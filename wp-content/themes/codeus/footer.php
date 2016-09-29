<?php if(codeus_get_option('footer_active')) : ?>
	<footer id="footer">

		<?php
			$socials_icons = array('twitter' => codeus_get_option('twitter_active'), 'facebook' => codeus_get_option('facebook_active'), 'linkedin' => codeus_get_option('linkedin_active'), 'googleplus' => codeus_get_option('googleplus_active'), 'stumbleupon' => codeus_get_option('stumbleupon_active'), 'rss' => codeus_get_option('rss_active'));
		?>
		<?php if(codeus_get_option('follow_contacts_active')) : ?>
			<div id="contacts" class="clearfix">
				<div class="central-wrapper">

					<div class="panel clearfix">

						<div class="socials socials-icons center">
							<h2 class="bar-title"><?php if(codeus_get_option("follow_title")) { echo codeus_get_option("follow_title"); } else { _e('Follow Us', 'codeus'); } ?></h2>
							<?php if(codeus_get_option('follow_us_text')) : ?>
								<div class="text"><?php echo apply_filters('the_content', stripslashes(codeus_get_option('follow_us_text'))); ?></div>
							<?php endif; ?>
							<?php if(in_array(1, $socials_icons)) : ?>
								<ul class="styled">
									<?php foreach($socials_icons as $name => $active) : ?>
										<?php if($active) : ?>
											<li class="<?php echo $name; ?>"><a href="<?php echo codeus_get_option($name . '_link'); ?>" target="_blank" title="<?php echo $name; ?>"><?php echo $name; ?></a></li>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div><!-- .social-icons -->

						<?php if(codeus_get_option("contacts_html")) : ?>
							<div class="contacts-info sidebar">
								<h2 class="bar-title"><?php if(codeus_get_option("contacts_title")) { echo codeus_get_option("contacts_title"); } else { _e('Contact Us', 'codeus'); } ?></h2>
								<?php echo apply_filters('widget_text', stripslashes(codeus_get_option("contacts_html"))); ?>
							</div>
						<?php endif; ?>

					</div><!-- .panel -->

				</div>
			</div><!-- #contacts -->
		<?php endif; ?>

		<div id="bottom-line">
			<div class="central-wrapper">

				<div class="panel">

					<div class="footer-nav center">
						<?php get_sidebar('footer'); ?>
						<?php if(has_nav_menu('footer_nav')) { wp_nav_menu(array('theme_location' => 'footer_nav', 'menu_class' => 'nav-menu styled')); } ?>
					</div><!-- .footer-nav -->

					<div class="site-info sidebar">
						<?php echo stripslashes(codeus_get_option("footer_html")); ?>
					</div><!-- .site-info -->

				</div>

			</div>
			<div class="clear"></div>
		</div><!-- #bottom-line -->

	</footer><!-- #footer -->
<?php endif; ?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>