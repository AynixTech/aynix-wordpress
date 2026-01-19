<?php get_header(); ?>

<main>
    <div class="homepage-layout">
        <!-- Insert Hero with background image -->
        <section class="hero">
            <!-- <div class="hero-background">
                <img src="https://aynix.tech/wp-content/uploads/2025/03/wallpaper-andes-with-sunset-and-river.png'" alt="Aynix header logo"/>
            </div> -->
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

            <div class="hero-left">
                <h1><?php echo aynix_translate('hero_section.title'); ?> <br><?php echo aynix_translate('hero_section.subtitle'); ?></h1>
                <p><?php echo aynix_translate('hero_section.description'); ?></p>
               <div class="hero-buttons">
                    <a class="btn-primary" href="<?php echo esc_url(home_url('/about-us')); ?>">
                        <?php echo aynix_translate('hero_section.button_left.text'); ?>
                    </a>
                    <a class="btn-secondary" href="<?php echo esc_url(home_url('/services')); ?>">
                        <?php echo aynix_translate('hero_section.button_right.text'); ?>
                    </a>
                </div>

            </div>
            <div class="hero-right">
                <!-- Optional futuristic HUD (commented out) -->
            </div>
        </section>

        <div class="container">
            <!-- Insert 3 services block -->
            <section class="services">
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

            <?php
                $partners = [
                    [
                        'name' => 'WeCoop',
                        'url' => 'https://www.wecoop.org/',
                        'img' => 'https://aynix.tech/wp-content/uploads/2025/03/wecooplogo2.png',
                        'alt' => 'Partner tecnologico'
                    ],
                    [
                        'name' => 'UNIUMA',
                        'url' => 'https://www.uniuma.it/',
                        'img' => 'https://aynix.tech/wp-content/uploads/2025/11/Logo-Uniuma.png',
                        'alt' => 'Partner tecnologico'
                    ]
                ];

                $clienti = [
                    [
                        'name' => 'Choema',
                        'url' => 'https://choema.com/',
                        'img' => 'https://www.aynix.tech/wp-content/uploads/2025/03/choema-white-1.png',
                        'alt' => 'Choema'
                    ],
                    [
                        'name' => 'SicurezzaFull',
                        'url' => 'https://sicurezzafull.it/',
                        'img' => 'https://www.aynix.tech/wp-content/uploads/2025/03/logo_sicurezzafull_y-1.png',
                        'alt' => 'SicurezzaFull'
                    ]
                ];
                ?>

                <div class="section-title">
                    <h3><?php echo aynix_translate('partners.title'); ?></h3>
                </div>

                <div class="container-partners">
                    <?php foreach ($partners as $partner): ?>
                        <div class="partner">
                            <a href="<?php echo $partner['url']; ?>">
                                <img src="<?php echo $partner['img']; ?>" alt="<?php echo $partner['alt']; ?>" />
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="section-title">
                    <h3><?php echo aynix_translate('clients.title'); ?></h3>
                </div>

                <div class="container-partners">
                    <?php foreach ($clienti as $cliente): ?>
                        <div class="partner">
                            <a href="<?php echo $cliente['url']; ?>">
                                <img src="<?php echo $cliente['img']; ?>" alt="<?php echo $cliente['alt']; ?>" />
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
