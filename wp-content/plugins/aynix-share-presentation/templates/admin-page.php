<?php
if (!defined('ABSPATH')) {
    exit;
}
/** @var array $rows */
/** @var string $notice */
/** @var string $msg */
$plugin = AYNIX_Share_Presentation::get_instance();
$default_intro_text = $plugin->get_default_intro_text();
?>
<div class="wrap aynix-sp-wrap">

    <div class="aynix-sp-header">
        <img src="<?php echo esc_url(AYNIX_SP_URL . 'assets/images/logo-aynix.png'); ?>" alt="AYNIX" class="aynix-sp-logo" />
        <h1><?php esc_html_e('Share Presentation', 'aynix-share-presentation'); ?></h1>
    </div>

    <?php if ($notice && $msg) : ?>
        <div class="notice notice-<?php echo $notice === 'error' ? 'error' : 'success'; ?> is-dismissible">
            <p><?php echo esc_html($msg); ?></p>
        </div>
    <?php endif; ?>

    <div class="aynix-sp-grid">

        <!-- Upload form -->
        <div class="aynix-sp-card">
            <h2><?php esc_html_e('Nuova presentazione', 'aynix-share-presentation'); ?></h2>
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
                <input type="hidden" name="action" value="aynix_sp_save" />
                <?php wp_nonce_field('aynix_sp_save'); ?>

                <p>
                    <label for="company_name"><strong><?php esc_html_e('Nome azienda', 'aynix-share-presentation'); ?> *</strong></label>
                    <input type="text" id="company_name" name="company_name" class="regular-text" required />
                </p>

                <p>
                    <label for="client_name"><strong><?php esc_html_e('Nome cliente (opzionale)', 'aynix-share-presentation'); ?></strong></label>
                    <input type="text" id="client_name" name="client_name" class="regular-text" placeholder="<?php esc_attr_e('es. Mario Rossi', 'aynix-share-presentation'); ?>" />
                    <span class="description"><?php esc_html_e('Mostrato nel saluto: "Hello, ...".', 'aynix-share-presentation'); ?></span>
                </p>

                <p>
                    <label for="intro_text"><strong><?php esc_html_e('Texto inicial de la presentación', 'aynix-share-presentation'); ?></strong></label>
                    <textarea id="intro_text" name="intro_text" class="large-text" rows="4"><?php echo esc_textarea($default_intro_text); ?></textarea>
                    <span class="description"><?php esc_html_e('Se muestra al inicio de la página compartida, antes de la presentación.', 'aynix-share-presentation'); ?></span>
                </p>

                <p>
                    <label for="presentation_file"><strong><?php esc_html_e('File (PDF o PPTX)', 'aynix-share-presentation'); ?> *</strong></label>
                    <input type="file" id="presentation_file" name="presentation_file" accept=".pdf,.pptx,.ppt" required />
                </p>

                <p>
                    <label for="pin"><strong><?php esc_html_e('PIN (opzionale)', 'aynix-share-presentation'); ?></strong></label>
                    <input type="text" id="pin" name="pin" class="regular-text" autocomplete="off" placeholder="<?php esc_attr_e('lascia vuoto per non usare il PIN', 'aynix-share-presentation'); ?>" />
                    <span class="description"><?php esc_html_e('Se impostato, il cliente dovrà inserirlo per vedere il file.', 'aynix-share-presentation'); ?></span>
                </p>

                <p>
                    <button type="submit" class="button button-primary button-hero"><?php esc_html_e('Carica e genera link', 'aynix-share-presentation'); ?></button>
                </p>
            </form>
        </div>

        <!-- Links list -->
        <div class="aynix-sp-card">
            <h2><?php esc_html_e('Link generati', 'aynix-share-presentation'); ?></h2>

            <?php if (empty($rows)) : ?>
                <p class="aynix-sp-empty"><?php esc_html_e('Nessuna presentazione ancora. Carica il primo file!', 'aynix-share-presentation'); ?></p>
            <?php else : ?>
                <table class="widefat striped aynix-sp-table">
                    <thead>
                        <tr>
                            <th><?php esc_html_e('Azienda', 'aynix-share-presentation'); ?></th>
                            <th><?php esc_html_e('Cliente', 'aynix-share-presentation'); ?></th>
                            <th><?php esc_html_e('File', 'aynix-share-presentation'); ?></th>
                            <th><?php esc_html_e('PIN', 'aynix-share-presentation'); ?></th>
                            <th><?php esc_html_e('Visite', 'aynix-share-presentation'); ?></th>
                            <th><?php esc_html_e('Link', 'aynix-share-presentation'); ?></th>
                            <th><?php esc_html_e('Azioni', 'aynix-share-presentation'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row) :
                            $link = $plugin->get_share_link($row->token);
                            $editor_id = 'aynix-sp-editor-' . $row->id;
                            $delete_url = wp_nonce_url(
                                add_query_arg(array('action' => 'aynix_sp_delete', 'id' => $row->id), admin_url('admin-post.php')),
                                'aynix_sp_delete_' . $row->id
                            );
                        ?>
                            <tr>
                                <td><strong><?php echo esc_html($row->company_name); ?></strong></td>
                                <td><?php echo $row->client_name ? esc_html($row->client_name) : '—'; ?></td>
                                <td><span class="aynix-sp-badge aynix-sp-badge-<?php echo esc_attr($row->file_type); ?>"><?php echo esc_html(strtoupper($row->file_type)); ?></span></td>
                                <td><?php echo $row->pin ? '🔒 ' . esc_html($row->pin) : '—'; ?></td>
                                <td><?php echo esc_html($row->views); ?></td>
                                <td>
                                    <div class="aynix-sp-link-cell">
                                        <input type="text" readonly value="<?php echo esc_url($link); ?>" class="aynix-sp-link-input" />
                                        <button type="button" class="button aynix-sp-copy" data-link="<?php echo esc_url($link); ?>"><?php esc_html_e('Copia', 'aynix-share-presentation'); ?></button>
                                    </div>
                                </td>
                                <td>
                                    <a href="<?php echo esc_url($link); ?>" target="_blank" class="button"><?php esc_html_e('Apri', 'aynix-share-presentation'); ?></a>
                                    <button type="button" class="button aynix-sp-edit-toggle" data-target="<?php echo esc_attr($editor_id); ?>" aria-expanded="false"><?php esc_html_e('Editar', 'aynix-share-presentation'); ?></button>
                                    <a href="<?php echo esc_url($delete_url); ?>" class="button aynix-sp-delete" onclick="return confirm('<?php echo esc_js(__('Eliminare questo link?', 'aynix-share-presentation')); ?>');"><?php esc_html_e('Elimina', 'aynix-share-presentation'); ?></a>
                                </td>
                            </tr>
                            <tr id="<?php echo esc_attr($editor_id); ?>" class="aynix-sp-editor-row" hidden>
                                <td colspan="7">
                                    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="aynix-sp-editor-form">
                                        <input type="hidden" name="action" value="aynix_sp_update_presentation" />
                                        <input type="hidden" name="id" value="<?php echo esc_attr($row->id); ?>" />
                                        <?php wp_nonce_field('aynix_sp_update_presentation_' . $row->id); ?>

                                        <div class="aynix-sp-editor-grid">
                                            <p>
                                                <label for="company_name_<?php echo esc_attr($row->id); ?>"><strong><?php esc_html_e('Nome azienda', 'aynix-share-presentation'); ?></strong></label>
                                                <input type="text" id="company_name_<?php echo esc_attr($row->id); ?>" name="company_name" value="<?php echo esc_attr($row->company_name); ?>" class="regular-text" required />
                                            </p>

                                            <p>
                                                <label for="client_name_<?php echo esc_attr($row->id); ?>"><strong><?php esc_html_e('Nome cliente', 'aynix-share-presentation'); ?></strong></label>
                                                <input type="text" id="client_name_<?php echo esc_attr($row->id); ?>" name="client_name" value="<?php echo esc_attr($row->client_name); ?>" class="regular-text" />
                                            </p>

                                            <p>
                                                <label for="pin_<?php echo esc_attr($row->id); ?>"><strong><?php esc_html_e('PIN', 'aynix-share-presentation'); ?></strong></label>
                                                <input type="text" id="pin_<?php echo esc_attr($row->id); ?>" name="pin" value="<?php echo esc_attr($row->pin); ?>" class="regular-text" autocomplete="off" />
                                            </p>

                                            <p class="aynix-sp-editor-full">
                                                <label for="intro_text_<?php echo esc_attr($row->id); ?>"><strong><?php esc_html_e('Texto inicial de la presentación', 'aynix-share-presentation'); ?></strong></label>
                                                <textarea id="intro_text_<?php echo esc_attr($row->id); ?>" name="intro_text" class="large-text" rows="4"><?php echo esc_textarea($row->intro_text ? $row->intro_text : $default_intro_text); ?></textarea>
                                            </p>
                                        </div>

                                        <div class="aynix-sp-editor-actions">
                                            <button type="submit" class="button button-primary"><?php esc_html_e('Guardar cambios', 'aynix-share-presentation'); ?></button>
                                            <button type="button" class="button aynix-sp-editor-cancel" data-target="<?php echo esc_attr($editor_id); ?>"><?php esc_html_e('Cancelar', 'aynix-share-presentation'); ?></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

    </div>
</div>
