<?php
/**
 * Template Name: Soluzioni
 * Description: Pagina dedicata alle soluzioni AYNIX
 */
get_header();
?>

<main>
    <div class="page-layout soluzioni-page">
        <!-- Hero Section -->
        <section class="hero-page">
            <div class="container">
                <h1><?php echo aynix_translate('soluzioni.hero.title'); ?></h1>
                <p class="hero-subtitle"><?php echo aynix_translate('soluzioni.hero.subtitle'); ?></p>
            </div>
        </section>

        <div class="container">
            <!-- Intro -->
            <section class="soluzioni-intro">
                <p class="lead-text"><?php echo aynix_translate('soluzioni.intro.text'); ?></p>
            </section>

            <!-- 3 Card Soluzioni -->
            <section class="soluzioni-cards">
                <div class="soluzioni-grid">
                    <!-- Soluzione 1: Automazione -->
                    <div class="soluzione-card">
                        <div class="soluzione-header">
                            <div class="soluzione-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <h3><?php echo aynix_translate('soluzioni.automazione.title'); ?></h3>
                        </div>
                        <p class="soluzione-desc"><?php echo aynix_translate('soluzioni.automazione.description'); ?></p>
                        <div class="soluzione-examples">
                            <h4><?php echo aynix_translate('soluzioni.examples_title'); ?>:</h4>
                            <ul>
                                <li><?php echo aynix_translate('soluzioni.automazione.example1'); ?></li>
                                <li><?php echo aynix_translate('soluzioni.automazione.example2'); ?></li>
                                <li><?php echo aynix_translate('soluzioni.automazione.example3'); ?></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Soluzione 2: Software Custom -->
                    <div class="soluzione-card">
                        <div class="soluzione-header">
                            <div class="soluzione-icon">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <h3><?php echo aynix_translate('soluzioni.software.title'); ?></h3>
                        </div>
                        <p class="soluzione-desc"><?php echo aynix_translate('soluzioni.software.description'); ?></p>
                        <div class="soluzione-examples">
                            <h4><?php echo aynix_translate('soluzioni.examples_title'); ?>:</h4>
                            <ul>
                                <li><?php echo aynix_translate('soluzioni.software.example1'); ?></li>
                                <li><?php echo aynix_translate('soluzioni.software.example2'); ?></li>
                                <li><?php echo aynix_translate('soluzioni.software.example3'); ?></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Soluzione 3: Integrazioni & IA -->
                    <div class="soluzione-card">
                        <div class="soluzione-header">
                            <div class="soluzione-icon">
                                <i class="fas fa-brain"></i>
                            </div>
                            <h3><?php echo aynix_translate('soluzioni.ia.title'); ?></h3>
                        </div>
                        <p class="soluzione-desc"><?php echo aynix_translate('soluzioni.ia.description'); ?></p>
                        <div class="soluzione-examples">
                            <h4><?php echo aynix_translate('soluzioni.examples_title'); ?>:</h4>
                            <ul>
                                <li><?php echo aynix_translate('soluzioni.ia.example1'); ?></li>
                                <li><?php echo aynix_translate('soluzioni.ia.example2'); ?></li>
                                <li><?php echo aynix_translate('soluzioni.ia.example3'); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Come nascono le soluzioni -->
            <section class="soluzioni-processo">
                <h2><?php echo aynix_translate('soluzioni.processo.title'); ?></h2>
                <div class="processo-timeline">
                    <div class="timeline-item">
                        <div class="timeline-number">1</div>
                        <div class="timeline-content">
                            <h3><?php echo aynix_translate('soluzioni.processo.step1_title'); ?></h3>
                            <p><?php echo aynix_translate('soluzioni.processo.step1_desc'); ?></p>
                        </div>
                    </div>
                    <div class="timeline-connector"></div>
                    <div class="timeline-item">
                        <div class="timeline-number">2</div>
                        <div class="timeline-content">
                            <h3><?php echo aynix_translate('soluzioni.processo.step2_title'); ?></h3>
                            <p><?php echo aynix_translate('soluzioni.processo.step2_desc'); ?></p>
                        </div>
                    </div>
                    <div class="timeline-connector"></div>
                    <div class="timeline-item">
                        <div class="timeline-number">3</div>
                        <div class="timeline-content">
                            <h3><?php echo aynix_translate('soluzioni.processo.step3_title'); ?></h3>
                            <p><?php echo aynix_translate('soluzioni.processo.step3_desc'); ?></p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Differenza AYNIX -->
            <section class="soluzioni-differenza">
                <div class="differenza-box">
                    <h2><?php echo aynix_translate('soluzioni.differenza.title'); ?></h2>
                    <div class="differenza-grid">
                        <div class="differenza-item">
                            <i class="fas fa-times-circle no-icon"></i>
                            <h4><?php echo aynix_translate('soluzioni.differenza.others_title'); ?></h4>
                            <ul>
                                <li><?php echo aynix_translate('soluzioni.differenza.others_1'); ?></li>
                                <li><?php echo aynix_translate('soluzioni.differenza.others_2'); ?></li>
                                <li><?php echo aynix_translate('soluzioni.differenza.others_3'); ?></li>
                            </ul>
                        </div>
                        <div class="differenza-item differenza-item--aynix">
                            <i class="fas fa-check-circle yes-icon"></i>
                            <h4><?php echo aynix_translate('soluzioni.differenza.aynix_title'); ?></h4>
                            <ul>
                                <li><?php echo aynix_translate('soluzioni.differenza.aynix_1'); ?></li>
                                <li><?php echo aynix_translate('soluzioni.differenza.aynix_2'); ?></li>
                                <li><?php echo aynix_translate('soluzioni.differenza.aynix_3'); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA finale -->
            <section class="soluzioni-cta">
                <div class="cta-box">
                    <h2><?php echo aynix_translate('soluzioni.cta.title'); ?></h2>
                    <p><?php echo aynix_translate('soluzioni.cta.subtitle'); ?></p>
                    <a href="<?php echo esc_url(home_url('/diagnosi')); ?>" class="btn-primary btn-large">
                        <?php echo aynix_translate('soluzioni.cta.button'); ?>
                    </a>
                </div>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
