<?php
if (!defined('ABSPATH')) {
    exit;
}
/** @var object $item */
/** @var bool $pin_ok */
/** @var string $pin_error */
/** @var string $token */

$logo       = AYNIX_SP_URL . 'assets/images/logo-aynix-white.png';
$client     = $item->client_name ? $item->client_name : $item->company_name;
$plugin     = AYNIX_Share_Presentation::get_instance();

// Build file URL (through the streaming endpoint so PIN is respected)
$file_endpoint = add_query_arg(
    array(
        'aynix_sp_file' => $item->token,
        'pin'           => $item->pin,
    ),
    home_url('/')
);

// Force-download endpoint variant
$download_endpoint = add_query_arg(array('download' => '1'), $file_endpoint);
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex, nofollow" />
    <title><?php echo esc_html($item->company_name); ?> — AYNIX</title>
    <link rel="stylesheet" href="<?php echo esc_url(AYNIX_SP_URL . 'assets/css/viewer.css'); ?>?v=<?php echo esc_attr(AYNIX_SP_VERSION); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class('aynix-sp-viewer'); ?>>
    <?php wp_body_open(); ?>
    <?php echo $plugin->get_site_header_html(); ?>

    <main class="aynix-sp-main">

        <?php if (!$pin_ok) : ?>

            <!-- PIN gate -->
            <div class="aynix-sp-panel aynix-sp-pin-panel">
                <h1><?php echo esc_html(sprintf(__('Hello, %s', 'aynix-share-presentation'), $client)); ?> 👋</h1>
                <p class="aynix-sp-sub"><?php esc_html_e('This presentation is protected by a PIN. Enter the code to continue.', 'aynix-share-presentation'); ?></p>

                <?php if ($pin_error) : ?>
                    <p class="aynix-sp-error"><?php echo esc_html($pin_error); ?></p>
                <?php endif; ?>

                <form method="post" class="aynix-sp-pin-form">
                    <?php wp_nonce_field('aynix_pin_' . $token, 'aynix_pin_nonce'); ?>
                    <input type="text" name="aynix_pin" inputmode="numeric" autocomplete="off" placeholder="PIN" required autofocus />
                    <button type="submit"><?php esc_html_e('Access', 'aynix-share-presentation'); ?></button>
                </form>
            </div>

        <?php else : ?>

            <!-- Content -->
            <div class="aynix-sp-panel aynix-sp-content-panel">
                <h1><?php echo esc_html(sprintf(__('Hello, %s', 'aynix-share-presentation'), $client)); ?> 👋</h1>
                <p class="aynix-sp-sub"><?php echo esc_html(sprintf(__('%s has shared a presentation with you.', 'aynix-share-presentation'), $item->company_name)); ?></p>

                <?php if ($item->file_type === 'pdf') : ?>
                    <div class="aynix-sp-embed">
                        <iframe src="<?php echo esc_url($file_endpoint); ?>#toolbar=1" title="<?php echo esc_attr($item->file_name); ?>"></iframe>
                    </div>
                    <div class="aynix-sp-actions">
                        <a class="aynix-sp-btn aynix-sp-btn-outline" href="<?php echo esc_url($download_endpoint); ?>">
                            <span class="aynix-sp-ico">&#8681;</span> <?php esc_html_e('Download', 'aynix-share-presentation'); ?>
                        </a>
                    </div>
                <?php else : ?>
                    <div class="aynix-sp-embed aynix-sp-pptx-embed">
                        <div id="aynix-sp-pptx"
                             class="aynix-sp-pptx-render"
                             data-file="<?php echo esc_url($file_endpoint); ?>"
                             data-vendor="<?php echo esc_url(AYNIX_SP_URL . 'assets/vendor/pptxjs'); ?>"
                             data-name="<?php echo esc_attr($item->file_name); ?>">
                            <div class="aynix-sp-loader">
                                <div class="aynix-sp-spinner"></div>
                                <p><?php esc_html_e('Loading presentation...', 'aynix-share-presentation'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="aynix-sp-actions">
                        <a class="aynix-sp-btn aynix-sp-btn-outline" href="<?php echo esc_url($download_endpoint); ?>">
                            <span class="aynix-sp-ico">&#8681;</span> <?php esc_html_e('Download', 'aynix-share-presentation'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

        <?php endif; ?>

    </main>

    <footer class="aynix-sp-footer">
        <span>Powered by <a href="https://aynix.tech" target="_blank" rel="noopener">AYNIX</a></span>
    </footer>

    <?php if ($pin_ok && $item->file_type !== 'pdf') : ?>
        <?php $vendor = AYNIX_SP_URL . 'assets/vendor/pptxjs'; ?>
        <link rel="stylesheet" href="<?php echo esc_url($vendor . '/css/pptxjs.css'); ?>?v=<?php echo esc_attr(AYNIX_SP_VERSION); ?>" />
        <link rel="stylesheet" href="<?php echo esc_url($vendor . '/css/nv.d3.min.css'); ?>?v=<?php echo esc_attr(AYNIX_SP_VERSION); ?>" />
        <script src="<?php echo esc_url(AYNIX_SP_URL . 'assets/js/viewer.js'); ?>?v=<?php echo esc_attr(AYNIX_SP_VERSION); ?>"></script>
    <?php endif; ?>

    <?php wp_footer(); ?>

</body>
</html>
