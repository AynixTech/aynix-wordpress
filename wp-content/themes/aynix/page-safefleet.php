<?php
/**
 * Template Name: SafeFleet Experience
 * Description: Pagina dedicata all'esperienza SafeFleet
 */
get_header();
?>

<main>
    <div id="sf-product-page" class="page-layout safefleet-page">
        <!-- Hero Section -->
        <section class="safefleet-hero">
            <div class="container">
                <div class="hero-content">
                    <div class="safefleet-logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/safefleet/safefleet-logo.png" alt="SafeFleet">
                    </div>
                    <h1>SafeFleet</h1>
                    <p class="hero-subtitle">Safe Fleet es una plataforma modular para la gestión integrada de flotas y recursos humanos. Cada módulo puede activarse por separado, garantizando flexibilidad, eficiencia y escalabilidad.</p>
                    <div class="hero-tags">
                        <span class="tag">Panel principal</span>
                        <span class="tag">Asistencias</span>
                        <span class="tag">Usuarios</span>
                        <span class="tag">Vehículos</span>
                        <span class="tag">Calendario</span>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <!-- Overview Section -->
            <section class="safefleet-overview">
                <h2>¿Cómo funciona?</h2>
                <p class="lead-text">Safe Fleet opera como una plataforma de gestión integrada (All-in-One).</p>
            </section>

            <!-- Problem Section -->
            <section class="safefleet-section">
                <div class="section-content">
                    <div class="section-icon problema-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h2>¿Qué problemas resuelve?</h2>
                    <p>Conductores y administradores pierden tiempo con papeleo y comunicaciones ineficientes.</p>
                    <ul class="feature-list">
                        <li>Escasa trazabilidad de la flota.</li>
                        <li>Control manual de asistencias y permisos.</li>
                        <li>Documentos vencidos: multas y bloqueos.</li>
                        <li>Soporte administrativo lento.</li>
                    </ul>
                </div>
            </section>

            <!-- Solution Section -->
            <section class="safefleet-section safefleet-solution">
                <div class="section-content">
                    <div class="section-icon soluzione-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h2>Solución</h2>
                    <p>Una introducción modular que conecta operación diaria, control documental y automatización para flotas de cualquier tamaño.</p>
                </div>
            </section>

            <!-- Features Grid -->
            <section class="safefleet-features">
                <h2>Módulos principales</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <h3>Módulo 1</h3>
                        <p>Gestión proactiva de documentos.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h3>Módulo 2</h3>
                        <p>Asistencias digitales con filtros y métricas.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-life-ring"></i>
                        </div>
                        <h3>Módulo 3</h3>
                        <p>Inventario digital de la flota y control operativo.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h3>Módulo 4</h3>
                        <p>Asistente IA (chatbot) para respuestas y seguimiento.</p>
                    </div>
                </div>
            </section>

            <!-- Screenshots Section -->
            <section class="safefleet-screenshots">
                <h2>Visión de la plataforma</h2>
                <div class="screenshots-grid">
                    <div class="screenshot-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/safefleet/safefleet-screenshot-1.png" alt="SafeFleet Dashboard">
                        <p>Panel principal: usuarios, vehículos y asistencias.</p>
                    </div>
                    <div class="screenshot-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/safefleet/safefleet-screenshot-2.png" alt="SafeFleet Driver Management">
                        <p>Asistencias digitales y control diario.</p>
                    </div>
                    <div class="screenshot-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/safefleet/safefleet-screenshot-3.png" alt="SafeFleet Tire Management">
                        <p>Gestión documental y vencimientos en tiempo real.</p>
                    </div>
                    <div class="screenshot-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/safefleet/safefleet-screenshot-4.png" alt="SafeFleet Vehicle Control">
                        <p>Inventario de flota y seguimiento inteligente.</p>
                    </div>
                </div>
            </section>

            <!-- Results Section -->
            <section class="safefleet-results">
                <h2>La gestión de tu flota, más inteligente</h2>
                <div class="results-grid">
                    <div class="result-card">
                        <div class="result-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3>Visibilidad completa</h3>
                        <p>Datos centralizados para decisiones rápidas.</p>
                    </div>
                    <div class="result-card">
                        <div class="result-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Procesos ordenados</h3>
                        <p>Menos tareas manuales y más control operativo.</p>
                    </div>
                    <div class="result-card">
                        <div class="result-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <h3>Automatización real</h3>
                        <p>Alertas, seguimiento y trazabilidad en un solo flujo.</p>
                    </div>
                    <div class="result-card">
                        <div class="result-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Ahorro de tiempo</h3>
                        <p>Más foco en operación y menos fricción administrativa.</p>
                    </div>
                </div>
            </section>

            <!-- CTA Demo -->
            <section class="safefleet-cta">
                <div class="cta-box">
                    <h2>Solicita tu diagnóstico personalizado</h2>
                    <p>Analizamos tu operación y diseñamos una solución tecnológica adaptada a las necesidades reales de tu empresa.</p>
                    <a href="<?php echo esc_url(aynix_get_translated_url('diagnosi')); ?>" class="btn-primary btn-large">
                        Iniciar Diagnóstico
                    </a>
                </div>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
