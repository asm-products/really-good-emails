<?php

/*-----------------------------------------------------------------------------------*/
/*
/*	Column Shortcodes
/*
/*-----------------------------------------------------------------------------------*/

if (!function_exists('visual_one_third')) {
	function visual_one_third( $atts, $content = null ) {

		// add script global
		global $add_shortcode_scripts;
		$add_shortcode_scripts = true;

	   return '<div class="visual-one-third">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('visual_one_third', 'visual_one_third');
}

if (!function_exists('visual_one_third_last')) {
	function visual_one_third_last( $atts, $content = null ) {

		// add script global
		global $add_shortcode_scripts;
		$add_shortcode_scripts = true;

	   return '<div class="visual-one-third visual-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('visual_one_third_last', 'visual_one_third_last');
}

if (!function_exists('visual_two_third')) {
	function visual_two_third( $atts, $content = null ) {

		// add script global
		global $add_shortcode_scripts;
		$add_shortcode_scripts = true;

	   return '<div class="visual-two-third">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('visual_two_third', 'visual_two_third');
}

if (!function_exists('visual_two_third_last')) {
	function visual_two_third_last( $atts, $content = null ) {

		// add script global
		global $add_shortcode_scripts;
		$add_shortcode_scripts = true;

	   return '<div class="visual-two-third visual-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('visual_two_third_last', 'visual_two_third_last');
}

if (!function_exists('visual_one_half')) {
	function visual_one_half( $atts, $content = null ) {

		// add script global
		global $add_shortcode_scripts;
		$add_shortcode_scripts = true;

	   return '<div class="visual-one-half">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('visual_one_half', 'visual_one_half');
}

if (!function_exists('visual_one_half_last')) {
	function visual_one_half_last( $atts, $content = null ) {

		// add script global
		global $add_shortcode_scripts;
		$add_shortcode_scripts = true;

	   return '<div class="visual-one-half visual-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('visual_one_half_last', 'visual_one_half_last');
}

if (!function_exists('visual_one_fourth')) {
	function visual_one_fourth( $atts, $content = null ) {

		// add script global
		global $add_shortcode_scripts;
		$add_shortcode_scripts = true;

	   return '<div class="visual-one-fourth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('visual_one_fourth', 'visual_one_fourth');
}

if (!function_exists('visual_one_fourth_last')) {
	function visual_one_fourth_last( $atts, $content = null ) {

		// add script global
		global $add_shortcode_scripts;
		$add_shortcode_scripts = true;

	   return '<div class="visual-one-fourth visual-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('visual_one_fourth_last', 'visual_one_fourth_last');
}

if (!function_exists('visual_three_fourth')) {
	function visual_three_fourth( $atts, $content = null ) {

		// add script global
		global $add_shortcode_scripts;
		$add_shortcode_scripts = true;

	   return '<div class="visual-three-fourth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('visual_three_fourth', 'visual_three_fourth');
}

if (!function_exists('visual_three_fourth_last')) {
	function visual_three_fourth_last( $atts, $content = null ) {

		// add script global
		global $add_shortcode_scripts;
		$add_shortcode_scripts = true;

	   return '<div class="visual-three-fourth visual-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode('visual_three_fourth_last', 'visual_three_fourth_last');
}


/*-----------------------------------------------------------------------------------*/
/*
/*	Buttons
/*
/*-----------------------------------------------------------------------------------*/

if (!function_exists('visual_button')) {
	function visual_button( $atts, $content = null ) {
		
		// add script global
		global $add_shortcode_scripts;
		$add_shortcode_scripts = true;

		extract(shortcode_atts(array(
			'url' => '#',
			'target' => '_self',
			'style' => 'default',
			'size' => 'small',
	    ), $atts));
		
	   return '<a target="'.$target.'" class="button visual-button '.$size.' '.$style.'" href="'.$url.'">' . do_shortcode($content) . '</a>';
	}
	add_shortcode('visual_button', 'visual_button');
}

/*-----------------------------------------------------------------------------------*/
/*
/*	Code
/*
/*-----------------------------------------------------------------------------------*/

if (!function_exists('code')) {
	function code( $atts, $content = null ) {

		// add script global
		global $add_shortcode_scripts;
		$add_shortcode_scripts = true;

		$defaults = array();
	
		extract( shortcode_atts( $defaults, $atts ) );

		return '<code>' . $content . '</code>';

	}
	add_shortcode('code', 'code');
}

/*-----------------------------------------------------------------------------------*/
/*
/*	Alerts
/*
/*-----------------------------------------------------------------------------------*/

if (!function_exists('visual_alert')) {
	function visual_alert( $atts, $content = null ) {

		// add script global
		global $add_shortcode_scripts;
		$add_shortcode_scripts = true;

		extract(shortcode_atts(array(
			'style'   => 'white'
	    ), $atts));
		
	   return '<div class="visual-alert '.$style.'">' . $content . '</div>';
	}
	add_shortcode('visual_alert', 'visual_alert');
}

/*-----------------------------------------------------------------------------------*/
/*
/*	Toggle Shortcodes
/*
/*-----------------------------------------------------------------------------------*/

if (!function_exists('visual_toggle')) {
	function visual_toggle( $atts, $content = null ) {

		// add script global
		global $add_shortcode_scripts;
		$add_shortcode_scripts = true;

	    extract(shortcode_atts(array(
			'title'    	 => 'Title goes here',
			'state'		 => 'open'
	    ), $atts));
	
		return "<div data-id='".$state."' class=\"visual-toggle\"><span class=\"visual-toggle-title\"><span class=\"title-icon\"></span>". $title ."</span><div class=\"visual-toggle-inner\">". do_shortcode($content) ."</div></div>";
	}
	add_shortcode('visual_toggle', 'visual_toggle');
}


/*-----------------------------------------------------------------------------------*/
/*
/*	Tabs Shortcodes
/*
/*-----------------------------------------------------------------------------------*/

if (!function_exists('visual_tabs')) {
	function visual_tabs( $atts, $content = null ) {

		// add script global
		global $add_shortcode_scripts;
		$add_shortcode_scripts = true;


		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		
		STATIC $i = 0;
		$i++;

		// Extract the tab titles for use in the tab widget.
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		
		$output = '';
		
		if( count($tab_titles) ){
		    $output .= '<div id="visual-tabs-'. $i .'" class="visual-tabs"><div class="visual-tab-inner">';
			$output .= '<ul class="visual-nav visual-clearfix">';
			
			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#visual-tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
			}
		    
		    $output .= '</ul>';
		    $output .= do_shortcode( $content );
		    $output .= '</div></div>';
		} else {
			$output .= do_shortcode( $content );
		}
		
		return $output;
	}
	add_shortcode( 'visual_tabs', 'visual_tabs' );
}

if (!function_exists('visual_tab')) {
	function visual_tab( $atts, $content = null ) {

		// add script global
		global $add_shortcode_scripts;
		$add_shortcode_scripts = true;

		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		
		return '<div id="visual-tab-'. sanitize_title( $title ) .'" class="visual-tab">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'visual_tab', 'visual_tab' );
}

?>