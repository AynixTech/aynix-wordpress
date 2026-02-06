<?php
/**
 * Plugin Name: AYNIX Generate AI Articles
 * Description: Generates AI articles on a schedule using the configured OpenAI API key.
 * Version: 1.0.0
 * Author: AYNIX Tech
 */

if (!defined('ABSPATH')) {
    exit;
}

class AYNIX_Generate_AI_Articles {
    const OPTION_KEY = 'aynix_generate_ai_articles_settings';
    const LOG_OPTION_KEY = 'aynix_generate_ai_articles_log';
    const LOG_FILE = 'aynix-ai-articles.log';
    const CRON_HOOK = 'aynix_generate_ai_articles_cron';

    public function __construct() {
        add_action('admin_menu', array($this, 'register_menu'));
        add_action('admin_init', array($this, 'register_settings'));

        add_action(self::CRON_HOOK, array($this, 'run_generation'));
        add_action('admin_post_aynix_ai_articles_test', array($this, 'handle_test_generation'));

        add_filter('manage_posts_columns', array($this, 'add_lang_column'));
        add_action('manage_posts_custom_column', array($this, 'render_lang_column'), 10, 2);

        register_activation_hook(__FILE__, array($this, 'on_activate'));
        register_deactivation_hook(__FILE__, array($this, 'on_deactivate'));
    }

    public function register_menu() {
        add_menu_page(
            'AYNIX AI Articles',
            'AYNIX AI Articles',
            'manage_options',
            'aynix-ai-articles',
            array($this, 'render_dashboard_page'),
            'dashicons-welcome-write-blog',
            58
        );

        add_submenu_page(
            'aynix-ai-articles',
            'Articles Dashboard',
            'Dashboard',
            'manage_options',
            'aynix-ai-articles',
            array($this, 'render_dashboard_page')
        );

        add_submenu_page(
            'aynix-ai-articles',
            'Settings',
            'Settings',
            'manage_options',
            'aynix-ai-articles-settings',
            array($this, 'render_settings_page')
        );

        add_submenu_page(
            'aynix-ai-articles',
            'Debug',
            'Debug',
            'manage_options',
            'aynix-ai-articles-debug',
            array($this, 'render_debug_page')
        );
    }

    public function register_settings() {
        register_setting('aynix_generate_ai_articles', self::OPTION_KEY, array($this, 'sanitize_settings'));

        add_settings_section(
            'aynix_ai_articles_main',
            'AI Article Generation Settings',
            '__return_false',
            'aynix-ai-articles-settings'
        );

        add_settings_field(
            'articles_per_run',
            'Articles per run',
            array($this, 'field_articles_per_run'),
            'aynix-ai-articles-settings',
            'aynix_ai_articles_main'
        );

        add_settings_field(
            'frequency',
            'Frequency',
            array($this, 'field_frequency'),
            'aynix-ai-articles-settings',
            'aynix_ai_articles_main'
        );

        add_settings_field(
            'publish_time',
            'Publish time (daily)',
            array($this, 'field_publish_time'),
            'aynix-ai-articles-settings',
            'aynix_ai_articles_main'
        );

        add_settings_field(
            'languages',
            'Languages',
            array($this, 'field_languages'),
            'aynix-ai-articles-settings',
            'aynix_ai_articles_main'
        );

        add_settings_field(
            'post_status',
            'Post status',
            array($this, 'field_post_status'),
            'aynix-ai-articles-settings',
            'aynix_ai_articles_main'
        );

        add_settings_field(
            'categories',
            'Categories',
            array($this, 'field_categories'),
            'aynix-ai-articles-settings',
            'aynix_ai_articles_main'
        );

        add_settings_field(
            'categories_free_text',
            'Categories (free text)',
            array($this, 'field_categories_free_text'),
            'aynix-ai-articles-settings',
            'aynix_ai_articles_main'
        );

        add_settings_field(
            'custom_prompt',
            'Custom prompt',
            array($this, 'field_custom_prompt'),
            'aynix-ai-articles-settings',
            'aynix_ai_articles_main'
        );

        add_settings_field(
            'generate_images',
            'Generate images',
            array($this, 'field_generate_images'),
            'aynix-ai-articles-settings',
            'aynix_ai_articles_main'
        );

        add_settings_field(
            'tags',
            'Tags',
            array($this, 'field_tags'),
            'aynix-ai-articles-settings',
            'aynix_ai_articles_main'
        );

        add_settings_field(
            'tone',
            'Tone',
            array($this, 'field_tone'),
            'aynix-ai-articles-settings',
            'aynix_ai_articles_main'
        );

        add_settings_field(
            'length',
            'Length',
            array($this, 'field_length'),
            'aynix-ai-articles-settings',
            'aynix_ai_articles_main'
        );

        add_settings_field(
            'author',
            'Author',
            array($this, 'field_author'),
            'aynix-ai-articles-settings',
            'aynix_ai_articles_main'
        );
    }

    public function sanitize_settings($input) {
        $output = array();
        $output['articles_per_run'] = max(1, min(20, intval($input['articles_per_run'] ?? 1)));

        $allowed_frequencies = array('hourly', 'twicedaily', 'daily');
        $frequency = $input['frequency'] ?? 'daily';
        $output['frequency'] = in_array($frequency, $allowed_frequencies, true) ? $frequency : 'daily';

        $time = isset($input['publish_time']) ? sanitize_text_field($input['publish_time']) : '09:00';
        $output['publish_time'] = preg_match('/^([01]\d|2[0-3]):([0-5]\d)$/', $time) ? $time : '09:00';

        $allowed_languages = array('it', 'en', 'es', 'pt');
        $langs = isset($input['languages']) && is_array($input['languages']) ? $input['languages'] : array('it');
        $langs = array_values(array_intersect($allowed_languages, $langs));
        $output['languages'] = !empty($langs) ? $langs : array('it');

        $allowed_status = array('draft', 'publish');
        $status = $input['post_status'] ?? 'draft';
        $output['post_status'] = in_array($status, $allowed_status, true) ? $status : 'draft';

        $categories = isset($input['categories']) && is_array($input['categories']) ? array_map('intval', $input['categories']) : array();
        $output['categories'] = array_values(array_filter($categories));
        $output['categories_free_text'] = isset($input['categories_free_text']) ? sanitize_text_field($input['categories_free_text']) : '';

        $output['custom_prompt'] = isset($input['custom_prompt']) ? wp_kses_post($input['custom_prompt']) : '';
        $output['generate_images'] = !empty($input['generate_images']) ? 1 : 0;

        $output['tags'] = isset($input['tags']) ? sanitize_text_field($input['tags']) : '';

        $allowed_tones = array('professional', 'friendly', 'technical', 'marketing');
        $tone = $input['tone'] ?? 'professional';
        $output['tone'] = in_array($tone, $allowed_tones, true) ? $tone : 'professional';

        $allowed_lengths = array('short', 'medium', 'long');
        $length = $input['length'] ?? 'medium';
        $output['length'] = in_array($length, $allowed_lengths, true) ? $length : 'medium';

        $author = isset($input['author']) ? intval($input['author']) : 0;
        $output['author'] = $author > 0 ? $author : 0;

        $this->reschedule_event($output['frequency'], $output['publish_time']);

        return $output;
    }

    public function render_settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }
        ?>
        <div class="wrap">
            <h1>AYNIX Generate AI Articles</h1>
            <?php if (isset($_GET['aynix_ai_articles_test']) && $_GET['aynix_ai_articles_test'] === '1') : ?>
                <div class="notice notice-success is-dismissible">
                    <p>Test generation started. Check Posts for the new draft/published article.</p>
                </div>
            <?php endif; ?>
            <form method="post" action="options.php">
                <?php
                settings_fields('aynix_generate_ai_articles');
                do_settings_sections('aynix-ai-articles-settings');
                submit_button();
                ?>
            </form>
            <hr />
            <h2>Test generation</h2>
            <p>Generate one article immediately using the current settings.</p>
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <?php wp_nonce_field('aynix_ai_articles_test'); ?>
                <input type="hidden" name="action" value="aynix_ai_articles_test" />
                <?php submit_button('Generate Test Article', 'secondary', 'submit', false); ?>
            </form>
        </div>
        <?php
    }

    public function render_dashboard_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        $log = get_option(self::LOG_OPTION_KEY, array());
        $query = new WP_Query(array(
            'post_type' => 'post',
            'post_status' => array('draft', 'publish', 'pending', 'private'),
            'meta_key' => '_aynix_ai_article',
            'meta_value' => '1',
            'posts_per_page' => 50,
            'orderby' => 'date',
            'order' => 'DESC',
        ));
        ?>
        <div class="wrap">
            <h1>AYNIX AI Articles - Dashboard</h1>
            <div class="card" style="max-width: 100%; margin-bottom: 16px;">
                <h2>Generation status</h2>
                <p><strong>Last run:</strong> <?php echo !empty($log['last_run']) ? esc_html($log['last_run']) : 'Never'; ?></p>
                <p><strong>Last status:</strong> <?php echo !empty($log['last_status']) ? esc_html($log['last_status']) : 'n/a'; ?></p>
                <p><strong>Last error:</strong> <?php echo !empty($log['last_error']) ? esc_html($log['last_error']) : 'none'; ?></p>
                <p><strong>Last generated IDs:</strong> <?php echo !empty($log['last_generated']) ? esc_html(implode(', ', $log['last_generated'])) : 'none'; ?></p>
            </div>
            <p>Latest AI-generated articles (up to 50).</p>
            <table class="widefat fixed striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Language</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <tr>
                            <td>
                                <a href="<?php echo esc_url(get_edit_post_link(get_the_ID())); ?>">
                                    <?php echo esc_html(get_the_title()); ?>
                                </a>
                            </td>
                            <td><?php echo esc_html(get_post_status(get_the_ID())); ?></td>
                            <td><?php echo esc_html(get_post_meta(get_the_ID(), '_aynix_ai_lang', true)); ?></td>
                            <td><?php echo esc_html(get_the_date('Y-m-d H:i')); ?></td>
                        </tr>
                    <?php endwhile; wp_reset_postdata(); ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4">No AI articles found yet.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function render_debug_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        $log = get_option(self::LOG_OPTION_KEY, array());
        $next_run = wp_next_scheduled(self::CRON_HOOK);
        $timezone = wp_timezone();
        $next_run_local = $next_run ? wp_date('Y-m-d H:i:s', $next_run, $timezone) : 'Not scheduled';
        $history = isset($log['history']) && is_array($log['history']) ? $log['history'] : array();
        ?>
        <div class="wrap">
            <h1>AYNIX AI Articles - Debug</h1>
            <div class="card" style="max-width: 100%; margin-bottom: 16px;">
                <h2>Schedule</h2>
                <p><strong>Next run:</strong> <?php echo esc_html($next_run_local); ?></p>
                <p><strong>Timezone:</strong> <?php echo esc_html($timezone->getName()); ?></p>
            </div>

            <div class="card" style="max-width: 100%; margin-bottom: 16px;">
                <h2>Last status</h2>
                <p><strong>Last run:</strong> <?php echo !empty($log['last_run']) ? esc_html($log['last_run']) : 'Never'; ?></p>
                <p><strong>Last status:</strong> <?php echo !empty($log['last_status']) ? esc_html($log['last_status']) : 'n/a'; ?></p>
                <p><strong>Last error:</strong> <?php echo !empty($log['last_error']) ? esc_html($log['last_error']) : 'none'; ?></p>
                <p><strong>Last generated IDs:</strong> <?php echo !empty($log['last_generated']) ? esc_html(implode(', ', $log['last_generated'])) : 'none'; ?></p>
            </div>

            <h2>Recent runs</h2>
            <table class="widefat fixed striped">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($history)) : ?>
                    <?php foreach ($history as $entry) : ?>
                        <tr>
                            <td><?php echo esc_html($entry['time']); ?></td>
                            <td><?php echo esc_html($entry['status']); ?></td>
                            <td><?php echo esc_html($entry['message']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3">No history yet.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function field_articles_per_run() {
        $options = $this->get_settings();
        $value = intval($options['articles_per_run']);
        echo '<input type="number" min="1" max="20" name="' . esc_attr(self::OPTION_KEY) . '[articles_per_run]" value="' . esc_attr($value) . '" />';
    }

    public function field_frequency() {
        $options = $this->get_settings();
        $value = $options['frequency'];
        $choices = array(
            'hourly' => 'Hourly',
            'twicedaily' => 'Twice Daily',
            'daily' => 'Daily',
        );
        echo '<select name="' . esc_attr(self::OPTION_KEY) . '[frequency]">';
        foreach ($choices as $key => $label) {
            printf('<option value="%s" %s>%s</option>', esc_attr($key), selected($value, $key, false), esc_html($label));
        }
        echo '</select>';
    }

    public function field_publish_time() {
        $options = $this->get_settings();
        $value = $options['publish_time'];
        echo '<input type="time" name="' . esc_attr(self::OPTION_KEY) . '[publish_time]" value="' . esc_attr($value) . '" />';
        echo '<p class="description">Used only for Daily frequency.</p>';
    }

    public function field_languages() {
        $options = $this->get_settings();
        $selected = $options['languages'];
        $choices = array(
            'it' => 'Italiano',
            'en' => 'English',
            'es' => 'Español',
            'pt' => 'Português',
        );
        foreach ($choices as $key => $label) {
            $checked = in_array($key, $selected, true) ? 'checked' : '';
            echo '<label style="display:block; margin:4px 0;">';
            echo '<input type="checkbox" name="' . esc_attr(self::OPTION_KEY) . '[languages][]" value="' . esc_attr($key) . '" ' . $checked . ' /> ' . esc_html($label);
            echo '</label>';
        }
    }

    public function field_post_status() {
        $options = $this->get_settings();
        $value = $options['post_status'];
        echo '<select name="' . esc_attr(self::OPTION_KEY) . '[post_status]">';
        echo '<option value="draft" ' . selected($value, 'draft', false) . '>Draft</option>';
        echo '<option value="publish" ' . selected($value, 'publish', false) . '>Publish</option>';
        echo '</select>';
    }

    public function field_categories() {
        $options = $this->get_settings();
        $selected = $options['categories'];
        $categories = get_categories(array('hide_empty' => false));
        if (empty($categories)) {
            echo '<p>No categories found.</p>';
            return;
        }
        foreach ($categories as $category) {
            $checked = in_array($category->term_id, $selected, true) ? 'checked' : '';
            echo '<label style="display:block; margin:4px 0;">';
            echo '<input type="checkbox" name="' . esc_attr(self::OPTION_KEY) . '[categories][]" value="' . esc_attr($category->term_id) . '" ' . $checked . ' /> ' . esc_html($category->name);
            echo '</label>';
        }
    }

    public function field_categories_free_text() {
        $options = $this->get_settings();
        $value = $options['categories_free_text'];
        echo '<input type="text" style="width:100%;" name="' . esc_attr(self::OPTION_KEY) . '[categories_free_text]" value="' . esc_attr($value) . '" placeholder="Marketing Digitale, Sviluppo Web" />';
        echo '<p class="description">Comma-separated categories. They will be created if missing and used for assignment/prompt.</p>';
    }

    public function field_custom_prompt() {
        $options = $this->get_settings();
        $value = $options['custom_prompt'];
        echo '<textarea name="' . esc_attr(self::OPTION_KEY) . '[custom_prompt]" rows="6" style="width:100%;" placeholder="Use placeholders: {site_name}, {language}, {category}">' . esc_textarea($value) . '</textarea>';
        echo '<p class="description">Placeholders available: {site_name}, {language}, {category}. Leave empty to use default prompt.</p>';
    }

    public function field_generate_images() {
        $options = $this->get_settings();
        $checked = !empty($options['generate_images']) ? 'checked' : '';
        echo '<label><input type="checkbox" name="' . esc_attr(self::OPTION_KEY) . '[generate_images]" value="1" ' . $checked . ' /> Generate and set a featured image</label>';
    }

    public function field_tags() {
        $options = $this->get_settings();
        $value = $options['tags'];
        echo '<input type="text" style="width:100%;" name="' . esc_attr(self::OPTION_KEY) . '[tags]" value="' . esc_attr($value) . '" placeholder="tag1, tag2, tag3" />';
        echo '<p class="description">Comma-separated tags to apply to each post.</p>';
    }

    public function field_tone() {
        $options = $this->get_settings();
        $value = $options['tone'];
        $choices = array(
            'professional' => 'Professional',
            'friendly' => 'Friendly',
            'technical' => 'Technical',
            'marketing' => 'Marketing',
        );
        echo '<select name="' . esc_attr(self::OPTION_KEY) . '[tone]">';
        foreach ($choices as $key => $label) {
            printf('<option value="%s" %s>%s</option>', esc_attr($key), selected($value, $key, false), esc_html($label));
        }
        echo '</select>';
    }

    public function field_length() {
        $options = $this->get_settings();
        $value = $options['length'];
        $choices = array(
            'short' => 'Short (300-500 words)',
            'medium' => 'Medium (700-900 words)',
            'long' => 'Long (1200-1500 words)',
        );
        echo '<select name="' . esc_attr(self::OPTION_KEY) . '[length]">';
        foreach ($choices as $key => $label) {
            printf('<option value="%s" %s>%s</option>', esc_attr($key), selected($value, $key, false), esc_html($label));
        }
        echo '</select>';
    }

    public function field_author() {
        $options = $this->get_settings();
        $value = intval($options['author']);
        $users = get_users(array('capability' => array('edit_posts')));
        echo '<select name="' . esc_attr(self::OPTION_KEY) . '[author]">';
        echo '<option value="0">Default</option>';
        foreach ($users as $user) {
            printf('<option value="%d" %s>%s</option>', esc_attr($user->ID), selected($value, $user->ID, false), esc_html($user->display_name));
        }
        echo '</select>';
    }

    private function get_settings() {
        $defaults = array(
            'articles_per_run' => 1,
            'frequency' => 'daily',
            'publish_time' => '09:00',
            'languages' => array('it'),
            'post_status' => 'draft',
            'categories' => array(),
            'categories_free_text' => '',
            'custom_prompt' => '',
            'generate_images' => 0,
            'tags' => '',
            'tone' => 'professional',
            'length' => 'medium',
            'author' => 0,
        );
        $options = get_option(self::OPTION_KEY, array());
        return wp_parse_args($options, $defaults);
    }

    public function on_activate() {
        $settings = $this->get_settings();
        $this->reschedule_event($settings['frequency'], $settings['publish_time']);
    }

    public function on_deactivate() {
        $timestamp = wp_next_scheduled(self::CRON_HOOK);
        if ($timestamp) {
            wp_unschedule_event($timestamp, self::CRON_HOOK);
        }
    }

    private function reschedule_event($frequency, $publish_time = '09:00') {
        $timestamp = wp_next_scheduled(self::CRON_HOOK);
        if ($timestamp) {
            wp_unschedule_event($timestamp, self::CRON_HOOK);
        }
        if (!wp_next_scheduled(self::CRON_HOOK)) {
            $next = $this->get_next_timestamp($frequency, $publish_time);
            wp_schedule_event($next, $frequency, self::CRON_HOOK);
        }
    }

    private function get_next_timestamp($frequency, $publish_time) {
        if ($frequency !== 'daily') {
            return time() + 300;
        }

        $timezone = wp_timezone();
        $now = new DateTime('now', $timezone);
        $parts = explode(':', $publish_time);
        $hour = intval($parts[0] ?? 9);
        $minute = intval($parts[1] ?? 0);

        $next = clone $now;
        $next->setTime($hour, $minute, 0);
        if ($next <= $now) {
            $next->modify('+1 day');
        }

        return $next->getTimestamp();
    }

    public function run_generation() {
        $this->log_status('started');
        $settings = $this->get_settings();
        $langs = $settings['languages'];
        $articles_per_run = intval($settings['articles_per_run']);

        if (!defined('OPENAI_API_KEY')) {
            error_log('AYNIX AI Articles: OPENAI_API_KEY not configured');
            $this->log_error('OPENAI_API_KEY not configured');
            return;
        }

        for ($i = 0; $i < $articles_per_run; $i++) {
            foreach ($langs as $lang) {
                $this->generate_article($lang, $settings['post_status']);
            }
        }

        $this->log_status('completed');
    }

    public function handle_test_generation() {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized', 403);
        }
        check_admin_referer('aynix_ai_articles_test');

        $this->log_status('test_started');
        $settings = $this->get_settings();
        $langs = $settings['languages'];
        foreach ($langs as $lang) {
            $this->generate_article($lang, $settings['post_status']);
        }

        $this->log_status('test_completed');

        $redirect = add_query_arg('aynix_ai_articles_test', '1', admin_url('admin.php?page=aynix-ai-articles-settings'));
        wp_safe_redirect($redirect);
        exit;
    }

    private function generate_article($lang, $status) {
        $settings = $this->get_settings();
        $prompt = $this->build_prompt($lang, $settings, array($lang));
        $response = $this->call_openai($prompt, $lang, array($lang));

        if (!$response) {
            $this->log_error('OpenAI response empty');
            $this->write_log('ARTICLE_GENERATION_FAIL: empty_response lang=' . $lang);
            return;
        }

        $this->log_response_language_keys($response);
        $response = $this->unwrap_single_language_response($response, $lang);
        $title = $response['title'] ?? null;
        $content = $response['content'] ?? null;

        if (!$title || !$content) {
            error_log('AYNIX AI Articles: Missing title/content in response');
            $this->log_error('Missing title/content in response');
            $this->write_log('ARTICLE_GENERATION_FAIL: missing_title_content lang=' . $lang);
            return;
        }

        $post_id = wp_insert_post(array(
            'post_title' => wp_strip_all_tags($title),
            'post_content' => $content,
            'post_status' => $status,
            'post_type' => 'post',
            'post_category' => $this->pick_categories($settings['categories'], $settings['categories_free_text']),
            'post_author' => $settings['author'] ?: get_current_user_id(),
        ));

        if ($post_id) {
            update_post_meta($post_id, '_aynix_ai_article', '1');
            update_post_meta($post_id, '_aynix_ai_lang', $lang);
            update_post_meta($post_id, 'lang', $lang);
            $this->log_generated_post($post_id);
            $this->write_log('ARTICLE_GENERATION_SUCCESS: post_id=' . $post_id . ' lang=' . $lang);
        } else {
            $this->write_log('ARTICLE_GENERATION_FAIL: wp_insert_post_failed lang=' . $lang);
        }

        if ($post_id && !empty($settings['generate_images'])) {
            $this->attach_featured_image($post_id, $title, $lang);
        }

        if ($post_id && !empty($settings['tags'])) {
            $tags = array_map('trim', explode(',', $settings['tags']));
            $tags = array_values(array_filter($tags));
            if (!empty($tags)) {
                wp_set_post_tags($post_id, $tags, false);
            }
        }
    }

    private function build_prompt($lang, $settings, $langs) {
        $site_name = get_bloginfo('name');
        $category_label = $this->get_random_category_label($settings['categories'], $settings['categories_free_text']);

        $instructions = array(
            'it' => "Scrivi un articolo informativo per il sito {$site_name}. Rispondi in italiano.",
            'en' => "Write an informative article for {$site_name}. Respond in English.",
            'es' => "Escribe un artículo informativo para {$site_name}. Responde en español.",
            'pt' => "Escreva um artigo informativo para {$site_name}. Responda em português.",
        );

        $prompt = $instructions[$lang] ?? $instructions['it'];
        if (!empty($settings['custom_prompt'])) {
            $prompt = $settings['custom_prompt'];
        }

        $langs = is_array($langs) ? $langs : array($lang);
        $language_labels = array(
            'it' => 'Italiano',
            'en' => 'English',
            'es' => 'Español',
            'pt' => 'Português',
        );
        $requested = array();
        foreach ($langs as $code) {
            if (isset($language_labels[$code])) {
                $requested[] = $code . ' (' . $language_labels[$code] . ')';
            } else {
                $requested[] = $code;
            }
        }

        $prompt = str_replace(
            array('{site_name}', '{language}', '{category}'),
            array($site_name, $lang, $category_label ?: 'general'),
            $prompt
        );

        $tone_map = array(
            'professional' => 'professional and authoritative',
            'friendly' => 'friendly and approachable',
            'technical' => 'technical and precise',
            'marketing' => 'persuasive and marketing-oriented',
        );
        $length_map = array(
            'short' => '300-500 words',
            'medium' => '700-900 words',
            'long' => '1200-1500 words',
        );

        if ($category_label) {
            $prompt .= "\nCategory focus: {$category_label}.";
        }
        $prompt .= "\nTone: " . ($tone_map[$settings['tone']] ?? 'professional and authoritative') . ".";
        $prompt .= "\nLength: " . ($length_map[$settings['length']] ?? '700-900 words') . ".";
        $prompt .= "\nGenerate ONE article and provide it in these languages: " . implode(', ', $requested) . ".";
        $prompt .= "\nReturn a single JSON object with one key per language code. Each language value must be an object with keys \"title\" and \"content\".";

        return $prompt;
    }

    private function call_openai($prompt, $lang, $langs = array()) {
        if (!defined('OPENAI_API_KEY') || !OPENAI_API_KEY) {
            error_log('AYNIX AI Articles: OPENAI_API_KEY not configured');
            $this->log_error('OPENAI_API_KEY not configured');
            return null;
        }
        $api_key = OPENAI_API_KEY;

        $langs = is_array($langs) ? array_values(array_unique($langs)) : array();
        if (empty($langs)) {
            $langs = array($lang);
        }

        $system_prompt = "You are a professional blog writer. Respond ONLY with valid JSON and no extra text. Do not add comments or notes. Required JSON format: {\"title\":\"...\",\"content\":\"...\"}. Content should be in HTML with headings and paragraphs.";

        $body = array(
            'model' => 'gpt-4o-mini',
            'messages' => array(
                array(
                    'role' => 'system',
                    'content' => $system_prompt
                ),
                array(
                    'role' => 'user',
                    'content' => $prompt
                )
            ),
            'temperature' => 0.7,
            'max_tokens' => 800,
            'response_format' => array('type' => 'json_object'),
        );

        $response = wp_remote_post('https://api.openai.com/v1/chat/completions', array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $api_key,
                'Content-Type' => 'application/json',
            ),
            'body' => wp_json_encode($body),
            'timeout' => 30,
        ));

        if (is_wp_error($response)) {
            error_log('AYNIX AI Articles: OpenAI error ' . $response->get_error_message());
            $this->log_error('OpenAI error: ' . $response->get_error_message());
            return null;
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $request_id = wp_remote_retrieve_header($response, 'x-request-id');
        if (is_array($request_id)) {
            $request_id = reset($request_id);
        }
        $request_id = is_string($request_id) ? $request_id : '';
        $body_raw = wp_remote_retrieve_body($response);
        $this->write_log('OPENAI_HTTP_STATUS: ' . $status_code . ($request_id ? (' REQUEST_ID: ' . $request_id) : ''));
        if ($status_code < 200 || $status_code >= 300) {
            $this->write_log('OPENAI_HTTP_ERROR_BODY: ' . $this->truncate_log($body_raw));
        }

        $data = json_decode($body_raw, true);
        if (!isset($data['choices'][0]['message']['content'])) {
            error_log('AYNIX AI Articles: Invalid OpenAI response');
            $this->log_error('Invalid OpenAI response');
            $this->write_log('OPENAI_RAW_RESPONSE: ' . $this->truncate_log($body_raw));
            return null;
        }

        $raw_content = $data['choices'][0]['message']['content'];
        $raw_content = trim($raw_content);
        $raw_content = preg_replace('/^```(?:json)?\s*/i', '', $raw_content);
        $raw_content = preg_replace('/\s*```$/', '', $raw_content);
        $raw_content = wp_check_invalid_utf8($raw_content, true);
        $raw_content = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F]/u', '', $raw_content);
        $is_utf8 = function_exists('mb_check_encoding') ? mb_check_encoding($raw_content, 'UTF-8') : true;
        $this->write_log('OPENAI_CONTENT_META: len=' . strlen($raw_content) . ' utf8=' . ($is_utf8 ? 'yes' : 'no'));

        $json_flags = defined('JSON_INVALID_UTF8_SUBSTITUTE') ? JSON_INVALID_UTF8_SUBSTITUTE : 0;
        $sanitized = $this->sanitize_json_text($raw_content);
        if ($sanitized !== $raw_content) {
            $this->write_log('OPENAI_SANITIZE_CHANGED: yes');
            $this->write_log('OPENAI_SANITIZE_DELTA_LEN: ' . (strlen($sanitized) - strlen($raw_content)));
        } else {
            $this->write_log('OPENAI_SANITIZE_CHANGED: no');
        }
        $content = json_decode($sanitized, true, 512, $json_flags);
        if (is_string($content)) {
            $content = json_decode($content, true, 512, $json_flags);
        }
        if (!is_array($content)) {
            $this->write_log('OPENAI_JSON_DECODE_STAGE: primary_failed');
            if (function_exists('iconv')) {
                $converted = @iconv('UTF-8', 'UTF-8//IGNORE', $sanitized);
                if ($converted && $converted !== $raw_content) {
                    $this->write_log('OPENAI_JSON_DECODE_STAGE: iconv_attempt');
                    $content = json_decode($converted, true, 512, $json_flags);
                }
            }
        }
        if (!is_array($content)) {
            $this->write_log('OPENAI_JSON_DECODE_STAGE: iconv_failed');
            if (function_exists('utf8_encode')) {
                $converted = utf8_encode($sanitized);
                if ($converted && $converted !== $raw_content) {
                    $this->write_log('OPENAI_JSON_DECODE_STAGE: utf8_encode_attempt');
                    $content = json_decode($converted, true, 512, $json_flags);
                }
            }
        }
        if (!is_array($content)) {
            $this->write_log('OPENAI_JSON_DECODE_STAGE: utf8_encode_failed');
            $extracted = $this->extract_json_object($sanitized);
            if ($extracted) {
                $this->write_log('OPENAI_JSON_DECODE_STAGE: extracted_object_attempt');
                $content = json_decode($extracted, true, 512, $json_flags);
            }
        }

        if (!is_array($content)) {
            $this->write_log('OPENAI_JSON_DECODE_STAGE: extracted_object_failed');
            $content = $this->fallback_parse_json_like($raw_content, $langs);
            if (is_array($content)) {
                $this->write_log('OPENAI_JSON_FALLBACK: used regex parser');
            }
        }

        if (!is_array($content)) {
            $json_error = function_exists('json_last_error_msg') ? json_last_error_msg() : 'unknown json error';
            error_log('AYNIX AI Articles: Invalid JSON content - ' . $json_error);
            $this->log_error('Invalid JSON content - ' . $json_error);
            $this->write_log('RAW_OPENAI_CONTENT: ' . $this->truncate_log($raw_content));
            $this->write_log('OPENAI_JSON_ERROR: ' . $json_error);
            $this->write_log('OPENAI_JSON_BYTES: ' . bin2hex(substr($raw_content, 0, 80)));
            return null;
        }

        return $content;
    }

    private function pick_categories($categories, $free_text) {
        $ids = is_array($categories) ? $categories : array();
        $free = $this->parse_free_text_categories($free_text);
        foreach ($free as $name) {
            $term = term_exists($name, 'category');
            if (!$term) {
                $term = wp_insert_term($name, 'category');
            }
            if (is_array($term) && isset($term['term_id'])) {
                $ids[] = intval($term['term_id']);
            } elseif (is_int($term)) {
                $ids[] = $term;
            }
        }

        $ids = array_values(array_unique(array_filter($ids)));
        if (empty($ids)) {
            return array();
        }

        return array($ids[array_rand($ids)]);
    }

    private function get_random_category_label($categories, $free_text) {
        $ids = is_array($categories) ? $categories : array();
        $names = $this->parse_free_text_categories($free_text);
        if (!empty($names)) {
            return $names[array_rand($names)];
        }
        if (empty($ids)) {
            return '';
        }
        $cat_id = $ids[array_rand($ids)];
        $term = get_term($cat_id, 'category');
        return $term && !is_wp_error($term) ? $term->name : '';
    }

    private function parse_free_text_categories($free_text) {
        if (empty($free_text)) {
            return array();
        }
        $parts = array_map('trim', explode(',', $free_text));
        $parts = array_values(array_filter($parts));
        return $parts;
    }

    private function attach_featured_image($post_id, $title, $lang) {
        $image_prompt = "Create a modern, professional blog header image for: {$title}.";

        $image_result = $this->call_openai_image($image_prompt);
        if (!$image_result) {
            return;
        }

        if (is_array($image_result) && ($image_result['type'] ?? '') === 'file') {
            $tmp = $image_result['value'];
        } else {
            $image_url = is_array($image_result) ? ($image_result['value'] ?? '') : $image_result;
            $tmp = download_url($image_url);
            if (is_wp_error($tmp)) {
                error_log('AYNIX AI Articles: Failed to download image');
                return;
            }
        }

        $file_array = array(
            'name' => sanitize_file_name('ai-article-' . $post_id . '.png'),
            'tmp_name' => $tmp,
        );

        $attachment_id = media_handle_sideload($file_array, $post_id, $title);
        if (is_wp_error($attachment_id)) {
            @unlink($tmp);
            error_log('AYNIX AI Articles: Failed to sideload image');
            return;
        }

        set_post_thumbnail($post_id, $attachment_id);
    }

    private function normalize_multilang_response($response, $langs) {
        if (!is_array($response)) {
            return array();
        }

        if (isset($response['title']) || isset($response['content'])) {
            return array(
                'title' => $response['title'] ?? null,
                'content' => $response['content'] ?? null,
            );
        }

        $langs = is_array($langs) ? $langs : array();
        $language_labels = array(
            'it' => 'Italiano',
            'en' => 'English',
            'es' => 'Español',
            'pt' => 'Português',
        );

        $title = null;
        $sections = array();
        foreach ($langs as $code) {
            if (!isset($response[$code]) || !is_array($response[$code])) {
                continue;
            }
            $lang_title = $response[$code]['title'] ?? '';
            $lang_content = $response[$code]['content'] ?? '';
            if (!$title && $lang_title) {
                $title = $lang_title;
            }
            if ($lang_content) {
                $label = $language_labels[$code] ?? strtoupper($code);
                $sections[] = '<hr /><h2>' . esc_html($label) . '</h2>' . $lang_content;
            }
        }

        if (!$title || empty($sections)) {
            return array();
        }

        return array(
            'title' => $title,
            'content' => implode("\n", $sections),
        );
    }


    private function call_openai_image($prompt) {
        if (!defined('OPENAI_API_KEY') || !OPENAI_API_KEY) {
            error_log('AYNIX AI Articles: OPENAI_API_KEY not configured');
            $this->log_error('OPENAI_API_KEY not configured');
            return null;
        }
        $api_key = OPENAI_API_KEY;
        $body = array(
            'model' => 'gpt-image-1',
            'prompt' => $prompt,
            'size' => '1024x1024'
        );

        $response = wp_remote_post('https://api.openai.com/v1/images/generations', array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $api_key,
                'Content-Type' => 'application/json',
            ),
            'body' => wp_json_encode($body),
            'timeout' => 60,
        ));

        if (is_wp_error($response)) {
            error_log('AYNIX AI Articles: OpenAI image error ' . $response->get_error_message());
            $this->log_error('OpenAI image error: ' . $response->get_error_message());
            return null;
        }

        $image_body = wp_remote_retrieve_body($response);
        $image_status = wp_remote_retrieve_response_code($response);
        $this->write_log('OPENAI_IMAGE_HTTP_STATUS: ' . $image_status);
        $data = json_decode($image_body, true);
        if (isset($data['data'][0]['url'])) {
            $this->write_log('OPENAI_IMAGE_TYPE: url');
            return array('type' => 'url', 'value' => $data['data'][0]['url']);
        }

        if (isset($data['data'][0]['b64_json'])) {
            $this->write_log('OPENAI_IMAGE_TYPE: b64_json');
            $binary = base64_decode($data['data'][0]['b64_json']);
            if ($binary === false) {
                $this->write_log('OPENAI_IMAGE_B64_DECODE: failed');
                return null;
            }
            $tmp = wp_tempnam('ai-image');
            if (!$tmp) {
                $this->write_log('OPENAI_IMAGE_TMP: failed');
                return null;
            }
            file_put_contents($tmp, $binary);
            return array('type' => 'file', 'value' => $tmp);
        }

        error_log('AYNIX AI Articles: Invalid image response');
        $this->log_error('Invalid image response');
        $this->write_log('OPENAI_IMAGE_RAW_RESPONSE: ' . $this->truncate_log($image_body));
        return null;
    }

    private function log_response_language_keys($response) {
        if (!is_array($response)) {
            return;
        }
        $keys = array_keys($response);
        $this->write_log('OPENAI_RESPONSE_KEYS: ' . implode(',', $keys));
    }

    private function unwrap_single_language_response($response, $lang) {
        if (!is_array($response)) {
            return $response;
        }
        if (isset($response['title']) || isset($response['content'])) {
            return $response;
        }
        if ($lang && isset($response[$lang]) && is_array($response[$lang])) {
            $this->write_log('OPENAI_RESPONSE_UNWRAP: ' . $lang);
            return $response[$lang];
        }
        return $response;
    }

    private function log_status($status) {
        $log = get_option(self::LOG_OPTION_KEY, array());
        $log['last_status'] = $status;
        $log['last_run'] = current_time('mysql');
        $log['history'] = $this->append_history($log, $status, '');
        update_option(self::LOG_OPTION_KEY, $log, false);
        $this->write_log("STATUS: {$status}");
    }

    private function log_error($message) {
        $log = get_option(self::LOG_OPTION_KEY, array());
        $log['last_error'] = $message;
        $log['last_status'] = 'error';
        $log['last_run'] = current_time('mysql');
        $log['history'] = $this->append_history($log, 'error', $message);
        update_option(self::LOG_OPTION_KEY, $log, false);
        $this->write_log("ERROR: {$message}");
    }

    private function log_generated_post($post_id) {
        $log = get_option(self::LOG_OPTION_KEY, array());
        $generated = isset($log['last_generated']) && is_array($log['last_generated']) ? $log['last_generated'] : array();
        array_unshift($generated, $post_id);
        $generated = array_values(array_unique(array_slice($generated, 0, 20)));
        $log['last_generated'] = $generated;
        $log['last_status'] = 'generated';
        $log['last_run'] = current_time('mysql');
        $log['history'] = $this->append_history($log, 'generated', 'Post ID ' . $post_id);
        update_option(self::LOG_OPTION_KEY, $log, false);
        $this->write_log("GENERATED: Post ID {$post_id}");
    }

    private function write_log($message) {
        if (!defined('WP_CONTENT_DIR')) {
            return;
        }
        $time = current_time('mysql');
        $line = '[' . $time . '] ' . $message . "\n";
        $path = trailingslashit(WP_CONTENT_DIR) . self::LOG_FILE;
        @file_put_contents($path, $line, FILE_APPEND | LOCK_EX);
    }

    private function extract_json_object($text) {
        $start = strpos($text, '{');
        $end = strrpos($text, '}');
        if ($start === false || $end === false || $end <= $start) {
            return null;
        }
        return substr($text, $start, $end - $start + 1);
    }

    private function fallback_parse_json_like($text, $langs) {
        $langs = is_array($langs) ? $langs : array();
        $this->write_log('OPENAI_FALLBACK_LANGS: ' . implode(',', $langs));
        $multilang = $this->fallback_parse_multilang($text, $langs);
        if (is_array($multilang) && !empty($multilang)) {
            return $multilang;
        }

        $this->write_log('OPENAI_FALLBACK_MODE: single');

        if (!preg_match('/"title"\s*:\s*"((?:\\\\.|[^\"])*)"/s', $text, $title_match)) {
            return null;
        }
        if (!preg_match('/"content"\s*:\s*"((?:\\\\.|[^\"])*)"/s', $text, $content_match)) {
            return null;
        }

        $title = $this->decode_json_string($title_match[1]);
        $content = $this->decode_json_string($content_match[1]);

        if ($title === '' || $content === '') {
            return null;
        }

        return array(
            'title' => $title,
            'content' => $content,
        );
    }

    private function fallback_parse_multilang($text, $langs) {
        if (empty($langs)) {
            return null;
        }

        $result = array();
        foreach ($langs as $code) {
            $lang_key = '"' . $code . '"';
            $lang_pos = strpos($text, $lang_key);
            if ($lang_pos === false) {
                $this->write_log('OPENAI_FALLBACK_LANG_MISSING: ' . $code);
                continue;
            }

            $title = $this->extract_json_string_value($text, 'title', $lang_pos);
            $content = $this->extract_json_string_value($text, 'content', $lang_pos);
            if ($title === null || $content === null) {
                $this->write_log('OPENAI_FALLBACK_LANG_INCOMPLETE: ' . $code);
                continue;
            }

            $result[$code] = array(
                'title' => $title,
                'content' => $content,
            );
        }

        return !empty($result) ? $result : null;
    }

    private function extract_json_string_value($text, $key, $offset) {
        $key_pos = strpos($text, '"' . $key . '"', $offset);
        if ($key_pos === false) {
            $this->write_log('OPENAI_FALLBACK_KEY_MISSING: ' . $key);
            return null;
        }
        $colon_pos = strpos($text, ':', $key_pos);
        if ($colon_pos === false) {
            $this->write_log('OPENAI_FALLBACK_COLON_MISSING: ' . $key);
            return null;
        }

        $len = strlen($text);
        $i = $colon_pos + 1;
        while ($i < $len && ctype_space($text[$i])) {
            $i++;
        }
        if ($i >= $len || $text[$i] !== '"') {
            $this->write_log('OPENAI_FALLBACK_QUOTE_MISSING: ' . $key);
            return null;
        }
        $i++;

        $value = '';
        $escaped = false;
        for (; $i < $len; $i++) {
            $ch = $text[$i];
            if ($escaped) {
                $value .= $ch;
                $escaped = false;
                continue;
            }
            if ($ch === '\\') {
                $value .= $ch;
                $escaped = true;
                continue;
            }
            if ($ch === '"') {
                break;
            }
            $value .= $ch;
        }

        return $this->decode_json_string($value);
    }

    private function decode_json_string($value) {
        $decoded = json_decode('"' . $value . '"');
        if (is_string($decoded)) {
            return $decoded;
        }
        return stripslashes($value);
    }

    private function sanitize_json_text($text) {
        $result = '';
        $in_string = false;
        $escaped = false;
        $length = strlen($text);

        for ($i = 0; $i < $length; $i++) {
            $ch = $text[$i];

            if ($in_string) {
                if ($escaped) {
                    $result .= $ch;
                    $escaped = false;
                    continue;
                }
                if ($ch === '\\') {
                    $result .= $ch;
                    $escaped = true;
                    continue;
                }
                if ($ch === "\"" ) {
                    $in_string = false;
                    $result .= $ch;
                    continue;
                }
                if ($ch === "\n" || $ch === "\r" || $ch === "\t") {
                    $result .= '\\n';
                    continue;
                }
                $result .= $ch;
                continue;
            }

            if ($ch === "\"") {
                $in_string = true;
                $result .= $ch;
                continue;
            }

            if ($ch === '\\' && $i + 1 < $length) {
                $next = $text[$i + 1];
                if ($next === 'n' || $next === 'r' || $next === 't') {
                    $result .= '\\' . $next;
                    $i++;
                    continue;
                }
            }

            $result .= $ch;
        }

        return $result;
    }

    private function truncate_log($text, $limit = 2000) {
        $text = preg_replace('/\s+/', ' ', $text);
        if (strlen($text) > $limit) {
            return substr($text, 0, $limit) . '...';
        }
        return $text;
    }

    private function append_history($log, $status, $message) {
        $history = isset($log['history']) && is_array($log['history']) ? $log['history'] : array();
        array_unshift($history, array(
            'time' => current_time('mysql'),
            'status' => $status,
            'message' => $message,
        ));
        return array_slice($history, 0, 50);
    }

    public function add_lang_column($columns) {
        if (!is_admin()) {
            return $columns;
        }
        $columns['aynix_lang'] = 'Lang';
        return $columns;
    }

    public function render_lang_column($column, $post_id) {
        if ($column !== 'aynix_lang') {
            return;
        }
        $lang = get_post_meta($post_id, 'lang', true);
        if (!$lang) {
            $lang = get_post_meta($post_id, '_aynix_ai_lang', true);
        }
        echo esc_html($lang ?: '-');
    }
}

new AYNIX_Generate_AI_Articles();
