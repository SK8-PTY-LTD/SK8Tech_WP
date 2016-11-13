(function($) {
	$(document).ready(function() {

		$('#quickfinder_select').attr('disabled', $('#quickfinder_position').val() === '0');
		$('#quickfinder_position').change(function() {
			$('#quickfinder_select').attr('disabled', $(this).val() === '0');
		});

		$('#portfolio_rubrics, input[name="codeus_portfolio_select[]"], #portfolio_select-all, #portfolio_size, #portfolio_count').attr('disabled', $('#portfolio_position').val() === '0');
		$('#portfolio_rubrics, #portfolio_size, #portfolio_count').attr('disabled', $('#portfolio_position').val() !== '2');
		$('#portfolio_position').change(function() {
			$('#portfolio_rubrics, input[name="codeus_portfolio_select[]"], #portfolio_select-all, #portfolio_size, #portfolio_count').attr('disabled', $(this).val() === '0');
			$('#portfolio_rubrics, #portfolio_size, #portfolio_count').attr('disabled', $(this).val() !== '2');
		});

		$('#portfolio_select-all').attr('checked', $('input[name="codeus_portfolio_select[]"]:checked').length == $('input[name="codeus_portfolio_select[]"]').length);
		$('#portfolio_select-all').change(function() {
			if($(this).is(':checked')) {
				$('input[name="codeus_portfolio_select[]"]').attr('checked', 'checked');
			} else {
				$('input[name="codeus_portfolio_select[]"]').removeAttr('checked');
			}
		});


		$('#gallery_manager').each(function() {

			var $manager = $(this);
			$gallery_field = $('#codeus_gallery_images', $manager);
			var gallery_images_frame;
			$gallery_images = $('ul.gallery-images', $manager);

			$manager.on( 'click', 'a#upload_button', function( event ) {

				var $el = $(this);
				var attachment_ids = $gallery_field.val();
				event.preventDefault();

				if ( gallery_images_frame ) {
					gallery_images_frame.open();
					return;
				}
				// Create the media frame.
				gallery_images_frame = wp.media.frames.gallery_images = wp.media({
					// Set the title of the modal.
					title: 'Select Images',
					button: {
						text: 'Add Images',
					},
					states : [
						new wp.media.controller.Library({
							title: 'Select Images',
							filterable : 'image',
							multiple: true,
						})
					]
				});
				// When an image is selected, run a callback.
				gallery_images_frame.on( 'select', function() {
					var selection = gallery_images_frame.state().get('selection');
					selection.map( function( attachment ) {
						attachment = attachment.toJSON();
						if ( attachment.id ) {
							attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
							$gallery_images.append('\
								<li class="image" data-attachment_id="' + attachment.id + '">\
									<a href="'+ attachment.editLink +'" class="edit" target="_blank"><img src="' + attachment.url + '" /></a>\
									<a href="javascript:void(0);" class="remove">x</a>\
								</li>');
						}
					});
					$gallery_field.val( attachment_ids );
				});

					// Finally, open the modal.
				gallery_images_frame.open();
			});

			// Image ordering
			$gallery_images.sortable({
				items: 'li.image',
				cursor: 'move',
				scrollSensitivity: 40,
				forcePlaceholderSize: true,
				forceHelperSize: false,
				helper: 'clone',
				opacity: 0.65,
				placeholder: 'codeus-gallery-images-sortable',
				start:function(event,ui){
					ui.item.css('background-color','#f6f6f6');
				},
				stop:function(event,ui){
					ui.item.removeAttr('style');
				},
				update: function(event, ui) {
					var attachment_ids = '';

					$('li.image', $gallery_images).css('cursor','default').each(function() {
						var attachment_id = jQuery(this).attr( 'data-attachment_id' );
						attachment_ids = attachment_ids + attachment_id + ',';
					});

					$gallery_field.val( attachment_ids );
				}
			});

			// Remove images
			$gallery_images.on( 'click', 'li.image a.remove', function() {
				$(this).closest('li.image').remove();

				var attachment_ids = '';

				$('li.image', $gallery_images).css('cursor','default').each(function() {
					var attachment_id = jQuery(this).attr( 'data-attachment_id' );
					attachment_ids = attachment_ids + attachment_id + ',';
				});

				$gallery_field.val( attachment_ids );

				return false;
			});

			// Edit images
			$gallery_images.on( 'click', 'li.image a.edit1', function() {
				var attachment_id = $(this).closest('li.image').data('attachment_id');
				var gallery_image_edit_frame = wp.media.frames.gallery_image_edit = wp.media({
					// Set the title of the modal.
					title: 'Edit Image Information',
					button: {
						text: 'Close'
					},
					library: {
						post__in: [attachment_id]
					}
				});

				gallery_image_edit_frame.on( 'open', function() {
					var selection = gallery_image_edit_frame.state().get('selection');
					attachment = wp.media.attachment(attachment_id);
					attachment.fetch();
					selection.add( attachment ? [ attachment ] : [] );
				});

				gallery_image_edit_frame.open();

				return false;
			});

		});

	});
})(jQuery);