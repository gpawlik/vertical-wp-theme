<form method="get" class="searchform" action="<?php echo home_url(); ?>/">
	<fieldset>
		<input class="s" type="text" value="<?php if ( isset($s) && trim( esc_html( $s,1 ) )!='' ) echo trim( esc_html( $s,1 ) ); else echo '';?>" name="s">
		<input class="searchsubmit" type="submit" value="<?php _e('Search' ,'raw_theme'); ?>">
	</fieldset>
</form>