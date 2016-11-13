(function($){
	$(document).ready(function() {
		$('<button>Select</button>').insertAfter($('input.picture-select, input.video-select'));
		var media_selector_frame;
		$('input.picture-select + button, input.video-select + button').live('click', function(event) {
				var $this = $(this);
				event.preventDefault();
				var mediaType = 'image';
				var mediaTypeTitle = 'Image';
				var $formfield = $(this).prev('input.picture-select, input.video-select');

				if($formfield.hasClass('video-select')) {
					var mediaType = 'video';
					var mediaTypeTitle = 'Video';
				}

				// Create the media frame.
				media_selector_frame = wp.media.frames.mediaSelector = wp.media({
					// Set the title of the modal.
					title: 'Select '+mediaTypeTitle,
					button: {
						text: 'Insert '+mediaTypeTitle,
					},
					library: {
						type: mediaType
					}
				});
				// When an image is selected, run a callback.
				media_selector_frame.on( 'select', function() {
					var attachment = media_selector_frame.state().get('selection').first();
					attachment = attachment.toJSON();
					if(attachment.id) {
						$formfield.val(attachment.url).trigger('change');
					}
				});
					// Finally, open the modal.
				media_selector_frame.open();
		});

		$('input.color-select').each(function(){
			$('<span class="cs_button"></span>')
				.insertAfter($(this))
				.css('backgroundColor', $(this).val());
		});
		$('input.color-select').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val('#' + hex);
				$(el).ColorPickerHide();
				$(el).change();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		});
		$('input.color-select').live('change', function(){
			$(this).next('.cs_button').css('backgroundColor', $(this).val());
		});
		$('input.color-select + .cs_button').click(function(){
			$(this).prev('input').ColorPickerShow();
		});
	});
})(jQuery);