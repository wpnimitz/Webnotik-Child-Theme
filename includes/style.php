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
    background-image: linear-gradient(90deg,rgba(30,30,30,0.50) 30%,rgba(30,30,30,0.20) 75%),url('.$hero_background.')!important;
}';

$css .= '.webnotik-pages .form-header-hero,
.webnotik-pages .form-hero .form-header,
.single .form-hero .form-header  {
    background: '.$hero_header.';
    
}';
// border-bottom: 5px solid #fff;
if($remove_form_header_padding_bottom == "Yes") {
$css .= '.form-header {
    padding-bottom: 0 !important;
	}';
}


$css .= '.webnotik-pages .form-body-hero,
.webnotik-pages .form-hero .form-body,
.form-header-hero .gform_wrapper {
    background: '.$form_body.';
}';

$css .= '.webnotik-pages .form-header-content,
.single .form-header-content {
    background: '.$content_header.';
}';


$css .= '.webnotik-pages .form-body-content, .single .form-body-content {
    background: '.$content_body.';
}';

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




