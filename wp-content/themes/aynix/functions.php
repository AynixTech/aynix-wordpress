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
 * Template email HTML con branding AYNIX
 */
function aynix_email_template($content, $title = '') {
    // URL assoluto del logo (necessario per client email)
    $logo_url = 'https://aynix.tech/wp-content/themes/aynix/assets/images/logo-white.svg';
    
    $html = '
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . esc_html($title) . '</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Inter", Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .email-header {
            background: linear-gradient(135deg, #438ef9 0%, #ff6331 100%);
            padding: 40px 20px;
            text-align: center;
        }
        .email-logo {
            max-width: 180px;
            height: auto;
            display: inline-block;
        }
        .email-body {
            padding: 40px 30px;
            color: #333333;
            line-height: 1.6;
        }
        .email-body h1 {
            color: #438ef9;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .email-body h2 {
            color: #438ef9;
            font-size: 20px;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        .email-body p {
            margin-bottom: 15px;
        }
        .cta-button {
            display: inline-block;
            padding: 15px 30px;
            background: linear-gradient(135deg, #438ef9 0%, #ff6331 100%);
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: 600;
        }
        .email-footer {
            background-color: #1a1a1a;
            color: #ffffff;
            padding: 30px;
            text-align: center;
            font-size: 14px;
        }
        .email-footer a {
            color: #438ef9;
            text-decoration: none;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #438ef9;
            padding: 15px 20px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-header">
            <img src="' . esc_url($logo_url) . '" alt="AYNIX" class="email-logo" style="max-width: 180px; height: auto; display: inline-block;">
            <!--[if mso]>
            <div style="font-family: \'Oxanium\', Arial, sans-serif; font-size: 36px; font-weight: 700; color: #ffffff; letter-spacing: 2px;">AYNIX</div>
            <![endif]-->
        </div>
        <div class="email-body">
            ' . $content . '
        </div>
        <div class="email-footer">
            <p><strong>AYNIX Tech</strong></p>
            <p>Sviluppiamo soluzioni software su misura</p>
            <p>
                <a href="https://aynix.tech">aynix.tech</a> | 
                <a href="mailto:admin@aynix.tech">admin@aynix.tech</a>
            </p>
            <p style="font-size: 12px; color: #999; margin-top: 20px;">
                Hai ricevuto questa email perché hai compilato il questionario sul nostro sito.
            </p>
        </div>
    </div>
</body>
</html>
    ';
    
    return $html;
}

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
        
        // Invia email all'admin con proposta e dati questionario
        send_admin_notification($user_email, $form_data, $ai_proposal, $post_id);
    } else {
        // Se OpenAI fallisce, invia comunque email base all'utente
        send_fallback_email($user_email);
        
        // Invia email all'admin senza proposta AI
        send_admin_notification($user_email, $form_data, null, $post_id);
        
        update_post_meta($post_id, 'ai_proposal_error', 'OpenAI API non disponibile');
    }
    
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
 * Invia email con proposta AI al cliente
 */
function send_proposal_email($to_email, $proposal, $form_data) {
    $subject = 'La Tua Proposta Personalizzata - AYNIX';
    
    $content = '
        <h1>🚀 La Tua Proposta Personalizzata</h1>
        <p>Ciao!</p>
        <p>Grazie per aver completato il nostro questionario. Abbiamo analizzato le tue esigenze e preparato una proposta su misura per il tuo progetto.</p>
        
        <div class="info-box">
            ' . nl2br(esc_html($proposal)) . '
        </div>
        
        <p><strong>Prossimi Passi:</strong></p>
        <ul>
            <li>Rispondi a questa email con le tue domande</li>
            <li>Prenota una call gratuita per discutere nel dettaglio</li>
            <li>Riceverai un preventivo dettagliato entro 24 ore</li>
        </ul>
        
        <p style="text-align: center;">
            <a href="https://aynix.tech/contatti" class="cta-button">Prenota una Call Gratuita</a>
        </p>
        
        <p>Non vediamo l\'ora di lavorare insieme!</p>
        <p><strong>Il Team AYNIX</strong></p>
    ';
    
    $html_message = aynix_email_template($content, 'La Tua Proposta Personalizzata');
    
    $headers = array(
        'From: AYNIX <admin@aynix.tech>',
        'Reply-To: admin@aynix.tech',
        'Content-Type: text/html; charset=UTF-8'
    );
    
    return wp_mail($to_email, $subject, $html_message, $headers);
}

/**
 * Invia email fallback se AI non disponibile
 */
function send_fallback_email($to_email) {
    $subject = 'Questionario Ricevuto - AYNIX';
    
    $content = '
        <h1>✅ Questionario Ricevuto!</h1>
        <p>Grazie per aver completato il nostro questionario!</p>
        <p>Abbiamo ricevuto le tue informazioni e il nostro team le sta analizzando attentamente.</p>
        
        <div class="info-box">
            <p><strong>📋 Cosa succede ora?</strong></p>
            <ul style="margin: 10px 0;">
                <li>Analizzeremo le tue esigenze in dettaglio</li>
                <li>Prepareremo una proposta personalizzata</li>
                <li>Ti contatteremo entro 24 ore</li>
            </ul>
        </div>
        
        <p>Nel frattempo, se hai domande urgenti puoi contattarci direttamente:</p>
        
        <p style="text-align: center;">
            <a href="https://aynix.tech/contatti" class="cta-button">Contattaci Ora</a>
        </p>
        
        <p>A presto!</p>
        <p><strong>Il Team AYNIX</strong></p>
    ';
    
    $html_message = aynix_email_template($content, 'Questionario Ricevuto');
    
    $headers = array(
        'From: AYNIX <admin@aynix.tech>',
        'Reply-To: admin@aynix.tech',
        'Content-Type: text/html; charset=UTF-8'
    );
    
    return wp_mail($to_email, $subject, $html_message, $headers);
}

/**
 * Invia notifica all'admin con dati questionario completi
 */
function send_admin_notification($user_email, $form_data, $ai_proposal = null, $post_id = 0) {
    $admin_email = get_option('admin_email');
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
        'From: AYNIX Sistema <admin@aynix.tech>',
        'Reply-To: ' . $user_email,
        'Content-Type: text/html; charset=UTF-8'
    );
    
    return wp_mail($admin_email, $subject, $html_message, $headers);
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
