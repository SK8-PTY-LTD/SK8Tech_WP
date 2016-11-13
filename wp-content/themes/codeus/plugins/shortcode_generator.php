<?php

/*
	Begin Create Shortcode Generator Options
*/

add_action('add_meta_boxes', 'codeus_shortcode_generator');

function codeus_shortcode_generator() {
		add_meta_box( 'shortcode_metabox', 'Shortcode Options', 'codeus_shortcode_generator_options', 'page', 'side', 'default' );
		add_meta_box( 'shortcode_metabox', 'Shortcode Options', 'codeus_shortcode_generator_options', 'post', 'side', 'default' );
		add_meta_box( 'shortcode_metabox', 'Shortcode Options', 'codeus_shortcode_generator_options', 'codeus_portfolios', 'side', 'default' );
}

function codeus_shortcode_generator_options() {

  	$plugin_url = get_template_directory_uri().'/plugins/shortcode_generator';

  	$args = array(
	    'numberposts' => -1,
	    'post_type' => array('codeus_gallery'),
	    'suppress_filters' => false
	);

	$galleries_arr = get_posts($args);
	$galleries_select = array();
	$galleries_select[''] = '';

	foreach($galleries_arr as $gallery)
	{
		$galleries_select[$gallery->ID] = $gallery->post_title;
	}

	//Begin shortcode array
	$shortcodes = array(
		'vc_column_text' => array(
			'title' => __('VC Text Container', 'codeus'),
			'attr' => array(),
			'content' => FALSE,
		),
		'accordion' => array(
			'title' => __('Accordion', 'codeus'),
			'attr' => array(
				'title' => 'text',
				'closed' => 'select',
			),
			'content' => TRUE,
			'options_closed' =>array(
				'0' => __('No', 'codeus'),
				'1' => __('Yes', 'codeus'),
			),
		),
		'alert_box' => array(
			'title' => __('Alert Box', 'codeus'),
			'attr' => array(
				'title' => 'text',
				'button_text' => 'text',
				'button_link' => 'text',
				'button_background_color' => 'color',
				'icon' => 'icon',
				'icon_border_color' => 'color',
				'icon_background_color' => 'color',
				'icon_color' => 'color',
			),
			'desc' => array(),
			'label' => array(
				'icon_border_color' => __('Icon Border Color', 'codeus'),
				'icon_background_color ' => __('Icon Background Color', 'codeus'),
				'icon_color' => __('Icon Font Color', 'codeus'),
			),
			'content' => TRUE,
		),
		'button' => array(
			'title' => __('Button', 'codeus'),
			'attr' => array(
				'link' => 'text',
				'text' => 'text',
				'title' => 'text',
				'target' => 'text',
				'bgcolor' => 'color',
			),
			'desc' => array(
				'title' => __('Value for title attribute', 'codeus'),
				'target' => __('Value for target attribute', 'codeus'),
			),
			'content' => FALSE,
		),
		'clients' => array(
			'title' => __('Clients', 'codeus'),
			'attr' => array(
				'clientsset' => 'text',
				'title' => 'text',
				'filter_disabled'=>'checkbox'
			),
			'desc' => array(
				'clientsset' => __('Choose a set by entering clients set slug', 'codeus'),
			),
			'label' => array(
				'clientsset' => __('Clients Set Slug', 'codeus'),
				'filter_disabled' => __('Filter disabled', 'codeus'),
			),
			'content' => FALSE,
		),
		'divider' => array(
			'title' => __('Divider', 'codeus'),
			'attr' => array(
				'type' => 'select',
				'color' => 'color'
			),
			'options_type' => array(
				'' => 'Solid',
				'linebreak' => 'Line Break',
				'dashed' => 'Dashed',
				'double ' => 'Double',
			),
			'desc' => array(),
			'content' => FALSE,
		),
		'dropcap' => array(
			'title' => __('Dropcap', 'codeus'),
			'attr' => array(
				'border_color' => 'color',
				'background_color' => 'color',
				'text_color' => 'color',
			),
			'desc' => array(),
			'content' => TRUE,
			'label' => array(
				'border_color' => __('Border Color', 'codeus'),
				'background_color' => __('Background Color', 'codeus'),
				'text_color' => __('Font Color', 'codeus'),
			),
		),
		'one_fourth' => array(
			'title' => __('Four Columns', 'codeus'),
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 3,
		),
		'gallery' => array(
			'title' => __('Gallery', 'codeus'),
			'attr' => array(
				'gallery_id' => 'text',
				'gallery_size' => 'select',
				'text_alignment'=>'select',
				'title' => 'text',
				'style' => 'select',
			),
			'desc' => array(),
			'content' => FALSE,
			'options_gallery_size' =>array(
				0 => __('For Full-Width Pages', 'codeus'),
				1 => __('For Sidebar Pages', 'codeus'),
				2 => __('Small Thumbs', 'codeus'),
				3 => __('Medium Thumbs', 'codeus')
			),
			'options_text_alignment' =>array(
				'left' => __('Left', 'codeus'),
				'right' => __('Right', 'codeus'),
				'below' => __('Below', 'codeus')
			),
			'label'=>array(
				'gallery_id'=>__('Gallery Post ID', 'codeus'),
				'gallery_size'=>__('Gallery type', 'codeus'),
				'text_alignment'=>__('Page Text Alignment', 'codeus'),
			),
			'desc'=>array(
				'gallery_id'=>__('Enter the gallery ID', 'codeus'),
				'gallery_size'=>__('Choose the gallery type', 'codeus'),
			),
			'options_style' =>array(
				'no-style' => __('without border', 'codeus'),
				'style-1' => __('1px no margin', 'codeus'),
				'style-2' => __('dark gray', 'codeus'),
				'style-3' => __('light gray', 'codeus'),
				'style-4' => __('shadow', 'codeus'),
				'style-5' => __('shadowed border', 'codeus'),
				'style-6' => __('1px with margin', 'codeus')
			)
		),
		'diagram' => array(
			'title' => __('Diagram', 'codeus'),
			'attr' => array(
				'title' => 'text',
				'summary' => 'textarea',
				'type' => 'select',
			),
			'content' => TRUE,
			'options_type' =>array(
				'circle' => __('Circle', 'codeus'),
				'line' => __('Lines', 'codeus')
			),
			'default' => '[skill title="Skill1" amount="70" color="#ff0000"]'."\n".
						 '[skill title="Skill2" amount="70" color="#ffff00"]'."\n".
						 '[skill title="Skill3" amount="70" color="#ff00ff"]'."\n".
						 '[skill title="Skill4" amount="70" color="#f0f0f0"]'
		),
		'map' => array(
			'title' => __('Google Maps', 'codeus'),
			'attr' => array(
				'width' => 'text',
				'height' => 'text',
				'lat' => 'text',
				'long' => 'text',
				'zoom' => 'text',
				'style' => 'select',
				'position' => 'select'
			),
			'desc' => array(
				'width' => __('Map width in pixels', 'codeus'),
				'height' => __('Map height in pixels', 'codeus'),
				'lat' => sprintf(__('Map latitude <a href="%s">Find here</a>', 'codeus'), 'http://universimmedia.pagesperso-orange.fr/geo/loc.htm'),
				'long' => sprintf(__('Map longitude <a href="%s">Find here</a>', 'codeus'), 'http://universimmedia.pagesperso-orange.fr/geo/loc.htm'),
				'zoom' => __('Enter zoom number (1-16)', 'codeus'),
			),
			'content' => FALSE,
			'options_position' =>array(
				'middle' => __('Middle', 'codeus'),
				'left' => __('Left', 'codeus'),
				'right' => __('Right', 'codeus'),
			),
			'options_style' =>array(
				'no-style' => __('without border', 'codeus'),
				'style-1' => __('1px no margin', 'codeus'),
				'style-2' => __('dark gray', 'codeus'),
				'style-3' => __('light gray', 'codeus'),
				'style-4' => __('shadow', 'codeus'),
				'style-5' => __('shadowed border', 'codeus'),
				'style-6' => __('1px with margin', 'codeus')
			)
		),
		'icon' => array(
			'title' => __('Icon', 'codeus'),
			'attr' => array(
				'icon' => 'icon',
				'icon_border_color' => 'color',
				'icon_background_color' => 'color',
				'icon_color' => 'color',
			),
			'desc' => array(),
			'content' => TRUE,
			'label'=>array(
				'icon_border_color' => __('Icon Border Color', 'codeus'),
				'icon_background_color ' => __('Icon Background Color', 'codeus'),
				'icon_color' => __('Icon Font Color', 'codeus'),
			),
		),
		'icon_with_text' => array(
			'title' => __('Icon With Text', 'codeus'),
			'attr' => array(
				'icon' => 'icon',
				'title' => 'text',
				'icon_border_color' => 'color',
				'icon_background_color' => 'color',
				'icon_color' => 'color',
				'level' => 'select'
			),
			'options_level' =>array(
				'' => __('Default ( h5 )', 'codeus'),
				'h1' => 'h1',
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h6' => 'h6',
			),
			'desc' => array(),
			'content' => TRUE,
			'label'=>array(
				'icon_border_color' => __('Icon Border Color', 'codeus'),
				'icon_background_color ' => __('Icon Background Color', 'codeus'),
				'icon_color' => __('Icon Font Color', 'codeus'),
			),
		),
		'news' => array(
			'title' => __('News', 'codeus'),
			'attr' => array(
				'items_per_page' => 'text',
			),
			'label' => array(
				'items_per_page' => __('Items per page', 'codeus'),
			),
			'content' => FALSE,
		),
		'portfolio' => array(
			'title' => __('Portfolio', 'codeus'),
			'attr' => array(
				'portfolioset' => 'text',
				'thumb_size' => 'select',
				'items_per_page' => 'text',
				'title' => 'text'
			),
			'desc' => array(
				'portfolioset' => __('Choose a set by entering portfolio set slug', 'codeus'),
			),
			'label' => array(
				'portfolioset' => __('Portfolio Set Slug', 'codeus'),
				'items_per_page' => __('Items per page', 'codeus'),
				'thumb_size' => __('Thumbnail size', 'codeus'),
			),
			'content' => FALSE,
			'options_thumb_size' =>array(
				'small' => __('Small Thumbs (222 x 177)', 'codeus'),
				'medium' => __('Medium Thumbs (302 x 207)', 'codeus'),
				'big' => __('Big Thumbs (464 x 306)', 'codeus'),
				'list' => __('One column list', 'codeus')
			),
		),
		'pricing_table' => array(
			'title' => __('Pricing Table', 'codeus'),
			'attr' => array(
				'style' => 'select',
				'columns' => 'select',
				'price_font_size' => 'text',
				'price_font_color' => 'color',
				'button_icon' => 'select'
			),
			'label'=>array(
				'columns'=>__("Column's count", 'codeus'),
				'price_font_size'=>__('Price font size', 'codeus'),
				'price_font_color'=>__('Price font color', 'codeus'),
				'button_icon'=>__('Button Icontype', 'codeus')
			),
			'desc' => array(
				'price_font_size' => __('in px, leave empty to use default', 'codeus'),
				'price_font_color' => __('leave empty to use default', 'codeus'),
			),
			'content' => FALSE,
			'options_style' =>array(
				'1' => __('Style 1', 'codeus'),
				'2' => __('Style 2', 'codeus'),
				'3' => __('Style 3', 'codeus'),
			),
			'options_columns' =>array(
				'3' => __('Three columns', 'codeus'),
				'4' => __('Four columns', 'codeus'),
			),
			'options_button_icon' =>array(
				'none' => __('None', 'codeus'),
				'arrow' => __('Arrow', 'codeus'),
				'cart' => __('Cart', 'codeus'),
			),
			'hidden_content' => "\n[pricing_column title=\"Column title\" %COLUMN_ADDITIONAL_ATTRIBUTES%]\n[pricing_price currency=\"$\" price=\"9.99\" time=\"Per Month\" %COLUMN_PRICE_ADDITIONAL_ATTRIBUTES%][/pricing_price]\n[pricing_row %COLUMN_ROW_ADDITIONAL_ATTRIBUTES%]Feature 1[/pricing_row]\n[pricing_footer href=\"#\"]Order[/pricing_footer]\n[/pricing_column]"
		),
		'quickfinder' => array(
			'title' => __('Quickfinder', 'codeus'),
			'attr' => array(
				'quickfinderset' => 'text',
				'title' => 'text'
			),
			'desc' => array(
				'quickfinderset' => __('Choose a set by entering quickfinder set slug', 'codeus'),
			),
			'label' => array(
				'quickfinderset' => __('Quickfinder Set Slug', 'codeus'),
			),
			'content' => FALSE,
		),
		'quote' => array(
			'title' => __('Quoted Text', 'codeus'),
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'video' => array(
			'title' => __('Self-hosted Video', 'codeus'),
			'attr' => array(
				'width' => 'text',
				'height' => 'text',
				'video_src' => 'video',
				'image_src' => 'picture',
				'style' => 'select',
				'position' => 'select'
			),
			'desc' => array(
				'width' => __('Video width in pixels', 'codeus'),
				'height' => __('Video height in pixels', 'codeus'),
				'video_src' => __('Video URL in mp4 or flv format', 'codeus'),
			),
			'content' => FALSE,
			'options_position' =>array(
				'middle' => __('Middle', 'codeus'),
				'left' => __('Left', 'codeus'),
				'right' => __('Right', 'codeus'),
			),
			'options_style' =>array(
				'no-style' => __('without border', 'codeus'),
				'style-1' => __('1px no margin', 'codeus'),
				'style-2' => __('dark gray', 'codeus'),
				'style-3' => __('light gray', 'codeus'),
				'style-4' => __('shadow', 'codeus'),
				'style-5' => __('shadowed border', 'codeus'),
				'style-6' => __('1px with margin', 'codeus')
			)
		),
		'image' => array(
			'title' => __('Styled Image', 'codeus'),
			'attr' => array(
				'width' => 'text',
				'height' => 'text',
				'src' => 'picture',
				'alt' => 'text',
				'style' => 'select',
				'position' => 'select',
				'lightbox'=>'checkbox',
			),
			'label'=>array(
				'lightbox'=>__('Show lightbox with full-size image'),
				'position' =>__('Page Text Alignment'),
				'src' => __('Choose Image', 'codeus'),
			),
			'desc' => array(
				'width' => __('Image width in pixels', 'codeus'),
				'height' => __('Image height in pixels', 'codeus'),
				'src' => __('Enter image URL', 'codeus'),
				'alt' => __('Enter image Alt-text', 'codeus'),
			),
			'content' => FALSE,
			'options_position' =>array(
				'below' => __('Below', 'codeus'),
				'left' => __('Left', 'codeus'),
				'right' => __('Right', 'codeus'),
			),
			'options_style' =>array(
				'no-style' => __('without border', 'codeus'),
				'style-1' => __('1px no margin', 'codeus'),
				'style-2' => __('dark gray', 'codeus'),
				'style-3' => __('light gray', 'codeus'),
				'style-4' => __('shadow', 'codeus'),
				'style-5' => __('shadowed border', 'codeus'),
				'style-6' => __('1px with margin', 'codeus')
			),
		),
		'list' => array(
			'title' => __('Styled List', 'codeus'),
			'attr' => array(
				'type' => 'select'
			),
			'desc' => array(),
			'content' => TRUE,
			'options_type' =>array(
				'circle' => __('circle', 'codeus'),
				'check' => __('check', 'codeus'),
				'arrow' => __('arrow', 'codeus'),
				'minus' => __('minus', 'codeus')
			),
			'default' => '<ul class="styled">'."\n".'<li>'.__('Element 1', 'codeus').'</li>'."\n".'<li>'.__('Element 2', 'codeus').'</li>'."\n".'<li>'.__('Element 3', 'codeus').'</li>'."\n".'</ul>'
		),
		'table' => array(
			'title' => __('Styled Table', 'codeus'),
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'default' => '<table style="width: 100%;">'."\n".
				'<thead><tr><th>'.__('Title 1', 'codeus').'</th><th>'.__('Title 2', 'codeus').'</th><th>'.__('Title 3', 'codeus').'</th></tr></thead>'."\n".
				'<tbody>'."\n".
				'<tr><th>'.__('Content 1 1', 'codeus').'</th><td>'.__('Content 1 2', 'codeus').'</td><td>'.__('Content 1 3', 'codeus').'</td></tr>'."\n".
				'<tr><th>'.__('Content 2 1', 'codeus').'</th><td>'.__('Content 2 2', 'codeus').'</td><td>'.__('Content 2 3', 'codeus').'</td></tr>'."\n".
				'<tr><th>'.__('Content 3 1', 'codeus').'</th><td>'.__('Content 3 2', 'codeus').'</td><td>'.__('Content 3 3', 'codeus').'</td></tr>'."\n".
				'</tbody></table>',
		),
		'text_box' => array(
			'title' => __('Styled Textbox', 'codeus'),
			'attr' => array(
				'title' => 'text',
				'title_background_color' => 'color',
				'title_text_color' => 'color',
				'content_background_color' => 'color',
				'content_text_color' => 'color',
				'border_color' => 'color',
			),
			'desc' => array(
				'title_background_color' => __('Choose or enter color code, ex. #ffffff', 'codeus'),
				'title_text_color' => __('Choose or enter color code, ex. #ffffff', 'codeus'),
				'content_background_color' => __('Choose or enter color code, ex. #ffffff', 'codeus'),
				'content_text_color' => __('Choose or enter color code, ex. #ffffff', 'codeus'),
				'border_color' => __('Choose or enter color code, ex. #ffffff', 'codeus'),
			),
			'label' => array(
				'title_background_color' => __('Title Background Color', 'codeus'),
				'title_text_color' => __('Title Text Color', 'codeus'),
				'content_background_color' => __('Content Background Color', 'codeus'),
				'content_text_color' => __('Content Text Color', 'codeus'),
				'border_color' => __('Border Color', 'codeus'),
			),
			'content' => TRUE,
			'content_text' => __('Enter content (can be normal text, HTML code or shortcode)', 'codeus'),
		),
		'tabs' => array(
			'title' => __('Tabs', 'codeus'),
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'default' => '[tabs tab1="title 1" tab2="title 2" tab3="title 3"]'."\n".
				'[tab id="1"]'.__('Content 1', 'codeus').'[/tab]'."\n".
				'[tab id="2"]'.__('Content 2', 'codeus').'[/tab]'."\n".
				'[tab id="3"]'.__('Content 3', 'codeus').'[/tab]'."\n".
				'[/tabs]'
		),
		'team' => array(
			'title' => __('Team', 'codeus'),
			'attr' => array(
				'teamsets' => 'text',
				'title' => 'text'
			),
			'desc' => array(),
			'content' => FALSE,
			'label'=>array(
				'teamsets'=>__('Team\'s Set', 'codeus'),
				'title'=>__('Title', 'codeus')
			),
			'desc'=>array(
				'teamsets'=>__('Enter slug of team\'s set', 'codeus'),
				'title'=>__('Enter title of team\'s block', 'codeus'),
			),
		),
		'one_third' => array(
			'title' => __('Three Columns', 'codeus'),
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 2,
		),
		'iconed_title' => array(
			'title' => __('Title With Icon', 'codeus'),
			'attr' => array(
				'icon' => 'icon',
				'isactive' => 'checkbox',
				'title' => 'text',
				'level' => 'select'
			),
			'desc' => array(),
			'content' => FALSE,
			'options_level' =>array(
				'' => __('Default ( h5 )', 'codeus'),
				'h1' => 'h1',
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h6' => 'h6',
			),
			'label'=>array(
				'isactive'=>__('Active', 'codeus'),
			),
		),
		'one_half' => array(
			'title' => __('Two Columns', 'codeus'),
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 1,
		),
		'youtube' => array(
			'title' => __('Youtube Video', 'codeus'),
			'attr' => array(
				'width' => 'text',
				'height' => 'text',
				'video_id' => 'text',
				'style' => 'select',
				'position' => 'select',
			),
			'desc' => array(
				'width' => __('Video width in pixels', 'codeus'),
				'height' => __('Video height in pixels', 'codeus'),
				'video_id' => __('Youtube video ID something like Js9Z8UQAA4E', 'codeus'),
			),
			'content' => FALSE,
			'options_position' =>array(
				'middle' => __('Middle', 'codeus'),
				'left' => __('Left', 'codeus'),
				'right' => __('Right', 'codeus'),
			),
			'options_style' =>array(
				'no-style' => __('without border', 'codeus'),
				'style-1' => __('1px no margin', 'codeus'),
				'style-2' => __('dark gray', 'codeus'),
				'style-3' => __('light gray', 'codeus'),
				'style-4' => __('shadow', 'codeus'),
				'style-5' => __('shadowed border', 'codeus'),
				'style-6' => __('1px with margin', 'codeus')
			)
		),
		'vimeo' => array(
			'title' => __('Vimeo Video', 'codeus'),
			'attr' => array(
				'width' => 'text',
				'height' => 'text',
				'video_id' => 'text',
				'style' => 'select',
				'position' => 'select'
			),
			'desc' => array(
				'width' => __('Video width in pixels', 'codeus'),
				'height' => __('Video height in pixels', 'codeus'),
				'video_id' => __('Vimeo video ID something like 9380243', 'codeus'),
			),
			'content' => FALSE,
			'options_position' =>array(
				'middle' => __('Middle', 'codeus'),
				'left' => __('Left', 'codeus'),
				'right' => __('Right', 'codeus'),
			),
			'options_style' =>array(
				'no-style' => __('without border', 'codeus'),
				'style-1' => __('1px no margin', 'codeus'),
				'style-2' => __('dark gray', 'codeus'),
				'style-3' => __('light gray', 'codeus'),
				'style-4' => __('shadow', 'codeus'),
				'style-5' => __('shadowed border', 'codeus'),
				'style-6' => __('1px with margin', 'codeus')
			)
		),
	);
?>
<script>
jQuery(document).ready(function(){
	jQuery('#shortcode_select').change(function() {
  		var target = jQuery(this).val();
  		jQuery('.rm_section').hide()
  		jQuery('#div_'+target).fadeIn()
	}).trigger('change');

	jQuery('.code_area').click(function() {
		document.getElementById(jQuery(this).attr('id')).focus();
    	document.getElementById(jQuery(this).attr('id')).select();
	});

	jQuery('.shortcode-button').click(function() {
		var target = jQuery(this).attr('id');
		var gen_shortcode = '';
  		gen_shortcode+= '['+target;

  		var attrs = {};
		if(jQuery('#'+target+'_attr_wrapper .attr').length > 0)
  		{
  			jQuery('#'+target+'_attr_wrapper .attr').each(function() {
  			if ((jQuery(this).is(':checkbox') && jQuery(this).is(':checked')) || ( !jQuery(this).is(':checkbox') && jQuery(this).val() != '') ) {
					attrs[jQuery(this).attr('name')] = jQuery(this).val();
					if (target == 'pricing_table' && (jQuery(this).attr('name') == 'price_font_size' || jQuery(this).attr('name') == 'price_font_color' || jQuery(this).attr('name') == 'columns')) {
						return;
					}
					gen_shortcode+= ' '+jQuery(this).attr('name')+'="'+jQuery(this).val()+'"';
				}
			});
		}

		gen_shortcode+= ']';

		if(jQuery('#'+target+'_content').length > 0)
  		{
  			gen_shortcode+= jQuery('#'+target+'_content').val()+'[/'+target+']';

  			var repeat = jQuery('#'+target+'_content_repeat').val();
  			for (count=1;count<=repeat;count=count+1)
			{
				if(count<repeat)
				{
					gen_shortcode+= '['+target+']';
					gen_shortcode+= jQuery('#'+target+'_content').val()+'[/'+target+']';
				}
				else
				{
					gen_shortcode+= '['+target+'_last]';
					gen_shortcode+= jQuery('#'+target+'_content').val()+'[/'+target+'_last]';
				}
			}
  		}
  		if(target == 'tabs') {
  			gen_shortcode = jQuery('#'+target+'_content').val();
  		}
		if (target == 'pricing_table') {
			var hidden_content = jQuery('#'+target+'_hidden_content').val();
			var repeat_count = attrs['columns'] || 0;
			for (var i=0; i < repeat_count; i++) {
				var col_add_attrs = '';
				var col_price_add_attrs = '';
				var col_row_add_attrs = '';
				if (i == 1)
					col_add_attrs += 'highlighted="1" subtitle="Column subtitle"';
				if (i == 2)
					col_row_add_attrs = 'strike="1"';
				col_price_add_attrs += ' font_size="' + (attrs['price_font_size'] || '') + '"';
				col_price_add_attrs += ' color="' + (attrs['price_font_color'] || '') + '"';
				var new_repeat_content = hidden_content.replace(/%COLUMN_ADDITIONAL_ATTRIBUTES%/g, col_add_attrs);
				new_repeat_content = new_repeat_content.replace(/%COLUMN_PRICE_ADDITIONAL_ATTRIBUTES%/g, col_price_add_attrs);
				new_repeat_content = new_repeat_content.replace(/%COLUMN_ROW_ADDITIONAL_ATTRIBUTES%/g, col_row_add_attrs);
				gen_shortcode += new_repeat_content;
			}
			gen_shortcode += "\n[/"+target+"]";
		}
			if(tinymce.editors.content !== undefined) {
				tinymce.editors.content.execCommand('mceInsertContent', false, gen_shortcode.replace(/([^>])\n/g, '$1<br/>'));
			} else if(jQuery('textarea#content').length > 0) {
				jQuery('textarea#content').val(jQuery('textarea#content').val()+gen_shortcode);
			}
  		jQuery('#'+target+'_code').val(gen_shortcode);
	});
	jQuery('.shortcode-replace-button').click(function() {
			var target = jQuery(this).attr('id');
			if(tinymce.editors.content !== undefined && !jQuery('textarea#content').is(':visible')) {
				var selectionText = tinymce.editors.content.selection.getContent();
				var replaceString = '['+target+']'+selectionText+'[/'+target+']';
				tinymce.editors.content.selection.setContent(replaceString);
			} else if(jQuery('textarea#content').length > 0) {
				var textareaText = jQuery('textarea#content').val();
				var selectionStart = jQuery('textarea#content').get(0).selectionStart;
				var selectionEnd = jQuery('textarea#content').get(0).selectionEnd;
				var selectionText = textareaText.substr(selectionStart, selectionEnd-selectionStart);
				var replaceString = '['+target+']'+selectionText+'[/'+target+']';
				jQuery('textarea#content').val(textareaText.substr(0, selectionStart) + replaceString + textareaText.substr(selectionEnd));
			}
	});
});
</script>

	<div style="padding:20px 10px 10px 10px">
	<?php
		if(!empty($shortcodes))
		{
	?>
			<strong>Shortcodes</strong><hr class="pp_widget_hr">
			<div class="pp_widget_description"><?php _e('Choose the shortcode from the list below and fill in the corresponding attributes &amp; values. After that click on "Insert Shortcode" and the generated shortcode will be automatically inserted in your content. Visit our demo website to see all shortcodes in action.', 'codeus'); ?></div>
			<br/>
			<select id="shortcode_select">
				<option value=""><?php _e('(no short code selected)', 'codeus'); ?></option>

	<?php
			foreach($shortcodes as $shortcode_name => $shortcode)
			{
	?>

			<option value="<?php echo $shortcode_name; ?>"><?php echo $shortcode['title']; ?></option>

	<?php
			}
	?>
			</select>
	<?php
		}
	?>

	<br/><br/>

	<?php
		if(!empty($shortcodes))
		{
			foreach($shortcodes as $shortcode_name => $shortcode)
			{
	?>

			<div id="div_<?php echo $shortcode_name; ?>" class="rm_section" style="display:none">
				<div class="rm_title">
					<h3><?php echo ucfirst($shortcode['title']); ?></h3>
					<div class="clearfix"></div>
				</div>

				<div class="rm_text" style="padding: 10px 0 20px 0">

				<!-- img src="<?php echo $plugin_url.'/'.$shortcode_name.'.png'; ?>" alt=""/><br/><br/><br/ -->

				<?php
					if(isset($shortcode['content']) && $shortcode['content'])
					{
						if(isset($shortcode['content_text']))
						{
							$content_text = $shortcode['content_text'];
						}
						else
						{
							$content_text = __('Your Content', 'codeus');
						}
				?>

				<strong><?php echo $content_text; ?>:</strong><br/>
				<input type="hidden" id="<?php echo $shortcode_name; ?>_content_repeat" value="<?php echo isset($shortcode['repeat']) ? $shortcode['repeat'] : ''; ?>"/>
				<textarea id="<?php echo $shortcode_name; ?>_content" style="width:100%;height:70px" rows="3" wrap="off"><?php if(isset($shortcode['default'])) {echo $shortcode['default'];} ?></textarea><br/><br/>

				<?php
					}
				?>
				
				<?php if(isset($shortcode['hidden_content']) && $shortcode['hidden_content']): ?>
					<input type="hidden" id="<?php echo $shortcode_name; ?>_hidden_content" value="<?php echo isset($shortcode['hidden_content']) ? htmlspecialchars($shortcode['hidden_content']) : ''; ?>"/>
				<?php endif; ?>

				<?php
					if(isset($shortcode['attr']) && !empty($shortcode['attr']))
					{
				?>

						<div id="<?php echo $shortcode_name; ?>_attr_wrapper">

				<?php
						foreach($shortcode['attr'] as $attr => $type)
						{
				?>

							<?php if ($type!='checkbox') : echo '<strong>'.ucfirst((isset($shortcode['label']) && isset($shortcode['label'][$attr])) ? $shortcode['label'][$attr] : $attr).'</strong>: '.(isset($shortcode['desc'][$attr]) ? $shortcode['desc'][$attr] : ''); ?><br/><?php endif; ?>

							<?php
								switch($type)
								{
									case 'text':
							?>

									<input type="text" id="<?php echo $shortcode_name; ?>_text" style="width:100%" class="attr" name="<?php echo $attr; ?>"/>

							<?php
									break;
									
									case 'textarea':
							?>

									<textarea id="<?php echo $shortcode_name; ?>_text" style="width:100%" class="attr" name="<?php echo $attr; ?>"></textarea>

							<?php
									break;

									case 'icon':
							?>

									<input type="text" id="<?php echo $shortcode_name; ?>_text" style="width:100%" class="attr" name="<?php echo $attr; ?>"/><br/>
									<?php _e('Enter icon code', 'codeus'); ?>. <a href="<?php echo get_template_directory_uri(); ?>/fonts/user-icons-list.php" onclick="tb_show('<?php _e('Icons info', 'codeus'); ?>', this.href+'?TB_iframe=true'); return false;"><?php _e('Show Icon Codes', 'codeus'); ?></a>

							<?php
									break;

									case 'checkbox':
							?>
									<input type="checkbox" id="<?php echo $shortcode_name; ?>_text" class="attr" name="<?php echo $attr; ?>" value="1"/>
									<?php echo '<strong>'.ucfirst((isset($shortcode['label']) && isset($shortcode['label'][$attr])) ? $shortcode['label'][$attr] : $attr).'</strong> '.(isset($shortcode['desc'][$attr]) ? $shortcode['desc'][$attr] : ''); ?>
							<?php
									break;

									case 'picture':
							?>

									<input type="text" id="<?php echo $shortcode_name; ?>_text" style="width:100%" class="attr picture-select" name="<?php echo $attr; ?>"/>

							<?php
									break;

									case 'color':
							?>

									<input type="text" id="<?php echo $shortcode_name; ?>_text" style="width:150px;" class="attr color-select" name="<?php echo $attr; ?>"/>

							<?php
									break;

									case 'video':
							?>

									<input type="text" id="<?php echo $shortcode_name; ?>_text" style="width:100%" class="attr video-select" name="<?php echo $attr; ?>"/>

							<?php
									break;

									case 'select':
							?>

									<select id="<?php echo $shortcode_name; ?>_select" class="attr" name="<?php echo $attr; ?>">

										<?php
											if(isset($shortcode['options_'.$attr]) && !empty($shortcode['options_'.$attr]))
											{
												foreach($shortcode['options_'.$attr] as $select_key => $option)
												{
										?>

													<option value="<?php echo $select_key; ?>"><?php echo $option; ?></option>

										<?php
												}
											}
										?>

									</select>

							<?php
									break;
								}
							?>

							<br/><br/>

				<?php
						} //end attr foreach
				?>

						</div>

				<?php
					}
				?>
				<br/>

				<input type="button" id="<?php echo $shortcode_name; ?>" value="<?php _e('Insert Shortcode', 'codeus'); ?>" class="shortcode<?php if($shortcode_name == 'vc_column_text') { echo '-replace'; } ?>-button"/>

				<?php if($shortcode_name != 'vc_column_text') : ?>
				<br/><br/><br/>

				<strong><?php _e('Shortcode', 'codeus'); ?>:</strong><br/>
				<textarea id="<?php echo $shortcode_name; ?>_code" style="width:90%;height:70px" rows="3" readonly="readonly" class="code_area" wrap="off"></textarea>
				<?php endif; ?>
				</div>

			</div>

	<?php
			} //end shortcode foreach
		}
	?>

</div>

<?php

}

/*
	End Create Shortcode Generator Options
*/

?>