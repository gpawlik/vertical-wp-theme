<?php

if ( is_front_page() ) { 			// Home page
	
	$sidebar = __( 'Home Page Sidebar', 'raw_theme' );
	
} elseif (						// Portfolio, portfolio categories, portfolio items
	get_post_type() == "portfolio" 
	|| is_page_template( 'portfolio.php' )
	|| is_tax( 'portfolio-category' )
) { 
	
	$sidebar = __('Portfolio Sidebar', 'raw_theme');

} elseif ( 							 // Blog index, archive, post or search
	is_home()
	|| is_archive()
	|| get_post_type() == "post"
	|| is_search()
) {

	$sidebar = __( 'Post Sidebar', 'raw_theme' );

} else {							// All others...
	
	$sidebar = __( 'Page Sidebar', 'raw_theme' );
	
}

?>
<ul class="widget-sidebar">
	<?php dynamic_sidebar( $sidebar ); ?>
</ul>

