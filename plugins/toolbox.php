<?php
$pages = array('General', 'Branding', 'Forms', 'City Pages', 'Divi Global', 'Help & Guidelines');

add_action( 'wp_before_admin_bar_render', 'toolbox_admin_bar_render' );
function webnotik_admin_bar_render() {
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
		        'id' => 'toolbox-' . toolbox_create_slug($page[$i]),
		        'title' => __($page[$i]),
		        'href' => admin_url( 'admin.php?page=webnotik-real-estate&tab=' . toolbox_create_slug($page[$i]) )
		    )
		);
    }
}


function toolbox_create_slug($string) {
	// Replaces all spaces with hyphens.
    $string = str_replace(' ', '-', $string);

    // Removes special chars.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    // Replaces multiple hyphens with single one.
    $string = preg_replace('/-+/', '-', $string);

    // Make sure that all characters are in lowercase
    $string = strtolower($string);
    
    return $string;
}
