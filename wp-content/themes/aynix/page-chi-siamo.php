<?php
/**
 * Template Name: Chi Siamo
 * Description: Pagina dedicata a chi siamo, visione e team AYNIX
 */
get_header();
?>

<main>
    <div class="page-layout chi-siamo-page">
        <!-- Hero Section -->
        <section class="hero-page">
            <div class="container">
                <h1><?php echo aynix_translate('chi_siamo.hero.title'); ?></h1>
                <p class="hero-subtitle"><?php echo aynix_translate('chi_siamo.hero.subtitle'); ?></p>
            </div>
        </section>

        <div class="container">
            <!-- Visione/Missione -->
            <section class="chi-siamo-visione">
                <div class="visione-content">
                    <h2><?php echo aynix_translate('chi_siamo.visione.title'); ?></h2>
                    <p class="lead-text"><?php echo aynix_translate('chi_siamo.visione.text'); ?></p>
                </div>
                <div class="missione-content">
                    <h2><?php echo aynix_translate('chi_siamo.missione.title'); ?></h2>
                    <p class="lead-text"><?php echo aynix_translate('chi_siamo.missione.text'); ?></p>
                </div>
            </section>

            <!-- Team -->
            <section class="chi-siamo-team">
                <h2><?php echo aynix_translate('chi_siamo.team.title'); ?></h2>
                <p class="team-intro"><?php echo aynix_translate('chi_siamo.team.intro'); ?></p>
                
                <div class="team-grid">
                    <!-- Team Member 1 -->
                    <div class="team-member">
                        <div class="member-photo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/founder1.png" alt="<?php echo aynix_translate('chi_siamo.team.member1_name'); ?>">
                        </div>
                        <div class="member-info">
                            <h3><?php echo aynix_translate('chi_siamo.team.member1_name'); ?></h3>
                            <p class="member-role"><?php echo aynix_translate('chi_siamo.team.member1_role'); ?></p>
                            <p class="member-bio"><?php echo aynix_translate('chi_siamo.team.member1_bio'); ?></p>
                        </div>
                    </div>

                    <!-- Team Member 2 -->
                    <div class="team-member">
                        <div class="member-photo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/founder2.png" alt="<?php echo aynix_translate('chi_siamo.team.member2_name'); ?>">
                        </div>
                        <div class="member-info">
                            <h3><?php echo aynix_translate('chi_siamo.team.member2_name'); ?></h3>
                            <p class="member-role"><?php echo aynix_translate('chi_siamo.team.member2_role'); ?></p>
                            <p class="member-bio"><?php echo aynix_translate('chi_siamo.team.member2_bio'); ?></p>
                        </div>
                    </div>

                    <!-- Team Member 3 -->
                    <div class="team-member">
                        <div class="member-photo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/founder3.png" alt="<?php echo aynix_translate('chi_siamo.team.member3_name'); ?>">
                        </div>
                        <div class="member-info">
                            <h3><?php echo aynix_translate('chi_siamo.team.member3_name'); ?></h3>
                            <p class="member-role"><?php echo aynix_translate('chi_siamo.team.member3_role'); ?></p>
                            <p class="member-bio"><?php echo aynix_translate('chi_siamo.team.member3_bio'); ?></p>
                        </div>
                    </div>

                    <!-- Team Member 4 -->
                    <div class="team-member">
                        <div class="member-photo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team1.png" alt="<?php echo aynix_translate('chi_siamo.team.member4_name'); ?>">
                        </div>
                        <div class="member-info">
                            <h3><?php echo aynix_translate('chi_siamo.team.member4_name'); ?></h3>
                            <p class="member-role"><?php echo aynix_translate('chi_siamo.team.member4_role'); ?></p>
                            <p class="member-bio"><?php echo aynix_translate('chi_siamo.team.member4_bio'); ?></p>
                        </div>
                    </div>

                    <!-- Team Member 5 -->
                    <div class="team-member">
                        <div class="member-photo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team2.png" alt="<?php echo aynix_translate('chi_siamo.team.member5_name'); ?>">
                        </div>
                        <div class="member-info">
                            <h3><?php echo aynix_translate('chi_siamo.team.member5_name'); ?></h3>
                            <p class="member-role"><?php echo aynix_translate('chi_siamo.team.member5_role'); ?></p>
                            <p class="member-bio"><?php echo aynix_translate('chi_siamo.team.member5_bio'); ?></p>
                        </div>
                    </div>

                    <!-- Team Member 6 -->
                    <div class="team-member">
                        <div class="member-photo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team3.png" alt="<?php echo aynix_translate('chi_siamo.team.member6_name'); ?>">
                        </div>
                        <div class="member-info">
                            <h3><?php echo aynix_translate('chi_siamo.team.member6_name'); ?></h3>
                            <p class="member-role"><?php echo aynix_translate('chi_siamo.team.member6_role'); ?></p>
                            <p class="member-bio"><?php echo aynix_translate('chi_siamo.team.member6_bio'); ?></p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Richiamo al Metodo -->
            <section class="chi-siamo-metodo">
                <div class="metodo-box">
                    <i class="fas fa-compass"></i>
                    <h2><?php echo aynix_translate('chi_siamo.metodo.title'); ?></h2>
                    <p><?php echo aynix_translate('chi_siamo.metodo.text'); ?></p>
                    <a href="<?php echo esc_url(home_url('/metodo')); ?>" class="btn-secondary">
                        <?php echo aynix_translate('chi_siamo.metodo.button'); ?>
                    </a>
                </div>
            </section>

            <!-- Valori -->
            <section class="chi-siamo-valori">
                <h2><?php echo aynix_translate('chi_siamo.valori.title'); ?></h2>
                <div class="valori-grid">
                    <div class="valore-card">
                        <i class="fas fa-user-check"></i>
                        <h3><?php echo aynix_translate('chi_siamo.valori.valore1_title'); ?></h3>
                        <p><?php echo aynix_translate('chi_siamo.valori.valore1_desc'); ?></p>
                    </div>
                    <div class="valore-card">
                        <i class="fas fa-handshake"></i>
                        <h3><?php echo aynix_translate('chi_siamo.valori.valore2_title'); ?></h3>
                        <p><?php echo aynix_translate('chi_siamo.valori.valore2_desc'); ?></p>
                    </div>
                    <div class="valore-card">
                        <i class="fas fa-lightbulb"></i>
                        <h3><?php echo aynix_translate('chi_siamo.valori.valore3_title'); ?></h3>
                        <p><?php echo aynix_translate('chi_siamo.valori.valore3_desc'); ?></p>
                    </div>
                    <div class="valore-card">
                        <i class="fas fa-chart-line"></i>
                        <h3><?php echo aynix_translate('chi_siamo.valori.valore4_title'); ?></h3>
                        <p><?php echo aynix_translate('chi_siamo.valori.valore4_desc'); ?></p>
                    </div>
                </div>
            </section>

            <!-- CTA finale -->
            <section class="chi-siamo-cta">
                <div class="cta-box">
                    <h2><?php echo aynix_translate('chi_siamo.cta.title'); ?></h2>
                    <p><?php echo aynix_translate('chi_siamo.cta.subtitle'); ?></p>
                    <a href="<?php echo esc_url(home_url('/diagnosi')); ?>" class="btn-primary btn-large">
                        <?php echo aynix_translate('chi_siamo.cta.button'); ?>
                    </a>
                </div>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
