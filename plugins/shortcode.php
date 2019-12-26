<?php

function webnotik_form_shortcode( $atts ){  
	$atts = shortcode_atts(
		array(
			'type' => 'seller',
			'source' => 'organic',
		), $atts, 'webnotik_form' );
	$type = $atts["type"];
	$source = $atts["source"];

	$allowed_types = array('seller', 'buyer', 'lender', 'contractor', 'realtors', 'wholesale' , 'contact', 'extra');

	if(in_array($type, $allowed_types)) {
		$form = get_option( 'webnotik_' . $type . '_form');
		$business_name = get_option( 'webnotik_business_name');
		$trust_badge = get_stylesheet_directory_uri() . '/assets/img/trust-badge.jpg';
		$allow_trust_badge = get_option( 'allow_trust_badge');
		if($form != "") {
			$ret = '<div class="gform_wrapper webnotik-'.$type.'">';

			if(!empty($source)) {
				$ret .= str_replace("%source%", $source, do_shortcode($form));
			} else {
				if(empty($source)) {
					$ret .= str_replace("%source%", "organic", do_shortcode($form));
				}
			}
			if($allow_trust_badge == "yes") {
				$ret .= '<img class="aligncenter trust_badge" src="'.$trust_badge.'" alt="'.$business_name.'" />';
			}

			$ret .= '</div>';
		} else {
			$ret = "Form is empty!";
		}
	} else {
		$ret = 'Not allowed types';
	}

	return $ret;

	
}
add_shortcode( 'webnotik_form', 'webnotik_form_shortcode' );

function webnotik_main_topics($atts) {
	$atts = shortcode_atts(
		array(
			'display' => '4',
		), $atts, 'webnotik_main_topics' );
	$display = $atts["display"];

	$main_topics = get_option( 'webnotik_main_topics');
	$topics = explode(",", $main_topics);

	$ret = '<ul class="main-topics display-'.$display.'" >';
	foreach ($topics as $topic) {
		$ret .= '<li>' .$topic. '</li>';
	}
	$ret .= '</ul>';

	return $ret;
}
add_shortcode( 'main_topics', 'webnotik_main_topics' );

function webnotik_comparison($atts) {
	global $comparison;
	$ret = '<div class="webnotik-comparison">';
	$ret .= $comparison;
	$ret .= '</div>';
	return $ret;
}
add_shortcode( 'rei_comparison', 'webnotik_comparison' );


function webnotik_business_shortcode( $atts ){  
	$atts = shortcode_atts(
		array(
			'business' => 'seller',
			'text' => 'LINK',
			'type' => 'html',
		), $atts, 'webnotik' );
	$business = $atts["business"];
	$type = $atts["type"];
	$text = $atts["text"];

	$allowed_types = array('name', 'phone', 'email', 'address1', 'address2', 'address', 'privacy', 'tos', 'weburl');

	if(in_array($business, $allowed_types)) {
		$form = get_option( 'webnotik_business_' . $business);
		if($form != "") {
			if($type == "url") {
				$ret = do_shortcode($form);
			} else {
				$ret = '<span class="webnotik-'.$business.'">'. do_shortcode($form) . '</span>';
			}
		} else {
			if($business == 'address') {
				$ret = '<span class="webnotik-'.$business.'">'. get_option( 'webnotik_business_address1') . ', '. get_option( 'webnotik_business_address2') . '</span>';
			} elseif($business == 'weburl') {
				$url = get_bloginfo('wpurl');
				$ret = $url; 
			} else {
				$ret = "Business info is empty!";
			}
		}
	} else {
		$ret = 'Business information is not part of the settings. Please review the code.';
	}

	return $ret;

	
}
add_shortcode( 'webnotik', 'webnotik_business_shortcode' );

function webnotik_city_pages( $atts ){
	$atts = shortcode_atts(
		array(
			'type' => 'list', //or inline
			'after' => '|',
			'limit' => 0,
			'column' => 2,
		), $atts, 'city_pages' );
	$type = $atts["type"];
	$after = $atts["after"];
	$limit = $atts["limit"];
	$column = $atts["column"];


	$subpages = get_option('webnotik_keywords_subpages');
	$subid = get_option('webnotik_keywords_subpages_ids');
	$ret = '';

	if($limit == 0){
		$limit_count = count($subpages);
	} else {
		$limit_count = $limit;
	}


	if($type == "list") {
		$ret .= '<ul class="column-'.$column.'">';
	}

	for ($i=0; $i < $limit_count; $i++) { 

		if($type == "list") {
			$ret .= '<li><a href="'. $subid[$i] . '">'. $subpages[$i] . '</a></li>';
		} else {
			$ret .= '<a href="'. $subid[$i] . '">'. $subpages[$i] . '</a>';
			if( ($i+1) != count($subpages)) {
				if($after == ',') {
					$ret .= '' . $after . " ";
				} else {
					$ret .= " " . $after . " ";
				}
			}

		}
	}

	if($type == "list") {
		$ret .= "</ul>";
	}
	
	return $ret;

}
add_shortcode( 'city_pages', 'webnotik_city_pages' );


function webnotik_city_keywords( $atts ){
	global $post;
	$atts = shortcode_atts(
		array(
			'type' => 'single', //or inline
			'item' => 'main'
		), $atts, 'city_keywords' );

	$type = $atts["type"];
	$item = $atts["item"];

	if( is_front_page() ){
		$item = "main";
	}

	//$page_id = get_the_ID();
	$city_keyword = get_post_meta( $post->ID, 'city_keyword', true );

	if($item == 'main') {
		$keyword = get_option('webnotik_keywords_main');
		$ret = $keyword;
	} elseif (!empty($city_keyword) && !isset($_GET["et_fb"])) {
		$ret = $city_keyword;
	} else {
		// $keyword = get_option('webnotik_keywords_subpages');
		// $item = str_replace("city", '', $item);
		// $try_keyword = $keyword[$item-1];
		

		$exclude_words = array( ' for ', ' my ', 'in ', 'In ', 'We ', 'Buy', 'Houses', 'House', 'Cash', 'Fast', 'Sell');
    	$post_title = get_the_title($post->ID);

    	foreach ($exclude_words as $ex_word) {
    		$post_title = str_replace($ex_word, '', $post_title);
    	}
    	

		if(!empty($post_title)) {
			$ret = $post_title;
		} else {
			$ret = 'City Name';
		}
	}	
	
	return '<span class="city city-'.$post->ID.'">' . $ret . '</span>';

}
add_shortcode( 'city_keywords', 'webnotik_city_keywords' );