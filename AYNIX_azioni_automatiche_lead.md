# AYNIX – Azioni Automatiche per Lead Freddo / Medio / Caldo
Documento operativo per **WordPress + CRM / Automazioni**  
Sistema: **Diagnosi & Vendita Custom**

---

## SCOPO DEL DOCUMENTO
Definire **azioni automatiche chiare e non negoziabili** dopo il completamento del questionario di diagnosi, in base allo **score del lead**.

Questo file serve a:
- softwareista / sviluppatore
- chi imposta automazioni (Make / Zapier / WP)
- team AYNIX (allineamento operativo)

---

## CLASSIFICAZIONE LEAD (INPUT)

Lo score viene calcolato dal questionario di diagnosi.

- **Lead Freddo:** score basso  
- **Lead Medio:** score medio  
- **Lead Caldo:** score alto  

👉 Le soglie sono definite nel file:  
`AYNIX_questionario_diagnosi.md`

---

# 🔵 LEAD FREDDO

## Profilo
- Problema non prioritario
- Basso impatto o bassa urgenza
- Non è il momento giusto

---

## AZIONI AUTOMATICHE

1. **Thank You Page standard**
   - Messaggio rassicurante
   - Nessuna call proposta

2. **Email di conferma**
   - Oggetto: “Abbiamo ricevuto la tua diagnosi”
   - (copy già definito)

3. **Email educativa (1 sola)**
   - Contenuto utile sul problema indicato
   - Nessuna CTA commerciale
   - Nessun link calendario

4. **Uscita dal funnel attivo**
   - Tag: `lead_freddo`
   - Nessun follow-up automatico ulteriore

---

## COSA NON FARE
- ❌ Call
- ❌ WhatsApp
- ❌ Vendita
- ❌ Pressione

---

## OBIETTIVO
> Lasciare una buona impressione senza forzare.

---

# 🟡 LEAD MEDIO

## Profilo
- Problema reale
- Priorità media o timing non immediato
- Potenziale futuro

---

## AZIONI AUTOMATICHE

1. **Thank You Page standard**

2. **Email di conferma**

3. **Email “passo intermedio”**
   - Contenuto mirato all’area problema
   - Serve a far riflettere
   - Nessuna vendita

4. **Follow-up soft (7–14 giorni)**
   - 1 solo messaggio automatico
   - Tipo: “Quando ha senso intervenire”

5. **Call**
   - ❌ NON automatica
   - ✅ Solo se richiesta dal lead

---

## TAG / STATUS
- Tag: `lead_medio`
- Stato: nurturing leggero

---

## OBIETTIVO
> Accompagnare senza forzare, far maturare il bisogno.

---

# 🔴 LEAD CALDO

## Profilo
- Problema critico
- Impatto chiaro
- Buon fit per AYNIX

---

## AZIONI AUTOMATICHE

1. **Thank You Page standard**

2. **Email di conferma**

3. **Email “Prossimo passo”**
   - Invito a call breve (15–20 min)
   - Link Calendly
   - Nessuna vendita promessa

4. **WhatsApp (opzionale ma consigliato)**
   - Solo con consenso esplicito
   - 1 messaggio 1:1
   - Tono umano, non automatico

5. **Preparazione interna**
   - Inviare a team:
     - score
     - area problema
     - note chiave
   - Obiettivo: call preparata in < 5 min

---

## TAG / STATUS
- Tag: `lead_caldo`
- Stato: attivo / prioritario

---

## OBIETTIVO
> Trasformare la diagnosi in una decisione consapevole.

---

# TABELLA RIASSUNTIVA

| Azione             | Freddo | Medio | Caldo |
|--------------------|--------|-------|-------|
| Thank You Page     | ✅     | ✅    | ✅    |
| Email conferma     | ✅     | ✅    | ✅    |
| Contenuto utile    | ✅     | ✅    | ⚠️ opz. |
| Call               | ❌     | ⚠️ su richiesta | ✅ |
| WhatsApp           | ❌     | ❌    | ✅ |
| Vendita diretta    | ❌     | ❌    | ❌ |

---

## REGOLA NON NEGOZIABILE
> **Mai anticipare la maturità del lead.**

Se un’azione:
- forza la vendita  
- anticipa la call  
- ignora lo score  

👉 è da eliminare.

---

## NOTE TECNICHE WORDPRESS

- Le azioni possono essere gestite via:
  - plugin CRM
  - Make / Zapier
  - automazioni WP
- Lo score deve essere salvato come:
  - campo personalizzato
  - o tag

---

Documento operativo – Azioni Automatiche AYNIX
