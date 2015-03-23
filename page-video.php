<?php
/**
 * Template Name: Video
 *
 * The template for displaying a video page.
 * 
 **/ 
?>

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
					<?php if ( get_post_meta( $post->ID, 'reach_subtitle', true ) != '' ) { ?>
						<em><?php echo get_post_meta( $post->ID, 'reach_subtitle', true ); ?></em>
					<?php } ?>
				
				</div>
			
			<?php } ?>
			
                        <!-- INSERT VIDEO -->
                        <div class="video-container">
                            <?php funky_embed_feature_content(); ?>
                        </div>
			
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