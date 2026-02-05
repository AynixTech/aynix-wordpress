/**
 * AYNIX Chatbot AI - Vanilla JavaScript (Sin jQuery)
 */

(function() {
    'use strict';
    
    const AynixChatbot = {
        
        init: function() {
            console.log('AYNIX Chatbot: Initializing...');
            console.log('aynixChatbot object:', typeof aynixChatbot !== 'undefined' ? aynixChatbot : 'NOT FOUND');
            
            if (typeof aynixChatbot !== 'undefined') {
                console.log('Current language:', aynixChatbot.lang);
                console.log('Translations available:', aynixChatbot.translations);
                console.log('All translations available:', aynixChatbot.allTranslations ? 'YES' : 'NO');
                if (aynixChatbot.allTranslations) {
                    console.log('Languages loaded:', Object.keys(aynixChatbot.allTranslations));
                }
            } else {
                console.error('aynixChatbot object NOT FOUND - translations will not work!');
            }
            
            this.cacheDom();
            this.bindEvents();
            this.initializeChat();
            console.log('AYNIX Chatbot: Initialized successfully');
        },
        
        cacheDom: function() {
            this.toggle = document.getElementById('aynix-chatbot-toggle');
            this.widget = document.getElementById('aynix-chatbot-widget');
            this.messages = document.getElementById('aynix-chatbot-messages');
            this.input = document.getElementById('aynix-chatbot-input');
            this.sendBtn = document.getElementById('aynix-chatbot-send');
            this.minimize = document.querySelector('.chatbot-minimize');
            this.chatTitle = document.querySelector('.chatbot-title span');
            this.languageSwitcher = document.getElementById('languageSwitcher');
            
            console.log('DOM Elements cached:');
            console.log('- Language switcher:', this.languageSwitcher ? 'FOUND' : 'NOT FOUND');
            console.log('- Chat title:', this.chatTitle ? 'FOUND' : 'NOT FOUND');
            console.log('- Input:', this.input ? 'FOUND' : 'NOT FOUND');
        },
        
        bindEvents: function() {
            const self = this;
            
            if (this.toggle) {
                this.toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    self.toggleChat();
                });
            }
            
            if (this.minimize) {
                this.minimize.addEventListener('click', function(e) {
                    e.preventDefault();
                    self.closeChat();
                });
            }
            
            if (this.sendBtn) {
                this.sendBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    self.sendMessage();
                });
            }
            
            if (this.input) {
                this.input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        self.sendMessage();
                    }
                });
            }
            
            // Escuchar cambios de idioma del sitio
            if (this.languageSwitcher) {
                console.log('Language switcher listener attached');
                this.languageSwitcher.addEventListener('change', function(e) {
                    const newLang = e.target.value;
                    console.log('=== LANGUAGE CHANGE DETECTED ===');
                    console.log('New language:', newLang);
                    console.log('aynixChatbot exists:', typeof aynixChatbot !== 'undefined');
                    console.log('allTranslations exists:', typeof aynixChatbot !== 'undefined' && aynixChatbot.allTranslations ? 'YES' : 'NO');
                    
                    // Solo cambiar idioma si tenemos todas las traducciones disponibles
                    if (typeof aynixChatbot !== 'undefined' && aynixChatbot.allTranslations) {
                        console.log('Calling changeLanguage method...');
                        self.changeLanguage(newLang);
                    } else {
                        // Recargar la página con el nuevo idioma
                        console.log('Translations not available, reloading page with lang parameter');
                        window.location.href = window.location.pathname + '?lang=' + newLang;
                    }
                });
            } else {
                console.warn('Language switcher NOT FOUND - dynamic language change disabled');
            }
        },
        
        initializeChat: function() {
            // Chat cerrado por defecto
        },
        
        toggleChat: function() {
            const isActive = this.widget.classList.contains('active');
            
            if (isActive) {
                this.closeChat();
            } else {
                this.openChat();
            }
        },
        
        openChat: function() {
            this.widget.classList.add('active');
            this.toggle.classList.add('active');
            this.widget.style.display = 'flex';
            
            if (this.input) {
                this.input.focus();
            }
            
            localStorage.setItem('aynix_chatbot_open', 'true');
            this.scrollToBottom();
        },
        
        closeChat: function() {
            this.widget.classList.remove('active');
            this.toggle.classList.remove('active');
            this.widget.style.display = 'none';
            
            localStorage.setItem('aynix_chatbot_open', 'false');
        },
        
        sendMessage: function() {
            const message = this.input.value.trim();
            
            if (message === '') {
                return;
            }
            
            this.addMessage(message, 'user');
            this.input.value = '';
            this.setLoading(true);
            this.showTypingIndicator();
            this.sendToServer(message);
        },
        
        addMessage: function(text, type) {
            const messageClass = type === 'user' ? 'user-message' : 'bot-message';
            const formattedText = this.linkify(text);
            
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${messageClass}`;
            messageDiv.innerHTML = `<div class="message-content">${formattedText}</div>`;
            
            this.messages.appendChild(messageDiv);
            this.scrollToBottom();
        },
        
        showTypingIndicator: function() {
            const typingDiv = document.createElement('div');
            typingDiv.className = 'message bot-message typing-indicator-wrapper';
            typingDiv.innerHTML = `
                <div class="message-content typing-indicator">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            `;
            
            this.messages.appendChild(typingDiv);
            this.scrollToBottom();
        },
        
        hideTypingIndicator: function() {
            const typing = this.messages.querySelector('.typing-indicator-wrapper');
            if (typing) {
                typing.remove();
            }
        },
        
        sendToServer: function(message) {
            const self = this;
            
            fetch(aynixChatbot.ajaxUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'aynix_chatbot_message',
                    nonce: aynixChatbot.nonce,
                    message: message,
                    lang: aynixChatbot.lang
                })
            })
            .then(response => response.json())
            .then(data => {
                self.hideTypingIndicator();
                
                if (data.success && data.data.response) {
                    self.addMessage(data.data.response, 'bot');
                } else {
                    self.addMessage(aynixChatbot.translations.errorMessage, 'bot');
                }
                
                self.setLoading(false);
            })
            .catch(error => {
                console.error('Error:', error);
                self.hideTypingIndicator();
                self.addMessage(aynixChatbot.translations.errorMessage, 'bot');
                self.setLoading(false);
            });
        },
        
        setLoading: function(loading) {
            this.input.disabled = loading;
            this.sendBtn.disabled = loading;
            
            if (!loading) {
                this.input.focus();
            }
        },
        
        scrollToBottom: function() {
            this.messages.scrollTop = this.messages.scrollHeight;
        },
        
        linkify: function(text) {
            const div = document.createElement('div');
            div.textContent = text;
            const escaped = div.innerHTML;
            
            const urlRegex = /(https?:\/\/[^\s]+)/g;
            return escaped.replace(urlRegex, function(url) {
                return '<a href="' + url + '" target="_blank" rel="noopener noreferrer">' + url + '</a>';
            });
        },
        
        changeLanguage: function(newLang) {
            console.log('=== changeLanguage() called ===');
            console.log('New language:', newLang);
            console.log('aynixChatbot.allTranslations:', aynixChatbot.allTranslations);
            
            // Verificar que existan las traducciones para el nuevo idioma
            if (!aynixChatbot.allTranslations || !aynixChatbot.allTranslations[newLang]) {
                console.error('Translations not found for language:', newLang);
                console.log('Available languages:', aynixChatbot.allTranslations ? Object.keys(aynixChatbot.allTranslations) : 'NONE');
                return;
            }
            
            console.log('Translations found for', newLang, ':', aynixChatbot.allTranslations[newLang]);
            
            // Actualizar idioma actual
            aynixChatbot.lang = newLang;
            aynixChatbot.translations = aynixChatbot.allTranslations[newLang];
            
            console.log('Updated aynixChatbot.lang to:', aynixChatbot.lang);
            console.log('Updated aynixChatbot.translations:', aynixChatbot.translations);
            
            // Actualizar textos del chatbot
            this.updateChatbotTexts();
            
            console.log('Chatbot language updated successfully to:', newLang);
        },
        
        updateChatbotTexts: function() {
            console.log('=== updateChatbotTexts() called ===');
            const t = aynixChatbot.translations;
            console.log('Using translations:', t);
            
            // Actualizar título del chat
            if (this.chatTitle) {
                console.log('Updating chat title from "' + this.chatTitle.textContent + '" to "' + t.chatTitle + '"');
                this.chatTitle.textContent = t.chatTitle;
            } else {
                console.warn('Chat title element not found');
            }
            
            // Actualizar placeholder del input
            if (this.input) {
                console.log('Updating input placeholder from "' + this.input.placeholder + '" to "' + t.placeholder + '"');
                this.input.placeholder = t.placeholder;
            } else {
                console.warn('Input element not found');
            }
            
            // Actualizar aria-label del botón toggle
            if (this.toggle) {
                this.toggle.setAttribute('aria-label', t.chatTitle);
                console.log('Updated toggle aria-label to:', t.chatTitle);
            }
            
            // Actualizar aria-label del botón minimize
            if (this.minimize) {
                this.minimize.setAttribute('aria-label', t.closeChat);
                console.log('Updated minimize aria-label to:', t.closeChat);
            }
            
            // Actualizar mensaje de bienvenida (solo si está visible y es el primer mensaje)
            const firstMessage = this.messages.querySelector('.bot-message .message-content');
            if (firstMessage && this.messages.children.length === 1) {
                console.log('Updating welcome message from "' + firstMessage.textContent + '" to "' + t.welcomeMessage + '"');
                firstMessage.textContent = t.welcomeMessage;
            } else {
                console.log('Welcome message not updated (conversation in progress or not found)');
            }
            
            console.log('=== Texts updated successfully ===');
        }
    };
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            AynixChatbot.init();
        });
    } else {
        AynixChatbot.init();
    }
    
})();
