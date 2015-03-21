<?php /*
Template Name: Portfolio
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
				
				<?php if ( get_post_meta( $post->ID, 'reach_enable_filter', true ) == 'on' && get_post_meta( $post->ID, 'reach_portfolio_category', true ) != '' ) { ?>
				
					<?php $cat_id = get_term_by( 'slug', get_post_meta( $post->ID, 'reach_portfolio_category', true ), 'portfolio-category' );
					$categories = get_term_children( $cat_id->term_id, 'portfolio-category' ); ?>
					
					<?php if ( $categories ) { ?>
						
						<!-- filter -->
						<ul id="filter">						
						
							<li><a data-filter="*" href="#" class="selected"><?php _e( "All", "raw_theme" ); ?></a></li>
						
							<?php foreach ( $categories as $cat ) {
								$cat_name = get_term_by( 'id', $cat, 'portfolio-category' );
								if ( $cat_name != '' ) {
									echo '<li><a href="#" data-filter=".'. urldecode( $cat_name->slug ) .'">'. $cat_name->name .'</a></li>';
								}
							} ?>
							
						</ul>					
						
					<?php } ?>						
				
				<?php } ?>
			
			</div>
			
			<?php // Portfolio item loop
	
			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' );
			} else {
				$paged = 1;
			}
			
			if ( get_post_meta( $post->ID, 'reach_portfolio_post_per_page', true ) == "" ) {
				$posts_per_page = -1;
			} else {
				$posts_per_page = get_post_meta( $post->ID, 'reach_portfolio_post_per_page', true );
			}
			
			$query_args = array(
				'post_type'			=> array( 'portfolio' ),
				'tax_query'			=> array(
					array(
						'taxonomy'	=> 'portfolio-category',
						'field'		=> 'slug',
						'terms'		=> get_post_meta( $post->ID, 'reach_portfolio_category', true )
					)
				),
				'posts_per_page'	=> $posts_per_page,
				'paged'				=> $paged
			);
			
			$portfolio_query = new WP_query( $query_args );
			
			if ( $portfolio_query->have_posts() ) { ?>
				
				<div id="portfolio-grid">
				
					<?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>
						
						<?php // Get portfolio item categories for filtering.
							$post_categories = get_the_terms( $post->ID, 'portfolio-category' );
							$categories_list = array();
						
							if ( $post_categories != NULL ) {
								foreach ( $post_categories as $category ) {
									array_push( $categories_list,  urldecode( $category->slug ) ); 
								}
							} 
						?>
						
						<article <?php post_class( $categories_list ); ?>>
							
							<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail( "thumbnail-portfolio" );
							} ?>
							
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
							
							<!-- link -->
							<a class="item-link" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( "Permalink to %s", "raw_theme" ), the_title_attribute( 'echo=0' ) ); ?>" <?php echo $rel; ?>></a>
							
						</article>
						
					<?php endwhile; ?>
				
				</div>
				
				<?php funky_pagination( $portfolio_query->max_num_pages ); ?>
				
				<?php wp_reset_postdata(); ?>
			
			<?php } ?>
		
		<?php endif; ?>
		
		<?php get_footer(); ?>