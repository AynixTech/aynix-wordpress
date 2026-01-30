<?php get_header(); ?>

<main>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-background">
            <div class="background-container">
                <div class="gradient-bg">
                    <svg xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <filter id="goo">
                                <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -8" result="goo" />
                                <feBlend in="SourceGraphic" in2="goo" />
                            </filter>
                        </defs>
                    </svg>
                    <div class="gradients-container">
                        <div class="g1"></div>
                        <div class="g2"></div>
                        <div class="g3"></div>
                        <div class="g4"></div>
                        <div class="g5"></div>
                        <div class="interactive"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="hero-content">
                <div class="hero-left">
                    <h1><?php echo aynix_translate('home.hero.title'); ?></h1>
                    <p><?php echo aynix_translate('home.hero.description'); ?></p>
                    <div class="hero-buttons">
                        <a class="btn-primary btn-large" href="<?php echo esc_url(home_url('/diagnosi')); ?>">
                            <?php echo aynix_translate('cta.avvia_diagnosi'); ?>
                        </a>
                    </div>
                    <p class="hero-microcopy"><?php echo aynix_translate('cta.microcopy'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Sections -->
    <div class="homepage-content">
        <div class="container">
            <!-- Metodo in 3 fasi -->
            <section class="metodo-home">
                <div class="section-title">
                    <h2><?php echo aynix_translate('home.metodo.title'); ?></h2>
                    <p><?php echo aynix_translate('home.metodo.subtitle'); ?></p>
                </div>
                <div class="metodo-fasi-home">
                    <div class="fase-home">
                        <div class="fase-number">1</div>
                        <h3><?php echo aynix_translate('home.metodo.fase1_title'); ?></h3>
                        <p><?php echo aynix_translate('home.metodo.fase1_desc'); ?></p>
                    </div>
                    <div class="fase-home">
                        <div class="fase-number">2</div>
                        <h3><?php echo aynix_translate('home.metodo.fase2_title'); ?></h3>
                        <p><?php echo aynix_translate('home.metodo.fase2_desc'); ?></p>
                    </div>
                    <div class="fase-home">
                        <div class="fase-number">3</div>
                        <h3><?php echo aynix_translate('home.metodo.fase3_title'); ?></h3>
                        <p><?php echo aynix_translate('home.metodo.fase3_desc'); ?></p>
                    </div>
                </div>
            </section>

            <!-- Prodotti Experience -->
            <section class="experience-products">
                <div class="section-title">
                    <h2><?php echo aynix_translate('experience.title'); ?></h2>
                    <p><?php echo aynix_translate('experience.subtitle'); ?></p>
                </div>
                <div class="products-grid">
                    <div class="product-card">
                        <div class="product-logo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/safefleet-logo.png" alt="SafeFleet">
                        </div>
                        <h3>SafeFleet</h3>
                        <p><?php echo aynix_translate('demo.safefleet.description'); ?></p>
                        <a href="<?php echo home_url('/experience/safefleet'); ?>" class="cta-button">
                            <?php echo aynix_translate('experience.view_project'); ?>
                        </a>
                    </div>
                    <div class="product-card">
                        <div class="product-logo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/navenza-logo.svg" alt="Navenza">
                        </div>
                        <h3>Navenza</h3>
                        <p><?php echo aynix_translate('innovation_solutions.navenza'); ?></p>
                        <a href="<?php echo home_url('/experience/navenza'); ?>" class="cta-button">
                            <?php echo aynix_translate('experience.view_project'); ?>
                        </a>
                    </div>
                    <div class="product-card">
                        <div class="product-logo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pinguito-logo.png" alt="Pinguito">
                        </div>
                        <h3>Pinguito</h3>
                        <p><?php echo aynix_translate('innovation_solutions.pinguito'); ?></p>
                        <a href="<?php echo home_url('/experience/pinguito'); ?>" class="cta-button">
                            <?php echo aynix_translate('experience.view_project'); ?>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Problemi che risolviamo -->
            <section class="problemi-home">
                <div class="section-title">
                    <h2><?php echo aynix_translate('home.problemi.title'); ?></h2>
                    <p><?php echo aynix_translate('home.problemi.subtitle'); ?></p>
                </div>
                <div class="problemi-grid-home">
                    <div class="problema-home">
                        <i class="fas fa-stopwatch"></i>
                        <h3><?php echo aynix_translate('home.problemi.problema1'); ?></h3>
                    </div>
                    <div class="problema-home">
                        <i class="fas fa-unlink"></i>
                        <h3><?php echo aynix_translate('home.problemi.problema2'); ?></h3>
                    </div>
                    <div class="problema-home">
                        <i class="fas fa-exclamation-triangle"></i>
                        <h3><?php echo aynix_translate('home.problemi.problema3'); ?></h3>
                    </div>
                    <div class="problema-home">
                        <i class="fas fa-database"></i>
                        <h3><?php echo aynix_translate('home.problemi.problema4'); ?></h3>
                    </div>
                </div>
                <div class="problemi-cta-home">
                    <a href="<?php echo esc_url(home_url('/problemi')); ?>" class="btn-secondary">
                        <?php echo aynix_translate('home.problemi.view_all'); ?>
                    </a>
                </div>
            </section>

            <!-- Perché AYNIX -->
            <section class="perche-aynix">
                <div class="section-title">
                    <h2><?php echo aynix_translate('home.perche.title'); ?></h2>
                </div>
                <div class="perche-grid">
                    <div class="perche-item">
                        <i class="fas fa-stethoscope"></i>
                        <h3><?php echo aynix_translate('home.perche.punto1_title'); ?></h3>
                        <p><?php echo aynix_translate('home.perche.punto1_desc'); ?></p>
                    </div>
                    <div class="perche-item">
                        <i class="fas fa-chart-line"></i>
                        <h3><?php echo aynix_translate('home.perche.punto2_title'); ?></h3>
                        <p><?php echo aynix_translate('home.perche.punto2_desc'); ?></p>
                    </div>
                    <div class="perche-item">
                        <i class="fas fa-handshake"></i>
                        <h3><?php echo aynix_translate('home.perche.punto3_title'); ?></h3>
                        <p><?php echo aynix_translate('home.perche.punto3_desc'); ?></p>
                    </div>
                </div>
            </section>

            <!-- Insert 3 services block (mantenuto per compatibilità) -->
            <section class="services" style="display: none;">
                <div class="service">
                    <div class="service-header">
                        <i class="fas fa-mobile-alt"></i>
                        <h3><?php echo aynix_translate('app_development.title'); ?></h3>
                    </div>
                    <p class="service-description"><?php echo aynix_translate('app_development.description'); ?></p>
                </div>
                <div class="service">
                    <div class="service-header">
                        <i class="fas fa-cogs"></i>
                        <h3><?php echo aynix_translate('process_automation.title'); ?></h3>
                    </div>
                    <p class="service-description"><?php echo aynix_translate('process_automation.description'); ?></p>
                </div>
                <div class="service">
                    <div class="service-header">
                        <i class="fas fa-link"></i>
                        <h3><?php echo aynix_translate('integrations_api.title'); ?></h3>
                    </div>
                    <p class="service-description"><?php echo aynix_translate('integrations_api.description'); ?></p>
                </div>
                <div class="service">
                    <div class="service-header">
                        <i class="fas fa-lightbulb"></i>
                        <h3><?php echo aynix_translate('technology_consulting.title'); ?></h3>
                    </div>
                    <p class="service-description"><?php echo aynix_translate('technology_consulting.description'); ?></p>
                </div>
                <div class="service">
                    <div class="service-header">
                        <i class="fas fa-robot"></i>
                        <h3><?php echo aynix_translate('ai_agent_creation.title'); ?></h3>
                    </div>
                    <p class="service-description"><?php echo aynix_translate('ai_agent_creation.description'); ?></p>
                </div>
            </section>
            <div class="container-presentation">
                 <div class="section-title">
                    <h2><?php echo aynix_translate('presentation.title'); ?></h2>
                    <p><?php echo aynix_translate('presentation.description'); ?></p>
                </div>
            </div>
            <div class="section-title">
                <h3><?php echo aynix_translate('latest_articles.title'); ?></h3>
                <p><?php echo aynix_translate('latest_articles.description'); ?></p>
            </div>
            <?php
            // Query latest posts
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => 4,
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) : ?>
                <div class="container-articles">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <article class="homepage">
                            <div class="post-thumbnail">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        </article>
                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p>No articles found.</p>
            <?php endif; ?>

            <!-- CTA finale -->
            <section class="home-cta-final">
                <div class="cta-box">
                    <h2><?php echo aynix_translate('home.cta.title'); ?></h2>
                    <p><?php echo aynix_translate('home.cta.subtitle'); ?></p>
                    <a href="<?php echo esc_url(home_url('/diagnosi')); ?>" class="btn-primary btn-large">
                        <?php echo aynix_translate('cta.avvia_diagnosi'); ?>
                    </a>
                    <p class="cta-microcopy"><?php echo aynix_translate('cta.microcopy'); ?></p>
                </div>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
