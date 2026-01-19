<?php
/* Template Name: Demos Page */
get_header();
?>

<?php
$projects = [
  [
    'name' => 'Safe Fleet',
    'description_key' => 'demo.safefleet.description',
    'demo_url' => 'https://safe-fleet-fe.onrender.com/auth/login',
    'logo' => 'https://www.wecoop.org/wp-content/uploads/2025/11/safe-fleet.png',
    'pdfs' => [
      'it' => 'https://www.wecoop.org/wp-content/uploads/2025/11/PICH-DECK-SAFE-FLEET-IT.pdf',
      'es' => 'https://www.wecoop.org/wp-content/uploads/2025/11/PITCH-DECK-SAFE-FLEET-ES.pdf',
      'en' => 'https://www.wecoop.org/wp-content/uploads/2025/11/PITCH-DECK-SAFE-FLEET-ING.pdf',
    ],
    'credentials' => [
      ['role' => 'Admin', 'username' => 'BRMBYN92D21Z605C', 'password' => 'securePassword123'],
    ]
  ]
];
?>

<div class="demo-page-container">
  <h1 class="page-title"><?php echo aynix_translate('demo.page_title'); ?></h1>

  <div class="project-grid">
    <?php foreach ($projects as $project): ?>
      <div class="project-card">
        <?php if (!empty($project['logo'])): ?>
          <div class="project-logo">
            <img src="<?= esc_url($project['logo']) ?>" alt="Logo <?= esc_attr($project['name']) ?>">
          </div>
        <?php endif; ?>

        <h2><?= esc_html($project['name']) ?></h2>
        <p><?= esc_html(aynix_translate($project['description_key'])) ?></p>

        <a class="demo-link" href="<?= esc_url($project['demo_url']) ?>" target="_blank">
          🔗 <?= aynix_translate('demo.view_demo') ?>
        </a>

        <div class="pdf-buttons">
          <strong>📄 <?= aynix_translate('demo.pdf_title') ?></strong><br>
          <a class="pdf-link" href="<?= esc_url($project['pdfs']['it']) ?>" target="_blank">🇮🇹 IT</a>
          <a class="pdf-link" href="<?= esc_url($project['pdfs']['es']) ?>" target="_blank">🇪🇸 ES</a>
          <a class="pdf-link" href="<?= esc_url($project['pdfs']['en']) ?>" target="_blank">🇬🇧 EN</a>
        </div>

        <div class="credentials">
          <strong><?= aynix_translate('demo.credentials_title') ?></strong><br>
          <?php foreach ($project['credentials'] as $cred): ?>
            <div class="cred-block">
              <em><?= esc_html($cred['role']) ?></em><br>
              <?= aynix_translate('demo.username_label') ?> <?= esc_html($cred['username']) ?><br>
              <?= aynix_translate('demo.password_label') ?> <?= esc_html($cred['password']) ?><br><br>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<style>
.demo-page-container {
  max-width: 1100px;
  margin: auto;
  padding: 50px 20px;
  font-family: 'Segoe UI', sans-serif;
  color: #222;
}
.page-title {
  text-align: center;
  font-size: 2.5em;
  margin-bottom: 50px;
  color: #0073aa;
}
.project-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 30px;
}
.project-card {
  background: #ffffff;
  border: 1px solid #e0e0e0;
  padding: 25px;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.05);
  transition: transform 0.2s ease;
}
.project-card:hover {
  transform: translateY(-5px);
}
.project-logo {
  text-align: center;
  margin-bottom: 20px;
}
.project-logo img {
  max-width: 200px;
  height: auto;
}
.project-card h2 {
  font-size: 1.5em;
  margin: 0 0 10px;
  color: #333;
}
.project-card p {
  font-size: 1em;
  line-height: 1.5;
  color: #444;
}
.demo-link,
.pdf-link {
  display: inline-block;
  margin: 8px 6px 0 0;
  padding: 8px 14px;
  background-color: #0073aa;
  color: #fff;
  text-decoration: none;
  border-radius: 6px;
  font-size: 0.9em;
  transition: background-color 0.3s ease;
}
.demo-link:hover,
.pdf-link:hover {
  background-color: #005a8c;
}
.pdf-buttons {
  margin-top: 15px;
  font-size: 0.95em;
}
.credentials {
  margin-top: 20px;
  font-size: 0.95em;
  background: #f8f8f8;
  padding: 15px;
  border-radius: 8px;
  border: 1px dashed #ccc;
}
.cred-block {
  margin-bottom: 12px;
  color: #555;
}
.cred-block em {
  font-weight: bold;
  color: #333;
}
</style>

<?php get_footer(); ?>
