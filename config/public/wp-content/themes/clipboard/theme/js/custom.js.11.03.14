jQuery(document).ready(function($) {

/*-----------------------------------------------------------------------------------*/
/*
/*  Results Wrap
/*
/*-----------------------------------------------------------------------------------*/

	function resultsWrap() {
		
		// if archive & fixedfull
		if( $('.fixedfull .resultsWrap').length > 0 && $('.fixedfull .col1.postWrap').length > 0 ) {

			// variables
			var resultsw = $('.fixedfull .resultsWrap');
			var item = $('.fixedfull .col1.postWrap').first().outerWidth();
			var padding = $('.fixedfull .col1.postWrap').css('padding-right').replace(/[^-\d\.]/g, '');
			var content = $('.fixedfull #content').width();

			// calulations
			var columns = Math.floor( (  content / item ) );
			var newWidth = (item * columns) - padding;

			// css
			resultsw.css('width',newWidth);

		}
	
	}


/*-----------------------------------------------------------------------------------*/
/*
/*  Similar Items
/*
/*-----------------------------------------------------------------------------------*/

	function similarHeight() {

		var width = $('.similarPadding').width();
		$('.similarItem').css('height', width);

	}


/*-----------------------------------------------------------------------------------*/
/*
/*  Mobile Button
/*
/*-----------------------------------------------------------------------------------*/
	
	function mobileButton() {

		// variables
		var mobNav = $('#mobileNav');
		var mobBut = $('.mobileSwitch');

		// click
		mobBut.click(function(){

			// if open
			if( mobNav.hasClass('open') ) {

				mobNav.removeClass('open').addClass('closed');

			// if closed
			} else {

				mobNav.removeClass('closed').addClass('open');

			}

		});
	
	}

/*-----------------------------------------------------------------------------------*/
/*
/*  Slider Button
/*
/*-----------------------------------------------------------------------------------*/

	function slideButton() {
			
		// variables
		var globalWrap = $('#globalWrap');
		var slideBut = $('#slideButton');
		var right = $('.rightContainer');

		// click	
		slideBut.click(function(){

			globalWrap.toggleClass('open');
			slideBut.toggleClass('open');
			right.toggleClass('open');

		});

	}

/*-----------------------------------------------------------------------------------*/
/*
/*  Add .rightContainer min height
/*
/*-----------------------------------------------------------------------------------*/
	
	function containerHeight() {

		$('.rightContainer').css('min-height', $(window).height()+'px' );

	}

/*-----------------------------------------------------------------------------------*/
/*
/*  Spotify Size Hack - also called in reloads.js
/*
/*-----------------------------------------------------------------------------------*/

	// spotify players in widgets
	function spotifyHack2() {

		$('.widget iframe[src*="embed.spotify.com"]').each( function() {

			var iframe = $(this);

			$(iframe).css('height','80px');

			$(iframe).css('width', $(iframe).parent(1).css('width'));

			$(iframe).attr('src', $(iframe).attr('src'));

		});

	}

/*-----------------------------------------------------------------------------------*/
/*
/*  Landing Wrapper
/*
/*-----------------------------------------------------------------------------------*/

	// landing vars
	landing = $('.landingWrapper');
	rcontainer = $('.rightContainer');

	// fix the landing height on resize
	function landingHeight() {

		if( landing.attr('data-landing')==='on') {

			var wHeight3 = $(window).height();

			rcontainer.css('height',wHeight3);

		}

	}

	// if the landing page is activated
    if ( landing.length > 0 && $(window).width() > 700 ) {

    	// css update
		landing.fadeIn();

		// lock scroll position, but retain settings for later
		var scrollPosition = [

			document.body.scrollLeft,

			document.body.scrollTop

		];

		var html = $('html'); // it would make more sense to apply this to body, but IE7 won't have that

		html.data('scroll-position', scrollPosition);

		html.data('previous-overflow', html.css('overflow'));

		html.css('overflow', 'hidden');

		window.scrollTo(scrollPosition[0], scrollPosition[1]);

		// remove landing on class
		setTimeout( function() {
			
			$('.rightContent').animate({opacity: 1, }, 300);
			$('.rightHeader').animate({opacity: 1, }, 300);

			setTimeout( function() {

				$('body').removeClass('landingOn');

			}, 300);

		}, 300);

		// turn the landing page on
		landing.attr('data-landing','on');

		var wHeight2 = $(window).height();

		rcontainer.css('height',wHeight2);

		// update the margins on the landing inner when landing is centered
		$('.landingCenter .landingInner').css('margin-top', '-'+( $('.landingInner').height() /2)+'px' );

		// turn the landing page off
		$('.landingClose a').click( function(){

			// fade and animate the content out
			$('.landingWrapper').fadeOut('slow', function(){

				// reset the right containers height
				rcontainer.css('height','auto');

				// turn the landing data off
				landing.attr('data-landing','off');

				// un-lock scroll position
				var html = $('html');

				var scrollPosition = html.data('scroll-position');

				html.css('overflow', html.data('previous-overflow'));

				window.scrollTo(scrollPosition[0], scrollPosition[1]);

				// create the browser session cookie
				$.cookie('landingpage', 'true', { path: '/' });

			});

		});

		// fix the height
		$(window).resize(function() { landingHeight(); });

    }

/*-----------------------------------------------------------------------------------*/
/*
/*  Page Element Fade In
/*
/*-----------------------------------------------------------------------------------*/

	// needs to be wrapped into ready function
	function pageFadeIn() {
		
		// variables
		var rightContent = $('.rightContent');

		// 500 delay
		setTimeout( function() {

			// animate in
			rightContent.addClass('fadeUp').animate({

				opacity: 1,

			}, 300);

		}, 500, function(){

			// remove animation
			rightContent.addClass('fadeUp')

		});

	}

/*-----------------------------------------------------------------------------------*/
/*
/*	Floating Sidebar
/*
/*-----------------------------------------------------------------------------------*/

	function floatSidebar() {

		if($('.floatSidebar').length > 0 ) {

			var windowWidth = $(window).width();

			var	sideFloat = $('.floatSidebar');

			var	gutter = $('body').attr('data-gutter-single');

			var offset = $('#floatStart').offset().top-gutter;

			var sideWidth = $('.postSidebar').width();

			// if user scrolls down
			if ( $(document).scrollTop() >= offset && windowWidth > 700 ) {
				
				$(sideFloat).addClass('floatFixed').css('width',sideWidth);

			// if user scrolls up
			} else {
				
				$(sideFloat).removeClass('floatFixed').css('width','');

			}

		}

	}

/*-----------------------------------------------------------------------------------*/
/*
/*	Header Nav
/*
/*-----------------------------------------------------------------------------------*/

	$('#headerNav ul li ul').each(function(){

		// sub list
		var ul = $(this);

		// add classes
		ul.addClass('fadeUpIcon');

		// hover function
		ul.parent().hover(function(){

			ul.animate({ opacity: '1', }, 150);

		}, function(){

			ul.animate({ opacity: '0', }, 150);

		});

	});


/*-----------------------------------------------------------------------------------*/
/*
/*  Buttons & Last Item Hacks
/*
/*-----------------------------------------------------------------------------------*/

	$('.comment_wrap .comment').last().css('border','none');

	$('.postPages a, .postPages span').addClass('button small');

	$('.tagcloud a').addClass('button small');

	$('.ping a').addClass('button small accentButton');

	$('.navigation a').addClass('accentButton');

	$('.navigation a').last().addClass('rr');

	// get the first mainBox with a display of block
	$('.mainBox').filter(function() {

		return $(this).css('display') === 'block';

	}).first().addClass('first');

	$('.pageWrap a, .pageWrap span').addClass('button');

/*-----------------------------------------------------------------------------------*/
/*
/*  Browser Compatability Scripts
/*
/*-----------------------------------------------------------------------------------*/

	// fix z-index youtube video embedding on internet explorer (also called in template-infinitescroll.php)
	if($('body').hasClass('ie')) {
		
		$('iframe').each(function() {

			var url = $(this).attr("src");

			if ($(this).attr("src").indexOf("?") > 0) {

				$(this).attr({
					"src" : url + "&wmode=transparent",
					"wmode" : "opaque"
				});

			} else {

				$(this).attr({
					"src" : url + "?wmode=transparent",
					"wmode" : "opaque"
				});

			}
		});

		$('embed').each(function() {

			$(this).attr({
				"wmode" : "opaque"
			});

		});

		$('param').each(function() {

			$(this).attr({
				"name" : "wmode",
				"value" : "opaque"
			});

		});

	}

/*-----------------------------------------------------------------------------------*/
/*
/*	Copyright Fade In
/*
/*-----------------------------------------------------------------------------------*/
	
	$(window).load(function(){

		$('.copyright').animate({

			opacity: 1,

		}, 500);

	});

/*-----------------------------------------------------------------------------------*/
/*
/*	Disqus Fix
/*
/*-----------------------------------------------------------------------------------*/
	
	// if disqus is in use
	if('#disqus_thread'){

		$('#disqus_thread').wrap('<div class="contentBlock"/>');

		$('.contentBlock #disqus_thread').wrap('<div class="entry_content"/>');

	}



/*-----------------------------------------------------------------------------------*/
/*
/*	Fire The Functions
/*
/*-----------------------------------------------------------------------------------*/

	resultsWrap();
	similarHeight();
	mobileButton();
	slideButton();
	containerHeight();
	spotifyHack2();
	pageFadeIn();

	setTimeout( function() {
		resultsWrap();
		similarHeight();
		containerHeight();
		spotifyHack2();
		floatSidebar();
	}, 1000);

	$(window).load(function() {
		resultsWrap();
		similarHeight();
		containerHeight();
		spotifyHack2();
		floatSidebar();
	});

	$(window).resize(function() {
		resultsWrap();
		similarHeight();
		containerHeight();
		spotifyHack2();
		floatSidebar();
	});

	$(document).scroll(function() {
		floatSidebar();
	});

	$(window).scroll(function() {
		floatSidebar();
	});

});