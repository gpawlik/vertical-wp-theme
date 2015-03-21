<?php /*
Template Name: Archive
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
			
			<div class="page-content clearfix">
				
				<?php if ( have_posts() ): ?>

					<?php while ( have_posts() ): the_post(); ?>
					
						<?php the_content(); ?>
					
					<?php endwhile; ?>
				
				<?php endif; ?>
				
				<div class="half">
				
					<h3><?php _e("Last 30 posts", "raw_theme"); ?></h3>
					<ul>
						<?php $args = array( 
							'numberposts' => 30, 
							'post_type' => "post"
						);
						
						$latest_posts = get_posts( $args );
						foreach( $latest_posts as $post ): ?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php endforeach; ?>
					</ul>
					
				</div>
				
				<div class="half end">
				
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
				
			</div>				
			
		</div>
		
		<?php get_footer(); ?>