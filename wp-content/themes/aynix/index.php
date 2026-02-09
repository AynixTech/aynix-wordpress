<?php get_header(); ?>

<main itemscope itemtype="https://schema.org/WebPage">
    <!-- Hero Section -->
    <section class="hero" itemscope itemtype="https://schema.org/WPHeader">
        <div class="hero-background" role="presentation" aria-hidden="true">
            <div class="background-container">
                <div class="gradient-bg">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
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
                    <h1 itemprop="headline">
                        <span><?php echo aynix_translate('home.hero.title_part1'); ?></span>
                        <span><?php echo aynix_translate('home.hero.title_part2'); ?></span>
                    </h1>
                    <p itemprop="description"><?php echo aynix_translate('home.hero.description'); ?></p>
                    <div class="hero-buttons">
                        <a class="btn-primary btn-large" 
                           href="<?php echo esc_url(home_url('/diagnosi')); ?>"
                           title="Avvia diagnosi gratuita - Analizza le tue esigenze software"
                           rel="noopener">
                            <?php echo aynix_translate('cta.avvia_diagnosi'); ?>
                        </a>
                    </div>
                    <p class="hero-microcopy"><?php echo aynix_translate('cta.microcopy'); ?></p>
                </div>
                <div class="hero-right" aria-hidden="true">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero/ROBOT.png'); ?>" alt="" loading="lazy" width="420" height="520">
                </div>
            </div>
        </div>
    </section>

    <!-- Content Sections -->
    <div class="homepage-content">
        <!-- Metodo in 3 fasi -->
        <section class="metodo-home" itemscope itemtype="https://schema.org/HowTo">
            <img class="metodo-bg metodo-bg-desktop" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/diagnosi/fondo-diagnosi.svg'); ?>" alt="" loading="lazy" aria-hidden="true">
            <img class="metodo-bg metodo-bg-mobile" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/diagnosi/fondo-diagnosi-mobile.svg'); ?>" alt="" loading="lazy" aria-hidden="true">
            <div class="metodo-layout">
                <div class="metodo-spacer" aria-hidden="true"></div>
                <div class="metodo-content">
                    <div class="section-title">
                        <h2 itemprop="name"><?php echo aynix_translate('home.metodo.title'); ?></h2>
                        <p itemprop="description"><?php echo aynix_translate('home.metodo.subtitle'); ?></p>
                    </div>
                    <div class="metodo-fasi-home">
                        <article class="fase-home" itemscope itemtype="https://schema.org/HowToStep" itemprop="step">
                            <meta itemprop="position" content="1">
                            <div class="fase-number" aria-label="Fase 1">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/diagnosi/diagnosi.svg'); ?>" alt="Diagnosi" loading="lazy" width="90" height="90">
                            </div>
                            <h3 itemprop="name"><?php echo aynix_translate('home.metodo.fase1_title'); ?></h3>
                            <p itemprop="text"><?php echo aynix_translate('home.metodo.fase1_desc'); ?></p>
                        </article>
                        <article class="fase-home" itemscope itemtype="https://schema.org/HowToStep" itemprop="step">
                            <meta itemprop="position" content="2">
                            <div class="fase-number" aria-label="Fase 2">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/diagnosi/progrettazione.svg'); ?>" alt="Progettazione" loading="lazy" width="90" height="90">
                            </div>
                            <h3 itemprop="name"><?php echo aynix_translate('home.metodo.fase2_title'); ?></h3>
                            <p itemprop="text"><?php echo aynix_translate('home.metodo.fase2_desc'); ?></p>
                        </article>
                        <article class="fase-home" itemscope itemtype="https://schema.org/HowToStep" itemprop="step">
                            <meta itemprop="position" content="3">
                            <div class="fase-number" aria-label="Fase 3">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/diagnosi/implementazione.svg'); ?>" alt="Implementazione" loading="lazy" width="90" height="90">
                            </div>
                            <h3 itemprop="name"><?php echo aynix_translate('home.metodo.fase3_title'); ?></h3>
                            <p itemprop="text"><?php echo aynix_translate('home.metodo.fase3_desc'); ?></p>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <!-- Prodotti Experience -->
            <section class="experience-products" itemscope itemtype="https://schema.org/ItemList">
                <div class="section-title">
                    <h2 itemprop="name"><?php echo aynix_translate('experience.title'); ?></h2>
                    <p itemprop="description"><?php echo aynix_translate('experience.subtitle'); ?></p>
                </div>
                <div class="products-grid">
                    <article class="product-card" itemscope itemtype="https://schema.org/SoftwareApplication" itemprop="itemListElement">
                        <meta itemprop="position" content="1">
                        <div class="product-logo" itemprop="image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/safefleet-logo.png" 
                                 alt="SafeFleet - Sistema di gestione flotte aziendali e attività team"
                                 width="120" 
                                 height="120"
                                 loading="lazy">
                        </div>
                        <h3 itemprop="name" class="sr-only">SafeFleet</h3>
                        <p itemprop="description"><?php echo aynix_translate('demo.safefleet.description'); ?></p>
                        <a href="<?php echo home_url('/safe-fleet'); ?>" 
                           class="cta-button" 
                           itemprop="url"
                           title="Scopri il caso di studio SafeFleet - Gestione flotte aziendali"
                           rel="noopener">
                            <?php echo aynix_translate('experience.view_project'); ?>
                        </a>
                        <meta itemprop="applicationCategory" content="BusinessApplication">
                        <meta itemprop="operatingSystem" content="Web">
                    </article>
                    <article class="product-card" itemscope itemtype="https://schema.org/SoftwareApplication" itemprop="itemListElement">
                        <meta itemprop="position" content="2">
                        <div class="product-logo" itemprop="image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/navenza-logo.svg" 
                                 alt="Navenza - Piattaforma gestione spedizioni internazionali multi-corriere"
                                 width="120" 
                                 height="120"
                                 loading="lazy">
                        </div>
                        <h3 itemprop="name" class="sr-only">Navenza</h3>
                        <p itemprop="description"><?php echo aynix_translate('innovation_solutions.navenza'); ?></p>
                        <a href="<?php echo home_url('/navenza'); ?>" 
                           class="cta-button" 
                           itemprop="url"
                           title="Scopri il caso di studio Navenza - Gestione spedizioni internazionali"
                           rel="noopener">
                            <?php echo aynix_translate('experience.view_project'); ?>
                        </a>
                        <meta itemprop="applicationCategory" content="BusinessApplication">
                        <meta itemprop="operatingSystem" content="Web">
                    </article>
                    <article class="product-card" itemscope itemtype="https://schema.org/SoftwareApplication" itemprop="itemListElement">
                        <meta itemprop="position" content="3">
                        <div class="product-logo" itemprop="image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pinguito-logo.png" 
                                 alt="Pinguito - Piattaforma automazione marketing social media"
                                 width="120" 
                                 height="120"
                                 loading="lazy">
                        </div>
                        <h3 itemprop="name" class="sr-only">Pinguito</h3>
                        <p itemprop="description"><?php echo aynix_translate('innovation_solutions.pinguito'); ?></p>
                        <a href="<?php echo home_url('/pinguito'); ?>" 
                           class="cta-button" 
                           itemprop="url"
                           title="Scopri il caso di studio Pinguito - Marketing automation social media"
                           rel="noopener">
                            <?php echo aynix_translate('experience.view_project'); ?>
                        </a>
                        <meta itemprop="applicationCategory" content="BusinessApplication">
                        <meta itemprop="operatingSystem" content="Web">
                    </article>
                </div>
            </section>

            <!-- Problemi che risolviamo -->
            <section class="problemi-home" itemscope itemtype="https://schema.org/ItemList">
                <div class="section-title">
                    <h2 itemprop="name"><?php echo aynix_translate('home.problemi.title'); ?></h2>
                    <p itemprop="description"><?php echo aynix_translate('home.problemi.subtitle'); ?></p>
                </div>
                <div class="problemi-grid-home">
                    <article class="problema-home" itemprop="itemListElement" itemscope itemtype="https://schema.org/Thing">
                        <meta itemprop="position" content="1">
                        <i class="fas fa-stopwatch" aria-hidden="true"></i>
                        <h3 itemprop="name"><?php echo aynix_translate('home.problemi.problema1'); ?></h3>
                    </article>
                    <article class="problema-home" itemprop="itemListElement" itemscope itemtype="https://schema.org/Thing">
                        <meta itemprop="position" content="2">
                        <i class="fas fa-unlink" aria-hidden="true"></i>
                        <h3 itemprop="name"><?php echo aynix_translate('home.problemi.problema2'); ?></h3>
                    </article>
                    <article class="problema-home" itemprop="itemListElement" itemscope itemtype="https://schema.org/Thing">
                        <meta itemprop="position" content="3">
                        <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>
                        <h3 itemprop="name"><?php echo aynix_translate('home.problemi.problema3'); ?></h3>
                    </article>
                    <article class="problema-home" itemprop="itemListElement" itemscope itemtype="https://schema.org/Thing">
                        <meta itemprop="position" content="4">
                        <i class="fas fa-database" aria-hidden="true"></i>
                        <h3 itemprop="name"><?php echo aynix_translate('home.problemi.problema4'); ?></h3>
                    </article>
                </div>
                <div class="problemi-cta-home">
                    <a href="<?php echo esc_url(home_url('/problemi')); ?>" 
                       class="btn-secondary"
                       title="Scopri tutti i problemi che risolviamo con soluzioni software"
                       rel="noopener">
                        <?php echo aynix_translate('home.problemi.view_all'); ?>
                    </a>
                </div>
            </section>

            <!-- Perché AYNIX -->
            <section class="perche-aynix" itemscope itemtype="https://schema.org/ItemList">
                <div class="section-title">
                    <h2 itemprop="name"><?php echo aynix_translate('home.perche.title'); ?></h2>
                </div>
                <div class="perche-grid">
                    <article class="perche-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/Thing">
                        <meta itemprop="position" content="1">
                        <i class="fas fa-stethoscope" aria-hidden="true"></i>
                        <h3 itemprop="name"><?php echo aynix_translate('home.perche.punto1_title'); ?></h3>
                        <p itemprop="description"><?php echo aynix_translate('home.perche.punto1_desc'); ?></p>
                    </article>
                    <article class="perche-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/Thing">
                        <meta itemprop="position" content="2">
                        <i class="fas fa-chart-line" aria-hidden="true"></i>
                        <h3 itemprop="name"><?php echo aynix_translate('home.perche.punto2_title'); ?></h3>
                        <p itemprop="description"><?php echo aynix_translate('home.perche.punto2_desc'); ?></p>
                    </article>
                    <article class="perche-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/Thing">
                        <meta itemprop="position" content="3">
                        <i class="fas fa-handshake" aria-hidden="true"></i>
                        <h3 itemprop="name"><?php echo aynix_translate('home.perche.punto3_title'); ?></h3>
                        <p itemprop="description"><?php echo aynix_translate('home.perche.punto3_desc'); ?></p>
                    </article>
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
            <div class="container-presentation" itemscope itemtype="https://schema.org/Organization">
                 <div class="section-title">
                    <h2 itemprop="name"><?php echo aynix_translate('presentation.title'); ?></h2>
                    <p itemprop="description"><?php echo aynix_translate('presentation.description'); ?></p>
                </div>
            </div>
            <div class="section-title">
                <h3><?php echo aynix_translate('latest_articles.title'); ?></h3>
                <p><?php echo aynix_translate('latest_articles.description'); ?></p>
            </div>
            <?php
            // Query latest posts
            $current_lang = function_exists('aynix_get_current_language') ? aynix_get_current_language() : 'it';
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'meta_query'     => array(
                    array(
                        'key'     => 'lang',
                        'value'   => $current_lang,
                        'compare' => '=',
                    ),
                ),
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) : ?>
                <div class="container-articles" itemscope itemtype="https://schema.org/Blog">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <article class="homepage" itemscope itemtype="https://schema.org/BlogPosting" itemprop="blogPost">
                            <div class="post-thumbnail" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>" 
                                       title="<?php echo esc_attr(get_the_title()); ?>"
                                       rel="bookmark">
                                        <?php the_post_thumbnail('medium', array(
                                            'itemprop' => 'url',
                                            'loading' => 'lazy',
                                            'alt' => get_the_title()
                                        )); ?>
                                    </a>
                                    <meta itemprop="width" content="<?php echo get_option('medium_size_w'); ?>">
                                    <meta itemprop="height" content="<?php echo get_option('medium_size_h'); ?>">
                                <?php endif; ?>
                            </div>
                            <h2 itemprop="headline">
                                <a href="<?php the_permalink(); ?>" 
                                   itemprop="url"
                                   title="<?php echo esc_attr(get_the_title()); ?>"
                                   rel="bookmark">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <meta itemprop="datePublished" content="<?php echo get_the_date('c'); ?>">
                            <meta itemprop="dateModified" content="<?php echo get_the_modified_date('c'); ?>">
                            <div itemprop="author" itemscope itemtype="https://schema.org/Person" style="display:none;">
                                <meta itemprop="name" content="<?php the_author(); ?>">
                            </div>
                            <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" style="display:none;">
                                <meta itemprop="name" content="AYNIX">
                                <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                                    <meta itemprop="url" content="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png">
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p><?php _e('No articles found.', 'aynix'); ?></p>
            <?php endif; ?>

            <!-- CTA finale -->
            <section class="home-cta-final" itemscope itemtype="https://schema.org/WPAdBlock">
                <div class="cta-box">
                    <h2 itemprop="headline"><?php echo aynix_translate('home.cta.title'); ?></h2>
                    <p itemprop="description"><?php echo aynix_translate('home.cta.subtitle'); ?></p>
                    <a href="<?php echo esc_url(home_url('/diagnosi')); ?>" 
                       class="btn-primary btn-large"
                       title="Inizia la diagnosi gratuita - Scopri come AYNIX può aiutarti"
                       rel="noopener">
                        <?php echo aynix_translate('cta.avvia_diagnosi'); ?>
                    </a>
                    <p class="cta-microcopy"><?php echo aynix_translate('cta.microcopy'); ?></p>
                </div>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
