<?php
/**
 * Plugin Name: AYNIX GDPR
 * Plugin URI: https://aynix.tech
 * Description: Plugin GDPR completo con cookie banner, gestione consensi e pagine automatiche (Privacy Policy, Cookie Policy, Terms of Service)
 * Version: 1.0.0
 * Author: AYNIX
 * Author URI: https://aynix.tech
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: aynix-gdpr
 * Domain Path: /languages
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('AYNIX_GDPR_VERSION', '1.0.0');
define('AYNIX_GDPR_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('AYNIX_GDPR_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include dependencies
require_once AYNIX_GDPR_PLUGIN_DIR . 'includes/class-translations.php';
require_once AYNIX_GDPR_PLUGIN_DIR . 'includes/class-cookie-banner.php';
require_once AYNIX_GDPR_PLUGIN_DIR . 'includes/class-consent-manager.php';
require_once AYNIX_GDPR_PLUGIN_DIR . 'includes/class-page-generator.php';

/**
 * Main AYNIX GDPR Class
 */
class AYNIX_GDPR {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        $this->init_hooks();
    }
    
    private function init_hooks() {
        // Activation/Deactivation
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        
        // Enqueue assets
        add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
        
        // Init components
        add_action('init', array($this, 'init_components'));
        
        // Admin menu
        add_action('admin_menu', array($this, 'add_admin_menu'));
        
        // AJAX handlers
        add_action('wp_ajax_aynix_gdpr_save_consent', array($this, 'ajax_save_consent'));
        add_action('wp_ajax_nopriv_aynix_gdpr_save_consent', array($this, 'ajax_save_consent'));
        
        // Settings
        add_action('admin_init', array($this, 'register_settings'));
    }
    
    public function activate() {
        // Create necessary pages
        AYNIX_GDPR_Page_Generator::create_gdpr_pages();
        
        // Set default options
        $defaults = array(
            'cookie_banner_enabled' => true,
            'banner_position' => 'bottom',
            'banner_bg_color' => '#ffffff',
            'banner_text_color' => '#333333',
            'cookie_expiry' => 365,
            'analytics_enabled' => false,
            'marketing_enabled' => false,
        );
        
        foreach ($defaults as $key => $value) {
            if (get_option('aynix_gdpr_' . $key) === false) {
                add_option('aynix_gdpr_' . $key, $value);
            }
        }
        
        flush_rewrite_rules();
    }
    
    public function deactivate() {
        flush_rewrite_rules();
    }
    
    public function enqueue_assets() {
        // CSS
        wp_enqueue_style(
            'aynix-gdpr-styles',
            AYNIX_GDPR_PLUGIN_URL . 'assets/css/aynix-gdpr.css',
            array(),
            AYNIX_GDPR_VERSION
        );
        
        // JS
        wp_enqueue_script(
            'aynix-gdpr-script',
            AYNIX_GDPR_PLUGIN_URL . 'assets/js/aynix-gdpr.js',
            array('jquery'),
            AYNIX_GDPR_VERSION,
            true
        );
        
        // Localize script
        wp_localize_script('aynix-gdpr-script', 'aynixGDPR', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('aynix_gdpr_nonce'),
            'cookie_expiry' => get_option('aynix_gdpr_cookie_expiry', 365)
        ));
    }
    
    public function enqueue_admin_assets($hook) {
        if ('settings_page_aynix-gdpr' !== $hook) {
            return;
        }
        
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script(
            'aynix-gdpr-admin',
            AYNIX_GDPR_PLUGIN_URL . 'assets/js/aynix-gdpr-admin.js',
            array('jquery', 'wp-color-picker'),
            AYNIX_GDPR_VERSION,
            true
        );
    }
    
    public function init_components() {
        // Initialize cookie banner
        if (get_option('aynix_gdpr_cookie_banner_enabled', true)) {
            AYNIX_GDPR_Cookie_Banner::get_instance();
        }
        
        // Initialize consent manager
        AYNIX_GDPR_Consent_Manager::get_instance();
    }
    
    public function add_admin_menu() {
        add_options_page(
            __('AYNIX GDPR Settings', 'aynix-gdpr'),
            __('AYNIX GDPR', 'aynix-gdpr'),
            'manage_options',
            'aynix-gdpr',
            array($this, 'render_admin_page')
        );
    }
    
    public function render_admin_page() {
        if (!current_user_can('manage_options')) {
            return;
        }
        
        include AYNIX_GDPR_PLUGIN_DIR . 'templates/admin-settings.php';
    }
    
    public function register_settings() {
        $settings = array(
            'aynix_gdpr_cookie_banner_enabled',
            'aynix_gdpr_banner_position',
            'aynix_gdpr_banner_bg_color',
            'aynix_gdpr_banner_text_color',
            'aynix_gdpr_cookie_expiry',
            'aynix_gdpr_analytics_enabled',
            'aynix_gdpr_marketing_enabled',
        );
        
        foreach ($settings as $setting) {
            register_setting('aynix_gdpr_options', $setting);
        }
    }
    
    public function ajax_save_consent() {
        check_ajax_referer('aynix_gdpr_nonce', 'nonce');
        
        $consent = isset($_POST['consent']) ? $_POST['consent'] : array();
        
        $consent_data = array(
            'necessary' => true, // Always true
            'analytics' => isset($consent['analytics']) ? (bool) $consent['analytics'] : false,
            'marketing' => isset($consent['marketing']) ? (bool) $consent['marketing'] : false,
            'timestamp' => current_time('mysql')
        );
        
        // Return success
        wp_send_json_success(array(
            'message' => aynix_gdpr_translate('consent_saved'),
            'consent' => $consent_data
        ));
    }
}

// Initialize plugin
function aynix_gdpr_init() {
    return AYNIX_GDPR::get_instance();
}
add_action('plugins_loaded', 'aynix_gdpr_init');
