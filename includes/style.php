<?php
$css = '';
$wda_form = get_option('wda_form');
extract($wda_form);

$border_radius = '5px';

$css .= '.webnotik-pages .form-header-hero,
.webnotik-pages .form-hero .form-header  {
    background: '.$hero_header.';
    
}';
// border-bottom: 5px solid #fff;
$css .= '.webnotik-pages .form-body-hero,
.webnotik-pages .form-hero .form-body {
    background: '.$hero_body.';
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
	margin-top: 45px;
	color: #fff !important;
	background-image: linear-gradient(to left, transparent, transparent 50%, '.$button_color_hover.' 50%, '.$button_color_hover.');
	background-position: 100% 0;
	background-size: 200% 100%;
	transition: all .25s ease-in;
}';

$css .= '.et_pb_module *[type=submit]:hover {
  background-position: 0 0;
  color: #fff !important;
}';




