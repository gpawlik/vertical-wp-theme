</div><!--#content -->
	
	<?php if ( have_posts() ): ?>

		<div id="blog-grid">
		
			<?php while ( have_posts() ): the_post(); ?>
		
				<article <?php post_class(); ?>>
					
					<?php if ( has_post_format( 'gallery' ) ) { # Gallery ?>
						
						<?php if ( has_post_Thumbnail() ) {						
							the_post_thumbnail( "thumbnail-post" );							
						} ?>
						
						<h3><?php the_title(); ?></h3>
						
					<?php } elseif ( has_post_format( 'quote' )) { # quote ?>
						
						<?php the_content(); ?>
						
					<?php } elseif ( has_post_format( 'status' )) { # status ?> 
						
						<?php the_content(); ?>
					
					<?php } elseif ( has_post_format( 'link' )) { # link ?>
						
						<!-- title -->
						<h3><a href="<?php echo funky_get_first_url( $post->post_content ); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'raw_theme' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<?php the_excerpt(); ?>
						
					<?php } else { # All other posts types ?>
						
						<?php if ( has_post_Thumbnail() ) {						
							the_post_thumbnail( "thumbnail-post" );						
						} ?>
						
						<!-- title -->
						<h3><?php the_title(); ?></h3>
						
						
						<?php if ( in_array( get_post_format(), array( 'video', 'audio' ) ) ) {
							
							if ( !empty( $post->post_excerpt ) ) {?>
								<p><?php raw_excerpt( 'excerpt_blog', 'excerptmore' ); ?></p>
							<?php } else {
								funky_the_remaining_content();
							} ?>
							
						<?php } else if ( $post->post_excerpt != " " && ( !empty( $post->post_excerpt ) || !empty( $post->post_content ) ) ) { ?>
							<!-- excerpt -->
							<p><?php raw_excerpt( 'excerpt_blog', 'excerptmore' ); ?></p>
						<?php } ?>						
						
					<?php } ?>
					
					<!-- date -->
					<small><time datetime="<?php the_time( 'c' ); ?>"><?php the_time(get_option('date_format')); ?></time></small>
					
					<div class="post-meta">
						
						<!-- category -->
						<?php $category = get_the_category(); ?>
						<span class="post-category"><?php echo $category[0]->cat_name; ?></span>
						
						<!-- icon -->
						<span class="icon-<?php echo get_post_format(); ?>"></span>
						
					</div>
					
					<!-- link -->
					<?php if ( has_post_format( 'link' )) { # Link posts ?>
						<a class="item-link" href="<?php echo funky_get_first_url( $post->post_content ); ?>"></a>
					<?php } else { ?>
						<a class="item-link" href="<?php the_permalink(); ?>"></a>
					<?php } ?>
					
				</article>
			
			<?php endwhile; ?>
			
		</div>
		
		<?php funky_pagination(); ?>
		
	<?php endif; ?>