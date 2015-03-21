<?php if ( !empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
	die ( 'Please do not load this page directly.' );
	
if ( post_password_required() ) { ?>
	<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php return;
} ?>

<?php if ( comments_open() ) { ?>
	
	<div class="clearboth"></div>
	
	<div id="comments-holder">
		
		<?php if ( have_comments() || comments_open() ) { ?>
			<h3 class="comment-title"><?php comments_number( __( '0 Comments', 'raw_theme' ), __( '1 Comment', 'raw_theme' ), __( '% Comments', 'raw_theme' ) ); ?></h3>
		<?php } ?>
		
		<?php if ( have_comments() ) { ?>
			
			<?php // Are there comments to navigate through?
			if ( get_comments_number() > get_option( 'comments_per_page' ) ) { ?>
			
				<!-- comment pagination -->
				<div id="comment-pagination" class="pagination">
					<ul>
						<li class="alignright"><?php next_comments_link( 'Newer Comments &rarr;' ) ?></li>
						<li class="alignleft"><?php previous_comments_link( '&larr; Older Comments' ) ?></li>
					</ul>
				</div>
			
			<?php } ?>
			
			<ol id="comments" class="commentlist">
				<?php wp_list_comments( 'callback=new_comment_list' ); ?>
			</ol>
			
		<?php } else { // If there are no comments ?>

			<?php if ( comments_open() ) { // If comments are open, but there are no comments. ?>
				<p><?php _e("Be the first to post a comment.", "raw_theme"); ?></p>
			<?php } ?>

		<?php } ?>


		<?php if ( comments_open() ) { ?>

			<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) { ?>
			
				<p class="comment-login"><?php printf( __( 'You must be logged in to post a comment.', 'raw_theme' ) ); ?></p>
				
			<?php } else { ?>

				<?php $fields =  array(
					'author' => '<div class="third">
									<p class="comment-form-author">
										<label for="author">' . __( 'Name', 'funky_theme' ) . '</label><span class="required">*</span>
										<input id="author" name="author" type="text" class="required" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />
									</p>
								</div>',
								
					'email'  => '<div class="third">
									<p class="comment-form-email">
										<label for="email">' . __( 'Email', 'funky_theme' ) . '</label><span class="required">*</span>
										<input id="email" name="email" type="text" class="required email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" />
									</p>
								</div>',
								
					'url'    => '<div class="third end">
									<p class="comment-form-url">
										<label for="url">' . __( 'Website', 'funky_theme' ) . '</label>
										<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />
									</p>
								</div>'						
				);
				
				comment_form(
					array(
						'logged_in_as'			=>	'<p class="logged-in-as">' . sprintf( __( 'Logged in as %1$s. <a href="%2$s" title="Log out of this account">Log out?</a>' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ) ) . '</p>',
						'comment_notes_after'	=>	false,
						'title_reply'			=>	__( 'Leave a Comment', 'funky_theme' ),
						'label_submit'			=>	__( 'Submit', 'funky_theme' ),
						'fields'				=>	$fields,
						'comment_field'			=> '<p class="comment-form-comment">
														<label for="comment">Comment</label>
														<textarea id="comment" class="required" name="comment" cols="45" rows="8"  aria-required="true"></textarea>
													</p>'
					)
				); ?>
				
			<?php } // If registration required and not logged in ?>

		<?php } // if comments open ?>

	</div>

<?php } ?>