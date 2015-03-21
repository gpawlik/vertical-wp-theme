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
			
			<?php if ( have_posts() ): ?>
				
				<!-- content -->
				<article class="page-content clearfix">
				
					<?php while ( have_posts() ): the_post(); ?>
						
						<?php if ( post_password_required() ) {
							
							the_content();
							
						} else { ?>
						
							<?php if ( get_post_meta( $post->ID, 'reach_layout', true ) != '1 Column' ) {
							
								// Opening div tag for first column
								echo '<div id="two-column-text" class="third end">';
								
							} ?>
					
							<!-- portfolio item meta -->
							<?php if ( get_post_meta( $post->ID, 'reach_client', true ) != '' ) { ?>						
								<strong class="portfolio-item-meta-title"><?php _e( 'Client', 'raw_theme' ); ?></strong>
								<?php echo get_post_meta( $post->ID, 'reach_client', true ); ?>					
							<?php } ?>	
							
							<?php if ( get_post_meta( $post->ID, 'reach_date', true ) != "" ) { ?>						
								<strong class="portfolio-item-meta-title"><?php _e( 'Date', 'raw_theme' ); ?></strong>
								<?php echo get_post_meta( $post->ID, 'reach_date', true ); ?>					
							<?php } ?>	
							
							<!-- portfolio item content -->
							<?php if ( in_array( get_post_format(), array( 'video', 'audio' ) ) ) {
								funky_the_remaining_content();
							} else {
								the_content();
							} ?>
							
							<?php if ( get_post_meta( $post->ID, 'reach_link', true ) != '' ) { ?>
								<a class="portfolio-item-project-link" href="<?php echo get_post_meta( $post->ID, 'reach_link', true ); ?>" title="View project" target="_blank"><?php _e( 'View Project', 'raw_theme' ); ?> &rarr;</a>
							<?php } ?>	
							
							<?php if ( get_post_meta( $post->ID, 'reach_layout', true ) != '1 Column' ) {
								
								// Closing div tag for first column and opening div tag for second column
								echo '</div>						
								<div id="two-column-gallery" class="two-thirds">';
							
							}
							
							// Portfolio item featured content
							get_template_part( 'portfolio_item', get_post_format() );
							
							if ( get_post_meta( $post->ID, 'reach_layout', true ) != '1 Column' ) {
								
								// Closing div tag for second column
								echo '</div>'; 
							
							} ?>
						
							<?php comments_template(); ?>						
						
						<?php } ?>
						
					<?php endwhile; ?>
				
				</article>
				
			<?php else : ?>
			
				<div class="page-content clearfix">
					<p><?php _e( "Page not found.", "raw_theme" ); ?></p>
				</div>
				
			<?php endif; ?>		
			
		</div>
	
		<?php get_footer(); ?>