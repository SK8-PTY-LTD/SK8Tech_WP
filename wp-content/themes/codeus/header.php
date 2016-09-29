<?php
	$layout = codeus_get_option("page_layout_style") ? codeus_get_option("page_layout_style") : 'fullwidth';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php if(codeus_get_option('favicon')) : ?>
		<link rel="shortcut icon" href="<?php echo codeus_get_option('favicon'); ?>" />
	<?php endif; ?>
	<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?></title>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<?php
	$effects_enabled = false;
	$body_classes = array();
	if(is_home()) {
		$effects_enabled = codeus_get_option('home_effects_enabled');
	} else {
		global $post;
		if(is_object($post)) {
			$effects_enabled = get_post_meta($post->ID, 'codeus_effects_enabled', true);
		}
	}
	if($effects_enabled) {
		$body_classes[] = 'lazy-enabled';
	}
	if(is_home() && codeus_get_option('home_content_enabled')) {
		$body_classes[] = 'home-constructor';
	}
?>

<body <?php body_class($body_classes); ?>>
<script type="text/javascript">
	if(jQuery('body').hasClass('lazy-enabled') && jQuery(window).width() <= 800) {
		jQuery('body').removeClass('lazy-enabled')
	}
</script>
<div id="page" class="<?php echo $layout; ?>">
	<!-- wrap start --><div class="block-wrap">
		<div class="header-fixed-wrapper">
			<header id="header">
				<div class="central-wrapper">
					<div class="navigation clearfix logo-position-<?php echo codeus_get_option("logo_position"); ?>">
						<?php if(codeus_get_option("logo")) : ?>
								<h1 class="site-title logo">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
										<img src="<?php echo codeus_get_option("logo"); ?>" alt="<?php bloginfo( 'name' ); ?>">
										<img src="<?php echo codeus_get_option("small_logo"); ?>" alt="<?php bloginfo( 'name' ); ?>" class="header-fixed-logo" style="display: none;">
									</a>
								</h1>
						<?php endif; ?>

						<nav id="site-navigation">
							<a href="javascript:void(0);" class="menu-toggle dl-trigger"><?php _e('Menu', 'codeus'); ?></a>
							<?php if(has_nav_menu('primary')) { wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav-menu styled main_menu dl-menu', 'container' => false, 'walker' => new Codeus_Menu_Walker)); } ?>
						</nav><!-- #site-navigation -->
					</div>

				</div>
			</header>
		</div>
		<!-- #header -->
		
		<?php
			global $post;
			$slideshow_type = false;
			$slideshow_select = false;
			$slider_value = false;
			$title_background_image = get_template_directory_uri() . '/images/backgrounds/title/01.jpg';
			$title_background_color = false;
			$title_text_color = false;
			$title_excerpt_text_color = false;
			$excerpt = false;
			if(is_object($post) && is_singular()) {
				$slideshow_type = get_post_meta($post->ID, 'codeus_slideshow_type', TRUE) ? get_post_meta($post->ID, 'codeus_slideshow_type', TRUE) : 0;
				$slideshow_select = get_post_meta($post->ID, 'codeus_slideshow_select', TRUE) === '-' ? 0 : get_post_meta($post->ID, 'codeus_slideshow_select', TRUE);
				$slider_value = get_post_meta($post->ID, 'codeus_slider_value', TRUE) === '-' ? 0 : get_post_meta($post->ID, 'codeus_slider_value', TRUE);
				if($title_background_color = get_post_meta($post->ID, "codeus_title_background_color", true)) {
					$title_background_image = false;
				}
				$title_background_image = get_post_meta($post->ID, "codeus_title_background_image", true) ? get_post_meta($post->ID, "codeus_title_background_image", true) : $title_background_image;
				if($title_background_image && !$title_background_color) {
					$title_background_color = codeus_get_option('main_background_color');
				}
				$title_text_color = get_post_meta($post->ID, "codeus_title_text_color", true);
				$title_excerpt_text_color = get_post_meta($post->ID, "codeus_title_excerpt_text_color", true);
				$excerpt = apply_filters( 'the_excerpt', $post->post_excerpt );
			}
		?>
		<?php if (!is_home()): ?>
			<?php if(!$slideshow_type && $slideshow_select) : ?>
				<div class="block slideshow noscript">
					<?php codeus_slideshow($slideshow_select); ?>
				</div>
				<div class="loading"></div>
			<?php elseif($slideshow_type && $slider_value) : ?>
				<div class="block slideshow noscript">
					<?php echo do_shortcode('[layerslider id="'.$slider_value.'"]'); ?>
				</div>
				<div class="loading"></div>
			<?php endif; ?>
			<?php if(is_page() && basename(get_page_template()) == 'page_contact.php' && codeus_get_option('contacts_display_map')) : ?>
				<div class="block map"><iframe class="wrap-box-element" width="100%" height="<?php echo (int)codeus_get_option('contacts_map_height'); ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $lat = (float)codeus_get_option('contacts_map_latitude'); ?>,<?php echo $long = (float)codeus_get_option('contacts_map_longitude'); ?>&amp;ll=<?php echo $lat; ?>,<?php echo $long; ?>&amp;z=<?php echo (int)codeus_get_option('contacts_map_zoom') ?>&amp;output=embed"></iframe></div>
			<?php endif; ?>
			<?php if (!is_front_page()): ?>
				<div class="page-title-block" style="<?php if ($title_background_image): ?>background-image: url(<?php echo $title_background_image; ?>);<?php endif; ?> <?php if ($title_background_color): ?>background-color: <?php echo $title_background_color; ?>;<?php endif; ?>">
					<div class="central-wrapper page-title-block-content">
						<div class="page-title-block-header"><h1 style="<?php if ($title_text_color): ?>color: <?php echo $title_text_color; ?>;<?php endif; ?>"><?php codeus_title( '', true ); ?></h1></div>
						<?php if($excerpt && !(function_exists('is_product') && is_product())) : ?><div class="page-excerpt" style="<?php if ($title_excerpt_text_color): ?>color:<?php echo $title_excerpt_text_color; ?>;<?php endif; ?>"><?php echo $excerpt; ?></div><?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>