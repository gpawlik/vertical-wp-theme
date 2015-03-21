<?php /*
Template Name: Sitemap
*/ ?>

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
			
			<?php if ( get_post_meta( $post->ID, 'reach_enable_slider', true ) == 'on' ) {				
				raw_create_slider( $post->ID );				
			} elseif ( has_post_thumbnail() && get_post_meta( $post->ID, 'reach_hide_feature_image', true ) != 'on'  ) {
				the_post_thumbnail( "large" );							
			} ?>
			
			<article class="page-content clearfix">
				
				<?php if ( have_posts() ): ?>
					
					<?php while ( have_posts() ): the_post(); ?>
						
						<?php the_content(); ?>
						
					<?php endwhile; ?>
						
				<?php endif; ?>	

				<!-- left colulmn -->
				<div class="half">
					<?php wp_nav_menu( 
						array( 
							'theme_location' => 'sitemap', 
							'container' => false,
							'menu_id' => false,
							'menu_class' => 'clearfix',
							'fallback_cb' => false
						)
					); ?>
				</div>
				
				<!-- right column -->
				<div class="half end">
					<h3><?php _e("Feeds", "raw_theme"); ?></h3>  
					<ul>  
						<li><a title="Full content" href="feed:<?php bloginfo('rss2_url'); ?>"><?php _e("Main RSS", "raw_theme"); ?></a></li>  
						<li><a title="Comment Feed" href="feed:<?php bloginfo('comments_rss2_url'); ?>"><?php _e("Comments Feed", "raw_theme"); ?></a></li>  
					</ul>  
					
					<h3><?php _e("Categories", "raw_theme"); ?></h3>
					<ul>
						<?php wp_list_categories( array(
							"hierarchical" => 0,
							"title_li" => false,
							"show_count" => 1
						)); ?>						
					</ul>
					
					<h3><?php _e("Archives", "raw_theme"); ?></h3>
					<ul>  
						<?php wp_get_archives( array(
							"type" => "monthly",
							"show_post_count" => true
						)); ?>  
					</ul>
					
				</div>
			
			</article>
			
		</div>
		
		<?php get_footer(); ?>