<?php
/**
 * Template Name: Thank You Diagnosi
 * Description: Pagina di ringraziamento dopo completamento diagnosi
 */
get_header();
?>

<main>
    <div class="page-layout thankyou-page">
        <section class="thankyou-hero">
            <div class="container">
                <div class="thankyou-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h1><?php echo aynix_translate('thankyou.title'); ?></h1>
                <p class="thankyou-subtitle"><?php echo aynix_translate('thankyou.text'); ?></p>
            </div>
        </section>

        <div class="container">
            <section class="thankyou-next-steps">
                <h2><?php echo aynix_translate('thankyou.next_title'); ?></h2>
                <div class="steps-grid">
                    <div class="step-item">
                        <div class="step-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <p><?php echo aynix_translate('thankyou.next_step1'); ?></p>
                    </div>
                    <div class="step-item">
                        <div class="step-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <p><?php echo aynix_translate('thankyou.next_step2'); ?></p>
                    </div>
                    <div class="step-item">
                        <div class="step-icon">
                            <i class="fas fa-route"></i>
                        </div>
                        <p><?php echo aynix_translate('thankyou.next_step3'); ?></p>
                    </div>
                </div>
            </section>

            <section class="thankyou-timeline">
                <p class="timeline-text">
                    <i class="fas fa-clock"></i>
                    <?php echo aynix_translate('thankyou.response_time'); ?>
                </p>
            </section>

            <section class="thankyou-note">
                <div class="note-box">
                    <h3><?php echo aynix_translate('thankyou.note_title'); ?></h3>
                    <p><?php echo aynix_translate('thankyou.note_text'); ?></p>
                </div>
            </section>

            <section class="thankyou-back">
                <a href="<?php echo home_url(); ?>" class="btn-secondary">
                    <?php echo aynix_translate('thankyou.back_home'); ?>
                </a>
            </section>
        </div>
    </div>
</main>

<style>
.thankyou-page {
    text-align: center;
}

.thankyou-hero {
    background: linear-gradient(135deg, #438ef9 0%, #ff6331 100%);
    color: white;
    padding: 4rem 1rem;
    margin-bottom: 3rem;
}

.thankyou-icon {
    font-size: 5rem;
    margin-bottom: 1.5rem;
    animation: scaleIn 0.5s ease-out;
}

@keyframes scaleIn {
    from {
        transform: scale(0);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.thankyou-hero h1 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    color: white;
}

.thankyou-subtitle {
    font-size: 1.2rem;
    max-width: 700px;
    margin: 0 auto;
    opacity: 0.95;
}

.thankyou-next-steps {
    margin: 3rem 0;
}

.thankyou-next-steps h2 {
    margin-bottom: 2rem;
    color: #2d3748;
}

.steps-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin: 2rem 0;
}

.step-item {
    background: #f7fafc;
    padding: 2rem;
    border-radius: 12px;
    border: 2px solid #e2e8f0;
}

.step-icon {
    font-size: 2.5rem;
    color: #438ef9;
    margin-bottom: 1rem;
}

.step-item p {
    color: #4a5568;
    line-height: 1.6;
}

.thankyou-timeline {
    background: #fff3cd;
    border-left: 4px solid #ff6331;
    padding: 1.5rem;
    margin: 3rem 0;
    border-radius: 8px;
}

.timeline-text {
    font-size: 1.1rem;
    color: #856404;
    margin: 0;
}

.timeline-text i {
    margin-right: 0.5rem;
}

.thankyou-note {
    margin: 3rem 0;
}

.note-box {
    background: #e6f3ff;
    border: 2px solid #438ef9;
    padding: 2rem;
    border-radius: 12px;
    max-width: 800px;
    margin: 0 auto;
}

.note-box h3 {
    color: #438ef9;
    margin-bottom: 1rem;
}

.note-box p {
    color: #2d3748;
    line-height: 1.7;
}

.thankyou-back {
    margin: 3rem 0;
}

.btn-secondary {
    display: inline-block;
    padding: 1rem 2rem;
    background: #e2e8f0;
    color: #2d3748;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #cbd5e0;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .thankyou-hero h1 {
        font-size: 2rem;
    }
    
    .steps-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>
