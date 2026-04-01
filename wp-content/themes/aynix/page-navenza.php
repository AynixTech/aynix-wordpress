<?php
/**
 * Template Name: Navenza Experience
 * Description: Landing page dedicata all'esperienza Navenza
 */
get_header();
$nv_assets = get_template_directory_uri() . '/assets/images/navenza';
$nv_captcha_a = wp_rand(1, 9);
$nv_captcha_b = wp_rand(1, 9);
$nv_captcha_token = wp_hash($nv_captcha_a . '|' . $nv_captcha_b . '|sf_modal');
$nv_contact_nonce = wp_create_nonce('sf_contact_modal');
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
                    <button type="button" class="nv-cta-btn" id="nv-open-contact-modal">Contáctanos</button>
                    <small>10 min · Sin coste · Sin venta</small>
                </div>
            </div>
        </section>

        <div id="nv-contact-modal" class="nv-modal" aria-hidden="true">
            <div class="nv-modal__backdrop" data-nv-modal-close></div>
            <div class="nv-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="nv-modal-title">
                <button type="button" class="nv-modal__close" data-nv-modal-close aria-label="Cerrar modal">&times;</button>
                <h3 id="nv-modal-title">Solicita más información</h3>
                <p class="nv-modal__subtitle">Completa el formulario y te contactaremos para tu diagnóstico personalizado.</p>

                <form id="nv-contact-form" class="nv-modal__form" novalidate>
                    <input type="hidden" name="action" value="submit_contact_request">
                    <input type="hidden" name="sf_contact_nonce" value="<?php echo esc_attr($nv_contact_nonce); ?>">
                    <input type="hidden" name="sf_captcha_a" value="<?php echo esc_attr($nv_captcha_a); ?>">
                    <input type="hidden" name="sf_captcha_b" value="<?php echo esc_attr($nv_captcha_b); ?>">
                    <input type="hidden" name="sf_captcha_token" value="<?php echo esc_attr($nv_captcha_token); ?>">
                    <input type="text" name="sf_website" class="nv-honeypot" tabindex="-1" autocomplete="off">

                    <div class="nv-modal__grid">
                        <div class="nv-modal__field">
                            <label for="nv-nome">Nombre *</label>
                            <input type="text" id="nv-nome" name="nome" required>
                        </div>
                        <div class="nv-modal__field">
                            <label for="nv-cognome">Apellido *</label>
                            <input type="text" id="nv-cognome" name="cognome" required>
                        </div>
                    </div>

                    <div class="nv-modal__grid">
                        <div class="nv-modal__field">
                            <label for="nv-email">Email *</label>
                            <input type="email" id="nv-email" name="email" required>
                        </div>
                        <div class="nv-modal__field">
                            <label for="nv-telefono">Teléfono *</label>
                            <input type="text" id="nv-telefono" name="telefono" required>
                        </div>
                    </div>

                    <div class="nv-modal__field">
                        <label for="nv-azienda">Empresa</label>
                        <input type="text" id="nv-azienda" name="azienda">
                    </div>

                    <div class="nv-modal__field">
                        <label for="nv-note">Mensaje</label>
                        <textarea id="nv-note" name="note" rows="4"></textarea>
                    </div>

                    <div class="nv-modal__field nv-modal__captcha">
                        <label for="nv-captcha-answer">Verificación de seguridad (captcha)</label>
                        <div class="nv-modal__captcha-row">
                            <span class="nv-modal__captcha-question"><?php echo esc_html($nv_captcha_a . ' + ' . $nv_captcha_b . ' = ?'); ?></span>
                            <input type="number" id="nv-captcha-answer" name="sf_captcha_answer" min="0" required>
                        </div>
                    </div>

                    <div id="nv-modal-feedback" class="nv-modal__feedback" aria-live="polite"></div>

                    <button type="submit" class="nv-modal__submit">Enviar solicitud</button>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
(function($) {
    var modal = $('#nv-contact-modal');
    var form = $('#nv-contact-form');
    var openBtn = $('#nv-open-contact-modal');
    var feedback = $('#nv-modal-feedback');
    var submitBtn = form.find('button[type="submit"]');

    var messages = {
        required: 'Completa todos los campos obligatorios y resuelve el captcha.',
        invalidEmail: 'Introduce un email válido.',
        invalidCaptcha: 'Captcha incorrecto. Inténtalo de nuevo.',
        sending: 'Enviando...',
        success: 'Solicitud enviada correctamente. Te contactaremos pronto.',
        genericError: 'No se pudo enviar la solicitud. Inténtalo de nuevo.'
    };

    function openModal() {
        modal.addClass('is-open').attr('aria-hidden', 'false');
        $('body').addClass('nv-modal-open');
    }

    function closeModal() {
        modal.removeClass('is-open').attr('aria-hidden', 'true');
        $('body').removeClass('nv-modal-open');
    }

    function setFeedback(type, text) {
        feedback.removeClass('is-success is-error').addClass(type === 'success' ? 'is-success' : 'is-error').text(text);
    }

    openBtn.on('click', openModal);
    modal.on('click', '[data-nv-modal-close]', closeModal);

    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && modal.hasClass('is-open')) {
            closeModal();
        }
    });

    form.on('submit', function(e) {
        e.preventDefault();

        var nome = $.trim($('#nv-nome').val());
        var cognome = $.trim($('#nv-cognome').val());
        var email = $.trim($('#nv-email').val());
        var telefono = $.trim($('#nv-telefono').val());
        var captchaA = parseInt(form.find('input[name="sf_captcha_a"]').val(), 10);
        var captchaB = parseInt(form.find('input[name="sf_captcha_b"]').val(), 10);
        var captchaAnswer = parseInt($('#nv-captcha-answer').val(), 10);

        feedback.text('').removeClass('is-success is-error');

        if (!nome || !cognome || !email || !telefono || Number.isNaN(captchaAnswer)) {
            setFeedback('error', messages.required);
            return;
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            setFeedback('error', messages.invalidEmail);
            return;
        }

        if (captchaAnswer !== (captchaA + captchaB)) {
            setFeedback('error', messages.invalidCaptcha);
            return;
        }

        submitBtn.prop('disabled', true).text(messages.sending);

        $.ajax({
            url: <?php echo wp_json_encode(admin_url('admin-ajax.php')); ?>,
            type: 'POST',
            dataType: 'json',
            data: form.serialize(),
            success: function(response) {
                if (response && response.success) {
                    setFeedback('success', messages.success);
                    form[0].reset();
                    setTimeout(closeModal, 1200);
                } else {
                    var errorText = response && response.data && response.data.message ? response.data.message : messages.genericError;
                    setFeedback('error', errorText);
                }
            },
            error: function() {
                setFeedback('error', messages.genericError);
            },
            complete: function() {
                submitBtn.prop('disabled', false).text('Enviar solicitud');
            }
        });
    });
})(jQuery);
</script>

<?php get_footer(); ?>
