/**
 * Questionario Diagnosi AYNIX
 * Multi-step form con validazione e salvataggio
 */

(function($) {
    'use strict';

    const DiagnosisForm = {
        currentStep: 0,
        formData: {},
        totalSteps: 11, // 10 domande + email

        init: function() {
            this.renderForm();
            this.bindEvents();
        },

        questions: {
            it: [
                {
                    id: 'tipo_progetto',
                    question: 'Che tipo di soluzione stai cercando?',
                    type: 'radio',
                    options: ['Web App', 'App Mobile (iOS/Android)', 'Software Desktop', 'Sistema gestionale custom', 'Automazione / Integrazione', 'Non sono sicuro']
                },
                {
                    id: 'obiettivo_principale',
                    question: 'Qual è l\'obiettivo principale del progetto?',
                    type: 'radio',
                    options: ['Automatizzare processi interni', 'Vendere online / E-commerce', 'Gestire clienti e dati', 'Comunicare con i clienti', 'Altro']
                },
                {
                    id: 'funzionalita',
                    question: 'Quali funzionalità principali ti servono?',
                    type: 'checkbox',
                    options: ['Gestione utenti / Login', 'Database / Archiviazione dati', 'Pagamenti online', 'Integrazioni (CRM, email, etc)', 'Dashboard / Report', 'App mobile', 'API / Automazioni']
                },
                {
                    id: 'utenti_target',
                    question: 'Chi userà principalmente questa soluzione?',
                    type: 'radio',
                    options: ['Solo il mio team interno', 'I miei clienti', 'Sia team che clienti', 'Partner / Fornitori']
                },
                {
                    id: 'numero_utenti',
                    question: 'Quanti utenti prevedi?',
                    type: 'radio',
                    options: ['< 10', '10-50', '50-200', '200-1000', '> 1000']
                },
                {
                    id: 'stato_progetto',
                    question: 'A che punto sei con il progetto?',
                    type: 'radio',
                    options: ['Solo un\'idea iniziale', 'Ho specifiche dettagliate', 'Ho già un prototipo/MVP', 'Ho già qualcosa ma va migliorato']
                },
                {
                    id: 'complessita',
                    question: 'Complessità percepita del progetto',
                    type: 'radio',
                    options: ['Semplice (landing page, form)', 'Media (gestionale base)', 'Complessa (marketplace, piattaforma)', 'Molto complessa (fintech, healthcare)']
                },
                {
                    id: 'tempistiche',
                    question: 'In quanto tempo vorresti lanciare?',
                    type: 'radio',
                    options: ['< 1 mese', '1-3 mesi', '3-6 mesi', '> 6 mesi', 'Non ho scadenze']
                },
                {
                    id: 'budget',
                    question: 'Qual è il tuo budget indicativo?',
                    type: 'radio',
                    options: ['< 5.000€', '5.000€ - 15.000€', '15.000€ - 50.000€', '> 50.000€', 'Da definire']
                },
                {
                    id: 'dettagli_extra',
                    question: 'Descrivi brevemente il tuo progetto (opzionale)',
                    type: 'textarea',
                    placeholder: 'Es: Voglio un\'app per gestire le prenotazioni del mio ristorante con pagamento online...'
                }
            ],
            en: [
                {
                    id: 'tipo_progetto',
                    question: 'What type of solution are you looking for?',
                    type: 'radio',
                    options: ['Web App', 'Mobile App (iOS/Android)', 'Desktop Software', 'Custom ERP/Management System', 'Automation / Integration', 'Not sure']
                },
                {
                    id: 'obiettivo_principale',
                    question: 'What is the main goal of the project?',
                    type: 'radio',
                    options: ['Automate internal processes', 'Sell online / E-commerce', 'Manage clients and data', 'Communicate with customers', 'Other']
                },
                {
                    id: 'funzionalita',
                    question: 'Which main features do you need?',
                    type: 'checkbox',
                    options: ['User management / Login', 'Database / Data storage', 'Online payments', 'Integrations (CRM, email, etc)', 'Dashboard / Reports', 'Mobile app', 'API / Automations']
                },
                {
                    id: 'utenti_target',
                    question: 'Who will primarily use this solution?',
                    type: 'radio',
                    options: ['Only my internal team', 'My customers', 'Both team and customers', 'Partners / Suppliers']
                },
                {
                    id: 'numero_utenti',
                    question: 'How many users do you expect?',
                    type: 'radio',
                    options: ['< 10', '10-50', '50-200', '200-1000', '> 1000']
                },
                {
                    id: 'stato_progetto',
                    question: 'What stage is your project at?',
                    type: 'radio',
                    options: ['Just an initial idea', 'I have detailed specifications', 'I already have a prototype/MVP', 'I have something but needs improvement']
                },
                {
                    id: 'complessita',
                    question: 'Perceived project complexity',
                    type: 'radio',
                    options: ['Simple (landing page, forms)', 'Medium (basic management system)', 'Complex (marketplace, platform)', 'Very complex (fintech, healthcare)']
                },
                {
                    id: 'tempistiche',
                    question: 'When would you like to launch?',
                    type: 'radio',
                    options: ['< 1 month', '1-3 months', '3-6 months', '> 6 months', 'No deadline']
                },
                {
                    id: 'budget',
                    question: 'What is your indicative budget?',
                    type: 'radio',
                    options: ['< €5,000', '€5,000 - €15,000', '€15,000 - €50,000', '> €50,000', 'To be defined']
                },
                {
                    id: 'dettagli_extra',
                    question: 'Briefly describe your project (optional)',
                    type: 'textarea',
                    placeholder: 'E.g., I want an app to manage my restaurant bookings with online payment...'
                }
            ]
        },

        getLanguage: function() {
            const cookies = document.cookie.split(';');
            for (let cookie of cookies) {
                const [name, value] = cookie.trim().split('=');
                if (name === 'site_lang') {
                    return value === 'it' ? 'it' : 'en';
                }
            }
            return 'it';
        },

        renderForm: function() {
            const lang = this.getLanguage();
            const container = $('#diagnosi-form');
            
            const html = `
                <div id="diagnosis-questionnaire">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: ${(this.currentStep / this.totalSteps) * 100}%"></div>
                    </div>
                    <div class="question-container"></div>
                    <div class="form-navigation">
                        <button type="button" class="btn-secondary" id="prev-btn" style="display:none;">« Indietro</button>
                        <button type="button" class="btn-primary" id="next-btn">Avanti »</button>
                        <button type="button" class="btn-primary btn-submit" id="submit-btn" style="display:none;">Invia Diagnosi</button>
                    </div>
                </div>
            `;
            
            container.html(html);
            this.renderQuestion();
        },

        renderQuestion: function() {
            const lang = this.getLanguage();
            const container = $('.question-container');
            
            // Step finale: richiesta email
            if (this.currentStep === this.totalSteps - 1) {
                const emailLabel = lang === 'it' ? 'Inserisci la tua email per ricevere la proposta personalizzata' : 'Enter your email to receive the personalized proposal';
                const emailPlaceholder = lang === 'it' ? 'tua@email.com' : 'your@email.com';
                
                const html = `
                    <div class="question-step" data-step="${this.currentStep}">
                        <p class="step-indicator">Step ${this.currentStep + 1} di ${this.totalSteps}</p>
                        <h3 class="question-title">${emailLabel}</h3>
                        <div class="options-container">
                            <input type="email" id="user-email" class="email-input" placeholder="${emailPlaceholder}" value="${this.formData.email || ''}" required>
                        </div>
                    </div>
                `;
                container.html(html);
                this.updateNavigation();
                return;
            }
            
            const question = this.questions[lang][this.currentStep];
            
            let optionsHtml = '';
            
            // Textarea
            if (question.type === 'textarea') {
                const value = this.formData[question.id] || '';
                optionsHtml = `
                    <textarea id="${question.id}" name="${question.id}" class="textarea-input" 
                              placeholder="${question.placeholder || ''}" rows="5">${value}</textarea>
                `;
            }
            // Checkbox
            else if (question.type === 'checkbox') {
                const selectedValues = this.formData[question.id] || [];
                question.options.forEach((option, index) => {
                    const isChecked = selectedValues.includes(option) ? 'checked' : '';
                    optionsHtml += `
            // Radio click con auto-advance
            $(document).on('click', '.radio-option', function() {
                const input = $(this).find('input');
                const questionId = input.attr('name');
                const value = input.val();
                
                $('.radio-option').removeClass('checked');
                $(this).addClass('checked');
                
                self.formData[questionId] = value;
                
                // Auto-advance solo se non siamo alla penultima domanda (prima dell'email)
                setTimeout(() => {
                    if (self.currentStep < self.totalSteps - 2) {
                        self.nextStep();
                    }
                }, 300);
            });
            
            // Checkbox toggle
            $(document).on('change', '.checkbox-option input', function() {
                const questionId = $(this).attr('name');
                const value = $(this).val();
                
                if (!self.formData[questionId]) {
                    self.formData[questionId] = [];
                }
                
                if ($(this).is(':checked')) {
                    $(this).closest('.checkbox-option').addClass('checked');
                    if (!self.formData[questionId].includes(value)) {
                        self.formData[questionId].push(value);
                    }
                } else {
                    $(this).closest('.checkbox-option').removeClass('checked');
                    self.formData[questionId] = self.formData[questionId].filter(v => v !== value);
                }
            });
            
            // Textarea change
            $(document).on('blur', '.textarea-input', function() {
                const questionId = $(this).attr('name');
                self.formData[questionId] = $(this).val();
            });
            
            // Textarea input - salva anche durante la digitazione
            $(document).on('input', '.textarea-input', function() {
                const questionId = $(this).attr('name');
                self.formData[questionId] = $(this).val();
            });
            
            // Email input
            $(document).on('blur', '#user-email', function() {
                self.formData.email = $(this).val();
            });
            
            $(document).on('click', '#next-btn', function() {
                self.nextStep();
            });
            
            $(document).on('click', '#prev-btn', function() {
                self.prevStep();
            });
            
            $(document).on('click', '#submit-btn', function() {
                // Validate email
                const email = $('#user-email').val();
                if (!email || !self.validateEmail(email)) {
                    alert('Inserisci un indirizzo email valido');
                    return;
                }
                self.formData.email = email;
                self.submitForm();
            });
        },
        
        validateEmail: function(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email;
            
            container.html(html);
            this.updateNavigation();
        },

        updateNavigation: function() {
            $('#prev-btn').toggle(this.currentStep > 0);
            $('#next-btn').toggle(this.currentStep < this.totalSteps - 1);
            $('#submit-btn').toggle(this.currentStep === this.totalSteps - 1);
            
            $('.progress-fill').css('width', `${((this.currentStep + 1) / this.totalSteps) * 100}%`);
        },

        bindEvents: function() {
            const self = this;
            
            $(document).on('click', '.radio-option', function() {
                const input = $(this).find('input');
                const questionId = input.attr('name');
                const value = input.val();
                
                $('.radio-option').removeClass('checked');
                $(this).addClass('checked');
                
                self.formData[questionId] = value;
                
                // Auto-advance after selection
                setTimeout(() => {
                    if (self.currentStep < self.totalSteps - 1) {
                        self.nextStep();
                    }
                }, 300);
            });
            
            $(document).on('click', '#next-btn', function() {
                self.nextStep();
            });
            
            $(document).on('click', '#prev-btn', function() {
                self.prevStep();
            });
        },
        
        validateEmail: function(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        },

        nextStep: function() {
            if (this.currentStep < this.totalSteps - 1) {
                this.currentStep++;
                this.renderQuestion();
            }
        },

        prevStep: function() {
            if (this.currentStep > 0) {
                this.currentStep--;
                this.renderQuestion();
            }
        },

        submitForm: function() {
            const self = this;
            
            // Validate email
            const email = $('#user-email').val();
            if (!email || !this.validateEmail(email)) {
                alert('Inserisci un indirizzo email valido');
                return;
            }
            
            // Salva email in formData
            this.formData.email = email;
            
            $('#submit-btn').prop('disabled', true).text('Invio in corso...');
            
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: {
                    action: 'save_diagnosis',
                    formData: this.formData,
                    timestamp: new Date().toISOString()
                },
                success: function(response) {
                    console.log('Response:', response);
                    if (response.success) {
                        window.location.href = '/grazie-diagnosi';
                    } else {
                        console.error('Errore backend:', response.data);
                        alert('Errore: ' + (response.data.message || 'Errore nell\'invio. Riprova.'));
                        $('#submit-btn').prop('disabled', false).text('Invia Diagnosi');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Errore AJAX:', xhr.responseText, status, error);
                    alert('Errore di connessione: ' + error);
                    $('#submit-btn').prop('disabled', false).text('Invia Diagnosi');
                }
            });
        }
    };

    // Initialize on page load
    $(document).ready(function() {
        if ($('#diagnosi-form').length) {
            DiagnosisForm.init();
        }
    });

})(jQuery);
