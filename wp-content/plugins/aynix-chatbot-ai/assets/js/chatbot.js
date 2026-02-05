/**
 * AYNIX Chatbot AI - Vanilla JavaScript (Sin jQuery)
 */

(function() {
    'use strict';
    
    const AynixChatbot = {
        
        init: function() {
            console.log('AYNIX Chatbot: Initializing...');
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
                this.languageSwitcher.addEventListener('change', function(e) {
                    const newLang = e.target.value;
                    console.log('Language changed to:', newLang);
                    self.changeLanguage(newLang);
                });
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
            // Verificar que existan las traducciones para el nuevo idioma
            if (!aynixChatbot.allTranslations || !aynixChatbot.allTranslations[newLang]) {
                console.error('Translations not found for language:', newLang);
                return;
            }
            
            // Actualizar idioma actual
            aynixChatbot.lang = newLang;
            aynixChatbot.translations = aynixChatbot.allTranslations[newLang];
            
            // Actualizar textos del chatbot
            this.updateChatbotTexts();
            
            console.log('Chatbot language updated to:', newLang);
        },
        
        updateChatbotTexts: function() {
            const t = aynixChatbot.translations;
            
            // Actualizar título del chat
            if (this.chatTitle) {
                this.chatTitle.textContent = t.chatTitle;
            }
            
            // Actualizar placeholder del input
            if (this.input) {
                this.input.placeholder = t.placeholder;
            }
            
            // Actualizar aria-label del botón toggle
            if (this.toggle) {
                this.toggle.setAttribute('aria-label', t.chatTitle);
            }
            
            // Actualizar aria-label del botón minimize
            if (this.minimize) {
                this.minimize.setAttribute('aria-label', t.closeChat);
            }
            
            // Actualizar mensaje de bienvenida (solo si está visible y es el primer mensaje)
            const firstMessage = this.messages.querySelector('.bot-message .message-content');
            if (firstMessage && this.messages.children.length === 1) {
                firstMessage.textContent = t.welcomeMessage;
            }
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
