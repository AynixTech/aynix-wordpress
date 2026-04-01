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
                    <h1><?php echo aynix_translate('navenza.hero.title'); ?></h1>
                    <p><?php echo aynix_translate('navenza.hero.description'); ?></p>
                </article>
            </div>
            <div class="nv-hero-wave">
                <div class="nv-hero-claim">
                    <i class="fa-solid fa-ship" aria-hidden="true"></i>
                    <p><?php echo aynix_translate('navenza.hero.claim'); ?></p>
                </div>
            </div>
        </section>

        <section class="nv-problem" aria-labelledby="nv-problem-title">
            <div class="nv-container nv-problem-wrap">
                <h2 id="nv-problem-title"><?php echo aynix_translate('navenza.problem.title'); ?></h2>
                <p class="nv-problem-lead"><strong><?php echo aynix_translate('navenza.problem.lead'); ?></strong></p>
                <p class="nv-problem-sublead"><?php echo aynix_translate('navenza.problem.sublead'); ?></p>

                <ul class="nv-problem-list">
                    <li><?php echo aynix_translate('navenza.problem.item1'); ?></li>
                    <li><?php echo aynix_translate('navenza.problem.item2'); ?></li>
                    <li><?php echo aynix_translate('navenza.problem.item3'); ?></li>
                    <li><?php echo aynix_translate('navenza.problem.item4'); ?></li>
                    <li><?php echo aynix_translate('navenza.problem.item5'); ?></li>
                </ul>
            </div>
        </section>

        <section class="nv-vision" aria-label="Nuestra vision">
            <div class="nv-vision-grid">
                <div class="nv-vision-copy">
                    <h2><?php echo nl2br(esc_html(aynix_translate('navenza.vision.title'))); ?></h2>
                    <p><strong><?php echo aynix_translate('navenza.vision.lead'); ?></strong></p>
                    <p><?php echo aynix_translate('navenza.vision.text'); ?></p>
                </div>
                <div class="nv-vision-media">
                    <img src="<?php echo esc_url($nv_assets . '/image-midle.png'); ?>" alt="<?php echo esc_attr(aynix_translate('navenza.alt.vision_image')); ?>">
                </div>
            </div>
        </section>

        <section class="nv-ecosystem" aria-labelledby="nv-ecosystem-title">
            <div class="nv-container">
                <h2 id="nv-ecosystem-title"><?php echo aynix_translate('navenza.ecosystem.title'); ?></h2>

                <div class="nv-eco-grid">
                    <article class="nv-eco-item">
                        <img src="<?php echo esc_url($nv_assets . '/icon-clients.png'); ?>" alt="<?php echo esc_attr(aynix_translate('navenza.ecosystem.clients')); ?>">
                        <h3><?php echo aynix_translate('navenza.ecosystem.clients'); ?></h3>
                    </article>
                    <article class="nv-eco-item">
                        <img src="<?php echo esc_url($nv_assets . '/icon-cotizacion.png'); ?>" alt="<?php echo esc_attr(aynix_translate('navenza.ecosystem.quotations')); ?>">
                        <h3><?php echo aynix_translate('navenza.ecosystem.quotations'); ?></h3>
                    </article>
                    <article class="nv-eco-item">
                        <img src="<?php echo esc_url($nv_assets . '/icon-documents.png'); ?>" alt="<?php echo esc_attr(aynix_translate('navenza.ecosystem.documents')); ?>">
                        <h3><?php echo aynix_translate('navenza.ecosystem.documents'); ?></h3>
                    </article>
                    <article class="nv-eco-item">
                        <img src="<?php echo esc_url($nv_assets . '/icon-factura.png'); ?>" alt="<?php echo esc_attr(aynix_translate('navenza.ecosystem.billing')); ?>">
                        <h3><?php echo aynix_translate('navenza.ecosystem.billing'); ?></h3>
                    </article>
                    <article class="nv-eco-item">
                        <img src="<?php echo esc_url($nv_assets . '/icon-dashboard.png'); ?>" alt="<?php echo esc_attr(aynix_translate('navenza.ecosystem.dashboard')); ?>">
                        <h3><?php echo aynix_translate('navenza.ecosystem.dashboard'); ?></h3>
                    </article>
                    <article class="nv-eco-item">
                        <img src="<?php echo esc_url($nv_assets . '/icon-bot.png'); ?>" alt="<?php echo esc_attr(aynix_translate('navenza.ecosystem.bot')); ?>">
                        <h3><?php echo aynix_translate('navenza.ecosystem.bot'); ?></h3>
                    </article>
                    <article class="nv-eco-item">
                        <img src="<?php echo esc_url($nv_assets . '/icon-tracking.png'); ?>" alt="<?php echo esc_attr(aynix_translate('navenza.ecosystem.tracking')); ?>">
                        <h3><?php echo aynix_translate('navenza.ecosystem.tracking'); ?></h3>
                    </article>
                </div>
            </div>
        </section>

        <section class="nv-cta" aria-label="Llamada a la accion">
            <div class="nv-container">
                <div class="nv-cta-box">
                    <h2><?php echo aynix_translate('navenza.cta.title'); ?></h2>
                    <p><?php echo aynix_translate('navenza.cta.text'); ?></p>
                    <button type="button" class="nv-cta-btn" id="nv-open-contact-modal"><?php echo aynix_translate('navenza.cta.button'); ?></button>
                </div>
            </div>
        </section>

        <div id="nv-contact-modal" class="nv-modal" aria-hidden="true">
            <div class="nv-modal__backdrop" data-nv-modal-close></div>
            <div class="nv-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="nv-modal-title">
                <button type="button" class="nv-modal__close" data-nv-modal-close aria-label="<?php echo esc_attr(aynix_translate('navenza.modal.close')); ?>">&times;</button>
                <h3 id="nv-modal-title"><?php echo aynix_translate('navenza.modal.title'); ?></h3>
                <p class="nv-modal__subtitle"><?php echo aynix_translate('navenza.modal.subtitle'); ?></p>

                <form id="nv-contact-form" class="nv-modal__form" novalidate>
                    <input type="hidden" name="action" value="submit_contact_request">
                    <input type="hidden" name="contact_source" value="Navenza">
                    <input type="hidden" name="sf_contact_nonce" value="<?php echo esc_attr($nv_contact_nonce); ?>">
                    <input type="hidden" name="sf_captcha_a" value="<?php echo esc_attr($nv_captcha_a); ?>">
                    <input type="hidden" name="sf_captcha_b" value="<?php echo esc_attr($nv_captcha_b); ?>">
                    <input type="hidden" name="sf_captcha_token" value="<?php echo esc_attr($nv_captcha_token); ?>">
                    <input type="text" name="sf_website" class="nv-honeypot" tabindex="-1" autocomplete="off">

                    <div class="nv-modal__grid">
                        <div class="nv-modal__field">
                            <label for="nv-nome"><?php echo aynix_translate('navenza.modal.form.nome'); ?> *</label>
                            <input type="text" id="nv-nome" name="nome" required>
                        </div>
                        <div class="nv-modal__field">
                            <label for="nv-cognome"><?php echo aynix_translate('navenza.modal.form.cognome'); ?> *</label>
                            <input type="text" id="nv-cognome" name="cognome" required>
                        </div>
                    </div>

                    <div class="nv-modal__grid">
                        <div class="nv-modal__field">
                            <label for="nv-email"><?php echo aynix_translate('navenza.modal.form.email'); ?> *</label>
                            <input type="email" id="nv-email" name="email" required>
                        </div>
                        <div class="nv-modal__field">
                            <label for="nv-telefono"><?php echo aynix_translate('navenza.modal.form.telefono'); ?> *</label>
                            <input type="text" id="nv-telefono" name="telefono" required>
                        </div>
                    </div>

                    <div class="nv-modal__field">
                        <label for="nv-azienda"><?php echo aynix_translate('navenza.modal.form.azienda'); ?></label>
                        <input type="text" id="nv-azienda" name="azienda">
                    </div>

                    <div class="nv-modal__field">
                        <label for="nv-note"><?php echo aynix_translate('navenza.modal.form.note'); ?></label>
                        <textarea id="nv-note" name="note" rows="4"></textarea>
                    </div>

                    <div class="nv-modal__field nv-modal__captcha">
                        <label for="nv-captcha-answer"><?php echo aynix_translate('navenza.modal.form.captcha_label'); ?></label>
                        <div class="nv-modal__captcha-row">
                            <span class="nv-modal__captcha-question"><?php echo esc_html($nv_captcha_a . ' + ' . $nv_captcha_b . ' = ?'); ?></span>
                            <input type="number" id="nv-captcha-answer" name="sf_captcha_answer" min="0" required>
                        </div>
                    </div>

                    <div id="nv-modal-feedback" class="nv-modal__feedback" aria-live="polite"></div>

                    <button type="submit" class="nv-modal__submit"><?php echo aynix_translate('navenza.modal.form.submit'); ?></button>
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
        required: <?php echo wp_json_encode(aynix_translate('navenza.modal.messages.required')); ?>,
        invalidEmail: <?php echo wp_json_encode(aynix_translate('navenza.modal.messages.invalid_email')); ?>,
        invalidCaptcha: <?php echo wp_json_encode(aynix_translate('navenza.modal.messages.invalid_captcha')); ?>,
        sending: <?php echo wp_json_encode(aynix_translate('navenza.modal.messages.sending')); ?>,
        success: <?php echo wp_json_encode(aynix_translate('navenza.modal.messages.success')); ?>,
        genericError: <?php echo wp_json_encode(aynix_translate('navenza.modal.messages.generic_error')); ?>
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
                submitBtn.prop('disabled', false).text(<?php echo wp_json_encode(aynix_translate('navenza.modal.form.submit')); ?>);
            }
        });
    });
})(jQuery);
</script>

<?php get_footer(); ?>
