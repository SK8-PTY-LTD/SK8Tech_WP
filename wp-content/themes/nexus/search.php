<?php
/* Search Page */
?>


<!-- Get Page Header
================================================== -->	
<?php get_header(); ?>



<!-- Page Variables and Query
================================================== -->	
<?php

	global $query_string;

	$query_args = explode("&", $query_string);
	$search_query = array();

	foreach($query_args as $key => $string) {
		$query_split = explode("=", $string);
		$search_query[$query_split[0]] = urldecode($query_split[1]);
	}

	$search = new WP_Query($search_query);

	global $prof_default;
	
	$all = __(' Comments', 'sentient');
	$one = __(' Comment', 'sentient');	
	
	$displayedCat = '';
	
	$string = get_the_title();
	$pieces = explode(' ', $string);
	$last_word = array_pop($pieces);
	
	$string = str_replace($last_word, "", $string);	
?>


<!-- Page Title Section
================================================== -->	
<section class="hero sub-header">
    <div class="container inactive">
        <div class="sh-title-wrapper">
            <h1><?php _e("Search for " , "nexus"); ?><?php echo get_search_query(); ?></h1>
        </div>
    </div>
</section>
<nav class="breadcrumb">
    <div class="container">
        <ul>
            <li class="home"><a href="<?php echo esc_url(home_url()); ?>"><i class="fa fa-home"></i></a></li>
            <li class="current"><a href="<?php echo get_permalink(); ?>"><?php _e("Search for " , "nexus"); ?><?php echo get_search_query(); ?></a></li>
        </ul>
    </div>
</nav>



<!-- Page Search Body Started
================================================== -->
<section class="section primary blog-posts search-posts">
    <div class="container small-container blog-items">
		<?php
			if (have_posts() ) { 
				while ( have_posts() ) : the_post();
				
				$feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
		?>					
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
		<?php } else { ?>
			<div id="post-0" class="post no-results not-found blog-item">
				<h2 class="entry-title"><?php _e( 'Nothing Found', 'sentient' ) ?></h2>
				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'sentient' ); ?></p>                    
				</div>
			</div>
		<?php } ?> 			
	</div>
</section>


<!-- Get Page Footer
================================================== -->	
<?php get_footer(); ?>											