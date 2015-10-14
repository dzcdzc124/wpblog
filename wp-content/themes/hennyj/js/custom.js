jQuery( document ).ready(function() {

	jQuery("#respond").addClass("col-sm-12");
	
	jQuery(window).load(function() {
	jQuery('.flexslider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: true,
	directionNav: true,
	keyboard: true,
	smoothHeight: true,
	 before: function(slider) {
		next_ht = jQuery(slider.slides[slider.animatingTo]).height();
		jQuery( '.flexslider' ).height('auto');
		slider.args['height'] = next_ht;
		},
	after: function(slider) {
		after_ht = jQuery(slider.slides[slider.animatingTo]).height();
		jQuery( '.flexslider' ).css( 'height', after_ht );
		}
	});
		});
		
	
	
	// Tiles Gallery
	jQuery('.tiles').tilesGallery({
        tileMinHeight: 200,
		margin: 0,
	});
    
	// Search Button Effect
    jQuery('a[href="#search"]').on('click', function(event) {
        event.preventDefault();
        jQuery('#search').addClass('open');
        jQuery('#search > form > input[type="search"]').focus();
    });
    
    jQuery('#search, #search button.close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            jQuery(this).removeClass('open');
        }
    });
    
	//Menu Effect
	var touch  = jQuery('#resp-menu');
	var menu  = jQuery('.nav-menu');
 
	jQuery(touch).on('click', function(e) {
		e.preventDefault();
	menu.slideToggle();
	});
 
	jQuery(window).resize(function(){
		var w = jQuery(window).width();
		if(w > 767 && menu.is(':hidden')) {
		menu.removeAttr('style');
	}
	});
	
   
});