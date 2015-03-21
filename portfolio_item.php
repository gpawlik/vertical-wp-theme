<?php
/**
 * The template for displaying standard portfolio items.
 * 
 * @package WordPress
 * @subpackage Reach
 * @since Reach 3.3
 **/
	
	if ( has_post_thumbnail() && get_post_meta( $post->ID, 'reach_hide_feature_image', true ) != 'on'  ) {			
		
		the_post_thumbnail( "large" );

	}

?>