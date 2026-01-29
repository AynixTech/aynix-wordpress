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
    // URL assoluto del logo (PNG invece di SVG per compatibilità client email)
    $logo_url = 'https://aynix.tech/wp-content/uploads/2025/03/logo_aynix_white-768x274.png';
    
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
    
    // PRIMA EMAIL: Invia SEMPRE email di conferma immediata (prima della risposta)
    send_confirmation_email($user_email);
    
    // Schedula elaborazione AI e seconda email in background
    wp_schedule_single_event(time() + 10, 'process_diagnosis_ai', array($post_id, $user_email, $form_data));
    
    // RISPOSTA IMMEDIATA all'utente
    wp_send_json_success(array(
        'post_id' => $post_id,
        'message' => 'Questionario ricevuto con successo'
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
 * Invia email con proposta AI al cliente (SECONDA EMAIL - dopo analisi)
 */
function send_proposal_email($to_email, $proposal, $form_data) {
    $subject = 'La Tua Analisi Personalizzata - AYNIX';
    
    // Genera parametro email per pre-compilare il form
    $email_param = urlencode($to_email);
    
    $content = '
        <h1>🚀 Abbiamo Analizzato il Tuo Progetto</h1>
        <p>Ciao!</p>
        <p>Abbiamo completato l\'analisi del questionario che hai compilato. Ecco cosa abbiamo capito del tuo progetto:</p>
        
        <div class="info-box">
            ' . nl2br(esc_html($proposal)) . '
        </div>
        
        <h2>💡 Sei interessato a procedere?</h2>
        <p>Se vuoi discutere questa analisi e capire i prossimi passi concreti, clicca il pulsante qui sotto per richiedere un contatto:</p>
        
        <p style="text-align: center; margin: 30px 0;">
            <a href="https://aynix.tech/richiesta-contatto?email=' . $email_param . '" class="cta-button" style="font-size: 18px; padding: 18px 40px;">📞 Richiedi di Essere Contattato</a>
        </p>
        
        <p style="font-size: 14px; color: #666;">Compila il form con i tuoi dati e ti contatteremo per fissare una call gratuita di 15-20 minuti.</p>
        
        <p>A presto!</p>
        <p><strong>Il Team AYNIX</strong></p>
    ';
    
    $html_message = aynix_email_template($content, 'La Tua Analisi Personalizzata');
    
    $headers = array(
        'From: AYNIX <admin@aynix.tech>',
        'Reply-To: admin@aynix.tech',
        'Content-Type: text/html; charset=UTF-8'
    );
    
    return wp_mail($to_email, $subject, $html_message, $headers);
}

/**
 * Invia email immediata di conferma ricezione questionario (PRIMA EMAIL)
 */
function send_confirmation_email($to_email) {
    $subject = 'Grazie per aver compilato il questionario - AYNIX';
    
    $content = '
        <h1>✅ Questionario Ricevuto</h1>
        <p>Grazie per aver completato il nostro questionario!</p>
        <p>Abbiamo ricevuto le tue informazioni e le stiamo analizzando.</p>
        
        <div class="info-box">
            <p><strong>📋 Cosa succede ora?</strong></p>
            <ul style="margin: 10px 0;">
                <li>Analizziamo le tue esigenze</li>
                <li>Valutiamo se e come possiamo aiutarti</li>
                <li>Ti ricontattiamo solo se c\'è valore reale</li>
            </ul>
        </div>
        
        <p><strong>Tempo stimato:</strong> 24-48 ore</p>
        
        <p><strong>Nota importante:</strong> Non riceverai proposte commerciali automatiche. Ti contatteremo solo se riteniamo di poter davvero aiutarti.</p>
        
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
    send_contact_request_notification($nome, $cognome, $email, $telefono, $azienda, $note, $post_id);
    
    // Invia conferma al cliente
    send_contact_request_confirmation($email, $nome);
    
    wp_send_json_success(array('message' => 'Richiesta inviata con successo'));
}

add_action('wp_ajax_submit_contact_request', 'submit_contact_request_handler');
add_action('wp_ajax_nopriv_submit_contact_request', 'submit_contact_request_handler');

/**
 * Invia notifica admin per richiesta contatto
 */
function send_contact_request_notification($nome, $cognome, $email, $telefono, $azienda, $note, $post_id) {
    $admin_email = get_option('admin_email');
    $subject = '📞 Nuova Richiesta di Contatto - AYNIX';
    
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
        
        <p><strong>⚡ Azione richiesta:</strong> Contatta il cliente entro 24-48 ore per fissare la call.</p>
    ';
    
    $html_message = aynix_email_template($content, 'Nuova Richiesta di Contatto');
    
    $headers = array(
        'From: AYNIX Sistema <admin@aynix.tech>',
        'Reply-To: ' . $email,
        'Content-Type: text/html; charset=UTF-8'
    );
    
    return wp_mail($admin_email, $subject, $html_message, $headers);
}

/**
 * Invia conferma al cliente per richiesta contatto
 */
function send_contact_request_confirmation($email, $nome) {
    $subject = 'Richiesta Ricevuta - Ti Contatteremo Presto - AYNIX';
    
    $content = '
        <h1>✅ Richiesta Ricevuta</h1>
        <p>Ciao ' . esc_html($nome) . ',</p>
        <p>Abbiamo ricevuto la tua richiesta di essere contattato.</p>
        
        <div class="info-box">
            <p><strong>📞 Cosa succede ora?</strong></p>
            <ul style="margin: 10px 0;">
                <li>Ti contatteremo entro 24-48 ore</li>
                <li>Fisseremo una call gratuita di 15-20 minuti</li>
                <li>Discuteremo il tuo progetto in dettaglio</li>
            </ul>
        </div>
        
        <p><strong>Preparati per la call:</strong></p>
        <ul>
            <li>Pensa agli obiettivi principali del progetto</li>
            <li>Identifica le criticità che vuoi risolvere</li>
            <li>Annota eventuali domande specifiche</li>
        </ul>
        
        <p>A presto!</p>
        <p><strong>Il Team AYNIX</strong></p>
    ';
    
    $html_message = aynix_email_template($content, 'Richiesta Ricevuta');
    
    $headers = array(
        'From: AYNIX <admin@aynix.tech>',
        'Reply-To: admin@aynix.tech',
        'Content-Type: text/html; charset=UTF-8'
    );
    
    return wp_mail($email, $subject, $html_message, $headers);
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
                echo '<button type="button" class="button button-small view-ai-proposal" data-post-id="' . $post_id . '">📄 Visualizza Proposta</button>';
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
function process_diagnosis_ai_background($post_id, $user_email, $form_data) {
    // Genera proposta AI con OpenAI
    $ai_proposal = generate_ai_proposal($form_data);
    
    if ($ai_proposal) {
        update_post_meta($post_id, 'ai_proposal', $ai_proposal);
        
        // SECONDA EMAIL: Invia email con proposta AI e CTA per richiesta contatto
        send_proposal_email($user_email, $ai_proposal, $form_data);
        
        // Invia email all'admin con proposta e dati questionario
        send_admin_notification($user_email, $form_data, $ai_proposal, $post_id);
    } else {
        // Se OpenAI fallisce, invia comunque notifica all'admin
        send_admin_notification($user_email, $form_data, null, $post_id);
        
        update_post_meta($post_id, 'ai_proposal_error', 'OpenAI API non disponibile');
    }
}
add_action('process_diagnosis_ai', 'process_diagnosis_ai_background', 10, 3);
?>
