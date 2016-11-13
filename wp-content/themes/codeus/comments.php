<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'codeus'); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<div class="post-comments-margin"></div>
<?php endif ?>

<?php if ( have_comments() ) : ?>

<h3><?php echo wp_count_comments( $post->ID )->approved; ?> <?php comment_form_title( __('COMMENTS', 'codeus'), __('Leave a Reply to %s', 'codeus' ) ); ?></h3>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

	<ol class="commentlist styled">
	<?php wp_list_comments('type=comment&callback=codeus_comment_template&avatar_size=57');?>
	</ol>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comments are closed.', 'codeus'); ?></p>

	<?php endif; ?>
<?php endif; ?>

<?php if ( comments_open() ) : ?>

<div id="respond">

<div id="cancel-comment-reply">
	<small><?php cancel_comment_reply_link() ?></small>
</div>

<?php
	$comments_args = array(
		'fields' => array(
			'author' => '<p class="first clearfix"><input type="text" name="author" id="author" value="'.esc_attr($comment_author).'" size="22" tabindex="1"'.($req ? ' aria-required="true"' : '').' /> <label for="author"><small>'.__('Name', 'codeus').($req ? __(' <b>(required)</b>', 'codeus') : '').'</small></label></p>',
			'email' => '<p class="clearfix"><input type="text" name="email" id="email" value="'.esc_attr($comment_author_email).'" size="22" tabindex="2"'.($req ? ' aria-required="true"' : '').' /> <label for="email"><small>'.__('Mail', 'codeus').($req ? __(' <b>(required)</b>', 'codeus') : '').'</small></label></p>',
			'url' => '<p class="clearfix"><input type="text" name="url" id="url" value="'.esc_attr($comment_author_url).'" size="22" tabindex="3" /><label for="url"><small>'.__('Website', 'codeus').'</small></label></p>'
		),
		'comment_notes_after' => '',
		'comment_notes_before' => '',
		'comment_field' => '<p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>',
		'must_log_in' => '<p>'.sprintf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url( get_permalink() )).'</p>',
		'logged_in_as' => '<p>'.sprintf(__('Logged in as <a href="%1$s">%2$s</a>.'), get_edit_user_link(), $user_identity).' <a href="'.wp_logout_url(get_permalink()).'" title="'.esc_attr__('Log out of this account', 'codeus').'">'.__('Log out &raquo;', 'codeus').'</a></p>',
		'label_submit' => __('Send', 'codeus'),
		'title_reply' => __('Leave a reply', 'codeus'),
		'title_reply_to' => __('Comment to %s', 'codeus'),
		'must_log_in' => sprintf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url( get_permalink() )),
	);
	comment_form($comments_args);
?>

</div>

<?php endif; // if you delete this the sky will fall on your head ?>
