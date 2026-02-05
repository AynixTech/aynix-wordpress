/**
 * AYNIX Chatbot AI - JavaScript
 */

(function($) {
    'use strict';
    
    const AynixChatbot = {
        
        init: function() {
            this.cacheDom();
            this.bindEvents();
            this.initializeChat();
        },
        
        cacheDom: function() {
            this.$toggle = $('#aynix-chatbot-toggle');
            this.$widget = $('#aynix-chatbot-widget');
            this.$messages = $('#aynix-chatbot-messages');
            this.$input = $('#aynix-chatbot-input');
            this.$sendBtn = $('#aynix-chatbot-send');
            this.$minimize = $('.chatbot-minimize');
        },
        
        bindEvents: function() {
            console.log('AYNIX Chatbot: Binding events...');
            console.log('Toggle element:', this.$toggle[0]);
            
            var self = this;
            
            // Método 1: jQuery con debugging
            this.$toggle.off('click').on('click', function(e) {
                console.log('=== JQUERY CLICK DETECTED ===');
                console.log('Event:', e);
                e.preventDefault();
                e.stopPropagation();
                self.toggleChat();
                return false;
            });
            
            // Método 2: Vanilla JavaScript como fallback
            if (this.$toggle[0]) {
                this.$toggle[0].addEventListener('click', function(e) {
                    console.log('=== VANILLA JS CLICK DETECTED ===');
                    console.log('Event:', e);
                    e.preventDefault();
                    e.stopPropagation();
                    self.toggleChat();
                }, true); // useCapture = true
            }
            
            this.$minimize.on('click', this.closeChat.bind(this));
            this.$sendBtn.on('click', this.sendMessage.bind(this));
            this.$input.on('keypress', this.handleKeypress.bind(this));
            
            console.log('AYNIX Chatbot: Events bound successfully');
        },
        
        initializeChat: function() {
            // Riapri chat se era aperta prima
            if (localStorage.getItem('aynix_chatbot_open') === 'true') {
                this.openChat();
            }
        },
        
        toggleChat: function() {
            console.log('=== TOGGLE CHAT METHOD CALLED ===');
            console.log('Widget has active class:', this.$widget.hasClass('active'));
            
            if (this.$widget.hasClass('active')) {
                console.log('Closing chat...');
                this.closeChat();
            } else {
                console.log('Opening chat...');
                this.openChat();
            }
        },
        
        openChat: function() {
            this.$widget.addClass('active');
            this.$toggle.addClass('active');
            this.$input.focus();
            localStorage.setItem('aynix_chatbot_open', 'true');
            
            // Scroll to bottom
            this.scrollToBottom();
        },
        
        closeChat: function() {
            this.$widget.removeClass('active');
            this.$toggle.removeClass('active');
            localStorage.setItem('aynix_chatbot_open', 'false');
        },
        
        handleKeypress: function(e) {
            if (e.which === 13 && !e.shiftKey) { // Enter key
                e.preventDefault();
                this.sendMessage();
            }
        },
        
        sendMessage: function() {
            const message = this.$input.val().trim();
            
            if (message === '') {
                return;
            }
            
            // Aggiungi messaggio utente alla UI
            this.addMessage(message, 'user');
            
            // Pulisci input
            this.$input.val('');
            
            // Disabilita input durante l'elaborazione
            this.setLoading(true);
            
            // Mostra typing indicator
            this.showTypingIndicator();
            
            // Invia messaggio al server
            this.sendToServer(message);
        },
        
        addMessage: function(text, type) {
            const messageClass = type === 'user' ? 'user-message' : 'bot-message';
            
            // Converti URL in link cliccabili
            const formattedText = this.linkify(text);
            
            const messageHtml = `
                <div class="message ${messageClass}">
                    <div class="message-content">${formattedText}</div>
                </div>
            `;
            
            this.$messages.append(messageHtml);
            this.scrollToBottom();
        },
        
        showTypingIndicator: function() {
            const typingHtml = `
                <div class="message bot-message typing-indicator-wrapper">
                    <div class="message-content typing-indicator">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            `;
            
            this.$messages.append(typingHtml);
            this.scrollToBottom();
        },
        
        hideTypingIndicator: function() {
            this.$messages.find('.typing-indicator-wrapper').remove();
        },
        
        sendToServer: function(message) {
            const self = this;
            
            $.ajax({
                url: aynixChatbot.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'aynix_chatbot_message',
                    nonce: aynixChatbot.nonce,
                    message: message,
                    lang: aynixChatbot.lang
                },
                success: function(response) {
                    self.hideTypingIndicator();
                    
                    if (response.success && response.data.response) {
                        self.addMessage(response.data.response, 'bot');
                    } else {
                        self.addMessage(aynixChatbot.translations.errorMessage, 'bot');
                    }
                    
                    self.setLoading(false);
                },
                error: function() {
                    self.hideTypingIndicator();
                    self.addMessage(aynixChatbot.translations.errorMessage, 'bot');
                    self.setLoading(false);
                }
            });
        },
        
        setLoading: function(loading) {
            this.$input.prop('disabled', loading);
            this.$sendBtn.prop('disabled', loading);
            
            if (!loading) {
                this.$input.focus();
            }
        },
        
        scrollToBottom: function() {
            this.$messages.animate({
                scrollTop: this.$messages[0].scrollHeight
            }, 300);
        },
        
        linkify: function(text) {
            // Escape HTML
            const escaped = $('<div>').text(text).html();
            
            // Convert URLs to links
            const urlRegex = /(https?:\/\/[^\s]+)/g;
            return escaped.replace(urlRegex, function(url) {
                return '<a href="' + url + '" target="_blank" rel="noopener noreferrer">' + url + '</a>';
            });
        }
    };
    
    // Initialize on document ready
    $(document).ready(function() {
        console.log('AYNIX Chatbot: Initializing...');
        console.log('jQuery version:', $.fn.jquery);
        console.log('Toggle button found:', $('#aynix-chatbot-toggle').length);
        console.log('Widget found:', $('#aynix-chatbot-widget').length);
        
        AynixChatbot.init();
        
        console.log('AYNIX Chatbot: Initialized successfully');
        
        // Test directo del elemento
        setTimeout(function() {
            var btn = document.getElementById('aynix-chatbot-toggle');
            console.log('Button test:', btn);
            console.log('Button style:', window.getComputedStyle(btn));
            console.log('Button pointer-events:', window.getComputedStyle(btn).pointerEvents);
            console.log('Button z-index:', window.getComputedStyle(btn).zIndex);
            console.log('Button position:', window.getComputedStyle(btn).position);
        }, 500);
    });
    
})(jQuery);
