<?php
/*-----------------------------------------------------------------------------------*/

    /* This is our main functions file, wordpress requires it for the theme to work */
    /* WARNING: Do not change anything in here or things will quickly break */

/*-----------------------------------------------------------------------------------*/
/*
/*  Define Theme Directories
/*
/*-----------------------------------------------------------------------------------*/

    define('VK_FILEPATH', get_template_directory() );

    define('VK_DIRECTORY', get_template_directory_uri() );

/*-----------------------------------------------------------------------------------*/
/*
/*  Framework
/*
/*-----------------------------------------------------------------------------------*/
    
    require ( VK_FILEPATH . '/framework/vk-framework.php');

/*-----------------------------------------------------------------------------------*/
/*
/*  Theme
/*
/*-----------------------------------------------------------------------------------*/

    require ( VK_FILEPATH . '/theme/functions/theme-functions.php');

    require ( VK_FILEPATH . '/theme/functions/theme-fonts.php');

    require ( VK_FILEPATH . '/theme/functions/theme-postmeta.php');

    require ( VK_FILEPATH . '/theme/functions/theme-usermeta.php');

    require ( VK_FILEPATH . '/theme/customizer/theme-customize.php');

/*-----------------------------------------------------------------------------------*/
/*
/*  Theme Plugins
/*
/*-----------------------------------------------------------------------------------*/

    function vk_register_plugins() {

        // slug paths for a forced update on super old plugins
        if( file_exists( WP_CONTENT_DIR.'/plugins/visualkicks-core' ) ) { $plug_core = 'visualkicks-core'; } else { $plug_core = 'vk-core'; }
        if( file_exists( WP_CONTENT_DIR.'/plugins/visualkicks-shortcodes' ) ) { $plug_shortcode = 'visualkicks-shortcodes'; } else { $plug_shortcode = 'vk-shortcodes'; }
        if( file_exists( WP_CONTENT_DIR.'/plugins/visualkicks-widget-dribbble' ) ) { $plug_dribbble = 'visualkicks-widget-dribbble'; } else { $plug_dribbble = 'vk-widget-dribbble'; }
        if( file_exists( WP_CONTENT_DIR.'/plugins/visualkicks-widget-social' ) ) { $plug_social = 'visualkicks-widget-social'; } else { $plug_social = 'vk-widget-social'; }
        if( file_exists( WP_CONTENT_DIR.'/plugins/visualkicks-widget-twitter' ) ) { $plug_twitter = 'visualkicks-widget-twitter'; } else { $plug_twitter = 'vk-widget-twitter'; }

        // the plugins
        $plugins = array(

            array(
                'name'                  => 'Visualkicks - Core',
                'slug'                  => $plug_core,
                'source'                => VK_DIRECTORY . '/plugins/vk-core.zip',
                'required'              => true,
                'version'               => '1.3',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
            array(
                'name'                  => 'Visualkicks - Shortcodes',
                'slug'                  => $plug_shortcode,
                'source'                => VK_DIRECTORY . '/plugins/vk-shortcodes.zip',
                'required'              => false,
                'version'               => '1.2',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
            array(
                'name'                  => 'Visualkicks - Dribbble Widget',
                'slug'                  => $plug_dribbble,
                'source'                => VK_DIRECTORY . '/plugins/vk-widget-dribbble.zip',
                'required'              => false,
                'version'               => '1.1',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
            array(
                'name'                  => 'Visualkicks - Social Widget',
                'slug'                  => $plug_social,
                'source'                => VK_DIRECTORY . '/plugins/vk-widget-social.zip',
                'required'              => false,
                'version'               => '1.2',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
            array(
                'name'                  => 'Visualkicks - Twitter Widget',
                'slug'                  => $plug_twitter,
                'source'                => VK_DIRECTORY . '/plugins/vk-widget-twitter.zip',
                'required'              => false,
                'version'               => '1.1',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
        );

        $textdomain = 'framework';

        $config = array(
            'domain'            => $textdomain,                 // Text domain - likely want to be the same as your theme.
            'default_path'      => '',                          // Default absolute path to pre-packaged plugins
            'parent_menu_slug'  => 'themes.php',                // Default parent menu slug
            'parent_url_slug'   => 'themes.php',                // Default parent URL slug
            'menu'              => 'install-required-plugins',  // Menu slug
            'has_notices'       => true,                        // Show admin notices or not
            'is_automatic'      => true,                        // Automatically activate plugins after installation or not
            'message'           => '',                          // Message to output right before the plugins table
            'strings'           => array(
                'page_title'                                => __( 'Install Required Plugins', $textdomain ),
                'menu_title'                                => __( 'Install Plugins', $textdomain ),
                'installing'                                => __( 'Installing Plugin: %s', $textdomain ), // %1$s = plugin name
                'oops'                                      => __( 'Something went wrong with the plugin API.', $textdomain ),
                'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
                'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
                'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
                'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
                'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to it\'s latest version to ensure maximum compatibility with this theme:<br><br> %1$s. <br><br>To update the plugin you will need to deactivate and then delete the plugin. After which you will be asked to install the latest version packaged with the theme.','The following plugins need to be updated to their latest versions to ensure maximum compatibility with this theme:<br><br> %1$s. <br><br><b>To update the plugins you will need to deactivate and then delete the plugins. After which you will be asked to install the latest versions packaged with the theme.</b>'), // %1$s = plugin name(s)
                'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
                'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
                'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
                'return'                                    => __( 'Return to Required Plugins Installer', $textdomain ),
                'plugin_activated'                          => __( 'Plugin activated successfully.', $textdomain ),
                'complete'                                  => __( 'All plugins installed and activated successfully. %s', $textdomain ), // %1$s = dashboard link
                'nag_type'                                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
            )
        );

        tgmpa($plugins, $config);

    }
    add_action('tgmpa_register', 'vk_register_plugins');

/*-----------------------------------------------------------------------------------*/
/*
/*  Theme Menus
/*
/*-----------------------------------------------------------------------------------*/

    // register
    function register_menu() {

        register_nav_menu('main_navagation', 'Main Menu');

    }

    add_action('init', 'register_menu');


    // fallback
    function default_menu() {

        $url = home_url();

        $fallback = '<ul><li><a href="'. strtolower($url) .'/wp-admin/nav-menus.php">Set up your new menu</a></li></ul>';
       
        echo $fallback;

    }


/*-----------------------------------------------------------------------------------*/
/*
/*  Theme Styles
/*
/*-----------------------------------------------------------------------------------*/
    
    // register and enque our theme styles
    function vk_theme_styles() {


        wp_register_style('frame', VK_DIRECTORY . '/theme/css/framework.css', 'all');

        wp_register_style('eightyshades', VK_DIRECTORY . '/theme/css/icons.css', 'all');

        wp_register_style('fontawesome', VK_DIRECTORY . '/theme/css/font-awesome.css', 'all');

        wp_register_style('style', get_stylesheet_directory_uri() . '/style.css', 'all');



        wp_enqueue_style( 'frame' );

        wp_enqueue_style( 'eightyshades' );

        wp_enqueue_style( 'fontawesome' );

        wp_enqueue_style( 'compressed-styles' ); 

        wp_enqueue_style( 'style' );


    }
    add_action('wp_enqueue_scripts', 'vk_theme_styles');



    // theme customizer ui styles
    function vk_theme_customize_ui_styles() {

        wp_register_style('customize-ui', VK_DIRECTORY . '/theme/customizer/theme-customize-ui.css', 'all');

        wp_enqueue_style('customize-ui');

    }
    add_action( 'customize_controls_print_scripts', 'vk_theme_customize_ui_styles' );



    // theme customizer preview styles
    function vk_customize_preview_styles() {

        wp_register_style('customize-preview', VK_DIRECTORY . '/theme/customizer/theme-customize-preview.css', 'all');

        if ( current_user_can( 'manage_options' ) ) { wp_enqueue_style('customize-preview'); }

    }
    add_action( 'wp_enqueue_scripts', 'vk_customize_preview_styles' );



/*-----------------------------------------------------------------------------------*/
/*
/*  Theme Scripts
/*
/*-----------------------------------------------------------------------------------*/
    
    // theme scripts
    function vk_theme_scripts() {


        wp_register_script('mapsapie', 'http://maps.google.com/maps/api/js?sensor=false', 'jquery',false, true);

        // wp_register_script('modernizr', VK_DIRECTORY . '/theme/js/modernizr.js', 'jquery', '2.6.1' );

        // wp_register_script('cookie', VK_DIRECTORY . '/theme/js/jquery.cookie.js', 'jquery', '1.3.1' );

        // wp_register_script('debounce', VK_DIRECTORY . '/theme/js/jquery.debounce.min.js', 'jquery', '1.1', true);

        // wp_register_script('easing', VK_DIRECTORY . '/theme/js/jquery.easing.min.js', 'jquery', '1.3', true);

        // wp_register_script('isotope', VK_DIRECTORY . '/theme/js/jquery.isotope.min.js', 'jquery', '1.1', true);

        // wp_register_script('fitvids', VK_DIRECTORY . '/theme/js/jquery.fitvids.min.js', 'jquery', '1.0', true);

        // wp_register_script('slides', VK_DIRECTORY . '/theme/js/responsiveslides.min.js', 'jquery', '1.53', true);

        wp_register_script('lightbox', VK_DIRECTORY . '/theme/js/jquery.slidebox.js', 'jquery', '2.0' );

        // wp_register_script('mediaquery', VK_DIRECTORY . '/theme/js/css3-mediaqueries.js', '', '1.0');

        // wp_register_script('placeholder', VK_DIRECTORY . '/theme/js/jquery.textPlaceholder.js', 'jquery', '1.0' );

        // wp_register_script('gmap3', VK_DIRECTORY . '/theme/js/gmap3.min.js', 'jquery', '1.4', true);

        wp_register_script('compressed-scripts', VK_DIRECTORY . '/theme/js/compressed-scripts.js', 'jquery', '1.0', true); // contains all the above

        // wp_register_script('custom', VK_DIRECTORY . '/theme/js/custom.js', 'jquery', '1.0', true);        

        wp_register_script('reloads', VK_DIRECTORY . '/theme/js/reloads.js', 'jquery', '1.0', true);




        wp_enqueue_script('jquery');

        wp_enqueue_script('jquery-ui-tabs');

        wp_enqueue_script('mapsapie');

        // wp_enqueue_script('modernizr');

        // wp_enqueue_script('cookie');

        // wp_enqueue_script('debounce');

        // wp_enqueue_script('easing');

        // wp_enqueue_script('isotope');

        // wp_enqueue_script('fitvids');

        // wp_enqueue_script('slides');

        wp_enqueue_script('lightbox');

        // wp_enqueue_script('mediaquery');

        // wp_enqueue_script('placeholder');

        // wp_enqueue_script('gmap3');

        wp_enqueue_script('compressed-scripts');

        // wp_enqueue_script('custom');        

        wp_enqueue_script('reloads');

        if (is_single()) { wp_enqueue_script( "comment-reply" ); }

    }

    add_action('wp_enqueue_scripts', 'vk_theme_scripts');


    // theme customizer scripts
    function vk_theme_customize_ui() {
        
        wp_register_script('theme-customize-ui', VK_DIRECTORY . '/theme/customizer/theme-customize-ui.js', 'jquery');

        wp_enqueue_script('theme-customize-ui');

    }
    add_action( 'customize_controls_print_scripts', 'vk_theme_customize_ui' );



    // admin theme scripts
    function vk_theme_admin_scripts($hook) {

        if ($hook == 'post.php' || $hook == 'post-new.php') {

            wp_register_script('theme-postmeta', VK_DIRECTORY . '/theme/functions/theme-postmeta.js', 'jquery');

            wp_enqueue_script('theme-postmeta');

        }

    }
    add_action('admin_enqueue_scripts','vk_theme_admin_scripts',10,1);

/*-----------------------------------------------------------------------------------*/
/*
/*  Theme Supports
/*
/*-----------------------------------------------------------------------------------*/

    // thumbnails
    add_theme_support( 'post-thumbnails' );

    set_post_thumbnail_size( 50, 50, true );

    // image sizes
    add_image_size( 'standard', 680, 9999, false );

    add_image_size( 'fullsize', 9999, 9999, false );

    // post formats
    add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'link', 'status','quote', 'video' ) );

    // feed links
    add_theme_support( 'automatic-feed-links' );

    // shortcodes in widgets
    add_filter('widget_text', 'do_shortcode');

    // contact width
    if ( ! isset( $content_width ) ) $content_width = 680;

    // editor style
    function vk_editor_style() {

        add_editor_style( '/theme/css/framework.css' );

    }

    add_action( 'init', 'vk_editor_style' );

    // custom background
    $bgdefaults = array(
        'default-color'          => 'f4f4f4',
        'default-image'          => '',
        'wp-head-callback'       => 'vk_custom_background',
        'admin-head-callback'    => '',
        'admin-preview-callback' => ''
    );

    global $wp_version;

    if (version_compare($wp_version, '3.4', '>=' )) { add_theme_support( 'custom-background', $bgdefaults ); }


/*-----------------------------------------------------------------------------------*/
/*
/*  Theme Sidebars
/*
/*-----------------------------------------------------------------------------------*/

    // main nav
    register_sidebar(array(
        'name'=>'Main Nav Sidebar',
        'id' => 'main-nav-sidebar',
        'before_widget' => '<div class="widget mainBox mobileHide"><div class="mainWidgetSep"></div>',  
        'after_widget' => '<div class="clear"></div></div>',
        'before_title' => '<h6 class="widgetTitle">',
        'after_title' => '</h6>',
    ));

    // post 1
    register_sidebar(array(
        'name'=>'Post 1 Sidebar',
        'id' => 'post-1-sidebar',
        'description'   => 'The 1st sidebar on single post pages.',
        'before_widget' => '<div class="widget contentBlock ar"><div class="entry_content">',  
        'after_widget' => '<div class="clear"></div></div></div>',
        'before_title' => '<h6 class="widgetTitle">',
        'after_title' => '</h6>',
    ));

    // post 2
    register_sidebar(array(
        'name'=>'Post 2 Floating Sidebar',
        'id' => 'post-2-sidebar',
        'description'   => 'The 2nd sidebar on single post pages. This sidebar will float with the screen.',
        'before_widget' => '<div class="widget contentBlock ar"><div class="entry_content">',  
        'after_widget' => '<div class="clear"></div></div></div>',
        'before_title' => '<h6 class="widgetTitle">',
        'after_title' => '</h6>',
    ));

    // blog 1
    register_sidebar(array(
        'name'=>'Blog 1 Sidebar',
        'id' => 'blog-1-sidebar',
        'description'   => 'The 1st sidebar on blog listing pages.',
        'before_widget' => '<div class="widget contentBlock ar"><div class="entry_content">',  
        'after_widget' => '<div class="clear"></div></div></div>',
        'before_title' => '<h6 class="widgetTitle">',
        'after_title' => '</h6>',
    ));

    // blog 2
    register_sidebar(array(
        'name'=>'Blog 2 Floating Sidebar',
        'id' => 'blog-2-sidebar',
        'description'   => 'The 2nd sidebar on blog listing pages. This sidebar will float with the screen.',
        'before_widget' => '<div class="widget contentBlock ar"><div class="entry_content">',  
        'after_widget' => '<div class="clear"></div></div></div>',
        'before_title' => '<h6 class="widgetTitle">',
        'after_title' => '</h6>',
    ));

    // page 1
    register_sidebar(array(
        'name'=>'Page 1 Sidebar',
        'id' => 'page-1-sidebar',
        'description'   => 'The 1st sidebar on single pages.',
        'before_widget' => '<div class="widget contentBlock ar"><div class="entry_content">',  
        'after_widget' => '<div class="clear"></div></div></div>',
        'before_title' => '<h6 class="widgetTitle">',
        'after_title' => '</h6>',
    ));

    // page 2
    register_sidebar(array(
        'name'=>'Page 2 Floating Sidebar',
        'id' => 'page-2-sidebar',
        'description'   => 'The 2nd sidebar on single pages. This sidebar will float with the screen.',
        'before_widget' => '<div class="widget contentBlock ar"><div class="entry_content">',  
        'after_widget' => '<div class="clear"></div></div></div>',
        'before_title' => '<h6 class="widgetTitle">',
        'after_title' => '</h6>',
    ));

    // contact
    register_sidebar(array(
        'name'=>'Contact Sidebar',
        'id' => 'contact-sidebar',
        'description'   => 'The sidebar that is used in the page-contact.php template.',
        'before_widget' => '<div class="widget contentBlock ar"><div class="entry_content">',  
        'after_widget' => '<div class="clear"></div></div></div>',
        'before_title' => '<h6 class="widgetTitle">',
        'after_title' => '</h6>',
    ));

/*-----------------------------------------------------------------------------------*/
/*
/*  Hide Customizer Tools
/*
/*-----------------------------------------------------------------------------------*/

    // keep tools off
    update_option($p.'tools_text','0');

?>