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
        isTransitioning: false, // Flag per prevenire avanzamenti multipli

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
            ],
            es: [
                {
                    id: 'tipo_progetto',
                    question: '¿Qué tipo de solución buscas?',
                    type: 'radio',
                    options: ['Aplicación Web', 'App Móvil (iOS/Android)', 'Software de Escritorio', 'Sistema de gestión personalizado', 'Automatización / Integración', 'No estoy seguro']
                },
                {
                    id: 'obiettivo_principale',
                    question: '¿Cuál es el objetivo principal del proyecto?',
                    type: 'radio',
                    options: ['Automatizar procesos internos', 'Vender online / E-commerce', 'Gestionar clientes y datos', 'Comunicar con clientes', 'Otro']
                },
                {
                    id: 'funzionalita',
                    question: '¿Qué funcionalidades principales necesitas?',
                    type: 'checkbox',
                    options: ['Gestión de usuarios / Login', 'Base de datos / Almacenamiento', 'Pagos online', 'Integraciones (CRM, email, etc)', 'Dashboard / Reportes', 'App móvil', 'API / Automatizaciones']
                },
                {
                    id: 'utenti_target',
                    question: '¿Quién usará principalmente esta solución?',
                    type: 'radio',
                    options: ['Solo mi equipo interno', 'Mis clientes', 'Equipo y clientes', 'Socios / Proveedores']
                },
                {
                    id: 'numero_utenti',
                    question: '¿Cuántos usuarios prevés?',
                    type: 'radio',
                    options: ['< 10', '10-50', '50-200', '200-1000', '> 1000']
                },
                {
                    id: 'stato_progetto',
                    question: '¿En qué punto está tu proyecto?',
                    type: 'radio',
                    options: ['Solo una idea inicial', 'Tengo especificaciones detalladas', 'Ya tengo un prototipo/MVP', 'Tengo algo que mejorar']
                },
                {
                    id: 'complessita',
                    question: 'Complejidad percibida del proyecto',
                    type: 'radio',
                    options: ['Simple (landing page, formularios)', 'Media (sistema de gestión básico)', 'Compleja (marketplace, plataforma)', 'Muy compleja (fintech, healthcare)']
                },
                {
                    id: 'tempistiche',
                    question: '¿En cuánto tiempo quieres lanzar?',
                    type: 'radio',
                    options: ['< 1 mes', '1-3 meses', '3-6 meses', '> 6 meses', 'Sin plazo']
                },
                {
                    id: 'budget',
                    question: '¿Cuál es tu presupuesto indicativo?',
                    type: 'radio',
                    options: ['< €5.000', '€5.000 - €15.000', '€15.000 - €50.000', '> €50.000', 'Por definir']
                },
                {
                    id: 'dettagli_extra',
                    question: 'Describe brevemente tu proyecto (opcional)',
                    type: 'textarea',
                    placeholder: 'Ej: Quiero una app para gestionar las reservas de mi restaurante con pago online...'
                }
            ],
            pt: [
                {
                    id: 'tipo_progetto',
                    question: 'Que tipo de solução procura?',
                    type: 'radio',
                    options: ['Aplicação Web', 'App Móvel (iOS/Android)', 'Software Desktop', 'Sistema de gestão personalizado', 'Automação / Integração', 'Não tenho certeza']
                },
                {
                    id: 'obiettivo_principale',
                    question: 'Qual é o objetivo principal do projeto?',
                    type: 'radio',
                    options: ['Automatizar processos internos', 'Vender online / E-commerce', 'Gerir clientes e dados', 'Comunicar com clientes', 'Outro']
                },
                {
                    id: 'funzionalita',
                    question: 'Quais funcionalidades principais precisa?',
                    type: 'checkbox',
                    options: ['Gestão de utilizadores / Login', 'Base de dados / Armazenamento', 'Pagamentos online', 'Integrações (CRM, email, etc)', 'Dashboard / Relatórios', 'App móvel', 'API / Automações']
                },
                {
                    id: 'utenti_target',
                    question: 'Quem usará principalmente esta solução?',
                    type: 'radio',
                    options: ['Apenas minha equipe interna', 'Meus clientes', 'Equipe e clientes', 'Parceiros / Fornecedores']
                },
                {
                    id: 'numero_utenti',
                    question: 'Quantos utilizadores prevê?',
                    type: 'radio',
                    options: ['< 10', '10-50', '50-200', '200-1000', '> 1000']
                },
                {
                    id: 'stato_progetto',
                    question: 'Em que ponto está o seu projeto?',
                    type: 'radio',
                    options: ['Apenas uma ideia inicial', 'Tenho especificações detalhadas', 'Já tenho um protótipo/MVP', 'Tenho algo a melhorar']
                },
                {
                    id: 'complessita',
                    question: 'Complexidade percebida do projeto',
                    type: 'radio',
                    options: ['Simples (landing page, formulários)', 'Média (sistema de gestão básico)', 'Complexa (marketplace, plataforma)', 'Muito complexa (fintech, healthcare)']
                },
                {
                    id: 'tempistiche',
                    question: 'Em quanto tempo quer lançar?',
                    type: 'radio',
                    options: ['< 1 mês', '1-3 meses', '3-6 meses', '> 6 meses', 'Sem prazo']
                },
                {
                    id: 'budget',
                    question: 'Qual é o seu orçamento indicativo?',
                    type: 'radio',
                    options: ['< €5.000', '€5.000 - €15.000', '€15.000 - €50.000', '> €50.000', 'A definir']
                },
                {
                    id: 'dettagli_extra',
                    question: 'Descreva brevemente o seu projeto (opcional)',
                    type: 'textarea',
                    placeholder: 'Ex: Quero uma app para gerir as reservas do meu restaurante com pagamento online...'
                }
            ]
        },

        getLanguage: function() {
            const cookies = document.cookie.split(';');
            for (let cookie of cookies) {
                const [name, value] = cookie.trim().split('=');
                if (name === 'site_lang') {
                    const lang = value.trim();
                    return ['it', 'en', 'es', 'pt'].includes(lang) ? lang : 'it';
                }
            }
            return 'it';
        },

        renderForm: function() {
            const lang = this.getLanguage();
            const container = $('#diagnosi-form');
            
            const labels = {
                it: { prev: '« Indietro', next: 'Avanti »', submit: 'Invia Diagnosi' },
                en: { prev: '« Back', next: 'Next »', submit: 'Submit Diagnosis' },
                es: { prev: '« Atrás', next: 'Siguiente »', submit: 'Enviar Diagnóstico' },
                pt: { prev: '« Voltar', next: 'Próximo »', submit: 'Enviar Diagnóstico' }
            };
            
            const html = `
                <div id="diagnosis-questionnaire">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: ${(this.currentStep / this.totalSteps) * 100}%"></div>
                    </div>
                    <div class="question-container"></div>
                    <div class="form-navigation">
                        <button type="button" class="btn-secondary" id="prev-btn" style="display:none;">${labels[lang].prev}</button>
                        <button type="button" class="btn-primary" id="next-btn">${labels[lang].next}</button>
                        <button type="button" class="btn-primary btn-submit" id="submit-btn" style="display:none;">${labels[lang].submit}</button>
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
                const emailLabels = {
                    it: {
                        label: 'Inserisci la tua email per ricevere la proposta personalizzata',
                        placeholder: 'tua@email.com',
                        step: 'Step'
                    },
                    en: {
                        label: 'Enter your email to receive the personalized proposal',
                        placeholder: 'your@email.com',
                        step: 'Step'
                    },
                    es: {
                        label: 'Ingresa tu email para recibir la propuesta personalizada',
                        placeholder: 'tu@email.com',
                        step: 'Paso'
                    },
                    pt: {
                        label: 'Insira o seu email para receber a proposta personalizada',
                        placeholder: 'seu@email.com',
                        step: 'Passo'
                    }
                };
                
                const html = `
                    <div class="question-step" data-step="${this.currentStep}">
                        <p class="step-indicator">${emailLabels[lang].step} ${this.currentStep + 1} di ${this.totalSteps}</p>
                        <h3 class="question-title">${emailLabels[lang].label}</h3>
                        <div class="options-container">
                            <input type="email" id="user-email" class="email-input" placeholder="${emailLabels[lang].placeholder}" value="${this.formData.email || ''}" required>
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
                        <label class="checkbox-option ${isChecked}">
                            <input type="checkbox" name="${question.id}" value="${option}" ${isChecked}>
                            <span class="checkbox-label">${option}</span>
                        </label>
                    `;
                });
            }
            // Radio
            else {
                question.options.forEach((option, index) => {
                    const isChecked = this.formData[question.id] === option ? 'checked' : '';
                    optionsHtml += `
                        <label class="radio-option ${isChecked}">
                            <input type="radio" name="${question.id}" value="${option}" ${isChecked}>
                            <span class="radio-label">${option}</span>
                        </label>
                    `;
                });
            }
            
            const questionLabels = {
                it: { question: 'Domanda', of: 'di' },
                en: { question: 'Question', of: 'of' },
                es: { question: 'Pregunta', of: 'de' },
                pt: { question: 'Pergunta', of: 'de' }
            };
            
            const html = `
                <div class="question-step" data-step="${this.currentStep}">
                    <p class="step-indicator">${questionLabels[lang].question} ${this.currentStep + 1} ${questionLabels[lang].of} ${this.totalSteps - 1}</p>
                    <h3 class="question-title">${question.question}</h3>
                    <div class="options-container">
                        ${optionsHtml}
                    </div>
                </div>
            `;
            
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
            
            // Radio click con auto-advance
            $(document).on('click', '.radio-option', function(e) {
                // Previeni eventi multipli
                if (self.isTransitioning) {
                    return;
                }
                
                const input = $(this).find('input');
                const questionId = input.attr('name');
                const value = input.val();
                
                $('.radio-option').removeClass('checked');
                $(this).addClass('checked');
                
                self.formData[questionId] = value;
                
                // Auto-advance solo se non siamo alla penultima domanda (prima dell'email)
                self.isTransitioning = true;
                setTimeout(() => {
                    if (self.currentStep < self.totalSteps - 2) {
                        self.nextStep();
                    }
                    self.isTransitioning = false;
                }, 400);
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
                const lang = self.getLanguage();
                const errorMessages = {
                    it: 'Inserisci un indirizzo email valido',
                    en: 'Please enter a valid email address',
                    es: 'Por favor ingresa un email válido',
                    pt: 'Por favor insira um email válido'
                };
                
                // Validate email
                const email = $('#user-email').val();
                if (!email || !self.validateEmail(email)) {
                    alert(errorMessages[lang]);
                    return;
                }
                self.formData.email = email;
                self.submitForm();
            });
        },
        
        validateEmail: function(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        },

        nextStep: function() {
            if (this.isTransitioning && this.currentStep < this.totalSteps - 1) {
                return; // Previeni avanzamenti durante transizione
            }
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
            const lang = this.getLanguage();
            
            const messages = {
                it: {
                    invalidEmail: 'Inserisci un indirizzo email valido',
                    sending: 'Invio in corso...',
                    submit: 'Invia Diagnosi',
                    error: 'Errore: ',
                    defaultError: 'Errore nell\'invio. Riprova.',
                    connectionError: 'Errore di connessione: '
                },
                en: {
                    invalidEmail: 'Please enter a valid email address',
                    sending: 'Sending...',
                    submit: 'Submit Diagnosis',
                    error: 'Error: ',
                    defaultError: 'Submission error. Please try again.',
                    connectionError: 'Connection error: '
                },
                es: {
                    invalidEmail: 'Por favor ingresa un email válido',
                    sending: 'Enviando...',
                    submit: 'Enviar Diagnóstico',
                    error: 'Error: ',
                    defaultError: 'Error al enviar. Inténtalo de nuevo.',
                    connectionError: 'Error de conexión: '
                },
                pt: {
                    invalidEmail: 'Por favor insira um email válido',
                    sending: 'Enviando...',
                    submit: 'Enviar Diagnóstico',
                    error: 'Erro: ',
                    defaultError: 'Erro ao enviar. Tente novamente.',
                    connectionError: 'Erro de conexão: '
                }
            };
            
            // Validate email
            const email = $('#user-email').val();
            console.log('Email field value:', email);
            
            if (!email || !this.validateEmail(email)) {
                alert(messages[lang].invalidEmail);
                return;
            }
            
            // Salva email in formData
            this.formData.email = email;
            console.log('FormData before submit:', this.formData);
            
            $('#submit-btn').prop('disabled', true).text(messages[lang].sending);
            
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: {
                    action: 'save_diagnosis',
                    formData: this.formData,
                    timestamp: new Date().toISOString(),
                    user_lang: lang
                },
                success: function(response) {
                    console.log('Response:', response);
                    if (response.success) {
                        window.location.href = '/grazie-diagnosi';
                    } else {
                        console.error('Errore backend:', response.data);
                        alert(messages[lang].error + (response.data.message || messages[lang].defaultError));
                        $('#submit-btn').prop('disabled', false).text(messages[lang].submit);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Errore AJAX:', xhr.responseText, status, error);
                    alert(messages[lang].connectionError + error);
                    $('#submit-btn').prop('disabled', false).text(messages[lang].submit);
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
