# Aynix WordPress

Sito web ufficiale di Aynix realizzato con WordPress.

## Descrizione

Questo repository contiene i file del sito WordPress di Aynix, una piattaforma completa per la gestione dei contenuti web.

## Tecnologie Utilizzate

- **WordPress**: Sistema di gestione dei contenuti (CMS)
- **PHP**: Linguaggio di programmazione server-side
- **MySQL**: Database per la gestione dei dati
- **HTML/CSS/JavaScript**: Frontend del sito

## Struttura del Progetto

```
aynix-wordpress/
├── wp-admin/          # Area amministrativa di WordPress
├── wp-content/        # Contenuti del sito (temi, plugin, upload)
├── wp-includes/       # File core di WordPress
├── index.php          # File principale
├── wp-config.php      # Configurazione del database
└── ...
```

## Requisiti di Sistema

- PHP 7.4 o superiore
- MySQL 5.7 o superiore / MariaDB 10.3 o superiore
- Apache o Nginx
- HTTPS raccomandato

## Installazione Locale

1. Clona il repository:
   ```bash
   git clone https://github.com/AynixTech/aynix-wordpress.git
   ```

2. Configura il database:
   - Crea un nuovo database MySQL
   - Copia `wp-config-sample.php` in `wp-config.php`
   - Modifica `wp-config.php` con le credenziali del database

3. Avvia il server locale:
   ```bash
   # Con MAMP, XAMPP o server locale
   ```

4. Accedi all'interfaccia di amministrazione:
   ```
   http://localhost/wp-admin
   ```

## Configurazione

Il file `wp-config.php` contiene le configurazioni principali:
- Credenziali del database
- Chiavi di sicurezza
- Prefisso delle tabelle
- Modalità debug

## Plugin e Temi

I plugin e temi personalizzati si trovano nella cartella `wp-content/`:
- `/wp-content/plugins/` - Plugin installati
- `/wp-content/themes/` - Temi disponibili
- `/wp-content/uploads/` - Media caricati

## Sicurezza

- Le credenziali del database sono configurate in `wp-config.php` (non incluso nel repository)
- File `.htaccess` per la protezione del server
- Aggiornamenti regolari di WordPress e plugin

## Note Importanti

- Il file `debug.log` è escluso dal repository (troppo grande)
- Non committare mai file sensibili come `wp-config.php` con credenziali reali
- Mantieni WordPress e i plugin sempre aggiornati

## Contributi

Per contribuire al progetto:
1. Fai un fork del repository
2. Crea un branch per la tua feature (`git checkout -b feature/NuovaFeature`)
3. Committa le modifiche (`git commit -m 'Aggiunta nuova feature'`)
4. Push al branch (`git push origin feature/NuovaFeature`)
5. Apri una Pull Request

## Licenza

Questo progetto utilizza WordPress, rilasciato sotto licenza GPL v2 o successiva.

## Contatti

- **Azienda**: Aynix Tech
- **GitHub**: [@AynixTech](https://github.com/AynixTech)

## Changelog

### Versione Iniziale
- Setup iniziale del sito WordPress
- Configurazione base del repository

---

**Powered by WordPress** | © 2026 Aynix Tech
