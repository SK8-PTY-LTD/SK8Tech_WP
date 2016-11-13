(function ($) {
	var Shortcodes = vc.shortcodes;
	var VcCodeusClass = vc.shortcode_view.extend({
		events:{
			'click > .vc_controls .column_delete':'deleteShortcode',
			'click > .vc_controls .column_add':'addElement',
			'click > .vc_controls .column_edit':'editElement',
			'click > .vc_controls .column_clone':'clone',
			'mousemove': 'checkControlsPosition'
		}
	})

	window.VcCodeusAccordion = VcCodeusClass.extend({});

	window.VcCodeusAlertBox = VcCodeusClass.extend({});
	window.VcCodeusIconWithText = VcCodeusClass.extend({});
	window.VcCodeusOneHalf = VcCodeusClass.extend({});
	window.VcCodeusOneHalfLast = VcCodeusClass.extend({});
	window.VcCodeusOneHalfFourth = VcCodeusClass.extend({});
	window.VcCodeusOneHalfFourthLast = VcCodeusClass.extend({});
	window.VcCodeusOneHalfThird = VcCodeusClass.extend({});
	window.VcCodeusOneHalfThirdLast = VcCodeusClass.extend({});
	window.VcCodeusTextbox = VcCodeusClass.extend({});
	window.VcCodeusTabs = VcCodeusClass.extend({});
	window.VcCodeusTab = VcCodeusClass.extend({});

})(window.jQuery);
