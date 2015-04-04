<?php 

// ---------- PROFILES POST TYPE --------- //

//add_action('init', 'create_raw_profiles_post_type');
function create_raw_profiles_post_type() {
 
	$labels = array(
		'name' => __('Staff', 'raw_theme'), 'post type general name',
		'singular_name' => __('Staff', 'raw_theme'), 'post type singular name',
		'add_new' => __('Add New', 'raw_theme'), 'portfolio item',
		'add_new_item' => __('Add New Profile', 'raw_theme'),
		'edit_item' => __('Edit Profile', 'raw_theme'),
		'new_item' => __('New Profile', 'raw_theme'),
		'view_item' => __('View Profile', 'raw_theme'),
		'search_items' => __('Search Profiles', 'raw_theme'),
		'not_found' =>  __('Nothing found', 'raw_theme'),
		'not_found_in_trash' => __('Nothing found in Trash', 'raw_theme'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array(
			'slug'		 => _x( 'profiles', 'URL slug', 'raw_theme'),
			'with_front' => false
		),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'editor', 'page-attributes', 'thumbnail'),
		'show_in_nav_menus' => false,
		'has_archive' => false
	  ); 
 
	register_post_type( 'raw_staff' , $args );
}


// Portfolio Custom Columns

function define_raw_staff_columns($columns){

	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __("Title", "raw_theme"),
		"role" => __("Role", "raw_theme"),
		"image" => __("Image", "raw_theme")
	);
 
  return $columns;
  
}

function build_raw_staff_columns($column){
	
	global $post, $shortname;

	switch($column){
		case "job":
			echo get_post_meta( $post->ID, $shortname .'_job_title', true );
		break;
		case "image":
			if(has_post_thumbnail()){
				the_post_thumbnail('dashboard');
			}
		break;
	}
}

add_filter("manage_edit-raw_staff_columns", "define_raw_staff_columns");
add_action("manage_pages_custom_column",  "build_raw_staff_columns");


/* ----- POST TYPE ICONS ----- */

add_action( 'admin_head', 'raw_staff_post_type_icon' );
function raw_staff_post_type_icon() { ?>

    <style type="text/css" media="screen">
        #menu-posts-raw_staff .wp-menu-image {
            background: url(<?php echo get_template_directory_uri() ?>/images/user.png) no-repeat 6px -17px !important;
        }
		#menu-posts-raw_staff:hover .wp-menu-image, #menu-posts-raw_staff.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
    </style>
	
<?php } ?>