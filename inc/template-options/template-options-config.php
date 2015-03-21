<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	global $shortname;
	
	// Portfolio categories list
	$portfolios = array();	
	$terms = get_terms( 'portfolio-category' );	
	foreach ( $terms as $term ) {	
		$category = array(
			'name'	=> $term->name,
			'value'	=> $term->slug
		);		
		array_push( $portfolios, $category );		
	}
	
	// Slider list
	$sliders = array();	
	$terms = get_terms( 'slide-categories' );	
	foreach ( $terms as $term ) {	
		$category = array(
			'name'	=> $term->name,
			'value'	=> $term->slug
		);		
		array_push( $sliders, $category );		
	}
	
	
	/* -------------------------------------------------- */
	/* BACKGROUND
	/* -------------------------------------------------- */
	
	$meta_boxes[] = array(
		'id'		=> 'background-options-box',
		'title'		=> __( 'Background Options', 'raw_theme' ),
		'pages'		=> array( 'page', 'post', 'portfolio' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'show_names'=> true,
		'fields'	=> array(
			
			// Background Source
			array(
				"name"		=> __( "Background Source", 'raw_theme' ),
				"desc"		=> __( "Select background for this page.", 'raw_theme' ),
				"id"		=> $shortname."_background",
				"type"		=> "select",
				"options"	=> array( 
					array( "name" => __( "Theme Default", "raw_theme" ),		"value" => "default" ),
					array( "name" => __( "WP Custom Background", "raw_theme" ),	"value" => "wordpress" ),
					array( "name" => __( "Feature Image", "raw_theme" ),		"value" => "feature-image" ),
					array( "name" => __( "Slideshow (Attached Images)", "raw_theme" ),			"value" => "slideshow" ),
					array( "name" => __( "From URL", "raw_theme" ),				"value" => "url" )
				)
				
			),
			
			// Background URL
			array(
				"name"	=> __( "Background URL", 'raw_theme' ),
				'desc' => __( "Upload an image or enter an URL.", "raw_theme" ),
				"id"	=> $shortname."_background_url",
				"type"	=> "file"
			)
			
		)
	);


	/* -------------------------------------------------- */
	/* CONTACT
	/* -------------------------------------------------- */

	$meta_boxes[] = array(
		'id'		=> 'contact-options-box',
		'title'		=> __( 'Contact Options', 'raw_theme' ),
		'pages'		=> array( 'page' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'show_names'=> true,
		'fields'	=> array(
			
			// Map Address
			array(
				"name"	=> __( "Map Address", 'raw_theme' ),
				"desc"	=> __( "Enter the address to be shown on the embedded google map.", 'raw_theme' ),
				"id"	=> $shortname."_map_address",
				"type"	=> "text"
			)
			
		)
	);



	/* -------------------------------------------------- */
	/* PORTFOLIO INDEX
	/* -------------------------------------------------- */

	$meta_boxes[] = array(
		'id'		=> 'portfolio-options-box',
		'title'		=> __( 'Portfolio Options', 'raw_theme' ),
		'pages'		=> array( 'page' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'show_names'=> true,
		'fields'	=> array(
			
			// Portfolio Category
			array(
				"name"		=> __( "Portfolio Category", 'raw_theme' ),
				"desc"		=> __( "Select a Portfolio Category to display on this page.", 'raw_theme' ),
				"id"		=> $shortname."_portfolio_category",
				"type"		=> "select",
				"options"	=> $portfolios
			),
		
			// Filter
			array(
				'name'	=> __( 'Enable Filter', 'raw_theme' ),
				'desc'	=> __( 'Select this option to enable jQuery filtering.', 'raw_theme' ),
				'id'	=> $shortname.'_enable_filter',
				'type'	=> 'checkbox'
			),
		
			// Items Per Page
			array(
				"name"	=> __( "Portfolio Items Per Page", 'raw_theme' ),
				"desc"	=> __( "Enter the number of portfolio items to show on each page. Leave blank to show all portfolio items on one pages.", 'raw_theme' ),
				"id"	=> $shortname."_portfolio_post_per_page",
				"type"	=> "text",
				"std"	=> ""
			)
			
		)
	);


	/* -------------------------------------------------- */
	/* PORTFOLIO ITEMS
	/* -------------------------------------------------- */

	$meta_boxes[] = array(
		'id'		=> 'portfolio-item-options-box',
		'title'		=> __( 'Portfolio Item Options', 'raw_theme' ),
		'pages'		=> array( 'portfolio' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'show_names'=> true,
		'fields'	=> array(
			
			// Page Title
			array(
				"name"		=> __( "Page Layout", 'raw_theme' ),
				"desc"		=> __( "Use this option to select the page's layout.", 'raw_theme' ),
				"id"		=> $shortname."_layout",
				"type"		=> "select",
				"options"	=> array( 
					array ( "name"	=> __( "1 Column", "raw_theme" ), "value" => '1 Column' ),
					array ( "name"	=> __( "2 Column", "raw_theme" ), "value" => '2 Column' )
				),
				"std"		=> __( "2 Column", "raw_theme" )
			),
			
			// Page Title
			array(
				"name"	=> __( "Page Title", 'raw_theme' ),
				"desc"	=> __( "Use this option to output a different title on the actual page.", 'raw_theme' ),
				"id"	=> $shortname."_page_title",
				"type"	=> "text"
			),
			
			// Subtitle
			array(
				"name"	=> __( "Subtitle", 'raw_theme' ),
				"desc"	=> __( "Enter text here to display it as the page subtitle below the page title.", 'raw_theme' ),
				"id"	=> $shortname."_subtitle",
				"type"	=> "text"
			),
			
			// Hide Feature Image
			array(
				'name'	=> __( 'Hide Feature Image', 'raw_theme' ),
				'desc'	=> __( 'Select this option to remove feature image from this page\'s gallery.', 'raw_theme' ),
				'id'	=> $shortname.'_hide_feature_image',
				'type'	=> 'checkbox'
			),
			
			
			// Client Name
			array(
				'name'	=> __( 'Client Name', 'raw_theme' ),
				'desc'	=> __( 'Enter the name of the client this portfolio item was produced for.', 'raw_theme' ),
				'id'	=> $shortname.'_client',
				'type'	=> 'text'
			),
			
			// Project Date
			array(
				'name'	=> __( 'Project Date', 'raw_theme' ),
				'desc'	=> __( 'Enter the date to display for this project.', 'raw_theme' ),
				'id'	=> $shortname.'_date',
				'type'	=> 'text'
			),
			
			// Link
			array(
				"name"	=> __( "Portfolio Item URL", 'raw_theme' ),
				"desc"	=> __( "Enter a URL to display a link on this portfolio item.", 'raw_theme' ),
				"id"	=> $shortname."_link",
				"type"	=> "text",
			)
			
		)
		
	);


	/* -------------------------------------------------- */
	/* PAGES
	/* -------------------------------------------------- */

	$meta_boxes[] = array(
		'id'		=> 'page-options-box',
		'title'		=> __( 'Page Options', 'raw_theme' ),
		'pages'		=> array( 'page' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'show_names'=> true,
		'fields'	=> array(
			
			// Hide Title
			array(
				'name'	=> __( 'Hide Title', 'raw_theme' ),
				'desc'	=> __( 'Select this option to hide the page title.', 'raw_theme' ),
				'id'	=> $shortname.'_hide_title',
				'type'	=> 'checkbox'
			),
			
			// Page Title
			array(
				"name"	=> __( "Page Title", 'raw_theme' ),
				"desc"	=> __( "Use this option to output a different title on the actual page.", 'raw_theme' ),
				"id"	=> $shortname."_page_title",
				"type"	=> "text"
			),
			
			// Subtitle
			array(
				"name"	=> __( "Subtitle", 'raw_theme' ),
				"desc"	=> __( "Enter text here to display it as the page subtitle below the page title.", 'raw_theme' ),
				"id"	=> $shortname."_subtitle",
				"type"	=> "text"
			),
			
			// Hide Featured Image
			array(
				'name'	=> __( 'Hide Featured Image', 'raw_theme' ),
				'desc'	=> __( 'Select to hide the feature image on this post.', 'raw_theme' ),
				'id'	=> $shortname.'_hide_feature_image',
				'type'	=> 'checkbox',
			),
			
			// Enable Slider
			array(
				'name'	=> __( 'Enable Slider', 'raw_theme' ),
				'desc'	=> __( 'Select this option to enable a slider on this page.', 'raw_theme' ),
				'id'	=> $shortname.'_enable_slider',
				'type'	=> 'checkbox'
			),
			
			// Select Slider
			array(
				"name"		=> __( "Select Slider", 'raw_theme' ),
				"desc"		=> __( "Select which slider to display on this page.", 'raw_theme' ),
				"id"		=> $shortname."_slide_category",
				"type"		=> "select",
				"options"	=> $sliders
			)
			
		)
	);


	/* -------------------------------------------------- */
	/* POSTS
	/* -------------------------------------------------- */

	$meta_boxes[] = array(
		'id'		=> 'post-options-box',
		'title'		=> __( 'Post Options', 'raw_theme' ),
		'pages' 	=> array( 'post' ),
		'context' 	=> 'normal',
		'priority'	=> 'high',
		'show_names'=> true,
		'fields'	=> array(		

			// Subtitle
			array(
				"name"	=> __( "Subtitle", 'raw_theme' ),
				"desc"	=> __( "Enter text here to display it as the page subtitle below the page title.", 'raw_theme' ),
				"id"	=> $shortname."_subtitle",
				"type"	=> "text"
			),
			
			// Hide Featured Image
			array(
				'name'	=> __( 'Hide Featured Image', 'raw_theme' ),
				'desc'	=> __( 'Select to hide the feature image on this post.', 'raw_theme' ),
				'id'	=> $shortname.'_hide_feature_image',
				'type'	=> 'checkbox',
			)
			
		)
		
	);


	/* -------------------------------------------------- */
	/* SLIDES
	/* -------------------------------------------------- */

	$meta_boxes[] = array(
		'id'		=> 'slides-options-box',
		'title'		=> __( 'Slide Options', 'raw_theme' ),
		'pages'		=> array( 'raw_slides' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'show_names'=> true,
		'fields'	=> array(
			
			// Slide Link
			array(
				"name"	=> __( "Slide Link", 'raw_theme' ),
				"desc"	=> __( "Enter the URL of the page this slide will link to. A link is only added to slides with static images. Leave this field blank to not create a link on this slide.", 'raw_theme' ),
				"id"	=> $shortname."_slide_link",
				"type"	=> "text"
			),
		
			// Caption Line 1
			array(
				"name"	=> __( "Caption Line 1", 'raw_theme' ),
				"desc"	=> __( "Enter the text to appear on the first line of this slides caption.", 'raw_theme' ),
				"id"	=> $shortname."_caption_line_1",
				"type"	=> "text"
			),
			
			// Caption Line 2
			array(
				"name"	=> __( "Caption Line 2", 'raw_theme' ),
				"desc"	=> __( "Enter the text to appear on the second line of this slides caption.", 'raw_theme' ),
				"id"	=> $shortname."_caption_line_2",
				"type"	=> "text"
			)
		
		)
	);


	/* -------------------------------------------------- */
	/* STAFF
	/* -------------------------------------------------- */

	$meta_boxes[] = array(
		'id'		=> 'profile-options-box',
		'title'		=> __( 'Profile Options', 'raw_theme' ),
		'pages'		=> array( 'raw_staff' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'show_names'=> true,
		'fields'	=> array(
			
			// Job Title
			array(
				"name"	=> __( "Job Title", 'raw_theme' ),
				"desc"	=> __( "Enter this staff member's job title.", 'raw_theme' ),
				"id"	=> $shortname."_job_title",
				"type"	=> "text"
			)
		
		)
		
	);
	
	return $meta_boxes;
	
}
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );


/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'template-options.php';

}