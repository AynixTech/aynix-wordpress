<?php
/**
 * Impostazioni tema Aynix
 */
function aynix_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');

    register_nav_menus([
        'main-menu' => __('Menu Principale', 'aynix')
    ]);
}
add_action('after_setup_theme', 'aynix_setup');

/**
 * Sistema URL tradotti - Mappatura slug per ogni lingua
 */
function aynix_get_translated_slugs() {
    return [
        'diagnosi' => [
            'it' => 'diagnosi',
            'en' => 'diagnosis',
            'es' => 'diagnostico',
            'pt' => 'diagnostico'
        ],
        'metodo' => [
            'it' => 'metodo',
            'en' => 'method',
            'es' => 'metodo',
            'pt' => 'metodo'
        ],
        'problemi' => [
            'it' => 'problemi',
            'en' => 'problems',
            'es' => 'problemas',
            'pt' => 'problemas'
        ],
        'soluzioni' => [
            'it' => 'soluzioni',
            'en' => 'solutions',
            'es' => 'soluciones',
            'pt' => 'solucoes'
        ],
        'chi-siamo' => [
            'it' => 'chi-siamo',
            'en' => 'about-us',
            'es' => 'quienes-somos',
            'pt' => 'quem-somos'
        ],
        'contattaci' => [
            'it' => 'contattaci',
            'en' => 'contact',
            'es' => 'contacto',
            'pt' => 'contato'
        ],
        'esperienza' => [
            'it' => 'esperienza',
            'en' => 'experience',
            'es' => 'experiencia',
            'pt' => 'experiencia'
        ],
        'questionario' => [
            'it' => 'questionario',
            'en' => 'questionnaire',
            'es' => 'cuestionario',
            'pt' => 'questionario'
        ],
        'safe-fleet' => [
            'it' => 'safe-fleet',
            'en' => 'safe-fleet',
            'es' => 'safe-fleet',
            'pt' => 'safe-fleet'
        ],
        'navenza' => [
            'it' => 'navenza',
            'en' => 'navenza',
            'es' => 'navenza',
            'pt' => 'navenza'
        ],
        'pinguito' => [
            'it' => 'pinguito',
            'en' => 'pinguito',
            'es' => 'pinguito',
            'pt' => 'pinguito'
        ]
    ];
}

/**
 * Ottieni URL tradotto per una pagina
 */
function aynix_get_translated_url($page_slug) {
    $lang = aynix_get_current_language();
    $slugs = aynix_get_translated_slugs();
    
    // Se la pagina non ha traduzioni, usa lo slug originale
    if (!isset($slugs[$page_slug])) {
        return home_url('/' . $page_slug);
    }
    
    // Ottieni lo slug tradotto per la lingua corrente
    $translated_slug = $slugs[$page_slug][$lang] ?? $slugs[$page_slug]['it'];
    
    return home_url('/' . $translated_slug);
}

/**
 * Aggiungi rewrite rules per URL tradotti
 */
function aynix_add_translated_rewrite_rules() {
    $slugs = aynix_get_translated_slugs();
    
    foreach ($slugs as $original_slug => $translations) {
        // Verifica che la pagina esista
        $page = get_page_by_path($original_slug);
        if (!$page) {
            continue;
        }
        
        foreach ($translations as $lang => $translated_slug) {
            // Skip se è lo slug originale italiano
            if ($lang === 'it' || $translated_slug === $original_slug) {
                continue;
            }
            
            // Aggiungi rewrite rule per ogni slug tradotto mappando al page_id
            add_rewrite_rule(
                '^' . $translated_slug . '/?$',
                'index.php?page_id=' . $page->ID,
                'top'
            );
        }
    }
}
add_action('init', 'aynix_add_translated_rewrite_rules');

/**
 * Mappa di pagine virtuali gestite via template file (senza Page nel backend)
 */
function aynix_get_virtual_page_templates() {
    return [
        'safe-fleet' => 'page-safefleet.php',
        'navenza' => 'page-navenza.php'
    ];
}

/**
 * Aggiungi rewrite rules per pagine virtuali
 */
function aynix_add_virtual_page_rewrite_rules() {
    $virtual_pages = aynix_get_virtual_page_templates();

    foreach ($virtual_pages as $slug => $template) {
        add_rewrite_rule(
            '^' . $slug . '/?$',
            'index.php?aynix_virtual_page=' . $slug,
            'top'
        );
    }
}
add_action('init', 'aynix_add_virtual_page_rewrite_rules');

/**
 * Registra query var per le pagine virtuali
 */
function aynix_register_virtual_page_query_var($vars) {
    $vars[] = 'aynix_virtual_page';
    return $vars;
}
add_filter('query_vars', 'aynix_register_virtual_page_query_var');

/**
 * Carica il template corretto per le pagine virtuali
 */
function aynix_virtual_page_template_include($template) {
    $virtual_slug = get_query_var('aynix_virtual_page');
    if (!$virtual_slug) {
        return $template;
    }

    $virtual_pages = aynix_get_virtual_page_templates();
    if (!isset($virtual_pages[$virtual_slug])) {
        return $template;
    }

    $virtual_template = locate_template($virtual_pages[$virtual_slug]);
    return $virtual_template ?: $template;
}
add_filter('template_include', 'aynix_virtual_page_template_include');

/**
 * Fallback: serve pagine virtuali anche se rewrite non aggiornate
 */
function aynix_render_virtual_page_fallback() {
    if (is_admin() || !is_404()) {
        return;
    }

    $request_uri = $_SERVER['REQUEST_URI'] ?? '';
    $request_path = trim((string) parse_url($request_uri, PHP_URL_PATH), '/');

    $site_path = trim((string) parse_url(home_url('/'), PHP_URL_PATH), '/');
    if ($site_path !== '' && strpos($request_path, $site_path . '/') === 0) {
        $request_path = substr($request_path, strlen($site_path) + 1);
    } elseif ($site_path !== '' && $request_path === $site_path) {
        $request_path = '';
    }

    $virtual_pages = aynix_get_virtual_page_templates();
    if (!isset($virtual_pages[$request_path])) {
        return;
    }

    $virtual_template = locate_template($virtual_pages[$request_path]);
    if (!$virtual_template) {
        return;
    }

    status_header(200);
    include $virtual_template;
    exit;
}
add_action('template_redirect', 'aynix_render_virtual_page_fallback', 1);

/**
 * Flush rewrite rules all'attivazione del tema
 */
function aynix_flush_rewrite_rules() {
    aynix_add_translated_rewrite_rules();
    aynix_add_virtual_page_rewrite_rules();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'aynix_flush_rewrite_rules');

/**
 * Flush una tantum quando cambiano regole rewrite del tema
 */
function aynix_maybe_flush_rewrite_rules() {
    $rewrite_version = '2026-04-01-virtual-pages-v2';
    if (get_option('aynix_rewrite_version') === $rewrite_version) {
        return;
    }

    aynix_add_translated_rewrite_rules();
    aynix_add_virtual_page_rewrite_rules();
    flush_rewrite_rules(false);
    update_option('aynix_rewrite_version', $rewrite_version);
}
add_action('init', 'aynix_maybe_flush_rewrite_rules', 20);

/**
 * Caricamento script e stili
 */
function aynix_scripts() {
    // Stili principali
    wp_enqueue_style('aynix-style', get_stylesheet_uri(), [], filemtime(get_stylesheet_directory() . '/style.css'));
    
    // Carica un solo script JS minimizzato che unisce tutti i tuoi JS
    wp_enqueue_script('aynix-scripts', get_template_directory_uri() . '/assets/js/scripts.min.js', ['jquery'], filemtime(get_template_directory() . '/assets/js/scripts.min.js'), true);
}
add_action('wp_enqueue_scripts', 'aynix_scripts');

/**
 * Caricamento jQuery da CDN
 */
function load_jquery_from_cdn() {
    if (!is_admin()) { // Non caricare su amministrazione
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', false, '3.6.0', true);
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'load_jquery_from_cdn');

/**
 * Caricamento dinamico di tutti i CSS in /assets/css/
 */
function aynix_enqueue_styles() {
    $css_dir = get_template_directory() . '/assets/css/';
    $css_files = glob($css_dir . '*.css');

    foreach ($css_files as $css_file) {
        $css_filename = basename($css_file);
        wp_enqueue_style('aynix-' . sanitize_title($css_filename), get_template_directory_uri() . '/assets/css/' . $css_filename, [], filemtime($css_file), 'all');
    }
}
add_action('wp_enqueue_scripts', 'aynix_enqueue_styles');

/**
 * Integrazione Swiper.js solo quando è necessario
 */
function enqueue_swiper_scripts() {
    // Carica Swiper solo sulla pagina Portfolio
    if (is_page('portfolio')) {
        wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], '11');
        wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', ['jquery'], '11', true);
        wp_enqueue_script(
            'aynix-swiper',
            get_template_directory_uri() . '/assets/js/aynix-swiper.js',
            ['jquery', 'swiper-js'],
            filemtime(get_template_directory() . '/assets/js/aynix-swiper.js'),
            true
        );
    }

    // Carica background-effect solo sulla homepage
    if (is_front_page()) {
        wp_enqueue_script(
            'background-effect',
            get_template_directory_uri() . '/assets/js/background-effect.js',
            [],
            filemtime(get_template_directory() . '/assets/js/background-effect.js'),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_swiper_scripts');

/**
 * Traduzioni tramite file JSON
 */
function aynix_get_current_language() {
    return $_COOKIE['site_lang'] ?? 'it';
}

function aynix_load_translation() {
    $lang = aynix_get_current_language();
    $lang_file = get_template_directory() . "/languages/$lang.json";

    return file_exists($lang_file) ? json_decode(file_get_contents($lang_file), true) : [];
}

function aynix_translate($key) {
    static $translations;
    if (!$translations) {
        $translations = aynix_load_translation();
    }
    return $translations[$key] ?? $key;
}

function custom_login_logo() { ?>
    <style type="text/css">
        #login h1 a {
            background-image: url('https://www.aynix.tech/wp-content/uploads/2025/03/logo_aynix_letter.png');
            background-size: contain;
            width: 100%;
            height: 84px; /* Regola l'altezza del logo */
        }
    </style>
<?php }
add_action('login_head', 'custom_login_logo');

/**
 * Caricamento font (Font Awesome)
 */
function aynix_enqueue_fonts() {
    // Caricamento di Font Awesome (Free)
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', [], '6.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'aynix_enqueue_fonts');

/**
 * Template email HTML con branding AYNIX
 */
function aynix_email_template($content, $title = '', $subtitle = '', $lang = 'it') {
    $logo_blue_url    = get_template_directory_uri() . '/assets/images/email/logo-blue.png';
    $logo_colored_url = get_template_directory_uri() . '/assets/images/email/logo-colored.png';
    $site_url         = home_url('/');
    $linkedin_url     = 'https://www.linkedin.com/company/aynix';

    $footer_strings = array(
        'it' => array(
            'desc'   => 'Aynix sviluppa piattaforme AI, sistemi di automazione e software personalizzato per aiutare le aziende a crescere con la tecnologia intelligente.',
            'legal'  => 'Hai ricevuto questa email perché hai richiesto informazioni o sei nella nostra lista contatti.',
            'rights' => 'Tutti i diritti riservati.',
        ),
        'en' => array(
            'desc'   => 'Aynix develops AI platforms, automation systems and custom software designed to help companies grow with intelligent technology.',
            'legal'  => 'You received this email because you requested information or are on our contact list.',
            'rights' => 'All rights reserved.',
        ),
        'es' => array(
            'desc'   => 'Aynix desarrolla plataformas de IA, sistemas de automatización y software personalizado para ayudar a las empresas a crecer con tecnología inteligente.',
            'legal'  => 'Este correo electrónico fue enviado a usted porque solicitó información o está en nuestra lista de contactos.',
            'rights' => 'Todos los derechos reservados.',
        ),
        'pt' => array(
            'desc'   => 'Aynix desenvolve plataformas de IA, sistemas de automação e software personalizado para ajudar as empresas a crescer com tecnologia inteligente.',
            'legal'  => 'Recebeu este e-mail porque solicitou informações ou está na nossa lista de contactos.',
            'rights' => 'Todos os direitos reservados.',
        ),
    );
    $fs = $footer_strings[$lang] ?? $footer_strings['it'];

    $subtitle_row = !empty($subtitle)
        ? '<p style="margin:8px 0 0;font-size:15px;color:#6b7280;line-height:1.5;font-family:Arial,Helvetica,sans-serif;">' . esc_html($subtitle) . '</p>'
        : '';

    $html = '<!DOCTYPE html><html lang="' . esc_attr($lang) . '"><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>' . esc_html($title) . '</title>
<style>
body{margin:0;padding:0;background-color:#eef2f8;font-family:Arial,Helvetica,sans-serif;}
h1{margin:0 0 16px;font-size:20px;font-weight:700;color:#0e1f3d;line-height:1.3;}
h2{margin:24px 0 10px;font-size:17px;font-weight:700;color:#0e1f3d;}
p{margin:0 0 16px;font-size:15px;color:#374151;line-height:1.6;}
ul{margin:8px 0 16px;padding-left:20px;}
li{font-size:15px;color:#374151;line-height:1.6;margin-bottom:6px;}
a{color:#438ef9;text-decoration:none;}
.info-box{background:#f8fafc;border-radius:8px;padding:18px 20px;margin:16px 0;}
.info-box p{margin:0 0 8px;}
.info-box p:last-child{margin:0;}
.cta-button{display:inline-block;background:#f05c2a;color:#ffffff !important;text-decoration:none;padding:16px 40px;border-radius:50px;font-size:16px;font-weight:700;}
</style>
</head><body>
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#eef2f8;">
<tr><td align="center" style="padding:24px 16px;">
<table width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;">

  <!-- HEADER -->
  <tr>
    <td style="background:#ffffff;padding:16px 28px;border-radius:10px 10px 0 0;">
      <table width="100%" cellpadding="0" cellspacing="0" border="0"><tr>
        <td style="vertical-align:middle;">
          <img src="' . esc_url($logo_blue_url) . '" alt="AYNIX" height="26" style="display:block;height:26px;width:auto;">
        </td>
        <td align="right" style="vertical-align:middle;font-size:9px;letter-spacing:1.5px;color:#9ca3af;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;">AI &bull; AUTOMATION &bull; SOFTWARE ARCHITECTURE</td>
      </tr></table>
    </td>
  </tr>
  <tr><td style="background-color:#dde3ed;height:1px;font-size:1px;line-height:1px;">&nbsp;</td></tr>

  <!-- HERO TITLE -->
  <tr>
    <td style="background-color:#eef2f8;padding:44px 32px 36px;text-align:center;">
      <p style="margin:0;font-size:28px;font-weight:800;color:#0e1f3d;line-height:1.2;font-family:Arial,Helvetica,sans-serif;">' . esc_html($title) . '</p>
      ' . $subtitle_row . '
    </td>
  </tr>

  <!-- CONTENT CARD -->
  <tr>
    <td style="background-color:#eef2f8;padding:0 16px 24px;">
      <table width="100%" cellpadding="0" cellspacing="0" border="0"><tr>
        <td style="background:#ffffff;border-radius:12px;padding:32px;font-family:Arial,Helvetica,sans-serif;">
          ' . $content . '
        </td>
      </tr></table>
    </td>
  </tr>

  <!-- SERVICES -->
  <tr>
    <td style="background-color:#eef2f8;padding:0 16px 24px;">
      <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f5f8fc;border-radius:8px;">
        <tr>
          <td align="center" style="padding:20px 4px 16px;vertical-align:top;width:25%;">
            <div style="width:44px;height:44px;border-radius:50%;background:#e8eef8;margin:0 auto 10px;line-height:44px;text-align:center;font-size:20px;">&#9881;&#65039;</div>
            <div style="font-size:12px;font-weight:700;color:#374151;line-height:1.4;font-family:Arial,Helvetica,sans-serif;">Automation<br>Systems</div>
          </td>
          <td align="center" style="padding:20px 4px 16px;vertical-align:top;width:25%;">
            <div style="width:44px;height:44px;border-radius:50%;background:#e8eef8;margin:0 auto 10px;line-height:44px;text-align:center;font-size:20px;">&#129302;</div>
            <div style="font-size:12px;font-weight:700;color:#374151;line-height:1.4;font-family:Arial,Helvetica,sans-serif;">AI<br>Integration</div>
          </td>
          <td align="center" style="padding:20px 4px 16px;vertical-align:top;width:25%;">
            <div style="width:44px;height:44px;border-radius:50%;background:#e8eef8;margin:0 auto 10px;line-height:44px;text-align:center;font-size:15px;font-weight:800;color:#438ef9;font-family:Arial,Helvetica,sans-serif;">&lt;/&gt;</div>
            <div style="font-size:12px;font-weight:700;color:#374151;line-height:1.4;font-family:Arial,Helvetica,sans-serif;">Custom<br>Software</div>
          </td>
          <td align="center" style="padding:20px 4px 16px;vertical-align:top;width:25%;">
            <div style="width:44px;height:44px;border-radius:50%;background:#e8eef8;margin:0 auto 10px;line-height:44px;text-align:center;font-size:20px;">&#128200;</div>
            <div style="font-size:12px;font-weight:700;color:#374151;line-height:1.4;font-family:Arial,Helvetica,sans-serif;">Business Process<br>Optimization</div>
          </td>
        </tr>
      </table>
    </td>
  </tr>

  <!-- FOOTER -->
  <tr>
    <td style="background:#ffffff;padding:20px 28px 16px;">
      <table width="100%" cellpadding="0" cellspacing="0" border="0"><tr>
        <td style="border-top:1px solid #e8edf5;padding-top:20px;vertical-align:top;padding-right:20px;width:55%;">
          <img src="' . esc_url($logo_colored_url) . '" alt="AYNIX" height="24" style="display:block;height:24px;width:auto;margin-bottom:10px;">
          <p style="margin:0;font-size:12px;color:#6b7280;line-height:1.5;font-family:Arial,Helvetica,sans-serif;">' . esc_html($fs['desc']) . '</p>
        </td>
        <td style="border-top:1px solid #e8edf5;padding-top:20px;vertical-align:top;text-align:right;white-space:nowrap;">
          <p style="margin:0 0 6px;font-family:Arial,Helvetica,sans-serif;"><a href="' . esc_url($site_url) . '" style="color:#438ef9;text-decoration:none;font-size:13px;font-weight:600;">Website</a></p>
          <p style="margin:0 0 6px;font-family:Arial,Helvetica,sans-serif;"><a href="mailto:info@aynix.tech" style="color:#438ef9;text-decoration:none;font-size:13px;font-weight:600;">Email</a></p>
          <p style="margin:0;font-family:Arial,Helvetica,sans-serif;"><a href="' . esc_url($linkedin_url) . '" style="color:#438ef9;text-decoration:none;font-size:13px;font-weight:600;">LinkedIn</a></p>
        </td>
      </tr></table>
    </td>
  </tr>

  <!-- LEGAL -->
  <tr>
    <td style="background:#f5f8fc;padding:14px 28px;border-top:1px solid #dde3ed;border-radius:0 0 10px 10px;">
      <p style="margin:0 0 4px;font-size:11px;color:#9ca3af;line-height:1.5;font-family:Arial,Helvetica,sans-serif;">' . esc_html($fs['legal']) . '</p>
      <p style="margin:0;font-size:11px;color:#9ca3af;font-family:Arial,Helvetica,sans-serif;">&copy; 2026 Aynix Consulting. ' . esc_html($fs['rights']) . '</p>
    </td>
  </tr>

</table>
</td></tr>
</table></body></html>';

    return $html;
}

/**
 * AJAX Handler per salvataggio diagnosi e generazione proposta AI
 */
function save_diagnosis_submission() {
    $form_data = isset($_POST['formData']) ? $_POST['formData'] : array();
    $timestamp = isset($_POST['timestamp']) ? sanitize_text_field($_POST['timestamp']) : current_time('mysql');
    $user_email = isset($form_data['email']) ? sanitize_email($form_data['email']) : '';
    $user_lang = isset($_POST['user_lang']) ? sanitize_text_field($_POST['user_lang']) : 'it';
    
    // Valida idioma
    if (!in_array($user_lang, array('it', 'en', 'es', 'pt'))) {
        $user_lang = 'it';
    }
    
    if (empty($user_email)) {
        wp_send_json_error(array('message' => 'Email richiesta'));
        return;
    }
    
    // Salva i dati in custom post type
    $diagnosis_data = array(
        'post_title'    => 'Progetto Software - ' . $user_email . ' - ' . $timestamp,
        'post_content'  => json_encode($form_data),
        'post_status'   => 'private',
        'post_type'     => 'diagnosis',
        'post_author'   => 1,
    );
    
    $post_id = wp_insert_post($diagnosis_data);
    
    if (!$post_id) {
        wp_send_json_error(array('message' => 'Errore nel salvataggio'));
        return;
    }
    
    // Salva metadati incluso idioma
    update_post_meta($post_id, 'user_lang', $user_lang);
    
    foreach ($form_data as $key => $value) {
        if (is_array($value)) {
            update_post_meta($post_id, $key, json_encode($value));
        } else {
            update_post_meta($post_id, $key, sanitize_text_field($value));
        }
    }
    
    // PRIMA EMAIL: Invia SEMPRE email di conferma immediata (prima della risposta)
    send_confirmation_email($user_email, $user_lang, $post_id);
    
    // Schedula elaborazione AI e seconda email in background
    wp_schedule_single_event(time() + 10, 'process_diagnosis_ai', array($post_id, $user_email, $form_data, $user_lang));
    
    // RISPOSTA IMMEDIATA all'utente
    wp_send_json_success(array(
        'post_id' => $post_id,
        'message' => 'Questionario ricevuto con successo'
    ));
}

/**
 * Genera proposta software personalizzata usando OpenAI
 */
function generate_ai_proposal($form_data, $user_lang = 'it') {
    if (!defined('OPENAI_API_KEY')) {
        error_log('OpenAI API Key non configurata');
        return false;
    }
    
    // Mappa delle domande del questionario per contesto completo
    $question_labels = array(
        'it' => array(
            'tipo_progetto' => 'Che tipo di soluzione stai cercando?',
            'obiettivo_principale' => 'Qual è l\'obiettivo principale del progetto?',
            'funzionalita' => 'Quali funzionalità principali ti servono?',
            'utenti_target' => 'Chi userà principalmente questa soluzione?',
            'numero_utenti' => 'Quanti utenti prevedi?',
            'stato_progetto' => 'A che punto sei con il progetto?',
            'complessita' => 'Complessità percepita del progetto',
            'tempistiche' => 'In quanto tempo vorresti lanciare?',
            'budget' => 'Qual è il tuo budget indicativo?',
            'dettagli_extra' => 'Descrizione dettagliata del progetto'
        ),
        'en' => array(
            'tipo_progetto' => 'What type of solution are you looking for?',
            'obiettivo_principale' => 'What is the main goal of the project?',
            'funzionalita' => 'Which main features do you need?',
            'utenti_target' => 'Who will primarily use this solution?',
            'numero_utenti' => 'How many users do you expect?',
            'stato_progetto' => 'What stage is your project at?',
            'complessita' => 'Perceived project complexity',
            'tempistiche' => 'When would you like to launch?',
            'budget' => 'What is your indicative budget?',
            'dettagli_extra' => 'Detailed project description'
        ),
        'es' => array(
            'tipo_progetto' => '¿Qué tipo de solución buscas?',
            'obiettivo_principale' => '¿Cuál es el objetivo principal del proyecto?',
            'funzionalita' => '¿Qué funcionalidades principales necesitas?',
            'utenti_target' => '¿Quién usará principalmente esta solución?',
            'numero_utenti' => '¿Cuántos usuarios esperas?',
            'stato_progetto' => '¿En qué etapa está tu proyecto?',
            'complessita' => 'Complejidad percibida del proyecto',
            'tempistiche' => '¿Cuándo te gustaría lanzar?',
            'budget' => '¿Cuál es tu presupuesto indicativo?',
            'dettagli_extra' => 'Descripción detallada del proyecto'
        ),
        'pt' => array(
            'tipo_progetto' => 'Que tipo de solução procuras?',
            'obiettivo_principale' => 'Qual é o objetivo principal do projeto?',
            'funzionalita' => 'Que funcionalidades principais precisas?',
            'utenti_target' => 'Quem irá usar principalmente esta solução?',
            'numero_utenti' => 'Quantos utilizadores esperas?',
            'stato_progetto' => 'Em que fase está o teu projeto?',
            'complessita' => 'Complexidade percebida do projeto',
            'tempistiche' => 'Quando gostarias de lançar?',
            'budget' => 'Qual é o teu orçamento indicativo?',
            'dettagli_extra' => 'Descrição detalhada do projeto'
        )
    );
    
    // Traduzioni per il prompt
    $lang_instructions = array(
        'it' => array(
            'language' => 'ITALIANO',
            'role' => 'Agisci come un **Solution Architect senior** in un\'azienda B2B specializzata in software custom.',
            'context' => 'AYNIX sviluppa soluzioni software su misura con focus su: Architettura scalabile, Integrazione API, Sistemi cloud-ready, Automazione operativa, Piattaforme digitali complesse B2B/B2C. Posizionamento tecnico premium.',
            'restrictions' => 'NON devi: fare una proposta formale, parlare di prezzi, promettere risultati, sembrare un\'agenzia digitale. Il tono deve essere **consultivo, tecnico e enterprise-level**.',
            'analyze' => 'Analizza queste risposte del questionario diagnostico:',
            'structure' => 'Scrivi una risposta in ITALIANO seguendo ESATTAMENTE questa struttura:'
        ),
        'en' => array(
            'language' => 'ENGLISH',
            'role' => 'Act as a **senior Solution Architect** in a B2B company specialized in custom software.',
            'context' => 'AYNIX develops custom software solutions focused on: Scalable architecture, API integration, Cloud-ready systems, Operational automation, Complex B2B/B2C digital platforms. Premium technical positioning.',
            'restrictions' => 'You must NOT: make a formal proposal, talk about prices, promise results, sound like a digital agency. The tone must be **consultative, technical and enterprise-level**.',
            'analyze' => 'Analyze these diagnostic questionnaire responses:',
            'structure' => 'Write a response in ENGLISH following EXACTLY this structure:'
        ),
        'es' => array(
            'language' => 'ESPAÑOL',
            'role' => 'Actúa como un **Solution Architect senior** en una empresa B2B especializada en software custom.',
            'context' => 'AYNIX desarrolla soluciones software a medida con enfoque en: Arquitectura escalable, Integración API, Sistemas cloud-ready, Automatización operativa, Plataformas digitales complejas B2B/B2C. Posicionamiento técnico premium.',
            'restrictions' => 'NO debes: hacer una propuesta formal, hablar de precios, prometer resultados, sonar como agencia digital. El tono debe ser **consultivo, técnico y enterprise-level**.',
            'analyze' => 'Analiza estas respuestas del cuestionario diagnóstico:',
            'structure' => 'Escribe una respuesta en ESPAÑOL siguiendo EXACTAMENTE esta estructura:'
        ),
        'pt' => array(
            'language' => 'PORTUGUÊS',
            'role' => 'Age como um **Solution Architect senior** numa empresa B2B especializada em software custom.',
            'context' => 'AYNIX desenvolve soluções software à medida com foco em: Arquitetura escalável, Integração API, Sistemas cloud-ready, Automação operativa, Plataformas digitais complexas B2B/B2C. Posicionamento técnico premium.',
            'restrictions' => 'NÃO deves: fazer uma proposta formal, falar de preços, prometer resultados, parecer uma agência digital. O tom deve ser **consultivo, técnico e enterprise-level**.',
            'analyze' => 'Analisa estas respostas do questionário diagnóstico:',
            'structure' => 'Escreve uma resposta em PORTUGUÊS seguindo EXATAMENTE esta estrutura:'
        )
    );
    
    $lang = isset($lang_instructions[$user_lang]) ? $lang_instructions[$user_lang] : $lang_instructions['it'];
    $labels = isset($question_labels[$user_lang]) ? $question_labels[$user_lang] : $question_labels['it'];
    
    // Costruisci prompt per OpenAI con nuovo approccio enterprise
    $prompt = $lang['role'] . "\n\n";
    $prompt .= "## CONTESTO AYNIX\n" . $lang['context'] . "\n\n";
    $prompt .= "## RESTRIZIONI\n" . $lang['restrictions'] . "\n\n";
    $prompt .= "## VARIABILI DEL LEAD\n" . $lang['analyze'] . "\n\n";
    
    // Ordine preferenziale delle domande per dare contesto migliore all'AI
    $question_order = ['tipo_progetto', 'obiettivo_principale', 'dettagli_extra', 'funzionalita', 'stato_progetto', 'complessita', 'utenti_target', 'numero_utenti', 'tempistiche', 'budget'];
    
    foreach ($question_order as $key) {
        if (isset($form_data[$key]) && !empty($form_data[$key]) && $key !== 'email') {
            $question_text = isset($labels[$key]) ? $labels[$key] : ucfirst(str_replace('_', ' ', $key));
            $value = $form_data[$key];
            
            if (is_array($value)) {
                $prompt .= "**{$question_text}**\n→ " . implode(', ', $value) . "\n\n";
            } else {
                $prompt .= "**{$question_text}**\n→ {$value}\n\n";
            }
        }
    }
    
    // Aggiungi eventuali campi extra non nell'ordine predefinito
    foreach ($form_data as $key => $value) {
        if (!in_array($key, $question_order) && $key !== 'email' && !empty($value)) {
            $question_text = isset($labels[$key]) ? $labels[$key] : ucfirst(str_replace('_', ' ', $key));
            if (is_array($value)) {
                $prompt .= "**{$question_text}**\n→ " . implode(', ', $value) . "\n\n";
            } else {
                $prompt .= "**{$question_text}**\n→ {$value}\n\n";
            }
        }
    }
    
    $prompt .= "\n## " . $lang['structure'] . "\n\n";
    $prompt .= "STRUTTURA OBBLIGATORIA (NON MODIFICARE):\n\n";
    $prompt .= "[Paragrafo introduttivo tecnico dove interpreti la natura del progetto, la sua complessità strutturale e la scala prevista. 2-3 righe.]\n\n";
    $prompt .= "________________________________________\n\n";
    $prompt .= "🔎 Lettura tecnico-strategica\n\n";
    $prompt .= "Un progetto di questo tipo richiede generalmente di definire con chiarezza:\n\n";
    $prompt .= "[Elenca 4-6 aree architetturali chiave in punti numerati. Ogni punto max 1 riga. Usa terminologia enterprise: governance, throughput, orchestrazione, layer applicativo, modello dati, scalabilità infrastrutturale, integrazione API, sicurezza perimetrale, etc.]\n\n";
    $prompt .= "[Chiudi con: \"L'elemento critico non è solo 'sviluppare [tipo soluzione]', ma progettare un'architettura coerente con: modello di business, [elementi rilevanti], carico previsto, roadmap futura\"]\n\n";
    $prompt .= "________________________________________\n\n";
    $prompt .= "⚠️ Punto sensibile\n\n";
    $prompt .= "[Descrivi in 2-3 righe il rischio strutturale principale in fase di \"idea iniziale\": costruire tecnologia prima di validare flussi reali, dipendenze tecniche, modello di scalabilità, integrazione con provider esterni, etc. Tono: consulenziale, non allarmista.]\n\n";
    $prompt .= "________________________________________\n\n";
    $prompt .= "## ISTRUZIONI DI INTERPRETAZIONE:\n\n";
    $prompt .= "1. Valuta il livello REALE di complessità tecnica (non solo quella dichiarata)\n";
    $prompt .= "2. Aggruppa le funzionalità in macro-domini architetturali\n";
    $prompt .= "3. Identifica rischi strutturali impliciti\n";
    $prompt .= "4. Se NUMERO_UTENTI > 1000 o COMPLESSITÀ = alta → aumenta focus su scalabilità\n";
    $prompt .= "5. Se FASE_PROGETTO = 'idea iniziale' → enfatizza validazione architetturale\n";
    $prompt .= "6. Se BUDGET = 'da definire' → enfatizza fase di discovery\n\n";
    $prompt .= "## REQUISITI OBBLIGATORI:\n\n";
    $prompt .= "- Linguaggio enterprise-level\n";
    $prompt .= "- Terminologia architettonica (layer, orchestrazione, governance, throughput)\n";
    $prompt .= "- Includi KPI impliciti (scalabilità, efficienza operativa, time-to-market)\n";
    $prompt .= "- MANTIENI i separatori visuali (________________________________________)\n";
    $prompt .= "- MANTIENI le emoji esatte (🔎 ⚠️)\n";
    $prompt .= "- NON menzionare tecnologie specifiche (no React, Node.js, AWS, etc.)\n";
    $prompt .= "- NON fare proposta formale\n";
    $prompt .= "- NON parlare di prezzi o promettere risultati\n";
    $prompt .= "- Scrivi TUTTO in " . $lang['language'] . "\n";
    $prompt .= "- Se il cliente ha menzionato funzionalità specifiche (API, pagamenti, dashboard, marketplace, etc.), CITALE nel paragrafo introduttivo\n";
    $prompt .= "- Tono: consultivo, tecnico, solution-oriented\n";
    $prompt .= "- Lunghezza: 300-400 parole massimo\n";
    
    // Chiamata API OpenAI
    $api_key = defined('OPENAI_API_KEY') ? OPENAI_API_KEY : '';
    
    // Verifica che l'API key sia configurata
    if (empty($api_key)) {
        error_log('OPENAI_API_KEY non configurata in wp-config.php');
        return false;
    }
    
    $response = wp_remote_post('https://api.openai.com/v1/chat/completions', array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type' => 'application/json',
        ),
        'body' => json_encode(array(
            'model' => 'gpt-4',
            'messages' => array(
                array(
                    'role' => 'system',
                    'content' => 'Sei un consulente strategico di AYNIX specializzato nell\'analisi di problemi legati a software e processi digitali.

COMPITO PRINCIPALE: Restituire comprensione profonda di ciò che il cliente vuole costruire/risolvere, dimostrando che hai letto attentamente la sua descrizione.

OBBLIGHI ASSOLUTI:
1. Leggi TUTTO il campo "Descrizione dettagliata del progetto" (dettagli_extra)
2. Se il cliente ha menzionato un prodotto/servizio specifico (es: "piattaforma eSIM", "marketplace per rivenditori", "sistema di booking"), DEVI riportarlo ESPLICITAMENTE nella tua risposta
3. Se ha elencato funzionalità (pagamenti online, API, dashboard, reportistica, checkout), DEVI citarle per dimostrare comprensione
4. La sezione "Situazione Attuale" deve iniziare riassumendo ciò che il cliente vuole (es: "Vuoi costruire una piattaforma marketplace per eSIM con...")

COSA PUOI MENZIONARE:
✅ Prodotti/servizi descritti dal cliente (marketplace, piattaforma booking, app mobile, ecc)
✅ Funzionalità richieste (pagamenti, API esterne, reportistica, gestione utenti, dashboard)
✅ Processi operativi (automazione vendite, gestione ordini, coordinamento team)
✅ Outcome desiderati (scalabilità, efficienza, controllo, visibilità)

COSA NON DEVI MAI MENZIONARE:
❌ Tecnologie specifiche (React, Node.js, Python, MySQL, AWS, Docker, Kubernetes)
❌ "La soluzione AYNIX" o "come risolveremo noi"
❌ Prezzi, costi, tempistiche specifiche
❌ Dettagli implementativi o architetturali

TONO: Consulenziale, empatico, tecnico ma accessibile. Dimostra che hai capito il progetto del cliente citando esplicitamente ciò che ha scritto.'
                ),
                array(
                    'role' => 'user',
                    'content' => $prompt
                )
            ),
            'temperature' => 0.7,
            'max_tokens' => 2500
        )),
        'timeout' => 60,
    ));
    
    if (is_wp_error($response)) {
        error_log('Errore OpenAI API: ' . $response->get_error_message());
        return false;
    }
    
    $body = json_decode(wp_remote_retrieve_body($response), true);
    
    // Log della risposta completa per debug
    error_log('OpenAI Response Status: ' . wp_remote_retrieve_response_code($response));
    error_log('OpenAI Response Body: ' . wp_remote_retrieve_body($response));
    
    if (isset($body['choices'][0]['message']['content'])) {
        return $body['choices'][0]['message']['content'];
    }
    
    // Log errore con dettagli
    if (isset($body['error'])) {
        error_log('Errore OpenAI API: ' . $body['error']['message']);
    } else {
        error_log('Risposta OpenAI non valida: ' . print_r($body, true));
    }
    
    return false;
}

/**
 * Invia email con proposta AI al cliente (SECONDA EMAIL - dopo analisi)
 */
function send_proposal_email($to_email, $proposal, $form_data, $lang = 'it', $post_id = null) {
    error_log("AYNIX DEBUG: send_proposal_email chiamata - email={$to_email}, lang={$lang}, post_id={$post_id}");
    // Genera ID univoco per evitare thread email
    $email_id = $post_id ? 'PROP-' . $post_id : 'PROP-' . time();
    
    $translations = array(
        'it' => array(
            'subject' => 'La tua Analisi AYNIX [#' . $email_id . ']',
            'greeting' => 'Ciao,',
            'intro' => '',
            'section1_title' => '',
            'section1_text' => '',
            'section2_title' => '',
            'section2_intro' => '',
            'section2_point1_title' => '',
            'section2_point1_text' => '',
            'section2_point2_title' => '',
            'section2_point2_text' => '',
            'section2_point3_title' => '',
            'section2_point3_text' => '',
            'section2_objective' => '',
            'section3_title' => '',
            'section3_text' => '',
            'section4_title' => '',
            'section4_text' => '',
            'section5_title' => '👉 Prossimo passo sensato',
            'section5_text' => 'Prima di qualsiasi proposta formale, ha senso fare una call breve e tecnica per:<br><br>• validare il modello di integrazione e architettura<br>• comprendere il flusso end-to-end<br>• stimare livello reale di complessità<br><br>Solo dopo questa fase ha senso trasformare tutto in una proposta strutturata.',
            'cta_button' => '👉 Richiedi di essere contattato',
            'closing' => 'Un saluto,',
            'team' => 'Team AYNIX',
            'email_title' => 'La tua Analisi AYNIX'
        ),
        'en' => array(
            'subject' => 'Your AYNIX Analysis [#' . $email_id . ']',
            'greeting' => 'Hello,',
            'intro' => '',
            'section1_title' => '',
            'section1_text' => '',
            'section2_title' => '',
            'section2_intro' => '',
            'section2_point1_title' => '',
            'section2_point1_text' => '',
            'section2_point2_title' => '',
            'section2_point2_text' => '',
            'section2_point3_title' => '',
            'section2_point3_text' => '',
            'section2_objective' => '',
            'section3_title' => '',
            'section3_text' => '',
            'section4_title' => '',
            'section4_text' => '',
            'section5_title' => '👉 Sensible next step',
            'section5_text' => 'Before any formal proposal, it makes sense to have a brief technical call to:<br><br>• validate the integration model and architecture<br>• understand the end-to-end flow<br>• estimate the real level of complexity<br><br>Only after this phase does it make sense to turn everything into a structured proposal.',
            'cta_button' => '👉 Request to be contacted',
            'closing' => 'Best regards,',
            'team' => 'AYNIX Team',
            'email_title' => 'Your AYNIX Analysis'
        ),
        'es' => array(
            'subject' => 'Tu Análisis AYNIX [#' . $email_id . ']',
            'greeting' => 'Hola,',
            'intro' => '',
            'section1_title' => '',
            'section1_text' => '',
            'section2_title' => '',
            'section2_intro' => '',
            'section2_point1_title' => '',
            'section2_point1_text' => '',
            'section2_point2_title' => '',
            'section2_point2_text' => '',
            'section2_point3_title' => '',
            'section2_point3_text' => '',
            'section2_objective' => '',
            'section3_title' => '',
            'section3_text' => '',
            'section4_title' => '',
            'section4_text' => '',
            'section5_title' => '👉 Próximo paso sensato',
            'section5_text' => 'Antes de cualquier propuesta formal, tiene sentido hacer una llamada breve y técnica para:<br><br>• validar el modelo de integración y arquitectura<br>• comprender el flujo end-to-end<br>• estimar el nivel real de complejidad<br><br>Solo después de esta fase tiene sentido transformar todo en una propuesta estructurada.',
            'cta_button' => '👉 Solicitar ser contactado',
            'closing' => 'Un saludo,',
            'team' => 'Equipo AYNIX',
            'email_title' => 'Tu Análisis AYNIX'
        ),
        'pt' => array(
            'subject' => 'A sua Análise AYNIX [#' . $email_id . ']',
            'greeting' => 'Olá,',
            'intro' => '',
            'section1_title' => '',
            'section1_text' => '',
            'section2_title' => '',
            'section2_intro' => '',
            'section2_point1_title' => '',
            'section2_point1_text' => '',
            'section2_point2_title' => '',
            'section2_point2_text' => '',
            'section2_point3_title' => '',
            'section2_point3_text' => '',
            'section2_objective' => '',
            'section3_title' => '',
            'section3_text' => '',
            'section4_title' => '',
            'section4_text' => '',
            'section5_title' => '👉 Próximo passo sensato',
            'section5_text' => 'Antes de qualquer proposta formal, faz sentido fazer uma chamada breve e técnica para:<br><br>• validar o modelo de integração e arquitetura<br>• compreender o fluxo end-to-end<br>• estimar o nível real de complexidade<br><br>Só após esta fase faz sentido transformar tudo numa proposta estruturada.',
            'cta_button' => '👉 Solicitar ser contactado',
            'closing' => 'Cumprimentos,',
            'team' => 'Equipa AYNIX',
            'email_title' => 'A sua Análise AYNIX'
        )
    );
    
    $t = $translations[$lang];
    
    // Genera parametro email per pre-compilare il form
    $email_param = urlencode($to_email);
    
    // Formatta il contenuto AI con le sezioni standard
    $ai_content = nl2br(esc_html($proposal));
    
    $content = '
        <p>' . $t['greeting'] . '</p>
        
        <div style="margin: 20px 0; line-height: 1.6;">
            ' . $ai_content . '
        </div>
        
        <h2 style="margin-top: 30px; margin-bottom: 15px; font-size: 18px; font-weight: bold;">' . $t['section5_title'] . '</h2>
        <p>' . $t['section5_text'] . '</p>
        
        <p style="text-align: center; margin: 30px 0;">
            <a href="https://aynix.tech/richiesta-contatto?email=' . $email_param . '" class="cta-button" style="font-size: 18px; padding: 18px 40px;">' . $t['cta_button'] . '</a>
        </p>
        
        <p>' . $t['closing'] . '</p>
        <p><strong>' . $t['team'] . '</strong></p>
    ';
    
    $html_message = aynix_email_template($content, $t['email_title'], '', $lang);
    
    $headers = array(
        'From: AYNIX <info@aynix.tech>',
        'Reply-To: info@aynix.tech',
        'Content-Type: text/html; charset=UTF-8'
    );
    
    $result = wp_mail($to_email, $t['subject'], $html_message, $headers);
    error_log("AYNIX DEBUG: send_confirmation_email risultato: " . ($result ? 'SUCCESS' : 'FAILED'));
    return $result;
}

/**
 * Invia email immediata di conferma ricezione questionario (PRIMA EMAIL)
 */
function send_confirmation_email($to_email, $lang = 'it', $post_id = null) {
    error_log("AYNIX DEBUG: send_confirmation_email chiamata - email={$to_email}, lang={$lang}, post_id={$post_id}");
    // Genera ID univoco per evitare thread email
    $email_id = $post_id ? 'CONF-' . $post_id : 'CONF-' . time();
    
    $translations = array(
        'it' => array(
            'subject' => 'Grazie per aver compilato il questionario - AYNIX [#' . $email_id . ']',
            'title' => '✅ Questionario Ricevuto',
            'thanks' => 'Grazie per aver completato il nostro questionario!',
            'received' => 'Abbiamo ricevuto le tue informazioni e le stiamo analizzando.',
            'what_next' => '📋 Cosa succede ora?',
            'step1' => 'Analizziamo le tue esigenze',
            'step2' => 'Valutiamo se e come possiamo aiutarti',
            'step3' => 'Ti ricontattiamo solo se c\'è valore reale',
            'time_label' => 'Tempo stimato:',
            'time_value' => 'massimo 24 ore',
            'note_label' => 'Nota importante:',
            'note_text' => 'Non riceverai proposte commerciali automatiche. Ti contatteremo solo se riteniamo di poter davvero aiutarti.',
            'closing' => 'A presto!',
            'team' => 'Il Team AYNIX',
            'email_title' => 'Questionario Ricevuto'
        ),
        'en' => array(
            'subject' => 'Thank you for completing the questionnaire - AYNIX [#' . $email_id . ']',
            'title' => '✅ Questionnaire Received',
            'thanks' => 'Thank you for completing our questionnaire!',
            'received' => 'We have received your information and are analyzing it.',
            'what_next' => '📋 What happens now?',
            'step1' => 'We analyze your needs',
            'step2' => 'We evaluate if and how we can help you',
            'step3' => 'We contact you only if there is real value',
            'time_label' => 'Estimated time:',
            'time_value' => 'max 24 hours',
            'note_label' => 'Important note:',
            'note_text' => 'You will not receive automatic sales proposals. We will contact you only if we believe we can really help you.',
            'closing' => 'See you soon!',
            'team' => 'The AYNIX Team',
            'email_title' => 'Questionnaire Received'
        ),
        'es' => array(
            'subject' => 'Gracias por completar el cuestionario - AYNIX [#' . $email_id . ']',
            'title' => '✅ Cuestionario Recibido',
            'thanks' => '¡Gracias por completar nuestro cuestionario!',
            'received' => 'Hemos recibido tu información y la estamos analizando.',
            'what_next' => '📋 ¿Qué pasa ahora?',
            'step1' => 'Analizamos tus necesidades',
            'step2' => 'Evaluamos si y cómo podemos ayudarte',
            'step3' => 'Te contactamos solo si hay valor real',
            'time_label' => 'Tiempo estimado:',
            'time_value' => 'máximo 24 horas',
            'note_label' => 'Nota importante:',
            'note_text' => 'No recibirás propuestas comerciales automáticas. Te contactaremos solo si creemos que podemos ayudarte realmente.',
            'closing' => '¡Hasta pronto!',
            'team' => 'El Equipo AYNIX',
            'email_title' => 'Cuestionario Recibido'
        ),
        'pt' => array(
            'subject' => 'Obrigado por preencher o questionário - AYNIX [#' . $email_id . ']',
            'title' => '✅ Questionário Recebido',
            'thanks' => 'Obrigado por preencher o nosso questionário!',
            'received' => 'Recebemos as suas informações e estamos a analisá-las.',
            'what_next' => '📋 O que acontece agora?',
            'step1' => 'Analisamos as suas necessidades',
            'step2' => 'Avaliamos se e como podemos ajudá-lo',
            'step3' => 'Contactamos apenas se houver valor real',
            'time_label' => 'Tempo estimado:',
            'time_value' => 'máximo 24 horas',
            'note_label' => 'Nota importante:',
            'note_text' => 'Não receberá propostas comerciais automáticas. Contactaremos apenas se acreditarmos que podemos realmente ajudá-lo.',
            'closing' => 'Até breve!',
            'team' => 'A Equipa AYNIX',
            'email_title' => 'Questionário Recebido'
        )
    );
    
    $t = $translations[$lang];
    
    $content = '
        <h1>' . $t['title'] . '</h1>
        <p>' . $t['thanks'] . '</p>
        <p>' . $t['received'] . '</p>
        
        <div class="info-box">
            <p><strong>' . $t['what_next'] . '</strong></p>
            <ul style="margin: 10px 0;">
                <li>' . $t['step1'] . '</li>
                <li>' . $t['step2'] . '</li>
                <li>' . $t['step3'] . '</li>
            </ul>
        </div>
        
        <p><strong>' . $t['time_label'] . '</strong> ' . $t['time_value'] . '</p>
        
        <p><strong>' . $t['note_label'] . '</strong> ' . $t['note_text'] . '</p>
        
        <p>' . $t['closing'] . '</p>
        <p><strong>' . $t['team'] . '</strong></p>
    ';
    
    $html_message = aynix_email_template($content, $t['email_title'], '', $lang);
    
    $headers = array(
        'From: AYNIX <info@aynix.tech>',
        'Reply-To: info@aynix.tech',
        'Content-Type: text/html; charset=UTF-8'
    );
    
    return wp_mail($to_email, $t['subject'], $html_message, $headers);
}

/**
 * Invia notifica all'admin con dati questionario completi
 */
function send_admin_notification($user_email, $form_data, $ai_proposal = null, $post_id = 0) {
    $admin_email = get_option('admin_email');
    $dev_email = 'aynixdevelopment@gmail.com';
    $recipients = array_values(array_unique(array_filter(array($admin_email, $dev_email), 'is_email')));
    $subject = '🔔 Nuova Richiesta Progetto Software - AYNIX';
    
    // Costruisci riepilogo dati questionario
    $form_summary = '<h2>📋 Dati Questionario</h2>';
    $form_summary .= '<table>';
    
    $field_labels = array(
        'tipo_progetto' => 'Tipo Progetto',
        'obiettivo_principale' => 'Obiettivo Principale',
        'funzionalita' => 'Funzionalità',
        'utenti_target' => 'Utenti Target',
        'numero_utenti' => 'Numero Utenti',
        'stato_progetto' => 'Stato Progetto',
        'complessita' => 'Complessità',
        'tempistiche' => 'Tempistiche',
        'budget' => 'Budget',
        'dettagli_extra' => 'Dettagli Extra'
    );
    
    foreach ($field_labels as $key => $label) {
        if (isset($form_data[$key]) && !empty($form_data[$key])) {
            $value = $form_data[$key];
            if (is_array($value)) {
                $value = implode(', ', $value);
            }
            $form_summary .= '<tr>';
            $form_summary .= '<td>' . esc_html($label) . ':</td>';
            $form_summary .= '<td>' . esc_html($value) . '</td>';
            $form_summary .= '</tr>';
        }
    }
    $form_summary .= '</table>';
    
    $content = '
        <h1>🚀 Nuova Richiesta Progetto Software</h1>
        
        <div class="info-box">
            <p><strong>📧 Email Cliente:</strong> ' . esc_html($user_email) . '</p>
            <p><strong>🆔 Post ID:</strong> ' . esc_html($post_id) . '</p>
            <p><strong>📅 Data:</strong> ' . date('d/m/Y H:i') . '</p>
        </div>
        
        ' . $form_summary . '
    ';
    
    if ($ai_proposal) {
        $content .= '
            <h2>🤖 Proposta AI Generata</h2>
            <div class="info-box">
                ' . nl2br(esc_html($ai_proposal)) . '
            </div>
            <p style="color: #28a745; font-weight: 600;">✅ Email con proposta inviata automaticamente al cliente</p>
        ';
    } else {
        $content .= '
            <div class="info-box" style="border-left-color: #ff6331;">
                <p style="color: #ff6331; font-weight: 600;">⚠️ Generazione proposta AI fallita</p>
                <p>Verifica la configurazione della OpenAI API key e contatta manualmente il cliente.</p>
            </div>
        ';
    }
    
    $content .= '
        <p style="text-align: center; margin-top: 30px;">
            <a href="' . admin_url('post.php?post=' . $post_id . '&action=edit') . '" class="cta-button">Visualizza nel Pannello Admin</a>
        </p>
    ';
    
    $html_message = aynix_email_template($content, 'Nuova Richiesta Progetto');
    
    $headers = array(
        'From: AYNIX Sistema <info@aynix.tech>',
        'Reply-To: ' . $user_email,
        'Content-Type: text/html; charset=UTF-8'
    );
    
    return wp_mail($recipients, $subject, $html_message, $headers);
}

add_action('wp_ajax_save_diagnosis', 'save_diagnosis_submission');
add_action('wp_ajax_nopriv_save_diagnosis', 'save_diagnosis_submission');

/**
 * AJAX Handler per richiesta contatto
 */
function submit_contact_request_handler() {
    // Raccolta dati
    $nome = isset($_POST['nome']) ? sanitize_text_field($_POST['nome']) : '';
    $cognome = isset($_POST['cognome']) ? sanitize_text_field($_POST['cognome']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $telefono = isset($_POST['telefono']) ? sanitize_text_field($_POST['telefono']) : '';
    $azienda = isset($_POST['azienda']) ? sanitize_text_field($_POST['azienda']) : '';
    $note = isset($_POST['note']) ? sanitize_textarea_field($_POST['note']) : '';
    $source = isset($_POST['contact_source']) ? sanitize_text_field($_POST['contact_source']) : '';
    $lang   = isset($_COOKIE['site_lang']) ? sanitize_text_field($_COOKIE['site_lang']) : 'it';
    $lang   = in_array($lang, array('it','en','es','pt'), true) ? $lang : 'it';

    // Sicurezza per form modal SafeFleet (nonce + honeypot + captcha)
    $sf_contact_nonce = isset($_POST['sf_contact_nonce']) ? sanitize_text_field($_POST['sf_contact_nonce']) : '';
    $sf_website = isset($_POST['sf_website']) ? sanitize_text_field($_POST['sf_website']) : '';

    if (!empty($sf_contact_nonce)) {
        if (!wp_verify_nonce($sf_contact_nonce, 'sf_contact_modal')) {
            wp_send_json_error(array('message' => 'Verifica sicurezza non valida'));
            return;
        }

        if (!empty($sf_website)) {
            wp_send_json_error(array('message' => 'Invio non valido'));
            return;
        }

        $sf_captcha_a = isset($_POST['sf_captcha_a']) ? intval($_POST['sf_captcha_a']) : -1;
        $sf_captcha_b = isset($_POST['sf_captcha_b']) ? intval($_POST['sf_captcha_b']) : -1;
        $sf_captcha_answer = isset($_POST['sf_captcha_answer']) ? intval($_POST['sf_captcha_answer']) : -1;
        $sf_captcha_token = isset($_POST['sf_captcha_token']) ? sanitize_text_field($_POST['sf_captcha_token']) : '';

        $sf_expected_token = wp_hash($sf_captcha_a . '|' . $sf_captcha_b . '|sf_modal');
        $sf_expected_answer = $sf_captcha_a + $sf_captcha_b;

        if (empty($sf_captcha_token) || !hash_equals($sf_expected_token, $sf_captcha_token) || $sf_captcha_answer !== $sf_expected_answer) {
            wp_send_json_error(array('message' => 'Captcha non valido'));
            return;
        }
    }
    
    // Validazione
    if (empty($nome) || empty($cognome) || empty($email) || empty($telefono)) {
        wp_send_json_error(array('message' => 'Compila tutti i campi obbligatori'));
        return;
    }
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Email non valida'));
        return;
    }
    
    // Salva in custom post type
    $contact_data = array(
        'post_title'    => 'Richiesta Contatto - ' . $nome . ' ' . $cognome . ' - ' . current_time('mysql'),
        'post_content'  => "Nome: $nome $cognome\nEmail: $email\nTelefono: $telefono\nAzienda: $azienda\n\nNote:\n$note",
        'post_status'   => 'private',
        'post_type'     => 'contact_request',
        'post_author'   => 1,
    );
    
    $post_id = wp_insert_post($contact_data);
    
    if (!$post_id) {
        wp_send_json_error(array('message' => 'Errore nel salvataggio'));
        return;
    }
    
    // Salva metadati
    update_post_meta($post_id, 'nome', $nome);
    update_post_meta($post_id, 'cognome', $cognome);
    update_post_meta($post_id, 'email', $email);
    update_post_meta($post_id, 'telefono', $telefono);
    update_post_meta($post_id, 'azienda', $azienda);
    update_post_meta($post_id, 'note', $note);
    
    // Invia email all'admin
    send_contact_request_notification($nome, $cognome, $email, $telefono, $azienda, $note, $post_id, $source);
    
    // Invia conferma al cliente
    send_contact_request_confirmation($email, $nome, $cognome, $telefono, $azienda, $note, $source, $lang);
    
    wp_send_json_success(array('message' => 'Richiesta inviata con successo'));
}

add_action('wp_ajax_submit_contact_request', 'submit_contact_request_handler');
add_action('wp_ajax_nopriv_submit_contact_request', 'submit_contact_request_handler');

/**
 * Invia notifica admin per richiesta contatto
 */
function send_contact_request_notification($nome, $cognome, $email, $telefono, $azienda, $note, $post_id, $source = '') {
    $admin_email = get_option('admin_email');
    $dev_email = 'aynixdevelopment@gmail.com';
    $recipients = array_values(array_unique(array_filter(array($admin_email, $dev_email), 'is_email')));
    $source_tag = !empty($source) ? ' [' . $source . ']' : '';
    $subject = '📞 Nuova Richiesta di Contatto' . $source_tag . ' - AYNIX';
    
    $content = '
        <h1>📞 Nuova Richiesta di Contatto</h1>
        
        <div class="info-box">
            <p><strong>👤 Nome:</strong> ' . esc_html($nome) . ' ' . esc_html($cognome) . '</p>
            <p><strong>📧 Email:</strong> ' . esc_html($email) . '</p>
            <p><strong>📱 Telefono:</strong> ' . esc_html($telefono) . '</p>
            ' . (!empty($azienda) ? '<p><strong>🏢 Azienda:</strong> ' . esc_html($azienda) . '</p>' : '') . '
            <p><strong>📅 Data:</strong> ' . date('d/m/Y H:i') . '</p>
        </div>
    ';
    
    if (!empty($note)) {
        $content .= '
            <h2>📝 Note</h2>
            <div class="info-box">
                <p>' . nl2br(esc_html($note)) . '</p>
            </div>
        ';
    }
    
    $content .= '
        <p style="text-align: center; margin-top: 30px;">
            <a href="' . admin_url('post.php?post=' . $post_id . '&action=edit') . '" class="cta-button">Visualizza nel Pannello Admin</a>
        </p>
        
        <p><strong>⚡ Azione richiesta:</strong> Contatta il cliente entro 24 ore per fissare la call.</p>
    ';
    
    $html_message = aynix_email_template($content, 'Nuova Richiesta di Contatto');
    
    $headers = array(
        'From: AYNIX Sistema <info@aynix.tech>',
        'Reply-To: ' . $email,
        'Content-Type: text/html; charset=UTF-8'
    );
    
    return wp_mail($recipients, $subject, $html_message, $headers);
}

/**
 * Invia conferma al cliente per richiesta contatto (tradotta in base alla lingua)
 */
function send_contact_request_confirmation($email, $nome, $cognome = '', $telefono = '', $azienda = '', $note = '', $source = '', $lang = 'it') {
    $allowed_langs = array('it', 'en', 'es', 'pt');
    if (!in_array($lang, $allowed_langs, true)) {
        $lang = 'it';
    }
    $source_tag = !empty($source) ? ' [' . $source . ']' : '';
    $full_name  = trim($nome . ' ' . $cognome);

    $translations = array(
        'it' => array(
            'subject'        => 'Richiesta Ricevuta' . $source_tag . ' - Ti contatteremo presto - AYNIX',
            'email_title'    => 'Richiesta Ricevuta',
            'email_subtitle' => 'Ti contatteremo entro 24 ore per organizzare una call.',
            'greeting'       => 'Ciao',
            'received'       => 'Abbiamo ricevuto la tua richiesta di contatto e ti ricontatteremo a breve.',
            'summary_title'  => '📌 Riepilogo della tua richiesta',
            'name_label'     => 'Nome',
            'email_label'    => 'Email',
            'phone_label'    => 'Telefono',
            'company_label'  => 'Azienda',
            'message_title'  => '📝 Il tuo messaggio',
            'next_title'     => '📞 Cosa succede ora?',
            'step1'          => 'Ti contatteremo entro 24 ore',
            'step2'          => 'Organizzeremo una call gratuita di 15-20 minuti',
            'step3'          => 'Analizzeremo il tuo progetto in dettaglio',
            'cta_text'       => 'Visita il nostro sito',
            'closing'        => 'A presto,',
            'team'           => 'Il Team AYNIX',
        ),
        'en' => array(
            'subject'        => 'Request Received' . $source_tag . ' - We will contact you soon - AYNIX',
            'email_title'    => 'Request Received',
            'email_subtitle' => 'We will contact you within 24 hours to schedule a call.',
            'greeting'       => 'Hi',
            'received'       => 'We have received your contact request and will get back to you shortly.',
            'summary_title'  => '📌 Your Request Summary',
            'name_label'     => 'Name',
            'email_label'    => 'Email',
            'phone_label'    => 'Phone',
            'company_label'  => 'Company',
            'message_title'  => '📝 Your Message',
            'next_title'     => '📞 What happens next?',
            'step1'          => 'We will contact you within 24 hours',
            'step2'          => 'We will schedule a free 15-20 minute call',
            'step3'          => 'We will analyse your project in detail',
            'cta_text'       => 'Visit our website',
            'closing'        => 'See you soon,',
            'team'           => 'The AYNIX Team',
        ),
        'es' => array(
            'subject'        => 'Solicitud Recibida' . $source_tag . ' - Te contactaremos pronto - AYNIX',
            'email_title'    => 'Solicitud Recibida',
            'email_subtitle' => 'Nos pondremos en contacto contigo en un plazo de 24 horas.',
            'greeting'       => 'Hola',
            'received'       => 'Hemos recibido tu solicitud de contacto y nos pondremos en contacto contigo en breve.',
            'summary_title'  => '📌 Resumen de tu solicitud',
            'name_label'     => 'Nombre',
            'email_label'    => 'Email',
            'phone_label'    => 'Teléfono',
            'company_label'  => 'Empresa',
            'message_title'  => '📝 Tu mensaje',
            'next_title'     => '📞 ¿Qué pasa ahora?',
            'step1'          => 'Nos pondremos en contacto contigo en un plazo de 24 horas',
            'step2'          => 'Organizaremos una llamada gratuita de 15-20 minutos',
            'step3'          => 'Analizaremos tu proyecto en detalle',
            'cta_text'       => 'Visita nuestro sitio web',
            'closing'        => '¡Hasta pronto,',
            'team'           => 'El Equipo AYNIX',
        ),
        'pt' => array(
            'subject'        => 'Pedido Recebido' . $source_tag . ' - Entraremos em contacto em breve - AYNIX',
            'email_title'    => 'Pedido Recebido',
            'email_subtitle' => 'Entraremos em contacto dentro de 24 horas para agendar uma chamada.',
            'greeting'       => 'Olá',
            'received'       => 'Recebemos o seu pedido de contacto e entraremos em contacto em breve.',
            'summary_title'  => '📌 Resumo do seu pedido',
            'name_label'     => 'Nome',
            'email_label'    => 'Email',
            'phone_label'    => 'Telefone',
            'company_label'  => 'Empresa',
            'message_title'  => '📝 A sua mensagem',
            'next_title'     => '📞 O que acontece agora?',
            'step1'          => 'Entraremos em contacto dentro de 24 horas',
            'step2'          => 'Agendaremos uma chamada gratuita de 15-20 minutos',
            'step3'          => 'Analisaremos o seu projeto em detalhe',
            'cta_text'       => 'Visite o nosso site',
            'closing'        => 'Até breve,',
            'team'           => 'A Equipa AYNIX',
        ),
    );
    $t = $translations[$lang];

    $content  = '<p>' . esc_html($t['greeting']) . ' ' . esc_html($nome) . ',</p>';
    $content .= '<p>' . esc_html($t['received']) . '</p>';
    $content .= '<p style="font-size:16px;font-weight:700;color:#0e1f3d;margin:24px 0 10px;">' . esc_html($t['summary_title']) . '</p>';
    $content .= '<div class="info-box">';
    $content .= '<p><strong>' . esc_html($t['name_label']) . ':</strong> ' . esc_html($full_name) . '</p>';
    $content .= '<p><strong>' . esc_html($t['email_label']) . ':</strong> ' . esc_html($email) . '</p>';
    if (!empty($telefono)) {
        $content .= '<p><strong>' . esc_html($t['phone_label']) . ':</strong> ' . esc_html($telefono) . '</p>';
    }
    if (!empty($azienda)) {
        $content .= '<p><strong>' . esc_html($t['company_label']) . ':</strong> ' . esc_html($azienda) . '</p>';
    }
    $content .= '</div>';

    if (!empty($note)) {
        $content .= '<p style="font-size:16px;font-weight:700;color:#0e1f3d;margin:24px 0 10px;">' . esc_html($t['message_title']) . '</p>';
        $content .= '<div class="info-box"><p>' . nl2br(esc_html($note)) . '</p></div>';
    }

    $content .= '<p style="font-size:16px;font-weight:700;color:#0e1f3d;margin:24px 0 10px;">' . esc_html($t['next_title']) . '</p>';
    $content .= '<ul>';
    $content .= '<li>' . esc_html($t['step1']) . '</li>';
    $content .= '<li>' . esc_html($t['step2']) . '</li>';
    $content .= '<li>' . esc_html($t['step3']) . '</li>';
    $content .= '</ul>';

    $content .= '<p style="text-align:center;margin:28px 0 8px;">';
    $content .= '<a href="' . esc_url(home_url('/')) . '" class="cta-button" style="background:#f05c2a;color:#ffffff !important;text-decoration:none;padding:16px 40px;border-radius:50px;font-size:16px;font-weight:700;display:inline-block;">' . esc_html($t['cta_text']) . '</a>';
    $content .= '</p>';

    $content .= '<p style="margin-top:28px;">' . esc_html($t['closing']) . '</p>';
    $content .= '<p><strong>' . esc_html($t['team']) . '</strong></p>';

    $html_message = aynix_email_template($content, $t['email_title'], $t['email_subtitle'], $lang);

    $headers = array(
        'From: AYNIX <info@aynix.tech>',
        'Reply-To: info@aynix.tech',
        'Content-Type: text/html; charset=UTF-8',
    );

    return wp_mail($email, $t['subject'], $html_message, $headers);
}

/**
 * Registra Custom Post Type per Diagnosi
 */
function register_diagnosis_post_type() {
    register_post_type('diagnosis', array(
        'labels' => array(
            'name' => 'Diagnosi',
            'singular_name' => 'Diagnosi'
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-analytics'
    ));
}
add_action('init', 'register_diagnosis_post_type');

/**
 * Aggiungi colonne personalizzate alla tabella Diagnosi in admin
 */
function diagnosis_custom_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = 'Titolo';
    $new_columns['email'] = 'Email Cliente';
    $new_columns['user_lang'] = 'Lingua';
    $new_columns['tipo_progetto'] = 'Tipo Progetto';
    $new_columns['budget'] = 'Budget';
    $new_columns['email_status'] = 'Email Status';
    $new_columns['ai_status'] = 'AI Status';
    $new_columns['date'] = 'Data';
    return $new_columns;
}
add_filter('manage_diagnosis_posts_columns', 'diagnosis_custom_columns');

/**
 * Popola le colonne personalizzate con i dati
 */
function diagnosis_custom_columns_content($column, $post_id) {
    switch ($column) {
        case 'email':
            $email = get_post_meta($post_id, 'email', true);
            echo esc_html($email);
            break;
            
        case 'user_lang':
            $lang = get_post_meta($post_id, 'user_lang', true);
            $lang_labels = array('it' => '🇮🇹 IT', 'en' => '🇬🇧 EN', 'es' => '🇪🇸 ES', 'pt' => '🇵🇹 PT');
            echo isset($lang_labels[$lang]) ? $lang_labels[$lang] : '🇮🇹 IT';
            break;
            
        case 'tipo_progetto':
            $tipo = get_post_meta($post_id, 'tipo_progetto', true);
            echo esc_html($tipo);
            break;
            
        case 'budget':
            $budget = get_post_meta($post_id, 'budget', true);
            echo '<strong>' . esc_html($budget) . '</strong>';
            break;
            
        case 'email_status':
            // Verifica se esiste proposta AI (indica che le email sono state inviate)
            $ai_proposal = get_post_meta($post_id, 'ai_proposal', true);
            $ai_error = get_post_meta($post_id, 'ai_proposal_error', true);
            
            if ($ai_proposal) {
                echo '<span style="color: #28a745;">✓ Email conferma + Proposta inviata</span>';
            } elseif ($ai_error) {
                echo '<span style="color: #ffa500;">✓ Email conferma (AI fallito)</span>';
            } else {
                echo '<span style="color: #999;">⏳ In elaborazione...</span>';
            }
            break;
            
        case 'ai_status':
            $ai_proposal = get_post_meta($post_id, 'ai_proposal', true);
            $ai_error = get_post_meta($post_id, 'ai_proposal_error', true);
            
            if ($ai_proposal) {
                echo '<a href="' . admin_url('post.php?post=' . $post_id . '&action=edit') . '" class="button button-small">📄 Visualizza Proposta</a>';
            } elseif ($ai_error) {
                echo '<span style="color: #dc3545;">✗ Errore: ' . esc_html($ai_error) . '</span>';
            } else {
                echo '<span style="color: #999;">⏳ Generazione in corso...</span>';
            }
            break;
    }
}
add_action('manage_diagnosis_posts_custom_column', 'diagnosis_custom_columns_content', 10, 2);

/**
 * Rendi le colonne ordinabili
 */
function diagnosis_sortable_columns($columns) {
    $columns['email'] = 'email';
    $columns['tipo_progetto'] = 'tipo_progetto';
    $columns['budget'] = 'budget';
    return $columns;
}
add_filter('manage_edit-diagnosis_sortable_columns', 'diagnosis_sortable_columns');

/**
 * Aggiungi meta box per visualizzare proposta AI completa
 */
function diagnosis_add_meta_boxes() {
    add_meta_box(
        'diagnosis_ai_proposal',
        'Proposta AI Generata',
        'diagnosis_ai_proposal_callback',
        'diagnosis',
        'normal',
        'high'
    );
    
    add_meta_box(
        'diagnosis_form_data',
        'Dati Questionario Completi',
        'diagnosis_form_data_callback',
        'diagnosis',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'diagnosis_add_meta_boxes');

/**
 * Callback per meta box proposta AI
 */
function diagnosis_ai_proposal_callback($post) {
    $ai_proposal = get_post_meta($post->ID, 'ai_proposal', true);
    $ai_error = get_post_meta($post->ID, 'ai_proposal_error', true);
    
    if ($ai_proposal) {
        echo '<div style="background: #f0f9ff; border-left: 4px solid #438ef9; padding: 20px; margin: 10px 0;">';
        echo '<h3 style="margin-top: 0; color: #438ef9;">✓ Proposta AI Generata con Successo</h3>';
        echo '<div style="white-space: pre-wrap; font-family: monospace; background: white; padding: 15px; border-radius: 5px; line-height: 1.6;">';
        echo esc_html($ai_proposal);
        echo '</div>';
        echo '</div>';
    } elseif ($ai_error) {
        echo '<div style="background: #fff3cd; border-left: 4px solid #ffa500; padding: 20px; margin: 10px 0;">';
        echo '<h3 style="margin-top: 0; color: #ff6331;">⚠️ Errore Generazione AI</h3>';
        echo '<p><strong>Errore:</strong> ' . esc_html($ai_error) . '</p>';
        echo '<p><em>La prima email di conferma è stata comunque inviata al cliente.</em></p>';
        echo '</div>';
    } else {
        echo '<div style="background: #f8f9fa; border-left: 4px solid #999; padding: 20px; margin: 10px 0;">';
        echo '<h3 style="margin-top: 0; color: #666;">⏳ Proposta AI in generazione...</h3>';
        echo '<p>La proposta AI verrà generata a breve dal cron di WordPress.</p>';
        echo '</div>';
    }
}

/**
 * Callback per meta box dati questionario
 */
function diagnosis_form_data_callback($post) {
    $form_data = json_decode($post->post_content, true);
    
    if (!$form_data) {
        echo '<p>Nessun dato disponibile.</p>';
        return;
    }
    
    $labels = array(
        'email' => 'Email',
        'tipo_progetto' => 'Tipo Progetto',
        'obiettivo_principale' => 'Obiettivo Principale',
        'funzionalita' => 'Funzionalità',
        'utenti_target' => 'Utenti Target',
        'numero_utenti' => 'Numero Utenti',
        'stato_progetto' => 'Stato Progetto',
        'complessita' => 'Complessità',
        'tempistiche' => 'Tempistiche',
        'budget' => 'Budget',
        'dettagli_extra' => 'Dettagli Extra'
    );
    
    echo '<table class="wp-list-table widefat fixed striped" style="margin-top: 10px;">';
    echo '<thead><tr><th style="width: 200px;">Campo</th><th>Valore</th></tr></thead>';
    echo '<tbody>';
    
    foreach ($labels as $key => $label) {
        if (isset($form_data[$key]) && !empty($form_data[$key])) {
            $value = $form_data[$key];
            if (is_array($value)) {
                $value = implode(', ', $value);
            }
            echo '<tr>';
            echo '<td><strong>' . esc_html($label) . '</strong></td>';
            echo '<td>' . esc_html($value) . '</td>';
            echo '</tr>';
        }
    }
    
    echo '</tbody>';
    echo '</table>';
}

/**
 * Aggiungi colonne personalizzate alla tabella Richieste Contatto in admin
 */
function contact_request_custom_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = 'Titolo';
    $new_columns['contact_name'] = 'Nome';
    $new_columns['email'] = 'Email';
    $new_columns['telefono'] = 'Telefono';
    $new_columns['azienda'] = 'Azienda';
    $new_columns['diagnosis_link'] = 'Diagnosi Collegata';
    $new_columns['google_meet'] = 'Google Meet';
    $new_columns['date'] = 'Data';
    return $new_columns;
}
add_filter('manage_contact_request_posts_columns', 'contact_request_custom_columns');

/**
 * Popola le colonne personalizzate con i dati
 */
function contact_request_custom_columns_content($column, $post_id) {
    switch ($column) {
        case 'contact_name':
            $nome = get_post_meta($post_id, 'nome', true);
            $cognome = get_post_meta($post_id, 'cognome', true);
            echo '<strong>' . esc_html($nome . ' ' . $cognome) . '</strong>';
            break;
            
        case 'email':
            $email = get_post_meta($post_id, 'email', true);
            echo '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>';
            break;
            
        case 'telefono':
            $telefono = get_post_meta($post_id, 'telefono', true);
            echo '<a href="tel:' . esc_attr($telefono) . '">' . esc_html($telefono) . '</a>';
            break;
            
        case 'azienda':
            $azienda = get_post_meta($post_id, 'azienda', true);
            echo $azienda ? esc_html($azienda) : '<em>—</em>';
            break;
            
        case 'diagnosis_link':
            $email = get_post_meta($post_id, 'email', true);
            
            // Cerca diagnosi con questa email
            $diagnosis_query = new WP_Query(array(
                'post_type' => 'diagnosis',
                'posts_per_page' => -1,
                'meta_query' => array(
                    array(
                        'key' => 'email',
                        'value' => $email,
                        'compare' => '='
                    )
                )
            ));
            
            if ($diagnosis_query->have_posts()) {
                echo '<div style="display: flex; flex-direction: column; gap: 5px;">';
                while ($diagnosis_query->have_posts()) {
                    $diagnosis_query->the_post();
                    $diagnosis_id = get_the_ID();
                    $diagnosis_date = get_the_date('d/m/Y H:i');
                    echo '<a href="' . admin_url('post.php?post=' . $diagnosis_id . '&action=edit') . '" class="button button-small">📋 Diagnosi del ' . esc_html($diagnosis_date) . '</a>';
                }
                echo '</div>';
                wp_reset_postdata();
            } else {
                echo '<em style="color: #999;">Nessuna diagnosi trovata</em>';
            }
            break;
            
        case 'google_meet':
            $nome = get_post_meta($post_id, 'nome', true);
            $cognome = get_post_meta($post_id, 'cognome', true);
            $email = get_post_meta($post_id, 'email', true);
            
            // Crea link Google Calendar con Meet
            $event_title = 'Aynix Call Diagnosi - ' . $nome . ' ' . $cognome;
            $event_details = 'Call di diagnosi con ' . $nome . ' ' . $cognome . '\nEmail: ' . $email;
            
            // Link Google Calendar (apre form per creare evento)
            $google_calendar_url = 'https://calendar.google.com/calendar/render?action=TEMPLATE';
            $google_calendar_url .= '&text=' . urlencode($event_title);
            $google_calendar_url .= '&details=' . urlencode($event_details);
            $google_calendar_url .= '&add=' . urlencode($email);
            $google_calendar_url .= '&conf=1'; // Abilita Google Meet automaticamente
            
            echo '<a href="' . esc_url($google_calendar_url) . '" target="_blank" class="button button-primary button-small">📅 Crea Meet</a>';
            break;
    }
}
add_action('manage_contact_request_posts_custom_column', 'contact_request_custom_columns_content', 10, 2);

/**
 * Rendi le colonne ordinabili
 */
function contact_request_sortable_columns($columns) {
    $columns['contact_name'] = 'nome';
    $columns['email'] = 'email';
    $columns['telefono'] = 'telefono';
    $columns['azienda'] = 'azienda';
    return $columns;
}
add_filter('manage_edit-contact_request_sortable_columns', 'contact_request_sortable_columns');

/**
 * Aggiungi meta box per richieste contatto
 */
function contact_request_add_meta_boxes() {
    add_meta_box(
        'contact_request_info',
        'Informazioni Contatto',
        'contact_request_info_callback',
        'contact_request',
        'normal',
        'high'
    );
    
    add_meta_box(
        'contact_request_diagnosis',
        'Diagnosi Correlate',
        'contact_request_diagnosis_callback',
        'contact_request',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'contact_request_add_meta_boxes');

/**
 * Callback per meta box informazioni contatto
 */
function contact_request_info_callback($post) {
    $nome = get_post_meta($post->ID, 'nome', true);
    $cognome = get_post_meta($post->ID, 'cognome', true);
    $email = get_post_meta($post->ID, 'email', true);
    $telefono = get_post_meta($post->ID, 'telefono', true);
    $azienda = get_post_meta($post->ID, 'azienda', true);
    $note = get_post_meta($post->ID, 'note', true);
    
    echo '<table class="form-table">';
    
    echo '<tr>';
    echo '<th><strong>Nome Completo:</strong></th>';
    echo '<td>' . esc_html($nome . ' ' . $cognome) . '</td>';
    echo '</tr>';
    
    echo '<tr>';
    echo '<th><strong>Email:</strong></th>';
    echo '<td><a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a></td>';
    echo '</tr>';
    
    echo '<tr>';
    echo '<th><strong>Telefono:</strong></th>';
    echo '<td><a href="tel:' . esc_attr($telefono) . '">' . esc_html($telefono) . '</a></td>';
    echo '</tr>';
    
    if ($azienda) {
        echo '<tr>';
        echo '<th><strong>Azienda:</strong></th>';
        echo '<td>' . esc_html($azienda) . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
    
    if ($note) {
        echo '<h3>Note aggiuntive:</h3>';
        echo '<div style="background: #f9f9f9; padding: 15px; border-left: 4px solid #438ef9; margin-top: 10px;">';
        echo '<p style="white-space: pre-wrap;">' . esc_html($note) . '</p>';
        echo '</div>';
    }
    
    // Link Google Meet
    $event_title = 'Aynix Call Diagnosi - ' . $nome . ' ' . $cognome;
    $event_details = 'Call di diagnosi con ' . $nome . ' ' . $cognome . '\n\nEmail: ' . $email . '\nTelefono: ' . $telefono . ($azienda ? '\nAzienda: ' . $azienda : '');
    
    $google_calendar_url = 'https://calendar.google.com/calendar/render?action=TEMPLATE';
    $google_calendar_url .= '&text=' . urlencode($event_title);
    $google_calendar_url .= '&details=' . urlencode($event_details);
    $google_calendar_url .= '&add=' . urlencode($email);
    $google_calendar_url .= '&conf=1';
    
    echo '<div style="margin-top: 20px; padding: 15px; background: #e7f3ff; border-radius: 5px;">';
    echo '<h3 style="margin-top: 0;">📅 Pianifica Call con Google Meet</h3>';
    echo '<p>Crea un evento Google Calendar con Google Meet automaticamente incluso:</p>';
    echo '<a href="' . esc_url($google_calendar_url) . '" target="_blank" class="button button-primary button-large">📞 Crea Evento Google Meet</a>';
    echo '</div>';
}

/**
 * Callback per meta box diagnosi correlate
 */
function contact_request_diagnosis_callback($post) {
    $email = get_post_meta($post->ID, 'email', true);
    
    // Cerca diagnosi con questa email
    $diagnosis_query = new WP_Query(array(
        'post_type' => 'diagnosis',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'email',
                'value' => $email,
                'compare' => '='
            )
        ),
        'orderby' => 'date',
        'order' => 'DESC'
    ));
    
    if ($diagnosis_query->have_posts()) {
        echo '<p><strong>Diagnosi trovate per ' . esc_html($email) . ':</strong></p>';
        echo '<ul style="margin: 10px 0; padding-left: 20px;">';
        
        while ($diagnosis_query->have_posts()) {
            $diagnosis_query->the_post();
            $diagnosis_id = get_the_ID();
            $diagnosis_date = get_the_date('d/m/Y H:i');
            $tipo_progetto = get_post_meta($diagnosis_id, 'tipo_progetto', true);
            
            echo '<li style="margin-bottom: 10px;">';
            echo '<strong>' . esc_html($diagnosis_date) . '</strong><br>';
            echo '<em>' . esc_html($tipo_progetto) . '</em><br>';
            echo '<a href="' . admin_url('post.php?post=' . $diagnosis_id . '&action=edit') . '" class="button button-small" style="margin-top: 5px;">Visualizza Diagnosi</a>';
            echo '</li>';
        }
        
        echo '</ul>';
        wp_reset_postdata();
    } else {
        echo '<p><em>Nessuna diagnosi trovata per questa email.</em></p>';
    }
}

/**
 * Registra Custom Post Type per Richieste Contatto
 */
function register_contact_request_post_type() {
    register_post_type('contact_request', array(
        'labels' => array(
            'name' => 'Richieste Contatto',
            'singular_name' => 'Richiesta Contatto'
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-phone'
    ));
}
add_action('init', 'register_contact_request_post_type');

/**
 * Elaborazione AI e invio email in background (schedulato)
 */
function process_diagnosis_ai_background($post_id, $user_email, $form_data, $user_lang = 'it') {
    error_log("AYNIX DEBUG: Iniziata elaborazione AI per post_id={$post_id}, email={$user_email}, lang={$user_lang}");
    
    // Genera proposta AI con OpenAI nella lingua dell'utente
    $ai_proposal = generate_ai_proposal($form_data, $user_lang);
    
    if ($ai_proposal) {
        error_log("AYNIX DEBUG: Proposta AI generata con successo");
        update_post_meta($post_id, 'ai_proposal', $ai_proposal);
        
        // SECONDA EMAIL: Invia email con proposta AI e CTA per richiesta contatto
        $email_sent = send_proposal_email($user_email, $ai_proposal, $form_data, $user_lang, $post_id);
        error_log("AYNIX DEBUG: Email proposta inviata a {$user_email}: " . ($email_sent ? 'SUCCESS' : 'FAILED'));
        
        // Invia email all'admin con proposta e dati questionario
        send_admin_notification($user_email, $form_data, $ai_proposal, $post_id);
    } else {
        error_log("AYNIX DEBUG: Generazione proposta AI FALLITA");
        // Se OpenAI fallisce, invia comunque notifica all'admin
        send_admin_notification($user_email, $form_data, null, $post_id);
        
        update_post_meta($post_id, 'ai_proposal_error', 'OpenAI API non disponibile');
    }
}
add_action('process_diagnosis_ai', 'process_diagnosis_ai_background', 10, 4);
?>
