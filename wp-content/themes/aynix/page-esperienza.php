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
            <!-- Named Experiences Section -->
            <section class="named-experiences">
                <div class="named-header">
                    <h2><?php echo aynix_translate('esperienza.named.title'); ?></h2>
                    <p class="named-subtitle"><strong><?php echo aynix_translate('esperienza.named.subtitle'); ?></strong><br>
                    <?php echo aynix_translate('esperienza.named.subtitle2'); ?></p>
                </div>
                
                <p class="named-intro"><?php echo aynix_translate('esperienza.named.intro'); ?></p>
                
                <div class="named-experiences-grid">
                    <!-- SafeFleet -->
                    <div class="named-card">
                        <h3><?php echo aynix_translate('esperienza.named.safefleet.title'); ?></h3>
                        <p class="named-tags"><em><?php echo aynix_translate('esperienza.named.safefleet.tags'); ?></em></p>
                        <p><?php echo aynix_translate('esperienza.named.safefleet.description'); ?></p>
                    </div>
                    
                    <!-- Navenza -->
                    <div class="named-card">
                        <h3><?php echo aynix_translate('esperienza.named.navenza.title'); ?></h3>
                        <p class="named-tags"><em><?php echo aynix_translate('esperienza.named.navenza.tags'); ?></em></p>
                        <p><?php echo aynix_translate('esperienza.named.navenza.description'); ?></p>
                    </div>
                    
                    <!-- Pinguito -->
                    <div class="named-card">
                        <h3><?php echo aynix_translate('esperienza.named.pinguito.title'); ?></h3>
                        <p class="named-tags"><em><?php echo aynix_translate('esperienza.named.pinguito.tags'); ?></em></p>
                        <p><?php echo aynix_translate('esperienza.named.pinguito.description'); ?></p>
                    </div>
                </div>
                
                <p class="named-method-note"><em><?php echo aynix_translate('esperienza.named.method_note'); ?></em></p>
                
                <div class="named-cta">
                    <a href="<?php echo esc_url(home_url('/diagnosi')); ?>" class="btn-primary btn-large">
                        👉 <?php echo aynix_translate('esperienza.named.cta'); ?>
                    </a>
                </div>
            </section>

            <!-- Intro -->
            <section class="esperienza-intro">
                <p class="lead-text"><?php echo aynix_translate('esperienza.intro.text'); ?></p>
            </section>

            <!-- Case Studies -->
            <section class="case-studies">
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
