<?php
add_action( 'wp_enqueue_scripts', 'custom_assets' );
function custom_assets() {
	$ver = "1.0.1" . strtotime("now");
    wp_enqueue_style( 'app-style', get_stylesheet_directory_uri() . '/assets/css/app-style.css', '', $ver );
}

function autopilot_seller_form( $atts ){  

	$ret = '';
	$ret .= '<form action="https://qfautopilot.com/form.php?userid=15051&redirect=https://rehubgroup.com/seller-thank-you/" class="gform_wrapper custom_form" method="post">';
	$ret .= '<input id="input_form_group_id" name="input_form_group_id" type="hidden" value="4983">';
	$ret .= '<input name="206f6a7ada917912e9389da75d80be3b" type="hidden" value="">';
	$ret .= '<input name="embed" type="hidden" value="1">';
	$ret .= '<input id="input_form_campaign_id" name="input_form_campaign_id" type="hidden" value="18040">';
	$ret .= '<input name="user-uid" type="hidden" value="15051">';
	$ret .= '<input name="add-contact_first_name" placeholder="First Name" required="" style="margin-bottom: 8px;" type="text">';
	$ret .= '<input name="add-contact_last_name" placeholder="Last Name" required="" style="margin-bottom: 8px;" type="text">';
	$ret .= '<input name="add-contact_email" placeholder="Email Address" required="" style="margin-bottom: 8px;" type="text">';
	$ret .= '<input name="add-contact_phone" placeholder="Phone Number" required="" style="margin-bottom: 8px;" type="text">';
		$ret .= '<input type="submit" value="Submit">';
	$ret .= '</form>';

	return $ret;
}
add_shortcode( 'autopilot_seller', 'autopilot_seller_form' );


function autopilot_investor_form( $atts ){  

	$ret = '';
	$ret .= '<form action="https://qfautopilot.com/form.php?userid=15051&redirect=https://rehubgroup.com/investor-thank-you/" class="gform_wrapper custom_form" method="post">';
	$ret .= '<input id="input_form_group_id" name="input_form_group_id" type="hidden" value="4981">';
	$ret .= '<input name="206f6a7ada917912e9389da75d80be3b" type="hidden" value="">';
	$ret .= '<input name="embed" type="hidden" value="1">';
	$ret .= '<input id="input_form_campaign_id" name="input_form_campaign_id" type="hidden" value="18041">';
	$ret .= '<input name="user-uid" type="hidden" value="15051">';
	$ret .= '<input name="add-contact_first_name" placeholder="First Name" required="" style="margin-bottom: 8px;" type="text">';
	$ret .= '<input name="add-contact_last_name" placeholder="Last Name" required="" style="margin-bottom: 8px;" type="text">';
	$ret .= '<input name="add-contact_email" placeholder="Email Address" required="" style="margin-bottom: 8px;" type="text">';
	$ret .= '<input name="add-contact_phone" placeholder="Phone Number" required="" style="margin-bottom: 8px;" type="text">';
		$ret .= '<input type="submit" value="Submit">';
	$ret .= '</form>';

	return $ret;
}
add_shortcode( 'autopilot_investor', 'autopilot_investor_form' );



function autopilot_buyer_form( $atts ) {

	$ret = '';
	$ret .= '<form class="gform_wrapper custom_form" action="https://qfautopilot.com/form.php?userid=15051&redirect=https://rehubgroup.com/buyer-thank-you/" class="custom_form " method="post"> ';
	$ret .= '<input type="hidden" name="input_form_group_id" id="input_form_group_id" value="4982" />';
	$ret .= '<input type="hidden" name="206f6a7ada917912e9389da75d80be3b" value="" />';
	$ret .= '<input type="hidden" name="embed" value="1" />';
	$ret .= '<input type="hidden" name="input_form_campaign_id" id="input_form_campaign_id" value="18042" />';
	$ret .= '<input type="hidden" name="user-uid" value="15051">';

	$ret .= '<input type="text" name="add-contact_first_name" style="margin-bottom: 8px;" placeholder="First name" required><br>';

	$ret .= '<input type="text" name="add-contact_last_name" style="margin-bottom: 8px;" placeholder="Last Name" required><br>';

	$ret .= '<input type="text" name="add-contact_email" style="margin-bottom: 8px;" placeholder="Email Address" required><br>';

	$ret .= '<input type="text" name="add-contact_phone" style="margin-bottom: 8px;" placeholder="Phone" required><br>';
		$ret .= '<input type="submit" value="Submit" >';
	$ret .= '</form>';

	return $ret;
}
add_shortcode( 'autopilot_buyer', 'autopilot_buyer_form' );



add_action( 'et_after_main_content', 'webnotik_global_footer' );
function webnotik_global_footer() {

	if(is_category() || is_single()) {
		echo do_shortcode('<div class="upsell-wrapper">[et_pb_section global_module="366"][/et_pb_section]</div>');
		echo do_shortcode('<div class="upsell-wrapper">[et_pb_section global_module="368"][/et_pb_section]</div>');
	}
    
}


add_action( 'et_before_main_content', 'webnotik_global_header' );
function webnotik_global_header() {
	if(is_category(6)) {
		echo do_shortcode('<div class="webnotik-wrapper">[et_pb_section global_module="839"][/et_pb_section]</div>');
	}
    
}
