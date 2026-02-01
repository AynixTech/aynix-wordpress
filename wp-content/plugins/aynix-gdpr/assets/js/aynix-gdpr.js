/**
 * AYNIX GDPR Frontend JavaScript
 */

(function($) {
    'use strict';
    
    // Wait for DOM ready
    $(document).ready(function() {
        
        // Open preferences modal
        $('.aynix-gdpr-btn-settings').on('click', function(e) {
            e.preventDefault();
            $('.aynix-gdpr-modal').addClass('active');
        });
        
        // Close modal
        $('.aynix-gdpr-modal-close, .aynix-gdpr-modal-cancel').on('click', function(e) {
            e.preventDefault();
            $('.aynix-gdpr-modal').removeClass('active');
        });
        
        // Close modal when clicking outside
        $('.aynix-gdpr-modal').on('click', function(e) {
            if ($(e.target).is('.aynix-gdpr-modal')) {
                $(this).removeClass('active');
            }
        });
        
        // Accept all cookies
        $('.aynix-gdpr-btn-accept-all').on('click', function(e) {
            e.preventDefault();
            
            var consent = {
                necessary: true,
                analytics: true,
                marketing: true
            };
            
            saveConsent(consent);
        });
        
        // Reject all cookies (except necessary)
        $('.aynix-gdpr-btn-reject').on('click', function(e) {
            e.preventDefault();
            
            var consent = {
                necessary: true,
                analytics: false,
                marketing: false
            };
            
            saveConsent(consent);
        });
        
        // Save preferences from modal
        $('.aynix-gdpr-modal-save').on('click', function(e) {
            e.preventDefault();
            
            var consent = {
                necessary: true,
                analytics: $('#aynix-gdpr-analytics').is(':checked'),
                marketing: $('#aynix-gdpr-marketing').is(':checked')
            };
            
            saveConsent(consent);
        });
        
        /**
         * Save consent
         */
        function saveConsent(consent) {
            // Set cookie
            setCookie('aynix_gdpr_consent', JSON.stringify(consent), 365);
            
            // Send to server
            $.ajax({
                url: aynixGDPR.ajax_url,
                type: 'POST',
                data: {
                    action: 'aynix_gdpr_save_consent',
                    nonce: aynixGDPR.nonce,
                    consent: consent
                },
                success: function(response) {
                    // Hide banner
                    $('.aynix-gdpr-banner').fadeOut();
                    
                    // Close modal
                    $('.aynix-gdpr-modal').removeClass('active');
                    
                    // Reload page to apply consent
                    location.reload();
                },
                error: function() {
                    console.error('GDPR: Failed to save consent');
                }
            });
        }
        
        /**
         * Set cookie
         */
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/; SameSite=Lax";
        }
        
        /**
         * Get cookie
         */
        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }
        
    });
    
})(jQuery);
