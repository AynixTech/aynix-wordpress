<?php
// Include your header and other necessary files
get_header();
?>

<main class="container">
  <div class="page-layout">
    <section class="page-header">
      <h1><?php echo aynix_translate('services.title'); ?></h1>
      <p><?php echo aynix_translate('services.description'); ?></p>
    </section>

    <div class="services-page">
      <section id="app-development" class="service-section">
        <div class="icon-container">
          <i class="fa fa-mobile-alt service-icon"></i>
        </div>
        <div class="service-text">
          <h2><?php echo aynix_translate("app_development.title"); ?></h2>
          <p><?php echo aynix_translate("app_development.description"); ?></p>
        </div>
      </section>

      <section id="process-automation" class="service-section">
        <div class="icon-container">
          <i class="fa fa-cogs service-icon"></i>
        </div>
        <div class="service-text">
          <h2><?php echo aynix_translate("process_automation.title"); ?></h2>
          <p><?php echo aynix_translate("process_automation.description"); ?></p>
        </div>
      </section>

      <section id="integrations-api" class="service-section">
        <div class="icon-container">
          <i class="fa fa-plug service-icon"></i>
        </div>
        <div class="service-text">
          <h2><?php echo aynix_translate("integrations_api.title"); ?></h2>
          <p><?php echo aynix_translate("integrations_api.description"); ?></p>
    </div>
  </section>

  <section id="technology-consulting" class="service-section">
    <div class="icon-container">
      <i class="fa fa-lightbulb service-icon"></i>
    </div>
    <div class="service-text">
      <h2><?php echo aynix_translate("technology_consulting.title"); ?></h2>
      <p><?php echo aynix_translate("technology_consulting.description"); ?></p>
    </div>
  </section>

  <section id="ai-agent-creation" class="service-section">
    <div class="icon-container">
      <i class="fa fa-robot service-icon"></i>
    </div>
    <div class="service-text">
      <h2><?php echo aynix_translate("ai_agent_creation.title"); ?></h2>
      <p><?php echo aynix_translate("ai_agent_creation.description"); ?></p>
    </div>
  </section>
</div>
</div>
</main>
<?php
// Include your footer or closing files
 get_footer();
?>
