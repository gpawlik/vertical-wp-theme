<?php get_header(); ?>

<div id="wrapper" class="clearfix">
	
	<!-- navigation sidebar -->
	<?php get_template_part( 'navigation' ); ?>
	
	<div id="content-wrapper">
	
		<div id="content">
			
			<?php if ( is_front_page() ) { ?>
				
				<div class="page-intro">
					
					<!-- title -->
					<h1><?php bloginfo( 'name' ); ?></h1>
					
					<!-- subtitle -->
					<?php if ( get_bloginfo( 'description' ) != '' ) { ?>
						<em><?php bloginfo( 'description' ); ?></em>
					<?php } ?>
				
				</div>
				
			<?php } else { ?>
			
				<?php if ( get_post_meta( $post->ID, 'reach_hide_title', true ) != 'on' ) { ?>
					
					
					<?php $save_post = $post;
					$post = get_post( get_option('page_for_posts') ); ?>
					
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
					
					<?php $post = $save_post; ?>
				
				<?php } ?>
			
			<?php } ?>
		
			<?php if ( of_get_option('blog_layout') == "0" ) {
				get_template_part('loop', 'grid'); 
			} else {
				get_template_part('loop');
			} ?>
	
			<?php get_footer(); ?>