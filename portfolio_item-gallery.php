<?php
/**
 * The template for displaying video format portfolio items.
 * 
 * @package WordPress
 * @subpackage Reach
 * @since Reach 3.3
 **/


	// gallery
	
	$args = array(
		'orderby' 		 => 'menu_order',
		'order'          => 'ASC',
		'post_type'      => 'attachment',
		'post_parent'    => $post->ID,
		'post_mime_type' => 'image',
		'post_status'    => null,
		'numberposts'    => -1,
	);

	$attachments = get_posts( $args );
	
	if ( $attachments ) {
	
		if ( get_post_meta( $post->ID, 'reach_layout', true ) == "1 Column" ) {
			$container_width = 736;
		} else {
			$container_width = 482;
		}
		
		foreach ( $attachments as $attachment ) {
			
			$title = apply_filters('the_title', $attachment->post_title);
			
			if ( get_post_meta( $post->ID, 'reach_hide_feature_image', true ) == 'on' && $attachment->ID == get_post_thumbnail_id( $post->ID ) ) {
				
				continue;
				
			} else {
				
				// Get image height and width
				$gallery_image_attributes = wp_get_attachment_image_src( $attachment->ID, 'large' );
				
				// Calculate width as a percentage of the content area
				$scale = $container_width / $gallery_image_attributes[1];			
				
				// Scale both height and width proportionately
				$width = $gallery_image_attributes[1] * $scale;
				$height = $gallery_image_attributes[2] * $scale;				
				
				// output image
				echo '<img src="'. $gallery_image_attributes[0] .'" width="'. $width .'" height="'. $height .'" alt="'. get_post_meta( $post->ID, '_wp_attachment_image_alt', true ) .'" />';
				
			}
			
		}

	}

	wp_reset_postdata();