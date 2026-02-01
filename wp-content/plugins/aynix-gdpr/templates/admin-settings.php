<?php
/**
 * Admin Settings Template
 */

if (!defined('ABSPATH')) {
    exit;
}

// Get current options
$cookie_banner_enabled = get_option('aynix_gdpr_cookie_banner_enabled', true);
$banner_position = get_option('aynix_gdpr_banner_position', 'bottom');
$banner_bg_color = get_option('aynix_gdpr_banner_bg_color', '#ffffff');
$banner_text_color = get_option('aynix_gdpr_banner_text_color', '#333333');
$cookie_expiry = get_option('aynix_gdpr_cookie_expiry', 365);
$analytics_enabled = get_option('aynix_gdpr_analytics_enabled', false);
$marketing_enabled = get_option('aynix_gdpr_marketing_enabled', false);

// Get GDPR pages
$privacy_page_id = get_option('aynix_gdpr_privacy_page_id');
$cookie_page_id = get_option('aynix_gdpr_cookie_page_id');
$terms_page_id = get_option('aynix_gdpr_terms_page_id');
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    
    <?php settings_errors('aynix_gdpr_messages'); ?>
    
    <form method="post" action="options.php">
        <?php
        settings_fields('aynix_gdpr_options');
        do_settings_sections('aynix_gdpr_options');
        ?>
        
        <table class="form-table">
            
            <!-- Cookie Banner -->
            <tr>
                <th colspan="2">
                    <h2>Banner Cookie</h2>
                </th>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="aynix_gdpr_cookie_banner_enabled">Abilita Banner</label>
                </th>
                <td>
                    <label>
                        <input type="checkbox" 
                               name="aynix_gdpr_cookie_banner_enabled" 
                               id="aynix_gdpr_cookie_banner_enabled" 
                               value="1" 
                               <?php checked($cookie_banner_enabled, true); ?>>
                        Mostra il banner cookie ai visitatori
                    </label>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="aynix_gdpr_banner_position">Posizione Banner</label>
                </th>
                <td>
                    <select name="aynix_gdpr_banner_position" id="aynix_gdpr_banner_position">
                        <option value="bottom" <?php selected($banner_position, 'bottom'); ?>>In basso</option>
                        <option value="top" <?php selected($banner_position, 'top'); ?>>In alto</option>
                    </select>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="aynix_gdpr_banner_bg_color">Colore Sfondo Banner</label>
                </th>
                <td>
                    <input type="text" 
                           name="aynix_gdpr_banner_bg_color" 
                           id="aynix_gdpr_banner_bg_color" 
                           value="<?php echo esc_attr($banner_bg_color); ?>" 
                           class="aynix-gdpr-color-picker">
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="aynix_gdpr_banner_text_color">Colore Testo Banner</label>
                </th>
                <td>
                    <input type="text" 
                           name="aynix_gdpr_banner_text_color" 
                           id="aynix_gdpr_banner_text_color" 
                           value="<?php echo esc_attr($banner_text_color); ?>" 
                           class="aynix-gdpr-color-picker">
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="aynix_gdpr_cookie_expiry">Scadenza Cookie (giorni)</label>
                </th>
                <td>
                    <input type="number" 
                           name="aynix_gdpr_cookie_expiry" 
                           id="aynix_gdpr_cookie_expiry" 
                           value="<?php echo esc_attr($cookie_expiry); ?>" 
                           min="1" 
                           max="365">
                    <p class="description">Dopo quanti giorni il consenso scade e deve essere richiesto nuovamente</p>
                </td>
            </tr>
            
            <!-- Cookie Categories -->
            <tr>
                <th colspan="2">
                    <h2>Categorie Cookie</h2>
                </th>
            </tr>
            
            <tr>
                <th scope="row">Cookie Necessari</th>
                <td>
                    <label>
                        <input type="checkbox" disabled checked>
                        Sempre attivi (richiesti per il funzionamento del sito)
                    </label>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="aynix_gdpr_analytics_enabled">Cookie Analytics</label>
                </th>
                <td>
                    <label>
                        <input type="checkbox" 
                               name="aynix_gdpr_analytics_enabled" 
                               id="aynix_gdpr_analytics_enabled" 
                               value="1" 
                               <?php checked($analytics_enabled, true); ?>>
                        Abilita cookie analytics (Google Analytics, ecc.)
                    </label>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="aynix_gdpr_marketing_enabled">Cookie Marketing</label>
                </th>
                <td>
                    <label>
                        <input type="checkbox" 
                               name="aynix_gdpr_marketing_enabled" 
                               id="aynix_gdpr_marketing_enabled" 
                               value="1" 
                               <?php checked($marketing_enabled, true); ?>>
                        Abilita cookie marketing (Facebook Pixel, LinkedIn, ecc.)
                    </label>
                </td>
            </tr>
            
            <!-- GDPR Pages -->
            <tr>
                <th colspan="2">
                    <h2>Pagine GDPR</h2>
                </th>
            </tr>
            
            <tr>
                <th scope="row">Privacy Policy</th>
                <td>
                    <?php if ($privacy_page_id): ?>
                        <a href="<?php echo get_permalink($privacy_page_id); ?>" target="_blank">
                            Visualizza pagina
                        </a>
                        |
                        <a href="<?php echo get_edit_post_link($privacy_page_id); ?>">
                            Modifica
                        </a>
                    <?php else: ?>
                        <span style="color: #d63638;">Non creata</span>
                    <?php endif; ?>
                </td>
            </tr>
            
            <tr>
                <th scope="row">Cookie Policy</th>
                <td>
                    <?php if ($cookie_page_id): ?>
                        <a href="<?php echo get_permalink($cookie_page_id); ?>" target="_blank">
                            Visualizza pagina
                        </a>
                        |
                        <a href="<?php echo get_edit_post_link($cookie_page_id); ?>">
                            Modifica
                        </a>
                    <?php else: ?>
                        <span style="color: #d63638;">Non creata</span>
                    <?php endif; ?>
                </td>
            </tr>
            
            <tr>
                <th scope="row">Terms of Service</th>
                <td>
                    <?php if ($terms_page_id): ?>
                        <a href="<?php echo get_permalink($terms_page_id); ?>" target="_blank">
                            Visualizza pagina
                        </a>
                        |
                        <a href="<?php echo get_edit_post_link($terms_page_id); ?>">
                            Modifica
                        </a>
                    <?php else: ?>
                        <span style="color: #d63638;">Non creata</span>
                    <?php endif; ?>
                </td>
            </tr>
            
            <?php if (!$privacy_page_id || !$cookie_page_id || !$terms_page_id): ?>
            <tr>
                <th scope="row"></th>
                <td>
                    <form method="post" action="">
                        <?php wp_nonce_field('aynix_gdpr_regenerate_pages', 'aynix_gdpr_regenerate_nonce'); ?>
                        <button type="submit" 
                                name="aynix_gdpr_regenerate_pages" 
                                class="button button-secondary">
                            Rigenera Pagine Mancanti
                        </button>
                    </form>
                </td>
            </tr>
            <?php endif; ?>
            
        </table>
        
        <?php submit_button('Salva Impostazioni'); ?>
    </form>
</div>

<?php
// Handle page regeneration
if (isset($_POST['aynix_gdpr_regenerate_pages']) && 
    check_admin_referer('aynix_gdpr_regenerate_pages', 'aynix_gdpr_regenerate_nonce')) {
    
    require_once AYNIX_GDPR_PLUGIN_DIR . 'includes/class-page-generator.php';
    AYNIX_GDPR_Page_Generator::create_gdpr_pages();
    
    echo '<div class="notice notice-success"><p>Pagine GDPR rigenerate con successo!</p></div>';
    
    // Reload page
    echo '<meta http-equiv="refresh" content="1">';
}
?>
