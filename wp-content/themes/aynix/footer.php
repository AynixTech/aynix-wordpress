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
                    <a href="mailto:admin@aynix.tech" style="color: #fff; text-decoration: none;">admin@aynix.tech</a>
                </p>
            </div>

            

            <select id="languageSwitcher" class="language-select" onchange="changeLanguage(this.value)">
                <option value="en">🇬🇧 EN</option>
                <option value="it">🇮🇹 IT</option>
                <option value="es">🇪🇸 ES</option>
                <option value="pt">🇵🇹 PT</option>
            </select>


            <script>
    function changeLanguage(lang) {
        // Imposta un cookie con la lingua selezionata, che durerà per 30 giorni
        document.cookie = "site_lang=" + lang + "; path=/; max-age=" + (60 * 60 * 24 * 30);
        
        // Ricarica la pagina per applicare la lingua
        location.reload();
    }

    // Imposta la lingua iniziale del selettore, se un cookie esiste
    document.addEventListener('DOMContentLoaded', function() {
        var cookies = document.cookie.split(';');
        var lang = 'en'; // Imposta 'en' come lingua predefinita
        cookies.forEach(function(cookie) {
            if (cookie.trim().startsWith('site_lang=')) {
                lang = cookie.split('=')[1]; // Prende il valore del cookie 'site_lang'
            }
        });
        
        // Imposta la lingua iniziale nel selettore
        document.getElementById('languageSwitcher').value = lang;
    });
</script>


        </div>
        <div class="col-md-4">
            <h5>Links</h5>
            <ul>
                <li><a href="<?php echo home_url('/'); ?>"><?php echo aynix_translate('nav.home'); ?></a></li>
                <li><a href="<?php echo home_url('/about'); ?>"><?php echo aynix_translate('nav.about'); ?></a></li>
                <li><a href="<?php echo home_url('/services'); ?>"><?php echo aynix_translate('nav.services'); ?></a></li>
                <li><a href="<?php echo home_url('/contact-us'); ?>"><?php echo aynix_translate('nav.contact'); ?></a></li>
            </ul>
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

