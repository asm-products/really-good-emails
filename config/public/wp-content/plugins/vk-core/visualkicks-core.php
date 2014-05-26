<?php

/*
Plugin Name: Visualkicks - Core
Plugin URI: http://www.visualkicks.com
Description: Adds core features like favicons, tracking code & update notifications via the 'Theme Settings' page 
Version: 1.3
Author: Visualkicks
Author URI: http://www.visualkicks.com

Changelog

09/12/2013 - Version 1.3
- The update alerts are now site wide and dissmissable and will return 7 days later
- Update alerts will only display to super admins

09/12/2013 - Version 1.2
- removed the size attribute from header link icons (html5 invalid)

/*-----------------------------------------------------------------------------------*/


if ( ! class_exists( 'Visualkicks_Core' ) ) :

class Visualkicks_Core {
	
	function __construct() {

		// activation
		register_activation_hook( __FILE__, array( &$this, 'plugin_activation' ) );

		// register settings
		add_action( 'admin_init', array( &$this, 'vk_core_settings' ) );

		// register page
		add_action( 'admin_menu', array( &$this, 'vk_add_core_page' ) );

	    // scripts & styles
	    if (isset($_GET['page']) && $_GET['page'] == 'settings') { add_action('admin_print_scripts', array( &$this, 'vk_print_core_scripts' ) ); }

	    // output
	    add_action('wp_head', array( &$this, 'vk_favicon') );
	    add_action('wp_footer', array( &$this, 'vk_analytics') );

	    // update notice
	    add_action('admin_notices', array( &$this, 'notice_show') );
	    add_action('admin_init', array( &$this, 'notice_hide') );

	}

	/*--------------------------------------------------------------------*/
	/*
	/*	Functions
	/*
	/*--------------------------------------------------------------------*/

	// activation
	function plugin_activation() {

		flush_rewrite_rules();

	}

	// register settings
	function vk_core_settings(){

	    register_setting( 'theme_settings', 'theme_settings' );

	}

	// register page
	function vk_add_core_page() {

		add_menu_page( __( 'Theme Settings' ), __( 'Theme Settings' ), 'manage_options', 'settings', array( &$this, 'vk_core_page' ) );

	}

	// scripts
	function vk_print_core_scripts() {

		wp_enqueue_media();
		wp_register_script('vk_upload', plugins_url( '/vk_upload.js', __FILE__ ), array('jquery','media-upload','thickbox') );
		wp_enqueue_script('vk_upload');

	}

    // favicons output
    function vk_favicon() {

    	// get the images
		$options = get_option( 'theme_settings' );

        $favicon = $options['favicon'];

        $tablet1 = $options['tablet1'];

        $tablet2 = $options['tablet2'];

        $tablet3 = $options['tablet3'];


        // favicon
        if ( $favicon != '') {

        	echo '<link rel="shortcut icon" href="'. $favicon .'?v=2"/>'."\n";

        } else { ?>

        	<link rel="shortcut icon" href="<?php echo plugins_url(); ?>/visualkicks-core/favicon.ico?v=2" />

        <?php }

		// tablet 3
        if ( $tablet3 != '') {

			echo '<link rel="apple-touch-icon" href="'. $tablet3 .'?v=2"/>'."\n";

        } else { ?>

			<link rel="apple-touch-icon" href="<?php echo plugins_url(); ?>/visualkicks-core/tablet3.png?v=2" />

        <?php }

        // tablet 2
        if ( $tablet2 != '') {

        	echo '<link rel="apple-touch-icon" href="'. $tablet2 .'?v=2"/>'."\n";

        } else { ?>

        	<link rel="apple-touch-icon" href="<?php echo plugins_url(); ?>/visualkicks-core/tablet2.png?v=2" />

        <?php }
        
        // tablet 1
        if ( $tablet1 != '') {

        	echo '<link rel="apple-touch-icon" href="'. $tablet1 .'?v=2"/>'."\n";

        } else { ?>

			<link rel="apple-touch-icon" href="<?php echo plugins_url(); ?>/visualkicks-core/tablet1.png?v=2" />

        <?php }


    }

	// analytics output
    function vk_analytics(){

    	// get the tracking code
		$options = get_option( 'theme_settings' );

        $output = $options['tracking'];

        // echo the tracking code
        if ( $output <> "" ) echo stripslashes($output) . "\n";

    }


	// update notice
	function notice_show() {

		// check current against new versions
		$current = wp_get_theme()->Version;
		$new = $this->vk_xml_updates();
		
		// if a new version is available
		if($new!='') {
			if(version_compare( $current, $new) == -1 ) {

				// the user
				global $current_user;
			    $user_id = $current_user->ID;

			    // if user is super admin only
			    if( is_super_admin($user_id) ) {

				    // show notice once a day
			    	$interval = 86400;

			    	// get the time the user last hid the notice
					$last = get_user_meta($user_id, 'notice_time', true);

					// get the time right now
					$now = time();

					// if this is the first time the notice is shown
					// OR if the time between now and last is larger then the interval
					if ( $last=='' || (( $now - $last ) > $interval) ) {

				        echo '<div class="updated">';
				        echo '<p><strong>Theme Update Available</strong></p>';
				        echo '<p>Please download the latest version from themeforest.net and keep up to date. Change logs can be found on the bottom of the item profile page.</p>';
				        echo '<p>';
				        printf(__('<a class="button" href="%1$s">Remind Me Later</a>'), '?notice_hide=0');
				        echo '</p></div>';

					}

				}

			}
		}
	}

	// close notice
	function notice_hide() {

		// user id
		global $current_user;
		$user_id = $current_user->ID;

		// update the notice time when the user clicks hide
		if ( isset($_GET['notice_hide']) && '0' == $_GET['notice_hide'] ) {

			update_user_meta($user_id, 'notice_time', time() );

		}

	}

	// get xml data
	function vk_xml_data() {

		$xmlurl = 'http://www.visualkicks.com/xml/update.xml';

		$content = wp_remote_get( $xmlurl );

		$body = wp_remote_retrieve_body($content);

		if($body!='') { 
			
			$xml = simplexml_load_string($body);

			return $xml;

		} else {

			return false;

		}
	}

	// check xml theme version
	function vk_xml_updates() {

		$xml = $this->vk_xml_data();

		if($xml!='') {

		$themename = strtolower(wp_get_theme());

			return $xml->updates->$themename;

		} else {

			return false;

		}

	}

	/*--------------------------------------------------------------------*/
	/*
	/*	Page Markup
	/*
	/*--------------------------------------------------------------------*/
	function vk_core_page() {

		if ( ! isset( $_REQUEST['settings-updated'] ) ) {

			$_REQUEST['settings-updated'] = false;

		} ?>

		<!-- page tart -->
		<div class="wrap">

			<!-- icon -->
			<div id="icon-generic" class="icon32"><br></div>

			<!-- title -->
			<h2><?php _e( 'Theme Settings' ); ?></h2>

			<!-- saved message -->
			<?php if ( false !== $_REQUEST['settings-updated'] ) { ?>

				<div id="setting-error-settings_updated" class="updated settings-error"> 

				<p><strong>Settings saved.</strong></p></div>

			<?php } ?>

			<!-- form start -->
			<form method="post" action="options.php">

			<?php

			// setting fields
			settings_fields( 'theme_settings' );

			// get the options
			$options = get_option( 'theme_settings' );

			// is set fallbacks
			if(!isset($options['tracking'])) { $options['tracking']=''; }

			if(!isset($options['favicon'])) { $options['favicon']=''; }

			if(!isset($options['tablet1'])) { $options['tablet1']=''; }

			if(!isset($options['tablet2'])) { $options['tablet2']=''; }

			if(!isset($options['tablet3'])) { $options['tablet3']=''; }

			?>

				<table class="form-table"><tbody>


					<!-- tracking code -->
					<tr valign="top">
						<th scope="row"><label for="theme_settings[tracking]"><?php _e( 'Analytics Tracking code', 'framework' ); ?></label></th>
						<td><fieldset>
							<p><label for="theme_settings[tracking]"><?php _e('Any tracking code placed here will be inserted at the very bottom of every page.','framework'); ?></label></p>
							<p><textarea name="theme_settings[tracking]" id="theme_settings[tracking]" class="large-text code" rows="5" cols="50"><?php esc_attr_e( $options['tracking'] ); ?></textarea></p>
						</fieldset></td>
					</tr>


					<!-- favicon -->
					<tr valign="top">
						<th scope="row"><label for="theme_settings[favicon]"><?php _e( 'Favicon (32 x 32)', 'framework' ); ?></label></th>
						<td><fieldset>
							<p><input class="imgfield" id="theme_settings[favicon]" name="theme_settings[favicon]" type="text" size="36" value="<?php echo $options['favicon']; ?>"/>
							<input class="button upload_button" type="button" value="Upload Image"/></p>
							<p><img src="<?php echo $options['favicon']; ?>" style="max-height: 200px;"></p>
						</fieldset></td>
					</tr>

					<!-- tablet favicon 1 -->
					<tr valign="top">
						<th scope="row"><label for="theme_settings[tablet1]"><?php _e( 'Tablet Favicon 1 (72 x 72)', 'framework' ); ?></label></th>
						<td><fieldset>
							<p><input class="imgfield" id="theme_settings[tablet1]" name="theme_settings[tablet1]" type="text" size="36" value="<?php echo $options['tablet1']; ?>"/>
							<input class="button upload_button" type="button" value="Upload Image"/></p>
							<p><img src="<?php echo $options['tablet1']; ?>" style="max-height: 200px;"></p>
						</fieldset></td>
					</tr>

					<!-- tablet favicon 2 -->
					<tr valign="top">
						<th scope="row"><label for="theme_settings[tablet2]"><?php _e( 'Tablet Favicon 2 (114 x 114)', 'framework' ); ?></label></th>
						<td><fieldset>
							<p><input class="imgfield" id="theme_settings[tablet2]" name="theme_settings[tablet2]" type="text" size="36" value="<?php echo $options['tablet2']; ?>"/>
							<input class="button upload_button" type="button" value="Upload Image"/></p>
							<p><img src="<?php echo $options['tablet2']; ?>" style="max-height: 200px;"></p>
						</fieldset></td>
					</tr>

					<!-- tablet favicon 3 -->
					<tr valign="top">
						<th scope="row"><label for="theme_settings[tablet3]"><?php _e( 'Tablet Favicon 3 (144 x 144)', 'framework' ); ?></label></th>
						<td><fieldset>
							<p><input class="imgfield" id="theme_settings[tablet3]" name="theme_settings[tablet3]" type="text" size="36" value="<?php echo $options['tablet3']; ?>"/>
							<input class="button upload_button" type="button" value="Upload Image"/></p>
							<p><img src="<?php echo $options['tablet3']; ?>" style="max-height: 200px;"></p>
						</fieldset></td>
					</tr>

				</tbody></table>

				<!-- submit -->
				<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>

			</form>

		</div><!-- end .wrap -->
		<?php

	}


	// sanitize and validate
	function options_validate( $input ) {

		$input['tracking'] = wp_filter_post_kses( $input['tracking'] );

		return $input;

	}


}

new Visualkicks_Core;

endif;

?>