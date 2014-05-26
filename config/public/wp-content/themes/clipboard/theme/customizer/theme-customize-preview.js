/**
 * This file handles the live preview of the theme customizer
 */
( function( $ ) {

    var p = 'vk_';

/*----------------------------------*/
/*  Logo
/*----------------------------------*/
    
    var name = database.blog_name;

    // CORE site title
    wp.customize( 'blogname', function( value ) {
        value.bind( function( newval ) {
            $('.logo h3 a').html( newval );
            name = newval;
        } );
    } );

    // logo type
    wp.customize(p+'logo_type', function( value ) {
        value.bind( function( newval ) {
            if(newval=='logoText') {
                $('body').removeClass('logoImage').addClass('logoText');
            } else {
                $('body').removeClass('logoText').addClass('logoImage');
            }
        } );
    } );

    // logo font family
    wp.customize(p+'logo_font', function( value ) {
        value.bind( function( newval ) {
            var friendly = newval.replace(/\s/g, '+');
            if(newval=='default'){
                $('.logo h3 a').css('font-family', 'inherit');
            } else {
                $('head').append('<style type="text/css">@import url(http://fonts.googleapis.com/css?family='+friendly+');</style>');
                $('.logo h3 a').css('font-family', newval);
            }
        } );
    } );

    // logo bold
    wp.customize(p+'logo_bold', function( value ) {
        value.bind( function( newval ) {
            if(newval==1) {
                $('body').removeClass('vk_logo_bold_').addClass('vk_logo_bold_1');
            } else {
                $('body').removeClass('vk_logo_bold_1').addClass('vk_logo_bold_');
            }
        } );
    } );

    // logo uppercase
    wp.customize(p+'logo_uppercase', function( value ) {
        value.bind( function( newval ) {
            if(newval==1) {
                $('body').removeClass('vk_logo_uppercase_').addClass('vk_logo_uppercase_1');
            } else {
                $('body').removeClass('vk_logo_uppercase_1').addClass('vk_logo_uppercase_');
            }
        } );
    } );

    // logo italic
    wp.customize(p+'logo_italic', function( value ) {
        value.bind( function( newval ) {
            if(newval==1) {
                $('body').removeClass('vk_logo_italic_').addClass('vk_logo_italic_1');
            } else {
                $('body').removeClass('vk_logo_italic_1').addClass('vk_logo_italic_');
            }
        } );
    } );

    // logo font size
    wp.customize(p+'logo_font_size', function( value ) {
        value.bind( function( newval ) {
            $('.logo h3 a').css('font-size', newval+'px');
        } );
    } );

    // logo lineheight
    wp.customize(p+'logo_lineheight', function( value ) {
        value.bind( function( newval ) {
            $('.logo h3 a').css('line-height',newval);
        } );
    } );

    // logo spacing
    wp.customize(p+'logo_spacing', function( value ) {
        value.bind( function( newval ) {
            $('.logo h3 a').css('letter-spacing',newval+'px');
        } );
    } );

    // logo color
    wp.customize(p+'logo_color', function( value ) {
        value.bind( function( newval ) {
            $('.logo h3 a').css('color',newval);
        } );
    } );

    // logo background color
    wp.customize(p+'logo_background', function( value ) {
        value.bind( function( newval ) {

            // if empty
            if(newval==false) {
                $('.logo h3 a').css('background','none');
                $('.logo h3 a').css('box-shadow','none');
            } else {
                $('.logo h3 a').css('background',newval);
                $('.logo h3 a').css('box-shadow','-5px 0 0 '+newval+', 5px 0 0 '+newval);
            }

        } );
    } );

    // logo image
    wp.customize(p+'logo_image', function( value ) {
        value.bind( function( newval ) {

            // If image was just uploaded
            if(newval!='') {
                $('.logo div.image a img.x1').remove();
                $('.logo div.image a').prepend('<img class="x1" src="'+newval+'"/>');
            } else {
                $('.logo div.image a img.x1').remove();
            }

        } );
    } );

    // logo image retina
    // hard refresh

    // logo position
    wp.customize(p+'logo_position', function( value ) {
        value.bind( function( newval ) {
            if(newval=='logoSidebar') {
                $('body').removeClass('logoHeader').addClass('logoSidebar');
            } else {
                $('body').removeClass('logoSidebar').addClass('logoHeader');
            }
        } );
    } );

    // logo position
    wp.customize(p+'logo_alignment', function( value ) {
        value.bind( function( newval ) {
            
            if(newval=='logoLeft') {
                $('body').removeClass('logoLeft logoCenter logoRight');
                $('body').addClass('logoLeft');

            } else if(newval=='logoCenter') {
                $('body').removeClass('logoLeft logoCenter logoRight');
                $('body').addClass('logoCenter');

            } else if(newval=='logoRight') {
                $('body').removeClass('logoLeft logoCenter logoRight');
                $('body').addClass('logoRight');
            
            }


        } );
    } );

    // margin top
    wp.customize(p+'logo_margin_top', function( value ) {
        value.bind( function( newval ) {
            $('.rightHeader').css('margin-top',newval+'px');
        } );
    } );

    // margin bottom
    wp.customize(p+'logo_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $('.rightHeader').css('margin-bottom',newval+'px');
        } );
    } );




/*----------------------------------*/
/*  Tagline
/*----------------------------------*/
    
    var tagline = database.blog_tagline;

    // CORE tagline
    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( newval ) {
            $('.tagline h3 span').html( newval );
            tagline = newval;
        } );
    } );

    // tagline inlucde
    wp.customize(p+'tagline', function( value ) {
        value.bind( function( newval ) {
            if(newval==1) {
                $('body').removeClass('vk_tagline_').addClass('vk_tagline_1');
            } else {
                $('body').removeClass('vk_tagline_1').addClass('vk_tagline_');
            }
        } );
    } );

    // tagline font
    wp.customize(p+'tagline_font', function( value ) {
        value.bind( function( newval ) {
            var friendly = newval.replace(/\s/g, '+');
            if(newval=='default'){
                $('.tagline h3').css('font-family', 'inherit');
            } else {
                $('head').append('<style type="text/css">@import url(http://fonts.googleapis.com/css?family='+friendly+');</style>');
                $('.tagline h3').css('font-family', newval);
            }
        } );
    } );

    // tagline bold
    wp.customize(p+'tagline_bold', function( value ) {
        value.bind( function( newval ) {
            if(newval==1) {
                $('body').removeClass('vk_tagline_bold_').addClass('vk_tagline_bold_1');
            } else {
                $('body').removeClass('vk_tagline_bold_1').addClass('vk_tagline_bold_');
            }
        } );
    } );

    // tagline uppercase
    wp.customize(p+'tagline_uppercase', function( value ) {
        value.bind( function( newval ) {
            if(newval==1) {
                $('body').removeClass('vk_tagline_uppercase_').addClass('vk_tagline_uppercase_1');
            } else {
                $('body').removeClass('vk_tagline_uppercase_1').addClass('vk_tagline_uppercase_');
            }
        } );
    } );

    // tagline uppercase
    wp.customize(p+'tagline_italic', function( value ) {
        value.bind( function( newval ) {
            if(newval==1) {
                $('body').removeClass('vk_tagline_italic_').addClass('vk_tagline_italic_1');
            } else {
                $('body').removeClass('vk_tagline_italic_1').addClass('vk_tagline_italic_');
            }
        } );
    } );

    // tagline font size
    wp.customize(p+'tagline_font_size', function( value ) {
        value.bind( function( newval ) {
            $('.tagline h3').css('font-size', newval+'px');
        } );
    } );

    // tagline lineheight
    wp.customize(p+'tagline_lineheight', function( value ) {
        value.bind( function( newval ) {
            $('.tagline h3').css('line-height',newval);
        } );
    } );

    // tagline spacing
    wp.customize(p+'tagline_spacing', function( value ) {
        value.bind( function( newval ) {
            $('.tagline h3').css('letter-spacing',newval+'px');
        } );
    } );

    // tagline color
    wp.customize(p+'tagline_color', function( value ) {
        value.bind( function( newval ) {
            $('.tagline h3').css('color',newval);
        } );
    } );

    // tagline background color
    wp.customize(p+'tagline_background', function( value ) {
        value.bind( function( newval ) {

            // if empty
            if(newval==false) {
                $('.tagline h3 span').css('background','none');
                $('.tagline h3 span').css('box-shadow','none');
            } else {
                $('.tagline h3 span').css('background',newval);
                $('.tagline h3 span').css('box-shadow','-5px 0 0 '+newval+', 5px 0 0 '+newval);
            }

        } );
    } );

    // margin top
    wp.customize(p+'tagline_margin', function( value ) {
        value.bind( function( newval ) {
            $('.tagline').css('margin-top',newval+'px');
            console.log('change');
        } );
    } );


/*----------------------------------*/
/*  Menu
/*----------------------------------*/

    // menu position
    wp.customize(p+'menu_position', function( value ) {
        value.bind( function( newval ) {
            if(newval=='menuSidebar') {
                $('body').removeClass('menuHeader').addClass('menuSidebar');
            } else {
                $('body').removeClass('menuSidebar').addClass('menuHeader');
            }
        } );
    } );

    // sidebar menu style
    // hard refresh

    // logo bold
    wp.customize(p+'menu_bold', function( value ) {
        value.bind( function( newval ) {
            if(newval==1) {
                $('body').removeClass('vk_menu_bold_').addClass('vk_menu_bold_1');
            } else {
                $('body').removeClass('vk_menu_bold_1').addClass('vk_menu_bold_');
            }
        } );
    } );

    // logo uppercase
    wp.customize(p+'menu_uppercase', function( value ) {
        value.bind( function( newval ) {
            if(newval==1) {
                $('body').removeClass('vk_menu_uppercase_').addClass('vk_menu_uppercase_1');
            } else {
                $('body').removeClass('vk_menu_uppercase_1').addClass('vk_menu_uppercase_');
            }
        } );
    } );

    // logo italic
    wp.customize(p+'menu_italic', function( value ) {
        value.bind( function( newval ) {
            if(newval==1) {
                $('body').removeClass('vk_menu_italic_').addClass('vk_menu_italic_1');
            } else {
                $('body').removeClass('vk_menu_italic_1').addClass('vk_menu_italic_');
            }
        } );
    } );

    // menu margin top
    wp.customize(p+'menu_margin_top', function( value ) {
        value.bind( function( newval ) {
            $('.rightHeader #headerNav').css('margin-top',newval+'px');
        } );
    } );

    // menu color
    wp.customize(p+'menu_color', function( value ) {
        value.bind( function( newval ) {
            $('.rightHeader #headerNav > ul > li > a').css('color',newval);
        } );
    } );

    // menu sub color
    wp.customize(p+'menu_color_sub', function( value ) {
        value.bind( function( newval ) {
            $('.rightHeader #headerNav ul li ul li a').css('color',newval);
        } );
    } );

    // menu sub color
    wp.customize(p+'menu_color_sub_background', function( value ) {
        value.bind( function( newval ) {
            $('.rightHeader #headerNav ul li ul').css('background-color',newval);
        } );
    } );


/*----------------------------------*/
/*  Sidebar
/*----------------------------------*/

    // menu position
    wp.customize(p+'sidebar_function', function( value ) {
        value.bind( function( newval ) {
            if(newval=='leftSidebarOn') {
                $('#globalWrap').removeClass('leftSidebarOn leftSidebarSlide leftSidebarOff');
                $('#globalWrap').addClass('leftSidebarOn');
            } else if(newval=='leftSidebarSlide') {
                $('#globalWrap').removeClass('leftSidebarOn leftSidebarSlide leftSidebarOff');
                $('#globalWrap').addClass('leftSidebarSlide');
            } else if(newval=='leftSidebarOff') {
                $('#globalWrap').removeClass('leftSidebarOn leftSidebarSlide leftSidebarOff');
                $('#globalWrap').addClass('leftSidebarOff');
            }

            isotopeFire();

        } );
    } );

    // slide button color
    wp.customize(p+'sidebar_slide_button', function( value ) {
        value.bind( function( newval ) {
            $('#slideButton').css('color',newval);
        } );
    } );

    // sidebar background
    wp.customize(p+'sidebar_background', function( value ) {
        value.bind( function( newval ) {
            $('.leftContainer, #mobileNav').css('background-color',newval);
        } );
    } );

    // sidebar background accent
    wp.customize(p+'sidebar_background_accent', function( value ) {
        value.bind( function( newval ) {
            $('.leftContainer .widget ul li a, .leftContainer input[type="text"], .leftContainer input[type="password"], .leftContainer input[type="email"], .leftContainer textarea, #mobileNav .mobileMenu ul li a').css('background-color',newval);
            $('.leftContainer #mainNav ul li ul').css('border-color',newval);
        } );
    } );

    // sidebar text color
    wp.customize(p+'sidebar_text', function( value ) {
        value.bind( function( newval ) {
            $('.leftContainer, .leftContainer #mainNav a, .leftContainer .widget ul li a, .leftContainer input[type="text"], .leftContainer input[type="password"], .leftContainer input[type="email"], .leftContainer textarea, #mobileNav, #mobileNav .mobileMenu ul li a').css('color',newval);
        } );
    } );

    // sidebar link color
    wp.customize(p+'sidebar_link', function( value ) {
        value.bind( function( newval ) {
            $('.leftContainer a:not( #mainLogo a, .widget li a, a.button, #mainNav a), .leftContainer div.twitter li a').css('color',newval);
        } );
    } );

    // sidebar line color
    wp.customize(p+'sidebar_lines', function( value ) {
        value.bind( function( newval ) {
            $('.leftContainer .mainBox').css('border-color',newval);
            $('.leftContainer #wp-calendar thead').css('border-top','1px solid '+newval);
            $('.leftContainer #wp-calendar thead, .leftContainer #wp-calendar tbody').css('border-left','1px solid '+newval);
            $('.leftContainer #wp-calendar thead th, .leftContainer #wp-calendar tbody td').css('box-shadow','inset -1px -1px 0px '+newval);
        } );
    } );

    // sidebar button color
    wp.customize(p+'sidebar_button', function( value ) {
        value.bind( function( newval ) {
            $('.leftContainer a.button, .leftContainer a.visual-button').not('.social-widget a').css('background-color',newval);
        } );
    } );

    // sidebar button text
    wp.customize(p+'sidebar_button_text', function( value ) {
        value.bind( function( newval ) {
            $('.leftContainer a.button, .leftContainer a.visual-button').css('color',newval);
        } );
    } );

    // sidebar padding switch
    var sidebar_padding_switch = database.sidebar_padding_switch;
    wp.customize(p+'sidebar_padding_switch', function( value ) {
        value.bind( function( newval ) {
            sidebar_padding_switch = newval;
        } );
    } );

    // sidebar padding left
    wp.customize(p+'sidebar_padding_left', function( value ) {
        value.bind( function( newval ) {

            // basic padding
            if(sidebar_padding_switch==1){
                $('.leftContainer .leftContent').css('padding-left',newval+'px');
                
            // advanced padding
            } else {
                $('.leftContainer .leftContent').css('padding',newval+'px');

            }

        } );
    } );

    // sidebar padding top
    wp.customize(p+'sidebar_padding_top', function( value ) {
        value.bind( function( newval ) {
            $('.leftContainer .leftContent').css('padding-top',newval+'px');
        } );
    } );

    // sidebar padding right
    wp.customize(p+'sidebar_padding_right', function( value ) {
        value.bind( function( newval ) {
            $('.leftContainer .leftContent').css('padding-right',newval+'px');
        } );
    } );

    // sidebar padding bottom
    wp.customize(p+'sidebar_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $('.leftContainer .leftContent').css('padding-bottom',newval+'px');
        } );
    } );

    // sidebar item gutter
    wp.customize(p+'sidebar_item_gutter', function( value ) {
        value.bind( function( newval ) {
            $('.leftContainer .mainBox').css('padding-top',(newval/2)+'px');
            $('.leftContainer .mainBox').css('padding-bottom',(newval/2)+'px');
        } );
    } );

    // sidebar shadow
    wp.customize(p+'sidebar_shadow', function( value ) {
        value.bind( function( newval ) {

            if(newval=='sideShad0') {
                $('body').removeClass('sideShad0 sideShad1 sideShad2 sideShad3 sideShad4 sideShad5 sideShad6');
                $('body').addClass('sideShad0');

            } else if(newval=='sideShad1') {
                $('body').removeClass('sideShad0 sideShad1 sideShad2 sideShad3 sideShad4 sideShad5 sideShad6');
                $('body').addClass('sideShad1');

            } else if(newval=='sideShad2') {
                $('body').removeClass('sideShad0 sideShad1 sideShad2 sideShad3 sideShad4 sideShad5 sideShad6');
                $('body').addClass('sideShad2');

            } else if(newval=='sideShad3') {
                $('body').removeClass('sideShad0 sideShad1 sideShad2 sideShad3 sideShad4 sideShad5 sideShad6');
                $('body').addClass('sideShad3');

            } else if(newval=='sideShad4') {
                $('body').removeClass('sideShad0 sideShad1 sideShad2 sideShad3 sideShad4 sideShad5 sideShad6');
                $('body').addClass('sideShad4');

            } else if(newval=='sideShad5') {
                $('body').removeClass('sideShad0 sideShad1 sideShad2 sideShad3 sideShad4 sideShad5 sideShad6');
                $('body').addClass('sideShad5');

            } else if(newval=='sideShad6') {
                $('body').removeClass('sideShad0 sideShad1 sideShad2 sideShad3 sideShad4 sideShad5 sideShad6');
                $('body').addClass('sideShad6');

            }

        } );
    } );

/*----------------------------------*/
/*  Content
/*----------------------------------*/

    // content background color
    wp.customize(p+'content_background', function( value ) {
        value.bind( function( newval ) {
            $('.rightContainer .contentBlock, .rightContainer .vk-chat-sc, .rightContainer .vk-tabs .vk-tab, .rightContainer .vk-toggle .vk-toggle-title, .rightContainer .vk-toggle-inner').css('background-color',newval);
        } );
    } );

    // content background accent
    wp.customize(p+'content_background_accent', function( value ) {
        value.bind( function( newval ) {
            $('.rightContainer .widget ul li a, .rightContainer input[type="text"], .rightContainer input[type="password"], .rightContainer input[type="email"], .rightContainer textarea, .rightContainer a.accentButton, .rightContainer a.button.accentButton, .rightContainer .accentButton').css('background-color',newval);
        } );
    } );

    // content text color
    wp.customize(p+'content_text', function( value ) {
        value.bind( function( newval ) {
            $('.rightContainer .chat-row,.rightContainer .entry_content,.rightContainer .entry_content h1,.rightContainer .entry_content h2,.rightContainer .entry_content h3,.rightContainer .entry_content h4,.rightContainer .entry_content h5,.rightContainer .entry_content h6,.rightContainer .entry_content p,.rightContainer .entry_title h1,.rightContainer .entry_title h2 a,.rightContainer #globalWrap .mejs-container .mejs-controls .mejs-time span,.rightContainer #globalWrap .mejs-controls .mejs-button:before,.rightContainer #globalWrap .mejs-controls .mejs-button,.rightContainer .featureWrap a,.rightContainer input[type="text"],.rightContainer input[type="password"],.rightContainer input[type="email"],.rightContainer textarea,.rightContainer .widget ul li a,.rightContainer div.counterWrap h6 a,.rightContainer a.accentButton,.rightContainer a.button.accentButton,.rightContainer .accentButton').css('color',newval);
        } );
    } );

    // content link color
    wp.customize(p+'content_link', function( value ) {
        value.bind( function( newval ) {
            $('.rightContainer a:not( .entry_meta a, .entry_title a, a.page-numbers, .rightHeader a, .widget li a, a.button), .rightContent div.twitter li a').css('color',newval);
        } );
    } );

    // content line color
    wp.customize(p+'content_lines', function( value ) {
        value.bind( function( newval ) {
            $('.rightContainer .chat-transcript,.rightContainer .comment_wrap .comment,.rightContainer .widget .mejs-container,.rightContainer .entry_copy table,.rightContainer .comment.text table,.rightContainer .entry_copy th,.rightContainer .comment.text th,.rightContainer .entry_copy tr,.rightContainer .comment.text tr,.rightContainer .entry_copy td,.rightContainer .comment.text td,.rightContainer .entry_title h1,.rightContainer .entry_title h2').css('border-color',newval);
            $('.rightContainer #wp-calendar thead').css('border-top','1px solid '+newval);
            $('.rightContainer #wp-calendar thead,.rightContainer #wp-calendar tbody').css('border-left','1px solid '+newval);
            $('.rightContainer .chat-row').css('border-bottom','1px solid '+newval);
            $('.rightContainer #wp-calendar thead th,.rightContainer #wp-calendar tbody td').css('box-shadow','inset -1px -1px 0px '+newval);
        } );
    } );

    // content button color
    wp.customize(p+'content_button', function( value ) {
        value.bind( function( newval ) {
            $('.similarTitle a,.rightContainer .entry_media .entry_hover .iconWrap,.rightContainer .pageWrap a,.rightContainer .pageWrap.standard span,.rightContainer .commentBubble,.rightContainer .postLabel,.rightContainer #globalWrap .mejs-controls .mejs-time-rail .mejs-time-float,.rightContainer input[type="submit"],.rightContainer input[type="reset"],.rightContainer input[type="button"],.rightContainer .button,.rightContainer a.button,.rightContainer a.visual-button,.rightContainer .comment-author-admin > div > div > .comment_wrap span.name,.rightContainer .bypostauthor > div > div > .comment_wrap span.name,.rightContainer .resultsWrap,.rightContainer .postPages span,.rightContainer .adminNote,.rightContainer .adminNote p').not('.social-widget a').css('background-color',newval);
            $('.rightContainer .sticky').css('border-top','20px solid ',+newval);
            $('.rightContainer .commentBubble span').css('border-right','5px solid '+newval);
            $('.rightContainer .commentBubble span').css('border-top','5px solid '+newval);
            $('.rightContainer #globalWrap .mejs-controls .mejs-time-rail .mejs-time-float-corner').css('border-color',newval+' transparent transparent transparent');
            $('.similarTitle a').css('box-shadow','-2px 0 0 '+newval+', 2px 0 0 '+newval);
        } );
    } );

    // content text color
    wp.customize(p+'content_button_text', function( value ) {
        value.bind( function( newval ) {
            $('.rightContainer .entry_media .entry_hover .iconWrap,.rightContainer .pageWrap a,.rightContainer .pageWrap.standard span,.rightContainer .commentBubble,.rightContainer .postLabel,.rightContainer #globalWrap .mejs-controls .mejs-time-rail .mejs-time-float,.rightContainer input[type="submit"],.rightContainer input[type="reset"],.rightContainer input[type="button"],.rightContainer .button,.rightContainer a.button,.rightContainer a.visual-button,.rightContainer .comment-author-admin > div > div > .comment_wrap span.name,.rightContainer .bypostauthor > div > div > .comment_wrap span.name,.rightContainer .resultsWrap h4,.rightContainer .postPages span,.rightContainer .adminNote,.rightContainer .adminNote p,.similarTitle a').css('color',newval);
            $('.rightContainer .resultsWrap h4 span').css('border-color',newval);
        } );
    } );
    
    // content background alt
    wp.customize(p+'content_background_alt', function( value ) {
        value.bind( function( newval ) {
            $('.rightContainer .comment_wrap .imgwrap a,.rightContainer .entry_meta,.rightContainer .vk-tabs ul.vk-nav li a,.rightContainer .vk-toggle .vk-toggle-title:hover,.rightContainer .vk-toggle-title.ui-state-active:hover,.rightContainer .vk-toggle .ui-state-active,.rightContainer .similarWrap .entry_media').css('background-color',newval);
        } );
    } );

    // content text alt
    wp.customize(p+'content_text_alt', function( value ) {
        value.bind( function( newval ) {
            $('.rightContainer .comment_wrap .imgwrap a,.rightContainer .entry_meta, .rightContainer .entry_meta a,.rightContainer .vk-tabs ul.vk-nav li a,.rightContainer .vk-toggle .vk-toggle-title:hover,.rightContainer .vk-toggle-title.ui-state-active:hover,.rightContainer .vk-toggle .ui-state-active,.rightContainer .similarWrap .entry_media').css('color',newval);
        } );
    } );

    // content line alt
    wp.customize(p+'content_line_alt', function( value ) {
        value.bind( function( newval ) {
            $('.rightContainer .entry_meta section').css('border-color',newval);
        } );
    } );

    // content alignment
    wp.customize(p+'content_alignment', function( value ) {
        value.bind( function( newval ) {
            if(newval=='conCenter'){
                $('body').removeClass('conLeft').addClass('conCenter');
            } else{
                $('body').removeClass('conCenter').addClass('conLeft');
                $('.rightPadding').css('padding-left','');
            }
            isotopeFire();
        } );
    } );

    // content gutter
    var window_padding = database.window_padding;
    var content_gutter = database.content_gutter;

    // content window padding
    wp.customize(p+'content_window_padding', function( value ) {
        value.bind( function( newval ) {

            // update window padding
            window_padding = newval;

            // get sum
            var padding = plus(window_padding,content_gutter);

            // css
            $('.rightContainer .rightPadding').css('margin',newval+'px');
            $('.conCenter .rightContainer .rightPadding').css('margin-left', padding+'px');
            
            // isotope
            isotopeFire();

        } );
    } );

    // content gutter
    wp.customize(p+'content_gutter', function( value ) {
        value.bind( function( newval ) {

            // update content gutter
            content_gutter = newval;

            // get sum
            var padding = plus(window_padding,content_gutter);

            // css
            $('.rightContainer .col1, .rightContainer .col2, .rightContainer .col3').css('padding','0 '+newval+'px '+newval+'px 0');
            $('.conCenter .rightContainer .rightPadding').css('margin-left', padding+'px');

            // isotope
            isotopeFire();

        } );
    } );

    // content gutter single
    wp.customize(p+'content_gutter_single', function( value ) {
        value.bind( function( newval ) {
            $('.rightContainer .floatFixed').css('top',newval+'px');
            $('.rightContainer .col2.single .contentBlock, .rightContainer .col1.postSidebar .widget').css('margin-bottom',newval+'px');
            $('.similarPadding').css('padding-right', newval+'px');
        } );
    } );

    // content radius
    wp.customize(p+'content_radius', function( value ) {
        value.bind( function( newval ) {
            if(newval!='0') {
                $('.rightContainer .contentBlock').css('overflow','hidden');
            } else {
                $('.rightContainer .contentBlock').css('overflow','visible');
            }
            $('.rightContainer #headerNav ul li ul,.rightContainer .contentBlock,input[type="text"],input[type="password"],input[type="email"],textarea').css('border-radius',newval+'px');
        } );
    } );

    // content shadow
    wp.customize(p+'content_shadow', function( value ) {
        value.bind( function( newval ) {

            if(newval=='conShad0') {
                $('body').removeClass('conShad0 conShad1 conShad2 conShad3');
                $('body').addClass('conShad0');

            } else if(newval=='conShad1') {
                $('body').removeClass('conShad0 conShad1 conShad2 conShad3');
                $('body').addClass('conShad1');

            } else if(newval=='conShad2') {
                $('body').removeClass('conShad0 conShad1 conShad2 conShad3');
                $('body').addClass('conShad2');

            } else if(newval=='conShad3') {
                $('body').removeClass('conShad0 conShad1 conShad2 conShad3');
                $('body').addClass('conShad3');

            }

        } );
    } );

    // content padding media
    wp.customize(p+'content_padding_media', function( value ) {
        value.bind( function( newval ) {
            
            if(newval==1){
                $('body').removeClass('vk_layout_padding_media_').addClass('vk_layout_padding_media_1');
            } else {
                $('body').removeClass('vk_layout_padding_media_1').addClass('vk_layout_padding_media_');
            }
            isotopeFire();
        } );
    } );

    // content padding content
    wp.customize(p+'content_padding_content', function( value ) {
        value.bind( function( newval ) {
            
            if(newval==1){
                $('body').removeClass('vk_layout_padding_content_').addClass('vk_layout_padding_content_1');
            } else {
                $('body').removeClass('vk_layout_padding_content_1').addClass('vk_layout_padding_content_');
            }
            isotopeFire();
        } );
    } );

    // content padding accent
    wp.customize(p+'content_padding_accent', function( value ) {
        value.bind( function( newval ) {
            
            if(newval==1){
                $('body').removeClass('vk_layout_padding_accent_').addClass('vk_layout_padding_accent_1');
            } else {
                $('body').removeClass('vk_layout_padding_accent_1').addClass('vk_layout_padding_accent_');
            }
            isotopeFire();
        } );
    } );

    // content padding
    wp.customize(p+'content_padding', function( value ) {
        value.bind( function( newval ) {
        $('.vk_layout_padding_media_1 .nContent .entry_media').css('margin', newval+'px');
        $('.vk_layout_padding_media_1 .wContent .entry_media').css('margin', newval+'px').css('margin-bottom','0px');
        $('.vk_layout_padding_media_1 .similarContainer .entry_media').css('margin', newval+'px');
        $('.vk_layout_padding_content_1 .entry_content').css('padding', newval+'px');
        $('.vk_layout_padding_content_ .entry_content').css('padding', newval+'px 0px '+newval+'px 0');
        $('.vk_layout_padding_accent_1 .entry_meta').css('padding', '0px '+newval+'px');

        isotopeFire();
        } );
    } );


/*----------------------------------*/
/*  Background
/*----------------------------------*/
    
    // get background color
    var background_color =  database.background_color;

    // background color
    wp.customize('background_color', function( value ) {
        value.bind( function( newval ) {
            background_color = newval;
            $('.rightContainer').css('background-color', newval );
        } );
    } );

    // background image stretch
    wp.customize(p+'background_stretch', function( value ) {
        value.bind( function( newval ) {
            if(newval==1) {
                $('body').removeClass('vk_background_stretch_').addClass('vk_background_stretch_1');
            } else {
                $('body').removeClass('vk_background_stretch_1').addClass('vk_background_stretch_');
            }
        } );
    } );

    // background image
    wp.customize('background_image', function( value ) {
        value.bind( function( newval ) {

            if(newval!='') {
                $('.rightContainer').css('background-image', 'url('+newval+')');
                $('.rightContainer').css('background-color','#'+background_color);
            } else{
                $('.rightContainer').css('background-image', 'none');
                $('.rightContainer').css('background-color','#'+background_color);
            }

        } );
    } );

    // background image repeat
    wp.customize('background_repeat', function( value ) {
        value.bind( function( newval ) {
            $('.rightContainer').css('background-repeat', newval);
        } );
    } );

    // background image position x
    wp.customize('background_position_x', function( value ) {
        value.bind( function( newval ) {
            $('.rightContainer').css('background-position-x', newval);
        } );
    } );

    // background image attachment
    wp.customize('background_attachment', function( value ) {
        value.bind( function( newval ) {
            $('.rightContainer').css('background-attachment', newval);
        } );
    } );


/*----------------------------------*/
/*  Media Player
/*----------------------------------*/

    // background color
    wp.customize(p+'media_bg', function( value ) {
        value.bind( function( newval ) {
            $('body .mejs-container .mejs-controls div, body .mejs-container .mejs-controls .mejs-time').css('background',newval);
        } );
    } );

    // line color
    wp.customize(p+'media_line', function( value ) {
        value.bind( function( newval ) {
            $('body .mejs-container .mejs-controls').css('background',newval);
            $('body .mejs-container .mejs-controls').css('border-bottom-color',newval);
        } );
    } );

    // timeline color
    wp.customize(p+'media_timeline', function( value ) {
        value.bind( function( newval ) {
            $('body .mejs-controls div.mejs-horizontal-volume-slider .mejs-horizontal-volume-total, body .mejs-controls div.mejs-time-rail .mejs-time-total ').css('background',newval);
        } );
    } );

    // loading color
    wp.customize(p+'media_loading', function( value ) {
        value.bind( function( newval ) {
            $('body .mejs-controls div.mejs-time-rail .mejs-time-loaded').css('background',newval);
        } );
    } );

    // current color
    wp.customize(p+'media_current', function( value ) {
        value.bind( function( newval ) {
            $('body .mejs-controls div.mejs-time-rail .mejs-time-current, body .mejs-video .mejs-controls div.mejs-volume-slider .mejs-volume-handle, body .mejs-controls div.mejs-horizontal-volume-slider .mejs-horizontal-volume-current').css('background',newval);
        } );
    } );

    // overlay color
    wp.customize(p+'media_overlay', function( value ) {
        value.bind( function( newval ) {
            $('body .mejs-overlay-button').css('border-color',newval);
            $('body .mejs-overlay-button:after').css('color',newval);
        } );
    } );


/*----------------------------------*/
/*  Landing Page
/*----------------------------------*/

    // landing alignment
    wp.customize(p+'landing_alignment', function( value ) {
        value.bind( function( newval ) {
            if(newval=='landingLeft'){
                $('body').removeClass('landingCenter').addClass('landingLeft');
                $('.landingInner').css('margin-top','');
            } else {
                $('body').removeClass('landingLeft').addClass('landingCenter');
                $('.landingCenter .landingInner').css('margin-top', '-'+( $('.landingInner').height() /2)+'px' );
            }
        } );
    } );

    // landing text color
    wp.customize(p+'landing_text_color', function( value ) {
        value.bind( function( newval ) {
            $('.landingWrapper').css('color',newval);
        } );
    } );

    // landing background
    wp.customize(p+'landing_background_color', function( value ) {
        value.bind( function( newval ) {
            $('.landingBackground').css('background-color',newval);
        } );
    } );

    // text shadow
    wp.customize(p+'landing_text_shadow', function( value ) {
        value.bind( function( newval ) {
            if(newval==1){
                $('body').removeClass('vk_landing_text_shadow_').addClass('vk_landing_text_shadow_1');
            } else {
                $('body').removeClass('vk_landing_text_shadow_1').addClass('vk_landing_text_shadow_');
            }
        } );
    } );

    // background stretch
    wp.customize(p+'landing_background_stretch', function( value ) {
        value.bind( function( newval ) {
            if(newval==1){
                $('body').removeClass('vk_landing_background_stretch_').addClass('vk_landing_background_stretch_1');
            } else {
                $('body').removeClass('vk_landing_background_stretch_1').addClass('vk_landing_background_stretch_');
            }
        } );
    } );

    // landing background image
    wp.customize(p+'landing_background_image', function( value ) {
        value.bind( function( newval ) {
            $('.landingBackground').css('background-image','url('+newval+')');
        } );
    } );

    // landing background repeat
    wp.customize(p+'landing_background_repeat', function( value ) {
        value.bind( function( newval ) {
            $('.landingBackground').css('background-repeat',newval);
        } );
    } );

    // landing background position
    wp.customize(p+'landing_background_position_x', function( value ) {
        value.bind( function( newval ) {
            $('.landingBackground').css('background-position',newval+' top');
        } );
    } );

    // landing background opacity
    wp.customize(p+'landing_background_opacity', function( value ) {
        value.bind( function( newval ) {
            $('.landingBackground').css('opacity',newval);
        } );
    } );


/*----------------------------------*/
/*  Typography
/*----------------------------------*/

    // h1 bold
    wp.customize(p+'type_h1_bold', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h1_bold_ vk_h1_bold_1');
            if(newval==1) { $('body').addClass('vk_h1_bold_1'); } else { $('body').addClass('vk_h1_bold_'); }
            isotopeFire();
        } );
    } );

    // h1 uppercase
    wp.customize(p+'type_h1_uppercase', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h1_uppercase_ vk_h1_uppercase_1');
            if(newval==1) { $('body').addClass('vk_h1_uppercase_1'); } else { $('body').addClass('vk_h1_uppercase_'); }
            isotopeFire();
        } );
    } );

    // h1 italic
    wp.customize(p+'type_h1_italic', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h1_italic_ vk_h1_italic_1');
            if(newval==1) { $('body').addClass('vk_h1_italic_1'); } else { $('body').addClass('vk_h1_italic_'); }
            isotopeFire();
        } );
    } );

    // h2 bold
    wp.customize(p+'type_h2_bold', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h2_bold_ vk_h2_bold_1');
            if(newval==1) { $('body').addClass('vk_h2_bold_1'); } else { $('body').addClass('vk_h2_bold_'); }
            isotopeFire();
        } );
    } );

    // h2 uppercase
    wp.customize(p+'type_h2_uppercase', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h2_uppercase_ vk_h2_uppercase_1');
            if(newval==1) { $('body').addClass('vk_h2_uppercase_1'); } else { $('body').addClass('vk_h2_uppercase_'); }
            isotopeFire();
        } );
    } );

    // h2 italic
    wp.customize(p+'type_h2_italic', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h2_italic_ vk_h2_italic_1');
            if(newval==1) { $('body').addClass('vk_h2_italic_1'); } else { $('body').addClass('vk_h2_italic_'); }
            isotopeFire();
        } );
    } );

    // h3 bold
    wp.customize(p+'type_h3_bold', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h3_bold_ vk_h3_bold_1');
            if(newval==1) { $('body').addClass('vk_h3_bold_1'); } else { $('body').addClass('vk_h3_bold_'); }
            isotopeFire();
        } );
    } );

    // h3 uppercase
    wp.customize(p+'type_h3_uppercase', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h3_uppercase_ vk_h3_uppercase_1');
            if(newval==1) { $('body').addClass('vk_h3_uppercase_1'); } else { $('body').addClass('vk_h3_uppercase_'); }
            isotopeFire();
        } );
    } );

    // h3 italic
    wp.customize(p+'type_h3_italic', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h3_italic_ vk_h3_italic_1');
            if(newval==1) { $('body').addClass('vk_h3_italic_1'); } else { $('body').addClass('vk_h3_italic_'); }
            isotopeFire();
        } );
    } );

    // h4 bold
    wp.customize(p+'type_h4_bold', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h4_bold_ vk_h4_bold_1');
            if(newval==1) { $('body').addClass('vk_h4_bold_1'); } else { $('body').addClass('vk_h4_bold_'); }
            isotopeFire();
        } );
    } );

    // h4 uppercase
    wp.customize(p+'type_h4_uppercase', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h4_uppercase_ vk_h4_uppercase_1');
            if(newval==1) { $('body').addClass('vk_h4_uppercase_1'); } else { $('body').addClass('vk_h4_uppercase_'); }
            isotopeFire();
        } );
    } );

    // h4 italic
    wp.customize(p+'type_h4_italic', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h4_italic_ vk_h4_italic_1');
            if(newval==1) { $('body').addClass('vk_h4_italic_1'); } else { $('body').addClass('vk_h4_italic_'); }
            isotopeFire();
        } );
    } );

    // h5 bold
    wp.customize(p+'type_h5_bold', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h5_bold_ vk_h5_bold_1');
            if(newval==1) { $('body').addClass('vk_h5_bold_1'); } else { $('body').addClass('vk_h5_bold_'); }
            isotopeFire();
        } );
    } );

    // h5 uppercase
    wp.customize(p+'type_h5_uppercase', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h5_uppercase_ vk_h5_uppercase_1');
            if(newval==1) { $('body').addClass('vk_h5_uppercase_1'); } else { $('body').addClass('vk_h5_uppercase_'); }
            isotopeFire();
        } );
    } );

    // h5 italic
    wp.customize(p+'type_h5_italic', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h5_italic_ vk_h5_italic_1');
            if(newval==1) { $('body').addClass('vk_h5_italic_1'); } else { $('body').addClass('vk_h5_italic_'); }
            isotopeFire();
        } );
    } );

    // h6 bold
    wp.customize(p+'type_h6_bold', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h6_bold_ vk_h6_bold_1');
            if(newval==1) { $('body').addClass('vk_h6_bold_1'); } else { $('body').addClass('vk_h6_bold_'); }
            isotopeFire();
        } );
    } );

    // h6 uppercase
    wp.customize(p+'type_h6_uppercase', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h6_uppercase_ vk_h6_uppercase_1');
            if(newval==1) { $('body').addClass('vk_h6_uppercase_1'); } else { $('body').addClass('vk_h6_uppercase_'); }
            isotopeFire();
        } );
    } );

    // h6 italic
    wp.customize(p+'type_h6_italic', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_h6_italic_ vk_h6_italic_1');
            if(newval==1) { $('body').addClass('vk_h6_italic_1'); } else { $('body').addClass('vk_h6_italic_'); }
            isotopeFire();
        } );
    } );

    // p bold
    wp.customize(p+'type_p_bold', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_p_bold_ vk_p_bold_1');
            if(newval==1) { $('body').addClass('vk_p_bold_1'); } else { $('body').addClass('vk_p_bold_'); }
            isotopeFire();
        } );
    } );

    // p uppercase
    wp.customize(p+'type_p_uppercase', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_p_uppercase_ vk_p_uppercase_1');
            if(newval==1) { $('body').addClass('vk_p_uppercase_1'); } else { $('body').addClass('vk_p_uppercase_'); }
            isotopeFire();
        } );
    } );

    // p italic
    wp.customize(p+'type_p_italic', function( value ) {
        value.bind( function( newval ) {
            $('body').removeClass('vk_p_italic_ vk_p_italic_1');
            if(newval==1) { $('body').addClass('vk_p_italic_1'); } else { $('body').addClass('vk_p_italic_'); }
            isotopeFire();
        } );
    } );


/*----------------------------------*/
/*  Buttons
/*----------------------------------*/

    // font
    wp.customize(p+'button_font', function( value ) {
        value.bind( function( newval ) {
            var friendly = newval.replace(/\s/g, '+');
            if(newval=='default'){
                $('input[type="submit"], input[type="reset"], input[type="button"], .button, a.button, .page-numbers').css('font-family', 'inherit');
            } else {
                $('head').append('<style type="text/css">@import url(http://fonts.googleapis.com/css?family='+friendly+');</style>');
                $('input[type="submit"], input[type="reset"], input[type="button"], .button, a.button, .page-numbers').css('font-family', newval);
            }
            isotopeFire();
        } );
    } );

    // button bold
    wp.customize(p+'button_bold', function( value ) {
        value.bind( function( newval ) {
            if(newval==1) {
                $('body').removeClass('vk_button_bold_').addClass('vk_button_bold_1');
            } else {
                $('body').removeClass('vk_button_bold_1').addClass('vk_button_bold_');
            }
            isotopeFire();
        } );
    } );

    // button uppercase
    wp.customize(p+'button_uppercase', function( value ) {
        value.bind( function( newval ) {
            if(newval==1) {
                $('body').removeClass('vk_button_uppercase_').addClass('vk_button_uppercase_1');
            } else {
                $('body').removeClass('vk_button_uppercase_1').addClass('vk_button_uppercase_');
            }
            isotopeFire();
        } );
    } );

    // button italic
    wp.customize(p+'button_italic', function( value ) {
        value.bind( function( newval ) {
            if(newval==1) {
                $('body').removeClass('vk_button_italic_').addClass('vk_button_italic_1');
            } else {
                $('body').removeClass('vk_button_italic_1').addClass('vk_button_italic_');
            }
            isotopeFire();
        } );
    } );

    // button size
    wp.customize(p+'button_size', function( value ) {
        value.bind( function( newval ) {
            $('input[type="submit"], input[type="reset"], input[type="button"], .button, a.button, .iconWrap, .page-numbers').css('font-size',newval+'px');
            isotopeFire();
        } );
    } );

    // button spacing
    wp.customize(p+'button_space', function( value ) {
        value.bind( function( newval ) {
            $('input[type="submit"], input[type="reset"], input[type="button"], .button, a.button, .iconWrap, .page-numbers').css('letter-spacing',newval+'px');
            isotopeFire();
        } );
    } );

    // button spacing
    wp.customize(p+'button_radius', function( value ) {
        value.bind( function( newval ) {
            $('input[type="submit"], input[type="reset"], input[type="button"], .button, a.button, .iconWrap, .page-numbers').css('border-radius',newval+'px');
            $('.widget ul li a').css('border-radius',newval+'px');
            isotopeFire();
        } );
    } );


/*----------------------------------*/
/*  General Settings
/*----------------------------------*/

    // read more link style

    // copyright text
    wp.customize(p+'copy_text', function( value ) {
        value.bind( function( newval ) {
            $('.copyright p').text(newval);  
        } );
    } );

    // copyright color
    wp.customize(p+'copy_color', function( value ) {
        value.bind( function( newval ) {
            $('.copyright, .copyright p ').css('color',newval);
        } );
    } );


/*----------------------------------*/
/*  Toos
/*----------------------------------*/
    
    // text highlighter
    wp.customize( 'vk_tools_text', function( value ) {
        value.bind( function( newval ) {
            if(newval=='1') {
                $('body').addClass('vk_tools_text_1').removeClass('vk_tools_text_');
            } else {
                $('body').removeClass('vk_tools_text_1').addClass('vk_tools_text_');
            }
        } );
    } );


/*----------------------------------*/
/*  Functions & PLugins
/*----------------------------------*/

    function isotopeFire() {

        // variables
        container = $('.masonry');

        // center conditions
        if( $('body').hasClass('conCenter') && ( $('.fixedfull').length > 0 || $('.oversize').length > 0 || $('.fixed').length > 0 ) ) {

            // clean up
            $('.rightPadding').css('padding-left','');

            // extend
            $.extend( $.Isotope.prototype, {

                centerMethod : function() {

                    // variables
                    var iWidth = $('.postWrap').outerWidth(); // item width

                    var cWidth = iWidth * this.masonry.cols; // content width

                    var wWidth = $('.masonry').width(); // wrapper width

                    var padding = Math.floor( (wWidth - cWidth) / 2); // padding

                    // add the css
                    $('.rightPadding').css('padding-left',padding);

                }

            });

            // fire isotope
            container.isotope({
                resizeable: false,
                itemSelector : '.postWrap',
                layoutMode : 'masonry',
                animationEngine : 'css',
            });

            // extend isotope
            container.isotope('centerMethod');

        } else {

            // fire isotope
            container.isotope({
                resizeable: false,
                itemSelector : '.postWrap',
                layoutMode : 'masonry',
                animationEngine : 'css',
            });

        }

    }

/*----------------------------------------------------------*/
/*  Simple Sum
/*----------------------------------------------------------*/

    function plus(one, two) {
        sum = parseInt(one) + parseInt(two);
        return sum;
    }

} )( jQuery );