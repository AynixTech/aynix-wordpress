<?php
/* Template Name: Contact Us */
get_header();
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
                <p><a href="tel:<?php echo str_replace(' ', '', aynix_translate('contact.phone')); ?>"><?php echo aynix_translate('contact.phone'); ?></a></p>
            </div>

            <div class="info-card company-details">
                <i class="fas fa-building"></i>
                <h3>Informazioni Aziendali</h3>
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
            <?php echo do_shortcode('[contact-form-7 id="0859f02" title="' . aynix_translate('contact.form_title') . '"]'); ?>
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
