<?php
/**
 * The template for displaying comments.
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comments_count = get_comments_number();
            $title_template = $comments_count === 1
                ? aynix_translate('comments.title_singular')
                : aynix_translate('comments.title_plural');
            printf(
                esc_html($title_template),
                number_format_i18n($comments_count)
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size'=> 48,
            ));
            ?>
        </ol>

        <?php the_comments_navigation(); ?>
    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number()) : ?>
        <p class="no-comments">
            <?php echo esc_html(aynix_translate('comments.closed')); ?>
        </p>
    <?php endif; ?>

    <?php
    $required_fields_message = '<span class="required-field-message">' .
        esc_html(aynix_translate('comments.required_fields')) .
        ' <span class="required">*</span></span>';

    $logged_in_as = '';
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $profile_url = esc_url(admin_url('profile.php'));
        $logout_url = esc_url(wp_logout_url(get_permalink()));
        $logged_in_as = '<p class="logged-in-as">' .
            sprintf(
                esc_html(aynix_translate('comments.logged_in_as')),
                esc_html($user->user_email)
            ) .
            ' <a href="' . $profile_url . '">' . esc_html(aynix_translate('comments.edit_profile')) . '</a>. ' .
            '<a href="' . $logout_url . '">' . esc_html(aynix_translate('comments.logout')) . '</a> ' .
            $required_fields_message .
            '</p>';
    }

    comment_form(array(
        'title_reply'          => aynix_translate('comments.leave_reply'),
        'cancel_reply_link'    => aynix_translate('comments.cancel_reply'),
        'label_submit'         => aynix_translate('comments.submit'),
        'logged_in_as'         => $logged_in_as,
        'comment_notes_before' => is_user_logged_in() ? '' : '<p class="comment-notes">' . $required_fields_message . '</p>',
        'comment_field'        => '<p class="comment-form-comment"><label for="comment">' .
            esc_html(aynix_translate('comments.comment_label')) .
            ' <span class="required">*</span></label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>',
    ));
    ?>
</div>
