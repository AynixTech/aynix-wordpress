<?php
/**
 * Template Name: Metodo
 * Description: Pagina dedicata al metodo AYNIX
 */
get_header();
?>

<main>
    <div class="page-layout metodo-page">
        <!-- Hero Section -->
        <section class="hero-page">
            <div class="container">
                <h1><?php echo aynix_translate('metodo.hero.title'); ?></h1>
                <p class="hero-subtitle"><?php echo aynix_translate('metodo.hero.subtitle'); ?></p>
                <a href="<?php echo esc_url(home_url('/diagnosi')); ?>" class="btn-primary btn-large">
                    <?php echo aynix_translate('metodo.hero.cta'); ?>
                </a>
            </div>
        </section>

        <div class="container">
            <!-- Principio -->
            <section class="metodo-principio">
                <h2><?php echo aynix_translate('metodo.principio.title'); ?></h2>
                <div class="principio-content">
                    <p class="lead-text"><?php echo aynix_translate('metodo.principio.text'); ?></p>
                </div>
            </section>

            <!-- 3 Fasi -->
            <section class="metodo-fasi">
                <h2><?php echo aynix_translate('metodo.fasi.title'); ?></h2>
                <div class="fasi-grid">
                    <div class="fase-card">
                        <div class="fase-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="fase-content">
                            <h3><?php echo aynix_translate('metodo.fasi.fase1_title'); ?></h3>
                            <p><?php echo aynix_translate('metodo.fasi.fase1_desc'); ?></p>
                            <ul class="fase-list">
                                <li><?php echo aynix_translate('metodo.fasi.fase1_point1'); ?></li>
                                <li><?php echo aynix_translate('metodo.fasi.fase1_point2'); ?></li>
                                <li><?php echo aynix_translate('metodo.fasi.fase1_point3'); ?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="fase-card">
                        <div class="fase-icon">
                            <i class="fas fa-drafting-compass"></i>
                        </div>
                        <div class="fase-content">
                            <h3><?php echo aynix_translate('metodo.fasi.fase2_title'); ?></h3>
                            <p><?php echo aynix_translate('metodo.fasi.fase2_desc'); ?></p>
                            <ul class="fase-list">
                                <li><?php echo aynix_translate('metodo.fasi.fase2_point1'); ?></li>
                                <li><?php echo aynix_translate('metodo.fasi.fase2_point2'); ?></li>
                                <li><?php echo aynix_translate('metodo.fasi.fase2_point3'); ?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="fase-card">
                        <div class="fase-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="fase-content">
                            <h3><?php echo aynix_translate('metodo.fasi.fase3_title'); ?></h3>
                            <p><?php echo aynix_translate('metodo.fasi.fase3_desc'); ?></p>
                            <ul class="fase-list">
                                <li><?php echo aynix_translate('metodo.fasi.fase3_point1'); ?></li>
                                <li><?php echo aynix_translate('metodo.fasi.fase3_point2'); ?></li>
                                <li><?php echo aynix_translate('metodo.fasi.fase3_point3'); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Perché non usiamo pacchetti -->
            <section class="metodo-no-pacchetti">
                <h2><?php echo aynix_translate('metodo.no_pacchetti.title'); ?></h2>
                <div class="no-pacchetti-content">
                    <div class="no-pacchetti-reasons">
                        <div class="reason-item">
                            <i class="fas fa-times-circle"></i>
                            <p><?php echo aynix_translate('metodo.no_pacchetti.reason1'); ?></p>
                        </div>
                        <div class="reason-item">
                            <i class="fas fa-times-circle"></i>
                            <p><?php echo aynix_translate('metodo.no_pacchetti.reason2'); ?></p>
                        </div>
                        <div class="reason-item">
                            <i class="fas fa-times-circle"></i>
                            <p><?php echo aynix_translate('metodo.no_pacchetti.reason3'); ?></p>
                        </div>
                        <div class="reason-item">
                            <i class="fas fa-times-circle"></i>
                            <p><?php echo aynix_translate('metodo.no_pacchetti.reason4'); ?></p>
                        </div>
                        <div class="reason-item">
                            <i class="fas fa-times-circle"></i>
                            <p><?php echo aynix_translate('metodo.no_pacchetti.reason5'); ?></p>
                        </div>
                        <div class="reason-item">
                            <i class="fas fa-times-circle"></i>
                            <p><?php echo aynix_translate('metodo.no_pacchetti.reason6'); ?></p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Tecnologia è un mezzo -->
            <section class="metodo-tecnologia">
                <div class="tecnologia-box">
                    <i class="fas fa-lightbulb"></i>
                    <h3><?php echo aynix_translate('metodo.tecnologia.title'); ?></h3>
                    <p><?php echo aynix_translate('metodo.tecnologia.text'); ?></p>
                </div>
            </section>

            <!-- CTA finale -->
            <section class="metodo-cta">
                <div class="cta-box">
                    <h2><?php echo aynix_translate('metodo.cta.title'); ?></h2>
                    <p><?php echo aynix_translate('metodo.cta.subtitle'); ?></p>
                    <a href="<?php echo esc_url(home_url('/diagnosi')); ?>" class="btn-primary btn-large">
                        <?php echo aynix_translate('metodo.cta.button'); ?>
                    </a>
                </div>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
