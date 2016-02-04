<?php

	global $prof_default;

?>
 
<!-- Footer Start
================================================== -->		

 
	<!-- Footer Columns
	================================================== -->
	<footer class="app-footer">
		<?php if(of_get_option('select_columns_columns',$prof_default) == 'On'){ ?>
			<div class="container footer-content">
				<div class="row">
					<div class="span-3 footer-col">
						<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('FooterColI')) { ?>   
							<?php dynamic_sidebar('FooterColI'); ?>
						<?php } ?>
					</div>
					<div class="span-3 footer-col">				
						<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('FooterColII')) { ?>   
							<?php dynamic_sidebar('FooterColII'); ?>
						<?php } ?>
					</div>
					<div class="span-3 footer-col">				
						<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('FooterColIII')) { ?>   
							<?php dynamic_sidebar('FooterColIII'); ?>
						<?php } ?>
					</div>
					<div class="span-3 footer-col">				
						<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('FooterColIV')) { ?>   
							<?php dynamic_sidebar('FooterColIV'); ?>
						<?php } ?>	
					</div>
				</div>
			</div>
		<?php } ?>
		<div class="bottom-bar">
			<div class="container">
				<div class="footer-wrapper">
					<!-- Copyright Section -->
					<?php if (of_get_option('select_copyrights_columns',$prof_default) == 'On') { ?>
						<div class="copyright" id="copyright">
							<?php echo wp_kses_post(of_get_option('footer_text',$prof_default)); ?>							
						</div>
					<?php } ?>
					<!-- Footer Navigation -->
					<?php
						if (of_get_option('select_menu_footer',$prof_default) == 'On') {
								wp_nav_menu( array( 'theme_location' => 'extra-menu' ) );
						} else {
								echo esc_attr(of_get_option('select_menu_text',$prof_default));
						}
					?>	
				</div>
			</div>
		</div>
		

		<?php if(of_get_option('select_backtotop',$prof_default) == 'On') { ?> 
			<a id="back-top" href="#" style="display: none;"><i class="fa fa-angle-up fa-2x"></i></a>
		<?php } ?>		
		
	</footer>


<!-- Footer End
================================================== -->		
</div>

<div class="loading-wrapper active">
	<div class="spinner"></div>
</div>


<span class="icon-lrg nav-trigger flyout-trigger" id="flyout-trigger">
    <i class="fa fa-bars"></i>
</span>

<nav class="flyout-nav-container" id="flyout-nav"></nav>


<?php
	if(of_get_option('select_header_search',$prof_default) == 'On'){
?>								
	<form action="<?php echo esc_url(get_site_url()); ?>" class="main-search" id="searchform" method="get" role="search">						
		<input type="search" name="s" id="s" value="" placeholder="<?php _e("Enter your query..." , "nexus"); ?>">
		<button type="submit"><i class="fa fa-search"></i></button>
		<div class="button brand-1 search-close"><i class="fa fa-times"></i></div>
	</form>
<?php } ?>


<?php wp_footer(); ?>
</body>
</html>

