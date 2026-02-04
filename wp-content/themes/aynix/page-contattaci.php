<?php
/* Template Name: Contattaci */
get_header();

// Handle form submission
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form_submit'])) {
    // Verify nonce for security
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'contact_form')) {
        $error_message = 'Security check failed';
    } else {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $company = sanitize_text_field($_POST['company']);
        $contact_reason = sanitize_text_field($_POST['contact_reason']);
        $message = sanitize_textarea_field($_POST['message']);

        // Validate fields
        if (empty($name) || empty($email) || empty($contact_reason) || empty($message)) {
            $error_message = aynix_translate('contact.form.required_fields');
        } elseif (!is_email($email)) {
            $error_message = aynix_translate('contact.form.invalid_email');
        } else {
            // Prepare email
            $to = 'info@aynix.tech';
            $email_subject = 'Contatto: ' . $contact_reason;
            $email_body = "Nome: $name\n";
            $email_body .= "Email: $email\n";
            $email_body .= "Azienda: " . ($company ?: 'Non specificata') . "\n";
            $email_body .= "Motivo del contatto: $contact_reason\n\n";
            $email_body .= "Messaggio:\n$message\n";
            
            $headers = array(
                'From: ' . $name . ' <' . $email . '>',
                'Reply-To: ' . $email,
                'Content-Type: text/plain; charset=UTF-8'
            );

            // Send email
            if (wp_mail($to, $email_subject, $email_body, $headers)) {
                $success_message = aynix_translate('contact.form.success_message');
            } else {
                $error_message = aynix_translate('contact.form.error_message');
            }
        }
    }
}
?>

<div class="contact-page-container">
    <!-- Hero Section -->
    <div class="contact-hero">
        <h1><?php echo aynix_translate('contact.hero.title'); ?></h1>
        <p class="hero-subtitle"><?php echo aynix_translate('contact.hero.subtitle'); ?></p>
    </div>

    <div class="contact-content">
        <!-- Blocco Orientamento -->
        <section class="orientation-block">
            <h2><?php echo aynix_translate('contact.orientation.title'); ?></h2>
            <p><?php echo aynix_translate('contact.orientation.intro'); ?></p>
            <ul class="orientation-list">
                <li><?php echo aynix_translate('contact.orientation.point1'); ?></li>
                <li><?php echo aynix_translate('contact.orientation.point2'); ?></li>
                <li><?php echo aynix_translate('contact.orientation.point3'); ?></li>
                <li><?php echo aynix_translate('contact.orientation.point4'); ?></li>
            </ul>
            <p class="orientation-suggestion"><?php echo aynix_translate('contact.orientation.suggestion'); ?></p>
        </section>

        <!-- CTA Diagnosi -->
        <section class="cta-diagnosis">
            <a href="<?php echo esc_url(home_url('/diagnosi')); ?>" class="btn-diagnosis-large">
                <?php echo aynix_translate('contact.cta.button'); ?>
            </a>
            <p class="cta-microcopy"><?php echo aynix_translate('contact.cta.microcopy'); ?></p>
        </section>

        <!-- Form di Contatto -->
        <section class="contact-form-section">
            <h2><?php echo aynix_translate('contact.form.title'); ?></h2>
            
            <?php if ($success_message): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="aynix-contact-form">
                <?php wp_nonce_field('contact_form', 'contact_nonce'); ?>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="name"><?php echo aynix_translate('contact.form.name_label'); ?> *</label>
                        <input type="text" id="name" name="name" required placeholder="<?php echo aynix_translate('contact.form.name_placeholder'); ?>">
                    </div>

                    <div class="form-group">
                        <label for="email"><?php echo aynix_translate('contact.form.email_label'); ?> *</label>
                        <input type="email" id="email" name="email" required placeholder="<?php echo aynix_translate('contact.form.email_placeholder'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="company"><?php echo aynix_translate('contact.form.company_label'); ?></label>
                    <input type="text" id="company" name="company" placeholder="<?php echo aynix_translate('contact.form.company_placeholder'); ?>">
                </div>

                <div class="form-group">
                    <label for="contact_reason"><?php echo aynix_translate('contact.form.reason_label'); ?> *</label>
                    <select id="contact_reason" name="contact_reason" required>
                        <option value=""><?php echo aynix_translate('contact.form.reason_placeholder'); ?></option>
                        <option value="Follow-up dopo diagnosi"><?php echo aynix_translate('contact.form.reason_option1'); ?></option>
                        <option value="Partnership / Collaborazioni"><?php echo aynix_translate('contact.form.reason_option2'); ?></option>
                        <option value="Richiesta specifica già definita"><?php echo aynix_translate('contact.form.reason_option3'); ?></option>
                        <option value="Altro"><?php echo aynix_translate('contact.form.reason_option4'); ?></option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message"><?php echo aynix_translate('contact.form.message_label'); ?> *</label>
                    <textarea id="message" name="message" rows="6" required placeholder="<?php echo aynix_translate('contact.form.message_placeholder'); ?>"></textarea>
                </div>

                <button type="submit" name="contact_form_submit" class="submit-button">
                    <i class="fas fa-paper-plane"></i> <?php echo aynix_translate('contact.form.submit_button'); ?>
                </button>
            </form>
        </section>

        <!-- Nota di Metodo -->
        <section class="method-note">
            <p><?php echo aynix_translate('contact.method_note'); ?></p>
        </section>

        <!-- Informazioni di Contatto -->
        <section class="contact-info-footer">
            <p>
                <strong>AYNIX SRL</strong><br>
                Via Populonia, 8 – 20159 Milano (MI)<br>
                Email: <a href="mailto:info@aynix.tech">info@aynix.tech</a><br><br>
                <strong>Italia / Europa:</strong> <a href="tel:<?php echo str_replace(' ', '', aynix_translate('contact.phone_europe')); ?>"><?php echo aynix_translate('contact.phone_europe'); ?></a><br>
                <strong>America Latina:</strong> <a href="tel:<?php echo str_replace(' ', '', aynix_translate('contact.phone_latin_america')); ?>"><?php echo aynix_translate('contact.phone_latin_america'); ?></a>
            </p>
        </section>
    </div>
</div>

<style>
.contact-page-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 50px 20px;
}

.contact-content {
    display: flex;
    flex-direction: column;
    gap: 0;
    width: 100%;
}

.contact-hero {
    text-align: center;
    margin-bottom: 60px;
    padding: 40px 20px;
    background: linear-gradient(135deg, var(--aynix-primary-color), var(--aynix-secondary-color));
    color: white;
    border-radius: 12px;
}

.contact-hero h1 {
    font-size: 2.8em;
    margin-bottom: 15px;
    font-weight: 700;
}

.contact-hero .hero-subtitle {
    font-size: 1.2em;
    line-height: 1.6;
    opacity: 0.95;
    max-width: 700px;
    margin: 0 auto;
}

.orientation-block {
    background: #f8f9fa;
    padding: 35px;
    border-radius: 10px;
    margin-bottom: 40px;
    border-left: 4px solid var(--aynix-primary-color);
}

.orientation-block h2 {
    font-size: 1.8em;
    color: var(--aynix-primary-color);
    margin-bottom: 20px;
}

.orientation-block p {
    font-size: 1.1em;
    line-height: 1.7;
    color: #555;
    margin-bottom: 15px;
}

.orientation-list {
    list-style: none;
    padding-left: 0;
    margin: 20px 0;
}

.orientation-list li {
    padding: 10px 0 10px 30px;
    position: relative;
    font-size: 1.05em;
    color: #444;
}

.orientation-list li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: var(--aynix-primary-color);
    font-weight: bold;
    font-size: 1.2em;
}

.orientation-suggestion {
    font-weight: 600;
    color: var(--aynix-primary-color);
    margin-top: 20px;
}

.orientation-suggestion strong {
    font-weight: 700;
}

.cta-diagnosis {
    text-align: center;
    margin: 50px 0;
    padding: 40px 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: 12px;
    border: 2px solid var(--aynix-primary-color);
}

.btn-diagnosis-large {
    display: inline-block;
    background: var(--aynix-primary-color);
    color: white;
    padding: 18px 50px;
    font-size: 1.3em;
    font-weight: 600;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 115, 170, 0.3);
}

.btn-diagnosis-large:hover {
    background: var(--aynix-secondary-color);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 115, 170, 0.4);
}

.cta-microcopy {
    margin-top: 15px;
    font-size: 0.95em;
    color: #666;
    font-style: italic;
}

.contact-form-section {
    background: #ffffff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    margin-bottom: 40px;
}

.contact-form-section h2 {
    margin-top: 0;
    margin-bottom: 30px;
    color: #333;
    font-size: 1.8em;
    text-align: center;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 25px;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}

.success-message,
.error-message {
    padding: 15px;
    margin-bottom: 25px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.success-message {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.error-message {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: 600;
    font-size: 1em;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 13px 16px;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    font-size: 1em;
    font-family: inherit;
    transition: border-color 0.3s ease;
    box-sizing: border-box;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--aynix-primary-color);
}

.form-group textarea {
    resize: vertical;
    min-height: 140px;
}

.form-group select {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 20px;
    padding-right: 40px;
}

.submit-button {
    background: var(--aynix-primary-color);
    color: #fff;
    padding: 14px 40px;
    border: none;
    border-radius: 6px;
    font-size: 1.1em;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    justify-content: center;
    width: 100%;
    margin-top: 10px;
}

.submit-button:hover {
    background: var(--aynix-secondary-color);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 115, 170, 0.3);
}

.method-note {
    background: #fff3cd;
    border: 1px solid #ffc107;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 30px;
    text-align: center;
}

.method-note p {
    margin: 0;
    font-size: 1.05em;
    color: #856404;
    font-weight: 500;
    line-height: 1.6;
}

.contact-info-footer {
    text-align: center;
    padding: 30px;
    background: #f8f9fa;
    border-radius: 8px;
}

.contact-info-footer p {
    margin: 0;
    font-size: 1em;
    line-height: 1.8;
    color: #555;
}

.contact-info-footer a {
    color: var(--aynix-primary-color);
    text-decoration: none;
    font-weight: 600;
}

.contact-info-footer a:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .contact-hero h1 {
        font-size: 2em;
    }
    
    .contact-hero .hero-subtitle {
        font-size: 1.05em;
    }

    .orientation-block,
    .contact-form-section {
        padding: 25px;
    }

    .btn-diagnosis-large {
        padding: 15px 35px;
        font-size: 1.1em;
    }
}
</style>

<?php get_footer(); ?>
