
/* Application Scripts
================================================================ */

/*! matchMedia() polyfill - Test a CSS media type/query in JS. Authors & copyright (c) 2012: Scott Jehl, Paul Irish, Nicholas Zakas, David Knight. Dual MIT/BSD license */

window.matchMedia || (window.matchMedia = function() {
    "use strict";

    // For browsers that support matchMedium api such as IE 9 and webkit
    var styleMedia = (window.styleMedia || window.media);

    // For those that don't support matchMedium
    if (!styleMedia) {
        var style       = document.createElement('style'),
            script      = document.getElementsByTagName('script')[0],
            info        = null;

        style.type  = 'text/css';
        style.id    = 'matchmediajs-test';

        script.parentNode.insertBefore(style, script);

        // 'style.currentStyle' is used by IE <= 8 and 'window.getComputedStyle' for all other browsers
        info = ('getComputedStyle' in window) && window.getComputedStyle(style, null) || style.currentStyle;

        styleMedia = {
            matchMedium: function(media) {
                var text = '@media ' + media + '{ #matchmediajs-test { width: 1px; } }';

                // 'style.styleSheet' is used by IE <= 8 and 'style.textContent' for all other browsers
                if (style.styleSheet) {
                    style.styleSheet.cssText = text;
                } else {
                    style.textContent = text;
                }

                // Test if media query is true or false
                return info.width === '1px';
            }
        };
    }

    return function(media) {
        return {
            matches: styleMedia.matchMedium(media || 'all'),
            media: media || 'all'
        };
    };
}());

jQuery(document).ready(function() {

"use strict";

/******************************************************************
Loading Spinner
******************************************************************/



/******************************************************************
Sub-Header Parallax Title
******************************************************************/

if (window.matchMedia('(min-width: 940px)').matches) { // is the window width larger than 940px?

    var shTitle = jQuery('.sh-title-wrapper'); // the element to apply parallax to

    jQuery(window).on('scroll', function() { // call the script on window scroll

        var st = jQuery(this).scrollTop();

        // set the CSS relative to scroll position to achieve parallax effect
        shTitle.css({ 
            //'top' : (st/3)+"px", 
            'transform' : "translate3d(0px, "+(st/3)+"px, 0px)",
            'opacity' : 1 - st/250
        }); 

    });

}
    
/******************************************************************
Scroll to Top/Nav trigger Visibility
******************************************************************/

if (window.matchMedia('(min-width: 940px)').matches) { // is the window width larger than 940px?

    jQuery(window).bind("load scroll", function() { // call the script on window scroll & window load

        if (jQuery(this).scrollTop() > 350) { // have we scrolled more than 350px from the top?
            // yes
            jQuery(".scroll-top, #cp-trigger, .opera-trigger").addClass('visible'); // show the buttons
        } else {
            // no
            jQuery(".scroll-top, #cp-trigger, .opera-trigger").stop().removeClass('visible'); // hide the buttons
        }

        // are we at the bottom of the page?
        if(jQuery(window).scrollTop() + jQuery(window).height() == jQuery(document).height()) {
            jQuery(".scroll-top").stop().removeClass('visible'); // hide the scroll-top button
        }

    });

}

/******************************************************************
Fixed Header
******************************************************************/

jQuery('.app-header').clone().removeAttr('id').appendTo('.fixed-header-container'); // Create the fixed header

jQuery(window).bind("load scroll", function() { // call the script on window scroll & window load

    if (jQuery(this).scrollTop() > 350) { // have we scrolled more than 350px from the top?
        // yes
        jQuery('body').addClass('fh-visible');
    } else {
        // no
        jQuery('body').removeClass('fh-visible');      
    }

    if (jQuery('.fixed-header-container').css('opacity') == '1' && jQuery('body').hasClass('fh-visible')) { // is the fixed-header visible?
        // yes
        jQuery('.flyout-trigger').css({
            top: '1.05em'
        });
    } else {   
        // no     
        jQuery('.flyout-trigger').css({
            top: '1.5em'
        });
    }

});

/******************************************************************
Main Search
******************************************************************/

jQuery('.search-toggle').click(function() {

    jQuery('body').addClass('search-active'); // search box is visible

    // auto-focus the input afer transition complete
    setTimeout(function(){
        jQuery('.main-search input').focus();
    }, 400)

});

jQuery('.search-close').click(function() {
    jQuery('body').removeClass('search-active'); // search box is hidden
});

/******************************************************************
Contact Form
******************************************************************/

if( jQuery('#s-contact').length != 0 ) {

    var $contact = jQuery('.h5-valid input');

    if( $contact.val().length != 0 ) {
        $contact.find('~ label').hide();
    }

    $contact.blur(function() {
        if( jQuery(this).val().length != 0 ) {
            jQuery(this).find('~ label').hide();
        } else {
           jQuery(this).find('~ label').fadeIn(); 
        }
    });

}

/******************************************************************
Add Active Class
******************************************************************/

if (window.matchMedia('(min-width: 940px)').matches) { // is the window width larger than 940px?
    // yes
    var tiles = jQuery(".inactive");
	var a , b;
    jQuery(window).bind("load scroll", function(d,h) { // call the script on window scroll & window load
        tiles.each(function(i) {
            a = jQuery(this).offset().top + jQuery(this).height();
            b = jQuery(window).scrollTop() + jQuery(window).height();
            if (a < b) jQuery(this).removeClass('inactive').addClass('active');
        });
    });
} else {
    // no
    jQuery('.inactive').removeClass('inactive');
}

/******************************************************************
Smooth Scroll
******************************************************************/

jQuery('.main-nav a[href*=#]').click(function() { // target all links except the off-canvas nav links
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
        || location.hostname == this.hostname) {
        var target = jQuery(this.hash);
        target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
           if (target.length) {
             jQuery('html,body').animate({
                 scrollTop: target.offset().top - 50
            }, 1200);
            return false;
        }
    }
});



/******************************************************************
Modals
******************************************************************/

jQuery('.modal-image').magnificPopup({ 
    type: 'image'
});

jQuery('.modal-gallery').magnificPopup({ 
    type: 'image',
    delegate: 'a',
    gallery: {
        enabled: true
    }
});

jQuery('.inline-modal').magnificPopup({
    type:'inline',
    midClick: true
});

/******************************************************************
Tooltip
******************************************************************/

jQuery('.tooltip').tipr({
    'speed': 300,
    'mode': 'top'
 });

/******************************************************************
Progress Bars
******************************************************************/

jQuery(".progress").each(function() {
    var attrProgress = jQuery(this).attr('data-progress');
    jQuery(this).css({ width : attrProgress }); 
});

var stat = jQuery('[id^="stat-"]');
var attrStat;
stat.each(function(i) {
	attrStat = jQuery(this).attr('data-val');
	jQuery(this).animateNumber({ 
			number: attrStat,
		}, 2000
	);
});


/******************************************************************
Portfolio Items Gallery
******************************************************************/

jQuery(".portfolio-items").magnificPopup({ 
    type: "image",
    delegate: ".icon-view",
    gallery: {
        enabled: true
    },
    callbacks: {
        change: function() {
            if (this.isOpen) {
                this.wrap.addClass('mfp-open');
            }
        }
    }
});


jQuery(".team-members").magnificPopup({ 
    type: "image",
    delegate: ".mask [class^='icon-']",
    gallery: {
        enabled: true
    },
    callbacks: {
        change: function() {
            if (this.isOpen) {
                this.wrap.addClass('mfp-open');
            }
        }
    }
});


/******************************************************************
Single Project Gallery
******************************************************************/


jQuery(".project-gallery").each(function () {
	jQuery(this).magnificPopup({ 
		type: "image",
		delegate: "a",
		gallery: {
			enabled: true
		},
		callbacks: {
			change: function() {
				if (this.isOpen) {
					this.wrap.addClass('mfp-open');
				}
			}
		}
	});
});

/******************************************************************
Meet the Team Gallery
******************************************************************/

jQuery(".section.team").magnificPopup({ 
    type: "image",
    delegate: ".mask [class^='icon-']",
    gallery: {
        enabled: true
    },
    callbacks: {
        change: function() {
            if (this.isOpen) {
                this.wrap.addClass('mfp-open');
            }
        }
    }
});

/******************************************************************
Portfolio Grid Carousel
******************************************************************/

var portfolioCarousel = jQuery('.portfolio-carousel');

portfolioCarousel.owlCarousel({
    items: 1,
    loop: true,
    dots: true,
    nav: false,
    slideBy: 1
})

// Go to the next item
jQuery('.section.latest-works .nav-next').click(function() {
    portfolioCarousel.trigger('next.owl.carousel');
})

// Go to the previous item
jQuery('.section.latest-works .nav-prev').click(function() {
    portfolioCarousel.trigger('prev.owl.carousel');
})

/******************************************************************
Portfolio Previews Carousel
******************************************************************/

var projectCarousel = jQuery('.project-carousel .previews');

projectCarousel.owlCarousel({
    items: 1,
    dots: false,
    loop: true,
    nav: false,
    autoplay:true,
    slideBy: 1
})

// Go to the next item
jQuery('.project-carousel .nav-next').click(function() {
    projectCarousel.trigger('next.owl.carousel');
})

// Go to the previous item
jQuery('.project-carousel .nav-prev').click(function() {
    projectCarousel.trigger('prev.owl.carousel');
})

/******************************************************************
Testimonials Carousel
******************************************************************/

var testimonialCarousel = jQuery('.testimonials-slider');

testimonialCarousel.owlCarousel({
    items: 1,
    loop: true,
    dots: false,
    nav: false,
    margin: 60,
    slideBy: 1
});

// Go to the next item
jQuery('.nexus-testimonials-slider .nav-next').click(function() {
    testimonialCarousel.trigger('next.owl.carousel');
})

// Go to the previous item
jQuery('.nexus-testimonials-slider .nav-prev').click(function() {
    testimonialCarousel.trigger('prev.owl.carousel');
})

/******************************************************************
Services Carousel
******************************************************************/

var servicesCarousel = jQuery('.services-slider');

servicesCarousel.owlCarousel({
    items: 1,
    loop: false,
    dots: false,
    nav: false,
    margin: 20,
    slideBy: 1,
    responsive:{
        720:{                
            items: 2
        },
        1100:{                
            items: 3
        }
    }
});

// Go to the next item
jQuery('.section.services .nav-next , .nexus-services-slider .nav-next').click(function() {
    servicesCarousel.trigger('next.owl.carousel');
})

// Go to the previous item
jQuery('.section.services .nav-prev , .nexus-services-slider .nav-prev').click(function() {
    servicesCarousel.trigger('prev.owl.carousel');
})

/******************************************************************
Clients Carousel
******************************************************************/

jQuery('.clients-slider').owlCarousel({
    items: 1,
    loop: true,
    dots: true,
    nav: false,
    margin: 35,
    slideBy: 1,
    autoplay:true,
    autoplayTimeout: 4000,
    autoplayHoverPause:true,
    responsive:{
        460:{                
            items: 2
        },
        720:{                
            items: 3
        }
    }
});

/******************************************************************
Footer Testimonials Carousel
******************************************************************/

jQuery('.footer-testimonials').owlCarousel({
    items: 1,
    loop: true,
    dots: false,
    nav: true,
    navText: [],
    margin: 20,
    slideBy: 1
});

}); // End document.ready


/* Interactive Elements
================================================================ */

/******************************************************************
Accordion
******************************************************************/

function accordion() {

    jQuery('.accordion > * > *:first-child').click(function () {

        var $parent = jQuery(this).parent();

        $parent.toggleClass('active');
        $parent.siblings().removeClass('active');
        $parent.siblings().find('> *:first-child ~ *').slideUp(420);
        jQuery(this).find('~ *').slideToggle(420);

    });
  
}

jQuery(accordion);

/******************************************************************
Tabs
******************************************************************/

function tabs() {

    jQuery('.tabs .nav li').click(function() {

        var $section = jQuery(this).parents('.tabs').find('section');

        jQuery(this).siblings().removeClass('active');
        jQuery(this).addClass('active');
        $section.slideUp(420);
        $section.eq(jQuery(this).index()).slideDown(420);
        return false;

    });
  
}

jQuery(tabs);

/******************************************************************
Tooltip
******************************************************************/
//http://www.tipue.com/tipr/

(function ($) {
    $.fn.tipr = function (options) {
        var set = $.extend({
            "speed": 200,
            "mode": "bottom"
        }, options);
        return this.each(function () {
            var tipr_cont = ".tipr_container_" + set.mode;
            jQuery(this).hover(function () {
                var out = '<div class="tipr_container_' + set.mode + '"><div class="tipr_point_' + set.mode + '"><div class="tipr_content">' + jQuery(this).attr("data-tip") + "</div></div></div>";
                jQuery(this).append(out);
                var w_t = jQuery(tipr_cont).outerWidth();
                var w_e = jQuery(this).width();
                var m_l = w_e / 2 - w_t / 2;
                jQuery(tipr_cont).css("margin-left", m_l + "px");
                jQuery(this).removeAttr("title");
                jQuery(tipr_cont).fadeIn(set.speed)
            }, function () {
                jQuery(tipr_cont).remove()
            })
        })
    }
})(jQuery);

/* Control Panel Navigation
================================================================ */

jQuery(document).ready(function() {

    var cpContainer = jQuery('#cp-nav');

    // create the cp nav HTML
    function cpNav() {

        jQuery("#cp-trigger").detach().prependTo('body') // relocate the cp-trigger in the DOM
        jQuery("#logo").clone().removeAttr('id').prependTo(cpContainer); // clone the logo into the cp nav
        jQuery("#search").clone().removeAttr('id').prependTo(cpContainer); // clone the search box into the cp nav
        jQuery("#app-header .main-nav > ul").clone().appendTo(cpContainer); // clone the main nav into the cp nav container
        jQuery("#copyright").clone().removeAttr('id').appendTo(cpContainer); // clone the copyright into the cp nav

    } // End cpNav()

    jQuery(cpNav);

}); // End document.ready

jQuery(window).load(function(){

    function toggleCP(state) {

        var scaleFactorWhenNavActive = 0.65; // change me if CSS body.cp-active #site-content transform:scale factor ever changes! 

        var vPos = jQuery('html').scrollTop(); // my current scroll position in px

        // webkit doesn't consider the html container to have scrolled, so let's check the body container instead
        if(vPos == 0) vPos = jQuery('body').scrollTop();

        var screenHeight = jQuery(window).height();
        var screenHeightFactor = screenHeight*0.15; // this is the height of the body:before, which is a height of 15%

        if(jQuery('body').hasClass('cp-active')) {  // are we currently in scaled-small mode about to switch back?
            // yes we are, so toggle and then scroll "down" the larger page to compensate
            if(state != 1) {
                jQuery('body').toggleClass('cp-active');
                jQuery('.cp-trigger').toggleClass('nav-trigger-animate');
                jQuery('body,html').animate({scrollTop:Number((vPos + screenHeightFactor)/scaleFactorWhenNavActive) + 1 },0);
            }
        } else {
            // no, we are not, so toggle and then scroll "up" the smaller page to compensate
            if(state != 0) {
                jQuery('body').toggleClass('cp-active');
                jQuery('.cp-trigger').toggleClass('nav-trigger-animate');
                jQuery('body,html').animate({scrollTop:Number((vPos * scaleFactorWhenNavActive) - (screenHeightFactor))},0);
            }
        }
     
    } // End toggleCP()

    jQuery('#cp-trigger').click(function() {
        toggleCP();
    });
   jQuery('#cp-nav a').click(function() {
        toggleCP(0);
    });

}); // End window.load

/* Flyout Navigation
================================================================ */

jQuery(document).ready(function() {

    var fnContainer = jQuery('#flyout-nav');

    // create the flyout nav HTML
    function flyoutNav() {

        jQuery("#flyout-trigger").detach().prependTo('body') // relocate the flyout-trigger in the DOM
        jQuery("#app-header .main-nav > ul , #app-header .main-nav > div > ul").clone().appendTo(fnContainer); // clone the main nav into the flyout nav container
        jQuery("#app-header .logo").clone().prependTo(fnContainer); // clone the logo into the off-canvas nav

    } // End flyoutNav()

    jQuery(flyoutNav);

}); // End document.ready

jQuery(window).load(function(){

    function toggleFlyout(state) {

        if(jQuery('body').hasClass('flyout-active')) {  // are we currently in scaled-small mode about to switch back?
            // yes we are, so toggle and then scroll "down" the larger page to compensate
            if(state != 1) {
                jQuery('body').toggleClass('flyout-active');
                jQuery('#flyout-trigger').toggleClass('nav-trigger-animate');
                jQuery('#site-overlay').toggleClass('invisible');
            }
        } else {
            // no, we are not, so toggle and then scroll "up" the smaller page to compensate
            if(state != 0) {
                jQuery('body').toggleClass('flyout-active');
                jQuery('#flyout-trigger').toggleClass('nav-trigger-animate');
                jQuery('#site-overlay').toggleClass('invisible');
            }
        }

    } // End toggleFlyout()

    // toggle the flyout nav
    jQuery('#flyout-trigger').click(function() {
        toggleFlyout();
    });

    jQuery('#flyout-nav a, .site-overlay').click(function() {
        toggleFlyout(0);
    });

}); // End window.load

/******************************************************************
Opera Flyout Nav
******************************************************************/

jQuery(document).ready(function() {

    // Our custom control panel nav doesn't work in Opera, so we need a fallback
    function operaNav() {

        jQuery('#cp-trigger').hide(); // hide the regular cp-canvas nav trigger
        jQuery('#flyout-trigger').show().addClass('opera-trigger'); // show the mobile off-canvas nav trigger

    } // End operaNav()

    // are we browsing with Opera?
    if (isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0) { 
        // yes
        operaNav();
    } else {
        // no
    }

}); // End document.ready


jQuery(window).load(function(){

var highest = null;
var hi = 0;
jQuery(".welcome-content").each(function(){
  var h = jQuery(this).outerHeight();
  if(h > hi){
     hi = h;
     highest = jQuery(this);  
  }
  jQuery(this).css("height", hi)    
});

}); // End window.load

/******************************************************************
Animate Numbers
******************************************************************/

/** @preserve jQuery animateNumber plugin v0.0.10
 * (c) 2013, Alexandr Borisov.
 * https://github.com/aishek/jquery-animateNumber
 */

// ['...'] notation using to avoid names minification by Google Closure Compiler
(function($) {
  var reverse = function(value) {
    return value.split('').reverse().join('');
  };

  var defaults = {
    numberStep: function(now, tween) {
      var floored_number = Math.floor(now),
          target = jQuery(tween.elem);

      target.text(floored_number);
    }
  };

  var handle = function( tween ) {
    var elem = tween.elem;
    if ( elem.nodeType && elem.parentNode ) {
      var handler = elem._animateNumberSetter;
      if (!handler) {
        handler = defaults.numberStep;
      }
      handler(tween.now, tween);
    }
  };

  if (!$.Tween || !$.Tween.propHooks) {
    $.fx.step.number = handle;
  } else {
    $.Tween.propHooks.number = {
      set: handle
    };
  }

  var extract_number_parts = function(separated_number, group_length) {
    var numbers = separated_number.split('').reverse(),
        number_parts = [],
        current_number_part,
        current_index,
        q;

    for(var i = 0, l = Math.ceil(separated_number.length / group_length); i < l; i++) {
      current_number_part = '';
      for(q = 0; q < group_length; q++) {
        current_index = i * group_length + q;
        if (current_index === separated_number.length) {
          break;
        }

        current_number_part = current_number_part + numbers[current_index];
      }
      number_parts.push(current_number_part);
    }

    return number_parts;
  };

  var remove_precending_zeros = function(number_parts) {
    var last_index = number_parts.length - 1,
        last = reverse(number_parts[last_index]);

    number_parts[last_index] = reverse(parseInt(last, 10).toString());
    return number_parts;
  };

  $.animateNumber = {
    numberStepFactories: {
      /**
       * Creates numberStep handler, which appends string to floored animated number on each step.
       *
       * @example
       * // will animate to 100 with "1 %", "2 %", "3 %", ...
       * jQuery('#someid').animateNumber({
       *   number: 100,
       *   numberStep: $.animateNumber.numberStepFactories.append(' %')
       * });
       *
       * @params {String} suffix string to append to animated number
       * @returns {Function} numberStep-compatible function for use in animateNumber's parameters
       */
      append: function(suffix) {
        return function(now, tween) {
          var floored_number = Math.floor(now),
              target = jQuery(tween.elem);

          target.prop('number', now).text(floored_number + suffix);
        };
      },

      /**
       * Creates numberStep handler, which format floored numbers by separating them to groups.
       *
       * @example
       * // will animate with 1 ... 217,980 ... 95,217,980 ... 7,095,217,980
       * jQuery('#world-population').animateNumber({
       *    number: 7095217980,
       *    numberStep: $.animateNumber.numberStepFactories.separator(',')
       * });
       *
       * @params {String} [separator=' '] string to separate number groups
       * @params {String} [group_length=3] number group length
       * @returns {Function} numberStep-compatible function for use in animateNumber's parameters
       */
      separator: function(separator, group_length) {
        separator = separator || ' ';
        group_length = group_length || 3;

        return function(now, tween) {
          var floored_number = Math.floor(now),
              separated_number = floored_number.toString(),
              target = jQuery(tween.elem);

          if (separated_number.length > group_length) {
            var number_parts = extract_number_parts(separated_number, group_length);

            separated_number = remove_precending_zeros(number_parts).join(separator);
            separated_number = reverse(separated_number);
          }

          target.prop('number', now).text(separated_number);
        };
      }
    }
  };

  $.fn.animateNumber = function() {
    var options = arguments[0],
        settings = $.extend({}, defaults, options),

        target = jQuery(this),
        args = [settings];

    for(var i = 1, l = arguments.length; i < l; i++) {
      args.push(arguments[i]);
    }

    // needs of custom step function usage
    if (options.numberStep) {
      // assigns custom step functions
      var items = this.each(function(){
        this._animateNumberSetter = options.numberStep;
      });

      // cleanup of custom step functions after animation
      var generic_complete = settings.complete;
      settings.complete = function() {
        items.each(function(){
          delete this._animateNumberSetter;
        });

        if ( generic_complete ) {
          generic_complete.apply(this, arguments);
        }
      };
    }

    return target.animate.apply(target, args);
  };

}(jQuery));

/******************************************************************
Stats Animated Numbers
******************************************************************/

stat = jQuery('[id^="stat-"]');

var statsDone = true;

	/*jQuery(function($) {
		$(".fact").appear(function(){
			$('.fact').each(function(){
		       	var dataperc = $(this).attr('data-perc');
				$(this).find('.factor').delay(6000).countTo({
			        from: 0,
			        to: dataperc,
			        speed: 3000,
			        refreshInterval: 50,
	            
        		});  
			});
		});
	});*/

jQuery(window).on("load scroll", function(d,h) {
	var a , b;
    stat.each(function(i) {
        a = jQuery(this).offset().top + jQuery(this).height();
        b = jQuery(window).scrollTop() + jQuery(window).height();
        /*statSep = $.animateNumber.numberStepFactories.separator(',');*/
        attrStat = jQuery(this).attr('data-val');
        if (a < b) {
				if(!jQuery(this).hasClass( "inactive" )){
					jQuery(this).countTo({
						from: 0,
						to: attrStat,
						speed: 2000,
						refreshInterval: 50,
	            
					});
					jQuery(this).addClass("inactive");
				}

        }
    });
});

/******************************************************************
Scroll Spy
******************************************************************/

jQuery(window).load(function(){

  // http://jsfiddle.net/mekwall/up4nu/

  // Cache selectors
  var lastId,
      topMenu = jQuery(".main-nav ul, #cp-nav ul"),
      topMenuHeight = topMenu.outerHeight()+15,
      // All list items
      menuItems = topMenu.find("a"),
      // Anchors corresponding to menu items
      scrollItems = menuItems.map(function(){
        var item = jQuery(jQuery(this).attr("href"));
        if (item.length) { return item; }
      });

  // Bind to scroll
  jQuery(window).scroll(function(){
     // Get container scroll position
     var fromTop = jQuery(this).scrollTop()+topMenuHeight;
     
     // Get id of current scroll item
     var cur = scrollItems.map(function(){
       if (jQuery(this).offset().top < fromTop)
         return this;
     });
     // Get the id of the current element
     cur = cur[cur.length-1];
     var id = cur && cur.length ? cur[0].id : "";
     
     if (lastId !== id) {
         lastId = id;
         // Set/remove active class
         menuItems
           .parent().removeClass("active")
           .end().filter("[href=#"+id+"]").parent().addClass("active");
     }                   
  });

}); // End window.load