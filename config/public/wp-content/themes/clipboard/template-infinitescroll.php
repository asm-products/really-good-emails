<?php

	// get the pagination type 
	// note that this template is only called is masonry is on without numbered pagination
	$pagType = get_option('vk_pagination');

	// standard pagination
	if( $pagType!='standardPag' ){

		wp_reset_query();
		global $wp_query;
		global $query_string;

		// archive & blog query
		if(is_search() || is_archive() || is_home()) {
			$action = 'infinite_archive';

		// custom queries
		} else {
			get_template_part('template','customloop');
			$action = 'infinite_page';

		}

		?>

		<script type="text/javascript">
		jQuery(document).ready(function($) {

			// Set the page variables
		    var count = 2;
		    var total = <?php echo $wp_query->max_num_pages; ?>;

			// if the count is bigger then the total from the start hide the load more button
			if( count > total ) {

				$('.pageWrap a').css('display','none');

			} 

		    <?php if($pagType=='seamlessInfinite') { ?>

	    		// Set the state so we know the function is active
	    		$('body').attr('data-load','on');

		    	function seamless() {

		    		// Get Dataload State
		    		var dataLoad = $('body').attr('data-load');

		            if( $(window).scrollTop() + $(window).height() > $(document).height() - 800 && dataLoad=='on') {
						
						// set the state on
						$('body').attr('data-load','off');

						if (count > total){
						  	return false;
						} else {

							loadArticle(count);
							count++;

					    	if(count > total) {
					    		console.log('end of line infinte scroll');
					    		$('.pageWrap a').css('opacity','0');
					    	}

						}

					}

				}

				// Check on document ready
				$(document).ready( function() { seamless(); });

				// Check on load multiple times for large screens 
				$(window).load( function() {
					seamless();
					setTimeout( function() { seamless(); }, 1000);
					setTimeout( function() { seamless(); }, 2000);
					setTimeout( function() { seamless(); }, 3000);
					setTimeout( function() { seamless(); }, 4000);
				});

				// Check on scroll 
	            $(window).scroll(function(){ seamless(); });


		    <?php } elseif($pagType=='manualInfinite') { ?>

			    // Load more on click 
			    $('#load-more').click(function(){
					
					console.log(count);
					console.log(total);

					if(count > total) {
						
						return false;

					} else {
					
						loadArticle(count);
						count++;

				    	if(count > total) {
				    		console.log('end of line infinte scroll');
				    		$('.pageWrap a').css('opacity','0');
				    	}

					}

			    });

			<?php } ?>

		    // Load more function 
		    function loadArticle(pageNumber){

				<?php if($pagType=='seamlessInfinite') { ?>

			    	// Update the loading 
					$('.pageWrap.seamless a').animate({opacity:1,},50);
					$('.copyright').animate({opacity:0,},300);

				<?php } elseif($pagType=='manualInfinite') { ?>

			    	// Update the loading 
					$('.pageWrap.manual a#load-more').css('display','none');
				    $('.pageWrap.manual a#loading').css('display','inline-block');

				<?php } ?>


			    // Get the new content via ajax 
				$.ajax({
			        url: "<?php echo site_url(); ?>/wp-admin/admin-ajax.php",
			        type:'POST',
			        data: "action=<?php echo $action; ?>&page_no="+ pageNumber + '&loop_file=loop&query=<?php echo $query_string; ?>', 
			        
				    success: function(html){


						<?php if($pagType=='seamlessInfinite') { ?>

					    	// Update the loading on success 
					    	setTimeout( function() {

								$('.pageWrap.seamless a').animate({opacity:0,},50);
								$('.copyright').animate({opacity:1,},300);

							}, 1500);

						<?php } elseif($pagType=='manualInfinite') { ?>

					    	// Update the loading on success 
							$('.pageWrap.manual a#load-more').css('display','inline-block');
							$('.pageWrap.manual a#loading').css('display','none');

						<?php } ?>


						// Set the new html variable 
					    var $newItems = $(html);

					    // Append the new content 
				        if( $('#content').hasClass('masonry') ) {

				        	$('#content').isotope('insert', $newItems);

				        } else {

				        	$newItems.appendTo('#content');

				        }

				        // Fade the new content in 
			        	var newContent = $newItems.find('.contentBlock');
			        	
			        	$(newContent).css('opacity','0');
						
						setTimeout( function() { $(newContent).animate({ opacity: 1 }, 300); }, 1500);
						
						// Turn the data load state back on for seamless scrolling 
						setTimeout( function() { $('body').attr('data-load','on'); }, 1000);

				        // Reload needed scripts 
						$.getScript('<?php echo get_template_directory_uri(); ?>/theme/js/reloads.js');
			        	
			        	$newItems.find('audio, video').mediaelementplayer();

						// Embedded Content in IE 
						if( $('body').hasClass('ie') ) {
							
							$newItems.find('iframe').each(function() {

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

							$newItems.find('embed').each(function() {
							    $(this).attr({
							      "wmode" : "opaque"
							    });
							});

							$newItems.find('param').each(function() {

							    $(this).attr({
							      "name" : "wmode",
							      "value" : "opaque"
							    });

							});

						}

				    }

			    });
		    return false;
		    }

		});
		</script>
       	
       	<?php } ?>