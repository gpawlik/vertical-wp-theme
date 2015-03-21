<?php get_header(); ?>

<div id="wrapper" class="clearfix">
	
	<!-- navigation sidebar -->
	<?php get_template_part( 'navigation' ); ?>
	
	<div id="content-wrapper">
	
		<div id="content" <?php post_class();?>>
			
			<?php if ( get_post_meta( $post->ID, 'reach_hide_title', true ) != 'on' ) { ?>
				
				<div class="page-intro">
					
					<!-- title -->
					<?php if ( get_post_meta( $post->ID, 'reach_page_title', true ) != '' ) { ?>
						<h1><?php echo get_post_meta( $post->ID, 'reach_page_title', true ); ?></h1>
					<?php } else { ?>
						<h1><?php the_title(); ?></h1>
					<?php } ?>
					
					<!-- subtitle -->
					<?php if ( get_post_meta( $post->ID, 'reach_job_title', true ) != '' ) { ?>
						<em><?php echo get_post_meta( $post->ID, 'reach_job_title', true ); ?></em>
					<?php } ?>
				
				</div>
			
			<?php } ?>
			
			<?php if ( get_post_meta( $post->ID, 'reach_enable_slider', true ) == 'on' ) {				
				raw_create_slider( $post->ID );				
			} elseif ( has_post_thumbnail() && get_post_meta( $post->ID, 'reach_hide_feature_image', true ) != 'on'  ) {
				$image = vt_resize( get_post_thumbnail_id(), '', 816, 999, false); 
				echo '<img class="post-image" src="'. $image[url] .'" width="'. $image[width] .'" height="'. $image[height] .'" />';
			} ?>
			
			<?php if ( have_posts() ): ?>
				
				<?php while ( have_posts() ): the_post(); ?>
				
					<!-- content -->
					<?php if( $post->post_content != "" ) { ?>
					
						<article class="page-content clearfix">
					
							<?php the_content(); ?>
						
						</article>
				
					<?php } ?>
				
				<?php endwhile; ?>
				
			<?php endif; ?>		
			
		</div>
		
		<?php get_footer(); ?>