<?php

function codeus_blog_list() {
	$page_num = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$items_per_page = codeus_get_option('post_per_page') ? codeus_get_option('post_per_page') : 5;
	$blog_loop = new WP_Query(array(
		'post_type' => 'post',
		'posts_per_page' => $items_per_page,
		'paged' => $page_num
	));
	$pages_count = ceil($blog_loop->found_posts/$items_per_page);
	global $post;
	$portfolio_posttemp = $post;
?>
<?php if($blog_loop->have_posts()) : ?>
	<div class="blog_list">
		<ul class="styled">
			<?php while ( $blog_loop->have_posts() ) : $blog_loop->the_post(); ?>
				<li class="clearfix">
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'codeus_post_list_image'); ?>
						<div class="comment-info">
							<a href="<?php echo get_permalink($post->ID); ?>" class="date-day"><?php echo get_the_date('d'); ?></a>
							<div class="date-month"><?php echo get_the_date('M'); ?></div>
						</div>
						<div class="post-info">
							<h3><a href="<?php echo get_permalink($post->ID); ?>"><?php the_title(); ?></a></h3>
							<?php if($image_url[0]) : ?>
								<div class="post-image">
									<div class="image wrap-box shadow middle">
										<div class="shadow-left"></div><div class="shadow-right"></div>
										<a href="<?php echo get_permalink($post->ID); ?>"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>
									</div>
								</div>
							<?php endif; ?>
							<div class="text clearfix"><?php the_excerpt(); ?></div>
							<?php codeus_author_info(get_the_ID()); ?>
						</div>
					</div>
				</li>
				<?php $post = $portfolio_posttemp; wp_reset_postdata(); ?>
			<?php endwhile; ?>
		</ul>
		<?php codeus_pagination($page_num, $pages_count); ?>
	</div>
<?php endif; ?>

<?php
}

function codeus_author_info($post_id, $full = FALSE) {
	$post = get_post($post_id);
	$user_id = $post->post_author;
	$user_data = get_userdata( $user_id );
	$user_meta = get_user_meta( $user_id );
	$show = TRUE;
	if(!codeus_get_option('show_author')) {
		$show = FALSE;
	}
?>
	<?php if ($full): ?>
		<?php if ($show): ?>
			<div class="post-author-block clearfix">
				<div class="post-author-avatar"><?php echo get_avatar( $user_id, 72 ); ?></div>
				<div class="post-author-info">
					<div class="name"><?php echo $user_data->data->display_name; ?></div>
					<div class="date-info">
						<span class="date"><?php echo get_the_date('', $post->ID); ?></span>
						<?php
							$cats = get_the_category( $post_id );
							$cats_echo = array();
							if($cats) {
								foreach($cats as $cat) {
									$cats_echo[] = '<a href="'.get_category_link( $cat->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'codeus' ), $cat->name ) ) . '">'.$cat->cat_name.'</a>';
								}
							}
						?>
						<?php if(count($cats_echo)) : ?>
							<span class="categories"> in <?php echo implode(', ', $cats_echo) ?></span>
						<?php endif; ?>
					</div>
					<div class="description"><?php echo $user_data->description; ?></div>
				</div>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<div class="post-info-bottom clearfix">
			<?php
				$cats = get_the_category( $post_id );
				$cats_echo = array();
				if($cats) {
					foreach($cats as $cat) {
						$cats_echo[] = '<a href="'.get_category_link( $cat->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'codeus' ), $cat->name ) ) . '">'.$cat->cat_name.'</a>';
					}
				}
			?>
			<?php if(count($cats_echo)) : ?>
				<div class="categories"><?php echo implode('<span class="sep">|</span>', $cats_echo) ?></div>
			<?php endif; ?>
			<div class="comments-count">
				<?php if($comments = wp_count_comments(get_the_ID())) : ?>
					<span class="comment-count"><?php printf( __( '<b>%d</b> comments', 'codeus' ), $comments->approved ); ?></span>
				<?php endif;?>
				<a href="<?php echo get_permalink($post->ID); ?>" class="more-link"><b>&nbsp;</b><?php _e('Read more', 'codeus'); ?></a>
			</div>
		</div>
	<?php endif; ?>
<?php
}

function codeus_socials_sharing() {
?>
	<div class="socials-sharing socials">
		<ul class="styled">
			<li class="twitter"><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" title="Twitter">Twitter</a></li>
			<li class="facebook"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php the_permalink(); ?>&p[title]=<?php the_title(); ?>" title="Facebook">Facebook</a></li>
			<li class="linkedin"><a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" title="LinkedIn">LinkedIn</a></li>
			<li class="googleplus"><a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" title="Google Plus">Google Plus</a></li>
			<li class="stumbleupon"><a target="_blank" href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" title="StumbleUpon">StumbleUpon</a></li>
		</ul>
	</div>
<?php
}

function codeus_comment_template($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="clearfix">
		<div class="left"><?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?></div>
		<div class="comment-content clearfix">
			<div class="comment-author"><?php printf(__('<span class="author">%s</span>'), get_comment_author_link()); ?></div>
			<div class="comment-date">
				<?php
					printf( __('<span class="date">%1$s %2$s</span>'), get_comment_date('F d, Y'), get_comment_time('H:i')) ?></a><?php edit_comment_link(__('Edit', 'codeus'),'&nbsp;&nbsp;','' );
				?>
				<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		
			<?php if ($comment->comment_approved == '0') : ?>
				<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'codeus') ?></em>
				<br />
			<?php endif; ?>

			<div class="text"><?php comment_text() ?></div>
		</div>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
		</div>
	<?php endif; ?>
<?php
}


?>