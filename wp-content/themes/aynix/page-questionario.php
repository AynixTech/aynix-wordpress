<?php
/**
 * Template Name: Questionario Diagnosi
 * Description: Form questionario diagnosi AYNIX
 */
get_header();
?>

<main>
    <div class="page-layout questionario-page">
        <!-- Hero compatto -->
        <section class="questionario-hero">
            <div class="container">
                <h1><?php echo aynix_translate('questionario.title'); ?></h1>
                <p class="hero-subtitle"><?php echo aynix_translate('questionario.subtitle'); ?></p>
                <div class="diagnosi-badges">
                    <span class="badge"><i class="fas fa-clock"></i> <?php echo aynix_translate('diagnosi.badge.time'); ?></span>
                    <span class="badge"><i class="fas fa-gift"></i> <?php echo aynix_translate('diagnosi.badge.cost'); ?></span>
                    <span class="badge"><i class="fas fa-ban"></i> <?php echo aynix_translate('diagnosi.badge.no_sales'); ?></span>
                </div>
            </div>
        </section>

        <!-- Form Section -->
        <section class="questionario-main">
            <div class="container">
                <div class="cta-box">
                    <!-- Questionario Diagnosi -->
                    <div class="diagnosi-form-container" id="diagnosi-form">
                        <!-- Il questionario verrà caricato qui tramite JavaScript -->
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<style>
.questionario-page {
    background: #f7fafc;
}

.questionario-hero {
    background: linear-gradient(135deg, #438ef9 0%, #ff6331 100%);
    color: white;
    padding: 3rem 1rem 2rem;
    text-align: center;
}

.questionario-hero h1 {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: white;
}

.hero-subtitle {
    font-size: 1.1rem;
    max-width: 600px;
    margin: 0 auto 1.5rem;
    opacity: 0.95;
}

.questionario-main {
    margin: 3rem 0;
}

.questionario-main .cta-box {
    background: linear-gradient(135deg, #438ef9 0%, #ff6331 100%);
    color: white;
    padding: 3rem 2rem;
    border-radius: 20px;
    max-width: 900px;
    margin: 0 auto;
    box-shadow: 0 10px 40px rgba(67, 142, 249, 0.3);
}

@media (max-width: 768px) {
    .questionario-hero h1 {
        font-size: 1.8rem;
    }
    
    .questionario-main .cta-box {
        padding: 2rem 1rem;
    }
}
</style>

<script>
// Load diagnosis form script
document.addEventListener('DOMContentLoaded', function() {
    const script = document.createElement('script');
    script.src = '<?php echo get_template_directory_uri(); ?>/assets/js/diagnosis-form.js';
    document.body.appendChild(script);
});
</script>

<?php get_footer(); ?>
