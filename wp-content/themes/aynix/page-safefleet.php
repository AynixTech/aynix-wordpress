<?php
/**
 * Template Name: SafeFleet Experience
 * Description: Pagina dedicata all'esperienza SafeFleet
 */
get_header();
?>

<main>
    <div class="page-layout safefleet-page">
        <!-- Hero Section -->
        <section class="safefleet-hero">
            <div class="container">
                <div class="hero-content">
                    <div class="safefleet-logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/safefleet/safefleet-logo.png" alt="SafeFleet">
                    </div>
                    <h1><?php echo aynix_translate('safefleet.hero.title'); ?></h1>
                    <p class="hero-subtitle"><?php echo aynix_translate('safefleet.hero.subtitle'); ?></p>
                    <div class="hero-tags">
                        <span class="tag">Fleet Management</span>
                        <span class="tag">Driver Documentation</span>
                        <span class="tag">Tire Lifecycle</span>
                        <span class="tag">Attendance Control</span>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <!-- Overview Section -->
            <section class="safefleet-overview">
                <h2><?php echo aynix_translate('safefleet.overview.title'); ?></h2>
                <p class="lead-text"><?php echo aynix_translate('safefleet.overview.text'); ?></p>
            </section>

            <!-- Problem Section -->
            <section class="safefleet-section">
                <div class="section-content">
                    <div class="section-icon problema-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h2><?php echo aynix_translate('safefleet.problem.title'); ?></h2>
                    <p><?php echo aynix_translate('safefleet.problem.text'); ?></p>
                    <ul class="feature-list">
                        <li><?php echo aynix_translate('safefleet.problem.point1'); ?></li>
                        <li><?php echo aynix_translate('safefleet.problem.point2'); ?></li>
                        <li><?php echo aynix_translate('safefleet.problem.point3'); ?></li>
                        <li><?php echo aynix_translate('safefleet.problem.point4'); ?></li>
                    </ul>
                </div>
            </section>

            <!-- Solution Section -->
            <section class="safefleet-section safefleet-solution">
                <div class="section-content">
                    <div class="section-icon soluzione-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h2><?php echo aynix_translate('safefleet.solution.title'); ?></h2>
                    <p><?php echo aynix_translate('safefleet.solution.text'); ?></p>
                </div>
            </section>

            <!-- Features Grid -->
            <section class="safefleet-features">
                <h2><?php echo aynix_translate('safefleet.features.title'); ?></h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <h3><?php echo aynix_translate('safefleet.features.feature1_title'); ?></h3>
                        <p><?php echo aynix_translate('safefleet.features.feature1_desc'); ?></p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h3><?php echo aynix_translate('safefleet.features.feature2_title'); ?></h3>
                        <p><?php echo aynix_translate('safefleet.features.feature2_desc'); ?></p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-life-ring"></i>
                        </div>
                        <h3><?php echo aynix_translate('safefleet.features.feature3_title'); ?></h3>
                        <p><?php echo aynix_translate('safefleet.features.feature3_desc'); ?></p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h3><?php echo aynix_translate('safefleet.features.feature4_title'); ?></h3>
                        <p><?php echo aynix_translate('safefleet.features.feature4_desc'); ?></p>
                    </div>
                </div>
            </section>

            <!-- Screenshots Section -->
            <section class="safefleet-screenshots">
                <h2><?php echo aynix_translate('safefleet.screenshots.title'); ?></h2>
                <div class="screenshots-grid">
                    <div class="screenshot-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/safefleet/safefleet-screenshot-1.png" alt="SafeFleet Dashboard">
                        <p><?php echo aynix_translate('safefleet.screenshots.caption1'); ?></p>
                    </div>
                    <div class="screenshot-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/safefleet/safefleet-screenshot-2.png" alt="SafeFleet Driver Management">
                        <p><?php echo aynix_translate('safefleet.screenshots.caption2'); ?></p>
                    </div>
                    <div class="screenshot-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/safefleet/safefleet-screenshot-3.png" alt="SafeFleet Tire Management">
                        <p><?php echo aynix_translate('safefleet.screenshots.caption3'); ?></p>
                    </div>
                    <div class="screenshot-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/safefleet/safefleet-screenshot-4.png" alt="SafeFleet Vehicle Control">
                        <p><?php echo aynix_translate('safefleet.screenshots.caption4'); ?></p>
                    </div>
                </div>
            </section>

            <!-- Results Section -->
            <section class="safefleet-results">
                <h2><?php echo aynix_translate('safefleet.results.title'); ?></h2>
                <div class="results-grid">
                    <div class="result-card">
                        <div class="result-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3><?php echo aynix_translate('safefleet.results.result1_title'); ?></h3>
                        <p><?php echo aynix_translate('safefleet.results.result1_desc'); ?></p>
                    </div>
                    <div class="result-card">
                        <div class="result-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3><?php echo aynix_translate('safefleet.results.result2_title'); ?></h3>
                        <p><?php echo aynix_translate('safefleet.results.result2_desc'); ?></p>
                    </div>
                    <div class="result-card">
                        <div class="result-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <h3><?php echo aynix_translate('safefleet.results.result3_title'); ?></h3>
                        <p><?php echo aynix_translate('safefleet.results.result3_desc'); ?></p>
                    </div>
                    <div class="result-card">
                        <div class="result-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3><?php echo aynix_translate('safefleet.results.result4_title'); ?></h3>
                        <p><?php echo aynix_translate('safefleet.results.result4_desc'); ?></p>
                    </div>
                </div>
            </section>

            <!-- CTA Demo -->
            <section class="safefleet-cta">
                <div class="cta-box">
                    <h2><?php echo aynix_translate('safefleet.cta.title'); ?></h2>
                    <p><?php echo aynix_translate('safefleet.cta.subtitle'); ?></p>
                    <a href="<?php echo esc_url(aynix_get_translated_url('diagnosi')); ?>" class="btn-primary btn-large">
                        <?php echo aynix_translate('safefleet.cta.button'); ?>
                    </a>
                </div>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
