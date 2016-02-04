<?php
/*Index Page*/
?>


<!-- Get Page Header
================================================== -->
<?php get_header(); ?>



<!-- Page Title Section
================================================== -->
<?php
	global $prof_default;
?>
<section class="hero sub-header">
    <div class="container inactive">
        <div class="sh-title-wrapper">
            <h1><?php echo esc_attr(of_get_option('index_title',$prof_default) ); ?></h1>
			<?php
				if(of_get_option('index_sub_title',$prof_default) != ''){ ?>
					<p><?php echo esc_attr(of_get_option('index_sub_title',$prof_default)); ?></p>
			<?php } ?>			
        </div>
    </div>
</section>
<nav class="breadcrumb">
    <div class="container">
        <ul>
            <li class="home"><a href="<?php echo esc_url(home_url()); ?>"><i class="fa fa-home"></i></a></li>
        </ul>
    </div>
</nav>


<!-- Page Body Start
================================================== -->
<div class="page-main-container single-page page-right-sidebar">	 
	 <div class="middle-container">
		<div class="container">
			<div class="row">				
				<div class="col-md-9">
					<section class="section primary blog-posts">
						<div class="container small-container blog-items">
					<?php
								$temp = $wp_query;
								$wp_query = null;
								$wp_query = new WP_Query();
								$wp_query->query('posts_per_page=5'.'&paged='.$paged);

								while ($wp_query->have_posts()) : $wp_query->the_post();
									$feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
									
										$terms = get_the_terms(get_the_ID() , "category");
										$count = count($terms); 
										$cat_string  = '';
										$catCount = 1;
										if ( $count > 0 ){  
										  
											foreach ( $terms as $term ) {  
												if($term->name != 'Uncategorized' && $term->name != 'uncategorized' && $catCount < 2){
													$termname = strtolower($term->name);  
													$cat_string = '<a href="' . get_term_link($term) . '" class="' . $termname . '" title="'. $term->name . '"> ' . $term->name . ' </a>';
													$cat_string = '<small>' . __("Posted in" , "nexus") . ' ' . $cat_string . '</small>';
												}
												$catCount = $catCount + 1;
											}  
										}  
							?>					
								<div <?php post_class("blog-item blog-item-half"); ?>>
									<?php if(has_post_thumbnail()){ ?>
										<a href="<?php echo esc_url(get_permalink()); ?>" class="thumb">                  
											<?php the_post_thumbnail( get_the_ID() ,  'nexus-blog-thumb' ); ?>
										</a>
										<a href="<?php echo esc_url(get_permalink()); ?>" class="modal-image profile profile-alt">          
											<?php echo get_avatar( get_the_author_meta( 'ID' ), 75 ); ?>
										</a>
									<?php } ?>			
									<div class="date">
										<span><?php echo get_the_time('M'); ?></span>
										<span><?php echo get_the_time('j'); ?></span>
									</div>
									<h4><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title() ?></a></h4>
									<h5><?php _e("Posted by " , "nexus"); ?><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_author(); ?></a></h5>
									<p><?php echo strip_shortcodes(wp_trim_words( get_the_content(), 53 )); ?></p>
									<a class="button round brand-1" href="<?php echo esc_url(get_permalink()); ?>"><?php _e("Read More" , "nexus"); ?></a>
									<?php echo $cat_string; ?>
								</div>

								<hr class="stripes" />
							<?php endwhile; ?>
							<div class="pagination">
									<?php
										global $wp_query;

										$big = 999999999;
										$modified = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
										$modified = str_replace( '#038;', '', $modified  );
										echo paginate_links( array(
											'base' => $modified,
											'format' => '?paged=%#%',
											'current' => max( 1, get_query_var('paged') ),
											'total' => $wp_query->max_num_pages,														
											'prev_text'    => __('<i class="fa fa-angle-left"></i>'),
											'next_text'    => __('<i class="fa fa-angle-right"></i>')						
										) );
									?>
							</div>	
						</div>
					</section>				
				</div>
				<div class="col-md-3">
					<aside class="project wow fadeInRight">
						<div class="aside-wrap">
							<?php get_sidebar(); ?>
						</div>
					</aside>
				</div>				
			</div>
		</div>
	</div>
</div>






<!-- Get Page Footer
================================================== -->
<?php get_footer(); ?>