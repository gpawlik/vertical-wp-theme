		
	<footer id="footer">
	
            <div class="clearfix">
                <!-- 1/3 -->
                <div class="gp-grid-1-4">
                    <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar(__( 'Footer Left', 'raw_theme' )) ) ?>
                </div>
                <!-- /End 1/3 -->
                <!-- 2/3 -->
                <div class="gp-grid-1-4">
                    <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar(__( 'Footer Center', 'raw_theme' )) ) ?>
                </div>
                <!-- /End 2/3 -->
                <!-- 3/3 -->
                <div class="gp-grid-1-2">
                    <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar(__( 'Footer Right', 'raw_theme' )) ) ?>
                </div>
                <!-- /End 3/3 -->
            </div>
	
	</footer>

        <!-- copyright -->
        <div class="copyright">
            &copy; <?php echo date( "Y" ); ?> <a href="<?php echo home_url(); ?>/" ><?php bloginfo('name'); ?></a>. <span><?php echo of_get_option( 'copyright_text' ); ?></span>
        </div>

    </div> <!-- #content-wrapper -->
	
</div> <!-- #wrapper -->

<?php wp_footer(); ?>

<script>
 new WOW().init();
</script>

</body>
</html>