# Make Flow Spec – Versione Robusta
AYNIX | Sistema Diagnosi & Vendita Custom

Documento operativo **avanzato** per softwareista / automation specialist.  
Questa versione estende la *Versione Minima* con automazioni, controllo e scalabilità.

---

## OBIETTIVO DELLA VERSIONE ROBUSTA

- Rendere il sistema **scalabile**
- Ridurre attività manuali interne
- Tracciare tutto il ciclo: diagnosi → decisione → risultato
- Aumentare qualità e velocità delle call

---

## 1. ARCHITETTURA COMPLETA

**Input**
- WordPress `/diagnosi`
- Questionario (Typeform / Tally / CF7)
- Calendly (prenotazioni call)

**Automazione**
- Make (3 scenari)

**Output**
- CRM strutturato (Airtable / HubSpot)
- Email automatiche
- WhatsApp (solo lead caldo)
- PDF Diagnosi (medio / caldo)
- Notifiche interne (Slack / Email)

---

## 2. SCENARI MAKE (PANORAMICA)

### Scenario 1 – Diagnosis Intake
- Gestisce invio questionario
- Calcola score
- Classifica lead
- Avvia automazioni base

### Scenario 2 – Call Booking Sync
- Gestisce prenotazioni Calendly
- Aggiorna CRM
- Notifica team

### Scenario 3 – PDF Diagnosi & Follow-up
- Genera PDF
- Invia email dedicate
- Aggiorna stato lead

---

## 3. SCENARIO 1 – DIAGNOSIS INTAKE

### Step
1. Trigger: New submission
2. Normalize data
3. Compute score
4. Classify lead
5. Upsert CRM
6. Send confirmation email
7. Router by lead_class

### Estensioni versione robusta
- Salvataggio **raw answers JSON**
- Tracciamento source / UTM
- Versionamento questionario

---

## 4. SCENARIO 2 – CALENDLY SYNC

### Trigger
- Calendly → Webhook: *Invitee Created*

### Azioni
1. Match lead by email
2. Update CRM:
   - status = Call scheduled
   - call_date
   - call_type = Diagnostic call
3. Notifica interna (Slack / Email)
4. Reminder automatico al lead (24h prima)

---

## 5. SCENARIO 3 – PDF DIAGNOSI

### Quando generare il PDF
- Lead medio → opzionale
- Lead caldo → sempre (consigliato)

### Step
1. Trigger: lead_class = medium OR hot
2. Create Google Doc from template
3. Populate:
   - settore
   - problema principale
   - score
   - ipotesi di soluzione
4. Export PDF
5. Save link PDF in CRM
6. Send email con PDF allegato / link

---

## 6. CRM – STRUTTURA CONSIGLIATA

### Tabelle minime

#### Leads
- Name
- Email
- Phone
- Language
- Score
- Lead class
- Priority
- Sector
- Area problem
- Status pipeline
- Source / UTM
- PDF link
- Calendly event ID
- Created at
- Updated at

#### Activities
- Lead (relation)
- Type (email / whatsapp / call)
- Date
- Notes

---

## 7. ROUTER AVANZATO PER LEAD

### Lead Freddo
- Nurture light
- Archivio dopo 30 gg inattività

### Lead Medio
- PDF opzionale
- Nurture guidato
- Call solo su richiesta

### Lead Caldo
- PDF automatico
- Calendly prioritario
- WhatsApp + call
- Stato “In decisione”

---

## 8. MONITORAGGIO & CONTROLLO

### KPI consigliati
- % diagnosi → call
- % call → proposta
- Tempo medio risposta
- Lead caldi persi

### Automazioni controllo
- Alert se lead caldo non contattato entro 24h
- Alert se call non eseguita

---

## 9. REGOLE NON NEGOZIABILI

- Diagnosi sempre prima di proposta
- Nessuna vendita automatica
- WhatsApp solo lead caldo + consenso
- Template centralizzati
- Log completo azioni

---

## 10. CHECKLIST GO-LIVE

- [ ] Scenario 1 attivo
- [ ] Scenario 2 testato
- [ ] Scenario 3 testato
- [ ] CRM campi completi
- [ ] PDF template validato
- [ ] KPI visibili

---

Documento ufficiale – Make Flow Spec (Versione Robusta) – AYNIX
