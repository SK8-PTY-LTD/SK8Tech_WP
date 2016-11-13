<?php

/* TRANSLATION */
load_theme_textdomain('codeus', get_template_directory().'/languages');

include (get_template_directory() . "/plugins/custom-menu/menu.class.php");
include (get_template_directory() . "/plugins/custom-menu/menu-walker.class.php");

// CONTENT WIDTH
if (!isset( $content_width )) $content_width = 1000;

// DEFAULT RSS FEED LINKS
add_theme_support('automatic-feed-links');

/* PREPARE THEME */
add_action( 'after_setup_theme', 'codeus_setup' );
function codeus_setup() {
	register_nav_menu( 'primary', __( 'Primary Menu', 'codeus' ) );
	register_nav_menu( 'footer_nav', __( 'Footer Menu', 'codeus' ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_image_size( 'codeus_portfolio1', 370, 210, true );
	add_image_size( 'codeus_gallery_full', 1170, 473, true );
	add_image_size( 'codeus_gallery_small', 835, 473, true );
	add_image_size( 'codeus_gallery_thumb', 165, 93, true );
	add_image_size( 'codeus_post_list', 72, 72, true );
	add_image_size( 'codeus_post_list_image', 1087, 410, true );
	add_image_size( 'codeus_post_image', 1087, 2000 );
	add_image_size( 'codeus_product', 575, 740, true );
	add_editor_style('css/editor-content.css');
	if(!get_option('codeus_theme_options')) {
		require_once (get_template_directory() . '/options.php');
		update_option('codeus_theme_options', codeus_first_install_settings());
	}
	update_option('layerslider-authorized-site', 1);
	$custom_menu = new Codeus_Menu();
}

/* MENU PREPARE */

/* Add a parent class for menu item */
add_filter( 'wp_nav_menu_objects', 'codeus_add_menu_parent_class' );
function codeus_add_menu_parent_class($items) {
	$parents = array();
	foreach($items as $item) {
		if($item->menu_item_parent && $item->menu_item_parent > 0) {
			$parents[] = $item->menu_item_parent;
		}
	}
	foreach($items as $item) {
		if(in_array($item->ID, $parents)) {
			$item->classes[] = 'menu-parent-item';
		}
	}
	return $items;
}

/* Codeus Scripts & Styles */
add_action( 'wp_enqueue_scripts', 'codues_scripts_styles', 15 );
function codues_scripts_styles() {
	wp_enqueue_script('jquery');

/* jQuery Menu */
	wp_enqueue_script('codeus-styled-cheboxes', get_template_directory_uri() . '/js/checkbox.js', array(), false, true);
	wp_enqueue_script('codeus-styled-radios', get_template_directory_uri() . '/js/jquery.radio.js', array(), false, true);
	wp_enqueue_script('codeus-site-scripts', get_template_directory_uri() . '/js/scripts.js', array(), false, true);
	wp_enqueue_script( 'codeus-modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array(), '1.0', true );
	wp_enqueue_script( 'codeus-dlmenu', get_template_directory_uri() . '/js/jquery.dlmenu.js', array(), '1.0', true );
	wp_enqueue_script( 'codeus-dropdown_menu', get_template_directory_uri() . '/js/drop-down-menu.js', array(), '1.0', true );

/* Comments */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

/* Lazy Loading */
	wp_enqueue_script('jquery-easing', get_template_directory_uri() . '/js/jquery.easing.js', array(), false, true);
	wp_enqueue_script('lazy-loading-script', get_template_directory_uri() . '/js/jquery.lazyLoading.js', array(), false, true);
	wp_enqueue_script('jquery-transform', get_template_directory_uri() . '/js/jquery.transform.js', array(), false, true);
	wp_enqueue_script('jquery-effects-drop');

/* FancyBox */
	wp_enqueue_script('mousewheel-script', get_template_directory_uri() . '/js/fancyBox/jquery.mousewheel.pack.js', array(), false, true);
	wp_enqueue_script('fancybox-script', get_template_directory_uri() . '/js/fancyBox/jquery.fancybox.pack.js', array(), false, true);
	wp_enqueue_script('fancybox-init-script', get_template_directory_uri() . '/js/fancyBox/jquery.fancybox-init.js', array(), false, true);
	wp_enqueue_style('fancybox-style', get_template_directory_uri() . '/js/fancyBox/jquery.fancybox.css');

/* Jquery scripts */
	wp_enqueue_script( 'jquery-touch-punch');
	wp_enqueue_script( 'jqueryui-elements', get_template_directory_uri() . '/js/jquery-ui/jquery-ui-init.js', array('jquery-ui-core','jquery-ui-widget','jquery-ui-position','jquery-ui-accordion','jquery-ui-tabs'), '1.0', true );

/* Carousel */
	wp_enqueue_script('carousel-script', get_template_directory_uri() . '/js/jquery.carouFredSel.js', array(), false, true);

/* Clients */
	wp_enqueue_script('clients-script', get_template_directory_uri() . '/js/clients.js', array(), false, true);

/* Diagram */
	wp_enqueue_script('diagram-line', get_template_directory_uri() . '/js/diagram_line.js', array(), false, true);
	wp_enqueue_script('raphael-js', get_template_directory_uri() . '/js/raphael.js', array(), false, true);
	wp_enqueue_script('diagram-circle', get_template_directory_uri() . '/js/diagram_circle.js', array(), false, true);

/* Gallery */
	wp_enqueue_script('gallery-script', get_template_directory_uri() . '/js/gallery.js', array(), false, true);

/* Portfolio */
	wp_enqueue_script('jura-slider-script', get_template_directory_uri() . '/js/jquery.juraSlider.js', array(), false, true);
	wp_enqueue_script('portfolio-script', get_template_directory_uri() . '/js/portfolio.js', array(), false, true);
	wp_enqueue_script('portfolio-mixitup', get_template_directory_uri() . '/js/jquery.mixitup.min.js', array(), false, true);


/* Quickfinder */
	wp_enqueue_script('quickfinder-shadow-script', get_template_directory_uri() . '/js/jquery.flatshadow.js', array(), false, true);
	wp_enqueue_script('quickfinder-script', get_template_directory_uri() . '/js/quickfinder.js', array(), false, true);

/* Styled Image */
	wp_enqueue_script('styled_image', get_template_directory_uri() . '/js/styled_image.js', array(), false, true);

/* Slideshow */
	wp_enqueue_style('nivo-slider-style', get_template_directory_uri() . '/plugins/slideshow/nivo-slider/nivo-slider.css');
	wp_enqueue_script('nivo-slider-script', get_template_directory_uri() . '/plugins/slideshow/nivo-slider/jquery.nivo.slider.pack.js', array('jquery'));

/* Team & testimonials */
	wp_enqueue_script('testimonials-script', get_template_directory_uri() . '/js/testimonials.js', array(), false, true);

	wp_enqueue_style('codeus-jquery-ui-style', get_template_directory_uri(). '/js/jquery-ui/jquery-ui.css');
	wp_enqueue_style('codeus-fonts-icons', get_template_directory_uri(). '/fonts/icons.css');
	wp_enqueue_style('codeus-styles', get_stylesheet_uri());
	wp_enqueue_style('codeus-editor-content-style', get_template_directory_uri(). '/css/editor-content.css');
	wp_enqueue_script('codeus-loading-script', get_template_directory_uri() . '/js/loading.js', array(), false, true);
	wp_enqueue_style( 'codeus-ie', get_template_directory_uri() . '/css/ie.css' );
	wp_style_add_data( 'codeus-ie', 'conditional', 'lt IE 9' );
	
	wp_enqueue_style( 'codeus-ie9', get_template_directory_uri() . '/css/ie9.css' );
	wp_style_add_data( 'codeus-ie9', 'conditional', 'lt IE 10' );

	wp_enqueue_script('codeus-combobox', get_template_directory_uri() . '/js/combobox-front.js');

	/* Woocommerce */
	require_once(ABSPATH . 'wp-admin/includes/plugin.php');
	if(is_plugin_active('woocommerce/woocommerce.php')) {
		wp_enqueue_style('codeus-woocommerce-style', get_template_directory_uri(). '/css/woocommerce/woocommerce.css');
		wp_enqueue_style('codeus-woocommerce1-style', get_template_directory_uri(). '/css/woocommerce/woocommerce1.css');
	}

	/* JS Composer */
	require_once(ABSPATH . 'wp-admin/includes/plugin.php');
	if(is_plugin_active('js_composer/js_composer.php')) {
		wp_enqueue_style('codeus-js-composer', get_template_directory_uri(). '/css/js_composer.css');
	}
}


add_action( 'init', 'codeus_add_excerpts_to_pages' );
function codeus_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}

/* SIDEBAR */

add_action( 'widgets_init', 'codeus_widgets_init' );
function codeus_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'codeus' ),
		'id' => 'sidebar',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'codeus' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Blog Post Sidebar', 'codeus' ),
		'id' => 'blog_sidebar',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'codeus' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer', 'codeus' ),
		'id' => 'footer_sidebar',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'codeus' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Woocommerce', 'codeus' ),
		'id' => 'shop',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'codeus' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Woocommerce Bottom', 'codeus' ),
		'id' => 'shop_bottom',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'codeus' ),
		'before_widget' => '<section id="%1$s" class="widget one_fourth %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

/* THEME OPTIONS */

/* Create admin theme page */
add_action( 'admin_menu', 'codeus_theme_add_page');
function codeus_theme_add_page() {
	$page = add_theme_page(__('Theme options',"codeus"), __('Theme options',"codeus"), 'edit_theme_options', 'options-framework', 'codeus_theme_options_page');
	add_action('load-' . $page, 'codeus_theme_page_prepend');
}

/* Admin theme page scripts & css*/
function codeus_theme_page_prepend() {
	global $wp_scripts;
	require_once (get_template_directory() . '/options.php');
	wp_enqueue_script('jquery-ui-position');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-draggable');
	wp_enqueue_script('jquery-ui-droppable');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_media();
	wp_enqueue_script('combobox', get_template_directory_uri() . '/js/combobox.js');
	wp_enqueue_script('checkbox', get_template_directory_uri() . '/js/checkbox.js');
	wp_enqueue_script('image-selector', get_template_directory_uri() . '/js/image-selector.js');
	wp_enqueue_script('file-selector', get_template_directory_uri() . '/js/file-selector.js');
	wp_enqueue_script('font-options', get_template_directory_uri() . '/js/font-options.js');
	wp_enqueue_script('theme-options', get_template_directory_uri() . '/js/theme_options.js');
	wp_localize_script('theme-options', 'theme_options_object',array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'security' => wp_create_nonce('ajax_security'),
		'text1' => __('Get all from font.', 'codeus'),
		'codeus_color_skin_defaults' => json_encode(codeus_color_skin_defaults()),
		'text2' => __('et colors, backgrounds and fonts options to default?', 'codeus'),
		'text3' => __('Update backup data?', 'codeus'),
		'text4' => __('Restore settings from backup data?', 'codeus'),
		'text5' => __('Import settings?', 'codeus'),
	));
}

/* Build admin theme page form */
function codeus_theme_options_page(){
	$jQuery_ui_theme = 'ui-no-theme';
	require_once (get_template_directory() . '/options.php');
	$options = codeus_get_theme_options();
	$options_values = get_option('codeus_theme_options');
?>
<div class="wrap">
	<div class="theme-title">
		<img class="right-part" src="<?php echo get_template_directory_uri(); ?>/css/admin-images/theme-options-title-right.png" alt="Codex Tuner" />
		<img class="left-part" src="<?php echo get_template_directory_uri(); ?>/css/admin-images/theme-options-title-left.png" alt="Theme Options. Codeus Business." />
		<div style="clear: both;"></div>
	</div>
	<form id="theme-options-form" method="POST">
		<div class="option-wrap <?php echo $jQuery_ui_theme; ?>">
			<div class="submit_buttons"><button name="action" value="save"><?php _e( 'Save Changes', 'codeus' ); ?></button></div>
			<div id="categories">

				<?php if(count($options) > 0) : ?>
					<ul class="styled">
						<?php foreach($options as $name => $category) : ?>
							<?php if(isset($category['subcats']) && count($category['subcats']) > 0) : ?>
								<li><a href="#<?php echo $name; ?>" style="background-image: url('<?php echo get_template_directory_uri(); ?>/css/admin-images/<?php print $name; ?>_icon.png');"><?php print $category['title']; ?></a></li>
							<?php endif; ?>
						<?php endforeach; ?>
						<li><a href="#backup" style="background-image: url('<?php echo get_template_directory_uri(); ?>/css/admin-images/backup_icon.png');"><?php _e('Backup', 'codeus'); ?></a></li>
					</ul>
				<?php endif; ?>

				<?php if(count($options) > 0) : ?>
					<?php foreach($options as $name => $category) : ?>
						<?php if(isset($category['subcats']) && count($category['subcats']) > 0) : ?>
							<div id="<?php echo $name; ?>">
								<div class="subcategories">

									<?php foreach($category['subcats'] as $sname => $subcat) : ?>
										<div id="<?php echo $sname; ?>">
											<h3><?php echo $subcat['title']; ?></h3>
											<div class="inside">
												<?php foreach($subcat['options'] as $oname => $option) : ?>
													<?php echo codeus_get_option_element($oname, $option, isset($options_values[$oname]) ? $options_values[$oname] : NULL); ?>
												<?php endforeach; ?>
											</div>
										</div>
									<?php endforeach; ?>

								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>

					<div id="backup">
						<div class="subcategories">

								<div id="backup_theme_options">
									<h3><?php _e('Backup and Restore Theme Settings', 'codeus'); ?></h3>
									<div class="inside">
										<div class="option backup_restore_settings">
											<p><?php _e('If you would like to experiment with the settings of your theme and don\'t want to loose your previous settings, use the "Backup Settings"-button to backup your current theme options. You can restore these options later using the button "Restore Settings".', 'codeus'); ?></p>
											<?php if($backup = get_option('codeus_theme_options_backup')) : ?>
												<p><b><?php _e('Last backup', 'codeus'); ?>: <?php echo date('Y-m-d H:i', $backup['date']) ?></b></p>
											<?php else : ?>
												<p><b><?php _e('Last backup', 'codeus'); ?>: <?php _e('No backups yet', 'codeus'); ?></b></p>
											<?php endif; ?>
											<div class="backups-buttons">
												<button name="action" value="backup"><?php _e( 'Backup Settings', 'codeus' ); ?></button>
												<button name="action" value="restore"><?php _e( 'Restore Settings', 'codeus' ); ?></button>
											</div>
										</div>
										<div class="option import_settings">
											<p><?php _e('In order to apply the settings of another Codeus theme used in a different install just copy and paste the settings in the text box and click on "Import Settings".', 'codeus'); ?></p>
											<div class="textarea">
												<textarea name="import_settings" cols="100" rows="8"><?php if($settings = get_option('codeus_theme_options')) { echo base64_encode(serialize($settings)); } ?></textarea>
											</div>
											<p>&nbsp;</p>
											<div class="backups-buttons">
												<button name="action" value="import"><?php _e( 'Import Settings', 'codeus' ); ?></button>
											</div>
										</div>
									</div>
								</div>

						</div>
					</div>

				<?php endif; ?>

			</div>
			<div class="submit_buttons"><button name="action" value="reset"><?php _e( 'Reset Style Settings', 'codeus' ); ?></button><button name="action" value="save"><?php _e( 'Save Changes', 'codeus' ); ?></button></div>
		</div>
	</form>
</div>
<?php
}

add_action('admin_init', 'codeus_admin_init');
function codeus_admin_init() {
	add_filter('tiny_mce_before_init', 'codeus_init_editor');
	add_filter('mce_buttons_2', 'codeus_mce_buttons_2');
}

function codeus_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

function codeus_init_editor($settings) {
	$style_formats = array(
		array(
			'title' => 'Styled Subtitle',
			'inline' => 'span',
			'classes' => 'styled-subtitle'
		),
	);
	$settings['style_formats'] = json_encode($style_formats);
	return $settings;
}

/* Update theme options */
add_action('admin_menu', 'codeus_theme_update_options');
function codeus_theme_update_options() {
	if(isset($_GET['page']) && $_GET['page'] == 'options-framework') {
		if(isset($_REQUEST['action']) && isset($_REQUEST['theme_options'])) {
			if($_REQUEST['action'] == 'save') {
				$theme_options = $_REQUEST['theme_options'];
				if(defined('ICL_LANGUAGE_CODE')) {
					$ml_options = array('home_content', 'footer_html', 'contacts_title', 'contacts_html', 'follow_title', 'follow_us_text');
					foreach ($ml_options as $ml_option) {
						$value = codeus_get_option($ml_option, true);
						if(!is_array($value)) {
							global $sitepress;
							if($sitepress->get_default_language()) {
								$value = array($sitepress->get_default_language() => $value);
							}
						}
						$value[ICL_LANGUAGE_CODE] = $theme_options[$ml_option];
						$theme_options[$ml_option] = $value;
					}
				}
				update_option('codeus_theme_options', $theme_options);
			} elseif($_REQUEST['action'] == 'reset') {
				if($options = get_option('codeus_theme_options')) {
					require_once (get_template_directory() . '/options.php');
					$defaults = codeus_color_skin_defaults();
					if(!($skin = codeus_get_option('page_color_style'))) {
						$skin = 'light';
					}
					$newOptions = array();
					foreach($defaults as $key => $val) {
						$newOptions[$key] = $val[$skin];
					}
					$options = array_merge($options, $newOptions);
					update_option('codeus_theme_options', $options);
				}
				
			} elseif($_REQUEST['action'] == 'backup') {
				if($settings = get_option('codeus_theme_options')) {
					update_option('codeus_theme_options_backup', array('date' => time(), 'settings' => base64_encode(serialize($settings))));
				}
			} elseif($_REQUEST['action'] == 'restore') {
				if($settings = get_option('codeus_theme_options_backup')) {
					update_option('codeus_theme_options', unserialize(base64_decode($settings['settings'])));
				}
			} elseif($_REQUEST['action'] == 'import') {
				update_option('codeus_theme_options', unserialize(base64_decode($_REQUEST['import_settings'])));
			}
			wp_redirect(admin_url('themes.php?page=options-framework'));
		}
	}
}

/* Get theme option*/
function codeus_get_option($name, $ml_full = false) {
	$options = get_option('codeus_theme_options');
	if(isset($options[$name])) {
		$ml_options = array('home_content', 'footer_html', 'contacts_title', 'contacts_html', 'follow_title', 'follow_us_text');
		if(in_array($name, $ml_options) && is_array($options[$name]) && !$ml_full) {
			if(defined('ICL_LANGUAGE_CODE')) {
				global $sitepress;
				if(isset($options[$name][ICL_LANGUAGE_CODE])) {
					$options[$name] = $options[$name][ICL_LANGUAGE_CODE];
				} elseif($sitepress->get_default_language() && isset($options[$name][$sitepress->get_default_language()])) {
					$options[$name] = $options[$name][$sitepress->get_default_language()];
				} else {
					$options[$name] = '';
				}
			}else {
				$options[$name] = reset($options[$name]);
			}
		}
		return $options[$name];
	}
	return FALSE;
}

/* FONTS MANAGER */

add_filter('upload_mimes', 'codeus_fonts_allowed_mime_types');
function codeus_fonts_allowed_mime_types( $existing_mimes = array() ) {
	$existing_mimes['ttf'] = 'font/ttf';
	$existing_mimes['eot'] = 'font/eot';
	$existing_mimes['woff'] = 'font/woff';
	$existing_mimes['svg'] = 'font/svg';
	$existing_mimes['json'] = 'application/json';
	return $existing_mimes;

}

/* Create fonts manager page */
add_action( 'admin_menu', 'codeus_fonts_manager_add_page');
function codeus_fonts_manager_add_page() {
	$page = add_theme_page(__('Fonts Manager',"codeus"), __('Fonts Manager',"codeus"), 'edit_theme_options', 'fonts-manager', 'codeus_fonts_manager_page');
	add_action('load-' . $page, 'codeus_fonts_manager_page_prepend');
}

/* Admin theme page scripts & css*/
function codeus_fonts_manager_page_prepend() {
	global $wp_scripts;
	wp_enqueue_script('file-selector', get_template_directory_uri() . '/js/file-selector.js');
	wp_enqueue_script('font-manager', get_template_directory_uri() . '/js/font-manager.js');
}

/* Build admin theme page form */
function codeus_fonts_manager_page(){
	$additionals_fonts = get_option('codeus_additionals_fonts');
?>
<div class="wrap">

	<h2><?php _e('Font Manager', 'codeus'); ?></h2>

	<form id="fonts-manager-form" method="POST" enctype="multipart/form-data">
		<div class="font-pane empty" style="display: none;">
			<div class="remove"><a href="javascript:void(0);"><?php _e('Remove', 'codeus'); ?></a></div>
			<div class="field">
				<div class="label"><label for=""><?php _e('Font name', 'codeus'); ?></label></div>
				<div class="input"><input type="text" name="fonts[font_name][]" value="" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php _e('Font file EOT url', 'codeus'); ?></label></div>
				<div class="file_url"><input type="text" name="fonts[font_url_eot][]" value="" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php _e('Font file SVG url', 'codeus'); ?></label></div>
				<div class="file_url"><input type="text" name="fonts[font_url_svg][]" value="" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php _e('ID inside SVG', 'codeus'); ?></label></div>
				<div class="input"><input type="text" name="fonts[font_svg_id][]" value="" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php _e('Font file TTF url', 'codeus'); ?></label></div>
				<div class="file_url"><input type="text" name="fonts[font_url_ttf][]" value="" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php _e('Font file WOFF url', 'codeus'); ?></label></div>
				<div class="file_url"><input type="text" name="fonts[font_url_woff][]" value="" /></div>
			</div>
		</div>
		<?php if(is_array($additionals_fonts)) : ?>
			<?php foreach($additionals_fonts as $additionals_font) : ?>
				<div class="font-pane">
					<div class="remove"><a href="javascript:void(0);"><?php _e('Remove', 'codeus'); ?></a></div>
					<div class="field">
						<div class="label"><label for=""><?php _e('Font name', 'codeus'); ?></label></div>
						<div class="input"><input type="text" name="fonts[font_name][]" value="<?php echo $additionals_font['font_name']; ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php _e('Font file EOT url', 'codeus'); ?></label></div>
						<div class="file_url"><input type="text" name="fonts[font_url_eot][]" value="<?php echo $additionals_font['font_url_eot']; ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php _e('Font file SVG url', 'codeus'); ?></label></div>
						<div class="file_url"><input type="text" name="fonts[font_url_svg][]" value="<?php echo $additionals_font['font_url_svg']; ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php _e('ID inside SVG', 'codeus'); ?></label></div>
						<div class="input"><input type="text" name="fonts[font_svg_id][]" value="<?php echo $additionals_font['font_svg_id']; ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php _e('Font file TTF url', 'codeus'); ?></label></div>
						<div class="file_url"><input type="text" name="fonts[font_url_ttf][]" value="<?php echo $additionals_font['font_url_ttf']; ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php _e('Font file WOFF url', 'codeus'); ?></label></div>
						<div class="file_url"><input type="text" name="fonts[font_url_woff][]" value="<?php echo $additionals_font['font_url_woff']; ?>" /></div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		<div class="add-new"><a href="javascript:void(0);"><?php _e('+ Add new', 'codeus'); ?></a></div>
		<div class="submit"><button name="action" value="save"><?php _e('Save', 'codeus'); ?></button></div>
	</form>
</div>

<?php
}

/* Update fonts manager */
add_action('admin_menu', 'codeus_fonts_manager_update');
function codeus_fonts_manager_update() {
	if(isset($_GET['page']) && $_GET['page'] == 'fonts-manager') {
		if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'save') {
			if(isset($_REQUEST['fonts']) && is_array($_REQUEST['fonts'])) {
				$fonts = array();
				foreach($_REQUEST['fonts'] as $font_param => $list) {
					foreach($list as $key => $item) {
						$fonts[$key][$font_param] = $_REQUEST['fonts'][$font_param][$key];
					}
				}
				foreach($fonts as $key => $font) {
					if(!$font['font_name']) {
						unset($fonts[$key]);
					}
				}
				update_option('codeus_additionals_fonts', $fonts);
			}
			wp_redirect(admin_url('themes.php?page=fonts-manager'));
		}
	}
}

/* ADMIN SCRIPTS */

add_action( 'admin_enqueue_scripts', 'codeus_admin_scripts_init');
function codeus_admin_scripts_init() {
	$jQuery_ui_theme = 'ui-no-theme';
	wp_enqueue_script('jquery');
	wp_enqueue_style('jquery-ui-theme', get_template_directory_uri() . '/css/jquery-ui/' . $jQuery_ui_theme . '/jquery-ui.css');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_script('media-upload');
	wp_enqueue_style('admin-styles', get_template_directory_uri() . '/css/admin.css');
	wp_enqueue_script('color-picker', get_template_directory_uri() . '/js/colorpicker/js/colorpicker.js');
	wp_enqueue_style('color-picker', get_template_directory_uri() . '/js/colorpicker/css/colorpicker.css');
	wp_enqueue_script('picture-select', get_template_directory_uri() . '/js/data-select.js');
	wp_enqueue_script('page_settings-script', get_template_directory_uri() . '/js/page_meta_box_settings.js');
	wp_enqueue_script('scalia_js_composer_js_custom_views', get_template_directory_uri() . '/js/codeus-composer-custom-views.js', array( 'wpb_js_composer_js_view' ), '', true );
}

add_action( 'admin_head', 'codeus_admin_head');
function codeus_admin_head() {
	wp_enqueue_script('js_composer-script', get_template_directory_uri() . '/js/js_composer.js', array(), '', TRUE);
}


/* PAGE OPTIONS */

/* Additional page options */
add_action('add_meta_boxes', 'codeus_add_page_settings_boxes');
function codeus_add_page_settings_boxes() {
	add_meta_box( 'codeus_page_title', __('Page Title', 'codeus'), 'codeus_page_title_settings_box', 'page', 'normal', 'high' );
	add_meta_box( 'codeus_page_effects', __('Lazy Loading Options', 'codeus'), 'codeus_page_effects_settings_box', 'page', 'normal', 'high' );
	add_meta_box( 'codeus_page_slideshow', __('Page Slideshow', 'codeus'), 'codeus_page_slideshow_settings_box', 'page', 'normal', 'high' );
	add_meta_box( 'codeus_page_quickfinder', __('Page Quickfinder', 'codeus'), 'codeus_page_quickfinder_settings_box', 'page', 'normal', 'high' );
	add_meta_box( 'codeus_page_portfolio', __('Page Portfolio', 'codeus'), 'codeus_page_portfolio_settings_box', 'page', 'normal', 'high' );
	add_meta_box( 'codeus_page_gallery', __('Page Gallery', 'codeus'), 'codeus_page_gallery_settings_box', 'page', 'normal', 'high' );
	add_meta_box( 'codeus_portfolios_title', __('Page Title', 'codeus'), 'codeus_page_title_settings_box', 'codeus_portfolios', 'normal', 'high' );
	add_meta_box( 'codeus_portfolios_effects', __('Lazy Loading Options', 'codeus'), 'codeus_page_effects_settings_box', 'codeus_portfolios', 'normal', 'high' );
	add_meta_box( 'codeus_portfolios_slideshow', __('Slideshow', 'codeus'), 'codeus_page_slideshow_settings_box', 'codeus_portfolios', 'normal', 'high' );
	add_meta_box( 'codeus_portfolios_quickfinder', __('Quickfinder', 'codeus'), 'codeus_page_quickfinder_settings_box', 'codeus_portfolios', 'normal', 'high' );
	add_meta_box( 'codeus_portfolios_portfolio', __('Additional Portfolio Sets', 'codeus'), 'codeus_page_portfolio_settings_box', 'codeus_portfolios', 'normal', 'high' );
	add_meta_box( 'codeus_portfolios_gallery', __('Gallery', 'codeus'), 'codeus_page_gallery_settings_box', 'codeus_portfolios', 'normal', 'high' );
}

/* Slideshow box */
function codeus_page_slideshow_settings_box() {
	global $post;
	$slideshow_terms = get_terms( 'codeus_slideshow', array('hide_empty' => false) );
	$slideshow_value = get_post_meta($post->ID, "codeus_slideshow_select", true);
	$slideshow_type = get_post_meta($post->ID, "codeus_slideshow_type", true);
	$slider_value = get_post_meta($post->ID, "codeus_slider_value", true);
	global $wpdb;
	$table_name = $wpdb->prefix . "layerslider";
	$sliders = $wpdb->get_results( "SELECT * FROM $table_name
										WHERE flag_hidden = '0' AND flag_deleted = '0'
										ORDER BY id ASC" );
?>
<table class="settings-box-table"><tbody><tr>
	<td>
		<label for="slideshow_type"><b><?php _e( 'Slideshow Type', 'codeus' ); ?>:</b></label>
		<select name="codeus_slideshow_type" id="slideshow_type">
			<option value="0"<?php echo ($slideshow_type ? '' : ' selected') ?>><?php _e( 'NivoSlider', 'codeus' ); ?></option>
			<option value="1"<?php echo ($slideshow_type ? ' selected' : '') ?>><?php _e( 'LayerSlider', 'codeus' ); ?></option>
		</select><br />&nbsp;<br />
		<div class="slideshow-select<?php echo ($slideshow_type ? ' hidden' : '' ); ?>">
			<?php if(count($slideshow_terms) > 0) : ?>
				<label for="slideshow_select"><b><?php _e( 'Select Slideshow', 'codeus' ); ?>:</b></label>
				<select name="codeus_slideshow_select" id="slideshow_select">
					<option value="-"><?php _e( 'None', 'codeus' ); ?></option>
					<option value=""><?php _e( 'All Slides', 'codeus' ); ?></option>
					<?php foreach($slideshow_terms as $slideshow_term) : ?>
						<option value="<?php echo $slideshow_term->slug; ?>"<?php if($slideshow_term->slug == $slideshow_value) { echo ' selected'; } ?>><?php echo $slideshow_term->name; ?></option>
					<?php endforeach; ?>
				</select>
			<?php else : ?>
				<p><?php _e( 'No slideshows found.', 'codeus' ); ?></p>
			<?php endif; ?>
		</div>
		<div class="slideshow-select<?php echo ($slideshow_type ? '' : ' hidden' ); ?>">
			<?php if(count($sliders) > 0) : ?>
				<label for="slider_value"><b><?php _e( 'Select Slideshow', 'codeus' ); ?>:</b></label>
				<select name="codeus_slider_value" id="slider_value">
					<option value="-"><?php _e( 'None', 'codeus' ); ?></option>
					<?php foreach($sliders as $slider) : ?>
						<option value="<?php echo $slider->id; ?>"<?php if($slider->id == $slider_value) { echo ' selected'; } ?>><?php echo (empty($slider->name) ? 'Unnamed' : $slider->name); ?></option>
					<?php endforeach; ?>
				</select>
			<?php else : ?>
				<p><?php _e( 'No slideshows found.', 'codeus' ); ?></p>
			<?php endif; ?>
		</div>
	</td>
</tr></tbody></table>
<script type="text/javascript">
	(function($) {
		$(function() {
			$('#slideshow_type').change(function() {
				$('.slideshow-select').addClass('hidden');
				$('.slideshow-select').eq($(this).val()).removeClass('hidden');
			}).trigger('change');
		});
	})(jQuery)
</script>
<?php
}

/* Quickfinder box */
function codeus_page_quickfinder_settings_box() {
	global $post;
	$quickfinder_terms = get_terms( 'codeus_quickfindersets', array('hide_empty' => false) );
	$quickfinder_terms_count = count($quickfinder_terms);
	$quickfinder_value = get_post_meta($post->ID, "codeus_quickfinder_select", true);
	$quickfinder_position = get_post_meta($post->ID, "codeus_quickfinder_position", true);
	$quickfinder_positions = array(0 => __('None', 'codeus'), 1 => __('Quickfinder bar above', 'codeus'), 2 => __('Inside content', 'codeus'), 3 => __('Quickfinder bar below', 'codeus'));
?>
<table class="settings-box-table"><tbody><tr>
	<td>
		<label for="quickfinder_position"><b><?php _e( 'Quickfinder position', 'codeus' ); ?>:</b></label>
		<select name="codeus_quickfinder_position" id="quickfinder_position">
			<?php foreach($quickfinder_positions as $key => $quickfinder_pos) : ?>
				<option value="<?php echo $key; ?>"<?php if($key == $quickfinder_position) { echo ' selected'; } ?>><?php echo $quickfinder_pos; ?></option>
			<?php endforeach; ?>
		</select>
	</td>
	<td>
		<?php if($quickfinder_terms_count > 0) : ?>
			<label for="quickfinder_select"><b><?php _e( 'Select Quickfinder', 'codeus' ); ?>:</b></label>
			<select name="codeus_quickfinder_select" id="quickfinder_select">
				<option value="">All Items</option>
				<?php foreach($quickfinder_terms as $quickfinder_term) : ?>
					<option value="<?php echo $quickfinder_term->slug; ?>"<?php if($quickfinder_term->slug == $quickfinder_value) { echo ' selected'; } ?>><?php echo $quickfinder_term->name; ?></option>
				<?php endforeach; ?>
			</select>
		<?php endif; ?>
	</td>
</tr></tbody></table>
<?php
}

/* Portfolio box */
function codeus_page_portfolio_settings_box() {
	global $post;
	$portfolio_terms = get_terms( 'codeus_portfoliosets', array('hide_empty' => false) );
	$portfolio_terms_count = count($portfolio_terms);
	$portfolio_value = get_post_meta($post->ID, "codeus_portfolio_select", true);
	$portfolio_position = get_post_meta($post->ID, "codeus_portfolio_position", true);
	$portfolio_positions = array(0 => __('None', 'codeus'), 1 => __('Slider-bar above', 'codeus'), 2 => __('Inside content', 'codeus'), 3 => __('Slider-bar below', 'codeus'));
	$portfolio_size = get_post_meta($post->ID, "codeus_portfolio_size", true);
	$portfolio_sizes = array('small' => __('Small Thumbs (222 x 177)', 'codeus'), 'medium' => __('Medium Thumbs (302 x 207)', 'codeus'), 'big' => __('Big Thumbs (464 x 306)', 'codeus'), 'list' => __('One column list', 'codeus'));
	$portfolio_count = get_post_meta($post->ID, "codeus_portfolio_count", true);
	$portfolio_filter = get_post_meta($post->ID, "codeus_portfolio_filter", true);
	$portfolio_title = get_post_meta($post->ID, "codeus_portfolio_title", true);
?>
<table class="settings-box-table"><tbody><tr>
	<td>
		<label for="portfolio_position"><b><?php _e( 'Portfolio position', 'codeus' ); ?>:</b></label>
		<select name="codeus_portfolio_position" id="portfolio_position">
			<?php foreach($portfolio_positions as $key => $portfolio_pos) : ?>
				<option value="<?php echo $key; ?>"<?php if($key == $portfolio_position) { echo ' selected'; } ?>><?php echo $portfolio_pos; ?></option>
			<?php endforeach; ?>
		</select><br />&nbsp;<br />
		<label for="portfolio_size"><b><?php _e( 'Thumbnail size', 'codeus' ); ?></b>:</label>
		<select name="codeus_portfolio_size" id="portfolio_size">
			<?php foreach($portfolio_sizes as $key => $portfolio_siz) : ?>
				<option value="<?php echo $key; ?>"<?php if($key == $portfolio_size) { echo ' selected'; } ?>><?php echo $portfolio_siz; ?></option>
			<?php endforeach; ?>
		</select><br />&nbsp;<br />
		<label for="portfolio_count"><b><?php _e( 'Items per page', 'codeus' ); ?>:</b></label>
		<input name="codeus_portfolio_count" id="portfolio_count" value="<?php echo $portfolio_count; ?>"/><br />&nbsp;<br />
		<label for="portfolio_title"><b><?php _e( 'Title', 'codeus' ); ?>:</b></label>
		<input name="codeus_portfolio_title" id="portfolio_title" value="<?php echo $portfolio_title; ?>"/>
	</td>
	<td>
		<?php if($portfolio_terms_count > 0) : ?>
			<label for="portfolio_select"><b><?php _e( 'Select Portfolios', 'codeus' ) ?>:</b></label><br />
			<label for="portfolio_select-all" class="selecttit"><input name="codeus_portfolio_select-all" type="checkbox" id="portfolio_select-all" value="1" /><?php _e( 'Select all', 'codeus' ); ?></label><br />
			<?php foreach($portfolio_terms as $portfolio_term) : ?>
				<label for="portfolio_select-<?php echo $portfolio_term->slug; ?>" class="selecttit"><input name="codeus_portfolio_select[]" type="checkbox" id="portfolio_select-<?php echo $portfolio_term->slug; ?>" value="<?php echo $portfolio_term->slug; ?>" <?php checked(is_array($portfolio_value) && in_array($portfolio_term->slug, $portfolio_value)); ?> /> <?php echo $portfolio_term->name; ?></label><br />
			<?php endforeach; ?>
			&nbsp;<br />
			<label for="portfolio_filter" class="selecttit"><input name="codeus_portfolio_filter" type="checkbox" id="portfolio_filter" value="1" <?php checked($portfolio_filter, '1'); ?> /> <b><?php _e( 'Activate Filter', 'codeus' ); ?></b></label>
		<?php endif; ?>
	</td>
</tr></tbody></table>
<?php
}

function codeus_page_gallery_settings_box() {
	global $post;
	$gallery_items = get_posts(array('post_type' => 'codeus_gallery', 'posts_per_page' => -1, 'suppress_filters' => false));
	$gallery_items_count = count($gallery_items);
	$gallery_value = get_post_meta($post->ID, "codeus_gallery_select", true);
	$gallery_position = get_post_meta($post->ID, "codeus_gallery_position", true);
	$gallery_positions = array(0 => __('None', 'codeus'), 1 => __('Gallery above', 'codeus'), 3 => __('Gallery below', 'codeus'));
	$gallery_size = get_post_meta($post->ID, "codeus_gallery_size", true);
	$gallery_sizes = array(0 => __('For Full-Width Pages', 'codeus'), 1 => __('For Sidebar Pages', 'codeus'), 2 => __('Small Thumbs', 'codeus'), 3 => __('Medium Thumbs', 'codeus'));
	$gallery_style = get_post_meta($post->ID, "codeus_gallery_style", true);
	$gallery_styles = array(
		'no-style' => __('without border', 'codeus'),
		'style-1' => __('1px no margin', 'codeus'),
		'style-2' => __('dark gray', 'codeus'),
		'style-3' => __('light gray', 'codeus'),
		'style-4' => __('shadow', 'codeus'),
		'style-5' => __('shadowed border', 'codeus'),
		'style-6' => __('1px with margin', 'codeus')
	);

?>
<table class="settings-box-table"><tbody><tr>
	<td>
		<label for="gallery_position"><b><?php _e( 'Gallery position', 'codeus' ); ?>:</b></label>
		<select name="codeus_gallery_position" id="gallery_position">
			<?php foreach($gallery_positions as $key => $gallery_pos) : ?>
				<option value="<?php echo $key; ?>"<?php if($key == $gallery_position) { echo ' selected'; } ?>><?php echo $gallery_pos; ?></option>
			<?php endforeach; ?>
		</select><br />&nbsp;<br />
		<label for="gallery_size"><b><?php _e( 'Gallery type', 'codeus' ); ?>:</b></label>
		<select name="codeus_gallery_size" id="gallery_size">
			<?php foreach($gallery_sizes as $key => $gallery_siz) : ?>
				<option value="<?php echo $key; ?>"<?php if($key == $gallery_size) { echo ' selected'; } ?>><?php echo $gallery_siz; ?></option>
			<?php endforeach; ?>
		</select>
	</td>
	<td>
		<?php if($gallery_items_count > 0) : ?>
			<label for="gallery_select"><b><?php _e( 'Select Gallery', 'codeus' ); ?>:</b></label>
			<select name="codeus_gallery_select" id="gallery_select">
				<?php foreach($gallery_items as $gallery_item) : ?>
					<option value="<?php echo $gallery_item->ID; ?>"<?php if($gallery_item->ID == $gallery_value) { echo ' selected'; } ?>><?php echo $gallery_item->post_title; ?></option>
				<?php endforeach; ?>
			</select><br />&nbsp;<br />
		<?php endif; ?>
		<label for="gallery_style"><b><?php _e( 'Select Style', 'codeus' ); ?>:</b></label>
		<select name="codeus_gallery_style" id="gallery_style">
			<?php foreach($gallery_styles as $key => $gallery_st) : ?>
				<option value="<?php echo $key; ?>"<?php if($key == $gallery_style) { echo ' selected'; } ?>><?php echo $gallery_st; ?></option>
			<?php endforeach; ?>
		</select>
	</td>
</tr></tbody></table>
<?php
}

function codeus_page_title_settings_box() {
	global $post;
	$title_background_image = get_post_meta($post->ID, "codeus_title_background_image", true);
	$title_background_color = get_post_meta($post->ID, "codeus_title_background_color", true);
	$title_text_color = get_post_meta($post->ID, "codeus_title_text_color", true);
	$title_excerpt_text_color = get_post_meta($post->ID, "codeus_title_excerpt_text_color", true);
	$title_background_image_items = array('01.jpg', '02.jpg', '03.jpg', '04.jpg', '05.jpg', '06.jpg', '07.jpg', '08.jpg', '09.jpg', '10.jpg', '11.jpg', '12.jpg');
?>
	<label for="title_background_image"><b><?php _e('Background Image', 'codeus'); ?>:</b></label>
	<input name="codeus_title_background_image" id="title_background_image" value="<?php echo $title_background_image; ?>" class="picture-select" />
	<span id="title_background_image_select">
		<?php foreach($title_background_image_items as $item) : ?>
			<a href="<?php echo get_template_directory_uri() . '/images/backgrounds/title/' . $item; ?>" style="background-image: url('<?php echo get_template_directory_uri() . '/images/backgrounds/title/' . $item; ?>')"></a>
		<?php endforeach; ?>
	</span>
	<label for="title_background_color"><b><?php _e('Background Color', 'codeus'); ?>:</b></label>
	<input name="codeus_title_background_color" id="title_background_color" value="<?php echo $title_background_color; ?>" class="color-select" /><br />&nbsp;<br />
	<label for="title_text_color"><b><?php _e('Main Text Color', 'codeus'); ?>:</b></label>
	<input name="codeus_title_text_color" id="title_text_color" value="<?php echo $title_text_color; ?>" class="color-select" /><br />&nbsp;<br />
	<label for="title_excerpt_text_color"><b><?php _e('Excerpt Color', 'codeus'); ?>:</b></label>
	<input name="codeus_title_excerpt_text_color" id="title_excerpt_text_color" value="<?php echo $title_excerpt_text_color; ?>" class="color-select" />
<script type="text/javascript">
(function($) {
	$(function() {
		$('#title_background_image_select a[href="'+$('#title_background_image').val()+'"]').addClass('active');
		$('#title_background_image_select a').click(function(e) {
			$('#title_background_image_select a.active').removeClass('active');
			e.preventDefault();
			$('#title_background_image').val($(this).attr('href'));
			$(this).addClass('active');
		});
	});
})(jQuery);
</script>
<?php
}

function codeus_page_effects_settings_box() {
	global $post;
	$effects_enabled = get_post_meta($post->ID, "codeus_effects_enabled", true);

?>
<table class="settings-box-table"><tbody><tr>
	<td>
		<label for="effects_enabled" class="selecttit"><input name="codeus_effects_enabled" type="checkbox" id="effects_enabled" value="1" <?php checked($effects_enabled, '1'); ?> /> <b><?php _e( 'Lazy loading enabled', 'codeus' ); ?></b></label>
	</td>
</tr></tbody></table>
<?php
}

add_action('save_post', 'codeus_save_page_settings');
function codeus_save_page_settings($post_id) {
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;
	if(!isset($_POST['post_type'])) {
		return $post_id;
	}
	if ( 'page' == $_POST['post_type']) {
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;
	}

	$post_metas = array(
		0 => 'codeus_slideshow_select',
		1 => 'codeus_slideshow_type',
		2 => 'codeus_slider_value',
		3 => 'codeus_quickfinder_position',
		4 => 'codeus_quickfinder_select',
		5 => 'codeus_portfolio_position',
		6 => 'codeus_portfolio_filter',
		7 => 'codeus_portfolio_select',
		8 => 'codeus_portfolio_size',
		9 => 'codeus_portfolio_count',
		10 => 'codeus_portfolio_title',
		11 => 'codeus_gallery_position',
		12 => 'codeus_gallery_select',
		13 => 'codeus_gallery_size',
		14 => 'codeus_gallery_style',
		15 => 'codeus_title_background_image',
		16 => 'codeus_title_background_color',
		17 => 'codeus_title_text_color',
		18 => 'codeus_title_excerpt_text_color',
		19 => 'codeus_effects_enabled'
	);
	foreach($post_metas as $post_meta) {
		if(isset($_POST[$post_meta])) {
			update_post_meta($post_id, $post_meta, $_POST[$post_meta]);
		} elseif(!(isset($_POST['vc_inline']) && $_POST['vc_inline'])) {
			delete_post_meta($post_id, $post_meta);
		}
	}
}

/* PLUGINS */

include (get_template_directory() . '/plugins/plugins.php');

function codeus_additionals_fonts() {
	$codeus_fonts = array(
		0 => array(
			'font_name' => 'Aileron Thin',
			'font_url_eot' => get_template_directory_uri() . '/fonts/aileron-thin-webfont.eot',
			'font_url_svg' => get_template_directory_uri() . '/fonts/aileron-thin-webfont.svg',
			'font_svg_id' => 'aileronthin',
			'font_url_ttf' => get_template_directory_uri() . '/fonts/aileron-thin-webfont.ttf',
			'font_url_woff' => get_template_directory_uri() . '/fonts/aileron-thin-webfont.woff',
		),
		1 => array(
			'font_name' => 'Aileron UltraLight',
			'font_url_eot' => get_template_directory_uri() . '/fonts/aileron-ultralight-webfont.eot',
			'font_url_svg' => get_template_directory_uri() . '/fonts/aileron-ultralight-webfont.svg',
			'font_svg_id' => 'aileronultralight',
			'font_url_ttf' => get_template_directory_uri() . '/fonts/aileron-ultralight-webfont.ttf',
			'font_url_woff' => get_template_directory_uri() . '/fonts/aileron-ultralight-webfont.woff',
		),
		2 => array(
			'font_name' => 'Aileron Light',
			'font_url_eot' => get_template_directory_uri() . '/fonts/aileron-light-webfont.eot',
			'font_url_svg' => get_template_directory_uri() . '/fonts/aileron-light-webfont.svg',
			'font_svg_id' => 'aileronlight',
			'font_url_ttf' => get_template_directory_uri() . '/fonts/aileron-light-webfont.ttf',
			'font_url_woff' => get_template_directory_uri() . '/fonts/aileron-light-webfont.woff',
		),
		3 => array(
			'font_name' => 'Geometria Light',
			'font_url_eot' => get_template_directory_uri() . '/fonts/geometria-light-webfont.eot',
			'font_url_svg' => get_template_directory_uri() . '/fonts/geometria-light-webfont.svg',
			'font_svg_id' => 'geometria_lightlight',
			'font_url_ttf' => get_template_directory_uri() . '/fonts/geometria-light-webfont.ttf',
			'font_url_woff' => get_template_directory_uri() . '/fonts/geometria-light-webfont.woff',
		),
		4 => array(
			'font_name' => 'Supra ThinDemiserif',
			'font_url_eot' => get_template_directory_uri() . '/fonts/supra-thindemiserif-webfont.eot',
			'font_url_svg' => get_template_directory_uri() . '/fonts/supra-thindemiserif-webfont.svg',
			'font_svg_id' => 'suprathindemiserif',
			'font_url_ttf' => get_template_directory_uri() . '/fonts/supra-thindemiserif-webfont.ttf',
			'font_url_woff' => get_template_directory_uri() . '/fonts/supra-thindemiserif-webfont.woff',
		),
	);
	$user_fonts = get_option('codeus_additionals_fonts');
	if(is_array($user_fonts)) {
		return array_merge($user_fonts, $codeus_fonts);
	}
	return $codeus_fonts;
}

/* FONTS */

add_action( 'init', 'codeus_google_fonts_load_file' );
function codeus_google_fonts_load_file() {
	global $codeus_fontsFamilyArray, $codeus_fontsFamilyArrayFull;
	$codeus_fontsFamilyArray = array();
	$codeus_fontsFamilyArrayFull = array();
	$additionals_fonts = codeus_additionals_fonts();
	foreach($additionals_fonts as $additionals_font) {
		$codeus_fontsFamilyArray[$additionals_font['font_name']] = $additionals_font['font_name'];
		$codeus_fontsFamilyArrayFull[$additionals_font['font_name']] = array('family' => $additionals_font['font_name'], 'variants' => array('regular'), 'subsets' => array());
	}
	$codeus_fontsFamilyArray = array_merge($codeus_fontsFamilyArray, array(
		'Arial' => 'Arial',
		'Courier' => 'Courier',
		'Courier New' => 'Courier New',
		'Georgia' => 'Georgia',
		'Helvetica' => 'Helvetica',
		'Palatino' => 'Palatino',
		'Times New Roman' => 'Times New Roman',
		'Trebuchet MS' => 'Trebuchet MS',
		'Verdana' => 'Verdana'
	));
	$codeus_fontsFamilyArrayFull = array_merge($codeus_fontsFamilyArrayFull, array(
		'Arial' => array('family' => 'Arial', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Courier' => array('family' => 'Courier', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Courier New' => array('family' => 'Courier New', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Georgia' => array('family' => 'Georgia', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Helvetica' => array('family' => 'Helvetica', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Palatino' => array('family' => 'Palatino', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Times New Roman' => array('family' => 'Times New Roman', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Trebuchet MS' => array('family' => 'Trebuchet MS', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Verdana' => array('family' => 'Verdana', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
	));
	$font_file = codeus_get_option('google_fonts_file');
	if(!file_exists($font_file)) {
		$font_file = get_template_directory() . '/fonts/webfonts.json';
	}
	$fontsList = json_decode(file_get_contents($font_file));
	if(is_object($fontsList) && isset($fontsList->kind) && $fontsList->kind == 'webfonts#webfontList' && isset($fontsList->items) && is_array($fontsList->items)) {
		foreach($fontsList->items as $item) {
			if(is_object($item) && isset($item->kind) && $item->kind == 'webfonts#webfont' && isset($item->family) && is_string($item->family)) {
				$codeus_fontsFamilyArray[$item->family] = $item->family;
				$codeus_fontsFamilyArrayFull[$item->family] = array(
					'family' => $item->family,
					'variants' => $item->variants,
					'subsets' => $item->subsets,
				);
			}
		}
	}
}

function codeus_fonts_list($full = false) {
	global $codeus_fontsFamilyArray, $codeus_fontsFamilyArrayFull;
	if($full) {
		return $codeus_fontsFamilyArrayFull;
	} else {
		return $codeus_fontsFamilyArray;
	}
}

add_action( 'wp_enqueue_scripts', 'codeus_load_fonts' );
function codeus_load_fonts() {
	require_once (get_template_directory() . '/options.php');
	$options = codeus_get_theme_options();
	$fontsList = codeus_fonts_list(true);
	$fontElements = array_keys($options['fonts']['subcats']);
	unset($fontElements[0]);
	$exclude_array = array('Arial', 'Courier', 'Courier New', 'Georgia', 'Helvetica', 'Palatino', 'Times New Roman', 'Trebuchet MS', 'Verdana');
	$additionals_fonts = codeus_additionals_fonts();
	foreach($additionals_fonts as $additionals_font) {
		$exclude_array[] = $additionals_font['font_name'];
	}
	foreach($fontElements as $element) {
		if(($font = codeus_get_option($element.'_family')) && !in_array($font, $exclude_array) && isset($fontsList[$font])) {
			$font = $fontsList[$font];
			if(codeus_get_option($element.'_sets')) {
				$font['subsets'] = codeus_get_option($element.'_sets');
			} else {
				$font['subsets'] = implode(',',$font['subsets']);
			}
			if(codeus_get_option($element.'_style')) {
				$font['variants'] = codeus_get_option($element.'_style');
			} else {
				$font['variants'] = 'regular';
			}
			wp_enqueue_style($font['family'].'-'.$font['variants'].'-'.$font['subsets'],'http://fonts.googleapis.com/css?family='.$font['family'].':'.$font['variants'].'&subset='.$font['subsets']);
		}
	}
}

function codeus_custom_fonts() {
	require_once (get_template_directory() . '/options.php');
	$options = codeus_get_theme_options();
	$fontElements = array_keys($options['fonts']['subcats']);
	unset($fontElements[0]);
	$additionals_fonts = codeus_additionals_fonts();
	foreach($additionals_fonts as $additionals_font) {
		$fonts_array[] = $additionals_font['font_name'];
		$fonts_arrayFull[$additionals_font['font_name']] = $additionals_font;
	}
	$exclude_array = array();
	foreach($fontElements as $element) {
		if(($font = codeus_get_option($element.'_family')) && in_array($font, $fonts_array) && !in_array($font, $exclude_array)) {
			$exclude_array[] = $font;
?>

@font-face {
	font-family: '<?php echo $fonts_arrayFull[$font]['font_name'] ?>';
	src: url('<?php echo $fonts_arrayFull[$font]['font_url_eot'] ?>');
	src:local('☺'), url('<?php echo $fonts_arrayFull[$font]['font_url_eot'] ?>?#iefix') format('embedded-opentype'),
		url('<?php echo $fonts_arrayFull[$font]['font_url_woff'] ?>') format('woff'),
		url('<?php echo $fonts_arrayFull[$font]['font_url_ttf'] ?>') format('truetype'),
		url('<?php echo $fonts_arrayFull[$font]['font_url_svg'] ?>#<?php echo $fonts_arrayFull[$font]['font_svg_id'] ?>') format('svg');
		font-weight: normal;
		font-style: normal;
}

<?php
		}
	}
}

add_action('wp_ajax_codeus_get_font_data', 'codeus_get_font_data');
function codeus_get_font_data() {
	if (is_array($_REQUEST['fonts'])) {
		$result = array();
		$fontsList = codeus_fonts_list(true);
		foreach ($_REQUEST['fonts'] as $font)
			if (isset($fontsList[$font]))
				$result[$font] = $fontsList[$font];
		echo json_encode($result);
		exit;
	}
	die(-1);
}

/* THUMBNAILS GENERATOR */

function codeus_thumbnail( $attachment_id, $image_size = 'full' ) {
	$codeus_image_sizes = array(
		'codeus_testimonial_photo' => array( 128, 128, true ),
		'codeus_quickfinder' => array( 170, 170, true ),
		'codeus_portfolio_small' => array( 267, 151, true ),
		'codeus_portfolio_medium' => array( 371, 210, true ),
		'codeus_portfolio_big' => array( 565, 320, true ),
		'codeus_gallery_medium' => array( 380, 380, true ),
		'codeus_gallery_medium_small' => array( 280, 280, true ),
		'codeus_clients_block_item' => array( 200, 150, false ),
		'codeus_product_gallery' => array(575, 740, true ),
		'codeus_product_gallery_thumb' => array(94, 94, true ),
		'codeus_product_list' => array(267, 267, true ),
		'codeus_widget_products' => array(78, 78, true ),
	);
	$filepath = get_attached_file($attachment_id);
	$image = wp_get_image_editor( $filepath );
	if ( !is_wp_error( $image ) ) {
		$image->resize( $codeus_image_sizes[$image_size][0], $codeus_image_sizes[$image_size][1], $codeus_image_sizes[$image_size][2] );
		$newFilepath = $image->generate_filename($image->get_suffix());
		if(file_exists($newFilepath)) {
			$newImage = wp_get_image_editor($newFilepath);
			if(!is_wp_error( $newImage ) && $newImage) {
				$newImage = array_merge(array('path' => $newFilepath), $newImage->get_size());
			}
		} else {
			$newImage = $image->save();
		}
		if(!is_wp_error( $newImage ) && $newImage) {
			$upload_dir = wp_upload_dir();
			return array($upload_dir['baseurl'].'/'._wp_relative_upload_path($newImage['path']), $newImage['width'], $newImage['height']);
		}
	}
	return false;
}

/* PAGINATION */

function codeus_pagination($current = 1, $total = 1) {
?>
	<?php if($total > 1) : ?>
		<div class="pagination">
			<?php if($current > 1) : ?>
				<a href="<?php echo get_pagenum_link($current-1); ?>" class="prev" title="<?php _e('Prev', 'codeus'); ?>"><?php _e('Prev', 'codeus'); ?></a>
			<?php endif; ?>
			<?php for($i=0; $i < $total; $i++) : ?>
				<?php if($current != $i+1) : ?>
					<a href="<?php echo get_pagenum_link($i+1); ?>"><?php echo $i+1; ?></a>
				<?php else : ?>
					<span class="current"><?php echo $i+1; ?></span>
				<?php endif; ?>
			<?php endfor; ?>
			<?php if($current < $total) : ?>
				<a href="<?php echo get_pagenum_link($current+1); ?>" class="next" title="<?php _e('Next', 'codeus'); ?>"><?php _e('Next', 'codeus'); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
<?php
}

function codeus_blog_excerpt_length($length) {
	return codeus_get_option('excerpt_length') ? codeus_get_option('excerpt_length') : 20;
}
add_filter('excerpt_length', 'codeus_blog_excerpt_length');
function codeus_blog_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'codeus_blog_excerpt_more');

/* HEAD AND FOOTER */

add_action('wp_head','codeus_theme_head', 15);
function codeus_theme_head() {
?>
	<style type="text/css">
		<?php codeus_custom_fonts(); ?>
	</style>
	<?php include (get_template_directory() . "/css/skins/custom-css.php"); ?>
	<?php if(codeus_get_option('custom_css')) : ?>
		<style type="text/css">
			<?php echo stripslashes(codeus_get_option('custom_css')); ?>
		</style>
	<?php endif; ?>
	<script type="text/javascript">
		document.write('<style>.noscript { display: none; }</style>');
	</script>
<?php
}

add_action('wp_footer','codeus_theme_footer', 15);
function codeus_theme_footer() {
?>
<?php if(codeus_get_option('ga_code')) : ?>
	<?php echo stripslashes(codeus_get_option('ga_code')); ?>
<?php endif; ?>
<?php
}

function codeus_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
	<div><input type="text" value="' . get_search_query() . '" name="s" id="s" /></div>
	<div class="clearfix"><input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" /></div>
	</form>';
	
	return $form;
}

add_filter( 'get_search_form', 'codeus_search_form' );

/* WOOCOMMERCE */

add_filter( 'woocommerce_enqueue_styles', '__return_false' );

add_action( 'codeus_woocommerce_single_product', 'woocommerce_template_single_title', 1 );
add_action( 'codeus_woocommerce_single_product', 'woocommerce_breadcrumb', 1 );
add_action( 'codeus_woocommerce_single_product', 'woocommerce_template_single_rating', 1 );
add_action( 'codeus_woocommerce_single_product', 'woocommerce_template_single_price', 1 );
add_action( 'codeus_woocommerce_single_product', 'woocommerce_template_single_add_to_cart', 1 );
add_action( 'codeus_woocommerce_product_excerpt', 'woocommerce_template_single_excerpt', 1 );
add_action( 'codeus_woocommerce_single_product', 'woocommerce_output_product_data_tabs', 1 );

add_action( 'codeus_woocommerce_single_product_bottom_line', 'woocommerce_template_single_meta', 1 );
//add_action( 'codeus_woocommerce_single_product', 'woocommerce_template_single_sharing', 500 ); 
//add_action( 'codeus_woocommerce_single_product', 'woocommerce_upsell_display', 1500 );
add_action( 'codeus_woocommerce_after_single_product', 'woocommerce_output_related_products', 1 );

add_action( 'codeus_woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 1 );
add_action( 'codeus_woocommerce_after_shop_loop_item_title_price', 'woocommerce_template_loop_price', 1 );
add_action( 'codeus_woocommerce_after_shop_loop_item_title_rating', 'woocommerce_template_loop_rating', 1 );


add_action( 'codeus_woocommerce_after_ordering', 'woocommerce_breadcrumb', 1 );

add_filter( 'woocommerce_short_description', 'codeus_run_shortcode', 7 );

add_filter( 'woocommerce_show_page_title', '__return_false' );

add_filter( 'woocommerce_product_additional_information_heading', 'codeus_woocommerce_product_additional_information_heading' );
function codeus_woocommerce_product_additional_information_heading($title = '') {
	return __( 'More Info', 'codeus' );
}
add_filter( 'woocommerce_product_additional_information_tab_title', 'codeus_woocommerce_product_additional_information_tab_title', 10, 2 );
function codeus_woocommerce_product_additional_information_tab_title($title = '', $key = '') {
	return __( 'More Info', 'codeus' );
}
add_filter( 'woocommerce_product_description_heading', 'codeus_woocommerce_product_description_heading' );
function codeus_woocommerce_product_description_heading($title = '') {
	return __( 'Details', 'codeus' );
}
add_filter( 'woocommerce_product_description_tab_title', 'codeus_woocommerce_product_description_tab_title', 10, 2);
function codeus_woocommerce_product_description_tab_title($title = '', $key = '') {
	return __( 'Details', 'codeus' );
}
add_filter( 'get_product_search_form', 'codeus_get_product_search_form' );
function codeus_get_product_search_form($form) {
		$form = '<form role="search" method="get" id="searchform" class="product-search" action="' . esc_url( home_url( '/'  ) ) . '">'.
			'<div class="clearfix">'.
				'<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search for products', 'woocommerce' ) . '" />'.
				'<button type="submit" id="searchsubmit" value="'. esc_attr__( 'Search', 'woocommerce' ) .'" ></button>'.
				'<input type="hidden" name="post_type" value="product" />'.
			'</div>'.
		'</form>';
	return $form;
}

add_filter( 'wc_add_to_cart_message', 'codeus_wc_add_to_cart_message', 10, 2);
function codeus_wc_add_to_cart_message($message='', $product_id='') {
	if ( is_array( $product_id ) ) {

		$titles = array();

		foreach ( $product_id as $id ) {
			$titles[] = get_the_title( $id );
		}

		$added_text = sprintf( __( 'Added &quot;%s&quot; to your cart.', 'woocommerce' ), join( __( '&quot; and &quot;', 'woocommerce' ), array_filter( array_merge( array( join( '&quot;, &quot;', array_slice( $titles, 0, -1 ) ) ), array_slice( $titles, -1 ) ) ) ) );

	} else {
		$added_text = sprintf( __( '&quot;%s&quot; was successfully added to your cart.', 'woocommerce' ), get_the_title( $product_id ) );
	}

	$added_text = '<div class="message">'.$added_text.'</div>';

	// Output success messages
	if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) :

		$return_to 	= apply_filters( 'woocommerce_continue_shopping_redirect', wp_get_referer() ? wp_get_referer() : home_url() );

		$message 	= sprintf('%s <a href="%s" class="button wc-forward">%s</a>', $added_text, $return_to, __( 'Continue Shopping', 'woocommerce' ) );

	else :

		$message 	= sprintf('%s <a href="%s" class="button wc-forward">%s</a>', $added_text, get_permalink( wc_get_page_id( 'cart' ) ), __( 'View Cart', 'woocommerce' ) );

	endif;
	return '<div class="clearfix">'.$message.'</div>';
}

add_filter('single_product_large_thumbnail_size', 'codeus_single_product_large_thumbnail_size', 10, 1);
function codeus_single_product_large_thumbnail_size($name) {
	return 'codeus_product';
}

add_filter('wp_nav_menu_items', 'codeus_cart_menu', 10, 2);
function codeus_cart_menu($items, $args) {
	require_once(ABSPATH . 'wp-admin/includes/plugin.php');
	if(is_plugin_active('woocommerce/woocommerce.php') && $args->theme_location == 'primary') {
		global $woocommerce;
		
		$count = sizeof( WC()->cart->get_cart() );
		
		ob_start();
		woocommerce_mini_cart();
		$minicart = ob_get_clean();
		$items .= '<li class="menu-item menu-item-cart"><a href="'.get_permalink(wc_get_page_id('cart')).'">&#xe604;</a>'.($count > 0 ? '<div class="minicart-item-count">'.$count.'</div>' : '').'<ul class="minicart"><li><div class="widget_shopping_cart_content">'.$minicart.'</div></li></ul></li>';
	}
	return $items;
}

function codeus_woocommerce_product_per_page_select() {
	$products_per_page_items = array(12,24,48);
	parse_str($_SERVER['QUERY_STRING'], $params);
	$pc = !empty($params['product_count']) ? $params['product_count'] : 12;
	$query_string = '?'.$_SERVER['QUERY_STRING'];
?>
<div class="woocommerce-select-count">
	<select id="products-per-page" name="products_per_page" class="styled" onchange="window.location.href=jQuery(this).val();">
		<?php foreach($products_per_page_items as $products_per_page_item) : ?>
			<option value="<?php echo codeus_addURLParameter($query_string, 'product_count', $products_per_page_item); ?>"<?php echo (($pc == $products_per_page_item) ? ' selected': ''); ?>><?php printf(__('Show %d On Page', 'codeus'), $products_per_page_item); ?></option>
		<?php endforeach; ?>
	</select>
</div>
<?php
}

add_filter('loop_shop_per_page', 'codeus_loop_shop_per_page');
function codeus_loop_shop_per_page()
{
	global $data;

	parse_str($_SERVER['QUERY_STRING'], $params);

	if($data['woo_items']) {
		$per_page = $data['woo_items'];
	} else {
		$per_page = 12;
	}

	$pc = !empty($params['product_count']) ? $params['product_count'] : $per_page;

	return $pc;
}


/* URL */

function codeus_addURLParameter($url, $paramName, $paramValue) {
	$url_data = parse_url($url);
	if(!isset($url_data["query"]))
		$url_data["query"]="";

	$params = array();
	parse_str($url_data['query'], $params);
	$params[$paramName] = $paramValue;
	$url_data['query'] = http_build_query($params);
	return codeus_build_url($url_data);
}
function codeus_build_url($url_data) {
	$url="";
	if(isset($url_data['host'])) {
		$url .= $url_data['scheme'] . '://';
		if (isset($url_data['user'])) {
			$url .= $url_data['user'];
				if (isset($url_data['pass'])) {
					$url .= ':' . $url_data['pass'];
				}
			$url .= '@';
		}
		$url .= $url_data['host'];
		if (isset($url_data['port'])) {
			$url .= ':' . $url_data['port'];
		}
	}
	if (isset($url_data['path'])) {
		$url .= $url_data['path'];
	}
	if (isset($url_data['query'])) {
		$url .= '?' . $url_data['query'];
	}
	if (isset($url_data['fragment'])) {
		$url .= '#' . $url_data['fragment'];
	}
	return $url;
}

function codeus_title($sep = '&raquo;', $display = true, $seplocation = '') {
	global $wpdb, $wp_locale;

	$m = get_query_var('m');
	$year = get_query_var('year');
	$monthnum = get_query_var('monthnum');
	$day = get_query_var('day');
	$search = get_query_var('s');
	$title = '';

	$t_sep = '%WP_TITILE_SEP%'; // Temporary separator, for accurate flipping, if necessary

	// If there is a post
	if ( is_single() || ( is_home() && !is_front_page() ) || ( is_page() && !is_front_page() ) ) {
		$title = single_post_title( '', false );
	}

	// If there's a post type archive
	if ( is_post_type_archive() ) {
		$post_type = get_query_var( 'post_type' );
		if ( is_array( $post_type ) )
			$post_type = reset( $post_type );
		$post_type_object = get_post_type_object( $post_type );
		if ( ! $post_type_object->has_archive )
			$title = post_type_archive_title( '', false );
	}

	// If there's a category or tag
	if ( is_category() || is_tag() ) {
		$title = single_term_title( '', false );
	}

	// If there's a taxonomy
	if ( is_tax() ) {
		$term = get_queried_object();
		if ( $term ) {
			$tax = get_taxonomy( $term->taxonomy );
			$title = single_term_title( $tax->labels->name . $t_sep, false );
		}
	}

	// If there's an author
	if ( is_author() ) {
		$author = get_queried_object();
		if ( $author )
			$title = $author->display_name;
	}

	// Post type archives with has_archive should override terms.
	if ( is_post_type_archive() && $post_type_object->has_archive )
		$title = post_type_archive_title( '', false );

	// If there's a month
	if ( is_archive() && !empty($m) ) {
		$my_year = substr($m, 0, 4);
		$my_month = $wp_locale->get_month(substr($m, 4, 2));
		$my_day = intval(substr($m, 6, 2));
		$title = $my_year . ( $my_month ? $t_sep . $my_month : '' ) . ( $my_day ? $t_sep . $my_day : '' );
	}

	// If there's a year
	if ( is_archive() && !empty($year) ) {
		$title = $year;
		if ( !empty($monthnum) )
			$title .= $t_sep . $wp_locale->get_month($monthnum);
		if ( !empty($day) )
			$title .= $t_sep . zeroise($day, 2);
	}

	// If it's a search
	if ( is_search() ) {
		/* translators: 1: separator, 2: search phrase */
		$title = sprintf(__('Search Results %1$s %2$s'), $t_sep, strip_tags($search));
	}

	// If it's a 404 page
	if ( is_404() ) {
		$title = __('Page not found');
	}

	$prefix = '';
	if ( !empty($title) )
		$prefix = " $sep ";

 	// Determines position of the separator and direction of the breadcrumb
	if ( 'right' == $seplocation ) { // sep on right, so reverse the order
		$title_array = explode( $t_sep, $title );
		$title_array = array_reverse( $title_array );
		$title = implode( " $sep ", $title_array ) . $prefix;
	} else {
		$title_array = explode( $t_sep, $title );
		$title = $prefix . implode( " $sep ", $title_array );
	}

	/**
	 * Filter the text of the page title.
	 *
	 * @since 2.0.0
	 *
	 * @param string $title       Page title.
	 * @param string $sep         Title separator.
	 * @param string $seplocation Location of the separator (left or right).
	 */
	$title = apply_filters( 'codeus_title', $title, $sep, $seplocation );

	// Send it out
	if ( $display )
		echo $title;
	else
		return $title;

}

function codeus_post_type_archive_title($label, $post_type) {
	if($post_type == 'product') {
		$shop_page_id = wc_get_page_id('shop');
		$page_title = get_the_title($shop_page_id);
		return $page_title;
	}
	return $label;
}
add_filter('post_type_archive_title', 'codeus_post_type_archive_title', 10, 2);