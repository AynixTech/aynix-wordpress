<?php
if (!defined('ABSPATH')) {
    exit;
}
/** @var string $message */
/** @var string $logo */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex, nofollow" />
    <title>AYNIX</title>
    <link rel="stylesheet" href="<?php echo esc_url(AYNIX_SP_URL . 'assets/css/viewer.css'); ?>?v=<?php echo esc_attr(AYNIX_SP_VERSION); ?>" />
</head>
<body class="aynix-sp-viewer">
    <header class="aynix-sp-topbar">
        <?php echo AYNIX_Share_Presentation::get_instance()->get_site_logo_html(); ?>
    </header>
    <main class="aynix-sp-main">
        <div class="aynix-sp-panel">
            <h1>404</h1>
            <p class="aynix-sp-sub"><?php echo esc_html($message); ?></p>
        </div>
    </main>
    <footer class="aynix-sp-footer">
        <span>Powered by <a href="https://aynix.tech" target="_blank" rel="noopener">AYNIX</a></span>
    </footer>
</body>
</html>
