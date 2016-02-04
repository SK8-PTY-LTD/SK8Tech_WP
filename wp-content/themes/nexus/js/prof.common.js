jQuery(document).ready(function($){

"use strict";
	var TimeValue = '';
	
	$(window).scroll(function () {
        if ($(window).scrollTop() > 600) {
            $("#back-top").fadeIn(200);
        } else {
            $("#back-top").fadeOut(200);
        }
    });
    $('#back-top').click(function () {
	    $('html,body').animate({ scrollTop: 0 }, 1500);
        return false; 
    });
	
	$("a.mouse").click(function() {
		$('html, body').animate({
			scrollTop: $("#contentWrap").offset().top - 50
		}, 1500);
		return false;
	});	
	
	$(window).scroll(function () {
        if ($(window).scrollTop() > 100) {
            $(".app-header").addClass("app-header-sticky");
        } else {
            $(".app-header").removeClass("app-header-sticky");
        }
    });	
	
	
	$(".nexus-single-row").each(function() {
		$(this).wrapInner("<div class='homepage-container-design-inner'></div>");
	});
	  
	
	$(".product-summary .cart .single_add_to_cart_button").each(function() {
		$(this).append('<i class="fa fa-shopping-cart fa-white"></i>');
	});
	
	
	$(".single-product .shop .alert .button").each(function() {
		$(this).append('<i class="fa fa-shopping-cart"></i>');
	});
	

	var checkExist = setInterval(function() {
	   if ($('.tweet-details time').length) {
			$(".tweet-details time").each(function() {
				TimeValue = $(this).attr('data-loctitle');
				$(this).text();
				$(this).timeago();
				$(this).prepend('<i class="fa fa-twitter"></i>');
			});	
			clearInterval(checkExist);
	   }
	}, 1000);
	
	$(".dropdown.cart-nav").mouseover(function() {
		$(this).find(".cart_list.dropdown-menu").addClass("insperia-open");
		$(this).find("ul.cart_list.product_list_widget").addClass("insperia-open");
	  }).mouseout(function(){	
		$(this).find(".cart_list.dropdown-menu").removeClass("insperia-open");
		$(this).find("ul.cart_list.product_list_widget").removeClass("insperia-open");
	});


	$(".nav.navbar-nav .page_item_has_children").mouseover(function() {
		$(this).addClass("open");
	  }).mouseout(function(){	
		$(this).removeClass("open");
	});

	$("a.add_to_cart_button").live("click",function() {
		setTimeout(function() {
			$("html, body").animate({ scrollTop: 0 },"slow");
		}, 1000);	
		
		setTimeout(function() {
			$(".dropdown.cart-nav .cart_list.dropdown-menu").addClass("insperia-open");
		}, 2000);			
		
		setTimeout(function() {
			$(".dropdown.cart-nav .cart_list.dropdown-menu").removeClass("insperia-open");
		}, 5000);
		return false;
	});		
	
	
});


jQuery(window).load(function(){
	jQuery('.loading-wrapper').removeClass('active');
	jQuery('.app-header , .hero, #contentWrap').removeClass('activehide');
	
	setTimeout(function(){
		jQuery('section.hero').removeClass('inactive');
	}, 600)
}); 
