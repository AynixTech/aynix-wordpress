<?php
/* Template Name: Contact Us */
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
        $phone = sanitize_text_field($_POST['phone']);
        $subject = sanitize_text_field($_POST['subject']);
        $message = sanitize_textarea_field($_POST['message']);

        // Validate fields
        if (empty($name) || empty($email) || empty($message)) {
            $error_message = aynix_translate('contact.form.required_fields');
        } elseif (!is_email($email)) {
            $error_message = aynix_translate('contact.form.invalid_email');
        } else {
            // Prepare email
            $to = 'admin@aynix.tech';
            $email_subject = 'Contact Form: ' . $subject;
            $email_body = "Name: $name\n";
            $email_body .= "Email: $email\n";
            $email_body .= "Phone: $phone\n\n";
            $email_body .= "Message:\n$message\n";
            
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
    <div class="contact-header">
        <h1><?php echo aynix_translate('contact.heading'); ?></h1>
    </div>

    <div class="contact-content">
        <div class="contact-info">
            <div class="info-card">
                <i class="fas fa-map-marker-alt"></i>
                <h3><?php echo aynix_translate('contact.address_label'); ?></h3>
                <p><?php echo aynix_translate('contact.address'); ?></p>
            </div>

            <div class="info-card">
                <i class="fas fa-envelope"></i>
                <h3><?php echo aynix_translate('contact.email_label'); ?></h3>
                <p><a href="mailto:<?php echo aynix_translate('contact.email'); ?>"><?php echo aynix_translate('contact.email'); ?></a></p>
            </div>

            <div class="info-card">
                <i class="fas fa-phone"></i>
                <h3><?php echo aynix_translate('contact.phone_label'); ?></h3>
                <p>
                    <strong>Italia / Europa:</strong> <a href="tel:<?php echo str_replace(' ', '', aynix_translate('contact.phone_europe')); ?>"><?php echo aynix_translate('contact.phone_europe'); ?></a><br>
                    <strong>America Latina:</strong> <a href="tel:<?php echo str_replace(' ', '', aynix_translate('contact.phone_latin_america')); ?>"><?php echo aynix_translate('contact.phone_latin_america'); ?></a>
                </p>
            </div>

            <div class="info-card company-details">
                <i class="fas fa-building"></i>
                <h3><?php echo aynix_translate('contact.form.company_info_title'); ?></h3>
                <p>
                    <strong>AYNIX SRL</strong><br>
                    VIA POPULONIA, 8<br>
                    20159 MILANO (MI)<br>
                    CF/P.IVA 14287050968<br>
                    SDI: 66OZKW1
                </p>
            </div>
        </div>

        <div class="contact-form">
            <h2><?php echo aynix_translate('contact.form_title'); ?></h2>
            
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
                
                <div class="form-group">
                    <label for="name"><?php echo aynix_translate('contact.form.name_label'); ?> *</label>
                    <input type="text" id="name" name="name" required placeholder="<?php echo aynix_translate('contact.form.name_placeholder'); ?>">
                </div>

                <div class="form-group">
                    <label for="email"><?php echo aynix_translate('contact.form.email_label'); ?> *</label>
                    <input type="email" id="email" name="email" required placeholder="<?php echo aynix_translate('contact.form.email_placeholder'); ?>">
                </div>

                <div class="form-group">
                    <label for="phone"><?php echo aynix_translate('contact.form.phone_label'); ?></label>
                    <input type="tel" id="phone" name="phone" placeholder="<?php echo aynix_translate('contact.form.phone_placeholder'); ?>">
                </div>

                <div class="form-group">
                    <label for="subject"><?php echo aynix_translate('contact.form.subject_label'); ?> *</label>
                    <input type="text" id="subject" name="subject" required placeholder="<?php echo aynix_translate('contact.form.subject_placeholder'); ?>">
                </div>

                <div class="form-group">
                    <label for="message"><?php echo aynix_translate('contact.form.message_label'); ?> *</label>
                    <textarea id="message" name="message" rows="6" required placeholder="<?php echo aynix_translate('contact.form.message_placeholder'); ?>"></textarea>
                </div>

                <button type="submit" name="contact_form_submit" class="submit-button">
                    <i class="fas fa-paper-plane"></i> <?php echo aynix_translate('contact.form.submit_button'); ?>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
.contact-page-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 50px 20px;
}

.contact-header {
    text-align: center;
    margin-bottom: 50px;
}

.contact-header h1 {
    font-size: 2.5em;
    color: #0073aa;
    margin-bottom: 10px;
}

.contact-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 50px;
    align-items: start;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.info-card {
    background: #ffffff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    border: 1px solid #e0e0e0;
    transition: transform 0.2s ease;
}

.info-card:hover {
    transform: translateY(-5px);
}

.info-card i {
    font-size: 2em;
    color: #0073aa;
    margin-bottom: 15px;
    display: block;
}

.info-card h3 {
    font-size: 1.3em;
    margin-bottom: 10px;
    color: #333;
}

.info-card p {
    font-size: 1em;
    color: #666;
    margin: 0;
    line-height: 1.6;
}

.info-card a {
    color: #0073aa;
    text-decoration: none;
    transition: color 0.3s ease;
}

.info-card a:hover {
    color: #005a8c;
}

.contact-form {
    background: #ffffff;
    padding: 35px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    border: 1px solid #e0e0e0;
}

.contact-form h2 {
    margin-top: 0;
    margin-bottom: 25px;
    color: #333;
    font-size: 1.5em;
}

.success-message,
.error-message {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
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
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: 500;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1em;
    font-family: inherit;
    transition: border-color 0.3s ease;
    box-sizing: border-box;
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #0073aa;
}

.form-group textarea {
    resize: vertical;
}

.submit-button {
    background: #0073aa;
    color: #fff;
    padding: 12px 30px;
    border: none;
    border-radius: 5px;
    font-size: 1.1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    justify-content: center;
    width: 100%;
}

.submit-button:hover {
    background: #005a8c;
}

@media (max-width: 768px) {
    .contact-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .contact-header h1 {
        font-size: 2em;
    }
}
</style>

<?php get_footer(); ?>
