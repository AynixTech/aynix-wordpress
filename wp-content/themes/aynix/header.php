<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Meta Title -->
    <title><?php echo aynix_translate('meta.title'); ?> </title>

    <!-- Meta Description -->
    <meta name="description" content="<?php echo aynix_translate('meta.description'); ?>">
    <meta property="og:title" content="<?php echo aynix_translate('meta.title'); ?>" />
    <meta property="og:description" content="<?php echo aynix_translate('meta.description'); ?>" />
    <meta property="og:image" content="https://aynix.tech/wp-content/uploads/2025/11/logo_aynix-1.png" />
    <meta property="og:url" content="https://aynix.com" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Aynix" />

    <?php wp_head(); ?>
    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Aynix",
        "url": "https://www.aynix.tech",
        "logo": "https://aynix.tech/wp-content/uploads/2025/11/logo_aynix-1.png",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+39 3891733185",
            "contactType": "Customer Service"
        },
        "sameAs": [
            "https://www.facebook.com/profile.php?id=61576837830464",
            "https://x.com/Aynixtech",
            "https://www.instagram.com/aynix.tech/",
            "https://www.linkedin.com/company/aynix/posts/?feedView=all"
        ]
        }
    </script>

</head>
<body <?php body_class(); ?>>

<header class="header">
    <div class="header__logo">
        <a href="<?php echo home_url(); ?>">
            <img src="https://aynix.tech/wp-content/uploads/2025/11/logo_aynix-1.png" alt="Aynix logo">
        </a>
    </div>
    <nav class="header__nav">
        <ul class="nav-menu">
            <li><a href="<?php echo home_url(); ?>"><?php echo aynix_translate('nav.home'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/metodo')); ?>"><?php echo aynix_translate('nav.metodo'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/problemi')); ?>"><?php echo aynix_translate('nav.problemi'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/soluzioni')); ?>"><?php echo aynix_translate('nav.soluzioni'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/esperienza')); ?>"><?php echo aynix_translate('nav.esperienza'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/chi-siamo')); ?>"><?php echo aynix_translate('nav.chi_siamo'); ?></a></li>
        </ul>
    </nav>
    <div class="header__contact">
        <a href="<?php echo esc_url(home_url('/diagnosi')); ?>" class="contact-button">
             <button class="btn-primary btn-cta-header"><?php echo aynix_translate('cta.avvia_diagnosi'); ?></button>
        </a>
    </div>
    <div class="hamburger" onclick="toggleMenu()">
        <div class="line"></div>
         <div class="line"></div>
          <div class="line"></div>
    </div>
</header>

<div id="modal-menu" class="modal-menu">
    <div class="menu-content">
        <button class="menu-close" onclick="toggleMenu()">✖</button>
       <nav >
        <ul class="nav-menu">
            <li><a href="<?php echo home_url(); ?>"><?php echo aynix_translate('nav.home'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/metodo')); ?>"><?php echo aynix_translate('nav.metodo'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/problemi')); ?>"><?php echo aynix_translate('nav.problemi'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/soluzioni')); ?>"><?php echo aynix_translate('nav.soluzioni'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/esperienza')); ?>"><?php echo aynix_translate('nav.esperienza'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/chi-siamo')); ?>"><?php echo aynix_translate('nav.chi_siamo'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/diagnosi')); ?>" class="menu-cta-link"><?php echo aynix_translate('cta.avvia_diagnosi'); ?></a></li>
        </ul>
    </nav>
    </div>
</div>

<script>
    function toggleMenu() {
        const modal = document.getElementById('modal-menu');
        modal.classList.toggle('active');
    }
</script>

<!-- Sticky CTA Mobile (solo homepage) -->
<?php if (is_front_page()) : ?>
<div id="sticky-cta-mobile" class="sticky-cta-mobile">
    <a href="<?php echo esc_url(home_url('/diagnosi')); ?>" class="btn-primary">
        <?php echo aynix_translate('cta.avvia_diagnosi'); ?>
    </a>
</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>