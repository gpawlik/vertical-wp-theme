<?php

$shortname	= "reach";
$theme		= wp_get_theme();
$themename	= preg_replace( "/\W/", "", strtolower( $theme->Name ) );

/*-----------------------------------------------------------------------------------
	OPTIONS FRAMEWORK
-----------------------------------------------------------------------------------*/

/**
 * Set the file path based on whether the Options Framework Theme is a parent theme or child theme
 **/
 
if ( !function_exists( 'optionsframework_init' ) ) {
	
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', trailingslashit( get_template_directory_uri() ) .'inc/theme-options/' );	
	require_once dirname( __FILE__ ) .'/inc/theme-options/options-framework.php';
	require_once dirname( __FILE__ ) .'/inc/theme-options/options.php'; // Loaded specifically for WP Customizer support

}


/*-----------------------------------------------------------------------------------
	FRAMEWORK FILES
-----------------------------------------------------------------------------------*/

require_once( trailingslashit( get_template_directory() ) .'inc/template-options/template-options-config.php' );
require_once( trailingslashit( get_template_directory() ) .'inc/funky-comments.php' );
require_once( trailingslashit( get_template_directory() ) .'inc/plugins/widgets.php' );

# Custom Post Types
require_once( trailingslashit( get_template_directory() ) .'/inc/post-types/portfolio.php' );
require_once( trailingslashit( get_template_directory() ) .'/inc/post-types/sliders.php' );
require_once( trailingslashit( get_template_directory() ) .'/inc/post-types/staff.php' );


/*-----------------------------------------------------------------------------------
	THEME SETUP
-----------------------------------------------------------------------------------*/

/**
 * Sets up the content width value based on the theme's design. 
 **/
if ( !isset( $content_width ) ) {
	$content_width = 1024;
}


/**
 * Sets up theme defaults and registers the various WordPress features that
 * supported by the theme.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, admin bar, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since WirePress 1.0
 *
 * @return void
 **/
 
function funky_theme_setup() {
	
	/**
	 * Makes the theme available for translation.
	 *
	 * Translations can be added to the /lang/ directory.
	 * If you're building a theme based on this theme, use a find and
	 * replace to change 'funky_theme' to the name of your theme in all
	 * template files.
	 **/
	load_theme_textdomain( 'raw_theme', trailingslashit( get_template_directory() ) .'lang/' );
	
	
	/**
	 * Adds RSS feed links to <head> for posts and comments.
	 **/
	add_theme_support( 'automatic-feed-links' );
	
	
	/**
	 * This theme supports all available post formats.
	 * See http://codex.wordpress.org/Post_Formats
	 **/
	add_theme_support( 'post-formats', array( 'audio', 'gallery', 'link', 'quote', 'status', 'video' ) );
	add_post_type_support( 'portfolio', 'post-formats' );
	
	/**
	 * This theme uses wp_nav_menu() in two location.
	 **/
	register_nav_menus(
		array(
			'main-navigation'	=> __( 'Main Navigation', 'raw_theme' ),
			'sitemap'			=> __( 'Sitemap', 'raw_theme' )
		)
	);

	
	/**
	 * This theme uses a custom image size portfolio item featured images 
	 * displayed in the admin dashboard.
	 **/
	add_theme_support( 'post-thumbnails' );	
	set_post_thumbnail_size( 150, 150, false ); 			# gallery (doesn't work)
	add_image_size( 'dashboard', 150, 90, true ); 			# Dashboard
	add_image_size( 'thumbnail-post', 480, 999, false );	# Post archive feature images
	add_image_size( 'thumbnail-portfolio', 480, 320, true );# Portfolio archive feature images
	
	
	/**
	 * This theme uses its own gallery styles.
	 **/
	add_filter( 'use_default_gallery_style', '__return_false' );
	
}	
add_action( 'after_setup_theme', 'funky_theme_setup' );


/**
 *	Flush rewrite rules
 *	Function that causes all site permalinks to regenerate when this theme is switched to. Used to prevent custom post type 404 errors.
 **/
function funky_flush_rewrite() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'funky_flush_rewrite' );


/*-----------------------------------------------------------------------------------
	LOAD SCRIPTS
-----------------------------------------------------------------------------------*/

function enqueueScripts() {
	
	if( !is_admin() ) {
	
		global $post, $shortname;
		
		# jQuery
		wp_enqueue_script( 'jquery' );
		
		# AJAX Comments
		wp_enqueue_script( 'comment-reply' );
		
		# addThis
		if ( of_get_option( 'addthis_id' ) != "" ) {
			wp_enqueue_script( 'addthis', 'http://s7.addthis.com/js/250/addthis_widget.js#pubid='. of_get_option( 'addthis_id' ), array( 'jquery' ), false, 1 );
		} else {			
			wp_enqueue_script( 'addthis', 'http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4ef0d02d71373c31', array( 'jquery' ), false, 1 );
		}
		
		# Backstretch
		wp_enqueue_script( 'backstretch', get_template_directory_uri() .'/js/jquery.backstretch.min.js', array( 'jquery' ), false, 0 );

		# colorbox
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'jquery-colorbox/jquery-colorbox.php' ) && of_get_option( 'colorbox_theme_styles' ) == '1' ) {
			wp_deregister_style( 'colorbox-theme1' );
			wp_deregister_style( 'colorbox-theme2' );
			wp_deregister_style( 'colorbox-theme3' );
			wp_deregister_style( 'colorbox-theme4' );
			wp_deregister_style( 'colorbox-theme5' );
			wp_deregister_style( 'colorbox-theme6' );
			wp_deregister_style( 'colorbox-theme7' );
			wp_deregister_style( 'colorbox-theme8' );
			wp_deregister_style( 'colorbox-theme9' );
			wp_deregister_style( 'colorbox-theme10' );
			wp_deregister_style( 'colorbox-theme11' );
			wp_enqueue_style( 'jquery-colorbox', trailingslashit( get_template_directory_uri() ) .'css/colorbox.css' );			
		}
		
		# Flexslider
		if ( get_post_meta( $post->ID, $shortname .'_enable_slider', true ) == 'on' ) {
			wp_enqueue_script( 'flexslider', get_template_directory_uri() .'/js/jquery.flexslider-min.js', array( 'jquery' ), false, 1 );
			wp_enqueue_style( 'flexslider', get_template_directory_uri() .'/css/flexslider.css' );
		}

		# ImagesLoaded
		wp_enqueue_script( 'imagesloaded', trailingslashit( get_template_directory_uri() ) .'js/imagesloaded.min.js', false, false, 1  );
		
		# Isotope
		if ( 
			( is_page_template( 'page-portfolio.php' ) )
			|| ( is_archive() && of_get_option( 'archive_layout' ) == "0" )
			|| ( is_search() && of_get_option( 'search_layout' ) == "0" )
			|| ( is_home() && of_get_option( 'blog_layout' ) == "0" )
		) {
			wp_enqueue_script( 'isotope', get_template_directory_uri() .'/js/jquery.isotope.min.js', array( 'jquery' ), false, 0 );
		}
		
		# Media Element		
		if ( is_page_template( 'page-portfolio.php' ) ) {
			wp_enqueue_script( 'wp-mediaelement' );
			wp_enqueue_style( 'mediaelement', includes_url() .'/js/mediaelement/mediaelementplayer.min.css?ver=2.13.0' );
		}
		
		#modernizr
		wp_enqueue_script( 'modernizr', get_template_directory_uri() .'/js/modernizr-1.7.min.js', array( 'jquery' ), false, 0 );
		
		# Smoothscroll			
		if ( of_get_option( 'smoothscroll' ) == '1' ) {		
			wp_enqueue_script( 'smoothscroll', get_template_directory_uri() .'/js/smoothscroll.js', array( 'jquery' ), false, 1 );		
		}		

		# Validate
		if ( is_page_template( 'page-contact.php' ) ) {
		
			wp_enqueue_script( 'validate', get_template_directory_uri() .'/js/jquery.validate.min.js', array( 'jquery' ), false, 1 );
			
			# This gets the locale setting for the blog and adds the necessary validate plugin language file.
			$locale = explode( "_", get_locale() );
			
			if ( $locale[0] != 'en' ) {
				wp_enqueue_script( 'validate-localization', get_template_directory_uri() .'/js/localization/messages_'. $locale[0] .'.js', array( 'jquery' ), false, 1 );
			}
		
		}
		
		# custom.js
		wp_enqueue_script( 'raw_custom', get_template_directory_uri() .'/js/jquery.custom.js', array( 'jquery' ), false, 1 );
		
		# Main stylesheet
		wp_enqueue_style( 'reach-style', get_stylesheet_uri() );
		
		# Funky Shortcodes
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if (  is_plugin_active( 'funky-shortcodes/funky-shortcodes.php' ) ) {
			wp_enqueue_style( 'funky-shortcodes-theme', trailingslashit( get_template_directory_uri() ) .'css/funky-shortcodes-theme.css' );			
		}
		
	}

}
add_action( 'template_redirect', 'enqueueScripts' );


/*-----------------------------------------------------------------------------------
	LOAD ADMIN SCRIPTS
-----------------------------------------------------------------------------------*/

function enqueueAdminScripts() {
	wp_enqueue_script( 'raw_admin_custom', get_template_directory_uri() .'/js/jquery.admin.js', array( 'jquery' ), false );
}
add_action( 'admin_print_scripts-post.php', 'enqueueAdminScripts' );
add_action( 'admin_print_scripts-edit.php', 'enqueueAdminScripts' );
add_action( 'admin_print_scripts-post-new.php', 'enqueueAdminScripts' );


/*-----------------------------------------------------------------------------------
	DYNAMIC CSS
-----------------------------------------------------------------------------------*/

function funky_generate_dynamic_css() {
	
	global $shortname;
	
	# Links
	$links = of_get_option( 'colour_links' );
	
	# Link Hover
	$link_hover = of_get_option( 'colour_link_hover' );
	
	# Buttons
	$buttons = of_get_option( 'colour_buttons' );
	
	# Buttons Text
	$buttons_text = of_get_option( 'colour_buttons_text' );
	
	
	/* ---------- LINKS ---------- */
	
	$link_style = "
	/* LINKS
	================================================== */
	.page-content a, .page-content a:visited { color: {$links}; }
	.page-content a:hover, .page-content a:visited:hover, #comments .comment small a:hover, #comments .comment-reply-link:hover { color: {$link_hover}; }";
	
	wp_add_inline_style( $shortname .'-style', $link_style );
	
	
	/* ---------- BUTTONS ---------- */
	
	$button_style = "
	/* BUTTONS
	================================================== */
	span.required { color: {$buttons}; }
	input[type='reset'], input[type='button'], button, input[type='submit'], #footer input[type='submit'], .page-content input[type='submit'], a.funky-button, a.funky-button:visited {
		background-color: {$buttons};
		color: {$buttons_text};
	}

	input[type='reset']:hover, input[type='button']:hover, button:hover, input[type='submit']:hover, #footer input[type='submit']:hover, .page-content input[type='submit']:hover, a.funky-button:hover, a.funky-button:visited:hover {
		background: {$buttons};
		color: {$buttons_text};
	}
	
	.mejs-controls .mejs-time-rail .mejs-time-current,
	.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current { background: {$buttons} !important; }
	";
	
	wp_add_inline_style( $shortname .'-style', $button_style );
	
	
	/* ---------- LIGHT COLOUR SCHEME ---------- */
	
	if ( of_get_option( 'colour_scheme' ) == '1' ) {
	
		$light_color_style = "
		/* LIGHT COLOUR SCHEME
		================================================== */
		#sidebar, #footer, #portfolio-grid .meta { background: #F6F6F6 }
		#blog-grid .post-meta { background-color: #FFF }
		.pagination { background-color: #F6F6F6 }

		#sidebar #logo { border-bottom: 4px solid #DDD; color: #333 }
		#sidebar a#logo:hover { border-bottom: 4px solid #DDD }
		#sidebar, #footer { color: #666 }
		.pagination, .pagination a:hover { color: #666 }
		.widgettitle, #portfolio-grid .meta { color: #666 }

			.pagination a, #sidebar a, #footer a, #portfolio-grid small { color: #333 }
			#sidebar a:hover, #footer a:hover { color: #333; border-bottom: 1px dotted #333 }
			#main-navigation a { color: #666 }	
			#main-navigation .hover > a { color: #666; }
			#main-navigation a:hover { background: #DDD; border: none; color: #222; }
			#main-navigation .hover > a:hover { color: #222 }
			#main-navigation .hover { background: #DDD; }
				#main-navigation ul ul { background: #DDD; }
					#main-navigation ul ul a { color: #666; }
			#main-navigation select { border: 1px solid #CCC; }

		.social-button-holder { border-top: 1px dotted #CCC; }	
		#blog-grid .post-meta { color: #444; }
		.post-icon { background: url(". trailingslashit( get_template_directory() ) ."images/post-icons-dark.png) no-repeat; }

		.widget { border-top: 1px dotted #CCC; }			
			#footer select, #footer .searchform input[type='text'], #footer input[type='text'], #footer input[type='password'], #footer textarea { background: #DDD; border: 1px solid #CCC; color: #333; }
			.searchform { border: 1px solid #CCC; }
			#footer .searchform input[type='text'] { border: none; }
			#footer .searchform .searchsubmit { background: #DDD url(". trailingslashit( get_template_directory() ) ."images/search-button.png) no-repeat; }
			#footer .searchform .searchsubmit:hover { background: #DDD url(". trailingslashit( get_template_directory() ) ."images/search-button.png) no-repeat bottom left; }";
	
		wp_add_inline_style( $shortname .'-style', $light_color_style );
	
	}
	
}
add_action( 'wp_enqueue_scripts', 'funky_generate_dynamic_css' );


/*-----------------------------------------------------------------------------------
	ADD FAVICON & APPLE BOOKMARK ICON
-----------------------------------------------------------------------------------*/

function add_custom_favicon() {
	
	if ( of_get_option( 'custom_favicon' ) != '' ) {
		echo "<link rel='shortcut icon' href='". of_get_option( 'custom_favicon' ) ."'/>\n";
	}
	if ( of_get_option( 'apple_bookmark_57' ) != '' ) {
		echo "<!-- Non retina display devices -->\n<link rel='apple-touch-icon' sizes='57x57' href='". of_get_option( 'apple_bookmark_57' ) ."'/>\n";
	}
	if ( of_get_option( 'apple_bookmark_114' ) != '' ) {
		echo "<!-- Retina display iPhone -->\n<link rel='apple-touch-icon' sizes='114x114' href='". of_get_option( 'apple_bookmark_114' ) ."'/>\n";
	}
	if ( of_get_option( 'apple_bookmark_72' ) != '' ) {
		echo "<!-- Non retina display iPad -->\n<link rel='apple-touch-icon' sizes='72x72' href='". of_get_option( 'apple_bookmark_72' ) ."'/>\n";
	}
	if ( of_get_option( 'apple_bookmark_144' ) != '' ) {
		echo "<!-- Retina display iPad -->\n<link rel='apple-touch-icon' sizes='144x144' href='". of_get_option( 'apple_bookmark_144' ) ."'/>\n";
	}
	
}
add_action( 'wp_head', 'add_custom_favicon' );


/*-----------------------------------------------------------------------------------
	ENABLE CUSTOM BACKGROUNDS
-----------------------------------------------------------------------------------*/

add_theme_support( 'custom-background' );

if ( !function_exists( 'raw_get_default_background' ) ) {

	function raw_get_default_background() {
		
		if ( of_get_option( 'default_background' ) != "" ){
			return of_get_option( 'default_background' );
		} else {		
			return false;		
		}
		
	}

}


/*-----------------------------------------------------------------------------------
	IMAGE RESIZE
-----------------------------------------------------------------------------------*/

/**
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 *
 * php 5.2+
 *
 * Exemplo de uso:
 * 
 * <?php 
 * $thumb = get_post_thumbnail_id(); 
 * $image = vt_resize( $thumb, '', 140, 110, true );
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
 **/
if ( !function_exists( 'vt_resize') ) {

	function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {

		// this is an attachment, so we have the ID
		if ( $attach_id ) {

			$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
			$file_path = get_attached_file( $attach_id );

		// this is not an attachment, let's use the image url
		} else if ( $img_url ) {

			$file_path = parse_url( $img_url );
			$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];

			// Look for Multisite Path
			if(file_exists($file_path) === false){
				global $blog_id;
				$file_path = parse_url( $img_url );
				if (preg_match("/files/", $file_path['path'])) {
					$path = explode('/',$file_path['path']);
					foreach($path as $k=>$v){
						if($v == 'files'){
							$path[$k-1] = 'wp-content/blogs.dir/'.$blog_id;
						}
					}
					$path = implode('/',$path);
				}
				$file_path = $_SERVER['DOCUMENT_ROOT'].$path;
			}
			//$file_path = ltrim( $file_path['path'], '/' );
			//$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];

			$orig_size = getimagesize( $file_path );

			$image_src[0] = $img_url;
			$image_src[1] = $orig_size[0];
			$image_src[2] = $orig_size[1];
		}

		$file_info = pathinfo( $file_path );

		// check if file exists
		$base_file = $file_info['dirname'].'/'.$file_info['filename'].'.'.$file_info['extension'];
		if ( !file_exists($base_file) )
		 return;

		$extension = '.'. $file_info['extension'];

		// the image path without the extension
		$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];
		
		/* Calculate the eventual height and width for accurate file name */
		if ( $crop == false ) {
		   $proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
		   $width = $proportional_size[0];
		   $height = $proportional_size[1];
		}
		$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

		// checking if the file size is larger than the target size
		// if it is smaller or the same size, stop right here and return
		if ( $image_src[1] > $width ) {

			// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
			if ( file_exists( $cropped_img_path ) ) {

				$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );

				$vt_image = array (
					'url' => $cropped_img_url,
					'width' => $width,
					'height' => $height
				);

				return $vt_image;
			}

			// $crop = false or no height set
			if ( $crop == false OR !$height ) {

				// calculate the size proportionaly
				$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
				$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;

				// checking if the file already exists
				if ( file_exists( $resized_img_path ) ) {

					$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

					$vt_image = array (
						'url' => $resized_img_url,
						'width' => $proportional_size[0],
						'height' => $proportional_size[1]
					);

					return $vt_image;
				}
			}

			// check if image width is smaller than set width
			$img_size = getimagesize( $file_path );
			if ( $img_size[0] <= $width ) $width = $img_size[0];

			// Check if GD Library installed
			if (!function_exists ('imagecreatetruecolor')) {
			    echo 'GD Library Error: imagecreatetruecolor does not exist - please contact your webhost and ask them to install the GD library';
			    return;
			}

			// no cache files - let's finally resize it
			$editor = wp_get_image_editor( $file_path );
			if ( is_wp_error( $editor ) )
				return $editor;
			$editor->set_quality( 100 );
			$resized = $editor->resize( $width, $height, $crop );
			$dest_file = $editor->generate_filename( NULL, NULL );
			$saved = $editor->save( $dest_file );
			if ( is_wp_error( $saved ) )
				return $saved;
			$new_img_path=$dest_file;			
			$new_img_size = getimagesize( $new_img_path );
			$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

			// resized output
			$vt_image = array (
				'url' => $new_img,
				'width' => $new_img_size[0],
				'height' => $new_img_size[1]
			);

			return $vt_image;
		}

		// default output - without resizing
		$vt_image = array (
			'url' => $image_src[0],
			'width' => $width,
			'height' => $height
		);

		return $vt_image;
		
	}
	
}


/*-----------------------------------------------------------------------------------
	ADD Custom CSS
-----------------------------------------------------------------------------------*/

function add_custom_css () {	
	if ( of_get_option( 'custom_css' ) != '' ) {
		echo "<!-- Theme Custom CSS -->\n
		<style>". of_get_option( 'custom_css' ) ."</style>";
	}
}
add_action( 'wp_head', 'add_custom_css' );


/*-----------------------------------------------------------------------------------
  CLEAN PROTECTED / PRIVATE POST TITLES
-----------------------------------------------------------------------------------*/

function raw_change_protected_title( $title ) {

	$title = esc_attr( $title );

	$findthese = array(
		'#Protected:#',
		'#Private:#'
	);

	$replacewith = array(
		'', // What to replace "Protected:" with
		'' // What to replace "Private:" with
	);

	$title = preg_replace( $findthese, $replacewith, $title );
	return $title;
	
}
add_filter( 'the_title', 'raw_change_protected_title' );


/*-----------------------------------------------------------------------------------
	ADD EXCERPT TO POST TYPES
-----------------------------------------------------------------------------------*/

function funky_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'funky_add_excerpts_to_pages' );


/*-----------------------------------------------------------------------------------
	EXCERPT LENGTH
-----------------------------------------------------------------------------------*/  

// Remove the default more link from excerpts
function new_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Give all excerpt (generated and manual) read more links
function give_all_excerpts_more_link( $post_excerpt ) {
	
	if ( $post_excerpt != "" ) {
		return '<p>'. $post_excerpt .' <a class="moretag" href="'. get_permalink() . '">&rarr;</a></p>';
	}

}
add_filter( 'wp_trim_excerpt', 'give_all_excerpts_more_link' );

function excerpt_testimonial( $length ) { return 45; }
function excerpt_blog( $length ) { return 25; } # Blog index, archive & search preview
function excerptmore( $more ) { return ''; }

function raw_excerpt( $length_callback='', $more_callback='', $echo=true ) {
    
	global $post;
    
	if ( function_exists( $length_callback ) ) {
        add_filter( 'excerpt_length', $length_callback );
    }
    
	if ( function_exists( $more_callback ) ) {
        add_filter( 'excerpt_more', $more_callback );
    }
    
	$output = get_the_excerpt();
    $output = apply_filters( 'wptexturize', $output );
    $output = apply_filters( 'convert_chars', $output );
    
	if ( $echo == false ) {
		return $output;
	} else {
		echo $output;
	}
	
}


/*-----------------------------------------------------------------------------------
	YOUTUBE IDS
-----------------------------------------------------------------------------------*/

# Function returns YouTube ids from video page URL.

if ( !function_exists( 'getYTid' ) ) {

	function getYTid( $ytURL ) {
	 
		$ytvIDlen = 11;

		$idStarts = strpos( $ytURL, "?v=" );

		if( $idStarts === FALSE ){
			$idStarts = strpos( $ytURL, "&v=" );
		}
		// If still FALSE, URL doesn't have a vid ID
		if( $idStarts === FALSE ){
			die( "YouTube video ID not found. Please double-check your URL." );
		}
		
		// Offset the start location to match the beginning of the ID string
		$idStarts +=3;

		// Get the ID string and return it
		$ytvID = substr( $ytURL, $idStarts, $ytvIDlen );

		return $ytvID;

	}

}


/*-----------------------------------------------------------------------------------
	REGISTER SIDEBARS
-----------------------------------------------------------------------------------*/

function funky_register_sidebars() {
	
	$funky_sidebar_attr = array(
		'name'          => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	);

	// "Sidebar Name" => "Description"
	$funky_sidebars = array(
		__( 'Page Sidebar', 'raw_theme' )	=> __( 'Sidebar used on pages.', 'raw_theme' ),
		__( 'Home Page Sidebar', 'raw_theme' )	=> __( 'Sidebar used on home page template.', 'raw_theme' ),
		__( 'Post Sidebar', 'raw_theme' )	=> __( 'Sidebar used on blog index, archives, search page and posts.', 'raw_theme' ),
		__( 'Portfolio Sidebar', 'raw_theme' )	=> __( 'Sidebar used on portfolio index and portfolio items.', 'raw_theme' ),
                __( 'Footer Left', 'raw_theme' )	=> __( 'Footer sidebar left column', 'raw_theme' ),
                __( 'Footer Center', 'raw_theme' )	=> __( 'Footer sidebar center column', 'raw_theme' ),
                __( 'Footer Right', 'raw_theme' )	=> __( 'Footer sidebar right column', 'raw_theme' ),
	);
	
	foreach ( $funky_sidebars as $sidebar_name => $sidebar_desc ) {
		$funky_sidebar_attr['name'] = $sidebar_name;
		$funky_sidebar_attr['description'] = $sidebar_desc;
		register_sidebar( $funky_sidebar_attr );
	}
	
}
add_action( 'widgets_init', 'funky_register_sidebars' );


/*-----------------------------------------------------------------------------------
	CREATE SLIDER
-----------------------------------------------------------------------------------*/  

if ( !function_exists( 'raw_create_slider' ) ) {

	function raw_create_slider( $postID ) {
		
		global $shortname, $post;

		$query_args = array(
			'post_type' => 'raw_slides',
			'taxonomy' => 'slide-categories',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'field' => 'slug',
			'term' => get_post_meta( $post->ID, $shortname.'_slide_category', true ),
			'ignore_sticky_posts' => 1,
			'posts_per_page' => -1
		);
		
		$slider_query = new WP_query( $query_args );
		
		if ( $slider_query->have_posts() ) :
		
			echo '<div id="slider" class="flexslider">
				<ul class="slides">';
				
			while ( $slider_query->have_posts() ) : $slider_query->the_post();
				
				$image = vt_resize( get_post_thumbnail_id( $post->ID ), '', 816, 544, true );
				
				echo '<li>
					<a href="'. get_post_meta( $post->ID, $shortname.'_slide_link', true ) .'">
						<img src="'. $image['url'] .'" />
					</a>';
					
					if ( get_post_meta( $post->ID, $shortname.'_caption_line_1', true ) != "" || get_post_meta( $post->ID, $shortname.'_caption_line_2', true ) != "" ) {
						
						echo '<p class="flex-caption">';
							
							if ( get_post_meta( $post->ID, $shortname.'_caption_line_1', true ) != "" ) {
								echo get_post_meta( $post->ID, $shortname.'_caption_line_1', true );
							}		
							if ( get_post_meta( $post->ID, $shortname.'_caption_line_2', true ) != "" ) { 
								echo '<small>'. get_post_meta( $post->ID, $shortname.'_caption_line_2', true ) .'</small>';
							}
						
						echo'</p>';
						
					}
					
				echo '</li>';
				
			endwhile;
			
				echo '</ul>
			</div>';
		
		endif;
		
		wp_reset_query();	

	}

}

/*-----------------------------------------------------------------------------------
	CREATE POST META
-----------------------------------------------------------------------------------*/

if ( !function_exists( 'create_post_meta' ) ) {

	function create_post_meta() {
		if (
			get_post_type() == "post" &&
			( of_get_option( 'author_meta' ) == "1"
			|| of_get_option( 'date_meta' ) == "1"
			|| of_get_option( 'category_meta' ) == "1"
			|| of_get_option( 'comments_meta' ) == "1"
			|| of_get_option( 'share_meta' ) == "1" )
		) { ?>
		
			<!-- post meta -->
			<aside class="post-meta clearfix">		
				<ul>
					<?php if ( of_get_option( 'author_meta' ) == "1" ) { ?>
						<li class="author-meta"><?php the_author_posts_link(); ?></li>
					<?php } ?>
					<?php if ( of_get_option( 'date_meta' ) == "1" ) { ?>
						<li class="date-meta"><time datetime="<?php the_time( 'c' );?>"><?php the_time( get_option( 'date_format' ) ); ?></time></li>
					<?php } ?>
					<?php if ( of_get_option( 'category_meta' ) == "1" ) { ?>
						<li class="category-meta"><?php the_category( ', ' ); ?></li>
					<?php } ?>
					<?php if ( of_get_option( 'comments_meta' ) == "1" ) { ?>		
						<li class="comments-meta"><?php comments_popup_link( '0', '1', '%' ); ?></li>
					<?php } ?>
					<?php if ( of_get_option( 'share_meta' ) == "1" && is_single() ) { ?>
						<li class="share">
							<a href="#">Share</a>
							
							<div class="share-holder">
								<!-- AddThis Button BEGIN -->
								<div class="addthis_toolbox addthis_default_style ">
									<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
									<a class="addthis_button_tweet"></a>
									<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
									<a class="addthis_counter addthis_pill_style"></a>
								</div>							
							</div>
							
							<?php if ( of_get_option( 'addthis_id' ) != "" ) { ?>							
								<script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>							
							<?php } ?>										
							<!-- AddThis Button END -->
						</li>
					<?php } ?>
				</ul>	
			</aside>
		<?php }
	}
	
}


/*-----------------------------------------------------------------------------------
	BACKGROUND IMAGE
-----------------------------------------------------------------------------------*/

if ( !function_exists( 'get_background_attachments' ) ) {

	function get_background_attachments ( $postID ) {

		$args = array(
			'orderby' 		 => 'menu_order',
			'order'          => 'ASC',
			'post_type'      => 'attachment',
			'post_parent'    => $postID,
			'post_mime_type' => 'image',
			'post_status'    => null,
			'numberposts'    => -1,
		);

		$attachments = get_posts( $args );
		
		if ( $attachments ) {
			
			$background_url = '';
			$counter = 1;
		
			foreach ( $attachments as $attachment ) {
			
				$attachurl = wp_get_attachment_url( $attachment->ID );
				$title = apply_filters( 'the_title', $attachment->post_title );
				
				if ( count( $attachments ) != $counter ){
					$background_url .= '"'. $attachurl .'",';
				} else { 
					$background_url .= '"'. $attachurl .'"';
				}
				
				$counter++;
				
			}
			
			return $background_url;
			
		}
		
	}
	
}


/*-----------------------------------------------------------------------------------
	OEMBED
-----------------------------------------------------------------------------------*/

function twitter_embed_width_fix( $html, $url, $args ) {

    if ( false !== strpos( $url, 'twitter.com' ) ) {
		$html = str_replace( 'width="500"', '', $html );
    }
    return $html;
	
}
add_filter( 'oembed_result', 'twitter_embed_width_fix', 10, 3 );


if ( !function_exists( 'funky_get_first_url' ) ) {

	/**
	 * Return the URL for the first link in the post  or the permalink if no
	 * URL is found.
	 *
	 * @since WirePress 1.0
	 *
	 * @return string URL
	 **/

	function funky_get_first_url( $content = false ) {
		
		if ( !$content ) {
			$content = get_the_content();
		}
		
		// Find first URL in $content
		$pattern = '/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/';
		preg_match_all( $pattern, $content, $links );
		
		if ( !empty( $links[0][0] ) ) {
			return $links[0][0];
		} else {		
			return;
		}

	}

}


if ( !function_exists( 'funky_embed_feature_content' ) ) {
	
	/**
	 * Return the oembed code for the first URL found in the post content.
	 *
	 * @since WirePress 1.0
	 **/
 
	function funky_embed_feature_content() {

		global $post, $shortname, $wp_embed;
		
		if ( get_post_meta( $post->ID, $shortname .'_web_video', true ) != '' ) {
			
			$url = get_post_meta( $post->ID, $shortname .'_web_video', true );
			
		} elseif ( get_post_meta( $post->ID, $shortname .'_video_m4v', true ) != '' ) {
			
			$url = get_post_meta( $post->ID, $shortname .'_video_m4v', true );			
		
		} else {
		
			// Find first URL
			$url = funky_get_first_url( get_the_content(), false );
		
		}
		
		// Check if a URL was found
		if ( $url !== false ) {
			
			$embed_code = $wp_embed->shortcode( false, $url );
			
			if ( preg_match( '#\[video\s*.*?\]#s', $embed_code, $matches ) || preg_match( '#\[audio\s*.*?\]#s', $embed_code, $matches ) ) {
				echo do_shortcode( $embed_code );
			} else {
				echo $embed_code;
			}
			
		} 
		
	}

}


function funky_the_remaining_content( $more_link_text = 'read more...', $stripteaser = 0, $more_file = '' ) {
	
	global $post;
	
	$content = get_the_content();
	
	$url = funky_get_first_url( $content );

	// Remove url from content
	$content = str_replace( $url, '', $content );
	$content = apply_filters( 'the_content', $content ) ;
	$content = str_replace( ']]>', ']]&gt;', $content );
	
	echo $content;
	
}


/*-----------------------------------------------------------------------------------*/
/*  PAGINATION
/*-----------------------------------------------------------------------------------*/

# Pagination code by Kriesi (http://www.kriesi.at).

if ( !function_exists( 'funky_pagination' ) ) {

	function funky_pagination($pages = '', $range = 2){
	  
		$showitems = ($range * 2)+1;  

		global $paged;
		if(empty($paged)) $paged = 1;

		if($pages == '') {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			
			if(!$pages) {
				$pages = 1;
			}
			
		}   

		if(1 != $pages) {
			echo "<div class='pagination'>";
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><span>&laquo;</span></a>";
			if($paged > 1) echo "<a href='".get_pagenum_link($paged - 1)."'><span>&larr; ". __("Prev", "raw_theme") ."</span></a>";

			for ($i=1; $i <= $pages; $i++) {
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
					echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' ><span>".$i."</span></a>";
				}
			}

			if ($paged < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'><span>". __("Next", "raw_theme") ." &rarr;</span></a>";  
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'><span>&raquo;</span></a>";
			echo "</div>\n";
		}
	
	}

}

/*-----------------------------------------------------------------------------------
	ACTIVATE PLUGINS
-----------------------------------------------------------------------------------*/

define( 'THEMENAME', 'XY' ); 

require_once trailingslashit( get_template_directory() ) .'inc/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'funky_register_required_plugins' );

function funky_register_required_plugins() {
	
	$plugins = array(

		// Funky Shortcodes
		array(
			'name'     				=> 'Funky Shortcodes', // The plugin name
			'slug'     				=> 'funky-shortcodes', // The plugin slug (typically the folder name)
			'source'   				=> trailingslashit( get_template_directory_uri() ) .'inc/plugins/funky-shortcodes.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '2.0.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false  // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		),
		
		// Funky Shortcodes Reach
		array(
			'name'     				=> 'Funky Shortcodes For Reach', // The plugin name
			'slug'     				=> 'funky-shortcodes-reach', // The plugin slug (typically the folder name)
			'source'   				=> trailingslashit( get_template_directory_uri() ) .'inc/plugins/funky-shortcodes-reach.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false  // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		),
		
		// FitVids
		array(
			'name' 		=> 'FitVids for WordPress',
			'slug' 		=> 'fitvids-for-wordpress',
			'required' 	=> false,
			'version'	=> '0',
		),
		
		// ColorBox
		array(
			'name' 		=> 'jQuery Colorbox',
			'slug' 		=> 'jquery-colorbox',
			'required' 	=> false,
			'version'	=> '0'
		),
		
		// Kebo Twitter Feed
		array(
			'name' 		=> 'Kebo Twitter Feed',
			'slug' 		=> 'kebo-twitter-feed',
			'required' 	=> false,
			'version'	=> '0'
		)
		
	);
	
	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'funky_theme';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 **/
	
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}


/* SHORTCODES */
/**************/
function gp_image_with_caption( $atts ) {
    $a = shortcode_atts( array(
        'image'   => '',
        'caption' => '',
        'color'   => '',
        'class'   => '',
        'grid'    => '1-3'
    ), $atts );

    $output = '<div class="gp-caption-image gp-grid-' . $a['grid'] . ' ' . $a['class'] . '">' .
              '<div class="gp-caption-image-box" style="background-image:url(' . $a['image'] . ')"></div>' .
              '<p class="gp-caption-text" style="color:' . $a['color'] . '">' . $a['caption'] . '</p>' .
              '</div>';
    
    return $output;
}
add_shortcode( 'image_box', 'gp_image_with_caption' );


function gp_recent_posts($atts) {
    $a = shortcode_atts( array(
        'title' => '',
        'posts' => 3,
        'grid'  => '1-3'
    ), $atts);

    $title = (!empty($a['title'])) ? '<h3>' . $a['title'] . '</h3>' : '';

    $output = $title;
    $output .= '<ul>';
    
    query_posts(
        array(
            'orderby'   => 'date', 
            'order'     => 'DESC' , 
            'showposts' => $a['posts']
        )
    );
    if (have_posts()) :
        while (have_posts()) : the_post();
            $output .= '<li class="gp-grid-' . $a['grid'] . '"><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        endwhile;
    endif;
    
    $output .= '</ul>';

    wp_reset_query();
    return $output;
}
add_shortcode('recent_posts', 'gp_recent_posts');


function gp_list_child_pages($atts) {
    $a = shortcode_atts( array(
        'title'  => '',
        'parent' => '',
        'limit'  => -1,
        'grid'   => '1-3'
    ), $atts);
    
    $posts_array = get_posts(
        array(
            'post_type' => 'page',
            'numberposts' => $a['limit'],
            'post_status' => 'publish',
            'post_parent' => $a['parent']
        )
    );         
    
    $title = (!empty($a['title'])) ? '<h3>' . $a['title'] . '</h3>' : '';
    
    $output = $title;
    $output .= '<ul>';    
    foreach($posts_array as $post) {
        $output .= '<li><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></li>';
    }
    $output .= '</ul>';    

    return $output;
}
add_shortcode('childpages', 'gp_list_child_pages');

?>