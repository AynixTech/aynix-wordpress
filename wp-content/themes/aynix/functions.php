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
function aynix_load_translation() {
    $lang = $_COOKIE['site_lang'] ?? 'en';
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
 * Caricamento font esterni (Inter, Oxanium, Font Awesome)
 */
function aynix_enqueue_fonts() {
    // Caricamento del font Inter da Google Fonts
    wp_enqueue_style('inter-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap', [], null);
    
    // Caricamento del font Oxanium da Google Fonts
    wp_enqueue_style('oxanium-font', 'https://fonts.googleapis.com/css2?family=Oxanium:wght@400;600&display=swap', [], null);
    
    // Caricamento di Font Awesome (Free)
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', [], '6.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'aynix_enqueue_fonts');

/**
 * AJAX Handler per salvataggio diagnosi e generazione proposta AI
 */
function save_diagnosis_submission() {
    $form_data = isset($_POST['formData']) ? $_POST['formData'] : array();
    $timestamp = isset($_POST['timestamp']) ? sanitize_text_field($_POST['timestamp']) : current_time('mysql');
    $user_email = isset($form_data['email']) ? sanitize_email($form_data['email']) : '';
    
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
    
    // Salva metadati
    foreach ($form_data as $key => $value) {
        if (is_array($value)) {
            update_post_meta($post_id, $key, json_encode($value));
        } else {
            update_post_meta($post_id, $key, sanitize_text_field($value));
        }
    }
    
    // Genera proposta AI con OpenAI
    $ai_proposal = generate_ai_proposal($form_data);
    
    if ($ai_proposal) {
        update_post_meta($post_id, 'ai_proposal', $ai_proposal);
        
        // Invia email all'utente con proposta
        send_proposal_email($user_email, $ai_proposal, $form_data);
    } else {
        // Se OpenAI fallisce, invia comunque email base all'utente
        $fallback_message = "Grazie per aver completato il questionario!\n\n";
        $fallback_message .= "Abbiamo ricevuto le tue informazioni e il nostro team le sta analizzando.\n";
        $fallback_message .= "Ti contatteremo a breve con una proposta personalizzata per il tuo progetto.\n\n";
        $fallback_message .= "A presto,\nIl Team AYNIX";
        
        wp_mail($user_email, 'Questionario Ricevuto - AYNIX', $fallback_message, array(
            'From: AYNIX <admin@aynix.tech>',
            'Content-Type: text/plain; charset=UTF-8'
        ));
        
        update_post_meta($post_id, 'ai_proposal_error', 'OpenAI API non disponibile');
    }
    
    // Notifica admin SEMPRE (anche se OpenAI fallisce)
    $admin_email = get_option('admin_email');
    $subject = 'Nuova Richiesta Progetto Software - AYNIX';
    $message = "Nuova richiesta progetto software ricevuta.\n\n";
    $message .= "Email cliente: $user_email\n";
    $message .= "Post ID: $post_id\n\n";
    $message .= "Tipo progetto: " . (isset($form_data['tipo_progetto']) ? $form_data['tipo_progetto'] : 'N/A') . "\n";
    $message .= "Budget: " . (isset($form_data['budget']) ? $form_data['budget'] : 'N/A') . "\n";
    
    if (!$ai_proposal) {
        $message .= "\nNOTA: Generazione proposta AI fallita. Verifica OpenAI API key.\n";
    }
    
    wp_mail($admin_email, $subject, $message);
    
    // SEMPRE success se i dati sono stati salvati
    wp_send_json_success(array(
        'post_id' => $post_id, 
        'proposal_sent' => (bool)$ai_proposal,
        'message' => $ai_proposal ? 'Proposta inviata via email' : 'Dati salvati, proposta manuale in arrivo'
    ));
}

/**
 * Genera proposta software personalizzata usando OpenAI
 */
function generate_ai_proposal($form_data) {
    if (!defined('OPENAI_API_KEY')) {
        error_log('OpenAI API Key non configurata');
        return false;
    }
    
    // Costruisci prompt per OpenAI
    $prompt = "Sei un esperto programmatore e consulente tecnico di AYNIX, una software house specializzata in soluzioni custom.

Analizza queste risposte del cliente e genera una proposta tecnica dettagliata per il loro progetto software:

";
    
    foreach ($form_data as $key => $value) {
        if ($key !== 'email' && !empty($value)) {
            $label = ucfirst(str_replace('_', ' ', $key));
            if (is_array($value)) {
                $prompt .= "$label: " . implode(', ', $value) . "\n";
            } else {
                $prompt .= "$label: $value\n";
            }
        }
    }
    
    $prompt .= "\n
Genera una proposta che includa:
1. **Analisi del Progetto**: Riepilogo obiettivi e necessità
2. **Soluzione Tecnica Proposta**: Stack tecnologico consigliato, architettura, funzionalità principali
3. **Tempistiche Stimate**: Fasi di sviluppo e durata
4. **Investimento Indicativo**: Range di costo basato sulla complessità
5. **Prossimi Passi**: Come procedere

Scrivi in tono professionale ma accessibile, in italiano. Sii specifico e tecnico dove necessario.";
    
    // Chiamata API OpenAI
    $api_key = defined('OPENAI_API_KEY') ? OPENAI_API_KEY : '';
    
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
                    'content' => 'Sei un esperto programmatore e consulente tecnico specializzato in sviluppo software custom, web app, mobile app e sistemi gestionali.'
                ),
                array(
                    'role' => 'user',
                    'content' => $prompt
                )
            ),
            'temperature' => 0.7,
            'max_tokens' => 2000
        )),
        'timeout' => 60,
    ));
    
    if (is_wp_error($response)) {
        error_log('Errore OpenAI API: ' . $response->get_error_message());
        return false;
    }
    
    $body = json_decode(wp_remote_retrieve_body($response), true);
    
    if (isset($body['choices'][0]['message']['content'])) {
        return $body['choices'][0]['message']['content'];
    }
    
    error_log('Risposta OpenAI non valida: ' . print_r($body, true));
    return false;
}

/**
 * Invia email con proposta AI al cliente
 */
function send_proposal_email($to_email, $proposal, $form_data) {
    $subject = 'La Tua Proposta Personalizzata - AYNIX';
    
    $message = "Ciao,\n\n";
    $message .= "Grazie per aver completato il nostro questionario!\n\n";
    $message .= "Abbiamo analizzato le tue risposte e preparato una proposta tecnica personalizzata per il tuo progetto:\n\n";
    $message .= "═══════════════════════════════════════\n\n";
    $message .= $proposal;
    $message .= "\n\n═══════════════════════════════════════\n\n";
    $message .= "Vuoi discutere questa proposta? Rispondi a questa email o prenota una call: https://aynix.tech/contatti\n\n";
    $message .= "A presto,\n";
    $message .= "Il Team AYNIX\n";
    $message .= "https://aynix.tech\n";
    
    $headers = array(
        'From: AYNIX <admin@aynix.tech>',
        'Reply-To: admin@aynix.tech',
        'Content-Type: text/plain; charset=UTF-8'
    );
    
    return wp_mail($to_email, $subject, $message, $headers);
}

add_action('wp_ajax_save_diagnosis', 'save_diagnosis_submission');
add_action('wp_ajax_nopriv_save_diagnosis', 'save_diagnosis_submission');

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
?>
