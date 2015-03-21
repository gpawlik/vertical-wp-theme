<div class="page-intro">
	
	<!-- title -->
	<h1><?php the_title(); ?></h1>

	<!-- subtitle -->
	<?php if ( get_post_meta( $post->ID, 'reach_subtitle', true ) != '' ) { ?>
		<em><?php echo get_post_meta( $post->ID, 'reach_subtitle', true ); ?></em>
	<?php } ?>

</div>

<?php create_post_meta(); ?>

<div class="audio-container">
	<?php funky_embed_feature_content(); ?>
</div>

<!-- content -->
<article class="page-content clearfix">
	
	<?php funky_the_remaining_content(); ?>
	
	<!-- post pagination -->
	<?php wp_link_pages( array( 'before' => '<div class="pagination">Page: ', 'after' => '</div>', 'next_or_number' => 'number', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	
	<?php if ( has_tag() && of_get_option( 'tag_meta' ) == "1" ) { ?>
		<!-- tags -->
		<div class="post-tags"><?php the_tags('<span class="tag-icon"></span>', ' '); ?></div>
	<?php } ?>

	<?php comments_template(); ?>
	
</article>