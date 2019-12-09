<?php
$css = '/**';
$css .= 'Created on: ' . date("Y/m/d H:i:s");
$css .= '**/';

$css .= '';
$css .= '';

$wda_form = get_option('wda_form');
extract($wda_form);

$border_radius = '5px';

if(empty($hero_background)) {
	$hero_background = get_stylesheet_directory_uri() . '/assets/img/no-bg.jpg';
}
$css .= '.webnotik-pages .hero-background {
    background-image: linear-gradient(90deg,rgba(30,30,30,0.50) 30%,rgba(30,30,30,0.20) 75%),url('.$hero_background.');
}';



if(!empty($form_header)) {
	$css .= '.webnotik-pages .form-header-hero,
	.webnotik-pages .form-hero .form-header,
	.single .form-hero .form-header  {
	    background: '.$form_header.';
	    
	}';
	$css .= '.webnotik-pages .et_pb_divider:before {
	    border-top-color: '.$form_header.';
	}';
}

if($remove_form_header_padding_bottom == "Yes") {
	$css .= '.form-header {
	    padding-bottom: 0 !important;
	}';
}


if(!empty($form_body)) {
	$css .= '.webnotik-pages .form-body-hero,
	.webnotik-pages .form-hero .form-body,
	.form-header-hero .gform_wrapper {
	    background: '.$form_body.';
	}';
}


//depreciated since 1.2.7
if(!empty($form_body)) {
	$css .= '.webnotik-pages .form-header-content,
	.single .form-header-content {
	    background: '.$form_body.';
	}';
}


//depreciated since 1.2.7
if(!empty($form_body)) {
	$css .= '.webnotik-pages .form-body-content, .single .form-body-content {
	    background: '.$form_body.';
	}';
}

if($form_fields_size == "Small") {
	$css .= '.et_pb_module .gform_wrapper input, .et_pb_module .gform_wrapper select, .et_pb_module .gform_wrapper textarea {
		padding: 10px 15px !important;
	}';
}


if(!empty($button_color)) {
	$css .= '.et_pb_module *[type=submit] {
		background: '.$button_color.';
		margin: 0 auto;
		text-align: center;
		font-weight: bold;
		color: #fff !important;
		background-image: linear-gradient(to left, transparent, transparent 50%, '.$button_color_hover.' 50%, '.$button_color_hover.');
		background-position: 100% 0;
		background-size: 200% 100%;
		transition: all .25s ease-in;
		margin-bottom: 0;
	}';

	$css .= '.et_pb_module *[type=submit]:hover {
	  background-position: 0 0;
	  color: #fff !important;
	}';

	$css .= '.webnotik-pages .location-list li a {
		color: '.$button_color.'
	}';
}


if($round_corners != "Yes") {
	$round_corners_px = 0;
}

$css .= '
.round_corners .cta a,
.round_corners *[type=submit],
.round_corners .et_pb_button,
.round_corners .et_pb_image .has-box-shadow-overlay
{
    border-radius: '.$round_corners_px.'px !important;
}';


