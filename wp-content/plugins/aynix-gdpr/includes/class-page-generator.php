<?php
/**
 * GDPR Page Generator
 * Creates Privacy Policy, Cookie Policy, and Terms of Service pages
 */

if (!defined('ABSPATH')) {
    exit;
}

class AYNIX_GDPR_Page_Generator {
    
    public static function create_gdpr_pages() {
        self::create_privacy_policy_page();
        self::create_cookie_policy_page();
        self::create_terms_of_service_page();
    }
    
    private static function create_privacy_policy_page() {
        $page_title = __('Privacy Policy', 'aynix-gdpr');
        $page_slug = 'privacy-policy';
        
        // Check if page already exists
        $existing_page = get_page_by_path($page_slug);
        if ($existing_page) {
            return;
        }
        
        $content = self::get_privacy_policy_content();
        
        $page_data = array(
            'post_title' => $page_title,
            'post_content' => $content,
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_name' => $page_slug,
            'post_author' => 1,
            'comment_status' => 'closed',
            'ping_status' => 'closed'
        );
        
        $page_id = wp_insert_post($page_data);
        
        if ($page_id) {
            update_option('aynix_gdpr_privacy_policy_page_id', $page_id);
        }
    }
    
    private static function create_cookie_policy_page() {
        $page_title = __('Cookie Policy', 'aynix-gdpr');
        $page_slug = 'cookie-policy';
        
        $existing_page = get_page_by_path($page_slug);
        if ($existing_page) {
            return;
        }
        
        $content = self::get_cookie_policy_content();
        
        $page_data = array(
            'post_title' => $page_title,
            'post_content' => $content,
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_name' => $page_slug,
            'post_author' => 1,
            'comment_status' => 'closed',
            'ping_status' => 'closed'
        );
        
        $page_id = wp_insert_post($page_data);
        
        if ($page_id) {
            update_option('aynix_gdpr_cookie_policy_page_id', $page_id);
        }
    }
    
    private static function create_terms_of_service_page() {
        $page_title = __('Terms of Service', 'aynix-gdpr');
        $page_slug = 'terms-of-service';
        
        $existing_page = get_page_by_path($page_slug);
        if ($existing_page) {
            return;
        }
        
        $content = self::get_terms_of_service_content();
        
        $page_data = array(
            'post_title' => $page_title,
            'post_content' => $content,
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_name' => $page_slug,
            'post_author' => 1,
            'comment_status' => 'closed',
            'ping_status' => 'closed'
        );
        
        $page_id = wp_insert_post($page_data);
        
        if ($page_id) {
            update_option('aynix_gdpr_terms_page_id', $page_id);
        }
    }
    
    private static function get_privacy_policy_content() {
        $company_name = get_bloginfo('name');
        $company_email = get_option('admin_email');
        
        return <<<HTML
<h2>1. Informazioni che Raccogliamo</h2>
<p>Quando visiti il nostro sito web, raccogliamo automaticamente alcune informazioni sul tuo dispositivo, comprese informazioni sul tuo browser web, indirizzo IP, fuso orario e alcuni dei cookie installati sul tuo dispositivo.</p>

<h2>2. Come Utilizziamo le Tue Informazioni</h2>
<p>Utilizziamo le informazioni che raccogliamo per:</p>
<ul>
    <li>Fornire e migliorare i nostri servizi</li>
    <li>Comunicare con te</li>
    <li>Analizzare l'utilizzo del sito</li>
    <li>Personalizzare la tua esperienza</li>
</ul>

<h2>3. Condivisione dei Dati</h2>
<p>Non vendiamo, scambiamo o trasferiamo in altro modo a terzi le tue informazioni personali identificabili senza il tuo consenso, eccetto quando richiesto dalla legge.</p>

<h2>4. Cookie</h2>
<p>Utilizziamo i cookie per migliorare la tua esperienza sul nostro sito. Per maggiori informazioni, consulta la nostra <a href="/cookie-policy">Cookie Policy</a>.</p>

<h2>5. I Tuoi Diritti GDPR</h2>
<p>Se risiedi nell'Area Economica Europea (AEA), hai i seguenti diritti:</p>
<ul>
    <li>Diritto di accesso ai tuoi dati personali</li>
    <li>Diritto di rettifica</li>
    <li>Diritto alla cancellazione</li>
    <li>Diritto di limitazione del trattamento</li>
    <li>Diritto alla portabilità dei dati</li>
    <li>Diritto di opposizione</li>
</ul>

<h2>6. Sicurezza dei Dati</h2>
<p>Implementiamo misure di sicurezza appropriate per proteggere i tuoi dati personali da accesso, alterazione, divulgazione o distruzione non autorizzati.</p>

<h2>7. Modifiche a Questa Privacy Policy</h2>
<p>Ci riserviamo il diritto di modificare questa privacy policy in qualsiasi momento. Le modifiche entreranno in vigore immediatamente dopo la pubblicazione sul sito.</p>

<h2>8. Contatti</h2>
<p>Per domande o richieste relative a questa privacy policy, contattaci a: <a href="mailto:{$company_email}">{$company_email}</a></p>

<p><em>Ultimo aggiornamento: {$this->get_current_date()}</em></p>
HTML;
    }
    
    private static function get_cookie_policy_content() {
        return <<<HTML
<h2>Cosa Sono i Cookie</h2>
<p>I cookie sono piccoli file di testo che vengono memorizzati sul tuo dispositivo quando visiti un sito web. Vengono utilizzati per far funzionare il sito in modo efficiente e fornire informazioni ai proprietari del sito.</p>

<h2>Come Utilizziamo i Cookie</h2>
<p>Utilizziamo i cookie per i seguenti scopi:</p>

<h3>Cookie Necessari</h3>
<p>Questi cookie sono essenziali per il funzionamento del sito web e non possono essere disattivati nei nostri sistemi. Di solito vengono impostati solo in risposta ad azioni da te effettuate che costituiscono una richiesta di servizi.</p>

<h3>Cookie Analitici</h3>
<p>Questi cookie ci consentono di contare le visite e le fonti di traffico in modo da poter misurare e migliorare le prestazioni del nostro sito. Ci aiutano a sapere quali sono le pagine più e meno popolari e vedere come i visitatori si muovono intorno al sito.</p>

<h3>Cookie di Marketing</h3>
<p>Questi cookie possono essere impostati attraverso il nostro sito dai nostri partner pubblicitari. Possono essere utilizzati da queste aziende per creare un profilo dei tuoi interessi e mostrarti annunci pertinenti su altri siti.</p>

<h2>Cookie di Terze Parti</h2>
<p>Alcuni cookie sono inseriti da servizi di terze parti che appaiono sulle nostre pagine, inclusi:</p>
<ul>
    <li>Google Analytics (analisi del traffico)</li>
    <li>Social media plugins (Facebook, LinkedIn, etc.)</li>
</ul>

<h2>Gestione dei Cookie</h2>
<p>Puoi gestire le tue preferenze sui cookie utilizzando il nostro banner dei cookie o modificando le impostazioni del tuo browser. Nota che la disabilitazione dei cookie potrebbe influire sulla funzionalità del sito.</p>

<h2>Maggiori Informazioni</h2>
<p>Per ulteriori informazioni sul trattamento dei tuoi dati personali, consulta la nostra <a href="/privacy-policy">Privacy Policy</a>.</p>

<p><em>Ultimo aggiornamento: {$this->get_current_date()}</em></p>
HTML;
    }
    
    private static function get_terms_of_service_content() {
        $company_name = get_bloginfo('name');
        
        return <<<HTML
<h2>1. Accettazione dei Termini</h2>
<p>Utilizzando questo sito web, accetti di essere vincolato da questi termini di servizio e dalla nostra privacy policy.</p>

<h2>2. Uso del Sito</h2>
<p>Ti viene concessa una licenza limitata per accedere e fare uso personale di questo sito. Non è consentito scaricare o modificare alcuna parte del sito senza il nostro esplicito consenso scritto.</p>

<h2>3. Proprietà Intellettuale</h2>
<p>Tutti i contenuti presenti su questo sito, inclusi testi, grafica, loghi, icone, immagini, clip audio, download digitali e software, sono di proprietà di {$company_name} o dei suoi fornitori di contenuti e sono protetti dalle leggi internazionali sul copyright.</p>

<h2>4. Limitazione di Responsabilità</h2>
<p>{$company_name} non sarà responsabile per eventuali danni diretti, indiretti, incidentali, consequenziali o punitivi derivanti dall'uso o dall'impossibilità di utilizzare questo sito.</p>

<h2>5. Indennizzo</h2>
<p>Accetti di indennizzare e tenere indenne {$company_name} da qualsiasi rivendicazione o domanda, incluse le ragionevoli spese legali, fatte da terze parti a causa del tuo uso del sito.</p>

<h2>6. Modifiche ai Termini</h2>
<p>Ci riserviamo il diritto di modificare questi termini in qualsiasi momento. Le modifiche entreranno in vigore immediatamente dopo la pubblicazione sul sito.</p>

<h2>7. Legge Applicabile</h2>
<p>Questi termini sono regolati e interpretati in conformità con le leggi italiane ed europee, senza riguardo ai suoi principi di conflitto di leggi.</p>

<h2>8. Servizi</h2>
<p>I nostri servizi di sviluppo software sono forniti "così come sono" senza garanzie di alcun tipo, esplicite o implicite. Ci impegniamo a fornire soluzioni di alta qualità ma non garantiamo risultati specifici.</p>

<h2>9. Contatti</h2>
<p>Per domande relative a questi termini di servizio, contattaci attraverso la nostra <a href="/contattaci">pagina contatti</a>.</p>

<p><em>Ultimo aggiornamento: {$this->get_current_date()}</em></p>
HTML;
    }
    
    private static function get_current_date() {
        return date_i18n(get_option('date_format'));
    }
}
