<?php
/**
 * 404 ( Not fount page )
 */
?>
<!-- Get Variables and create header
================================================== -->
<?php	global $prof_default;	
	get_header();
?><!-- Get Page Title Section================================================== --><section class="hero sub-header">    <div class="container inactive">        <div class="sh-title-wrapper">            <h1><?php echo esc_attr(of_get_option('blank_page_title',$prof_default));?></h1>			<?php if(of_get_option('blank_page_desc',$prof_default) != ''){ ?>				<p><?php echo esc_attr(of_get_option('blank_page_desc',$prof_default));?></p>			<?php } ?>        </div>    </div></section><!-- Footer Section================================================== -->
<?php get_footer(); ?>