<?php get_header(); ?>

<div id="wrapper" class="clearfix">
	
	<!-- navigation sidebar -->
	<?php get_template_part( 'navigation' ); ?>
	
	<div id="content-wrapper">
	
		<div id="content" <?php post_class();?>>

			<div class="page-intro">
				
				<!-- title -->
				<h1><?php _e( 'Oops! Page Not Found.', 'raw_theme' ); ?></h1>
			
			</div>			

			<div class="page-content clearfix">
				
				<p><?php _e( 'The page or content you are looking for could not be found. It might have been moved or deleted. Please use the links below to find what you are looking for.', 'funky_theme' ); ?></p>
				
				<!-- left column -->
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
					
					<h3>Feeds</h3>  
					<ul>  
						<li><a title="Full content" href="feed:<?php bloginfo( 'rss2_url' ); ?>"><?php _e( 'Main RSS' , 'raw_theme' ); ?></a></li>  
						<li><a title="Comment Feed" href="feed:<?php bloginfo( 'comments_rss2_url' ); ?>"><?php _e( 'Comments Feed', 'raw_theme' ); ?></a></li>  
					</ul>  
					
					<h3>Categories</h3>  
					<ul>
						<?php wp_list_categories( array(
							"hierarchical" => 0,
							"title_li" => false,
							"show_count" => 1
						)); ?>						
					</ul>
					
					<h3>Archives</h3>  
					<ul>  
						<?php wp_get_archives( array(
							"type" => "monthly",
							"show_post_count" => true
						)); ?>  
					</ul>
					
				</div>
				
			</div>
			
		</div>
		
		<?php get_footer(); ?>