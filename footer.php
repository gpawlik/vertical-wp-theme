	
	<?php if ( !is_page_template('page-blank.php') ) { ?>
		</div> <!-- #content-wrapper -->
	<?php } ?>
	
	<footer id="footer">
	
		<?php get_sidebar(); ?>
		
		<!-- copyright -->
		<div class="copyright">
			&copy; <?php echo date( "Y" ); ?> <a href="<?php echo home_url(); ?>/" ><?php bloginfo('name'); ?></a>. <span><?php echo of_get_option( 'copyright_text' ); ?></span>
		</div>	
	
	</footer>
	
</div> <!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>