<?php
/**
 * Plugin Name: AYNIX Share Presentation
 * Plugin URI: https://aynix.tech
 * Description: Carica presentazioni (PDF o PPTX), assegna nome azienda e un PIN opzionale, genera un link da condividere con il cliente e gestisci l'elenco dei link generati.
 * Version: 1.1.4
 * Author: AYNIX Tech
 * Author URI: https://aynix.tech
 * Text Domain: aynix-share-presentation
 * License: GPL v2 or later
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('AYNIX_SP_VERSION', '1.1.4');
define('AYNIX_SP_FILE', __FILE__);
define('AYNIX_SP_DIR', plugin_dir_path(__FILE__));
define('AYNIX_SP_URL', plugin_dir_url(__FILE__));
define('AYNIX_SP_QUERY_VAR', 'aynix_presentation');

class AYNIX_Share_Presentation {

    private static $instance = null;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        // Activation / deactivation
        register_activation_hook(AYNIX_SP_FILE, array($this, 'activate'));
        register_deactivation_hook(AYNIX_SP_FILE, array($this, 'deactivate'));

        // Admin
        add_action('admin_menu', array($this, 'register_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'admin_assets'));
        add_action('admin_post_aynix_sp_save', array($this, 'handle_save'));
        add_action('admin_post_aynix_sp_delete', array($this, 'handle_delete'));

        // Public viewer
        add_action('init', array($this, 'add_rewrite'));
        add_filter('query_vars', array($this, 'register_query_var'));
        add_action('template_redirect', array($this, 'maybe_render_viewer'));

        // Handle raw file download / streaming
        add_action('template_redirect', array($this, 'maybe_serve_file'));
    }

    /* ---------------------------------------------------------------------
     * Activation
     * ------------------------------------------------------------------- */
    public function activate() {
        global $wpdb;
        $table = $wpdb->prefix . 'aynix_presentations';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$table} (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            token VARCHAR(64) NOT NULL,
            company_name VARCHAR(191) NOT NULL,
            client_name VARCHAR(191) DEFAULT '',
            file_url TEXT NOT NULL,
            file_name VARCHAR(255) NOT NULL,
            file_type VARCHAR(20) NOT NULL,
            pin VARCHAR(20) DEFAULT '',
            views BIGINT(20) UNSIGNED NOT NULL DEFAULT 0,
            created_at DATETIME NOT NULL,
            PRIMARY KEY  (id),
            UNIQUE KEY token (token)
        ) {$charset_collate};";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);

        $this->add_rewrite();
        flush_rewrite_rules();
    }

    public function deactivate() {
        flush_rewrite_rules();
    }

    private function table() {
        global $wpdb;
        return $wpdb->prefix . 'aynix_presentations';
    }

    /* ---------------------------------------------------------------------
     * Rewrite / routing
     * ------------------------------------------------------------------- */
    public function add_rewrite() {
        add_rewrite_rule('^p/([^/]+)/?$', 'index.php?' . AYNIX_SP_QUERY_VAR . '=$matches[1]', 'top');
    }

    public function register_query_var($vars) {
        $vars[] = AYNIX_SP_QUERY_VAR;
        return $vars;
    }

    public function get_share_link($token) {
        return home_url('/p/' . $token);
    }

    /* ---------------------------------------------------------------------
     * Site branding for the public viewer header
     * ------------------------------------------------------------------- */
    public function get_site_logo_html() {
        $logo_url = 'https://aynix.tech/wp-content/uploads/2025/11/logo_aynix-1.png';
        return '<a href="' . esc_url(home_url('/')) . '" class="aynix-sp-brand-link" rel="home">'
            . '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr__('Aynix logo', 'aynix-share-presentation') . '" class="aynix-sp-site-logo" /></a>';
    }

    public function get_site_header_html() {
        $nav_items = array(
            array(
                'label' => function_exists('aynix_translate') ? aynix_translate('nav.home') : __('Home', 'aynix-share-presentation'),
                'url'   => home_url('/'),
            ),
            array(
                'label' => function_exists('aynix_translate') ? aynix_translate('nav.metodo') : __('Metodo', 'aynix-share-presentation'),
                'url'   => $this->get_translated_page_url('metodo'),
            ),
            array(
                'label' => function_exists('aynix_translate') ? aynix_translate('nav.problemi') : __('Problemi', 'aynix-share-presentation'),
                'url'   => $this->get_translated_page_url('problemi'),
            ),
            array(
                'label' => function_exists('aynix_translate') ? aynix_translate('nav.soluzioni') : __('Soluzioni', 'aynix-share-presentation'),
                'url'   => $this->get_translated_page_url('soluzioni'),
            ),
            array(
                'label' => function_exists('aynix_translate') ? aynix_translate('nav.esperienza') : __('Esperienza', 'aynix-share-presentation'),
                'url'   => $this->get_translated_page_url('esperienza'),
            ),
            array(
                'label' => function_exists('aynix_translate') ? aynix_translate('nav.chi_siamo') : __('Chi Siamo', 'aynix-share-presentation'),
                'url'   => $this->get_translated_page_url('chi-siamo'),
            ),
            array(
                'label' => function_exists('aynix_translate') ? aynix_translate('nav.contattaci') : __('Contattaci', 'aynix-share-presentation'),
                'url'   => $this->get_translated_page_url('contattaci'),
            ),
        );

        $cta_label = function_exists('aynix_translate') ? aynix_translate('cta.avvia_diagnosi') : __('Avvia Diagnosi', 'aynix-share-presentation');
        $cta_url = $this->get_translated_page_url('diagnosi');

        ob_start();
        ?>
        <header class="header aynix-sp-site-header">
            <div class="header__logo">
                <?php echo $this->get_site_logo_html(); ?>
            </div>
            <nav class="header__nav">
                <ul class="nav-menu">
                    <?php foreach ($nav_items as $item) : ?>
                        <li><a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <div class="header__contact">
                <a href="<?php echo esc_url($cta_url); ?>" class="contact-button">
                    <button class="btn-primary btn-cta-header"><?php echo esc_html($cta_label); ?></button>
                </a>
            </div>
            <div class="hamburger" onclick="toggleAynixShareMenu()">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </header>

        <div id="aynix-sp-modal-menu" class="modal-menu">
            <div class="menu-content">
                <button class="menu-close" type="button" onclick="toggleAynixShareMenu()">✖</button>
                <nav>
                    <ul class="nav-menu">
                        <?php foreach ($nav_items as $item) : ?>
                            <li><a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a></li>
                        <?php endforeach; ?>
                        <li><a href="<?php echo esc_url($cta_url); ?>" class="menu-cta-link"><?php echo esc_html($cta_label); ?></a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <script>
            function toggleAynixShareMenu() {
                var modal = document.getElementById('aynix-sp-modal-menu');
                if (modal) {
                    modal.classList.toggle('active');
                }
            }
        </script>
        <?php

        return ob_get_clean();
    }

    private function get_translated_page_url($page_slug) {
        if (function_exists('aynix_get_translated_url')) {
            return aynix_get_translated_url($page_slug);
        }

        return home_url('/' . ltrim($page_slug, '/'));
    }

    /* ---------------------------------------------------------------------
     * Admin menu + assets
     * ------------------------------------------------------------------- */
    public function register_admin_menu() {
        add_menu_page(
            __('AYNIX Presentations', 'aynix-share-presentation'),
            __('Presentations', 'aynix-share-presentation'),
            'manage_options',
            'aynix-share-presentation',
            array($this, 'render_admin_page'),
            'dashicons-media-document',
            26
        );
    }

    public function admin_assets($hook) {
        if ($hook !== 'toplevel_page_aynix-share-presentation') {
            return;
        }
        wp_enqueue_style(
            'aynix-sp-admin',
            AYNIX_SP_URL . 'assets/css/admin.css',
            array(),
            AYNIX_SP_VERSION
        );
        wp_enqueue_script(
            'aynix-sp-admin',
            AYNIX_SP_URL . 'assets/js/admin.js',
            array(),
            AYNIX_SP_VERSION,
            true
        );
    }

    /* ---------------------------------------------------------------------
     * Save (upload) handler
     * ------------------------------------------------------------------- */
    public function handle_save() {
        if (!current_user_can('manage_options')) {
            wp_die(__('Permesso negato.', 'aynix-share-presentation'));
        }
        check_admin_referer('aynix_sp_save');

        $company_name = isset($_POST['company_name']) ? sanitize_text_field(wp_unslash($_POST['company_name'])) : '';
        $client_name  = isset($_POST['client_name']) ? sanitize_text_field(wp_unslash($_POST['client_name'])) : '';
        $pin          = isset($_POST['pin']) ? sanitize_text_field(wp_unslash($_POST['pin'])) : '';

        if (empty($company_name)) {
            $this->redirect_with_notice('error', __('Il nome azienda è obbligatorio.', 'aynix-share-presentation'));
        }

        if (empty($_FILES['presentation_file']['name'])) {
            $this->redirect_with_notice('error', __('Seleziona un file da caricare.', 'aynix-share-presentation'));
        }

        // Validate extension
        $file = $_FILES['presentation_file'];
        $filename = sanitize_file_name($file['name']);
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowed = array('pdf', 'pptx', 'ppt');
        if (!in_array($ext, $allowed, true)) {
            $this->redirect_with_notice('error', __('Formato non valido. Sono ammessi solo PDF, PPTX o PPT.', 'aynix-share-presentation'));
        }

        require_once ABSPATH . 'wp-admin/includes/file.php';

        $overrides = array(
            'test_form' => false,
            'mimes'     => array(
                'pdf'  => 'application/pdf',
                'ppt'  => 'application/vnd.ms-powerpoint',
                'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            ),
        );

        $moved = wp_handle_upload($file, $overrides);

        if (isset($moved['error'])) {
            $this->redirect_with_notice('error', $moved['error']);
        }

        global $wpdb;
        $token = $this->generate_token();

        $wpdb->insert(
            $this->table(),
            array(
                'token'        => $token,
                'company_name' => $company_name,
                'client_name'  => $client_name,
                'file_url'     => esc_url_raw($moved['url']),
                'file_name'    => $filename,
                'file_type'    => $ext,
                'pin'          => $pin,
                'views'        => 0,
                'created_at'   => current_time('mysql'),
            ),
            array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s')
        );

        $this->redirect_with_notice('success', __('Presentazione caricata! Link generato.', 'aynix-share-presentation'));
    }

    public function handle_delete() {
        if (!current_user_can('manage_options')) {
            wp_die(__('Permesso negato.', 'aynix-share-presentation'));
        }
        $id = isset($_GET['id']) ? absint($_GET['id']) : 0;
        check_admin_referer('aynix_sp_delete_' . $id);

        if ($id) {
            global $wpdb;
            $wpdb->delete($this->table(), array('id' => $id), array('%d'));
        }
        $this->redirect_with_notice('success', __('Link eliminato.', 'aynix-share-presentation'));
    }

    private function generate_token() {
        return substr(bin2hex(random_bytes(16)), 0, 20);
    }

    private function redirect_with_notice($type, $message) {
        $url = add_query_arg(
            array(
                'page'        => 'aynix-share-presentation',
                'aynix_notice' => $type,
                'aynix_msg'    => rawurlencode($message),
            ),
            admin_url('admin.php')
        );
        wp_safe_redirect($url);
        exit;
    }

    /* ---------------------------------------------------------------------
     * Admin page
     * ------------------------------------------------------------------- */
    public function render_admin_page() {
        global $wpdb;
        $rows = $wpdb->get_results("SELECT * FROM {$this->table()} ORDER BY created_at DESC");

        $notice = isset($_GET['aynix_notice']) ? sanitize_text_field(wp_unslash($_GET['aynix_notice'])) : '';
        $msg    = isset($_GET['aynix_msg']) ? sanitize_text_field(wp_unslash($_GET['aynix_msg'])) : '';

        include AYNIX_SP_DIR . 'templates/admin-page.php';
    }

    /* ---------------------------------------------------------------------
     * Public viewer
     * ------------------------------------------------------------------- */
    private function get_by_token($token) {
        global $wpdb;
        return $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM {$this->table()} WHERE token = %s", $token)
        );
    }

    public function maybe_render_viewer() {
        $token = get_query_var(AYNIX_SP_QUERY_VAR);
        if (empty($token)) {
            return;
        }

        $item = $this->get_by_token($token);
        if (!$item) {
            status_header(404);
            $this->render_viewer_error(__('Presentation not found.', 'aynix-share-presentation'));
            exit;
        }

        // PIN gate
        $pin_ok = true;
        $pin_error = '';
        if (!empty($item->pin)) {
            $pin_ok = false;
            if (isset($_POST['aynix_pin']) && isset($_POST['aynix_pin_nonce']) &&
                wp_verify_nonce($_POST['aynix_pin_nonce'], 'aynix_pin_' . $token)) {
                $entered = sanitize_text_field(wp_unslash($_POST['aynix_pin']));
                if (hash_equals((string) $item->pin, (string) $entered)) {
                    $pin_ok = true;
                } else {
                    $pin_error = __('Incorrect PIN. Please try again.', 'aynix-share-presentation');
                }
            }
        }

        if ($pin_ok) {
            // increment views
            global $wpdb;
            $wpdb->query(
                $wpdb->prepare("UPDATE {$this->table()} SET views = views + 1 WHERE id = %d", $item->id)
            );
        }

        include AYNIX_SP_DIR . 'templates/viewer.php';
        exit;
    }

    private function render_viewer_error($message) {
        $logo = AYNIX_SP_URL . 'assets/images/logo-aynix.png';
        include AYNIX_SP_DIR . 'templates/viewer-error.php';
    }

    /* ---------------------------------------------------------------------
     * Serve file inline (used by viewer for PDF embed / PPTX download)
     * ------------------------------------------------------------------- */
    public function maybe_serve_file() {
        if (!isset($_GET['aynix_sp_file'])) {
            return;
        }
        $token = sanitize_text_field(wp_unslash($_GET['aynix_sp_file']));
        $item = $this->get_by_token($token);
        if (!$item) {
            status_header(404);
            exit;
        }

        // Verify PIN if set
        if (!empty($item->pin)) {
            $provided = isset($_GET['pin']) ? sanitize_text_field(wp_unslash($_GET['pin'])) : '';
            if (!hash_equals((string) $item->pin, (string) $provided)) {
                status_header(403);
                exit;
            }
        }

        // Convert stored URL to a filesystem path
        $upload = wp_upload_dir();
        $path = str_replace($upload['baseurl'], $upload['basedir'], $item->file_url);
        if (!file_exists($path)) {
            status_header(404);
            exit;
        }

        $mime = $item->file_type === 'pdf'
            ? 'application/pdf'
            : ($item->file_type === 'pptx'
                ? 'application/vnd.openxmlformats-officedocument.presentationml.presentation'
                : 'application/vnd.ms-powerpoint');

        nocache_headers();
        header('Content-Type: ' . $mime);
        header('Content-Length: ' . filesize($path));
        // Allow embedding on same origin (needed for the JS renderer fetch)
        header('Access-Control-Allow-Origin: ' . home_url());
        $force_download = isset($_GET['download']) && $_GET['download'];
        // PDF inline by default, PPTX served for the renderer/fetch; force attachment on ?download=1
        if ($force_download) {
            $disposition = 'attachment';
        } else {
            $disposition = $item->file_type === 'pdf' ? 'inline' : 'attachment';
        }
        header('Content-Disposition: ' . $disposition . '; filename="' . basename($item->file_name) . '"');
        readfile($path);
        exit;
    }
}

AYNIX_Share_Presentation::get_instance();
