jQuery(document).ready(function($) {

	/* Tabs */
	$(".visual-tabs").tabs();
	

	/* Toggles */

	/* We have chosen not to use the jquery toggle function to eliminated responsive height issues. */
	/* Instead we are creating our own toggle like function that simply hides and shows content. */

	function toggleDefault(){

		// Set the default state
		$('.visual-toggle').each( function(){

			var icon = $(this).children('.visual-toggle-title').children('.title-icon');

			// If toggle open
			if($(this).attr('data-id') === 'open') {
				$(this).children('.visual-toggle-inner').css('display','block');
				icon.text('- ');

			// if toggle closed
			} else {
				$(this).children('.visual-toggle-inner').css('display','none');
				icon.text('+ ');

			}

		});

	}
	toggleDefault();
	$(window).load(function(){ toggleDefault(); });


	// If a toggle is clicked
	$('.visual-toggle').click( function() {

		var icon = $(this).children('.visual-toggle-title').children('.title-icon');

		// If toggle currently open
		if($(this).attr('data-id') === 'open') {
			$(this).attr('data-id','closed');
			$(this).children('.visual-toggle-inner').hide();
			icon.text('+ ');


		// if toggle currently closed
		} else {
			$(this).attr('data-id','open');
			$(this).children('.visual-toggle-inner').show();
			icon.text('- ');

		}

	});
	
});