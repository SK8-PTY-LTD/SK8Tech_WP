<?php
/*
	Archives Page
*/
?>

<!-- Get Page Header
================================================== -->	
<?php get_header(); ?>


<!-- Page Title Section
================================================== -->
<section class="hero sub-header">
    <div class="container inactive">
        <div class="sh-title-wrapper">
			<?php
				$archiveTitle = wp_title('|', false, 'right');
				$archiveTitleArray = explode(" ", $archiveTitle);
				
			?>		
            <h1><?php echo $archiveTitleArray[0]; ?></h1>
        </div>
    </div>
</section>
<nav class="breadcrumb">
    <div class="container">
        <ul>
            <li class="home"><a href="<?php echo esc_url(home_url()); ?>"><i class="fa fa-home"></i></a></li>
            <li class="current"><?php echo $archiveTitleArray[0]; ?></li>
        </ul>
    </div>
</nav>



<!-- Page Content Started
================================================== -->
<div class="page-main-container single-page page-right-sidebar">	 
	<div class="middle-container">
		<div class="container">
			<div class="row" id="content" role="main">
				<!-- Archive Content
				================================================== -->				
				<section class="section primary blog-posts search-posts">
					<div class="container small-container blog-items">
						<?php 
							if (have_posts() ) { ?>			 
							<?php while ( have_posts() ) : the_post();?>
								<div <?php post_class("blog-item"); ?>>                    
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
									<p><?php echo strip_shortcodes(wp_trim_words( get_the_excerpt(), 53 )); ?></p>
									<a class="button round brand-1" href="<?php echo esc_url(get_permalink()); ?>"><?php _e("Read More" , "nexus"); ?></a>
								</div>

								<hr class="stripes" />				
							<?php endwhile; ?>
							
							<!-- Pagination Started
							================================================== -->
							<div class="pagination">
								<div class="pages">
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
											'prev_text'    => __('<i class="fa fa-chevron-left"></i> Previous'),
											'next_text'    => __('Next <i class="fa fa-chevron-right"></i>')						
										) );
									?>
								</div>
							</div>							
							<!-- Pagination End
							================================================== -->								
							<?php } else { ?>
							<div id="post-0" class="post no-results not-found">
								<h2 class="entry-title"><?php _e( 'Nothing Found', 'sentient' ) ?></h2>
								<div class="entry-content">
									<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with something different.', 'sentient' ); ?></p>                    
								</div>
							</div>
							<?php } ?> 				
					</div>
				</section>
			</div>
		</div>
	</div>
</div>


<!-- Footer
================================================== -->	
<?php get_footer(); ?>