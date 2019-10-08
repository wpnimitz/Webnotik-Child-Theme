<?php
include_once("plugins/webnotik.php");

add_action( 'wp_enqueue_scripts', 'custom_assets' );
function custom_assets() {
	$ver = "1.0.1" . strtotime("now");
    wp_enqueue_style( 'app-style', get_stylesheet_directory_uri() . '/assets/css/app-style.css', '', $ver );
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
    return $classes;
}
