<?php

	// Get background option for this page.
	$postID = false;
	
	if ( is_home() || is_archive() || is_search() ) { # Blog pages
		$postID = get_option('page_for_posts');
	} elseif ( !is_404() )  {
		$postID = $post->ID;
	}

	$background_url = ""; 

	switch ( get_post_meta( $postID, 'reach_background', true ) ) {

		case 'feature-image':
			
			if ( has_post_thumbnail( $postID ) ) {			
				$background_url = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), 'Full' );
				$background_url = '"'. $background_url[0]. '"';	
			}		
		
		break;
		case 'slideshow':
			
			$background_url = get_background_attachments( $postID );
			
		break;
		case 'url':
		
			$background_url = '"'. get_post_meta( $postID, 'reach_background_url', true ) .'"';
		
		break;
		default:
			
			if ( raw_get_default_background() != false ) {
				$background_url = '"'. of_get_option( 'default_background' ) .'"';
			}
			
		break;
                

	} ?>

	<script>
		jQuery(document).ready(function ($) {

                        $('body').css('background-image', 'url(<?php echo $background_url; ?>)');
			
		});	
	</script>