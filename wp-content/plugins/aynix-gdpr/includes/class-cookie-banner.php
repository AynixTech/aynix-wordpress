<?php
/**
 * GDPR Cookie Banner
 */

if (!defined('ABSPATH')) {
    exit;
}

class AYNIX_GDPR_Cookie_Banner {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('wp_footer', array($this, 'render_cookie_banner'));
    }
    
    public function render_cookie_banner() {
        // Don't show banner if consent cookie exists
        if (isset($_COOKIE['aynix_gdpr_consent'])) {
            return;
        }
        
        $position = get_option('aynix_gdpr_banner_position', 'bottom');
        $bg_color = get_option('aynix_gdpr_banner_bg_color', '#ffffff');
        $text_color = get_option('aynix_gdpr_banner_text_color', '#333333');
        
        ?>
        <div id="aynix-gdpr-banner" class="aynix-gdpr-banner position-<?php echo esc_attr($position); ?>" style="background-color: <?php echo esc_attr($bg_color); ?>; color: <?php echo esc_attr($text_color); ?>;">
            <div class="aynix-gdpr-banner-content">
                <div class="aynix-gdpr-banner-text">
                    <p>
                        <strong><?php echo esc_html(aynix_gdpr_translate('cookie_banner_title')); ?></strong><br>
                        <?php echo esc_html(aynix_gdpr_translate('cookie_banner_text')); ?>
                        <a href="<?php echo esc_url(get_permalink(get_option('aynix_gdpr_cookie_page_id'))); ?>" target="_blank" rel="noopener">
                            <?php echo esc_html(aynix_gdpr_translate('more_info')); ?>
                        </a>
                    </p>
                </div>
                <div class="aynix-gdpr-banner-actions">
                    <button type="button" class="aynix-gdpr-btn aynix-gdpr-btn-secondary aynix-gdpr-btn-settings">
                        <?php echo esc_html(aynix_gdpr_translate('customize')); ?>
                    </button>
                    <button type="button" class="aynix-gdpr-btn aynix-gdpr-btn-reject">
                        <?php echo esc_html(aynix_gdpr_translate('reject')); ?>
                    </button>
                    <button type="button" class="aynix-gdpr-btn aynix-gdpr-btn-primary aynix-gdpr-btn-accept-all">
                        <?php echo esc_html(aynix_gdpr_translate('accept_all')); ?>
                    </button>
                </div>
            </div>
        </div>

        <!-- Settings Modal -->
        <div class="aynix-gdpr-modal">
            <div class="aynix-gdpr-modal-content">
                <div class="aynix-gdpr-modal-header">
                    <h2><?php echo esc_html(aynix_gdpr_translate('cookie_preferences')); ?></h2>
                    <button type="button" class="aynix-gdpr-modal-close">
                        &times;
                    </button>
                </div>
                <div class="aynix-gdpr-modal-body">
                    <p><?php echo esc_html(aynix_gdpr_translate('preferences_description')); ?></p>
                    
                    <!-- Necessary Cookies -->
                    <div class="aynix-gdpr-cookie-category">
                        <div class="aynix-gdpr-cookie-category-header">
                            <h3 class="aynix-gdpr-cookie-category-title"><?php echo esc_html(aynix_gdpr_translate('necessary_cookies')); ?></h3>
                            <label class="aynix-gdpr-toggle">
                                <input type="checkbox" checked disabled>
                                <span class="aynix-gdpr-toggle-slider"></span>
                            </label>
                        </div>
                        <p class="aynix-gdpr-cookie-category-description">
                            <?php echo esc_html(aynix_gdpr_translate('necessary_description')); ?>
                        </p>
                    </div>

                    <?php if (get_option('aynix_gdpr_analytics_enabled', false)): ?>
                    <!-- Analytics Cookies -->
                    <div class="aynix-gdpr-cookie-category">
                        <div class="aynix-gdpr-cookie-category-header">
                            <h3 class="aynix-gdpr-cookie-category-title"><?php echo esc_html(aynix_gdpr_translate('analytics_cookies')); ?></h3>
                            <label class="aynix-gdpr-toggle">
                                <input type="checkbox" id="aynix-gdpr-analytics" name="analytics" value="1">
                                <span class="aynix-gdpr-toggle-slider"></span>
                            </label>
                        </div>
                        <p class="aynix-gdpr-cookie-category-description">
                            <?php echo esc_html(aynix_gdpr_translate('analytics_description')); ?>
                        </p>
                    </div>
                    <?php endif; ?>

                    <?php if (get_option('aynix_gdpr_marketing_enabled', false)): ?>
                    <!-- Marketing Cookies -->
                    <div class="aynix-gdpr-cookie-category">
                        <div class="aynix-gdpr-cookie-category-header">
                            <h3 class="aynix-gdpr-cookie-category-title"><?php echo esc_html(aynix_gdpr_translate('marketing_cookies')); ?></h3>
                            <label class="aynix-gdpr-toggle">
                                <input type="checkbox" id="aynix-gdpr-marketing" name="marketing" value="1">
                                <span class="aynix-gdpr-toggle-slider"></span>
                            </label>
                        </div>
                        <p class="aynix-gdpr-cookie-category-description">
                            <?php echo esc_html(aynix_gdpr_translate('marketing_description')); ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="aynix-gdpr-modal-footer">
                    <button type="button" class="aynix-gdpr-btn aynix-gdpr-btn-secondary aynix-gdpr-modal-cancel">
                        <?php echo esc_html(aynix_gdpr_translate('cancel')); ?>
                    </button>
                    <button type="button" class="aynix-gdpr-btn aynix-gdpr-btn-primary aynix-gdpr-modal-save">
                        <?php echo esc_html(aynix_gdpr_translate('save_preferences')); ?>
                    </button>
                </div>
            </div>
        </div>
        <?php
    }
}
