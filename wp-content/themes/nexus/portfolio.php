<?php  
/* Template Name: Template - Portfolio*/  
?>


<!-- Get Page Header
================================================== -->	
<?php get_header(); ?>

<?php global $prof_default; ?>
<!-- Get Page Title Section
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


<!-- Portfolio Filter Section - Started
================================================== -->
<section class="section primary latest-works" id="portfolio">
    <div class="container">
        <?php if(of_get_option('select_title_portfolio',$prof_default) == 'On'){ ?>
		<header class="sep active nexus-portfolio-title">
            <div class="section-title">
                <h2><?php echo esc_attr(of_get_option('portfolio_title_word',$prof_default));?> <i><?php echo esc_attr(of_get_option('portfolio_title_highlighted_word',$prof_default));?></i></h2>
                <h3><?php echo esc_attr(of_get_option('portfolio_subtitle_text',$prof_default));?></h3>
            </div>
            <p><?php echo esc_attr(of_get_option('portfolio_description_text',$prof_default));?></p>
        </header>
		<?php } ?>
		
		<div class="owl-carousel portfolio-carousel">
		<?php 
				$wp_query= null;
				$wp_query = new WP_Query();
				$counter = 1;
				$endCounter = 1;				
				$wp_query->query('post_type=portfolio&posts_per_page=-1');

				
				while ($wp_query->have_posts()) : $wp_query->the_post();
		?>	
				<?php
					if($counter == 1 || $counter == 7 || $counter == 13 || $counter == 19 || $counter == 25 || $counter == 31 || $counter == 37 || $counter == 43 || $counter == 49 || $counter == 55 || $counter == 61 || $counter == 67 || $counter == 73 || $counter == 79 || $counter == 85 || $counter == 91 || $counter == 97){
						echo '<div class="portfolio-items">';
					}
					
					$feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
				?>
				<div class="portfolio-item">
                    <div class="controls">
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="icon-round-border">
                            <i class="fa fa-link"></i>
                        </a>
                        <a href="<?php echo esc_url($feat_image); ?>" class="icon-round-border icon-view">
                            <i class="fa fa-search"></i>
                        </a>
                    </div>
                    <h4><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h4>
                    <p><?php echo strip_shortcodes(wp_trim_words( get_the_excerpt(), 15 )); ?></p>
                    <?php the_post_thumbnail( get_the_ID() ,  'nexus-portfolio-thumb' ); ?>
                </div>
				<?php
					if($endCounter % 6 == 0){
						echo '</div>';
					}

					$endCounter = $endCounter + 1;
					$counter = $counter + 1;					
				?>
		<?php endwhile; ?>
		</div>
		<div class="nav-carousel">
			<div class="icon-round-border-lrg nav-prev">
				<i class="fa fa-angle-left"></i>
			</div>
			<div class="icon-round-border-lrg nav-next">
				<i class="fa fa-angle-right"></i>
			</div>
		</div>			
    </div>
	<?php wp_reset_query(); ?>
</section>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>				
	<?php the_content(); ?>			
<?php endwhile; endif; ?>	
<!-- Get Page Body
================================================== -->		
<?php get_footer(); ?>  