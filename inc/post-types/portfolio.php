<?php 

// ---------- PORTFOLIO POST TYPE --------- //

//add_action('init', 'create_portfolio_post_type');
function create_portfolio_post_type() {
 
	$labels = array(
		'name'					=> __('Portfolio Items', 'raw_theme'), 'post type general name',
		'singular_name'			=> __('Portfolio Item', 'raw_theme'), 'post type singular name',
		'add_new'				=> __('Add New', 'raw_theme'), 'portfolio item',
		'add_new_item'			=> __('Add New Portfolio Item', 'raw_theme'),
		'edit_item'				=> __('Edit Portfolio Item', 'raw_theme'),
		'new_item'				=> __('New Portfolio Item', 'raw_theme'),
		'view_item'				=> __('View Portfolio Item', 'raw_theme'),
		'search_items'			=> __('Search Portfolio', 'raw_theme'),
		'not_found'				=>  __('Nothing found', 'raw_theme'),
		'not_found_in_trash'	=> __('Nothing found in Trash', 'raw_theme'),
		'parent_item_colon'		=> ''
	);
 
	$args = array(
		'labels'			=> $labels,
		'public'			=> true,
		'publicly_queryable'=> true,
		'show_ui'			=> true,
		'query_var'			=> true,
		'rewrite'			=> array(
			'slug'		 => _x( 'portfolios', 'URL slug', 'raw_theme' ),
			'with_front' => false
		),
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'menu_position' 	=> null,
		'supports'			=> array('title', 'editor', 'thumbnail', 'comments', 'custom-fields'),
		'has_archive'		=> true
	); 
 
	register_post_type( 'portfolio' , $args );
	
}

add_action('init', 'create_portfolio_taxonomy');
function create_portfolio_taxonomy() {

	$category_labels = array(
		'name'					=> __( 'Portfolios', 'raw_theme' ),
		'singular_name'			=> __( 'Portfolio', 'raw_theme'),
		'search_items'			=>  __( 'Search Portfolio', 'raw_theme' ),
		'popular_items'			=> __( 'Popular Portfolio', 'raw_theme' ),
		'all_items'				=> __( 'All Portfolios', 'raw_theme' ),
		'edit_item'				=> __( 'Edit Portfolio', 'raw_theme' ), 
		'update_item'			=> __( 'Update Portfolio', 'raw_theme' ),
		'add_new_item'			=> __( 'Add New Portfolio', 'raw_theme' ),
		'new_item_name'			=> __( 'New Portfolio Name', 'raw_theme' ),
		'add_or_remove_items'	=> __( 'Add or remove portfolio', 'raw_theme' ),
		'choose_from_most_used' => __( 'Choose from the most used portfolio', 'raw_theme' ),
		'menu_name'				=> __( 'Portfolios', 'raw_theme' ),
	);

	register_taxonomy( 'portfolio-category', array("portfolio"), array( "hierarchical" => true, "labels" => $category_labels, "query_var" => "portfolio-category", "rewrite" => true ) );

}


// Portfolio Custom Columns

function define_portfolio_columns($columns){

	$columns = array(
		"cb"				 => "<input type=\"checkbox\" />",
		"title"				 => __( "Title", "raw_theme" ),
		"client"			 => __( "Client", "raw_theme" ),
		"project-date"		 => __( "Date", "raw_theme" ),
		"portfolio-category" => __( "Categories", "raw_theme" ),
		"image" 			 => __( "Image", "raw_theme" )
	);
 
  return $columns;
  
}

function build_portfolio_columns($column){
	
	global $post, $shortname;

	switch($column){
		case "client":
			echo get_post_meta( $post->ID, $shortname.'_client', true );
		break;		
		case "project-date":
			echo get_post_meta( $post->ID, $shortname.'_date', true );
		break;
		case "portfolio-category":
			if ( $categories = get_the_term_list($post->ID, 'portfolio-category', '', ', ', '') ){
				echo $categories;
			} else {
				echo 'None';
			}
		break;
		case "image":
			if(has_post_thumbnail()){
				the_post_thumbnail('dashboard');
			}
		break;
	}
}

add_filter("manage_edit-portfolio_columns", "define_portfolio_columns");
add_action("manage_pages_custom_column",  "build_portfolio_columns");


/* ----- POST TYPE ICONS ----- */

add_action( 'admin_head', 'portfolio_post_type_icon' );
function portfolio_post_type_icon() { ?>

    <style type="text/css" media="screen">
        #menu-posts-portfolio .wp-menu-image {
            background: url(<?php echo get_template_directory_uri() ?>/images/television--pencil.png) no-repeat 6px -17px !important;
        }
		#menu-posts-portfolio:hover .wp-menu-image, #menu-posts-portfolio.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
    </style>
	
<?php } ?>