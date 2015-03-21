<?php get_header(); ?>

<div id="wrapper" class="clearfix">
	
	<!-- navigation sidebar -->
	<?php get_template_part( 'navigation' ); ?>
	
	<div id="content-wrapper">
	
		<div id="content" <?php post_class();?>>			
			
			<?php if ( have_posts() ): ?>
				
				<?php while ( have_posts() ): the_post(); ?>
					
					<!-- next / prev post links -->
					<div class="post-scroll-holder">
						<?php previous_post_link('<span class="prev-post-link">%link</span>', '' ); ?>
						<?php next_post_link('<span class="next-post-link">%link</span>', '' ); ?>
					</div>
					
					<?php if ( !post_password_required() ) {
						get_template_part( 'format', get_post_format() );
					} else {
						get_template_part( 'format' );
					} ?>
				
				<?php endwhile; ?>
				
			<?php endif; ?>		
			
		</div>
	
		<?php get_footer(); ?>