<?php
/**
 * Template Name: About Aynix
 */
get_header(); ?>

<main class="container">
    <div class="page-layout">
        <section class="page-header">
            <h1><?php echo aynix_translate('about_us.title'); ?></h1>
            <p><?php echo aynix_translate('about_us.description'); ?></p>
        </section>

        <section class="section">
            <h2><?php echo aynix_translate('about_us.founders_title'); ?></h2>
            <div class="founders">
                <div class="founder-card">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/founder1.png" alt="Founder 1">
                    <h3><?php echo aynix_translate('about_us.founder1_name'); ?></h3>
                    <p><?php echo aynix_translate('about_us.founder1_desc'); ?></p>
                </div>
                <div class="founder-card">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/founder2.png" alt="Founder 2">
                    <h3><?php echo aynix_translate('about_us.founder2_name'); ?></h3>
                    <p><?php echo aynix_translate('about_us.founder2_desc'); ?></p>
                </div>
                <div class="founder-card">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/founder3.png" alt="Founder 3">
                    <h3><?php echo aynix_translate('about_us.founder3_name'); ?></h3>
                    <p><?php echo aynix_translate('about_us.founder3_desc'); ?></p>
                </div>
            </div>
        </section>

        <section class="section">
            <h2><?php echo aynix_translate('about_us.team_title'); ?></h2>
            <div class="team">
                <div class="team-card">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team1.png" alt="Team Member 1">
                    <h3><?php echo aynix_translate('about_us.team1_name'); ?></h3>
                    <p><?php echo aynix_translate('about_us.team1_desc'); ?></p>
                </div>

                 <div class="team-card">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team3.png" alt="Team Member 3">
                    <h3><?php echo aynix_translate('about_us.team3_name'); ?></h3>
                    <p><?php echo aynix_translate('about_us.team3_desc'); ?></p>
                </div>
            </div>
        </section>


        <section class="section">
            <h2><?php echo aynix_translate('about_us.vision_title'); ?></h2>
            <div class="vision-box">
                <p><?php echo aynix_translate('about_us.vision_description'); ?></p>
            </div>
        </section>

        <section class="section">
            <h2><?php echo aynix_translate('about_us.how_we_help'); ?></h2>
            <div class="founders">
                <div class="founder-card">
                    <h3><?php echo aynix_translate('about_us.training_youth'); ?></h3>
                    <p><?php echo aynix_translate('about_us.training_description'); ?></p>
                </div>
                <div class="founder-card">
                    <h3><?php echo aynix_translate('about_us.digital_innovation'); ?></h3>
                    <p><?php echo aynix_translate('about_us.innovation_description'); ?></p>
                </div>
                <div class="founder-card">
                    <h3><?php echo aynix_translate('about_us.tech_migration'); ?></h3>
                    <p><?php echo aynix_translate('about_us.migration_description'); ?></p>
                </div>
            </div>
        </section>

    </div>
</main>
<?php get_footer(); ?>