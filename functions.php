<?php
include_once("plugins/webnotik.php");
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

	$header_style =  get_option('webnotik_header_style');
	//create a condition here for the header setup
	if($header_style != 'normal' || $header_style == "") {
		$classes[] = 'webnotik-header header-' .$header_style;
	}

    return $classes;
}


/**
 * Hook into options page after save.
 */
public function generate_new_rei_style( $old_value, $new_value ) {
	$style = get_stylesheet_directory() . '/assets/css/rei-style.css';
	$file = file_get_contents('includes/style.php');
	file_put_contents($style, $file);
}
add_action( 'update_option_webnotik_register_branding_settings', 'generate_new_rei_style', 10, 2 );

