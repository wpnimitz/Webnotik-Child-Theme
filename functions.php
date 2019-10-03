<?php
include_once("plugins/webnotik.php");

add_action( 'wp_enqueue_scripts', 'custom_assets' );
function custom_assets() {
	$ver = "1.0.1" . strtotime("now");
    wp_enqueue_style( 'app-style', get_stylesheet_directory_uri() . '/assets/css/app-style.css', '', $ver );
}


add_action( 'et_before_main_content', 'webnotik_global_header' );
function webnotik_global_header() {
	if(is_category(6)) {
		echo do_shortcode('<div class="webnotik-wrapper">[et_pb_section global_module="924"][/et_pb_section]</div>');
	}
    
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
