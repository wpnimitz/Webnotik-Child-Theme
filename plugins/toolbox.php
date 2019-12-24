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
		        'href' => admin_url( 'admin.php?page=toolbox-' . toolbox_create_slug($pages[$i]) )
		    )
		);
    }
}


function toolbox_create_slug($string, $underscore = false) {
    // Replaces all spaces with hyphens.
	$string = str_replace(' ', '-', $string);


	// Removes special chars.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    
    // Replaces multiple hyphens with single one.
    $string = preg_replace('/-+/', '-', $string);

    // make all characters lower case
    $string = strtolower($string);

    // for callback functions.
    if($underscore) {
		$string = str_replace('-', '_', $string);
	}
    
    return $string;
}


function toolbox_content($body) {
	global $pages;
	ob_start()
	?>
	<div class="webnotik-re-wrapper">
	<div class="message"></div>
	<div class="panel">
		<div class="panel-header">
			<h1><?php esc_html_e('Welcome to REI Toolbox Settings', 're-webnotik'); ?></h1>
			<p><?php esc_html_e('Speeding up the process of other CRM we don\'t usually use for Webnotik Digital Agency Clients', 're-webnotik'); ?></p>
		</div>
		<div class="panel-navigation">
			<div class="panel-nav">
				<?php 
				for ($i=0; $i < count($pages); $i++) {
			    	$toolbox_content = 'toolbox_' .toolbox_create_slug($pages[$i], true) .'_callback';
					add_submenu_page('toolbox', $pages[$i], $pages[$i], 'manage_options', 'toolbox-'.toolbox_create_slug($pages[$i]), $toolbox_content, $i);
					echo '<a class="forms-group <?php echo $tab == "general" ? 'active' : 'inactive'; ?>" href="admin.php?page=webnotik-real-estate&tab=general">General</a>';
			    }

				 ?>
				
				<a class="forms-group <?php echo $tab == "branding" ? 'active' : 'inactive'; ?>" href="admin.php?page=webnotik-real-estate&tab=branding">Branding</a>
				<a class="forms-group <?php echo $tab == "forms" ? 'active' : 'inactive'; ?>" href="admin.php?page=webnotik-real-estate&tab=forms">Forms</a>
				<a class="forms-group <?php echo $tab == "city-pages" ? 'active' : 'inactive'; ?>" href="admin.php?page=webnotik-real-estate&tab=city-pages">City Pages</a>	
				<a class="forms-group <?php echo $tab == "topics" ? 'active' : 'inactive'; ?>" href="admin.php?page=webnotik-real-estate&tab=topics">Topics</a>				
				<a class="forms-group <?php echo $tab == "divi-global" ? 'active' : 'inactive'; ?>" href="admin.php?page=webnotik-real-estate&tab=divi-global">Divi Global</a>				
				<a class="forms-group <?php echo $tab == "help" ? 'active' : 'inactive'; ?>" href="admin.php?page=webnotik-real-estate&tab=help">Help & Guidelines</a>
				<a href="#" class="icon">&#9776;</a>			
			</div>
		</div>
		

		
		<div class="panel-body">
<?php 
	$output = ob_get_contents();
    ob_end_clean();

    return $output;

} //close toolbox_content

function show_toolbox_content_callback() {
	$ret = 'Something awesome is coming here.';

	echo toolbox_content($ret);
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


function toolbox_help_guidelines_callback() {
	echo 'help and guidlines';
}

