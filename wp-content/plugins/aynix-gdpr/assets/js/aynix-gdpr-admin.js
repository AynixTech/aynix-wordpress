/**
 * AYNIX GDPR Admin JavaScript
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        
        // Initialize color pickers if available
        if ($.fn.wpColorPicker) {
            $('.aynix-gdpr-color-picker').wpColorPicker();
        }
        
    });
    
})(jQuery);
