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
                <a href="mailto:info@aynix.tech">info@aynix.tech</a>
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
            'intro' => 'Sei un consulente strategico di AYNIX che aiuta a comprendere e inquadrare problemi legati a software e processi digitali.',
            'analyze' => 'Analizza queste risposte del questionario diagnostico e identifica il problema principale che emerge:',
            'structure' => 'Scrivi un\'analisi in ITALIANO strutturata così:'
        ),
        'en' => array(
            'language' => 'ENGLISH',
            'intro' => 'You are a strategic consultant at AYNIX who helps understand and frame problems related to software and digital processes.',
            'analyze' => 'Analyze these diagnostic questionnaire responses and identify the main problem that emerges:',
            'structure' => 'Write an analysis in ENGLISH structured as follows:'
        ),
        'es' => array(
            'language' => 'ESPAÑOL',
            'intro' => 'Eres un consultor estratégico de AYNIX que ayuda a comprender y enmarcar problemas relacionados con software y procesos digitales.',
            'analyze' => 'Analiza estas respuestas del cuestionario diagnóstico e identifica el problema principal que surge:',
            'structure' => 'Escribe un análisis en ESPAÑOL estructurado así:'
        ),
        'pt' => array(
            'language' => 'PORTUGUÊS',
            'intro' => 'És um consultor estratégico da AYNIX que ajuda a compreender e enquadrar problemas relacionados com software e processos digitais.',
            'analyze' => 'Analisa estas respostas do questionário diagnóstico e identifica o problema principal que emerge:',
            'structure' => 'Escreve uma análise em PORTUGUÊS estruturada assim:'
        )
    );
    
    $lang = isset($lang_instructions[$user_lang]) ? $lang_instructions[$user_lang] : $lang_instructions['it'];
    $labels = isset($question_labels[$user_lang]) ? $question_labels[$user_lang] : $question_labels['it'];
    
    // Costruisci prompt per OpenAI con domande e risposte complete
    $prompt = $lang['intro'] . "\n\n" . $lang['analyze'] . "\n\n";
    
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
    
    $prompt .= "\n" . $lang['structure'] . "\n
1. **Il Nodo Principale**
   - Identifica in 2-3 righe qual è il problema/vincolo centrale che emerge dalla diagnosi
   - NON proporre soluzioni, solo comprensione del problema

2. **L'Impatto Oggi**
   - Descrivi l'impatto qualitativo di questo problema in termini di:
     * Tempo perso o inefficienza
     * Mancanza di controllo o visibilità
     * Complessità gestionale
     * Difficoltà a scalare o crescere
   - Usa linguaggio semplice e concreto, NO gergo tecnico

REGOLE FERME:
- Scrivi COMPLETAMENTE in " . $lang['language'] . "
- MENZIONA in modo tecnico SOLO per descrivere i modelli (Utente, Funzionalità, Flusso, etc.) ma NON tecnologie, stack, architetture
- NON proporre soluzioni o \"la soluzione che proponiamo\"
- NON parlare di \"prossimi passi\" o \"come procederemo\"
- NON menzionare prezzi, costi, tempistiche
- Focus esclusivo: PROBLEMA + IMPATTO
- Tono: empatico, comprensivo, consulenziale
- Lunghezza: massimo 200-250 parole";
    
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
                    'content' => 'Sei un consulente strategico di AYNIX specializzato nell\'analisi di problemi legati a software e processi digitali. Il tuo compito NON è proporre soluzioni, ma restituire comprensione del problema identificato. NON menzionare MAI tecnologie, stack, architetture o dettagli implementativi. Concentrati esclusivamente su: problema centrale + impatto qualitativo (tempo, controllo, complessità, scalabilità). Usa un tono empatico e consulenziale, linguaggio semplice e accessibile.'
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
            'subject' => 'La Tua Analisi Personalizzata - AYNIX [#' . $email_id . ']',
            'greeting' => 'Ciao ' . ($form_data['nome'] ?? '') . ',',
            'intro' => 'abbiamo analizzato le informazioni che hai condiviso nella diagnosi.<br>Sulla base di quanto emerge, ti restituiamo una prima lettura tecnico-operativa ad alto livello.',
            'section1_title' => 'Quadro attuale',
            'section1_text' => 'L\'operatività risulta sostenuta da attività manuali, passaggi informali e coordinamento diretto tra persone.<br>Questo approccio funziona, ma rende difficile:<br><br>• misurare in modo oggettivo cosa sta accadendo<br>• replicare i flussi quando il volume aumenta<br>• intervenire in modo strutturale sulle inefficienze',
            'section2_title' => 'Ipotesi di architettura operativa',
            'section2_intro' => 'In contesti simili, un percorso efficace tende a svilupparsi su tre livelli:',
            'section2_point1_title' => '1. Mappatura dei processi critici',
            'section2_point1_text' => 'Individuare i flussi che generano più carico operativo o più errori, distinguendo tra decisioni di valore e attività ripetitive.',
            'section2_point2_title' => '2. Standardizzazione e regole operative',
            'section2_point2_text' => 'Trasformare attività ricorrenti in flussi chiari, con stati, responsabilità e criteri di completamento espliciti.',
            'section2_point3_title' => '3. Automazioni mirate e tracciabili',
            'section2_point3_text' => 'Introdurre automazioni solo dove riducono davvero attrito, errori o tempi morti, mantenendo piena visibilità e controllo.',
            'section2_objective' => 'L\'obiettivo non è la tecnologia in sé, ma rendere il sistema leggibile, governabile e scalabile.',
            'section3_title' => 'Risultato atteso',
            'section3_text' => 'Quando questo approccio è ben calibrato, tende a portare:<br><br>• maggiore controllo sui processi<br>• riduzione delle eccezioni gestite "a mano"<br>• migliore allineamento tra operatività e crescita',
            'section4_title' => 'Nota importante',
            'section4_text' => 'Questa non è una proposta né una soluzione definitiva.<br>È una ipotesi tecnica iniziale, basata esclusivamente sulle informazioni disponibili oggi.<br><br>Prima di formalizzare qualsiasi intervento, è necessario validare:<br><br>• l\'aderenza al tuo contesto reale<br>• le priorità operative<br>• i vincoli di tempo e risorse',
            'section5_title' => 'Prossimo passo',
            'section5_text' => 'Se vuoi, possiamo fare una call breve (15–20 minuti) per:<br><br>• verificare se questa architettura è sensata per te<br>• capire quali processi toccare per primi<br>• valutare se evolvere verso una proposta strutturata',
            'cta_button' => '👉 Richiedi di essere contattato',
            'closing' => 'Un saluto,',
            'team' => 'Team AYNIX',
            'email_title' => 'Risultato Diagnosi'
        ),
        'en' => array(
            'subject' => 'Your Personalized Analysis - AYNIX [#' . $email_id . ']',
            'greeting' => 'Hello ' . ($form_data['nome'] ?? '') . ',',
            'intro' => 'we have analyzed the information you shared in the diagnosis.<br>Based on what emerges, we provide you with an initial high-level technical-operational reading.',
            'section1_title' => 'Current Situation',
            'section1_text' => 'Operations are sustained by manual activities, informal steps, and direct coordination between people.<br>This approach works, but makes it difficult to:<br><br>• objectively measure what is happening<br>• replicate flows when volume increases<br>• intervene structurally on inefficiencies',
            'section2_title' => 'Operational Architecture Hypothesis',
            'section2_intro' => 'In similar contexts, an effective path tends to develop on three levels:',
            'section2_point1_title' => '1. Mapping critical processes',
            'section2_point1_text' => 'Identify flows that generate more operational load or errors, distinguishing between value decisions and repetitive activities.',
            'section2_point2_title' => '2. Standardization and operational rules',
            'section2_point2_text' => 'Transform recurring activities into clear flows, with explicit states, responsibilities, and completion criteria.',
            'section2_point3_title' => '3. Targeted and traceable automation',
            'section2_point3_text' => 'Introduce automation only where it truly reduces friction, errors, or downtime, while maintaining full visibility and control.',
            'section2_objective' => 'The goal is not technology itself, but making the system readable, governable, and scalable.',
            'section3_title' => 'Expected Result',
            'section3_text' => 'When this approach is well calibrated, it tends to bring:<br><br>• greater process control<br>• reduction of exceptions handled "manually"<br>• better alignment between operations and growth',
            'section4_title' => 'Important Note',
            'section4_text' => 'This is neither a proposal nor a definitive solution.<br>It is an initial technical hypothesis, based exclusively on the information available today.<br><br>Before formalizing any intervention, it is necessary to validate:<br><br>• adherence to your real context<br>• operational priorities<br>• time and resource constraints',
            'section5_title' => 'Next Step',
            'section5_text' => 'If you wish, we can have a brief call (15–20 minutes) to:<br><br>• verify if this architecture makes sense for you<br>• understand which processes to address first<br>• evaluate whether to evolve toward a structured proposal',
            'cta_button' => '👉 Request to be contacted',
            'closing' => 'Best regards,',
            'team' => 'AYNIX Team',
            'email_title' => 'Diagnosis Result'
        ),
        'es' => array(
            'subject' => 'Tu Análisis Personalizado - AYNIX [#' . $email_id . ']',
            'greeting' => 'Hola ' . ($form_data['nome'] ?? '') . ',',
            'intro' => 'hemos analizado la información que compartiste en el diagnóstico.<br>Según lo que surge, te devolvemos una primera lectura técnico-operativa de alto nivel.',
            'section1_title' => 'Situación Actual',
            'section1_text' => 'La operativa está sostenida por actividades manuales, pasos informales y coordinación directa entre personas.<br>Este enfoque funciona, pero dificulta:<br><br>• medir objetivamente lo que está sucediendo<br>• replicar los flujos cuando el volumen aumenta<br>• intervenir estructuralmente en las ineficiencias',
            'section2_title' => 'Hipótesis de Arquitectura Operativa',
            'section2_intro' => 'En contextos similares, un camino eficaz tiende a desarrollarse en tres niveles:',
            'section2_point1_title' => '1. Mapeo de procesos críticos',
            'section2_point1_text' => 'Identificar los flujos que generan más carga operativa o más errores, distinguiendo entre decisiones de valor y actividades repetitivas.',
            'section2_point2_title' => '2. Estandarización y reglas operativas',
            'section2_point2_text' => 'Transformar actividades recurrentes en flujos claros, con estados, responsabilidades y criterios de finalización explícitos.',
            'section2_point3_title' => '3. Automatizaciones específicas y rastreables',
            'section2_point3_text' => 'Introducir automatizaciones solo donde realmente reducen fricción, errores o tiempos muertos, manteniendo plena visibilidad y control.',
            'section2_objective' => 'El objetivo no es la tecnología en sí, sino hacer el sistema legible, gobernable y escalable.',
            'section3_title' => 'Resultado Esperado',
            'section3_text' => 'Cuando este enfoque está bien calibrado, tiende a aportar:<br><br>• mayor control de los procesos<br>• reducción de excepciones gestionadas "a mano"<br>• mejor alineación entre operativa y crecimiento',
            'section4_title' => 'Nota Importante',
            'section4_text' => 'Esto no es una propuesta ni una solución definitiva.<br>Es una hipótesis técnica inicial, basada exclusivamente en la información disponible hoy.<br><br>Antes de formalizar cualquier intervención, es necesario validar:<br><br>• la adherencia a tu contexto real<br>• las prioridades operativas<br>• las restricciones de tiempo y recursos',
            'section5_title' => 'Próximo Paso',
            'section5_text' => 'Si quieres, podemos hacer una llamada breve (15–20 minutos) para:<br><br>• verificar si esta arquitectura tiene sentido para ti<br>• entender qué procesos abordar primero<br>• evaluar si evolucionar hacia una propuesta estructurada',
            'cta_button' => '👉 Solicitar ser contactado',
            'closing' => 'Un saludo,',
            'team' => 'Equipo AYNIX',
            'email_title' => 'Resultado Diagnóstico'
        ),
        'pt' => array(
            'subject' => 'A Sua Análise Personalizada - AYNIX [#' . $email_id . ']',
            'greeting' => 'Olá ' . ($form_data['nome'] ?? '') . ',',
            'intro' => 'analisámos as informações que partilhou no diagnóstico.<br>Com base no que emerge, devolvemos uma primeira leitura técnico-operacional de alto nível.',
            'section1_title' => 'Situação Atual',
            'section1_text' => 'A operação é sustentada por atividades manuais, passos informais e coordenação direta entre pessoas.<br>Esta abordagem funciona, mas torna difícil:<br><br>• medir objetivamente o que está a acontecer<br>• replicar os fluxos quando o volume aumenta<br>• intervir estruturalmente nas ineficiências',
            'section2_title' => 'Hipótese de Arquitetura Operacional',
            'section2_intro' => 'Em contextos semelhantes, um caminho eficaz tende a desenvolver-se em três níveis:',
            'section2_point1_title' => '1. Mapeamento de processos críticos',
            'section2_point1_text' => 'Identificar os fluxos que geram mais carga operacional ou mais erros, distinguindo entre decisões de valor e atividades repetitivas.',
            'section2_point2_title' => '2. Padronização e regras operacionais',
            'section2_point2_text' => 'Transformar atividades recorrentes em fluxos claros, com estados, responsabilidades e critérios de conclusão explícitos.',
            'section2_point3_title' => '3. Automações direcionadas e rastreáveis',
            'section2_point3_text' => 'Introduzir automações apenas onde realmente reduzem atrito, erros ou tempos mortos, mantendo plena visibilidade e controlo.',
            'section2_objective' => 'O objetivo não é a tecnologia em si, mas tornar o sistema legível, governável e escalável.',
            'section3_title' => 'Resultado Esperado',
            'section3_text' => 'Quando esta abordagem está bem calibrada, tende a trazer:<br><br>• maior controlo dos processos<br>• redução de exceções geridas "manualmente"<br>• melhor alinhamento entre operação e crescimento',
            'section4_title' => 'Nota Importante',
            'section4_text' => 'Isto não é uma proposta nem uma solução definitiva.<br>É uma hipótese técnica inicial, baseada exclusivamente nas informações disponíveis hoje.<br><br>Antes de formalizar qualquer intervenção, é necessário validar:<br><br>• a aderência ao seu contexto real<br>• as prioridades operacionais<br>• as restrições de tempo e recursos',
            'section5_title' => 'Próximo Passo',
            'section5_text' => 'Se quiser, podemos fazer uma chamada breve (15–20 minutos) para:<br><br>• verificar se esta arquitetura faz sentido para si<br>• perceber quais processos abordar primeiro<br>• avaliar se evoluir para uma proposta estruturada',
            'cta_button' => '👉 Solicitar ser contactado',
            'closing' => 'Cumprimentos,',
            'team' => 'Equipa AYNIX',
            'email_title' => 'Resultado Diagnóstico'
        )
    );
    
    $t = $translations[$lang];
    
    // Genera parametro email per pre-compilare il form
    $email_param = urlencode($to_email);
    
    $content = '
        <p>' . $t['greeting'] . '</p>
        <p>' . $t['intro'] . '</p>
        
        <h2 style="margin-top: 30px; margin-bottom: 15px; font-size: 18px; font-weight: bold;">' . $t['section1_title'] . '</h2>
        <p>' . $t['section1_text'] . '</p>
        
        <h2 style="margin-top: 30px; margin-bottom: 15px; font-size: 18px; font-weight: bold;">' . $t['section2_title'] . '</h2>
        <p>' . $t['section2_intro'] . '</p>
        
        <div style="margin: 20px 0;">
            <p style="margin-bottom: 10px;"><strong>' . $t['section2_point1_title'] . '</strong><br>' . $t['section2_point1_text'] . '</p>
            <p style="margin-bottom: 10px;"><strong>' . $t['section2_point2_title'] . '</strong><br>' . $t['section2_point2_text'] . '</p>
            <p style="margin-bottom: 10px;"><strong>' . $t['section2_point3_title'] . '</strong><br>' . $t['section2_point3_text'] . '</p>
        </div>
        
        <p>' . $t['section2_objective'] . '</p>
        
        <h2 style="margin-top: 30px; margin-bottom: 15px; font-size: 18px; font-weight: bold;">' . $t['section3_title'] . '</h2>
        <p>' . $t['section3_text'] . '</p>
        
        <h2 style="margin-top: 30px; margin-bottom: 15px; font-size: 18px; font-weight: bold;">' . $t['section4_title'] . '</h2>
        <p>' . $t['section4_text'] . '</p>
        
        <h2 style="margin-top: 30px; margin-bottom: 15px; font-size: 18px; font-weight: bold;">' . $t['section5_title'] . '</h2>
        <p>' . $t['section5_text'] . '</p>
        
        <p style="text-align: center; margin: 30px 0;">
            <a href="https://aynix.tech/richiesta-contatto?email=' . $email_param . '" class="cta-button" style="font-size: 18px; padding: 18px 40px;">' . $t['cta_button'] . '</a>
        </p>
        
        <p>' . $t['closing'] . '</p>
        <p><strong>' . $t['team'] . '</strong></p>
    ';
    
    $html_message = aynix_email_template($content, $t['email_title']);
    
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
            'time_value' => '24-48 ore',
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
            'time_value' => '24-48 hours',
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
            'time_value' => '24-48 horas',
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
            'time_value' => '24-48 horas',
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
    
    $html_message = aynix_email_template($content, $t['email_title']);
    
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
        'From: AYNIX Sistema <info@aynix.tech>',
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
        'From: AYNIX <info@aynix.tech>',
        'Reply-To: info@aynix.tech',
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
