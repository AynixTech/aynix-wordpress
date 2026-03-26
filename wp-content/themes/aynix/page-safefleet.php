<?php
/**
 * Template Name: SafeFleet Experience
 * Description: Pagina dedicata all'esperienza SafeFleet
 */
get_header();
$sf_assets = get_template_directory_uri() . '/assets/images/safefleet';
?>

<main>
    <div id="sf-product-page" class="page-layout safefleet-page">
        <section class="sf-hero">
            <div class="sf-hero-overlay"></div>
            <div class="container sf-hero-inner">
                <div class="sf-hero-card">
                    <h1><span>Safe</span>Fleet</h1>
                    <p>Safe Fleet es una plataforma modular para la gestion integrada de flotas y recursos humanos. Cada modulo puede activarse por separado, garantizando flexibilidad, eficiencia y escalabilidad.</p>
                </div>
            </div>
            <div class="sf-hero-wave">
                <div class="container sf-hero-claim">
                    <div class="sf-hero-claim-icon">
                        <img src="<?php echo esc_url($sf_assets . '/icon-position.webp'); ?>" alt="Icono flota inteligente">
                    </div>
                    <p>La gestion de tu flota, mas inteligente.</p>
                </div>
            </div>
        </section>

        <section class="sf-how">
            <div class="sf-split sf-split-light">
                <div class="sf-col sf-col-content">
                    <div class="sf-content-wrap">
                        <h2>Como funciona?</h2>
                        <p class="sf-subtitle">Safe Fleet opera como una plataforma de gestion integrada (All-in-One).</p>
                        <ul class="sf-feature-box">
                            <li><strong>Panel principal:</strong> vision general de usuarios, vehiculos y asistencias.</li>
                            <li><strong>Asistencias:</strong> control diario con graficos y filtros.</li>
                            <li><strong>Usuarios:</strong> creacion, edicion y roles del personal.</li>
                            <li><strong>Vehiculos:</strong> registro y control de flota.</li>
                            <li><strong>Calendario:</strong> planificacion mensual y anual, exportacion Excel.</li>
                        </ul>
                    </div>
                </div>
                <div class="sf-col sf-col-media sf-dark-panel">
                    <p class="sf-media-caption">Safe<span>Fleet</span></p>
                    <img src="<?php echo esc_url($sf_assets . '/image-middle.jpeg'); ?>" alt="Panel de SafeFleet">
                </div>
            </div>
        </section>

        <section class="sf-problems">
            <div class="sf-split sf-split-dark">
                <div class="sf-col sf-col-media">
                    <img src="<?php echo esc_url($sf_assets . '/safefleet-screenshot-4.png'); ?>" alt="Problemas operativos de flota">
                </div>
                <div class="sf-col sf-col-content">
                    <div class="sf-content-wrap">
                        <h2>Que problemas resuelve?</h2>
                        <p class="sf-subtitle">Conductores y administradores pierden tiempo con papeleo y comunicaciones ineficientes.</p>
                        <div class="sf-problem-grid">
                            <article class="sf-problem-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-position.webp'); ?>" alt="Icono trazabilidad">
                                <h3>Escasa <span>trazabilidad</span> de la flota</h3>
                            </article>
                            <article class="sf-problem-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-problems.webp'); ?>" alt="Icono asistencias y permisos">
                                <h3>Control manual de <span>asistencias y permisos</span></h3>
                            </article>
                            <article class="sf-problem-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-expired.webp'); ?>" alt="Icono documentos vencidos">
                                <h3><span>Documentos vencidos</span>: multas y bloqueos</h3>
                            </article>
                            <article class="sf-problem-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-lento.webp'); ?>" alt="Icono soporte administrativo lento">
                                <h3><span>Soporte</span> administrativo lento</h3>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="sf-solution">
            <div class="sf-split sf-split-light">
                <div class="sf-col sf-col-content">
                    <div class="sf-content-wrap">
                        <h2>Solucion</h2>
                        <p class="sf-subtitle">(introduccion a los modulos)</p>
                        <div class="sf-module-grid">
                            <article class="sf-module-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-folders.webp'); ?>" alt="Icono modulo documentos">
                                <h3><span>Modulo 1</span> - Gestion proactiva de documentos</h3>
                            </article>
                            <article class="sf-module-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-support.webp'); ?>" alt="Icono modulo asistencias">
                                <h3><span>Modulo 2</span> - Asistencias digitales</h3>
                            </article>
                            <article class="sf-module-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-timecarmoney.webp'); ?>" alt="Icono modulo inventario">
                                <h3><span>Modulo 3</span> - Inventario Digital de la Flota</h3>
                            </article>
                            <article class="sf-module-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-chatai.webp'); ?>" alt="Icono modulo asistente IA">
                                <h3><span>Modulo 4</span> - Asistente IA (Chatbot)</h3>
                            </article>
                        </div>
                    </div>
                </div>
                <div class="sf-col sf-col-media">
                    <img src="<?php echo esc_url($sf_assets . '/imagen-bottom.png'); ?>" alt="Oficina de control de flota">
                </div>
            </div>
        </section>

        <section class="sf-cta">
            <div class="container">
                <div class="sf-cta-box">
                    <h2>Solicita tu diagnostico personalizado</h2>
                    <p>Analizamos tu operacion y disenamos una solucion tecnologica adaptada a las necesidades reales de tu empresa.</p>
                    <a href="<?php echo esc_url(aynix_get_translated_url('diagnosi')); ?>" class="sf-cta-btn">Iniciar Diagnostico</a>
                    <small>10 min · Sin coste · Sin venta</small>
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
