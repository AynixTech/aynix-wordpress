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
        <section class="hero-page diagnosi-hero">
            <div class="container">
                <h1><?php echo aynix_translate('diagnosi.hero.title'); ?></h1>
                <p class="hero-intro"><?php echo aynix_translate('diagnosi.hero.intro'); ?></p>
                
                <div class="diagnosi-badges">
                    <span class="badge"><i class="fas fa-clock"></i> <?php echo aynix_translate('diagnosi.badge.time'); ?></span>
                    <span class="badge"><i class="fas fa-gift"></i> <?php echo aynix_translate('diagnosi.badge.cost'); ?></span>
                    <span class="badge"><i class="fas fa-ban"></i> <?php echo aynix_translate('diagnosi.badge.no_sales'); ?></span>
                </div>
            </div>
        </section>

        <div class="container">
            <!-- Cos'è / Cosa non è -->
            <section class="diagnosi-what">
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
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Come funziona -->
            <section class="diagnosi-how">
                <h2><?php echo aynix_translate('diagnosi.how.title'); ?></h2>
                <div class="diagnosi-steps">
                    <div class="diagnosi-step">
                        <div class="step-number">1</div>
                        <p><?php echo aynix_translate('diagnosi.how.step1'); ?></p>
                    </div>
                    <div class="diagnosi-step">
                        <div class="step-number">2</div>
                        <p><?php echo aynix_translate('diagnosi.how.step2'); ?></p>
                    </div>
                    <div class="diagnosi-step">
                        <div class="step-number">3</div>
                        <p><?php echo aynix_translate('diagnosi.how.step3'); ?></p>
                    </div>
                </div>
            </section>

            <!-- Cosa ottieni -->
            <section class="diagnosi-benefits">
                <h2><?php echo aynix_translate('diagnosi.benefits.title'); ?></h2>
                <div class="benefits-list">
                    <div class="benefit-item">
                        <i class="fas fa-search"></i>
                        <p><?php echo aynix_translate('diagnosi.benefits.benefit1'); ?></p>
                    </div>
                    <div class="benefit-item">
                        <i class="fas fa-lightbulb"></i>
                        <p><?php echo aynix_translate('diagnosi.benefits.benefit2'); ?></p>
                    </div>
                    <div class="benefit-item">
                        <i class="fas fa-comments"></i>
                        <p><?php echo aynix_translate('diagnosi.benefits.benefit3'); ?></p>
                    </div>
                </div>
            </section>

            <!-- CTA + Questionario -->
            <section class="diagnosi-cta">
                <div class="cta-box">
                    <h2><?php echo aynix_translate('diagnosi.cta.title'); ?></h2>
                    <p class="cta-note"><?php echo aynix_translate('diagnosi.cta.note'); ?></p>
                    
                    <!-- Questionario Diagnosi -->
                    <div class="diagnosi-form-container" id="diagnosi-form">
                        <?php 
                        // Qui verrà inserito il form - per ora link placeholder
                        // Opzioni: Typeform embed, Tally, Contact Form 7, custom form
                        ?>
                        
                        <!-- Placeholder per form -->
                        <a href="#questionario" class="btn-primary btn-large" id="start-diagnosis-btn">
                            <?php echo aynix_translate('diagnosi.cta.button'); ?>
                        </a>
                        
                        <!-- Alternative: Typeform embed -->
                        <!-- <div data-tf-widget="YOUR_FORM_ID" data-tf-opacity="100" style="width:100%;height:600px;"></div>
                        <script src="//embed.typeform.com/next/embed.js"></script> -->
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
