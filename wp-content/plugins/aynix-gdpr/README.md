# AYNIX GDPR Plugin

Plugin WordPress completo per la conformità GDPR con cookie banner personalizzabile, gestione dei consensi e pagine legali automatiche.

## Caratteristiche

### Cookie Banner
- Banner personalizzabile con posizione (alto/basso)
- Colori configurabili (sfondo e testo)
- Modale per le preferenze dettagliate
- Gestione granulare dei consensi

### Categorie Cookie
- **Necessari**: Sempre attivi (richiesti per il funzionamento del sito)
- **Analytics**: Google Analytics e strumenti di analisi
- **Marketing**: Facebook Pixel, LinkedIn Ads, ecc.

### Pagine Legali Auto-generate
Il plugin crea automaticamente all'attivazione:
- **Privacy Policy**: Completa di diritti GDPR
- **Cookie Policy**: Spiegazione delle categorie di cookie
- **Terms of Service**: Termini di servizio conformi alla legge italiana/UE

### Gestione Consensi
- Blocco automatico degli script di tracciamento senza consenso
- Cookie di consenso con scadenza configurabile
- Supporto AJAX per salvataggio preferenze

## Installazione

1. Carica la cartella `aynix-gdpr` nella directory `/wp-content/plugins/`
2. Attiva il plugin dal menu 'Plugin' in WordPress
3. Le pagine legali verranno create automaticamente
4. Configura le impostazioni in Impostazioni > AYNIX GDPR

## Configurazione

### Impostazioni Banner
- **Abilita Banner**: Mostra/nasconde il banner cookie
- **Posizione**: Alto o basso della pagina
- **Colore Sfondo**: Personalizza il colore di sfondo
- **Colore Testo**: Personalizza il colore del testo
- **Scadenza Cookie**: Giorni prima che il consenso scada (default: 365)

### Categorie Cookie
- **Analytics**: Abilita/disabilita cookie di analisi
- **Marketing**: Abilita/disabilita cookie di marketing

## Struttura File

```
aynix-gdpr/
├── aynix-gdpr.php              # File principale del plugin
├── assets/
│   ├── css/
│   │   └── aynix-gdpr.css      # Stili banner e modale
│   └── js/
│       ├── aynix-gdpr.js       # Frontend JavaScript
│       └── aynix-gdpr-admin.js # Admin JavaScript
├── includes/
│   ├── class-cookie-banner.php   # Gestione banner
│   ├── class-consent-manager.php # Gestione consensi
│   └── class-page-generator.php  # Generazione pagine
├── templates/
│   └── admin-settings.php      # Template impostazioni admin
└── README.md
```

## Hook e Filtri

### Actions
- `aynix_gdpr_before_banner`: Prima del rendering del banner
- `aynix_gdpr_after_banner`: Dopo il rendering del banner
- `aynix_gdpr_consent_saved`: Quando il consenso viene salvato

### Filters
- `aynix_gdpr_banner_text`: Modifica il testo del banner
- `aynix_gdpr_consent_expiry`: Modifica i giorni di scadenza del consenso

## Funzioni Pubbliche

### Verificare il consenso
```php
$consent_manager = AYNIX_GDPR_Consent_Manager::get_instance();

// Verifica consenso analytics
if ($consent_manager->has_consent('analytics')) {
    // Carica Google Analytics
}

// Verifica consenso marketing
if ($consent_manager->has_consent('marketing')) {
    // Carica Facebook Pixel
}
```

## Compatibilità

- WordPress 5.0 o superiore
- PHP 7.0 o superiore
- Conforme al GDPR (Regolamento UE 2016/679)
- Conforme alle linee guida del Garante Privacy italiano

## Supporto

Per supporto o segnalazioni di bug, contattare: info@aynix.tech

## Changelog

### 1.0.0
- Release iniziale
- Cookie banner personalizzabile
- Gestione consensi
- Pagine legali auto-generate
- Blocco automatico script di tracciamento

## Licenza

GPL v2 or later
