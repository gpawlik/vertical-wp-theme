<?php /*
Template Name: Staff 
*/ ?>

<?php get_header(); ?>

<div id="wrapper" class="clearfix">
	
	<!-- navigation sidebar -->
	<?php get_template_part( 'navigation' ); ?>
	
	<div id="content-wrapper">
		
		<?php if ( have_posts() ): ?>
		
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
			
				<?php while ( have_posts() ): the_post(); ?>
					
					<!-- content -->
					<?php if( $post->post_content != "" ) { ?>
						
						<article class="page-content clearfix">
						
							<?php the_content(); ?>
						
						</article>
					
					<?php } ?>
					
				<?php endwhile; ?>
				
			</div>
			
			<?php // Staff item loop

			$query_args = array(
				'post_type'		 => array( 'raw_staff' ),
				'orderby'		 => 'menu_order',
				'order'          => 'ASC',
				'posts_per_page' => -1
			);
			
			$staff_query = new WP_query( $query_args );
			
			if ( $staff_query->have_posts() ) { ?>
				
				<div id="portfolio-grid">
				
					<?php while ( $staff_query->have_posts() ) : $staff_query->the_post(); ?>
						
						<article <?php post_class(); ?>>
						
							<!-- thumbnail -->
							<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail( "thumbnail-portfolio" );
							} ?>
						
							<div class="meta">
								<h6><?php the_title(); ?></h6>
								<small><?php echo get_post_meta( $post->ID, 'reach_job_title', true ); ?></small>
							</div>	
							
							<?php if ( $post->post_content != "" ) { ?>
								<!-- link -->
								<a class="item-link" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( "Permalink to %s", "raw_theme" ), the_title_attribute( 'echo=0' ) ); ?>" <?php echo $rel; ?>></a>
							<?php } ?>
							
						</article>
						
					<?php endwhile; ?>
				
				</div>
				
				<?php funky_pagination( $staff_query->max_num_pages ); ?>
				
				<?php wp_reset_postdata(); ?>
			
			<?php } ?>
			
		<?php endif; ?>

		<?php get_footer(); ?>