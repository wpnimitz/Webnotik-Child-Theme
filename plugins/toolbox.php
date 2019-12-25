<?php
$pages = array('Branding', 'Forms', 'City Pages', 'Divi Global', 'Help & Guidelines');
include_once('toolbox-config.php');


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
	global $pages;
	for ($i=0; $i < count($pages); $i++) {
    	$settings_group = 'toolbox-' .toolbox_create_slug($pages[$i], true) .'-group';
		register_setting( $settings_group, toolbox_create_slug('toolbox-'.$pages[$i]) );
    }
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
	$toolbox = get_option('toolbox-' . $group);

	if(isset($toolbox[$name])) {
		return $toolbox[$name];
	} else {
		return $default[$group][$name];
	}
}

function city_pages_field($name, $action = false, $count = 0) {
	$label = $name;
	$name = toolbox_create_slug($name, true);
	$toolbox = get_option('toolbox');

	$city_names = @$toolbox["city_pages"]["names"];
	$city_urls = @$toolbox["city_pages"]["urls"];

	$value1 = '';
	if(!empty($city_names[$count])) {
		$value1 = $city_names[$count];
	}
	$value2 = '';
	if(!empty($city_urls[$count])) {
		$value2 = $city_urls[$count];
	}

	$city_action = '<p class="actions"><a class="rename-cp" href="#">Rename Page</a> <a class="delete-cp" href="#">Delete Data</a> </p>';


	$ret = '<div class="form-group">
    	<div class="form-label">
    		<label for="'.$name.'">'.$label.'</label> '.($action ? $city_action : '').'
    	</div>
    	<div class="form-field">
    		<div class="col-2 k-main">
	    		<input type="text" name="toolbox[city_pages][names][]" id="'.$name.'" value="'.$value1.'">
	    		<p class="hint">Enter focus city or state here.</p>
	    	</div><div class="col-2 k-value">
	    		<input name="toolbox[city_pages][urls][]" id="'.$name.'" value="'.$value2.'">
    			<p class="hint">Enter page URL. Very usefull for automatic linking.</p>
	    	</div>
    	</div>
    </div>';

    echo $ret;
}

function toolbox_fields($type = 'text', $name, $group = false, $help = false, $options = false, $class = false, $others = false) {
	$label = $name;
	$name = toolbox_create_slug($name, true);
	$ret = '<div class="form-group">';
	$ret .= '<div class="form-label">';
	$ret .= '<label for="'.$name.'">'.$label.'</label>';
	$ret .= '</div>';
	if($help) {
		$help_ret = '';
		foreach ($help as $key => $print) {
			$help_ret .= '<p class="'.$key.'">'.$print.'</p>';
		}
	}
	if($group) {
		$final_name = 'toolbox-' . $group.'['.$name.']';
	}
	if(!$class) {
		$class = '';
	}

	if($others) {
		$data = '';
		foreach ($others as $other => $val) {
			$data .= 'data-' . $other . '="'.$val.'"';
		}
	}

	$value = get_toolbox_option($name, $group);
	$ret .= '<div class="form-field">';
	switch ($type) {
		case 'text':
		case 'number':
			$ret .= '<input class="'.$class.'" type="'.$type.'" name="'.$final_name.'" id="'.$name.'" value="'.$value.'" '.(isset($data) ? $data : '').'>';
			break;
		case 'select':
			$ret .= '<select class="'.$class.'" name="'.$final_name.'" id="'.$name.'" '.(isset($data) ? $data : '').'>';
			if($options) {
				for ($i=0; $i < count($options); $i++) {
					$option_value = toolbox_create_slug($options[$i], true);
					$is_selected = ($value == $option_value) ? 'selected' : '';
					$ret .= '<option value="'.$option_value.'" '.$is_selected.'>'.$options[$i].'</option>';
				}
			}
			$ret .= '</select>';
			break;
		case 'textarea':
			$ret .= '<textarea name="'.$final_name.'" id="'.$name.'">'.$value.'</textarea>';
			break;
		default:
			# code...
			break;
	}
	$ret .= isset($help_ret) ? $help_ret : '';
	$ret .= '</div>'; //close form-field
	$ret .= '</div>'; //close form-group

	echo  $ret;
}


function toolbox_content($body, $tab = 'general') {
	global $pages;
	ob_start()
	?>
	<div class="webnotik-re-wrapper toolbox-wrapper">
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
				<form method="post" action="options.php" class="tab-<?php echo $tab; ?>">
				<?php settings_fields( 'toolbox-' .toolbox_create_slug($tab, true) .'-group' ); ?>
				<?php do_settings_sections( 'toolbox-' .toolbox_create_slug($tab, true) .'-group' ); ?>
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
	
	toolbox_fields('text', 'Business Name', 'general', array('help' => '[webnotik business="name"]'));
	toolbox_fields('text', 'Business Phone Number', 'general', array('help' => '[webnotik business="phone_number"]'));
	toolbox_fields('text', 'Business Email Address', 'general', array('help' => '[webnotik business="email_address"]'));
	toolbox_fields('text', 'Business Address Line 1', 'general', array('help' => '[webnotik business="address_line_1"]'));
	toolbox_fields('text', 'Business Address Line 2', 'general', array('help' => '[webnotik business="address_line_2"]'));
	toolbox_fields('text', 'Business Logo URL', 'general', array('help' => '[webnotik business="logo_url"]'));
	toolbox_fields('text', 'Privacy URL', 'general',  array('help' => '[webnotik business="privacy_url"]'));
	toolbox_fields('text', 'Terms of Use URL', 'general', array('help' => '[webnotik business="terms_of_use_url"]'));

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
	
	toolbox_fields('select', 'Round Corners?', 'branding', false, array("No","Yes"));
	toolbox_fields('text', 'Round Corners PX', 'branding');
	toolbox_fields('text', 'Main Branding Color', 'branding', false, false, 'wda_color_picker');
	toolbox_fields('text', 'Secondary Branding Color', 'branding', false, false, 'wda_color_picker');

	echo '<h3>Hero Section</h3>';
	toolbox_fields('text', 'Hero Background Image', 'branding');
	toolbox_fields('text', 'Hero Background Overlay Color', 'branding', false, false, 'wda_color_picker');

	echo '<h3>Form Design</h3>';
	echo '<p>Make sure to add <strong>form-hero-header</strong> class to any module that you have a form.</p>';
	toolbox_fields('text', 'Form Header Background', 'branding', false, array("No","Yes"));
	toolbox_fields('select', 'Remove Header Bottom Padding?', 'branding', false, array("No","Yes"));
	toolbox_fields('select', 'Form Fields Size', 'branding', false, array("Small","Regular"));
	toolbox_fields('text', 'Form Body Background', 'branding', false, false, 'wda_color_picker');
	toolbox_fields('text', 'Form Button Background', 'branding', false, false, 'wda_color_picker');
	toolbox_fields('text', 'Form Button Background Hover', 'branding', false, false, 'wda_color_picker');
	toolbox_fields('select', 'Allow Trust Badge?', 'branding', false, array("No","Yes"));

	echo '<h3>Special Pages</h3>';
	echo '<p>Perfect for Thank You and 404 Pages. Make sure to add <strong>special-page</strong> class to the section class settings.</p>';
	toolbox_fields('text', 'Special Page Background Color', 'branding', false, false, 'wda_color_picker');
	toolbox_fields('text', 'Special Page Button Background Color', 'branding', false, false, 'wda_color_picker');
	toolbox_fields('text', 'Special Page Button Hover Background Color', 'branding', false, false, 'wda_color_picker');

	submit_button();	

	$output = ob_get_contents();
    ob_end_clean();
	echo toolbox_content($output, 'branding');
}

function toolbox_forms_callback() {
	ob_start();

	toolbox_fields('textarea', 'Seller Form', 'forms', array('help' => '[webnotik_form type="seller_form"]', 'hint' => "In some instances, you may use lead source, this will help us gain more advantage for PPC landing pages. For reference, please check our Help & Guidelines section <a href='#'>here.</a>"));
	toolbox_fields('textarea', 'Buyer Form', 'forms', array('help' => '[webnotik_form type="buyer_form"]'));
	toolbox_fields('textarea', 'Private Lending Form', 'forms', array('help' => '[webnotik_form type="private_lending_form"]'));
	toolbox_fields('textarea', 'Contractor Form', 'forms', array('help' => '[webnotik_form type="contractor_form"]'));
	toolbox_fields('textarea', 'Realtors Form', 'forms', array('help' => '[webnotik_form type="realtors_form"]'));
	toolbox_fields('textarea', 'Wholesale Form', 'forms', array('help' => '[webnotik_form type="wholesale_form"]'));
	toolbox_fields('textarea', 'Contact Form', 'forms', array('help' => '[webnotik_form type="contact_form"]'));
	toolbox_fields('textarea', 'Extra Form', 'forms', array('help' => '[webnotik_form type="extra_form"]'));

	submit_button();	

	$output = ob_get_contents();
    ob_end_clean();
	echo toolbox_content($output, 'forms');
}

function toolbox_city_pages_callback() {
	ob_start();
	echo '<p>Add all your city pages here. The more the merrier for SEO.</p>';	

	echo '<p>this page is still cooking its settings. Come back again soon!';
	
	city_pages_field('Main State');
	city_pages_field('City #1', true, 1);



	submit_button();


	$output = ob_get_contents();
    ob_end_clean();
	echo toolbox_content($output, 'city-pages');
}

function toolbox_divi_global_callback() {
	$ret = 'Something awesome is coming here.';
	echo toolbox_content($ret, 'divi-global');
}


function toolbox_help_guidelines_callback() {
	$ret = 'Something awesome is coming here.';
	echo toolbox_content($ret, 'help-guidelines');
}