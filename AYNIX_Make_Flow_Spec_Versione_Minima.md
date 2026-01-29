# Make Flow Spec – Versione Minima
AYNIX | Sistema Diagnosi & Vendita Custom

Documento operativo da consegnare al **softwareista / automation specialist**  
Obiettivo: rendere operativo il ciclo **Diagnosi → Classificazione → Azione** con il minimo indispensabile.

---

## 1. ARCHITETTURA MINIMA

**Input**
- WordPress pagina `/diagnosi`
- Questionario (Typeform / Tally / CF7)

**Automazione**
- Make (1 scenario principale)

**Output**
- CRM leggero (Airtable / HubSpot / Notion)
- Email automatiche
- WhatsApp **solo lead caldo + consenso**
- Calendly (solo via link, no webhook in questa fase)

---

## 2. SCHEMA FLOW (OVERVIEW)

```
Questionario Submit
   ↓
Make Trigger
   ↓
Normalizzazione dati
   ↓
Calcolo Score
   ↓
Upsert CRM
   ↓
Email conferma (tutti)
   ↓
Router per Lead Class
      ├─ Freddo → nurture leggero
      ├─ Medio  → nurture medio
      └─ Caldo  → email + WhatsApp + notifica interna
```

---

## 3. TRIGGER MAKE

**Modulo**
- Typeform / Tally → Watch Responses

**Campi obbligatori in ingresso**
- name
- email
- phone (opzionale)
- whatsapp_consent (boolean)
- language (EN / ES / IT / PT)
- risposte Q1–Q10
- timestamp

---

## 4. NORMALIZZAZIONE DATI

**Modulo**
- Tools → Set variables

**Variabili standard**
- lead_name
- lead_email
- lead_phone
- lang
- sector
- company_size
- area_problem
- pain_type
- criticality
- current_maturity
- volume
- objective
- timing
- budget

---

## 5. CALCOLO SCORE

**Modulo**
- Tools → Set variable (formula)

**Output**
- score_total (number)
- lead_class (cold / medium / hot)
- priority (low / mid / high)

**Logica**
Fare riferimento a:
AYNIX_questionario_diagnosi.md

---

## 6. UPSERT CRM

**Modulo**
- CRM / Airtable → Search record (by email)
- IF found → Update record
- IF not found → Create record

**Campi CRM minimi**
- Name
- Email
- Phone
- Language
- Score
- Lead class
- Priority
- Area problem
- Sector
- Status pipeline = “Diagnosis submitted”
- Created at
- Last update

---

## 7. EMAIL DI CONFERMA (TUTTI I LEAD)

**Modulo**
- Email (SMTP / Gmail / Sendgrid)

**Template**
- Usare i template dal file:
AYNIX_messaggi_post_diagnosi_multilingua.md

**Regola**
- Template selezionato in base a lang

---

## 8. ROUTER PER LEAD CLASS

### 8A. LEAD FREDDO

**Azioni**
- CRM: status = Nurture – Cold
- Email educativa (1 sola)

Stop flow.

---

### 8B. LEAD MEDIO

**Azioni**
- CRM: status = Nurture – Medium
- Email passo intermedio
- (Opzionale) Task interno follow-up 7–14 giorni

Stop flow.

---

### 8C. LEAD CALDO

**Azioni**
- CRM: status = Hot – Call suggested
- Email next step con link Calendly

**Condizione WhatsApp**
IF:
- whatsapp_consent = true
- lead_phone is not empty

THEN:
- Invia messaggio WhatsApp (template lingua)

**Notifica interna**
- Email o Slack al team AYNIX con:
  - nome lead
  - score
  - area problema
  - link record CRM

---

## 9. WHATSAPP (SOLO LEAD CALDO)

**Provider**
- Twilio / 360dialog / WATI

**Regole**
- 1 solo messaggio
- tono umano
- nessuna vendita

---

## 10. REGOLE NON NEGOZIABILI

- Upsert sempre per email
- Lingua salvata e usata ovunque
- WhatsApp solo caldo + consenso
- Nessuna call automatica per medio/freddo
- Nessun testo hardcoded in Make (solo template)

---

## 11. CHECKLIST FINALE

- [ ] Questionario invia tutti i campi richiesti
- [ ] Score calcolato correttamente
- [ ] CRM non crea duplicati
- [ ] Email lingua corretta
- [ ] WhatsApp inviato solo se consentito
- [ ] Team riceve notifica per lead caldo

---

Documento ufficiale – Make Flow Spec (Versione Minima) – AYNIX
