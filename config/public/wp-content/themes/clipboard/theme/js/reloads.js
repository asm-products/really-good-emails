jQuery(document).ready(function($) {

/*-----------------------------------------------------------------------------------*/
/*
/*  Spotify Size Hack - also called in custom.js
/*
/*-----------------------------------------------------------------------------------*/
	
	// spotify players in post entry media
	function spotifyHack() {

		$('.entry_media iframe[src*="embed.spotify.com"]').each( function() {

			var iframe = $(this);

			$(iframe).css('height','80px');

			$(iframe).css('width', $(iframe).parent(1).css('width'));

			$(iframe).attr('src', $(iframe).attr('src'));

		});

	}
	spotifyHack();
    $(window).resize($.debounce(200, function() { spotifyHack(); }));

/*-----------------------------------------------------------------------------------*/
/*
/*	Read More Link
/*
/*-----------------------------------------------------------------------------------*/


	function readmore() {

		if( $('body').hasClass('more-button') ) {

			// variables
			var readmore = $('a.more-link');

			// add class
			readmore.addClass('button medium');

			// each link
			readmore.each(function(){

				// get width of container
				var entryw = $(this).parent().parent().width();

				// container smaller than 400
				if( entryw < 400 ) {

					$(this).addClass('fullwidth');

				// container smaller than 400
				} else {

					$(this).removeClass('fullwidth');

				}

			});

		}

	}
	readmore();
	$(window).load( function() { readmore(); });
    $(window).resize($.debounce(200, function() { readmore(); }));

/*-----------------------------------------------------------------------------------*/
/*
/*	Entry Hovers
/*
/*-----------------------------------------------------------------------------------*/

	// entry_hover set
	$('.entry_hover').css('opacity','0');

	// hover in
	$('.entry_hover').hover(function() {

		$(this).children('.placement').addClass('fadeUpIcon');

		$(this).animate({

			opacity: 1

		},50);

	// hover out
	}, function() {

		$(this).children('.placement').removeClass('fadeUpIcon');

		$(this).animate({

			opacity: 0

		},50);

	});

/*-----------------------------------------------------------------------------------*/
/*
/*	Isotope
/*
/*-----------------------------------------------------------------------------------*/

	function isotopeGo() {

		// variables
		container = $('.masonry');

		// center conditions
		if( $('body').hasClass('conCenter') && ( $('.fixedfull').length > 0 || $('.oversize').length > 0 || $('.fixed').length > 0 ) ) {

			// clean up
			$('.rightContent').css('max-width','');

			// extend
			$.extend( $.Isotope.prototype, {

				centerMethod : function() {

					// variables
					var iWidth = $('.postWrap').outerWidth(); // item width

					var cWidth = iWidth * this.masonry.cols; // content width

					// add the cWidth to body
					$('body').attr('data-cwidth',cWidth);

					// clean up
					$('.rightContent').css('max-width',cWidth+'px');

				}

			});

			// fire isotope
			container.isotope();

			// extend isotope
			container.isotope('centerMethod');

			// fire isotope
			container.isotope({
				resizeable: false,
				itemSelector : '.postWrap',
				layoutMode : 'masonry',
				animationEngine : 'css',
			});

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
	isotopeGo();
    $(document).ready( function() { setTimeout( function() { isotopeGo(); }, 1000); });
    $(window).load( function() { isotopeGo(); });
    $(window).resize(function() { isotopeGo(); });
    $(window).resize($.debounce(300, function() { isotopeGo(); }));


/*-----------------------------------------------------------------------------------*/
/*
/*	Fit Vids
/*
/*-----------------------------------------------------------------------------------*/

	// ie8
	if( $('body').hasClass('ie8') ) {

		$(".entry_media:not(:has(>.selfhosted))").fitVids();

	// standard
	} else {

		$(".entry_media").fitVids();

	}
	
	// in content
	$(".entry_copy").fitVids();

	// fix for self hosted content width
	$('.wp-video').css('width','');

	
	// twitter embedded media resize fix single page
	function twitterMediaFitSingle() {

		$(".format-status .entry_media iframe").removeAttr('height');

	}

	// twitter embedded media resize fix for status
	function twitterMediaFit() {

		$('.format-status .entry_media iframe').each(function(){

			var imedia = $(this).contents().find('.media');

			var iframe = $(this).contents().find('.media iframe');

			var iframeYoutube = $(this).contents().find('.media iframe[src*="youtube.com"]');

			$(imedia).css({
				width: '100%',
				display: 'block',
			});

			$(iframe).css({
				width: '100%',
				display: 'block',
			});

			$(imedia).find('img').css({
				width: '100%',
				maxWidth: '100%',
				maxHeight: '100%',
				height: 'auto',
				display: 'block',
			});

			// embedded youtube videos in embedded tweets
			if( $(iframeYoutube) ) {

				// set the ratio that most youtube videos will use
				var ratio = 0.5635;
				var	width = $(iframe).width();
				var height = width * ratio;
				
				// css
				$(iframeYoutube).css('height',height);

				// if is single page
				if( $('body').hasClass('single-post') || $('body').hasClass('page-template-page-blog1col-php') ) {

					twitterMediaFitSingle();

				}

			}

			isotopeGo();

		});

	}
	twitterMediaFit();
	$(window).load(function(){ twitterMediaFit(); });
	$(window).resize(function() { twitterMediaFit(); });

/*-----------------------------------------------------------------------------------*/
/*
/*	Shortcodes
/*
/*-----------------------------------------------------------------------------------*/

	// tabs
	$(".vk-tabs").tabs();

	/* TOGGLES - We have chosen not to use the jquery toggle function to eliminated responsive height issues. */
	/* Instead we are creating our own toggle like function that simply hides and shows content. */

	// set the default state
	$('.vk-toggle').each( function(){

		// if toggle open
		if($(this).attr('data-id') === 'open') {

			$(this).children('.vk-toggle-inner').show();

		// if toggle closed
		} else {

			$(this).children('.vk-toggle-inner').hide();

		}

	});

	// if a toggle is clicked
	$('.vk-toggle').click( function() {

		// if toggle currently open
		if($(this).attr('data-id') === 'open') {
			
			$(this).attr('data-id','closed');

			$(this).children('.vk-toggle-inner').hide();

		// if toggle currently closed
		} else {

			$(this).attr('data-id','open');

			$(this).children('.vk-toggle-inner').show();

		}

	});

	// message box
	$(".messageBox .closeBox").click( function() {

		$(this).parent('.messageBox').hide();

	});


/*-----------------------------------------------------------------------------------*/
/*
/*	Browser Compatability Scripts
/*
/*-----------------------------------------------------------------------------------*/

	// last children hacks for ie8
	$(".ie8 p:last-child").addClass('last-child');

});