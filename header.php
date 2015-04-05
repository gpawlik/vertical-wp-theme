<?php
/**
 * Theme header.
 *
 * Displays all of the <head> section and everything up to the main site navigation.
 *
 **/ 

/**
 * Add class to allow styling for toolbar.
 **/
 
$html_class = ( is_admin_bar_showing() ) ? 'wp-toolbar' : ''; 

?>
<!DOCTYPE html>
<!--[if IE 7 ]><html class="no-js ie7 <?php echo $html_class; ?>" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8 ]><html class="no-js ie8 <?php echo $html_class; ?>" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 9)|!(IE) ]><!--> <html class="no-js <?php echo $html_class; ?>" <?php language_attributes(); ?>><!--<![endif]-->
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>	
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300|Source+Sans+Pro:200,300,400,600' rel='stylesheet' type='text/css'>        	
        
	<?php wp_head(); ?>
	
	<?php get_template_part( "background" ); ?>
	
</head>
<body <?php body_class(); ?> style="backaground-image:url(<?= $background_url ?>)">

<a id="top"></a>