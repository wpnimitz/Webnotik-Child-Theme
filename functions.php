<?php
include_once("plugins/webnotik.php");
include_once("plugins/toolbox.php");
include_once("plugins/shortcode.php");
//include_once("assets/other/comparison.php");

add_action( 'wp_enqueue_scripts', 'custom_assets' );
function custom_assets() {
	$ver = "1.0.1" . strtotime("now");
    wp_enqueue_style( 'app-style', get_stylesheet_directory_uri() . '/assets/css/app-style.css', '', $ver );
    wp_enqueue_style( 'rei-style', get_stylesheet_directory_uri() . '/assets/css/rei-style.css', '', $ver );
}

add_filter( 'body_class', 'webnotik_body_class' );
function webnotik_body_class( $classes ) {
	if(is_page()) {
		$classes[] = 'webnotik-pages';
	} elseif(is_single()) {
		$classes[] = 'webnotik-post';
	} else {
		$classes[] = 'webnotik-otherpage';
	}

	$header_style =  get_option('webnotik_header_style');
	//create a condition here for the header setup
	if($header_style != 'normal' || $header_style == "") {
		$classes[] = 'webnotik-header header-' .$header_style;
	}

	$wda_form =  get_option('wda_form');
	$classes[] = 'round_corners';

    return $classes;
}