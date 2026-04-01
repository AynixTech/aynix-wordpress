<?php
/**
 * Template Name: SafeFleet Experience
 * Description: Pagina dedicata all'esperienza SafeFleet
 */
get_header();
$sf_assets = get_template_directory_uri() . '/assets/images/safefleet';
$sf_captcha_a = wp_rand(1, 9);
$sf_captcha_b = wp_rand(1, 9);
$sf_captcha_token = wp_hash($sf_captcha_a . '|' . $sf_captcha_b . '|sf_modal');
$sf_contact_nonce = wp_create_nonce('sf_contact_modal');
?>

<main>
    <div id="sf-product-page" class="page-layout safefleet-page">
        <section class="sf-hero">
            <div class="sf-hero-overlay"></div>
            <div class="sf-hero-inner">
                <div class="sf-hero-card">
                    <h1><span>Safe</span>Fleet</h1>
                    <p><?php echo aynix_translate('safefleet.hero.description'); ?></p>
                </div>
            </div>
            <!-- <div class="sf-hero-wave">
                <div class="sf-hero-claim">
                    <div class="sf-hero-claim-icon">
                        <img src="<?php echo esc_url($sf_assets . '/logoandslogan.png'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.smart_fleet_icon')); ?>">
                    </div>
                    <p><?php echo aynix_translate('safefleet.hero.claim'); ?></p>
                </div>
            </div> -->
        </section>

        <section class="sf-how">
            <div class="sf-split sf-split-light">
                <div class="sf-col sf-col-content">
                    <div class="sf-content-wrap">
                        <h2><?php echo aynix_translate('safefleet.how.title'); ?></h2>
                        <p class="sf-subtitle"><?php echo aynix_translate('safefleet.how.subtitle'); ?></p>
                        <ul class="sf-feature-box">
                            <li><strong><?php echo aynix_translate('safefleet.how.feature1.title'); ?></strong> <?php echo aynix_translate('safefleet.how.feature1.text'); ?></li>
                            <li><strong><?php echo aynix_translate('safefleet.how.feature2.title'); ?></strong> <?php echo aynix_translate('safefleet.how.feature2.text'); ?></li>
                            <li><strong><?php echo aynix_translate('safefleet.how.feature3.title'); ?></strong> <?php echo aynix_translate('safefleet.how.feature3.text'); ?></li>
                            <li><strong><?php echo aynix_translate('safefleet.how.feature4.title'); ?></strong> <?php echo aynix_translate('safefleet.how.feature4.text'); ?></li>
                            <li><strong><?php echo aynix_translate('safefleet.how.feature5.title'); ?></strong> <?php echo aynix_translate('safefleet.how.feature5.text'); ?></li>
                        </ul>
                    </div>
                </div>
                <div class="sf-col sf-col-media sf-dark-panel">
                    <p class="sf-media-caption">Safe<span>Fleet</span></p>
                    <img src="<?php echo esc_url($sf_assets . '/image-middle.jpeg'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.dashboard_panel')); ?>">
                </div>
            </div>
        </section>

        <section class="sf-problems">
            <div class="sf-split sf-split-dark">
                <div class="sf-col sf-col-media">
                    <img src="<?php echo esc_url($sf_assets . '/safefleet-screenshot-4.png'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.operational_problems')); ?>">
                </div>
                <div class="sf-col sf-col-content">
                    <div class="sf-content-wrap">
                        <h2><?php echo aynix_translate('safefleet.problems.title'); ?></h2>
                        <p class="sf-subtitle"><?php echo aynix_translate('safefleet.problems.subtitle'); ?></p>
                        <div class="sf-problem-grid">
                            <article class="sf-problem-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-position.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.traceability_icon')); ?>">
                                <h3><?php echo aynix_translate('safefleet.problems.item1.prefix'); ?> <span><?php echo aynix_translate('safefleet.problems.item1.highlight'); ?></span> <?php echo aynix_translate('safefleet.problems.item1.suffix'); ?></h3>
                            </article>
                            <article class="sf-problem-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-problems.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.attendance_icon')); ?>">
                                <h3><?php echo aynix_translate('safefleet.problems.item2.prefix'); ?> <span><?php echo aynix_translate('safefleet.problems.item2.highlight'); ?></span></h3>
                            </article>
                            <article class="sf-problem-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-expired.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.expired_docs_icon')); ?>">
                                <h3><span><?php echo aynix_translate('safefleet.problems.item3.highlight'); ?></span><?php echo aynix_translate('safefleet.problems.item3.suffix'); ?></h3>
                            </article>
                            <article class="sf-problem-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-lento.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.slow_support_icon')); ?>">
                                <h3><span><?php echo aynix_translate('safefleet.problems.item4.highlight'); ?></span> <?php echo aynix_translate('safefleet.problems.item4.suffix'); ?></h3>
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
                        <h2><?php echo aynix_translate('safefleet.solution.title'); ?></h2>
                        <p class="sf-subtitle"><?php echo aynix_translate('safefleet.solution.subtitle'); ?></p>
                        <div class="sf-module-grid">
                            <article class="sf-module-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-folders.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.module_docs_icon')); ?>">
                                <h3><span><?php echo aynix_translate('safefleet.solution.module1.label'); ?></span> - <?php echo aynix_translate('safefleet.solution.module1.title'); ?></h3>
                            </article>
                            <article class="sf-module-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-support.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.module_attendance_icon')); ?>">
                                <h3><span><?php echo aynix_translate('safefleet.solution.module2.label'); ?></span> - <?php echo aynix_translate('safefleet.solution.module2.title'); ?></h3>
                            </article>
                            <article class="sf-module-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-timecarmoney.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.module_inventory_icon')); ?>">
                                <h3><span><?php echo aynix_translate('safefleet.solution.module3.label'); ?></span> - <?php echo aynix_translate('safefleet.solution.module3.title'); ?></h3>
                            </article>
                            <article class="sf-module-item">
                                <img src="<?php echo esc_url($sf_assets . '/icon-chatai.webp'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.module_ai_icon')); ?>">
                                <h3><span><?php echo aynix_translate('safefleet.solution.module4.label'); ?></span> - <?php echo aynix_translate('safefleet.solution.module4.title'); ?></h3>
                            </article>
                        </div>
                    </div>
                </div>
                <div class="sf-col sf-col-media">
                    <img src="<?php echo esc_url($sf_assets . '/imagen-bottom.png'); ?>" alt="<?php echo esc_attr(aynix_translate('safefleet.alt.control_office')); ?>">
                </div>
            </div>
        </section>

        <section class="sf-cta">
            <div class="sf-cta-box">
                <h2><?php echo aynix_translate('safefleet.cta.title'); ?></h2>
                <p><?php echo aynix_translate('safefleet.cta.text'); ?></p>
                <button type="button" class="sf-cta-btn" id="sf-open-contact-modal"><?php echo aynix_translate('safefleet.cta.button'); ?></button>
                <small><?php echo aynix_translate('safefleet.cta.note'); ?></small>
            </div>
        </section>

        <div id="sf-contact-modal" class="sf-modal" aria-hidden="true">
            <div class="sf-modal__backdrop" data-sf-modal-close></div>
            <div class="sf-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="sf-modal-title">
                <button type="button" class="sf-modal__close" data-sf-modal-close aria-label="<?php echo esc_attr(aynix_translate('safefleet.modal.close')); ?>">&times;</button>
                <h3 id="sf-modal-title"><?php echo aynix_translate('safefleet.modal.title'); ?></h3>
                <p class="sf-modal__subtitle"><?php echo aynix_translate('safefleet.modal.subtitle'); ?></p>

                <form id="sf-contact-form" class="sf-modal__form" novalidate>
                    <input type="hidden" name="action" value="submit_contact_request">
                    <input type="hidden" name="contact_source" value="SafeFleet">
                    <input type="hidden" name="sf_contact_nonce" value="<?php echo esc_attr($sf_contact_nonce); ?>">
                    <input type="hidden" name="sf_captcha_a" value="<?php echo esc_attr($sf_captcha_a); ?>">
                    <input type="hidden" name="sf_captcha_b" value="<?php echo esc_attr($sf_captcha_b); ?>">
                    <input type="hidden" name="sf_captcha_token" value="<?php echo esc_attr($sf_captcha_token); ?>">
                    <input type="text" name="sf_website" class="sf-honeypot" tabindex="-1" autocomplete="off">

                    <div class="sf-modal__grid">
                        <div class="sf-modal__field">
                            <label for="sf-nome"><?php echo aynix_translate('safefleet.modal.form.nome'); ?> *</label>
                            <input type="text" id="sf-nome" name="nome" required>
                        </div>
                        <div class="sf-modal__field">
                            <label for="sf-cognome"><?php echo aynix_translate('safefleet.modal.form.cognome'); ?> *</label>
                            <input type="text" id="sf-cognome" name="cognome" required>
                        </div>
                    </div>

                    <div class="sf-modal__grid">
                        <div class="sf-modal__field">
                            <label for="sf-email"><?php echo aynix_translate('safefleet.modal.form.email'); ?> *</label>
                            <input type="email" id="sf-email" name="email" required>
                        </div>
                        <div class="sf-modal__field">
                            <label for="sf-telefono"><?php echo aynix_translate('safefleet.modal.form.telefono'); ?> *</label>
                            <input type="text" id="sf-telefono" name="telefono" required>
                        </div>
                    </div>

                    <div class="sf-modal__field">
                        <label for="sf-azienda"><?php echo aynix_translate('safefleet.modal.form.azienda'); ?></label>
                        <input type="text" id="sf-azienda" name="azienda">
                    </div>

                    <div class="sf-modal__field">
                        <label for="sf-note"><?php echo aynix_translate('safefleet.modal.form.note'); ?></label>
                        <textarea id="sf-note" name="note" rows="4"></textarea>
                    </div>

                    <div class="sf-modal__field sf-modal__captcha">
                        <label for="sf-captcha-answer"><?php echo aynix_translate('safefleet.modal.form.captcha_label'); ?></label>
                        <div class="sf-modal__captcha-row">
                            <span class="sf-modal__captcha-question"><?php echo esc_html($sf_captcha_a . ' + ' . $sf_captcha_b . ' = ?'); ?></span>
                            <input type="number" id="sf-captcha-answer" name="sf_captcha_answer" min="0" required>
                        </div>
                    </div>

                    <div id="sf-modal-feedback" class="sf-modal__feedback" aria-live="polite"></div>

                    <button type="submit" class="sf-modal__submit"><?php echo aynix_translate('safefleet.modal.form.submit'); ?></button>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
(function($) {
    var modal = $('#sf-contact-modal');
    var form = $('#sf-contact-form');
    var openBtn = $('#sf-open-contact-modal');
    var feedback = $('#sf-modal-feedback');
    var submitBtn = form.find('button[type="submit"]');

    var messages = {
        required: <?php echo wp_json_encode(aynix_translate('safefleet.modal.messages.required')); ?>,
        invalidEmail: <?php echo wp_json_encode(aynix_translate('safefleet.modal.messages.invalid_email')); ?>,
        invalidCaptcha: <?php echo wp_json_encode(aynix_translate('safefleet.modal.messages.invalid_captcha')); ?>,
        sending: <?php echo wp_json_encode(aynix_translate('safefleet.modal.messages.sending')); ?>,
        success: <?php echo wp_json_encode(aynix_translate('safefleet.modal.messages.success')); ?>,
        genericError: <?php echo wp_json_encode(aynix_translate('safefleet.modal.messages.generic_error')); ?>
    };

    function openModal() {
        modal.addClass('is-open').attr('aria-hidden', 'false');
        $('body').addClass('sf-modal-open');
    }

    function closeModal() {
        modal.removeClass('is-open').attr('aria-hidden', 'true');
        $('body').removeClass('sf-modal-open');
    }

    function setFeedback(type, text) {
        feedback.removeClass('is-success is-error').addClass(type === 'success' ? 'is-success' : 'is-error').text(text);
    }

    openBtn.on('click', openModal);
    modal.on('click', '[data-sf-modal-close]', closeModal);

    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && modal.hasClass('is-open')) {
            closeModal();
        }
    });

    form.on('submit', function(e) {
        e.preventDefault();

        var nome = $.trim($('#sf-nome').val());
        var cognome = $.trim($('#sf-cognome').val());
        var email = $.trim($('#sf-email').val());
        var telefono = $.trim($('#sf-telefono').val());
        var captchaA = parseInt(form.find('input[name="sf_captcha_a"]').val(), 10);
        var captchaB = parseInt(form.find('input[name="sf_captcha_b"]').val(), 10);
        var captchaAnswer = parseInt($('#sf-captcha-answer').val(), 10);

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
                submitBtn.prop('disabled', false).text(<?php echo wp_json_encode(aynix_translate('safefleet.modal.form.submit')); ?>);
            }
        });
    });
})(jQuery);
</script>

<?php get_footer(); ?>
