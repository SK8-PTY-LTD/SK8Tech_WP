<?php
/*
Template Name: Template - Homepage
*/
?>


<!-- Get Page Header
================================================== -->
<?php get_header(); ?>


<!-- Page Title Section
================================================== -->
<?php
	if((!is_front_page() && !is_home())){
?>
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
<?php } ?>

<!-- Page Begin
================================================== -->
<div id="contentWrap" class="main-container activehide">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>				
	<div class="main-page-column-data main-page-column-data-full">
		<div class="get-column-container">			
			<div class="page-content">
				<?php the_content(); ?>			
			</div>				
		</div>
	</div>
	<?php endwhile; endif; ?>			
</div>


<!-- Get Page Header
================================================== -->
<?php get_footer(); ?>
