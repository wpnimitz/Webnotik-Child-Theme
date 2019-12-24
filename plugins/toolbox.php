<?php
$pages = array('Branding', 'Forms', 'City Pages', 'Divi Global', 'Help & Guidelines');

add_action('admin_menu', 'toolbox_admin_menu_999');
function toolbox_admin_menu_999() {
	global $pages;
    add_menu_page( __('Toolbox', 'rei-toolbox'), __('Toolbox', 'rei-toolbox'), 'manage_options', 'toolbox', 'show_toolbox_content_callback', 'dashicons-flag', 3);

    for ($i=0; $i < count($pages); $i++) {
    	$toolbox_content = 'toolbox_' .toolbox_create_slug($pages[$i], true) .'_callback';
		add_submenu_page('toolbox', $pages[$i], $pages[$i], 'manage_options', 'toolbox-'.toolbox_create_slug($pages[$i]), $toolbox_content, $i);
    }

    //call register settings function
	add_action( 'admin_init', 'webnotik_register_forms_settings' );
	add_action( 'admin_init', 'webnotik_register_general_settings' );
	add_action( 'admin_init', 'webnotik_register_branding_settings' );
	add_action( 'admin_init', 'webnotik_register_keywords_settings' );
	add_action( 'admin_init', 'webnotik_register_topics_settings' );
	add_action( 'admin_init', 'webnotik_register_divi_global_settings' );
}
function show_toolbox_content_callback() {
	echo 'Something awesome is coming here.';
} //close admin_rei_toolbox_content


add_action( 'wp_before_admin_bar_render', 'toolbox_admin_bar_render' );
function toolbox_admin_bar_render() {
    global $wp_admin_bar;
    global $pages;
    // we can remove a menu item, like the Comments link, just by knowing the right $id
    //$wp_admin_bar->remove_menu('comments');

    // lets add our main theme settings option
    $wp_admin_bar->add_menu(
	    array(
	        'id' => 'toolbox',
	        'title' => __('Toolbox'),
	        'href' => admin_url( 'admin.php?page=webnotik-toolbox')
	    )	    
	); 

    for ($i=0; $i < count($pages); $i++) { 
    	$wp_admin_bar->add_menu(
			array(
		    	'parent' => 'toolbox',
		        'id' => 'toolbox-' . toolbox_create_slug($pages[$i]),
		        'title' => __($pages[$i]),
		        'href' => admin_url( 'admin.php?page=toolbox&tab=' . toolbox_create_slug($pages[$i]) )
		    )
		);
    }
}


function toolbox_create_slug($string, $underscore = false) {
	// Removes special chars.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    // Replaces all spaces with hyphens or underscore.
	if($underscore) {
		$string = str_replace(' ', '_', $string);
	} else {
		$string = str_replace(' ', '-', $string);
	}
    // Replaces multiple hyphens with single one.
    $string = preg_replace('/-+/', '-', $string);

    // make all characters lower case
    $string = strtolower($string);
    
    return $string;
}


function toolbox_branding_callback() {
	echo 'branding';
}

function toolbox_forms_callback() {
	echo 'forms';
}

function toolbox_city_pages_callback() {
	echo 'city pages';
}

function toolbox_divi_global_callback() {
	echo 'divi global';
}


function toolbox_help_guidlines_callback() {
	echo 'help and guidlines';
}

