/**
 * One Page COD - Scripts JavaScript
 * Version: 1.0.0
 */

(function($) {
    'use strict';

    const OPC = {
        init: function() {
            this.bindEvents();
            this.initVariations();
        },

        bindEvents: function() {
            // Soumission du formulaire
            $(document).on('submit', '#opc-order-form', this.handleSubmit.bind(this));
            
            // Changement de variation
            $(document).on('change', '.opc-variation-select', this.handleVariationChange.bind(this));
            
            // Validation en temps réel
            $(document).on('blur', '.opc-input', this.validateField.bind(this));
        },

        initVariations: function() {
            const $form = $('#opc-order-form');
            
            if ($form.length && $form.data('product-type') === 'variable') {
                // Vérifier si toutes les variations sont sélectionnées
                this.checkVariations();
            }
        },

        handleVariationChange: function(e) {
            const $select = $(e.currentTarget);
            const $form = $select.closest('form');
            const productId = $form.data('product-id');
            
            // Récupérer toutes les sélections de variations
            const attributes = {};
            let allSelected = true;
            
            $form.find('.opc-variation-select').each(function() {
                const $this = $(this);
                const value = $this.val();
                
                if (value) {
                    attributes[$this.data('attribute')] = value;
                } else {
                    allSelected = false;
                }
            });
            
            // Si toutes les variations sont sélectionnées, récupérer les données
            if (allSelected) {
                this.getVariationData(productId, attributes, $form);
            } else {
                $('#opc_variation_id').val('');
            }
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
            // Supprimer l'ancien affichage de prix
            $form.find('.opc-variation-price').remove();
            
            // Créer un nouvel affichage
            const $priceDiv = $('<div class="opc-variation-price"></div>');
            $priceDiv.html(data.price_html);
            
            // Ajouter l'info de stock
            if (data.is_in_stock) {
                if (data.stock_quantity !== null) {
                    $priceDiv.append('<div class="opc-stock-status in-stock">Stock: ' + data.stock_quantity + '</div>');
                } else {
                    $priceDiv.append('<div class="opc-stock-status in-stock">En stock</div>');
                }
            } else {
                $priceDiv.append('<div class="opc-stock-status out-of-stock">Rupture de stock</div>');
            }
            
            $form.find('.opc-variations-section').append($priceDiv);
        },

        checkVariations: function() {
            const $form = $('#opc-order-form');
            
            if (!$form.length || $form.data('product-type') !== 'variable') {
                return true;
            }
            
            let allSelected = true;
            
            $form.find('.opc-variation-select').each(function() {
                if (!$(this).val()) {
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
                
                // Réinitialiser le formulaire
                $('#opc-order-form')[0].reset();
                $('#opc_variation_id').val('');
                $('.opc-variation-price').remove();
                
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
                this.showMessage('error', response.data.message || opcData.messages.error);
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
