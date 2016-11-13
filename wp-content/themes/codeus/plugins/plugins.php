<?php

/* Video */
include (get_template_directory() . "/plugins/video/video.php");

/* Slideshow Plugin */
include (get_template_directory() . "/plugins/slideshow/slideshow.php");

/* Widget Plugin */
include (get_template_directory() . "/plugins/wp-page-widget/wp-page-widgets.php");

/* Rich Text Plugin */
include (get_template_directory() . "/plugins/black-studio-tinymce-widget/black-studio-tinymce-widget.php");

/* Quickfinder */
include (get_template_directory() . "/plugins/quickfinder.php");

/* Clients */
include (get_template_directory() . "/plugins/clients.php");

/* Portfolio */
include (get_template_directory() . "/plugins/portfolio.php");

/* Gallery */
include (get_template_directory() . "/plugins/gallery.php");

/* News */
include (get_template_directory() . "/plugins/news.php");

/* Diagram */
include (get_template_directory() . "/plugins/diagram.php");

/* Blog */
include (get_template_directory() . "/plugins/blog.php");

/* Content block */
include (get_template_directory() . "/plugins/content_block.php");

/* Testimonials */
include (get_template_directory() . "/plugins/testimonials.php");

/* Team */
include (get_template_directory() . "/plugins/team.php");

/* Shortcode Generator */
include (get_template_directory() . "/plugins/shortcode_generator.php");

/* Shortcodes */
include (get_template_directory() . "/plugins/shortcodes.php");

/* Widgets */
include (get_template_directory() . "/plugins/widgets.php");

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'codeus_register_required_plugins' );
function codeus_register_required_plugins() {
	$plugins = array(
		array(
			'name' => 'LayerSlider WP',
			'slug' => 'LayerSlider',
			'source' => 'http://codex-themes.com/codeus/required-plugins/layersliderwp.installable.zip',
			'required' => true,
			'version' => '',
			'force_activation' => true,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name'			=> 'WPBakery Visual Composer',
			'slug'			=> 'js_composer',
			'source'			=> 'http://codex-themes.com/codeus/recommended-plugins/js_composer.zip',
			'recommended'			=> true,
			'required' => false,
			'version'			=> '3.7',
			'force_activation'		=> false,
			'force_deactivation'	=> false,
			'external_url'		=> '',
		)
/*		array(
			'name' => 'Wordpress Page Widgets',
			'slug' => 'wp-page-widget',
			'source' => 'http://codex-themes.com/codeus/required-plugins/wp-page-widget.zip',
			'required' => true,
			'version' => '',
			'force_activation' => true,
			'force_deactivation' => true,
			'external_url' => '',
		),*/
/*		array(
			'name' => 'Black Studio TinyMCE Widget',
			'slug' => 'black-studio-tinymce-widget',
			'source' => 'http://codex-themes.com/codeus/required-plugins/black-studio-tinymce-widget.zip',
			'required' => true,
			'version' => '',
			'force_activation' => true,
			'force_deactivation' => true,
			'external_url' => '',
		),*/
	);

	$theme_text_domain = 'codeus';

	$config = array(
		'domain' => $theme_text_domain,
		'default_path' => '',
		'parent_menu_slug' => 'themes.php',
		'parent_url_slug' => 'themes.php',
		'menu' => 'install-required-plugins',
		'has_notices' => true,
		'is_automatic' => true,
		'message' => '',
		'strings' => array(
			'page_title' => __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title' => __( 'Install Plugins', $theme_text_domain ),
			'installing' => __( 'Installing Plugin: %s', $theme_text_domain ),
			'oops' => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
			'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
			'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
			'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
			'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
			'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
			'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
			'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return' => __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated' => __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ),
			'nag_type' => 'updated'
		)
	);

	tgmpa( $plugins, $config );

}

if(function_exists('vc_set_as_theme')) vc_set_as_theme(true);

?>