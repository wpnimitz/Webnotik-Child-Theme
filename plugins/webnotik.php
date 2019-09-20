<?php
add_action('admin_menu', 'webnotik_real_estate_add_admin_menu');
function webnotik_real_estate_add_admin_menu() {
    add_menu_page(__('Webnotik', 're-webnotik'), __('Webnotik', 're-webnotik'), 'manage_options', 'webnotik-real-estate', 'webnotik_real_estate_content', 'dashicons-schedule', 3);
    //call register settings function
	add_action( 'admin_init', 'register_re_webnotik_settings' );
}


function register_re_webnotik_settings() {
	//register our settings
	register_setting( 're-webnotik-group', 'webnotik_seller_form' );
	register_setting( 're-webnotik-group', 'webnotik_buyer_form' );
	register_setting( 're-webnotik-group', 'webnotik_other_form' );
	register_setting( 're-webnotik-group', 'webnotik_extra1_form' );
	register_setting( 're-webnotik-group', 'webnotik_extra2_form' );
}

function webnotik_real_estate_content(){
?>

<div class="webnotik-re-wrapper">
	<div class="panel">
		<div class="panel-header">
			<h1><?php esc_html_e('Welcome to Webnotik Real Estate Settings', 're-webnotik'); ?></h1>
			<p><?php esc_html_e('Speeding up the process of other CRM we don\'t usually use for Webnotik Digital Agency Clients', 're-webnotik'); ?></p>
		</div>
		<div class="panel-navigation">
			<div class="panel-nav">
				<a class="forms-group active" href="#forms">Forms</a>
				<a class="forms-group" href="#keywords">Keywords</a>				
				<a class="forms-group" href="#divi-global">Divi Global</a>				
				<a class="forms-group" href="#others">Others</a>
				<a href="#" class="icon">&#9776;</a>			
			</div>
		</div>
		

		
		<div class="panel-body">
			<form method="post" action="options.php">
			    <?php settings_fields( 're-webnotik-group' ); ?>
			    <?php do_settings_sections( 're-webnotik-group' ); ?>

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
			    		<label for="webnotik_other_form">Other Form</label>
			    	</div>
			    	<div class="form-field">
			    		<textarea name="webnotik_other_form" id="webnotik_other_form"><?php echo esc_attr( get_option('webnotik_other_form') ); ?></textarea>
			    		<p>[webnotik_form type="other"]</p>
			    	</div>			    	
			    </div>

			    <div class="form-group">
			    	<div class="form-label">
				    	<label for="webnotik_extra1_form">Extra Form #1</label>
				    </div>
			    	<div class="form-field">
				    	<textarea name="webnotik_extra1_form" id="webnotik_extra1_form"><?php echo esc_attr( get_option('webnotik_extra1_form') ); ?></textarea>
				    	<p>[webnotik_form type="extra1"]</p>
				    </div>
			    </div>

			    <div class="form-group">
			    	<div class="form-label">
				    	<label for="webnotik_extra2_form">Extra Form #1</label>
				    </div>
			    	<div class="form-field">
				    	<textarea name="webnotik_extra2_form" id="webnotik_extra2_form"><?php echo esc_attr( get_option('webnotik_extra2_form') ); ?></textarea>
				    	<p>[webnotik_form type="extra2"]</p>
				    </div>
			    </div>

			   
			    
			    <?php submit_button(); ?>

			</form>
		</div>
	</div>
</div>
<?php
    
}


add_action('admin_enqueue_scripts', 'register_webnotik_scripts');
function register_webnotik_scripts() {
    wp_register_style('re-webnotik', get_stylesheet_directory_uri() . '/plugins/css/webnotik.css?version=3');
    wp_register_script('re-webnotik', get_stylesheet_directory_uri() . '/plugins/js/webnotik.js?version=3');
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



