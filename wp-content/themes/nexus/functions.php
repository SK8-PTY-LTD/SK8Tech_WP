<?php
/*------------------------------------------------------*/
/* Nexus functions.php Started */
/*------------------------------------------------------*/

/*------------------------------------------------------
Nexus, After Theme Setup - Started
-------------------------------------------------------*/

/*require_once get_template_directory() . '/admin/custom/nexus-custom.php';*/

add_action('after_setup_theme', 'nexus_setup');
function nexus_setup(){
	/* Add theme-supported features here. */
	add_theme_support( 'post-thumbnails' ); 	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header');
	add_theme_support( 'post-formats', array('video','audio','gallery') );
	add_theme_support( 'title-tag' );
	/* Add custom actions here. */
	add_action('wp_enqueue_scripts', 'nexus_load_theme_fonts', 30);
	add_action('wp_enqueue_scripts', 'nexus_load_theme_scripts' );
	add_action('wp_enqueue_scripts', 'nexus_load_theme_styles');	
	add_action( 'add_meta_boxes', 'nexus_add_sidebar_metabox' );  
	add_action( 'save_post', 'nexus_save_sidebar_postdata' );  
	add_action( 'tgmpa_register', 'nexus_register_required_plugins' );		
	/* Add custom filters here. */	
	add_filter('wp_list_categories','categories_postcount_filter');
	add_filter('get_search_form', 'nexus_search_form' );
	add_filter('wp_generate_attachment_metadata', 'nexus_retina_support_attachment_meta', 10, 2 );
	add_filter('delete_attachment', 'nexus_delete_retina_support_images' );
	add_filter('request', 'nexus_request_filter' );
	add_filter('excerpt_length', 'nexus_custom_excerpt_length', 999 );
	add_filter('excerpt_more', 'nexus_excerpt_more_string');
	add_filter('widget_text', 'do_shortcode');	
	add_filter('loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );	
	/* Add ceditor Styles here. */	
	add_editor_style();
	/* Add Nexus Content Width. */
	if ( ! isset( $content_width ) ){ $content_width = 1170;}	
	/* Add Custom Background. */
	add_theme_support( 'custom-background');
	/* Load Text Domain. */
	load_theme_textdomain('nexus', get_template_directory() . '/languages');
}
/*------------------------------------------------------
Nexus, After Theme Setup - End
-------------------------------------------------------*/

/*------------------------------------------------------*/
/* TGM_Plugin_Activation class Started*/
/*------------------------------------------------------*/
require_once ('admin/tgm/class-tgm-plugin-activation.php');
function nexus_register_required_plugins() {
	$sentient_layerslider_path = get_template_directory() . '/admin/lib/plugins/layersliderwp.zip';
	$sentient_vc_path = get_template_directory() . '/admin/lib/plugins/visual-composer.zip';
	$identity_revslider_path = get_template_directory() . '/admin/lib/plugins/revslider.zip';
	$identity_posts_path = get_template_directory() . '/admin/lib/plugins/ProfTeamExtensions.zip';
	$sentient_envato = get_template_directory() . '/admin/lib/plugins/envato-wordpress-toolkit-master.zip';
	
	$plugins = array(
		array(
			'name'     				=> 'Layerslider', // The plugin name
			'slug'     				=> 'LayerSlider', // The plugin slug (typically the folder name)
			'source'   				=> $sentient_layerslider_path, // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.4.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Visual Composer', // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> $sentient_vc_path, // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '4.5.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> $identity_revslider_path, // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '4.6.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),			
		array(
			'name'     				=> 'ProfTeam Extensions', // The plugin name
			'slug'     				=> 'ProfTeamExtensions', // The plugin slug (typically the folder name)
			'source'   				=> $identity_posts_path, // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Envato WordPress Toolkit', // The plugin name
			'slug'     				=> 'envato-wordpress-toolkit-master', // The plugin slug (typically the folder name)
			'source'   				=> $sentient_envato, // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.7.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),		
        array(
            'name'      => 'contact-form-7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),		
        array(
            'name'      => 'newsletter',
            'slug'      => 'newsletter',
            'required'  => false,
        ),		

	);
	$theme_text_domain = 'nexus';

	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       // Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'nexus'),
			'menu_title'                       			=> __( 'Install Plugins', 'nexus' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'nexus' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'nexus' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'nexus' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'nexus' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'nexus' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);
	tgmpa( $plugins, $config );
}
/**************************************/
/*TGM_Plugin_Activation class End*/
/**************************************/

/***************************************************/
/*Set Visual Composer as Theme Function - Started*/
/***************************************************/
if(function_exists('vc_set_as_theme')) vc_set_as_theme();
/***************************************************/
/*Set Visual Composer as Theme Function - End*/
/***************************************************/

/***************************************************/
/*Load Nexus Fonts - Started*/
/***************************************************/
function nexus_load_theme_fonts() {

	global $prof_default;
	$Protocol = is_ssl() ? 'https' : 'http';	
	
	if(of_get_option('select_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'siteFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('select_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'siteFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('select_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'siteFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");				
	} elseif(of_get_option('select_font',$prof_default) == 'Lato') {	
		wp_enqueue_style( 'siteFont', "$Protocol://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext");
	} else {
		wp_enqueue_style( 'siteFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('select_font',$prof_default));		
	}
	
	if(of_get_option('h1_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingOneFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h1_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingOneFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h1_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingOneFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h1_font',$prof_default) == 'Lato') {	
		wp_enqueue_style( 'headingOneFont', "$Protocol://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext");
	} else {
		wp_enqueue_style( 'headingOneFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h1_font',$prof_default));		
	}
	
	if(of_get_option('h2_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingTwoFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h2_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingTwoFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h2_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingTwoFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h2_font',$prof_default) == 'Lato') {	
		wp_enqueue_style( 'headingTwoFont', "$Protocol://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext");
	} else {
		wp_enqueue_style( 'headingTwoFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h2_font',$prof_default));		
	}	
	
	if(of_get_option('h3_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingThreeFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h3_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingThreeFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h3_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingThreeFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h3_font',$prof_default) == 'Lato') {	
		wp_enqueue_style( 'headingThreeFont', "$Protocol://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext");
	} else {
		wp_enqueue_style( 'headingThreeFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h3_font',$prof_default));		
	}	
	
	if(of_get_option('h4_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingFourFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h4_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingFourFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h4_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingFourFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h4_font',$prof_default) == 'Lato') {	
		wp_enqueue_style( 'headingFourFont', "$Protocol://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext");
	} else {
		wp_enqueue_style( 'headingFourFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h4_font',$prof_default));		
	}		
	
	if(of_get_option('h5_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingFiveFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h5_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingFiveFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h5_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingFiveFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h5_font',$prof_default) == 'Lato') {	
		wp_enqueue_style( 'headingFiveFont', "$Protocol://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext");
	} else {
		wp_enqueue_style( 'headingFiveFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h5_font',$prof_default));		
	}		
	
	if(of_get_option('h6_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingSixFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h6_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingSixFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h6_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingSixFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h6_font',$prof_default) == 'Lato') {	
		wp_enqueue_style( 'headingSixFont', "$Protocol://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext");
	} else {
		wp_enqueue_style( 'headingSixFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h6_font',$prof_default));		
	}			
		
}
/***************************************************/
/*Load Nexus Fonts - End*/
/***************************************************/

/***************************************************/
/*Load nexus Styles - Started*/
/***************************************************/
function nexus_load_theme_styles() {
	global $prof_default;

	wp_register_style('nexus-usage', get_template_directory_uri().'/styles/nexus-usage.css');
	wp_register_style('nexus-icons', get_template_directory_uri().'/styles/nexus-icons.css');	
	wp_register_style('nexus-custom', get_template_directory_uri().'/nexus-styles.css');
	wp_register_style('app', get_template_directory_uri().'/styles/nexus/app.css');	
	wp_register_style('style', get_stylesheet_uri());
	
	wp_enqueue_style('style');	
	wp_enqueue_style('nexus-icons');	
	wp_enqueue_style('nexus-usage');	
	wp_enqueue_style('app');		
	wp_enqueue_style('nexus-custom');	
}
/***************************************************/
/*Load nexus Styles - End*/
/***************************************************/

/***************************************************/
/*Load Nexus Scripts - Started*/
/***************************************************/
function nexus_load_theme_scripts() {
	global $prof_default;
	
	wp_enqueue_script('jquery');
	
	wp_enqueue_script('prof.common', get_template_directory_uri().'/js/prof.common.js',false,false,true);		
	wp_enqueue_script('retina', get_template_directory_uri().'/js/retina.js', '', '', true);
	
	if ( is_page_template( 'homepage.php' ) || is_page_template( 'page-full.php' )) {
		wp_enqueue_script('earth-slider', get_template_directory_uri().'/js/nexus/earth-slider.js', '', '', true);
	}
	
	wp_enqueue_script('app', get_template_directory_uri().'/js/nexus/app.js', '', '', true);
	wp_enqueue_script('homepage', get_template_directory_uri().'/js/nexus/homepage.js', '', '', true);
	wp_enqueue_script('modernizr.min', get_template_directory_uri().'/js/nexus/modernizr.min.js', '', '', true);
	wp_enqueue_script('raphael', get_template_directory_uri().'/js/nexus/raphael.min.js', '', '', true);
	wp_enqueue_script('livicons', get_template_directory_uri().'/js/nexus/livicons.js', '', '', true);
	wp_enqueue_script('owl-carousel', get_template_directory_uri().'/js/nexus/owl-carousel.min.js', '', '', true);
	wp_enqueue_script('magnific-popup', get_template_directory_uri().'/js/nexus/magnific-popup.min.js', '', '', true);
	
	if ( is_page_template( 'homepage.php' ) || is_page_template( 'page-full.php' )) {
		wp_enqueue_script('appear-count', get_template_directory_uri().'/js/nexus/appear-count.js', '', '', true);
		wp_enqueue_script('mapsgoogle', 'https://maps.googleapis.com/maps/api/js?sensor=false', '', '', true);
		wp_enqueue_script('google-map', get_template_directory_uri().'/js/nexus/google-map.js', '', '', true);		
	}	
}
/***************************************************/
/*Load Nexus Scripts - End*/
/***************************************************/

/***************************************************/
/*Nexus Retina Functions - Started*/
/***************************************************/
function nexus_retina_support_attachment_meta( $metadata, $attachment_id ) {
	foreach ( $metadata as $key => $value ) {
		if ( is_array( $value ) ) {
			foreach ( $value as $image => $attr ) {
				if ( is_array( $attr ) )
					nexus_retina_support_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
			}
		}
	}
	return $metadata;
}

function nexus_retina_support_create_images( $file, $width, $height, $crop = false ) {
    if ( $width || $height ) {
        $resized_file = wp_get_image_editor( $file );
        if ( ! is_wp_error( $resized_file ) ) {
            $filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );
 
            $resized_file->resize( $width * 2, $height * 2, $crop );
            $resized_file->save( $filename );
 
            $info = $resized_file->get_size();
 
            return array(
                'file' => wp_basename( $filename ),
                'width' => $info['width'],
                'height' => $info['height'],
            );
        }
    }
    return false;
}

function nexus_delete_retina_support_images( $attachment_id ) {
    $meta = wp_get_attachment_metadata( $attachment_id );
    $upload_dir = wp_upload_dir();
	
	if(is_array($meta)){	
		$path = pathinfo( $meta['file'] );

		foreach ( $meta as $key => $value ) {
			if ( 'sizes' === $key ) {
				foreach ( $value as $sizes => $size ) {
					$original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
					$retina_filename = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
					if ( file_exists( $retina_filename ) )
						unlink( $retina_filename );
				}
			}
		}
	}
}
/***************************************************/
/*Nexus Retina Functions - End*/
/***************************************************/


/***************************************************/
/*Nexus Search Query Function - Started*/
/***************************************************/
if(!is_admin()){
    add_action('init', 'nexus_search_query_fix');
    function nexus_search_query_fix(){
        if(isset($_GET['s']) && $_GET['s']==''){
            $_GET['s']=' ';
        }
    }
}

function nexus_request_filter( $query_vars ) {
    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
        $query_vars['s'] = " ";
    }
    return $query_vars;
}
/***************************************************/
/*Nexus Search Query Function - End*/
/***************************************************/

/***************************************************/
/*Nexus Add Post Thumbnails size - Started*/
/***************************************************/
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 500, 500, true );
	set_post_thumbnail_size( 600, 800, true );
	set_post_thumbnail_size( 900, 9999, true );
	set_post_thumbnail_size( 360, 300, true );
	set_post_thumbnail_size( 80, 80, true );
	set_post_thumbnail_size( 380, 255, true );		
	
	set_post_thumbnail_size( 450, 350, true );	
	set_post_thumbnail_size( 150, 150, true );		
	set_post_thumbnail_size( 400, 250, true );	
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'insperia-team', 500, 500, true ); //(cropped)
	add_image_size( 'insperia-portfolio-small', 600, 800, true ); //(cropped)
	add_image_size( 'insperia-blog-big', 900, 9999, true ); //(cropped)
	add_image_size( 'insperia-blog-small', 360, 300, true ); //(cropped)
	add_image_size( 'insperia-testimonial-thumb', 80, 80, true ); //(cropped)
	add_image_size( 'insperia-portfolio-thumb', 380, 255, true ); //(cropped)			
	
	add_image_size( 'nexus-testimonial-thumb', 150, 150, true ); //(cropped)	
	add_image_size( 'nexus-portfolio-thumb', 450, 350, true ); //(cropped)	
	add_image_size( 'nexus-blog-thumb', 450, 350, true ); //(cropped)	
}
/***************************************************/
/*Nexus Add Post Thumbnails sizes - End*/
/***************************************************/


$nexus_socials = array(__("facebook", "nexus") => "facebook", __("twitter", "nexus") => "twitter", __("google-plus", "nexus") => "google-plus", __("rss", "nexus") => "rss", __("reddit", "nexus") => "reddit", __("email", "nexus") => "email", __("linkedin", "nexus") => "linkedin", __("dribbble", "nexus") => "dribbble", __("pinterest", "nexus") => "pinterest", __("github", "nexus") => "github", __("behance", "nexus") => "behance", __("deviantart", "nexus") => "deviantart", __("flickr" , "nexus") => "flickr", __("instagram" , "nexus") => "instagram", __("tumblr" , "nexus") => "tumblr", __("youtube" , "nexus") => "youtube");
$nexus_yes_no_arr = array(__("Yes", "nexus") => "yes", __("No", "nexus") => "no");
$nexus_align = array(__("Align Left", "nexus") => "left", __("Align Right", "nexus") => "right", __("Align Center", "nexus") => "center");

$nexus_icon_arr = array(
__("Align Left", "nexus") => "align-left",
__("Align Center", "nexus") => "align-center",
__("Align Right", "nexus") => "align-right",
__("Align Justify", "nexus") => "align-justify",
__("Arrows", "nexus") => "arrows",
__("Arrow Left", "nexus") => "arrow-left",
__("Arrow Right", "nexus") => "arrow-right",
__("Arrow Up", "nexus") => "arrow-up",
__("Arrow Down", "nexus") => "arrow-down",
__("Asterisk", "nexus") => "asterisk",
__("Arrows V", "nexus") => "arrows-v",
__("Arrows H", "nexus") => "arrows-h",
__("Arrow Circle Left", "nexus") => "arrow-circle-left",
__("Arrow Circle Right", "nexus") => "arrow-circle-right",
__("Arrow Circle Up", "nexus") => "arrow-circle-up",
__("Arrow Circle Down", "nexus") => "arrow-circle-down",
__("Arrows Alt", "nexus") => "arrows-alt",
__("Ambulance", "nexus") => "ambulance",
__("Adn", "nexus") => "adn",
__("Angle Double Left", "nexus") => "angle-double-left",
__("Angle Double Right", "nexus") => "angle-double-right",
__("Angle Double Up", "nexus") => "angle-double-up",
__("Angle Double Down", "nexus") => "angle-double-down",
__("Angle Left", "nexus") => "angle-left",
__("Angle Right", "nexus") => "angle-right",
__("Angle Up", "nexus") => "angle-up",
__("Angle Down", "nexus") => "angle-down",
__("Anchor", "nexus") => "anchor",
__("Android", "nexus") => "android",
__("Apple", "nexus") => "apple",
__("Archive", "nexus") => "archive",
__("Automobile", "nexus") => "automobile",
__("Bars", "nexus") => "bars",
__("Backward", "nexus") => "backward",
__("Ban", "nexus") => "ban",
__("Bar Code", "nexus") => "barcode",
__("Bank", "nexus") => "bank",
__("Bell", "nexus") => "bell",
__("Book", "nexus") => "book",
__("Bookmark", "nexus") => "bookmark",
__("Bold", "nexus") => "bold",
__("Bullhorn", "nexus") => "bullhorn",
__("Briefcase", "nexus") => "briefcase",
__("Bolt", "nexus") => "bolt",
__("Beer", "nexus") => "beer",
__("Behance", "nexus") => "behance",
__("Behance Square", "nexus") => "behance-square",
__("Bitcoin", "nexus") => "bitcoin",
__("Bitbucket", "nexus") => "bitbucket",
__("Bitbucket-square", "nexus") => "bitbucket-square",
__("Bomb", "nexus") => "bomb",
__("BTC", "nexus") => "glass",
__("Bullseye", "nexus") => "bullseye",
__("Bug", "nexus") => "bug",
__("Building", "nexus") => "building",
__("Check", "nexus") => "check",
__("Cog", "nexus") => "cog",
__("Camera", "nexus") => "camera",
__("Chevron Left", "nexus") => "chevron-left",
__("Chevron Right", "nexus") => "chevron-right",
__("Check Circle", "nexus") => "check-circle",
__("Cross Hairs", "nexus") => "crosshairs",
__("Compress", "nexus") => "compress",
__("Calendar", "nexus") => "calendar",
__("Comment", "nexus") => "comment",
__("Chevron Up", "nexus") => "hevron-up",
__("Chevron Down", "nexus") => "chevron-down",
__("Camera Retro", "nexus") => "camera-retro",
__("Cogs", "nexus") => "cogs",
__("Comments", "nexus") => "comments",
__("Credit Card", "nexus") => "credit-card",
__("Certificate", "nexus") => "certificate",
__("Chain", "nexus") => "chain",
__("Cloud", "nexus") => "cloud",
__("Cut", "nexus") => "cut",
__("Copy", "nexus") => "copy",
__("Caret Down", "nexus") => "caret-down",
__("Caret Up", "nexus") => "caret-up",
__("Caret Left", "nexus") => "caret-left",
__("Caret Right", "nexus") => "caret-right",
__("Columns", "nexus") => "columns",
__("Clipboard", "nexus") => "clipboard",
__("Cloud Download", "nexus") => "cloud-download",
__("Cloud Upload", "nexus") => "cloud-upload",
__("Coffee", "nexus") => "coffee",
__("Cutlery", "nexus") => "cutlery",
__("Car", "nexus") => "car",
__("Cab", "nexus") => "cab",
__("Chevron Circle Left", "nexus") => "chevron-circle-left",
__("Chevron Circle Right", "nexus") => "chevron-circle-right",
__("Chevron Circle Up", "nexus") => "chevron-circle-up",
__("Chevron Circle Down", "nexus") => "chevron-circle-down",
__("Check Square", "nexus") => "check-square",
__("Child", "nexus") => "child",
__("Chain Broken", "nexus") => "chain-broken",
__("Circle", "nexus") => "circle",
__("Circle Thin", "nexus") => "circle-thin",
__("CNY", "nexus") => "cny",
__("Code", "nexus") => "code",
__("Compass", "nexus") => "compass",
__("Code Pen", "nexus") => "codepen",
__("css3", "nexus") => "css3",
__("Cube", "nexus") => "cube",
__("Cubes", "nexus") => "cubes",
__("Download", "nexus") => "download",
__("Dedent", "nexus") => "dedent",
__("Dashboard", "nexus") => "dashboard",
__("Database", "nexus") => "database",
__("Deviantart", "deviantart") => "glass",
__("Desktop", "nexus") => "desktop",
__("Delicious", "nexus") => "delicious",
__("Drupal", "nexus") => "drupal",
__("Dribbble", "nexus") => "dribbble",
__("Dropbox", "nexus") => "dropbox",
__("Dollar", "nexus") => "dollar",
__("Digg", "nexus") => "digg",
__("Exchange", "nexus") => "exchange",
__("Eye Dropper", "nexus") => "eyedropper",
__("Eject", "nexus") => "eject",
__("Expand", "nexus") => "expand",
__("Exclamation Circle", "nexus") => "exclamation-circle",
__("Eye", "nexus") => "eye",
__("Eye Slash", "nexus") => "eye-slash",
__("Exclamation Triangle", "nexus") => "exclamation-triangle",
__("External Link", "nexus") => "external-link",
__("Envelope", "nexus") => "envelope",
__("Empire", "nexus") => "empire",
__("Envelope Square", "nexus") => "envelope-square",
__("External Link Square", "nexus") => "external-link-square",
__("Eraser", "nexus") => "eraser",
__("Exclamation", "nexus") => "exclamation",
__("Ellipsis Horizontal", "nexus") => "ellipsis-h",
__("Ellipsis Vertical", "nexus") => "ellipsis-v",
__("Euro", "nexus") => "euro",
__("Eur", "nexus") => "eur",
__("Flash", "nexus") => "flash",
__("Fighter Jet", "nexus") => "fighter-jet",
__("Film", "nexus") => "film",
__("Flag", "nexus") => "flag",
__("Font", "nexus") => "font",
__("Fast Backward", "nexus") => "fast-backward",
__("Forward", "nexus") => "forward",
__("Fast Forward", "nexus") => "fast-forward",
__("Fire", "nexus") => "fire",
__("folder", "nexus") => "folder",
__("Folder Open", "nexus") => "folder-open",
__("Facebook Square", "nexus") => "facebook-square",
__("Facebook", "nexus") => "facebook",
__("Filter", "nexus") => "filter",
__("Flask", "nexus") => "flask",
__("Fax", "nexus") => "fax",
__("Female", "nexus") => "female",
__("Foursquare", "nexus") => "foursquare",
__("Fire Extinguisher", "nexus") => "fire-extinguisher",
__("Flag Checkered", "nexus") => "flag-checkered",
__("Folder Open", "nexus") => "folder-open-o",
__("File", "nexus") => "file",
__("File Text", "nexus") => "file-text",
__("Flickr", "nexus") => "flickr",
__("Google Plus Square", "google-plus-square") => "glass",
__("Google Plus", "nexus") => "google-plus",
__("Gavel", "nexus") => "gavel",
__("Glass", "nexus") => "glass",
__("Gear", "nexus") => "gear",
__("Gift", "nexus") => "gift",
__("Gears", "nexus") => "gears",
__("Github-Square", "nexus") => "github-square",
__("Github", "nexus") => "github",
__("Globe", "nexus") => "globe",
__("Group", "nexus") => "group",
__("Git Square", "nexus") => "git-square",
__("GE", "nexus") => "ge",
__("Google", "nexus") => "google",
__("Graduation Cap", "nexus") => "graduation-cap",
__("Git Tip", "nexus") => "gittip",
__("GBP", "nexus") => "gbp",
__("Gamepad", "nexus") => "gamepad",
__("Github Alt", "nexus") => "github-alt",
__("Git", "nexus") => "git",
__("Heart", "nexus") => "heart",
__("Home", "nexus") => "home",
__("Headphones", "nexus") => "headphones",
__("Header", "nexus") => "header",
__("History", "nexus") => "history",
__("hacker-news", "nexus") => "hacker-news",
__("html5", "nexus") => "html5",
__("H Square", "nexus") => "h-square",
__("Italic", "nexus") => "italic",
__("Indent", "nexus") => "indent",
__("Image", "nexus") => "image",
__("Info Circle", "nexus") => "info-circle",
__("Inverse", "nexus") => "inverse",
__("Inbox", "nexus") => "inbox",
__("Institution", "nexus") => "institution",
__("Instagram", "nexus") => "instagram",
__("INR", "nexus") => "inr",
__("Info", "nexus") => "info",
__("JS Fiddle", "nexus") => "jsfiddle",
__("Joomla", "nexus") => "joomla",
__("JPY", "nexus") => "jpy",
__("Key", "nexus") => "key",
__("KRW", "nexus") => "krw",
__("Linkedin Square", "nexus") => "linkedin-square",
__("Link", "nexus") => "link",
__("List ul", "nexus") => "list-ul",
__("List ol", "nexus") => "list-ol",
__("Linkedin", "nexus") => "linkedin",
__("Legal", "nexus") => "legal",
__("List", "nexus") => "list-alt",
__("Lock", "nexus") => "lock",
__("List", "nexus") => "list",
__("Leaf", "nexus") => "leaf",
__("Life Bouy", "nexus") => "life-bouy",
__("Life Saver", "nexus") => "life-saver",
__("Language", "nexus") => "language",
__("Laptop", "nexus") => "laptop",
__("Level Up", "nexus") => "level-up",
__("Level Down", "nexus") => "level-down",
__("Long Arrow Down", "nexus") => "long-arrow-down",
__("Long Arrow Up", "nexus") => "long-arrow-up",
__("Long Arrow Left", "nexus") => "long-arrow-left",
__("Long Arrow Right", "nexus") => "long-arrow-right",
__("Linux", "nexus") => "linux",
__("Life Ring", "nexus") => "life-ring",
__("Magnet", "nexus") => "magnet",
__("Magic", "nexus") => "magic",
__("Money", "nexus") => "money",
__("Medkit", "nexus") => "medkit",
__("Music", "nexus") => "music",
__("Minus Circle", "nexus") => "minus-circle",
__("Mail Forward", "nexus") => "mail-forward",
__("Minus", "nexus") => "minus",
__("Mortar Board", "nexus") => "mortar-board",
__("Male", "nexus") => "male",
__("Minus Square", "nexus") => "minus-square",
__("Maxcdn", "nexus") => "maxcdn",
__("Mobile Phone", "nexus") => "mobile-phone",
__("mobile", "nexus") => "mobile",
__("Mail Reply", "nexus") => "mail-reply",
__("Microphone", "nexus") => "microphone",
__("Microphone Slash", "nexus") => "microphone-slash",
__("Navicon", "nexus") => "navicon",
__("Open Comment", "nexus") => "comment-o",
__("Open comments", "nexus") => "comments-o",
__("Open Lightbulb", "nexus") => "lightbulb-o",
__("Open Bell", "nexus") => "bell-o",
__("Open File Text", "nexus") => "file-text-o",
__("Open Building", "nexus") => "building-o",
__("Open Hospital", "nexus") => "hospital-o",
__("Open Envelope", "nexus") => "envelope-o",
__("Open Star", "nexus") => "star-o",
__("Open Trash", "nexus") => "trash-o",
__("Open File", "nexus") => "file-o",
__("Open Clock", "nexus") => "clock-o",
__("Open Arrow Circle Down", "nexus") => "arrow-circle-o-down",
__("Open Arrow Circle Up", "nexus") => "arrow-circle-o-up",
__("Open Play Circle", "nexus") => "play-circle-o",
__("Outdent", "nexus") => "outdent",
__("Open Picture", "nexus") => "picture-o",
__("Open Pencil Square", "nexus") => "pencil-square-o",
__("Open Share Square", "nexus") => "share-square-o",
__("Open Check Square", "nexus") => "check-square-o",
__("Open Times Circle", "nexus") => "times-circle-o",
__("Open Check Circle", "nexus") => "check-circle-o",
__("Open Bar Chart", "nexus") => "bar-chart-o",
__("Open Thumbs Up", "nexus") => "thumbs-o-up",
__("Open Thumbs Down", "nexus") => "thumbs-o-down",
__("Open Heart", "nexus") => "heart-o",
__("Open Lemon", "nexus") => "lemon-o",
__("Open Square", "nexus") => "square",
__("Open Bookmark", "nexus") => "bookmark-o",
__("Open hdd", "nexus") => "hdd-o",
__("Open Hand Right", "nexus") => "hand-o-right",
__("Open Hand Left", "nexus") => "hand-o-left",
__("Open Hand Up", "nexus") => "hand-o-up",
__("Open Hand Down", "nexus") => "hand-o-down",
__("Open Files", "nexus") => "files-o",
__("Open Floppy", "nexus") => "floppy-o",
__("Open Circle", "nexus") => "circle-o",
__("Open Folder", "nexus") => "folder-o",
__("Open Smile", "nexus") => "smile-o",
__("Open Frown", "nexus") => "frown-o",
__("Open Meh", "nexus") => "meh-o",
__("Open Keyboard", "nexus") => "keyboard-o",
__("Open Flag", "nexus") => "flag-o",
__("Open Calendar", "nexus") => "calendar-o",
__("Open Minus Square", "nexus") => "minus-square-o",
__("Open Caret Square Down", "nexus") => "caret-square-o-down",
__("Open Caret Square Up", "nexus") => "caret-square-o-up",
__("Open Caret Square Right", "nexus") => "caret-square-o-right",
__("Open Sun", "nexus") => "sun-o",
__("Open Moon", "nexus") => "moon-o",
__("Open Arrow Circle Right", "nexus") => "arrow-circle-o-right",
__("Open Arrow Circle Left", "nexus") => "arrow-circle-o-left",
__("Open Caret Square Left", "nexus") => "caret-square-o-left",
__("Open Dot Circle", "nexus") => "dot-circle-o",
__("Open Plus Square", "nexus") => "plus-square-o",
__("Open ID", "nexus") => "openid",
__("Open File pdf", "nexus") => "file-pdf-o",
__("Open File Word", "nexus") => "file-word-o",
__("Open File Eexcel", "nexus") => "file-excel-o",
__("Open File Powerpoint", "nexus") => "file-powerpoint-o",
__("Open File Photo", "nexus") => "file-photo-o",
__("Open File Picture", "nexus") => "file-picture-o",
__("Open File Image", "nexus") => "file-image-o",
__("Open File Zip", "nexus") => "file-zip-o",
__("Open File Archive", "nexus") => "file-archive-o",
__("Open File Sound", "nexus") => "file-sound-o",
__("Open File Audio", "nexus") => "file-audio-o",
__("Open File Movie", "nexus") => "file-movie-o",
__("Open File Video", "nexus") => "file-video-o",
__("Open File Code", "nexus") => "file-code-o",
__("Open Circle Notch", "nexus") => "circle-o-notch",
__("Open Send", "nexus") => "send-o",
__("Open Paper Plane", "nexus") => "paper-plane-o",
__("Pinterest", "nexus") => "pinterest",
__("Pinterest Square", "nexus") => "pinterest-square",
__("Paste", "nexus") => "paste",
__("Power Off", "nexus") => "power-off",
__("Print", "nexus") => "print",
__("Photo", "nexus") => "photo",
__("Play", "nexus") => "play",
__("Pause", "nexus") => "pause",
__("Plus Circle", "nexus") => "plus-circle",
__("Plus", "nexus") => "plus",
__("Plane", "nexus") => "plane",
__("Phone", "nexus") => "phone",
__("phone-square", "nexus") => "Phone Square",
__("Paper Clip", "nexus") => "paperclip",
__("Puzzle Piece", "nexus") => "puzzle-piece",
__("Play Circle", "nexus") => "play-circle",
__("Pencil Square", "nexus") => "pencil-square",
__("Page Lines", "nexus") => "pagelines",
__("Pied Piper Square", "nexus") => "pied-piper-square",
__("Pied Piper", "nexus") => "pied-piper",
__("Pied Piper Alt", "nexus") => "pied-piper-alt",
__("Paw", "nexus") => "paw",
__("Paper Plane", "nexus") => "paper-plane",
__("Paragraph", "nexus") => "paragraph",
__("Plus Square", "nexus") => "plus-square",
__("QR Code", "nexus") => "qrcode",
__("Question Circle", "nexus") => "question-circle",
__("Question", "nexus") => "question",
__("QQ", "nexus") => "qq",
__("Quote Left", "nexus") => "quote-left",
__("Quote Right", "nexus") => "quote-right",
__("Random", "nexus") => "random",
__("Retweet", "nexus") => "retweet",
__("Rss", "nexus") => "rss",
__("Reorder", "nexus") => "reorder",
__("Rotate Left", "nexus") => "rotate-left",
__("Road", "nexus") => "road",
__("Rotate Right", "nexus") => "rotate-right",
__("Repeat", "nexus") => "repeat",
__("Refresh", "nexus") => "refresh",
__("Reply", "nexus") => "reply",
__("Rocket", "nexus") => "rocket",
__("Rss Square", "nexus") => "rss-square",
__("Rupee", "nexus") => "rupee",
__("RMB", "nexus") => "rmb",
__("Ruble", "nexus") => "ruble",
__("Rouble", "nexus") => "rouble",
__("Rub", "nexus") => "rub",
__("Renren", "nexus") => "renren",
__("Reddit", "nexus") => "reddit",
__("Reddit Square", "nexus") => "reddit-square",
__("Recycle", "nexus") => "recycle",
__("RA", "nexus") => "ra",
__("Rebel", "nexus") => "rebel",
__("Step Backward", "nexus") => "step-backward",
__("Stop", "nexus") => "stop",
__("Step Forward", "nexus") => "step-forward",
__("Share", "nexus") => "share",
__("Shopping Cart", "nexus") => "shopping-cart",
__("Star Half", "nexus") => "star-half",
__("Sign Out", "nexus") => "sign-out",
__("Sign In", "nexus") => "sign-in",
__("Scissors", "nexus") => "scissors",
__("Save", "nexus") => "save",
__("Square", "nexus") => "square",
__("Strikethrough", "nexus") => "strikethrough",
__("Sort", "nexus") => "sort",
__("Sort Down", "nexus") => "sort-down",
__("Sort Desc", "nexus") => "sort-desc",
__("Sort Up", "nexus") => "sort-up",
__("Sort Asc", "nexus") => "sort-asc",
__("Sitemap", "nexus") => "sitemap",
__("Search", "nexus") => "search",
__("Star", "nexus") => "star",
__("Stethoscope", "nexus") => "stethoscope",
__("Suitcase", "nexus") => "suitcase",
__("Search Plus", "nexus") => "search-plus",
__("Search Minus", "nexus") => "search-minus",
__("Signal", "nexus") => "signal",
__("Spinner", "nexus") => "Spinner",
__("Superscript", "nexus") => "superscript",
__("Subscript", "nexus") => "subscript",
__("Shield", "nexus") => "shield",
__("Share Square", "nexus") => "share-square",
__("Sort Alpha Asc", "nexus") => "sort-alpha-asc",
__("Sort Alpha Desc", "nexus") => "sort-alpha-desc",
__("Sort Amount ASC", "nexus") => "sort-amount-asc",
__("Sort Amount Desc", "nexus") => "sort-amount-desc",
__("Sort Numeric Asc", "nexus") => "sort-numeric-asc",
__("Sort Numeric Desc", "nexus") => "sort-numeric-desc",
__("Stack Overflow", "nexus") => "stack-overflow",
__("Skype", "nexus") => "skype",
__("Stack Exchange", "nexus") => "stack-exchange",
__("Space Shuttle", "nexus") => "space-shuttle",
__("Slack", "nexus") => "Slack",
__("Stumbleupon Circle", "nexus") => "stumbleupon-circle",
__("Stumbleupon", "nexus") => "stumbleupon",
__("Spoon", "nexus") => "spoon",
__("Steam", "nexus") => "steam",
__("Steam Square", "nexus") => "steam-square",
__("Spotify", "nexus") => "spotify",
__("Sound Cloud", "nexus") => "soundcloud",
__("Support", "nexus") => "support",
__("Send", "nexus") => "send",
__("Sliders", "nexus") => "sliders",
__("Share Alt", "nexus") => "share-alt",
__("Share Alt Square", "nexus") => "share-alt-square",
__("Tag", "nexus") => "tag",
__("Tags", "nexus") => "tags",
__("Text Height", "nexus") => "text-height",
__("Text Width", "nexus") => "text-width",
__("Times Circle", "nexus") => "times-circle",
__("Twitter Square", "nexus") => "twitter-square",
__("Thumb Tack", "nexus") => "thumb-tack",
__("Trophy", "nexus") => "trophy",
__("Twitter", "nexus") => "twitter",
__("Tasks", "nexus") => "tasks",
__("Truck", "nexus") => "truck",
__("Tachometer", "nexus") => "tachometer",
__("Thumbnail Large", "nexus") => "th-large",
__("Thumbnail", "nexus") => "th",
__("Thumbnail List", "nexus") => "th-list",
__("Times", "nexus") => "times",
__("Ticket", "nexus") => "ticket",
__("Toggle Down", "nexus") => "toggle-down",
__("Toggle Up", "nexus") => "toggle-up",
__("Toggle Right", "nexus") => "toggle-right",
__("Thumbs Up", "nexus") => "thumbs-up",
__("Thumbs Down", "nexus") => "thumbs-down",
__("Tumblr", "nexus") => "tumblr",
__("Tumblr Square", "nexus") => "tumblr-square",
__("Trello", "nexus") => "trello",
__("Toggle Left", "nexus") => "toggle-left",
__("Turkish Lira", "nexus") => "turkish-lira",
__("Try", "nexus") => "try",
__("Taxi", "nexus") => "taxi",
__("Tree", "nexus") => "tree",
__("Tencent Weibo", "nexus") => "tencent-weibo",
__("Tablet", "nexus") => "tablet",
__("Terminal", "nexus") => "terminal",
__("Upload", "nexus") => "upload",
__("Unlock", "nexus") => "unlock",
__("Users", "nexus") => "users",
__("Underline", "nexus") => "underline",
__("Unsorted", "nexus") => "unsorted",
__("Undo", "nexus") => "undo",
__("User md", "nexus") => "user-md",
__("Umbrella", "nexus") => "umbrella",
__("User", "nexus") => "user",
__("Unlock Alt", "nexus") => "unlock-alt",
__("USD", "nexus") => "usd",
__("University", "nexus") => "university",
__("Unlink", "nexus") => "unlink",
__("Volume Off", "nexus") => "volume-off",
__("Volume Down", "nexus") => "volume-down",
__("Volume Up", "nexus") => "volume-up",
__("Video Camera", "nexus") => "video-camera",
__("VK", "nexus") => "vk",
__("Vimeo Square", "nexus") => "vimeo-square",
__("Vine", "nexus") => "vine",
__("Warning", "nexus") => "warning",
__("Wrench", "nexus") => "wrench",
__("Won", "nexus") => "won",
__("Windows", "nexus") => "windows",
__("Weibo", "nexus") => "weibo",
__("Wheel Chair", "nexus") => "wheelchair",
__("WordPress", "nexus") => "wordpress",
__("We Chat", "nexus") => "wechat",
__("Weixin", "nexus") => "weixin",
__("Xing", "nexus") => "xing",
__("Xing Square", "nexus") => "xing-square",
__("YEN", "nexus") => "yen",
__("Youtube Square", "nexus") => "youtube-square",
__("Youtube", "nexus") => "youtube",
__("Youtube Play", "nexus") => "youtube-play",
__("Yahoo", "nexus") => "yahoo",
);

$nexus_livicon_icon_arr = array(
__("AT", "nexus") => "at",
__("balloons", "nexus") => "balloons",
__("bank", "nexus") => "bank",
__("bomb", "nexus") => "bomb",
__("calculator", "nexus") => "calculator",
__("folders", "nexus") => "folders",
__("ice-cream", "nexus") => "ice-cream",
__("medkit", "nexus") => "medkit",
__("paper-plane", "nexus") => "paper-plane",
__("wine", "nexus") => "wine",
__("connect", "nexus") => "connect",
__("disconnect", "nexus") => "disconnect",
__("collapse-down", "nexus") => "collapse-down",
__("collapse-up", "nexus") => "collapse-up",
__("expand-left", "nexus") => "expand-left",
__("expand-right", "nexus") => "expand-right",
__("battery", "nexus") => "battery",
__("medal", "nexus") => "medal",
__("servers", "nexus") => "servers",
__("apple-logo", "nexus") => "apple-logo",
__("bing", "nexus") => "bing",
__("bitbucket", "nexus") => "bitbucket",
__("blogger", "nexus") => "blogger",
__("concrete5", "nexus") => "concrete5",
__("deviantart", "nexus") => "deviantart",
__("dribbble", "nexus") => "dribbble",
__("github", "nexus") => "github",
__("github-alt", "nexus") => "github-alt",
__("instagram", "nexus") => "instagram",
__("opera", "nexus") => "opera",
__("reddit", "nexus") => "reddit",
__("soundcloud", "nexus") => "soundcloud",
__("tumblr", "nexus") => "tumblr",
__("vimeo", "nexus") => "vimeo",
__("vk", "nexus") => "VK",
__("xing", "nexus") => "xing",
__("yahoo", "nexus") => "yahoo",
__("address-book", "nexus") => "address-book",
__("albums", "nexus") => "albums",
__("anchor", "nexus") => "anchor",
__("archive-add", "nexus") => "archive-add",
__("archive-extract", "nexus") => "archive-extract",
__("asterisk", "nexus") => "asterisk",
__("bluetooth", "nexus") => "bluetooth",
__("brightness-down", "nexus") => "brightness-down",
__("brightness-up", "nexus") => "brightness-up",
__("crop", "nexus") => "crop",
__("eyedropper", "nexus") => "eyedropper",
__("file-export", "nexus") => "file-export",
__("folder-add", "nexus") => "older-add",
__("folder-flag", "nexus") => "folder-flag",
__("folder-lock", "nexus") => "folder-lock",
__("folder-new", "nexus") => "folder-new",
__("folder-open", "nexus") => "folder-open",
__("folder-remove", "nexus") => "folder-remove",
__("inbox-empty", "nexus") => "inbox-empty",
__("inbox-in", "nexus") => "inbox-in",
__("inbox-out", "nexus") => "inbox-out",
__("indent-left", "nexus") => "indent-left",
__("indent-right", "nexus") => "indent-right",
__("message-add", "nexus") => "message-add",
__("message-flag", "nexus") => "message-flag",
__("message-in", "nexus") => "message-in",
__("message-lock", "nexus") => "message-lock",
__("message-new", "nexus") => "message-new",
__("message-out", "nexus") => "essage-out",
__("message-remove", "nexus") => "message-remove",
__("microphone", "nexus") => "microphone",
__("moon", "nexus") => "moon",
__("new-window", "nexus") => "new-window",
__("pin-off", "nexus") => "pin-off",
__("pin-on", "nexus") => "pin-on",
__("playlist", "nexus") => "playlist",
__("save", "nexus") => "save",
__("shopping-cart-in", "nexus") => "shopping-cart-in",
__("shopping-cart-out", "nexus") => "shopping-cart-out",
__("striked", "nexus") => "striked",
__("text-decrease", "nexus") => "text-decrease",
__("text-height", "nexus") => "text-height",
__("text-increase", "nexus") => "text-increase",
__("text-size", "nexus") => "text-size",
__("text-width", "nexus") => "text-width",
__("thumbnails-big", "nexus") => "thumbnails-big",
__("thumbnails-small", "nexus") => "thumbnails-small",
__("timer", "nexus") => "timer",
__("unlink", "nexus") => "unlink",
__("user-add", "nexus") => "user-add",
__("user-ban", "nexus") => "user-ban",
__("user-flag", "nexus") => "user-flag",
__("user-remove", "nexus") => "user-remove",
__("users-add", "nexus") => "users-add",
__("users-ban", "nexus") => "users-ban",
__("users-remove", "nexus") => "users-remove",
__("vector-circle", "nexus") => "vector-circle",
__("vector-curve", "nexus") => "vector-curve",
__("vector-line", "nexus") => "vector-line",
__("vector-polygon", "nexus") => "vector-polygon",
__("vector-square", "nexus") => "vector-square",
__("webcam", "nexus") => "webcam",
__("wifi", "nexus") => "wifi",
__("wifi-alt", "nexus") => "wifi-alt",
__("adjust", "nexus") => "adjust",
__("alarm", "nexus") => "alarm",
__("align-center", "nexus") => "align-center",
__("align-justify", "nexus") => "align-justify",
__("align-left", "nexus") => "align-left",
__("align-right", "nexus") => "lign-right",
__("android", "nexus") => "android",
__("angle-wide-down", "nexus") => "angle-wide-down",
__("angle-wide-left", "nexus") => "angle-wide-left",
__("angle-wide-right", "nexus") => "angle-wide-right",
__("angle-wide-up", "nexus") => "angle-wide-up",
__("angle-double-down", "nexus") => "angle-double-down",
__("angle-double-left", "nexus") => "angle-double-left",
__("angle-double-right", "nexus") => "angle-double-right",
__("angle-double-up", "nexus") => "angle-double-up",
__("angle-down", "nexus") => "angle-down",
__("angle-left", "nexus") => "angle-left",
__("angle-right", "nexus") => "angle-right",
__("angle-up", "nexus") => "angle-up",
__("apple", "nexus") => "apple",
__("arrow-circle-down", "nexus") => "arrow-circle-down",
__("arrow-circle-left", "nexus") => "arrow-circle-left",
__("arrow-circle-right", "nexus") => "arrow-circle-right",
__("arrow-circle-up", "nexus") => "arrow-circle-up",
__("arrow-down", "nexus") => "arrow-down",
__("arrow-left", "nexus") => "arrow-left",
__("arrow-right", "nexus") => "arrow-right",
__("arrow-up", "nexus") => "arrow-up",
__("balance", "nexus") => "balance",
__("ban", "nexus") => "ban",
__("barchart", "nexus") => "barchart",
__("barcode", "nexus") => "barcode",
__("beer", "nexus") => "beer",
__("bell", "nexus") => "bell",
__("biohazard", "nexus") => "biohazard",
__("bold", "nexus") => "bold",
__("bolt", "nexus") => "bolt",
__("bookmark", "nexus") => "bookmark",
__("bootstrap", "nexus") => "bootstrap",
__("briefcase", "nexus") => "briefcase",
__("brush", "nexus") => "brush",
__("bug", "nexus") => "bug",
__("calendar", "nexus") => "calendar",
__("camcoder", "nexus") => "camcoder",
__("camera", "nexus") => "camera",
__("camera-alt", "nexus") => "camera-alt",
__("car", "nexus") => "car",
__("caret-down", "nexus") => "caret-down",
__("caret-left", "nexus") => "caret-left",
__("caret-right", "nexus") => "caret-right",
__("caret-up", "nexus") => "caret-up",
__("cellphone", "nexus") => "cellphone",
__("certificate", "nexus") => "certificate",
__("check", "nexus") => "check",
__("check-circle", "nexus") => "check-circle",
__("check-circle-alt", "nexus") => "check-circle-alt",
__("checked-off", "nexus") => "checked-off",
__("checked-on", "nexus") => "checked-on",
__("chevron-down", "nexus") => "chevron-down",
__("chevron-left", "nexus") => "chevron-left",
__("chevron-right", "nexus") => "chevron-right",
__("chevron-up", "nexus") => "chevron-up",
__("chrome", "nexus") => "chrome",
__("circle", "nexus") => "circle",
__("circle-alt", "nexus") => "circle-alt",
__("clapboard", "nexus") => "clapboard",
__("clip", "nexus") => "clip",
__("clock", "nexus") => "clock",
__("cloud", "nexus") => "cloud",
__("cloud-bolts", "nexus") => "cloud-bolts",
__("cloud-down", "nexus") => "cloud-down",
__("cloud-rain", "nexus") => "cloud-rain",
__("cloud-snow", "nexus") => "cloud-snow",
__("cloud-sun", "nexus") => "cloud-sun",
__("cloud-up", "nexus") => "cloud-up",
__("Code", "nexus") => "code",
__("columns", "nexus") => "columns",
__("comment", "nexus") => "comment",
__("comments", "nexus") => "comments",
__("compass", "nexus") => "compass",
__("credit-card", "nexus") => "credit-card",
__("css3", "nexus") => "CSS3",
__("dashboard", "nexus") => "dashboard",
__("desktop", "nexus") => "desktop",
__("doc-landscape", "nexus") => "doc-landscape",
__("doc-portrait", "nexus") => "doc-portrait",
__("download", "nexus") => "download",
__("download-alt", "nexus") => "download-alt",
__("drop", "nexus") => "drop",
__("dropbox", "nexus") => "dropbox",
__("edit", "nexus") => "edit",
__("exchange", "nexus") => "exchange",
__("external-link", "nexus") => "external-link",
__("eye-close", "nexus") => "eye-close",
__("eye-open", "nexus") => "eye-open",
__("facebook", "nexus") => "facebook",
__("facebook-alt", "nexus") => "facebook-alt",
__("film", "nexus") => "film",
__("filter", "nexus") => "filter",
__("fire", "nexus") => "fire",
__("firefox", "nexus") => "firefox",
__("flag", "nexus") => "flag",
__("flickr", "nexus") => "flickr",
__("flickr-alt", "nexus") => "flickr-alt",
__("font", "nexus") => "font",
__("gear", "nexus") => "gear",
__("gears", "nexus") => "gears",
__("ghost", "nexus") => "ghost",
__("gift", "nexus") => "gift",
__("glass", "nexus") => "glass",
__("globe", "nexus") => "globe",
__("google-plus", "nexus") => "google-plus",
__("google-plus-alt", "nexus") => "google-plus-alt",
__("hammer", "nexus") => "hammer",
__("hand-down", "nexus") => "hand-down",
__("hand-left", "nexus") => "and-left",
__("hand-right", "nexus") => "hand-right",
__("hand-up", "nexus") => "hand-up",
__("heart", "nexus") => "heart",
__("heart-alt", "nexus") => "heart-alt",
__("help", "nexus") => "help",
__("home", "nexus") => "home",
__("HTML5", "nexus") => "html5",
__("IE", "nexus") => "ie",
__("image", "nexus") => "image",
__("inbox", "nexus") => "inbox",
__("info", "nexus") => "info",
__("ios", "nexus") => "iOS",
__("italic", "nexus") => "italic",
__("jquery", "nexus") => "jquery",
__("key", "nexus") => "key",
__("lab", "nexus") => "lab",
__("laptop", "nexus") => "laptop",
__("leaf", "nexus") => "leaf",
__("legal", "nexus") => "legal",
__("linechart", "nexus") => "linechart",
__("link", "nexus") => "link",
__("linkedin", "nexus") => "linkedin",
__("linkedin-alt", "nexus") => "linkedin-alt",
__("list", "nexus") => "list",
__("list-ol", "nexus") => "list-ol",
__("list-ul", "nexus") => "list-ul",
__("location", "nexus") => "location",
__("lock", "nexus") => "lock",
__("magic", "nexus") => "magic",
__("magic-alt", "nexus") => "magic-alt",
__("magnet", "nexus") => "magnet",
__("mail", "nexus") => "mail",
__("mail-alt", "nexus") => "mail-alt",
__("map", "nexus") => "map",
__("minus", "nexus") => "minus",
__("minus-alt", "nexus") => "minus-alt",
__("money", "nexus") => "money",
__("more", "nexus") => "more",
__("morph-c-s", "nexus") => "morph-c-s",
__("morph-c-o", "nexus") => "morph-c-o",
__("morph-s-c", "nexus") => "morph-s-c",
__("morph-s-o", "nexus") => "morph-s-o",
__("morph-o-c", "nexus") => "morph-o-c",
__("morph-o-s", "nexus") => "morph-o-s",
__("morph-c-t-up", "nexus") => "morph-c-t-up",
__("morph-s-t-up", "nexus") => "morph-s-t-up",
__("morph-o-t-up", "nexus") => "morph-o-t-up",
__("morph-t-up-c", "nexus") => "morph-t-up-c",
__("morph-t-up-s", "nexus") => "morph-t-up-s",
__("morph-t-up-o", "nexus") => "morph-t-up-o",
__("morph-c-t-right", "nexus") => "morph-c-t-right",
__("morph-s-t-right", "nexus") => "morph-s-t-right",
__("morph-o-t-right", "nexus") => "morph-o-t-right",
__("morph-t-right-c", "nexus") => "morph-t-right-c",
__("morph-t-right-s", "nexus") => "morph-t-right-s",
__("morph-t-right-o", "nexus") => "morph-t-right-o",
__("morph-c-t-down", "nexus") => "morph-c-t-down",
__("morph-s-t-down", "nexus") => "morph-s-t-down",
__("morph-o-t-down", "nexus") => "morph-o-t-down",
__("morph-t-down-c", "nexus") => "morph-t-down-c",
__("morph-t-down-s", "nexus") => "morph-t-down-s",
__("morph-t-down-o", "nexus") => "morph-t-down-o",
__("morph-c-t-left", "nexus") => "morph-c-t-left",
__("morph-s-t-left", "nexus") => "morph-s-t-left",
__("morph-o-t-left", "nexus") => "morph-o-t-left",
__("morph-t-left-c", "nexus") => "morph-t-left-c",
__("morph-t-left-s", "nexus") => "morph-t-left-s",
__("morph-t-left-o", "nexus") => "morph-t-left-o",
__("move", "nexus") => "move",
__("music", "nexus") => "music",
__("myspace", "nexus") => "myspace",
__("notebook", "nexus") => "notebook",
__("pacman", "nexus") => "pacman",
__("paypal", "nexus") => "paypal",
__("pen", "nexus") => "pen",
__("pencil", "nexus") => "pencil",
__("phone", "nexus") => "phone",
__("piechart", "nexus") => "piechart",
__("piggybank", "nexus") => "piggybank",
__("pinterest", "nexus") => "pinterest",
__("pinterest-alt", "nexus") => "pinterest-alt",
__("plane-down", "nexus") => "plane-down",
__("plane-up", "nexus") => "plane-up",
__("plus", "nexus") => "plus",
__("plus-alt", "nexus") => "plus-alt",
__("presentation", "nexus") => "presentation",
__("printer", "nexus") => "printer",
__("qrcode", "nexus") => "qrcode",
__("question", "nexus") => "question",
__("quote-left", "nexus") => "quote-left",
__("quote-right", "nexus") => "quote-right",
__("raphael", "nexus") => "raphael",
__("recycled", "nexus") => "recycled",
__("redo", "nexus") => "redo",
__("refresh", "nexus") => "refresh",
__("remove", "nexus") => "remove",
__("remove-alt", "nexus") => "remove-alt",
__("remove-circle", "nexus") => "remove-circle",
__("resize-big", "nexus") => "resize-big",
__("resize-big-alt", "nexus") => "resize-big-alt",
__("resize-horizontal", "nexus") => "resize-horizontal",
__("resize-horizontal-alt", "nexus") => "resize-horizontal-alt",
__("resize-small", "nexus") => "resize-small",
__("resize-small-alt", "nexus") => "resize-small-alt",
__("resize-vertical", "nexus") => "resize-vertical",
__("resize-vertical-alt", "nexus") => "esize-vertical-alt",
__("responsive", "nexus") => "responsive",
__("responsive-menu", "nexus") => "responsive-menu",
__("retweet", "nexus") => "retweet",
__("rocket", "nexus") => "rocket",
__("rotate-right", "nexus") => "rotate-right",
__("rotate-left", "nexus") => "rotate-left",
__("rss", "nexus") => "rss",
__("safari", "nexus") => "safari",
__("sandglass", "nexus") => "sandglass",
__("scissors", "nexus") => "scissors",
__("screen-full", "nexus") => "screen-full",
__("screen-full-alt", "nexus") => "screen-full-alt",
__("screen-small", "nexus") => "screen-small",
__("screen-small-alt", "nexus") => "screen-small-alt",
__("screenshot", "nexus") => "screenshot",
__("search", "nexus") => "search",
__("settings", "nexus") => "settings",
__("share", "nexus") => "share",
__("shield", "nexus") => "shield",
__("shopping-cart", "nexus") => "shopping-cart",
__("shuffle", "nexus") => "shuffle",
__("sign-in", "nexus") => "sign-in",
__("sign-out", "nexus") => "sign-out",
__("signal", "nexus") => "signal",
__("sitemap", "nexus") => "sitemap",
__("sky-dish", "nexus") => "sky-dish",
__("skype", "nexus") => "skype",
__("sort", "nexus") => "sort",
__("sort-down", "nexus") => "sort-down",
__("sort-up", "nexus") => "sort-up",
__("speaker", "nexus") => "speaker",
__("spinner-one", "nexus") => "spinner-one",
__("spinner-two", "nexus") => "spinner-two",
__("spinner-three", "nexus") => "spinner-three",
__("spinner-four", "nexus") => "spinner-four",
__("spinner-five", "nexus") => "spinner-five",
__("spinner-six", "nexus") => "spinner-six",
__("spinner-seven", "nexus") => "spinner-seven",
__("star-empty", "nexus") => "star-empty",
__("star-full", "nexus") => "star-full",
__("star-half", "nexus") => "star-half",
__("stopwatch", "nexus") => "stopwatch",
__("stumbleupon", "nexus") => "stumbleupon",
__("stumbleupon-alt", "nexus") => "stumbleupon-alt",
__("sun", "nexus") => "sun",
__("table", "nexus") => "table",
__("tablet", "nexus") => "tablet",
__("tag", "nexus") => "tag",
__("tags", "nexus") => "tags",
__("tasks", "nexus") => "tasks",
__("thermo-down", "nexus") => "thermo-down",
__("thermo-up", "nexus") => "thermo-up",
__("thumbs-down", "nexus") => "thumbs-down",
__("thumbs-up", "nexus") => "thumbs-up",
__("trash", "nexus") => "trash",
__("tree", "nexus") => "tree",
__("trophy", "nexus") => "trophy",
__("truck", "nexus") => "truck",
__("twitter", "nexus") => "twitter",
__("twitter-alt", "nexus") => "twitter-alt",
__("umbrella", "nexus") => "umbrella",
__("underline", "nexus") => "underline",
__("undo", "nexus") => "undo",
__("unlock", "nexus") => "unlock",
__("upload", "nexus") => "upload",
__("upload-alt", "nexus") => "upload-alt",
__("user", "nexus") => "user",
__("users", "nexus") => "users",
__("video-play", "nexus") => "video-play",
__("video-play-alt", "nexus") => "video-play-alt",
__("video-stop", "nexus") => "ideo-stop",
__("video-pause", "nexus") => "video-pause",
__("video-eject", "nexus") => "video-eject",
__("video-backward", "nexus") => "video-backward",
__("video-step-backward", "nexus") => "video-step-backward",
__("video-fast-backward", "nexus") => "video-fast-backward",
__("video-forward", "nexus") => "video-forward",
__("video-step-forward", "nexus") => "video-step-forward",
__("video-fast-forward", "nexus") => "video-fast-forward",
__("warning", "nexus") => "warning",
__("warning-alt", "nexus") => "warning-alt",
__("windows", "nexus") => "windows",
__("windows8", "nexus") => "windows8",
__("wordpress", "nexus") => "wordpress",
__("wordpress-alt", "nexus") => "wordpress-alt",
__("wrench", "nexus") => "wrench",
__("youtube", "nexus") => "youtube",
__("zoom-in", "nexus") => "zoom-in",
__("zoom-out", "nexus") => "zoom-out",
__("livicon", "nexus") => "livicon"
);




/***************************************************/
/*Nexus Menu Fall Back Function - Started */
/***************************************************/
function nexus_menu_fall_back(){
	echo '<ul>';
	wp_list_pages(array('title_li'  => '', 'sort_column'=> 'menu_order',));
    echo '</ul>';	
}
/***************************************************/
/*Nexus Menu Fall Back Function - End */
/***************************************************/

/***************************************************/
/*Nexus excerpt string function - Started */
/***************************************************/
function nexus_excerpt_more_string( $more ) {return '...';}
/***************************************************/
/*Nexus excerpt string function - End */
/***************************************************/

/***************************************************/
/*Nexus excerpt length Function - Started */
/***************************************************/
function nexus_custom_excerpt_length( $length ) {return 80;}
/***************************************************/
/*Nexus excerpt length Function - End */
/***************************************************/

/***************************************************/
/*Nexus , Add Shortcodes to Visual Composer - Started */
/***************************************************/
if(function_exists('vc_map')){

	/*------------------------------------------------------
	Identity Map - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Map" , "sentient"),
	   "base" => "identity_map",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Location Main Title" , "sentient"),
			 "param_name" => "loctitle",
			 "value" => "ProfTeamSolutions",
			 "description" => __("Please Enter Location Main title" , "sentient")
		  ),
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Location Description" , "sentient"),
			 "param_name" => "locdesc",
			 "value" => "12, Segun Bagicha, 10th floor, Dhaka, Bangladesh. Lorem ipsum dolor sit amet incididunt ut labore et dolore psum dolor magna aliqua.",
			 "description" => __("Please Enter Location Description" , "sentient")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Map Latitude" , "sentient"),
			 "param_name" => "latitude",
			 "value" => "-37.809674",
			 "description" => __("Please Enter Map Latitude Value" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Map embed Longitude" , "sentient"),
			 "param_name" => "longitude",
			 "value" => "144.954718",
			 "description" => __("Please Enter Map Longitude Value" , "sentient")
		  )	  
	   )
	) );
	
	/*------------------------------------------------------
	Nexus Homepage Row Start - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Row Begin" , "nexus"),
	   "base" => "homepage_container",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Color?" , "nexus"),
			 "param_name" => "type",
			 "value" => $nexus_yes_no_arr,
			 "description" => __("If you choose No it will put the background image." , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background color" , "nexus"),
			 "param_name" => "color",
			 "value" => "#FFFFFF",
			 "description" => __("Please Choose Background color for your Row" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Font color" , "nexus"),
			 "param_name" => "font",
			 "value" => "#787878",
			 "description" => __("Please Choose Font color for your Row" , "nexus")
		  ),
		  array(
			 "type" => "attach_image",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Image" , "nexus"),
			 "param_name" => "background",
			 "value" => "",
			 "description" => __("Please Choose Background Image for your Row" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Position" , "nexus"),
			 "param_name" => "backgroundposition",
			 "value" => "0 0",
			 "description" => __("Background Position for your row background (e.g. 0 0 , center center , ...etc)" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Size" , "nexus"),
			 "param_name" => "backgroundsize",
			 "value" => "100%",
			 "description" => __("Background Size for your row background (e.g. 100% , 50% , ...etc)" , "nexus")
		  ),		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Make it Parallax" , "nexus"),
			 "param_name" => "parallax",
			 "value" => $nexus_yes_no_arr,
			 "description" => __("Do you want to make Background Image Parallax?" , "nexus")
		  ),		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Image Repeat" , "nexus"),
			 "param_name" => "repeat",
			 "value" => $nexus_yes_no_arr,
			 "description" => __("Do you want to Repeat Background Image?" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Padding from Top" , "nexus"),
			 "param_name" => "paddingtop",
			 "value" => "40px",
			 "description" => __("Distance between row and content from top side" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Padding from Bottom" , "nexus"),
			 "param_name" => "paddingbottom",
			 "value" => "40px",
			 "description" => __("Distance between row and content from bottom side" , "nexus")
		  )
	   )
	) );
	
	/*------------------------------------------------------
	Nexus Homepage Row Wide Start - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Row Wide Begin" , "nexus"),
	   "base" => "homepage_container_wide",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Color?" , "nexus"),
			 "param_name" => "type",
			 "value" => $nexus_yes_no_arr,
			 "description" => __("If you choose No it will put the background image." , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background color" , "nexus"),
			 "param_name" => "color",
			 "value" => "#FFFFFF",
			 "description" => __("Please Choose Background color for your Row" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Font color" , "nexus"),
			 "param_name" => "font",
			 "value" => "#787878",
			 "description" => __("Please Choose Font color for your Row" , "nexus")
		  ),
		  array(
			 "type" => "attach_image",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Image" , "nexus"),
			 "param_name" => "background",
			 "value" => "",
			 "description" => __("Please Choose Background Image for your Row" , "nexus")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Image Repeat" , "nexus"),
			 "param_name" => "repeat",
			 "value" => $nexus_yes_no_arr,
			 "description" => __("Do you want to Repeat Background Image?" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Padding from Top" , "nexus"),
			 "param_name" => "paddingtop",
			 "value" => "40px",
			 "description" => __("Distance between row and content from top side" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Padding from Bottom" , "nexus"),
			 "param_name" => "paddingbottom",
			 "value" => "40px",
			 "description" => __("Distance between row and content from bottom side" , "nexus")
		  )
	   )
	) );

	/*------------------------------------------------------
	Nexus Stripes - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Stripes" , "nexus"),
	   "base" => "nexus_stripes",
	   "class" => "",
	   "show_settings_on_create" => false,   
	   "category" => __('Content' , "nexus"),
	   "params" => array()
	) );	
	
	/*------------------------------------------------------
	Nexus Homepage Row End - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Row End" , "nexus"),
	   "base" => "homepage_container_end",
	   "class" => "",  
	   "category" => __('Content' , "nexus"),
	   "show_settings_on_create" => false, 
	   "params" => array()
	) );

	/*------------------------------------------------------
	Nexus Percentage Bar Text - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Percentage Bar" , "nexus"),
	   "base" => "nexus_percentage_bar",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Bar Title" , "nexus"),
			 "param_name" => "title",
			 "value" => "",
			 "description" => __("Enter Bar Title" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Bar Percentage" , "nexus"),
			 "param_name" => "percentage",
			 "value" => "",
			 "description" => __("Enter Bar Percentage" , "nexus")
		  ),		  
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Bar color" , "nexus"),
			 "param_name" => "color",
			 "value" => "#111111",
			 "description" => __("Please Choose color for your Bar Block" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Bar Title color" , "nexus"),
			 "param_name" => "titlecolor",
			 "value" => "#1795c5",
			 "description" => __("Please Choose Title color for your Bar Block" , "nexus")
		  )		  
	   )
	) );		
	
	/*------------------------------------------------------
	Nexus Single Icon - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Single Icon" , "nexus"),
	   "base" => "nexus_icon",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Choose Icon" , "nexus"),
			 "param_name" => "icon",
			 "value" => $nexus_livicon_icon_arr,
			 "description" => __("Please choose Icon" , "nexus")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Keep original color?" , "nexus"),
			 "param_name" => "original",
			 "value" => $nexus_yes_no_arr,
			 "description" => __("Do you want to keep icon original color?" , "nexus")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon Tooltip" , "nexus"),
			 "param_name" => "tooltip",
			 "value" => "",
			 "description" => __("Please Enter Icon Tooltip" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon Size" , "nexus"),
			 "param_name" => "size",
			 "value" => "",
			 "description" => __("Enter number 1 is small 50 is medium and 100 is big" , "nexus")
		  ),			  
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon color" , "nexus"),
			 "param_name" => "color",
			 "value" => "#111111",
			 "description" => __("If Original option is disabled then this color will be used" , "nexus")
		  )	  
	   )
	) );			
	
	/*------------------------------------------------------
	Nexus Socials - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Socials" , "nexus"),
	   "base" => "nexus_socials",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Choose Social Icon" , "nexus"),
			 "param_name" => "icon",
			 "value" => $nexus_socials,
			 "description" => __("Please choose Social Icon" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Enter Number (e.g. Number of likes)" , "nexus"),
			 "param_name" => "number",
			 "value" => "",
			 "description" => __("Please Enter Number (e.g. Number of likes)" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Enter the word/title" , "nexus"),
			 "param_name" => "word",
			 "value" => "",
			 "description" => __("Please Enter the word/title that will be displayed under the number (e.g. Likes/Shares..etc)" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Enter the link of Socials" , "nexus"),
			 "param_name" => "link",
			 "value" => "",
			 "description" => __("Please Enter the link of Socials" , "nexus")
		  )		  
	   )
	) );	
	
	/*------------------------------------------------------
	Nexus Service Widget - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Services Widget Style 2" , "nexus"),
	   "base" => "nexus_service_widget_style_two",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Choose Icon" , "nexus"),
			 "param_name" => "icon",
			 "value" => $nexus_livicon_icon_arr,
			 "description" => __("Please choose Icon" , "nexus")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Keep Original color?" , "nexus"),
			 "param_name" => "original",
			 "value" => $nexus_yes_no_arr,
			 "description" => __("Do you want to keep icon original color?" , "nexus")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Widget Title" , "nexus"),
			 "param_name" => "title",
			 "value" => "",
			 "description" => __("Please Enter Widget Title" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Widget Sub Title" , "nexus"),
			 "param_name" => "subtitle",
			 "value" => "",
			 "description" => __("Please Enter Widget Sub Title" , "nexus")
		  ),		  
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Text Title" , "nexus"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Please Enter Widget Text" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon color" , "nexus"),
			 "param_name" => "color",
			 "value" => "#111111",
			 "description" => __("If Original option is disabled then this color will be used" , "nexus")
		  )	 		  
	   )
	) );

	/*------------------------------------------------------
	Nexus Service Boxes - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Services Box" , "nexus"),
	   "base" => "nexus_service_boxes",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Choose Icon" , "nexus"),
			 "param_name" => "icon",
			 "value" => $nexus_livicon_icon_arr,
			 "description" => __("Please choose Icon" , "nexus")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Keep Original color?" , "nexus"),
			 "param_name" => "original",
			 "value" => $nexus_yes_no_arr,
			 "description" => __("Do you want to keep icon original color?" , "nexus")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Widget Title" , "nexus"),
			 "param_name" => "title",
			 "value" => "",
			 "description" => __("Please Enter Widget Title" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Widget Sub Title" , "nexus"),
			 "param_name" => "subtitle",
			 "value" => "",
			 "description" => __("Please Enter Widget Sub Title" , "nexus")
		  ),		  
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Text Title" , "nexus"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Please Enter Widget Text" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon color" , "nexus"),
			 "param_name" => "color",
			 "value" => "#111111",
			 "description" => __("If Original option is disabled then this color will be used" , "nexus")
		  )	 		  
	   )
	) );	

	/*------------------------------------------------------
	Nexus Pricing Table - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Pricing Table" , "nexus"),
	   "base" => "nexus_pricing_table",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Table color" , "nexus"),
			 "param_name" => "tablecolor",
			 "value" => "#1795c5",
			 "description" => __("Please choose tablecolor" , "nexus")
		  ),	   
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Table Title" , "nexus"),
			 "param_name" => "tabletitle",
			 "value" => "",
			 "description" => __("Please Enter Table Title" , "nexus")
		  ), 
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Table Sub Title" , "nexus"),
			 "param_name" => "tablesubtitle",
			 "value" => "",
			 "description" => __("Please Enter Table Sub Title" , "nexus")
		  ), 
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Choose currency" , "nexus"),
			 "param_name" => "currency",
			 "value" => "",
			 "description" => __("Please Choose currency" , "nexus")
		  ),
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Enter Price" , "nexus"),
			 "param_name" => "price",
			 "value" => "",
			 "description" => __("Please Enter Price" , "nexus")
		  ),  	
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Enter Separator" , "nexus"),
			 "param_name" => "separator",
			 "value" => "",
			 "description" => __("Please Enter Separator" , "nexus")
		  ), 		 
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Plan Period" , "nexus"),
			 "param_name" => "period",
			 "value" => "",
			 "description" => __("Please Enter Plan Period" , "nexus")
		  ),	   
			array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title of first record" , "nexus"),
			 "param_name" => "onetitle",
			 "value" => "",
			 "description" => __("Please Enter Title of first record" , "nexus")
		  ), 		  
			array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Value for first record" , "nexus"),
			 "param_name" => "onevalue",
			 "value" => "",
			 "description" => __("Please Enter Value for first record" , "nexus")
		  ),
		array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon for first record" , "nexus"),
			 "param_name" => "oneicon",
			 "value" => $nexus_icon_arr,
			 "description" => __("Please Icon for table first record" , "nexus")
		  ),		
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title of second record" , "nexus"),
			 "param_name" => "twotitle",
			 "value" => "",
			 "description" => __("Please Enter Title of second record" , "nexus")
		  ), 		  
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Value for second record" , "nexus"),
			 "param_name" => "twovalue",
			 "value" => "",
			 "description" => __("Please Enter Value for second record" , "nexus")
		  ), 		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon for second record" , "nexus"),
			 "param_name" => "twoicon",
			 "value" => $nexus_icon_arr,
			 "description" => __("Please Icon for table second record" , "nexus")
		  ),
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title of third record" , "nexus"),
			 "param_name" => "threetitle",
			 "value" => "",
			 "description" => __("Please Enter Title of third record" , "nexus")
		  ), 		  
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Value for third record" , "nexus"),
			 "param_name" => "threevalue",
			 "value" => "",
			 "description" => __("Please Enter Value for third record" , "nexus")
		  ), 		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon for third record" , "nexus"),
			 "param_name" => "threeicon",
			 "value" => $nexus_icon_arr,
			 "description" => __("Please Icon for table third record" , "nexus")
		  ),
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title of fourth record" , "nexus"),
			 "param_name" => "fourtitle",
			 "value" => "",
			 "description" => __("Please Enter Title of fourth record" , "nexus")
		  ), 		  
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Value for fourth record" , "nexus"),
			 "param_name" => "fourvalue",
			 "value" => "",
			 "description" => __("Please Enter Value for fourth record" , "nexus")
		  ), 		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon for fourth record" , "nexus"),
			 "param_name" => "fouricon",
			 "value" => $nexus_icon_arr,
			 "description" => __("Please Icon for table fourth record" , "nexus")
		  ),
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title of fifth record" , "nexus"),
			 "param_name" => "fivetitle",
			 "value" => "",
			 "description" => __("Please Enter Title of fifth record" , "nexus")
		  ), 		  
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Value for fifth record" , "nexus"),
			 "param_name" => "fivevalue",
			 "value" => "",
			 "description" => __("Please Enter Value for fifth record" , "nexus")
		  ), 		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon for fifth record" , "nexus"),
			 "param_name" => "fiveicon",
			 "value" => $nexus_icon_arr,
			 "description" => __("Please Icon for table fifth record" , "nexus")
		  ),
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title of sixth record" , "nexus"),
			 "param_name" => "sixtitle",
			 "value" => "",
			 "description" => __("Please Enter Title of sixth record" , "nexus")
		  ), 		  
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Value for sixth record" , "nexus"),
			 "param_name" => "sixvalue",
			 "value" => "",
			 "description" => __("Please Enter Value for sixth record" , "nexus")
		  ), 		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon for sixth record" , "nexus"),
			 "param_name" => "sixicon",
			 "value" => $nexus_icon_arr,
			 "description" => __("Please Icon for table sixth record" , "nexus")
		  ),
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title of seventh record" , "nexus"),
			 "param_name" => "seventitle",
			 "value" => "",
			 "description" => __("Please Enter Title of seventh record" , "nexus")
		  ), 		  
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Value for seventh record" , "nexus"),
			 "param_name" => "sevenvalue",
			 "value" => "",
			 "description" => __("Please Enter Value for seventh record" , "nexus")
		  ), 		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon for seventh record" , "nexus"),
			 "param_name" => "sevenicon",
			 "value" => $nexus_icon_arr,
			 "description" => __("Please Icon for table seventh record" , "nexus")
		  ),
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title of eighth record" , "nexus"),
			 "param_name" => "eighttitle",
			 "value" => "",
			 "description" => __("Please Enter Title of eighth record" , "nexus")
		  ), 		  
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Value for eighth record" , "nexus"),
			 "param_name" => "eightvalue",
			 "value" => "",
			 "description" => __("Please Enter Value for eighth record" , "nexus")
		  ), 		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon for eighth record" , "nexus"),
			 "param_name" => "eighticon",
			 "value" => $nexus_icon_arr,
			 "description" => __("Please Icon for table eighth record" , "nexus")
		  ),
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title of ninth record" , "nexus"),
			 "param_name" => "ninetitle",
			 "value" => "",
			 "description" => __("Please Enter Title of ninth record" , "nexus")
		  ), 		  
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Value for ninth record" , "nexus"),
			 "param_name" => "ninevalue",
			 "value" => "",
			 "description" => __("Please Enter Value for ninth record" , "nexus")
		  ), 		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon for ninth record" , "nexus"),
			 "param_name" => "nineicon",
			 "value" => $nexus_icon_arr,
			 "description" => __("Please Icon for table ninth record" , "nexus")
		  ),
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title of tenth record" , "nexus"),
			 "param_name" => "tentitle",
			 "value" => "",
			 "description" => __("Please Enter Title of tenth record" , "nexus")
		  ), 		  
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Value for tenth record" , "nexus"),
			 "param_name" => "tenvalue",
			 "value" => "",
			 "description" => __("Please Enter Value for tenth record" , "nexus")
		  ), 			  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon for tenth record" , "nexus"),
			 "param_name" => "tenicon",
			 "value" => $nexus_icon_arr,
			 "description" => __("Please Icon for table tenth record" , "nexus")
		  ),		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Add ribbon for the table?" , "nexus"),
			 "param_name" => "ribbon",
			 "value" => $nexus_yes_no_arr,
			 "description" => __("Do you want to add ribbon for the table?" , "nexus")
		  ),	  
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Ribbon Text" , "nexus"),
			 "param_name" => "ribbontext",
			 "value" => "",
			 "description" => __("Please Enter Ribbon Text" , "nexus")
		  ),  
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Plan URL/Link" , "nexus"),
			 "param_name" => "url",
			 "value" => "",
			 "description" => __("Please Enter URL/Link" , "nexus")
		  ),
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Plan Button Title" , "nexus"),
			 "param_name" => "urltitle",
			 "value" => "",
			 "description" => __("Please Enter Button Title" , "nexus")
		  ),
		array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Background" , "nexus"),
			 "param_name" => "linkcolor",
			 "value" => "#1795c5",
			 "description" => __("Please choose table Button Background color" , "nexus")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Icon" , "nexus"),
			 "param_name" => "urlicon",
			 "value" => $nexus_icon_arr,
			 "description" => __("Please Icon for table button" , "nexus")
		  )		  
	   )
	) );	
	
	/*------------------------------------------------------
	Nexus Service Widget - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Services Widgets" , "nexus"),
	   "base" => "nexus_service_widget",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Choose Icon" , "nexus"),
			 "param_name" => "icon",
			 "value" => $nexus_livicon_icon_arr,
			 "description" => __("Please choose Icon" , "nexus")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Keep Original color?" , "nexus"),
			 "param_name" => "original",
			 "value" => $nexus_yes_no_arr,
			 "description" => __("Do you want to keep icon original color?" , "nexus")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Widget Title" , "nexus"),
			 "param_name" => "title",
			 "value" => "",
			 "description" => __("Please Enter Widget Title" , "nexus")
		  ),
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Text Title" , "nexus"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Please Enter Widget Text" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon color" , "nexus"),
			 "param_name" => "color",
			 "value" => "#111111",
			 "description" => __("If Original option is disabled then this color will be used" , "nexus")
		  )	 		  
	   )
	) );		
	
	/*------------------------------------------------------
	Nexus Section Title - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Section Title" , "nexus"),
	   "base" => "nexus_section_title",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Section Title" , "nexus"),
			 "param_name" => "title",
			 "value" => "",
			 "description" => __("Enter Section Title" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Section Title Mini Description" , "nexus"),
			 "param_name" => "titledesc",
			 "value" => "",
			 "description" => __("Enter Title Mini Description" , "nexus")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title Align" , "nexus"),
			 "param_name" => "align",
			 "value" => $nexus_align,
			 "description" => __("Please choose Title alignment" , "nexus")
		  ),		  
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title text color" , "nexus"),
			 "param_name" => "titlecolor",
			 "value" => "#ffffff",
			 "description" => __("Please Choose Title text color" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title Description text color" , "nexus"),
			 "param_name" => "titledesccolor",
			 "value" => "#1795c5",
			 "description" => __("Please Choose Title Description text color" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title Font Size" , "nexus"),
			 "param_name" => "textfontsize",
			 "value" => "",
			 "description" => __("Enter Title Font Size in Pixels" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Description Font Size" , "nexus"),
			 "param_name" => "descfontsize",
			 "value" => "",
			 "description" => __("Enter Description Font Size in Pixels" , "nexus")
		  )		  
	   )
	) );		
	
	/*------------------------------------------------------
	Nexus Button - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Button" , "nexus"),
	   "base" => "nexus_button",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Text" , "nexus"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Button Text" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button URL" , "nexus"),
			 "param_name" => "link",
			 "value" => "",
			 "description" => __("Enter Button URL" , "nexus")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Open in new window?" , "nexus"),
			 "param_name" => "target",
			 "value" => $nexus_yes_no_arr,
			 "description" => __("If yes then the button will open in new window/tab" , "nexus")
		  ),		  
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Background color" , "nexus"),
			 "param_name" => "buttoncolor",
			 "value" => "#1795c5",
			 "description" => __("Please Choose Button Background color" , "nexus")
		  )		  
	   )
	) );	
	
	/*------------------------------------------------------
	Nexus Button - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus White Button" , "nexus"),
	   "base" => "nexus_white_button",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Text" , "nexus"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Button Text" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button URL" , "nexus"),
			 "param_name" => "link",
			 "value" => "",
			 "description" => __("Enter Button URL" , "nexus")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Open in new window?" , "nexus"),
			 "param_name" => "target",
			 "value" => $nexus_yes_no_arr,
			 "description" => __("If yes then the button will open in new window/tab" , "nexus")
		  )  
	   )
	) );		
	
	/*------------------------------------------------------
	Nexus Section Header with Icon - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Section Header with Icon" , "nexus"),
	   "base" => "nexus_header_with_icon",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Normal Text" , "nexus"),
			 "param_name" => "normaltext",
			 "value" => "",
			 "description" => __("Enter Normal Text" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Bold Text" , "nexus"),
			 "param_name" => "boldtext",
			 "value" => "",
			 "description" => __("Enter Bold Text" , "nexus")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Choose Icon" , "nexus"),
			 "param_name" => "icon",
			 "value" => $nexus_icon_arr,
			 "description" => __("Icon for the section" , "nexus")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Choose Text Align" , "nexus"),
			 "param_name" => "align",
			 "value" => $nexus_align,
			 "description" => __("Choose Text Align" , "nexus")
		  ),		  
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Section Description" , "nexus"),
			 "param_name" => "desc",
			 "value" => "",
			 "description" => __("Section Description Text" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Text color" , "nexus"),
			 "param_name" => "textcolor",
			 "value" => "#111111",
			 "description" => __("Please Choose Text color" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon color" , "nexus"),
			 "param_name" => "iconcolor",
			 "value" => "#1795c5",
			 "description" => __("Please Choose Icon color" , "nexus")
		  )	  
	   )
	) );		
	
	/*------------------------------------------------------
	Nexus Section Lined Header - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Lined Header" , "nexus"),
	   "base" => "nexus_lined_header",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Normal Text" , "nexus"),
			 "param_name" => "normaltext",
			 "value" => "",
			 "description" => __("Enter Normal Text" , "nexus")
		  ),		  
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Text color" , "nexus"),
			 "param_name" => "textcolor",
			 "value" => "#111111",
			 "description" => __("Please Choose Text color" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Highlighted Text" , "nexus"),
			 "param_name" => "highlighttext",
			 "value" => "",
			 "description" => __("Enter Normal Text" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Highlighted Text color" , "nexus"),
			 "param_name" => "highlighttextcolor",
			 "value" => "#ffffff",
			 "description" => __("Please Choose Text color" , "nexus")
		  )	  
	   )
	) );	
	
	/*------------------------------------------------------
	Nexus Section Header without Icon - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Section Header" , "nexus"),
	   "base" => "nexus_header_without_icon",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Normal Text" , "nexus"),
			 "param_name" => "normaltext",
			 "value" => "",
			 "description" => __("Enter Normal Text" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Bold Text" , "nexus"),
			 "param_name" => "boldtext",
			 "value" => "",
			 "description" => __("Enter Bold Text" , "nexus")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Choose Text Align" , "nexus"),
			 "param_name" => "align",
			 "value" => $nexus_align,
			 "description" => __("Choose Text Align" , "nexus")
		  ),		  
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Section Description" , "nexus"),
			 "param_name" => "desc",
			 "value" => "",
			 "description" => __("Section Description Text" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Text color" , "nexus"),
			 "param_name" => "textcolor",
			 "value" => "#111111",
			 "description" => __("Please Choose Text color" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Highlighted Text" , "nexus"),
			 "param_name" => "highlighttext",
			 "value" => "",
			 "description" => __("Enter Normal Text" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Highlighted Text color" , "nexus"),
			 "param_name" => "highlighttextcolor",
			 "value" => "#ffffff",
			 "description" => __("Please Choose Text color" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Highlighted Text Background color" , "nexus"),
			 "param_name" => "highlightbackgroundcolor",
			 "value" => "#111111",
			 "description" => __("Please Choose Text color" , "nexus")
		  )		  
	   )
	) );
	
	/*------------------------------------------------------
	Nexus List Items - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus List Items" , "nexus"),
	   "base" => "nexus_list_items",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(	  
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Section List Items" , "nexus"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter List items and make sure to wrap each in < li >< /li >" , "nexus")
		  )	  
	   )
	) );		
	
	/*------------------------------------------------------
	Nexus Desktop Slider - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Desktop Slider" , "nexus"),
	   "base" => "nexus_desktop_slider",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "attach_images",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Slider Images" , "nexus"),
			 "param_name" => "images",
			 "value" => "",
			 "description" => __("Please Choose Slider Images for your section" , "nexus")
		  )
		  )
	   )
	);		
	
	/*------------------------------------------------------
	Nexus Clients - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Clients" , "nexus"),
	   "base" => "nexus_clients",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "attach_images",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Clients Images" , "nexus"),
			 "param_name" => "images",
			 "value" => "",
			 "description" => __("Please Choose Clients Images for your Clients section" , "nexus")
		  )
		  )
	   )
	);		

	/*------------------------------------------------------
	Nexus Page Section - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Page Section" , "sentient"),
	   "base" => "nexus_page_section",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter a unique ID" , "sentient"),
			 "param_name" => "id",
			 "value" => "",
			 "description" => __("This ID must be unique and should not be duplicated in this page" , "sentient")
		  )
	   )
	) );
	
	/*------------------------------------------------------
	Nexus Testimonial - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Nexus Testimonial" , "nexus"),
	   "base" => "nexus_testimonial",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Testimonials" , "nexus"),
			 "param_name" => "number",
			 "value" => "",
			 "description" => __("Enter Number of Testimonials to display" , "nexus")
		  )
	   )
	) );		
	
	/*------------------------------------------------------
	Nexus Animated Numbers - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Nexus Animated Numbers" , "nexus"),
	   "base" => "nexus_animated_numbers",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Animated Number Icon" , "nexus"),
			 "param_name" => "icon",
			 "value" => $nexus_livicon_icon_arr,
			 "description" => __("Here you will choose Animated Number Icon" , "nexus")
		  )	,
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon color" , "nexus"),
			 "param_name" => "iconcolor",
			 "value" => "#FFFFFF",
			 "description" => __("Please Choose Icon color" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Number to Animate to" , "nexus"),
			 "param_name" => "number",
			 "value" => "0 0",
			 "description" => __("Number to Animate to (e.g. 100 , 5841 , ...etc)" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Number color" , "nexus"),
			 "param_name" => "numbercolor",
			 "value" => "#FFFFFF",
			 "description" => __("Please Choose Number color" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title" , "nexus"),
			 "param_name" => "title",
			 "value" => "Completed projects ",
			 "description" => __("Title of your Animated Number" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title color" , "nexus"),
			 "param_name" => "titlecolor",
			 "value" => "#ffffff",
			 "description" => __("Please Choose Title color" , "nexus")
		  ),		  
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Box color" , "nexus"),
			 "param_name" => "boxcolor",
			 "value" => "#1480aa",
			 "description" => __("Please Choose Box color" , "nexus")
		  ),		  
	   )
	) );		
	
	/*------------------------------------------------------
	Nexus Portfolio Slider - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Nexus Portfolio Slider" , "nexus"),
	   "base" => "nexus_portfolio_slider",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Portfolio Items" , "nexus"),
			 "param_name" => "number",
			 "value" => "6",
			 "description" => __("Enter Number of Portfolio to display" , "nexus")
		  )	  
	   )
	) );	

	/*------------------------------------------------------
	Nexus Portfolio - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Nexus Portfolio" , "nexus"),
	   "base" => "nexus_portfolio",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Portfolio Items" , "nexus"),
			 "param_name" => "number",
			 "value" => "6",
			 "description" => __("Enter Number of Portfolio to display" , "nexus")
		  )	  
	   )
	) );	
	
	/*------------------------------------------------------
	Nexus Earth Slider - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Earth Slider" , "nexus"),
	   "base" => "nexus_earth_slider",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter No.# of sliders you want to display" , "nexus"),
			 "param_name" => "noofposts",
			 "value" => "3",
			 "description" => __("Number of sliders to display" , "nexus")
		  )  
	   )
	) );	
		
	/*------------------------------------------------------
	Nexus Blog - Four per Row - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Blog" , "nexus"),
	   "base" => "nexus_blog",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter No.# of Blog items you want to display" , "nexus"),
			 "param_name" => "noofposts",
			 "value" => "4",
			 "description" => __("Number of Blog Items to display" , "nexus")
		  )  
	   )
	) );	
	
	/*------------------------------------------------------
	Nexus Services - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Nexus Services" , "nexus"),
	   "base" => "nexus_services",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Services Items" , "nexus"),
			 "param_name" => "number",
			 "value" => "6",
			 "description" => __("Enter Number of Services Items to display" , "nexus")
		  )  
	   )
	) );			
	
	/*------------------------------------------------------
	Nexus Services Desktop - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Nexus Services Desktop" , "nexus"),
	   "base" => "nexus_services_desktop",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Services Items" , "nexus"),
			 "param_name" => "number",
			 "value" => "6",
			 "description" => __("Enter Number of Services Items to display" , "nexus")
		  ) ,
		  array(
			 "type" => "attach_image",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Service Desktop Image" , "nexus"),
			 "param_name" => "image",
			 "description" => __("Upload your image here" , "nexus")
		  )		  
	   )
	) );	
	
	/*------------------------------------------------------
	Nexus Team Members - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Nexus Team Members" , "nexus"),
	   "base" => "nexus_team_members",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Team Members" , "nexus"),
			 "param_name" => "number",
			 "value" => "6",
			 "description" => __("Enter Number of Team Members to display" , "nexus")
		  )	
	   )
	) );			
	
	/*------------------------------------------------------
	Nexus Video - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Nexus Video" , "nexus"),
	   "base" => "nexus_video",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Video URL" , "nexus"),
			 "param_name" => "url",
			 "value" => "",
			 "description" => __("Enter video URL here" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Video Width" , "nexus"),
			 "param_name" => "width",
			 "value" => "",
			 "description" => __("Enter video width (Number Only)" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Video Height" , "nexus"),
			 "param_name" => "height",
			 "value" => "",
			 "description" => __("Enter video height (Number Only)" , "nexus")
		  )			  
	   )
	) );	

	/*------------------------------------------------------
	Nexus Map - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Nexus Map" , "nexus"),
	   "base" => "nexus_map",
	   "class" => "",
	   "category" => __('Content' , "nexus"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Map Latitude" , "nexus"),
			 "param_name" => "latitude",
			 "value" => "-37.809674",
			 "description" => __("Please Enter Map Latitude Value" , "nexus")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Map embed Longitude" , "nexus"),
			 "param_name" => "longitude",
			 "value" => "144.954718",
			 "description" => __("Please Enter Map Longitude Value" , "nexus")
		  )	,
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Water color" , "nexus"),
			 "param_name" => "water",
			 "value" => "#005f91",
			 "description" => __("This will be used as water color if default colors are disabled above" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Road color" , "nexus"),
			 "param_name" => "road",
			 "value" => "#00b7de",
			 "description" => __("This will be used as road color if default colors are disabled above" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Label Stroke color" , "nexus"),
			 "param_name" => "labelstroke",
			 "value" => "#009ed9",
			 "description" => __("This will be used as Label Stroke color if default colors are disabled above" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Label Fill color" , "nexus"),
			 "param_name" => "labelfill",
			 "value" => "#ffffff",
			 "description" => __("This will be used as Label Fill color if default colors are disabled above" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Administrative color" , "nexus"),
			 "param_name" => "administrative",
			 "value" => "#006792",
			 "description" => __("This will be used as Administrative color if default colors are disabled above" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Landscape/POI Park color" , "nexus"),
			 "param_name" => "landscape",
			 "value" => "#008cca",
			 "description" => __("This will be used as Landscape/POI Park color if default colors are disabled above" , "nexus")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("POI/Transit color" , "nexus"),
			 "param_name" => "poi",
			 "value" => "#00ace9",
			 "description" => __("This will be used as POI/Transit color if default colors are disabled above" , "nexus")
		  ), 		  
	   )
	) );		
}
/*------------------------------------------------------
Nexus Sidebar Functions - Started
-------------------------------------------------------*/
if ( function_exists('register_sidebar') ){
register_sidebar(array(
	'name' => 'default',
	'id' => 'default',
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));
/************************/
register_sidebar(array(
	'name' => 'ExtraSidebarI',
	'id' => 'ExtraSidebarI',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));
/************************/
register_sidebar(array('name'=>'ExtraSidebarII',
	'id' => 'ExtraSidebarII',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));
/************************/
register_sidebar(array('name'=>'ExtraSidebarIII',
	'id' => 'ExtraSidebarIII',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));
/************************/
register_sidebar(array('name'=>'ExtraSidebarIV',
	'id' => 'ExtraSidebarIV',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));
/************************/
register_sidebar(array('name'=>'ExtraSidebarV',
	'id' => 'ExtraSidebarV',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',

));
/************************/
register_sidebar(array('name'=>'ExtraSidebarVI',
	'id' => 'ExtraSidebarVI',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));
/************************/
register_sidebar(array('name'=>'ExtraSidebarVII',
	'id' => 'ExtraSidebarVII',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));
/************************/
register_sidebar(array('name'=>'ExtraSidebarVIII',
	'id' => 'ExtraSidebarVIII',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));
/************************/
register_sidebar(array('name'=>'FooterColI',
	'id' => 'FooterColI',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '',
));
/************************/
register_sidebar(array('name'=>'FooterColII',
	'id' => 'FooterColII',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '',
));
/************************/
register_sidebar(array('name'=>'FooterColIII',
	'id' => 'FooterColIII',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '',
));
/************************/
register_sidebar(array(
	'name'=>'FooterColIV',
	'id' => 'FooterColIV',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '',
));
/************************/
register_sidebar(array('name'=>'BlogRightSidebar',
	'id' => 'BlogRightSidebar',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));
/************************/
register_sidebar(array('name'=>'BlogSingleSidebar',
	'id' => 'BlogSingleSidebar',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));
/************************/
register_sidebar(array('name'=>'PageLeftSidebar',
	'id' => 'PageLeftSidebar',
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));
/************************/
register_sidebar(array('name'=>'PageRightSidebar',
	'id' => 'PageRightSidebar',
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));
}
/*------------------------------------------------------
Nexus Sidebar Functions - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus, Adds a box to the side column on the Post and Page edit screens - Started
-------------------------------------------------------*/
function nexus_add_sidebar_metabox()  
{  
    add_meta_box(  
        'custom_sidebar',  
        __( 'Custom Sidebar', 'nexus' ),  
        'nexus_custom_sidebar_callback',  
        'post',  
        'side'  
    );  
    add_meta_box(
        'custom_sidebar',  
        __( 'Custom Sidebar', 'nexus' ),  
        'nexus_custom_sidebar_callback',  
        'page',  
        'side'  
    );  
    add_meta_box(
        'custom_sidebar',  
        __( 'Custom Sidebar', 'nexus' ),  
        'nexus_custom_sidebar_callback',  
        'project',  
        'side'  
    );

} 

function nexus_custom_sidebar_callback( $post )  
{  
    global $wp_registered_sidebars;  
      
    $custom = get_post_custom($post->ID);  
      
    if(isset($custom['custom_sidebar']))  
        $val = $custom['custom_sidebar'][0];  
    else  
        $val = "default";  
  
    wp_nonce_field( plugin_basename( __FILE__ ), 'custom_sidebar_nonce' );  
  
    $output = '<p><label for="myplugin_new_field">'.__("Choose a sidebar to display", 'nexus' ).'</label></p>';  
    $output .= "<select name='custom_sidebar'>";  
	
    $output .= "<option";  
    if($val == "default")  
        $output .= " selected='selected'";  
    $output .= " value='default'>".__('default', 'nexus' )."</option>";  
       
    foreach($wp_registered_sidebars as $sidebar_id => $sidebar)  
    {  
        $output .= "<option";  
        if($sidebar_id == $val)  
            $output .= " selected='selected'";  
        $output .= " value='".$sidebar_id."'>".$sidebar['name']."</option>";  
    }  
    
    $output .= "</select>";  
      
    echo $output;  
}

function nexus_save_sidebar_postdata( $post_id ){  
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )   
      return;  
  
	if(isset ($_POST['custom_sidebar_nonce'])){
		if ( !wp_verify_nonce( $_POST['custom_sidebar_nonce'], plugin_basename( __FILE__ ) ) )  
		  return; 
	}   
  
    if ( !current_user_can( 'edit_page', $post_id ) )  
        return;  
  
	if(isset ($_POST['custom_sidebar'])){
		$data = $_POST['custom_sidebar'];  
		update_post_meta($post_id, "custom_sidebar", $data);
	}     
}  
/*------------------------------------------------------
Nexus, Adds a box to the side column on the Post and Page edit screens - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Walker_Nav_Menu - Started
-------------------------------------------------------*/
class Nexus_description_walker extends Walker_Nav_Menu
{

	  function start_lvl(&$output, $depth= 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul>\n";
	  }
	  function end_lvl(&$output, $depth= 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	  }
  
	  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

			$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
			if (empty($children)) {
				$sentientdiv = '';
				$sentientchild = '';
				$toggleClass = '';
			} else {
				$sentientdiv = '';
				$sentientchild = 'dropdown';
				$toggleClass = 'class="dropdown-toggle" data-toggle="dropdown"';
			}		   
		   
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names . ' ' . $sentientchild ) .'"';		   
		   
           $output .= $indent . '<li ' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		   
           $prepend = '';
           $append = '';
		   
           $description  = ! empty( $item->description ) ? '<span class="menu-item-description">'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }
			
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .' ' . $toggleClass . '>';
			$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
			$item_output .= $description.$args->link_after;
			$item_output .= $sentientdiv . '</a>';
			$item_output .= $args->after;
			
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
      }

}
/*------------------------------------------------------
Nexus Walker_Nav_Menu - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus, Add Custom Fields to the Post Formats (add_action) - Started
-------------------------------------------------------*/
add_action( 'admin_menu', 'nexus_team_post_format_member_position' );
add_action( 'save_post', 'nexus_save_team_post_format_member_position', 10, 2 );

add_action( 'admin_menu', 'nexus_testimonial_post_format_person_company' );
add_action( 'save_post', 'nexus_save_testimonial_post_format_person_company', 10, 2 );

add_action( 'admin_menu', 'nexus_post_format_facebook_field' );
add_action( 'save_post', 'nexus_save_post_format_facebook_field', 10, 2 );

add_action( 'admin_menu', 'nexus_post_format_behance_field' );
add_action( 'save_post', 'nexus_save_post_format_behance_field', 10, 2 );

add_action( 'admin_menu', 'nexus_post_format_deviantart_field' );
add_action( 'save_post', 'nexus_save_post_format_deviantart_field', 10, 2 );

add_action( 'admin_menu', 'nexus_post_format_twitter_field' );
add_action( 'save_post', 'nexus_save_post_format_twitter_field', 10, 2 );

add_action( 'admin_menu', 'nexus_post_format_dribbble_field' );
add_action( 'save_post', 'nexus_save_post_format_dribbble_field', 10, 2 );

add_action( 'admin_menu', 'nexus_post_format_linkedin_field' );
add_action( 'save_post', 'nexus_save_post_format_linkedin_field', 10, 2 );

add_action( 'admin_menu', 'nexus_post_format_google_field' );
add_action( 'save_post', 'nexus_save_post_format_google_field', 10, 2 );

add_action( 'admin_menu', 'nexus_video_post_format_URL_field' );
add_action( 'save_post', 'nexus_save_video_post_format_URL_field', 10, 2 );

add_action( 'admin_menu', 'nexus_audio_post_format_URL_field' );
add_action( 'save_post', 'nexus_save_audio_post_format_URL_field', 10, 2 );

add_action( 'admin_menu', 'nexus_gallery_post_format_URL_field' );
add_action( 'save_post', 'nexus_save_gallery_post_format_URL_field', 10, 2 );

add_action( 'admin_menu', 'post_icons_list' );
add_action( 'save_post', 'post_save_icons_list', 10, 2 );

add_action( 'admin_menu', 'nexus_title_desc_field' );
add_action( 'save_post', 'nexus_save_title_desc_field', 10, 2 );

add_action( 'admin_menu', 'nexus_skill_value_field' );
add_action( 'save_post', 'nexus_save_skill_value_field', 10, 2 );

add_action( 'admin_menu', 'post_icons_svg_list' );
add_action( 'save_post', 'post_save_icons_svg_list', 10, 2 );

add_action( 'admin_menu', 'nexus_services_description_field' );
add_action( 'save_post', 'nexus_services_save_description_field', 10, 2 );
/*------------------------------------------------------
Nexus , Add Custom Fields to the Post Formats (add_action) - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus , Add Custom Fields to the Post Formats (Create Fields) - Started
-------------------------------------------------------*/
function nexus_team_post_format_member_position() {
	add_meta_box( 'nexus-team-position-box', 'Team Member Position', 'nexus_create_team_post_format_member_position', 'team', 'normal', 'high' );
}
function nexus_testimonial_post_format_person_company() {
	add_meta_box( 'nexus-test-company-box', 'Person Company', 'nexus_create_testimonial_post_format_person_company', 'testimonial', 'normal', 'high' );
}
function nexus_post_format_facebook_field() {
	add_meta_box( 'nexus-facebook-box', 'Facebook URL', 'nexus_create_post_format_facebook_field', 'team', 'normal', 'high' );	
}
function nexus_post_format_behance_field() {
	add_meta_box( 'nexus-behance-box', 'Behance URL', 'nexus_create_post_format_behance_field', 'team', 'normal', 'high' );	
}
function nexus_post_format_deviantart_field() {
	add_meta_box( 'nexus-deviantart-box', 'Deviantart URL', 'nexus_create_post_format_deviantart_field', 'team', 'normal', 'high' );	
}
function nexus_post_format_twitter_field() {
	add_meta_box( 'nexus-twitter-box', 'Twitter URL', 'nexus_create_post_format_twitter_field', 'team', 'normal', 'high' );	
}
function nexus_post_format_dribbble_field() {
	add_meta_box( 'nexus-dribbble-box', 'Dribbble URL', 'nexus_create_post_format_dribbble_field', 'team', 'normal', 'high' );	
}
function nexus_post_format_linkedin_field() {
	add_meta_box( 'nexus-linkedin-box', 'LinkedIn URL', 'nexus_create_post_format_linkedin_field', 'team', 'normal', 'high' );		
}
function nexus_post_format_google_field() {
	add_meta_box( 'nexus-google-box', 'Google URL', 'nexus_create_post_format_google_field', 'team', 'normal', 'high' );		
}
function nexus_video_post_format_URL_field() {
	add_meta_box( 'nexus-video-box', 'Video URL for post video format (only)', 'nexus_create_video_post_format_URL_field', 'post', 'normal', 'high' );
}
function nexus_audio_post_format_URL_field() {
	add_meta_box( 'nexus-audio-box', 'Audio Shortcode for post Audio format (only)', 'nexus_create_audio_post_format_URL_field', 'post', 'normal', 'high' );
}
function post_icons_list() {
	add_meta_box( 'nexus-icon-box', 'Select Icon', 'create_post_icon_list', 'duties', 'normal', 'high' );
}
function post_icons_svg_list() {
	add_meta_box( 'nexus-svg-icon-box', 'Select Icon', 'create_post_svg_icon_list', 'services', 'normal', 'high' );
	add_meta_box( 'nexus-svg-icon-box', 'Select Icon', 'create_post_svg_icon_list', 'servicesdesktop', 'normal', 'high' );
}
function nexus_gallery_post_format_URL_field() {
	add_meta_box( 'nexus-gallery-box', 'Gallery images ID for post gallery format (only)', 'nexus_create_gallery_post_format_URL_field', 'post', 'normal', 'high' );
}
function nexus_title_desc_field() {
	add_meta_box( 'nexus-title-desc-box', 'Page Title Description', 'nexus_create_title_desc_field', 'page', 'normal', 'high' );
	add_meta_box( 'nexus-title-desc-box', 'Page Title Description', 'nexus_create_title_desc_field', 'post', 'normal', 'high' );
	add_meta_box( 'nexus-title-desc-box', 'Page Title Description', 'nexus_create_title_desc_field', 'portfolio', 'normal', 'high' );
}
function nexus_skill_value_field() {
	add_meta_box( 'nexus-skill-value-box', 'Skill Value', 'nexus_create_skill_value_field', 'skills', 'normal', 'high' );
}
function nexus_services_description_field() {
	add_meta_box( 'nexus-services-description-value-box', 'Services Title Description', 'nexus_create_services_description_field', 'services', 'normal', 'high' );
	add_meta_box( 'nexus-services-description-value-box', 'Services Title Description', 'nexus_create_services_description_field', 'servicesdesktop', 'normal', 'high' );
}
/*------------------------------------------------------
Nexus , Add Custom Fields to the Post Formats (Create Fields) - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus , Add Custom Fields to the Post Formats (Create Fields Layout) - Started
-------------------------------------------------------*/
function nexus_create_team_post_format_member_position( $object, $box ) { ?>
	<p>
		<label for="teampositionlink-shortcode">Person Position</label>
		<br />
		<input name="teampositionlink-shortcode" id="teampositionlink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Member Position', true )); ?>" />
		<input type="hidden" name="nexus_meta_box_teamposition" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function nexus_create_testimonial_post_format_person_company( $object, $box ) { ?>
	<p>
		<label for="testcompanylink-shortcode">Person Company</label>
		<br />
		<input name="testcompanylink-shortcode" id="testcompanylink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Person Company', true )); ?>" />
		<input type="hidden" name="nexus_meta_box_testcompany" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function nexus_create_post_format_facebook_field( $object, $box ) { ?>
	<p>
		<label for="post-facebook">Facebook URL</label>
		<br />
		<input name="post-facebook" id="post-facebook" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Facebook URL', true ) ); ?>" />
		<input type="hidden" name="nexus_meta_box_facebook" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function nexus_create_post_format_behance_field( $object, $box ) { ?>
	<p>
		<label for="post-behance">Behance URL</label>
		<br />
		<input name="post-behance" id="post-behance" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Behance URL', true ) ); ?>" />
		<input type="hidden" name="nexus_meta_box_behance" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function nexus_create_post_format_deviantart_field( $object, $box ) { ?>
	<p>
		<label for="post-deviantart">Deviantart URL</label>
		<br />
		<input name="post-deviantart" id="post-deviantart" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Deviantart URL', true ) ); ?>" />
		<input type="hidden" name="nexus_meta_box_deviantart" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function nexus_create_post_format_twitter_field( $object, $box ) { ?>
	<p>
		<label for="post-twitter">Twitter URL</label>
		<br />
		<input name="post-twitter" id="post-twitter" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Twitter URL', true ) ); ?>" />
		<input type="hidden" name="nexus_meta_box_twitter" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function nexus_create_post_format_linkedin_field( $object, $box ) { ?>
	<p>
		<label for="post-linkedin">LinkedIn URL</label>
		<br />
		<input name="post-linkedin" id="post-linkedin" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'LinkedIn URL', true ) ); ?>" />
		<input type="hidden" name="nexus_meta_box_linkedin" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function nexus_create_post_format_google_field( $object, $box ) { ?>
	<p>
		<label for="post-google">Google URL</label>
		<br />
		<input name="post-google" id="post-google" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Google URL', true ) ); ?>" />
		<input type="hidden" name="nexus_meta_box_google" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function nexus_create_post_format_dribbble_field( $object, $box ) { ?>
	<p>
		<label for="post-dribbble">Dribbble URL</label>
		<br />
		<input name="post-dribbble" id="post-dribbble" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Dribbble URL', true ) ); ?>" />
		<input type="hidden" name="nexus_meta_box_dribbble" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function nexus_create_video_post_format_URL_field( $object, $box ) { ?>
	<p>
		<label for="post-video">Post Video URL</label>
		<br />
		<input name="post-video" id="post-video" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Post Video URL', true ) ); ?>" />
		<input type="hidden" name="nexus_meta_box_video" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function nexus_create_audio_post_format_URL_field( $object, $box ) { ?>
	<p>
		<label for="post-audio">Post Audio Shortcode</label>
		<br />
		<input name="post-audio" id="post-audio" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Post Audio Shortcode', true ) ); ?>" />
		<input type="hidden" name="nexus_meta_box_audio" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function nexus_create_gallery_post_format_URL_field( $object, $box ) { ?>
	<p>
		<label for="post-gallery">Gallery images ID</label>
		<br />
		<input name="post-gallery" id="post-gallery" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Gallery images ID', true ) ); ?>" />
		<input type="hidden" name="nexus_meta_box_gallery" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function nexus_create_title_desc_field( $object, $box ) { ?>
	<p>
		<label for="title-desc">Title Description</label>
		<br />
		<input name="title-desc" id="title-desc" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Title Description', true ) ); ?>" />
		<input type="hidden" name="nexus_meta_box_title_desc" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function nexus_create_skill_value_field( $object, $box ) { ?>
	<p>
		<label for="skill-value">Skill Value (Number Only)</label>
		<br />
		<input name="skill-value" id="skill-value" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Skill Value (Number Only)', true ) ); ?>" />
		<input type="hidden" name="nexus_meta_box_skill_value" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function nexus_create_services_description_field( $object, $box ) { ?>
	<p>
		<label for="services-description-value">Services Title Description</label>
		<br />
		<input name="services-description-value" id="services-description-value" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Services Title Description', true ) ); ?>" />
		<input type="hidden" name="nexus_meta_box_description_value" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }
/*------------------------------------------------------
Nexus , Add Custom Fields to the Post Formats (Create Fields Layout) - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus , Add Custom Fields to the Post Formats (Save Values) - Started
-------------------------------------------------------*/
function nexus_save_team_post_format_member_position( $post_id, $post ) {

	if(isset ($_POST['nexus_meta_box_teamposition'])){
		if ( !wp_verify_nonce( $_POST['nexus_meta_box_teamposition'], plugin_basename( __FILE__ ) ) )
			return $post_id;	
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Member Position', true );
	
	if(isset ($_POST['teampositionlink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['teampositionlink-shortcode'] );
	} else {
		$new_meta_value = '';
	}			

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Team Member Position', $new_meta_value );
}

function nexus_save_testimonial_post_format_person_company( $post_id, $post ) {

	if(isset ($_POST['nexus_meta_box_testcompany'])){
		if ( !wp_verify_nonce( $_POST['nexus_meta_box_testcompany'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Person Company', true );
	
	if(isset ($_POST['testcompanylink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['testcompanylink-shortcode'] );
	} else {
		$new_meta_value = '';
	}				

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Person Company', $new_meta_value );
}

function nexus_save_post_format_facebook_field( $post_id, $post ) {

	if(isset ($_POST['nexus_meta_box_facebook'])){
		if ( !wp_verify_nonce( $_POST['nexus_meta_box_facebook'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Facebook URL', true );
	
	if(isset ($_POST['post-facebook'])){
		$new_meta_value = stripslashes( $_POST['post-facebook'] );
	} else {
		$new_meta_value = '';
	}					

	$new_meta_value = esc_url_raw($new_meta_value);		
	
	update_post_meta( $post_id, 'Facebook URL', $new_meta_value );
}
function nexus_save_post_format_behance_field( $post_id, $post ) {

	if(isset ($_POST['nexus_meta_box_behance'])){
		if ( !wp_verify_nonce( $_POST['nexus_meta_box_behance'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Behance URL', true );
	
	if(isset ($_POST['post-behance'])){
		$new_meta_value = stripslashes( $_POST['post-behance'] );
	} else {
		$new_meta_value = '';
	}					

	$new_meta_value = esc_url_raw($new_meta_value);		
	
	update_post_meta( $post_id, 'Behance URL', $new_meta_value );

}
function nexus_save_post_format_deviantart_field( $post_id, $post ) {

	if(isset ($_POST['nexus_meta_box_deviantart'])){
		if ( !wp_verify_nonce( $_POST['nexus_meta_box_deviantart'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Deviantart URL', true );
	
	if(isset ($_POST['post-deviantart'])){
		$new_meta_value = stripslashes( $_POST['post-deviantart'] );
	} else {
		$new_meta_value = '';
	}					

	$new_meta_value = esc_url_raw($new_meta_value);		
	
	update_post_meta( $post_id, 'Deviantart URL', $new_meta_value );

}
function nexus_save_post_format_twitter_field( $post_id, $post ) {

	if(isset ($_POST['nexus_meta_box_twitter'])){
		if ( !wp_verify_nonce( $_POST['nexus_meta_box_twitter'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Twitter URL', true );
	
	if(isset ($_POST['post-twitter'])){
		$new_meta_value = stripslashes( $_POST['post-twitter'] );
	} else {
		$new_meta_value = '';
	}						

	$new_meta_value = esc_url_raw($new_meta_value);		
	
	update_post_meta( $post_id, 'Twitter URL', $new_meta_value );

}
function nexus_save_post_format_linkedin_field( $post_id, $post ) {

	if(isset ($_POST['nexus_meta_box_linkedin'])){
		if ( !wp_verify_nonce( $_POST['nexus_meta_box_linkedin'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'LinkedIn URL', true );
	
	if(isset ($_POST['post-linkedin'])){
		$new_meta_value = stripslashes( $_POST['post-linkedin'] );
	} else {
		$new_meta_value = '';
	}							

	$new_meta_value = esc_url_raw($new_meta_value);	
	
	update_post_meta( $post_id, 'LinkedIn URL', $new_meta_value );
	
}
function nexus_save_post_format_google_field( $post_id, $post ) {

	if(isset ($_POST['nexus_meta_box_google'])){
		if ( !wp_verify_nonce( $_POST['nexus_meta_box_google'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Google URL', true );
	
	if(isset ($_POST['post-google'])){
		$new_meta_value = stripslashes( $_POST['post-google'] );
	} else {
		$new_meta_value = '';
	}								

	$new_meta_value = esc_url_raw($new_meta_value);	
	
	update_post_meta( $post_id, 'Google URL', $new_meta_value );
	
}
function nexus_save_post_format_dribbble_field( $post_id, $post ) {

	if(isset ($_POST['nexus_meta_box_dribbble'])){
		if ( !wp_verify_nonce( $_POST['nexus_meta_box_dribbble'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Dribbble URL', true );
	
	if(isset ($_POST['post-dribbble'])){
		$new_meta_value = stripslashes( $_POST['post-dribbble'] );
	} else {
		$new_meta_value = '';
	}									

	$new_meta_value = esc_url_raw($new_meta_value);	
	
	update_post_meta( $post_id, 'Dribbble URL', $new_meta_value );
}
function nexus_save_video_post_format_URL_field( $post_id, $post ) {

	if(isset ($_POST['nexus_meta_box_video'])){
		if ( !wp_verify_nonce( $_POST['nexus_meta_box_video'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Post Video URL', true );
	
	if(isset ($_POST['post-video'])){
		$new_meta_value = stripslashes( $_POST['post-video'] );
	} else {
		$new_meta_value = '';
	}												

	$new_meta_value = esc_url_raw($new_meta_value);	
	
	update_post_meta( $post_id, 'Post Video URL', $new_meta_value );
}
function nexus_save_audio_post_format_URL_field( $post_id, $post ) {

	if(isset ($_POST['nexus_meta_box_audio'])){
		if ( !wp_verify_nonce( $_POST['nexus_meta_box_audio'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Post Audio Shortcode', true );
	
	if(isset ($_POST['post-audio'])){
		$new_meta_value = stripslashes( $_POST['post-audio'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);		
	
	update_post_meta( $post_id, 'Post Audio Shortcode', $new_meta_value );
}
function nexus_save_gallery_post_format_URL_field( $post_id, $post ) {

	if(isset ($_POST['nexus_meta_box_gallery'])){
		if ( !wp_verify_nonce( $_POST['nexus_meta_box_gallery'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Gallery images ID', true );
	
	if(isset ($_POST['post-gallery'])){
		$new_meta_value = stripslashes( $_POST['post-gallery'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);	
	
	update_post_meta( $post_id, 'Gallery images ID', $new_meta_value );
}
function post_save_icons_list( $post_id, $post ) {

	if(isset ($_POST['meta_box_icon'])){
		if ( !wp_verify_nonce( $_POST['meta_box_icon'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Icon', true );
	
	if(isset ($_POST['post-icon'])){
		$new_meta_value = stripslashes( $_POST['post-icon'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Icon', $new_meta_value );
}
function post_save_icons_svg_list( $post_id, $post ) {


	if(isset ($_POST['meta_box_svg_icon'])){
		if ( !wp_verify_nonce( $_POST['meta_box_svg_icon'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Animated Icon', true );
	
	if(isset ($_POST['post-svg-icon'])){
		$new_meta_value = stripslashes( $_POST['post-svg-icon'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Animated Icon', $new_meta_value );
}
function nexus_save_title_desc_field( $post_id, $post ) {

	if(isset ($_POST['nexus_meta_box_title_desc'])){
		if ( !wp_verify_nonce( $_POST['nexus_meta_box_title_desc'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Title Description', true );
	
	if(isset ($_POST['title-desc'])){
		$new_meta_value = stripslashes( $_POST['title-desc'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Title Description', $new_meta_value );
}
function nexus_save_skill_value_field( $post_id, $post ) {

	if(isset ($_POST['nexus_meta_box_skill_value'])){
		if ( !wp_verify_nonce( $_POST['nexus_meta_box_skill_value'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Title Description', true );
	
	if(isset ($_POST['skill-value'])){
		$new_meta_value = stripslashes( $_POST['skill-value'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);	
	
	update_post_meta( $post_id, 'Skill Value (Number Only)', $new_meta_value );
}
function nexus_services_save_description_field( $post_id, $post ) {

	if(isset ($_POST['nexus_meta_box_description_value'])){
		if ( !wp_verify_nonce( $_POST['nexus_meta_box_description_value'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Services Title Description', true );
	
	if(isset ($_POST['services-description-value'])){
		$new_meta_value = stripslashes( $_POST['services-description-value'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);	
	
	update_post_meta( $post_id, 'Services Title Description', $new_meta_value );
}
/*------------------------------------------------------
Nexus , Add Custom Fields to the Post Formats (Save Values) - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Comments - Started
-------------------------------------------------------*/
function nexus_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
	?>
	<?php $tag = 'article'; ?>
	
	<<?php echo $tag ?> <?php comment_class('media comments ' . empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">		
		<a href="#" class="pull-left profile profile-border modal-image">
			<?php echo get_avatar( $comment, 150 ); ?>
		</a>
		<div class="comment-content">
			<?php printf(__('<h4 class="nexus-capital">%s</h4>'), get_comment_author_link()); ?>
			<?php $at = __(" - " , "nexus")?>
			<?php $getDate = get_comment_date('M' , $comment->comment_ID ) . ' ' . get_comment_date('j' , $comment->comment_ID ) . ', ' . get_comment_date('Y' , $comment->comment_ID ) . $at . get_comment_time('H:i'); ?>
			<span class="post-date">
				<i class="fa fa-calendar"></i> <span><?php _e("Posted:","nexus"); ?></span> <?php echo $getDate; ?>				
			</span>
			<p><?php comment_text() ?></p>						
		</div>
		<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</article>	
	
	<?php
}
/*------------------------------------------------------
Nexus Comments - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Search - Started
-------------------------------------------------------*/
function nexus_search_form( $form ) {
    $form = '
	<form role="search" method="get" class="search-form-sidebar" action="' . home_url( '/' ) . '">
		<div class="input-group">
		  <input type="text" class="form-control" name="s" id="s" >
		  <span class="input-group-btn">
			<button name="submit" type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
		  </span>
		</div>
	</form>';

    return $form;
}
/*------------------------------------------------------
Nexus Search - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Category List - Started
-------------------------------------------------------*/
function categories_postcount_filter ($variable) {
   $variable = str_replace('(', '<span class="post_count"> ', $variable);
   $variable = str_replace(')', ' </span>', $variable);
   return $variable;
}
/*------------------------------------------------------
Nexus Category List - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Importer - Started
-------------------------------------------------------*/
require dirname( __FILE__ ) . '/importer/init.php';
/*------------------------------------------------------
Nexus Importer - Started
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Admin Panel - Started
-------------------------------------------------------*/
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri().'/admin/');
	require_once dirname( __FILE__ ) . '/admin/options-framework.php';
}
/*------------------------------------------------------
Nexus Admin Panel - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Theme Activation - Begin
-------------------------------------------------------*/
if(!function_exists('nexus_backend_theme_activation'))
{
	function nexus_backend_theme_activation()
	{
		global $pagenow;
		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) )
		{
			do_action('nexus_backend_theme_activation');
			header( 'Location: '.admin_url().'themes.php?page=options-framework' ) ;
		}
	}
	add_action('admin_init','nexus_backend_theme_activation');
}
/*------------------------------------------------------
Nexus Theme Activation - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Import CSS Styles - Begin
-------------------------------------------------------*/
function Nexus_Import_CSS(){
	$file = get_template_directory() . '/nexus-styles.css';
	$current = Nexus_Generate_CSS();
	file_put_contents($file, $current);
}
/*------------------------------------------------------
Nexus Import CSS Styles - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Testimonials Function - Begin
-------------------------------------------------------*/
function Nexus_Testimonials_Widget_value() {
	global $prof_default;
	
	$loop = new WP_Query(array('post_type' => 'testimonial'));
	
	$return_string = '<div class="owl-carousel footer-testimonials">';
			
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
	$feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );

	$return_string .= '
                    <div class="testimonial">
                        <blockquote>
                                ' . get_the_content() . '
                        </blockquote>
                        <div class="cf">
                            <span class="profile">
                                <a href="' . $feat_image . '" class="modal-image thumb">
									' . get_the_post_thumbnail( get_the_ID() ,  'nexus-testimonial-thumb' ) . '
                                </a>
                            </span>
                            <cite>
                                <strong>' . get_the_title() . '</strong>
                                <i>' . esc_attr(get_post_meta(get_the_ID(), 'Person Company', true)) . '</i>
                            </cite>
                        </div>
                    </div>';
	endwhile;
	endif;		
	
	$return_string .= '</div>';
	return $return_string;
	wp_reset_postdata();					
}
/*------------------------------------------------------
Nexus Testimonials Function - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Widget News Function - Begin
-------------------------------------------------------*/
function Nexus_News_Widget_value($noofposts) {
	global $prof_default;
	
	$loop = new WP_Query(array('post_type' => 'post', 'posts_per_page' => $noofposts));
	$return_string = '<div id="twitter-feed">';
			
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
	$feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );

	$return_string .= '
                    <div class="twitter-article">
                        <div class="twitter-pic">
                            <a href="' . $feat_image . '" class="modal-image">
								' . get_the_post_thumbnail( get_the_ID() , "thumbnail" ) . '                                
                            </a>
                            <div class="tweet-time"><a href="' . esc_url( get_permalink()) . '">' . get_the_time('j') . ' ' . get_the_time('M') . '</a></div>
                        </div>
                        <div class="twitter-text">
                            <div class="tweetprofilelink">
                                <strong><a href="' . esc_url( get_permalink()) . '">'. get_the_title() .'</a></strong>
                            </div>
                            <p>' . strip_shortcodes(wp_trim_words( get_the_content(), 8 )) . '</p>
                        </div>
                    </div>';
	endwhile;
	endif;		
	
	$return_string .= '</div>';
	return $return_string;
	wp_reset_postdata();					
}
/*------------------------------------------------------
Nexus Widget News Function - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Contact Info Function - Begin
-------------------------------------------------------*/
function Nexus_Contact_Widget_value() {
	global $prof_default;

	if(of_get_option('widget_address_one',$prof_default) != ''){$addressOne = '<li><b><i class="fa fa-globe"></i> ' . esc_attr(of_get_option('widget_address_title',$prof_default)) . ':</b> ' . esc_attr(of_get_option('widget_address_one',$prof_default)) . '</li>';}else{$addressOne = '';}
	if(of_get_option('widget_phone',$prof_default) != ''){$phone = '<li><b><i class="fa fa-phone-square"></i> ' . esc_attr(of_get_option('widget_phone_title',$prof_default)) . ':</b> ' . esc_attr(of_get_option('widget_phone',$prof_default)) . '</li>';}else{$phone = '';}
	if(of_get_option('widget_mail',$prof_default) != ''){$mail = '<li><b><i class="fa fa-envelope"></i> ' . esc_attr(of_get_option('widget_mail_title',$prof_default)) . ':</b> <a href="mailto:' . esc_attr(of_get_option('widget_mail',$prof_default)) . '">' . esc_attr(of_get_option('widget_mail',$prof_default)) . '</a></li>';}else{$mail = '';}

	 return '<ul class="nexus-contact-widget">
                ' . $addressOne . '
                ' . $phone . '
                ' . $mail . '
             </ul>';
				
}
/*------------------------------------------------------
Nexus Contact Info Function - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Socials Function - Begin
-------------------------------------------------------*/
function Nexus_Socials_Widget_value() {
	global $prof_default;

	if(of_get_option('facebook_user_account',$prof_default) != ''){
		$facebook = '<a href="' . esc_url(of_get_option('facebook_user_account',$prof_default)) . '" class="icon tooltip" data-tip="' . __("Facebook" , "nexus") . '">
                        <i class="fa fa-facebook"></i>
                    </a>';
	}else{
		$facebook = '';
	}
	if(of_get_option('twitter_user_account',$prof_default) != ''){
		$twitter = '<a href="' . esc_url(of_get_option('twitter_user_account',$prof_default)) . '" class="icon tooltip" data-tip="' . __("Twitter" , "nexus") . '">
                        <i class="fa fa-twitter"></i>
                    </a>';
	}else{
		$twitter = '';
	}
	if(of_get_option('dribbble_user_account',$prof_default) != ''){
		$dribbble = '<a href="' . esc_url(of_get_option('dribbble_user_account',$prof_default)) . '" class="icon tooltip" data-tip="' . __("Dribbble" , "nexus") . '">
                        <i class="fa fa-dribbble"></i>
                    </a>';
	}else{
		$dribbble = '';
	}
	if(of_get_option('pinterest_user_account',$prof_default) != ''){
		$pinterest = '<a href="' . esc_url(of_get_option('pinterest_user_account',$prof_default)) . '" class="icon tooltip" data-tip="' . __("Pinterest" , "nexus") . '">
                        <i class="fa fa-pinterest"></i>
                    </a>';
	}else{
		$pinterest = '';
	}
	if(of_get_option('linkedin_user_account',$prof_default) != ''){
		$linkedin = '<a href="' . esc_url(of_get_option('linkedin_user_account',$prof_default)) . '" class="icon tooltip" data-tip="' . __("Linkedin" , "nexus") . '">
                        <i class="fa fa-linkedin"></i>
                    </a>';
	}else{
		$linkedin = '';
	}
	if(of_get_option('rss_user_account',$prof_default) != ''){
		$rss = '<a href="' . esc_url(of_get_option('rss_user_account',$prof_default)) . '" class="icon tooltip" data-tip="' . __("RSS" , "nexus") . '">
                        <i class="fa fa-rss"></i>
                </a>';
	}else{
		$rss = '';
	}
	if(of_get_option('skype_user_account',$prof_default) != ''){
		$skype = '<a href="' . esc_attr(of_get_option('skype_user_account',$prof_default)) . '" class="icon tooltip" data-tip="' . __("Skype" , "nexus") . '">
                        <i class="fa fa-skype"></i>
                </a>';
	}else{
		$skype = '';
	}
	if(of_get_option('deviantart_user_account',$prof_default) != ''){
		$deviantart = '<a href="' . esc_url(of_get_option('deviantart_user_account',$prof_default)) . '" class="icon tooltip" data-tip="' . __("Deviantart" , "nexus") . '">
                        <i class="fa fa-deviantart"></i>
					</a>';
	}else{
		$deviantart = '';
	}
	if(of_get_option('behance_user_account',$prof_default) != ''){
		$behance = '<a href="' . esc_url(of_get_option('behance_user_account',$prof_default)) . '" class="icon tooltip" data-tip="' . __("Behance" , "nexus") . '">
                        <i class="fa fa-behance"></i>
					</a>';
	}else{
		$behance = '';
	}
	if(of_get_option('instagram_user_account',$prof_default) != ''){
		$instagram = '<a href="' . esc_url(of_get_option('instagram_user_account',$prof_default)) . '" class="icon tooltip" data-tip="' . __("Instagram" , "nexus") . '">
                        <i class="fa fa-instagram"></i>
					</a>';
	}else{
		$instagram = '';
	}	
	if(of_get_option('google_user_account',$prof_default) != ''){
		$google = '<a href="' . esc_url(of_get_option('google_user_account',$prof_default)) . '" class="icon tooltip" data-tip="' . __("Google+" , "nexus") . '">
                        <i class="fa fa-google"></i>
					</a>';
	}else{
		$google = '';
	}
	 return '<div class="social-icons">
				' . $facebook . '
				' . $twitter . '
				' . $dribbble . '
				' . $pinterest . '
				' . $linkedin . '
				' . $rss . '
				' . $skype . '
				' . $deviantart . '
				' . $behance . '
				' . $google	. '
				' . $instagram . '
             </div>';
				
}
/*------------------------------------------------------
Nexus Socials Function - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus News Widget - Begin
-------------------------------------------------------*/
class Nexus_News_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'NexusNewsWidget', 'description' => 'Insert your News' );
	
		parent::__construct(
			'Nexus_News_Widget',
			__( 'Nexus News Widget', 'nexus' ),
			array( 'description' => __( 'Insert your News', 'nexus' ), $widget_ops )
		);
	} 


	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];			
		}
		
		echo Nexus_News_Widget_value($instance['number']);
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'nexus' );
		$number = ! empty( $instance['number'] ) ? $instance['number'] : __( '1', 'nexus' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , "nexus"); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts:' , "nexus"); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>">
		</p>		
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';

		return $instance;
	}
}
/*------------------------------------------------------
Nexus News Widget - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Socials Widget - Begin
-------------------------------------------------------*/
class Nexus_Socials_Widget extends WP_Widget {
	
	function __construct() {
		$widget_ops = array('classname' => 'NexusSocialsWidget', 'description' => 'Insert your Socials' );
	
		parent::__construct(
			'Nexus_Socials_Widget',
			__( 'Nexus Socials Widget', 'nexus' ),
			array( 'description' => __( 'Insert your Socials', 'nexus' ), $widget_ops )
		);
	} 	
	

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		echo Nexus_Socials_Widget_value();
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'nexus' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , "nexus"); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

}
/*------------------------------------------------------
Nexus Socials Widget - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Add Contact Widget - Begin
-------------------------------------------------------*/
class Nexus_Contact_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'NexusContactsWidget', 'description' => 'Insert your Contacts' );
	
		parent::__construct(
			'Nexus_Contact_Widget',
			__( 'Nexus Contact Widget', 'nexus' ),
			array( 'description' => __( 'Insert your Contacts', 'nexus' ), $widget_ops )
		);
	} 


	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		echo Nexus_Contact_Widget_value();
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'nexus' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , "nexus"); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

}
/*------------------------------------------------------
Nexus Add Contact Widget - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Testimonials Widget - Begin
-------------------------------------------------------*/
class Nexus_Testimonials_Widget extends WP_Widget {
  
	function __construct() {
		$widget_ops = array('classname' => 'NexusTestimonialsWidget', 'description' => 'Insert your Testimonials' );
	
		parent::__construct(
			'Nexus_Testimonials_Widget',
			__( 'Nexus Testimonial Widget', 'nexus' ),
			array( 'description' => __( 'Insert your Testimonials', 'nexus' ), $widget_ops )
		);
	}  
  
  
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		echo Nexus_Testimonials_Widget_value();
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'nexus' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , "nexus"); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

}
/*------------------------------------------------------
Nexus Testimonials Widget - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Register Contact Widget - Begin
-------------------------------------------------------*/
function Register_Nexus_Contact_Widget() {
    register_widget( 'Nexus_Contact_Widget' );
	register_widget( 'Nexus_Testimonials_Widget' );
	register_widget( 'Nexus_Socials_Widget' );
	register_widget( 'Nexus_News_Widget' );
}
add_action( 'widgets_init', 'Register_Nexus_Contact_Widget' );
/*------------------------------------------------------
Nexus Register Contact Widget - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Get Tags - Started
-------------------------------------------------------*/
function Nexus_display_tags(){

	$getTags =  the_tags();
	
	return $getTags;

}
/*------------------------------------------------------
Nexus Get Tags - End
-------------------------------------------------------*/

/*------------------------------------------------------
Nexus Generate CSS Styles - Started
-------------------------------------------------------*/
function Nexus_Generate_CSS(){

	global $prof_default;

	$GetStyle = "";
	
	$GetStyle .= "";
	$getcorrectbodyfont = str_replace('+', ' ', of_get_option('select_font',$prof_default));
	
	$getcorrectheadingonefont = str_replace('+', ' ', of_get_option('h1_font',$prof_default));
	$getcorrectheadingtwofont = str_replace('+', ' ', of_get_option('h2_font',$prof_default));
	$getcorrectheadingthreefont = str_replace('+', ' ', of_get_option('h3_font',$prof_default));
	$getcorrectheadingfourfont = str_replace('+', ' ', of_get_option('h4_font',$prof_default));
	$getcorrectheadingfivefont = str_replace('+', ' ', of_get_option('h5_font',$prof_default));
	$getcorrectheadingSixfont = str_replace('+', ' ', of_get_option('h6_font',$prof_default));
	
	$GetStyle .= "
		
		@font-face{font-family: entypo; src: url(" . get_template_directory_uri(). "/fonts/entypo.woff);}		
		@font-face{font-family: entyposocial; src: url(" . get_template_directory_uri(). "/fonts/entypo-social.woff);}
		@font-face{font-family: fontello; src: url(" . get_template_directory_uri(). "/fonts/fontello.woff);}
		@font-face{font-family: fontawesome; src: url(" . get_template_directory_uri(). "/fonts/fontawesome-webfont.woff);}				
		
		body, .button , .font-1, form, input, textarea, label , .price-chart h5,
		.blog-items .blog-item h4 , .app-footer .footer-content h4, .section.primary .section-title h2 span,
		.section.skills h5, .metro-block span , .font-2, blockquote, .team h4{
			font-family: " . $getcorrectbodyfont . ", sans-serif; !important;
		}

		
		h1{color:" . of_get_option('h1_color',$prof_default) . "; font-family: " . $getcorrectheadingonefont . ", sans-serif; !important; font-size: " . of_get_option('h1_font_size',$prof_default) . "; line-height: " . of_get_option('h1_line_height',$prof_default) . ";}
		h2{color:" . of_get_option('h2_color',$prof_default) . "; font-family: " . $getcorrectheadingtwofont . ", sans-serif; !important; font-size: " . of_get_option('h2_font_size',$prof_default) . "; line-height: " . of_get_option('h2_line_height',$prof_default) . ";}
		h3{color:" . of_get_option('h3_color',$prof_default) . "; font-family: " . $getcorrectheadingthreefont . ", sans-serif; !important; font-size: " . of_get_option('h3_font_size',$prof_default) . "; line-height: " . of_get_option('h3_line_height',$prof_default) . ";}
		h4{color:" . of_get_option('h4_color',$prof_default) . "; font-family: " . $getcorrectheadingfourfont . ", sans-serif; !important; font-size: " . of_get_option('h4_font_size',$prof_default) . "; line-height: " . of_get_option('h4_line_height',$prof_default) . ";}			
		h5{color:" . of_get_option('h5_color',$prof_default) . ";font-family: " . $getcorrectheadingfivefont . ", sans-serif; !important;font-size: " . of_get_option('h5_font_size',$prof_default) . ";line-height: " . of_get_option('h5_line_height',$prof_default) . ";}
		h6{color:" . of_get_option('h6_color',$prof_default) . "; font-family: " . $getcorrectheadingSixfont . ", sans-serif; !important; font-size: " . of_get_option('h6_font_size',$prof_default) . "; line-height: " . of_get_option('h6_line_height',$prof_default) . ";}			
		
		.wpb_toggle:not(.layerslider-heading), #content h4.wpb_toggle:not(.layerslider-heading) {
		  border: 1px solid #e6e6e6;
		  color: #242526 !important;
		  font-size: 16px !important;
		  margin: 0 0 5px;
		  padding: 10px 15px;
		}
		
		.wpb_toggle_content {
		  background: none repeat scroll 0 0 #fff;
		  border: 1px solid #e6e6e6;
		  margin: -6px 0 6px !important;
		  padding: 15px !important;
		}
		
		.logo{margin-top:" . of_get_option('theme_site_logo_padding_top',$prof_default) . "; margin-bottom:" . of_get_option('theme_site_logo_padding_bottom',$prof_default) . "; margin-left:" . of_get_option('theme_site_logo_padding_left',$prof_default) . ";margin-right:" . of_get_option('theme_site_logo_padding_right',$prof_default) . ";}		

		.flickr_badge_image:hover{border-color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.proftheme-widget ul li a.sentient-widget-recent-post-title:hover,{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.wpb_toggle:hover, #content h4.wpb_toggle:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		.wpb_toggle_title_active:hover, #content h4.wpb_toggle_title_active:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.wpb_toggle, #content h4.wpb_toggle{background-color:#f5f5f5 !important; background-image:none !important; color:#333 !important;}
		.wpb_toggle_title_active, #content h4.wpb_toggle_title_active{background-color:#f5f5f5 !important; color:#333 !important; background-image:none !important;}
				
		.wpb_tabs_nav.ui-tabs-nav.clearfix.ui-helper-reset.ui-helper-clearfix.ui-widget-header.ui-corner-all li.ui-state-default.ui-corner-top.ui-tabs-active.ui-state-active,
		.portfolio-pagination span:hover, .portfolio-pagination a.page-numbers:hover ,
		.portfolio-pagination .page-numbers:hover, #wp-calendar #today,
		.contactform .contact-form-send-btn{
			background:" . of_get_option('theme_color',$prof_default) . " !important;
		}

		#recentcomments .sentient-comments-author a:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.comment-edit-link,
		.Recent-post-list li:hover,
		Recent-post-list li a:hover,
		.comment-post-title,
		#recentcomments .recentcomments a,
		#comments #respond h3,
		.reply a.comment-reply-link:hover ,
		.reply:hover{
			color:" . of_get_option('theme_color',$prof_default) . " !important;
		}
		
		.div-top:hover{border:2px solid " . of_get_option('theme_color',$prof_default) . ";}
		.div-top:hover i{color:" . of_get_option('theme_color',$prof_default) . ";}
				
		
		ul.wpb_tabs_nav.ui-tabs-nav li.ui-state-default.ui-state-active a{
			color: #ffffff !important;		
		}
		
		
		ul.wpb_tabs_nav.ui-tabs-nav li.ui-state-default.ui-state-active a:hover{
			background:" .  of_get_option('theme_color',$prof_default) . " !important;
			color:#fff !important;
		}

		.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-accordion-header-active.ui-state-active a:hover,		
		.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a:hover{
			color: " . of_get_option('theme_color',$prof_default) . " !important;
			background:transparent !important;		
		}
		
		ul.wpb_tabs_nav.ui-tabs-nav li.ui-state-default a:hover{
			color: " . of_get_option('theme_color',$prof_default) . " !important;
			background:#ffffff !important;
		}		
		
		.wpb_content_element .wpb_tabs_nav li a{color:#242526 !important;}
		

		footer p a{color:" . of_get_option('theme_color',$prof_default) . " !important;}/
		
		.footer-social-links{
			background:url('" . of_get_option('social_back',$prof_default) . "') repeat scroll 0 0 transparent;
		}

		.wpb_content_element .wpb_tabs_nav li.ui-tabs-active{
		  background:" .  of_get_option('theme_color',$prof_default) . " !important;
		}
		
		.wpb_tour .wpb_tour_tabs_wrapper .wpb_tab,	
		.wpb_content_element.wpb_tabs .wpb_tour_tabs_wrapper .wpb_tab {
		  background-color: transparent !important;
		  border: 1px solid #e6e6e6 !important;
		  padding: 20px !important;
		}
		
		.wpb_content_element .wpb_accordion_wrapper .wpb_accordion_header{
		  background-color: transparent !important;
		  border: 1px solid #e6e6e6 !important;
		  padding: 10px 15px  !important;		
		}
		

				
		.dropdown-menu > .current-menu-item > a, .dropdown-menu > .current-menu-item > a:hover, .dropdown-menu > .current-menu-item > a:focus{
			color:" . of_get_option('theme_color',$prof_default) . " !important;
		}
		
		.service.style4:hover { background:" . of_get_option('theme_color',$prof_default) . "; border-color:" . of_get_option('theme_color',$prof_default) . ";}
		

		.pro .column-header,
		.status-well,
		.social-links a:hover, .social-links a:focus,
		.post-quote, .post-link,
		.fun-facts .fact:hover .fa,
		.service.style4:hover > .fa,
		.service.style3:hover > .fa,
		.portfolio-item .zoom:hover, .portfolio-item .zoom:focus, .portfolio-item .link:hover, .portfolio-item .link:focus,
		.tags-cloud a:hover, .tags-cloud a:focus{
			background:" . of_get_option('theme_color',$prof_default) . ";
		}
		
		.support-header .fa.fa-support,
		.page-header-wrap .breadcrumb li a,
		.post-audio .post-type,
		.post-footer .like:focus .fa,
		.masonry-blog .post-img .post-type, .masonry-blog .post-quote .post-type, .masonry-blog .post-video .post-type, .masonry-blog .no-media .post-type, .masonry-blog .post-link .post-type,
		.service p > a:hover, .service p > a:focus{
			color:" . of_get_option('theme_color',$prof_default) . " !important;
		}
		
		.label-primary[href]:hover, .label-primary[href]:focus,
		.label-primary,
		.progress-bar,
		.plans .header,
		.service.style1:hover > .fa { background-color:" . of_get_option('theme_color',$prof_default) . ";}
		
		.pagination > li.active > a,
		.pagination > li.active > span,
		.pagination > .active > a,
		.pagination > .active > span,
		.pagination > .active > a:hover,
		.pagination > .active > span:hover,
		.pagination > .active > a:focus,
		.pagination > .active > span:focus,
		.list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus,
		.insperia-submit input{
			background-color: " . of_get_option('theme_color',$prof_default) . ";
			border-color: " . of_get_option('theme_color',$prof_default) . ";
		}
		
		.like:hover .fa { text-shadow:0 0 5px " . of_get_option('theme_color',$prof_default) . "; }
		
		.service.style2:hover > .fa,
		.tweet-time .fa,.form-signin:hover .fa,
		.like:hover .fa, .portfolio-item .like:focus .fa,
		.options-list li.active a, .options-list li.active a:hover, .options-list li.active a:focus,
		.grid-btn:hover, .grid-btn:focus,
		.navbar .navbar-brand span, .logo span,
		.tweet-details .fa{
			color:" . of_get_option('theme_color',$prof_default) . ";
		}		
		
		.fa-angle-left:hover, .fa-angle-right:hover, .carousel-indicators .active, .carousel-indicators .active:hover { background:" . of_get_option('theme_color',$prof_default) . "; color:#fff; }
		.custom-tabs .nav-tabs > li.active > a:after { border-color: " . of_get_option('theme_color',$prof_default) . " rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);}
		
		.custom-tabs .nav-tabs > li.active > a,
		.custom-tabs .nav-tabs > li.active > a:hover,
		.custom-tabs .nav-tabs > li.active > a:focus { background:" . of_get_option('theme_color',$prof_default) . "; border-color:" . of_get_option('theme_color',$prof_default) . "; color:#fff; }
		
		.nav-tabs > li.active > a,
		.nav-tabs > li.active > a:hover,
		.nav-tabs > li.active.open > a:hover,
		.nav-tabs > li.active > a:focus{border-radius:0; background:" . of_get_option('theme_color',$prof_default) . "; color:#fff; border-color:" . of_get_option('theme_color',$prof_default) . ";}
		
		.portfolio-item a.like:hover i{ color:" . of_get_option('theme_color',$prof_default) . " !important; }
		
		.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus,
		.color-primary,.colored,.styled-header .fa,
		.colored, blockquote footer a:hover, blockquote footer a:focus,
		.error-404 h1 .fa { color:" . of_get_option('theme_color',$prof_default) . "; }		
		
		a.btn:hover{color:#fff !important;}
		
		.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus,
		.bg-primary { background-color:" . of_get_option('theme_color',$prof_default) . "; }
		
		.btn-primary.btn-line { background-color:transparent; color:" . of_get_option('theme_color',$prof_default) . "; border-color:" . of_get_option('theme_color',$prof_default) . "; box-shadow:0 0 0 1px " . of_get_option('theme_color',$prof_default) . " inset; }
		
		.btn-dark.btn-line:hover, .btn-dark.btn-line:focus,
		.btn-primary.btn-line:hover, .btn-primary.btn-line:focus { background-color:" . of_get_option('theme_color',$prof_default) . "; border-color:" . of_get_option('theme_color',$prof_default) . "; color:#fff; box-shadow:0 0 0 1px " . of_get_option('theme_color',$prof_default) . " inset; }
		
		.hero{background-image:url('" . of_get_option('slider_background_image',$prof_default) . "');}
		
		header .splash-banner.insperia-hide-image{background-image:none;}
		
		.pagination .pages a.page-numbers {
		  background: " . of_get_option('theme_color',$prof_default) . ";  
		}
		
		.btn-primary,
		.btn-primary.btn-line,
		.btn-primary.disabled,
		.btn-primary[disabled],
		fieldset[disabled] .btn-primary,
		.btn-primary.disabled:hover,
		.btn-primary[disabled]:hover,
		fieldset[disabled] .btn-primary:hover,
		.btn-primary.disabled:focus,
		.btn-primary[disabled]:focus,
		fieldset[disabled] .btn-primary:focus,
		.btn-primary.disabled:active,
		.btn-primary[disabled]:active,
		fieldset[disabled] .btn-primary:active,
		.btn-primary.disabled.active,
		.btn-primary.active[disabled],
		fieldset[disabled] .btn-primary.active{border-color:" . of_get_option('theme_color',$prof_default) . ";}
		
		.btn-primary, .btn-primary.btn-line, .btn-primary.disabled, .btn-primary[disabled], fieldset[disabled] .btn-primary, .btn-primary.disabled:hover, .btn-primary[disabled]:hover, fieldset[disabled] .btn-primary:hover, .btn-primary.disabled:focus, .btn-primary[disabled]:focus, fieldset[disabled] .btn-primary:focus, .btn-primary.disabled:active, .btn-primary[disabled]:active, fieldset[disabled] .btn-primary:active, .btn-primary.disabled.active, .btn-primary.active[disabled], fieldset[disabled] .btn-primary.active,
		.btn-primary:hover,
		.btn-primary:focus,
		.btn-primary:active,
		.btn-primary.active{background-color:" . of_get_option('theme_color',$prof_default) . "; border-color:" . of_get_option('theme_color',$prof_default) . ";}

		
		.slider-button {background:" . of_get_option('theme_color',$prof_default) . ";}

		.tp-caption a:hover , .tp-caption a {
		  color: #fff !important;
		}
	
		.footer-title, .app-footer .footer-content span, .app-footer .footer-content span div, .app-footer .footer-content span span ,.app-footer .footer-content h3{color:" . of_get_option('foo_heading_color',$prof_default) . ";}
		.app-footer {background:" . of_get_option('foo_color',$prof_default) . "; color:" . of_get_option('foo_text_color',$prof_default) . ";}		
		.app-footer .footer-content span.footer-sub-heading, .app-footer .footer-content h4.footer-sub-heading , .app-footer .footer-col , .app-footer .footer-col .widget , .app-footer .footer-content h4{color:" . of_get_option('foo_text_color',$prof_default) . ";}
		
		.bottom-bar {background:" . of_get_option('foo_copyrights_back_color',$prof_default) . ";color:" . of_get_option('foo_copyrights_text_color',$prof_default) . ";}
		
		.footer-wrapper ul.menu li a{color:" . of_get_option('foo_copyrights_text_color',$prof_default) . ";}
		
		.main-nav ul li a{color:" . of_get_option('menu_color',$prof_default) . " !important;}
		.main-nav ul li a:hover{color:" . of_get_option('menu_color_hover',$prof_default) . " !important;}
		
		.main-nav ul li.active a:hover{color:" . of_get_option('menu_color',$prof_default) . " !important;}
		
		.sh-title-wrapper , .sh-title-wrapper h1 {
		  color: " . of_get_option('page_title_color',$prof_default) . ";
		}
		
		.nexus-internal .hero{background-image:url('" . of_get_option('page_title_image',$prof_default) . "');}
		
		.blog-audio-container{background:" . of_get_option('theme_color',$prof_default) . ";}
		.proftheme-widget #searchform i.icon-search:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		.tagcloud a:hover{background:" . of_get_option('theme_color',$prof_default) . " !important; color:#fff !important;}
		
		.feature-block-wrapper {border-top: 8px solid " . of_get_option('theme_color',$prof_default) . ";}
		
		.feature-block h5{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.feature-block:hover {
		  background: " . of_get_option('theme_color',$prof_default) . ";
		  border-color: " . of_get_option('theme_color',$prof_default) . ";
		  border-top-color: " . of_get_option('theme_color',$prof_default) . ";
		}
		
		.nexus-portfolio-title , .nexus-portfolio-title h2 , .nexus-portfolio-title h3{color:" . of_get_option('portfolio_text_color',$prof_default) . " !important;}
		.nexus-portfolio-title h2 i{color:" . of_get_option('portfolio_highlighted_text_color',$prof_default) . " !important;}
		
		.nexus-blog-title , .nexus-blog-title h2 , .nexus-blog-title h3{color:" . of_get_option('blog_text_color',$prof_default) . " !important;}
		.nexus-blog-title h2 i{color:" . of_get_option('blog_highlighted_text_color',$prof_default) . " !important;}
		
		#back-top {
		  background:" . of_get_option('theme_color',$prof_default) . ";
		}
		
		.nexus-full .wpcf7-form-control.wpcf7-submit{background:" . of_get_option('theme_color',$prof_default) . ";}
		
		.ribbon .banner::after, .ribbon .banner::before {
		  background-color: " . of_get_option('pricing_ribbon_back_color',$prof_default) . ";
		}
		
		.ribbon .text::before, .ribbon .text::after {
		  background-color: " . of_get_option('pricing_ribbon_fore_color',$prof_default) . ";
		}
		
		.metro-block:hover a {color: #ffffff !important;}
		
		a.comment-reply-link{background:" . of_get_option('theme_color',$prof_default) . ";}
		a.comment-reply-link:hover{color: #ffffff !important;}
		
		::-moz-selection , ::selection {
			background-color: " . of_get_option('theme_color',$prof_default) . ";
		}
		
		.comments .comment-reply .comment-content {
			border-left: 4px solid " . of_get_option('theme_color',$prof_default) . ";
		}
		
		.flyout-nav-container ul ul ul li:hover > a {
		  border-left-color: " . of_get_option('theme_color',$prof_default) . ";
		}

		.flyout-nav-container > ul > li > a {
		  border-left-color: " . of_get_option('theme_color',$prof_default) . ";
		}		
		
		.why-choose-us .wcu-feature:hover:after {
		  border-bottom-color: " . of_get_option('theme_color',$prof_default) . ";
		}
		
		.testimonials-slider .testimonial blockquote cite,
		.clients-slider a:hover,
		.section.clients .client-logos a:hover,
		.section.banner.alt,
		#twitter-feed .tweet-time a,
		.portfolio-carousel .owl-dots div.active,
		.footer-testimonials blockquote,
		.flyout-nav-container ul ul li:hover > a,
		.flyout-nav-container ul a:hover,
		.earth .pin-wrapper.active .pin,
		.comments .reply:hover,
		.comments .report:hover,
		.blog-items .date span:first-child,
		table thead, .breadcrumb li.home a:hover,
		[class^='icon'][class*='-border']:hover,
		[class^='icon'][class*='-plain']:hover,		
		[class^='icon'], .comments .comment-quote,
		.input-toggle input:checked + label:before,
		form input[type='submit'],
		form input button,		
		form .form-element input:focus ~ label,
		form .form-element textarea:focus ~ label,		
		.feature-block .fa,
		.button.brand-1:hover,
		.button.brand-1 {
		  background: " . of_get_option('theme_color',$prof_default) . ";
		}

		.breadcrumb li.home a:hover,
		[class^='icon'][class*='-border']:hover,
		[class^='icon'][class*='-plain']:hover,
		form .box:focus,
		form .box:hover {
		  border-color: " . of_get_option('theme_color',$prof_default) . ";
		}		

		a {color: " . of_get_option('theme_color',$prof_default) . ";}	
		
		.input-toggle input:checked + label:after {
		  -webkit-box-shadow: inset 0 0 0 1px " . of_get_option('theme_color',$prof_default) . ";
		  box-shadow: inset 0 0 0 1px " . of_get_option('theme_color',$prof_default) . ";
		}		
		
		h1 i, h2 i, h3 i, h4 i, h5 i, h6 i {color: " . of_get_option('theme_color',$prof_default) . ";}		
		
		h1.highlight > b,
		h2.highlight > b,
		h3.highlight > b,
		h4.highlight > b,
		h5.highlight > b,
		h6.highlight > b {
		  background: " . of_get_option('theme_color',$prof_default) . ";
		  -webkit-box-shadow: 0.3em 0 0 " . of_get_option('theme_color',$prof_default) . ", -0.3em 0 0 " . of_get_option('theme_color',$prof_default) . ";
		  box-shadow: 0.3em 0 0 " . of_get_option('theme_color',$prof_default) . ", -0.3em 0 0 " . of_get_option('theme_color',$prof_default) . ";
		}		

		.widget:hover path,
		.feature-block path {
		  fill: " . of_get_option('theme_color',$prof_default) . ";
		}

		.section.quote {
		  background-color: " . of_get_option('theme_color',$prof_default) . ";
		}		
		
		.team .mask:before {
		  border: 2px solid " . of_get_option('theme_color',$prof_default) . ";
		}		
		
		.earth .pin {
		  background: " . of_get_option('theme_color',$prof_default) . ";
		}		
		
		.hero .hero-title h3,		
		 body.single-project .info-graphic h5,
		.team h5,
		.section.primary .section-title h2 span,
		.section-title p,
		.section header ul li .fa,
		.hero .blurb a:hover,	
		.section.clients h5,
		.section.banner.alt .button:hover,
		.main-search [type='submit']:hover,
		.app-footer .footer-content ul i,
		body .cp-nav-container .main-search [type='submit']:hover,
		body .cp-nav-container > ul li:hover > a,
		body .cp-nav-container > ul li.active > a,
		.breadcrumb li.current a,
		.breadcrumb li a:hover,
		.post-author h4 a:hover,
		.post-author h5,
		.widget h5,
		.button-set a:not([class*='button']):hover,
		.accordion > *.active > *:first-child,
		.accordion > *:hover > *:first-child:before,
		.accordion > *.active > *:first-child:before {
		  color: " . of_get_option('theme_color',$prof_default) . ";
		}
		
		.accordion > *.active {
		  border-right: 8px solid " . of_get_option('theme_color',$prof_default) . ";
		}
	
		.footer-testimonials blockquote:after {
		  border-top-color: " . of_get_option('theme_color',$prof_default) . ";
		}
		
		.nav-carousel.nexus-services-slider [class*='nav-']:hover ,
		.section.primary .nav-carousel [class*='nav-']:hover {
		  border-color: " . of_get_option('theme_color',$prof_default) . ";
		  background: " . of_get_option('theme_color',$prof_default) . ";
		}		
		
		.spinner {border-top: 8px solid " . of_get_option('theme_color',$prof_default) . ";}		
		

		
		.section.primary .section-title h2 b,
		.newsletter [type='submit']:hover {
		  background: " . of_get_option('theme_color',$prof_default) . ";
		}
		
		.pagination span.current,
		.pagination li.active a,		
		.pagination a:hover ,
		.pagination li a:hover {
		  background: " . of_get_option('theme_color',$prof_default) . ";
		  border-color: " . of_get_option('theme_color',$prof_default) . ";
		}

		.portfolio-items .portfolio-item:before {
		  border: 2px solid " . of_get_option('theme_color',$prof_default) . ";
		}		
		
		.scroll-top:hover {
		  border-color: " . of_get_option('theme_color',$prof_default) . " !important;
		}

		.main-nav ul li ul:after,
		.main-nav > ul > li ul:after {
		  background: " . of_get_option('menu_color_hover',$prof_default) . ";
		}		
		
		.main-nav ul li ul li:first-child > a,
		.main-nav > ul > li ul li:first-child > a {
		  border-top: 8px solid " . of_get_option('menu_color_hover',$prof_default) . " !important;
		}		
		
		.main-nav ul li ul li:hover a,
		.main-nav > ul > li ul li:hover a {
		  background: " . of_get_option('menu_color_hover',$prof_default) . " !important;
		}

		.navbar-nav > li.current_page_item  > a,
		.navbar-nav > li.current-menu-item > a {
		  background: " . of_get_option('menu_color_hover',$prof_default) . ";
		}
		
		.main-nav ul li.active a,
		.main-nav > ul > li.active > a {
		  background: " . of_get_option('menu_color_hover',$prof_default) . ";
		  border-color: " . of_get_option('menu_color_hover',$prof_default) . ";
		}		
		
		[class*='bullet-list'] li:before,
		[class*='bullet-list'] li:after {
		  color: " . of_get_option('theme_color',$prof_default) . ";
		}
		
		.navbar-nav > li.current_page_item > a:hover, .navbar-nav > li.current-menu-item > a:hover{border-color: " . of_get_option('menu_color_hover',$prof_default) . ";}
		
		.footer-wrapper ul.menu li a:hover{color: " . of_get_option('theme_color',$prof_default) . " !important;}
		
		.nexus-header-title .section-title h2 i:not(.fa),
		.nexus-header-title p i {
		  color: " . of_get_option('theme_color',$prof_default) . ";
		}
		
		
		";			
		
	$GetStyle .= of_get_option('css_text',$prof_default);
	$GetStyle .= " 
	
	";
	$GetStyle .= "
	
	";
	
	return $GetStyle;	
}

/***************************************************/
/*Nexus Import CSS Styles - End*/
/***************************************************/

/***************************************************/
/*Nexus Custom Field Icon List - End*/
/***************************************************/
add_action('in_widget_form', 'nexus_in_widget_form',5,3);
add_filter('widget_update_callback', 'nexus_in_widget_form_update',5,3);
add_filter('dynamic_sidebar_params', 'nexus_dynamic_sidebar_params');

function nexus_in_widget_form($t,$return,$instance){
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'float' => 'none') );

    if ( !isset($instance['texttest']) )
        $instance['texttest'] = null;
    ?>

    <label style="margin-bottom:10px;display:block;">Widget Desc: <input class="widefat" type="text" name="<?php echo $t->get_field_name('texttest'); ?>" id="<?php echo $t->get_field_id('texttest'); ?>" value="<?php echo $instance['texttest'];?>" /></label>
    <?php
    $retrun = null;
    return array($t,$return,$instance);
}

function nexus_in_widget_form_update($instance, $new_instance, $old_instance){
    $instance['texttest'] = strip_tags($new_instance['texttest']);
    return $instance;
}

function nexus_dynamic_sidebar_params($params){
    global $wp_registered_widgets;
    $widget_id = $params[0]['widget_id'];
    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number'];
    if (isset($widget_opt[$widget_num]['texttest']) && ($widget_opt[$widget_num]['texttest'] != '')){
			$params[0]['after_title'] =  '</h3><span class="footer-sub-heading" >' . $widget_opt[$widget_num]['texttest'] . '</span>';			
    }
    return $params;
}



/***************************************************/
/*Nexus Custom Field Icon List - Started*/
/***************************************************/
function create_post_icon_list( $object, $box ) { ?>
	<p>
		<label for="post-icon">Icon</label>
		<br />
		<select name="post-icon" id="post-icon" cols="60" rows="4" tabindex="30" style="width: 97%;">
			<option value="align-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'align-left'){ ?> selected="selected" <?php } ?>>Align Left</option>
			<option value="align-center" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'align-center'){ ?> selected="selected" <?php } ?>>Align Center</option>
			<option value="align-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'align-right'){ ?> selected="selected" <?php } ?>>Align Right</option>
			<option value="align-justify" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'align-justify'){ ?> selected="selected" <?php } ?>>Align Justify</option>
			<option value="arrows" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrows'){ ?> selected="selected" <?php } ?>>Arrows</option>
			<option value="arrow-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-left'){ ?> selected="selected" <?php } ?>>Align Justify</option>
			<option value="arrow-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-right'){ ?> selected="selected" <?php } ?>>Arrow Left</option>
			<option value="arrow-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-up'){ ?> selected="selected" <?php } ?>>Arrow Up</option>
			<option value="arrow-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-down'){ ?> selected="selected" <?php } ?>>Arrow Down</option>
			<option value="asterisk" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'asterisk'){ ?> selected="selected" <?php } ?>>Asterisk</option>
			<option value="arrows-v" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrows-v'){ ?> selected="selected" <?php } ?>>Arrows V</option>
			<option value="arrows-h" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrows-h'){ ?> selected="selected" <?php } ?>>Arrows H</option>
			<option value="arrow-circle-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-circle-left'){ ?> selected="selected" <?php } ?>>Arrow Circle Left</option>
			<option value="arrow-circle-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-circle-right'){ ?> selected="selected" <?php } ?>>Arrow Circle Right</option>
			<option value="arrow-circle-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-circle-up'){ ?> selected="selected" <?php } ?>>Arrow Circle Up</option>
			<option value="arrow-circle-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-circle-down'){ ?> selected="selected" <?php } ?>>Arrow Circle Down</option>
			<option value="arrows-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrows-alt'){ ?> selected="selected" <?php } ?>>Arrows Alt</option>
			<option value="ambulance" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ambulance'){ ?> selected="selected" <?php } ?>>Ambulance</option>
			<option value="adn" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'adn'){ ?> selected="selected" <?php } ?>>Adn</option>
			<option value="angle-double-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-double-left'){ ?> selected="selected" <?php } ?>>Angle Double Left</option>
			<option value="angle-double-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-double-right'){ ?> selected="selected" <?php } ?>>Angle Double Right</option>
			<option value="angle-double-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-double-up'){ ?> selected="selected" <?php } ?>>Angle Double Up</option>
			<option value="angle-double-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-double-down'){ ?> selected="selected" <?php } ?>>Angle Double Down</option>
			<option value="angle-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-left'){ ?> selected="selected" <?php } ?>>Angle Left</option>
			<option value="angle-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-right'){ ?> selected="selected" <?php } ?>>Angle Right</option>
			<option value="angle-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-up'){ ?> selected="selected" <?php } ?>>Angle Up</option>
			<option value="angle-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-down'){ ?> selected="selected" <?php } ?>>Angle Down</option>
			<option value="anchor" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'anchor'){ ?> selected="selected" <?php } ?>>Anchor</option>
			<option value="android" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'android'){ ?> selected="selected" <?php } ?>>Android</option>
			<option value="apple" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'apple'){ ?> selected="selected" <?php } ?>>Apple</option>
			<option value="archive" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'archive'){ ?> selected="selected" <?php } ?>>Archive</option>
			<option value="automobile" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'automobile'){ ?> selected="selected" <?php } ?>>Archive</option>
			<option value="bars" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bars'){ ?> selected="selected" <?php } ?>>Bars</option>
			<option value="backward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'backward'){ ?> selected="selected" <?php } ?>>Backward</option>
			<option value="ban" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ban'){ ?> selected="selected" <?php } ?>>Ban</option>
			<option value="barcode" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'barcode'){ ?> selected="selected" <?php } ?>>Barcode</option>
			<option value="bank" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bank'){ ?> selected="selected" <?php } ?>>Bank</option>
			<option value="bell" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bell'){ ?> selected="selected" <?php } ?>>Bell</option>
			<option value="book" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'book'){ ?> selected="selected" <?php } ?>>Book</option>
			<option value="bookmark" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bookmark'){ ?> selected="selected" <?php } ?>>Bookmark</option>
			<option value="bold" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bold'){ ?> selected="selected" <?php } ?>>Bold</option>
			<option value="bullhorn" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bullhorn'){ ?> selected="selected" <?php } ?>>Bullhorn</option>
			<option value="briefcase" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'briefcase'){ ?> selected="selected" <?php } ?>>Briefcase</option>
			<option value="bolt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bolt'){ ?> selected="selected" <?php } ?>>Bolt</option>
			<option value="beer" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'beer'){ ?> selected="selected" <?php } ?>>Beer</option>
			<option value="behance" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'behance'){ ?> selected="selected" <?php } ?>>Behance</option>
			<option value="bitcoin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bitcoin'){ ?> selected="selected" <?php } ?>>Bitcoin</option>
			<option value="bitbucket" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bitbucket'){ ?> selected="selected" <?php } ?>>Bitbucket</option>
			<option value="bomb" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bomb'){ ?> selected="selected" <?php } ?>>Bomb</option>
			<option value="glass" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'glass'){ ?> selected="selected" <?php } ?>>Glass</option>
			<option value="bullseye" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bullseye'){ ?> selected="selected" <?php } ?>>Bullseye</option>
			<option value="bug" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bug'){ ?> selected="selected" <?php } ?>>Bug</option>
			<option value="building" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'building'){ ?> selected="selected" <?php } ?>>Building</option>
			<option value="check" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'check'){ ?> selected="selected" <?php } ?>>Check</option>
			<option value="cog" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cog'){ ?> selected="selected" <?php } ?>>Cog</option>
			<option value="camera" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'camera'){ ?> selected="selected" <?php } ?>>Camera</option>
			<option value="crosshairs" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'crosshairs'){ ?> selected="selected" <?php } ?>>Cross Hairs</option>
			<option value="compress" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'compress'){ ?> selected="selected" <?php } ?>>Compress</option>
			<option value="calendar" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'calendar'){ ?> selected="selected" <?php } ?>>Calendar</option>
			<option value="comment" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'comment'){ ?> selected="selected" <?php } ?>>Comment</option>
			<option value="cogs" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cogs'){ ?> selected="selected" <?php } ?>>Cogs</option>
			<option value="comments" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'comments'){ ?> selected="selected" <?php } ?>>Comments</option>
			<option value="credit-card" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'credit-card'){ ?> selected="selected" <?php } ?>>Credit Card</option>
			<option value="certificate" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'certificate'){ ?> selected="selected" <?php } ?>>Certificate</option>
			<option value="chain" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chain'){ ?> selected="selected" <?php } ?>>Chain</option>
			<option value="cloud" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cloud'){ ?> selected="selected" <?php } ?>>Cloud</option>
			<option value="cut" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cut'){ ?> selected="selected" <?php } ?>>Cut</option>
			<option value="copy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'copy'){ ?> selected="selected" <?php } ?>>Copy</option>
			<option value="caret-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'caret-down'){ ?> selected="selected" <?php } ?>>Caret Down</option>
			<option value="caret-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'caret-up'){ ?> selected="selected" <?php } ?>>Caret Up</option>
			<option value="caret-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'caret-left'){ ?> selected="selected" <?php } ?>>Caret Left</option>
			<option value="caret-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'caret-right'){ ?> selected="selected" <?php } ?>>Caret Right</option>
			<option value="columns" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'columns'){ ?> selected="selected" <?php } ?>>Columns</option>
			<option value="clipboard" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'clipboard'){ ?> selected="selected" <?php } ?>>Clipboard</option>
			<option value="cloud-download" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cloud-download'){ ?> selected="selected" <?php } ?>>Cloud Download</option>
			<option value="cloud-upload" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cloud-upload'){ ?> selected="selected" <?php } ?>>Cloud Upload</option>
			<option value="coffee" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'coffee'){ ?> selected="selected" <?php } ?>>Coffee</option>
			<option value="cutlery" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cutlery'){ ?> selected="selected" <?php } ?>>Cutlery</option>
			<option value="car" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'car'){ ?> selected="selected" <?php } ?>>Car</option>
			<option value="cab" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cab'){ ?> selected="selected" <?php } ?>>Cab</option>
			<option value="chevron-circle-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chevron-circle-left'){ ?> selected="selected" <?php } ?>>Chevron Circle Left</option>
			<option value="chevron-circle-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chevron-circle-right'){ ?> selected="selected" <?php } ?>>Chevron Circle Right</option>
			<option value="chevron-circle-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chevron-circle-up'){ ?> selected="selected" <?php } ?>>Chevron Circle Up</option>
			<option value="chevron-circle-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chevron-circle-down'){ ?> selected="selected" <?php } ?>>Chevron Circle Down</option>
			<option value="check-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'check-square'){ ?> selected="selected" <?php } ?>>Check Square</option>
			<option value="child" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'child'){ ?> selected="selected" <?php } ?>>Child</option>
			<option value="chain-broken" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chain-broken'){ ?> selected="selected" <?php } ?>>Chain Broken</option>
			<option value="circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'circle'){ ?> selected="selected" <?php } ?>>Circle</option>
			<option value="circle-thin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'circle-thin'){ ?> selected="selected" <?php } ?>>Circle Thin</option>
			<option value="cny" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cny'){ ?> selected="selected" <?php } ?>>CNY</option>
			<option value="code" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'code'){ ?> selected="selected" <?php } ?>>Code</option>
			<option value="compass" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'compass'){ ?> selected="selected" <?php } ?>>Compass</option>
			<option value="codepen" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'codepen'){ ?> selected="selected" <?php } ?>>Code Pen</option>
			<option value="css3" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'css3'){ ?> selected="selected" <?php } ?>>CSS3</option>
			<option value="cube" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cube'){ ?> selected="selected" <?php } ?>>Cube</option>
			<option value="cubes" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cubes'){ ?> selected="selected" <?php } ?>>Cubes</option>
			<option value="download" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'download'){ ?> selected="selected" <?php } ?>>Download</option>
			<option value="dedent" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dedent'){ ?> selected="selected" <?php } ?>>Dedent</option>
			<option value="dashboard" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dashboard'){ ?> selected="selected" <?php } ?>>Dashboard</option>
			<option value="database" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'database'){ ?> selected="selected" <?php } ?>>Database</option>
			<option value="glass" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'glass'){ ?> selected="selected" <?php } ?>>Glass</option>
			<option value="desktop" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'desktop'){ ?> selected="selected" <?php } ?>>Desktop</option>
			<option value="delicious" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'delicious'){ ?> selected="selected" <?php } ?>>Delicious</option>
			<option value="drupal" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'drupal'){ ?> selected="selected" <?php } ?>>Drupal</option>
			<option value="dribbble" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dribbble'){ ?> selected="selected" <?php } ?>>Dribbble</option>
			<option value="dropbox" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dropbox'){ ?> selected="selected" <?php } ?>>Dropbox</option>
			<option value="dollar" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dollar'){ ?> selected="selected" <?php } ?>>Dollar</option>
			<option value="digg" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'digg'){ ?> selected="selected" <?php } ?>>Digg</option>
			<option value="exchange" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'exchange'){ ?> selected="selected" <?php } ?>>Exchange</option>
			<option value="eyedropper" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eyedropper'){ ?> selected="selected" <?php } ?>>Eye Dropper</option>
			<option value="eject" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eject'){ ?> selected="selected" <?php } ?>>Eject</option>
			<option value="expand" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'expand'){ ?> selected="selected" <?php } ?>>Expand</option>
			<option value="exclamation-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'exclamation-circle'){ ?> selected="selected" <?php } ?>>Exclamation Circle</option>
			<option value="eye" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eye'){ ?> selected="selected" <?php } ?>>Eye</option>
			<option value="eye-slash" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eye-slash'){ ?> selected="selected" <?php } ?>>Eye Slash</option>
			<option value="exclamation-triangle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'exclamation-triangle'){ ?> selected="selected" <?php } ?>>Exclamation Triangle</option>
			<option value="external-link" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'external-link'){ ?> selected="selected" <?php } ?>>External Link</option>
			<option value="envelope" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'envelope'){ ?> selected="selected" <?php } ?>>Envelope</option>
			<option value="empire" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'empire'){ ?> selected="selected" <?php } ?>>Empire</option>
			<option value="eraser" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eraser'){ ?> selected="selected" <?php } ?>>Eraser</option>
			<option value="exclamation" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'exclamation'){ ?> selected="selected" <?php } ?>>Exclamation</option>
			<option value="ellipsis-h" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ellipsis-h'){ ?> selected="selected" <?php } ?>>Ellipsis H</option>
			<option value="ellipsis-v" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ellipsis-v'){ ?> selected="selected" <?php } ?>>Ellipsis V</option>
			<option value="euro" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'euro'){ ?> selected="selected" <?php } ?>>Euro</option>
			<option value="eur" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eur'){ ?> selected="selected" <?php } ?>>Eur</option>
			<option value="flash" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'flash'){ ?> selected="selected" <?php } ?>>Flash</option>
			<option value="fighter-jet" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fighter-jet'){ ?> selected="selected" <?php } ?>>Fighter Jet</option>
			<option value="film" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'film'){ ?> selected="selected" <?php } ?>>Film</option>
			<option value="flag" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'flag'){ ?> selected="selected" <?php } ?>>Flag</option>
			<option value="font" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'font'){ ?> selected="selected" <?php } ?>>Font</option>
			<option value="fast-backward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fast-backward'){ ?> selected="selected" <?php } ?>>Fast Backward</option>
			<option value="forward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'forward'){ ?> selected="selected" <?php } ?>>Forward</option>
			<option value="fast-forward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fast-forward'){ ?> selected="selected" <?php } ?>>Fast Forward</option>
			<option value="fire" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fire'){ ?> selected="selected" <?php } ?>>Fire</option>
			<option value="folder" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'folder'){ ?> selected="selected" <?php } ?>>Folder</option>
			<option value="folder-open" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'folder-open'){ ?> selected="selected" <?php } ?>>Folder Open</option>
			<option value="facebook" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'facebook'){ ?> selected="selected" <?php } ?>>Facebook</option>
			<option value="filter" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'filter'){ ?> selected="selected" <?php } ?>>Filter</option>
			<option value="fax" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fax'){ ?> selected="selected" <?php } ?>>Fax</option>
			<option value="female" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'female'){ ?> selected="selected" <?php } ?>>Female</option>
			<option value="foursquare" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'foursquare'){ ?> selected="selected" <?php } ?>>foursquare</option>
			<option value="fire-extinguisher" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fire-extinguisher'){ ?> selected="selected" <?php } ?>>Fire Extinguisher</option>
			<option value="flag-checkered" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'flag-checkered'){ ?> selected="selected" <?php } ?>>Flag Checkered</option>
			<option value="file" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'file'){ ?> selected="selected" <?php } ?>>File</option>
			<option value="file-text" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'file-text'){ ?> selected="selected" <?php } ?>>File Text</option>
			<option value="flickr" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'flickr'){ ?> selected="selected" <?php } ?>>flickr</option>
			<option value="google-plus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'google-plus'){ ?> selected="selected" <?php } ?>>Google Plus</option>
			<option value="gavel" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gavel'){ ?> selected="selected" <?php } ?>>Gavel</option>
			<option value="glass" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'glass'){ ?> selected="selected" <?php } ?>>Glass</option>
			<option value="gear" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gear'){ ?> selected="selected" <?php } ?>>Gear</option>
			<option value="gift" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gift'){ ?> selected="selected" <?php } ?>>Gift</option>
			<option value="gears" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gears'){ ?> selected="selected" <?php } ?>>Gears</option>
			<option value="github" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'github'){ ?> selected="selected" <?php } ?>>Github</option>
			<option value="globe" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'globe'){ ?> selected="selected" <?php } ?>>Globe</option>
			<option value="group" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'group'){ ?> selected="selected" <?php } ?>>Group</option>
			<option value="google" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'google'){ ?> selected="selected" <?php } ?>>Google</option>
			<option value="graduation-cap" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'graduation-cap'){ ?> selected="selected" <?php } ?>>Graduation Cap</option>
			<option value="gittip" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gittip'){ ?> selected="selected" <?php } ?>>Gittip</option>
			<option value="gbp" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gbp'){ ?> selected="selected" <?php } ?>>GBP</option>
			<option value="gamepad" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gamepad'){ ?> selected="selected" <?php } ?>>Game Pad</option>
			<option value="git" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'git'){ ?> selected="selected" <?php } ?>>GIT</option>
			<option value="heart" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'heart'){ ?> selected="selected" <?php } ?>>Heart</option>
			<option value="home" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'home'){ ?> selected="selected" <?php } ?>>Home</option>
			<option value="headphones" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'headphones'){ ?> selected="selected" <?php } ?>>Headphones</option>
			<option value="header" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'header'){ ?> selected="selected" <?php } ?>>Header</option>
			<option value="history" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'history'){ ?> selected="selected" <?php } ?>>History</option>
			<option value="hacker-news" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hacker-news'){ ?> selected="selected" <?php } ?>>Hacker News</option>
			<option value="html5" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'html5'){ ?> selected="selected" <?php } ?>>HTML5</option>
			<option value="h-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'h-square'){ ?> selected="selected" <?php } ?>>H Square</option>
			<option value="italic" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'italic'){ ?> selected="selected" <?php } ?>>Italic</option>
			<option value="indent" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'indent'){ ?> selected="selected" <?php } ?>>Indent</option>
			<option value="image" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'image'){ ?> selected="selected" <?php } ?>>Image</option>
			<option value="inverse" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'inverse'){ ?> selected="selected" <?php } ?>>Inverse</option>
			<option value="inbox" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'inbox'){ ?> selected="selected" <?php } ?>>Inbox</option>
			<option value="institution" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'institution'){ ?> selected="selected" <?php } ?>>Institution</option>
			<option value="instagram" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'instagram'){ ?> selected="selected" <?php } ?>>Instagram</option>
			<option value="inr" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'inr'){ ?> selected="selected" <?php } ?>>INR</option>
			<option value="info" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'info'){ ?> selected="selected" <?php } ?>>Info</option>
			<option value="jsfiddle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'jsfiddle'){ ?> selected="selected" <?php } ?>>JS Fiddle</option>
			<option value="joomla" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'joomla'){ ?> selected="selected" <?php } ?>>Joomla</option>
			<option value="jpy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'jpy'){ ?> selected="selected" <?php } ?>>JPY</option>
			<option value="key" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'key'){ ?> selected="selected" <?php } ?>>Key</option>
			<option value="krw" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'krw'){ ?> selected="selected" <?php } ?>>KRW</option>
			<option value="link" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'link'){ ?> selected="selected" <?php } ?>>Link</option>
			<option value="list-ul" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'list-ul'){ ?> selected="selected" <?php } ?>>List Ul</option>
			<option value="list-ol" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'list-ol'){ ?> selected="selected" <?php } ?>>List OL</option>
			<option value="linkedin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'linkedin'){ ?> selected="selected" <?php } ?>>LinkedIn</option>
			<option value="legal" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'legal'){ ?> selected="selected" <?php } ?>>Legal</option>
			<option value="list-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'list-alt'){ ?> selected="selected" <?php } ?>>List Alt</option>
			<option value="lock" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'lock'){ ?> selected="selected" <?php } ?>>Lock</option>
			<option value="list" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'list'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="leaf" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'leaf'){ ?> selected="selected" <?php } ?>>Leaf</option>
			<option value="life-bouy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'life-bouy'){ ?> selected="selected" <?php } ?>>Lifebouy</option>
			<option value="life-saver" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'life-saver'){ ?> selected="selected" <?php } ?>>Life Saver</option>
			<option value="language" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'language'){ ?> selected="selected" <?php } ?>>Language</option>
			<option value="laptop" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'laptop'){ ?> selected="selected" <?php } ?>>Laptop</option>
			<option value="level-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'level-up'){ ?> selected="selected" <?php } ?>>Level up</option>
			<option value="level-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'level-down'){ ?> selected="selected" <?php } ?>>Level Down</option>
			<option value="linux" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'linux'){ ?> selected="selected" <?php } ?>>Linux</option>
			<option value="life-ring" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'life-ring'){ ?> selected="selected" <?php } ?>>Life Ring</option>
			<option value="magnet" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'magnet'){ ?> selected="selected" <?php } ?>>Magnet</option>
			<option value="map-marker" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'map-marker'){ ?> selected="selected" <?php } ?>>Map Marker</option>
			<option value="magic" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'magic'){ ?> selected="selected" <?php } ?>>Magic</option>
			<option value="money" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'money'){ ?> selected="selected" <?php } ?>>Money</option>
			<option value="medkit" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'medkit'){ ?> selected="selected" <?php } ?>>Med kit</option>
			<option value="music" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'music'){ ?> selected="selected" <?php } ?>>Music</option>
			<option value="mail-forward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mail-forward'){ ?> selected="selected" <?php } ?>>Mail Forward</option>
			<option value="minus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'minus'){ ?> selected="selected" <?php } ?>>Minus</option>
			<option value="mortar-board" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mortar-board'){ ?> selected="selected" <?php } ?>>Mortar Board</option>
			<option value="male" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'male'){ ?> selected="selected" <?php } ?>>Male</option>
			<option value="mobile-phone" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mobile-phone'){ ?> selected="selected" <?php } ?>>Mobile Phone</option>
			<option value="mobile" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mobile'){ ?> selected="selected" <?php } ?>>Mobile</option>
			<option value="mail-reply" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mail-reply'){ ?> selected="selected" <?php } ?>>Mail Reply</option>
			<option value="microphone" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'microphone'){ ?> selected="selected" <?php } ?>>Microphone</option>
			<option value="microphone-slash" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'microphone-slash'){ ?> selected="selected" <?php } ?>>Microphone Slash</option>
			<option value="navicon" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'navicon'){ ?> selected="selected" <?php } ?>>Nav icon</option>
			<option value="lightbulb-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'lightbulb-o'){ ?> selected="selected" <?php } ?>>Open Lightbulb</option>
			<option value="bell-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bell-o'){ ?> selected="selected" <?php } ?>>Open Bell</option>
			<option value="building-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'building-o'){ ?> selected="selected" <?php } ?>>Open Building</option>
			<option value="hospital-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hospital-o'){ ?> selected="selected" <?php } ?>>Open Hospital</option>
			<option value="envelope-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'envelope-o'){ ?> selected="selected" <?php } ?>>Open Envelope</option>
			<option value="star-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'star-o'){ ?> selected="selected" <?php } ?>>Open Star</option>
			<option value="trash-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'trash-o'){ ?> selected="selected" <?php } ?>>Open Trash</option>
			<option value="file-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'file-o'){ ?> selected="selected" <?php } ?>>Open File</option>
			<option value="clock-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'clock-o'){ ?> selected="selected" <?php } ?>>Open Clock</option>
			<option value="outdent" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'outdent'){ ?> selected="selected" <?php } ?>>Outdent</option>
			<option value="picture-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'picture-o'){ ?> selected="selected" <?php } ?>>Open Picture</option>
			<option value="pencil-square-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pencil-square-o'){ ?> selected="selected" <?php } ?>>Open Pencil Square</option>
			<option value="bar-chart-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bar-chart-o'){ ?> selected="selected" <?php } ?>>Open Bar Chart</option>
			<option value="thumbs-o-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'thumbs-o-up'){ ?> selected="selected" <?php } ?>>Open Thumbs Up</option>
			<option value="thumbs-o-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'thumbs-o-down'){ ?> selected="selected" <?php } ?>>Open Thumbs Down</option>
			<option value="heart-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'heart-o'){ ?> selected="selected" <?php } ?>>Open Heart</option>
			<option value="lemon-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'lemon-o'){ ?> selected="selected" <?php } ?>>Open Lemon</option>
			<option value="square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'square'){ ?> selected="selected" <?php } ?>>Open Square</option>
			<option value="bookmark-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bookmark-o'){ ?> selected="selected" <?php } ?>>Open Bookmark</option>
			<option value="hdd-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hdd-o'){ ?> selected="selected" <?php } ?>>Open hdd</option>
			<option value="hand-o-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hand-o-right'){ ?> selected="selected" <?php } ?>>Open Hand Right</option>
			<option value="hand-o-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hand-o-left'){ ?> selected="selected" <?php } ?>>Open Hand Left</option>
			<option value="hand-o-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hand-o-up'){ ?> selected="selected" <?php } ?>>Open Hand Up</option>
			<option value="hand-o-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hand-o-down'){ ?> selected="selected" <?php } ?>>Open Hand Down</option>
			<option value="files-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'files-o'){ ?> selected="selected" <?php } ?>>Open Files</option>
			<option value="floppy-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'floppy-o'){ ?> selected="selected" <?php } ?>>Open Floppy</option>
			<option value="circle-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'circle-o'){ ?> selected="selected" <?php } ?>>Open Circle</option>
			<option value="folder-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'folder-o'){ ?> selected="selected" <?php } ?>>Open Folder</option>
			<option value="smile-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'smile-o'){ ?> selected="selected" <?php } ?>>Open Smile</option>
			<option value="pinterest" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pinterest'){ ?> selected="selected" <?php } ?>>Pinterest</option>
			<option value="paste" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paste'){ ?> selected="selected" <?php } ?>>Paste</option>
			<option value="power-off" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'power-off'){ ?> selected="selected" <?php } ?>>Power Off</option>
			<option value="print" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'print'){ ?> selected="selected" <?php } ?>>Print</option>
			<option value="photo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'photo'){ ?> selected="selected" <?php } ?>>Photo</option>
			<option value="play" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'play'){ ?> selected="selected" <?php } ?>>Play</option>
			<option value="pause" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pause'){ ?> selected="selected" <?php } ?>>Pause</option>
			<option value="plus-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'plus-circle'){ ?> selected="selected" <?php } ?>>Plus Circle</option>
			<option value="plus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'plus'){ ?> selected="selected" <?php } ?>>Plus</option>
			<option value="plane" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'plane'){ ?> selected="selected" <?php } ?>>Plane</option>
			<option value="phone" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'phone'){ ?> selected="selected" <?php } ?>>Phone</option>
			<option value="phone-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'phone-square'){ ?> selected="selected" <?php } ?>>Phone Square</option>
			<option value="paperclip" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paperclip'){ ?> selected="selected" <?php } ?>>Paper Clip</option>
			<option value="puzzle-piece" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'puzzle-piece'){ ?> selected="selected" <?php } ?>>Puzzle Piece</option>
			<option value="play-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'play-circle'){ ?> selected="selected" <?php } ?>>Play Circle</option>
			<option value="pencil-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pencil-square'){ ?> selected="selected" <?php } ?>>Pencil Square</option>
			<option value="pagelines" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pagelines'){ ?> selected="selected" <?php } ?>>Page Lines</option>
			<option value="pied-piper-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pied-piper-square'){ ?> selected="selected" <?php } ?>>Pied Piper Square</option>
			<option value="pied-piper" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pied-piper'){ ?> selected="selected" <?php } ?>>Pied Piper</option>
			<option value="pied-piper-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pied-piper-alt'){ ?> selected="selected" <?php } ?>>Pied Piper Alt</option>
			<option value="paw" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paw'){ ?> selected="selected" <?php } ?>>Paw</option>
			<option value="paper-plane" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paper-plane'){ ?> selected="selected" <?php } ?>>Paper Plane</option>
			<option value="paragraph" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paragraph'){ ?> selected="selected" <?php } ?>>Paragraph</option>
			<option value="plus-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'plus-square'){ ?> selected="selected" <?php } ?>>Plus Square</option>
			<option value="qrcode" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'qrcode'){ ?> selected="selected" <?php } ?>>QR Code</option>
			<option value="question-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'question-circle'){ ?> selected="selected" <?php } ?>>Question Circle</option>
			<option value="question" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'question'){ ?> selected="selected" <?php } ?>>Question</option>
			<option value="qq" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'qq'){ ?> selected="selected" <?php } ?>>QQ</option>
			<option value="quote-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'quote-left'){ ?> selected="selected" <?php } ?>>Quote Left</option>
			<option value="quote-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'quote-right'){ ?> selected="selected" <?php } ?>>Quote Right</option>
			<option value="random" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'random'){ ?> selected="selected" <?php } ?>>Random</option>
			<option value="retweet" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'retweet'){ ?> selected="selected" <?php } ?>>Retweet</option>
			<option value="rss" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rss'){ ?> selected="selected" <?php } ?>>RSS</option>
			<option value="reorder" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'reorder'){ ?> selected="selected" <?php } ?>>Reorder</option>
			<option value="rotate-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rotate-left'){ ?> selected="selected" <?php } ?>>Rotate Left</option>
			<option value="rotate-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rotate-right'){ ?> selected="selected" <?php } ?>>Rotate Right</option>
			<option value="road" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'road'){ ?> selected="selected" <?php } ?>>Road</option>
			<option value="repeat" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'repeat'){ ?> selected="selected" <?php } ?>>Repeat</option>
			<option value="refresh" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'refresh'){ ?> selected="selected" <?php } ?>>Refresh</option>
			<option value="reply" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'reply'){ ?> selected="selected" <?php } ?>>Reply</option>
			<option value="rocket" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rocket'){ ?> selected="selected" <?php } ?>>Rocket</option>
			<option value="rupee" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rupee'){ ?> selected="selected" <?php } ?>>Rupee</option>
			<option value="rmb" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rmb'){ ?> selected="selected" <?php } ?>>RMB</option>
			<option value="ruble" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ruble'){ ?> selected="selected" <?php } ?>>Ruble</option>
			<option value="rouble" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rouble'){ ?> selected="selected" <?php } ?>>Rouble</option>
			<option value="rub" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rub'){ ?> selected="selected" <?php } ?>>Rub</option>
			<option value="renren" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'renren'){ ?> selected="selected" <?php } ?>>Renren</option>
			<option value="reddit" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'reddit'){ ?> selected="selected" <?php } ?>>Reddit</option>
			<option value="recycle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'recycle'){ ?> selected="selected" <?php } ?>>Recycle</option>
			<option value="rebel" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rebel'){ ?> selected="selected" <?php } ?>>Rebel</option>
			<option value="step-backward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'step-backward'){ ?> selected="selected" <?php } ?>>Step Backward</option>
			<option value="stop" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stop'){ ?> selected="selected" <?php } ?>>Stop</option>
			<option value="step-forward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'step-forward'){ ?> selected="selected" <?php } ?>>Step Forward</option>
			<option value="shopping-cart" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'shopping-cart'){ ?> selected="selected" <?php } ?>>Shopping Cart</option>
			<option value="star-half" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'star-half'){ ?> selected="selected" <?php } ?>>Star Half</option>
			<option value="sign-out" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sign-out'){ ?> selected="selected" <?php } ?>>Sign Out</option>
			<option value="sign-in" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sign-in'){ ?> selected="selected" <?php } ?>>Sign In</option>
			<option value="scissors" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'scissors'){ ?> selected="selected" <?php } ?>>Scissors</option>
			<option value="save" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'save'){ ?> selected="selected" <?php } ?>>Save</option>
			<option value="square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'square'){ ?> selected="selected" <?php } ?>>Square</option>
			<option value="strikethrough" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'strikethrough'){ ?> selected="selected" <?php } ?>>Strike Through</option>
			<option value="sort" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sort'){ ?> selected="selected" <?php } ?>>Sort</option>
			<option value="sort-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sort-down'){ ?> selected="selected" <?php } ?>>Sort Down</option>
			<option value="sitemap" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sitemap'){ ?> selected="selected" <?php } ?>>Site map</option>
			<option value="search" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'search'){ ?> selected="selected" <?php } ?>>Search</option>
			<option value="star" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'star'){ ?> selected="selected" <?php } ?>>Star</option>
			<option value="stethoscope" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stethoscope'){ ?> selected="selected" <?php } ?>>Stethoscope</option>
			<option value="suitcase" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'suitcase'){ ?> selected="selected" <?php } ?>>Suitcase</option>
			<option value="search-plus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'search-plus'){ ?> selected="selected" <?php } ?>>Search Plus</option>
			<option value="search-minus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'search-minus'){ ?> selected="selected" <?php } ?>>Search Minus</option>
			<option value="signal" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'signal'){ ?> selected="selected" <?php } ?>>Signal</option>
			<option value="spinner" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'spinner'){ ?> selected="selected" <?php } ?>>Spinner</option>
			<option value="superscript" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'superscript'){ ?> selected="selected" <?php } ?>>Superscript</option>
			<option value="subscript" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'subscript'){ ?> selected="selected" <?php } ?>>Subscript</option>
			<option value="shield" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'shield'){ ?> selected="selected" <?php } ?>>Shield</option>
			<option value="stack-overflow" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stack-overflow'){ ?> selected="selected" <?php } ?>>Stack Overflow</option>
			<option value="skype" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'skype'){ ?> selected="selected" <?php } ?>>Skype</option>
			<option value="stack-exchange" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stack-exchange'){ ?> selected="selected" <?php } ?>>Stack Exchange</option>
			<option value="space-shuttle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'space-shuttle'){ ?> selected="selected" <?php } ?>>Space Shuttle</option>
			<option value="slack" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'slack'){ ?> selected="selected" <?php } ?>>Slack</option>
			<option value="stumbleupon-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stumbleupon-circle'){ ?> selected="selected" <?php } ?>>Stumbleupon Circle</option>
			<option value="stumbleupon" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stumbleupon'){ ?> selected="selected" <?php } ?>>Stumbleupon</option>
			<option value="spoon" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'spoon'){ ?> selected="selected" <?php } ?>>Spoon</option>
			<option value="steam" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'steam'){ ?> selected="selected" <?php } ?>>Steam</option>
			<option value="spotify" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'spotify'){ ?> selected="selected" <?php } ?>>Spotify</option>
			<option value="soundcloud" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'soundcloud'){ ?> selected="selected" <?php } ?>>Soundcloud</option>
			<option value="support" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'support'){ ?> selected="selected" <?php } ?>>Support</option>
			<option value="send" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'send'){ ?> selected="selected" <?php } ?>>Send</option>
			<option value="sliders" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sliders'){ ?> selected="selected" <?php } ?>>Sliders</option>
			<option value="share-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'share-alt'){ ?> selected="selected" <?php } ?>>Share Alt</option>
			<option value="tag" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tag'){ ?> selected="selected" <?php } ?>>Tag</option>
			<option value="tags" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tags'){ ?> selected="selected" <?php } ?>>Tags</option>
			<option value="text-height" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'text-height'){ ?> selected="selected" <?php } ?>>Text Height</option>
			<option value="text-width" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'text-width'){ ?> selected="selected" <?php } ?>>Text Width</option>
			<option value="times-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'times-circle'){ ?> selected="selected" <?php } ?>>Times Circle</option>
			<option value="thumb-tack" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'thumb-tack'){ ?> selected="selected" <?php } ?>>Thumb Tack</option>
			<option value="trophy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'trophy'){ ?> selected="selected" <?php } ?>>Trophy</option>
			<option value="twitter" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'twitter'){ ?> selected="selected" <?php } ?>>Twitter</option>
			<option value="tasks" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tasks'){ ?> selected="selected" <?php } ?>>Tasks</option>
			<option value="truck" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'truck'){ ?> selected="selected" <?php } ?>>Truck</option>
			<option value="tachometer" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tachometer'){ ?> selected="selected" <?php } ?>>Tachometer</option>
			<option value="th-large" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'th-large'){ ?> selected="selected" <?php } ?>>Thumbnail Large</option>
			<option value="th" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'th'){ ?> selected="selected" <?php } ?>>Thumbnail</option>
			<option value="th-list" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'th-list'){ ?> selected="selected" <?php } ?>>Thumbnail</option>
			<option value="th" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'th'){ ?> selected="selected" <?php } ?>>Thumbnail List</option>
			<option value="times" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'times'){ ?> selected="selected" <?php } ?>>Times</option>
			<option value="ticket" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ticket'){ ?> selected="selected" <?php } ?>>Ticket</option>
			<option value="toggle-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'toggle-down'){ ?> selected="selected" <?php } ?>>Toggle Down</option>
			<option value="toggle-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'toggle-up'){ ?> selected="selected" <?php } ?>>Toggle Up</option>
			<option value="toggle-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'toggle-right'){ ?> selected="selected" <?php } ?>>Toggle Right</option>
			<option value="tumblr" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tumblr'){ ?> selected="selected" <?php } ?>>Tumblr</option>
			<option value="trello" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'trello'){ ?> selected="selected" <?php } ?>>Trello</option>
			<option value="toggle-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'toggle-left'){ ?> selected="selected" <?php } ?>>Toggle Left</option>
			<option value="turkish-lira" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'turkish-lira'){ ?> selected="selected" <?php } ?>>Turkish Lira</option>
			<option value="try" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'try'){ ?> selected="selected" <?php } ?>>Try</option>
			<option value="taxi" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'taxi'){ ?> selected="selected" <?php } ?>>Taxi</option>
			<option value="tree" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tree'){ ?> selected="selected" <?php } ?>>Tree</option>
			<option value="tencent-weibo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tencent-weibo'){ ?> selected="selected" <?php } ?>>Tencent Weibo</option>
			<option value="tablet" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tablet'){ ?> selected="selected" <?php } ?>>Tablet</option>
			<option value="terminal" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'terminal'){ ?> selected="selected" <?php } ?>>Terminal</option>
			<option value="upload" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'upload'){ ?> selected="selected" <?php } ?>>Upload</option>
			<option value="unlock" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'unlock'){ ?> selected="selected" <?php } ?>>Unlock</option>
			<option value="users" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'users'){ ?> selected="selected" <?php } ?>>Users</option>
			<option value="underline" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'underline'){ ?> selected="selected" <?php } ?>>Underline</option>
			<option value="unsorted" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'unsorted'){ ?> selected="selected" <?php } ?>>Unsorted</option>
			<option value="undo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'undo'){ ?> selected="selected" <?php } ?>>Undo</option>
			<option value="user-md" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'user-md'){ ?> selected="selected" <?php } ?>>User MD</option>
			<option value="umbrella" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'umbrella'){ ?> selected="selected" <?php } ?>>Umbrella</option>
			<option value="user" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'user'){ ?> selected="selected" <?php } ?>>User</option>
			<option value="unlock-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'unlock-alt'){ ?> selected="selected" <?php } ?>>Unlock Alt</option>
			<option value="usd" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'usd'){ ?> selected="selected" <?php } ?>>USD</option>
			<option value="university" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'university'){ ?> selected="selected" <?php } ?>>University</option>
			<option value="unlink" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'unlink'){ ?> selected="selected" <?php } ?>>Unlink</option>
			<option value="volume-off" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'volume-off'){ ?> selected="selected" <?php } ?>>Volume Off</option>
			<option value="volume-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'volume-down'){ ?> selected="selected" <?php } ?>>Volume Down</option>
			<option value="volume-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'volume-up'){ ?> selected="selected" <?php } ?>>Volume Up</option>
			<option value="video-camera" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'video-camera'){ ?> selected="selected" <?php } ?>>Video Camera</option>
			<option value="vk" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'vk'){ ?> selected="selected" <?php } ?>>VK</option>
			<option value="vine" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'vine'){ ?> selected="selected" <?php } ?>>Vine</option>
			<option value="warning" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'warning'){ ?> selected="selected" <?php } ?>>Warning</option>
			<option value="wrench" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'wrench'){ ?> selected="selected" <?php } ?>>Wrench</option>
			<option value="won" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'won'){ ?> selected="selected" <?php } ?>>Won</option>
			<option value="windows" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'windows'){ ?> selected="selected" <?php } ?>>Windows</option>
			<option value="weibo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'weibo'){ ?> selected="selected" <?php } ?>>Weibo</option>
			<option value="wheelchair" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'wheelchair'){ ?> selected="selected" <?php } ?>>Wheel Chair</option>
			<option value="wordpress" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'wordpress'){ ?> selected="selected" <?php } ?>>WordPress</option>
			<option value="wechat" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'wechat'){ ?> selected="selected" <?php } ?>>We Chat</option>
			<option value="weixin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'weixin'){ ?> selected="selected" <?php } ?>>Weixin</option>
			<option value="xing" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'xing'){ ?> selected="selected" <?php } ?>>Xing</option>
			<option value="yen" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'yen'){ ?> selected="selected" <?php } ?>>Yen</option>
			<option value="youtube" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'youtube'){ ?> selected="selected" <?php } ?>>YouTube</option>
			<option value="yahoo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'yahoo'){ ?> selected="selected" <?php } ?>>Yahoo</option>
		</select> 
		<input type="hidden" name="meta_box_icon" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

/***************************************************/
/*Nexus Custom Field SVG Icon List - Started*/
/***************************************************/
function create_post_svg_icon_list( $object, $box ) { ?>
	<p>
		<label for="post-svg-icon">Animated Icon</label>
		<br />
		<select name="post-svg-icon" id="post-icon" cols="60" rows="4" tabindex="30" style="width: 97%;">
			<option value="desktop" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'at'){ ?> selected="selected" <?php } ?>>At</option>
			<option value="balloons" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'balloons'){ ?> selected="selected" <?php } ?>>Balloons</option>
			<option value="bank" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'bank'){ ?> selected="selected" <?php } ?>>Bank</option>
			<option value="bomb" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'bomb'){ ?> selected="selected" <?php } ?>>Bomb</option>
			<option value="calculator" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'calculator'){ ?> selected="selected" <?php } ?>>Calculator</option>
			<option value="folders" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'folders'){ ?> selected="selected" <?php } ?>>Folders</option>
			<option value="ice-cream" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'ice-cream'){ ?> selected="selected" <?php } ?>>Ice Cream</option>
			<option value="medkit" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'medkit'){ ?> selected="selected" <?php } ?>>Medkit</option>
			<option value="paper-plane" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'paper-plane'){ ?> selected="selected" <?php } ?>>Paper Plane</option>
			<option value="connect" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'connect'){ ?> selected="selected" <?php } ?>>Connect</option>
			<option value="disconnect" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'disconnect'){ ?> selected="selected" <?php } ?>>Disconnect</option>
			<option value="collapse-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'collapse-down'){ ?> selected="selected" <?php } ?>>Collapse Down</option>
			<option value="collapse-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'collapse-up'){ ?> selected="selected" <?php } ?>>Collapse Up</option>
			<option value="expand-left" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'expand-left'){ ?> selected="selected" <?php } ?>>Expand Left</option>
			<option value="expand-right" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'expand-right'){ ?> selected="selected" <?php } ?>>Expand Right</option>			
			<option value="battery" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'battery'){ ?> selected="selected" <?php } ?>>Battery</option>
			<option value="medal" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'medal'){ ?> selected="selected" <?php } ?>>Medal</option>
			<option value="servers" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'servers'){ ?> selected="selected" <?php } ?>>Servers</option>
			<option value="apple-logo" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'apple-logo'){ ?> selected="selected" <?php } ?>>Apple Logo</option>
			<option value="bing" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'bing'){ ?> selected="selected" <?php } ?>>Bing</option>
			<option value="bitbucket" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'bitbucket'){ ?> selected="selected" <?php } ?>>Bitbucket</option>
			<option value="blogger" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'blogger'){ ?> selected="selected" <?php } ?>>Blogger</option>
			<option value="concrete5" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'concrete5'){ ?> selected="selected" <?php } ?>>Concrete 5</option>
			<option value="deviantart" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'deviantart'){ ?> selected="selected" <?php } ?>>Deviantart</option>
			<option value="dribbble" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'dribbble'){ ?> selected="selected" <?php } ?>>Dribbble</option>
			<option value="github" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'github'){ ?> selected="selected" <?php } ?>>Github</option>
			<option value="github-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'github-alt'){ ?> selected="selected" <?php } ?>>Github Alt</option>						
			<option value="instagram" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'instagram'){ ?> selected="selected" <?php } ?>>Instagram</option>			
			<option value="opera" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'opera'){ ?> selected="selected" <?php } ?>>Opera</option>			
			<option value="reddit" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'reddit'){ ?> selected="selected" <?php } ?>>Reddit</option>			
			<option value="soundcloud" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'soundcloud'){ ?> selected="selected" <?php } ?>>Soundcloud</option>			
			<option value="tumblr" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'tumblr'){ ?> selected="selected" <?php } ?>>Tumblr</option>			
			<option value="vimeo" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'vimeo'){ ?> selected="selected" <?php } ?>>Vimeo</option>			
			<option value="vk" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'vk'){ ?> selected="selected" <?php } ?>>VK</option>			
			<option value="xing" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'xing'){ ?> selected="selected" <?php } ?>>Xing</option>			
			<option value="yahoo" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'yahoo'){ ?> selected="selected" <?php } ?>>Yahoo</option>			
			<option value="address-book" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'address-book'){ ?> selected="selected" <?php } ?>>Address Book</option>			
			<option value="albums" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'albums'){ ?> selected="selected" <?php } ?>>Albums</option>			
			<option value="anchor" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'anchor'){ ?> selected="selected" <?php } ?>>Anchor</option>			
			<option value="archive-add" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'archive-add'){ ?> selected="selected" <?php } ?>>Archive Add</option>			
			<option value="archive-extract" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'archive-extract'){ ?> selected="selected" <?php } ?>>Archive Extract</option>			
			<option value="asterisk" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'asterisk'){ ?> selected="selected" <?php } ?>>Asterisk</option>			
			<option value="bluetooth" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'bluetooth'){ ?> selected="selected" <?php } ?>>Bluetooth</option>			
			<option value="brightness-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'brightness-down'){ ?> selected="selected" <?php } ?>>Brightness Down</option>						
			<option value="brightness-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'brightness-up'){ ?> selected="selected" <?php } ?>>Brightness Up</option>
			<option value="crop" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'crop'){ ?> selected="selected" <?php } ?>>Crop</option>
			<option value="eyedropper" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'eyedropper'){ ?> selected="selected" <?php } ?>>Eye Dropper</option>
			<option value="file-export" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'file-export'){ ?> selected="selected" <?php } ?>>File Export</option>
			<option value="file-import" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'file-import'){ ?> selected="selected" <?php } ?>>File Import</option>
			<option value="folder-add" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'folder-add'){ ?> selected="selected" <?php } ?>>Folder Add</option>
			<option value="folder-flag" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'folder-flag'){ ?> selected="selected" <?php } ?>>Folder Flag</option>
			<option value="folder-lock" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'folder-lock'){ ?> selected="selected" <?php } ?>>Folder Lock</option>
			<option value="folder-new" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'folder-new'){ ?> selected="selected" <?php } ?>>Folder New</option>
			<option value="folder-open" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'folder-open'){ ?> selected="selected" <?php } ?>>Folder Open</option>
			<option value="folder-remove" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'folder-remove'){ ?> selected="selected" <?php } ?>>Folder Remove</option>
			<option value="inbox-empty" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'inbox-empty'){ ?> selected="selected" <?php } ?>>Inbox Empty</option>
			<option value="inbox-in" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'inbox-in'){ ?> selected="selected" <?php } ?>>Inbox In</option>
			<option value="inbox-out" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'inbox-out'){ ?> selected="selected" <?php } ?>>Inbox Out</option>
			<option value="indent-left" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'indent-left'){ ?> selected="selected" <?php } ?>>Indent Left</option>
			<option value="indent-right" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'indent-right'){ ?> selected="selected" <?php } ?>>Indent Right</option>
			<option value="message-add" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'message-add'){ ?> selected="selected" <?php } ?>>Message add</option>			
			<option value="message-flag" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'message-flag'){ ?> selected="selected" <?php } ?>>Message flag</option>
			<option value="message-in" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'message-in'){ ?> selected="selected" <?php } ?>>Message in</option>
			<option value="message-lock" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'message-lock'){ ?> selected="selected" <?php } ?>>Message lock</option>
			<option value="message-new" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'message-new'){ ?> selected="selected" <?php } ?>>Message new</option>
			<option value="message-out" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'message-out'){ ?> selected="selected" <?php } ?>>Message out</option>
			<option value="message-remove" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'message-remove'){ ?> selected="selected" <?php } ?>>Message remove</option>
			<option value="microphone" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'microphone'){ ?> selected="selected" <?php } ?>>Microphone</option>
			<option value="moon" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'moon'){ ?> selected="selected" <?php } ?>>Moon</option>
			<option value="new-window" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'new-window'){ ?> selected="selected" <?php } ?>>New Window</option>
			<option value="pin-off" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'pin-off'){ ?> selected="selected" <?php } ?>>Pin off</option>
			<option value="pin-on" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'pin-on'){ ?> selected="selected" <?php } ?>>Pin on</option>
			<option value="playlist" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'playlist'){ ?> selected="selected" <?php } ?>>Play list</option>
			<option value="save" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'save'){ ?> selected="selected" <?php } ?>>Save</option>
			<option value="shopping-cart-in" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'shopping-cart-in'){ ?> selected="selected" <?php } ?>>Shopping cart in</option>
			<option value="shopping-cart-out" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'shopping-cart-out'){ ?> selected="selected" <?php } ?>>Shopping cart out</option>
			<option value="striked" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'striked'){ ?> selected="selected" <?php } ?>>Striked</option>
			<option value="text-decrease" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'text-decrease'){ ?> selected="selected" <?php } ?>>Text Decrease</option>
			<option value="text-height" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'text-height'){ ?> selected="selected" <?php } ?>>Text Height</option>
			<option value="text-increase" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'text-increase'){ ?> selected="selected" <?php } ?>>Text Increase</option>
			<option value="text-size" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'text-size'){ ?> selected="selected" <?php } ?>>Text Size</option>
			<option value="text-width" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'text-width'){ ?> selected="selected" <?php } ?>>Text Width</option>
			<option value="thumbnails-big" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'thumbnails-big'){ ?> selected="selected" <?php } ?>>Thumbnails Big</option>
			<option value="thumbnails-small" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'thumbnails-small'){ ?> selected="selected" <?php } ?>>Thumbnails Small</option>
			<option value="timer" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'timer'){ ?> selected="selected" <?php } ?>>Timer</option>
			<option value="unlink" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'unlink'){ ?> selected="selected" <?php } ?>>Unlink</option>
			<option value="user-add" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'user-add'){ ?> selected="selected" <?php } ?>>User add</option>
			<option value="user-ban" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'user-ban'){ ?> selected="selected" <?php } ?>>User ban</option>
			<option value="user-flag" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'user-flag'){ ?> selected="selected" <?php } ?>>User flag</option>
			<option value="user-remove" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'user-remove'){ ?> selected="selected" <?php } ?>>User remove</option>
			<option value="users-add" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'users-add'){ ?> selected="selected" <?php } ?>>Users add</option>
			<option value="users-ban" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'users-ban'){ ?> selected="selected" <?php } ?>>Users ban</option>
			<option value="users-remove" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'users-remove'){ ?> selected="selected" <?php } ?>>Users remove</option>
			<option value="vector-circle" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'vector-circle'){ ?> selected="selected" <?php } ?>>Vector circle</option>
			<option value="vector-curve" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'vector-curve'){ ?> selected="selected" <?php } ?>>Vector Curve</option>
			<option value="vector-line" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'vector-line'){ ?> selected="selected" <?php } ?>>Vector line</option>
			<option value="vector-polygon" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'vector-polygon'){ ?> selected="selected" <?php } ?>>Vector polygon</option>
			<option value="vector-square" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'vector-square'){ ?> selected="selected" <?php } ?>>Vector square</option>
			<option value="webcam" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'webcam'){ ?> selected="selected" <?php } ?>>Web cam</option>
			<option value="wifi" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'wifi'){ ?> selected="selected" <?php } ?>>WiFi</option>
			<option value="wifi-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'wifi-alt'){ ?> selected="selected" <?php } ?>>WiFi alt</option>
			<option value="adjust" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'adjust'){ ?> selected="selected" <?php } ?>>Adjust</option>
			<option value="alarm" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'alarm'){ ?> selected="selected" <?php } ?>>Alarm</option>
			<option value="align-center" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'align-center'){ ?> selected="selected" <?php } ?>>Align center</option>
			<option value="align-justify" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'align-justify'){ ?> selected="selected" <?php } ?>>Align justify</option>
			<option value="align-left" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'align-left'){ ?> selected="selected" <?php } ?>>Align left</option>
			<option value="align-right" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'align-right'){ ?> selected="selected" <?php } ?>>Align right</option>
			<option value="android" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'android'){ ?> selected="selected" <?php } ?>>Android</option>
			<option value="angle-wide-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'angle-wide-down'){ ?> selected="selected" <?php } ?>>Angle wide down</option>
			<option value="angle-wide-left" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'angle-wide-left'){ ?> selected="selected" <?php } ?>>Angle wide left</option>
			<option value="angle-wide-right" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'angle-wide-right'){ ?> selected="selected" <?php } ?>>Angle wide right</option>
			<option value="angle-wide-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'angle-wide-up'){ ?> selected="selected" <?php } ?>>Angle wide up</option>
			<option value="angle-double-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'angle-double-down'){ ?> selected="selected" <?php } ?>>Angle double down</option>
			<option value="angle-double-left" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'angle-double-left'){ ?> selected="selected" <?php } ?>>Angle double left</option>
			<option value="angle-double-right" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'angle-double-right'){ ?> selected="selected" <?php } ?>>Angle double right</option>	
			<option value="angle-double-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'angle-double-up'){ ?> selected="selected" <?php } ?>>Angle double up</option>	
			<option value="angle-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'angle-down'){ ?> selected="selected" <?php } ?>>Angle down</option>	
			<option value="angle-left" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'angle-left'){ ?> selected="selected" <?php } ?>>Angle left</option>	
			<option value="angle-right" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'angle-right'){ ?> selected="selected" <?php } ?>>Angle right</option>	
			<option value="angle-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'angle-up'){ ?> selected="selected" <?php } ?>>Angle up</option>	
			<option value="apple" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'apple'){ ?> selected="selected" <?php } ?>>Apple</option>	
			<option value="arrow-circle-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'arrow-circle-down'){ ?> selected="selected" <?php } ?>>Arrow circle down</option>	
			<option value="arrow-circle-left" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'arrow-circle-left'){ ?> selected="selected" <?php } ?>>Arrow circle left</option>	
			<option value="arrow-circle-right" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'arrow-circle-right'){ ?> selected="selected" <?php } ?>>Arrow circle right</option>	
			<option value="arrow-circle-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'arrow-circle-up'){ ?> selected="selected" <?php } ?>>Arrow circle up</option>	
			<option value="arrow-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'arrow-down'){ ?> selected="selected" <?php } ?>>Arrow down</option>	
			<option value="arrow-left" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'arrow-left'){ ?> selected="selected" <?php } ?>>Arrow left</option>	
			<option value="arrow-right" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'arrow-right'){ ?> selected="selected" <?php } ?>>Arrow right</option>	
			<option value="arrow-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'arrow-up'){ ?> selected="selected" <?php } ?>>Arrow up</option>	
			<option value="balance" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'balance'){ ?> selected="selected" <?php } ?>>Balance</option>	
			<option value="ban" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'ban'){ ?> selected="selected" <?php } ?>>Ban</option>	
			<option value="barchart" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'barchart'){ ?> selected="selected" <?php } ?>>Barchart</option>	
			<option value="barcode" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'barcode'){ ?> selected="selected" <?php } ?>>Barcode</option>	
			<option value="beer" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'beer'){ ?> selected="selected" <?php } ?>>Beer</option>	
			<option value="bell" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'bell'){ ?> selected="selected" <?php } ?>>Bell</option>	
			<option value="biohazard" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'biohazard'){ ?> selected="selected" <?php } ?>>Biohazard</option>	
			<option value="bold" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'bold'){ ?> selected="selected" <?php } ?>>Bold</option>	
			<option value="bolt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'bolt'){ ?> selected="selected" <?php } ?>>Bolt</option>	
			<option value="bookmark" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'bookmark'){ ?> selected="selected" <?php } ?>>Bookmark</option>	
			<option value="bootstrap" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'bootstrap'){ ?> selected="selected" <?php } ?>>Bootstrap</option>	
			<option value="briefcase" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'briefcase'){ ?> selected="selected" <?php } ?>>Briefcase</option>				
			<option value="brush" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'brush'){ ?> selected="selected" <?php } ?>>Brush</option>
			<option value="bug" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'bug'){ ?> selected="selected" <?php } ?>>Bug</option>
			<option value="calendar" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'calendar'){ ?> selected="selected" <?php } ?>>Calendar</option>
			<option value="camcoder" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'camcoder'){ ?> selected="selected" <?php } ?>>Camcoder</option>
			<option value="camera" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'camera'){ ?> selected="selected" <?php } ?>>Camera</option>
			<option value="camera-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'camera-alt'){ ?> selected="selected" <?php } ?>>Camera Alt</option>
			<option value="car" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'car'){ ?> selected="selected" <?php } ?>>Car</option>
			<option value="caret-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'caret-down'){ ?> selected="selected" <?php } ?>>Caret down</option>
			<option value="caret-left" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'caret-left'){ ?> selected="selected" <?php } ?>>Caret left</option>
			<option value="caret-right" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'caret-right'){ ?> selected="selected" <?php } ?>>Caret right</option>
			<option value="caret-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'caret-up'){ ?> selected="selected" <?php } ?>>Caret up</option>
			<option value="cellphone" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'cellphone'){ ?> selected="selected" <?php } ?>>Cell phone</option>
			<option value="certificate" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'certificate'){ ?> selected="selected" <?php } ?>>Certificate</option>
			<option value="check" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'check'){ ?> selected="selected" <?php } ?>>Check</option>
			<option value="check-circle" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'check-circle'){ ?> selected="selected" <?php } ?>>Check circle</option>
			<option value="check-circle-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'check-circle-alt'){ ?> selected="selected" <?php } ?>>Check circle alt</option>
			<option value="checked-off" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'checked-off'){ ?> selected="selected" <?php } ?>>Checked off</option>
			<option value="checked-on" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'checked-on'){ ?> selected="selected" <?php } ?>>Checked on</option>
			<option value="chevron-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'chevron-down'){ ?> selected="selected" <?php } ?>>Chevron down</option>
			<option value="chevron-left" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'chevron-left'){ ?> selected="selected" <?php } ?>>Chevron left</option>
			<option value="chevron-right" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'chevron-right'){ ?> selected="selected" <?php } ?>>Chevron right</option>
			<option value="chevron-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'chevron-up'){ ?> selected="selected" <?php } ?>>Chevron up</option>
			<option value="chrome" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'chrome'){ ?> selected="selected" <?php } ?>>Chrome</option>
			<option value="circle" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'circle'){ ?> selected="selected" <?php } ?>>Circle</option>
			<option value="circle-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'circle-alt'){ ?> selected="selected" <?php } ?>>Circle alt</option>
			<option value="clapboard" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'clapboard'){ ?> selected="selected" <?php } ?>>Clap board</option>
			<option value="clip" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'clip'){ ?> selected="selected" <?php } ?>>Clip</option>
			<option value="clock" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'clock'){ ?> selected="selected" <?php } ?>>Clock</option>
			<option value="cloud" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'cloud'){ ?> selected="selected" <?php } ?>>cloud</option>
			<option value="cloud-bolts" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'cloud-bolts'){ ?> selected="selected" <?php } ?>>Cloud bolts</option>
			<option value="cloud-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'cloud-down'){ ?> selected="selected" <?php } ?>>Cloud down</option>
			<option value="cloud-rain" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'cloud-rain'){ ?> selected="selected" <?php } ?>>Cloud rain</option>
			<option value="cloud-snow" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'cloud-snow'){ ?> selected="selected" <?php } ?>>Cloud snow</option>
			<option value="cloud-sun" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'cloud-sun'){ ?> selected="selected" <?php } ?>>Cloud sun</option>
			<option value="cloud-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'cloud-up'){ ?> selected="selected" <?php } ?>>Cloud up</option>
			<option value="code" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'code'){ ?> selected="selected" <?php } ?>>Code</option>
			<option value="columns" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'columns'){ ?> selected="selected" <?php } ?>>Columns</option>
			<option value="comment" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'comment'){ ?> selected="selected" <?php } ?>>Comment</option>
			<option value="comments" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'comments'){ ?> selected="selected" <?php } ?>>Comments</option>
			<option value="compass" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'compass'){ ?> selected="selected" <?php } ?>>Compass</option>
			<option value="credit-card" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'credit-card'){ ?> selected="selected" <?php } ?>>Credit card</option>
			<option value="css3" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'css3'){ ?> selected="selected" <?php } ?>>CSS3</option>
			<option value="dashboard" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'dashboard'){ ?> selected="selected" <?php } ?>>Dashboard</option>
			<option value="desktop" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'desktop'){ ?> selected="selected" <?php } ?>>Desktop</option>
			<option value="doc-landscape" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'doc-landscape'){ ?> selected="selected" <?php } ?>>Doc landscape</option>
			<option value="doc-portrait" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'doc-portrait'){ ?> selected="selected" <?php } ?>>Doc portrait</option>
			<option value="download" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'download'){ ?> selected="selected" <?php } ?>>Download</option>
			<option value="download-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'download-alt'){ ?> selected="selected" <?php } ?>>Download alt</option>
			<option value="drop" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'drop'){ ?> selected="selected" <?php } ?>>Drop</option>
			<option value="dropbox" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'dropbox'){ ?> selected="selected" <?php } ?>>Dropbox</option>
			<option value="edit" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'edit'){ ?> selected="selected" <?php } ?>>Edit</option>
			<option value="exchange" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'exchange'){ ?> selected="selected" <?php } ?>>Exchange</option>
			<option value="external-link" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'external-link'){ ?> selected="selected" <?php } ?>>External link</option>
			<option value="eye-close" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'eye-close'){ ?> selected="selected" <?php } ?>>Eye close</option>
			<option value="eye-open" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'eye-open'){ ?> selected="selected" <?php } ?>>Eye open</option>
			<option value="facebook" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'facebook'){ ?> selected="selected" <?php } ?>>Facebook</option>
			<option value="facebook-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'facebook-alt'){ ?> selected="selected" <?php } ?>>Facebook alt</option>
			<option value="film" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'film'){ ?> selected="selected" <?php } ?>>Film</option>
			<option value="filter" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'filter'){ ?> selected="selected" <?php } ?>>Filter</option>
			<option value="fire" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'fire'){ ?> selected="selected" <?php } ?>>Fire</option>
			<option value="firefox" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'firefox'){ ?> selected="selected" <?php } ?>>Firefox</option>
			<option value="flag" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'flag'){ ?> selected="selected" <?php } ?>>Flag</option>
			<option value="flickr" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'flickr'){ ?> selected="selected" <?php } ?>>Flickr</option>
			<option value="flickr-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'flickr-alt'){ ?> selected="selected" <?php } ?>>Flickr alt</option>
			<option value="font" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'font'){ ?> selected="selected" <?php } ?>>Font</option>
			<option value="gear" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'gear'){ ?> selected="selected" <?php } ?>>Gear</option>
			<option value="gears" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'gears'){ ?> selected="selected" <?php } ?>>Gears</option>
			<option value="ghost" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'ghost'){ ?> selected="selected" <?php } ?>>Ghost</option>
			<option value="gift" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'gift'){ ?> selected="selected" <?php } ?>>Gift</option>
			<option value="glass" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'glass'){ ?> selected="selected" <?php } ?>>Glass</option>
			<option value="globe" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'globe'){ ?> selected="selected" <?php } ?>>Globe</option>
			<option value="google-plus" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'google-plus'){ ?> selected="selected" <?php } ?>>Google plus</option>
			<option value="google-plus-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'google-plus-alt'){ ?> selected="selected" <?php } ?>>Google plus alt</option>
			<option value="hammer" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'hammer'){ ?> selected="selected" <?php } ?>>Hammer</option>
			<option value="hand-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'hand-down'){ ?> selected="selected" <?php } ?>>Hand down</option>
			<option value="hand-left" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'hand-left'){ ?> selected="selected" <?php } ?>>Hand left</option>
			<option value="hand-right" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'hand-right'){ ?> selected="selected" <?php } ?>>Hand right</option>
			<option value="hand-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'hand-up'){ ?> selected="selected" <?php } ?>>Hand up</option>
			<option value="heart" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'heart'){ ?> selected="selected" <?php } ?>>Heart</option>
			<option value="heart-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'heart-alt'){ ?> selected="selected" <?php } ?>>Heart alt</option>
			<option value="help" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'help'){ ?> selected="selected" <?php } ?>>Help</option>
			<option value="home" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'home'){ ?> selected="selected" <?php } ?>>Home</option>
			<option value="html5" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'html5'){ ?> selected="selected" <?php } ?>>HTML5</option>
			<option value="ie" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'ie'){ ?> selected="selected" <?php } ?>>IE</option>
			<option value="image" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'image'){ ?> selected="selected" <?php } ?>>Image</option>
			<option value="inbox" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'inbox'){ ?> selected="selected" <?php } ?>>Inbox</option>
			<option value="info" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'info'){ ?> selected="selected" <?php } ?>>Info</option>
			<option value="ios" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'ios'){ ?> selected="selected" <?php } ?>>iOS</option>
			<option value="italic" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'italic'){ ?> selected="selected" <?php } ?>>Italic</option>
			<option value="jquery" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'jquery'){ ?> selected="selected" <?php } ?>>jQuery</option>
			<option value="key" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'key'){ ?> selected="selected" <?php } ?>>Key</option>
			<option value="lab" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'lab'){ ?> selected="selected" <?php } ?>>Lab</option>
			<option value="laptop" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'laptop'){ ?> selected="selected" <?php } ?>>Laptop</option>
			<option value="leaf" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'leaf'){ ?> selected="selected" <?php } ?>>Leaf</option>
			<option value="legal" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'legal'){ ?> selected="selected" <?php } ?>>Legal</option>
			<option value="linechart" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'linechart'){ ?> selected="selected" <?php } ?>>Line chart</option>
			<option value="link" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'link'){ ?> selected="selected" <?php } ?>>Link</option>
			<option value="linkedin" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'linkedin'){ ?> selected="selected" <?php } ?>>LinkedIn</option>
			<option value="linkedin-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'linkedin-alt'){ ?> selected="selected" <?php } ?>>LinkedIn alt</option>
			<option value="list" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'list'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="list-ol" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'list-ol'){ ?> selected="selected" <?php } ?>>List</option>			
			<option value="list-ul" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'list-ul'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="location" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'location'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="lock" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'lock'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="magic" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'magic'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="magic-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'magic-alt'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="magnet" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'magnet'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="mail" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'mail'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="mail-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'mail-alt'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="map" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'map'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="minus" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'minus'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="minus-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'minus-alt'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="money" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'money'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="more" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'more'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="morph-c-s" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-c-s'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="morph-c-o" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-c-o'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="morph-s-c" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-s-c'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="morph-s-o" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-s-o'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="morph-o-c" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-o-c'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="morph-o-s" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-o-s'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="morph-c-t-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-c-t-up'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="morph-s-t-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-s-t-up'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="morph-o-t-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-o-t-up'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="morph-t-up-c" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-t-up-c'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="morph-t-up-s" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-t-up-s'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="morph-t-up-o" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-t-up-o'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="morph-c-t-right" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-c-t-right'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="morph-s-t-right" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-s-t-right'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="morph-o-t-right" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-o-t-right'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="morph-t-right-c" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-t-right-c'){ ?> selected="selected" <?php } ?>>morph-t-right-c</option>
			<option value="morph-t-right-s" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-t-right-s'){ ?> selected="selected" <?php } ?>>morph-t-right-s</option>
			<option value="morph-t-right-o" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-t-right-o'){ ?> selected="selected" <?php } ?>>morph-t-right-o</option>
			<option value="morph-c-t-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-c-t-down'){ ?> selected="selected" <?php } ?>>morph-c-t-down</option>
			<option value="morph-s-t-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-s-t-down'){ ?> selected="selected" <?php } ?>>morph-s-t-down</option>
			<option value="morph-o-t-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-o-t-down'){ ?> selected="selected" <?php } ?>>morph-o-t-down</option>
			<option value="morph-t-down-c" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-t-down-c'){ ?> selected="selected" <?php } ?>>morph-t-down-c</option>
			<option value="morph-t-down-s" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-t-down-s'){ ?> selected="selected" <?php } ?>>morph-t-down-s</option>
			<option value="morph-t-down-o" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-t-down-o'){ ?> selected="selected" <?php } ?>>morph-t-down-o</option>
			<option value="morph-c-t-left" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-c-t-left'){ ?> selected="selected" <?php } ?>>morph-c-t-left</option>
			<option value="morph-s-t-left" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-s-t-left'){ ?> selected="selected" <?php } ?>>morph-s-t-left</option>
			<option value="morph-o-t-left" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-o-t-left'){ ?> selected="selected" <?php } ?>>morph-o-t-left</option>
			<option value="morph-t-left-c" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-t-left-c'){ ?> selected="selected" <?php } ?>>morph-t-left-c</option>
			<option value="morph-t-left-c" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-t-left-c'){ ?> selected="selected" <?php } ?>>morph-t-left-c</option>
			<option value="morph-t-left-s" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-t-left-s'){ ?> selected="selected" <?php } ?>>morph-t-left-s</option>
			<option value="morph-t-left-o" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'morph-t-left-o'){ ?> selected="selected" <?php } ?>>morph-t-left-o</option>
			<option value="move" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'move'){ ?> selected="selected" <?php } ?>>Move</option>
			<option value="music" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'music'){ ?> selected="selected" <?php } ?>>Music</option>
			<option value="myspace" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'myspace'){ ?> selected="selected" <?php } ?>>My space</option>
			<option value="notebook" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'notebook'){ ?> selected="selected" <?php } ?>>Notebook</option>
			<option value="pacman" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'pacman'){ ?> selected="selected" <?php } ?>>Pacman</option>					
			<option value="paypal" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'paypal'){ ?> selected="selected" <?php } ?>>Paypal</option>
			<option value="pen" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'pen'){ ?> selected="selected" <?php } ?>>Pen</option>
			<option value="pencil" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'pencil'){ ?> selected="selected" <?php } ?>>Pencil</option>
			<option value="phone" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'phone'){ ?> selected="selected" <?php } ?>>Phone</option>
			<option value="piechart" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'piechart'){ ?> selected="selected" <?php } ?>>Piechart</option>
			<option value="piggybank" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'piggybank'){ ?> selected="selected" <?php } ?>>Piggybank</option>
			<option value="pinterest" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'pinterest'){ ?> selected="selected" <?php } ?>>Pinterest</option>
			<option value="pinterest-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'pinterest-alt'){ ?> selected="selected" <?php } ?>>Pinterest alt</option>
			<option value="plane-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'plane-down'){ ?> selected="selected" <?php } ?>>Plane down</option>
			<option value="plane-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'plane-up'){ ?> selected="selected" <?php } ?>>Plane up</option>
			<option value="plus" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'plus'){ ?> selected="selected" <?php } ?>>Plus</option>
			<option value="plus-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'plus-alt'){ ?> selected="selected" <?php } ?>>Plus alt</option>
			<option value="presentation" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'presentation'){ ?> selected="selected" <?php } ?>>Presentation</option>
			<option value="printer" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'printer'){ ?> selected="selected" <?php } ?>>Printer</option>
			<option value="question" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'question'){ ?> selected="selected" <?php } ?>>Question</option>
			<option value="quote-left" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'quote-left'){ ?> selected="selected" <?php } ?>>Quote left</option>
			<option value="quote-right" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'quote-right'){ ?> selected="selected" <?php } ?>>Quote right</option>
			<option value="raphael" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'raphael'){ ?> selected="selected" <?php } ?>>Raphael</option>
			<option value="recycled" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'recycled'){ ?> selected="selected" <?php } ?>>Recycled</option>
			<option value="redo" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'redo'){ ?> selected="selected" <?php } ?>>Redo</option>
			<option value="refresh" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'refresh'){ ?> selected="selected" <?php } ?>>Refresh</option>
			<option value="remove" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'remove'){ ?> selected="selected" <?php } ?>>Remove</option>
			<option value="remove-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'remove-alt'){ ?> selected="selected" <?php } ?>>Remove alt</option>
			<option value="remove-circle" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'remove-circle'){ ?> selected="selected" <?php } ?>>Remove circle</option>
			<option value="resize-big" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'resize-big'){ ?> selected="selected" <?php } ?>>Resize big</option>
			<option value="resize-big-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'resize-big-alt'){ ?> selected="selected" <?php } ?>>Resize big alt</option>
			<option value="resize-horizontal" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'resize-horizontal'){ ?> selected="selected" <?php } ?>>Resize Horizontal</option>
			<option value="resize-horizontal-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'resize-horizontal-alt'){ ?> selected="selected" <?php } ?>>Resize horizontal alt</option>
			<option value="resize-small-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'resize-small-alt'){ ?> selected="selected" <?php } ?>>Resize small alt</option>
			<option value="resize-vertical" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'resize-vertical'){ ?> selected="selected" <?php } ?>>Resize vertical</option>
			<option value="resize-vertical-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'resize-vertical-alt'){ ?> selected="selected" <?php } ?>>Resize vertical alt</option>
			<option value="responsive" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'responsive'){ ?> selected="selected" <?php } ?>>Responsive</option>
			<option value="responsive-menu" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'responsive-menu'){ ?> selected="selected" <?php } ?>>Responsive menu</option>
			<option value="retweet" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'retweet'){ ?> selected="selected" <?php } ?>>Retweet</option>			
			<option value="rocket" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'rocket'){ ?> selected="selected" <?php } ?>>Rocket</option>
			<option value="rotate-right" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'rotate-right'){ ?> selected="selected" <?php } ?>>Rotate right</option>
			<option value="rotate-left" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'rotate-left'){ ?> selected="selected" <?php } ?>>Rotate left</option>
			<option value="RSS" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'RSS'){ ?> selected="selected" <?php } ?>>RSS</option>
			<option value="Safari" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'Safari'){ ?> selected="selected" <?php } ?>>Safari</option>
			<option value="sandglass" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'sandglass'){ ?> selected="selected" <?php } ?>>Sand Glass</option>
			<option value="scissors" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'scissors'){ ?> selected="selected" <?php } ?>>Scissors</option>
			<option value="screen-full" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'screen-full'){ ?> selected="selected" <?php } ?>>Screen Full</option>			
			<option value="screen-full-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'screen-full-alt'){ ?> selected="selected" <?php } ?>>Screen Full alt</option>
			<option value="screen-small" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'screen-small'){ ?> selected="selected" <?php } ?>>Screen Small</option>
			<option value="screen-small-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'screen-small-alt'){ ?> selected="selected" <?php } ?>>Screen Small Alt</option>
			<option value="screenshot" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'screenshot'){ ?> selected="selected" <?php } ?>>Screenshot</option>
			<option value="search" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'search'){ ?> selected="selected" <?php } ?>>Search</option>
			<option value="settings" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'settings'){ ?> selected="selected" <?php } ?>>Settings</option>
			<option value="share" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'share'){ ?> selected="selected" <?php } ?>>Share</option>
			<option value="shield" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'shield'){ ?> selected="selected" <?php } ?>>Shield</option>
			<option value="shopping-cart" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'shopping-cart'){ ?> selected="selected" <?php } ?>>Shopping Cart</option>
			<option value="shuffle" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'shuffle'){ ?> selected="selected" <?php } ?>>Shuffle</option>
			<option value="sign-in" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'sign-in'){ ?> selected="selected" <?php } ?>>Sign In</option>
			<option value="sign-out" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'sign-out'){ ?> selected="selected" <?php } ?>>Sign Out</option>
			<option value="signal" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'signal'){ ?> selected="selected" <?php } ?>>Signal</option>
			<option value="sitemap" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'sitemap'){ ?> selected="selected" <?php } ?>>Sitemap</option>
			<option value="sky-dish" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'sky-dish'){ ?> selected="selected" <?php } ?>>Sky Dish</option>
			<option value="skype" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'skype'){ ?> selected="selected" <?php } ?>>skype</option>
			<option value="sort" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'sort'){ ?> selected="selected" <?php } ?>>Sort</option>
			<option value="sort-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'sort-down'){ ?> selected="selected" <?php } ?>>Sort Sown</option>
			<option value="sort-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'sort-up'){ ?> selected="selected" <?php } ?>>Sort up</option>
			<option value="speaker" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'speaker'){ ?> selected="selected" <?php } ?>>Speaker</option>
			<option value="spinner-one" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'spinner-one'){ ?> selected="selected" <?php } ?>>Spinner one</option>
			<option value="spinner-two" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'spinner-two'){ ?> selected="selected" <?php } ?>>Spinner two</option>
			<option value="spinner-three" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'spinner-three'){ ?> selected="selected" <?php } ?>>Spinner three</option>
			<option value="spinner-four" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'spinner-four'){ ?> selected="selected" <?php } ?>>Spinner four</option>
			<option value="spinner-five" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'spinner-five'){ ?> selected="selected" <?php } ?>>Spinner five</option>
			<option value="spinner-six" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'spinner-six'){ ?> selected="selected" <?php } ?>>Spinner six</option>
			<option value="spinner-seven" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'spinner-seven'){ ?> selected="selected" <?php } ?>>Spinner seven</option>
			<option value="star-empty" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'star-empty'){ ?> selected="selected" <?php } ?>>Star empty</option>
			<option value="star-full" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'star-full'){ ?> selected="selected" <?php } ?>>Star full</option>
			<option value="star-half" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'star-half'){ ?> selected="selected" <?php } ?>>Star half</option>
			<option value="stopwatch" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'stopwatch'){ ?> selected="selected" <?php } ?>>Stopwatch</option>
			<option value="stumbleupon" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'stumbleupon'){ ?> selected="selected" <?php } ?>>Stumbleupon</option>
			<option value="stumbleupon-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'stumbleupon-alt'){ ?> selected="selected" <?php } ?>>Stumbleupon alt</option>
			<option value="sun" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'sun'){ ?> selected="selected" <?php } ?>>Sun</option>
			<option value="table" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'table'){ ?> selected="selected" <?php } ?>>Table</option>
			<option value="tablet" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'tablet'){ ?> selected="selected" <?php } ?>>Tablet</option>
			<option value="tag" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'tag'){ ?> selected="selected" <?php } ?>>Tag</option>
			<option value="tags" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'tags'){ ?> selected="selected" <?php } ?>>Tags</option>
			<option value="tasks" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'tasks'){ ?> selected="selected" <?php } ?>>Tasks</option>
			<option value="thermo-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'thermo-down'){ ?> selected="selected" <?php } ?>>Thermo down</option>
			<option value="thermo-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'thermo-up'){ ?> selected="selected" <?php } ?>>Thermo up</option>
			<option value="thumbs-down" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'thumbs-down'){ ?> selected="selected" <?php } ?>>Thumbs down</option>
			<option value="thumbs-up" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'thumbs-up'){ ?> selected="selected" <?php } ?>>Thumbs up</option>
			<option value="tree" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'tree'){ ?> selected="selected" <?php } ?>>Tree</option>
			<option value="trophy" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'trophy'){ ?> selected="selected" <?php } ?>>Trophy</option>
			<option value="truck" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'truck'){ ?> selected="selected" <?php } ?>>Truck</option>
			<option value="twitter" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'twitter'){ ?> selected="selected" <?php } ?>>Twitter</option>
			<option value="twitter-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'twitter-alt'){ ?> selected="selected" <?php } ?>>Twitter alt</option>
			<option value="umbrella" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'umbrella'){ ?> selected="selected" <?php } ?>>Umbrella</option>
			<option value="underline" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'underline'){ ?> selected="selected" <?php } ?>>Underline</option>
			<option value="undo" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'undo'){ ?> selected="selected" <?php } ?>>Undo</option>
			<option value="unlock" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'unlock'){ ?> selected="selected" <?php } ?>>Unlock</option>
			<option value="upload" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'upload'){ ?> selected="selected" <?php } ?>>Upload</option>
			<option value="upload-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'upload-alt'){ ?> selected="selected" <?php } ?>>Upload alt</option>
			<option value="user" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'user'){ ?> selected="selected" <?php } ?>>User</option>
			<option value="users" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'users'){ ?> selected="selected" <?php } ?>>Users</option>
			<option value="video-play" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'video-play'){ ?> selected="selected" <?php } ?>>Video play</option>
			<option value="video-play-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'video-play-alt'){ ?> selected="selected" <?php } ?>>Video play alt</option>
			<option value="video-stop" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'video-stop'){ ?> selected="selected" <?php } ?>>Video stop</option>
			<option value="video-pause" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'video-pause'){ ?> selected="selected" <?php } ?>>Video pause</option>
			<option value="video-eject" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'video-eject'){ ?> selected="selected" <?php } ?>>Video eject</option>
			<option value="video-backward" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'video-backward'){ ?> selected="selected" <?php } ?>>Video backward</option>
			<option value="video-step-backward" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'video-step-backward'){ ?> selected="selected" <?php } ?>>Video step backward</option>
			<option value="video-fast-backward" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'video-fast-backward'){ ?> selected="selected" <?php } ?>>Video fast backward</option>			
			<option value="video-forward" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'video-forward'){ ?> selected="selected" <?php } ?>>Video forward</option>
			<option value="video-step-forward" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'video-step-forward'){ ?> selected="selected" <?php } ?>>Video step forward</option>
			<option value="video-fast-forward" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'video-fast-forward'){ ?> selected="selected" <?php } ?>>Video fast forward</option>
			<option value="warning" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'warning'){ ?> selected="selected" <?php } ?>>Warning</option>
			<option value="warning-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'warning-alt'){ ?> selected="selected" <?php } ?>>Warning alt</option>
			<option value="windows" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'windows'){ ?> selected="selected" <?php } ?>>Windows</option>
			<option value="windows8" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'windows8'){ ?> selected="selected" <?php } ?>>Windows8</option>
			<option value="wordpress" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'wordpress'){ ?> selected="selected" <?php } ?>>WordPress</option>
			<option value="wordpress-alt" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'wordpress-alt'){ ?> selected="selected" <?php } ?>>WordPress alt</option>
			<option value="wrench" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'wrench'){ ?> selected="selected" <?php } ?>>Wrench</option>
			<option value="youtube" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'youtube'){ ?> selected="selected" <?php } ?>>YouTube</option>
			<option value="zoom-in" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'zoom-in'){ ?> selected="selected" <?php } ?>>Zoom in</option>
			<option value="zoom-out" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'zoom-out'){ ?> selected="selected" <?php } ?>>Zoom out</option>
			<option value="livicon" <?php if(get_post_meta( $object->ID, 'Animated Icon', true ) == 'livicon'){ ?> selected="selected" <?php } ?>>Livicon</option>
		</select> 
		<input type="hidden" name="meta_box_svg_icon" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }
/***************************************************/
/*Nexus Custom Field SVG Icon List - End*/
/***************************************************/
?>