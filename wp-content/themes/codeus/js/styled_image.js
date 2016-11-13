(function($) {
	$(document).ready(function() {
		$('.fancy').hover(
			function() {
				$('.overlay', this).stop(true,true).animate({ opacity: 'show' });
			},
			function() {
				$('.overlay', this).stop(true,true).animate({ opacity: 'hide' });
			}
		);
	});
})(jQuery);