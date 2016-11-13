<?php

function codeus_get_theme_options() {
	$options = array(
		'general' => array(
			'title' => __('General', 'codeus'),
			'subcats' => array(
				'theme_color_skin' => array(
					'title' => __('Theme Color Skin', 'codeus'),
					'options' => array(
						'page_color_style' => array(
							'title' => __('Page Color Style', 'codeus'),
							'type' => 'select',
							'items' => array(
								'light' => __('Light', 'codeus'),
								'dark' => __('Dark', 'codeus'),
							),
							'default' => 'light',
							'description' => __('Select theme color style', 'codeus'),
						),
					),
				),
				'theme_layout' => array(
					'title' => __('Theme Layout', 'codeus'),
					'options' => array(
						'page_layout_style' => array(
							'title' => __('Page Layout Style', 'codeus'),
							'type' => 'select',
							'items' => array(
								'fullwidth' => __('Fullwidth Layout', 'codeus'),
								'boxed' => __('Boxed Layout', 'codeus'),
							),
							'default' => 'fullwidth',
							'description' => __('Select theme layout style', 'codeus'),
						),
					),
				),
				'identity' => array(
					'title' => __('Identity', 'codeus'),
					'options' => array(
						'logo' => array(
							'title' => __('Logo', 'codeus'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/default-logo.png',
							'description' => __('Upload or select image file for your logo', 'codeus'),
						),
						'small_logo' => array(
							'title' => __('Small Logo', 'codeus'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/default-logo-fixed.png',
							'description' => __('Upload or select image file for your logo', 'codeus'),
						),
						'logo_position' => array(
							'title' => __('Logo Position', 'codeus'),
							'type' => 'select',
							'items' => array(
								'left' => __('Left', 'codeus'),
								'right' => __('Right', 'codeus'),
							),
							'default' => 'left',
							'description' => __('Select position of your logo in website header', 'codeus'),
						),
						'favicon' => array(
							'title' => __('Favicon', 'codeus'),
							'type' => 'image',
							'description' => __('Upload or select file for your favicon', 'codeus'),
						),
					),
				),
				'advanced' => array(
					'title' => __('Advanced', 'codeus'),
					'options' => array(
						'custom_css' => array(
							'title' => __('Custom CSS', 'codeus'),
							'type' => 'textarea',
							'description' => __('Type your custom css here, which you would like to add to theme\'s css (or overwrite it)', 'codeus'),
						),
						'ga_code' => array(
							'title' => __('Google Analytics Code', 'codeus'),
							'type' => 'textarea',
							'description' => __('Paste your tracking code here (Google Analytics or others)', 'codeus'),
						),
					),
				),
			),
		),

		'fonts' => array(
			'title' => __('Fonts', 'codeus'),
			'subcats' => array(
				'google_fonts' => array(
					'title' => __('Google Fonts', 'codeus'),
					'options' => array(
						'google_fonts_file' => array(
							'title' => __('Google Fonts File', 'codeus'),
							'type' => 'file',
							'description' => __('Upload or select you own google fonts file if you would like to use a different version than the theme\'s default', 'codeus'),
						),
					),
				),
				'main_menu_font' => array(
					'title' => __('Main Menu Font', 'codeus'),
					'options' => array(
						'main_menu_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'main_menu_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'main_menu_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'main_menu_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 18,
						),
						'main_menu_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'submenu_font' => array(
					'title' => __('Submenu Font', 'codeus'),
					'options' => array(
						'submenu_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'submenu_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'submenu_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'submenu_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 12,
						),
						'submenu_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h1_font' => array(
					'title' => __('H1 Font', 'codeus'),
					'options' => array(
						'h1_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'h1_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'h1_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'h1_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 29,
						),
						'h1_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h2_font' => array(
					'title' => __('H2 Font', 'codeus'),
					'options' => array(
						'h2_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'h2_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'h2_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'h2_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 25,
						),
						'h2_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h3_font' => array(
					'title' => __('H3 Font', 'codeus'),
					'options' => array(
						'h3_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'h3_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'h3_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'h3_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 23,
						),
						'h3_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h4_font' => array(
					'title' => __('H4 Font', 'codeus'),
					'options' => array(
						'h4_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'h4_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'h4_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'h4_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 21,
						),
						'h4_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h5_font' => array(
					'title' => __('H5 Font', 'codeus'),
					'options' => array(
						'h5_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'h5_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'h5_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'h5_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 19,
						),
						'h5_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h6_font' => array(
					'title' => __('H6 Font', 'codeus'),
					'options' => array(
						'h6_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'h6_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'h6_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'h6_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 17,
						),
						'h6_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'body_font' => array(
					'title' => __('Body Font', 'codeus'),
					'options' => array(
						'body_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'body_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'body_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'body_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 14,
						),
						'body_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'widget_title_font' => array(
					'title' => __('Widget Tile Font', 'codeus'),
					'options' => array(
						'widget_title_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'widget_title_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'widget_title_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'widget_title_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 14,
						),
						'widget_title_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'button_font' => array(
					'title' => __('Button Font', 'codeus'),
					'options' => array(
						'button_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'button_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'button_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'button_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 16,
						),
						'button_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'slideshow_title_font' => array(
					'title' => __('Slideshow Title Font', 'codeus'),
					'options' => array(
						'slideshow_title_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'slideshow_title_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'slideshow_title_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'slideshow_title_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 16,
						),
						'slideshow_title_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'slideshow_description_font' => array(
					'title' => __('Slideshow Description Font', 'codeus'),
					'options' => array(
						'slideshow_description_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'slideshow_description_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'slideshow_description_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'slideshow_description_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 16,
						),
						'slideshow_description_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'portfolio_title_font' => array(
					'title' => __('Portfolio Title Font', 'codeus'),
					'options' => array(
						'portfolio_title_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'portfolio_title_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'portfolio_title_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'portfolio_title_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 16,
						),
						'portfolio_title_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'portfolio_description_font' => array(
					'title' => __('Portfolio Description Font', 'codeus'),
					'options' => array(
						'portfolio_description_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'portfolio_description_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'portfolio_description_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'portfolio_description_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 16,
						),
						'portfolio_description_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'quickfinder_title_font' => array(
					'title' => __('Quickfinder Title Font', 'codeus'),
					'options' => array(
						'quickfinder_title_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'quickfinder_title_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'quickfinder_title_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'quickfinder_title_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 16,
						),
						'quickfinder_title_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'quickfinder_description_font' => array(
					'title' => __('Quickfinder Description Font', 'codeus'),
					'options' => array(
						'quickfinder_description_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'quickfinder_description_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'quickfinder_description_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'quickfinder_description_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 16,
						),
						'quickfinder_description_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'gallery_title_font' => array(
					'title' => __('Gallery Title Font', 'codeus'),
					'options' => array(
						'gallery_title_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'gallery_title_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'gallery_title_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'gallery_title_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 16,
						),
						'gallery_title_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'gallery_description_font' => array(
					'title' => __('Gallery Description Font', 'codeus'),
					'options' => array(
						'gallery_description_font_family' => array(
							'title' => __('Font Family', 'codeus'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'codeus'),
						),
						'gallery_description_font_style' => array(
							'title' => __('Font Style', 'codeus'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'codeus'),
						),
						'gallery_description_font_sets' => array(
							'title' => __('Font Sets', 'codeus'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'codeus'),
							'default' => 'latin,latin-ext'
						),
						'gallery_description_font_size' => array(
							'title' => __('Font Size', 'codeus'),
							'description' => __('Select the font size', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 72,
							'default' => 16,
						),
						'gallery_description_line_height' => array(
							'title' => __('Line Height', 'codeus'),
							'description' => __('Select the line height', 'codeus'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
			),
		),

		'colors' => array(
			'title' => __('Colors', 'codeus'),
			'subcats' => array(
				'background_colors' => array(
					'title' => __('Background Colors', 'codeus'),
					'options' => array(
						'basic_outer_background_color' => array(
							'title' => __('Background Color For Boxed Layout', 'codeus'),
							'type' => 'color',
							'description' => __('Select website\'s backround color in boxed layout', 'codeus'),
						),
						'basic_inner_background_color' => array(
							'title' => __('Basic background color for website', 'codeus'),
							'type' => 'color',
							'description' => __('Basic background color is the continuous background color underlaying the whole webpage. By default it is visible for example in slideshow area, quickfinder area, portfolio-slider', 'codeus'),
						),
						'top_background_color' => array(
							'title' => __('Top Background Color', 'codeus'),
							'type' => 'color',
							'description' => __('Select color for website\'s top background', 'codeus'),
						),
						'main_background_color' => array(
							'title' => __('Main Content Background Color', 'codeus'),
							'type' => 'color',
							'description' => __('Select color for website\'s main content background', 'codeus'),
						),
						'contact_background_color' => array(
							'title' => __('Contact Background Color', 'codeus'),
							'type' => 'color',
							'description' => __('Select color contact us & follow us bar at website\'s bottom', 'codeus'),
						),
						'footer_background_color' => array(
							'title' => __('Footer Background Color', 'codeus'),
							'type' => 'color',
							'description' => __('Select color footer bar at website\'s bottom', 'codeus'),
						),
						'styled_elements_background_color' => array(
							'title' => __('Styled Element Default Background Color', 'codeus'),
							'type' => 'color',
							'description' => __('Default background color which is used in following elements: text boxes, alert boxes, tables, news, tabs, galleries, rounded backgrounds in testimonials, recent posts, author block', 'codeus'),
						),
						'divider_default_color' => array(
							'title' => __('Divider Default Color', 'codeus'),
							'type' => 'color',
							'description' => __('Default color for dividers used in theme: content dividers, widget dividers, blog & news posts dividers etc.', 'codeus'),
						),
						'images_border_color' => array(
							'title' => __('Image Box Border Color', 'codeus'),
							'type' => 'color',
							'description' => __('Choose border color for displaying images in styled image', 'codeus'),
						),
					),
				),
				'menu_colors' => array(
					'title' => __('Menu Colors', 'codeus'),
					'options' => array(
						'main_menu_text_color' => array(
							'title' => __('Main Menu Text Color', 'codeus'),
							'type' => 'color',
						),
						'main_menu_hover_text_color' => array(
							'title' => __('Main Menu Hover Text Color', 'codeus'),
							'type' => 'color',
						),
						'main_menu_active_text_color' => array(
							'title' => __('Main Menu Active Text Color', 'codeus'),
							'type' => 'color',
						),
						'main_menu_active_background_color' => array(
							'title' => __('Main Menu Active Background Color', 'codeus'),
							'type' => 'color',
						),
						'submenu_text_color' => array(
							'title' => __('Submenu Text Color', 'codeus'),
							'type' => 'color',
						),
						'submenu_hover_text_color' => array(
							'title' => __('Submenu Hover Text Color', 'codeus'),
							'type' => 'color',
						),
						'submenu_background_color' => array(
							'title' => 'Submenu Background Color',
							'type' => 'color',
						),
						'submenu_hover_background_color' => array(
							'title' => __('Submenu Hover Background Color', 'codeus'),
							'type' => 'color',
						),
					),
				),
				'text_colors' => array(
					'title' => __('Text Colors', 'codeus'),
					'options' => array(
						'body_color' => array(
							'title' => __('Body Color', 'codeus'),
							'type' => 'color',
						),
						'h1_color' => array(
							'title' => __('H1 Color', 'codeus'),
							'type' => 'color',
						),
						'h2_color' => array(
							'title' => __('H2 Color', 'codeus'),
							'type' => 'color',
						),
						'h3_color' => array(
							'title' => __('H3 Color', 'codeus'),
							'type' => 'color',
						),
						'h4_color' => array(
							'title' => __('H4 Color', 'codeus'),
							'type' => 'color',
						),
						'h5_color' => array(
							'title' => __('H5 Color', 'codeus'),
							'type' => 'color',
						),
						'h6_color' => array(
							'title' => __('H6 Color', 'codeus'),
							'type' => 'color',
						),
						'link_color' => array(
							'title' => __('Link Color', 'codeus'),
							'type' => 'color',
						),
						'hover_link_color' => array(
							'title' => __('Hover Link Color', 'codeus'),
							'type' => 'color',
						),
						'active_link_color' => array(
							'title' => __('Active Link Color', 'codeus'),
							'type' => 'color',
						),
						'footer_text_color' => array(
							'title' => __('Footer Text Color', 'codeus'),
							'type' => 'color',
						),
						'copyright_text_color' => array(
							'title' => __('Copyright Text Color', 'codeus'),
							'type' => 'color',
						),
						'copyright_link_color' => array(
							'title' => __('Copyright Link Color', 'codeus'),
							'type' => 'color',
						),
						'portfolio_clients_bar_title_color' => array(
							'title' => __('Portfolio & Clients Slider Bar Title', 'codeus'),
							'type' => 'color',
						),
						'contact_bar_title_color' => array(
							'title' => __('Contact Bar Title', 'codeus'),
							'type' => 'color',
						),
						'contact_bar_text_color' => array(
							'title' => __('Contact Bar Text Color', 'codeus'),
							'type' => 'color',
						),
					),
				),
				'button_colors' => array(
					'title' => __('Button Colors', 'codeus'),
					'options' => array(
						'button_text_basic_color' => array(
							'title' => __('Basic Text Color', 'codeus'),
							'type' => 'color',
						),
						'button_text_hover_color' => array(
							'title' => __('Hover Text Color', 'codeus'),
							'type' => 'color',
						),
						'button_text_active_color' => array(
							'title' => __('Active Text Color', 'codeus'),
							'type' => 'color',
						),
						'button_background_basic_color' => array(
							'title' => __('Basic Background Color', 'codeus'),
							'type' => 'color',
						),
						'button_background_hover_color' => array(
							'title' => __('Hover Background Color', 'codeus'),
							'type' => 'color',
						),
						'button_background_active_color' => array(
							'title' => __('Active Background Color', 'codeus'),
							'type' => 'color',
						),
					),
				),
				'widgets_colors' => array(
					'title' => __('Widgets Colors', 'codeus'),
					'options' => array(
						'widget_background_color' => array(
							'title' => __('Widget Background Color', 'codeus'),
							'type' => 'color',
							'description' => __('Choose background color for following widgets - SUBMENU, TEAM, CATEGORIES, CUSTOM MENU, RECENT POSTS, POPULAR POSTS, FLICKR', 'codeus'),
						),
						'widget_title_background_color' => array(
							'title' => __('Widget Title Background Color', 'codeus'),
							'type' => 'color',
							'description' => __('Choose title bar background color for following widgets - SUBMENU, TEAM, CATEGORIES, CUSTOM MENU, RECENT POSTS, POPULAR POSTS, FLICKR', 'codeus'),
						),
						'widget_title_color' => array(
							'title' => __('Widget Title Color', 'codeus'),
							'type' => 'color',
							'description' => __('Choose color of widget titles', 'codeus'),
						),
						'widget_link_color' => array(
							'title' => __('Widget Link Color', 'codeus'),
							'type' => 'color',
							'description' => __('Choose color of links in widgets', 'codeus'),
						),
						'widget_hover_link_color' => array(
							'title' => __('Widget Hover Link Color', 'codeus'),
							'type' => 'color',
						),
						'widget_active_link_color' => array(
							'title' => __('Widget Active Link Color', 'codeus'),
							'type' => 'color',
						),
						'widgets_custom_field_color' => array(
							'title' => __('Widgets Custom Field Text Color', 'codeus'),
							'type' => 'color',
							'description' => __('Select body text color for PROJECT INFO / CUSTOM FIELDS widget', 'codeus'),
						),
					),
				),
				'portfolio_colors' => array(
					'title' => __('Portfolio Colors', 'codeus'),
					'options' => array(
						'portfolio_slider_bar_background_color' => array(
							'title' => __('Portfolio Slider Bar Background', 'codeus'),
							'type' => 'color',
							'description' => __('Choose background color for portfolio sliders', 'codeus'),
						),
						'portfolio_slider_title_background_color' => array(
							'title' => __('Portfolio Slider Title Background', 'codeus'),
							'type' => 'color',
							'description' => __('Select title & description background color for portfolio sliders', 'codeus'),
						),
						'portfolio_slider_title_color' => array(
							'title' => __('Portfolio Slider Title Text', 'codeus'),
							'type' => 'color',
							'description' => __('Choose portfolio item\'s title color for portfolio slider', 'codeus'),
						),
						'portfolio_slider_description_color' => array(
							'title' => __('Portfolio Slider Description Text', 'codeus'),
							'type' => 'color',
							'description' => __('Select portfolio item\'s description color for portfolio slider', 'codeus'),
						),
						'portfolio_slider_arrow_border_color' => array(
							'title' => __('Portfolio Slider Arrow Border', 'codeus'),
							'type' => 'color',
							'description' => __('Choose border color for slider\'s arrow', 'codeus'),
						),
						'portfolio_slider_arrow_color' => array(
							'title' => __('Portfolio Slider Arrow', 'codeus'),
							'type' => 'color',
							'description' => __('Select color of slider\'s arrow', 'codeus'),
						),
						'portfolio_title_background_color' => array(
							'title' => __('Portfolio Overview Title Background', 'codeus'),
							'type' => 'color',
							'description' => __('Choose title & description background color for grid-style portfolio overviews', 'codeus'),
						),
						'portfolio_title_color' => array(
							'title' => __('Portfolio Overview Title Text', 'codeus'),
							'type' => 'color',
							'description' => __('Select portfolio item\'s title color for grid-style portfolio overviews', 'codeus'),
						),
						'portfolio_description_color' => array(
							'title' => __('Portfolio Overview Description Text', 'codeus'),
							'type' => 'color',
							'description' => __('Choose portfolio item\'s description color for grid-style portfolio overviews', 'codeus'),
						),
						'portfolio_sharing_button_background_color' => array(
							'title' => __('Sharing Button Background', 'codeus'),
							'type' => 'color',
							'description' => __('Choose background color for sharing button in portfolio overviews', 'codeus'),
						),
						'portfolio_date_color' => array(
							'title' => __('Portfolio Date Color', 'codeus'),
							'type' => 'color',
							'description' => __('Font color for showing the date in portfolio overviews', 'codeus'),
						),
					),
				),
				'gallery_colors' => array(
					'title' => __('Gallery And Image Box Colors', 'codeus'),
					'options' => array(
						'gallery_caption_background_color' => array(
							'title' => __('Gallery Caption Background', 'codeus'),
							'type' => 'color',
							'description' => __('Select background color for image description in gallery', 'codeus'),
						),
						'gallery_title_color' => array(
							'title' => __('Gallery Title Text', 'codeus'),
							'type' => 'color',
							'description' => __('Choose title color for image description in gallery', 'codeus'),
						),
						'gallery_description_color' => array(
							'title' => __('Gallery Description Text', 'codeus'),
							'type' => 'color',
							'description' => __('Select text color for image description in gallery', 'codeus'),
						),
					),
				),
				'quickfinder_colors' => array(
					'title' => __('Quickfinder Colors', 'codeus'),
					'options' => array(
						'quickfinder_bar_background_color' => array(
							'title' => __('Quickfinder Bar Background', 'codeus'),
							'type' => 'color',
							'description' => __('Select background color for the bar/panel with quickfinders', 'codeus'),
						),
						'quickfinder_bar_title_color' => array(
							'title' => __('Quickfinder Bar Title Text', 'codeus'),
							'type' => 'color',
							'description' => __('Choose title color for the bar/panel with quickfinders', 'codeus'),
						),
						'quickfinder_bar_description_color' => array(
							'title' => __('Quickfinder Bar Description Text', 'codeus'),
							'type' => 'color',
							'description' => __('Select text color for the bar/panel with quickfinders', 'codeus'),
						),
						'quickfinder_title_color' => array(
							'title' => __('Quickfinder Title Text', 'codeus'),
							'type' => 'color',
						),
						'quickfinder_description_color' => array(
							'title' => __('Quickfinder Description Text', 'codeus'),
							'type' => 'color',
						),
					),
				),
				'bullets_pager_colors' => array(
					'title' => __('Bullets, Icons, Dropcaps & Pager', 'codeus'),
					'options' => array(
						'bullets_symbol_color' => array(
							'title' => __('Bullets Symbol', 'codeus'),
							'type' => 'color',
							'description' => __('Select font color for bullets. The same color will be used as icon font color in "active" state', 'codeus'),
						),
						'dropcap_border_color' => array(
							'title' => __('Dropcaps Default Border', 'codeus'),
							'type' => 'color',
							'description' => __('Select default backround color for dropcaps. The same border color will be used as border color for accordion\'s icons', 'codeus'),
						),
						'dropcap_background_color' => array(
							'title' => __('Dropcaps Default Background', 'codeus'),
							'type' => 'color',
							'description' => __('Select backround color for dropcaps. The same color will be used as backround color for accordion\'s icons ', 'codeus'),
						),
						'dropcaps_symbol_color' => array(
							'title' => __('Dropcaps Default Fontcolor', 'codeus'),
							'type' => 'color',
							'description' => __('Select fontcolor for dropcaps', 'codeus'),
						),
						'icons_background_color' => array(
							'title' => __('Icons Background', 'codeus'),
							'type' => 'color',
							'description' => __('Select icon backround color for "normal" state', 'codeus'),
						),
						'icons_symbol_color' => array(
							'title' => __('Icons Symbol', 'codeus'),
							'type' => 'color',
							'description' => __('Select icon font color for "normal" state', 'codeus'),
						),
						'icons_border_color' => array(
							'title' => __('Icons Border', 'codeus'),
							'type' => 'color',
							'description' => __('???', 'codeus'),
						),
						'pager_border_color' => array(
							'title' => __('Pager Element Border', 'codeus'),
							'type' => 'color',
							'description' => __('???', 'codeus'),
						),
						'pager_text_color' => array(
							'title' => __('Pager Element Text', 'codeus'),
							'type' => 'color',
							'description' => __('Select font color for pages in pager', 'codeus'),
						),
						'pager_active_text_color' => array(
							'title' => __('Active and Hover Pager Element Text', 'codeus'),
							'type' => 'color',
							'description' => __('Select font color for active page in pager', 'codeus'),
						),
						'slideshow_arrow_border_color' => array(
							'title' => __('Icon Border For Slideshows & Hovers', 'codeus'),
							'type' => 'color',
							'description' => __('Select icon border color for arrows in slideshow & hovers on portfolio items/gallery', 'codeus'),
						),
						'slideshow_arrow_color' => array(
							'title' => __('Icon Font Color For Slideshows & Hovers', 'codeus'),
							'type' => 'color',
							'description' => __('Select icon font color for arrows in slideshow & hovers on portfolio items/gallery', 'codeus'),
						),
					),
				),
				'form_colors' => array(
					'title' => __('Form', 'codeus'),
					'options' => array(
						'form_elements_background_color' => array(
							'title' => __('Form Elements Background', 'codeus'),
							'type' => 'color',
						),
						'form_elements_text_color' => array(
							'title' => __('Form Elements Text', 'codeus'),
							'type' => 'color',
						),
					),
				),
			),
		),

		'backgrounds' => array(
			'title' => __('Backgrounds', 'codeus'),
			'subcats' => array(
				'backgrounds_images' => array(
					'title' => __('Background Images', 'codeus'),
					'options' => array(
						'basic_outer_background_image' => array(
							'title' => __('Background for Boxed Layout', 'codeus'),
							'type' => 'image',
							'description' => __('Select or upload image file for website\'s backround in boxed layout', 'codeus'),
						),
						'basic_outer_background_image_select' => array(
							'title' => __('Background Patterns for Boxed Layout', 'codeus'),
							'type' => 'image-select',
							'target' => 'basic_outer_background_image',
							'items' => array(
								0 => 'low_contrast_linen',
								1 => 'mochaGrunge',
								2 => 'bedge_grunge',
								3 => 'solid',
								4 => 'concrete_wall',
								5 => 'dark_circles',
								6 => 'debut_dark',
							),
						),
						'basic_outer_background_size' => array(
							'title' => __('Cover complete background area (no cloning)', 'codeus'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
							'description' => __('If checked, this option will use your chosen background image to cover the whole background area.  Otherwise your background image will be use in original sized and then cloned to cover the background area', 'codeus'),
						),
						'basic_inner_background_image' => array(
							'title' => __('Basic background for website', 'codeus'),
							'type' => 'image',
							'description' => __('Basic background is the continuous background underlaying the whole webpage. By default it is visible for example in slideshow area, quickfinder area, portfolio-slider', 'codeus'),
						),
						'header_pattern_image' => array(
							'title' => __('Header\'s Texture Pattern', 'codeus'),
							'type' => 'image',
							'description' => __('Select or upload texture pattern to use in website header. Please use PNGs with transparency', 'codeus'),
						),
						'top_background_image' => array(
							'title' => __('Top Background', 'codeus'),
							'type' => 'image',
							'description' => __('Select or upload image file for website\'s top background', 'codeus'),
						),
						'main_background_image' => array(
							'title' => __('Main Content Background', 'codeus'),
							'type' => 'image',
							'description' => __('Select or upload image file for website\'s main content background', 'codeus'),
						),
						'contact_background_image' => array(
							'title' => __('Contact Background', 'codeus'),
							'type' => 'image',
							'description' => __('Select or upload image file for contact us & follow us bar at website\'s bottom', 'codeus'),
						),
						'footer_background_image' => array(
							'title' => __('Footer Background', 'codeus'),
							'type' => 'image',
							'description' => __('Select or upload image file for footer bar at website\'s bottom', 'codeus'),
						),
						'portfolio_bar_background_image' => array(
							'title' => __('Portfolio Slider Bar Background', 'codeus'),
							'type' => 'image',
							'description' => __('Select or upload image to customize background in portfolio sliders', 'codeus'),
						),
						'quickfinder_bar_background_image' => array(
							'title' => __('Quickfinder Bar Background', 'codeus'),
							'type' => 'image',
							'description' => __('Select or upload image to customize background in quickfinder area', 'codeus'),
						),
					),
				),
			),
		),

		'home_constructor' => array(
			'title' => __('Home Constructor', 'codeus'),
			'subcats' => array(
				'home_content_builder' => array(
					'title' => __('Home Constructor', 'codeus'),
					'options' => array(
						'home_content_enabled' => array(
							'title' => __('Activate Home Constructor', 'codeus'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'home_effects_enabled' => array(
							'title' => __('Lazy loading enabled', 'codeus'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'home_content' => array(
							'type' => 'content_builder',
							'blocks' => array(
								'slideshow' => __('Slideshow', 'codeus'),
								'quickfinder' => __('Quickfinder', 'codeus'),
								'portfolio' => __('Portfolio', 'codeus'),
								'clients' => __('Clients', 'codeus'),
								'content' => __('Pages', 'codeus'),
								'news' => __('News', 'codeus'),
							),
							'description' => __('Drag-n-drop panels here to setup required order', 'codeus'),
						),
					),
				),
			),
		),

		'slideshow' => array(
			'title' => __('NivoSlider Options', 'codeus'),
			'subcats' => array(
				'slideshow_options' => array(
					'title' => __('NivoSlider Options', 'codeus'),
					'options' => array(
						'slider_effect' => array(
							'title' => __('Effect', 'codeus'),
							'type' => 'select',
							'items' => array(
								'random' => 'random',
								'fold' => 'fold',
								'fade' => 'fade',
								'sliceDown' => 'sliceDown',
								'sliceDownRight' => 'sliceDownRight',
								'sliceDownLeft' => 'sliceDownLeft',
								'sliceUpRight' => 'sliceUpRight',
								'sliceUpLeft' => 'sliceUpLeft',
								'sliceUpDown' => 'sliceUpDown',
								'sliceUpDownLeft' => 'sliceUpDownLeft',
								'fold' => 'fold',
								'fade' => 'fade',
								'boxRandom' => 'boxRandom',
								'boxRain' => 'boxRain',
								'boxRainReverse' => 'boxRainReverse',
								'boxRainGrow' => 'boxRainGrow',
								'boxRainGrowReverse' => 'boxRainGrowReverse',
							),
						),
						'slider_slices' => array(
							'title' => __('Slices', 'codeus'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 20,
							'default' => 15,
						),
						'slider_boxCols' => array(
							'title' => __('Box Cols', 'codeus'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 10,
							'default' => 8,
						),
						'slider_boxRows' => array(
							'title' => __('Box Rows', 'codeus'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 10,
							'default' => 4,
						),
						'slider_animSpeed' => array(
							'title' => __('Animation Speed ( x 100 milliseconds )', 'codeus'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 50,
							'default' => 5,
						),
						'slider_pauseTime' => array(
							'title' => __('Pause Time ( x 1000 milliseconds )', 'codeus'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 20,
							'default' => 3,
						),
						'slider_directionNav' => array(
							'title' => __('Direction Navigation', 'codeus'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'slider_controlNav' => array(
							'title' => __('Control Navigation', 'codeus'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
			),
		),

		'blog' => array(
			'title' => __('Blog & News', 'codeus'),
			'subcats' => array(
				'blog_options' => array(
					'title' => __('Blog & News Options', 'codeus'),
					'options' => array(
						'show_author' => array(
							'title' => __('Show author', 'codeus'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'post_per_page' => array(
							'title' => __('Post per page', 'codeus'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 20,
							'default' => 5,
						),
						'excerpt_length' => array(
							'title' => __('Excerpt lenght', 'codeus'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 150,
							'default' => 20,
						),
					),
				),
			),
		),

		'footer' => array(
			'title' => __('Footer', 'codeus'),
			'subcats' => array(
				'footer_options' => array(
					'title' => __('Footer Options', 'codeus'),
					'options' => array(
						'footer_active' => array(
							'title' => __('Activate footer', 'codeus'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'footer_html' => array(
							'title' => __('Footer HTML', 'codeus'),
							'type' => 'textarea',
						),
					),
				),
			),
		),

		'socials' => array(
			'title' => __('Contacts & Socials', 'codeus'),
			'subcats' => array(
				'follow_contacts_bar' => array(
					'title' => __('Follow Us / Contact Us Bar', 'codeus'),
					'options' => array(
						'follow_contacts_active' => array(
							'title' => __('Activate Follow Us / Contact Us', 'codeus'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
				'contacts' => array(
					'title' => __('Contacts', 'codeus'),
					'options' => array(
						'contacts_title' => array(
							'title' => __('Contact Us Title', 'codeus'),
							'type' => 'input',
							'description' => __('Enter your custom title for Contact Us box at the website\'s bottom. "Contact Us" will be used if empty', 'codeus'),
						),
						'contacts_html' => array(
							'title' => __('Contacts Us HTML', 'codeus'),
							'type' => 'textarea',
							'description' => __('Define your contact data to be shown in contact box. You can use a simple text as well as HTML and shortcodes', 'codeus'),
						),
						'admin_email' => array(
							'title' => __('Admin E-mail', 'codeus'),
							'type' => 'input',
							'description' => __('Define email address of website admin. All feedbacks from contact form will be forwarded on this email address', 'codeus'),
						),
						'contacts_display_map' => array(
							'title' => __('Display map on contact page', 'codeus'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'contacts_map_height' => array(
							'title' => __('Map height (px)', 'codeus'),
							'type' => 'input',
						),
						'contacts_map_latitude' => array(
							'title' => __('Map latitude', 'codeus'),
							'type' => 'input',
							'description' => sprintf(__('<a href="%s">Find here</a>', 'codeus'), 'http://universimmedia.pagesperso-orange.fr/geo/loc.htm'),
						),
						'contacts_map_longitude' => array(
							'title' => __('Map longitude', 'codeus'),
							'type' => 'input',
							'description' => sprintf(__('<a href="%s">Find here</a>', 'codeus'), 'http://universimmedia.pagesperso-orange.fr/geo/loc.htm'),
						),
						'contacts_map_zoom' => array(
							'title' => __('Map zoom', 'codeus'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 20,
							'default' => 12,
						),
					),
				),
				'socials_options' => array(
					'title' => __('Socials', 'codeus'),
					'options' => array(
						'follow_title' => array(
							'title' => __('Follow Us Title', 'codeus'),
							'type' => 'input',
							'description' => __('Enter your custom title for Follow Us box at the website\'s bottom. "Follow Us" will be used if empty', 'codeus'),
						),
						'follow_us_text' => array(
							'title' => __('Follow Us Text', 'codeus'),
							'type' => 'textarea',
							'description' => __('Define your content to be shown in Follow Us box. You can use a simple text as well as HTML and shortcodes', 'codeus'),
						),
						'twitter_active' => array(
							'title' => __('Activate Twitter Icon', 'codeus'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'facebook_active' => array(
							'title' => __('Activate Facebook Icon', 'codeus'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'linkedin_active' => array(
							'title' => __('Activate LinkedIn Icon', 'codeus'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'googleplus_active' => array(
							'title' => __('Activate Google Plus Icon', 'codeus'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'stumbleupon_active' => array(
							'title' => __('Activate StumbleUpon Icon', 'codeus'),
							'type' => 'checkbox',
							'value' => 1,
						),
						'rss_active' => array(
							'title' => __('Activate RSS Icon', 'codeus'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'twitter_link' => array(
							'title' => __('Twitter Profile Link', 'codeus'),
							'type' => 'input',
							'default' => '#',
							'description' => __('Enter URL to your twitter profile', 'codeus'),
						),
						'facebook_link' => array(
							'title' => __('Facebook Profile Link', 'codeus'),
							'type' => 'input',
							'default' => '#',
							'description' => __('Enter URL to your facebook profile', 'codeus'),
						),
						'linkedin_link' => array(
							'title' => __('LinkedIn Profile Link', 'codeus'),
							'type' => 'input',
							'default' => '#',
							'description' => __('Enter URL to your linkedin profile', 'codeus'),
						),
						'googleplus_link' => array(
							'title' => __('Google Plus Profile Link', 'codeus'),
							'type' => 'input',
							'default' => '#',
							'description' => __('Enter URL to your google+ profile', 'codeus'),
						),
						'stumbleupon_link' => array(
							'title' => __('StumbleUpon Profile Link', 'codeus'),
							'type' => 'input',
							'default' => '#',
							'description' => __('Enter URL to your stumbleupon profile', 'codeus'),
						),
						'rss_link' => array(
							'title' => __('RSS Link', 'codeus'),
							'type' => 'input',
							'default' => '#',
						),
						'show_social_icons' => array(
							'title' => __('Display Links For Sharing Posts On Social Networks', 'codeus'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
			),
		),
	);

	return $options;
}

function codeus_get_option_element($oname = '', $option = array(), $default = NULL) {
	if($default !== NULL) {
		$option['default'] = $default;
	}

	$ml_options = array('home_content', 'footer_html', 'contacts_title', 'contacts_html', 'follow_title', 'follow_us_text');
	if(in_array($oname, $ml_options) && is_array($option['default'])) {
		if(defined('ICL_LANGUAGE_CODE')) {
			global $sitepress;
			if(isset($option['default'][ICL_LANGUAGE_CODE])) {
				$option['default'] = $option['default'][ICL_LANGUAGE_CODE];
			} elseif($sitepress->get_default_language() && isset($option['default'][$sitepress->get_default_language()])) {
				$option['default'] = $option['default'][$sitepress->get_default_language()];
			} else {
				$option['default'] = '';
			}
		}else {
			$option['default'] = reset($option['default']);
		}
	}

	$option['default'] = stripslashes($option['default']);

	$output = '<div class="option '.$oname.'_field">';

	if(isset($option['type']) && $option['type'] == 'content_builder') {
		return codeus_content_builder_output($oname, $option);
	}

	if(isset($option['type'])) {

		if(isset($option['description'])) {
			$output .= '<div class="description">'.$option['description'].'</div>';
		}

		$output .= '<div class="label"><label for="'.$oname.'">'.$option['title'].'</label></div><div class="'.$option['type'].'">';
		switch ($option['type']) {

		case 'input':
			$output .= '<input id="'.$oname.'" name="theme_options['.$oname.']"';
			if(isset($option['default'])) {
				$output .= ' value="'.$option['default'].'"';
			}
			$output .= '/>';
			break;

		case 'image':
			$output .= '<input id="'.$oname.'" name="theme_options['.$oname.']"';
			if(isset($option['default'])) {
				$output .= ' value="'.$option['default'].'"';
			}
			$output .= '/>';
			break;

		case 'image-select':
			$skins = array('light', 'dark');
			foreach($skins as $skin) {
				foreach($option['items'] as $item) {
					$output .= '<a data-target="'.$option['target'].'" href="'.get_template_directory_uri().'/images/backgrounds/patterns/'.$skin.'/'.$item.'.jpg"><img alt="#" src="'.get_template_directory_uri().'/images/backgrounds/patterns/'.$skin.'/'.$item.'-thumb.jpg"/></a>';
				}
				$output .= '<span class="clear"></span>';
			}
			break;

		case 'file':
			$output .= '<input id="'.$oname.'" name="theme_options['.$oname.']"';
			if(isset($option['default'])) {
				$output .= ' value="'.$option['default'].'"';
			}
			$output .= '/>';
			break;

		case 'font-select':
			$selected = isset($option['default']) ? $option['default'] : '';
			$fontsList = codeus_fonts_list();
			$output .= '<select id="'.$oname.'" name="theme_options['.$oname.']">';
			foreach($fontsList as $val => $item) {
				$output .= '<option value="'.$val.'"';
				if($val == $selected) {
					$output .= ' selected';
				}
				$output .= '>'.$item.'</option>';
			}
			$output .= '</select>';
			break;

		case 'font-style':
			$selected = isset($option['default']) ? $option['default'] : '';
			$output .= '<select id="'.$oname.'" name="theme_options['.$oname.']" data-value="'.$selected.'"></select>';
			break;

		case 'font-sets':
			$output .= '<input id="'.$oname.'" name="theme_options['.$oname.']"';
			if(isset($option['default'])) {
				$output .= ' data-value="'.$option['default'].'"';
			}
			$output .= '/>';
			break;

		case 'fixed-number':
			$min = isset($option['min']) ? $option['min'] : 1;
			$max = isset($option['max']) ? $option['max'] : $min+1;
			$default = isset($option['default']) ? $option['default'] : $min;
			$output .= '<input id="'.$oname.'" name="theme_options['.$oname.']" value="'.$default.'" data-min-value="'.$min.'" data-max-value="'.$max.'"/>';
			break;

		case 'color':
			$output .= '<input id="'.$oname.'" name="theme_options['.$oname.']"';
			if(isset($option['default'])) {
				$output .= ' value="'.$option['default'].'"';
			}
			$output .= ' class="color-select"/>';
			break;

		case 'textarea':
			$output .= '<textarea id="'.$oname.'" name="theme_options['.$oname.']" cols="100" rows="15">';
			if(isset($option['default'])) {
				$output .= $option['default'];
			}
			$output .= '</textarea>';
			break;

		case 'select':
			$selected = isset($option['default']) ? $option['default'] : '';
			$output .= '<select id="'.$oname.'" name="theme_options['.$oname.']">';
			foreach($option['items'] as $val => $item) {
				$output .= '<option value="'.$val.'"';
				if($val == $selected) {
					$output .= ' selected';
				}
				$output .= '>'.$item.'</option>';
			}
			$output .= '</select>';
			break;

		default: 
			$output .= '<input id="'.$oname.'" name="theme_options['.$oname.']"';
			if(isset($option['default'])) {
				$output .= ' value="'.$option['default'].'"';
			}
			$output .= '/>';
		}

		$output .= '</div>';

		if($option['type'] == 'checkbox') {
			$output = '<div class="option '.$oname.'_field"><div class="checkbox"><input id="'.$oname.'" name="theme_options['.$oname.']" type="checkbox" value="'.$option['value'].'"';
			if($option['default'] == $option['value']) {
				$output .= ' checked';
			}
			$output .= '> <label for="'.$oname.'">'.$option['title'].'</label></div>';
		}

		$output .= '<div class="clear"></div></div>';
	}

	return $output;
}

function codeus_content_builder_output($oname, $option) {
	ob_start();
	$pages = array();
	$pages_list = get_pages();
	foreach ($pages_list as $page) {
		$pages[$page->ID] = $page->post_title . ' (ID = ' . $page->ID . ')';
	}
	$slideshow_types = array(0 => 'NivoSlider', 1 => 'LayerSlider');
	$slideshows = array();
	$slideshows_list = get_terms('codeus_slideshow', array('hide_empty' => false));
	foreach ($slideshows_list as $slideshow) {
		$slideshows[$slideshow->slug] = $slideshow->name . ' (Slug = ' . $slideshow->slug . ')';
	}
	$sliders = array();
	global $wpdb;
	$table_name = $wpdb->prefix . "layerslider";
	$slider_items = $wpdb->get_results( "SELECT * FROM $table_name
										WHERE flag_hidden = '0' AND flag_deleted = '0'
										ORDER BY id ASC" );
	foreach ($slider_items as $slider_item) {
		$sliders[$slider_item->id] = (empty($slider_item->name) ? 'Unnamed' : $slider_item->name) . ' (ID = ' . $slider_item->id . ')';
	}
	$portfolios = array();
	$portfolios_list = get_terms('codeus_portfoliosets', array('hide_empty' => false));
	foreach ($portfolios_list as $portfolio) {
		$portfolios[$portfolio->slug] = $portfolio->name . ' (Slug = ' . $portfolio->slug . ')';
	}
	$clients_sets = array();
	$clients_sets_list = get_terms('codeus_clientssets', array('hide_empty' => false));
	foreach ($clients_sets_list as $clients_set) {
		$clients_sets[$clients_set->slug] = $clients_set->name . ' (Slug = ' . $clients_set->slug . ')';
	}
	$quickfinders = array();
	$quickfinders_list = get_terms('codeus_quickfindersets', array('hide_empty' => false));
	foreach ($quickfinders_list as $quickfinder) {
		$quickfinders[$quickfinder->slug] = $quickfinder->name . ' (Slug = ' . $quickfinder->slug . ')';
	}
	$news_layouts = array('with_sidebar' => 'With Sidebar', 'fullwidth' => 'Fullwidth');
	if(!isset($option['default'])) {
		$option['default'] = '';
	}

	echo '<input id="' . $oname . '" name="theme_options[' . $oname . ']" type="hidden" value=""/>';
?>
<div id="<?php print $oname; ?>-control">
	<div class="option">
		<div class="description"><?php _e('Move content block down to activate it on your Home', 'codeus'); ?></div>
		<div class="label"><label for=""><?php _e('Selectable Content Blocks', 'codeus'); ?></label></div>
		<div class="selectable-blocks">
			<?php foreach($option['blocks'] as $name => $title) : ?>
				<div class="block" data-type="<?php print $name; ?>">
					<div class="title"><?php print $title; ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="option">
		<div class="description"><?php _e('Drag & drop blocks to define sort order. Open blocks to choose content.', 'codeus'); ?></div>
		<div class="label"><label for=""><?php _e('Active Home Content', 'codeus'); ?></label></div>
		<div class="active-blocks">
		</div>
	</div>
</div>
<script type="text/javascript">
var default_data = <?php echo $option['default'] ? $option['default'] : '{}'; ?>;
var pages = <?php print json_encode($pages); ?>;
var slideshow_types = <?php print json_encode($slideshow_types); ?>;
var slideshows = <?php print json_encode($slideshows); ?>;
var sliders = <?php print json_encode($sliders); ?>;
var portfolios = <?php print json_encode($portfolios); ?>;
var clients_sets = <?php print json_encode($clients_sets); ?>;
var quickfinders = <?php print json_encode($quickfinders); ?>;
var news_layouts = <?php print json_encode($news_layouts); ?>;
(function($) {
	$(document).ready(function() {

		function codeus_build_block(blockData) {
			var optionWrap;
			var dataType = blockData['block_type'];
			var block = $('<div class="block block-' + dataType + '"/>');
			$('<input type="hidden" name="block_type" value="' + dataType + '"/>').appendTo(block);
			var title = $('<div class="title">' + $('#<?php print $oname; ?>-control .selectable-blocks .block[data-type="' + dataType + '"]').find('.title').text() + '</div>').appendTo(block);
			$('<a href="javascript:void(0);" class="remove"><?php _e('Remove', 'codeus'); ?></a>').appendTo(title).click(function() {
				block.remove();
			});
			var blockOptions = $('<div class="options"/>').appendTo(block);
			if(dataType == 'content') {
				$('<div class="label"><label for=""><?php _e('Select Page', 'codeus'); ?></label></div>').appendTo(blockOptions);
				optionWrap = $('<div class="select" />').appendTo(blockOptions);
				var select = $('<select name="page"/>').appendTo(optionWrap);
				for(page in pages) {
					$('<option value="' + page + '">' + pages[page] + '</option>').appendTo(select);
				}
				if(blockData['page'] !== undefined) {
					select.val(blockData['page']);
				}
			}
			if(dataType == 'slideshow') {
				$('<div class="label"><label for=""><?php _e('Select Slideshow Type', 'codeus'); ?></label></div>').appendTo(blockOptions);
				optionWrap = $('<div class="select" />').appendTo(blockOptions);
				var select = $('<select name="slideshow_type"/>').appendTo(optionWrap);
				for(sshow in slideshow_types) {
					$('<option value="' + sshow + '">' + slideshow_types[sshow] + '</option>').appendTo(select);
				}
				if(blockData['slideshow_type'] !== undefined) {
					select.val(blockData['slideshow_type']);
				}
				select.change(function() {
					$('.slider-select', optionWrap.parent()).hide();
					$('.slider-select', optionWrap.parent()).eq($(this).val()).show();
				});
				$('<div class="label"><label for=""><?php _e('Select Slideshow', 'codeus'); ?></label></div>').appendTo(blockOptions);
				optionWrap = $('<div class="select slider-select" />').appendTo(blockOptions);
				var select = $('<select name="slideshow"/>').appendTo(optionWrap);
				$('<option value="">- <?php _e('Select', 'codeus'); ?> -</option>').appendTo(select);
				for(sshow in slideshows) {
					$('<option value="' + sshow + '">' + slideshows[sshow] + '</option>').appendTo(select);
				}
				if(blockData['slideshow'] !== undefined) {
					select.val(blockData['slideshow']);
				}
				optionWrap = $('<div class="select slider-select" />').appendTo(blockOptions);
				var select = $('<select name="slider"/>').appendTo(optionWrap);
				$('<option value="">- <?php _e('Select', 'codeus'); ?> -</option>').appendTo(select);
				for(sshow in sliders) {
					$('<option value="' + sshow + '">' + sliders[sshow] + '</option>').appendTo(select);
				}
				if(blockData['slider'] !== undefined) {
					select.val(blockData['slider']);
				}
			}
			if(dataType == 'portfolio') {
				$('<div class="label"><label for=""><?php _e('Select Portfolio', 'codeus'); ?></label></div>').appendTo(blockOptions);
				optionWrap = $('<div class="select" />').appendTo(blockOptions);
				var select = $('<select name="portfolio"/>').appendTo(optionWrap);
				$('<option value="">- <?php _e('Select', 'codeus'); ?> -</option>').appendTo(select);
				for(portfolio in portfolios) {
					$('<option value="' + portfolio + '">' + portfolios[portfolio] + '</option>').appendTo(select);
				}
				if(blockData['portfolio'] !== undefined) {
					select.val(blockData['portfolio']);
				}
			}
			if(dataType == 'clients') {
				$('<div class="label"><label for=""><?php _e('Select Clients Sets', 'codeus'); ?></label></div>').appendTo(blockOptions);
				optionWrap = $('<div class="select" />').appendTo(blockOptions);
				var select = $('<select name="clients_set"/>').appendTo(optionWrap);
				$('<option value="">- <?php _e('Select', 'codeus'); ?> -</option>').appendTo(select);
				for(clients_set in clients_sets) {
					$('<option value="' + clients_set + '">' + clients_sets[clients_set] + '</option>').appendTo(select);
				}
				if(blockData['clients_set'] !== undefined) {
					select.val(blockData['clients_set']);
				}
			}
			if(dataType == 'quickfinder') {
				$('<div class="label"><label for=""><?php _e('Select Quickfinder', 'codeus'); ?></label></div>').appendTo(blockOptions);
				optionWrap = $('<div class="select" />').appendTo(blockOptions);
				var select = $('<select name="quickfinder"/>').appendTo(optionWrap);
				$('<option value="">- <?php _e('Select', 'codeus'); ?> -</option>').appendTo(select);
				for(quickfinder in quickfinders) {
					$('<option value="' + quickfinder + '">' + quickfinders[quickfinder] + '</option>').appendTo(select);
				}
				if(blockData['quickfinder'] !== undefined) {
					select.val(blockData['quickfinder']);
				}
			}
			if(dataType == 'news') {
				value = '';
				if(blockData['news_count'] !== undefined) {
					value = blockData['news_count'];
				}
				$('<div class="label"><label for=""><?php _e('News Count', 'codeus'); ?></label></div><div class="input"><input type="text" name="news_count" value="' + value + '"/></div>').appendTo(blockOptions);
				value = '';
				if(blockData['news_link'] !== undefined) {
					value = blockData['news_link'];
				}
				$('<div class="label"><label for=""><?php _e('All News Link', 'codeus'); ?></label></div><div class="input"><input type="text" name="news_link" value="' + value + '"/></div>').appendTo(blockOptions);
				$('<div class="label"><label for=""><?php _e('News Layout', 'codeus'); ?></label></div>').appendTo(blockOptions);
				optionWrap = $('<div class="select" />').appendTo(blockOptions);
				var select = $('<select name="news_layout"/>').appendTo(optionWrap);
				for(layout in news_layouts) {
					$('<option value="' + layout + '">' + news_layouts[layout] + '</option>').appendTo(select);
				}
				if(blockData['news_layout'] !== undefined) {
					select.val(blockData['news_layout']);
				}
				$('<br/>').appendTo(blockOptions);
				if(blockData['news_sidebar_header'] !== undefined) {
					value = blockData['news_sidebar_header'];
				}
				$('<div class="label"><label for=""><?php _e('Sidebar Header', 'codeus'); ?></label></div><div class="input"><input type="text" name="news_sidebar_header" value="' + value + '"/></div>').appendTo(blockOptions);
				if(blockData['news_sidebar_html'] !== undefined) {
					value = blockData['news_sidebar_html'];
				}
				$('<div class="label"><label for=""><?php _e('Sidebar Content', 'codeus'); ?></label></div><div class="textarea"><textarea cols="100" rows="15" name="news_sidebar_html">' + value + '</textarea></div>').appendTo(blockOptions);
			}
			block.appendTo($("#<?php print $oname; ?>-control .active-blocks"));
			block.accordion({
				collapsible: true,
				active: false,
				header: '.title',
				heightStyle: 'content',
				beforeActivate: function(event, ui) {
					if($(this).hasClass('sortable')) {
						$(this).removeClass('sortable');
						return false;
					}
				}
			});
			$('select', block).combobox();
		}

		function codeus_active_blocks_builder() {
			if(default_data != '') {
				var content = default_data; //JSON.parse(default_data.replace(/\'/g,'"'));
				for(i in content) {
					codeus_build_block(content[i]);
				}
			}
		}

		codeus_active_blocks_builder();

		$("#<?php print $oname; ?>-control .selectable-blocks .block").draggable({
			appendTo: 'body',
			helper: 'clone',
			start: function(event, ui) {
				$(ui.helper.get(0)).outerWidth($(ui.helper.context).outerWidth());
			}
		});

		$("#<?php print $oname; ?>-control .active-blocks").droppable({
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				var dataType = ui.draggable.attr('data-type');
				codeus_build_block({'block_type' : dataType});
			}
		}).sortable({
			items: ".block",
			update: function(event, ui) {
				ui.item.addClass('sortable');
			}
		});

		$($("#<?php print $oname; ?>").get(0).form).submit(function() {
			var build_array = new Object();
			$("#<?php print $oname; ?>-control .active-blocks .block").each(function() {
				var arr = {};
				$(':input', this).each(function() {
					arr[$(this).attr('name')] = $(this).val();
				});
				build_array[Object.keys(build_array).length] = arr;
			});
			$("#<?php print $oname; ?>").val(JSON.stringify(build_array));
		});

	});
})(jQuery);
</script>
<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

function codeus_color_skin_defaults($skin = '') {
	$skin_defaults = array(
		'main_menu_font_family' => array(
			'light' => 'Aileron Light',
			'dark' => 'Geometria Light',
		),
		'main_menu_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'main_menu_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'main_menu_font_size' => array(
			'light' => '16',
			'dark' => '15',
		),
		'main_menu_line_height' => array(
			'light' => '52',
			'dark' => '',
		),
		'submenu_font_family' => array(
			'light' => 'Aileron Light',
			'dark' => 'Geometria Light',
		),
		'submenu_font_style' => array(
			'light' => 'regular',
			'dark' => '',
		),
		'submenu_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'submenu_font_size' => array(
			'light' => '15',
			'dark' => '15',
		),
		'submenu_line_height' => array(
			'light' => '30',
			'dark' => '30',
		),
		'h1_font_family' => array(
			'light' => 'Aileron UltraLight',
			'dark' => 'Supra ThinDemiserif',
		),
		'h1_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'h1_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'h1_font_size' => array(
			'light' => '58',
			'dark' => '58',
		),
		'h1_line_height' => array(
			'light' => '70',
			'dark' => '70',
		),
		'h2_font_family' => array(
			'light' => 'Aileron UltraLight',
			'dark' => 'Supra ThinDemiserif',
		),
		'h2_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'h2_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'h2_font_size' => array(
			'light' => '36',
			'dark' => '36',
		),
		'h2_line_height' => array(
			'light' => '46',
			'dark' => '46',
		),
		'h3_font_family' => array(
			'light' => 'Aileron Thin',
			'dark' => 'Supra ThinDemiserif',
		),
		'h3_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'h3_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'h3_font_size' => array(
			'light' => '30',
			'dark' => '30',
		),
		'h3_line_height' => array(
			'light' => '38',
			'dark' => '38',
		),
		'h4_font_family' => array(
			'light' => 'Aileron Thin',
			'dark' => 'Supra ThinDemiserif',
		),
		'h4_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'h4_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'h4_font_size' => array(
			'light' => '24',
			'dark' => '24',
		),
		'h4_line_height' => array(
			'light' => '31',
			'dark' => '31',
		),
		'h5_font_family' => array(
			'light' => 'Aileron Thin',
			'dark' => 'Supra ThinDemiserif',
		),
		'h5_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'h5_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'h5_font_size' => array(
			'light' => '21',
			'dark' => '21',
		),
		'h5_line_height' => array(
			'light' => '28',
			'dark' => '28',
		),
		'h6_font_family' => array(
			'light' => 'Aileron Thin',
			'dark' => 'Supra ThinDemiserif',
		),
		'h6_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'h6_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'h6_font_size' => array(
			'light' => '19',
			'dark' => '19',
		),
		'h6_line_height' => array(
			'light' => '25',
			'dark' => '25',
		),
		'body_font_family' => array(
			'light' => 'Aileron Light',
			'dark' => 'Geometria Light',
		),
		'body_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'body_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'body_font_size' => array(
			'light' => '17',
			'dark' => '18',
		),
		'body_line_height' => array(
			'light' => '25',
			'dark' => '24',
		),
		'widget_title_font_family' => array(
			'light' => 'Aileron Thin',
			'dark' => 'Supra ThinDemiserif',
		),
		'widget_title_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'widget_title_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'widget_title_font_size' => array(
			'light' => '28',
			'dark' => '28',
		),
		'widget_title_line_height' => array(
			'light' => '40',
			'dark' => '40',
		),
		'button_font_family' => array(
			'light' => 'Aileron Thin',
			'dark' => 'Supra ThinDemiserif',
		),
		'button_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'button_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'button_font_size' => array(
			'light' => '19',
			'dark' => '19',
		),
		'button_line_height' => array(
			'light' => '19',
			'dark' => '19',
		),
		'slideshow_title_font_family' => array(
			'light' => 'Aileron UltraLight',
			'dark' => 'Supra ThinDemiserif',
		),
		'slideshow_title_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'slideshow_title_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'slideshow_title_font_size' => array(
			'light' => '65',
			'dark' => '31',
		),
		'slideshow_title_line_height' => array(
			'light' => '80',
			'dark' => '38',
		),
		'slideshow_description_font_family' => array(
			'light' => 'Aileron UltraLight',
			'dark' => 'Geometria Light',
		),
		'slideshow_description_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'slideshow_description_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'slideshow_description_font_size' => array(
			'light' => '30',
			'dark' => '15',
		),
		'slideshow_description_line_height' => array(
			'light' => '38',
			'dark' => '19',
		),
		'portfolio_title_font_family' => array(
			'light' => 'Aileron Thin',
			'dark' => 'Supra ThinDemiserif',
		),
		'portfolio_title_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'portfolio_title_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'portfolio_title_font_size' => array(
			'light' => '21',
			'dark' => '21',
		),
		'portfolio_title_line_height' => array(
			'light' => '60',
			'dark' => '60',
		),
		'portfolio_description_font_family' => array(
			'light' => 'Aileron Light',
			'dark' => 'Geometria Light',
		),
		'portfolio_description_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'portfolio_description_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'portfolio_description_font_size' => array(
			'light' => '17',
			'dark' => '17',
		),
		'portfolio_description_line_height' => array(
			'light' => '26',
			'dark' => '26',
		),
		'quickfinder_title_font_family' => array(
			'light' => 'Aileron Thin',
			'dark' => 'Supra ThinDemiserif',
		),
		'quickfinder_title_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'quickfinder_title_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'quickfinder_title_font_size' => array(
			'light' => '23',
			'dark' => '24',
		),
		'quickfinder_title_line_height' => array(
			'light' => '26',
			'dark' => '30',
		),
		'quickfinder_description_font_family' => array(
			'light' => 'Aileron Light',
			'dark' => 'Geometria Light',
		),
		'quickfinder_description_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'quickfinder_description_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'quickfinder_description_font_size' => array(
			'light' => '15',
			'dark' => '16',
		),
		'quickfinder_description_line_height' => array(
			'light' => '23',
			'dark' => '23',
		),
		'gallery_title_font_family' => array(
			'light' => 'Aileron Light',
			'dark' => 'Supra ThinDemiserif',
		),
		'gallery_title_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'gallery_title_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'gallery_title_font_size' => array(
			'light' => '21',
			'dark' => '21',
		),
		'gallery_title_line_height' => array(
			'light' => '26',
			'dark' => '26',
		),
		'gallery_description_font_family' => array(
			'light' => 'Aileron Light',
			'dark' => 'Geometria Light',
		),
		'gallery_description_font_style' => array(
			'light' => 'regular',
			'dark' => 'regular',
		),
		'gallery_description_font_sets' => array(
			'light' => '',
			'dark' => '',
		),
		'gallery_description_font_size' => array(
			'light' => '13',
			'dark' => '13',
		),
		'gallery_description_line_height' => array(
			'light' => '26',
			'dark' => '26',
		),
		'basic_outer_background_color' => array(
			'light' => '#8b94a5',
			'dark' => '#272533',
		),
		'basic_inner_background_color' => array(
			'light' => '#e8ecef',
			'dark' => '#f7f6f4',
		),
		'top_background_color' => array(
			'light' => '#ffffff',
			'dark' => '#2d2a3b',
		),
		'main_background_color' => array(
			'light' => '#ffffff',
			'dark' => '#f5f4f0',
		),
		'contact_background_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#2d2a3b',
		),
		'footer_background_color' => array(
			'light' => '#2c2e3a',
			'dark' => '#2d2a3b',
		),
		'styled_elements_background_color' => array(
			'light' => '#f0f4f7',
			'dark' => '#ffffff',
		),
		'divider_default_color' => array(
			'light' => '#d6dde3',
			'dark' => '#d0cec4',
		),
		'images_border_color' => array(
			'light' => '#d6dde3',
			'dark' => '#e0e2d7',
		),
		'main_menu_text_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#ffffff',
		),
		'main_menu_hover_text_color' => array(
			'light' => '#48afdb',
			'dark' => '#a5b753',
		),
		'main_menu_active_text_color' => array(
			'light' => '#48afdb',
			'dark' => '#a5b753',
		),
		'main_menu_active_background_color' => array(
			'light' => '',
			'dark' => '',
		),
		'submenu_text_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#3b3e4f',
		),
		'submenu_hover_text_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#3b3e4f',
		),
		'submenu_background_color' => array(
			'light' => '#ffffff',
			'dark' => '#ffffff',
		),
		'submenu_hover_background_color' => array(
			'light' => '#e8ecef',
			'dark' => '#dfeae0',
		),
		'body_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#3b3e4f',
		),
		'h1_color' => array(
			'light' => '#48afdb',
			'dark' => '#3b3e4f',
		),
		'h2_color' => array(
			'light' => '#48afdb',
			'dark' => '#3b3e4f',
		),
		'h3_color' => array(
			'light' => '#48afdb',
			'dark' => '#3b3e4f',
		),
		'h4_color' => array(
			'light' => '#48afdb',
			'dark' => '#3b3e4f',
		),
		'h5_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#3b3e4f',
		),
		'h6_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#3b3e4f',
		),
		'link_color' => array(
			'light' => '#48afdb',
			'dark' => '#7a4e71',
		),
		'hover_link_color' => array(
			'light' => '#48afdb',
			'dark' => '#7a4e71',
		),
		'active_link_color' => array(
			'light' => '#48afdb',
			'dark' => '#7a4e71',
		),
		'footer_text_color' => array(
			'light' => '#e8ecef',
			'dark' => '#e8ecef',
		),
		'copyright_text_color' => array(
			'light' => '#7b848f',
			'dark' => '#7b848f',
		),
		'copyright_link_color' => array(
			'light' => '#60dbc4',
			'dark' => '#87d890',
		),
		'portfolio_clients_bar_title_color' => array(
			'light' => '#48afdb',
			'dark' => '#2c2635',
		),
		'contact_bar_title_color' => array(
			'light' => '#48afdb',
			'dark' => '#e8ecef',
		),
		'contact_bar_text_color' => array(
			'light' => '#e8ecef',
			'dark' => '#e8ecef',
		),
		'button_text_basic_color' => array(
			'light' => '#ffffff',
			'dark' => '#ffffff',
		),
		'button_text_hover_color' => array(
			'light' => '#ffffff',
			'dark' => '#ffffff',
		),
		'button_text_active_color' => array(
			'light' => '#ffffff',
			'dark' => '#ffffff',
		),
		'button_background_basic_color' => array(
			'light' => '#48afdb',
			'dark' => '#56797f',
		),
		'button_background_hover_color' => array(
			'light' => '#558cad',
			'dark' => '#2c2635',
		),
		'button_background_active_color' => array(
			'light' => '#558cad',
			'dark' => '#2c2635',
		),
		'widget_background_color' => array(
			'light' => '',
			'dark' => '',
		),
		'widget_title_background_color' => array(
			'light' => '',
			'dark' => '',
		),
		'widget_title_color' => array(
			'light' => '#48afdb',
			'dark' => '#3b3e4f',
		),
		'widget_link_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#3b3e4f',
		),
		'widget_hover_link_color' => array(
			'light' => '#48afdb',
			'dark' => '#48afdb',
		),
		'widget_active_link_color' => array(
			'light' => '#48afdb',
			'dark' => '#48afdb',
		),
		'widgets_custom_field_color' => array(
			'light' => '#75889C',
			'dark' => '#a4a39a',
		),
		'portfolio_slider_bar_background_color' => array(
			'light' => '#e8ecef',
			'dark' => '#dfeae0',
		),
		'portfolio_slider_title_background_color' => array(
			'light' => '#ffffff',
			'dark' => '#ffffff',
		),
		'portfolio_slider_title_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#3b3e4f',
		),
		'portfolio_slider_description_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#3b3e4f',
		),
		'portfolio_slider_arrow_border_color' => array(
			'light' => '#48afdb',
			'dark' => '#56797f',
		),
		'portfolio_slider_arrow_color' => array(
			'light' => '#464959',
			'dark' => '#805878',
		),
		'portfolio_title_background_color' => array(
			'light' => '#f0f4f7',
			'dark' => '#ffffff',
		),
		'portfolio_title_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#3b3e4f',
		),
		'portfolio_description_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#3b3e4f',
		),
		'portfolio_sharing_button_background_color' => array(
			'light' => '#3a5370',
			'dark' => '#56797f',
		),
		'portfolio_date_color' => array(
			'light' => '#75889C',
			'dark' => '#a4a39a',
		),
		'gallery_caption_background_color' => array(
			'light' => '#ffffff',
			'dark' => '#ffffff',
		),
		'gallery_title_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#3b3e4f',
		),
		'gallery_description_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#3b3e4f',
		),
		'quickfinder_bar_background_color' => array(
			'light' => '#f0f4f7',
			'dark' => '#2e2a3c',
		),
		'quickfinder_bar_title_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#dadee1',
		),
		'quickfinder_bar_description_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#dadee1',
		),
		'quickfinder_title_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#3b3e4f',
		),
		'quickfinder_description_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#3b3e4f',
		),
		'bullets_symbol_color' => array(
			'light' => '#48afdb',
			'dark' => '#a5b753',
		),
		'dropcap_border_color' => array(
			'light' => '#48afdb',
			'dark' => '#a5b753',
		),
		'dropcap_background_color' => array(
			'light' => '',
			'dark' => '',
		),
		'dropcaps_symbol_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#3b3e4f',
		),
		'icons_background_color' => array(
			'light' => '',
			'dark' => '',
		),
		'icons_symbol_color' => array(
			'light' => '#d6dde3',
			'dark' => '#d0cec4',
		),
		'icons_border_color' => array(
			'light' => '',
			'dark' => '',
		),
		'pager_border_color' => array(
			'light' => '#48afdb',
			'dark' => '#7a4e71',
		),
		'pager_text_color' => array(
			'light' => '#3b3e4f',
			'dark' => '#3b3e4f',
		),
		'pager_active_text_color' => array(
			'light' => '#ffffff',
			'dark' => '#ffffff',
		),
		'slideshow_arrow_border_color' => array(
			'light' => '#ffffff',
			'dark' => '#ffffff',
		),
		'slideshow_arrow_color' => array(
			'light' => '#48afdb',
			'dark' => '#87d890',
		),
		'form_elements_background_color' => array(
			'light' => '#ffffff',
			'dark' => '#ffffff',
		),
		'form_elements_text_color' => array(
			'light' => '#99a2a9',
			'dark' => '#99a2a9',
		),
		'basic_outer_background_image' => array(
			'light' => '',
			'dark' => '',
		),
		'basic_inner_background_image' => array(
			'light' => '',
			'dark' => '',
		),
		'header_pattern_image' => array(
			'light' => '',
			'dark' => '',
		),
		'top_background_image' => array(
			'light' => '',
			'dark' => '',
		),
		'main_background_image' => array(
			'light' => '',
			'dark' => '',
		),
		'contact_background_image' => array(
			'light' => '',
			'dark' => '',
		),
		'footer_background_image' => array(
			'light' => '',
			'dark' => '',
		),
		'portfolio_bar_background_image' => array(
			'light' => '',
			'dark' => '',
		),
		'quickfinder_bar_background_image' => array(
			'light' => '',
			'dark' => '',
		),
	);
	if($skin) {
		return $skin_defaults['$skin'];
	}
	return $skin_defaults;
}

function codeus_first_install_settings() {
	return array(
		'page_color_style' => 'light',
		'page_layout_style' => 'fullwidth',
		'logo' => get_template_directory_uri() . '/images/default-logo.png',
		'small_logo' => get_template_directory_uri() . '/images/default-logo-fixed.png',
		'logo_position' => 'left',
		'favicon' => get_template_directory_uri() . '/images/favicon.ico',
		'custom_css' => '',
		'ga_code' => '',
		'google_fonts_file' => '',
		'main_menu_font_family' => 'Aileron Light',
		'main_menu_font_style' => 'regular',
		'main_menu_font_sets' => '',
		'main_menu_font_size' => '16',
		'main_menu_line_height' => '52',
		'submenu_font_family' => 'Aileron Light',
		'submenu_font_style' => 'regular',
		'submenu_font_sets' => '',
		'submenu_font_size' => '15',
		'submenu_line_height' => '30',
		'h1_font_family' => 'Aileron UltraLight',
		'h1_font_style' => 'regular',
		'h1_font_sets' => '',
		'h1_font_size' => '58',
		'h1_line_height' => '70',
		'h2_font_family' => 'Aileron UltraLight',
		'h2_font_style' => 'regular',
		'h2_font_sets' => '',
		'h2_font_size' => '36',
		'h2_line_height' => '46',
		'h3_font_family' => 'Aileron Thin',
		'h3_font_style' => 'regular',
		'h3_font_sets' => '',
		'h3_font_size' => '30',
		'h3_line_height' => '38',
		'h4_font_family' => 'Aileron Thin',
		'h4_font_style' => 'regular',
		'h4_font_sets' => '',
		'h4_font_size' => '24',
		'h4_line_height' => '31',
		'h5_font_family' => 'Aileron Thin',
		'h5_font_style' => 'regular',
		'h5_font_sets' => '',
		'h5_font_size' => '21',
		'h5_line_height' => '28',
		'h6_font_family' => 'Aileron Thin',
		'h6_font_style' => 'regular',
		'h6_font_sets' => '',
		'h6_font_size' => '19',
		'h6_line_height' => '25',
		'body_font_family' => 'Aileron Light',
		'body_font_style' => 'regular',
		'body_font_sets' => '',
		'body_font_size' => '17',
		'body_line_height' => '25',
		'widget_title_font_family' => 'Aileron Thin',
		'widget_title_font_style' => 'regular',
		'widget_title_font_sets' => '',
		'widget_title_font_size' => '28',
		'widget_title_line_height' => '40',
		'button_font_family' => 'Aileron Thin',
		'button_font_style' => 'regular',
		'button_font_sets' => '',
		'button_font_size' => '19',
		'button_line_height' => '19',
		'slideshow_title_font_family' => 'Aileron UltraLight',
		'slideshow_title_font_style' => 'regular',
		'slideshow_title_font_sets' => '',
		'slideshow_title_font_size' => '65',
		'slideshow_title_line_height' => '80',
		'slideshow_description_font_family' => 'Aileron UltraLight',
		'slideshow_description_font_style' => 'regular',
		'slideshow_description_font_sets' => '',
		'slideshow_description_font_size' => '30',
		'slideshow_description_line_height' => '38',
		'portfolio_title_font_family' => 'Aileron Thin',
		'portfolio_title_font_style' => 'regular',
		'portfolio_title_font_sets' => '',
		'portfolio_title_font_size' => '21',
		'portfolio_title_line_height' => '60',
		'portfolio_description_font_family' => 'Aileron Light',
		'portfolio_description_font_style' => 'regular',
		'portfolio_description_font_sets' => '',
		'portfolio_description_font_size' => '17',
		'portfolio_description_line_height' => '26',
		'quickfinder_title_font_family' => 'Aileron Thin',
		'quickfinder_title_font_style' => 'regular',
		'quickfinder_title_font_sets' => '',
		'quickfinder_title_font_size' => '23',
		'quickfinder_title_line_height' => '26',
		'quickfinder_description_font_family' => 'Aileron Light',
		'quickfinder_description_font_style' => 'regular',
		'quickfinder_description_font_sets' => '',
		'quickfinder_description_font_size' => '15',
		'quickfinder_description_line_height' => '23',
		'gallery_title_font_family' => 'Aileron Light',
		'gallery_title_font_style' => 'regular',
		'gallery_title_font_sets' => '',
		'gallery_title_font_size' => '21',
		'gallery_title_line_height' => '26',
		'gallery_description_font_family' => 'Aileron Light',
		'gallery_description_font_style' => 'regular',
		'gallery_description_font_sets' => '',
		'gallery_description_font_size' => '13',
		'gallery_description_line_height' => '26',
		'basic_outer_background_color' => '#8b94a5',
		'basic_inner_background_color' => '#E8ECEF',
		'top_background_color' => '#ffffff',
		'main_background_color' => '#ffffff',
		'contact_background_color' => '#3b3e4f',
		'footer_background_color' => '#2c2e3a',
		'styled_elements_background_color' => '#f0f4f7',
		'divider_default_color' => '#d6dde3',
		'images_border_color' => '#d6dde3',
		'main_menu_text_color' => '#3b3e4f',
		'main_menu_hover_text_color' => '#48afdb',
		'main_menu_active_text_color' => '#48afdb',
		'main_menu_active_background_color' => '',
		'submenu_text_color' => '#3b3e4f',
		'submenu_hover_text_color' => '#3b3e4f',
		'submenu_background_color' => '#ffffff',
		'submenu_hover_background_color' => '#e8ecef',
		'body_color' => '#3b3e4f',
		'h1_color' => '#48afdb',
		'h2_color' => '#48afdb',
		'h3_color' => '#48afdb',
		'h4_color' => '#48afdb',
		'h5_color' => '#3b3e4f',
		'h6_color' => '#3b3e4f',
		'link_color' => '#48afdb',
		'hover_link_color' => '#48afdb',
		'active_link_color' => '#48afdb',
		'footer_text_color' => '#e8ecef',
		'copyright_text_color' => '#7b848f',
		'copyright_link_color' => '#60dbc4',
		'portfolio_clients_bar_title_color' => '#48afdb',
		'contact_bar_title_color' => '#48afdb',
		'contact_bar_text_color' => '#e8ecef',
		'button_text_basic_color' => '#ffffff',
		'button_text_hover_color' => '#ffffff',
		'button_text_active_color' => '#ffffff',
		'button_background_basic_color' => '#48afdb',
		'button_background_hover_color' => '#558cad',
		'button_background_active_color' => '#558cad',
		'widget_background_color' => '',
		'widget_title_background_color' => '',
		'widget_title_color' => '#48afdb',
		'widget_link_color' => '#3b3e4f',
		'widget_hover_link_color' => '#48afdb',
		'widget_active_link_color' => '#48afdb',
		'widgets_custom_field_color' => '#75889C',
		'portfolio_slider_bar_background_color' => '#e8ecef',
		'portfolio_slider_title_background_color' => '#ffffff',
		'portfolio_slider_title_color' => '#3b3e4f',
		'portfolio_slider_description_color' => '#3b3e4f',
		'portfolio_slider_arrow_border_color' => '#48afdb',
		'portfolio_slider_arrow_color' => '#464959',
		'portfolio_title_background_color' => '#f0f4f7',
		'portfolio_title_color' => '#3b3e4f',
		'portfolio_description_color' => '#3b3e4f',
		'portfolio_sharing_button_background_color' => '#3a5370',
		'portfolio_date_color' => '#75889C',
		'gallery_caption_background_color' => '#ffffff',
		'gallery_title_color' => '#3b3e4f',
		'gallery_description_color' => '#3b3e4f',
		'quickfinder_bar_background_color' => '#f0f4f7',
		'quickfinder_bar_title_color' => '#3b3e4f',
		'quickfinder_bar_description_color' => '#3b3e4f',
		'quickfinder_title_color' => '#3b3e4f',
		'quickfinder_description_color' => '#3b3e4f',
		'bullets_symbol_color' => '#48afdb',
		'dropcap_border_color' => '#48afdb',
		'dropcap_background_color' => '',
		'dropcaps_symbol_color' => '#3b3e4f',
		'icons_background_color' => '',
		'icons_symbol_color' => '#d6dde3',
		'icons_border_color' => '',
		'pager_border_color' => '#48afdb',
		'pager_text_color' => '#3b3e4f',
		'pager_active_text_color' => '#ffffff',
		'slideshow_arrow_border_color' => '#ffffff',
		'slideshow_arrow_color' => '#48afdb',
		'form_elements_background_color' => '#ffffff',
		'form_elements_text_color' => '#99a2a9',
		'basic_outer_background_image' => '',
		'basic_inner_background_image' => '',
		'header_pattern_image' => '',
		'top_background_image' => '',
		'main_background_image' => '',
		'contact_background_image' => '',
		'footer_background_image' => '',
		'portfolio_bar_background_image' => '',
		'quickfinder_bar_background_image' => '',
		'home_effects_enabled' => '1',
		'home_content' => '',
		'slider_effect' => 'random',
		'slider_slices' => '15',
		'slider_boxCols' => '8',
		'slider_boxRows' => '4',
		'slider_animSpeed' => '5',
		'slider_pauseTime' => '20',
		'slider_directionNav' => '1',
		'slider_controlNav' => '1',
		'show_author' => '1',
		'post_per_page' => '5',
		'excerpt_length' => '20',
		'footer_active' => '1',
		'footer_html' => '2013 &copy; Made by <a href="#">Codex Themes</a>',
		'follow_contacts_active' => '1',
		'contacts_title' => '',
		'contacts_html' => '19th Ave Sacramento<br />CA 95822, USA<br />Phone: +1 916-875-2235<br />Fax: +1 916-875-0000<br />Email: <a href="#">info@domain.tld</a>',
		'admin_email' => '',
		'contacts_display_map' => '1',
		'contacts_map_height' => '450',
		'contacts_map_latitude' => '38.53460',
		'contacts_map_longitude' => '-121.48744',
		'contacts_map_zoom' => '12',
		'follow_title' => '',
		'follow_us_text' => 'Phosfluorescently engage worldwide with web-enabled technology e-commerce!',
		'twitter_active' => '1',
		'facebook_active' => '1',
		'linkedin_active' => '1',
		'googleplus_active' => '1',
		'stumbleupon_active' => '1',
		'rss_active' => '1',
		'twitter_link' => '#',
		'facebook_link' => '#',
		'linkedin_link' => '#',
		'googleplus_link' => '#',
		'stumbleupon_link' => '#',
		'rss_link' => '#',
		'show_social_icons' => '1',
	);
}

?>