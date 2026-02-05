<?php
/**
 * Plugin Name: AYNIX Chatbot AI
 * Plugin URI: https://aynix.tech
 * Description: Chatbot AI multilingua per assistenza e navigazione sul sito AYNIX
 * Version: 2.2.6
 * Version: 2.2.3
 * Author: AYNIX Tech
 * Author URI: https://aynix.tech
 * Text Domain: aynix-chatbot-ai
 * License: GPL v2 or later
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class AYNIX_Chatbot_AI {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        error_log('AYNIX Chatbot: Constructor called');
        
        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
        
        // Add chatbot HTML to footer
        add_action('wp_footer', array($this, 'render_chatbot'));
        
        // AJAX handlers
        add_action('wp_ajax_aynix_chatbot_message', array($this, 'handle_chat_message'));
        add_action('wp_ajax_nopriv_aynix_chatbot_message', array($this, 'handle_chat_message'));
        
        error_log('AYNIX Chatbot: All hooks registered');
    }
    
    public function enqueue_assets() {
        // Debug log
        error_log('AYNIX Chatbot: enqueue_assets called');
        
        // CSS
        wp_enqueue_style(
            'aynix-chatbot-css',
            plugin_dir_url(__FILE__) . 'assets/css/chatbot.css',
            array(),
            '1.1.0'
        );
        
        // JavaScript sin dependencia de jQuery
        wp_enqueue_script(
            'aynix-chatbot-js',
            plugin_dir_url(__FILE__) . 'assets/js/chatbot.js',
            array(), // Sin dependencias
            '2.2.6',
            true
        );
        
        error_log('AYNIX Chatbot: Scripts enqueued - CSS and JS (Vanilla JavaScript)');
        
        // Localize script con traduzioni e AJAX URL
        $current_lang = $this->detect_language();
        
        // Pasar TODAS las traducciones para permitir cambio dinámico de idioma
        wp_localize_script('aynix-chatbot-js', 'aynixChatbot', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('aynix_chatbot_nonce'),
            'lang' => $current_lang,
            'allTranslations' => array(
                'it' => $this->get_translations('it'),
                'en' => $this->get_translations('en'),
                'es' => $this->get_translations('es'),
                'pt' => $this->get_translations('pt')
            ),
            'translations' => $this->get_translations($current_lang)
        ));
    }
    
    private function normalize_lang($lang) {
        if (!$lang) {
            return 'it';
        }
        $normalized = strtolower((string) $lang);
        if (strpos($normalized, '-') !== false) {
            $parts = explode('-', $normalized);
            $normalized = $parts[0];
        }
        if (strpos($normalized, '_') !== false) {
            $parts = explode('_', $normalized);
            $normalized = $parts[0];
        }
        if (strlen($normalized) > 2) {
            $normalized = substr($normalized, 0, 2);
        }
        $allowed = array('it', 'en', 'es', 'pt');
        if (!in_array($normalized, $allowed, true)) {
            return 'it';
        }
        return $normalized;
    }

    private function detect_language() {
        // Cerca parametro URL lang
        if (isset($_GET['lang'])) {
            $url_lang = $this->normalize_lang(sanitize_text_field($_GET['lang']));
            if ($url_lang) {
                return $url_lang;
            }
        }
        
        // Cerca cookie o session
        if (isset($_COOKIE['aynix_lang'])) {
            $cookie_lang = $this->normalize_lang(sanitize_text_field($_COOKIE['aynix_lang']));
            if ($cookie_lang) {
                return $cookie_lang;
            }
        }

        // Locale del sito/utente
        $locale = function_exists('determine_locale') ? determine_locale() : get_locale();
        $locale_lang = $this->normalize_lang($locale);
        if ($locale_lang) {
            return $locale_lang;
        }
        
        // Default italiano
        return 'it';
    }
    
    private function get_translations($lang) {
        $translations = array(
            'it' => array(
                'chatTitle' => 'Assistente AYNIX',
                'placeholder' => 'Scrivi un messaggio...',
                'sendButton' => 'Invia',
                'welcomeMessage' => 'Ciao! 👋 Sono l\'assistente virtuale di AYNIX. Posso aiutarti a navigare il sito, scoprire i nostri servizi o rispondere alle tue domande. Come posso aiutarti?',
                'errorMessage' => 'Si è verificato un errore. Riprova per favore.',
                'typingIndicator' => 'Sto scrivendo...',
                'closeChat' => 'Chiudi chat'
            ),
            'en' => array(
                'chatTitle' => 'AYNIX Assistant',
                'placeholder' => 'Type a message...',
                'sendButton' => 'Send',
                'welcomeMessage' => 'Hello! 👋 I\'m AYNIX virtual assistant. I can help you navigate the site, discover our services or answer your questions. How can I help you?',
                'errorMessage' => 'An error occurred. Please try again.',
                'typingIndicator' => 'Typing...',
                'closeChat' => 'Close chat'
            ),
            'es' => array(
                'chatTitle' => 'Asistente AYNIX',
                'placeholder' => 'Escribe un mensaje...',
                'sendButton' => 'Enviar',
                'welcomeMessage' => '¡Hola! 👋 Soy el asistente virtual de AYNIX. Puedo ayudarte a navegar el sitio, descubrir nuestros servicios o responder a tus preguntas. ¿Cómo puedo ayudarte?',
                'errorMessage' => 'Se produjo un error. Por favor, inténtalo de nuevo.',
                'typingIndicator' => 'Escribiendo...',
                'closeChat' => 'Cerrar chat'
            ),
            'pt' => array(
                'chatTitle' => 'Assistente AYNIX',
                'placeholder' => 'Escreve uma mensagem...',
                'sendButton' => 'Enviar',
                'welcomeMessage' => 'Olá! 👋 Sou o assistente virtual da AYNIX. Posso ajudá-lo a navegar no site, descobrir os nossos serviços ou responder às suas perguntas. Como posso ajudar?',
                'errorMessage' => 'Ocorreu um erro. Por favor, tente novamente.',
                'typingIndicator' => 'A escrever...',
                'closeChat' => 'Fechar chat'
            )
        );
        
        return isset($translations[$lang]) ? $translations[$lang] : $translations['it'];
    }
    
    public function render_chatbot() {
        // Evitar renderizar dos veces
        static $rendered = false;
        
        if ($rendered) {
            error_log('AYNIX Chatbot: Already rendered, skipping duplicate render');
            return;
        }
        
        $rendered = true;
        
        error_log('AYNIX Chatbot: render_chatbot() called');
        
        $lang = $this->detect_language();
        $t = $this->get_translations($lang);
        
        error_log('AYNIX Chatbot: Rendering HTML for language: ' . $lang);
        ?>
        <!-- AYNIX Chatbot Start -->
        <script>
            console.log('AYNIX Chatbot: HTML rendered in footer');
            console.log('AYNIX Chatbot: jQuery loaded?', typeof jQuery !== 'undefined');
        </script>
        <div id="aynix-chatbot-container">
            <!-- Pulsante floating -->
            <button id="aynix-chatbot-toggle" aria-label="<?php echo esc_attr($t['chatTitle']); ?>">
                <svg class="chat-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
                    <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/>
                </svg>
                <svg class="close-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="28" height="28">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </svg>
            </button>
            
            <!-- Widget chatbot -->
            <div id="aynix-chatbot-widget">
                <div class="chatbot-header">
                    <div class="chatbot-title">
                        <div class="chatbot-avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                            </svg>
                        </div>
                        <span><?php echo esc_html($t['chatTitle']); ?></span>
                    </div>
                    <button class="chatbot-minimize" aria-label="<?php echo esc_attr($t['closeChat']); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                            <path d="M19 13H5v-2h14v2z"/>
                        </svg>
                    </button>
                </div>
                
                <div class="chatbot-messages" id="aynix-chatbot-messages">
                    <div class="message bot-message">
                        <div class="message-content"><?php echo esc_html($t['welcomeMessage']); ?></div>
                    </div>
                </div>
                
                <div class="chatbot-input-area">
                    <input 
                        type="text" 
                        id="aynix-chatbot-input" 
                        class="chatbot-input" 
                        placeholder="<?php echo esc_attr($t['placeholder']); ?>"
                        autocomplete="off"
                    >
                    <button id="aynix-chatbot-send" class="chatbot-send-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- AYNIX Chatbot End -->
        <?php
        error_log('AYNIX Chatbot: HTML rendered successfully');
    }
    
    public function handle_chat_message() {
        check_ajax_referer('aynix_chatbot_nonce', 'nonce');
        
        $user_message = isset($_POST['message']) ? sanitize_text_field($_POST['message']) : '';
        $user_lang = isset($_POST['lang']) ? sanitize_text_field($_POST['lang']) : 'it';
        
        if (empty($user_message)) {
            wp_send_json_error(array('message' => 'Message is required'));
            return;
        }
        
        // Genera risposta AI
        $ai_response = $this->generate_ai_response($user_message, $user_lang);
        
        if ($ai_response) {
            wp_send_json_success(array('response' => $ai_response));
        } else {
            wp_send_json_error(array('message' => 'AI response failed'));
        }
    }
    
    private function generate_ai_response($user_message, $lang) {
        // Usa la stessa API key del tema
        if (!defined('OPENAI_API_KEY')) {
            error_log('AYNIX Chatbot: OpenAI API Key non configurata');
            return false;
        }
        
        $api_key = OPENAI_API_KEY;
        
        // Context awareness - informazioni sul sito
        $site_context = $this->get_site_context($lang);
        
        $system_message = $this->get_system_message($lang, $site_context);
        
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
                        'content' => $system_message
                    ),
                    array(
                        'role' => 'user',
                        'content' => $user_message
                    )
                ),
                'temperature' => 0.7,
                'max_tokens' => 500
            )),
            'timeout' => 30,
        ));
        
        if (is_wp_error($response)) {
            error_log('AYNIX Chatbot OpenAI Error: ' . $response->get_error_message());
            return false;
        }
        
        $body = json_decode(wp_remote_retrieve_body($response), true);
        
        if (isset($body['choices'][0]['message']['content'])) {
            return $body['choices'][0]['message']['content'];
        }
        
        return false;
    }
    
    private function get_site_context($lang) {
        $contexts = array(
            'it' => array(
                'company' => 'AYNIX è un\'azienda che sviluppa soluzioni software personalizzate',
                'services' => 'Offriamo sviluppo software su misura, automazione processi, consulenza tecnologica',
                'products' => 'SafeFleet (gestione flotte), Navenza (logistica last-mile), Pinguito (marketplace)',
                'pages' => array(
                    'Home' => home_url('/'),
                    'Soluzioni' => home_url('/soluzioni'),
                    'Esperienze' => home_url('/esperienze'),
                    'Team' => home_url('/team'),
                    'Questionario Diagnosi' => home_url('/questionario'),
                    'Contattaci' => home_url('/contattaci')
                ),
                'cta' => 'Consiglia sempre di compilare il questionario diagnosi per ricevere un\'analisi AI personalizzata'
            ),
            'en' => array(
                'company' => 'AYNIX is a company that develops custom software solutions',
                'services' => 'We offer custom software development, process automation, technology consulting',
                'products' => 'SafeFleet (fleet management), Navenza (last-mile logistics), Pinguito (marketplace)',
                'pages' => array(
                    'Home' => home_url('/'),
                    'Solutions' => home_url('/soluzioni'),
                    'Experiences' => home_url('/esperienze'),
                    'Team' => home_url('/team'),
                    'Diagnostic Questionnaire' => home_url('/questionario'),
                    'Contact Us' => home_url('/contattaci')
                ),
                'cta' => 'Always recommend completing the diagnostic questionnaire to receive a personalized AI analysis'
            ),
            'es' => array(
                'company' => 'AYNIX es una empresa que desarrolla soluciones de software personalizadas',
                'services' => 'Ofrecemos desarrollo de software a medida, automatización de procesos, consultoría tecnológica',
                'products' => 'SafeFleet (gestión de flotas), Navenza (logística última milla), Pinguito (marketplace)',
                'pages' => array(
                    'Inicio' => home_url('/'),
                    'Soluciones' => home_url('/soluzioni'),
                    'Experiencias' => home_url('/esperienze'),
                    'Equipo' => home_url('/team'),
                    'Cuestionario Diagnóstico' => home_url('/questionario'),
                    'Contáctanos' => home_url('/contattaci')
                ),
                'cta' => 'Recomienda siempre completar el cuestionario diagnóstico para recibir un análisis AI personalizado'
            ),
            'pt' => array(
                'company' => 'AYNIX é uma empresa que desenvolve soluções de software personalizadas',
                'services' => 'Oferecemos desenvolvimento de software personalizado, automatização de processos, consultoria tecnológica',
                'products' => 'SafeFleet (gestão de frotas), Navenza (logística última milha), Pinguito (marketplace)',
                'pages' => array(
                    'Início' => home_url('/'),
                    'Soluções' => home_url('/soluzioni'),
                    'Experiências' => home_url('/esperienze'),
                    'Equipa' => home_url('/team'),
                    'Questionário Diagnóstico' => home_url('/questionario'),
                    'Contacte-nos' => home_url('/contattaci')
                ),
                'cta' => 'Recomenda sempre preencher o questionário diagnóstico para receber uma análise AI personalizada'
            )
        );
        
        return isset($contexts[$lang]) ? $contexts[$lang] : $contexts['it'];
    }
    
    private function get_system_message($lang, $context) {
        $messages = array(
            'it' => "Sei l'assistente virtuale del sito AYNIX, un'azienda di sviluppo software.

INFORMAZIONI AZIENDA:
- {$context['company']}
- Servizi: {$context['services']}
- Prodotti: {$context['products']}

PAGINE DISPONIBILI:
" . implode("\n", array_map(function($name, $url) {
                return "- {$name}: {$url}";
            }, array_keys($context['pages']), $context['pages'])) . "

TUO COMPITO:
1. Aiutare gli utenti a navigare il sito
2. Rispondere a domande sui servizi AYNIX
3. Guidare verso il questionario diagnosi
4. Fornire assistenza generale

REGOLE:
- Rispondi SEMPRE in italiano
- Sii conciso (max 2-3 frasi)
- Se l'utente cerca informazioni tecniche dettagliate, suggerisci il questionario diagnosi
- Fornisci link alle pagine quando pertinente
- Tono: professionale ma amichevole
- Non inventare informazioni non fornite nel contesto

IMPORTANTE: {$context['cta']}",

            'en' => "You are the virtual assistant for AYNIX website, a software development company.

COMPANY INFORMATION:
- {$context['company']}
- Services: {$context['services']}
- Products: {$context['products']}

AVAILABLE PAGES:
" . implode("\n", array_map(function($name, $url) {
                return "- {$name}: {$url}";
            }, array_keys($context['pages']), $context['pages'])) . "

YOUR TASK:
1. Help users navigate the site
2. Answer questions about AYNIX services
3. Guide towards the diagnostic questionnaire
4. Provide general assistance

RULES:
- ALWAYS respond in English
- Be concise (max 2-3 sentences)
- If user seeks detailed technical information, suggest the diagnostic questionnaire
- Provide page links when relevant
- Tone: professional but friendly
- Don't invent information not provided in context

IMPORTANT: {$context['cta']}",

            'es' => "Eres el asistente virtual del sitio AYNIX, una empresa de desarrollo de software.

INFORMACIÓN DE LA EMPRESA:
- {$context['company']}
- Servicios: {$context['services']}
- Productos: {$context['products']}

PÁGINAS DISPONIBLES:
" . implode("\n", array_map(function($name, $url) {
                return "- {$name}: {$url}";
            }, array_keys($context['pages']), $context['pages'])) . "

TU TAREA:
1. Ayudar a los usuarios a navegar el sitio
2. Responder preguntas sobre los servicios de AYNIX
3. Guiar hacia el cuestionario diagnóstico
4. Proporcionar asistencia general

REGLAS:
- SIEMPRE responde en español
- Sé conciso (máx 2-3 frases)
- Si el usuario busca información técnica detallada, sugiere el cuestionario diagnóstico
- Proporciona enlaces a páginas cuando sea relevante
- Tono: profesional pero amigable
- No inventes información no proporcionada en el contexto

IMPORTANTE: {$context['cta']}",

            'pt' => "És o assistente virtual do site AYNIX, uma empresa de desenvolvimento de software.

INFORMAÇÃO DA EMPRESA:
- {$context['company']}
- Serviços: {$context['services']}
- Produtos: {$context['products']}

PÁGINAS DISPONÍVEIS:
" . implode("\n", array_map(function($name, $url) {
                return "- {$name}: {$url}";
            }, array_keys($context['pages']), $context['pages'])) . "

A TUA TAREFA:
1. Ajudar os utilizadores a navegar no site
2. Responder a perguntas sobre os serviços AYNIX
3. Orientar para o questionário diagnóstico
4. Fornecer assistência geral

REGRAS:
- SEMPRE responde em português
- Sê conciso (máx 2-3 frases)
- Se o utilizador procura informações técnicas detalhadas, sugere o questionário diagnóstico
- Fornece links para páginas quando relevante
- Tom: profissional mas amigável
- Não inventes informação não fornecida no contexto

IMPORTANTE: {$context['cta']}"
        );
        
        return isset($messages[$lang]) ? $messages[$lang] : $messages['it'];
    }
}

// Initialize plugin
function aynix_chatbot_ai_init() {
    return AYNIX_Chatbot_AI::get_instance();
}

add_action('plugins_loaded', 'aynix_chatbot_ai_init');
