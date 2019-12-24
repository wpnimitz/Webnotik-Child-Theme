<?php
$pages = array('Branding', 'Forms', 'City Pages', 'Divi Global', 'Help & Guidelines');

add_action('admin_menu', 'toolbox_admin_menu_999');
function toolbox_admin_menu_999() {
	global $pages;
    add_menu_page( __('Toolbox', 'rei-toolbox'), __('Toolbox', 'rei-toolbox'), 'manage_options', 'toolbox', 'admin_rei_toolbox_content', 'dashicons-flag', 3);

    for ($i=0; $i < count($pages); $i++) { 
		add_submenu_page('toolbox', $pages[$i], $pages[$i], 'manage_options', 'admin.php?page=toolbox&tab='.toolbox_create_slug($pages[$i]), 'admin_rei_toolbox_content', $i);
    }

    //call register settings function
	add_action( 'admin_init', 'webnotik_register_forms_settings' );
	add_action( 'admin_init', 'webnotik_register_general_settings' );
	add_action( 'admin_init', 'webnotik_register_branding_settings' );
	add_action( 'admin_init', 'webnotik_register_keywords_settings' );
	add_action( 'admin_init', 'webnotik_register_topics_settings' );
	add_action( 'admin_init', 'webnotik_register_divi_global_settings' );
}
function admin_rei_toolbox_content() {
	return 'Something awesome is coming here.';
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
	// Replaces all spaces with hyphens or underscore.
	if($underscore) {
		$string = str_replace(' ', '_', $string);
	} else {
		$string = str_replace(' ', '-', $string);
	}
    

    // Removes special chars.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    // Replaces multiple hyphens with single one.
    $string = preg_replace('/-+/', '-', $string);
     // Replaces multiple underscores with single one.
    $string = preg_replace('/_+/', '_', $string);

    // Make sure that all characters are in lowercase
    $string = strtolower($string);
    
    return $string;
}


function toolbox_submenu_content_branding() {
	$tab = isset($_GET["tab"]) ? $_GET["tab"] : 'general';
	return $tab;
}
