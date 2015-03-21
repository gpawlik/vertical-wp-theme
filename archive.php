<?php get_header(); ?>

<div id="wrapper" class="clearfix">
	
	<!-- navigation sidebar -->
	<?php get_template_part( 'navigation' ); ?>
	
	<div id="content-wrapper">
	
		<div id="content">
			
			<?php if ( get_post_meta( $post->ID, 'reach_hide_title', true ) != 'on' ) { ?>
				
				<?php $save_post = $post;
				$post = get_post( get_option('page_for_posts') ); ?>
				
				<div class="page-intro">
					
					<!-- title -->
					<h1>
						<?php $post = $posts[0]; // Hack. Set $post so that the_date() works.
						/* If this is a category archive */ if ( is_category() ) {
							single_cat_title( '' );
						/* If this is a tag archive */ } elseif ( is_tag() ) {
							printf( __( 'Posts Tagged &#8216;%s&#8217;', 'raw_theme' ), single_tag_title( '', false ) );
						/* If this is a daily archive */ } elseif ( is_day() ) {
							printf( __( 'Archive for %s', 'raw_theme' ), get_the_date() );
						/* If this is a monthly archive */ } elseif ( is_month() ) {
							printf( __( 'Archive for %s', 'raw_theme' ), get_the_date( 'F Y' ) );
						/* If this is a yearly archive */ } elseif ( is_year() ) {
							printf( __( 'Archive for %s', 'raw_theme' ), get_the_date( 'Y' ) );
						/* If this is an author archive */ } elseif ( is_author() ) {
							_e( 'Author Archive', 'raw_theme' );
						/* If this is a paged archive */ } elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) {
							_e( 'Blog Archives', 'raw_theme' );
						} ?>					
					</h1>
					
					<!-- subtitle -->
					<?php if ( category_description() != '' ) { ?>
						<em><?php echo category_description(); ?></em>
					<?php } ?>
				
				</div>
				
				<?php $post = $save_post; ?>
				
			<?php } ?>
			
			<?php if ( of_get_option('archive_layout') == "0" ) {
				get_template_part('loop', 'grid'); 
			} else {
				get_template_part('loop');
			} ?>
			
			<?php get_footer(); ?>