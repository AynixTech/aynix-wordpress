<?php
/**
 * Template Name: SafeFleet Experience
 * Description: Pagina dedicata all'esperienza SafeFleet
 */
get_header();
$sf_assets = get_template_directory_uri() . '/assets/images/safefleet';
?>

<main>
    <div id="sf-product-page" class="page-layout safefleet-page">
        <section class="sf-hero">
            <div class="sf-hero-overlay"></div>
            <div class="container sf-hero-inner">
                <div class="sf-hero-card">
                    <h1><span>Safe</span>Fleet</h1>
                    <p><?php echo aynix_translate('safefleet.hero.description'); ?></p>
                </div>
            </div>
            <div class="sf-hero-wave">
                <div class="container sf-hero-claim">
                    <div class="sf-hero-claim-icon">
                        <img src="<?php echo esc_url($sf_assets . '/logoandslogan.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.smart_fleet_icon')); ?>">
                    </div>
                    <p><?php echo aynix_translate('safefleet.hero.claim'); ?></p>
                </div>
            </div>
        </section>

        <section class="sf-how">
            <div class="sf-split sf-split-light">
                <div class="sf-col sf-col-content">
                    <div class="sf-content-wrap">
                        <h2><?php echo aynix_translate('safefleet.how.title'); ?></h2>
                        <p class="sf-subtitle"><?php echo aynix_translate('safefleet.how.subtitle'); ?></p>
                        <ul class="sf-feature-box">
                            <li><strong><?php echo aynix_translate('safefleet.how.feature1.title'); ?></strong> <?php echo aynix_translate('safefleet.how.feature1.text'); ?></li>
                            <li><strong><?php echo aynix_translate('safefleet.how.feature2.title'); ?></strong> <?php echo aynix_translate('safefleet.how.feature2.text'); ?></li>
                            <li><strong><?php echo aynix_translate('safefleet.how.feature3.title'); ?></strong> <?php echo aynix_translate('safefleet.how.feature3.text'); ?></li>
                            <li><strong><?php echo aynix_translate('safefleet.how.feature4.title'); ?></strong> <?php echo aynix_translate('safefleet.how.feature4.text'); ?></li>
                            <li><strong><?php echo aynix_translate('safefleet.how.feature5.title'); ?></strong> <?php echo aynix_translate('safefleet.how.feature5.text'); ?></li>
                        </ul>
                    </div>
                </div>
                <div class="sf-col sf-col-media sf-dark-panel">
                    <p class="sf-media-caption">Safe<span>Fleet</span></p>
                    <img src="<?php echo esc_url($sf_assets . '/image-middle.jpeg'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.dashboard_panel')); ?>">
                </div>
            </div>
        </section>

        <section class="sf-problems">
            <div class="sf-split sf-split-dark">
                <div class="sf-col sf-col-media">
                    <img src="<?php echo esc_url($sf_assets . '/safefleet-screenshot-4.png'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.operational_problems')); ?>">
                </div>
                <div class="sf-col sf-col-content">
                    <div class="sf-content-wrap">
                        <h2><?php echo aynix_translate('safefleet.problems.title'); ?></h2>
                        <p class="sf-subtitle"><?php echo aynix_translate('safefleet.problems.subtitle'); ?></p>
                        <div class="sf-problem-grid">
                            <article class="sf-problem-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-position.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.traceability_icon')); ?>">
                                <h3><?php echo aynix_translate('safefleet.problems.item1.prefix'); ?> <span><?php echo aynix_translate('safefleet.problems.item1.highlight'); ?></span> <?php echo aynix_translate('safefleet.problems.item1.suffix'); ?></h3>
                            </article>
                            <article class="sf-problem-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-problems.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.attendance_icon')); ?>">
                                <h3><?php echo aynix_translate('safefleet.problems.item2.prefix'); ?> <span><?php echo aynix_translate('safefleet.problems.item2.highlight'); ?></span></h3>
                            </article>
                            <article class="sf-problem-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-expired.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.expired_docs_icon')); ?>">
                                <h3><span><?php echo aynix_translate('safefleet.problems.item3.highlight'); ?></span><?php echo aynix_translate('safefleet.problems.item3.suffix'); ?></h3>
                            </article>
                            <article class="sf-problem-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-lento.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.slow_support_icon')); ?>">
                                <h3><span><?php echo aynix_translate('safefleet.problems.item4.highlight'); ?></span> <?php echo aynix_translate('safefleet.problems.item4.suffix'); ?></h3>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="sf-solution">
            <div class="sf-split sf-split-light">
                <div class="sf-col sf-col-content">
                    <div class="sf-content-wrap">
                        <h2><?php echo aynix_translate('safefleet.solution.title'); ?></h2>
                        <p class="sf-subtitle"><?php echo aynix_translate('safefleet.solution.subtitle'); ?></p>
                        <div class="sf-module-grid">
                            <article class="sf-module-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-folders.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.module_docs_icon')); ?>">
                                <h3><span><?php echo aynix_translate('safefleet.solution.module1.label'); ?></span> - <?php echo aynix_translate('safefleet.solution.module1.title'); ?></h3>
                            </article>
                            <article class="sf-module-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-support.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.module_attendance_icon')); ?>">
                                <h3><span><?php echo aynix_translate('safefleet.solution.module2.label'); ?></span> - <?php echo aynix_translate('safefleet.solution.module2.title'); ?></h3>
                            </article>
                            <article class="sf-module-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-timecarmoney.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.module_inventory_icon')); ?>">
                                <h3><span><?php echo aynix_translate('safefleet.solution.module3.label'); ?></span> - <?php echo aynix_translate('safefleet.solution.module3.title'); ?></h3>
                            </article>
                            <article class="sf-module-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-chatai.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.module_ai_icon')); ?>">
                                <h3><span><?php echo aynix_translate('safefleet.solution.module4.label'); ?></span> - <?php echo aynix_translate('safefleet.solution.module4.title'); ?></h3>
                            </article>
                        </div>
                    </div>
                </div>
                <div class="sf-col sf-col-media">
                    <img src="<?php echo esc_url($sf_assets . '/imagen-bottom.png'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.control_office')); ?>">
                </div>
            </div>
        </section>

        <section class="sf-cta">
            <div class="container">
                <div class="sf-cta-box">
                    <h2><?php echo aynix_translate('safefleet.cta.title'); ?></h2>
                    <p><?php echo aynix_translate('safefleet.cta.text'); ?></p>
                    <a href="<?php echo esc_url(aynix_get_translated_url('diagnosi')); ?>" class="sf-cta-btn"><?php echo aynix_translate('safefleet.cta.button'); ?></a>
                    <small><?php echo aynix_translate('safefleet.cta.note'); ?></small>
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
