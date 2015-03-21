<aside id="sidebar">

	<header>
		
		<!-- logo -->
		<a href="<?php echo home_url(); ?>/" title="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>" id="logo">
			
			<?php if (of_get_option( 'logo' ) != "" ) { ?>
				
				<img class="desktop-logo" src="<?php echo of_get_option( 'logo' ); ?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>" />				
				
				<?php if (of_get_option( 'mobile_logo' ) != "" ) { ?>
					<img class="mobile-logo" src="<?php echo of_get_option( 'mobile_logo' ); ?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>" />				
				<?php } else { ?>
					<img class="mobile-logo" src="<?php echo of_get_option( 'logo' ); ?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>" />				
				<?php } ?>
				
			<?php } else { ?>			
				<?php bloginfo('name'); ?>			
			<?php } ?>
			
		</a>
		
		<!-- navigation -->
		<nav id="main-navigation" class="clearfix">
			
			<?php wp_nav_menu( 
				array( 
					'theme_location' => 'main-navigation', 
					'container' => false,
					'menu_id' => 'navigation',
					'menu_class' => 'clearfix',
					'fallback_cb' => false
				)
			); ?>
			
			<select id="mobile-navigation">
				<option selected="selected" value=""><?php _e( "Select a page ...", "raw_theme" ); ?></option>
			</select>
			
		</nav>
		
		<?php if (
			of_get_option( 'facebook' ) != ''
			|| of_get_option( 'twitter' ) != ''
			|| of_get_option( 'google_plus' ) != ''
			|| of_get_option( 'dribbble' ) != ''
			|| of_get_option( 'linkedin' ) != ''
			|| of_get_option( 'vimeo' ) != ''
			|| of_get_option( 'youtube' ) != ''
		) : ?>
			<!-- social buttons -->
			<div class="social-button-holder">
			
				<?php if ( of_get_option( 'facebook' ) != '') {
					echo '<a class="facebook-button" title="'.__("Follow on Facebook", "raw_theme").'" href="'. of_get_option( 'facebook' ) .'" target="_blank">Facebook</a>';
				}
				if ( of_get_option( 'twitter' ) != '') {
					echo '<a class="twitter-button" title="'.__("Follow on Twitter", "raw_theme").'" href="'. of_get_option( 'twitter' ) .'" target="_blank">Twitter</a>';
				}			
				if ( of_get_option( 'google_plus' ) != '') {
					echo '<a class="google-button" title="'.__("Follow on google+", "raw_theme").'" href="'. of_get_option( 'google_plus' ) .'" target="_blank">Google+</a>';
				}
				if ( of_get_option( 'dribbble' ) != '') {
					echo '<a class="dribbble-button" title="'.__("Follow on Dribbble", "raw_theme").'" href="'. of_get_option( 'dribbble' ) .'" target="_blank">Dribbble</a>';
				}
				if ( of_get_option( 'linkedin' ) != '') {
					echo '<a class="linkedin-button" title="'.__("Follow on LinkedIn", "raw_theme").'" href="'. of_get_option( 'linkedin' ) .'" target="_blank">LinkedIn</a>';
				}
				if ( of_get_option( 'vimeo' ) != '') {
					echo '<a class="vimeo-button" title="'.__("Follow on Vimeo", "raw_theme").'" href="'. of_get_option( 'vimeo' ) .'" target="_blank">Vimeo</a>';
				}
				if ( of_get_option( 'youtube' ) != '') {
					echo '<a class="youtube-button" title="'.__("Follow on YouTube", "raw_theme").'" href="'. of_get_option( 'youtube' ) .'" target="_blank">YouTube</a>';
				}
				?>

			</div>
		<?php endif; ?>
		
	</header>	

</aside>