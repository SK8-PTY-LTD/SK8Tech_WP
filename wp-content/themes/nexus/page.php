<?php
/**
 * Default Page
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


<!-- Page Default Body Started
================================================== -->
<div class="page-main-container single-page page-right-sidebar">	 
	 <div class="middle-container">
		<div class="container">
			<div class="row">				
				<div class="col-md-9">
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
						
						<!-- Content
						================================================== -->							
						<?php the_content(); ?>

						<!-- Blog Comments Section
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
							

					<?php endwhile; endif; ?>
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
<!-- Page Default Body End
================================================== -->



<!-- Get Page Footer
================================================== -->
<?php get_footer(); ?>