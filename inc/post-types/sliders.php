<?php 
// ---------- SLIDER POST TYPE --------- //

add_action('init', 'create_slider_post_type');
function create_slider_post_type() {
 
	$labels = array(
		'name' => __('Slides', 'raw_theme'),
		'singular_name' => __('Slide', 'raw_theme'),
		'add_new' => __('Add New', 'raw_theme'),
		'add_new_item' => __('Add New Slide', 'raw_theme'),
		'edit_item' => __('Edit Slide', 'raw_theme'),
		'new_item' => __('New Slide', 'raw_theme'),
		'view_item' => __('View Slide', 'raw_theme'),
		'search_items' => __('Search Slides', 'raw_theme'),
		'not_found' =>  __('Nothing found', 'raw_theme'),
		'not_found_in_trash' => __('Nothing found in Trash', 'raw_theme'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'show_in_nav_menus' => false,
		'supports' => array('title', 'page-attributes', 'thumbnail')
	  ); 
 
	register_post_type( 'raw_slides' , $args );
}

add_action('init', 'create_slider_taxonomy');
function create_slider_taxonomy() {
	
	$slider_labels = array(
		'name' => __( 'Sliders', 'raw_theme' ),
		'singular_name' => __( 'Slider', 'raw_theme'),
		'search_items' =>  __( 'Search SlidersCategory', 'raw_theme' ),
		'popular_items' => __( 'Popular Sliders', 'raw_theme' ),
		'all_items' => __( 'All sliders', 'raw_theme' ),
		'edit_item' => __( 'Edit slider', 'raw_theme' ), 
		'update_item' => __( 'Update Slider', 'raw_theme' ),
		'add_new_item' => __( 'Add New Slider', 'raw_theme' ),
		'new_item_name' => __( 'New Slider Name', 'raw_theme' ),
		'add_or_remove_items' => __( 'Add or remove slider', 'raw_theme' ),
		'choose_from_most_used' => __( 'Choose from the most used categories', 'raw_theme' ),
		'menu_name' => __( 'Sliders', 'raw_theme' ),
	);

	register_taxonomy( 'slide-categories', array("raw_slides"), array( "hierarchical" => false, "labels" => $slider_labels, 'show_in_nav_menus' => false, ) );

}
	
// Slider Custom Columns

function define_raw_slides_columns($columns){

	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __("Title", "raw_theme"),
		"image" => __("Image", "raw_theme"),
		"text" => __("Caption", "raw_theme"),		
		"slide-categories" => __("Sliders", "raw_theme")
	);
 
  return $columns;
  
}

function build_raw_slides_columns($column){
	
	global $post, $shortname;

	switch($column){		
		case "image":
			if(has_post_thumbnail()){
				the_post_thumbnail('dashboard');
			}
		break;
		case "text":
			echo get_post_meta( $post->ID, $shortname.'_caption_line_1', true ) .'<br/><br/>';
			echo get_post_meta( $post->ID, $shortname.'_caption_line_2', true );
		break;
		case "slide-categories":
			if ($tag_list = get_the_term_list($post->ID, 'slide-categories', '', ', ', '')){
				echo $tag_list;
			} else {
				echo 'None';
			}
		break;
	}
}

add_filter("manage_edit-raw_slides_columns", "define_raw_slides_columns");
add_action("manage_posts_custom_column",  "build_raw_slides_columns");


/* ----- POST TYPE ICONS ----- */

add_action( 'admin_head', 'slides_post_type_icon' );
function slides_post_type_icon() { ?>

    <style type="text/css" media="screen">
       #menu-posts-raw_slides .wp-menu-image {
            background: url(<?php echo get_template_directory_uri() ?>/images/image.png) no-repeat 6px -17px !important;
        }
		#menu-posts-raw_slides:hover .wp-menu-image, #menu-posts-raw_slides.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
    </style>
	
<?php } ?>