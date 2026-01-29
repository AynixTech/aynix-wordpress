<?php
/**
 * Template Name: Grazie Contatto
 * Description: Thank you page dopo richiesta contatto
 */
get_header();
?>

<main>
    <div class="page-layout thankyou-contact-page">
        <section class="thankyou-hero">
            <div class="container">
                <div class="thankyou-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h1>✅ Richiesta Inviata con Successo</h1>
                <p class="thankyou-subtitle">Ti contatteremo entro 24-48 ore per fissare la call</p>
            </div>
        </section>

        <div class="container">
            <section class="thankyou-next-steps">
                <h2>📞 Cosa succede ora</h2>
                <div class="steps-grid">
                    <div class="step-item">
                        <div class="step-icon">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <h3>1. Conferma Email</h3>
                        <p>Riceverai un'email di conferma</p>
                    </div>
                    <div class="step-item">
                        <div class="step-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3>2. Ti Contattiamo</h3>
                        <p>Entro 24-48 ore ti chiamiamo o scriviamo</p>
                    </div>
                    <div class="step-item">
                        <div class="step-icon">
                            <i class="fas fa-video"></i>
                        </div>
                        <h3>3. Call Gratuita</h3>
                        <p>15-20 minuti per discutere il progetto</p>
                    </div>
                </div>
            </section>

            <section class="preparation-tips">
                <h2>💡 Prepara la Call</h2>
                <div class="tips-container">
                    <div class="tip-card">
                        <i class="fas fa-bullseye"></i>
                        <h3>Obiettivi</h3>
                        <p>Pensa agli obiettivi principali che vuoi raggiungere con il progetto</p>
                    </div>
                    <div class="tip-card">
                        <i class="fas fa-exclamation-triangle"></i>
                        <h3>Criticità</h3>
                        <p>Identifica i problemi operativi più urgenti da risolvere</p>
                    </div>
                    <div class="tip-card">
                        <i class="fas fa-question-circle"></i>
                        <h3>Domande</h3>
                        <p>Annota eventuali domande tecniche o di processo</p>
                    </div>
                </div>
            </section>

            <section class="thankyou-back">
                <a href="<?php echo home_url(); ?>" class="btn-secondary">
                    Torna alla Home
                </a>
            </section>
        </div>
    </div>
</main>

<style>
.thankyou-contact-page {
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

.thankyou-next-steps h2,
.preparation-tips h2 {
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

.step-item h3 {
    color: #2d3748;
    margin-bottom: 0.5rem;
    font-size: 1.2rem;
}

.step-item p {
    color: #4a5568;
    line-height: 1.6;
}

.preparation-tips {
    margin: 4rem 0;
}

.tips-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin: 2rem 0;
}

.tip-card {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s;
}

.tip-card:hover {
    transform: translateY(-5px);
}

.tip-card i {
    font-size: 2.5rem;
    color: #ff6331;
    margin-bottom: 1rem;
}

.tip-card h3 {
    color: #2d3748;
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

.tip-card p {
    color: #4a5568;
    line-height: 1.6;
}

.thankyou-back {
    margin: 3rem 0;
}

@media (max-width: 768px) {
    .thankyou-hero h1 {
        font-size: 1.8rem;
    }
    
    .steps-grid,
    .tips-container {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>
