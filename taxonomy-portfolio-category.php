<?php get_header(); ?>

<div id="wrapper" class="clearfix">
	
	<!-- navigation sidebar -->
	<?php get_template_part( 'navigation' ); ?>
	
	<div id="content-wrapper">
		
		<?php if ( have_posts() ): ?>
		
			<div id="content" <?php post_class();?>>
		
				<div class="page-intro">
					
					<!-- title -->
					<h1><?php single_cat_title( '' ); ?></h1>
					
					<em><?php echo term_description(); ?></em>
				
				</div>

			</div>
			
			<?php // portfolio loop
	
			global $wp_query;
			$args = array_merge( $wp_query->query, array ( 'posts_per_page' => -1 ) );
			query_posts( $args );
			
			if ( have_posts() ) { ?>
				
				<div id="portfolio-grid">
				
					<?php while ( have_posts() ): the_post(); ?>
						
						<?php // Get portfolio item categories for filtering.
						$post_categories = get_the_terms( $post->ID, 'portfolio-category' );
						$categories_list = array();
					
						if ( $post_categories != NULL ) {
							foreach ( $post_categories as $category ) {
								array_push( $categories_list, urldecode( $category->slug ) ); 
							}
						} ?>
						
						<article <?php post_class( $categories_list ); ?>>
						
							<?php if ( has_post_thumbnail() ) {							
								the_post_thumbnail( "thumbnail-portfolio" );							
							} ?>
						
							<!-- meta -->
							<div class="meta">
								<h6><?php the_title(); ?></h6>
							</div>
							
							<?php 
								if (of_get_option('colorbox') == "0") {
									$rel = 'rel="colorbox-portfolio"';
								} else {
									$rel = '';
								} 
							?>
							
							<a class="item-link" href="<?php the_permalink(); ?>" <?php echo $rel; ?>></a>
							
						</article>
						
					<?php endwhile; ?>
				
				</div>
				
				<?php funky_pagination(); ?>
				
				<?php wp_reset_postdata(); ?>
			
			<?php } ?>
			
		<?php endif; ?>

		<?php get_footer(); ?>