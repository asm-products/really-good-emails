<?php
/**
* Visualkicks Framework 1.1
*
* This is the key file in loading the visualkicks framework. From including
* this file in the functions.php we should be successfully be
* loading all our key framework parts.
*
*/

/*-----------------------------------------------------------------------------------*/
/*
/*	Load in all the parts
/*
/*-----------------------------------------------------------------------------------*/
	
    // Require Mobile Detect
	require_once ( VK_FILEPATH . '/framework/php/Mobile_Detect.php');

	// Require prev next custom tax functions
	require_once ( VK_FILEPATH . '/framework/php/previous-and-next-post-in-same-taxonomy.php');

    // Require TGM Plugin Activation
	require_once ( VK_FILEPATH . '/framework/php/class-tgm-plugin-activation.php');

	// Create Lists
	require_once ( VK_FILEPATH . '/framework/vk-create-lists.php');

	// Create Post Meta
    require_once ( VK_FILEPATH . '/framework/vk-create-postmeta.php');

	// Create Post Format Output
    require_once ( VK_FILEPATH . '/framework/vk-create-postformats.php');


/*-----------------------------------------------------------------------------------*/
/*
/*	Custom Theme Hooks */
/*
/*-----------------------------------------------------------------------------------*/

	// vk_messages - placed directly bellow the opening body tag
	function vk_messages() {

		do_action( 'vk_messages' );

	}

/*-----------------------------------------------------------------------------------*/
/*
/*	Enqueue Framework Styles */
/*
/*-----------------------------------------------------------------------------------*/
	
	// Admin Styles
	function vk_admin_styles($hook) {

		// admin pages
	    wp_register_style('vk-admin-style', VK_DIRECTORY . '/framework/css/vk-admin.css', 'all');
		
		// enqueue
		wp_enqueue_style( 'vk-admin-style' );

	}
	add_action('admin_enqueue_scripts', 'vk_admin_styles');




/*-----------------------------------------------------------------------------------*/
/*
/*	Enqueue Framework Scripts */
/*
/*-----------------------------------------------------------------------------------*/
	
	// Admin Scripts
	function vk_admin_scripts($hook) {

		// post format meta switcher
		wp_register_script('vk-post-format-switcher', VK_DIRECTORY . '/framework/js/vk-post-format-switcher.js', 'jquery');

		// post edit only
	    if ($hook == 'post.php' || $hook == 'post-new.php') {

	    	// enqueue
	    	wp_enqueue_script('vk-post-format-switcher');

	    }

	}
	add_action('admin_enqueue_scripts','vk_admin_scripts',10,1);


/*-----------------------------------------------------------------------------------*/
/*
/*	Add Thumbnail Columns */
/*
/*-----------------------------------------------------------------------------------*/

	// The Column
	if( !function_exists( 'vk_posts_columns' ) ) {
	    function vk_posts_columns($columns){

	      $new = array();

	      foreach($columns as $key => $title) {
	        
	        if ($key[2]) {
	          
	          $new['vk_post_thumbs'] = 'Thumb';

	        }

	        $new[$key] = $title;

	      }

	      return $new;

	    }
	    add_filter('manage_posts_columns', 'vk_posts_columns', 5);
	}


	// The Thumbnail
	if( !function_exists( 'vk_posts_custom_columns' ) ) {
	    function vk_posts_custom_columns($column_name, $id){
	        
	        if($column_name === 'vk_post_thumbs'){
	            
	            echo the_post_thumbnail();

	        }

	    }
		add_action('manage_posts_custom_column', 'vk_posts_custom_columns', 5, 2);
	}

/*-----------------------------------------------------------------------------------*/
/*
/*	Output Content (use in loop)
/*
/*-----------------------------------------------------------------------------------*/
	
	// Excerpt filter replace
	function new_excerpt_more( $more ) {
		return '...';
	}
	add_filter('excerpt_more', 'new_excerpt_more');


	// Excerpt filter length
	function custom_excerpt_length() {

		$excerpt_length = get_option('vk_blog_excerpt_length');
		
		if($excerpt_length!='') {

			return $excerpt_length;

		} else {

			return 25;

		}
		
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


	if ( !function_exists( 'vk_content' ) ) {
		function vk_content($postid) {

			// id
			$post = get_post($postid);

			// excerpt user defined
			$user_defined = $post->post_excerpt;

			// trim style in options
			$trimstyle = get_option('vk_blog_content_trim');

			// read more style
			$readmore = get_option('vk_blog_read_more');

			// excerpt
			if(	$trimstyle=='blog-excerpt' && !is_single() && !is_page()

			|| $user_defined!='' && !is_single() && !is_page()

			|| is_search()

			|| is_archive()

			) {

				the_excerpt();

			// content
			} else {

				if( $readmore == 'more-text' ) {

					the_content( __('Continue Reading &rarr;','framework') );

				} else {

					the_content( __('Read More','framework') );

				}

			}

        }
    }

/*-----------------------------------------------------------------------------------*/
/*
/*	Output Link Pages (use in loop)
/*
/*-----------------------------------------------------------------------------------*/

	if ( !function_exists( 'vk_pages' ) ) {
		function vk_pages() {

			// Linked Pages
			if( is_single() ) {

				wp_link_pages();

			}

        }
    }

/*-----------------------------------------------------------------------------------*/
/*
/*  Output Body Browser Class
/*
/*-----------------------------------------------------------------------------------*/
	
	// Is Browser
	if ( !function_exists( 'vk_browser_class' ) ) {
		function vk_browser_class($classes) {
			global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
			if($is_lynx) $classes[] = 'lynx';
			elseif($is_gecko) $classes[] = 'mozilla';
			elseif($is_opera) $classes[] = 'opera';
			elseif($is_NS4) $classes[] = 'ns4';
			elseif($is_safari) $classes[] = 'safari';
			elseif($is_chrome) $classes[] = 'chrome';
			elseif($is_IE){ 
			    $classes[] = 'ie';
			    if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version)) $classes[] = 'ie'.$browser_version[1];
			} else $classes[] = 'unknown';
			if($is_iphone) $classes[] = 'iphone';
			return $classes;
		}
		add_filter('body_class','vk_browser_class');
	}


	// Is tablet
	if ( !function_exists( 'vk_tablet_class' ) ) {
		function vk_tablet_class($classes) {

			$detect = new Mobile_Detect;

			// Add Mobile Class
			if ( $detect->isTablet() ) {

				$classes[] = 'isTablet';

			} else {

				$classes[] = 'noTablet';
				
			}

			return $classes;
		}
		add_filter('body_class','vk_tablet_class');
	}


	// Is Mobile
	if ( !function_exists( 'vk_mobile_class' ) ) {
		function vk_mobile_class($classes) {

			$detect = new Mobile_Detect;

			// Add Mobile Class
			if ( $detect->isMobile() ) {

				$classes[] = 'isMobile';

			} else {

				$classes[] = 'noMobile';

			}

			return $classes;
		}
		add_filter('body_class','vk_mobile_class');
	}


/*-----------------------------------------------------------------------------------*/
/*
/*	Output RGB Colors
/*
/*-----------------------------------------------------------------------------------*/

	function vk_hexchange($hex) {

		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}

		$rgb = array($r, $g, $b);
		return implode(",", $rgb);

	}


/*-----------------------------------------------------------------------------------*/
/*
/*  More Link Functionality (return to top of page)
/*
/*-----------------------------------------------------------------------------------*/

	function vk_remove_more_link_scroll( $link ) {

		$link = preg_replace( '|#more-[0-9]+|', '', $link );

		return $link;

	}
	add_filter( 'the_content_more_link', 'vk_remove_more_link_scroll' );


/*-----------------------------------------------------------------------------------*/
/*
/*  Global Post / Page ID
/*
/*-----------------------------------------------------------------------------------*/

    function vk_postid() {

        global $wp_query;

        if( is_home() ) {

            return get_option('page_for_posts');

        } elseif( is_search() || is_404() || is_archive() ) {

           return get_option('page_for_posts');

        } else {

            return $wp_query->post->ID;

        }
    }

/*-----------------------------------------------------------------------------------*/
/*
/*	Count Sidebar Widgets
/*
/*-----------------------------------------------------------------------------------*/

	function count_sidebar_widgets( $sidebar_id ) {
	   
	    $the_sidebars = wp_get_sidebars_widgets();

	    if( !isset( $the_sidebars[$sidebar_id] ) ) { return false; }

	   	return count( $the_sidebars[$sidebar_id] );

	}

/*-----------------------------------------------------------------------------------*/
/*
/*	Output Taxonomy
/*
/*-----------------------------------------------------------------------------------*/
	
    function vk_custom_taxonomy($args) {

    	$postid = $args['postid'];
    	$taxonomy = $args['taxonomy'];
    	$links = $args['links'];
    	$buttons = $args['buttons'];
    	$buttonsize = $args['buttonsize'];
    	$before = $args['before'];
    	$after = $args['after'];

    	// set the button classes
    	if($buttons==true) {

    		$button = 'button ' . $buttonsize;

    	} else {

    		$button = 'no-button';

    	}

    	// Get the terms
		$terms = get_the_terms( $postid, $taxonomy);

		// if we're in business
		if(is_array($terms)) {

			// count the terms
			$count = count($terms);

			// define the term list
			$output = "";

			// if we have terms
			if ($count > 0) {

					// foreach in term in array
				    foreach ($terms as $term) {

				    	// exclude the uncategorized term
				    	if ($term->name != 'Uncategorized') {

				    		if($before!='') { $output.= $before; }

				    		if($links==true) {

				    			$output.= '<a class="' . $button . '" href="/' . $taxonomy. '/' . $term->slug . '" title="' . sprintf(__('View all post filed under %s', 'framework'), $term->name) . '">' . $term->name . '</a>';
				    		
				    		} else {

				    			$output.= $term->name;

				    		}

				    		if($after!='') { $output.= $after; }


				    	} // end uncategorized

				    } // end foreach

				return $output;

			// if we don't have terms
			} else {

				return false;

			}
		
		// no in business
		} else {

			return false;

		}

    }


/*-----------------------------------------------------------------------------------*/
/*
/*	Filter Tag Cloud
/*
/*-----------------------------------------------------------------------------------*/
	
	// Tags as buttons
    if ( !function_exists( 'vk_tag_cloud' ) ) {
        function vk_tag_cloud($in) {

            return 'smallest=10&largest=10';

        }

        add_filter( 'widget_tag_cloud_args', 'vk_tag_cloud' );

    }


/*-----------------------------------------------------------------------------------*/
/*
/*	No Wordpress Resitory Update Check
/*
/*-----------------------------------------------------------------------------------*/

    function vk_wp_no_check( $r, $url ) {

        if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )

        return $r; // Not a theme update request. Bail immediately.

        $themes = unserialize( $r['body']['themes'] );

        unset( $themes[ get_option( 'template' ) ] );

        unset( $themes[ get_option( 'stylesheet' ) ] );

        $r['body']['themes'] = serialize( $themes );

        return $r;

    }

    add_filter( 'http_request_args', 'vk_wp_no_check', 5, 2 );


/*-----------------------------------------------------------------------------------*/
/*
/*	Fetch Image ID From URL
/*
/*-----------------------------------------------------------------------------------*/

    // Fetch the image ID from URL
    function vk_get_attachment_id_from_src($image_src) {

        global $wpdb;

        $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";

        $id = $wpdb->get_var($query);

        return $id;

    }

/*-----------------------------------------------------------------------------------*/
/*
/*	Theme Activation
/*
/*-----------------------------------------------------------------------------------*/

	// Theme Activation Customizer Checkbox
	if ( !function_exists( 'vk_framework_register' ) ) {
   		function vk_framework_register ( $wp_customize ) {

   			// place activation tab at the top if theme hasn't been activated
   			if (get_option('vk_theme_activate')=='') {
   				
   				$priority = 0;

   			} else {
   				
   				$priority = 99;

   			}

   			// register section
            $wp_customize->add_section('activate', array(
                'title' => __('Theme Activation','framework'),
                'priority' => $priority,
            ));

            // register setting
            $wp_customize->add_setting('vk_theme_activate', array(
                'default' => '',
                'type' => 'option',
                'capability' => 'edit_theme_options',
                'transport' => 'postMessage', // set to postMessage because we want the user to press save
            ));

            // register control
            $wp_customize->add_control('vk_theme_activate', array(
                'label'     => __('Activate Theme', 'framework' ),
                'section'   => 'activate',
                'priority'  => 1,
                'type'      => 'checkbox',
            ));

	    }
	    add_action( 'customize_register' , 'vk_framework_register' );
	}

	// Backend - Check if the theme is activated
	if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
		if ( !function_exists( 'vk_framework_admin_head' ) ) {
			function vk_framework_admin_head() { 
				
				$themename =  wp_get_theme(); ?>
			    <script type="text/javascript">
			    jQuery(function(){
					var message = '<p><strong>Thank you for using <?php Print($themename); ?></strong></br></br>Before you can use this theme, you need to "Activate This Theme" in the <a href="<?php echo admin_url('customize.php'); ?>">customization</a> window, then click save.</p>';
				    	jQuery('.themes-php #message2').html(message);
				    
				    });
			    </script>
			    
			    <?php
			}
			add_action('admin_head', 'vk_framework_admin_head');
		}
	}


	// Frontend - Check if the theme is activated
	if (get_option('vk_theme_activate')=='') {

		// Front end activation message
		add_action('vk_messages', 'vk_message_activation'); // The markup
		add_action('wp_enqueue_scripts', 'vk_message_styles'); // The Style

	}


	// THEME MESSAGE - ACTIVATION REQUIRED
	function vk_message_activation() { ?>

			<div id="vk_landing">

				<div id="vk_landing_inner">

					<h3><strong>We're 99% done!</strong></h3>

					<p>Before you can start using this theme, please check "<strong>Activate Theme</strong>" in the theme <a href="<?php echo admin_url(); ?>customize.php">customization</a> window.
						Then click save and refresh this page.</p>

					<img width="431" height="291" src="<?php echo get_template_directory_uri(); ?>/framework/images/vkmessage-activate.png">

					<p class="vk_landing_note">Rember to rate this product on themeforest.net.</p>

				</div>

			</div>

	<?php }


	// THEME ACTIVATION STYLE CSS
    function vk_message_styles() {
		
		// landing style
		wp_register_style('vk-landing-style', VK_DIRECTORY . '/framework/css/vk-landing.css', 'all');
		
		// enqueue
		wp_enqueue_style( 'vk-landing-style' );
    
    }   

?>