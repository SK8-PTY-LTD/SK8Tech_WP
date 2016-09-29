(function($) {
	$.fn.fileSelector = function() {
		$(this).each(function() {
			var $el = $(this);
			$el.hide();
			var $fileWrapper = $('<a href="javascript:void(0);" class="file-wrapper" />').insertAfter($el);
			var $remove = $('<a href="javascript:void(0);" class="remove-file" >Remove File</a>').insertAfter($fileWrapper);
			$el.change(function() {
				if($el.val() == '') {
					$remove.hide();
					$fileWrapper.text('Click here to select file');
				} else {
					$remove.show();
					$fileWrapper.html($el.val());
				}
			}).trigger('change');
			var tbframe_interval;
			var wp_func = window.send_to_editor;
			var ps_func = function(html) {
				var fileurl = $(html).attr('href');
				$el.val(fileurl).trigger('change');
				tb_remove();
				clearInterval(tbframe_interval);
				window.send_to_editor = wp_func;
			}
			$fileWrapper.click(function() {
				window.send_to_editor = ps_func;
				tb_show('', 'media-upload.php?tab=library&TB_iframe=true&width=625');
				tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This File');}, 2000);
				return false;
			});
			$remove.click(function() {
				$el.val('').trigger('change');
			});
		});
	}
})(jQuery);