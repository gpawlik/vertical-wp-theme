/*
 * jquery.custom.js
 * 
 * Custom scripts.
 * 
 */
 
jQuery(document).ready(function($) {
            
    /* Custom scrollbars */
    $(window).resize(function() {
        changeMenuHeight();      
    });
    changeMenuHeight();
    jQuery("#main-navigationx").customScrollbar({
        skin: "default-skin", 
        hScroll: false,
        updateOnWindowResize: true
    });    

/* ---------------------------------------------------
	Navigation
-------------------------------------------------- */	

	$("#main-navigation a").removeAttr("title");
	$("#main-navigation li ul").css({display: "none"}); // Opera Fix
	$("#main-navigation ul > li").hover(function(){
		$(this).find('ul:first').css({visibility: "visible", display: "none"}).fadeIn(250);
	},function(){
		$(this).find('ul:first').css({visibility: "hidden"});
	});
	
	$("#main-navigation > ul > li").hover(function(){
		$(this).addClass("hover");
	},function(){
		$(this).removeClass("hover");
	});
	
	/* --- Select navigation for mobile --- */	
	$("#main-navigation a").each(function() {
		var el = $(this);
		
		var level8 = el.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent();
		var level7 = el.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent();
		var level6 = el.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent();
		var level5 = el.parent().parent().parent().parent().parent().parent().parent().parent();
		var level4 = el.parent().parent().parent().parent().parent().parent();
		var level3 = el.parent().parent().parent().parent();
		var level2 = el.parent().parent();

		var text;
		
		if ( level8.hasClass('sub-menu') ) {
			text = '------- ' + el.text();
		} else if ( level7.hasClass('sub-menu') ) {
			text = '------ ' + el.text();
		} else if ( level6.hasClass('sub-menu') ) {
			text = '----- ' + el.text();
		} else if ( level5.hasClass('sub-menu') ) {
			text = '---- ' + el.text();
		} else if ( level4.hasClass('sub-menu') ) {
			text = '--- ' + el.text();
		} else if ( level3.hasClass('sub-menu') ) {
			text = '-- ' + el.text();
		} else if ( level2.hasClass('sub-menu') ) {
			text = '- ' + el.text();
		} else {
			text = el.text();
		}
		
		$("<option />", {
			"value"   : el.attr("href"),
			"text"    : text
		}).appendTo("#mobile-navigation");
		
	});
	
	$("#main-navigation select").change(function() {
		window.location = $(this).find("option:selected").val();
	});
	
	
/* ---------------------------------------------------
	Toggle Content
-------------------------------------------------- */

	$(".toggle-content .expand-button").click(function() {
		$(this).toggleClass('close').parent('div').find('.expand').slideToggle(250);
	});


/* ---------------------------------------------------
	Portfolio
-------------------------------------------------- */
	
	/* ---- Remove title attribute from grid links -- */
	$('#portfolio-grid .item-link').removeAttr('title');
	
	if($.isFunction($.fn.isotope)){
		
		$(window).load(function(){
			$('#portfolio-grid').isotope({
				itemSelector:	'.type-portfolio',
				layoutMode:		'fitRows'
			});
		});
		
		/* ---- Filtering ----- */
		$('#filter a').click(function(){
		
			var $this = $(this);
			
			if ( $this.hasClass('selected') ) {
			  
				return false;
			  
			} else {
				
				$('#filter .selected').removeClass('selected');
				
				var selector = $this.attr('data-filter');
				$('#portfolio-grid').isotope({ filter: selector });
				$this.addClass('selected');
				return false;
			
			}
		});		
	
	}
	
	
	/* ---- Colorbox ----- */
	if($.isFunction($.fn.colorbox)){
		
		jQuery.ajaxSettings.async = false;
		
		// Check window size when page is loaded. Do not use lightbox on small screens.
		if ( $(window).width() > 1024 ) {
		
			$('a[rel^="colorbox"]').colorbox();
			
			$('a[rel^="colorbox-portfolio"]').colorbox({
				href			: function(){
									return $(this).attr('href') + ' #content';				
								},
				rel				: 'colorbox',
				overlayClose	: false,
				transition		: "fade",
				current			: ""				
			});
			
			$('#two-column-gallery a[rel^="gallery"], .gallery-item a').colorbox({
				current		: '{current} of {total}',
				rel			: 'gallery'				
			});
	
			$(document).bind('cbox_complete', function () {
			
				// MediaElement
				if($.isFunction($.fn.mediaelementplayer)){
					$("audio, video").mediaelementplayer();
				}
				
				// FitVids
				if($.isFunction($.fn.fitVids)){
					$("body").fitVids();
				}
				
				// Resize after images have loaded					
				$('#colorbox').imagesLoaded().done( function() {
					if ( $("#colorbox .mejs-container").length > 0 ) {
						height: $('#cboxContent').height() + 100
					} else {					
						$.colorbox.resize();				
					}			
				});
				
			});
		
		}		
	
	}
	
	
/* ---------------------------------------------------
	Blog Index
-------------------------------------------------- */
	
	if($.isFunction($.fn.isotope)){
		
		var mosaic = false;
		
		$(window).load(function(){
			if ( $(window).width() > 1024 ) {
				$('#blog-grid').isotope({ 
					layoutMode : 'masonry'
				});
				mosaic = true;			
			}
		});
		
		/* Remove isotope when window is small */
	
		$(window).resize(function() {
			
			if ( $('#blog-grid') ) {
				
				if ( $(window).width() > 480 && mosaic == true ) {
					
					$('#blog-grid').isotope( 'reLayout' );
					mosaic = true;

				} else if ( $(window).width() > 480 && mosaic == false ) {
					
					$('#blog-grid').isotope({ 
						layoutMode : 'masonry'
					});
					
					mosaic = true;
				
				} else if ( $(window).width() <= 480 && mosaic == true ) {				
					
					$('#blog-grid').isotope( 'destroy' );
					mosaic = false;
					
				}
				
			}
			
		});
		
		
	}
	
	
	$('#blog-grid .item-link').hover(function() {
		$(this).parent().stop().animate({ opacity : 0.75 }, 250 );
	}, function() {
		$(this).parent().stop().animate({ opacity : 1 }, 250 );
	});
	

/* ---------------------------------------------------
	Image Gallery
-------------------------------------------------- */
	
	$('.gallery-image-link span').css({visibility: "visible", opacity: 0 });
	
	$('.gallery-image-link').hover(function() {
		$('span', this).stop().animate({ opacity : 1 }, 250 );
	}, function() {
		$('span', this).stop().animate({ opacity : 0 }, 250 );
	});
	
	
/* ---------------------------------------------------
	Contact Form Validation 
-------------------------------------------------- */
	
	if(jQuery.isFunction(jQuery.fn.validate)){
		$("#contactForm").validate();
	}


/* ---------------------------------------------------
	Flexslider
-------------------------------------------------- */

	if(jQuery.isFunction(jQuery.fn.flexslider)){
		$('#slider').flexslider({
			directionNav: false
		});
	}

	
/* ---------------------------------------------------
	Share Box
-------------------------------------------------- */
	
	$('.share').click(function() {
		$(this).find('.share-holder').fadeToggle('slow');
		return false;
	});
	
	
/* ---------------------------------------------------
	Social Buttons
-------------------------------------------------- */

	$('.social-button-holder a').hover(function() {
		$(this).stop().animate({ opacity : 0.75 }, 250 );
	}, function() {
		$(this).stop().animate({ opacity : 1 }, 250 );
	});
        
        
/* ---------------------------------------------------
	Footer image animation
-------------------------------------------------- */

        $('#gp-profile-footer').click(function(e){
            e.preventDefault();
            $(this).profilize();
        });
        $(window).scroll(function(){
            $('#gp-profile-footer').profilize();
        });       

	
/* ---------------------------------------------------
	Contact Form Validation 
-------------------------------------------------- */
	
	if(jQuery.isFunction(jQuery.fn.validate)){
		$("#contactform").validate();
	}
	
    
});

/* Simple animation of profile picture */
jQuery.fn.profilize = function() {
    var $el = this;
    var items = parseInt($el.attr('data-limit'));
    var current_image = parseInt($el.attr('data-item'));
    var new_image = current_image + 1;

    if(new_image > items) new_image = 1;
    setTimeout(function() {
        $el.attr('data-item', new_image).removeClass().addClass('profile' + new_image);
    }, 100);    
};

/* Menu height control */
function changeMenuHeight() {
    var sidebarHeight = jQuery("#sidebar").height();
    var logoHeight    = jQuery("#logo").height();
    var socialHeight  = jQuery("social-button-holder").height();
    var navHeight = sidebarHeight - (logoHeight + socialHeight + 100);    
    jQuery("#main-navigation").height(navHeight); 
};


