<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
	
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Set the Options Array
	$options = array();
	
	// ------------------------------------
	//	ENVATO API
	// ------------------------------------
	/*
	$options[] = array( "name"	=> __( "Envato API Settings", "funky_theme" ),
						"desc"	=> __( "Envato API settings used to enable theme updating.", "funky_theme" ),
						"type"	=> "heading" );
						
		// Envato Username
		$options[] = array( "name"	=> __( "Envato Username", "funky_theme" ),
							"desc"	=> __( "The Envato username of the account used to purchase the theme.", "funky_theme" ),
							"id"	=> "envato_username",
							"std"	=> "",
							"type"	=> "text" );
						
		// Envato API Key
		$options[] = array( "name"	=> __( "Envato API Key", "funky_theme" ),
							"desc"	=> __( "The API key of the account used to purchase the theme.", "funky_theme" ),
							"id"	=> "envato_apikey",
							"std"	=> "",
							"type"	=> "text" );
	*/						
								
	// ------------------------------------
	//	APPEARANCE SETTINGS
	// ------------------------------------
	$options[] = array( "name"	=> __("Appearance Settings", "raw_theme"),
						"type"	=> "heading" );
		
		// Default Background
		$options['default_background'] = array( "name"	=> __("Default Background Image", "raw_theme"),
												"desc"	=> __("Upload the image you wish to use as the default background for your website. Leave this option blank to use <a href='wp-admin/themes.php?page=custom-background'>WordPress custom background</a> as your default background. Once the image is uploaded click the \"Use This Image\" button.", "raw_theme"),
												"short_desc"=> __( "Default background image", "raw_theme" ),
												"id"	=> "default_background",
												"std"	=> "",
												"type"	=> "upload");						
		
		// Custom Logo				
		$options['logo'] = array(	"name"	=> __("Site Logo", "raw_theme"),
									"desc"	=> __("Upload or specify the file URL for the logo that will appear in your website's header (max width: 180px) e.g. (http://yoursite.com/logo.png)", "raw_theme"),
									"short_desc"=> __( "Site logo", "raw_theme" ),
									"id"	=> "logo",
									"std"	=> "",
									"type"	=> "upload");

		// Custom Mobile Logo				
		$options[] = array( "name"	=> __("Custom Mobile Logo", "raw_theme"),
							"desc"	=> __("Upload or specify the file URL for the logo that will appear in your website's header on small screen devices (max width: 180px) e.g. (http://yoursite.com/logo.png)", "raw_theme"),
							"id"	=> "mobile_logo",
							"std"	=> "",
							"type"	=> "upload");	
							
		// Custom Favicon
		$options[] = array( "name"	=> __("Custom Favicon", "raw_theme"),
							"desc"	=> __("Upload a 16px x 16px PNG/Gif image that will represent your website's favicon.", "raw_theme"),
							"id"	=> "custom_favicon",
							"std"	=> "",
							"type"	=> "upload"); 
		
		// Apple Icons
		$options[] = array( "name"	=> __( "Apple Bookmark Icons", "funky_theme" ),
							"desc"	=> "Upload or enter the file URL for the Apple bookmark icon .png images.",
							"type"	=> "info");
						
		// Custom Apple Icon (57x57)
		$options[] = array( "desc"	=> __( "Non Retina iPhones (57x57px).", "funky_theme" ),
							"id"	=> "apple_bookmark_57",
							"type"	=> "upload" );
		
		// Custom Apple Icon (114x114)
		$options[] = array( "desc"	=> __( "Retina iPhones (114x114px).", "funky_theme" ),
							"id"	=> "apple_bookmark_114",
							"type"	=> "upload" );
		
		// Custom Apple Icon (72x72)
		$options[] = array( "desc"	=> __( "Non Retina iPads (72x72px).", "funky_theme" ),
							"id"	=> "apple_bookmark_72",
							"type"	=> "upload" );
							
		// Custom Apple Icon (144x144)
		$options[] = array( "desc"	=> __( "Retina iPads (144x144px).", "funky_theme" ),
							"id"	=> "apple_bookmark_144",
							"type"	=> "upload" );
		
		// Custom CSS
		$options['custom_css'] = array( "name"	=> __("Custom CSS", "raw_theme"),
										"desc"	=> __("Place any custom CSS above. This overrides any other stylesheets. Note this is intended for small pieces of CSS only. eg: a.button{color: #FFF}", "raw_theme"),
										"short_desc"=> __( "Custom CSS", "raw_theme" ),
										"id"	=> "custom_css",
										"std"	=> "",
										"type"	=> "textarea");
		
		// Blog Layout
		$options['blog_layout'] = array(	"name"		=> __("Blog Layout", "raw_theme"),
											"desc"		=> __("Select the blog page layout. \"Mosaic Grid\" arranges posts using the jQuery Masonry plugin.", "raw_theme"),
											"short_desc"=> __( "Blog layout", "raw_theme" ),
											"id"		=> "blog_layout",
											"options"	=> array(  __("Mosaic Grid", "raw_theme"),  __("Traditional", "raw_theme") ),
											"std"		=> "Mosaic Grid",
											"type"		=> "select");
						
		// Archive Layout
		$options['archive_layout'] = array( "name"		=> __("Archive Layout", "raw_theme"),
											"desc"		=> __("Select the post archive page layout. \"Mosaic Grid\" arranges posts using the jQuery Masonry plugin.", "raw_theme"),
											"short_desc"=> __( "Archive layout", "raw_theme" ),
											"id"		=> "archive_layout",
											"options" 	=> array(  __("Mosaic Grid", "raw_theme"),  __("Traditional", "raw_theme") ),
											"std" 		=> "Mosaic Grid",
											"type"		=> "select");
						
	
		$options[] = array( "name"	=> __( "Post Meta Options", "raw_theme" ),
							"desc"	=> "The following options are used to adjust the layout of posts.",
							"type"	=> "info");
							
			// Author meta
			$options['author_meta'] = array( "desc"		=> __( "Show post author.", "raw_theme" ),
											"short_desc"=> __( "Show post author", "raw_theme" ),
											"id"		=> "author_meta",
											"std"		=> "true",
											"type"		=> "checkbox");
						
			// Date meta
			$options['date_meta'] = array( "desc"		=> __( "Show post date.", "raw_theme" ),
											"short_desc"=> __( "Show post date", "raw_theme" ),
											"id"		=> "date_meta",
											"std"		=> "true",
											"type"		=> "checkbox" );
		
			// Category meta
			$options['category_meta'] = array(	"desc"		=> __( "Show post category.", "raw_theme" ),
												"short_desc"=> __( "Show post category", "raw_theme" ),
												"id"		=> "category_meta",
												"std"		=> "true",
												"type"		=> "checkbox" );
						
			// Comments meta
			$options['comments_meta'] = array( "desc"		=> __( "Show number of comments.", "raw_theme" ),
												"short_desc"=> __( "Show number of comments", "raw_theme" ),
												"id"		=> "comments_meta",
												"std"		=> "true",
												"type"		=> "checkbox" );
			
			// Share links meta
			$options['share_meta'] = array( "desc"		=> __( "Show share links on posts.", "raw_theme" ),
											"short_desc"=> __( "Show share links on posts", "raw_theme" ),
											"id"		=> "comments_meta",
											"std"		=> "true",
											"type"		=> "checkbox" );			
		
			// Tags
			$options['tag_meta'] = array(	"desc"		=> __( "Show post tags.", "funky_theme" ),
											"short_desc"=> __( "Show post tags", "funky_theme" ),
											"id"		=> "tag_meta",
											"std"		=> "true",
											"type"		=> "checkbox" );
	
	// ------------------------------------
	//	COLOUR SETTINGS
	// ------------------------------------
	
	$options[] = array( "name" => __("Colour Settings", "raw_theme"),
						"type" => "heading" );
		
		// Base Colour Scheme
		$options['colour_scheme'] = array(	"name"		=> __("Colour Scheme", "raw_theme"),
											"desc"		=> __("Select a colour scheme.", "raw_theme"),
											"short_desc"=> __( "Colour scheme", "raw_theme" ),
											"id"		=> "colour_scheme",
											"options"	=> array( __("Dark", "raw_theme"), __("Light", "raw_theme") ),
											"std"		=> "Dark",
											"type"		=> "select");			
		
		// Links
		$options['colour_links'] = array(	"name"	=> __( "Links", "raw_theme"),
											"desc"	=> __( "Link text colour.", "raw_theme"),
											"short_desc"=> __( "Link text colour", "raw_theme" ),
											"id"	=> "colour_links",
											"std"	=> "#F57A30",
											"type"	=> "color");
						
		// Link Hover
		$options['colour_link_hover'] = array(	"desc"	=> __( "Link text hover colour.", "raw_theme"),
												"short_desc"=> __( "Link text hover colour", "raw_theme" ),
												"id"	=> "colour_link_hover",
												"std"	=> "#3297FD",
												"type"	=> "color");	
		
		// Buttons
		$options['colour_buttons'] = array(	"name"	=> __( "Buttons", "raw_theme"),
											"desc"	=> __( "Button background colour.", "raw_theme"),
											"short_desc"=> __( "Button background colour", "raw_theme" ),
											"id"	=> "colour_buttons",
											"std"	=> "#F57A30",
											"type"	=> "color");	
						
		// Buttons Text
		$options['colour_buttons_text'] = array(	"desc"	=> __( "Button text colour.", "raw_theme"),
													"short_desc"=> __( "Button text colour", "raw_theme" ),
													"id"	=> "colour_buttons_text",
													"std"	=> "#FFFFFF",
													"type"	=> "color");	
						
	// ------------------------------------
	//	CONTACT PAGE
	// ------------------------------------
	$options[] = array( "name" => __("Contact Settings", "raw_theme"),
						"type" => "heading" );
		
		// Contact Form Address
		$options[] = array( "name"	=> __("Contact Form Address", "raw_theme"),
							"desc"	=> __("Enter the email address that contact form submissions should be sent to", "raw_theme"),
							"id"	=> "address",
							"std"	=> get_bloginfo('admin_email'),
							"type"	=> "text");	
		
		$options[] = array( "name"	=> "Contact Details Widget Settings",
							"desc"	=> "The following options are used to set the information displayed in the contact form widget and on the contact page template.",
							"type"	=> "info");
					
		// Contact Widget Address
		$options[] = array( "name"	=> __("Address", "raw_theme"),
							"desc"	=> __("Enter the address to be displayed on the contact page template", "raw_theme"),
							"id"	=> "contact_widget_address",
							"std"	=> '',
							"type"	=> "text");	
		
		// Contact Widget Phone
		$options[] = array( "name"	=> __("Telephone Number", "raw_theme"),
							"desc"	=> __("Enter the telephone number to be displayed on the contact page template", "raw_theme"),
							"id"	=> "contact_widget_phone",
							"std"	=> '',
							"type"	=> "text");	
		
		// Contact Widget Mobile
		$options[] = array( "name"	=> __("Mobile Telephone Number", "raw_theme"),
							"desc"	=> __("Enter the mobile telephone number to be displayed on the contact page template", "raw_theme"),
							"id"	=> "contact_widget_mobile",
							"std"	=> '',
							"type"	=> "text");	
		
		// Contact Widget Fax
		$options[] = array( "name"	=> __("Fax Number", "raw_theme"),
							"desc"	=> __("Enter the fax number to be displayed on the contact page template", "raw_theme"),
							"id"	=> "contact_widget_fax",
							"std"	=> '',
							"type"	=> "text");	
						
		// Contact Widget Website URL
		$options[] = array( "name"	=> __("Website URL", "raw_theme"),
							"desc"	=> __("Enter the website URL to be displayed on the contact page template", "raw_theme"),
							"id"	=> "contact_widget_website",
							"std"	=> '',
							"type"	=> "text");	
						
		// Contact Widget Email
		$options[] = array( "name"	=> __("Email Address", "raw_theme"),
							"desc"	=> __("Enter the email address to be displayed on the contact page template", "raw_theme"),
							"id"	=> "contact_widget_email",
							"std"	=> '',
							"type"	=> "text");	
	
	// ------------------------------------
	//	FOOTER SETTINGS
	// ------------------------------------
	$options[] = array( "name" => __("Footer Settings", "raw_theme"),
						"type" => "heading" );

		// Footer Text
		$options['copyright_text'] = array( "name"		=> __("Footer Text", "raw_theme"),
											"desc"		=> __("Enter the text shown below copyright symbol in the footer", "raw_theme"),
											"short_desc"=> __("Footer Text", "raw_theme"),
											"id"		=> "copyright_text",
											"std"		=> "",
											"type"		=> "text");
						
	// ------------------------------------
	//	JQUERY SETTINGS
	// ------------------------------------
	$options[] = array( "name" => __("jQuery Plugin Settings", "raw_theme"),
						"type" => "heading" );
						
		//Smooth Scroll
		$options[] = array( "name"	=> __("Smooth Scroll", "raw_theme"),
							"desc"	=> __("Select to enable Smooth Scroll jQuery plugin.", "raw_theme"),
							"id"	=> "smoothscroll",
							"std"	=> "true",
							"type"	=> "checkbox");
						
		//Colorbox
		$options[] = array( "name"	=> __("Colorbox", "raw_theme"),
							"desc"	=> __("Select to open portfolio items in colorbox.", "raw_theme"),
							"id"	=> "colorbox_portfolio",
							"std"	=> "true",
							"type"	=> "checkbox");
							
		//Colorbox
		$options[] = array( "desc"	=> __("Use theme styling for colorBox window.", "raw_theme"),
							"id"	=> "colorbox_theme_styles",
							"std"	=> "true",
							"type"	=> "checkbox");
				

	// ------------------------------------
	//	SOCIAL NETWORK SETTINGS
	// ------------------------------------
	
	$options[] = array( "name" => __("Social Networks", "raw_theme"),
						"type" => "heading" );
		
		// AddThis Profile ID
		$options[] = array( "name"	=> __("AddThis Profile ID", "raw_theme"),
							"desc"	=> __("Enter your AddThis (http://www.addthis.com/) Profile ID here", "raw_theme"),
							"id"	=> "addthis_id",
							"std"	=> "",
							"type"	=> "text");

		$options[] = array( "name"	=> "Social Network Buttons",
							"desc"	=> "Enter the URL to the social network profile each of the following buttons will link to. The social buttons are shown at the bottom of the website's navigation menu.",
							"type"	=> "info");	
							
		//Twitter
		$options['twitter'] = array(	"desc"		=> __("Twitter profile URL", "raw_theme"),
										"short_desc"=> __( "Twitter URL", "raw_theme" ),
										"id"		=> "twitter",
										"type"		=> "text" );
						
		//Facebook
		$options['facebook'] = array(	"desc"		=> __("Facebook profile URL", "raw_theme"),
										"short_desc"=> __( "Facebook URL", "raw_theme" ),
										"id"		=> "facebook",
										"type"		=> "text" );	
						
		//Google+
		$options['google_plus'] = array(	"desc"		=> __("Google+ profile URL", "raw_theme"),
											"short_desc"=> __( "Google+ URL", "raw_theme" ),
											"id"		=> "google_plus",
											"type"		=> "text" );
						
		//Dribbble
		$options['dribbble'] = array(	"desc"		=> __("Dribbble profile URL", "raw_theme"),
										"short_desc"=> __( "Dribbble URL", "raw_theme" ),
										"id"		=> "dribbble",
										"type"		=> "text" );	
						
		//LinkedIn
		$options['linkedin'] = array(	"desc"		=> __("LinkedIn profile URL", "raw_theme"),
										"short_desc"=> __( "LinkedIn URL", "raw_theme" ),
										"id"		=> "linkedin",
										"type"		=> "text" );	
						
		//YouTube
		$options['youtube'] = array(	"desc"		=> __("YouTube channel URL", "raw_theme"),
										"short_desc"=> __( "YouTube URL", "raw_theme" ),
										"id"		=> "youtube",
										"type"		=> "text" );	
						
		//Vimeo
		$options['vimeo'] = array(	"desc"		=> __("Vimeo profile URL", "raw_theme"),
									"short_desc"=> __( "Vimeo URL", "raw_theme" ),
									"id"		=> "vimeo",
									"type"		=> "text" );	
	
	return $options;
	
}

add_action( 'customize_register', 'options_theme_customizer_register' );

function options_theme_customizer_register($wp_customize) {
	
	$options = optionsframework_options();
	$optionsframework_settings = get_option( 'optionsframework' );
	$options_id = $optionsframework_settings['id'];
	
	// APPEARANCE SETTINGS
	$wp_customize->add_section( 'options_theme_customizer_appearance', array(
        'title' => __( "Appearance", "funky_theme" ),
        'priority' => 200
	));
		
		// Default Background		
		$wp_customize->add_setting( $options_id .'[default_background]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $options_id .'[default_background]', array(
			'priority'	=> 1,
			'label' 	=> $options['default_background']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[default_background]'
		)));
		
		// Logo		
		$wp_customize->add_setting( $options_id .'[logo]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $options_id .'[logo]', array(
			'priority'	=> 1,
			'label' 	=> $options['logo']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[logo]'
		)));
		
	
		// Custom CSS
		$wp_customize->add_setting( $options_id .'[custom_css]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[custom_css]', array(
			'priority'	=> 2,
			'label'		=> $options['custom_css']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[custom_css]',
			'type'		=> 'text'
		));
	
	
		// Comments meta
		$wp_customize->add_setting( $options_id .'[comments_meta]', array(
			'default'	=> $options['comments_meta']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[comments_meta]', array(
			'priority'	=> 5,
			'label'		=> $options['comments_meta']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[comments_meta]',
			'type'		=> $options['comments_meta']['type']
		));
		
		
		// Date meta
		$wp_customize->add_setting( $options_id .'[date_meta]', array(
			'default'	=> $options['date_meta']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[date_meta]', array(
			'priority'	=> 6,
			'label'		=> $options['date_meta']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[date_meta]',
			'type'		=> $options['date_meta']['type']
		));
		
		
		// Author meta
		$wp_customize->add_setting( $options_id .'[author_meta]', array(
			'default'	=> $options['author_meta']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[author_meta]', array(
			'priority'	=> 7,
			'label'		=> $options['author_meta']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[author_meta]',
			'type'		=> $options['author_meta']['type']
		));
		
		
		// Category meta
		$wp_customize->add_setting( $options_id .'[category_meta]', array(
			'default'	=> $options['category_meta']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[category_meta]', array(
			'priority'	=> 8,
			'label'		=> $options['category_meta']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[category_meta]',
			'type'		=> $options['category_meta']['type']
		));
		
		// Share Links
		$wp_customize->add_setting( $options_id .'[share_meta]', array(
			'default'	=> $options['share_meta']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[share_meta]', array(
			'priority'	=> 10,
			'label'		=> $options['share_meta']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[share_meta]',
			'type'		=> $options['share_meta']['type']
		));
		
		// Tags
		$wp_customize->add_setting( $options_id .'[tag_meta]', array(
			'default'	=> $options['tag_meta']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[tag_meta]', array(
			'priority'	=> 9,
			'label'		=> $options['tag_meta']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[tag_meta]',
			'type'		=> $options['tag_meta']['type']
		));
		
	
	// COLOUR SETTINGS
		
		// Colour Scheme
		$wp_customize->add_setting( $options_id .'[colour_scheme]', array(
			'default'	=> $options['colour_scheme']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control($options_id .'[colour_scheme]', array(
			'priority'	=> 11,
			'label'		=> $options['colour_scheme']['short_desc'],
			'section'	=> 'colors',
			'settings'	=> $options_id .'[colour_scheme]',
			'type'		=> $options['colour_scheme']['type'],
			'choices'	=> $options['colour_scheme']['options']
		));			
		
		// Links
		$wp_customize->add_setting( $options_id .'[colour_links]', array(
			'default'	=> $options['colour_links']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $options_id .'[colour_links]', array(
			'priority'	=> 12,
			'label'		=> $options['colour_links']['short_desc'],
			'section'	=> 'colors',
			'settings'	=> $options_id .'[colour_links]'
		)));
		
		
		// Link Hover
		$wp_customize->add_setting( $options_id .'[colour_link_hover]', array(
			'default'	=> $options['colour_link_hover']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $options_id .'[colour_link_hover]', array(
			'priority'	=> 13,
			'label'		=> $options['colour_link_hover']['short_desc'],
			'section'	=> 'colors',
			'settings'	=> $options_id .'[colour_link_hover]'
		)));
		
		
		// Button
		$wp_customize->add_setting( $options_id .'[colour_buttons]', array(
			'default'	=> $options['colour_buttons']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $options_id .'[colour_buttons]', array(
			'priority'	=> 14,
			'label'		=> $options['colour_buttons']['short_desc'],
			'section'	=> 'colors',
			'settings'	=> $options_id .'[colour_buttons]'
		)));
		
		
		// Button Text
		$wp_customize->add_setting( $options_id .'[colour_buttons_text]', array(
			'default'	=> $options['colour_buttons_text']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $options_id .'[colour_buttons_text]', array(
			'priority'	=> 15,
			'label'		=> $options['colour_buttons_text']['short_desc'],
			'section'	=> 'colors',
			'settings'	=> $options_id .'[colour_buttons_text]'
		)));		
		
		
	// FOOTER SETTINGS
	$wp_customize->add_section( 'options_theme_customizer_footer', array(
        'title'		=> __( "Footer", "funky_theme" ),
        'priority'	=> 202
	));	
		
		// Footer Text
		$wp_customize->add_setting( $options_id .'[copyright_text]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[copyright_text]', array(
			'priority'	=> 2,
			'label'		=> $options['copyright_text']['short_desc'],
			'section'	=> 'options_theme_customizer_footer',
			'settings'	=> $options_id .'[copyright_text]',
			'type'		=> 'text'
		));
		
	
	// SOCIAL NETWORKING
	$wp_customize->add_section( 'options_theme_customizer_social_networks', array(
        'title'		=> __( "Social Networks Links", "funky_theme" ),
        'priority'	=> 203
	));	
		
		// Twitter
		$wp_customize->add_setting( $options_id .'[twitter]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[twitter]', array(
			'priority'	=> 1,
			'label'		=> $options['twitter']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[twitter]',
			'type'		=> 'text'
		));		
		
		// Facebook
		$wp_customize->add_setting( $options_id .'[facebook]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[facebook]', array(
			'priority'	=> 2,
			'label'		=> $options['facebook']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[facebook]',
			'type'		=> 'text'
		));		
		
		// Google+
		$wp_customize->add_setting( $options_id .'[google_plus]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[google_plus]', array(
			'priority'	=> 3,
			'label'		=> $options['google_plus']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[google_plus]',
			'type'		=> 'text'
		));
		
		// Dribbble
		$wp_customize->add_setting( $options_id .'[dribbble]', array(
			'type'		=> 'option'
		));		
		
		$wp_customize->add_control( $options_id .'[dribbble]', array(
			'priority'	=> 4,
			'label'		=> $options['dribbble']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[dribbble]',
			'type'		=> 'text'
		));
		
		// LinkedIn
		$wp_customize->add_setting( $options_id .'[linkedin]', array(
			'type'		=> 'option'
		));		
		
		$wp_customize->add_control( $options_id .'[linkedin]', array(
			'priority'	=> 5,
			'label'		=> $options['linkedin']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[linkedin]',
			'type'		=> 'text'
		));		
		
		// YouTube
		$wp_customize->add_setting( $options_id .'[youtube]', array(
			'type'		=> 'option'
		));		
		
		$wp_customize->add_control( $options_id .'[youtube]', array(
			'priority'	=> 6,
			'label'		=> $options['youtube']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[youtube]',
			'type'		=> 'text'
		));
	
		// Vimeo
		$wp_customize->add_setting( $options_id .'[vimeo]', array(
			'type'		=> 'option'
		));		
		
		$wp_customize->add_control( $options_id .'[vimeo]', array(
			'priority'	=> 7,
			'label'		=> $options['vimeo']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[vimeo]',
			'type'		=> 'text'
		));

		
}

function optionsframework_custom_scripts() { ?>

	
 
<?php }
//add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );