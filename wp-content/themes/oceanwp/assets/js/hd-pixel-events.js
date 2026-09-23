/**
 * HomeDesk — Meta Pixel : événements liés au formulaire COD.
 *
 * Funnel : ViewContent (head) → InitiateCheckout → Lead → Purchase
 * Dépend de window.HD_PIXEL (défini dans le <head> sur les fiches produit)
 * et de fbq() (code de base du pixel dans le <head>).
 *
 * ⚠️ RGPD : on n'envoie JAMAIS nom / téléphone / email au pixel.
 * Seules les données produit (id, prix, devise) transitent ici.
 */
(function () {
	'use strict';

	var form = document.getElementById('opc-order-form');
	if (!form || typeof window.fbq !== 'function') {
		return;
	}

	var data = window.HD_PIXEL || { content_type: 'product' };

	// -------------------------------------------------------------------------
	// InitiateCheckout — au 1er contact réel avec le formulaire (1x/page)
	// -------------------------------------------------------------------------
	var initiateCheckoutFired = false;

	function fireInitiateCheckout() {
		if (initiateCheckoutFired) {
			return;
		}
		initiateCheckoutFired = true;
		fbq('track', 'InitiateCheckout', data);
	}

	// focusin couvre les clics/tab dans les champs ; change couvre radios & quantité
	form.addEventListener('focusin', fireInitiateCheckout);
	form.addEventListener('change', fireInitiateCheckout);

	// -------------------------------------------------------------------------
	// Lead — nom + téléphone (>=8 chiffres) + adresse valides (debounce 1s, 1x/page)
	// Signal "abandon avec infos" : si Lead part mais pas Purchase => abandon qualifié.
	// -------------------------------------------------------------------------
	var leadFired = false;
	var leadTimer = null;

	function isPhoneValid(v) {
		return v.replace(/[^0-9]/g, '').length >= 8;
	}

	function isEmailValid(v) {
		return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim());
	}

	function checkLead() {
		if (leadFired) {
			return;
		}
		var name  = (form.querySelector('#opc_name')  || {}).value || '';
		var phone = (form.querySelector('#opc_phone') || {}).value || '';
		var email = (form.querySelector('#opc_email') || {}).value || '';

		// Nom rempli + au moins un moyen de contact valide (téléphone OU email)
		if (name.trim() && (isPhoneValid(phone) || isEmailValid(email))) {
			leadFired = true;
			fbq('track', 'Lead', data);
		}
	}

	function scheduleLeadCheck() {
		if (leadFired) {
			return;
		}
		clearTimeout(leadTimer);
		leadTimer = setTimeout(checkLead, 1000);
	}

	['#opc_name', '#opc_phone', '#opc_email'].forEach(function (sel) {
		var el = form.querySelector(sel);
		if (!el) {
			return;
		}
		el.addEventListener('input', scheduleLeadCheck); // debounce pendant la saisie
		el.addEventListener('blur', checkLead);          // vérif immédiate en quittant le champ
	});

	// -------------------------------------------------------------------------
	// Purchase — commande créée (événement 'opc:purchase' émis par opc-scripts.js)
	// eventID = 'opc_<order_id>' : anti-doublon + clé de déduplication CAPI (phase 2).
	// -------------------------------------------------------------------------
	document.addEventListener('opc:purchase', function (e) {
		var t = e.detail || {};
		var params = {
			content_ids:  t.content_ids || data.content_ids,
			content_type: 'product',
			value:        t.value,
			currency:     t.currency || data.currency,
			num_items:    t.num_items
		};
		var options = t.order_id ? { eventID: 'opc_' + t.order_id } : {};
		fbq('track', 'Purchase', params, options);
	});
})();
