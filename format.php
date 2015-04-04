<div class="page-intro">
    
        <?php echo gp_prev_next_page($post->ID, get_option( 'page_for_posts' )) ?>
	
	<!-- title -->
	<h1><?php the_title(); ?></h1>

	<!-- subtitle -->
	<?php if ( get_post_meta( $post->ID, 'reach_subtitle', true ) != '' ) { ?>
		<em><?php echo get_post_meta( $post->ID, 'reach_subtitle', true ); ?></em>
	<?php } ?>

</div>

<?php create_post_meta(); ?>

<?php if ( has_post_thumbnail() && get_post_meta( $post->ID, 'reach_hide_feature_image', true ) != 'on' && get_post_format() != 'gallery' ) {
	the_post_thumbnail( "large" );
} ?>

<!-- content -->
<article class="page-content clearfix">
	
	<?php the_content(); ?>
	
	<!-- post pagination -->
	<?php wp_link_pages( array( 'before' => '<div class="pagination">Page: ', 'after' => '</div>', 'next_or_number' => 'number', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	
	<?php if ( has_tag() && of_get_option( 'tag_meta' ) == "1" ) { ?>
		<!-- tags -->
		<div class="post-tags"><?php the_tags('<span class="tag-icon"></span>', ' '); ?></div>
	<?php } ?>
	
	<?php comments_template(); ?>
	
</article>