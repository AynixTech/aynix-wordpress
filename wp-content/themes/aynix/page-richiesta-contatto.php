<?php
/**
 * Template Name: Richiesta Contatto
 * Description: Form per richiedere di essere contattati dopo analisi diagnosi
 */
get_header();

// Pre-compila email da parametro URL
$prefilled_email = isset($_GET['email']) ? sanitize_email($_GET['email']) : '';
?>

<main>
    <div class="page-layout richiesta-contatto-page">
        <!-- Hero Section -->
        <section class="richiesta-hero">
            <div class="container">
                <h1>📞 Richiedi di Essere Contattato</h1>
                <p class="hero-subtitle">Compila il form e ti contatteremo per fissare una call gratuita di 15-20 minuti</p>
            </div>
        </section>

        <!-- Form Section -->
        <section class="richiesta-form-section">
            <div class="container">
                <div class="form-container">
                    <form id="richiesta-contatto-form" class="contact-request-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nome">Nome *</label>
                                <input type="text" id="nome" name="nome" required placeholder="Il tuo nome">
                            </div>
                            <div class="form-group">
                                <label for="cognome">Cognome *</label>
                                <input type="text" id="cognome" name="cognome" required placeholder="Il tuo cognome">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required placeholder="tua@email.com" value="<?php echo esc_attr($prefilled_email); ?>">
                        </div>

                        <div class="form-group">
                            <label for="telefono">Telefono *</label>
                            <input type="tel" id="telefono" name="telefono" required placeholder="+39 123 456 7890">
                        </div>

                        <div class="form-group">
                            <label for="azienda">Azienda (opzionale)</label>
                            <input type="text" id="azienda" name="azienda" placeholder="Nome della tua azienda">
                        </div>

                        <div class="form-group">
                            <label for="note">Note aggiuntive (opzionale)</label>
                            <textarea id="note" name="note" rows="4" placeholder="Eventuali note o preferenze per la call..."></textarea>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-primary btn-large" id="submit-request-btn">
                                Invia Richiesta
                            </button>
                        </div>

                        <div id="form-message" class="form-message"></div>
                    </form>
                </div>

                <div class="info-sidebar">
                    <div class="info-box">
                        <h3>📋 Cosa aspettarti</h3>
                        <ul>
                            <li>Ti contatteremo entro 24-48 ore</li>
                            <li>Call gratuita di 15-20 minuti</li>
                            <li>Nessun impegno o vendita forzata</li>
                            <li>Discussione concreta sul tuo progetto</li>
                        </ul>
                    </div>

                    <div class="info-box">
                        <h3>🔒 Privacy</h3>
                        <p>I tuoi dati sono protetti e utilizzati solo per contattarti in merito alla tua richiesta.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<style>
.richiesta-contatto-page {
    background: #f7fafc;
}

.richiesta-hero {
    background: linear-gradient(135deg, #438ef9 0%, #ff6331 100%);
    color: white;
    padding: 3rem 1rem;
    text-align: center;
}

.richiesta-hero h1 {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: white;
}

.hero-subtitle {
    font-size: 1.1rem;
    max-width: 700px;
    margin: 0 auto;
    opacity: 0.95;
}

.richiesta-form-section {
    padding: 3rem 0;
}

.richiesta-form-section .container {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
    max-width: 1200px;
    margin: 0 auto;
}

.form-container {
    background: white;
    padding: 2.5rem;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.contact-request-form .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.contact-request-form .form-group {
    margin-bottom: 1.5rem;
}

.contact-request-form label {
    display: block;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #2d3748;
}

.contact-request-form input,
.contact-request-form textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s;
}

.contact-request-form input:focus,
.contact-request-form textarea:focus {
    outline: none;
    border-color: #438ef9;
}

.contact-request-form textarea {
    resize: vertical;
    font-family: inherit;
}

.form-actions {
    margin-top: 2rem;
}

.form-message {
    margin-top: 1.5rem;
    padding: 1rem;
    border-radius: 8px;
    display: none;
}

.form-message.success {
    display: block;
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.form-message.error {
    display: block;
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.info-sidebar .info-box {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    margin-bottom: 1.5rem;
}

.info-sidebar .info-box h3 {
    color: #438ef9;
    margin-bottom: 1rem;
    font-size: 1.2rem;
}

.info-sidebar .info-box ul {
    list-style: none;
    padding: 0;
}

.info-sidebar .info-box ul li {
    padding: 0.5rem 0;
    padding-left: 1.5rem;
    position: relative;
}

.info-sidebar .info-box ul li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #438ef9;
    font-weight: 700;
}

.info-sidebar .info-box p {
    color: #4a5568;
    line-height: 1.6;
}

@media (max-width: 968px) {
    .richiesta-form-section .container {
        grid-template-columns: 1fr;
    }

    .contact-request-form .form-row {
        grid-template-columns: 1fr;
    }

    .form-container {
        padding: 1.5rem;
    }
}

@media (max-width: 768px) {
    .richiesta-hero h1 {
        font-size: 1.8rem;
    }
}
</style>

<script>
jQuery(document).ready(function($) {
    $('#richiesta-contatto-form').on('submit', function(e) {
        e.preventDefault();

        const submitBtn = $('#submit-request-btn');
        const messageBox = $('#form-message');
        
        // Validazione base
        const nome = $('#nome').val().trim();
        const cognome = $('#cognome').val().trim();
        const email = $('#email').val().trim();
        const telefono = $('#telefono').val().trim();
        
        if (!nome || !cognome || !email || !telefono) {
            messageBox.removeClass('success').addClass('error').text('Compila tutti i campi obbligatori').show();
            return;
        }

        // Disable button
        submitBtn.prop('disabled', true).text('Invio in corso...');
        messageBox.hide();

        // Raccolta dati
        const formData = {
            action: 'submit_contact_request',
            nome: nome,
            cognome: cognome,
            email: email,
            telefono: telefono,
            azienda: $('#azienda').val().trim(),
            note: $('#note').val().trim()
        };

        // Invio AJAX
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    messageBox.removeClass('error').addClass('success').text('✅ Richiesta inviata! Ti contatteremo presto.').show();
                    $('#richiesta-contatto-form')[0].reset();
                    
                    // Redirect dopo 2 secondi
                    setTimeout(function() {
                        window.location.href = '/grazie-contatto';
                    }, 2000);
                } else {
                    messageBox.removeClass('success').addClass('error').text('❌ ' + (response.data?.message || 'Errore nell\'invio. Riprova.')).show();
                }
                submitBtn.prop('disabled', false).text('Invia Richiesta');
            },
            error: function() {
                messageBox.removeClass('success').addClass('error').text('❌ Errore di connessione. Riprova.').show();
                submitBtn.prop('disabled', false).text('Invia Richiesta');
            }
        });
    });
});
</script>

<?php get_footer(); ?>
