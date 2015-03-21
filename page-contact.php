<?php
/**
 * Template Name: Contact
 *
 * The template for displaying a contact page.
 *
 * This template includes a contact form that allows visitors to submit a message
 * to a specified email address.
 * 
 * @package WordPress
 * @subpackage Reach
 * @since Reach 1.0
 **/ 
 
get_header();

$emailSent = null;
$nameError = null;
$emailError = null;
$commentError = null;

//If the form is submitted
if( isset( $_POST['submitted'] ) ) {
	
	global $shortname;
	
	//Check to see if the honey pot field was filled in
	if( trim( $_POST['checking'] ) !== '' ) {
	
		$captchaError = true;
		
	} else {
	
		//Check to make sure that the name field is not empty
		$name = utf8_decode( sanitize_text_field( trim( $_POST['contactName'] ) ) );
		if( $name === '' ) {
			$nameError = __( 'You forgot to enter your name.', 'funky_theme' );
			$hasError = true;
		}
		
		//Check to make sure sure that a valid email address is submitted
		$email = sanitize_text_field( trim( $_POST['email'] ) );
		if( $email === '' ) {
			$emailError = __( 'You forgot to enter your email address.', 'funky_theme' );
			$hasError = true;
		} else if ( !is_email( $email ) ) {
			$emailError = __( 'You entered an invalid email address.', 'funky_theme' );
			$hasError = true;
		}
		
		//Check to make sure comments were entered
		$comments = sanitize_text_field( trim( $_POST['comments'] ) );
		if( $comments === '') {
			$commentError = __( 'You forgot to enter your message.', 'funky_theme' );
			$hasError = true;
		}
		
		//If there is no error, send the email
		if( !isset( $hasError ) ) {
			
			$emailTo = of_get_option( 'address' );
			$subject = get_bloginfo( 'name' ) .' contact form submission';
			$sendCopy = trim( $_POST['sendCopy'] );
			
			$body = $comments ."\r\n\r\n";
			$body .= $name ."\r\n";
			$body .= $email;
			
			// Email headers
			$headers[] = "Content-Type: text/plain";
			$headers[] = "charset=utf-8";
			$headers[] = "From: ". $name ." <". $email .">";
			
			if ( wp_mail( $emailTo, $subject, $body, $headers ) ) {
				$emailSent = true;
			} else {
				$emailSent = false;
			}

			if( $sendCopy == true ) {
			
				$subject = "You emailed ". get_bloginfo('name');
				
				// Email headers
				$receipt_headers[] = "Content-Type: text/plain;";
				$receipt_headers[] = "charset=utf-8";
				$receipt_headers[] = "From: ". get_bloginfo( 'name' ) ." <". $emailTo .">";
				
				wp_mail( $email, $subject, $body, $receipt_headers );
				
			}

		}
	}
} ?>

<div id="wrapper" class="clearfix">
	
	<!-- navigation sidebar -->
	<?php get_template_part( 'navigation' ); ?>
	
	<div id="content-wrapper">
	
		<div id="content" <?php post_class();?>>
			
			<?php if ( get_post_meta( $post->ID, 'reach_hide_title', true ) != 'on' ) { ?>
				
				<div class="page-intro">
					
					<!-- title -->
					<?php if ( get_post_meta( $post->ID, 'reach_page_title', true ) != '' ) { ?>
						<h1><?php echo get_post_meta( $post->ID, 'reach_page_title', true ); ?></h1>
					<?php } else { ?>
						<h1><?php the_title(); ?></h1>
					<?php } ?>
				
					<!-- subtitle -->
					<?php if ( get_post_meta( $post->ID, 'reach_subtitle', true ) != '' ) { ?>
						<em><?php echo get_post_meta( $post->ID, 'reach_subtitle', true ); ?></em>
					<?php } ?>
				
				</div>
			
			<?php } ?>			
			
			<?php if ( get_post_meta( $post->ID, 'reach_enable_slider', true ) == 'on' ) {				
				raw_create_slider( $post->ID );				
			} elseif ( has_post_thumbnail() && get_post_meta( $post->ID, 'reach_hide_feature_image', true ) != 'on'  ) {
				the_post_thumbnail( "large" );
			} ?>
			
			<?php if ( have_posts() ): ?>
				
				<?php while ( have_posts() ): the_post(); ?>
				
					<!-- content -->
					<article class="page-content clearfix">
						
						<div id="two-column-gallery" class="two-thirds">
							
							<?php the_content(); ?>
							
							<?php if ( !$emailSent ) { ?>								
					
								<?php if ( isset( $hasError ) || isset( $captchaError ) ) { ?>
									<p class="error"><?php _e( 'There was an error submitting your message.', 'funky_theme' ); ?><p>
								<?php } ?>							
								
								<div id="respond" class="contact-form">
								
									<form action="<?php the_permalink(); ?>" id="contactform" method="post">
										
										<p class="comment-form-author">
											<label for="contactName"><?php _e( 'Name', 'funky_theme' ); ?></label>
											<span class="required">*</span>
											<input type="text" name="contactName" id="contactName" class="required" value="<?php if ( isset( $_POST['contactName'] ) ) { echo $_POST['contactName'];}?>" tabindex="1" />
											<?php if ( $nameError == true ) { ?>													
												<label for="contactName" class="error"><?php echo $nameError;?></label>
											<?php } ?>
										</p>
										
										<p class="comment-form-email">									
											<label for="email"><?php _e( 'Email', 'funky_theme' ); ?></label>
											<span class="required">*</span>
											<input type="text" name="email" id="email" class="required email" value="<?php if ( isset( $_POST['email'] ) ) { echo $_POST['email'];}?>" tabindex="2"/>
											<?php if ( $emailError == true ) { ?>													
												<label for="email" class="error"><?php echo $emailError;?></label>
											<?php } ?>
										</p>
										
										<p class="comment-form-comment">
											<label for="commentsText"><?php _e( 'Message', 'funky_theme' ); ?></label>
											<span class="required">*</span>
											<textarea name="comments" id="commentsText" class="required" rows="1" cols="1" tabindex="3"><?php if ( isset( $_POST['comments'] ) ) {	if ( function_exists( 'stripslashes' ) ) {	echo stripslashes( $_POST['comments'] ); } else { echo $_POST['comments'];}} ?></textarea>
											<?php if ( $commentError == true ) { ?>													
												<label for="commentsText" class="error"><?php echo $commentError;?></label>
											<?php } ?>
											
										</p>
										
										<p class="form-receipt">
											<input type="checkbox" name="sendCopy" id="sendCopy" class="checkbox" value="true" <?php if ( isset( $_POST['sendCopy'] ) && $_POST['sendCopy'] == true ) echo ' checked="checked"'; ?> tabindex="4"/>
											<label class="checkbox" for="sendCopy"><?php _e( 'Send copy of email to yourself', 'funky_theme' ); ?></label>
										</p>
										
										<p class="form-submit">
											<input name="submit" type="submit" id="submit" class="button" tabindex="5" value="<?php _e( 'Send Message', 'funky_theme' ); ?>" />
										</p>
										
										<p class="displace">
											<label for="checking"><?php _e( 'If you want to submit this form, do not enter anything in this field', 'funky_theme' ); ?></label>
											<input type="text" name="checking" id="checking" value="<?php if ( isset( $_POST['checking'] ) )  echo $_POST['checking'];?>" />
											<input type="hidden" name="submitted" id="submitted" value="true" />	
										</p>

									</form>
								
								</div>
							
							<?php } else { ?>
								
								<h4><?php _e( 'Thank you. Your message has been sent.', 'funky_theme' ); ?></h4>
								
							<?php } ?>
							
						</div>
						
						<div id="two-column-text" class="third end">							
							
							<!-- google map -->
							<?php if ( get_post_meta( $post->ID, 'reach_map_address', true ) != '' ) { ?>								
								
								<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
								
								<div id="map_canvas-contact" class="google-map" style="height: 232px;"></div>
								
								<script type="text/javascript">
									jQuery(document).ready(function($) {
										
										var mapOptions = {
											zoom: 15,
											mapTypeId: google.maps.MapTypeId.ROADMAP,
											disableDefaultUI: true
										}
										
										var map = new google.maps.Map(document.getElementById("map_canvas-contact"), mapOptions);					
										
										geocoder = new google.maps.Geocoder();
										var address = "<?php echo get_post_meta( $post->ID, 'reach_map_address', true ); ?>";
										geocoder.geocode( { "address": address }, 
											function(results, status) {
												if (status == google.maps.GeocoderStatus.OK) {
													map.setCenter(results[0].geometry.location);
													var marker = new google.maps.Marker({
														map: map, 
														position: results[0].geometry.location
													});
												}
											});
									});
								</script>
								
							<?php } ?>
							
							<!-- contact details -->
							<div class="raw_contact_holder">
		
								<?php
								// Address
								if ( of_get_option( 'contact_widget_address' ) != '' ) {
									echo '<span class="contact_address">'. of_get_option( 'contact_widget_address' ) .'</span>';				
								}			
								// Phone
								if ( of_get_option( 'contact_widget_phone' ) != '' ) {
									echo '<span class="contact_phone">'. of_get_option( 'contact_widget_phone' ) .'</span>';
								}
								// Mobile
								if ( of_get_option( 'contact_widget_mobile' ) != '' ) {
									echo '<span class="contact_mobile">'. of_get_option( 'contact_widget_mobile' ) .'</span>';			
								}
								// Fax
								if ( of_get_option( 'contact_widget_fax' ) != '' ) {
									echo '<span class="contact_fax">'. of_get_option( 'contact_widget_fax' ) .'</span>';
								}
								// Website			
								if ( of_get_option( 'contact_widget_website' ) != '' ) {
									echo '<span class="contact_website">'. of_get_option( 'contact_widget_website' ) .'</span>';
								}
								// Email
								if ( of_get_option( 'contact_widget_email' ) != '' ) {
									echo '<span class="contact_email">'. of_get_option( 'contact_widget_email' ) .'</span>';
								}
								?>				
							
							</div>
							
						</div>
					
					</article>
					
				<?php endwhile; ?>
				
			<?php endif; ?>		
			
		</div>
	
		<?php get_footer(); ?>