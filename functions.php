<?php
// include_once("plugins/webnotik.php");
include_once("plugins/toolbox.php"); 
include_once("plugins/shortcode.php");
include_once("assets/other/comparison.php");

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

	$classes[] = 'round_corners';

    return $classes;
}

add_action('after_setup_theme', 'create_rei_style');
function create_rei_style() {
	$filename = get_stylesheet_directory() . '/assets/css/rei-style.css';
	if (!file_exists($filename)) {
	    //partial code from generate_new_rei_style() just remove the json success
		include_once( get_stylesheet_directory() . '/includes/style.php' );
		$myCSS = fopen($filename, "w") or die("Unable to open file!");	
		fwrite($myCSS, $css);
		fclose($myCSS);
	}
}