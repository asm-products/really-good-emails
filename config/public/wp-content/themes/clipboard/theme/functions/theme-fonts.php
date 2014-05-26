<?php
/*-----------------------------------------------------------------------------------*/

    /* This file handles our custom google fonts, the font list is in /framework */
    /* WARNING: Do not change anything in here or things will quickly break */

/*-----------------------------------------------------------------------------------*/
/*
/*  Generate Font Name (current not needed)
/*
/*-----------------------------------------------------------------------------------*/

// Generate Name
function vk_font_family($font) {

	$family = str_replace(" ", "+", $font);

	return $family;

}

/*-----------------------------------------------------------------------------------*/
/*
/*  Enqueue Standard & Create Array Of Custom
/*
/*-----------------------------------------------------------------------------------*/

// Enqueue Normal Fonts
function vk_enqueue_fonts() {

    // set prefix
    $pfx = 'vk_';

	// Create array of system fonts
	$default = array(
				'default',
				'Default',
				'arial',
				'Arial',
				'verdana',
				'Verdana',
				'trebuchet',
				'Trebuchet',
				'georgia',
				'Georgia',
				'times',
				'Times',
				'tahoma',
				'Tahoma',
				'helvetica',
				'Helvetica'
				);


	// creates array
	$fonts = array();

	$logo = get_option($pfx.'logo_font');
	if($logo!='') { $fonts[] = $logo; }

	$tagline = get_option($pfx.'tagline_font');
	if($tagline!='') { $fonts[] = $tagline; }

	$type_h1_font = get_option($pfx.'type_h1_font');
	if($type_h1_font!='') { $fonts[] = $type_h1_font; }

	$type_h2_font = get_option($pfx.'type_h2_font');
	if($type_h2_font!='') { $fonts[] = $type_h2_font; }

	$type_h3_font = get_option($pfx.'type_h3_font');
	if($type_h3_font!='') { $fonts[] = $type_h3_font; }

	$type_h4_font = get_option($pfx.'type_h4_font');
	if($type_h4_font!='') { $fonts[] = $type_h4_font; }

	$type_h5_font = get_option($pfx.'type_h5_font');
	if($type_h5_font!='') { $fonts[] = $type_h5_font; }

	$type_h6_font = get_option($pfx.'type_h6_font');
	if($type_h6_font!='') { $fonts[] = $type_h6_font; }

	$type_p_font = get_option($pfx.'type_p_font');
	if($type_p_font!='') { $fonts[] = $type_p_font; }

	$button = get_option($pfx.'button_font');
	if($button!='') { $fonts[] = $button; }

	// Remove any duplicates in the list
	$fonts = array_unique($fonts);

	// Check Google Fonts against System Fonts & Call Enque Font
	foreach($fonts as $font) {

		// If we are dealing with google fonts
		if(!in_array($font, $default)) {

			vk_enqueue_google_fonts($font);

		}

	}

}
add_action( 'wp_enqueue_scripts', 'vk_enqueue_fonts' );


/*-----------------------------------------------------------------------------------*/
/*
/*  Enqueue Custom Google Fonts
/*
/*-----------------------------------------------------------------------------------*/

function vk_enqueue_google_fonts($font) {

	$font = explode(',', $font);
	$font = $font[0];

	// Certain Google fonts need slight tweaks in order to load properly

	if ( $font == 'Open Sans' ){

		$font = 'Open Sans:400,600';

	} else {

		$font = $font . ':400,700';

	}

	$font = str_replace(" ", "+", $font);

	wp_enqueue_style( "vk_google_$font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );

} ?>