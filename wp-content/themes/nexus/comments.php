
<!-- Comments Section Begin
================================================== -->	



<!-- Please, Do not delete these lines
================================================== -->	
<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="no-comments"><?php _e('This post is password protected. Enter the password to view comments.', 'Prof'); ?></p>
	<?php
		return;
	}
	
	$commentvalue = false;
?>


<!-- Check if have Comments then Begin
================================================== -->	
<?php if ( have_comments() ) : ?>

	<?php
		$nocomment = __('No Comments Yet', 'sentient');
		$onecomment = __('1 Comment', 'sentient');
		$morecomments = __('% Comments', 'sentient');
	?>

	<header class="sep active">
		<div class="section-title">
			<h2><?php _e("Post" , "nexus"); ?> <i><?php _e("Comments" , "nexus"); ?></i></h2>
		</div>
	</header>
	<div class="comments-wrapper">
		<?php wp_list_comments('type=comment&callback=nexus_comment&avatar_size=70'); ?>
	</div>
	<div class="comments-pagination">
		<?php paginate_comments_links(); ?>
	</div>	


<?php else : /*this is displayed if there are no comments so far*/ ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<h3><?php _e("Comments are closed" , "nexus"); ?></h3>
	<?php endif; ?>

<?php endif; ?>


<!-- Check if have Comments Open then Begin
================================================== -->	
<?php if ( comments_open() ) : ?>

				
		<!-- Comment Section -->	
		<div id="respond" class="comment-respond">			
			<p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>

			<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
			<p><?php _e("You must be" , "nexus"); ?> <a href="<?php echo esc_url(wp_login_url( get_permalink() )); ?>"><?php _e("logged in" , "nexus"); ?></a> <?php _e("to post a comment." , "nexus"); ?></p>
			<?php else : ?>
			
				<div class="comment-form">
					<header>
						<div class="section-title">
							<h4><span>Post A <i>Response</i></span></h4>
						</div>
					</header>
					<form class="comment-form" id="commentform" method="post" action="<?php echo esc_url(get_option('siteurl')); ?>/wp-comments-post.php">
						<div>
							<div class="nexus-half nexus-half-left">
								<input placeholder="<?php _e("Name" , "nexus"); ?>" type="text" class="form-control input-lg" id="author" name="author" value="">
							</div>
							<div class="nexus-half nexus-half-right">
								<input placeholder="<?php _e("Email Address" , "nexus"); ?>" type="email" class="form-control input-lg" id="email" name="email" value="">
							</div>
							<div class="nexus-full">
								<textarea placeholder="<?php _e("Your Message" , "nexus"); ?>" class="form-control" id="comment" name="comment" rows="8" ></textarea>
							</div>
							<div class="nexus-full nexus-full-comment">
								<input type="submit" value="<?php _e('Post Comment', 'sentient'); ?>" id="submit" name="submit" class="btn btn-primary btn-lg btn-block">
								<?php comment_id_fields(); ?>
								<?php do_action('comment_form', $post->ID); ?>									
							</div>
						</div>
					</form>
				</div>
								
			<?php endif; ?>
			
		</div>								
		<!-- Comment Section::END -->


<?php endif; ?>


<?php if($commentvalue){comment_form(); wp_enqueue_script( 'comment-reply' );} ?>


<!-- Comments Section End
================================================== -->	

