<?php
/**
 * AYNIX GDPR Translations
 */

if (!defined('ABSPATH')) {
    exit;
}

class AYNIX_GDPR_Translations {
    
    private static $instance = null;
    private $current_lang = 'it';
    private $translations = array();
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        $this->detect_language();
        $this->load_translations();
    }
    
    private function detect_language() {
        // Try to get language from theme's aynix_translate function
        if (function_exists('aynix_get_current_language')) {
            $this->current_lang = aynix_get_current_language();
        }
        // Check if cookie exists (used by AYNIX theme)
        elseif (isset($_COOKIE['aynix_language'])) {
            $this->current_lang = sanitize_key($_COOKIE['aynix_language']);
        }
        // Check session
        elseif (isset($_SESSION['aynix_language'])) {
            $this->current_lang = sanitize_key($_SESSION['aynix_language']);
        }
        // Check URL parameter
        elseif (isset($_GET['lang'])) {
            $this->current_lang = sanitize_key($_GET['lang']);
        }
        // Default to Italian
        else {
            $this->current_lang = 'it';
        }
        
        // Validate language code
        $allowed_langs = array('it', 'en', 'es', 'pt');
        if (!in_array($this->current_lang, $allowed_langs)) {
            $this->current_lang = 'it';
        }
    }
    
    private function load_translations() {
        $this->translations = array(
            'it' => array(
                // Cookie Banner
                'cookie_banner_title' => 'Utilizziamo i Cookie',
                'cookie_banner_text' => 'Questo sito utilizza cookie per migliorare la tua esperienza di navigazione. I cookie necessari sono sempre abilitati. Puoi personalizzare le tue preferenze.',
                'more_info' => 'Maggiori informazioni',
                'customize' => 'Personalizza',
                'reject' => 'Rifiuta',
                'accept_all' => 'Accetta Tutti',
                
                // Modal
                'cookie_preferences' => 'Preferenze Cookie',
                'preferences_description' => 'Gestiamo le tue preferenze sui cookie. I cookie necessari sono sempre abilitati perché essenziali per il funzionamento del sito.',
                
                // Categories
                'necessary_cookies' => 'Cookie Necessari',
                'necessary_description' => 'Questi cookie sono essenziali per il funzionamento del sito e non possono essere disabilitati.',
                'analytics_cookies' => 'Cookie Analitici',
                'analytics_description' => 'Questi cookie ci aiutano a capire come gli utenti interagiscono con il sito raccogliendo e analizzando informazioni in forma anonima.',
                'marketing_cookies' => 'Cookie Marketing',
                'marketing_description' => 'Questi cookie vengono utilizzati per tracciare i visitatori sui siti web e mostrare pubblicità pertinenti e coinvolgenti.',
                
                // Buttons
                'save_preferences' => 'Salva Preferenze',
                'cancel' => 'Annulla',
                
                // Admin
                'settings_saved' => 'Impostazioni salvate con successo!',
                'consent_saved' => 'Preferenze di consenso salvate',
                'pages_regenerated' => 'Pagine GDPR rigenerate con successo!',
                
                // Page titles
                'privacy_policy' => 'Privacy Policy',
                'cookie_policy' => 'Cookie Policy',
                'terms_of_service' => 'Termini di Servizio',
            ),
            
            'en' => array(
                // Cookie Banner
                'cookie_banner_title' => 'We Use Cookies',
                'cookie_banner_text' => 'This site uses cookies to improve your browsing experience. Necessary cookies are always enabled. You can customize your preferences.',
                'more_info' => 'More information',
                'customize' => 'Customize',
                'reject' => 'Reject',
                'accept_all' => 'Accept All',
                
                // Modal
                'cookie_preferences' => 'Cookie Preferences',
                'preferences_description' => 'Manage your cookie preferences. Necessary cookies are always enabled because they are essential for the site to function.',
                
                // Categories
                'necessary_cookies' => 'Necessary Cookies',
                'necessary_description' => 'These cookies are essential for the site to function and cannot be disabled.',
                'analytics_cookies' => 'Analytics Cookies',
                'analytics_description' => 'These cookies help us understand how users interact with the site by collecting and analyzing information anonymously.',
                'marketing_cookies' => 'Marketing Cookies',
                'marketing_description' => 'These cookies are used to track visitors across websites and display relevant and engaging advertisements.',
                
                // Buttons
                'save_preferences' => 'Save Preferences',
                'cancel' => 'Cancel',
                
                // Admin
                'settings_saved' => 'Settings saved successfully!',
                'consent_saved' => 'Consent preferences saved',
                'pages_regenerated' => 'GDPR pages regenerated successfully!',
                
                // Page titles
                'privacy_policy' => 'Privacy Policy',
                'cookie_policy' => 'Cookie Policy',
                'terms_of_service' => 'Terms of Service',
            ),
            
            'es' => array(
                // Cookie Banner
                'cookie_banner_title' => 'Usamos Cookies',
                'cookie_banner_text' => 'Este sitio utiliza cookies para mejorar su experiencia de navegación. Las cookies necesarias están siempre habilitadas. Puede personalizar sus preferencias.',
                'more_info' => 'Más información',
                'customize' => 'Personalizar',
                'reject' => 'Rechazar',
                'accept_all' => 'Aceptar Todo',
                
                // Modal
                'cookie_preferences' => 'Preferencias de Cookies',
                'preferences_description' => 'Gestione sus preferencias de cookies. Las cookies necesarias están siempre habilitadas porque son esenciales para el funcionamiento del sitio.',
                
                // Categories
                'necessary_cookies' => 'Cookies Necesarias',
                'necessary_description' => 'Estas cookies son esenciales para el funcionamiento del sitio y no se pueden desactivar.',
                'analytics_cookies' => 'Cookies Analíticas',
                'analytics_description' => 'Estas cookies nos ayudan a comprender cómo los usuarios interactúan con el sitio recopilando y analizando información de forma anónima.',
                'marketing_cookies' => 'Cookies de Marketing',
                'marketing_description' => 'Estas cookies se utilizan para rastrear visitantes en sitios web y mostrar anuncios relevantes y atractivos.',
                
                // Buttons
                'save_preferences' => 'Guardar Preferencias',
                'cancel' => 'Cancelar',
                
                // Admin
                'settings_saved' => '¡Configuración guardada exitosamente!',
                'consent_saved' => 'Preferencias de consentimiento guardadas',
                'pages_regenerated' => '¡Páginas GDPR regeneradas exitosamente!',
                
                // Page titles
                'privacy_policy' => 'Política de Privacidad',
                'cookie_policy' => 'Política de Cookies',
                'terms_of_service' => 'Términos de Servicio',
            ),
            
            'pt' => array(
                // Cookie Banner
                'cookie_banner_title' => 'Usamos Cookies',
                'cookie_banner_text' => 'Este site usa cookies para melhorar sua experiência de navegação. Os cookies necessários estão sempre ativados. Você pode personalizar suas preferências.',
                'more_info' => 'Mais informações',
                'customize' => 'Personalizar',
                'reject' => 'Rejeitar',
                'accept_all' => 'Aceitar Todos',
                
                // Modal
                'cookie_preferences' => 'Preferências de Cookies',
                'preferences_description' => 'Gerencie suas preferências de cookies. Os cookies necessários estão sempre ativados porque são essenciais para o funcionamento do site.',
                
                // Categories
                'necessary_cookies' => 'Cookies Necessários',
                'necessary_description' => 'Esses cookies são essenciais para o funcionamento do site e não podem ser desativados.',
                'analytics_cookies' => 'Cookies Analíticos',
                'analytics_description' => 'Esses cookies nos ajudam a entender como os usuários interagem com o site coletando e analisando informações anonimamente.',
                'marketing_cookies' => 'Cookies de Marketing',
                'marketing_description' => 'Esses cookies são usados para rastrear visitantes em sites e exibir anúncios relevantes e envolventes.',
                
                // Buttons
                'save_preferences' => 'Salvar Preferências',
                'cancel' => 'Cancelar',
                
                // Admin
                'settings_saved' => 'Configurações salvas com sucesso!',
                'consent_saved' => 'Preferências de consentimento salvas',
                'pages_regenerated' => 'Páginas GDPR regeneradas com sucesso!',
                
                // Page titles
                'privacy_policy' => 'Política de Privacidade',
                'cookie_policy' => 'Política de Cookies',
                'terms_of_service' => 'Termos de Serviço',
            ),
        );
    }
    
    public function get($key, $lang = null) {
        if ($lang === null) {
            $lang = $this->current_lang;
        }
        
        if (isset($this->translations[$lang][$key])) {
            return $this->translations[$lang][$key];
        }
        
        // Fallback to Italian
        if (isset($this->translations['it'][$key])) {
            return $this->translations['it'][$key];
        }
        
        return $key;
    }
    
    public function get_current_language() {
        return $this->current_lang;
    }
}

// Helper function
function aynix_gdpr_translate($key) {
    return AYNIX_GDPR_Translations::get_instance()->get($key);
}
