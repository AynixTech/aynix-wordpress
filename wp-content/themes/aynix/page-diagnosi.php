<?php
/**
 * Template Name: Diagnosi
 * Description: Pagina dedicata alla diagnosi operativa AYNIX
 */
get_header();
?>

<main>
    <div class="page-layout diagnosi-page">
        <!-- Hero Section -->
        <section class="hero-page">
            <div class="container">
                <h1><?php echo aynix_translate('diagnosi.hero.title'); ?></h1>
                <p class="hero-subtitle"><?php echo aynix_translate('diagnosi.hero.subtitle'); ?></p>
                <div class="diagnosi-badges">
                    <span class="badge"><i class="fas fa-clock"></i> 10 min</span>
                    <span class="badge"><i class="fas fa-gift"></i> Nessun costo</span>
                    <span class="badge"><i class="fas fa-handshake"></i> Nessuna vendita</span>
                </div>
            </div>
        </section>

        <div class="container">
            <!-- Cos'è / Cosa non è -->
            <section class="diagnosi-what">
                <h2><?php echo aynix_translate('diagnosi.what.title'); ?></h2>
                <div class="diagnosi-grid-two">
                    <div class="diagnosi-card diagnosi-card--is">
                        <div class="card-icon card-icon--success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3><?php echo aynix_translate('diagnosi.what.is_title'); ?></h3>
                        <ul class="diagnosi-list">
                            <li><?php echo aynix_translate('diagnosi.what.is_1'); ?></li>
                            <li><?php echo aynix_translate('diagnosi.what.is_2'); ?></li>
                            <li><?php echo aynix_translate('diagnosi.what.is_3'); ?></li>
                            <li><?php echo aynix_translate('diagnosi.what.is_4'); ?></li>
                        </ul>
                    </div>
                    <div class="diagnosi-card diagnosi-card--isnot">
                        <div class="card-icon card-icon--danger">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h3><?php echo aynix_translate('diagnosi.what.isnot_title'); ?></h3>
                        <ul class="diagnosi-list">
                            <li><?php echo aynix_translate('diagnosi.what.isnot_1'); ?></li>
                            <li><?php echo aynix_translate('diagnosi.what.isnot_2'); ?></li>
                            <li><?php echo aynix_translate('diagnosi.what.isnot_3'); ?></li>
                            <li><?php echo aynix_translate('diagnosi.what.isnot_4'); ?></li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Come funziona -->
            <section class="diagnosi-how">
                <h2><?php echo aynix_translate('diagnosi.how.title'); ?></h2>
                <div class="diagnosi-grid-three">
                    <div class="diagnosi-step">
                        <div class="step-number">1</div>
                        <h3><?php echo aynix_translate('diagnosi.how.step1_title'); ?></h3>
                        <p><?php echo aynix_translate('diagnosi.how.step1_desc'); ?></p>
                    </div>
                    <div class="diagnosi-step">
                        <div class="step-number">2</div>
                        <h3><?php echo aynix_translate('diagnosi.how.step2_title'); ?></h3>
                        <p><?php echo aynix_translate('diagnosi.how.step2_desc'); ?></p>
                    </div>
                    <div class="diagnosi-step">
                        <div class="step-number">3</div>
                        <h3><?php echo aynix_translate('diagnosi.how.step3_title'); ?></h3>
                        <p><?php echo aynix_translate('diagnosi.how.step3_desc'); ?></p>
                    </div>
                </div>
            </section>

            <!-- Cosa ottieni -->
            <section class="diagnosi-benefits">
                <h2><?php echo aynix_translate('diagnosi.benefits.title'); ?></h2>
                <div class="diagnosi-grid-two">
                    <div class="diagnosi-benefit">
                        <i class="fas fa-file-pdf"></i>
                        <h3><?php echo aynix_translate('diagnosi.benefits.benefit1_title'); ?></h3>
                        <p><?php echo aynix_translate('diagnosi.benefits.benefit1_desc'); ?></p>
                    </div>
                    <div class="diagnosi-benefit">
                        <i class="fas fa-phone-alt"></i>
                        <h3><?php echo aynix_translate('diagnosi.benefits.benefit2_title'); ?></h3>
                        <p><?php echo aynix_translate('diagnosi.benefits.benefit2_desc'); ?></p>
                    </div>
                </div>
            </section>

            <!-- CTA finale -->
            <section class="diagnosi-cta">
                <div class="cta-box">
                    <h2><?php echo aynix_translate('diagnosi.cta.title'); ?></h2>
                    <p><?php echo aynix_translate('diagnosi.cta.subtitle'); ?></p>
                    
                    <!-- Embed questionario - Modifica l'URL con il tuo form Typeform/Tally -->
                    <div class="diagnosi-form-container">
                        <!-- Opzione 1: Typeform embed -->
                        <!-- <div data-tf-widget="YOUR_FORM_ID" data-tf-opacity="100" style="width:100%;height:500px;"></div>
                        <script src="//embed.typeform.com/next/embed.js"></script> -->
                        
                        <!-- Opzione 2: Link diretto al form -->
                        <a href="#" class="btn-primary btn-large" target="_blank">
                            <?php echo aynix_translate('diagnosi.cta.button'); ?>
                        </a>
                        
                        <!-- Opzione 3: Form WordPress nativo (da configurare con plugin) -->
                        <!-- <?php echo do_shortcode('[contact-form-7 id="123"]'); ?> -->
                    </div>
                    
                    <p class="cta-reminder"><?php echo aynix_translate('diagnosi.cta.reminder'); ?></p>
                </div>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
