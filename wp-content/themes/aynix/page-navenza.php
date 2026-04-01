<?php
/**
 * Template Name: Navenza Experience
 * Description: Landing page dedicata all'esperienza Navenza
 */
get_header();
$nv_assets = get_template_directory_uri() . '/assets/images/navenza';
?>

<main>
    <div id="nv-product-page" class="page-layout navenza-page">
        <section class="nv-hero" aria-label="Navenza hero">
            <div class="nv-hero-overlay"></div>
            <div class="nv-hero-inner">
                <article class="nv-hero-card">
                    <h1>Navenza</h1>
                    <p>
                        Navenza es una plataforma tecnológica desarrollada por Aynix que centraliza,
                        automatiza y optimiza la operación de empresas logísticas, forwarders y compañías
                        de transporte. Conecta el mundo físico con el digital, brindando control total,
                        trazabilidad y toma de decisiones basada en datos.
                    </p>
                </article>
            </div>
            <div class="nv-hero-wave">
                <div class="nv-hero-claim">
                    <i class="fa-solid fa-ship" aria-hidden="true"></i>
                    <p>Gestión inteligente para tus importaciones</p>
                </div>
            </div>
        </section>

        <section class="nv-problem" aria-labelledby="nv-problem-title">
            <div class="nv-container nv-problem-wrap">
                <h2 id="nv-problem-title">El Problema que resuelve Navenza?</h2>
                <p class="nv-problem-lead"><strong>Cada día se pierde información, tiempo... y clientes.</strong></p>
                <p class="nv-problem-sublead">
                    Los datos están en Excel, los clientes en libretas,
                    y la inteligencia del negocio en la cabeza de los vendedores.
                </p>

                <ul class="nv-problem-list">
                    <li>Los vendedores se van y se llevan la información.</li>
                    <li>No existe trazabilidad ni historial comercial.</li>
                    <li>Las tarifas se manejan manualmente y cambian sin control.</li>
                    <li>Documentos dispersos -> errores, retrasos y pérdida de confianza.</li>
                    <li>No hay dashboard ni KPIs para medir resultados.</li>
                </ul>
            </div>
        </section>

        <section class="nv-vision" aria-label="Nuestra vision">
            <div class="nv-vision-grid">
                <div class="nv-vision-copy">
                    <h2>Nuestra Visión:<br>Orden, Visibilidad<br>y Confianza</h2>
                    <p><strong>Un sistema que le devuelve el control de su operación.</strong></p>
                    <p>
                        Navenza centraliza clientes, cotizaciones, documentos y finanzas,
                        para que todo esté en un solo lugar, visible y bajo control.
                    </p>
                </div>
                <div class="nv-vision-media">
                    <img src="<?php echo esc_url($nv_assets . '/image-midle.png'); ?>" alt="Interfaz de Navenza en una oficina logística">
                </div>
            </div>
        </section>

        <section class="nv-ecosystem" aria-labelledby="nv-ecosystem-title">
            <div class="nv-container">
                <h2 id="nv-ecosystem-title">Ecosistema Conectado</h2>

                <div class="nv-eco-grid">
                    <article class="nv-eco-item">
                        <img src="<?php echo esc_url($nv_assets . '/icon-clients.png'); ?>" alt="Clientes">
                        <h3>Clientes</h3>
                    </article>
                    <article class="nv-eco-item">
                        <img src="<?php echo esc_url($nv_assets . '/icon-cotizacion.png'); ?>" alt="Cotizaciones">
                        <h3>Cotizaciones</h3>
                    </article>
                    <article class="nv-eco-item">
                        <img src="<?php echo esc_url($nv_assets . '/icon-documents.png'); ?>" alt="Documentos">
                        <h3>Documentos</h3>
                    </article>
                    <article class="nv-eco-item">
                        <img src="<?php echo esc_url($nv_assets . '/icon-factura.png'); ?>" alt="Facturación">
                        <h3>Facturación</h3>
                    </article>
                    <article class="nv-eco-item">
                        <img src="<?php echo esc_url($nv_assets . '/icon-dashboard.png'); ?>" alt="Dashboard">
                        <h3>Dashboard</h3>
                    </article>
                    <article class="nv-eco-item">
                        <img src="<?php echo esc_url($nv_assets . '/icon-bot.png'); ?>" alt="Bot">
                        <h3>Bot</h3>
                    </article>
                    <article class="nv-eco-item">
                        <img src="<?php echo esc_url($nv_assets . '/icon-tracking.png'); ?>" alt="Tracking">
                        <h3>Tracking</h3>
                    </article>
                </div>
            </div>
        </section>

        <section class="nv-cta" aria-label="Llamada a la accion">
            <div class="nv-container">
                <div class="nv-cta-box">
                    <h2>Solicita tu diagnóstico personalizado</h2>
                    <p>
                        Analizamos tu operación y diseñamos una solución tecnológica
                        adaptada a las necesidades reales de tu empresa.
                    </p>
                    <a class="nv-cta-btn" href="<?php echo esc_url(aynix_get_translated_url('diagnosi')); ?>">Iniciar Diagnóstico</a>
                    <small>10 min · Sin coste · Sin venta</small>
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
