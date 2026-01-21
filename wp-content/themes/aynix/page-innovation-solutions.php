<?php
/*
Template Name: Blog Custom with Sidebar
*/
get_header();
?>

<main class="container">
    <div class="page-layout">
        <section class="page-header">
            <h1><?php echo aynix_translate('innovation_solutions.title'); ?></h1>
            <p><?php echo aynix_translate('innovation_solutions.description'); ?></p>
        </section>
        <section class="portfolio-grid">
            <?php
            $portfolio_items = [
                [
                    'title'       => 'Pinguito',
                    'description' => aynix_translate('innovation_solutions.pinguito'),
                    'images'      => [126, 127],
                    'logo'        => 'pinguito-logo.png'
                ],
                [
                    'title'       => 'Safe Fleet',
                    'description' => aynix_translate('innovation_solutions.safe_fleet'),
                    'images'      => [128],
                    'logo'        => 'safefleet-logo.png',
                    'pdfs'        => [
                        'it' => 'https://aynix.tech/wp-content/uploads/2025/11/PITCH-DECK-SAFE-FLEET-IT.pdf',
                        'es' => 'https://aynix.tech/wp-content/uploads/2025/11/PITCH-DECK-SAFE-FLEET-ES.pdf',
                        'en' => 'https://aynix.tech/wp-content/uploads/2025/11/PITCH-DECK-SAFE-FLEET-ING.pdf',
                    ]
                ],
                //Navenza
                [
                    'title'       => 'Navenza',
                    'description' => aynix_translate('innovation_solutions.navenza'),
                    'images'      => [129, 130],
                    'logo'        => 'navenza-logo.svg',
                ],
            ];

            foreach ($portfolio_items as $item) : ?>
                <article class="portfolio-item">
                    <?php if (!empty($item['logo'])) : ?>
                        <div class="portfolio-logo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/<?php echo esc_attr($item['logo']); ?>" alt="<?php echo esc_attr($item['title']); ?> logo" class="portfolio-logo-img">
                        </div>
                    <?php endif; ?>

                    <h2 class="portfolio-title"><?php echo esc_html($item['title']); ?></h2>
                    <div class="portfolio-excerpt">
                        <p><?php echo esc_html($item['description']); ?></p>
                    </div>

                    <?php if (!empty($item['images'])) : ?>
                        <div class="portfolio-gallery swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($item['images'] as $image_id) :
                                    $image_html = wp_get_attachment_image($image_id, 'medium_large', false, [
                                        'class' => 'swiper-lazy',
                                        'style' => 'width: 100%; height: 100%;'
                                    ]);
                                    if (!empty($image_html)) {
                                        echo '<div class="swiper-slide">' . $image_html . '</div>';
                                    }
                                endforeach; ?>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($item['pdfs'])) : ?>
                        <div class="pdf-buttons">
                            <strong>📄 <?php echo aynix_translate('demo.pdf_title'); ?></strong><br>
                            <a class="pdf-link" href="<?php echo esc_url($item['pdfs']['it']); ?>" target="_blank">🇮🇹 IT</a>
                            <a class="pdf-link" href="<?php echo esc_url($item['pdfs']['es']); ?>" target="_blank">🇪🇸 ES</a>
                            <a class="pdf-link" href="<?php echo esc_url($item['pdfs']['en']); ?>" target="_blank">🇬🇧 EN</a>
                        </div>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </section>
    </div>
</main>

<style>
.pdf-buttons {
  margin-top: 15px;
  font-size: 0.95em;
}
.pdf-link {
  display: inline-block;
  margin: 8px 6px 0 0;
  padding: 8px 14px;
  background-color: #0073aa;
  color: #fff;
  text-decoration: none;
  border-radius: 6px;
  font-size: 0.9em;
  transition: background-color 0.3s ease;
}
.pdf-link:hover {
  background-color: #005a8c;
}
</style>

<?php get_footer(); ?>
