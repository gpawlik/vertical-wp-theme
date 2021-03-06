	<div class="blog-traditional">
		
		<?php if ( have_posts() ): ?>
	
			<?php while ( have_posts() ): the_post(); ?>
		
				<article class="wow fadeInDown">
					
					<?php if ( has_post_format( 'link' )) { # Link posts
						$post_link = funky_get_first_url( $post->post_content );
					} else {
						$post_link = get_permalink();
					} ?>
					
					<h2><a href="<?php echo $post_link; ?>"><?php the_title(); ?></a></h2>
					
                                        <div class="blog-traditional-header clearfix">
                                        
                                            <div class="gp-grid-3-4">

                                                <?php if ( has_post_thumbnail() ) { ?>

                                                    <!-- thumbnail -->
                                                    <a class="blog-traditional-thumbnail" href="<?php echo $post_link; ?>">								
                                                        <?php the_post_thumbnail( "thumbnail-post" ); ?>
                                                    </a>

                                                <?php } ?>											

                                            </div>
                                            <div class="gp-grid-1-4">
                                                <?php create_post_meta(); ?>
                                            </div>
                                            
                                        </div>
                                            
                                        <?php the_excerpt(); ?>
					
				</article>
			
			<?php endwhile; ?>
	
			<?php funky_pagination(); ?>
	
		<?php else: ?>
			
			<article>
				<p><?php _e( "No posts to display. Please check back soon!", "raw_theme" ); ?></p>			
				<p><a href="<?php echo home_url(); ?>/"><?php _e( "Return to home page", "raw_theme" ); ?> &rarr;</a></p>
			</article>
			
		<?php endif; ?>

	</div>

</div> <!--#content -->