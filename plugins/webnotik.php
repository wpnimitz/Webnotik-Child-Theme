<?php
add_action('admin_menu', 'webnotik_real_estate_add_admin_menu');
function webnotik_real_estate_add_admin_menu() {
    add_menu_page(__('Webnotik', 're-webnotik'), __('Webnotik', 're-webnotik'), 'manage_options', 'webnotik-real-estate', 'webnotik_real_estate_content', 'dashicons-schedule', 3);
    //call register settings function
	add_action( 'admin_init', 'webnotik_register_forms_settings' );
	add_action( 'admin_init', 'webnotik_register_general_settings' );
	add_action( 'admin_init', 'webnotik_register_keywords_settings' );
}


function webnotik_register_forms_settings() {
	//register our form settings
	register_setting( 'webnotik-forms-group', 'webnotik_seller_form' );
	register_setting( 'webnotik-forms-group', 'webnotik_buyer_form' );
	register_setting( 'webnotik-forms-group', 'webnotik_lender_form' );
	register_setting( 'webnotik-forms-group', 'webnotik_realtors_form' );
	register_setting( 'webnotik-forms-group', 'webnotik_wholesale_form' );
	register_setting( 'webnotik-forms-group', 'webnotik_contractor_form' );
	register_setting( 'webnotik-forms-group', 'webnotik_contact_form' );
	register_setting( 'webnotik-forms-group', 'webnotik_extra_form' );
}
function webnotik_register_general_settings() {
	//register our general settings
	register_setting( 'webnotik-general-group', 'webnotik_business_name' );
	register_setting( 'webnotik-general-group', 'webnotik_business_phone' );
	register_setting( 'webnotik-general-group', 'webnotik_business_email' );
	register_setting( 'webnotik-general-group', 'webnotik_business_address1' );
	register_setting( 'webnotik-general-group', 'webnotik_business_address2' );
	register_setting( 'webnotik-general-group', 'webnotik_business_privacy' );
	register_setting( 'webnotik-general-group', 'webnotik_business_tos' );
}
function webnotik_register_keywords_settings() {
	//register our keywords settings
	register_setting( 'webnotik-keywords-group', 'webnotik_keywords_main' );
	register_setting( 'webnotik-keywords-group', 'webnotik_keywords_main_id' );
	register_setting( 'webnotik-keywords-group', 'webnotik_keywords_subpages' );
	register_setting( 'webnotik-keywords-group', 'webnotik_keywords_subpages_ids' );
}



function webnotik_real_estate_content(){
	$tab = isset($_GET["tab"]) ? $_GET["tab"] : 'general';
?>

<div class="webnotik-re-wrapper">
	<div class="panel">
		<div class="panel-header">
			<h1><?php esc_html_e('Welcome to Webnotik Real Estate Settings', 're-webnotik'); ?></h1>
			<p><?php esc_html_e('Speeding up the process of other CRM we don\'t usually use for Webnotik Digital Agency Clients', 're-webnotik'); ?></p>
		</div>
		<div class="panel-navigation">
			<div class="panel-nav">
				<a class="forms-group <?php echo $tab == "general" ? 'active' : 'inactive'; ?>" href="admin.php?page=webnotik-real-estate&tab=general">General</a>
				<a class="forms-group <?php echo $tab == "forms" ? 'active' : 'inactive'; ?>" href="admin.php?page=webnotik-real-estate&tab=forms">Forms</a>
				<a class="forms-group <?php echo $tab == "keywords" ? 'active' : 'inactive'; ?>" href="admin.php?page=webnotik-real-estate&tab=keywords">Keywords</a>				
				<a class="forms-group <?php echo $tab == "divi-global" ? 'active' : 'inactive'; ?>" href="admin.php?page=webnotik-real-estate&tab=divi-global">Divi Global</a>				
				<a class="forms-group <?php echo $tab == "help" ? 'active' : 'inactive'; ?>" href="admin.php?page=webnotik-real-estate&tab=help">Help</a>
				<a href="#" class="icon">&#9776;</a>			
			</div>
		</div>
		

		
		<div class="panel-body">

			<?php if($tab == 'general') {?>
			<!-- STARTS #general-forms -->
			<div id="general"> 
				<p>Welcome to general settings of <?php echo get_bloginfo('name'); ?>. Output any shortcode in any of your wordpress page and we will instantly convert any data to seo rich snippets.</p>
				<form method="post" action="options.php">
				    <?php settings_fields( 'webnotik-general-group' ); ?>
				    <?php do_settings_sections( 'webnotik-general-group' ); ?>

				    <div class="form-group">
				    	<div class="form-label">
				    		<label for="webnotik_business_name">Business Name</label>
				    	</div>
				    	<div class="form-field">
				    		<input name="webnotik_business_name" id="webnotik_business_name" value="<?php echo esc_attr( get_option('webnotik_business_name') ); ?>">
				    		<p>[webnotik business="name"]</p>
				    	</div>
				    </div>

				    <div class="form-group">
				    	<div class="form-label">
				    		<label for="webnotik_business_phone">Business Phone Number</label>
				    	</div>
				    	<div class="form-field">
				    		<input name="webnotik_business_phone" id="webnotik_business_phone" value="<?php echo esc_attr( get_option('webnotik_business_phone') ); ?>">
				    		<p>[webnotik business="phone"]</p>
				    	</div>
				    </div>

				    <div class="form-group">
				    	<div class="form-label">
				    		<label for="webnotik_business_email">Business Email Address</label>
				    	</div>
				    	<div class="form-field">
				    		<input name="webnotik_business_email" id="webnotik_business_email" value="<?php echo esc_attr( get_option('webnotik_business_email') ); ?>">
				    		<p>[webnotik business="email"]</p>
				    	</div>
				    </div>

				    <div class="form-group">
				    	<div class="form-label">
				    		<label for="webnotik_business_address1">Business Address Line 1</label>
				    	</div>
				    	<div class="form-field">
				    		<input name="webnotik_business_address1" id="webnotik_business_address1" value="<?php echo esc_attr( get_option('webnotik_business_address1') ); ?>">
				    		<p>[webnotik business="address1"]</p>
				    	</div>
				    </div>

				    <div class="form-group">
				    	<div class="form-label">
				    		<label for="webnotik_business_address2">Business Address Line 2</label>
				    	</div>
				    	<div class="form-field">
				    		<input name="webnotik_business_address2" id="webnotik_business_address2" value="<?php echo esc_attr( get_option('webnotik_business_address2') ); ?>">
				    		<p>[webnotik business="address2"]</p>
				    	</div>
				    </div>

				    <div class="form-group">
				    	<div class="form-label">
				    		<label for="webnotik_business_address">Business Full Address</label>
				    	</div>
				    	<div class="form-field">
				    		No need to input anything here. This is the combination of Address Line 1 and 2 in a straigh long format. Appended with comma.
				    		<p>[webnotik business="address"]</p>
				    	</div>
				    </div>

				    <div class="form-group">
				    	<div class="form-label">
				    		<label for="webnotik_business_weburl">Business Website Full Address</label>
				    	</div>
				    	<div class="form-field">
				    		This will print the current website URL.
				    		<p>[webnotik business="weburl"]</p>
				    	</div>
				    </div>

				    <div class="form-group">
				    	<div class="form-label">
				    		<label for="webnotik_business_privacy">Privacy Policy URL</label>
				    	</div>
				    	<div class="form-field">
				    		<input name="webnotik_business_privacy" id="webnotik_business_privacy" value="<?php echo esc_attr( get_option('webnotik_business_privacy') ); ?>">
				    		<p>[webnotik business="privacy"]</p>
				    	</div>
				    </div>

				    <div class="form-group">
				    	<div class="form-label">
				    		<label for="webnotik_business_tos">Terms of Use URL</label>
				    	</div>
				    	<div class="form-field">
				    		<input name="webnotik_business_tos" id="webnotik_business_tos" value="<?php echo esc_attr( get_option('webnotik_business_tos') ); ?>">
				    		<p>[webnotik business="tos"]</p>
				    	</div>
				    </div>     
				    
				    <?php submit_button(); ?>

				</form>
			</div>
			<!-- end #general-forms -- >
			<?php } elseif($tab == 'forms') {?>
			<!-- STARTS #forms -->
			<div id="forms"> 
				<form method="post" action="options.php">
				    <?php settings_fields( 'webnotik-forms-group' ); ?>
				    <?php do_settings_sections( 'webnotik-forms-group' ); ?>

				    <div class="form-group">
				    	<div class="form-label">
				    		<label for="webnotik_seller_form">Seller Form</label>
				    	</div>
				    	<div class="form-field">
				    		<textarea name="webnotik_seller_form" id="webnotik_seller_form"><?php echo esc_attr( get_option('webnotik_seller_form') ); ?></textarea>
				    		<p>[webnotik_form type="seller"]</p>
				    	</div>
				    </div>

				    <div class="form-group">
				    	<div class="form-label">
				    		<label for="webnotik_buyer_form">Buyer Form</label>
				    	</div>
				    	<div class="form-field">
				    		<textarea name="webnotik_buyer_form" id="webnotik_buyer_form"><?php echo esc_attr( get_option('webnotik_buyer_form') ); ?></textarea>
				    		<p>[webnotik_form type="buyer"]</p>
				    	</div>
				    </div>

				     <div class="form-group">
				    	<div class="form-label">
				    		<label for="webnotik_lender_form">Private Lending Form</label>
				    	</div>
				    	<div class="form-field">
				    		<textarea name="webnotik_lender_form" id="webnotik_lender_form"><?php echo esc_attr( get_option('webnotik_lender_form') ); ?></textarea>
				    		<p>[webnotik_form type="lender"]</p>
				    	</div>			    	
				    </div>

				    <div class="form-group">
				    	<div class="form-label">
				    		<label for="webnotik_contractor_form">Contractor Form</label>
				    	</div>
				    	<div class="form-field">
				    		<textarea name="webnotik_contractor_form" id="webnotik_contractor_form"><?php echo esc_attr( get_option('webnotik_contractor_form') ); ?></textarea>
				    		<p>[webnotik_form type="contractor"]</p>
				    	</div>			    	
				    </div>

				    <div class="form-group">
				    	<div class="form-label">
				    		<label for="webnotik_realtors_form">Realtors Form</label>
				    	</div>
				    	<div class="form-field">
				    		<textarea name="webnotik_realtors_form" id="webnotik_realtors_form"><?php echo esc_attr( get_option('webnotik_realtors_form') ); ?></textarea>
				    		<p>[webnotik_form type="realtors"]</p>
				    	</div>			    	
				    </div>

				    <div class="form-group">
				    	<div class="form-label">
				    		<label for="webnotik_wholesale_form">Wholesale Form</label>
				    	</div>
				    	<div class="form-field">
				    		<textarea name="webnotik_wholesale_form" id="webnotik_wholesale_form"><?php echo esc_attr( get_option('webnotik_wholesale_form') ); ?></textarea>
				    		<p>[webnotik_form type="wholesale"]</p>
				    	</div>			    	
				    </div>

				    <div class="form-group">
				    	<div class="form-label">
					    	<label for="webnotik_contact_form">Contact Form</label>
					    </div>
				    	<div class="form-field">
					    	<textarea name="webnotik_contact_form" id="webnotik_contact_form"><?php echo esc_attr( get_option('webnotik_contact_form') ); ?></textarea>
					    	<p>[webnotik_form type="contact"]</p> 
					    </div>
				    </div>

				    <div class="form-group">
				    	<div class="form-label">
					    	<label for="webnotik_extra_form">Extra Form</label>
					    </div>
				    	<div class="form-field">
					    	<textarea name="webnotik_extra_form" id="webnotik_extra_form"><?php echo esc_attr( get_option('webnotik_extra_form') ); ?></textarea>
					    	<p>[webnotik_form type="extra"]</p>
					    </div>
				    </div>

				   
				    
				    <?php submit_button(); ?>

				</form>
			</div>
			<!-- end #FORMS -- >
			<?php } elseif($tab == 'keywords') {?>
			<!-- STARTS #keywords-forms --> 
			<div id="keywords"> 
				<p>Keywords are very important for Real Estate search engine optimization as well as in creating additional pages of this website.</p>
				<form method="post" action="options.php">
				    <?php settings_fields( 'webnotik-keywords-group' ); ?>
				    <?php do_settings_sections( 'webnotik-keywords-group' ); ?>

				    <div class="form-group">
				    	<div class="form-label">
				    		<label for="webnotik_keywords_main">Main Keyword</label>
				    	</div>
				    	<div class="form-field">
				    		<div class="col-2">
					    		<input name="webnotik_keywords_main" id="webnotik_keywords_main" value="<?php echo esc_attr( get_option('webnotik_keywords_main') ); ?>">
					    		<p>[rank keyword="main"]</p>
					    	</div><div class="col-2">
					    		<input name="webnotik_keywords_main_id" id="webnotik_keywords_main_id" value="<?php echo esc_attr( get_option('webnotik_keywords_main_id') ); ?>">
				    			<p class="hint">useful for linking automatic linking.</p>
					    	</div>

				    	</div>
				    </div>

				    <?php 
				    $subpages = get_option('webnotik_keywords_subpages');
				    $subid = get_option('webnotik_keywords_subpages_ids');
				     ?>

				    <div class="form-group keyword main-sub-keyword">
				    	<div class="form-label">
				    		<label for="webnotik_keywords_subpages">Sub Keyword <span>1</span></label>
				    	</div>
				    	<div class="form-field">
				    		<div class="col-2">
					    		<input placeholder="enter main city/location keyword" name="webnotik_keywords_subpages[]" id="webnotik_keywords_subpages" value="<?php echo esc_attr( $subpages[0] ); ?>">
					    		<p>[rank keyword="sub"]</p>
					    	</div><div class="col-2">
					    		<input name="webnotik_keywords_subpages_ids[]" id="webnotik_keywords_subpages_ids" value="<?php echo esc_attr( $subid[0] ); ?>">
				    			<p class="hint">Enter page ID here. Very useful for automatic page linking.</p>
					    	</div>
				    	</div>
				    </div>

				    <div class="extra-keywords">
				    <?php for ($i=1; $i < count($subpages); $i++) { 
				    		$display = $i + 1;
				    	?>
					    <div class="form-group keyword" id="extra-<?php echo $display; ?>">
					    	<div class="form-label">
					    		<label for="webnotik_keywords_subpages<?php echo $display; ?>">Sub Keyword <span><?php echo $display; ?></span></label>
					    	</div>
					    	<div class="form-field">
					    		<div class="col-2">
						    		<input placeholder="enter other city keyword" name="webnotik_keywords_subpages[]" id="webnotik_keywords_subpages<?php echo $display; ?>" value="<?php echo esc_attr( $subpages[$i] ); ?>">
						    		<p>[rank keyword="sub"]</p>
						    	</div><div class="col-2">
						    		<input name="webnotik_keywords_subpages_ids[]" id="webnotik_keywords_subpages_ids" value="<?php echo esc_attr( $subid[$i] ); ?>">
					    			<p class="hint">Enter page ID here. Very useful for automatic page linking.</p>
						    	</div>
					    	</div>
					    </div>
				    <?php } ?> 
				    </div>

				    <div class="form-group add-sub-keyword">
				    	Add new sub keyword 
				    </div>

				    

				   
				    
				    <?php submit_button(); ?>

				</form>
			</div>
			<!-- end #keywords-forms -- >
			<?php } else {?>			
			Work in progress
			<?php } ?>

		</div>
	</div>
</div>
<?php
    
}


add_action('admin_enqueue_scripts', 'register_webnotik_scripts');
function register_webnotik_scripts() {
	$ver = "1.2.1" . strtotime("now");
    wp_register_style('re-webnotik', get_stylesheet_directory_uri() . '/plugins/css/webnotik.css?version='.$ver);
    wp_register_script('re-webnotik', get_stylesheet_directory_uri() . '/plugins/js/webnotik.js?version='.$ver);
}






add_action('admin_enqueue_scripts', 'load_my_plugin_scripts');
function load_my_plugin_scripts($hook) {
    
    // Load only on ?page=webnotik-real-estate    
    if ($hook != 'toplevel_page_webnotik-real-estate') {        
        return;        
    }    
    // Load style & scripts.    
    wp_enqueue_style('re-webnotik');    
    wp_enqueue_script('re-webnotik');    
}



function webnotik_form_shortcode( $atts ){  
	$atts = shortcode_atts(
		array(
			'type' => 'seller',
		), $atts, 'webnotik_form' );
	$type = $atts["type"];

	$allowed_types = array('seller', 'buyer', 'lender', 'contractor', 'realtors', 'wholesale' , 'contact', 'extra');

	if(in_array($type, $allowed_types)) {
		$form = get_option( 'webnotik_' . $type . '_form');
		if($form != "") {
			$ret = '<div class="gform_wrapper webnotik-'.$type.'">'. do_shortcode($form) . '</div>';
		} else {
			$ret = "Form is empty!";
		}
	} else {
		$ret = 'Not allowed types';
	}

	return $ret;

	
}
add_shortcode( 'webnotik_form', 'webnotik_form_shortcode' );

function webnotik_business_shortcode( $atts ){  
	$atts = shortcode_atts(
		array(
			'business' => 'seller',
		), $atts, 'webnotik_form' );
	$type = $atts["business"];

	$allowed_types = array('name', 'phone', 'email', 'address1', 'address2', 'address', 'privacy', 'tos');

	if(in_array($type, $allowed_types)) {
		$form = get_option( 'webnotik_business_' . $type);
		if($form != "") {
			$ret = '<span class="webnotik-'.$type.'">'. do_shortcode($form) . '</span>';
		} else {
			$ret = "Business info is empty!";
		}
	} else {
		$ret = 'Business information is not part of the settings. Please review the code.';
	}

	return $ret;

	
}
add_shortcode( 'webnotik', 'webnotik_business_shortcode' );