<?php

add_shortcode('divider', '__return_false');
add_shortcode('one_half', '__return_false');
add_shortcode('one_half_last', '__return_false');
add_shortcode('image', '__return_false');
add_shortcode('iconed_title', '__return_false');
add_shortcode('one_third', '__return_false');
add_shortcode('one_third_last', '__return_false');
add_shortcode('one_fourth', '__return_false');
add_shortcode('one_fourth_last', '__return_false');
add_shortcode('text_box', '__return_false');
add_shortcode('map', '__return_false');
add_shortcode('youtube', '__return_false');
add_shortcode('vimeo', '__return_false');
add_shortcode('dropcap', '__return_false');
add_shortcode('quote', '__return_false');
add_shortcode('accordion', '__return_false');
add_shortcode('tabs', '__return_false');
add_shortcode('tab', '__return_false');
add_shortcode('video', '__return_false');
add_shortcode('list', '__return_false');
add_shortcode('table', '__return_false');
add_shortcode('button', '__return_false');
add_shortcode('icon_with_text', '__return_false');
add_shortcode('icon', '__return_false');
add_shortcode('alert_box', '__return_false');
add_shortcode('clients', '__return_false');
add_shortcode('diagram', '__return_false');
add_shortcode('skill', '__return_false');
add_shortcode('gallery', '__return_false');
add_shortcode('news', '__return_false');
add_shortcode('portfolio', '__return_false');
add_shortcode('quickfinder', '__return_false');
add_shortcode('team', '__return_false');
add_shortcode('pricing_table', '__return_false');
add_shortcode('pricing_column', '__return_false');
add_shortcode('pricing_price', '__return_false');
add_shortcode('pricing_row', '__return_false');
add_shortcode('pricing_footer', '__return_false');

add_filter( 'the_content', 'codeus_run_shortcode', 7 );
add_filter( 'widget_text', 'codeus_run_shortcode', 7 );
add_filter( 'the_excerpt', 'codeus_run_shortcode', 7 );


function codeus_run_shortcode( $content ) {
	global $shortcode_tags;

	$orig_shortcode_tags = $shortcode_tags;
	remove_all_shortcodes();

	add_shortcode('divider', 'codeus_divider_shortcode');
	add_shortcode('one_half', 'codeus_one_half_shortcode');
	add_shortcode('one_half_last', 'codeus_one_half_last_shortcode');
	add_shortcode('image', 'codeus_image_shortcode');
	add_shortcode('iconed_title', 'codeus_iconed_title_shortcode');
	add_shortcode('one_third', 'codeus_one_third_shortcode');
	add_shortcode('one_third_last', 'codeus_one_third_last_shortcode');
	add_shortcode('one_fourth', 'codeus_one_fourth_shortcode');
	add_shortcode('one_fourth_last', 'codeus_one_fourth_last_shortcode');
	add_shortcode('text_box', 'codeus_text_box_shortcode');
	add_shortcode('map', 'codeus_map_shortcode');
	add_shortcode('youtube', 'codeus_youtube_shortcode');
	add_shortcode('vimeo', 'codeus_vimeo_shortcode');
	add_shortcode('dropcap', 'codeus_dropcap_shortcode');
	add_shortcode('quote', 'codeus_quote_shortcode');
	add_shortcode('accordion', 'codeus_accordion_shortcode');
	add_shortcode('tabs', 'codeus_tabs_shortcode');
	add_shortcode('tab', 'codeus_tab_shortcode');
	add_shortcode('video', 'codeus_video_shortcode');
	add_shortcode('list', 'codeus_list_shortcode');
	add_shortcode('table', 'codeus_table_shortcode');
	add_shortcode('button', 'codeus_button_shortcode');
	add_shortcode('icon_with_text', 'codeus_icon_with_text_shortcode');
	add_shortcode('icon', 'codeus_icon_shortcode');
	add_shortcode('alert_box', 'codeus_alert_box_shortcode');
	add_shortcode('clients', 'codeus_clients_shortcode');
	add_shortcode('diagram', 'codeus_diagram_shortcode');
	add_shortcode('skill', 'codeus_skill_shortcode');
	add_shortcode('gallery', 'codeus_gallery_shortc');
	add_shortcode('news', 'codeus_news_shortcode');
	add_shortcode('portfolio', 'codeus_portfolio_shortcode');
	add_shortcode('quickfinder', 'codeus_quickfinder_shortcode');
	add_shortcode('team', 'codeus_team_shortcode');
	add_shortcode('pricing_table', 'codeus_pricing_table_shortcode');
	add_shortcode('pricing_column', 'codeus_pricing_column_shortcode');
	add_shortcode('pricing_price', 'codeus_pricing_price_shortcode');
	add_shortcode('pricing_row', 'codeus_pricing_row_shortcode');
	add_shortcode('pricing_footer', 'codeus_pricing_footer_shortcode');

	$content = do_shortcode( $content );

	$shortcode_tags = $orig_shortcode_tags;

	return $content;
}

function codeus_js_remove_wpautop($content, $autop = false) {
	require_once(ABSPATH . 'wp-admin/includes/plugin.php');
	if(is_plugin_active('js_composer/js_composer.php')) {
		return wpb_js_remove_wpautop($content, $autop);
	}
	return $content;
}


add_action( 'init', 'codeus_VC_init' );
function codeus_VC_init() {
	require_once(ABSPATH . 'wp-admin/includes/plugin.php');
	if(is_plugin_active('js_composer/js_composer.php')) {
		global $vc_manager;
		remove_filter('the_excerpt', array($vc_manager->vc(), 'excerptFilter'));

		add_action('admin_notices', 'codeus_vc_admin_notices');

		if(vc_mode() === 'page_editable') {
			add_filter('wp_enqueue_scripts', 'codeus_loadIFrameJsCss', 15);
		}

		add_shortcode_param('codeus_picture', 'codeus_pucture_param_settings_field');

		add_shortcode('accordion', 'codeus_accordion_shortcode');
		vc_map(array(
			'name' => __("Accordion", "codeus"),
			"base" => "accordion",
			"is_container" => true,
			'js_view' => 'VcCodeusAccordion',
			"icon" => "icon-wpb-ui-accordion",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Content arranged in accordion', 'codeus'),
			"params" => array(
				array(
					"type" => 'textfield',
					"heading" => __("Title", "codeus"),
					"param_name" => "title",
				),
				array(
					"type" => 'checkbox',
					"heading" => __("Closed", "codeus"),
					"param_name" => "closed",
					"value" => Array(__("Yes", "codeus") => '1')
				),
			),
		));

		add_shortcode('alert_box', 'codeus_alert_box_shortcode');
		vc_map(array(
			'name' => __("Alert Box", "codeus"),
			"base" => "alert_box",
			"is_container" => true,
			'js_view' => 'VcCodeusAlertBox',
			"icon" => "icon-wpb-call-to-action",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Catch visitors attention with alert box', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", "codeus"),
					"param_name" => "title",
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Text", "codeus"),
					"param_name" => "button_text",
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Link", "codeus"),
					"param_name" => "button_link",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Button Background Color", "codeus"),
					"param_name" => "button_background_color",
				),
				array(
					"type" => "textfield",
					"heading" => __("Icon Code", "codeus"),
					"param_name" => "icon",
					"description" => "<a href=\"".get_template_directory_uri()."/fonts/user-icons-list.php\" onclick=\"tb_show('".__('Icons info', 'codeus')."', this.href+'?TB_iframe=true'); return false;\">".__('Show Icon Codes', 'codeus')."</a>"
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Icon Border Color", "codeus"),
					"param_name" => "icon_border_color",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Icon Background Color", "codeus"),
					"param_name" => "icon_background_color",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Icon Font Color", "codeus"),
					"param_name" => "icon_color",
				),
			),
		));

		add_shortcode('button', 'codeus_button_shortcode');
		vc_map(array(
			'name' => __("Button", "codeus"),
			"base" => "button",
			"icon" => "icon-wpb-ui-button",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Styled button element', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Position", "codeus"),
					"param_name" => "link",
				),
				array(
					"type" => "textfield",
					"heading" => __("Text", "codeus"),
					"param_name" => "text",
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", "codeus"),
					"param_name" => "title",
					'description' => __('Value for title attribute', 'codeus'),
				),
				array(
					"type" => "textfield",
					"heading" => __("Target", "codeus"),
					"param_name" => "target",
					'description' => __('Value for target attribute', 'codeus'),
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Background Color", "codeus"),
					"param_name" => "bgcolor",
				),
			),
		));

		add_shortcode('clients', 'codeus_clients_shortcode');
		vc_map(array(
			'name' => __("Clients", "codeus"),
			"base" => "clients",
			"icon" => "codeus-icon-wpb-ui-clients",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Clients overview inside content', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Clientsset", "codeus"),
					"param_name" => "clientsset",
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", "codeus"),
					"param_name" => "title",
				),
				array(
					"type" => 'checkbox',
					"heading" => __("Filter Disabled", "codeus"),
					"param_name" => "filter_disabled",
					"value" => Array(__("Yes", "codeus") => '1')
				),
			),
		));

		add_shortcode('divider', 'codeus_divider_shortcode');
		vc_map(array(
			'name' => __("Divider", "codeus"),
			"base" => "divider",
			"icon" => "icon-wpb-ui-separator",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Horizontal separator in different styles', 'codeus'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __("Type", "codeus"),
					"param_name" => "type",
					"value" => array(
						'Solid' => '',
						'Line Break' => 'linebreak',
						'Dashed' => 'dashed',
						'Double' => 'double',
					),
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Color", "codeus"),
					"param_name" => "color",
				),
			),
		));

		add_shortcode('diagram', 'codeus_diagram_shortcode');
		vc_map(array(
			'name' => __("Diagram", "codeus"),
			"base" => "diagram",
			"icon" => "icon-wpb-graph",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Animated progress bar &amp; pie chart', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", "codeus"),
					"param_name" => "title",
				),
				array(
					"type" => "textarea",
					"heading" => __("Summary", "codeus"),
					"param_name" => "summary",
				),
				array(
					"type" => "dropdown",
					"heading" => __("Type", "codeus"),
					"param_name" => "type",
					"value" => array(
						__('Circle', 'codeus') => 'circle',
						__('Lines', 'codeus') => 'line'
					),
				),
				array(
					"type" => "textarea",
					"heading" => __("Content", "codeus"),
					"param_name" => "content",
					"value" => '[skill title="Skill1" amount="70" color="#ff0000"]'."\n".
						'[skill title="Skill2" amount="70" color="#ffff00"]'."\n".
						'[skill title="Skill3" amount="70" color="#ff00ff"]'."\n".
						'[skill title="Skill4" amount="70" color="#f0f0f0"]',
				),
			),
		));

		add_shortcode('dropcap', 'codeus_dropcap_shortcode');
		vc_map(array(
			'name' => __("Dropcap", "codeus"),
			"base" => "dropcap",
			"icon" => "codeus-icon-wpb-ui-dropcap",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Dropcap symbol for text content', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Sign", "codeus"),
					"param_name" => "content",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Border Color", "codeus"),
					"param_name" => "border_color",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Background Color", "codeus"),
					"param_name" => "background_color",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Font Color", "codeus"),
					"param_name" => "text_color",
				),
			),
		));

		add_shortcode('gallery', 'codeus_gallery_shortc');
		vc_map(array(
			'name' => __("Gallery", "codeus"),
			"base" => "gallery",
			"icon" => "icon-wpb-images-stack",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Image gallery in different styles', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Gallery Post ID", "codeus"),
					"param_name" => "gallery_id",
				),
				array(
					"type" => "dropdown",
					"heading" => __("Gallery Size", "codeus"),
					"param_name" => "gallery_size",
					"value" => array(
							__('For Full-Width Pages', 'codeus') => 0,
							__('For Sidebar Pages', 'codeus') => 1,
							__('Small Thumbs', 'codeus') => 2,
							__('Medium Thumbs', 'codeus') => 3
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Page Text Alignment", "codeus"),
					"param_name" => "text_alignment",
					"value" => array(
						__('Below', 'codeus') => 'below',
						__('Left', 'codeus') => 'left',
						__('Right', 'codeus') => 'right',
					),
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", "codeus"),
					"param_name" => "title",
				),
				array(
					"type" => "dropdown",
					"heading" => __("Style", "codeus"),
					"param_name" => "style",
					"value" => array(
						__('without border', 'codeus') => 'no-style',
						__('1px no margin', 'codeus') => 'style-1',
						__('dark gray', 'codeus') => 'style-2',
						__('light gray', 'codeus') => 'style-3',
						__('shadow', 'codeus') => 'style-4',
						__('shadowed border', 'codeus') => 'style-5',
						__('1px with margin', 'codeus') => 'style-6'
					),
				),
			),
		));

		add_shortcode('map', 'codeus_map_shortcode');
		vc_map(array(
			'name' => __("Google Maps", "codeus"),
			"base" => "map",
			"icon" => "icon-wpb-map-pin",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Map block in different styles', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Width", "codeus"),
					"param_name" => "width",
					'description' => __('Map width in pixels', 'codeus'),
				),
				array(
					"type" => "textfield",
					"heading" => __("Height", "codeus"),
					"param_name" => "height",
					'description' => __('Map height in pixels', 'codeus'),
				),
				array(
					"type" => "textfield",
					"heading" => __("Latitude", "codeus"),
					"param_name" => "lat",
					'description' => sprintf(__('Map latitude <a href="%s" target="_blank">Find here</a>', 'codeus'), 'http://universimmedia.pagesperso-orange.fr/geo/loc.htm'),
				),
				array(
					"type" => "textfield",
					"heading" => __("Longitude", "codeus"),
					"param_name" => "long",
					'description' => sprintf(__('Map longitude <a href="%s" target="_blank">Find here</a>', 'codeus'), 'http://universimmedia.pagesperso-orange.fr/geo/loc.htm'),
				),
				array(
					"type" => "textfield",
					"heading" => __("Zoom", "codeus"),
					"param_name" => "zoom",
					'description' => __('Enter zoom number (1-16)', 'codeus'),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Style", "codeus"),
					"param_name" => "style",
					"value" => array(
						__('without border', 'codeus') => 'no-style',
						__('1px no margin', 'codeus') => 'style-1',
						__('dark gray', 'codeus') => 'style-2',
						__('light gray', 'codeus') => 'style-3',
						__('shadow', 'codeus') => 'style-4',
						__('shadowed border', 'codeus') => 'style-5',
						__('1px with margin', 'codeus') => 'style-6'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Position", "codeus"),
					"param_name" => "position",
					"value" => array(
						__('Below', 'codeus') => 'below',
						__('Left', 'codeus') => 'left',
						__('Right', 'codeus') => 'right',
					),
				),
			),
		));

		add_shortcode('icon', 'codeus_icon_shortcode');
		vc_map(array(
			'name' => __("Icon", "codeus"),
			"base" => "icon",
			"icon" => "codeus-icon-wpb-ui-icon",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Customizable Font Icon', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Icon Code", "codeus"),
					"param_name" => "icon",
					"description" => "<a href=\"".get_template_directory_uri()."/fonts/user-icons-list.php\" onclick=\"tb_show('".__('Icons info', 'codeus')."', this.href+'?TB_iframe=true'); return false;\">".__('Show Icon Codes', 'codeus')."</a>"
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Icon Border Color", "codeus"),
					"param_name" => "icon_border_color",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Icon Background Color", "codeus"),
					"param_name" => "icon_background_color",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Icon Font Color", "codeus"),
					"param_name" => "icon_color",
				),
			),
		));

		add_shortcode('icon_with_text', 'codeus_icon_with_text_shortcode');
		vc_map(array(
			'name' => __("Icon with Text", "codeus"),
			"base" => "icon_with_text",
			"is_container" => true,
			'js_view' => 'VcCodeusIconWithText',
			"icon" => "codeus-icon-wpb-ui-icon_with_text",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Font Icon with aligned text content', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Icon Code", "codeus"),
					"param_name" => "icon",
					"description" => "<a href=\"".get_template_directory_uri()."/fonts/user-icons-list.php\" onclick=\"tb_show('".__('Icons info', 'codeus')."', this.href+'?TB_iframe=true'); return false;\">".__('Show Icon Codes', 'codeus')."</a>"
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", "codeus"),
					"param_name" => "title",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Icon Border Color", "codeus"),
					"param_name" => "icon_border_color",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Icon Background Color", "codeus"),
					"param_name" => "icon_background_color",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Icon Font Color", "codeus"),
					"param_name" => "icon_color",
				),
				array(
					"type" => "dropdown",
					"heading" => __("Title level", "codeus"),
					"param_name" => "level",
					"value" => array(
						__('Default ( h5 )', 'codeus') => '',
						'h1' => 'h1',
						'h2' => 'h2',
						'h3' => 'h3',
						'h4' => 'h4',
						'h6' => 'h6',
					),
				),
			),
		));

		add_shortcode('news', 'codeus_news_shortcode');
		vc_map(array(
			'name' => __("News", "codeus"),
			"base" => "news",
			"icon" => "codeus-icon-wpb-ui-news",
			"category" => __('Codeus', 'codeus'),
			"description" => __('News List', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Items per page", "codeus"),
					"param_name" => "items_per_page",
				),
				array(
					"type" => "dropdown",
					"heading" => __("Post type", "codeus"),
					"param_name" => "post_type",
					"value" => array(
						__('News', 'codeus') => 'codeus_news',
						__('Post', 'codeus') => 'post',
					),
				),
			),
		));

		add_shortcode('one_half', 'codeus_one_half_shortcode');
		vc_map(array(
			'name' => __("One Half", "codeus"),
			"base" => "one_half",
			"show_settings_on_create" => false,
			"is_container" => true,
			'js_view' => 'VcCodeusOneHalf',
			"icon" => "codeus-icon-wpb-ui-one_half",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Two columns container', 'codeus'),
		));

		add_shortcode('one_half_last', 'codeus_one_half_last_shortcode');
		vc_map(array(
			'name' => __("One Half Last", "codeus"),
			"base" => "one_half_last",
			"is_container" => true,
			'js_view' => 'VcCodeusOneHalfLast',
			"show_settings_on_create" => false,
			"content_element" => false,
			"category" => __('Codeus', 'codeus'),
		));

		add_shortcode('one_fourth', 'codeus_one_fourth_shortcode');
		vc_map(array(
			'name' => __("One Fourth", "codeus"),
			"base" => "one_fourth",
			"is_container" => true,
			'js_view' => 'VcCodeusOneHalfFourth',
			"show_settings_on_create" => false,
			"icon" => "codeus-icon-wpb-ui-one_fourth",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Four columns container', 'codeus'),
		));

		add_shortcode('one_fourth_last', 'codeus_one_fourth_last_shortcode');
		vc_map(array(
			'name' => __("One Fourth Last", "codeus"),
			"base" => "one_fourth_last",
			"is_container" => true,
			'js_view' => 'VcCodeusOneHalfFourthLast',
			"show_settings_on_create" => false,
			"content_element" => false,
			"category" => __('Codeus', 'codeus'),
		));

		add_shortcode('one_third', 'codeus_one_third_shortcode');
		vc_map(array(
			'name' => __("One Third", "codeus"),
			"base" => "one_third",
			"is_container" => true,
			'js_view' => 'VcCodeusOneHalfThird',
			"show_settings_on_create" => false,
			"icon" => "codeus-icon-wpb-ui-one_third",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Three columns container', 'codeus'),
		));

		add_shortcode('one_third_last', 'codeus_one_third_last_shortcode');
		vc_map(array(
			'name' => __("One Third Last", "codeus"),
			"base" => "one_third_last",
			"is_container" => true,
			'js_view' => 'VcCodeusOneHalfThirdLast',
			"show_settings_on_create" => false,
			"content_element" => false,
			"category" => __('Codeus', 'codeus'),
		));

		add_shortcode('portfolio', 'codeus_portfolio_shortcode');
		vc_map(array(
			'name' => __("Portfolio", "codeus"),
			"base" => "portfolio",
			"icon" => "codeus-icon-wpb-ui-portfolio",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Portfolio overview inside content', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Portfolio Set Slug", "codeus"),
					"param_name" => "portfolioset",
				),
				array(
					"type" => "dropdown",
					"heading" => __("Thumbnail size", "codeus"),
					"param_name" => "thumb_size",
					"value" => array(
						__('Small Thumbs (222 x 177)', 'codeus') => 'small',
						__('Medium Thumbs (302 x 207)', 'codeus') => 'medium',
						__('Big Thumbs (464 x 306)', 'codeus') => 'big',
						__('One column list', 'codeus') => 'list'
					),
				),
				array(
					"type" => "textfield",
					"heading" => __("Items per page", "codeus"),
					"param_name" => "items_per_page",
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", "codeus"),
					"param_name" => "title",
				),
			),
		));

		add_shortcode('pricing_table', 'codeus_pricing_table_shortcode');
		vc_map(array(
			'name' => __("Pricing Table", "codeus"),
			"base" => "pricing_table",
			"icon" => "codeus-icon-wpb-ui-pricing_table",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Styled pricing table', 'codeus'),
			"params" => array(
				array(
					"type" => "textarea",
					"heading" => __("Content", "codeus"),
					"param_name" => "content",
					"value" => "\n[pricing_column title=\"Column title\"]\n[pricing_price currency=\"$\" price=\"9.99\" time=\"Per Month\"][/pricing_price]\n[pricing_row]Feature 1[/pricing_row]\n[pricing_footer href=\"#\"]Order[/pricing_footer]\n[/pricing_column]"
				),
				array(
					"type" => "dropdown",
					"heading" => __("Style", "codeus"),
					"param_name" => "style",
					"value" => array(
						__('Style 1', 'codeus') => '1',
						__('Style 2', 'codeus') => '2',
						__('Style 3', 'codeus') => '3',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Column's count", "codeus"),
					"param_name" => "columns",
					"value" => array(
						__('Three columns', 'codeus') => '3',
						__('Four columns', 'codeus') => '4',
					),
				),
				array(
					"type" => "textfield",
					"heading" => __("Price font size", "codeus"),
					"param_name" => "price_font_size",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Price font color", "codeus"),
					"param_name" => "price_font_color",
				),
				array(
					"type" => "dropdown",
					"heading" => __("Button Icontype", "codeus"),
					"param_name" => "button_icon",
					"value" => array(
						__('None', 'codeus') => 'none',
						__('Arrow', 'codeus') => 'arrow',
						__('Cart', 'codeus') => 'cart',
					),
				),
			),
			'default_content' => '\n[pricing_column title=\"Column title\"]\n[pricing_price currency=\"$\" price=\"9.99\" time=\"Per Month\"][/pricing_price]\n[pricing_row]Feature 1[/pricing_row]\n[pricing_footer href=\"#\"]Order[/pricing_footer]\n[/pricing_column]',
		));

		add_shortcode('quickfinder', 'codeus_quickfinder_shortcode');
		vc_map(array(
			'name' => __("Quickfinder", "codeus"),
			"base" => "quickfinder",
			"icon" => "codeus-icon-wpb-ui-quickfinder",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Quickfinder overviews inside content', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Quickfinder Set Slug", "codeus"),
					"param_name" => "quickfinderset",
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", "codeus"),
					"param_name" => "title",
				),
			),
		));

		add_shortcode('quote', 'codeus_quote_shortcode');
		vc_map(array(
			'name' => __("Quoted Text", "codeus"),
			"base" => "quote",
			"icon" => "codeus-icon-wpb-ui-quote",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Quoted text content', 'codeus'),
			'params' => array(
				array(
					'type' => 'textarea',
					'holder' => 'div',
					'heading' => __( 'Text', 'js_composer' ),
					'param_name' => 'content',
				),
			)
		));

		add_shortcode('video', 'codeus_video_shortcode');
		vc_map(array(
			'name' => __("Self-hosted Video", "codeus"),
			"base" => "video",
			"icon" => "codeus-icon-wpb-ui-video",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Self-hosted video content', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Width", "codeus"),
					"param_name" => "width",
					'description' => __('Video width in pixels', 'codeus'),
				),
				array(
					"type" => "textfield",
					"heading" => __("Height", "codeus"),
					"param_name" => "height",
					'description' => __('Video height in pixels', 'codeus'),
				),
				array(
					"type" => 'textfield',
					"heading" => __("Video url", "codeus"),
					"param_name" => "video_src",
					'description' => __('Video URL in mp4 or flv format', 'codeus'),
				),
				array(
					"type" => 'textfield',
					"heading" => __("Image url", "codeus"),
					"param_name" => "image_src",
				),
				array(
					"type" => "dropdown",
					"heading" => __("Style", "codeus"),
					"param_name" => "style",
					"value" => array(
						__('without border', 'codeus') => 'no-style',
						__('1px no margin', 'codeus') => 'style-1',
						__('dark gray', 'codeus') => 'style-2',
						__('light gray', 'codeus') => 'style-3',
						__('shadow', 'codeus') => 'style-4',
						__('shadowed border', 'codeus') => 'style-5',
						__('1px with margin', 'codeus') => 'style-6'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Position", "codeus"),
					"param_name" => "position",
					"value" => array(
						__('Below', 'codeus') => 'below',
						__('Left', 'codeus') => 'left',
						__('Right', 'codeus') => 'right',
					),
				),
			),
		));

		add_shortcode('image', 'codeus_image_shortcode');
		vc_map(array(
			'name' => __("Styled Image", "codeus"),
			"base" => "image",
			"icon" => "icon-wpb-single-image",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Image in different styles', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Width", "codeus"),
					"param_name" => "width",
					"description" => __('Image width in pixels', 'codeus'),
				),
				array(
					"type" => "textfield",
					"heading" => __("Height", "codeus"),
					"param_name" => "height",
					"description" => __('Image height in pixels', 'codeus'),
				),
				array(
					"type" => 'codeus_picture',
					"heading" => __("Choose Image", "codeus"),
					"param_name" => "src",
					"description" => __('Enter image URL', 'codeus'),
				),
				array(
					"type" => "textfield",
					"heading" => __("Alt text", "codeus"),
					"param_name" => "alt",
					"description" => __('Enter image Alt-text', 'codeus'),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Style", "codeus"),
					"param_name" => "style",
					"value" => array(
						__('without border', 'codeus') => 'no-style',
						__('1px no margin', 'codeus') => 'style-1',
						__('dark gray', 'codeus') => 'style-2',
						__('light gray', 'codeus') => 'style-3',
						__('shadow', 'codeus') => 'style-4',
						__('shadowed border', 'codeus') => 'style-5',
						__('1px with margin', 'codeus') => 'style-6'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Page Text Alignment", "codeus"),
					"param_name" => "position",
					"value" => array(
						__('Below', 'codeus') => 'below',
						__('Left', 'codeus') => 'left',
						__('Right', 'codeus') => 'right',
					),
				),
				array(
					"type" => 'checkbox',
					"heading" => __("Show lightbox with full-size image", "codeus"),
					"param_name" => "lightbox",
					"value" => Array(__("Yes", "codeus") => '1')
				),
			),
		));

		add_shortcode('list', 'codeus_list_shortcode');
		vc_map(array(
			'name' => __("Styled List", "codeus"),
			"base" => "list",
			"icon" => "codeus-icon-wpb-ui-list",
			"category" => __('Codeus', 'codeus'),
			"description" => __('List in different styles', 'codeus'),
			"params" => array(
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'heading' => __( 'Content', 'codeus' ),
					'param_name' => 'content',
					'value' => '<ul class="styled">'."\n<li>".__('Element 1', 'codeus')."</li>\n<li>".__('Element 2', 'codeus')."</li>\n<li>".__('Element 3', 'codeus')."</li>\n".'</ul>'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Position", "codeus"),
					"param_name" => "type",
					"value" => array(
						__('circle', 'codeus') => 'circle',
						__('check', 'codeus') => 'check',
						__('arrow', 'codeus') => 'arrow',
						__('minus', 'codeus') => 'minus'
					),
				),
			),
		));

		add_shortcode('table', 'codeus_table_shortcode');
		vc_map(array(
			'name' => __("Styled Table", "codeus"),
			"base" => "table",
			"icon" => "codeus-icon-wpb-ui-table",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Styled table content', 'codeus'),
			"params" => array(
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'heading' => __( 'Content', 'js_composer' ),
					'param_name' => 'content',
					'value' => '<table style="width: 100%;">'."\n".
						'<thead><tr><th>'.__('Title 1', 'codeus').'</th><th>'.__('Title 2', 'codeus').'</th><th>'.__('Title 3', 'codeus').'</th></tr></thead>'."\n".
						'<tbody>'."\n".
						'<tr><th>'.__('Content 1 1', 'codeus').'</th><td>'.__('Content 1 2', 'codeus').'</td><td>'.__('Content 1 3', 'codeus').'</td></tr>'."\n".
						'<tr><th>'.__('Content 2 1', 'codeus').'</th><td>'.__('Content 2 2', 'codeus').'</td><td>'.__('Content 2 3', 'codeus').'</td></tr>'."\n".
						'<tr><th>'.__('Content 3 1', 'codeus').'</th><td>'.__('Content 3 2', 'codeus').'</td><td>'.__('Content 3 3', 'codeus').'</td></tr>'."\n".
						'</tbody></table>',
				),
			)
		));

		add_shortcode('text_box', 'codeus_text_box_shortcode');
		vc_map(array(
			'name' => __("Styled Textbox", "codeus"),
			"base" => "text_box",
			"is_container" => true,
			'js_view' => 'VcCodeusTextbox',
			"icon" => "icon-wpb-layer-shape-text",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Customizable block of text', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", "codeus"),
					"param_name" => "title",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Title Background Color", "codeus"),
					"param_name" => "title_background_color",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Title Text Color", "codeus"),
					"param_name" => "title_text_color",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Content Background Color", "codeus"),
					"param_name" => "content_background_color",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Content Text Color", "codeus"),
					"param_name" => "content_text_color",
				),
				array(
					"type" => 'colorpicker',
					"heading" => __("Border Color", "codeus"),
					"param_name" => "border_color",
				),
			),
		));

		add_shortcode('tabs', 'codeus_tabs_shortcode');
		vc_map(array(
			'name' => __("Tabs", "codeus"),
			"base" => "tabs",
			"is_container" => true,
			'js_view' => 'VcCodeusTabs',
			"show_settings_on_create" => false,
			'as_parent' => array('only' => 'tab'),
			"icon" => "icon-wpb-ui-tab-content",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Tabbed content', 'codeus'),
			"params" => array(
				array(
					"type" => 'textfield',
					"heading" => __("Tab 1 Title", "codeus"),
					"param_name" => "tab1",
				),
				array(
					"type" => 'textfield',
					"heading" => __("Tab 2 Title", "codeus"),
					"param_name" => "tab2",
				),
				array(
					"type" => 'textfield',
					"heading" => __("Tab 3 Title", "codeus"),
					"param_name" => "tab3",
				),
				array(
					"type" => 'textfield',
					"heading" => __("Tab 4 Title", "codeus"),
					"param_name" => "tab4",
				),
				array(
					"type" => 'textfield',
					"heading" => __("Tab 5 Title", "codeus"),
					"param_name" => "tab5",
				),
				array(
					"type" => 'textfield',
					"heading" => __("Tab 6 Title", "codeus"),
					"param_name" => "tab6",
				),
				array(
					"type" => 'textfield',
					"heading" => __("Tab 7 Title", "codeus"),
					"param_name" => "tab7",
				),
				array(
					"type" => 'textfield',
					"heading" => __("Tab 8 Title", "codeus"),
					"param_name" => "tab8",
				),
				array(
					"type" => 'textfield',
					"heading" => __("Tab 9 Title", "codeus"),
					"param_name" => "tab9",
				),
				array(
					"type" => 'textfield',
					"heading" => __("Tab 10 Title", "codeus"),
					"param_name" => "tab10",
				),
			),
		));

		add_shortcode('tab', 'codeus_tab_shortcode');
		vc_map(array(
			'name' => __("Tab", "codeus"),
			"base" => "tab",
			"is_container" => true,
			'js_view' => 'VcCodeusTab',
			"content_element" => true,
			"show_settings_on_create" => false,
			"category" => __('Codeus', 'codeus'),
			'as_child' => array('only' => 'tabs'),
			"params" => array(
				array(
					"type" => 'textfield',
					"heading" => __("ID", "codeus"),
					"param_name" => "id",
				)
			),
		));

		add_shortcode('team', 'codeus_team_shortcode');
		vc_map(array(
			'name' => __("Team", "codeus"),
			"base" => "team",
			"icon" => "codeus-icon-wpb-ui-team",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Team overview inside content', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Team's Set", "codeus"),
					"param_name" => "teamsets",
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", "codeus"),
					"param_name" => "title",
				),
			),
		));

		add_shortcode('iconed_title', 'codeus_iconed_title_shortcode');
		vc_map(array(
			'name' => __("Title With Icon", "codeus"),
			"base" => "iconed_title",
			"icon" => "codeus-icon-wpb-ui-iconed_title",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Title with customizable font icon', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Icon Code", "codeus"),
					"param_name" => "icon",
					"description" => "<a href=\"".get_template_directory_uri()."/fonts/user-icons-list.php\" onclick=\"tb_show('".__('Icons info', 'codeus')."', this.href+'?TB_iframe=true'); return false;\">".__('Show Icon Codes', 'codeus')."</a>"
				),
				array(
					"type" => 'checkbox',
					"heading" => __("Is active", "codeus"),
					"param_name" => "isactive",
					"value" => Array(__("Yes", "codeus") => '1')
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", "codeus"),
					"param_name" => "title",
				),
				array(
					"type" => "dropdown",
					"heading" => __("Title level", "codeus"),
					"param_name" => "level",
					"value" => array(
						__('Default ( h5 )', 'codeus') => '',
						'h1' => 'h1',
						'h2' => 'h2',
						'h3' => 'h3',
						'h4' => 'h4',
						'h6' => 'h6',
					),
				),
			),
		));

		add_shortcode('youtube', 'codeus_youtube_shortcode');
		vc_map(array(
			'name' => __("Youtube Video", "codeus"),
			"base" => "youtube",
			"icon" => "codeus-icon-wpb-ui-youtube",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Youtube video content', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Width", "codeus"),
					"param_name" => "width",
					'description' => __('Video width in pixels', 'codeus'),
				),
				array(
					"type" => "textfield",
					"heading" => __("Height", "codeus"),
					"param_name" => "height",
					'description' => __('Video height in pixels', 'codeus'),
				),
				array(
					"type" => 'textfield',
					"heading" => __("Video Id", "codeus"),
					"param_name" => "video_id",
					'description' => __('Youtube video ID something like Js9Z8UQAA4E', 'codeus'),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Style", "codeus"),
					"param_name" => "style",
					"value" => array(
						__('without border', 'codeus') => 'no-style',
						__('1px no margin', 'codeus') => 'style-1',
						__('dark gray', 'codeus') => 'style-2',
						__('light gray', 'codeus') => 'style-3',
						__('shadow', 'codeus') => 'style-4',
						__('shadowed border', 'codeus') => 'style-5',
						__('1px with margin', 'codeus') => 'style-6'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Position", "codeus"),
					"param_name" => "position",
					"value" => array(
						__('Below', 'codeus') => 'below',
						__('Left', 'codeus') => 'left',
						__('Right', 'codeus') => 'right',
					),
				),
			),
		));

		add_shortcode('vimeo', 'codeus_vimeo_shortcode');
		vc_map(array(
			'name' => __("Vimeo Video", "codeus"),
			"base" => "vimeo",
			"icon" => "codeus-icon-wpb-ui-vimeo",
			"category" => __('Codeus', 'codeus'),
			"description" => __('Vimeo video content', 'codeus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Width", "codeus"),
					"param_name" => "width",
					'description' => __('Video width in pixels', 'codeus'),
				),
				array(
					"type" => "textfield",
					"heading" => __("Height", "codeus"),
					"param_name" => "height",
					'description' => __('Video height in pixels', 'codeus'),
				),
				array(
					"type" => 'textfield',
					"heading" => __("Video Id", "codeus"),
					"param_name" => "video_id",
					'description' => __('Vimeo video ID something like 9380243', 'codeus'),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Style", "codeus"),
					"param_name" => "style",
					"value" => array(
						__('without border', 'codeus') => 'no-style',
						__('1px no margin', 'codeus') => 'style-1',
						__('dark gray', 'codeus') => 'style-2',
						__('light gray', 'codeus') => 'style-3',
						__('shadow', 'codeus') => 'style-4',
						__('shadowed border', 'codeus') => 'style-5',
						__('1px with margin', 'codeus') => 'style-6'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Position", "codeus"),
					"param_name" => "position",
					"value" => array(
						__('Below', 'codeus') => 'below',
						__('Left', 'codeus') => 'left',
						__('Right', 'codeus') => 'right',
					),
				),
			),
		));

		vc_remove_element('vc_separator');
		vc_remove_element('vc_message');
		vc_remove_element('vc_toggle');
		vc_remove_element('vc_single_image');
		vc_remove_element('vc_gallery');
		vc_remove_element('vc_images_carousel');
		vc_remove_element('vc_tabs');
		vc_remove_element('vc_tour');
		vc_remove_element('vc_accordion');
		vc_remove_element('vc_posts_grid');
		vc_remove_element('vc_carousel');
		vc_remove_element('vc_posts_slider');
		vc_remove_element('vc_widget_sidebar');
		vc_remove_element('vc_button');
		vc_remove_element('vc_button2');
		vc_remove_element('vc_cta_button');
		vc_remove_element('vc_cta_button2');
		vc_remove_element('vc_video');
		vc_remove_element('vc_gmaps');
		vc_remove_element('vc_flickr');
		vc_remove_element('vc_pie');
		vc_remove_element('vc_progress_bar');

vc_map( array(
	"name" => __( "Column", "js_composer" ),
	"base" => "vc_column_inner",
	"class" => "",
	"icon" => "",
	"wrapper_class" => "",
	"controls" => "full",
	"content_element" => false,
	"is_container" => true,
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => __( "Extra class name", "js_composer" ),
			"param_name" => "el_class",
			"value" => "",
			"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
		),
		array(
			"type" => "css_editor",
			"heading" => __( 'Css', "js_composer" ),
			"param_name" => "css",
			// "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
			"group" => __( 'Design options', 'js_composer' )
		)
	),
	"js_view" => 'VcColumnView'
) ); 

	}
}

function codeus_pucture_param_settings_field($settings, $value) {
   $dependency = vc_generate_dependencies_attributes($settings);
   return '<div class="picture">'
             .'<input name="'.$settings['param_name']
             .'" class="wpb_vc_param_value wpb-textinput picture-select '
             .$settings['param_name'].' '.$settings['type'].'_field" type="text" value="'
             .$value.'" ' . $dependency . '/><button>'.__('Select picture', 'codeus').'</button>'
         .'</div>';
}

function codeus_loadIFrameJsCss() {
	wp_enqueue_script( 'codeus_vc_inline_iframe_js', get_template_directory_uri() . '/js/js_composer_inline.js', array( 'jquery' ), '1.0', true );
}

if(class_exists('WPBakeryShortCodesContainer')) {
	class WPBakeryShortCode_one_half extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_one_half_last extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_text_box extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_one_third extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_one_third_last extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_one_fourth extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_one_fourth_last extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_accordion extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_tab extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_tabs extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_alert_box extends WPBakeryShortCodesContainer {}
}

function codeus_vc_admin_notices() {
	$screen = get_current_screen();
	if($screen->base == 'post' && $screen->action != 'add') {
		global $post;
		if($post->post_content != '' && substr($post->post_content, 0, 7) != '[vc_row' && is_array(vc_settings()->get( 'content_types' )) && in_array(get_post_type(), vc_settings()->get( 'content_types' ))) {
			echo '<div class="error" style="text-transform: uppercase; line-height: 2;"><p>'.sprintf(__('It seems like your content was created without Visual Composer. Please <a href="%s" target="_blank">READ THESE INSTRUCTIONS</a> of how to prepare your existing content to be edited with Visual Composer.','codeus'), 'http://codex-themes.com/codeus/recommended-plugins/js_composer_warning.html').'</p></div>';
		}
	}
}

add_filter('the_editor_content', 'codeus_the_editor_content');
function codeus_the_editor_content( $content ) {
	require_once(ABSPATH . 'wp-admin/includes/plugin.php');
	if(is_plugin_active('js_composer/js_composer.php') && $content != '' && substr($content, 0, 7) != '[vc_row' && is_array(vc_settings()->get( 'content_types' )) && in_array(get_post_type(), vc_settings()->get( 'content_types' ))) {
		return '[vc_row][vc_column width="1/1"]'.$content.'[/vc_column][/vc_row]';
	}
	return $content;
}

function codeus_divider_shortcode($atts) {
	extract(shortcode_atts(array(
		'type' => '',
		'color' => ''
	), $atts));
	return '<div class="divider'.($type ? ' '.$type : '').'"'.($color ? ' style="border-color: '.$color.'"' : '').'>'.($type == 'linebreak' ? '&nbsp;': '').'</div>';
}

function codeus_one_half_shortcode($atts,$content) {
	$return_html = '<div class="one_half">'.do_shortcode($content).'</div>';
	return $return_html;
}

function codeus_one_half_last_shortcode($atts,$content) {
	$return_html = '<div class="one_half last">'.do_shortcode($content).'</div><div class="clear"></div>';
	return $return_html;
}

function codeus_one_third_shortcode($atts,$content) {
	$return_html = '<div class="one_third">'.do_shortcode($content).'</div>';
	return $return_html;
}

function codeus_one_third_last_shortcode($atts,$content) {
	$return_html = '<div class="one_third last">'.do_shortcode($content).'</div><div class="clear"></div>';
	return $return_html;
}

function codeus_one_fourth_shortcode($atts,$content) {
	$return_html = '<div class="one_fourth">'.do_shortcode($content).'</div>';
	return $return_html;
}

function codeus_one_fourth_last_shortcode($atts,$content) {
	$return_html = '<div class="one_fourth last">'.do_shortcode($content).'</div><div class="clear"></div>';
	return $return_html;
}

function codeus_text_box_shortcode($atts,$content) {
	extract(shortcode_atts(array(
		'title' => '',
		'title_background_color' => '',
		'title_text_color' => '',
		'content_background_color' => '',
		'content_text_color' => '',
		'border_color' => '',
	), $atts));
	$return_html = '<div class="text_box" style="'.($border_color ? 'border: 1px solid '.$border_color.'; ' : 'border: none; ').($content_background_color ? 'background-color:'.$content_background_color.';' : '').'">';
	if($title) {
		$return_html .= '<h4 class="title" style="';
		if($title_background_color) {
			$return_html .= 'background-color:'.$title_background_color.';';
		}
		if($title_text_color) {
			$return_html .= 'color:'.$title_text_color.';';
		}
		$return_html .= '">'.$title.'</h4>';
	}
	$return_html .= '<div class="text clearfix" style="';
	if($content_text_color) {
		$return_html .= 'color:'.$content_text_color.';';
	}
	$return_html .= '">'.do_shortcode($content).'</div></div>';
	return $return_html;
}

function codeus_map_shortcode($atts) {
	extract(shortcode_atts(array(
		'width' => '100%',
		'height' => 300,
		'lat' => 0,
		'long' => 0,
		'zoom' => 12,
		'style' => 'no-style',
		'position' => 'left'
	), $atts));
	if(substr($width, -1) != "%") {
		$width = intval($width).'px';
	}
	if(substr($height, -1) != "%") {
		$height = intval($height).'px';
	}
	$return_html = '<div class="map wrap-box '.$style.' '.$position.'"><div class="wrap-box-inner" style="width:'.$width.'; height:'.$height.'">';
	if($style == 'style-5') {
		$return_html .= '<div class="shadow-wrap">';
	}
	$return_html .= '<iframe class="wrap-box-element" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q='.$lat.','.$long.'&amp;ll='.$lat.','.$long.'&amp;z='.$zoom.'&amp;output=embed"></iframe>';
	if($style == 'style-5') {
		$return_html .= '</div>';
	}
	$return_html .= '</div></div>';

	if($position == 'middle') {
		$return_html = '<div style="text-align:center;">'.$return_html.'</div>';
	}

	return $return_html;

}

function codeus_youtube_shortcode($atts) {
	extract(shortcode_atts(array(
		'width' => 400,
		'height' => 300,
		'video_id' => '',
		'style' => 'no-style',
		'position' => 'left'
	), $atts));
	if(substr($width, -1) != "%") {
		$width = intval($width).'px';
	}
	if(substr($height, -1) != "%") {
		$height = intval($height).'px';
	}

	$return_html = '<div class="youtube wrap-box '.$style.' '.$position.'"><div class="wrap-box-inner" style="width:'.$width.'; height:'.$height.'">';
	if($style == 'style-5') {
		$return_html .= '<div class="shadow-wrap">';
	}
	$return_html .= '<iframe class="wrap-box-element" width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.youtube.com/embed/'.$video_id.'?rel=0&amp;wmode=opaque"></iframe>';
	if($style == 'style-5') {
		$return_html .= '</div>';
	}
	$return_html .= '</div></div>';

	if($position == 'middle') {
		$return_html = '<div style="text-align:center;">'.$return_html.'</div>';
	}

	return $return_html;

}

function codeus_vimeo_shortcode($atts) {
	extract(shortcode_atts(array(
		'width' => 400,
		'height' => 300,
		'video_id' => '',
		'style' => 'no-style',
		'position' => 'left'
	), $atts));
	if(substr($width, -1) != "%") {
		$width = intval($width).'px';
	}
	if(substr($height, -1) != "%") {
		$height = intval($height).'px';
	}

	$return_html = '<div class="vimeo wrap-box '.$style.' '.$position.'"><div class="wrap-box-inner" style="width:'.$width.'; height:'.$height.'">';
	if($style == 'style-5') {
		$return_html .= '<div class="shadow-wrap">';
	}
	$return_html .= '<iframe class="wrap-box-element" width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0"></iframe>';
	if($style == 'style-5') {
		$return_html .= '</div>';
	}
	$return_html .= '</div></div>';

	if($position == 'middle') {
		$return_html = '<div style="text-align:center;">'.$return_html.'</div>';
	}

	return $return_html;

}

function codeus_image_shortcode($atts) {
	extract(shortcode_atts(array(
		'width' => '',
		'height' => '',
		'src' => '',
		'alt' => '',
		'style' => 'no-style',
		'position' => 'left',
		'lightbox'=>''
	), $atts));
	
	$return_html = '<div class="image wrap-box '.$style.' '.$position.'" style="'.($width?'width:auto; max-width: '.$width.'px;':'').'"><div class="wrap-box-inner">';
	if($style == 'style-5') {
		$return_html .= '<div class="shadow-wrap">';
	}
	if ($lightbox) {
		$return_html.='<a class="fancy" href="'.$src.'">';
	}
	if($src) {
		$return_html .= '<img class="wrap-box-element" style="'.($width?'width: '.$width.'px;':'').' '.($height?'height: '.$height.'px;':'').'" src="'.$src.'" alt="'.$alt.'"/>';
	}
	if ($lightbox) $return_html.='<span class="overlay"></span></a>';
	if($style == 'style-5') {
		$return_html .= '</div>';
	}
	$return_html .= '</div></div>';

	if($position == 'middle') {
		$return_html = '<div style="text-align:center;">'.$return_html.'</div>';
	}

	return $return_html;

}

function codeus_dropcap_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'border_color' => '',
		'background_color' => '',
		'text_color' => '',
	), $atts));
	$return_html = '<div class="dropcap"><span style="border-color: '.$border_color.'; background-color: '.$background_color.'; color: '.$text_color.';">'.do_shortcode($content).'</span></div>';
	return $return_html;
}

function codeus_quote_shortcode($atts, $content) {
	$content = codeus_js_remove_wpautop($content);
	$return_html = '<blockquote><p>'.do_shortcode($content).'</p></blockquote>';
	return $return_html;
}

function codeus_accordion_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'title' => '',
		'closed' => 1,
	), $atts));
	$return_html = '<div class="noscript accordion'.($closed ? ' closed' : '').'"><h5>'.$title.'</h5><div>'.do_shortcode($content).'</div></div><div class="loading"></div>';
	return $return_html;
}

function codeus_tabs_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'tab1' => '',
		'tab2' => '',
		'tab3' => '',
		'tab4' => '',
		'tab5' => '',
		'tab6' => '',
		'tab7' => '',
		'tab8' => '',
		'tab9' => '',
		'tab10' => '',
	), $atts));
	$tab_arr = array(
		$tab1,
		$tab2,
		$tab3,
		$tab4,
		$tab5,
		$tab6,
		$tab7,
		$tab8,
		$tab9,
		$tab10,
	);
	$return_html = '<div class="noscript tabs"><ul class="tabs-nav styled clearfix">';
	foreach($tab_arr as $key=>$tab) {
		if(!empty($tab)) {
			$return_html.= '<li><h5><a href="#tabs-'.($key+1).'">'.$tab.'</a></h5></li>';
		}
	}
	$return_html.= '</ul>';
	$return_html.= do_shortcode(str_replace(array('[/tab]<br />', "<br />\n[tab"), array('[/tab]', "\n[tab"), $content));
	$return_html.= '</div><div class="loading"></div>';
	return $return_html;
}

function codeus_tab_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'id' => '',
	), $atts));
	$return_html = '<div id="tabs-'.$id.'" class="tab_wrapper">'.do_shortcode($content).'</div>';
	return $return_html;
}

function codeus_video_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'width' => 400,
		'height' => 300,
		'video_src' => '',
		'image_src' => '',
		'style' => 'no-style',
		'position' => 'left'
	), $atts));
	if(substr($width, -1) != "%") {
		$width = intval($width).'px';
	}
	if(substr($height, -1) != "%") {
		$height = intval($height).'px';
	}

	$return_html = '<div class="video wrap-box '.$style.' '.$position.'"><div class="wrap-box-inner" style="width:'.$width.'; height:'.$height.'">';
	if($style == 'style-5') {
		$return_html .= '<div class="shadow-wrap">';
	}
	$return_html .= codeus_selfvideo($video_src, $image_src, $width, $height, 'wrap-box-element');
	if($style == 'style-5') {
		$return_html .= '</div>';
	}
	$return_html .= '</div></div>';

	if($position == 'middle') {
		$return_html = '<div style="text-align:center;">'.$return_html.'</div>';
	}

	return $return_html;

}

function codeus_list_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'type' => '',
	), $atts));
	$return_html = '<div class="list '.$type.'">'.do_shortcode($content).'</div>';
	return $return_html;
}


function codeus_table_shortcode($atts, $content) {
	$return_html = '<div class="table">'.do_shortcode($content).'</div>';
	return $return_html;
}

function codeus_button_shortcode($atts) {
	extract(shortcode_atts(array(
		'link' => '#',
		'text' => __('More', 'codeus'),
		'title' => '',
		'target' => '_self',
		'bgcolor' => '',
	), $atts));
	$return_html = '<a class="button" href="'.$link.'" target="'.$target.'" style="background-color: '.$bgcolor.';">'.$text.'</a>';
	return $return_html;
}


function codeus_iconed_title_shortcode($atts) {
	extract(shortcode_atts(array(
		'icon' => '',
		'isactive' => 0,
		'title' => __('Title', 'codeus'),
		'level' => 'h5',
	), $atts));
	$return_html = '<div><'.$level.' class="iconed-title" >'.($icon ? '<span class="icon'.($isactive ? ' active' : '').'">&#x'.$icon.';</span>' : '').$title.'</'.$level.'></div>';
	return $return_html;
}

function codeus_icon_with_text_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'icon' => '',
		'title' => '',
		'level' => 'h5',
		'icon_border_color' => '',
		'icon_background_color' => '',
		'icon_color' => '',
	), $atts));
	$return_html = '<div class="iconed-text clearfix">';
	if($icon) {
		$return_html .= '<span class="icon" style="border-color: '.$icon_border_color.'; background-color: '.$icon_background_color.'; color: '.$icon_color.';">&#x'.$icon.';</span>';
	}
	$return_html .= '<div class="text">';
	$return_html .= ($title ? '<'.$level.'>'.$title.'</'.$level.'>' : '').'<div>'.do_shortcode($content).'</div></div></div>';
	return $return_html;
}

function codeus_icon_shortcode($atts) {
	extract(shortcode_atts(array(
		'icon' => '',
		'icon_border_color' => '',
		'icon_background_color' => '',
		'icon_color' => '',
	), $atts));
	$return_html = '';
	if($icon) {
		$return_html .= '<span class="simple-icon" style="border-color: '.$icon_border_color.'; background-color: '.$icon_background_color.'; color: '.$icon_color.';">&#x'.$icon.';</span>';
	}
	return $return_html;
}

function codeus_alert_box_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'title' => '',
		'button_text' => __('Read more', 'codeus'),
		'button_link' => '#',
		'button_background_color' => '',
		'icon' => '',
		'icon_border_color' => '',
		'icon_background_color' => '',
		'icon_color' => '',
	), $atts));
	$return_html = '';
	if($icon) {
		$return_html = '<div class="alert-icon" style="border-color: '.$icon_border_color.'; background-color: '.$icon_background_color.'; color: '.$icon_color.';">&#x'.$icon.';</div>';
	}
	$return_html .= '<div class="text">'.($title ? '<h2>'.$title.'</h2>' : '').'<div>'.do_shortcode($content).'</div></div>';
	$return_html .= '<div class="alert-button"><a class="button" href="'.$button_link.'" style="background-color: '.$button_background_color.';">'.$button_text.'</a></div>';
	$return_html = '<div class="alert-box'.($icon ? ' iconed' : '').'"><div class="clearfix">'.$return_html.'</div></div>';
	return $return_html;
}

function codeus_pricing_table_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'style' => '1',
		'button_icon' => 'none',
	), $atts));
	$return_html = '<div class="pricing-table style-'.$style.' button-icon-'.$button_icon.'">';
	$return_html.= do_shortcode($content);
	$return_html.= '</div>';
	return $return_html;
}

function codeus_pricing_column_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'title' => 'Column title',
		'subtitle' => 'Column subtitle',
		'highlighted' => '0',
	), $atts));
	$return_html = '<div class="pricing-column'.($highlighted == '1' ? ' highlighted' : '').'"><div class="pricing-title-wrapper"><div class="pricing-title">'.$title.($highlighted && $subtitle != '' ? '<br/><span class="subtitle">'.$subtitle.'</span>' : '').'</div></div>';
	$return_html.= do_shortcode($content);
	$return_html.= '</div>';
	return $return_html;
}

function codeus_pricing_price_shortcode($atts) {
	extract(shortcode_atts(array(
		'currency' => '',
		'price' => '',
		'time' => '',
		'font_size' => '72',
		'color' => '',
	), $atts));
	$return_html = '<div class="pricing-price" style="'.($font_size != '' ? 'font-size: '.$font_size.'px;' : '').($color != '' ? 'color: '.$color.';' : '').'">'.$currency.$price.($time != '' ? '<span class="time">'.$time.'</span>' : '').'</div>';
	return $return_html;
}

function codeus_pricing_row_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'strike' => '',
	), $atts));
	$return_html = '<div class="pricing-row '.($strike == '1' ? ' strike' : '').'">'.$content.'</div>';
	return $return_html;
}

function codeus_pricing_footer_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'href' => '#',
	), $atts));
	$return_html = '<div class="pricing-footer"><a href="'.$href.'" class="button">'.$content.'</a></div>';
	return $return_html;
}

?>