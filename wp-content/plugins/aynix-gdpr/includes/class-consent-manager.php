<?php
/**
 * GDPR Consent Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

class AYNIX_GDPR_Consent_Manager {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        // Block scripts based on consent
        add_action('wp_head', array($this, 'block_tracking_scripts'), 1);
    }
    
    public function block_tracking_scripts() {
        // Get consent
        $consent = $this->get_consent();
        
        // Block Google Analytics if not consented
        if (!$consent['analytics']) {
            add_filter('script_loader_tag', array($this, 'block_analytics_scripts'), 10, 3);
        }
        
        // Block Marketing scripts if not consented
        if (!$consent['marketing']) {
            add_filter('script_loader_tag', array($this, 'block_marketing_scripts'), 10, 3);
        }
    }
    
    public function block_analytics_scripts($tag, $handle, $src) {
        // Block Google Analytics
        if (strpos($src, 'google-analytics.com') !== false || 
            strpos($src, 'googletagmanager.com') !== false ||
            strpos($handle, 'analytics') !== false) {
            return '';
        }
        return $tag;
    }
    
    public function block_marketing_scripts($tag, $handle, $src) {
        // Block common marketing/advertising scripts
        $marketing_domains = array(
            'facebook.net',
            'doubleclick.net',
            'adservice.google',
            'ads.linkedin.com'
        );
        
        foreach ($marketing_domains as $domain) {
            if (strpos($src, $domain) !== false) {
                return '';
            }
        }
        
        return $tag;
    }
    
    public function get_consent() {
        $default_consent = array(
            'necessary' => true,
            'analytics' => false,
            'marketing' => false
        );
        
        if (!isset($_COOKIE['aynix_gdpr_consent'])) {
            return $default_consent;
        }
        
        $consent = json_decode(stripslashes($_COOKIE['aynix_gdpr_consent']), true);
        
        if (!is_array($consent)) {
            return $default_consent;
        }
        
        return wp_parse_args($consent, $default_consent);
    }
    
    public function has_consent($type = 'necessary') {
        $consent = $this->get_consent();
        return isset($consent[$type]) && $consent[$type] === true;
    }
}
