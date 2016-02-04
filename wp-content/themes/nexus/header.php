<!DOCTYPE html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html <?php language_attributes(); ?> class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->


<!-- Head Section Started
================================================== -->
<head>


	<!-- Basic Page Needs
  ================================================== -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="<?php wp_title('|', true, 'right'); ?>">
	
	
	<!-- Get Variables and include files
  ================================================== -->	
	<?php			

		global $prof_default, $woocommerce; ;
		if((is_front_page() && !is_home())){ $nexus_location = 'nexus-home';} else { $nexus_location = 'nexus-internal';}	
		
	?>

	
	<!-- Responsive is enabled 
	================================================== -->	
    <meta name="viewport" content="width=device-width, initial-scale=0.85">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">  
	
	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo esc_url(of_get_option('theme_favicon',$prof_default)); ?>" type="image/vnd.microsoft.icon"/>	
	
	<?php wp_head(); ?>
	
</head>
<!-- Head Section End
================================================== -->




<!-- Body Section Started
================================================== -->
<body <?php body_class('index parallax-title ' . $nexus_location); ?>>

    <div id="site-content">

		<!-- Menu Started
		================================================== -->	
	   <header class="app-header activehide" id="app-header">
			<div class="container">
				<div class="header-wrapper">
					<!-- Logo -->
					<div class="logo" id="logo">
						<!-- image logo -->
						<a href="<?php  echo esc_url(home_url()); ?>" title="<?php bloginfo( 'name' ) ?>" class="image-logo">							
							<?php if(of_get_option('select_display_logo',$prof_default) == 'On'){ ?>
								<img src="<?php echo esc_url(of_get_option('theme_logo',$prof_default)); ?>" alt="<?php bloginfo( 'name' ) ?>" />
							<?php } else { ?>
								<h3><?php echo esc_attr(of_get_option('theme_site_logo_text',$prof_default)); ?></h3>							
							<?php } ?>							
						</a>						
					</div>
					<!-- Main-Nav -->
					<nav class="main-nav">					
						<?php wp_nav_menu( array(
							'theme_location' => 'header-menu' ,
							'container' => false,
							'menu_class' => 'nav navbar-nav navbar-right ',
							'fallback_cb' => 'nexus_menu_fall_back',
							'walker' => new Nexus_description_walker()
							)); ?>
						<?php if(of_get_option('select_header_search',$prof_default) == 'On'){ ?>								
							<div class="icon-round-lrg-plain search-toggle">
								<i class="fa fa-search"></i>
							</div>
						<?php } ?>
					</nav>
				</div>
			</div>
		</header>	

        <?php if(of_get_option('page_slider_option',$prof_default) == 'On'){
				$heroClass = 'hero-slider';
			} else {$heroClass = '';}
		 ?>
		
		<!-- Static Header Started
		================================================== -->
		<?php
			if((is_front_page() && !is_home())){
		?>
		<section id="home" class="<?php echo esc_attr($heroClass); ?> hero inactive activehide">
			<?php if(of_get_option('page_slider_option',$prof_default) == 'On'){  ?>
				<?php echo do_shortcode(of_get_option('page_slider',$prof_default)); ?>
			<?php } else { ?>
                <?php if(of_get_option('slider_arrow_option',$prof_default) == 'On'){ ?>
                    <div class="hero-down">
                        <a href="#contentWrap" class="mouse">
                            <div class="mouse-animations">
                                <div class="mouse-scroll-l"></div>
                                <div class="mouse-scroll-2"></div>
                                <div class="mouse-scroll-3"></div>
                            </div>
                        </a>
                    </div>            
                <?php } ?>
				<div class="container">
					<div class="title-wrapper">
						<div class="hero-title">
							<h2><?php echo esc_attr(of_get_option('main_text_slider',$prof_default)); ?></h2>
							<h3><?php echo esc_attr(of_get_option('main_subtext_slider',$prof_default)); ?></h3>
						</div>
						<div class="meta">
							<p class="blurb"><?php echo esc_attr(of_get_option('main_description_slider',$prof_default)); ?></p>
                            <?php if(of_get_option('first_button_url',$prof_default) != ''){ ?>
								<a href="<?php echo esc_url(of_get_option('first_button_url',$prof_default)); ?>" class="button round brand-1"><?php echo esc_attr(of_get_option('first_button_text',$prof_default)); ?></a>
                            <?php } ?>
                            <?php if(of_get_option('second_button_url',$prof_default) != ''){ ?>
								<a href="<?php echo esc_url(of_get_option('second_button_url',$prof_default)); ?>" class="button round border"><?php echo esc_attr(of_get_option('second_button_text',$prof_default)); ?></a>
                            <?php } ?>
						</div>
					</div>
				</div>			
			<?php } ?>
		</section>
		<?php
			}
		?>