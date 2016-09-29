<?php
/**
 * Category page
 *
 * @package Codeus
 */

	get_header();
	global $more; $more = false;
?>

	</div><!-- wrap end -->

	<!-- wrap start --><div class="content-wrap">

		<?php if(have_posts()) : ?>
			<div id="main">
				<div class="central-wrapper clearfix">

					<div class="panel clearfix">

						<div id="center" class="center clearfix">
							<div id="content">
								<div class="inner">
									<div class="blog_list">
										<ul class="styled">
											<?php while(have_posts()) : the_post(); ?>
												<li class="clearfix">
													<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
														<?php $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'codeus_post_image'); ?>
														<div class="comment-info">
															<div class="date-day"><?php echo get_the_date('d'); ?></div>
															<div class="date-month"><?php echo get_the_date('M'); ?></div>
														</div>
														<div class="post-info">
															<h3><a href="<?php echo get_permalink($post->ID); ?>"><?php the_title(); ?></a></h3>
															<?php if($image_url[0]) : ?>
																<div class="post-image">
																	<div class="image wrap-box shadow middle">
																		<div class="shadow-left"></div><div class="shadow-right"></div>
																		<a href="<?php echo get_permalink($post->ID); ?>"><img class="wrap-box-element" src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>
																	</div>
																</div>
															<?php endif; ?>
															<div class="text clearfix"><?php the_excerpt(); ?></div>
															<?php if(codeus_get_option('show_social_icons')) { codeus_socials_sharing(); } ?>
															<?php codeus_author_info(get_the_ID()); ?>
														</div>
														</div>
												</li>
											<?php endwhile; ?>
										</ul>
										<?php
											global $wp_query;
											$page_num = (get_query_var('paged')) ? get_query_var('paged') : 1;
											codeus_pagination($page_num, $wp_query->max_num_pages);
										?>
									</div>
								</div>
							</div><!-- #content -->
						</div><!-- #center -->

						<?php get_sidebar('blog'); ?>

					</div><!-- .panel -->

				</div><!-- .central-wrapper -->
			</div><!-- #main -->

		<?php endif; ?>

	</div><!-- wrap end -->

<?php get_footer(); ?>