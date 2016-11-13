(function($) {

	if(window.InlineShortcodeViewContainer != undefined) {
		window.InlineShortcodeView_one_half = window.InlineShortcodeViewContainer.extend({
			render: function() {
				window.InlineShortcodeView_one_half.__super__.render.call(this);
				if(this.$el.next().length < 1 || !(this.$el.next().attr('data-tag') == 'one_half_last') ) {
					new vc.ShortcodesBuilder()
						.create({shortcode: 'one_half_last', parent_id: this.model.get('parent_id')})
						.render();
					$(':last[data-tag="one_half_last"]',this.$el.parent()).insertAfter(this.$el);
				}
				return this;
			}
		});

		window.InlineShortcodeView_one_half_last = window.InlineShortcodeViewContainer.extend({
			render: function() {
				window.InlineShortcodeView_one_half_last.__super__.render.call(this);
				$('<div class="clearfix" />').insertAfter(this.$el);
				return this;
			}
		});

		window.InlineShortcodeView_one_third = window.InlineShortcodeViewContainer.extend({
			render: function() {
				window.InlineShortcodeView_one_third.__super__.render.call(this);
				if(this.$el.next().length < 1 || !((this.$el.next().attr('data-tag') == 'one_third_last') || this.$el.next().attr('data-tag') == 'one_third')) {
					if(this.$el.prev().length < 1 || !(this.$el.prev().attr('data-tag') == 'one_third') ) {
						new vc.ShortcodesBuilder()
							.create({shortcode: 'one_third', parent_id: this.model.get('parent_id')})
							.render();
							$(':last[data-tag="one_third"]',this.$el.parent()).insertAfter(this.$el);
					} else {
						new vc.ShortcodesBuilder()
							.create({shortcode: 'one_third_last', parent_id: this.model.get('parent_id')})
							.render();
						$(':last[data-tag="one_third_last"]',this.$el.parent()).insertAfter(this.$el);
					}
				}
				return this;
			}
		});

		window.InlineShortcodeView_one_third_last = window.InlineShortcodeViewContainer.extend({
			render: function() {
				window.InlineShortcodeView_one_third_last.__super__.render.call(this);
				$('<div class="clearfix" />').insertAfter(this.$el);
				return this;
			}
		});

		window.InlineShortcodeView_one_fourth = window.InlineShortcodeViewContainer.extend({
			render: function() {
				window.InlineShortcodeView_one_fourth.__super__.render.call(this);
				if(this.$el.next().length < 1 || !(this.$el.next().attr('data-tag') == 'one_fourth_last' || this.$el.next().attr('data-tag') == 'one_fourth')) {
					if(this.$el.prev().length < 1 || !(this.$el.prev().attr('data-tag') == 'one_fourth') || this.$el.prev().prev().length < 1 || !(this.$el.prev().prev().attr('data-tag') == 'one_fourth')  ) {
						new vc.ShortcodesBuilder()
							.create({shortcode: 'one_fourth', parent_id: this.model.get('parent_id')})
							.render();
							$(':last[data-tag="one_fourth"]',this.$el.parent()).insertAfter(this.$el);
					} else {
						new vc.ShortcodesBuilder()
							.create({shortcode: 'one_fourth_last', parent_id: this.model.get('parent_id')})
							.render();
						$(':last[data-tag="one_fourth_last"]',this.$el.parent()).insertAfter(this.$el);
					}
				}
				return this;
			}
		});

		window.InlineShortcodeView_one_fourth_last = window.InlineShortcodeViewContainer.extend({
			render: function() {
				window.InlineShortcodeView_one_fourth_last.__super__.render.call(this);
				$('<div class="clearfix" />').insertAfter(this.$el);
				return this;
			}
		});

		window.InlineShortcodeView_accordion = window.InlineShortcodeViewContainer.extend({
			render: function() {
				window.InlineShortcodeView_accordion.__super__.render.call(this);
				$('.noscript + .loading', this.$el).each(function() {
					$(this).prev().removeClass('noscript');
					$(this).remove();
				});
				return this;
			}
		});

		window.InlineShortcodeView_icon_with_text = window.InlineShortcodeViewContainer.extend({
			render: function() {
				window.InlineShortcodeView_icon_with_text.__super__.render.call(this);
				$('.iconed-text', this.$el).eq(0).removeClass('clearfix');
				this.$el.addClass('clearfix');
				return this;
			}
		});

		window.InlineShortcodeView_clients = window.InlineShortcodeView.extend({
			render: function() {
				window.InlineShortcodeView_clients.__super__.render.call(this);
				$('.clients ul.list li', this.$el).css({display: 'inline-block', opacity: 1});
				return this;
			}
		});

		window.InlineShortcodeView_portfolio = window.InlineShortcodeView.extend({
			render: function() {
				window.InlineShortcodeView_portfolio.__super__.render.call(this);
				$('.noscript + .loading', this.$el).each(function() {
					$(this).prev().removeClass('noscript');
					$(this).remove();
				});
				$('.portfolio .galleriffic ul.thumbs li, .portfolio .rubrics ul.thumbs li', this.$el).css({display: 'inline-block', opacity: 1});
				$('.portfolio .galleriffic ul.thumbs li, .portfolio .rubrics ul.thumbs li', this.$el).after(' ');
				return this;
			}
		});

		window.InlineShortcodeView_gallery = window.InlineShortcodeView.extend({
			render: function() {
				window.InlineShortcodeView_gallery.__super__.render.call(this);
				vc.frame_window.vc_iframe.codeus_init_gallery(this.$el);
				return this;
			}
		});

/*		window.InlineShortcodeView_tab = window.InlineShortcodeViewContainer.extend({
			controls_selector: '#vc-controls-template-tab',
			events: {
				'click > .vc-controls .element .control-btn-delete': 'destroy',
				'click > .vc-controls .element .control-btn-edit': 'edit',
				'click > .vc-controls .element .control-btn-clone': 'clone',
				'click > .vc-controls .element .control-btn-prepend': 'prependElement',
				'click > .vc-controls .control-btn-append': 'appendElement',
				'click > .vc-controls .parent .control-btn-delete': 'destroyParent',
				'click > .vc-controls .parent .control-btn-edit': 'editParent',
				'click > .vc-controls .parent .control-btn-clone': 'cloneParent',
				'click > .vc-controls .parent .control-btn-prepend': 'addSibling',
				'click > .wpb_accordion_section > .vc-empty-element': 'appendElement',
				'click > .vc-controls .control-btn-switcher': 'switchControls',
				'mouseenter': 'resetActive',
				'mouseleave': 'holdActive'
			},
			destroyParent: function(e) {
				e && e.preventDefault();
				this.parent_view.destroy(e);
			},
			cloneParent: function(e) {
				e && e.preventDefault();
				this.parent_view.clone(e);
			},
			editParent: function(e) {
				e && e.preventDefault();
				this.parent_view.edit(e);
			},
			addSibling: function(e) {
				e && e.preventDefault();
				this.parent_view.addElement(e);
			},
			switchControls: function(e) {
				e && e.preventDefault();
				vc.unsetHoldActive();
				var $control = $(e.currentTarget),
					$parent = $control.parent(),
					$current;
				$parent.addClass('active');
				$current = $parent.siblings('.active').removeClass('active');
				!$current.hasClass('element') && window.setTimeout(this.holdActive, 500);
			},
			addControls: function() {
				var template = $(this.controls_selector).html(),
					parent = vc.shortcodes.get(this.model.get('parent_id')),
					data = {
						name: vc.getMapped(this.model.get('shortcode')).name,
						tag: this.model.get('shortcode'),
						parent_name: vc.getMapped(parent.get('shortcode')).name,
						parent_tag: parent.get('shortcode')
					};
				this.$controls = $(_.template(template, data, vc.template_options).trim()).addClass('vc-controls');
				this.$controls.appendTo(this.$el);
			}
		});*/

		window.InlineShortcodeView_tabs = window.InlineShortcodeViewContainer.extend({
			render: function() {
				window.InlineShortcodeView_tabs.__super__.render.call(this);
				$('.noscript + .loading', this.$el).each(function() {
					$(this).prev().removeClass('noscript');
					$(this).remove();
				});
				return this;
			},
			changed: function() {
				window.InlineShortcodeView_tabs.__super__.changed.call(this);
				$('.tabs-nav + .tabs-nav', this.$el).remove();
			},
			addElement: function(e) {
				e && e.preventDefault();
				new vc.ShortcodesBuilder()
					.create({shortcode: 'tab', parent_id: this.model.get('id')})
					.render();
			}
		});

	}
})(jQuery);