<?php

/*
Plugin Name: Visualkicks - Shortcodes
Plugin URI: http://www.visualkicks.com/plugins/
Description: Enables a set of shortcodes usable in the visual post editor for use in our compatible Visualkicks themes
Version: 1.2
Author: Visualkicks
Author URI: http://www.visualkicks.com

Changelog

04/11/2013 Version 1.2
- added forced margin right to the buttons
- removed the eschtmltags from code shortcode
- all styles are now forced and themes should no longer need to override styling
- instead of using .hide and .show in the js we now set the css
- we have forced the default views for tabs now via css
- scripts are now only loaded if they are needed and also placed into the footer not the head

29/11/2013 Version 1.1
- buttons no longer container any styling for sizing
- buttons have their colors set with !important rule
- added the .button class to the visual buttons

/*-----------------------------------------------------------------------------------*/


if ( ! class_exists( 'Visualkicks_Shortcodes' ) ) :

class Visualkicks_Shortcodes {

    function __construct() {

    	// get shortcodes.php
    	require_once( plugin_dir_path( __FILE__ ) .'shortcodes.php' );

    	// define paths
    	define('VISUAL_TINYMCE_URI', plugin_dir_url( __FILE__ ) .'tinymce');
		define('VISUAL_TINYMCE_DIR', plugin_dir_path( __FILE__ ) .'tinymce');
		
		// register
        add_action('init', array(&$this, 'init'));
        add_action('admin_init', array(&$this, 'admin_init'));
       	add_action('wp_footer', array(&$this, 'print_shortcode_scripts'));

	}
	

	/*--------------------------------------------------------------------*/
	/*
	/*	Registers TinyMCE
	/*
	/*--------------------------------------------------------------------*/

	function init() {

		// admin conditions
		if( ! is_admin() ) {

			// enqueue styles
			wp_register_style( 'visual-shortcodes', plugin_dir_url( __FILE__ ) . 'shortcodes.css' );
			
			// register scripts
			wp_register_script( 'visual-shortcodes-lib', plugin_dir_url( __FILE__ ) . 'js/visual-shortcodes-lib.js', array('jquery', 'jquery-ui-tabs'), '1.0', true );

		}
		
		// exit conditions
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) { return; }

		// editor condtions
		if ( get_user_option('rich_editing') == 'true' ) {

			add_filter( 'mce_external_plugins', array(&$this, 'add_rich_plugins') );

			add_filter( 'mce_buttons', array(&$this, 'register_rich_buttons') );

		}

	}

	/*--------------------------------------------------------------------*/
	/*
	/*	Print shortcode scripts in footer only if needed
	/*
	/*--------------------------------------------------------------------*/

	function print_shortcode_scripts() {

		// only print if shortcode is in use
		global $add_shortcode_scripts;
		if ( ! $add_shortcode_scripts ) {

			return;

		} else {

			wp_print_styles('visual-shortcodes');

			wp_print_scripts('jquery-ui-tabs');

			wp_print_scripts('visual-shortcodes-lib');

		}

	}

	/*--------------------------------------------------------------------*/
	/*
	/*	Defins TinyMCE js plugin
	/*
	/*--------------------------------------------------------------------*/

	function add_rich_plugins( $plugin_array ) {

		$plugin_array['visualShortcodes'] = VISUAL_TINYMCE_URI . '/plugin.js';

		return $plugin_array;

	}

	/*--------------------------------------------------------------------*/
	/*
	/*	Adds TinyMCE buttons
	/*
	/*--------------------------------------------------------------------*/	

	function register_rich_buttons( $buttons ) {

		array_push( $buttons, "|", 'visual_button' );

		return $buttons;

	}

	/*--------------------------------------------------------------------*/
	/*
	/*	Enqueue Scripts and Styles
	/*
	/*--------------------------------------------------------------------*/

	function admin_init() {

		// css
		wp_enqueue_style( 'visual-popup', VISUAL_TINYMCE_URI . '/css/popup.css', false, '1.0', 'all' );

		// js
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-livequery', VISUAL_TINYMCE_URI . '/js/jquery.livequery.js', false, '1.1.1', false );
		wp_enqueue_script( 'jquery-appendo', VISUAL_TINYMCE_URI . '/js/jquery.appendo.js', false, '1.0', false );
		wp_enqueue_script( 'base64', VISUAL_TINYMCE_URI . '/js/base64.js', false, '1.0', false );
		wp_enqueue_script( 'visual-popup', VISUAL_TINYMCE_URI . '/js/popup.js', false, '1.0', false );

		// localize the plugins js
		wp_localize_script( 'jquery', 'VisualShortcodes', array('plugin_folder' => WP_PLUGIN_URL .'/vk-shortcodes') );

	}
    
}

$visual_shortcodes = new Visualkicks_Shortcodes();

endif;

?>