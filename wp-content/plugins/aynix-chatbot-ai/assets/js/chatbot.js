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
            // Verificar si hay duplicados
            const allToggles = document.querySelectorAll('#aynix-chatbot-toggle');
            const allWidgets = document.querySelectorAll('#aynix-chatbot-widget');
            
            console.log('⚠️ Number of toggle buttons found:', allToggles.length);
            console.log('⚠️ Number of widgets found:', allWidgets.length);
            
            if (allToggles.length > 1) {
                console.error('❌ DUPLICATE TOGGLE BUTTONS FOUND!');
                allToggles.forEach((el, i) => console.log(`Toggle ${i}:`, el));
            }
            
            if (allWidgets.length > 1) {
                console.error('❌ DUPLICATE WIDGETS FOUND!');
                allWidgets.forEach((el, i) => console.log(`Widget ${i}:`, el));
            }
            
            this.toggle = document.getElementById('aynix-chatbot-toggle');
            this.widget = document.getElementById('aynix-chatbot-widget');
            this.messages = document.getElementById('aynix-chatbot-messages');
            this.input = document.getElementById('aynix-chatbot-input');
            this.sendBtn = document.getElementById('aynix-chatbot-send');
            this.minimize = document.querySelector('.chatbot-minimize');
            
            console.log('Toggle button found:', this.toggle ? 'Yes' : 'No');
            console.log('Widget found:', this.widget ? 'Yes' : 'No');
            
            // Verificar integridad del widget
            if (this.widget) {
                console.log('Widget ID:', this.widget.id);
                console.log('Widget classList value:', this.widget.classList.value);
                console.log('Widget className:', this.widget.className);
            }
        },
        
        bindEvents: function() {
            console.log('AYNIX Chatbot: Binding events...');
            console.log('Toggle button element:', this.toggle);
            console.log('Widget element:', this.widget);
            
            const self = this;
            
            if (this.toggle) {
                console.log('Adding click listener to toggle button...');
                this.toggle.addEventListener('click', function(e) {
                    console.log('🎯 === CLICK DETECTED ON TOGGLE BUTTON ===');
                    console.log('Event:', e);
                    console.log('Event target:', e.target);
                    console.log('Current target:', e.currentTarget);
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Calling toggleChat()...');
                    self.toggleChat();
                }, false);
                console.log('Click listener added to toggle button');
            } else {
                console.error('❌ Toggle button not found!');
            }
            
            if (this.minimize) {
                this.minimize.addEventListener('click', function(e) {
                    console.log('Minimize clicked');
                    e.preventDefault();
                    self.closeChat();
                });
            }
            
            if (this.sendBtn) {
                this.sendBtn.addEventListener('click', function(e) {
                    console.log('Send button clicked');
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
            
            // Test manual después de 1 segundo
            setTimeout(function() {
                console.log('=== DIAGNOSTIC TEST ===');
                console.log('Toggle button exists:', !!self.toggle);
                console.log('Toggle button visible:', self.toggle ? window.getComputedStyle(self.toggle).display !== 'none' : false);
                console.log('Toggle button z-index:', self.toggle ? window.getComputedStyle(self.toggle).zIndex : 'N/A');
                console.log('Toggle button pointer-events:', self.toggle ? window.getComputedStyle(self.toggle).pointerEvents : 'N/A');
                
                // Test click programático
                console.log('Testing programmatic click...');
                if (self.toggle) {
                    self.toggle.click();
                }
            }, 2000);
            
            console.log('AYNIX Chatbot: Events bound successfully');
        },
        
        initializeChat: function() {
            if (localStorage.getItem('aynix_chatbot_open') === 'true') {
                this.openChat();
            }
        },
        
        toggleChat: function() {
            console.log('🔄 === TOGGLE CHAT METHOD CALLED ===');
            console.log('Widget element:', this.widget);
            console.log('Widget classList:', this.widget.classList);
            
            const isActive = this.widget.classList.contains('active');
            console.log('Widget has active class:', isActive);
            console.log('Widget display style:', this.widget.style.display);
            console.log('Widget computed display:', window.getComputedStyle(this.widget).display);
            
            if (isActive) {
                console.log('➡️ Closing chat...');
                this.closeChat();
            } else {
                console.log('➡️ Opening chat...');
                this.openChat();
            }
        },
        
        openChat: function() {
            console.log('✅ === OPEN CHAT CALLED ===');
            console.log('Widget before changes:', {
                hasActive: this.widget.classList.contains('active'),
                display: this.widget.style.display,
                computedDisplay: window.getComputedStyle(this.widget).display
            });
            
            this.widget.classList.add('active');
            this.toggle.classList.add('active');
            this.widget.style.display = 'flex';
            
            console.log('Widget after changes:', {
                hasActive: this.widget.classList.contains('active'),
                display: this.widget.style.display,
                computedDisplay: window.getComputedStyle(this.widget).display
            });
            
            if (this.input) {
                this.input.focus();
            }
            
            localStorage.setItem('aynix_chatbot_open', 'true');
            this.scrollToBottom();
            
            console.log('✅ Chat opened successfully');
        },
        
        closeChat: function() {
            console.log('=== CLOSE CHAT CALLED ===');
            
            this.widget.classList.remove('active');
            this.toggle.classList.remove('active');
            this.widget.style.display = 'none';
            
            localStorage.setItem('aynix_chatbot_open', 'false');
            console.log('Chat closed');
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
