(function($) {
	$(document).ready(function() {
		$('.accordion').accordion({
			collapsible: true,
			heightStyle : 'content',
			activate: function(event, ui) {
				$('.gallery', ui.newPanel).trigger('gallery-init');
				if($('.portfolio .galleriffic, .portfolio .carousel', ui.newPanel)) {
					$('.portfolio .galleriffic, .portfolio .carousel', ui.newPanel).each(function() {
						$('ul.thumbs li', this).css('height', 'auto');
						var maxPortfolioItemsHeight = Math.max.apply(Math, $('ul.thumbs li', this).map(function() { return $(this).height(); }));
						$("ul.thumbs li", this).height(maxPortfolioItemsHeight);
					});
				}
			}
		});
		$('.accordion.closed').accordion( "option", "active", false );
		$('.tabs').tabs({
			activate: function(event, ui) {
				ui.newPanel.hide().fadeIn(500);
				ui.oldPanel.css({position:'absolute'}).outerWidth(ui.newPanel.outerWidth(true),true).show().position({of:ui.newPanel, my: 'left top', at:'left top', collision:'none'});
				ui.oldPanel.fadeOut(500,function() {
					$(this).css({position:'static', width: 'auto', top: 0, left: 0});
				});
				$('.gallery', ui.newPanel).trigger('gallery-init');
				if($('.portfolio .galleriffic, .portfolio .carousel', ui.newPanel)) {
					$('.portfolio .galleriffic, .portfolio .carousel', ui.newPanel).each(function() {
						$('ul.thumbs li', this).css('height', 'auto');
						var maxPortfolioItemsHeight = Math.max.apply(Math, $('ul.thumbs li', this).map(function() { return $(this).height(); }));
						$("ul.thumbs li", this).height(maxPortfolioItemsHeight);
					});
				}
				jQuery(window).trigger('resize');
			}
		});
		jQuery('.tabs').on('noscript-loaded', function() {
			jQuery(window).trigger('resize');
		});
	});
})(jQuery);