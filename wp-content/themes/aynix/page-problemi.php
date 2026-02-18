<?php
/**
 * Template Name: Problemi
 * Description: Pagina dedicata ai problemi reali che AYNIX risolve
 */
get_header();
?>

<main>
    <div class="page-layout problemi-page">
        <!-- Hero Section -->
        <section class="hero-page">
            <div class="container">
                <h1><?php echo aynix_translate('problemi.hero.title'); ?></h1>
                <p class="hero-subtitle"><?php echo aynix_translate('problemi.hero.subtitle'); ?></p>
            </div>
        </section>

        <div class="container">
            <!-- Intro -->
            <section class="problemi-intro">
                <p class="lead-text"><?php echo aynix_translate('problemi.intro.text'); ?></p>
            </section>

            <!-- Griglia Problemi -->
            <section class="problemi-grid-section">
                <div class="problemi-grid">
                    <!-- Problema 1 -->
                    <div class="problema-card">
                        <div class="problema-icon">
                            <i class="fas fa-stopwatch"></i>
                        </div>
                        <h3><?php echo aynix_translate('problemi.problema1.title'); ?></h3>
                        <div class="problema-content">
                            <p class="problema-desc"><?php echo aynix_translate('problemi.problema1.description'); ?></p>
                            <div class="impatto">
                                <strong><?php echo aynix_translate('problemi.impatto_label'); ?>:</strong>
                                <p><?php echo aynix_translate('problemi.problema1.impatto'); ?></p>
                            </div>
                        </div>
                        <a href="<?php echo esc_url(aynix_get_translated_url('diagnosi')); ?>" class="btn-primary">
                            <?php echo aynix_translate('problemi.cta_button'); ?>
                        </a>
                    </div>

                    <!-- Problema 2 -->
                    <div class="problema-card">
                        <div class="problema-icon">
                            <i class="fas fa-unlink"></i>
                        </div>
                        <h3><?php echo aynix_translate('problemi.problema2.title'); ?></h3>
                        <div class="problema-content">
                            <p class="problema-desc"><?php echo aynix_translate('problemi.problema2.description'); ?></p>
                            <div class="impatto">
                                <strong><?php echo aynix_translate('problemi.impatto_label'); ?>:</strong>
                                <p><?php echo aynix_translate('problemi.problema2.impatto'); ?></p>
                            </div>
                        </div>
                        <a href="<?php echo esc_url(aynix_get_translated_url('diagnosi')); ?>" class="btn-primary">
                            <?php echo aynix_translate('problemi.cta_button'); ?>
                        </a>
                    </div>

                    <!-- Problema 3 -->
                    <div class="problema-card">
                        <div class="problema-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h3><?php echo aynix_translate('problemi.problema3.title'); ?></h3>
                        <div class="problema-content">
                            <p class="problema-desc"><?php echo aynix_translate('problemi.problema3.description'); ?></p>
                            <div class="impatto">
                                <strong><?php echo aynix_translate('problemi.impatto_label'); ?>:</strong>
                                <p><?php echo aynix_translate('problemi.problema3.impatto'); ?></p>
                            </div>
                        </div>
                        <a href="<?php echo esc_url(aynix_get_translated_url('diagnosi')); ?>" class="btn-primary">
                            <?php echo aynix_translate('problemi.cta_button'); ?>
                        </a>
                    </div>

                    <!-- Problema 4 -->
                    <div class="problema-card">
                        <div class="problema-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3><?php echo aynix_translate('problemi.problema4.title'); ?></h3>
                        <div class="problema-content">
                            <p class="problema-desc"><?php echo aynix_translate('problemi.problema4.description'); ?></p>
                            <div class="impatto">
                                <strong><?php echo aynix_translate('problemi.impatto_label'); ?>:</strong>
                                <p><?php echo aynix_translate('problemi.problema4.impatto'); ?></p>
                            </div>
                        </div>
                        <a href="<?php echo esc_url(aynix_get_translated_url('diagnosi')); ?>" class="btn-primary">
                            <?php echo aynix_translate('problemi.cta_button'); ?>
                        </a>
                    </div>

                    <!-- Problema 5 -->
                    <div class="problema-card">
                        <div class="problema-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <h3><?php echo aynix_translate('problemi.problema5.title'); ?></h3>
                        <div class="problema-content">
                            <p class="problema-desc"><?php echo aynix_translate('problemi.problema5.description'); ?></p>
                            <div class="impatto">
                                <strong><?php echo aynix_translate('problemi.impatto_label'); ?>:</strong>
                                <p><?php echo aynix_translate('problemi.problema5.impatto'); ?></p>
                            </div>
                        </div>
                        <a href="<?php echo esc_url(aynix_get_translated_url('diagnosi')); ?>" class="btn-primary">
                            <?php echo aynix_translate('problemi.cta_button'); ?>
                        </a>
                    </div>

                    <!-- Problema 6 -->
                    <div class="problema-card">
                        <div class="problema-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3><?php echo aynix_translate('problemi.problema6.title'); ?></h3>
                        <div class="problema-content">
                            <p class="problema-desc"><?php echo aynix_translate('problemi.problema6.description'); ?></p>
                            <div class="impatto">
                                <strong><?php echo aynix_translate('problemi.impatto_label'); ?>:</strong>
                                <p><?php echo aynix_translate('problemi.problema6.impatto'); ?></p>
                            </div>
                        </div>
                        <a href="<?php echo esc_url(aynix_get_translated_url('diagnosi')); ?>" class="btn-primary">
                            <?php echo aynix_translate('problemi.cta_button'); ?>
                        </a>
                    </div>

                    <!-- Problema 7 -->
                    <div class="problema-card">
                        <div class="problema-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h3><?php echo aynix_translate('problemi.problema7.title'); ?></h3>
                        <div class="problema-content">
                            <p class="problema-desc"><?php echo aynix_translate('problemi.problema7.description'); ?></p>
                            <div class="impatto">
                                <strong><?php echo aynix_translate('problemi.impatto_label'); ?>:</strong>
                                <p><?php echo aynix_translate('problemi.problema7.impatto'); ?></p>
                            </div>
                        </div>
                        <a href="<?php echo esc_url(aynix_get_translated_url('diagnosi')); ?>" class="btn-primary">
                            <?php echo aynix_translate('problemi.cta_button'); ?>
                        </a>
                    </div>

                    <!-- Problema 8 -->
                    <div class="problema-card">
                        <div class="problema-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3><?php echo aynix_translate('problemi.problema8.title'); ?></h3>
                        <div class="problema-content">
                            <p class="problema-desc"><?php echo aynix_translate('problemi.problema8.description'); ?></p>
                            <div class="impatto">
                                <strong><?php echo aynix_translate('problemi.impatto_label'); ?>:</strong>
                                <p><?php echo aynix_translate('problemi.problema8.impatto'); ?></p>
                            </div>
                        </div>
                        <a href="<?php echo esc_url(aynix_get_translated_url('diagnosi')); ?>" class="btn-primary">
                            <?php echo aynix_translate('problemi.cta_button'); ?>
                        </a>
                    </div>
                </div>
            </section>

            <!-- CTA finale -->
            <section class="problemi-cta">
                <div class="cta-box">
                    <h2><?php echo aynix_translate('problemi.final_cta.title'); ?></h2>
                    <p><?php echo aynix_translate('problemi.final_cta.subtitle'); ?></p>
                    <a href="<?php echo esc_url(aynix_get_translated_url('diagnosi')); ?>" class="btn-primary btn-large">
                        <?php echo aynix_translate('problemi.final_cta.button'); ?>
                    </a>
                </div>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
