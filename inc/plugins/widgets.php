<?php /*
	Raw Theme Widgets
	EugeneO
	http://themeforest.net/user/EugeneO/portfolio
	Copyright (C) 2011 EugeneO
*/

// ---------- CONTACT DETAILS WIDGET ----------//

class raw_widget_contact_details extends WP_Widget {

	function raw_widget_contact_details() {
		$widget_ops = array( 'classname' => 'raw_contact', 'description' => __( "Contact details", 'raw_theme' ) );
		$this->WP_Widget( false, 'Raw Contact Details', $widget_ops );
	}

	function widget($args, $instance) {
		
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		
		$output = $before_widget . $before_title . $title . $after_title;
		
		$output .= '<div class="raw_contact_holder">';
		
			// Address
			if ( of_get_option( 'contact_widget_address' ) != '' ) {		
				$output .= '<span class="contact_address">'. of_get_option( 'contact_widget_address' ) .'</span>';				
			}			
			// Phone
			if ( of_get_option( 'contact_widget_phone' ) != '' ) {
				$output .= '<span class="contact_phone">'. of_get_option( 'contact_widget_phone' ) .'</span>';
			}
			// Mobile
			if ( of_get_option( 'contact_widget_mobile' ) != '' ) {
				$output .= '<span class="contact_mobile">'. of_get_option( 'contact_widget_mobile' )  .'</span>';			
			}
			// Fax
			if ( of_get_option( 'contact_widget_fax' ) != '' ) {
				$output .= '<span class="contact_fax">'. of_get_option( 'contact_widget_fax' ) .'</span>';
			}
			// Website			
			if ( of_get_option( 'contact_widget_website' ) != '' ) {
				$output .= '<span class="contact_website">'. of_get_option( 'contact_widget_website' ) .'</span>';
			}
			// Email
			if ( of_get_option( 'contact_widget_email' ) != '' ) {
				$output .= '<span class="contact_email">'. of_get_option( 'contact_widget_email' ) .'</span>';
			}						
		
		$output .= '</div>';
		
		$output .= $after_widget;
		
		echo $output;
        
	}

	function update($new_instance, $old_instance) {
	
		return $new_instance;
		
	}

	function form($instance) {
		
		// Title
		$title = esc_attr( $instance['title'] );
		echo '<p><label for="'. $this->get_field_id( 'title' ) .'">'. _e( 'Title:', 'raw_theme' ) .'<input class="widefat" id="'. $this->get_field_id('title') .'" name="'. $this->get_field_name('title') .'" type="text" value="'. $title .'" /></label></p>';
	
	}

}
add_action('widgets_init', create_function('', 'return register_widget("raw_widget_contact_details");'));

?>