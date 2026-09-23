/**
 * One Page COD — Capture des abandons (leads).
 *
 * Génère un session_id persistant (localStorage) au chargement de la fiche produit,
 * puis sauvegarde progressivement les coordonnées (dès qu'un téléphone >=8 chiffres
 * OU un email valide est saisi), même sans clic sur "Commander".
 *
 * Réutilise opcData (ajax_url + nonce) localisé par opc-scripts.
 */
(function () {
    'use strict';

    var form = document.getElementById('opc-order-form');
    if (!form || typeof window.opcData === 'undefined') {
        return;
    }

    // -------------------------------------------------------------------------
    // session_id persistant (même personne / navigateur = même id au retour)
    // -------------------------------------------------------------------------
    function getSessionId() {
        var key = 'homedesk_lead_sid';
        var sid = null;
        try { sid = localStorage.getItem(key); } catch (e) {}
        if (!sid) {
            if (window.crypto && typeof crypto.randomUUID === 'function') {
                sid = crypto.randomUUID();
            } else {
                sid = 'sid-' + Date.now() + '-' + Math.random().toString(36).slice(2);
            }
            try { localStorage.setItem(key, sid); } catch (e) {}
        }
        return sid;
    }

    var sessionId = getSessionId();

    // Injecter dans le champ caché pour lier la commande au lead
    var hidden = form.querySelector('#opc_session_id');
    if (hidden) {
        hidden.value = sessionId;
    }

    // -------------------------------------------------------------------------
    // Sauvegarde progressive
    // -------------------------------------------------------------------------
    function digits(v) { return (v || '').replace(/[^0-9]/g, ''); }
    function isEmailValid(v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test((v || '').trim()); }
    function val(sel) { var el = form.querySelector(sel); return el ? el.value : ''; }

    function collect() {
        var variation = [];
        form.querySelectorAll('.opc-variation-radios').forEach(function (g) {
            var r = g.querySelector('input[type="radio"]:checked');
            if (r) { variation.push(r.value); }
        });
        return {
            session_id: sessionId,
            name:       val('#opc_name'),
            phone:      val('#opc_phone'),
            email:      val('#opc_email'),
            address:    val('#opc_address'),
            product_id: (form.querySelector('input[name="product_id"]') || {}).value || '',
            variation:  variation.join(', '),
            quantity:   val('#opc_quantity') || '1'
        };
    }

    var lastPayload = '';
    var timer = null;

    function save() {
        var p = collect();

        // Exiger un moyen de contact valide (tél >=8 chiffres OU email valide)
        if (digits(p.phone).length < 8 && !isEmailValid(p.email)) {
            return;
        }

        var json = JSON.stringify(p);
        if (json === lastPayload) {
            return; // rien de neuf depuis le dernier envoi
        }
        lastPayload = json;

        var body = new URLSearchParams();
        body.append('action', 'opc_save_lead');
        body.append('nonce', window.opcData.nonce);
        Object.keys(p).forEach(function (k) { body.append(k, p[k]); });

        fetch(window.opcData.ajax_url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: body.toString(),
            keepalive: true // permet l'envoi même si la page se ferme
        }).catch(function () {});
    }

    function schedule() {
        clearTimeout(timer);
        timer = setTimeout(save, 1200);
    }

    ['#opc_name', '#opc_phone', '#opc_email', '#opc_address', '#opc_quantity'].forEach(function (sel) {
        var el = form.querySelector(sel);
        if (!el) { return; }
        el.addEventListener('input', schedule);
        el.addEventListener('blur', save);
    });
    form.addEventListener('change', schedule); // variations, quantité +/-

    // Filet de sécurité : tenter une sauvegarde si l'utilisateur quitte la page
    window.addEventListener('pagehide', save);
})();
