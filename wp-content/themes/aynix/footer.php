<footer>
    <div class="container">
        <div class="col-md-4">
           <div class="logo-footer">
                <a href="<?php echo home_url(); ?>">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-white.svg" alt="Aynix footer logo">
                </a>
                <p class="description"><?php echo aynix_translate('footer.site_description'); ?></p>
                <p class="company-info">
                    <?php echo aynix_translate('footer.company_name'); ?><br>
                    <?php echo aynix_translate('footer.address'); ?><br>
                    <?php echo aynix_translate('footer.postal_code'); ?><br>
                    <?php echo aynix_translate('footer.vat'); ?><br>
                    <a href="mailto:info@aynix.tech" style="color: #fff; text-decoration: none;">info@aynix.tech</a>
                </p>
            </div>

            

            <select id="languageSwitcher" class="language-select" onchange="changeLanguage(this.value)">
                <option value="en">🇬🇧 EN</option>
                <option value="it">🇮🇹 IT</option>
                <option value="es">🇪🇸 ES</option>
                <option value="pt">🇵🇹 PT</option>
            </select>


            <script>
    function normalizeLang(lang) {
        if (!lang) return 'it';
        var normalized = String(lang).toLowerCase();
        if (normalized.indexOf('-') !== -1) normalized = normalized.split('-')[0];
        if (normalized.indexOf('_') !== -1) normalized = normalized.split('_')[0];
        if (normalized.length > 2) normalized = normalized.slice(0, 2);
        return ['it', 'en', 'es', 'pt'].indexOf(normalized) !== -1 ? normalized : 'it';
    }

    function getCookieValue(name) {
        var match = document.cookie.match(new RegExp('(?:^|; )' + name + '=([^;]*)'));
        return match ? decodeURIComponent(match[1]) : null;
    }

    function changeLanguage(lang) {
        var normalized = normalizeLang(lang);
        // Imposta cookie lingua per sito e chatbot (30 giorni)
        document.cookie = "site_lang=" + normalized + "; path=/; max-age=" + (60 * 60 * 24 * 30);
        document.cookie = "aynix_lang=" + normalized + "; path=/; max-age=" + (60 * 60 * 24 * 30);
        
        // Ricarica la pagina per applicare la lingua
        location.reload();
    }

    // Imposta la lingua iniziale del selettore senza forzare EN
    document.addEventListener('DOMContentLoaded', function() {
        var cookieLang = normalizeLang(getCookieValue('site_lang') || getCookieValue('aynix_lang'));
        var htmlLang = normalizeLang(document.documentElement.lang);
        var initialLang = cookieLang || htmlLang || 'it';
        document.getElementById('languageSwitcher').value = initialLang;
    });
</script>


        </div>
        <div class="col-md-4">
            <h5><?php echo aynix_translate('footer.navigation'); ?></h5>
            <ul>
                <li><a href="<?php echo home_url('/'); ?>"><?php echo aynix_translate('nav.home'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/metodo')); ?>"><?php echo aynix_translate('nav.metodo'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/problemi')); ?>"><?php echo aynix_translate('nav.problemi'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/soluzioni')); ?>"><?php echo aynix_translate('nav.soluzioni'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/esperienza')); ?>"><?php echo aynix_translate('nav.esperienza'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/chi-siamo')); ?>"><?php echo aynix_translate('nav.chi_siamo'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/contattaci')); ?>"><?php echo aynix_translate('nav.contattaci'); ?></a></li>
            </ul>
            <div class="footer-cta" style="margin-top: 20px;">
                <a href="<?php echo esc_url(home_url('/diagnosi')); ?>" class="btn-primary" style="display: inline-block; padding: 12px 24px; border-radius: 8px;">
                    <?php echo aynix_translate('cta.avvia_diagnosi'); ?>
                </a>
            </div>
        </div>
        <div class="col-md-4 social-icons">
    <h5><?php echo aynix_translate('follow_us'); ?></h5>
    <ul>
    <li><a href="https://www.facebook.com/profile.php?id=61576837830464" class="facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
    <li><a href="https://x.com/Aynixtech" class="twitter"><i class="fa-brands fa-twitter"></i></a></li>
    <li><a href="https://www.instagram.com/aynix.tech/" class="instagram"><i class="fa-brands fa-instagram"></i></a></li>
    <li><a href="https://www.linkedin.com/company/aynix/posts/?feedView=all" class="linkedin"><i class="fa-brands fa-linkedin-in"></i></a></li>
</ul>

</div>

    </div>
    <div class="text-center">
        <p>&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?> - <?php echo aynix_translate('footer.all_rights_reserved'); ?>.</p>
    </div>
    <?php wp_footer(); ?>
</footer>
<div id="page-loader">
    <div class="loader"></div>
</div>

