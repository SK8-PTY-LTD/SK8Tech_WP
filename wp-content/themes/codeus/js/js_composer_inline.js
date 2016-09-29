(function($) {

	vc_iframe.codeus_init_gallery = function ($element) {
		$('.gallery', $element).each(function() {
			$(this).on('noscript-loaded', codeus_init_gallery);
		});
	}

})(jQuery);