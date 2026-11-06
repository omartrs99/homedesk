/**
 * One Page COD - Scripts JavaScript
 * Version: 1.0.0
 */

(function($) {
    'use strict';

    const OPC = {
        variationsCache: [],
        noBag: false,
        promo: { code: '', discount: 0 }, // code promo validé par le serveur
        promoTimer: null,
        promoRequest: 0,

        init: function() {
            this.bindEvents();
            this.initVariations();
            this.initPromoFromUrl();
        },

        bindEvents: function() {
            // Soumission du formulaire
            $(document).on('submit', '#opc-order-form', this.handleSubmit.bind(this));

            // Changement de variation (radio buttons)
            $(document).on('change', '.opc-variation-radio', this.handleVariationChange.bind(this));

            // Validation en temps réel
            $(document).on('blur', '.opc-input', this.validateField.bind(this));

            // Choix "Version" : avec sac / sans sac
            $(document).on('change', '.opc-bag-radio', this.handleBagChange.bind(this));

            // Saisie manuelle de la quantité
            $(document).on('input change', '#opc_quantity', function() {
                OPC.updateTotalPrice();
            });

            // Boutons +/− quantité
            $(document).on('click', '.opc-qty-minus', function() {
                var $input = $(this).siblings('#opc_quantity');
                var val = parseInt($input.val(), 10) || 1;
                var min = parseInt($input.attr('min'), 10) || 1;
                if (val > min) {
                    $input.val(val - 1).trigger('change');
                    OPC.updateTotalPrice(val - 1);
                }
                $(this).prop('disabled', parseInt($input.val(), 10) <= min);
            });

            $(document).on('click', '.opc-qty-plus', function() {
                var $input = $(this).siblings('#opc_quantity');
                var val = parseInt($input.val(), 10) || 1;
                var max = parseInt($input.attr('max'), 10);
                if (!max || val < max) {
                    $input.val(val + 1).trigger('change');
                    OPC.updateTotalPrice(val + 1);
                }
                $(this).closest('.opc-qty-wrap').find('.opc-qty-minus').prop('disabled', false);
            });

            // Code promo : lien « Vous avez un code promo ? », bouton « Appliquer », Entrée
            $(document).on('click', '.opc-promo-toggle', this.togglePromo.bind(this));
            $(document).on('click', '.opc-promo-apply', function() {
                OPC.applyPromo($('#opc_coupon').val(), 'field');
            });
            $(document).on('keydown', '#opc_coupon', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    OPC.applyPromo($(this).val(), 'field');
                }
            });
            // Code modifié après validation → la remise affichée n'est plus valable
            $(document).on('input', '#opc_coupon', function() {
                if (OPC.promo.code && $(this).val().trim().toLowerCase() !== OPC.promo.code) {
                    OPC.clearPromo();
                }
            });
            // Quantité / taille / version changées → remise recalculée par le serveur
            $(document).on('change', '#opc_quantity, .opc-variation-radio, .opc-bag-radio', this.schedulePromoRefresh.bind(this));
        },

        // ── Code promo ───────────────────────────────────────────────
        togglePromo: function() {
            var $box = $('#opc-promo-box');
            var open = $box.prop('hidden');
            $box.prop('hidden', !open);
            $('.opc-promo-toggle').attr('aria-expanded', open ? 'true' : 'false');
            if (open) {
                $('#opc_coupon').trigger('focus');
            }
        },

        // ?promo=CODE dans l'URL : pré-remplit et applique le code (gardé pour la session,
        // ex. landing → fiche produit). Fonctionne aussi quand le lien est masqué dans les réglages.
        initPromoFromUrl: function() {
            if (!$('#opc_coupon').length) {
                return;
            }
            var code = '';
            try {
                code = new URLSearchParams(window.location.search).get('promo') || '';
            } catch (e) {}
            try {
                if (code) {
                    sessionStorage.setItem('opc_promo', code);
                } else {
                    code = sessionStorage.getItem('opc_promo') || '';
                }
            } catch (e) {}
            code = code.trim();
            if (!code) {
                return;
            }
            $('#opc_coupon').val(code);
            if ($('.opc-promo').data('promo-field') == 1) {
                $('#opc-promo-box').prop('hidden', false);
                $('.opc-promo-toggle').attr('aria-expanded', 'true');
            }
            this.applyPromo(code, 'url');
        },

        // source : 'field' (bouton), 'url' (?promo=), 'refresh' (quantité / version changée)
        applyPromo: function(code, source) {
            var $form = $('#opc-order-form');
            code = (code || '').trim();
            if (!code) {
                this.clearPromo();
                this.showPromoStatus('error', opcData.messages.promo_empty);
                return;
            }

            var requestId = ++this.promoRequest;
            var $btn = $('.opc-promo-apply');
            if (source !== 'refresh') {
                $btn.prop('disabled', true).addClass('loading');
            }

            $.ajax({
                url: opcData.ajax_url,
                type: 'POST',
                data: {
                    action: 'opc_apply_coupon',
                    nonce: opcData.nonce,
                    coupon_code: code,
                    product_id: $form.find('input[name="product_id"]').val(),
                    variation_id: $('#opc_variation_id').val() || 0,
                    quantity: $('#opc_quantity').val() || 1,
                    no_bag: $('#opc_no_bag').val() || '0',
                    email: $('#opc_email').val() || ''
                },
                success: function(response) {
                    if (requestId !== OPC.promoRequest) {
                        return; // réponse dépassée par une requête plus récente
                    }
                    if (response.success) {
                        OPC.promo = { code: response.data.code, discount: parseFloat(response.data.discount) || 0 };
                        OPC.showPromoStatus('success', response.data.message);
                        OPC.updateTotalPrice();
                        return;
                    }
                    var message = (response.data && response.data.message) || opcData.messages.error;
                    OPC.clearPromo();
                    if (source === 'url') {
                        // Code du lien refusé : on le retire pour ne pas bloquer la commande
                        $('#opc_coupon').val('');
                        try { sessionStorage.removeItem('opc_promo'); } catch (e) {}
                        if ($('.opc-promo').data('promo-field') != 1) {
                            return;
                        }
                    }
                    OPC.showPromoStatus('error', message);
                },
                error: function() {
                    if (requestId === OPC.promoRequest) {
                        OPC.showPromoStatus('error', opcData.messages.error);
                    }
                },
                complete: function() {
                    $btn.prop('disabled', false).removeClass('loading');
                }
            });
        },

        schedulePromoRefresh: function() {
            if (!this.promo.code) {
                return;
            }
            clearTimeout(this.promoTimer);
            this.promoTimer = setTimeout(function() {
                OPC.applyPromo(OPC.promo.code, 'refresh');
            }, 300);
        },

        clearPromo: function() {
            this.promoRequest++;
            this.promo = { code: '', discount: 0 };
            $('.opc-promo-status').empty();
            this.updateTotalPrice();
        },

        showPromoStatus: function(type, message) {
            $('.opc-promo-status').html(
                $('<p class="opc-promo-msg opc-promo-msg--' + type + '"></p>').text(message)
            );
        },

        initVariations: function() {
            const $form = $('#opc-order-form');

            if (!$form.length || $form.data('product-type') !== 'variable') {
                return;
            }

            // Charger le cache depuis le DOM (pré-rendu PHP, pas d'AJAX)
            this.variationsCache = $form.find('.opc-variations-section').data('opc-variations') || [];

            // Synchroniser l'état visuel .is-checked avec le radio réellement coché
            // (indispensable car le style ne repose plus sur :has() pour la compat mobile)
            $form.find('.opc-variation-radios').each(function() {
                var $radios = $(this);
                $radios.find('.opc-radio-option').removeClass('is-checked');
                $radios.find('input[type="radio"]:checked')
                       .closest('.opc-radio-option').addClass('is-checked');
            });

            // Appliquer la variation pré-sélectionnée (premier radio)
            this.resolveVariation($form);
        },

        resolveVariation: function($form) {
            const selected = {};
            $form.find('.opc-variation-radios').each(function() {
                const attrName = $(this).data('attribute');
                const val = $(this).find('input[type="radio"]:checked').val();
                if (val) selected[attrName] = val;
            });

            const match = this.variationsCache.find(function(v) {
                return Object.keys(selected).every(function(k) {
                    return v.attributes[k] === selected[k];
                });
            });

            if (match) {
                $('#opc_variation_id').val(match.variation_id);
                OPC.displayVariationPrice(match, $form);
            } else {
                $('#opc_variation_id').val('');
            }
        },

        handleVariationChange: function(e) {
            const $radio = $(e.currentTarget);
            const $form = $radio.closest('form');

            // Mettre à jour l'état visuel
            $radio.closest('.opc-variation-radios').find('.opc-radio-option').removeClass('is-checked');
            $radio.closest('.opc-radio-option').addClass('is-checked');

            // Lookup instantané dans le cache — pas d'AJAX
            this.resolveVariation($form);
        },

        getVariationData: function(productId, attributes, $form) {
            $.ajax({
                url: opcData.ajax_url,
                type: 'POST',
                data: {
                    action: 'opc_get_variation_data',
                    nonce: opcData.nonce,
                    product_id: productId,
                    attributes: attributes
                },
                success: function(response) {
                    if (response.success) {
                        $('#opc_variation_id').val(response.data.variation_id);
                        
                        // Afficher le prix si disponible
                        OPC.displayVariationPrice(response.data, $form);
                    } else {
                        OPC.showMessage('error', response.data.message || opcData.messages.error);
                    }
                },
                error: function() {
                    OPC.showMessage('error', opcData.messages.error);
                }
            });
        },

        displayVariationPrice: function(data, $form) {
            // Mettre à jour la boîte de prix principale avec la variation sélectionnée
            var $priceBox = $form.find('.opc-product-price');
            var regularPrice = (typeof data.regular_price !== 'undefined' && data.regular_price !== '')
                ? data.regular_price
                : data.price;
            $priceBox
                .data('unit-price', data.price)
                .attr('data-unit-price', data.price)
                .data('regular-price', regularPrice)
                .attr('data-regular-price', regularPrice)
                .html(data.price_html);

            // Afficher / mettre à jour la description de la variation
            $form.find('.opc-variation-desc').remove();
            if (data.description) {
                // Après le choix « Version » s'il existe : Taille et Version restent côte à côte
                var $desc = $('<div class="opc-variation-desc"></div>').html(data.description);
                var $bag = $form.find('.opc-bag-field');
                if ($bag.length) {
                    $bag.after($desc);
                } else {
                    $form.find('.opc-variations-section').append($desc);
                }
            }

            // Activer/désactiver le bouton selon la disponibilité
            $form.find('.opc-submit-btn').prop('disabled', !data.is_in_stock);

            // Réappliquer la quantité et l'éventuelle remise "sans sac"
            OPC.updateTotalPrice();
        },

        getNoBagDiscount: function() {
            if (!this.noBag) {
                return 0;
            }
            var attr = parseFloat($('.opc-bag-field').data('nobag-discount'));
            if (!isNaN(attr)) {
                return attr;
            }
            return parseFloat(opcData.nobag_discount) || 0;
        },

        handleBagChange: function(e) {
            var $radio = $(e.currentTarget);

            this.noBag = $radio.val() === '1';

            $radio.closest('.opc-bag-radios').find('.opc-radio-option').removeClass('is-checked');
            $radio.closest('.opc-radio-option').addClass('is-checked');
            $('#opc_no_bag').val(this.noBag ? '1' : '0');

            this.updateTotalPrice();
        },

        checkVariations: function() {
            const $form = $('#opc-order-form');

            if (!$form.length || $form.data('product-type') !== 'variable') {
                return true;
            }

            let allSelected = true;

            $form.find('.opc-variation-radios').each(function() {
                if (!$(this).find('input[type="radio"]:checked').val()) {
                    allSelected = false;
                }
            });

            return allSelected;
        },

        handleSubmit: function(e) {
            e.preventDefault();
            
            const $form = $(e.currentTarget);
            const $submitBtn = $form.find('.opc-submit-btn');
            
            // Nettoyer les messages précédents
            this.clearMessages();
            
            // Validation côté client
            if (!this.validateForm($form)) {
                return false;
            }
            
            // Vérifier les variations pour les produits variables
            if ($form.data('product-type') === 'variable' && !this.checkVariations()) {
                this.showMessage('error', 'Veuillez sélectionner toutes les options du produit.');
                return false;
            }
            
            // Désactiver le bouton et afficher le loader
            $submitBtn.prop('disabled', true).addClass('loading');
            
            // Préparer les données
            const formData = new FormData($form[0]);
            formData.append('action', 'opc_submit_order');
            formData.append('nonce', opcData.nonce);
            
            // Envoyer la requête AJAX
            $.ajax({
                url: opcData.ajax_url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: this.handleSuccess.bind(this),
                error: this.handleError.bind(this),
                complete: function() {
                    $submitBtn.prop('disabled', false).removeClass('loading');
                }
            });
            
            return false;
        },

        handleSuccess: function(response) {
            if (response.success) {
                this.showMessage('success', response.data.message);

                // Émettre un événement découplé pour le tracking (Meta Pixel, GA, etc.)
                if (response.data.tracking) {
                    document.dispatchEvent(new CustomEvent('opc:purchase', {
                        detail: response.data.tracking
                    }));
                }

                // Réinitialiser le formulaire
                $('#opc-order-form')[0].reset();
                $('#opc_variation_id').val('');

                // Réinitialiser la version (retour à "avec sac", coché par défaut)
                OPC.noBag = false;
                $('#opc_no_bag').val('0');

                // Réinitialiser le code promo (utilisé par cette commande)
                OPC.clearPromo();
                try { sessionStorage.removeItem('opc_promo'); } catch (e) {}

                // Rétablir l'état visuel des radios et recharger la variation par défaut
                var $resetForm = $('#opc-order-form');
                $resetForm.find('.opc-variation-radios, .opc-bag-radios').each(function() {
                    $(this).find('.opc-radio-option').removeClass('is-checked');
                    $(this).find('.opc-radio-option:first').addClass('is-checked');
                });
                OPC.initVariations();
                
                // Défiler vers le message
                this.scrollToMessages();
                
                // Redirection si définie (validation same-origin pour éviter open redirect)
                if (response.data.redirect_url) {
                    setTimeout(function() {
                        try {
                            var url = new URL(response.data.redirect_url, window.location.origin);
                            if (url.origin === window.location.origin) {
                                window.location.href = url.href;
                            }
                        } catch (e) {}
                    }, 2000);
                }
            } else {
                if (response.data && response.data.coupon_error) {
                    // Code refusé : le retirer du total affiché et signaler sous le champ
                    this.clearPromo();
                    $('#opc-promo-box').prop('hidden', false);
                    $('.opc-promo-toggle').attr('aria-expanded', 'true');
                    this.showPromoStatus('error', $('<textarea>').html(response.data.message).text()); // message échappé côté serveur
                }
                this.showMessage('error', (response.data && response.data.message) || opcData.messages.error);
                this.scrollToMessages();
            }
        },

        handleError: function() {
            this.showMessage('error', opcData.messages.error);
            this.scrollToMessages();
        },

        validateForm: function($form) {
            let isValid = true;
            
            // Valider les champs requis
            $form.find('[required]').each(function() {
                const $field = $(this);
                
                if (!OPC.validateField.call($field[0])) {
                    isValid = false;
                }
            });
            
            return isValid;
        },

        validateField: function(e) {
            const $field = $(e ? e.currentTarget : this);
            const value = $field.val().trim();
            const fieldType = $field.attr('type');
            const fieldName = $field.attr('name');
            
            // Supprimer les anciennes erreurs
            $field.removeClass('error');
            $field.siblings('.opc-field-error').remove();
            
            // Vérifier si le champ est requis
            if ($field.prop('required') && !value) {
                OPC.showFieldError($field, opcData.messages.required);
                return false;
            }
            
            // Validation spécifique selon le type
            if (value) {
                if (fieldType === 'email' && !OPC.isValidEmail(value)) {
                    OPC.showFieldError($field, opcData.messages.invalid_email);
                    return false;
                }
                
                if (fieldType === 'tel' || fieldName === 'phone') {
                    if (!OPC.isValidPhone(value)) {
                        OPC.showFieldError($field, opcData.messages.invalid_phone);
                        return false;
                    }
                }
            }
            
            return true;
        },

        showFieldError: function($field, message) {
            $field.addClass('error');
            $field.after('<span class="opc-field-error">' + message + '</span>');
        },

        isValidEmail: function(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        },

        isValidPhone: function(phone) {
            const cleanPhone = phone.replace(/[^0-9]/g, '');
            return cleanPhone.length >= 8;
        },

        showMessage: function(type, message) {
            const $messagesContainer = $('.opc-form-messages');
            
            let className = 'opc-message';
            
            switch(type) {
                case 'success':
                    className += ' opc-message-success';
                    break;
                case 'error':
                    className += ' opc-message-error';
                    break;
                case 'info':
                    className += ' opc-message-info';
                    break;
            }
            
            const $message = $('<div class="' + className + '">' + message + '</div>');
            
            $messagesContainer.html($message);
        },

        clearMessages: function() {
            $('.opc-form-messages').empty();
            $('.opc-field-error').remove();
            $('.opc-input').removeClass('error');
        },

        formatPrice: function(amount) {
            var decimals    = parseInt(opcData.price_decimals, 10) || 0;
            var decSep      = opcData.decimal_separator  || ',';
            var thouSep     = opcData.thousand_separator || '.';
            var symbol      = opcData.currency_symbol    || 'DT';
            var pos         = opcData.currency_pos       || 'right_space';

            var fixed   = parseFloat(amount).toFixed(decimals);
            var parts   = fixed.split('.');
            parts[0]    = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thouSep);
            var number  = parts.join(decSep);

            switch (pos) {
                case 'left':       return symbol + number;
                case 'left_space': return symbol + ' ' + number;
                case 'right':      return number + symbol;
                default:           return number + ' ' + symbol; // right_space
            }
        },

        updateTotalPrice: function(qty) {
            var $priceBox    = $('.opc-product-price');
            if (!$priceBox.length) {
                return;
            }

            if (typeof qty === 'undefined' || qty === null) {
                qty = parseInt($('#opc_quantity').val(), 10) || 1;
            }

            var unitPrice    = parseFloat($priceBox.data('unit-price'))    || 0;
            var regularPrice = parseFloat($priceBox.data('regular-price')) || 0;

            // Remise "sans sac" deduite par article (jamais en dessous de 0)
            var discount     = this.getNoBagDiscount();
            var effUnit      = Math.max(0, unitPrice - discount);
            var effRegular   = regularPrice ? Math.max(0, regularPrice - discount) : 0;

            var updateBdi = function($bdi, total) {
                var $symbol = $bdi.find('.woocommerce-Price-currencySymbol').detach();
                $bdi.text(OPC.formatPrice(total).replace(' ' + opcData.currency_symbol, '').replace(opcData.currency_symbol + ' ', '') + ' ');
                $bdi.append($symbol);
            };

            // Remise du code promo (montant total calculé par le serveur)
            var total = Math.max(0, effUnit * qty - (this.promo.discount || 0));

            // Prix soldé (ins) ou prix simple
            var $ins = $priceBox.find('ins .woocommerce-Price-amount bdi');
            if ($ins.length) {
                updateBdi($ins, total);
            } else {
                updateBdi($priceBox.find('.woocommerce-Price-amount bdi').first(), total);
            }

            // Prix barré (del)
            var $del = $priceBox.find('del .woocommerce-Price-amount bdi');
            if ($del.length && effRegular) {
                updateBdi($del, effRegular * qty);
            }
        },

        scrollToMessages: function() {
            const $messages = $('.opc-form-messages');
            
            if ($messages.length) {
                $('html, body').animate({
                    scrollTop: $messages.offset().top - 100
                }, 500);
            }
        }
    };

    // Initialiser au chargement du DOM
    $(document).ready(function() {
        OPC.init();
    });

    // Exposer OPC globalement pour les extensions
    window.OPC = OPC;

})(jQuery);

/* ── img-popup lightbox (JS natif) ─────────────────────────── */
document.addEventListener('click', function (e) {
    var trigger = e.target.closest('.img-popup');
    if (!trigger) return;

    var img = trigger.matches('img') ? trigger : trigger.querySelector('img');
    var src = img ? img.getAttribute('src') : null;
    var alt = img ? (img.getAttribute('alt') || '') : '';
    if (!src) return;

    var overlay = document.createElement('div');
    overlay.className = 'img-popup-overlay';
    overlay.setAttribute('role', 'dialog');
    overlay.setAttribute('aria-modal', 'true');
    overlay.innerHTML =
        '<div class="img-popup-inner">' +
            '<img class="img-popup-full" src="' + src + '" alt="' + alt + '">' +
            '<button class="img-popup-close" aria-label="Fermer">&times;</button>' +
        '</div>';

    document.body.appendChild(overlay);
    document.body.classList.add('img-popup-open');

    requestAnimationFrame(function () {
        overlay.classList.add('img-popup-visible');
    });

    function closePopup() {
        overlay.classList.remove('img-popup-visible');
        document.body.classList.remove('img-popup-open');
        setTimeout(function () { overlay.remove(); }, 320);
        document.removeEventListener('keydown', onKeyDown);
    }

    overlay.addEventListener('click', function (e) {
        if (!e.target.closest('.img-popup-inner img')) closePopup();
    });

    function onKeyDown(e) {
        if (e.key === 'Escape') closePopup();
    }
    document.addEventListener('keydown', onKeyDown);
});
