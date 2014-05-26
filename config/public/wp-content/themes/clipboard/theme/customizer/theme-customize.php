<?php
/*-----------------------------------------------------------------------------------*/

    /* This file contains all the themes options and customization settings */
    /* WARNING: Do not change anything in here or things will quickly break */

/*-----------------------------------------------------------------------------------*/
/*
/*  Register Customization Options
/*
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'vk_register' ) ) {

    function vk_register ( $wp_customize ) {
    
        // prefix
        $p = 'vk_';

        // require custom control classes
        require_once ( VK_FILEPATH . '/framework/vk-create-custom-controls.php');


        /*-----------------------------------------------------------------------------------*/
        /*
        /*  Create New Sections & Consolidate Old Ones
        /*
        /*-----------------------------------------------------------------------------------*/

            $vk['add_sec'][] = array( 1, 'logo','Logo');

            $vk['add_sec'][] = array( 2, 'tagline','Tagline');

            $vk['add_sec'][] = array( 3, 'mainmenu','Menu');

            $vk['add_sec'][] = array( 4, 'sidebar','Sidebar');

            $vk['add_sec'][] = array( 5, 'content','Content');

            $vk['add_sec'][] = array( 6, 'background','Background');


        $vk['add_div'][] = array( 10, 'divider1','Divider');

            $vk['add_sec'][] = array( 11, 'layout','Layout');

            $vk['add_sec'][] = array( 12, 'landing','Landing Page');


        $vk['add_div'][] = array( 15, 'divider2','Divider');

            $vk['add_sec'][] = array( 16, 'type','Typography');

            $vk['add_sec'][] = array( 17, 'buttons','Buttons');

            $vk['add_sec'][] = array( 18, 'mediaplayer','Media Player');


        $vk['add_div'][] = array( 20, 'divider3','Divider');

            $vk['add_sec'][] = array( 21, 'post_defaults','Post Default Settings');

            $vk['add_sec'][] = array( 22, 'general_settings','General Settings');

            $vk['add_sec'][] = array( 999, 'tools','UI Tools');
        

        // add new sections
        foreach ($vk['add_sec'] as $section) {
            $wp_customize->add_section($section[1], array(
                'title' => $section[2],
                'priority' => $section[0],
            ));
        }

        // add dividers
        foreach ($vk['add_div'] as $section) {
            $wp_customize->add_section($section[1], array(
                'title' => $section[2],
                'priority' => $section[0],
            ));
            $vk['add_set'][] = array($p.$section[1],'');
            $vk['add_con'][] = array(1,$p.$section[1],'',$section[1],'text');
        }

        // remove unnecessary core sections & controls
        $wp_customize->remove_section( 'title_tagline');
        $wp_customize->remove_section( 'colors');
        $wp_customize->remove_section( 'background_image');
        $wp_customize->remove_section( 'static_front_page');

        // move remaining controls that are still needed
        $wp_customize->get_control( 'blogname' )->section='logo';
        $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
        $wp_customize->get_control( 'blogname' )->priority=1;
        $wp_customize->get_control( 'blogdescription' )->section='tagline';
        $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
        $wp_customize->get_control( 'blogdescription' )->priority=1;

        if ( has_nav_menu('main_navagation') ) {
            $wp_customize->get_control( 'nav_menu_locations[main_navagation]' )->section='mainmenu';
            $wp_customize->get_control( 'nav_menu_locations[main_navagation]' )->priority=0;
        }

        $wp_customize->get_control( 'background_color' )->section='background';
        $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
        $wp_customize->get_control( 'background_color' )->priority=0;
        $wp_customize->get_control( 'background_image' )->section='background';
        $wp_customize->get_setting( 'background_image' )->transport = 'postMessage';
        $wp_customize->get_control( 'background_image' )->priority=2;
        $wp_customize->get_control( 'background_repeat' )->section='background';
        $wp_customize->get_setting( 'background_repeat' )->transport = 'postMessage';
        $wp_customize->get_control( 'background_repeat' )->priority=3;
        $wp_customize->get_control( 'background_position_x' )->section='background';
        $wp_customize->get_setting( 'background_position_x' )->transport = 'postMessage';
        $wp_customize->get_control( 'background_position_x' )->priority=4;
        $wp_customize->get_control( 'background_attachment' )->section='background';
        $wp_customize->get_setting( 'background_attachment' )->transport = 'postMessage';
        $wp_customize->get_control( 'background_attachment' )->priority=5;


        /*-----------------------------------------------------------------------------------*/
        /*
        /*  Global Select & Slider Arrays
        /*
        /*-----------------------------------------------------------------------------------*/

        // landing opacity
        $range_opacity = array(
            'min' => '0.0',
            'max' => '1.0',
            'step' => '0.1',
        );

        // gutters
        $range_gutters = array(
            'min' => '0',
            'max' => '40',
            'step' => '1',
        );

        // radius
        $range_radius = array(
            'min' => '0',
            'max' => '30',
            'step' => '1',
        );

        // padding & margins
        $range_padding = array(
            'min' => '0',
            'max' => '100',
            'step' => '5',
        );

        // templates
        $choices_srt = array(
            'msnryFixed' => 'Masonry Fixed',
            'msnryFixedfull' => 'Masonry Fixed Fullwidth',
            'msnryOver'  => 'Masonry Oversize',
            'blg2col'    => 'Blog 2 Column',
            'blg1col'    => 'Blog 1 Column',
        );

        // fonts
        $fonts = vk_list_fonts();

        // font size
        $range_font_size = array(
            'min' => '10',
            'max' => '80',
            'step' => '1',
        );

        // font line height
        $range_font_line = array(
            'min' => '0',
            'max' => '3',
            'step' => '.1',
        );

        // font letter spacing
        $range_font_spacing = array(
            'min' => '-10',
            'max' => '10',
            'step' => '1',
        );

        // post visability
        $choices_visability = array(
            'Always show' => 'Always show',
            'Only show on post page' => 'Only show on post page',
            'Never show' => 'Never show',
        );

        // custom css
        $options = get_option( 'theme_settings' );

        // if the user had custom css from the old core plugin (1.2)
        // bring it into the new settings as the default
        if( isset($options['css']) && $options['css']!='' ) {

            $default_css = $options['css'];

        } else {

$default_css =
'/*---------------------------------------------------------------------------------------------
Custom CSS area
- your css will be placed after the theme output css in the header
- update and preview your code by toggling the css button in the toolbar
- feel free to delete this note at any time
---------------------------------------------------------------------------------------------*/

';

        }


        /*-----------------------------------------------------------------------------------*/
        /*
        /*  This is where we add new settings and controls. Don't mess this up.
        /*
        /*  Adding Setting: ID, Default
        /*  Adding Control: Priority, ID, Label, Section, Type, choices(array)
        /*
        /*-----------------------------------------------------------------------------------*/
        /*
        /*  Logo
        /*
        /*-----------------------------------------------------------------------------------*/

        // logo type
        $choices_lp = array(
            'logoText'   => 'Text',
            'logoImage'    => 'Image',
        );
        $vk['add_set'][] = array($p.'logo_type','');
        $vk['add_con'][] = array( 2, $p.'logo_type','Logo Type','logo','select', $choices_lp );
        if( get_option($p.'logo_type')==='' ) { update_option( $p.'logo_type', 'logoText' ); } // select default


                // font
                $vk['add_set'][] = array($p.'logo_font','');
                $vk['add_con'][] = array( 3, $p.'logo_font','Logo Font Family','logo','select', $fonts);
                if( get_option($p.'logo_font')==='' ) { update_option( $p.'logo_font', 'Raleway' ); } // select set default

                // bold
                $vk['add_set'][] = array($p.'logo_bold', 1);
                $vk['add_con'][] = array( 4, $p.'logo_bold','Bold','logo','checkbox');

                // uppercase
                $vk['add_set'][] = array($p.'logo_uppercase', '');
                $vk['add_con'][] = array( 5, $p.'logo_uppercase','Uppercase','logo','checkbox');

                // italic
                $vk['add_set'][] = array($p.'logo_italic', '');
                $vk['add_con'][] = array( 6, $p.'logo_italic','Italic','logo','checkbox');

                // font size
                $vk['add_set'][] = array($p.'logo_font_size','38','','number');
                $vk['add_con'][] = array( 7, $p.'logo_font_size','Font Size','logo','slider', $range_font_size);

                // line height
                $vk['add_set'][] = array($p.'logo_lineheight','1','','number');
                $vk['add_con'][] = array( 8, $p.'logo_lineheight','Line Height','logo','slider', $range_font_line);

                // spacing
                $vk['add_set'][] = array($p.'logo_spacing','-1','','number');
                $vk['add_con'][] = array( 9, $p.'logo_spacing','Letter Spacing','logo','slider', $range_font_spacing);

                // color
                $vk['add_set'][] = array($p.'logo_color', '#333333');
                $vk['add_con'][] = array( 10, $p.'logo_color','Color','logo','color');

                // background color
                $vk['add_set'][] = array($p.'logo_background','');
                $vk['add_con'][] = array( 11, $p.'logo_background','Background Color','logo','color');

                // image x1
                $vk['add_set'][] = array($p.'logo_image','');
                $vk['add_con'][] = array( 12, $p.'logo_image', 'Upload Logo', 'logo', 'image');

                // image x2
                $vk['add_set'][] = array($p.'logo_image_retina','','on');
                $vk['add_con'][] = array( 13, $p.'logo_image_retina', 'Upload Retina Logo(@x2)', 'logo', 'image');


        // logo position
        $choices_lp = array(
            'logoSidebar'   => 'Sidebar',
            'logoHeader'    => 'Content Header',
        );
        $vk['add_set'][] = array($p.'logo_position','');
        $vk['add_con'][] = array( 14, $p.'logo_position','Logo Position','logo','select', $choices_lp );
        if( get_option($p.'logo_position')==='' ) { update_option( $p.'logo_position', 'logoHeader' ); } // select default

                // alignment
                $choices_la = array(
                    'logoLeft' => 'Left',
                    'logoCenter' => 'Center',
                    'logoRight' => 'Right'
                );
                $vk['add_set'][] = array($p.'logo_alignment','');
                $vk['add_con'][] = array( 15, $p.'logo_alignment','Alignment','logo','select', $choices_la );
                if( get_option($p.'logo_alignment')==='' ) { update_option( $p.'logo_alignment', 'logoLeft' ); } // select default

                // margin top
                $vk['add_set'][] = array($p.'logo_margin_top','90','','number');
                $vk['add_con'][] = array( 16, $p.'logo_margin_top','Margin Top','logo','slider', $range_padding);

                // margin bottom
                $vk['add_set'][] = array($p.'logo_margin_bottom','70','','number');
                $vk['add_con'][] = array( 17, $p.'logo_margin_bottom','Margin Bottom','logo','slider', $range_padding);

        

        /*-----------------------------------------------------------------------------------*/
        /*
        /*  Tagline
        /*
        /*-----------------------------------------------------------------------------------*/

        // tagline
        $vk['add_set'][] = array($p.'tagline', '');
        $vk['add_con'][] = array( 2, $p.'tagline','Include Tagline Below Logo','tagline','checkbox');

                // font
                $vk['add_set'][] = array($p.'tagline_font','');
                $vk['add_con'][] = array( 3, $p.'tagline_font','Tagline Font Family','tagline','select', $fonts);
                if( get_option($p.'tagline_font')==='' ) { update_option( $p.'tagline_font', 'helvetica' ); } // select default

                // bold
                $vk['add_set'][] = array($p.'tagline_bold', '');
                $vk['add_con'][] = array( 4, $p.'tagline_bold','Bold','tagline','checkbox');

                // uppercase
                $vk['add_set'][] = array($p.'tagline_uppercase', 1);
                $vk['add_con'][] = array( 5, $p.'tagline_uppercase','Uppercase','tagline','checkbox');

                // italic
                $vk['add_set'][] = array($p.'tagline_italic', '');
                $vk['add_con'][] = array( 6, $p.'tagline_italic','Italic','tagline','checkbox');

                // font size
                $vk['add_set'][] = array($p.'tagline_font_size','12','','number');
                $vk['add_con'][] = array( 7, $p.'tagline_font_size','Font Size','tagline','slider', $range_font_size);

                // line height
                $vk['add_set'][] = array($p.'tagline_lineheight','1','','number');
                $vk['add_con'][] = array( 8, $p.'tagline_lineheight','Line Height','tagline','slider', $range_font_line);

                // spacing
                $vk['add_set'][] = array($p.'tagline_spacing','0','','number');
                $vk['add_con'][] = array( 9, $p.'tagline_spacing','Letter Spacing','tagline','slider', $range_font_spacing);

                // color
                $vk['add_set'][] = array($p.'tagline_color', '#444444');
                $vk['add_con'][] = array( 10, $p.'tagline_color','Color','tagline','color');

                // background color
                $vk['add_set'][] = array($p.'tagline_background','');
                $vk['add_con'][] = array( 11, $p.'tagline_background','Background Color','tagline','color');

                // margin
                $range_tagline_margin = array(
                    'min' => '0',
                    'max' => '100',
                    'step' => '2',
                );
                $vk['add_set'][] = array($p.'tagline_margin','10','','number');
                $vk['add_con'][] = array( 12, $p.'tagline_margin','Distance From Logo','tagline','slider', $range_tagline_margin);



        /*-----------------------------------------------------------------------------------*/
        /*
        /*  Main menu
        /*
        /*-----------------------------------------------------------------------------------*/

        // menu position
        $choices_mp = array(
            'menuSidebar' => 'Sidebar',
            'menuHeader' => 'Content Header',
        );
        $vk['add_set'][] = array($p.'menu_position', '');
        $vk['add_con'][] = array( 1, $p.'menu_position','Main Menu Position','mainmenu','select', $choices_mp);
        if( get_option($p.'menu_position')==='' ) { update_option( $p.'menu_position', 'menuHeader' ); } // select default

                // style
                $choices_sms = array(
                    'sideStyleStandard' => 'Standard',
                    'sideStyleWidget' => 'Widget List',
                );
                $vk['add_set'][] = array($p.'sidebar_menu_style', '', 'on');
                $vk['add_con'][] = array( 3, $p.'sidebar_menu_style','Menu Style','mainmenu','select', $choices_sms);
                if( get_option($p.'sidebar_menu_style')==='' ) { update_option( $p.'sidebar_menu_style', 'sideStyleStandard' ); } // select default

                // bold
                $vk['add_set'][] = array($p.'menu_bold', 1);
                $vk['add_con'][] = array( 4, $p.'menu_bold','Bold','mainmenu','checkbox');

                // uppercase
                $vk['add_set'][] = array($p.'menu_uppercase', '');
                $vk['add_con'][] = array( 5, $p.'menu_uppercase','Uppercase','mainmenu','checkbox');

                // italic
                $vk['add_set'][] = array($p.'menu_italic', '');
                $vk['add_con'][] = array( 6, $p.'menu_italic','Italic','mainmenu','checkbox');

                // margin top
                $vk['add_set'][] = array($p.'menu_margin_top','20','','number');
                $vk['add_con'][] = array( 7, $p.'menu_margin_top','Distance From Logo','mainmenu','slider', $range_padding);

                // color
                $vk['add_set'][] = array($p.'menu_color', '#333333');
                $vk['add_con'][] = array( 8, $p.'menu_color','Color','mainmenu','color');

                // color sub
                $vk['add_set'][] = array($p.'menu_color_sub', '#ffffff');
                $vk['add_con'][] = array( 9, $p.'menu_color_sub','Sub Menu Color','mainmenu','color');

                // color sub background
                $vk['add_set'][] = array($p.'menu_color_sub_background', '#2a2c33');
                $vk['add_con'][] = array( 10, $p.'menu_color_sub_background','Sub Menu Background Color','mainmenu','color');


        /*-----------------------------------------------------------------------------------*/
        /*
        /*  Sidebar
        /*
        /*-----------------------------------------------------------------------------------*/


        // sidebar function
        $choices_sf = array(
            'leftSidebarOn' => 'On',
            'leftSidebarSlide' => 'Slide In / Out',
            'leftSidebarOff' => 'Off',
        );
        $vk['add_set'][] = array($p.'sidebar_function', '');
        $vk['add_con'][] = array( 1, $p.'sidebar_function','Sidebar Functionality','sidebar','select', $choices_sf);
        if( get_option($p.'sidebar_function')==='' ) { update_option( $p.'sidebar_function', 'leftSidebarSlide' ); } // select default


                // slide button color
                $vk['add_set'][] = array($p.'sidebar_slide_button','#cccccc');
                $vk['add_con'][] = array( 2, $p.'sidebar_slide_button','Slide Button Color','sidebar','color');


        // background color
        $vk['add_set'][] = array($p.'sidebar_background','#292d30');
        $vk['add_con'][] = array( 9, $p.'sidebar_background','Background Color','sidebar','color');

        // background accent color
        $vk['add_set'][] = array($p.'sidebar_background_accent','#2b3135');
        $vk['add_con'][] = array( 10, $p.'sidebar_background_accent','Background Accent Color','sidebar','color');

        // text color
        $vk['add_set'][] = array($p.'sidebar_text','#ffffff');
        $vk['add_con'][] = array( 11, $p.'sidebar_text','Text Color','sidebar','color');

        // link color
        $vk['add_set'][] = array($p.'sidebar_link','#3bceba');
        $vk['add_con'][] = array( 12, $p.'sidebar_link','Link Color','sidebar','color');

        // line color
        $vk['add_set'][] = array($p.'sidebar_lines','#292d30');
        $vk['add_con'][] = array( 13, $p.'sidebar_lines','Line Color','sidebar','color');

        // button color
        $vk['add_set'][] = array($p.'sidebar_button','#3bceba');
        $vk['add_con'][] = array( 14, $p.'sidebar_button','Button Color','sidebar','color');

        // button text color
        $vk['add_set'][] = array($p.'sidebar_button_text','#ffffff');
        $vk['add_con'][] = array( 15, $p.'sidebar_button_text','Button Text Color','sidebar','color');


        // padding left
        $vk['add_set'][] = array($p.'sidebar_padding_left','35','','number');
        $vk['add_con'][] = array( 30, $p.'sidebar_padding_left','Sidebar Padding Left','sidebar','slider', $range_padding);

                // padding top
                $vk['add_set'][] = array($p.'sidebar_padding_top','35','','number');
                $vk['add_con'][] = array( 31, $p.'sidebar_padding_top','Sidebar Padding Top','sidebar','slider', $range_padding);

                // padding right
                $vk['add_set'][] = array($p.'sidebar_padding_right','35','','number');
                $vk['add_con'][] = array( 32, $p.'sidebar_padding_right','Sidebar Padding Right','sidebar','slider', $range_padding);

                // padding bottom
                $vk['add_set'][] = array($p.'sidebar_padding_bottom','35','','number');
                $vk['add_con'][] = array( 33, $p.'sidebar_padding_bottom','Sidebar Padding Bottom','sidebar','slider', $range_padding);

                // padding switch
                $vk['add_set'][] = array($p.'sidebar_padding_switch', '', 'on');
                $vk['add_con'][] = array( 34, $p.'sidebar_padding_switch','Advanced','sidebar','checkbox');


        // item gutter
        $vk['add_set'][] = array($p.'sidebar_item_gutter','50','','number');
        $vk['add_con'][] = array( 35, $p.'sidebar_item_gutter','Sidebar Item Gutter','sidebar','slider', $range_padding);


        // Sidebar Box Shadow
        $choices_cstc = array(
            'sideShad0' => 'None',
            'sideShad1' => 'Type 1',
            'sideShad2' => 'Type 2',
            'sideShad3' => 'Type 3',
            'sideShad4' => 'Inner Type 1',
            'sideShad5' => 'Inner Type 2',
            'sideShad6' => 'Inner Type 3',
        );
        $vk['add_set'][] = array($p.'sidebar_shadow', '');
        $vk['add_con'][] = array( 36, $p.'sidebar_shadow','Sidebar Box Shadow','sidebar','select', $choices_cstc);
        if( get_option($p.'sidebar_shadow')==='' ) { update_option( $p.'sidebar_shadow', 'sideShad5' ); } // select default


        /*-----------------------------------------------------------------------------------*/
        /*
        /*  Content
        /*
        /*-----------------------------------------------------------------------------------*/

        // Background Color
        $vk['add_set'][] = array($p.'content_background','#ffffff');
        $vk['add_con'][] = array( 20, $p.'content_background','Background Color','content','color');

        // Background Color
        $vk['add_set'][] = array($p.'content_background_accent','#f9f9f9');
        $vk['add_con'][] = array( 21, $p.'content_background_accent','Background Accent Color','content','color');

        // Text Color
        $vk['add_set'][] = array($p.'content_text','#333333');
        $vk['add_con'][] = array( 22, $p.'content_text','Text Color','content','color');

        // Link Color
        $vk['add_set'][] = array($p.'content_link','#3bceba');
        $vk['add_con'][] = array( 23, $p.'content_link','Link Color','content','color');

        // Line Color
        $vk['add_set'][] = array($p.'content_lines','#ededed');
        $vk['add_con'][] = array( 24, $p.'content_lines','Line Color','content','color');

        // Button Color
        $vk['add_set'][] = array($p.'content_button','#3bceba');
        $vk['add_con'][] = array( 25, $p.'content_button','Button Color','content','color');

        // Button Text Color
        $vk['add_set'][] = array($p.'content_button_text','#ffffff');
        $vk['add_con'][] = array( 26, $p.'content_button_text','Button Text Color','content','color');

        // Background Accent Color
        $vk['add_set'][] = array($p.'content_background_alt','#fcfcfc');
        $vk['add_con'][] = array( 27, $p.'content_background_alt','Alt Background Color','content','color');

        // Background Accent Text Color
        $vk['add_set'][] = array($p.'content_text_alt','#b2b2b2');
        $vk['add_con'][] = array( 28, $p.'content_text_alt','Alt Text Color','content','color');

        // Background Accent Line Color
        $vk['add_set'][] = array($p.'content_line_alt','#f2f2f2');
        $vk['add_con'][] = array( 29, $p.'content_line_alt','Alt Line Color','content','color');

        // Content Alignment
        $choices_cal = array(
            'conCenter' => 'Center',
            'conLeft'   => 'Left',
        );
        $vk['add_set'][] = array($p.'content_alignment', '');
        $vk['add_con'][] = array( 31, $p.'content_alignment','Content Alignment','content','select',$choices_cal);
        if( get_option($p.'content_alignment')==='' ) { update_option( $p.'content_alignment', 'conCenter' ); } // select default

        // Content Padding
        $range_content_padding = array(
            'min' => '0',
            'max' => '200',
            'step' => '2',
        );
        $vk['add_set'][] = array($p.'content_window_padding', '20','','number');
        $vk['add_con'][] = array( 32, $p.'content_window_padding','Window Padding','content','slider',$range_content_padding);

        // Content Gutter
        $vk['add_set'][] = array($p.'content_gutter', '15','','number');
        $vk['add_con'][] = array( 33, $p.'content_gutter','Item Gutters','content','slider',$range_gutters);

        // Content Single Page Gutter
        $vk['add_set'][] = array($p.'content_gutter_single', '10','','number');
        $vk['add_con'][] = array( 34, $p.'content_gutter_single','Item Gutters On Post Page','content','slider',$range_gutters);

        // Content Border Radius
        $vk['add_set'][] = array($p.'content_radius', '3','','number');
        $vk['add_con'][] = array( 35, $p.'content_radius','Rounded Corners','content','slider', $range_radius);

        // Content Box Shadow
        $choices_cst = array(
            'conShad0' => 'None',
            'conShad1' => 'Type 1',
            'conShad2' => 'Type 2',
            'conShad3' => 'Type 3',
        );
        $vk['add_set'][] = array($p.'content_shadow', '');
        $vk['add_con'][] = array( 36, $p.'content_shadow','Content Box Shadow','content','select', $choices_cst);
        if( get_option($p.'content_shadow')==='' ) { update_option( $p.'content_shadow', 'conShad1' ); } // select default

        // Content Media Padding
        $vk['add_set'][] = array($p.'content_padding_media', '');
        $vk['add_con'][] = array( 37, $p.'content_padding_media','Media Padding','content','checkbox');

        // Content Padding
        $vk['add_set'][] = array($p.'content_padding_content', 1);
        $vk['add_con'][] = array( 38, $p.'content_padding_content','Content Padding','content','checkbox');

        // Content Accent Padding
        $vk['add_set'][] = array($p.'content_padding_accent', 1);
        $vk['add_con'][] = array( 39, $p.'content_padding_accent','Accent Padding','content','checkbox');

        // Padding Amount 
        $vk['add_set'][] = array($p.'content_padding', '35', '','number');
        $vk['add_con'][] = array( 40, $p.'content_padding','Padding Amount','content','slider', $range_padding);


        /*-----------------------------------------------------------------------------------*/
        /*
        /*  Backround
        /*
        /*-----------------------------------------------------------------------------------*/

        // background stretch
        $vk['add_set'][] = array($p.'background_stretch', '');
        $vk['add_con'][] = array( 1, $p.'background_stretch', 'Background Image CSS3 Stretch', 'background','checkbox');

        /*-----------------------------------------------------------------------------------*/
        /*
        /*  Layout
        /*
        /*-----------------------------------------------------------------------------------*/

        // Blog Template
        $vk['add_set'][] = array($p.'blog_template','','on');
        $vk['add_con'][] = array( 1, $p.'blog_template','Blog Template','layout','select', $choices_srt );
        if( get_option($p.'blog_template')==='' ) { update_option( $p.'blog_template', 'msnryFixedfull' ); } // select default

        // Search Template
        $vk['add_set'][] = array($p.'search_template','','on');
        $vk['add_con'][] = array( 2, $p.'search_template','Search Results & Taxonomy Template','layout','select', $choices_srt );
        if( get_option($p.'search_template')==='' ) { update_option( $p.'search_template', 'msnryFixedfull' ); } // select default

        // Pagination Typpe
        $choices_pag = array(
            'manualInfinite'    => 'Manual Infinite Scroll',
            'seamlessInfinite'  => 'Seamless Infinite Scroll',
            'standardPag'       => 'Standard Pagination',
        );
        $vk['add_set'][] = array($p.'pagination','manualInfinite','on');
        $vk['add_con'][] = array( 3, $p.'pagination','Pagination Type','layout','select', $choices_pag );
        if( get_option($p.'pagination')==='' ) { update_option( $p.'pagination', 'seamlessInfinite' ); } // select default


        /*-----------------------------------------------------------------------------------*/
        /*
        /*  Media Player
        /*
        /*-----------------------------------------------------------------------------------*/

        // Media Player Background Color
        $vk['add_set'][] = array($p.'media_bg','#2a2c33');
        $vk['add_con'][] = array( 1, $p.'media_bg','Background Color','mediaplayer','color');

        // Media Player Line Color
        $vk['add_set'][] = array($p.'media_line','#2a2c33');
        $vk['add_con'][] = array( 2, $p.'media_line','Line Color','mediaplayer','color');

        // Media Player Timeline Color
        $vk['add_set'][] = array($p.'media_timeline','#1a1b21');
        $vk['add_con'][] = array( 3, $p.'media_timeline','Timeline Color','mediaplayer','color');

        // Media Player Loading Color
        $vk['add_set'][] = array($p.'media_loading','#4f4f4f');
        $vk['add_con'][] = array( 4, $p.'media_loading','Loading Color','mediaplayer','color');

        // Media Player Current Color
        $vk['add_set'][] = array($p.'media_current','#ff9659');
        $vk['add_con'][] = array( 5, $p.'media_current','Current Color','mediaplayer','color');

        // Media Player Current Color
        $vk['add_set'][] = array($p.'media_overlay','#ffffff');
        $vk['add_con'][] = array( 6, $p.'media_overlay','Button Overlay Color','mediaplayer','color');


        /*-----------------------------------------------------------------------------------*/
        /* 
        /*  Landing Page
        /*
        /*-----------------------------------------------------------------------------------*/

        // content
        $vk['add_set'][] = array($p.'landing_page', '', 'on');
        $vk['add_con'][] = array( 1, $p.'landing_page', 'Content', 'landing', 'select', vk_list_pages() );
        if( get_option($p.'landing_page')==='' ) { update_option( $p.'landing_page', '0' ); } // select default

        // content alignment
        $choices_lca = array(
            'landingLeft'      => 'Left',
            'landingCenter'    => 'Center',
        );
        $vk['add_set'][] = array($p.'landing_alignment','');
        $vk['add_con'][] = array( 2, $p.'landing_alignment', 'Content Alignment', 'landing', 'select',$choices_lca);
        if( get_option($p.'landing_alignment')==='' ) { update_option( $p.'landing_alignment', 'landingLeft' ); } // select default

        // text color
        $vk['add_set'][] = array($p.'landing_text_color','#333333');
        $vk['add_con'][] = array( 4, $p.'landing_text_color','Text Color', 'landing','color');

        // background color
        $vk['add_set'][] = array($p.'landing_background_color','#f4f4f4');
        $vk['add_con'][] = array( 5, $p.'landing_background_color','Background Color', 'landing','color');

        // background stretch
        $vk['add_set'][] = array($p.'landing_text_shadow', '');
        $vk['add_con'][] = array( 6, $p.'landing_text_shadow', 'Text Shadow', 'landing','checkbox');

        // background stretch
        $vk['add_set'][] = array($p.'landing_background_stretch', '');
        $vk['add_con'][] = array( 7, $p.'landing_background_stretch', 'Background Image Stretch', 'landing','checkbox');

        // background image
        $vk['add_set'][] = array($p.'landing_background_image','');
        $vk['add_con'][] = array( 8, $p.'landing_background_image','Background Image', 'landing','image');

        // background repeat
        $choices_lbr = array(
            'no-repeat' => 'No Repeat',
            'repeat'    => 'Tile',
            'repeat-x'  => 'Tile Horizontally',
            'repeat-y'  => 'Tile Vertically',
        );
        $vk['add_set'][] = array($p.'landing_background_repeat','');
        $vk['add_con'][] = array( 9, $p.'landing_background_repeat', 'Background Repeat', 'landing','radio', $choices_lbr );

        // background position x
        $choices_lbx = array(
            'left'      => 'Left',
            'center'    => 'Center',
            'right'     => 'Right',
        );
        $vk['add_set'][] = array($p.'landing_background_position_x','');
        $vk['add_con'][] = array( 10, $p.'landing_background_position_x', 'Background Position', 'landing','radio', $choices_lbx );

        // background opacity
        $vk['add_set'][] = array($p.'landing_background_opacity', '.9','','number');
        $vk['add_con'][] = array( 11, $p.'landing_background_opacity','Background Opacity','landing','slider',$range_opacity);


        /*-----------------------------------------------------------------------------------*/
        /*
        /*  Typography
        /*
        /*-----------------------------------------------------------------------------------*/

        // paragraph margin bottom
        $vk['add_set'][] = array($p.'paragraph_spacing','30','on','number');
        $vk['add_con'][] = array( 1, $p.'paragraph_spacing', 'Paragraph Spacing', 'type','slider', $range_font_size);

        // h1 size
        $vk['add_set'][] = array($p.'type_h1_size','32','on','number');
        $vk['add_con'][] = array( 20, $p.'type_h1_size', 'H1 Size', 'type','slider', $range_font_size);

        // h1 line
        $vk['add_set'][] = array($p.'type_h1_line','1.2','on','number');
        $vk['add_con'][] = array( 21, $p.'type_h1_line', 'H1 Line Height', 'type','slider', $range_font_line);

        // h1 space
        $vk['add_set'][] = array($p.'type_h1_space','-2','on','number');
        $vk['add_con'][] = array( 22, $p.'type_h1_space', 'H1 Letter Spacing', 'type','slider', $range_font_spacing);

        // h1 Styles 
        $vk['add_fontstyle'][] = array($p.'type_h1', 'type', 23, 24, 25);

        // h1 font family
        $vk['add_set'][] = array($p.'type_h1_font','','on');
        $vk['add_con'][] = array( 26, $p.'type_h1_font', 'H1 Font Family', 'type','select', $fonts);
        if( get_option($p.'type_h1_font')==='' ) { update_option( $p.'type_h1_font', 'Raleway' ); } // select set default

        // h2 size
        $vk['add_set'][] = array($p.'type_h2_size','26','on','number');
        $vk['add_con'][] = array( 30, $p.'type_h2_size', 'H2 Size', 'type','slider', $range_font_size);

        // h2 line
        $vk['add_set'][] = array($p.'type_h2_line','1.2','on','number');
        $vk['add_con'][] = array( 31, $p.'type_h2_line', 'H2 Line Height', 'type','slider', $range_font_line);

        // h2 space
        $vk['add_set'][] = array($p.'type_h2_space','-1','on','number');
        $vk['add_con'][] = array( 32, $p.'type_h2_space', 'H2 Letter Spacing', 'type','slider', $range_font_spacing);

        // h2 Styles 
        $vk['add_fontstyle'][] = array($p.'type_h2', 'type', 33, 34, 35);

        // h2 font family
        $vk['add_set'][] = array($p.'type_h2_font','','on');
        $vk['add_con'][] = array( 36, $p.'type_h2_font', 'H2 Font Family', 'type','select', $fonts);
        if( get_option($p.'type_h2_font')==='' ) { update_option( $p.'type_h2_font', 'Raleway' ); } // select set default

        // h3 size
        $vk['add_set'][] = array($p.'type_h3_size','22','on','number');
        $vk['add_con'][] = array( 40, $p.'type_h3_size', 'H3 Size', 'type','slider', $range_font_size);

        // h3 line
        $vk['add_set'][] = array($p.'type_h3_line','1.2','on','number');
        $vk['add_con'][] = array( 41, $p.'type_h3_line', 'H3 Line Height', 'type','slider', $range_font_line);

        // h3 space
        $vk['add_set'][] = array($p.'type_h3_space','-1','on','number');
        $vk['add_con'][] = array( 42, $p.'type_h3_space', 'H3 Letter Spacing', 'type','slider', $range_font_spacing);

        // h3 Styles 
        $vk['add_fontstyle'][] = array($p.'type_h3', 'type', 43, 44, 45);

        // h3 font family
        $vk['add_set'][] = array($p.'type_h3_font','','on');
        $vk['add_con'][] = array( 46, $p.'type_h3_font', 'H3 Font Family', 'type','select', $fonts);
        if( get_option($p.'type_h3_font')==='' ) { update_option( $p.'type_h3_font', 'Raleway' ); } // select set default

        // h4 size
        $vk['add_set'][] = array($p.'type_h4_size','20','on','number');
        $vk['add_con'][] = array( 50, $p.'type_h4_size', 'H4 Size', 'type','slider', $range_font_size);

        // h4 line
        $vk['add_set'][] = array($p.'type_h4_line','1.3','on','number');
        $vk['add_con'][] = array( 51, $p.'type_h4_line', 'H4 Line Height', 'type','slider', $range_font_line);

        // h4 space
        $vk['add_set'][] = array($p.'type_h4_space','-1','on','number');
        $vk['add_con'][] = array( 52, $p.'type_h4_space', 'H4 Letter Spacing', 'type','slider', $range_font_spacing);

        // h4 Styles 
        $vk['add_fontstyle'][] = array($p.'type_h4', 'type', 53, 54, 55);

        // h4 font family
        $vk['add_set'][] = array($p.'type_h4_font','','on');
        $vk['add_con'][] = array( 56, $p.'type_h4_font', 'H4 Font Family', 'type','select', $fonts);
        if( get_option($p.'type_h4_font')==='' ) { update_option( $p.'type_h4_font', 'Raleway' ); } // select set default

        // h5 size
        $vk['add_set'][] = array($p.'type_h5_size','18','on','number');
        $vk['add_con'][] = array( 60, $p.'type_h5_size', 'H5 Size', 'type','slider', $range_font_size);

        // h5 line
        $vk['add_set'][] = array($p.'type_h5_line','1.4','on','number');
        $vk['add_con'][] = array( 61, $p.'type_h5_line', 'H5 Line Height', 'type','slider', $range_font_line);

        // h5 space
        $vk['add_set'][] = array($p.'type_h5_space','-1','on','number');
        $vk['add_con'][] = array( 62, $p.'type_h5_space', 'H5 Letter Spacing', 'type','slider', $range_font_spacing);

        // h5 Styles 
        $vk['add_fontstyle'][] = array($p.'type_h5', 'type', 63, 64, 65);

        // h5 font family
        $vk['add_set'][] = array($p.'type_h5_font','','on');
        $vk['add_con'][] = array( 66, $p.'type_h5_font', 'H5 Font Family', 'type','select', $fonts);
        if( get_option($p.'type_h5_font')==='' ) { update_option( $p.'type_h5_font', 'Raleway' ); } // select set default

        // h6 size
        $vk['add_set'][] = array($p.'type_h6_size','16','on','number');
        $vk['add_con'][] = array( 70, $p.'type_h6_size', 'H6 Size', 'type','slider', $range_font_size);

        // h6 line
        $vk['add_set'][] = array($p.'type_h6_line','1.5','on','number');
        $vk['add_con'][] = array( 71, $p.'type_h6_line', 'H6 Line Height', 'type','slider', $range_font_line);

        // h6 space
        $vk['add_set'][] = array($p.'type_h6_space','0','on','number');
        $vk['add_con'][] = array( 72, $p.'type_h6_space', 'H6 Letter Spacing', 'type','slider', $range_font_spacing);

        // h6 Styles 
        $vk['add_fontstyle'][] = array($p.'type_h6', 'type', 73, 74, 75);

        // h6 font family
        $vk['add_set'][] = array($p.'type_h6_font','','on');
        $vk['add_con'][] = array( 76, $p.'type_h6_font', 'H6 Font Family', 'type','select', $fonts);
        if( get_option($p.'type_h6_font')==='' ) { update_option( $p.'type_h6_font', 'Raleway' ); } // select set default

        // p size
        $vk['add_set'][] = array($p.'type_p_size','15','on','number');
        $vk['add_con'][] = array( 80, $p.'type_p_size', 'Paragraph Size', 'type','slider', $range_font_size);

        // p line
        $vk['add_set'][] = array($p.'type_p_line','1.7','on','number');
        $vk['add_con'][] = array( 81, $p.'type_p_line', 'Paragraph Line Height', 'type','slider', $range_font_line);

        // p space
        $vk['add_set'][] = array($p.'type_p_space','0','on','number');
        $vk['add_con'][] = array( 82, $p.'type_p_space', 'Paragraph Letter Spacing', 'type','slider', $range_font_spacing);

        // P Styles 
        $vk['add_fontstyle'][] = array($p.'type_p', 'type', 83, 84, 85);

        // p font family
        $vk['add_set'][] = array($p.'type_p_font','','on');
        $vk['add_con'][] = array( 86, $p.'type_p_font', 'Paragraph Font Family', 'type','select', $fonts);
        if( get_option($p.'type_p_font')==='' ) { update_option( $p.'type_p_font', 'helvetica' ); } // select default


        /*-----------------------------------------------------------------------------------*/
        /*
        /*  Buttons
        /*
        /*-----------------------------------------------------------------------------------*/

        // Button Font 
        $vk['add_set'][] = array($p.'button_font', 'default');
        $vk['add_con'][] = array( 1, $p.'button_font','Button Font','buttons','select', $fonts);
        if( get_option($p.'button_font')==='' ) { update_option($p.'button_font', 'helvetica' ); } // select default

        // bold
        $vk['add_set'][] = array($p.'button_bold', 1);
        $vk['add_con'][] = array( 2, $p.'button_bold','Bold','buttons','checkbox');

        // uppercase
        $vk['add_set'][] = array($p.'button_uppercase', '');
        $vk['add_con'][] = array( 3, $p.'button_uppercase','Uppercase','buttons','checkbox');

        // italic
        $vk['add_set'][] = array($p.'button_italic', '');
        $vk['add_con'][] = array( 4, $p.'button_italic','italic','buttons','checkbox');

        // Button Text Size 
        $vk['add_set'][] = array($p.'button_size', '14','','number');
        $vk['add_con'][] = array( 5, $p.'button_size','Font Size','buttons','slider', $range_font_size);

        // Button Text Spacing 
        $vk['add_set'][] = array($p.'button_space', '0','','number');
        $vk['add_con'][] = array( 6, $p.'button_space','Letter Spacing','buttons','slider', $range_font_spacing);

        // Button Radius 
        $vk['add_set'][] = array($p.'button_radius', '3','','number');
        $vk['add_con'][] = array( 7, $p.'button_radius','Rounded Corners','buttons','slider', $range_radius);


        /*-----------------------------------------------------------------------------------*/
        /*
        /*  Post Default Settings
        /*
        /*-----------------------------------------------------------------------------------*/

        // Include Permalink Hover Icon 
        $vk['add_set'][] = array($p.'default_permalink', 1);
        $vk['add_con'][] = array( 1, $p.'default_permalink','Include Permalink Hover Icon','post_defaults','checkbox');   

        // Include Lightbox Hover Icon 
        $vk['add_set'][] = array($p.'default_lightbox', '');
        $vk['add_con'][] = array( 2, $p.'default_lightbox','Include Lightbox Hover Icon','post_defaults','checkbox');

        // Content Visability 
        $vk['add_set'][] = array($p.'default_content', '');
        $vk['add_con'][] = array( 3, $p.'default_content','Content Visability','post_defaults','select', $choices_visability);
        if( get_option($p.'default_content')==='' ) { update_option( $p.'default_content', 'Always show' ); } // select default

        // Post Meta Visability 
        $vk['add_set'][] = array($p.'default_meta', '');
        $vk['add_con'][] = array( 4, $p.'default_meta','Post Meta Visability','post_defaults','select', $choices_visability);
        if( get_option($p.'default_meta')==='' ) { update_option( $p.'default_meta', 'Only show on post page' ); } // select default

        // Display Post Title 
        $vk['add_set'][] = array($p.'default_title', 1);
        $vk['add_con'][] = array( 5, $p.'default_title','Display Post Title','post_defaults','checkbox');

        // Display Post Sharing Buttons
        $vk['add_set'][] = array($p.'default_social', '');
        $vk['add_con'][] = array( 6, $p.'default_social','Display Post Sharing Buttons','post_defaults','checkbox');

        // Display Post Pagination
        $vk['add_set'][] = array($p.'default_pagination', 1);
        $vk['add_con'][] = array( 7, $p.'default_pagination','Display Post Pagination','post_defaults','checkbox');

        // Display Author Badge 
        $vk['add_set'][] = array($p.'default_author', '');
        $vk['add_con'][] = array( 8, $p.'default_author','Display Author Badge','post_defaults','checkbox');

        // Display Comments 
        $vk['add_set'][] = array($p.'default_comments', 1);
        $vk['add_con'][] = array( 9, $p.'default_comments','Display Comments','post_defaults','checkbox');

        // Display Similar Posts 
        $vk['add_set'][] = array($p.'default_similar', '');
        $vk['add_con'][] = array( 10, $p.'default_similar','Display Similar Posts','post_defaults','checkbox');

        // Link & Quote Text Color
        $vk['add_set'][] = array($p.'default_ql_text', '#ffffff');
        $vk['add_con'][] = array( 12, $p.'default_ql_text','Link & Quote Text Color','post_defaults','color');

        // Link & Quote Background Color
        $vk['add_set'][] = array($p.'default_ql_background', '#2a2c33');
        $vk['add_con'][] = array( 13, $p.'default_ql_background','Link & Quote Background Color','post_defaults','color');


        /*-----------------------------------------------------------------------------------*/
        /*
        /*  General Settings
        /*
        /*-----------------------------------------------------------------------------------*/

        // Content Trim Style 
        $choices_blog_trim = array(
            'blog-readmore' => 'Read More Link',
            'blog-excerpt' => 'Post Excerpt',
        );
        $vk['add_set'][] = array($p.'blog_content_trim', '', 'on');
        $vk['add_con'][] = array( 1, $p.'blog_content_trim','Content Trim Style','general_settings','select',$choices_blog_trim);
        if( get_option($p.'blog_content_trim')==='' ) { update_option( $p.'blog_content_trim', 'blog-readmore' ); } // select set default

            // Read More Style
            $choices_readmore = array(
                'more-button' => 'Button',
                'more-text' => 'Plain Text',
            );
            $vk['add_set'][] = array($p.'blog_read_more', '', 'on');
            $vk['add_con'][] = array( 2, $p.'blog_read_more','Read More Style','general_settings','select', $choices_readmore);
            if( get_option($p.'blog_read_more')==='' ) { update_option( $p.'blog_read_more', 'more-text' ); } // select set default

            // Excerpt Length
            $vk['add_set'][] = array($p.'blog_excerpt_length', '25', 'on', 'number');
            $vk['add_con'][] = array( 3, $p.'blog_excerpt_length', 'Excerpt Length', 'general_settings', 'text');


        // Copyright Text
        $vk['add_set'][] = array($p.'copy_text','Copyright text goes here and is changed via the WP Customizer.', '','text');
        $vk['add_con'][] = array( 3, $p.'copy_text', 'Copyright Text', 'general_settings', 'textarea');

        // Copyright Color
        $vk['add_set'][] = array($p.'copy_color','#666666');
        $vk['add_con'][] = array( 4, $p.'copy_color','Copyright Text Color', 'general_settings','color');

        /*-----------------------------------------------------------------------------------*/
        /*
        /*  UI Tools (these are the tools used in the customizer & this section is hidden)
        /*
        /*-----------------------------------------------------------------------------------*/

        // Refresh Button 
        $vk['add_set'][] = array($p.'tools_refresh', '', 'on', 'text');
        $vk['add_con'][] = array( 1, $p.'tools_refresh','Refresh Button','tools','text');

        // Text Highlight 
        $vk['add_set'][] = array($p.'tools_text', '0', '', 'text');
        $vk['add_con'][] = array( 2, $p.'tools_text','Text Highlight','tools','text');

        // Custom CSS 
        $vk['add_set'][] = array($p.'tools_css', $default_css, 'on', 'text');
        $vk['add_con'][] = array( 4, $p.'tools_css','Custom CSS','tools','textarea');


        /*-----------------------------------------------------------------------------------*/
        /*
        /*  Ok, now all the options are setup, we create and register them with wp_customize
        /*  You shouldn't have to touch the code directly below.
        /*
        /*-----------------------------------------------------------------------------------*/
        /*
        /*  For Font Style (needs to be created before settings and controls)
        /*
        /*-----------------------------------------------------------------------------------*/

        foreach ($vk['add_fontstyle'] as $fontstyle) {

            // Bold 
            $vk['add_set'][] = array($fontstyle[0].'_bold', '');
            $vk['add_con'][] = array( $fontstyle[2], $fontstyle[0].'_bold','Bold',$fontstyle[1],'checkbox');

            // Uppercase 
            $vk['add_set'][] = array($fontstyle[0].'_uppercase', '');
            $vk['add_con'][] = array( $fontstyle[3], $fontstyle[0].'_uppercase','Uppercase',$fontstyle[1],'checkbox');

            // Italic 
            $vk['add_set'][] = array($fontstyle[0].'_italic', '');
            $vk['add_con'][] = array( $fontstyle[4], $fontstyle[0].'_italic','Italic',$fontstyle[1],'checkbox');

        }

        /*-----------------------------------------------------------------------------------*/
        /*
        /*  For Each Setting (sanitize functions are kept in /vk-create-custom-controls.php
        /*
        /*-----------------------------------------------------------------------------------*/

        foreach ($vk['add_set'] as $setting) {

            // if sanitize
            if( isset($setting[3]) ) {
                $sanitize = 'sanitize_'.$setting[3];
            } else {
                $sanitize = '';
            }

            // transport
            if( isset($setting[2]) ) {
                $transport = $setting[2];
            } else {
                $transport = '';
            }

            // If page refresh
            if($transport==='on') {

                $wp_customize->add_setting( $setting[0], array(
                    'default' => $setting[1],
                    'value'=> $setting[1],
                    'type' => 'option',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => $sanitize,
                ));

            // If post message (update via js)
            } else {

                $wp_customize->add_setting( $setting[0], array(
                    'default' => $setting[1],
                    'type' => 'option',
                    'capability' => 'edit_theme_options',
                    'transport' => 'postMessage',
                    'sanitize_callback' => $sanitize,
                ));

            }

        }

        /*-----------------------------------------------------------------------------------*/
        /*
        /*  For Each Control
        /*
        /*-----------------------------------------------------------------------------------*/

        foreach ($vk['add_con'] as $control) {

            // Color Control
            if($control[4]=='color') {
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $control[1], array(
                        'priority'  => $control[0],
                        'settings'  => $control[1],
                        'label'     => $control[2],
                        'section'   => $control[3],
                    )
                ));

            // Image Control    
            } elseif($control[4]=='image') {
                $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $control[1],  array(
                        'priority'  => $control[0],
                        'settings'  => $control[1],
                        'label'     => $control[2],
                        'section'   => $control[3],
                    )
                ));

            // Textarea Control
            } elseif($control[4]=='textarea') {
                $wp_customize->add_control( new VK_Customize_Textarea_Control( $wp_customize, $control[1], array(
                        'priority'  => $control[0],
                        'settings'  => $control[1],
                        'label'     => $control[2],
                        'section'   => $control[3],
                    )
                ));

            // Select or Radio Control
            } elseif($control[4]=='select' || $control[4]=='radio') {
                $wp_customize->add_control( $control[1], array(
                        'priority'  => $control[0],
                        'settings'  => $control[1],
                        'label'     => $control[2],
                        'section'   => $control[3],
                        'type'      => $control[4],
                        'choices'   => $control[5],
                ));

            // Checkbox Control
            } elseif($control[4]=='checkbox') {
                $wp_customize->add_control( $control[1], array(
                        'priority'  => $control[0],
                        'settings'  => $control[1],
                        'label'     => $control[2],
                        'section'   => $control[3],
                        'type'      => $control[4],
                ));

            // Text Input Control
            } elseif($control[4]=='text') {
                $wp_customize->add_control( $control[1], array(
                        'priority'  => $control[0],
                        'settings'  => $control[1],
                        'label'     => $control[2],
                        'section'   => $control[3],
                        'type'      => $control[4],
                ));

            // Slider Input Control
            } elseif( $control[4]=='slider') {
                $wp_customize->add_control( new VK_Customize_Slider_Control( $wp_customize, $control[1], array(
                        'priority'  => $control[0],
                        'settings'  => $control[1],
                        'label'     => $control[2],
                        'section'   => $control[3],
                        'type'      => $control[4],
                        'choices'   => $control[5],
                    )
                ));

            }

        } // END foreach controls

    } // END vk_register function

} // END if functions exists


/*-----------------------------------------------------------------------------------*/
/*
/*  Some options like checkboxes and selects may need body classes added. We can do
/*  that here and then target the options within our style.css. This also means
/*  the live theme-customizer.js can utilise addClass() and removeClass().
/*
/*-----------------------------------------------------------------------------------*/
/*
/*  Output Body Classes
/*
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'vk_option_classes' ) ) {

    function vk_option_classes($classes) {

        // prefix
        $p = 'vk_';

        // logo
        $classes[] = get_option($p.'logo_type');
        $classes[] = get_option($p.'logo_position');
        $classes[] = get_option($p.'logo_alignment');
        $classes[] = 'vk_logo_bold_'.get_option($p.'logo_bold');
        $classes[] = 'vk_logo_uppercase_'.get_option($p.'logo_uppercase');
        $classes[] = 'vk_logo_italic_'.get_option($p.'logo_italic');

        // tagline
        $classes[] = 'vk_tagline_'.get_option($p.'tagline');
        $classes[] = 'vk_tagline_bold_'.get_option($p.'tagline_bold');
        $classes[] = 'vk_tagline_uppercase_'.get_option($p.'tagline_uppercase');
        $classes[] = 'vk_tagline_italic_'.get_option($p.'tagline_italic');

        // menu
        $classes[] = get_option($p.'menu_position');
        $classes[] = get_option($p.'sidebar_menu_style');
        $classes[] = 'vk_menu_bold_'.get_option($p.'menu_bold');
        $classes[] = 'vk_menu_uppercase_'.get_option($p.'menu_uppercase');
        $classes[] = 'vk_menu_italic_'.get_option($p.'menu_italic');

        // sidebar
        $classes[] = get_option($p.'sidebar_shadow');

        // content
        $classes[] = get_option($p.'content_alignment');
        $classes[] = 'vk_layout_padding_media_'.get_option($p.'content_padding_media');
        $classes[] = 'vk_layout_padding_content_'.get_option($p.'content_padding_content');
        $classes[] = 'vk_layout_padding_accent_'.get_option($p.'content_padding_accent');
        $classes[] = get_option($p.'content_shadow');

        // background
        $classes[] = 'vk_background_stretch_'.get_option($p.'background_stretch');

        // landing
        if( is_front_page() && !isset( $_COOKIE['landingpage']) && get_option($p.'landing_page')!='0' ) { 
            $classes[] = 'landingOn';
        } else {
            $classes[] = 'landingOff';
        }
        $classes[] = get_option($p.'landing_alignment');
        $classes[] = 'vk_landing_text_shadow_'.get_option($p.'landing_text_shadow');
        $classes[] = 'vk_landing_background_stretch_'.get_option($p.'landing_background_stretch');

        // type
        $classes[] = 'vk_h1_bold_'.get_option($p.'type_h1_bold');
        $classes[] = 'vk_h1_uppercase_'.get_option($p.'type_h1_uppercase');
        $classes[] = 'vk_h1_italic_'.get_option($p.'type_h1_italic');

        $classes[] = 'vk_h2_bold_'.get_option($p.'type_h2_bold');
        $classes[] = 'vk_h2_uppercase_'.get_option($p.'type_h2_uppercase');
        $classes[] = 'vk_h2_italic_'.get_option($p.'type_h2_italic');

        $classes[] = 'vk_h3_bold_'.get_option($p.'type_h3_bold');
        $classes[] = 'vk_h3_uppercase_'.get_option($p.'type_h3_uppercase');
        $classes[] = 'vk_h3_italic_'.get_option($p.'type_h3_italic');

        $classes[] = 'vk_h4_bold_'.get_option($p.'type_h4_bold');
        $classes[] = 'vk_h4_uppercase_'.get_option($p.'type_h4_uppercase');
        $classes[] = 'vk_h4_italic_'.get_option($p.'type_h4_italic');

        $classes[] = 'vk_h5_bold_'.get_option($p.'type_h5_bold');
        $classes[] = 'vk_h5_uppercase_'.get_option($p.'type_h5_uppercase');
        $classes[] = 'vk_h5_italic_'.get_option($p.'type_h5_italic');

        $classes[] = 'vk_h6_bold_'.get_option($p.'type_h6_bold');
        $classes[] = 'vk_h6_uppercase_'.get_option($p.'type_h6_uppercase');
        $classes[] = 'vk_h6_italic_'.get_option($p.'type_h6_italic');

        $classes[] = 'vk_p_bold_'.get_option($p.'type_p_bold');
        $classes[] = 'vk_p_uppercase_'.get_option($p.'type_p_uppercase');
        $classes[] = 'vk_p_italic_'.get_option($p.'type_p_italic');

        // buttons
        $classes[] = 'vk_button_bold_'.get_option($p.'button_bold');
        $classes[] = 'vk_button_uppercase_'.get_option($p.'button_uppercase');
        $classes[] = 'vk_button_italic_'.get_option($p.'button_italic');

        // general settings
        $classes[] = get_option($p.'blog_read_more');

        // tools
        $classes[] = 'vk_tools_text_'.get_option($p.'tools_text');

        // add the classes
        return $classes;

    } // END vk_option_classes function

    add_filter('body_class','vk_option_classes');

} // END if functions exists


/*-----------------------------------------------------------------------------------*/
/*
/*  This is where we can add variables to localize for use in the live preview.js
/*
/*-----------------------------------------------------------------------------------*/
/*
/*  Output CSS To wp_head
/*
/*-----------------------------------------------------------------------------------*/

    $p = 'vk_';

    // localize variables theme preview script
    $preview_vars = array(
        'blog_name' => get_bloginfo('name'),
        'blog_tagline' => get_bloginfo('description'),
        'sidebar_padding_switch' => get_option($p.'sidebar_padding_switch'),
        'content_gutter' => get_option($p.'content_gutter'),
        'window_padding' => get_option($p.'window_padding'),
        'background_color' => get_background_color(),
    );

/*-----------------------------------------------------------------------------------*/
/*
/*  This is where we can add custom css to our header, created from the above options.
/*  The output css is minified and all comments and spacing is removed on final output.
/*  Some of the options are not included such as options that work on bdoy classes.
/*
/*-----------------------------------------------------------------------------------*/
/*
/*  Output CSS Variables
/*
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'vk_header_style' ) ) {
    
    function vk_header_style() {

        /*-----------------------------------------------------------------------------------*/
        /*  Logo
        /*-----------------------------------------------------------------------------------*/
        $logo_font = get_option('vk_logo_font');
        $logo_font_size = get_option('vk_logo_font_size');
        $logo_spacing = get_option('vk_logo_spacing');
        $logo_lineheight = get_option('vk_logo_lineheight');
        $logo_color = get_option('vk_logo_color');
        $logo_bg = get_option('vk_logo_background');
        $logo_margin_top = get_option('vk_logo_margin_top');
        $logo_margin_bottom = get_option('vk_logo_margin_bottom');

        /*-----------------------------------------------------------------------------------*/
        /*  Tagline
        /*-----------------------------------------------------------------------------------*/
        $tagline_font = get_option('vk_tagline_font');
        $tagline_font_size = get_option('vk_tagline_font_size');
        $tagline_spacing = get_option('vk_tagline_spacing');
        $tagline_lineheight = get_option('vk_tagline_lineheight');
        $tagline_color = get_option('vk_tagline_color');
        $tagline_bg = get_option('vk_tagline_background');
        $tagline_margin = get_option('vk_tagline_margin');

        /*-----------------------------------------------------------------------------------*/
        /*  Menu
        /*-----------------------------------------------------------------------------------*/
        $menu_margin_top = get_option('vk_menu_margin_top');
        $menu_color = get_option('vk_menu_color');
        $menu_color_sub = get_option('vk_menu_color_sub');
        $menu_color_sub_background = get_option('vk_menu_color_sub_background');

        /*-----------------------------------------------------------------------------------*/
        /*  Sidebar
        /*-----------------------------------------------------------------------------------*/
        $sidebar_slide_button = get_option('vk_sidebar_slide_button');
        $sidebar_background = get_option('vk_sidebar_background');
        $sidebar_background_accent = get_option('vk_sidebar_background_accent');
        $sidebar_text = get_option('vk_sidebar_text');
        $sidebar_link = get_option('vk_sidebar_link');
        $sidebar_lines = get_option('vk_sidebar_lines');
        $sidebar_button = get_option('vk_sidebar_button');
        $sidebar_button_text = get_option('vk_sidebar_button_text');
        $sidebar_padding_left = get_option('vk_sidebar_padding_left');
        if(get_option('vk_sidebar_padding_switch')==1) {
            $sidebar_padding_top = get_option('vk_sidebar_padding_top');
            $sidebar_padding_right = get_option('vk_sidebar_padding_right');
            $sidebar_padding_bottom = get_option('vk_sidebar_padding_bottom');
        } else {
            $sidebar_padding_top = $sidebar_padding_left; 
            $sidebar_padding_right = $sidebar_padding_left;
            $sidebar_padding_bottom =  $sidebar_padding_left;
        }
        $sidebar_item_gutter = ( get_option('vk_sidebar_item_gutter') / 2);

        /*-----------------------------------------------------------------------------------*/
        /*  Content
        /*-----------------------------------------------------------------------------------*/
        $content_background = get_option('vk_content_background');
        $content_background_accent = get_option('vk_content_background_accent');
        $content_text = get_option('vk_content_text');
        $content_link = get_option('vk_content_link');
        $content_lines = get_option('vk_content_lines');
        $content_button = get_option('vk_content_button');
        $content_button_text = get_option('vk_content_button_text');
        $content_background_alt = get_option('vk_content_background_alt');
        $content_text_alt = get_option('vk_content_text_alt');
        $content_line_alt = get_option('vk_content_line_alt');
        $content_window_padding = get_option('vk_content_window_padding');
        $content_gutter = get_option('vk_content_gutter');
        $content_gutter_single = get_option('vk_content_gutter_single');
        $content_radius = get_option('vk_content_radius');
        $content_padding = get_option('vk_content_padding');

        /*-----------------------------------------------------------------------------------*/
        /*  Media
        /*-----------------------------------------------------------------------------------*/
        $media_bg = get_option('vk_media_bg');
        $media_line = get_option('vk_media_line');
        $media_timeline = get_option('vk_media_timeline');
        $media_loading = get_option('vk_media_loading');
        $media_current = get_option('vk_media_current');
        $media_overlay = get_option('vk_media_overlay');

        /*-----------------------------------------------------------------------------------*/
        /*  Landing
        /*-----------------------------------------------------------------------------------*/
        $landing_text_color = get_option('vk_landing_text_color');
        $landing_background_color = get_option('vk_landing_background_color');
        $landing_background_image = get_option('vk_landing_background_image');
        $landing_background_repeat = get_option('vk_landing_background_repeat');
        $landing_background_position_x = get_option('vk_landing_background_position_x'); 
        $landing_background_opacity = get_option('vk_landing_background_opacity'); 

        /*-----------------------------------------------------------------------------------*/
        /*  Type
        /*-----------------------------------------------------------------------------------*/
        $paragraph_spacing = get_option('vk_paragraph_spacing');
        $type_h1_size = get_option('vk_type_h1_size');
        $type_h1_line = get_option('vk_type_h1_line');
        $type_h1_space = get_option('vk_type_h1_space');
        $type_h1_font = get_option('vk_type_h1_font');
        $type_h2_size = get_option('vk_type_h2_size');
        $type_h2_line = get_option('vk_type_h2_line');
        $type_h2_space = get_option('vk_type_h2_space');
        $type_h2_font = get_option('vk_type_h2_font');
        $type_h3_size = get_option('vk_type_h3_size');
        $type_h3_line = get_option('vk_type_h3_line');
        $type_h3_space = get_option('vk_type_h3_space');
        $type_h3_font = get_option('vk_type_h3_font');
        $type_h4_size = get_option('vk_type_h4_size');
        $type_h4_line = get_option('vk_type_h4_line');
        $type_h4_space = get_option('vk_type_h4_space');
        $type_h4_font = get_option('vk_type_h4_font');
        $type_h5_size = get_option('vk_type_h5_size');
        $type_h5_line = get_option('vk_type_h5_line');
        $type_h5_space = get_option('vk_type_h5_space');
        $type_h5_font = get_option('vk_type_h5_font');
        $type_h6_size = get_option('vk_type_h6_size');
        $type_h6_line = get_option('vk_type_h6_line');
        $type_h6_space = get_option('vk_type_h6_space');
        $type_h6_font = get_option('vk_type_h6_font');
        $type_p_size = get_option('vk_type_p_size');
        $type_p_line = get_option('vk_type_p_line');
        $type_p_space = get_option('vk_type_p_space');
        $type_p_font = get_option('vk_type_p_font');

        /*-----------------------------------------------------------------------------------*/
        /*  Buttons
        /*-----------------------------------------------------------------------------------*/
        $button_font = get_option('vk_button_font');
        $button_size = get_option('vk_button_size');
        $button_space = get_option('vk_button_space');
        $button_radius = get_option('vk_button_radius');

        /*-----------------------------------------------------------------------------------*/
        /*  General Settings
        /*-----------------------------------------------------------------------------------*/
        $copy_color = get_option('vk_copy_color');


/*-----------------------------------------------------------------------------------*/
/*
/*  Output CSS To wp_head
/*
/*-----------------------------------------------------------------------------------*/

        // Start the object
        ob_start(); ?>

        <style type="text/css">

        /*----------------------------------------------------------------------------*/
        /*  typography
        /*----------------------------------------------------------------------------*/

        h1, h2, h3, h4, h5, h6, p, blockquote { margin-bottom: <?php echo $paragraph_spacing; ?>px; }
        .entry_title h1, .entry_title h2 { padding-bottom: <?php echo $paragraph_spacing; ?>px; }

        <?php if($type_h1_font!='default') { ?> h1 { font-family: '<?php echo $type_h1_font; ?>'; } <?php } ?>
        <?php if($type_h2_font!='default') { ?> h2 { font-family: '<?php echo $type_h2_font; ?>'; } <?php } ?>
        <?php if($type_h3_font!='default') { ?> h3 { font-family: '<?php echo $type_h3_font; ?>'; } <?php } ?>
        <?php if($type_h4_font!='default') { ?> h4 { font-family: '<?php echo $type_h4_font; ?>'; } <?php } ?>
        <?php if($type_h5_font!='default') { ?> h5 { font-family: '<?php echo $type_h5_font; ?>'; } <?php } ?>
        <?php if($type_h6_font!='default') { ?> h6 { font-family: '<?php echo $type_h6_font; ?>'; } <?php } ?>
        <?php if($type_p_font!='default') { ?> p, body { font-family: '<?php echo $type_p_font; ?>'; } <?php } ?>

        h1 { font-size: <?php echo $type_h1_size; ?>px; line-height: <?php echo $type_h1_line; ?>; letter-spacing: <?php echo $type_h1_space; ?>px; }
        h2 { font-size: <?php echo $type_h2_size; ?>px; line-height: <?php echo $type_h2_line; ?>; letter-spacing: <?php echo $type_h2_space; ?>px; }
        h3 { font-size: <?php echo $type_h3_size; ?>px; line-height: <?php echo $type_h3_line; ?>; letter-spacing: <?php echo $type_h3_space; ?>px; }
        h4 { font-size: <?php echo $type_h4_size; ?>px; line-height: <?php echo $type_h4_line; ?>; letter-spacing: <?php echo $type_h4_space; ?>px; }
        h5 { font-size: <?php echo $type_h5_size; ?>px; line-height: <?php echo $type_h5_line; ?>; letter-spacing: <?php echo $type_h5_space; ?>px; }
        h6 { font-size: <?php echo $type_h6_size; ?>px; line-height: <?php echo $type_h6_line; ?>; letter-spacing: <?php echo $type_h6_space; ?>px; }
        p, body { font-size: <?php echo $type_p_size; ?>px; line-height: <?php echo $type_p_line; ?>; letter-spacing: <?php echo $type_p_space; ?>px; }

        /*----------------------------------------------------------------------------*/
        /*  logo
        /*----------------------------------------------------------------------------*/
        <?php if($logo_font!='default') { ?>
            .logo h3 { font-family: '<?php echo $logo_font; ?>'; }
        <?php } ?>
            .logo h3 a {
                font-size: <?php echo $logo_font_size; ?>px;
                line-height: <?php echo $logo_lineheight; ?>;
                letter-spacing: <?php echo $logo_spacing; ?>px;
                color: <?php echo $logo_color; ?>;

                 <?php if($logo_bg!='') { ?>
                    background: <?php echo $logo_bg; ?>;
                    box-shadow: -5px 0 0 <?php echo $logo_bg; ?>, 5px 0 0 <?php echo $logo_bg; ?>;
                 <?php } ?>

            }
            .rightHeader {
                margin-top: <?php echo $logo_margin_top; ?>px;
                margin-bottom: <?php echo $logo_margin_bottom; ?>px;
            }

        /*----------------------------------------------------------------------------*/
        /*  tagline
        /*----------------------------------------------------------------------------*/
        <?php if($tagline_font!='default') { ?>
            .tagline h3 { font-family: '<?php echo $tagline_font; ?>'; }
        <?php } ?>
            .tagline h3 {
                font-size: <?php echo $tagline_font_size; ?>px;
                line-height: <?php echo $tagline_lineheight; ?>;
                letter-spacing: <?php echo $tagline_spacing; ?>px;
                color: <?php echo $tagline_color; ?>;
            }

        <?php if($tagline_bg!='') { ?>
            .tagline h3 span {
                background: <?php echo $tagline_bg; ?>;
                box-shadow: -5px 0 0 <?php echo $tagline_bg; ?>, 5px 0 0 <?php echo $tagline_bg; ?>;
            }
        <?php } ?>

            .tagline {
                margin-top: <?php echo $tagline_margin; ?>px;
            }

        /*----------------------------------------------------------------------------*/
        /*  main menu
        /*----------------------------------------------------------------------------*/
        .rightHeader #headerNav {
            margin-top: <?php echo $menu_margin_top; ?>px;
        }
        .rightHeader #headerNav ul li a,
        .rightHeader #headerNav ul li:after { color: <?php echo $menu_color; ?>; }
        .rightHeader #headerNav ul li ul li a { color: <?php echo $menu_color_sub; ?>; }
        .rightHeader #headerNav ul li ul { background-color: <?php echo $menu_color_sub_background; ?>; }

        /*----------------------------------------------------------------------------*/
        /*  sidebar background color
        /*----------------------------------------------------------------------------*/
        .leftContainer,
        #mobileNav {
            background-color: <?php echo $sidebar_background; ?>;
        }

        /*----------------------------------------------------------------------------*/
        /*  sidebar background accent color
        /*----------------------------------------------------------------------------*/
        .leftContainer .widget ul li a,
        .leftContainer input[type="text"],
        .leftContainer input[type="password"],
        .leftContainer input[type="email"],
        .leftContainer textarea,
        #mobileNav .mobileMenu ul li a {
            background-color: <?php echo $sidebar_background_accent; ?>;
        }

        .leftContainer #mainNav ul li ul {
            border-color: <?php echo $sidebar_background_accent; ?>;
        }

        /*----------------------------------------------------------------------------*/
        /*  sidebar text color
        /*----------------------------------------------------------------------------*/
        .leftContainer,
        .leftContainer #mainNav a,
        .leftContainer .widget ul li a,
        .leftContainer input[type="text"],
        .leftContainer input[type="password"],
        .leftContainer input[type="email"],
        .leftContainer textarea,
        #mobileNav,
        #mobileNav .mobileMenu ul li a {
            color: <?php echo $sidebar_text; ?>;
        }
        .leftContainer ::-webkit-input-placeholder {
            color: <?php echo $sidebar_text; ?>;
        }
        .leftContainer input :-moz-placeholder {
            color: <?php echo $sidebar_text; ?>;
        }
        .leftContainer input ::-moz-placeholder {
            color: <?php echo $sidebar_text; ?>;
        }
        .leftContainer :-ms-input-placeholder {
            color: <?php echo $sidebar_text; ?>;
        }

        /*----------------------------------------------------------------------------*/
        /*  sidebar link color
        /*----------------------------------------------------------------------------*/
        .leftContainer a,
        .leftContainer div.twitter li a {
            color: <?php echo $sidebar_link; ?>;
        }

        /*----------------------------------------------------------------------------*/
        /*  sidebar line color
        /*----------------------------------------------------------------------------*/
        .leftContainer .mainBox {
            border-color: <?php echo $sidebar_lines; ?>;
        }
        .leftContainer #wp-calendar thead {
          border-top: 1px solid <?php echo $sidebar_lines; ?>;
          border-left: 1px solid <?php echo $sidebar_lines; ?>;
        }
        .leftContainer #wp-calendar tbody {
            border-left: 1px solid <?php echo $sidebar_lines; ?>;
        }
        .leftContainer #wp-calendar thead th,
        .leftContainer #wp-calendar tbody td {
          -webkit-box-shadow: inset -1px -1px 0px <?php echo $sidebar_lines; ?>;
             -moz-box-shadow: inset -1px -1px 0px <?php echo $sidebar_lines; ?>;
                  box-shadow: inset -1px -1px 0px <?php echo $sidebar_lines; ?>;
        }

        /*----------------------------------------------------------------------------*/
        /*  sidebar button color
        /*----------------------------------------------------------------------------*/
        .leftContainer a.button,
        .leftContainer a.visual-button {
            background-color: <?php echo $sidebar_button; ?>;
        }

        /*----------------------------------------------------------------------------*/
        /*  sidebar button text color
        /*----------------------------------------------------------------------------*/
        .leftContainer a.button,
        .leftContainer a.visual-button {
            color: <?php echo $sidebar_button_text; ?>;   
        }

        /*----------------------------------------------------------------------------*/
        /*  sidebar layout
        /*----------------------------------------------------------------------------*/
        #slideButton {
            color: <?php echo $sidebar_slide_button; ?>;
        }
        .leftContainer .leftContent {
            padding-left: <?php echo $sidebar_padding_left; ?>px;
            padding-top: <?php echo $sidebar_padding_top; ?>px;
            padding-right: <?php echo $sidebar_padding_right; ?>px;
            padding-bottom: <?php echo $sidebar_padding_bottom; ?>px;
        }
        .leftContainer .mainBox {
            padding-top: <?php echo $sidebar_item_gutter; ?>px;
            padding-bottom: <?php echo $sidebar_item_gutter; ?>px;
        }

        /*----------------------------------------------------------------------------*/
        /*  content background color
        /*----------------------------------------------------------------------------*/
        .rightContainer .contentBlock,
        .rightContainer .vk-chat-sc,
        .rightContainer .vk-tabs .vk-tab,
        .rightContainer .vk-toggle .vk-toggle-title,
        .rightContainer .vk-toggle-inner {
            background-color: <?php echo $content_background; ?>;
        }

        .rightContainer .vk-tabs ul.vk-nav li a:hover,
        .rightContainer .vk-tabs ul.vk-nav li a:focus,
        .rightContainer .ui-tabs-nav .ui-state-active a {
            background-color: <?php echo $content_background; ?> !important;
        }

        /*----------------------------------------------------------------------------*/
        /*  content background accent color
        /*----------------------------------------------------------------------------*/
        .rightContainer .widget ul li a,
        .rightContainer input[type="text"],
        .rightContainer input[type="password"],
        .rightContainer input[type="email"],
        .rightContainer textarea,
        .rightContainer a.accentButton,
        .rightContainer a.button.accentButton,
        .rightContainer .accentButton {
            background-color: <?php echo $content_background_accent; ?>;
        }

        /*----------------------------------------------------------------------------*/
        /*  content text color
        /*----------------------------------------------------------------------------*/
        .rightContainer .chat-row,
        .rightContainer .entry_content,
        .rightContainer .entry_content h1,
        .rightContainer .entry_content h2,
        .rightContainer .entry_content h3,
        .rightContainer .entry_content h4,
        .rightContainer .entry_content h5,
        .rightContainer .entry_content h6,
        .rightContainer .entry_content p,
        .rightContainer .entry_title h1,
        .rightContainer .entry_title h2 a,
        .rightContainer #globalWrap .mejs-container .mejs-controls .mejs-time span,
        .rightContainer #globalWrap .mejs-controls .mejs-button:before,
        .rightContainer #globalWrap .mejs-controls .mejs-button,
        .rightContainer .featureWrap a,
        .rightContainer input[type="text"],
        .rightContainer input[type="password"],
        .rightContainer input[type="email"],
        .rightContainer textarea,
        .rightContainer .widget ul li a,
        .rightContainer div.counterWrap h6 a,
        .rightContainer a.accentButton,
        .rightContainer a.button.accentButton,
        .rightContainer .accentButton {
            color: <?php echo $content_text; ?>;
        }
        .rightContainer .vk-tabs ul.vk-nav li a:hover,
        .rightContainer .vk-tabs ul.vk-nav li a:focus,
        .rightContainer .ui-tabs-nav .ui-state-active a {
            color: <?php echo $content_text; ?> !important;
        }
        .rightContainer ::-webkit-input-placeholder {
            color: <?php echo $content_text; ?>;
        }
        .rightContainer input :-moz-placeholder {
            color: <?php echo $content_text; ?>;
        }
        .rightContainer input ::-moz-placeholder {
            color: <?php echo $content_text; ?>;
        }
        .rightContainer :-ms-input-placeholder {
            color: <?php echo $content_text; ?>;
        }

        /*----------------------------------------------------------------------------*/
        /*  content link color
        /*----------------------------------------------------------------------------*/
        .rightContainer a,
        .rightContainer div.twitter li a {
            color: <?php echo $content_link; ?>;
        }

        /*----------------------------------------------------------------------------*/
        /*  content line color
        /*----------------------------------------------------------------------------*/
        .rightContainer .chat-transcript,
        .rightContainer .comment_wrap .comment,
        .rightContainer .widget .mejs-container,
        .rightContainer .entry_copy table,
        .rightContainer .comment.text table,
        .rightContainer .entry_copy th,
        .rightContainer .comment.text th,
        .rightContainer .entry_copy tr,
        .rightContainer .comment.text tr,
        .rightContainer .entry_copy td,
        .rightContainer .comment.text td,
        .rightContainer .entry_title h1,
        .rightContainer .entry_title h2 {
            border-color: <?php echo $content_lines; ?>;
        }
        .rightContainer .chat-row {
            border-bottom: solid 1px <?php echo $content_lines; ?>;
        }
        .rightContainer #wp-calendar thead {
            border-top: 1px solid <?php echo $content_lines; ?>;
            border-left: 1px solid <?php echo $content_lines; ?>;
        }
        .rightContainer #wp-calendar tbody {
            border-left: 1px solid <?php echo $content_lines; ?>;
        }
        .rightContainer #wp-calendar thead th,
        .rightContainer #wp-calendar tbody td {
            -webkit-box-shadow: inset -1px -1px 0px <?php echo $content_lines; ?>;
            -moz-box-shadow: inset -1px -1px 0px <?php echo $content_lines; ?>;
            box-shadow: inset -1px -1px 0px <?php echo $content_lines; ?>;
        }

        /*----------------------------------------------------------------------------*/
        /*  content button color
        /*----------------------------------------------------------------------------*/
        .rightContainer .entry_media .entry_hover .iconWrap,
        .rightContainer .pageWrap a,
        .rightContainer .pageWrap.standard span,
        .rightContainer .commentBubble,
        .rightContainer .postLabel,
        .rightContainer #globalWrap .mejs-controls .mejs-time-rail .mejs-time-float,
        .rightContainer input[type="submit"],
        .rightContainer input[type="reset"],
        .rightContainer input[type="button"],
        .rightContainer .button,
        .rightContainer a.button,
        .rightContainer a.visual-button,
        .rightContainer .comment-author-admin > div > div > .comment_wrap span.name,
        .rightContainer .bypostauthor > div > div > .comment_wrap span.name,
        .rightContainer .resultsWrap,
        .rightContainer .postPages span,
        .rightContainer .adminNote,
        .rightContainer .adminNote p {
            background-color: <?php echo $content_button; ?>;
        }
        .rightContainer .sticky {
            border-top: 20px solid  <?php echo $content_button; ?>;
        }
        .rightContainer .commentBubble span {
            border-right: 5px solid <?php echo $content_button; ?>;
            border-top: 5px solid <?php echo $content_button; ?>;
        }
        .rightContainer #globalWrap .mejs-controls .mejs-time-rail .mejs-time-float-corner {
            border-color: <?php echo $content_button; ?> transparent transparent transparent;
        }
        .similarTitle a {
            background: <?php echo $content_button; ?>;
            -webkit-box-shadow: -2px 0 0 <?php echo $content_button; ?>, 2px 0 0 <?php echo $content_button; ?>;
            -moz-box-shadow: -2px 0 0 <?php echo $content_button; ?>, 2px 0 0 <?php echo $content_button; ?>;
            box-shadow: -2px 0 0 <?php echo $content_button; ?>, 2px 0 0 <?php echo $content_button; ?>;
        }

        /*----------------------------------------------------------------------------*/
        /*  content button text color
        /*----------------------------------------------------------------------------*/

        .rightContainer .entry_media .entry_hover .iconWrap,
        .rightContainer .pageWrap a,
        .rightContainer .pageWrap.standard span,
        .rightContainer .commentBubble,
        .rightContainer .postLabel,
        .rightContainer #globalWrap .mejs-controls .mejs-time-rail .mejs-time-float,
        .rightContainer input[type="submit"],
        .rightContainer input[type="reset"],
        .rightContainer input[type="button"],
        .rightContainer .button,
        .rightContainer a.button,
        .rightContainer a.visual-button,
        .rightContainer .comment-author-admin > div > div > .comment_wrap span.name,
        .rightContainer .bypostauthor > div > div > .comment_wrap span.name,
        .rightContainer .resultsWrap h4,
        .rightContainer .postPages span,
        .rightContainer .adminNote,
        .rightContainer .adminNote p,
        .similarTitle a {
            color: <?php echo $content_button_text; ?>;
        }
        .rightContainer .resultsWrap h4 span {
            border-color: <?php echo $content_button_text; ?>;
        }

        /*----------------------------------------------------------------------------*/
        /*  content alt background color
        /*----------------------------------------------------------------------------*/
        .rightContainer .comment_wrap .imgwrap a,
        .rightContainer .entry_meta,
        .rightContainer .vk-tabs ul.vk-nav li a,
        .rightContainer .vk-toggle .vk-toggle-title:hover,
        .rightContainer .vk-toggle-title.ui-state-active:hover,
        .rightContainer .vk-toggle .ui-state-active,
        .rightContainer .similarWrap .entry_media {
            background-color: <?php echo $content_background_alt; ?>;
        }

        /*----------------------------------------------------------------------------*/
        /*  content alt text color
        /*----------------------------------------------------------------------------*/
        .rightContainer .comment_wrap .imgwrap a,
        .rightContainer .entry_meta,
        .rightContainer .entry_meta a,
        .rightContainer .vk-tabs ul.vk-nav li a,
        .rightContainer .vk-toggle .vk-toggle-title:hover,
        .rightContainer .vk-toggle-title.ui-state-active:hover,
        .rightContainer .vk-toggle .ui-state-active {
            color: <?php echo $content_text_alt; ?>;
        }

        /*----------------------------------------------------------------------------*/
        /*  content alt line color
        /*----------------------------------------------------------------------------*/
        .rightContainer .entry_meta section {
            border-color: <?php echo $content_line_alt; ?>;
        }

        /*----------------------------------------------------------------------------*/
        /*  content layout
        /*----------------------------------------------------------------------------*/
        .rightContainer .rightPadding {
            margin: <?php echo $content_window_padding; ?>px;
        }
        @media screen and (min-width: 700px) {
            .conCenter .rightContainer .rightPadding {
                margin-left: <?php echo ($content_window_padding + $content_gutter); ?>px;
            }
        }
        .rightContainer .col1,
        .rightContainer .col2,
        .rightContainer .col3 {
            padding-bottom: <?php echo $content_gutter; ?>px;
        }
        @media screen and (min-width: 700px) {
            
            /* with right gutter */
            .rightContainer .col1,
            .rightContainer .col2,
            .rightContainer .col3 {
                padding: 0 <?php echo $content_gutter; ?>px <?php echo $content_gutter; ?>px 0;
            }

            /* without right gutter */
            .sidebarOff .col2.single {
                padding-right: 0px;
            }
            .sidebarOff .col2 .postWrap {
                padding-right: 0px;
            }
            .conCenter .rightContainer .rightPadding.sidebarOff {
                margin-left: <?php echo ($content_window_padding); ?>px;
            }

        }
        .rightContainer .floatFixed {
            top: <?php echo $content_gutter_single; ?>px;
        }
        .rightContainer .col2.single .contentBlock,
        .rightContainer .col1.postSidebar .widget {
            margin-bottom: <?php echo $content_gutter_single; ?>px;
        }
        .similarPadding {
            padding-right: <?php echo $content_gutter_single; ?>px;
        }

        <?php if($content_radius!='0') { ?>
        .rightContainer .contentBlock {
            overflow: hidden !important;
        }
        <?php } ?>
        .rightContainer #headerNav ul li ul,
        .rightContainer .contentBlock,
        input[type="text"],
        input[type="password"],
        input[type="email"],
        textarea {
        -webkit-border-radius: <?php echo $content_radius;?>px;
         -khtml-border-radius: <?php echo $content_radius;?>px;
           -moz-border-radius: <?php echo $content_radius;?>px;
            -ms-border-radius: <?php echo $content_radius;?>px;
             -o-border-radius: <?php echo $content_radius;?>px;
                border-radius: <?php echo $content_radius;?>px;
        }

        .vk_layout_padding_media_1 .nContent .entry_media {
            margin: <?php echo $content_padding; ?>px;
        }
        .vk_layout_padding_media_1 .wContent .entry_media {
            margin: <?php echo $content_padding; ?>px <?php echo $content_padding; ?>px 0 <?php echo $content_padding; ?>px;
        }
        .vk_layout_padding_media_1 .similarContainer .entry_media {
            margin: <?php echo $content_padding; ?>px;
        }
        .vk_layout_padding_content_1 .entry_content {
            padding: <?php echo $content_padding; ?>px;
        }
        .vk_layout_padding_content_ .entry_content {
            padding: <?php echo $content_padding; ?>px 0 <?php echo $content_padding; ?>px 0;
        }
        .vk_layout_padding_accent_1 .entry_meta {
            padding: 0 <?php echo $content_padding; ?>px;
        }


        /*----------------------------------------------------------------------------*/
        /*  media player
        /*----------------------------------------------------------------------------*/

        body .mejs-container .mejs-controls {
            background: <?php echo $media_line; ?>;
        }
        body .mejs-container .mejs-controls {
            border-bottom-color: <?php echo $media_line; ?>;
        }
        body .mejs-container .mejs-controls div, body .mejs-container .mejs-controls .mejs-time {
            background: <?php echo $media_bg; ?>;
        }
        body .mejs-controls div.mejs-time-rail .mejs-time-total {
            background: <?php echo $media_timeline; ?>
        }
        body .mejs-controls div.mejs-time-rail .mejs-time-loaded {
            background: <?php echo $media_loading; ?>;
        }
        body .mejs-controls div.mejs-time-rail .mejs-time-current {
            background: <?php echo $media_current; ?>;
        }
        body .mejs-controls div.mejs-horizontal-volume-slider .mejs-horizontal-volume-total {
            background: <?php echo $media_timeline; ?>
        }
        body .mejs-controls div.mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
            background: <?php echo $media_current; ?>;
        }
        body .mejs-video .mejs-controls div.mejs-volume-slider .mejs-volume-handle {
            background: <?php echo $media_current; ?>;
        }
        body .mejs-overlay-button {
            border-color: <?php echo $media_overlay; ?>;
        }
        body .mejs-overlay-button:after {
            color: <?php echo $media_overlay; ?> !important;
        }

        /*----------------------------------------------------------------------------*/
        /*  landing page
        /*----------------------------------------------------------------------------*/
        
        .landingWrapper {
            color: <?php echo $landing_text_color; ?>;
        }
        .landingBackground {
            background-color: <?php echo $landing_background_color; ?>;
            background-image: url(<?php echo $landing_background_image; ?>);
            background-repeat: <?php echo $landing_background_repeat; ?>;
            background-position: <?php echo $landing_background_position_x; ?> top;
            opacity: <?php echo $landing_background_opacity; ?>;
        }

        /*----------------------------------------------------------------------------*/
        /*  buttons
        /*----------------------------------------------------------------------------*/

        <?php if($button_font!='default') { ?>
        input[type="submit"],
        input[type="reset"],
        input[type="button"],
        .button,
        a.button,
        .page-numbers {
            font-family: '<?php echo $button_font; ?>';
        }
        <?php } ?>

        input[type="submit"],
        input[type="reset"],
        input[type="button"],
        .button,
        a.button,
        .iconWrap,
        .page-numbers {
            font-size: <?php echo $button_size; ?>px;
            letter-spacing: <?php echo $button_space; ?>px;
            -webkit-border-radius: <?php echo $button_radius; ?>px;
             -khtml-border-radius: <?php echo $button_radius; ?>px;
               -moz-border-radius: <?php echo $button_radius; ?>px;
                -ms-border-radius: <?php echo $button_radius; ?>px;
                 -o-border-radius: <?php echo $button_radius; ?>px;
                    border-radius: <?php echo $button_radius; ?>px;
        }
        .widget ul li a {
            -webkit-border-radius: <?php echo $button_radius; ?>px;
             -khtml-border-radius: <?php echo $button_radius; ?>px;
               -moz-border-radius: <?php echo $button_radius; ?>px;
                -ms-border-radius: <?php echo $button_radius; ?>px;
                 -o-border-radius: <?php echo $button_radius; ?>px;
                    border-radius: <?php echo $button_radius; ?>px;
        }
 
        /*----------------------------------------------------------------------------*/
        /*  general settings
        /*----------------------------------------------------------------------------*/

        /* Settings (Copyright) */
        .copyright, .copyright p { color: <?php echo $copy_color; ?>; }

        /*-----------------------------------------------------------------------------------*/
        /*  Custom CSS
        /*-----------------------------------------------------------------------------------*/

        <?php echo get_option('vk_tools_css'); ?>

        </style><?php

        // create output string string
        $customcss = ob_get_contents();

        // end object
        ob_end_clean();

        // remove css comments
        $output = preg_replace('#/\*.*?\*/#s', '', $customcss);

        // remove css whitespace
        $output = preg_replace('/\s*([{}|:;,])\s+/', '$1', $output);

        // remove css starting whitespace
        $output = preg_replace('/\s\s+(.*)/', '$1', $output);

        // compressed
        echo $output;

        // the rest of the compression is handled in the footer.php where the entire page gets squished

    } // END vk_header_style function

} // END if functions exists


/*-----------------------------------------------------------------------------------*/
/*
/*  Run the live preview javascript
/*
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'vk_live_preview' ) ) {

    function vk_live_preview() {

        global $preview_vars;

        wp_enqueue_script( 'theme-customize-preview', VK_DIRECTORY . '/theme/customizer/theme-customize-preview.js', array( 'jquery','customize-preview' ), '', true );

        wp_localize_script( 'theme-customize-preview', 'database', $preview_vars );

        
    }

}

/*-----------------------------------------------------------------------------------*/
/*
/*  Do everything and make the magic happen
/*
/*-----------------------------------------------------------------------------------*/

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , 'vk_register' );

// Output custom CSS to live site
add_action( 'wp_head' , 'vk_header_style' );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , 'vk_live_preview' );

?>