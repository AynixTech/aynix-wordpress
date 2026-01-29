# AYNIX – Guida Implementazione Sistema Diagnosi

## Modifiche Implementate

### ✅ 1. Pagina Diagnosi Aggiornata
- **File**: `page-diagnosi.php`
- **Copy**: Aggiornato con contenuti da `AYNIX_diagnosi_multilingua.md`
- **Struttura**:
  - Hero con H1: "Inizia da una diagnosi. Non da una proposta."
  - Sezione "Cos'è / Cosa non è"
  - Sezione "Come funziona" (3 step)
  - Sezione "Cosa ottieni" (3 benefici)
  - CTA per avviare diagnosi

### ✅ 2. Thank You Page
- **File**: `page-grazie-diagnosi.php`
- **Funzione**: Pagina di ringraziamento post-questionario
- **Contenuti**:
  - Conferma ricezione diagnosi
  - Cosa succede ora (3 step)
  - Tempo di risposta: 24-48 ore
  - Nota: nessuna proposta commerciale automatica

### ✅ 3. Traduzioni Complete
Tutte le traduzioni aggiunte in 4 lingue (IT, EN, ES, PT):
- `diagnosi.hero.*` - Hero section
- `diagnosi.badge.*` - Badge (10 min, Nessun costo, Nessuna vendita)
- `diagnosi.what.*` - Cos'è / Cosa non è
- `diagnosi.how.*` - Come funziona
- `diagnosi.benefits.*` - Cosa ottieni
- `diagnosi.cta.*` - CTA finale
- `thankyou.*` - Thank You page completa

### ✅ 4. CSS Dedicato
- **File**: `assets/css/page-diagnosi.css`
- **Styling**: Design moderno, responsive, gradient colorati
- **Componenti**: Cards, badge, step indicators, CTA box

---

## 🚀 Prossimi Passi Operativi

### STEP 1: Creare le Pagine in WordPress

1. **Accedi a WordPress Admin** → Pagine → Aggiungi Nuova

2. **Crea pagina "Diagnosi"**:
   - Titolo: `Diagnosi`
   - Slug: `diagnosi`
   - Template: Seleziona "Diagnosi"
   - Pubblica

3. **Crea pagina "Thank You"**:
   - Titolo: `Grazie - Diagnosi`
   - Slug: `grazie-diagnosi`
   - Template: Seleziona "Thank You Diagnosi"
   - Pubblica

4. **Crea le altre 5 pagine** (se non già fatto):
   - Metodo (slug: `metodo`, template: "Metodo")
   - Problemi (slug: `problemi`, template: "Problemi")
   - Soluzioni (slug: `soluzioni`, template: "Soluzioni")
   - Esperienza (slug: `esperienza`, template: "Esperienza")
   - Chi Siamo (slug: `chi-siamo`, template: "Chi Siamo")

---

### STEP 2: Configurare il Questionario

Hai **3 opzioni** per il questionario:

#### OPZIONE A: Typeform (Consigliato)

1. **Crea account su Typeform.com**

2. **Crea nuovo form** usando le domande da:
   - `AYNIX_questionario_diagnosi.md` (italiano)
   - `AYNIX_questionario_multilingua_EN_ES_PT.md` (altre lingue)

3. **Configura redirect**:
   - Settings → After submission → Redirect to URL
   - URL: `https://aynix.tech/grazie-diagnosi`

4. **Ottieni codice embed**:
   - Share → Embed
   - Copia il codice widget

5. **Integra in WordPress**:
   - Modifica `page-diagnosi.php` linea ~100
   - Sostituisci il commento `<!-- Placeholder per form -->` con:
   ```html
   <div data-tf-widget="YOUR_FORM_ID" data-tf-opacity="100" style="width:100%;height:600px;"></div>
   <script src="//embed.typeform.com/next/embed.js"></script>
   ```

#### OPZIONE B: Tally.so (Gratuito)

1. **Crea account su Tally.so**
2. **Importa domande** dal documento questionario
3. **Configura redirect** → `/grazie-diagnosi`
4. **Embed** simile a Typeform

#### OPZIONE C: Contact Form 7 + Plugin

1. **Installa plugin**:
   - Contact Form 7
   - Contact Form 7 Conditional Fields

2. **Crea form** con le 10 domande
3. **Configura redirect** con hook WordPress
4. **Inserisci shortcode** in page-diagnosi.php

---

### STEP 3: Configurare Automazioni Make

Segui le specifiche in:
- `AYNIX_Make_Flow_Spec_Versione_Minima.md` (base)
- `AYNIX_Make_Flow_Spec_Versione_Robusta.md` (avanzato)

**Componenti da configurare**:
1. Trigger da Typeform/Tally
2. Calcolo score lead
3. Upsert CRM (Airtable/HubSpot)
4. Email automatiche (usa template da `AYNIX_messaggi_post_diagnosi_multilingua.md`)
5. WhatsApp per lead caldi (opzionale)

---

### STEP 4: Configurare Template Email

I template sono pronti in `AYNIX_messaggi_post_diagnosi_multilingua.md`:

1. **Email Conferma** (tutti i lead)
2. **Email Follow-up Lead Caldo** (con link Calendly)
3. **WhatsApp Lead Caldo** (solo con consenso)

**Variabili da sostituire**:
- `{{Name}}` → Nome lead
- `{{CalendarLink}}` → Link Calendly
- `{{Area}}` → Area problema

---

### STEP 5: Test Completo

1. ✅ Visita `/diagnosi`
2. ✅ Compila questionario test
3. ✅ Verifica redirect a `/grazie-diagnosi`
4. ✅ Controlla email conferma
5. ✅ Verifica dati in CRM
6. ✅ Test responsive mobile

---

## 📋 Checklist Finale

- [ ] Pagina /diagnosi creata e pubblicata
- [ ] Pagina /grazie-diagnosi creata e pubblicata
- [ ] Questionario integrato (Typeform/Tally/CF7)
- [ ] Redirect post-submit configurato
- [ ] Automazioni Make attive
- [ ] Email template configurati
- [ ] CRM connesso
- [ ] Test end-to-end completato
- [ ] Mobile responsive verificato
- [ ] Traduzioni verificate per tutte le lingue

---

## 🛠️ File Modificati

```
wp-content/themes/aynix/
├── page-diagnosi.php (aggiornato con nuovo copy)
├── page-grazie-diagnosi.php (nuovo)
├── assets/css/page-diagnosi.css (nuovo)
├── languages/
│   ├── it.json (diagnosi.* + thankyou.*)
│   ├── en.json (diagnosi.* + thankyou.*)
│   ├── es.json (diagnosi.* + thankyou.*)
│   └── pt.json (diagnosi.* + thankyou.*)
```

---

## 📚 Documenti di Riferimento

**Per lo sviluppatore**:
- `AYNIX_questionario_diagnosi.md` - Domande e logica scoring
- `AYNIX_Make_Flow_Spec_Versione_Minima.md` - Automazioni base
- `AYNIX_Make_Flow_Spec_Versione_Robusta.md` - Automazioni avanzate

**Per il team**:
- `AYNIX_script_call_diagnosi.md` - Script per call post-diagnosi
- `AYNIX_azioni_automatiche_lead.md` - Azioni per freddo/medio/caldo
- `AYNIX_PDF_Diagnosi_Template_1_pagina.md` - Template PDF diagnosi

**Per il chatbot** (opzionale):
- `AYNIX_chatbot_diagnostic_assistant.md` - Copy chatbot multilingua

---

## 🔧 Troubleshooting

**Problema**: Pagina 404 su /diagnosi
- Soluzione: Vai in Impostazioni → Permalink → Salva modifiche

**Problema**: Form non appare
- Verifica che hai sostituito il placeholder nel template
- Controlla console browser per errori JavaScript

**Problema**: Email non arrivano
- Verifica configurazione SMTP in WordPress
- Controlla spam/posta indesiderata
- Testa con plugin tipo WP Mail SMTP

**Problema**: Traduzioni non funzionano
- Controlla che i cookie di lingua siano attivi
- Verifica sintassi JSON nei file languages/*.json

---

## 📞 Supporto

Per domande tecniche:
- GitHub Issues
- Email: tech@aynix.com

Per configurazione Make/CRM:
- Consulta documentazione specifica nella cartella docs/

---

**Documento creato**: 29 gennaio 2026  
**Versione**: 1.0  
**Autore**: GitHub Copilot per AYNIX
