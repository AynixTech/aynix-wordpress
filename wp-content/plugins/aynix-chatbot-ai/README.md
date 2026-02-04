# AYNIX Chatbot AI

Plugin WordPress per chatbot AI multilingua con integrazione OpenAI GPT-4.

## Caratteristiche

✅ **Chatbot AI intelligente** - Usa GPT-4 per rispondere alle domande
✅ **Multilingua** - Supporto completo IT, EN, ES, PT
✅ **Responsive** - Ottimizzato per desktop e mobile
✅ **Context-aware** - Conosce le pagine e i servizi AYNIX
✅ **Design moderno** - UI pulita e professionale
✅ **Integrazione API OpenAI** - Usa la stessa chiave del tema

## Installazione

1. Copia la cartella `aynix-chatbot-ai` in `wp-content/plugins/`
2. Attiva il plugin dal pannello WordPress
3. Il chatbot apparirà automaticamente in basso a destra

## Configurazione

Il plugin usa automaticamente la chiave API OpenAI definita in `wp-config.php`:

```php
define('OPENAI_API_KEY', 'sk-...');
```

Nessuna configurazione aggiuntiva richiesta!

## Funzionalità

### Assistenza Navigazione
- Guida gli utenti attraverso le pagine del sito
- Fornisce link diretti alle sezioni

### Informazioni Servizi
- Risponde a domande su AYNIX
- Spiega i prodotti (SafeFleet, Navenza, Pinguito)
- Suggerisce il questionario diagnosi

### Multilingua
Il chatbot rileva automaticamente la lingua da:
1. Parametro URL `?lang=`
2. Cookie `aynix_lang`
3. Default: italiano

### Responsive
- Desktop: widget floating in basso a destra
- Mobile: fullscreen con animazioni fluide

## Personalizzazione

### Modificare i colori
Modifica `assets/css/chatbot.css` e cerca:
- `#0066cc` - Colore primario AYNIX
- `#0052a3` - Colore primario scuro

### Modificare il comportamento AI
Modifica il metodo `get_system_message()` in `aynix-chatbot-ai.php`

### Aggiungere pagine al context
Modifica il metodo `get_site_context()` in `aynix-chatbot-ai.php`

## Requisiti

- WordPress 5.0+
- PHP 7.4+
- jQuery (incluso in WordPress)
- Chiave API OpenAI configurata

## Struttura File

```
aynix-chatbot-ai/
├── aynix-chatbot-ai.php     # Plugin principale
├── assets/
│   ├── css/
│   │   └── chatbot.css       # Stili
│   └── js/
│       └── chatbot.js        # JavaScript
└── README.md                 # Documentazione
```

## API Endpoints

### AJAX Handler
- **Action**: `aynix_chatbot_message`
- **Method**: POST
- **Parameters**:
  - `message` - Messaggio utente
  - `lang` - Lingua (it, en, es, pt)
  - `nonce` - Security nonce

## Browser Support

- Chrome/Edge 90+
- Firefox 88+
- Safari 14+
- Mobile browsers (iOS Safari, Chrome Mobile)

## Changelog

### v1.0.0
- Rilascio iniziale
- Supporto multilingua IT/EN/ES/PT
- Integrazione OpenAI GPT-4
- Design responsive
- Context awareness per pagine AYNIX

## Licenza

GPL v2 or later

## Supporto

Per assistenza: info@aynix.tech
