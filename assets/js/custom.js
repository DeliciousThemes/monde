jQuery(document).ready( function() {
	'use strict';

	//topbar fix 
	var monde_topbar = jQuery('.topbar');
	var monde_topbar_height = jQuery('.topbar').outerHeight();
	var monde_site_branding = jQuery('.site-branding');
	monde_site_branding.css({'margin-top': monde_topbar_height});
	jQuery('.searchform-wrapper, .searchform-switch').css({'height': monde_topbar_height});
	jQuery('.searchform-switch i').css({'line-height': monde_topbar_height+'px'});
	jQuery('.searchform-wrapper .search-form').css({'top': monde_topbar_height});
	monde_topbar.css({'position': 'fixed'});

	// to top btn
	var monde_offset = 500,
	monde_backtotop = jQuery('.upbtn');

	jQuery(window).scroll(function(){
		( jQuery(this).scrollTop() > monde_offset ) ? monde_backtotop.addClass('dt-is-visible') : monde_backtotop.removeClass('dt-is-visible');
	});	
	monde_backtotop.on('click', function(){
        jQuery("html, body").animate({ scrollTop: 0 }, 700);
        return false;
    });			


    // swiper
	var dazzle_swiper = new Swiper ('.swiper-container', {
	    loop: true,
	    pagination: '.swiper-pagination',
	    spaceBetween: 4,
	    slidesPerView: 'auto',
	    centeredSlides: true,
	    roundLengths: true,
	    grabCursor: true,
	    // Navigation arrows
	    nextButton: '.swiper-button-next',
	    prevButton: '.swiper-button-prev',
	});


	// searchform
	var $searchformfatimes = jQuery(".searchform-switch .fa-times-circle");
	var $searchformfasearch = jQuery(".searchform-switch .fa-search");
	var $searchform = jQuery(".searchform-wrapper .search-form");

	$searchform.addClass("display-none");

	$searchformfatimes.fadeOut();
	$searchformfasearch.on('click', function () {
		$searchformfasearch.fadeOut("slow");
		
		$searchform.fadeIn("slow", function(){
			  jQuery(this).removeClass("display-none");
		});
		$searchformfatimes.fadeIn("slow");
	});
	
	$searchformfatimes.on('click', function () {
		$searchformfatimes.fadeOut("slow");
		$searchform.fadeOut("slow", function(){
			  jQuery(this).addClass("display-none");
		});			
		$searchformfasearch.fadeIn("slow");
	});			
});