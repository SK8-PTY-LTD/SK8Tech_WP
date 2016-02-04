
<!-- Single Page Started
================================================== -->	


<!-- Get Page Header
================================================== -->	
<?php get_header(); ?>




<!-- Single Portfolio Template Started
================================================== -->	

<?php global $prof_default; ?>


<?php if ('portfolio' == get_post_type()){ ?>

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	
	<!-- Page Title Section
	================================================== -->	
	<section class="hero sub-header">
		<div class="container inactive">
			<div class="sh-title-wrapper">
				<h1><?php echo get_the_title(); ?></h1>
				<?php if(get_post_meta(get_the_ID(), 'Title Description', true) != ''){ ?>
					<p><?php echo esc_attr(get_post_meta(get_the_ID(), 'Title Description', true)); ?></p>
				<?php } ?>
			</div>
		</div>
	</section>
	<nav class="breadcrumb">
		<div class="container">
			<ul>
				<li class="home"><a href="<?php echo esc_url(home_url()); ?>"><i class="fa fa-home"></i></a></li>
				<?php
					if($post->post_parent > 0) {
						echo '<li><a href="' . esc_url(get_permalink($post->post_parent)) .'">'.get_the_title($post->post_parent).'</a></li>';
					}
				?>
				<li class="current"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
			</ul>
		</div>
	</nav>
		
	
	<!-- Portfolio Section Started
	================================================== -->	
    <section class="section primary single-project inactive">
		<div>
			<?php the_content(); ?>
		</div>
	</section>
	<!-- Portfolio Section End
	================================================== -->		
	
	<?php endwhile; ?>
	<?php endif; ?>			
<!-- Single Portfolio Template End
================================================== -->	



<!-- Single Post Template Started
================================================== -->	
<?php } else { ?>
<div class="nexus-single-main-container" >

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<!-- Page Title Section Started
	================================================== -->		
	<section class="hero sub-header">
		<div class="container inactive">
			<div class="sh-title-wrapper">
				<h1><?php echo get_the_title(); ?></h1>
				<?php if(get_post_meta(get_the_ID(), 'Title Description', true) != ''){ ?>
					<p><?php echo esc_attr(get_post_meta(get_the_ID(), 'Title Description', true)); ?></p>
				<?php } ?>
			</div>
		</div>
	</section>
	<nav class="breadcrumb">
		<div class="container">
			<ul>
				<li class="home"><a href="<?php echo esc_url(home_url()); ?>"><i class="fa fa-home"></i></a></li>
				<?php
					if($post->post_parent > 0) {
						echo '<li><a href="' . esc_url(get_permalink($post->post_parent)) .'">'.get_the_title($post->post_parent).'</a></li>';
					}
				?>
				<li class="current"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
			</ul>
		</div>
	</nav>
	<!-- Page Title Section End
	================================================== -->		
	
	
	<!-- Page Content Section Started
	================================================== -->
	<?php
		$string = get_the_title();
		$pieces = explode(' ', $string);
		$last_word = array_pop($pieces);
	
		$string = str_replace($last_word, "", $string);		
	?>
    <section class="section primary blog-post nexus-blog-post">
		<div class="container small-container">
			<header class="sep active">
				<div class="section-title">
					<h2><?php echo esc_attr($string); ?> <i><?php echo esc_attr($last_word); ?></i></h2>
					<?php
						$terms = get_the_terms(get_the_ID() , "category");
						$count = count($terms); 					
						$cat_string  = '';
						$catCount = 1;
						if ( $count > 0 ){  
						  
							foreach ( $terms as $term ) {  
								if($term->name != 'Uncategorized' && $term->name != 'uncategorized' && $catCount < 2){
									$termname = strtolower($term->name);  
									$cat_string = '<li><i class="fa fa-folder"></i> '. __("Category:" , "nexus") .' <a href="' . get_term_link($term) . '">'. $term->name . '</a></li>';
								}
								$catCount = $catCount + 1;
							}  
						} 
					?>
					<ul class="post-meta">
						<li><i class="fa fa-user"></i> <?php _e("Posted by:" , "nexus"); ?> <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_author(); ?></a></li>
						<?php echo $cat_string; ?>
						<li><i class="fa fa-calendar"></i> <?php _e("Posted:" , "nexus"); ?> <?php echo  get_the_time('j') . '-' . get_the_time('M') . '-' . get_the_time('Y'); ?></li>
					</ul>
				</div>
			</header>
			<div class="post-meta">
				<?php
					$feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
					
					if ( get_post_format() == false && has_post_thumbnail()) { ?>
				
						<a href="<?php echo esc_url($feat_image); ?>" class="modal-image thumb">
							<?php echo get_the_post_thumbnail( get_the_ID() ,  'full' ); ?>
						</a>
						<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>" class="profile profile-border modal-image"> 
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 75 ); ?>
						</a>				
				
					<?php } elseif ( has_post_format('video') && get_post_meta(get_the_ID(), 'Post Video URL', true) != '') { ?>
					
						<iframe width="100%" height="450px" src="<?php echo esc_url(get_post_meta(get_the_ID(), 'Post Video URL', true)); ?>"></iframe>
					
					<?php } elseif ( has_post_format('gallery') && get_post_meta(get_the_ID(), 'Gallery images ID', true)!= '') {?>
					
						<div class="testimonials-slider owl-carousel">						
							<?php
								$galleryids = explode(",", get_post_meta(get_the_ID(), 'Gallery images ID', true));
								$idscount = count($galleryids);
								for ($x=0; $x < $idscount; $x++)
								{	
									$getimageurlarray = wp_get_attachment_image_src( $galleryids[$x] , 'full');
									
									$alt = get_post_meta($galleryids[$x], '_wp_attachment_image_alt', true);
									
									echo '<div class="testimonial"><img class="img-center img-responsive" src="' . esc_url($getimageurlarray[0]) . '" alt="' . esc_attr($alt) . '"/></div>';
								} 
						
							?>
						</div>
						<div class="nexus-testimonials-slider nav-carousel">
							<div class="icon-round-border-lrg nav-prev">
								<i class="fa fa-angle-left"></i>
							</div>
							<div class="icon-round-border-lrg nav-next">
								<i class="fa fa-angle-right"></i>
							</div>
						</div>
					<?php } elseif ( has_post_format( 'audio' ) && get_post_meta(get_the_ID(), 'Post Audio Shortcode', true)!= '') {		
						echo do_shortcode(get_post_meta(get_the_ID(), 'Post Audio Shortcode', true)) ;
					} else { ?>
					
						<a href="<?php echo esc_url($feat_image); ?>" class="modal-image thumb">
							<?php echo get_the_post_thumbnail( get_the_ID() ,  'full' ); ?>
						</a>
						<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>" class="profile profile-border modal-image"> 
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 75 ); ?>
						</a>					
					
					<?php } ?>

			</div>
			<div class="post-content">
				<?php the_content(); ?>
			</div>
			<?php if(of_get_option('blog_author_option',$prof_default) == 'On'){ ?>
			<div class="post-author">
				<header>
					<div class="section-title">
						<?php
							$authorstring = of_get_option('blog_author_title',$prof_default);
							$authorpieces = explode(' ', $authorstring);
							$authorlast_word = array_pop($authorpieces);
						
							$authorstring = str_replace($authorlast_word, "", $authorstring);								
						?>
						<h4><span><?php echo esc_attr($authorstring); ?> <i><?php echo esc_attr($authorlast_word); ?></i></span></h4>
					</div>
				</header>
				<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>" class="modal-image profile profile-border">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
				</a>
				<div class="author-content">
					<h4><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_author(); ?></a></h4>
					<p><?php esc_attr(the_author_meta('description')); ?></p>
				</div>
			</div>
			<?php } ?>
		</div>
	</section>	
	
	<!-- Comments Section Started
	================================================== -->					
	<?php if(comments_open($post->ID )){?>
        <section class="section primary comments">
			<div class="container">
				<hr class="stripes large no-mt" />
			
				<div class="comment-area">
					<?php comments_template('', true); ?>
				</div>
				
				<hr class="stripes large no-mb" />
			</div>
		</section>
	<?php } ?>
	
	<!-- Comments Section
	================================================== -->	
	<div class="pagination">
		<div class="pages">
			<?php wp_link_pages(array('before' => '<p>' . __('Pages: ','nexus'),'after'=> '</p>')); ?>
		</div>							
	</div>
	
	
	<!-- Related Posts Section
	================================================== -->			
	<?php if(of_get_option('blog_related_option',$prof_default) == 'On'){ ?>
		<?php
		
		$category = get_the_category(  $post->ID  );
		if($category[0]->cat_name != 'Uncategorized'){
			$profseparator = ',';
			$profoutput='';
			if($category){
				foreach($category as $profcategory) {
					$profoutput .= $profcategory->name . $profseparator;
				}					
				$profallcategories = trim($profoutput, $profseparator);
			}		
		
		$type = get_post_type( $post->ID );
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$args =  array ( 'category_name' => $profallcategories, 'paged' => $paged, 'posts_per_page'=> 3, 'post_type'=> $type , 'post__not_in'=>array($post->ID));
		$catPosts = new WP_Query($args );
		
		
		if($catPosts->have_posts()){ ?>		
			<section class="section primary related-posts nexus-internal-related-posts">
				<div class="container">
					<header class="sep">
						<div class="section-title">
							<?php
								$relatedstring = of_get_option('blog_related_title',$prof_default);
								$relatedpieces = explode(' ', $relatedstring);
								$relatedlast_word = array_pop($relatedpieces);
							
								$relatedstring = str_replace($relatedlast_word, "", $relatedstring);								
							?>
							<h2><span><?php echo esc_attr($relatedstring); ?> <i><?php echo esc_attr($relatedlast_word); ?></i></span></h2>
						</div>
					</header>
					<div class="row blog-items">
						<?php if( $catPosts ) while ($catPosts->have_posts()) : $catPosts->the_post(); ?>
							<?php
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
							<div class="span-4 blog-item">  
							<?php if(has_post_thumbnail()){ ?>
								<a href="<?php echo esc_url(the_permalink()); ?>" class="thumb">                  
									<?php echo get_the_post_thumbnail( get_the_ID() ,  'nexus-blog-thumb' ); ?>
								</a>
								<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>" class="modal-image profile profile-alt">            
									<?php echo get_avatar( get_the_author_meta( 'ID' ), 75 ); ?>
								</a>
							<?php } ?>									
								<div class="date">
									<span><?php the_time('M'); ?></span>
									<span><?php the_time('j'); ?></span>
								</div>
								<h4><a href="<?php echo esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h4>
								<h5><?php _e("Posted by " , "nexus"); ?><a href="<?php echo esc_url(the_permalink()); ?>"><?php the_author(); ?></a></h5>
								<p><?php echo strip_shortcodes(wp_trim_words( get_the_content(), 23 )); ?></p>
								<a class="button round brand-1" href="<?php echo esc_url(the_permalink()); ?>"><?php _e("Read More" , "nexus"); ?></a>
								<?php echo $cat_string; ?>
							</div>									
						<?php
							endwhile;
							wp_reset_postdata();
						?>
					</div>
				</div>
			</section>
		<?php }
			}
		?>
	<?php } ?>
	<!-- Page Content Section End
	================================================== -->	
	
	<?php endwhile; ?>
	<?php endif; ?>		
</div>
<?php } ?>
<!-- Single Post Template End
================================================== -->	



<!-- Get Page Footer
================================================== -->	
<?php get_footer(); ?>
