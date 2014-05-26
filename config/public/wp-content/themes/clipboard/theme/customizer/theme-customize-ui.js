jQuery(document).ready(function($) {
/*----------------------------------------------------------------------------*/
/*
/*	UI Groups
/*
/*----------------------------------------------------------------------------*/
	
	var p1 = 'li#customize-control-vk_';
	var p2 = ',li#customize-control-vk_';

	/*----------------------------------------------------------*/
	/*	Logo
	/*----------------------------------------------------------*/
	
	// site title
	group($(
		'li#customize-control-blogname'
	), '','Your Site Title is used for every page followed by the current post that is being viewed. The Site Title is also set in Dashboard > Settings > General.' );
	
	// type
	group($(
		p1+'logo_type'+
		p2+'logo_font'+
		p2+'logo_bold'+
		p2+'logo_uppercase'+
		p2+'logo_italic'+
		p2+'logo_font_size'+
		p2+'logo_spacing'+
		p2+'logo_lineheight'+
		p2+'logo_color'+
		p2+'logo_background'+
		p2+'logo_image'+
		p2+'logo_image_retina'
	));

			// text
			group($(
				p1+'logo_font'+
				p2+'logo_bold'+
				p2+'logo_uppercase'+
				p2+'logo_italic'+
				p2+'logo_font_size'+
				p2+'logo_spacing'+
				p2+'logo_lineheight'+
				p2+'logo_color'+
				p2+'logo_background'
			),'logoText');

			// image
			group($(
				p1+'logo_image'+
				p2+'logo_image_retina'
			),'logoImage','The width & height used for your retina logo will be taken from your regular logo. Therefore your retina logo should be exactly double in width and height.');


	// position
	group($(
		p1+'logo_position'+
		p2+'logo_alignment'+
		p2+'logo_margin_top'+
		p2+'logo_margin_bottom'
	));

			// sidebar
			group($(
				p1+'logo_alignment'
			),'logoSidebar');

			// content header
			group($(
				p1+'logo_margin_top'+
				p2+'logo_margin_bottom'
			),'logoHeader');



	/*----------------------------------------------------------*/
	/*	Tagline
	/*----------------------------------------------------------*/

	group($(
		'li#customize-control-blogdescription'
	),'','It\'s important to set a site tagline even if you are not including it on the page. The tagline is commonly used in places like search engine results and social media links. The Tagline is also set in Dashboard > Settings > General.' );
	group($(
		p1+'tagline'+
		p2+'tagline_font'+
		p2+'tagline_bold'+
		p2+'tagline_uppercase'+
		p2+'tagline_italic'+
		p2+'tagline_font_size'+
		p2+'tagline_spacing'+
		p2+'tagline_lineheight'+
		p2+'tagline_color'+
		p2+'tagline_background'+
		p2+'tagline_margin'
	));
	


	/*----------------------------------------------------------*/
	/*	Main Menu
	/*----------------------------------------------------------*/

	group($(
		'li#customize-control-nav_menu_locations-main_navagation'
	),'','Select the menu you want to use for your main navigation. Menus are created and edited in Dashboard > Appearance > Menus');

	group($(
		p1+'menu_position'+
		p2+'sidebar_menu_style'+
		p2+'menu_bold'+
		p2+'menu_uppercase'+
		p2+'menu_italic'+
		p2+'menu_margin_top'+
		p2+'menu_color'+
		p2+'menu_color_sub'+
		p2+'menu_color_sub_background'
	),'','Select where the main menu will appear. Placing the menu in the content header requires the logo to be placed in the content header also.');

			// sidebar
			group($(
				p1+'sidebar_menu_style'
			),'menuSidebar');
			
			// content header
			group($(
				p1+'menu_bold'+
				p2+'menu_uppercase'+
				p2+'menu_italic'+
				p2+'menu_margin_top'+
				p2+'menu_color'+
				p2+'menu_color_sub'+
				p2+'menu_color_sub_background'
			),'menuHeader');


	/*----------------------------------------------------------*/
	/*	Sidebar
	/*----------------------------------------------------------*/
	
	// function
	group($(
		p1+'sidebar_function'+
		p2+'sidebar_slide_button'
	));

			// slide button
			group($(
				p1+'sidebar_slide_button'
			),'leftSidebarSlide');

	group($(
		p1+'sidebar_background'+
		p2+'sidebar_background_accent'
	));
	group($(
		p1+'sidebar_text'+
		p2+'sidebar_link'+
		p2+'sidebar_lines'
	));
	group($(
		p1+'sidebar_button'+
		p2+'sidebar_button_text'
	));
	group($(
		p1+'sidebar_padding_left'+
		p2+'sidebar_padding_top'+
		p2+'sidebar_padding_right'+
		p2+'sidebar_padding_bottom'+
		p2+'sidebar_padding_switch'
	));
	group($(
		p1+'sidebar_item_gutter'
	),'','The distance between each item in the sidebar (logo, menu, widgets etc).');
	group($(
		p1+'sidebar_shadow'
	));


	/*----------------------------------------------------------*/
	/*	Content
	/*----------------------------------------------------------*/

	group($(
		p1+'content_background'+
		p2+'content_background_accent'
	));
	group($(
		p1+'content_text'+
		p2+'content_link'+
		p2+'content_lines'
	));
	group($(
		p1+'content_button'+
		p2+'content_button_text'
	));
	group($(
		p1+'content_background_alt'+
		p2+'content_text_alt'+
		p2+'content_line_alt'
	),'','The alt colors are primiarly used for the post meta area (the area at the bottom of a post).');
	group($(
		p1+'content_alignment'
	));
	group($(
		p1+'content_window_padding'
	));
	group($(
		p1+'content_gutter'+
		p2+'content_gutter_single'
	),'', 'Gutters are the spacings between each item. \'Post Page\' gutters are the distances between things like comments and post navigation.');
	group($(
		p1+'content_padding_media'+
		p2+'content_padding_content'+
		p2+'content_padding_accent'+
		p2+'content_padding'
	));
	group($(
		p1+'content_radius'
	));
	group($(
		p1+'content_shadow'
	));


	/*----------------------------------------------------------*/
	/*	Background
	/*----------------------------------------------------------*/
		
	group($(
		'li#customize-control-background_color'
	));

	group($(
		p1+'background_stretch'
	));

	group($(
		'li#customize-control-background_image,'+
		'li#customize-control-background_repeat,'+
		'li#customize-control-background_position_x,'+
		'li#customize-control-background_attachment'
	));

	/*----------------------------------------------------------*/
	/*	Layout
	/*----------------------------------------------------------*/

	group($(
		p1+'blog_template'+
		p2+'search_template'
	),'','Masonry template changes are not very noticeable on smaller screens as the changes take place at higher resolutions. \'Masonry Fixed Fullwidth\' is the safest option if you do not have access to a large display.');
	
	group($(
		p1+'pagination'
	),'','if you select standard pagination, you can change the posts per page via dashboard > settings > reading.');

	/*----------------------------------------------------------*/
	/*	Media Player
	/*----------------------------------------------------------*/

	group($(
		p1+'media_bg'+
		p2+'media_line'+
		p2+'media_timeline'+
		p2+'media_loading'+
		p2+'media_current'+
		p2+'media_overlay'
	));


	/*----------------------------------------------------------*/
	/*	Landing Page
	/*----------------------------------------------------------*/

	group($(
		p1+'landing_page'+
		p2+'landing_alignment'+
		p2+'landing_text_color'+
		p2+'landing_background_color'+
		p2+'landing_text_shadow'
	));

	group($(
		p1+'landing_background_stretch'+
		p2+'landing_background_image'+
		p2+'landing_background_repeat'+
		p2+'landing_background_position_x'+
		p2+'landing_background_opacity'
	));



	/*----------------------------------------------------------*/
	/*	Type
	/*----------------------------------------------------------*/

	// fonts
	group($(
		p1+'heading_font'+
		p2+'paragraph_font'+
		p2+'paragraph_spacing'
	));

	// h1
	group($(
		p1+'type_h1_size'+
		p2+'type_h1_line'+
		p2+'type_h1_space'+
		p2+'type_h1_bold'+
		p2+'type_h1_uppercase'+
		p2+'type_h1_italic'+
		p2+'type_h1_font'
	));

	// h2
	group($(
		p1+'type_h2_size'+
		p2+'type_h2_line'+
		p2+'type_h2_space'+
		p2+'type_h2_bold'+
		p2+'type_h2_uppercase'+
		p2+'type_h2_italic'+
		p2+'type_h2_font'
	));

	// h3
	group($(
		p1+'type_h3_size'+
		p2+'type_h3_line'+
		p2+'type_h3_space'+
		p2+'type_h3_bold'+
		p2+'type_h3_uppercase'+
		p2+'type_h3_italic'+
		p2+'type_h3_font'
	));

	// h4
	group($(
		p1+'type_h4_size'+
		p2+'type_h4_line'+
		p2+'type_h4_space'+
		p2+'type_h4_bold'+
		p2+'type_h4_uppercase'+
		p2+'type_h4_italic'+
		p2+'type_h4_font'
	));

	// h5
	group($(
		p1+'type_h5_size'+
		p2+'type_h5_line'+
		p2+'type_h5_space'+
		p2+'type_h5_bold'+
		p2+'type_h5_uppercase'+
		p2+'type_h5_italic'+
		p2+'type_h5_font'
	));

	// h6
	group($(
		p1+'type_h6_size'+
		p2+'type_h6_line'+
		p2+'type_h6_space'+
		p2+'type_h6_bold'+
		p2+'type_h6_uppercase'+
		p2+'type_h6_italic'+
		p2+'type_h6_font'
	));

	// p
	group($(
		p1+'type_p_size'+
		p2+'type_p_line'+
		p2+'type_p_space'+
		p2+'type_p_bold'+
		p2+'type_p_uppercase'+
		p2+'type_p_italic'+
		p2+'type_p_font'
	));


	/*----------------------------------------------------------*/
	/*	Buttons
	/*----------------------------------------------------------*/

	group($(
		p1+'button_font'+
		p2+'button_bold'+
		p2+'button_uppercase'+
		p2+'button_italic'+
		p2+'button_size'+
		p2+'button_space'+
		p2+'button_radius'
	));

	/*----------------------------------------------------------*/
	/*	Post Default Settings
	/*----------------------------------------------------------*/

	group($(
		p1+'default_permalink'+
		p2+'default_lightbox'+
		p2+'default_content'+
		p2+'default_meta'+
		p2+'default_title'+
		p2+'default_social'+
		p2+'default_pagination'+
		p2+'default_author'+
		p2+'default_comments'+
		p2+'default_similar'
	),'','The default settings for posts can be overridden for each individual post. These settings help to make post creation a more streamlined process.');

	group($(
		p1+'default_ql_text'+
		p2+'default_ql_background'
	));

	/*----------------------------------------------------------*/
	/*	General Settings
	/*----------------------------------------------------------*/
	
	group($(
		p1+'blog_content_trim'+
		p2+'blog_read_more'+
		p2+'blog_excerpt_length'
	),'','The "Read More" functionality is not automated and you will need to add the read more tag into each individual post.');

		group($(
			p1+'blog_read_more'
		),'blog-readmore');

		group($(
			p1+'blog_excerpt_length'
		),'blog-excerpt');

	group($(
		p1+'copy_text'+
		p2+'copy_color'
	));


	/*----------------------------------------------------------*/
	/*	Theme Activate
	/*----------------------------------------------------------*/
	group($(
		p1+'theme_activate'
	),'', 'Once you check \'Activate Theme\' click \'Save & Publish\' then refresh this page.');


	/*----------------------------------------------------------*/
	/*	Switches
	/*----------------------------------------------------------*/

	// logo
	select_c('logo_position');
	select_c('logo_type');

	// tagline
	slidedown_c('tagline');
	
	// menu
	select_c('menu_position');

	// sidebar
	select_c('sidebar_function');
	padding_c('sidebar_padding_switch','Sidebar Padding');

	// type
	select_c('type_control');
	fontstyle_c('type_p');
	fontstyle_c('type_h1');
	fontstyle_c('type_h2');
	fontstyle_c('type_h3');
	fontstyle_c('type_h4');
	fontstyle_c('type_h5');
	fontstyle_c('type_h6');

	// settings
	select_c('blog_content_trim');


/*----------------------------------------------------------------------------*/
/*	
/*	YOU SHOULD NOT HAVE TO TOUCH ANYTHING BELOW HERE
/*	ALL FUNCTIONS TO CREATE SWITCHES ARE BELOW
/*	STYLES FOR BELOW SWITCHES ARE KEPT IN /FRAMEWORK/CSS/VK-CUSTOMIZER.CSS
/*
/*----------------------------------------------------------------------------*/
/*
/*	Fontstyle Buttons
/*
/*----------------------------------------------------------------------------*/
	
	// create buttons
	function fontstyle_c(name){

		// get inputs
		var bold = $('#customize-control-vk_'+name+'_bold input');
		var uppercase = $('#customize-control-vk_'+name+'_uppercase input');
		var italic = $('#customize-control-vk_'+name+'_italic input');

		// update labels
		bold.parent().addClass('button').css({
			paddingRight: '4px',
			paddingLeft: '4px',
		});
		uppercase.parent().addClass('button').css({
			paddingRight: '4px',
			paddingLeft: '4px',
		});
		italic.parent().addClass('button').css({
			paddingRight: '4px',
			paddingLeft: '4px',
		});

		// update li
		bold.parent().parent().css({
			clear: 'none',
			width: 'auto',
			marginRight: '3px',
			marginTop: '3px',
		});
		uppercase.parent().parent().css({
			clear: 'none',
			width: 'auto',
			marginRight: '3px',
			marginTop: '3px',			
		});
		italic.parent().parent().css({
			clear: 'none',
			width: 'auto',
			marginRight: '3px',
			marginTop: '3px',			
		});

	}
	
/*----------------------------------------------------------------------------*/
/*
/*	Slidedown Switch
/*
/*----------------------------------------------------------------------------*/
	
	// create slidedown
	function slidedown_c(name){ var ob = $('#customize-control-vk_'+name+' input'); slidedown_s(ob); ob.click( function() { slidedown_s(ob); }); }
	
	// do slidedown
	function slidedown_s(object) {

		// get list items
		var swi = $(object).closest('li');
		var par = swi.attr('id');
		var targets = $(object).closest('div.customizer-group').children(':not(li#'+par+')');

		// add classes
		swi.addClass('slideSwitch');
		swi.parent('').addClass('slide');

		// checked
		if($(object).is(':checked')) {

			// show siblings
			targets.slideDown('fast');

			// add a class to the switch
			swi.removeClass('slideUp').addClass('slideDown');

		// unchecked
		} else {

			// hide siblings
			targets.slideUp('fast');

			// add a class to the switch
			swi.removeClass('slideDown').addClass('slideUp');

		}

	}



/*----------------------------------------------------------------------------*/
/*
/*	Select Switch
/*
/*----------------------------------------------------------------------------*/

	// create select
	function select_c(name){ var ob = $('#customize-control-vk_'+name+' select'); select_s(ob); ob.trigger('change'); ob.change( function() { select_s(ob); }); }
	
	// do select
	function select_s(object) {

		var swi = $(object).closest('li');
		var sibs = swi.siblings(':not(.group-description)');
		var current = $(object).val();

		// add classes
		swi.addClass('selectSwitch');
		swi.parent('').addClass('select');

		// single
		if( $('#'+current).length > 0 ) {

			sibs.slideUp('fast');
			$('#'+current).slideDown('fast');

		// multi
		} else if( $('.'+current).length > 0 ) {

			sibs.slideUp('fast');
			$('.'+current).slideDown('fast');

		} else {

			sibs.slideUp('fast');

		}

	}


/*----------------------------------------------------------------------------*/
/*
/*	Padding Switch
/*
/*----------------------------------------------------------------------------*/

	// create padding
	function padding_c(name, string){ var ob = $('#customize-control-vk_'+name+' input'); padding_s(ob,string); ob.click( function() { padding_s(ob,string); }); }

	// do padding
	function padding_s(object, string) {

		// get list items
		var swi = $(object).closest('li');
		var items = $(object).closest('div.customizer-group').children(':not(.group-description)');

		// add classes
		items.first().addClass('first');
		items.last().addClass('last');
		swi.addClass('padding');

		// get targets
		var targets = items.not('.first, .last');

		// titles
		var title = items.first().children().children('span');
		var title1 = string+' Left';
		var title2 = string+'';

		// checked
		if($(object).is(':checked')) {

			// show siblings
			targets.slideDown('fast');
			title.text(title1);
			swi.removeClass('slideUp').addClass('slideDown');

		// unchecked
		} else {

			// hide siblings
			targets.slideUp('fast');
			title.text(title2);
			swi.removeClass('slideDown').addClass('slideUp');

		}

	}

/*----------------------------------------------------------------------------*/
/*
/*	Group
/*
/*----------------------------------------------------------------------------*/

	// do group
	function group(object, id, description) {

		// if multiple ids return classes
		if (/\s/g.test(id)) {

			object.wrapAll('<div class="'+id+' customizer-group">');

		// if single id return id
		} else {

			object.wrapAll('<div id="'+id+'" class="customizer-group">');

		}

		// description
		if(typeof description != 'undefined') {

			object.parent('.customizer-group').append('<div class="group-description">i<span>'+description+'</span></div>');

		}

	}

	// do group description hover
	$('.group-description').live( 'mouseover',  function() {

		$(this).children('span').addClass('fadeUp').animate({

			opacity: '1',

		}, 200);

	}).live( 'mouseout', function() {

		$(this).children('span').css('opacity','0').removeClass('fadeUp');

	});


	

/*----------------------------------------------------------*/
/*
/*	Create new tool tip area
/*
/*----------------------------------------------------------*/

	var previewDiv = $('#customize-preview');

	$('.wp-full-overlay-header').append('<div id="vk-tools"></div>');

	var vktools = $('#vk-tools');

/*----------------------------------------------------------*/
/*
/*	Create hard refresh button
/*
/*----------------------------------------------------------*/

	function toolsRefresh() {

		// add button
		vktools.append('<a id="tools_refresh" class="button vk-ui-button" href="#" title="Force a page refresh"><span></span></a>');

		// click
		$('#tools_refresh').click(function(e){

			e.preventDefault();

			var input = $("li#customize-control-vk_tools_refresh").children().children('input');

			input.val(Math.random()).keyup();

		});

	}
	toolsRefresh();

/*----------------------------------------------------------*/
/*
/*	Create highlight text button
/*
/*----------------------------------------------------------*/

	function toolsText() {
		
		// add  button
		vktools.append('<a id="tools_text" class="button vk-ui-button" href="#" title="Highlight all heading and paragraph tags">h1</a>');

		// click
		$('#tools_text').click(function(e){

			e.preventDefault();

			var input = $("li#customize-control-vk_tools_text").children().children('input');

			// turn on
			if( input.val() == '0' ) {

				$(this).addClass('vk-active');

				input.val('1').keyup();
				

			// turn off
			} else {

				$(this).removeClass('vk-active');

				input.val('0').keyup();

			}

		});

	}
	toolsText();

/*----------------------------------------------------------*/
/*
/*	Create highlight section button
/*

	function toolsSection() {
		
		// add button
		vktools.append('<a id="tools_section" class="button vk-ui-button" href="#" title="Highlight all area sections">sections</a>');

		// click
		$('#tools_section').click(function(e){

			e.preventDefault();

			var input = $("li#customize-control-vk_tools_section").children().children('input');

			// turn on
			if( input.val() == '0' ) {

				$(this).addClass('vk-active');

				input.val('1').keyup();
				

			// turn off
			} else {

				$(this).removeClass('vk-active');

				input.val('0').keyup();

			}

		});
	
	}
	toolsSection();


/*----------------------------------------------------------*/
/*
/*	Add Custom CSS
/*
/*----------------------------------------------------------*/
	
	function toolsCSS() {
	
		// add button
		vktools.append('<a id="tools_css" class="button vk-ui-button" href="#" title="Adjust your sites custom css">css</a>');

		// add box		
		previewDiv.prepend('<div id="vk-customcss"><form><textarea id="csstextarea"></textarea></form></div>');

		// vars
		var cssWindow = $('#customize-preview #vk-customcss');
		var cssText = $('#customize-preview #vk-customcss form textarea');
		var ogText = $("li#customize-control-vk_tools_css").children().children('textarea');

		// click
		$('#tools_css').click(function(e){

			e.preventDefault();

			// turn off
			if($(this).hasClass('vk-active')) {
				
				$(this).removeClass('vk-active');

				cssWindow.fadeToggle('fast');

				ogText.val(cssText.val()).keyup();

			// turn on
			} else {

				$(this).addClass('vk-active');

				// fade in
				cssWindow.fadeToggle('fast');

				// empty
				cssText.val('');

				// focus
				cssText.focus();

				// fill
				cssText.val(ogText.val());

			}

		});

	}
	toolsCSS();

/*----------------------------------------------------------*/
/*
/*	Add Loading Message
/*
/*----------------------------------------------------------*/
	
	// add box
	previewDiv.prepend('<div id="vk-loading"><p>loading</p></div>');

	loadingDiv = $('#customize-preview #vk-loading');

	// check the dom every second
	setInterval(function(){

		// if 2 iframes are present
		if( previewDiv.children('iframe').length > 1 ) {

			loadingDiv.fadeIn('fast');

		} else {

			loadingDiv.fadeOut('fast');

		}
	
	}, 1000);


/*----------------------------------------------------------*/
/*
/*	Section Dividers
/*
/*----------------------------------------------------------*/

	// disable clicks on dividers
	$('div[id*="accordion-section-divider"]').click(function(e){

		e.preventDefault();

		return false;

	});


/*----------------------------------------------------------*/
/*
/*	Custom CSS Tabs
/*
/*----------------------------------------------------------*/

	HTMLTextAreaElement.prototype.getCaretPosition = function () { //return the caret position of the textarea
	    return this.selectionStart;
	};
	HTMLTextAreaElement.prototype.setCaretPosition = function (position) { //change the caret position of the textarea
	    this.selectionStart = position;
	    this.selectionEnd = position;
	    this.focus();
	};
	HTMLTextAreaElement.prototype.hasSelection = function () { //if the textarea has selection then return true
	    if (this.selectionStart == this.selectionEnd) {
	        return false;
	    } else {
	        return true;
	    }
	};
	HTMLTextAreaElement.prototype.getSelectedText = function () { //return the selection text
	    return this.value.substring(this.selectionStart, this.selectionEnd);
	};
	HTMLTextAreaElement.prototype.setSelection = function (start, end) { //change the selection area of the textarea
	    this.selectionStart = start;
	    this.selectionEnd = end;
	    this.focus();
	};

	var textarea = document.getElementById('csstextarea');

	textarea.onkeydown = function(event) {
	    
	    //support tab on textarea
	    if (event.keyCode == 9) { //tab was pressed
	        var newCaretPosition;
	        newCaretPosition = textarea.getCaretPosition() + "    ".length;
	        textarea.value = textarea.value.substring(0, textarea.getCaretPosition()) + "    " + textarea.value.substring(textarea.getCaretPosition(), textarea.value.length);
	        textarea.setCaretPosition(newCaretPosition);
	        return false;
	    }
	    if(event.keyCode == 8){ //backspace
	        if (textarea.value.substring(textarea.getCaretPosition() - 4, textarea.getCaretPosition()) == "    ") { //it's a tab space
	            var newCaretPosition;
	            newCaretPosition = textarea.getCaretPosition() - 3;
	            textarea.value = textarea.value.substring(0, textarea.getCaretPosition() - 3) + textarea.value.substring(textarea.getCaretPosition(), textarea.value.length);
	            textarea.setCaretPosition(newCaretPosition);
	        }
	    }
	    if(event.keyCode == 37){ //left arrow
	        var newCaretPosition;
	        if (textarea.value.substring(textarea.getCaretPosition() - 4, textarea.getCaretPosition()) == "    ") { //it's a tab space
	            newCaretPosition = textarea.getCaretPosition() - 3;
	            textarea.setCaretPosition(newCaretPosition);
	        }    
	    }
	    if(event.keyCode == 39){ //right arrow
	        var newCaretPosition;
	        if (textarea.value.substring(textarea.getCaretPosition() + 4, textarea.getCaretPosition()) == "    ") { //it's a tab space
	            newCaretPosition = textarea.getCaretPosition() + 3;
	            textarea.setCaretPosition(newCaretPosition);
	        }
	    } 
	}


});