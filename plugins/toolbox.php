<?php
$pages = array('Branding', 'Forms', 'City Pages', 'Divi Global', 'Help & Guidelines');
$default = array(
	"general" => array(
		"business_name" => "",
		"business_phone_number" => "",
		"business_email_address" => "",
		"business_address_line_1" => "",
		"business_address_line_2" => "",
		"business_logo_url" => "",
		"privacy_url" => "/privacy-policy/",
		"terms_of_use_url" => "/terms-of-use/"
	),
	"branding" => array(
		"round_corners" => "",
		"round_corners_px" => "",
		"main_branding_color" => "",
		"secondary_branding_color" => "",
		"hero_background_image" => "",
		"hero_bg_image_overlay_color" => "",
		"form_header_background_color" => "",
		"form_body_background_color" => "",
		"form_button_background_color" => "",
		"form_button_hover_background_color" => "",
		"special_page_background_color" => "",
		"special_page_button_background_color" => "",
		"special_page_button_hover_background_color" => "",
	)
);


// Enqueue the script on the back end (wp-admin)
add_action( 'admin_enqueue_scripts', 'toolbox_admin_scripts_assets' );
function toolbox_admin_scripts_assets() {
	$ver = "1.4.1" . strtotime("now");
	// Add the color picker css file       
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style('toolbox-css', get_stylesheet_directory_uri() . '/plugins/css/webnotik.css?version='.$ver);
    wp_enqueue_script('toolbox-webnotik', get_stylesheet_directory_uri() . '/plugins/js/webnotik.js?version='.$ver);
    wp_enqueue_script( 'wp-color-picker-alpha', get_stylesheet_directory_uri() . '/plugins/js/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), $ver, true );
    wp_enqueue_script( 'get-city-pages-script', get_stylesheet_directory_uri() . '/plugins/js/webnotik-ajax.js?ver='.$ver, array( 'jquery' ), null, true );
    wp_localize_script( 'get-city-pages-script', 'get_city_pages_data', array('ajaxurl' => admin_url( 'admin-ajax.php' )) );
}


add_action('admin_menu', 'toolbox_admin_menu_999');
function toolbox_admin_menu_999() {
	global $pages;
    add_menu_page( __('Toolbox', 'rei-toolbox'), __('Toolbox v2', 'rei-toolbox'), 'manage_options', 'toolbox', 'show_toolbox_content_callback', 'dashicons-flag', 3);
    add_action( 'admin_init', 'toolbox_settings' );

    for ($i=0; $i < count($pages); $i++) {
    	$toolbox_content = 'toolbox_' .toolbox_create_slug($pages[$i], true) .'_callback';
		add_submenu_page('toolbox', $pages[$i], $pages[$i], 'manage_options', 'toolbox-'.toolbox_create_slug($pages[$i]), $toolbox_content, $i);
    }
}
function toolbox_settings() {
	register_setting( 'toolbox-settings-group', 'toolbox' );
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
	        'href' => admin_url( 'admin.php?page=toolbox')
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

function get_toolbox_option($name, $group) {
	global $default;
	$toolbox = get_option('toolbox');

	if(isset($toolbox[$group][$name])) {
		return $toolbox[$group][$name];
	} else {
		return $default[$group][$name];
	}
}

function toolbox_fields($type = 'text', $name, $value, $help = false, $group = false, $options = false) {
	$ret = '<div class="form-group">';
	$ret .= '<div class="form-label">';
	$ret .= '<label for="'.toolbox_create_slug($name).'">'.$name.'</label>';
	$ret .= '</div>';

	if($help) {
		$help_ret = '';
		foreach ($help as $key => $print) {
			$help_ret .= '<p class="'.$key.'">'.$print.'</p>';
		}
	}

	if($group) {
		$final_name = 'toolbox['.$group.']['.toolbox_create_slug($name, true).']';
	} else {
		$final_name = 'toolbox['.toolbox_create_slug($name, true).']';
	}

	$ret .= '<div class="form-field">';
	switch ($type) {
		case 'text':
		case 'number':
			$ret .= '<input type="'.$type.'" name="'.$final_name.'" id="'.toolbox_create_slug($name).'" value="'.$value.'">';
			$ret .= isset($help_ret) ? $help_ret : '';
			break;
		default:
			# code...
			break;
	}
	$ret .= '</div>';


	$ret .= '</div>';

	return $ret;
}


function toolbox_content($body, $tab = 'general') {
	global $pages;
	ob_start()
	?>
	<div class="webnotik-re-wrapper">
		<div class="message"></div>
		<div class="panel">
			<div class="panel-header">
				<h1>Welcome to REI Toolbox Settings</h1>
				<p>Speeding up the process of website development for Real Estate Investor clients.</p>
				
			</div>
			<div class="panel-navigation">
				<div class="panel-nav">
					<a class="forms-group <?php echo ($tab == 'general' ? 'active' : '') ?>" href="admin.php?page=toolbox">General</a>
					<?php 
					for ($i=0; $i < count($pages); $i++) {
				    	$toolbox_content = 'toolbox_' .toolbox_create_slug($pages[$i], true) .'_callback';
						echo '<a class="forms-group ' . ($tab == toolbox_create_slug($pages[$i]) ? 'active' : 'inactive') . '" href="admin.php?page=toolbox-'.toolbox_create_slug($pages[$i]).'">'.$pages[$i].'</a>';
				    }
					?>
					

					<a href="#" class="icon">&#9776;</a>			
				</div>
			</div>
			<?php settings_errors(); ?>			
			<div class="panel-body">
				<form method="post" action="options.php">
				<?php settings_fields( 'toolbox-settings-group' ); ?>
				<?php do_settings_sections( 'toolbox-settings-group' ); ?>
				<?php echo $body; ?>
				</form>
			</div>
		</div>
	</div>
<?php 
	$output = ob_get_contents();
    ob_end_clean();

    return $output;

} //close toolbox_content

function show_toolbox_content_callback() {
	$toolbox = get_option('toolbox');

	ob_start();
	echo '<p>Welcome to general settings of Wide Open Homes LLC. Output any shortcode in any of your wordpress page and we will instantly convert any data to seo rich snippets.</p>';	
	
	echo toolbox_fields('text', 
		'Business Name', get_toolbox_option('business_name', 'general'), 
		array('help' => '[webnotik business="name"]'), 'general');
	echo toolbox_fields('text',
		'Business Phone Number', get_toolbox_option('business_phone_number', 'general'), 
		array('help' => '[webnotik business="phone_number"]'), 'general');
	echo toolbox_fields('text',
		'Business Email Address',get_toolbox_option('business_email_address', 'general'),
		array('help' => '[webnotik business="email_address"]'), 'general');
	echo toolbox_fields('text',
		'Business Address Line 1', get_toolbox_option('business_address_line_1', 'general'), 
		array('help' => '[webnotik business="address_line_1"]'), 'general');
	echo toolbox_fields('text',
		'Business Address Line 2', get_toolbox_option('business_address_line_2', 'general'), 
		array('help' => '[webnotik business="address_line_2"]'), 'general');
	echo toolbox_fields('text',
		'Business Logo URL', get_toolbox_option('business_logo_url', 'general'), 
		array('help' => '[webnotik business="logo_url"]'), 'general');
	echo toolbox_fields('text',
		'Privacy URL', get_toolbox_option('privacy_url', 'general'), 
		array('help' => '[webnotik business="privacy_url"]'), 'general');
	echo toolbox_fields('text',
		'Terms of Use URL', get_toolbox_option('terms_of_use_url', 'general'), 
		array('help' => '[webnotik business="terms_of_use_url"]'), 'general');

	submit_button();	

	echo '<pre>';
	print_r($toolbox);
	echo '</pre>';

	$output = ob_get_contents();
    ob_end_clean();
	echo toolbox_content($output, 'general');
}

function toolbox_branding_callback() {
	ob_start();
	echo '<p>Welcome to your branding settings. Please use this page to easily change for this template.</p>';	
	
	echo toolbox_fields('text', 'Round Corners?', get_toolbox_option('round_corners', 'branding'), false, 'branding');
	echo toolbox_fields('text', 'Round Corners PX', get_toolbox_option('round_corners_px', 'branding'), false, 'branding');
	echo toolbox_fields('text', 'Main Branding Color', get_toolbox_option('main_branding_color', 'branding'), false, 'branding');
	echo toolbox_fields('text', 'Secondary Branding Color', get_toolbox_option('secondary_branding_color', 'branding'), false, 'branding');

	submit_button();	

	$output = ob_get_contents();
    ob_end_clean();
	echo toolbox_content($output, 'branding');
}

function toolbox_forms_callback() {
	$ret = 'Something awesome is coming here.';
	echo toolbox_content($ret, 'forms');
}

function toolbox_city_pages_callback() {
	$ret = 'Something awesome is coming here.';
	echo toolbox_content($ret, 'city-pages');
}

function toolbox_divi_global_callback() {
	$ret = 'Something awesome is coming here.';
	echo toolbox_content($ret, 'divi-global');
}


function toolbox_help_guidelines_callback() {
	$ret = 'Something awesome is coming here.';
	echo toolbox_content($ret, 'help-guidelines');
}

