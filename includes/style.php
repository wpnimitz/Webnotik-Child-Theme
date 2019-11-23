<?php
header("Content-type: text/css");
/**
CSS GENEREATED BY REI TOOLBOX
**/


$wda_form = get_option('wda_form');
extract($wda_form);

$css = '.webnotik-pages .form-header-hero  {
    background: '.$hero_header.';
    border-bottom: 5px solid #fff;
}';

$css .= '.webnotik-pages .form-body-hero {
    background: '.$hero_body.';
}';

$css .= '.webnotik-pages .form-header-content, .single .form-header-content {
    background: '.$content_header.';
    border-bottom: 5px solid #fff;
}';


$css .= '.webnotik-pages .form-body-content, .single .form-body-content {
    background: '.$content_body.';
}';

