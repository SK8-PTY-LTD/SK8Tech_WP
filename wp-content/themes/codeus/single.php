<?php
/**
 * The main template.
 *
 * @package Codeus
 */

	get_header();

?>
	</div><!-- wrap end -->
	<!-- wrap start --><div class="content-wrap">

		<?php if(have_posts()) : the_post(); ?>
			<?php
				$post_tags = wp_get_post_tags($post->ID);
				$post_tags_ids = array();
				foreach($post_tags as $individual_tag) {
					$post_tags_ids[] = $individual_tag->term_id;
				}
				if ($post_tags_ids) {
					$args=array(
						'tag__in' => $post_tags_ids,
						'post__not_in' => array($post->ID),
						'posts_per_page'=>3,
						'orderby' => 'rand'
					);  
					$related_query = new WP_Query( $args );
				}
			?>
			<div id="main">
				<div class="central-wrapper clearfix">
					<div class="panel clearfix">
						<div id="center" class="center clearfix">
							<div id="content">
								<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<div class="inner">
										<?php $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'codues_post_image'); ?>
										<?php if($image_url[0]) : ?>
											<div class="post-image">
												<div class="image wrap-box shadow middle">
													<div class="shadow-left"></div><div class="shadow-right"></div>
													<img class="wrap-box-element" src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" />
												</div>
											</div>
										<?php endif; ?>
										<?php the_content(); ?>
										<?php wp_link_pages( array( 'before' => '<div class="pagination"><div class="page-links-title">' . __( 'Pages:', 'codeus' ) . '</div>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
										<?php codeus_author_info(get_the_ID(), true); ?>
										<div class="post-tags-block clearfix">
											<?php if(codeus_get_option('show_social_icons')) { codeus_socials_sharing(); } ?>
											<div class="post-tags">
												<?php echo get_the_date(); ?>
												<?php if ($post_tags_ids): ?>
													<span class="sep">|</span>
													<?php
														$tag_list = get_the_tag_list( '', __( '<span class="sep">|</span>', 'codeus' ) );
														if ( $tag_list ) {
															echo '<span class="tags-links">' . $tag_list . '</span>';
														}
													?>
												<?php endif; ?>
											</div>
										</div>
										<div class="post-posts-links clearfix">
											<div class="left"><?php previous_post_link('%link', __('Previous post', 'codeus'), true); ?></div>
											<div class="right"><?php next_post_link('%link', __('Next post', 'codeus'), true); ?></div>
										</div>
										<?php if($post_tags_ids && $related_query->have_posts()) : ?>
											<?php
												global $post;
												$blog_posttemp = $post;
											?>
											<div class="post-related-posts">
												<h3><?php _e('Related Posts', 'codeus'); ?></h3>
												<?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
													<?php $related_mage_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'codeus_post_list'); ?>
													<div class="related-element <?php if (!$related_mage_url[0]): ?>without-image<?php endif; ?>">
														<a href="<?php echo get_permalink(); ?>"><?php if ($related_mage_url[0]): ?><img src="<?php echo $related_mage_url[0]; ?>" /><?php endif; ?></a>
														<div class="related-element-info">
															<a href="<?php echo get_permalink(); ?>"> <?php echo get_the_title(); ?></a>
															<div class="date"><?php echo get_the_date(); ?></div>
														</div>
													</div>
													<?php $post = $blog_posttemp; wp_reset_postdata(); ?>
												<?php endwhile; ?>
											</div>
											<?php if ( have_comments() || comments_open() ) : ?>
												<div class="post-related-posts-line" <?php if ( !have_comments() ) : ?>style="margin: 0;"<?php endif; ?>></div>
											<?php endif;?>
										<?php endif; ?>
										<?php comments_template( '', true ); ?>
									</div>
								</div>
							</div><!-- #content -->
						</div><!-- #center -->
						<?php get_sidebar('blog'); ?>
					</div><!-- .panel -->
				</div><!-- .central -->
			</div><!-- #main -->
		<?php endif; ?>

	</div><!-- wrap end -->

<?php get_footer(); ?>