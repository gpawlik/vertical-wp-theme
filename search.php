<?php get_header(); ?>

<div id="wrapper" class="clearfix">
	
	<!-- navigation sidebar -->
	<?php get_template_part( 'navigation' ); ?>
	
	<div id="content-wrapper">
	
		<div id="content">

			<div class="page-intro">
				
				<!-- title -->
				<h1><?php printf( __( 'Search Results for "%s"', 'raw_theme' ), get_search_query() ); ?></h1>
				
				<!-- subtitle -->
				<em><?php printf( __( '%s results found.', 'raw_theme' ), $wp_query->found_posts ); ?></em>
			
			</div>

			<?php get_template_part('loop'); ?>	
	
		<?php get_footer(); ?>