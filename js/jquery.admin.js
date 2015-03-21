jQuery(document).ready(function($) {

/*----------------------------------------------------------------------------------*/
/*	Template Options
/*----------------------------------------------------------------------------------*/
	
	var templateTrigger = $('#page_template');
	
	// Contact
	var contactOptions = $('#contact-options-box');
	contactOptions.css('display', 'none');
	
	// Portfolio
	var portfolioOptions = $('#portfolio-options-box');
	portfolioOptions.css('display', 'none');
	
	if (templateTrigger.val() == 'page-contact.php') {
		contactOptions.css('display', 'block');
	} else if (templateTrigger.val() == 'page-portfolio.php') {
		portfolioOptions.css('display', 'block');		
	}
	
	templateTrigger.change( function() {
		
		if ($(this).val() == 'page-contact.php') {
			contactOptions.css('display', 'block');
			refreshTemplateOptions(contactOptions);	
		} else if ($(this).val() == 'page-portfolio.php') {
			portfolioOptions.css('display', 'block');
			refreshTemplateOptions(portfolioOptions);	
		} else {			
			contactOptions.css('display', 'none');
			portfolioOptions.css('display', 'none');
		}
		
	});
	
	function refreshTemplateOptions(selected) {			
		contactOptions.css('display', 'none');
		portfolioOptions.css('display', 'none');
		selected.css('display', 'block');
	}
	
	
/*----------------------------------------------------------------------------------*/
/*	Background
/*----------------------------------------------------------------------------------*/
	
	var backgroundURLOption = $('#reach_background_url').closest('tr');
	var backgroundURLtrigger = $('[name="reach_background"]');
	
	if ( backgroundURLtrigger.val() != "url" ) {
		backgroundURLOption.css('display', 'none');
	}
	
	backgroundURLtrigger.change( function() {
		if( $(this).val() == 'url' ) {
			backgroundURLOption.css('display', 'table row');
			backgroundURLOption.slideDown();
		} else {
			backgroundURLOption.css('display', 'none');
		}
	});
	
/*----------------------------------------------------------------------------------*/
/*	Slider
/*----------------------------------------------------------------------------------*/
	
	var sliderOption = $('[name="reach_slide_category"]').closest('tr');
	var slidertrigger = $('[name="reach_enable_slider"]');

	if ( slidertrigger.is(':checked') ) {
		sliderOption.css('display', 'table row');
	} else {
		sliderOption.css('display', 'none');
	}	
	
	slidertrigger.change( function() {
		if( slidertrigger.is(':checked') ) {
			sliderOption.css('display', 'table row');
			sliderOption.slideDown();
		} else {
			sliderOption.css('display', 'none');
		}
	});
	
/*----------------------------------------------------------------------------------*/
/*	Post Formats
/*----------------------------------------------------------------------------------*/
	
	// Audio
	var audioOptions = $('#audio-options-box');
	var audioTrigger = $('#post-format-audio');
	audioOptions.css('display', 'none');

	// Link Options
	var linkOptions = $('#link-options-box');
	var linkTrigger = $('#post-format-link');
	linkOptions.css('display', 'none');

	// Quote Options
	var quoteOptions = $('#quote-options-box');
	var quoteTrigger = $('#post-format-quote');
	quoteOptions.css('display', 'none');

	// Video Options
	var videoOptions = $('#video-options-box');
	var videoTrigger = $('#post-format-video');
	videoOptions.css('display', 'none');

	if(quoteTrigger.is(':checked')) {
		quoteOptions.css('display', 'block');
	}
	if(linkTrigger.is(':checked')) {
		linkOptions.css('display', 'block');
	}
	if(audioTrigger.is(':checked')) {
		audioOptions.css('display', 'block');
	}
	if(videoTrigger.is(':checked')) {
		videoOptions.css('display', 'block');
	}
	
	var buttons = $('#post-formats-select input');
	buttons.change( function() {
		
		if($(this).val() == 'quote') {
			quoteOptions.css('display', 'block');
			refreshPostOptions(quoteOptions);			
		} else if($(this).val() == 'link') {
			linkOptions.css('display', 'block');
			refreshPostOptions(linkOptions);			
		} else if($(this).val() == 'audio') {
			audioOptions.css('display', 'block');
			refreshPostOptions(audioOptions);			
		} else if($(this).val() == 'video') {
			videoOptions.css('display', 'block');
			refreshPostOptions(videoOptions);			
		} else {
			quoteOptions.css('display', 'none');
			videoOptions.css('display', 'none');
			linkOptions.css('display', 'none');
			audioOptions.css('display', 'none');
		}
		
	});	
	
	function refreshPostOptions(selected) {
		videoOptions.css('display', 'none');
		quoteOptions.css('display', 'none');
		linkOptions.css('display', 'none');
		audioOptions.css('display', 'none');	
		selected.css('display', 'block');
	}		

/*----------------------------------------------------------------------------------
Portfolio
----------------------------------------------------------------------------------*/

	if ($('#post_type').val() === 'portfolio') {

		/**
		 * Hide unused post formats
		 **/
		$ ('#post-format-aside, #post-format-aside + label, #post-format-aside + label + br, #post-format-chat, #post-format-chat + label, #post-format-chat + label + br, #post-format-image, #post-format-image + label, #post-format-image + label + br, #post-format-link, #post-format-link + label, #post-format-link + label + br, #post-format-quote, #post-format-quote + label, #post-format-quote + label + br, #post-format-status, #post-format-status + label, #post-format-status + label + br').css('display', 'none');
		
	}
	
});