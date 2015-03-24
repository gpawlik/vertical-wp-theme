<?php
/**
 * The template for displaying standard portfolio items.
 * 
 **/
	
if ( has_post_thumbnail() && get_post_meta( $post->ID, 'reach_hide_feature_image', true ) != 'on'  ) {			

    the_post_thumbnail( "large" );

}

?>