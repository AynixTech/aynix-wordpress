<?php
/**
 * Template Name: Esperienza
 * Description: Pagina dedicata ai case studies ed esperienza AYNIX
 */
get_header();
?>

<main>
    <div class="page-layout esperienza-page">
        <!-- Hero Section -->
        <section class="hero-page">
            <div class="container">
                <h1><?php echo aynix_translate('esperienza.hero.title'); ?></h1>
                <p class="hero-subtitle"><?php echo aynix_translate('esperienza.hero.subtitle'); ?></p>
            </div>
        </section>

        <div class="container">
            <!-- Intro -->
            <section class="esperienza-intro">
                <p class="lead-text"><?php echo aynix_translate('esperienza.intro.text'); ?></p>
            </section>

            <!-- SEZIONE 1: Named Experiences -->
            <section class="named-experiences">
                <h2><?php echo aynix_translate('esperienza.named_experiences.title'); ?></h2>
                <p class="section-subtitle"><?php echo aynix_translate('esperienza.named_experiences.subtitle'); ?></p>
                <p class="section-intro"><?php echo aynix_translate('esperienza.named_experiences.intro'); ?></p>

                <div class="case-studies">
                    <!-- SafeFleet -->
                    <div class="case-card experience-card">
                        <div class="case-badge">Experience</div>
                        <div class="case-label">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/safefleet-logo.png" alt="SafeFleet" class="case-logo">
                        </div>
                        <p class="experience-intro"><?php echo aynix_translate('esperienza.named_experiences.case_intro'); ?></p>
                        <div class="case-content">
                        <div class="case-section">
                            <div class="case-icon problema-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.safefleet.problema_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.safefleet.problema'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon soluzione-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.safefleet.soluzione_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.safefleet.soluzione'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon risultato-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.safefleet.risultato_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.safefleet.risultato'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Navenza -->
                <div class="case-card experience-card">
                    <div class="case-badge">Experience</div>
                    <div class="case-label">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/navenza-logo.svg" alt="Navenza" class="case-logo">
                    </div>
                    <p class="experience-intro"><?php echo aynix_translate('esperienza.named_experiences.case_intro'); ?></p>
                    <div class="case-content">
                        <div class="case-section">
                            <div class="case-icon problema-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.navenza.problema_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.navenza.problema'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon soluzione-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.navenza.soluzione_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.navenza.soluzione'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon risultato-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.navenza.risultato_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.navenza.risultato'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Pinguito -->
                <div class="case-card experience-card">
                    <div class="case-badge">Experience</div>
                    <div class="case-label">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pinguito-logo.png" alt="Pinguito" class="case-logo">
                    </div>
                    <p class="experience-intro"><?php echo aynix_translate('esperienza.named_experiences.case_intro'); ?></p>
                    <div class="case-content">
                        <div class="case-section">
                            <div class="case-icon problema-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.pinguito.problema_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.pinguito.problema'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon soluzione-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.pinguito.soluzione_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.pinguito.soluzione'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon risultato-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.pinguito.risultato_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.pinguito.risultato'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            </section>

            <!-- SEZIONE 2: Casi risolti con diagnosi -->
            <section class="diagnosed-cases">
                <h2><?php echo aynix_translate('esperienza.diagnosed_cases.title'); ?></h2>
                <p class="section-subtitle"><?php echo aynix_translate('esperienza.diagnosed_cases.subtitle'); ?></p>
                <p class="section-intro"><?php echo aynix_translate('esperienza.diagnosed_cases.intro'); ?></p>
                <p class="section-key-phrase"><?php echo aynix_translate('esperienza.diagnosed_cases.key_phrase'); ?></p>

                <div class="case-studies">
                    <!-- Case 1 -->
                    <div class="case-card">
                        <div class="case-label"><?php echo aynix_translate('esperienza.case_label'); ?> 1</div>
                        <div class="case-content">
                        <div class="case-section">
                            <div class="case-icon problema-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case1.problema_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case1.problema'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon soluzione-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case1.soluzione_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case1.soluzione'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon risultato-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case1.risultato_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case1.risultato'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Case 2 -->
                <div class="case-card">
                    <div class="case-label"><?php echo aynix_translate('esperienza.case_label'); ?> 2</div>
                    <div class="case-content">
                        <div class="case-section">
                            <div class="case-icon problema-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case2.problema_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case2.problema'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon soluzione-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case2.soluzione_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case2.soluzione'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon risultato-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case2.risultato_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case2.risultato'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Case 3 -->
                <div class="case-card">
                    <div class="case-label"><?php echo aynix_translate('esperienza.case_label'); ?> 3</div>
                    <div class="case-content">
                        <div class="case-section">
                            <div class="case-icon problema-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case3.problema_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case3.problema'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon soluzione-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case3.soluzione_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case3.soluzione'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon risultato-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case3.risultato_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case3.risultato'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Case 4 -->
                <div class="case-card">
                    <div class="case-label"><?php echo aynix_translate('esperienza.case_label'); ?> 4</div>
                    <div class="case-content">
                        <div class="case-section">
                            <div class="case-icon problema-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case4.problema_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case4.problema'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon soluzione-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case4.soluzione_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case4.soluzione'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon risultato-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case4.risultato_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case4.risultato'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Case 5 -->
                <div class="case-card">
                    <div class="case-label"><?php echo aynix_translate('esperienza.case_label'); ?> 5</div>
                    <div class="case-content">
                        <div class="case-section">
                            <div class="case-icon problema-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case5.problema_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case5.problema'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon soluzione-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case5.soluzione_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case5.soluzione'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon risultato-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case5.risultato_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case5.risultato'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Case 6 -->
                <div class="case-card">
                    <div class="case-label"><?php echo aynix_translate('esperienza.case_label'); ?> 6</div>
                    <div class="case-content">
                        <div class="case-section">
                            <div class="case-icon problema-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case6.problema_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case6.problema'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon soluzione-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case6.soluzione_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case6.soluzione'); ?></p>
                        </div>
                        <div class="case-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="case-section">
                            <div class="case-icon risultato-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3><?php echo aynix_translate('esperienza.case6.risultato_title'); ?></h3>
                            <p><?php echo aynix_translate('esperienza.case6.risultato'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            </section>

            <!-- CTA finale -->
            <section class="esperienza-cta">
                <div class="cta-box">
                    <h2><?php echo aynix_translate('esperienza.cta.title'); ?></h2>
                    <p><?php echo aynix_translate('esperienza.cta.subtitle'); ?></p>
                    <a href="<?php echo esc_url(home_url('/diagnosi')); ?>" class="btn-primary btn-large">
                        <?php echo aynix_translate('esperienza.cta.button'); ?>
                    </a>
                </div>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
