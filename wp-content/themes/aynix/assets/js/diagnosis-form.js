/**
 * Questionario Diagnosi AYNIX
 * Multi-step form con validazione e salvataggio
 */

(function($) {
    'use strict';

    const DiagnosisForm = {
        currentStep: 0,
        formData: {},
        totalSteps: 10,

        init: function() {
            this.renderForm();
            this.bindEvents();
        },

        questions: {
            it: [
                {
                    id: 'settore',
                    question: 'In quale settore opera la tua azienda?',
                    type: 'radio',
                    options: ['Servizi', 'Logistica / Trasporti', 'Produzione / Industria', 'Retail / E-commerce', 'Altro']
                },
                {
                    id: 'dimensione',
                    question: 'Dimensione dell\'organizzazione',
                    type: 'radio',
                    options: ['1-5 persone', '6-20 persone', '21-50 persone', '50+ persone']
                },
                {
                    id: 'area_problema',
                    question: 'Quale area oggi crea più difficoltà?',
                    type: 'radio',
                    options: ['Vendite', 'Operazioni / Processi interni', 'Amministrazione', 'Logistica', 'Customer support']
                },
                {
                    id: 'problema_principale',
                    question: 'Qual è il problema principale che stai vivendo?',
                    type: 'radio',
                    options: ['Perdiamo troppo tempo', 'Ci sono troppi errori manuali', 'Mancanza di controllo / dati', 'I costi stanno aumentando', 'Facciamo fatica a scalare']
                },
                {
                    id: 'criticita',
                    question: 'Quanto è critico questo problema?',
                    type: 'radio',
                    options: ['È un fastidio', 'Ha un impatto economico', 'Sta bloccando la crescita']
                },
                {
                    id: 'gestione_attuale',
                    question: 'Come gestite oggi questo processo?',
                    type: 'radio',
                    options: ['Manualmente (email, Excel, carta)', 'Con strumenti parziali', 'Con sistemi strutturati', 'Non è chiaramente definito']
                },
                {
                    id: 'volume',
                    question: 'Volume medio mensile coinvolto (ordini, richieste, documenti, clienti)',
                    type: 'radio',
                    options: ['< 100', '100 – 500', '500 – 2.000', '> 2.000']
                },
                {
                    id: 'obiettivo',
                    question: 'Qual è l\'obiettivo principale?',
                    type: 'radio',
                    options: ['Ridurre costi', 'Risparmiare tempo', 'Avere più controllo', 'Scalare senza assumere']
                },
                {
                    id: 'timing',
                    question: 'In che orizzonte temporale vorresti risolvere il problema?',
                    type: 'radio',
                    options: ['Subito / urgente', '3–6 mesi', '> 6 mesi']
                },
                {
                    id: 'budget',
                    question: 'Hai già previsto un budget per affrontare questo problema?',
                    type: 'radio',
                    options: ['Sì, indicativamente', 'Non ancora', 'No']
                }
            ],
            en: [
                {
                    id: 'settore',
                    question: 'Which sector does your company operate in?',
                    type: 'radio',
                    options: ['Services', 'Logistics / Transportation', 'Manufacturing / Industry', 'Retail / E-commerce', 'Other']
                },
                {
                    id: 'dimensione',
                    question: 'Company size',
                    type: 'radio',
                    options: ['1-5 people', '6-20 people', '21-50 people', '50+ people']
                },
                {
                    id: 'area_problema',
                    question: 'Which area currently causes the most difficulties?',
                    type: 'radio',
                    options: ['Sales', 'Operations / Internal processes', 'Administration', 'Logistics', 'Customer support']
                },
                {
                    id: 'problema_principale',
                    question: 'What is the main problem you are experiencing?',
                    type: 'radio',
                    options: ['Too much time wasted', 'Too many manual errors', 'Lack of control / data visibility', 'Increasing costs', 'Difficulty scaling']
                },
                {
                    id: 'criticita',
                    question: 'How critical is this problem?',
                    type: 'radio',
                    options: ['Minor inconvenience', 'Financial impact', 'Blocking growth']
                },
                {
                    id: 'gestione_attuale',
                    question: 'How is this process managed today?',
                    type: 'radio',
                    options: ['Manually (emails, spreadsheets, paper)', 'With partially structured tools', 'With structured systems', 'Not clearly defined']
                },
                {
                    id: 'volume',
                    question: 'Average monthly volume involved (orders, requests, documents, customers)',
                    type: 'radio',
                    options: ['< 100', '100 – 500', '500 – 2,000', '> 2,000']
                },
                {
                    id: 'obiettivo',
                    question: 'What is your main objective?',
                    type: 'radio',
                    options: ['Reduce costs', 'Save time', 'Gain more control', 'Scale without hiring']
                },
                {
                    id: 'timing',
                    question: 'When would you like to address this problem?',
                    type: 'radio',
                    options: ['Immediately / urgent', 'Within 3–6 months', 'In more than 6 months']
                },
                {
                    id: 'budget',
                    question: 'Have you already allocated a budget to address this problem?',
                    type: 'radio',
                    options: ['Yes, approximately', 'Not yet', 'No']
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
            const question = this.questions[lang][this.currentStep];
            const container = $('.question-container');
            
            let optionsHtml = '';
            question.options.forEach((option, index) => {
                const isChecked = this.formData[question.id] === option ? 'checked' : '';
                optionsHtml += `
                    <label class="radio-option ${isChecked}">
                        <input type="radio" name="${question.id}" value="${option}" ${isChecked}>
                        <span class="radio-label">${option}</span>
                    </label>
                `;
            });
            
            const html = `
                <div class="question-step" data-step="${this.currentStep}">
                    <p class="step-indicator">Domanda ${this.currentStep + 1} di ${this.totalSteps}</p>
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
            
            $(document).on('click', '#submit-btn', function() {
                self.submitForm();
            });
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
                    if (response.success) {
                        window.location.href = '/grazie-diagnosi';
                    } else {
                        alert('Errore nell\'invio. Riprova.');
                        $('#submit-btn').prop('disabled', false).text('Invia Diagnosi');
                    }
                },
                error: function() {
                    alert('Errore di connessione. Riprova.');
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
