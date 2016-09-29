jQuery(function($) {

	$("body").fadeOut(0);

	$('#titlediv .inside').css("display", "none");

	// Hide gallery settings
	$('div#gallery-settings').hide();
	// Full size select dropdown
	$('select.custom_dropdown').css("width", "100%");
	// Create Extra Button For Live Preview
	var new_button = jQuery('<input type="button" id="update_preview" class="button" value="…then Update Live Preview & Return" style="">').clone();	
	// Update live preview
	$('p.ml-submit').append(new_button);
	// Assign function to button.
	$("input#update_preview").click(function () 
	{
		top.location.href = top.location.href;
	});
	
	$("div#media-items").css("margin-bottom", "13px");

	$("body").fadeIn(0);

	jQuery('.upload_slide_button').click(function() {
		current_slide_focus = jQuery(this).closest(".slide_template");
		formfield = jQuery(this).closest(".slide_template").find("input.slide_image");
		tb_show('', 'media-upload.php?type=image&amp;post_id=3&amp;TB_iframe=true');
		return false;
	});
	
	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src');
		if (jQuery(".wall_item_template").size() == 0)
		current_slide_focus.find("input.slide_image").val(imgurl)
		else
		current_slide_focus.find("input.wall_image").val(imgurl);
				
		tb_remove();
	}
					
});
