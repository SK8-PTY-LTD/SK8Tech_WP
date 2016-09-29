<?php
/**
 * Template Name: Contact Page
 *
 * @package Codeus
 */

	global $post;

	$name = isset($_REQUEST['contact_form']['name']) ? esc_attr(trim($_REQUEST['contact_form']['name'])) : '';
	$email = isset($_REQUEST['contact_form']['email']) ? esc_attr(trim($_REQUEST['contact_form']['email'])) : '';
	$site = isset($_REQUEST['contact_form']['site']) ? esc_attr(trim($_REQUEST['contact_form']['site'])) : '';
	$message = isset($_REQUEST['contact_form']['message']) ? esc_attr(trim($_REQUEST['contact_form']['message'])) : '';
	$errors = '';
	if(isset($_REQUEST['contact_form']['check']) && wp_verify_nonce($_REQUEST['contact_form']['check'], plugin_basename(__FILE__))) {
		if(!$name || !is_email($email) || !$message) {
			$errors = __('Form  has required fields', 'codeus');
		}
		if(!$errors) {
			function codeus_set_html_content_type(){
				return 'text/html';
			}
			$errors = -1;
			$headers = array();
			$headers[] = __('From', 'codeus').': '.stripslashes($name).' <'.$email.'>';
			$subject = __('Contact form message', 'codeus');
			$mail_message = '<b>'.__('Name', 'codeus').':</b> '.stripslashes($name).'<br />';
			$mail_message .= '<b>'.__('Email', 'codeus').':</b> '.stripslashes($email).'<br />';
			$mail_message .= '<b>'.__('Site', 'codeus').':</b> '.stripslashes($site).'<br />';
			$mail_message .= '<b>'.__('Message', 'codeus').':</b> '.'<br />'.nl2br(stripslashes($message)).'<br />';
			add_filter( 'wp_mail_content_type', 'codeus_set_html_content_type' );
			if(!wp_mail(codeus_get_option('admin_email'), $subject, $mail_message, $headers)) { $errors = __('Sending failed.', 'codeus'); };
			remove_filter( 'wp_mail_content_type', 'codeus_set_html_content_type' );
		}
	}

	get_header();

?>

	</div><!-- wrap end -->
	<!-- wrap start --><div class="content-wrap">

		<?php if(have_posts()) : the_post(); ?>

			<div id="main">
				<div class="central-wrapper clearfix">

					<div class="panel clearfix">

						<div id="center" class="center clearfix">

							<div id="content">
								<div class="inner">
									<?php if($errors !== -1) : ?>
										<?php the_content(); ?>
										<?php wp_link_pages( array( 'before' => '<div class="pagination"><div class="page-links-title">' . __( 'Pages:', 'codeus' ) . '</div>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
									<?php endif; ?>

									<div class="contact-form">
										<?php if($errors === -1) : ?>
											<div class="success"><?php _e('Your message has been sent.', 'codeus'); ?></div>
										<?php else : ?>
											<?php if($errors != '') : ?><div class="error"><?php _e('ERROR', 'codeus'); ?>: <?php echo $errors; ?></div><?php endif; ?>
											<form method="POST" action="<?php the_permalink(); ?>">
												<?php wp_nonce_field( plugin_basename(__FILE__), 'contact_form[check]' );?>
												<p>
													<input type="text" name="contact_form[name]" id="name" value="<?php echo $name; ?>" />
													<label for="name"><?php _e('Name', 'codeus'); ?> <span class="required"><?php _e('(required)', 'codeus'); ?></span></label><br />
												</p>
												<p>
													<input type="text" name="contact_form[email]" id="email" value="<?php echo $email; ?>" />
													<label for="email"><?php _e('Mail', 'codeus'); ?> <span class="required"><?php _e('(required)', 'codeus'); ?></span></label><br />
												</p>
												<p>
													<input type="text" name="contact_form[site]" id="site" value="<?php echo $email; ?>" />
													<label for="site"><?php _e('Website', 'codeus'); ?></label><br />
												</p>
												<p>
													<textarea name="contact_form[message]" id="message" cols="58" rows="10"><?php echo $message; ?></textarea>
												</p>
												<a href="javascript: void(0);" class="reset" onclick="jQuery(this).closest('form')[0].reset();"><?php _e('Clear form', 'codeus'); ?></a>
												<button><?php _e('Send', 'codeus'); ?></button>
											</form>
										<?php endif; ?>
									</div>
								</div>
							</div><!-- #content -->
						</div><!-- #center -->

						<?php get_sidebar(); ?>

					</div><!-- .panel -->

				</div><!-- .central-wrapper -->
			</div><!-- #main -->

		<?php endif; ?>

	</div><!-- wrap end -->

<?php get_footer(); ?>
