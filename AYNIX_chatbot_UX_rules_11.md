# AYNIX – Chatbot UX Rules
Documento operativo per **softwareista / UX / frontend**  
Sistema: **AYNIX Diagnostic Assistant**

---

## OBIETTIVO
Definire **quando il chatbot appare e quando tace**, per non disturbare l’utente e rafforzare il posizionamento AYNIX basato sulla diagnosi.

Il chatbot:
- **aiuta a decidere**
- **non interrompe flussi**
- **non sostituisce la diagnosi**

---

## PRINCIPIO BASE (NON NEGOZIABILE)

> **Se l’utente è già in un flusso deciso, il chatbot tace.**  
> **Se l’utente è indeciso, il chatbot può parlare.**

---

## DOVE DEVE APPARIRE ✅

### 1️⃣ HOME PAGE

**Comportamento**
- Popup automatico **ritardato**
- Oppure apertura su scroll

**Trigger consigliati**
- Dopo **6–10 secondi**
- Oppure dopo **30–40% scroll**

**Motivo**
- L’utente ha già letto headline e posizionamento
- Il chatbot rafforza il messaggio
- Non interrompe la prima impressione

---

### 2️⃣ PAGINE SERVIZI / SOLUZIONI

**Comportamento**
- Popup intelligente

**Trigger consigliati**
- **50% scroll**
- **Exit intent** (mouse verso chiusura tab)

**Motivo**
- Qui nasce confusione o dubbio
- Il chatbot canalizza verso la diagnosi

---

### 3️⃣ PAGINE MANIFESTO / CHI SIAMO / APPROFONDIMENTI

**Comportamento**
- **Nessun popup automatico**
- Solo **icona cliccabile**

**Motivo**
- L’utente è in lettura
- Non va interrotto

---

### 4️⃣ UTENTE DI RITORNO (COOKIE / LOCAL STORAGE)

**Comportamento**
- Popup anticipato

**Trigger consigliati**
- Dopo **3–5 secondi**

**Motivo**
- Interesse già dimostrato
- Possiamo essere più diretti

---

## DOVE DEVE TACERE ❌

### 1️⃣ PAGINA /DIAGNOSI

**Regola**
- Chatbot **disabilitato**

**Motivo**
- L’utente ha già preso la decisione
- Il chatbot diventa rumore

---

### 2️⃣ QUESTIONARIO DIAGNOSI

**Regola**
- Nessun chatbot
- Nessuna icona
- Nessun overlay

**Motivo**
- Riduce la concentrazione
- Aumenta l’abbandono

---

### 3️⃣ THANK YOU PAGE

**Regola**
- Chatbot **disabilitato**

**Motivo**
- Il flusso è concluso
- Ora parlano email e follow-up

---

### 4️⃣ MOBILE (REGOLA SPECIALE)

**Comportamento**
- ❌ Nessun popup automatico
- ✅ Solo icona discreta

**Motivo**
- Spazio limitato
- Alta percezione di disturbo

---

## RIASSUNTO OPERATIVO

| Pagina / Stato             | Comportamento Chatbot |
|----------------------------|-----------------------|
| Home                       | Popup ritardato       |
| Servizi / Soluzioni        | Popup intelligente    |
| Chi siamo / Manifesto      | Solo icona            |
| /diagnosi                  | Disabilitato          |
| Questionario               | Disabilitato          |
| Thank you                  | Disabilitato          |
| Mobile                     | Solo icona            |

---

## REGOLE TECNICHE CONSIGLIATE

- Condizioni per URL
- Delay time configurabile
- Scroll depth trigger
- Cookie / localStorage:
  - `visited = true`
- No AI complessa
- No loop conversazionali

---

## REGOLA FINALE
> **Meglio un chatbot che parla poco  
che uno che parla sempre.**

---

Documento ufficiale – Chatbot UX Rules – AYNIX
