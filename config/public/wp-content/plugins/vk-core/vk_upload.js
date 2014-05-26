jQuery(document).ready(function($) { // start jquery scripts (Don't delete this)
 	
	var custom_uploader;

	$('.upload_button').click(function(e) {

	    e.preventDefault();

	    // button
	    thisbutton = $(this);

	    // textfield
	    textfield = thisbutton.siblings('input');

	    // thumbnail
	    thumbnail = thisbutton.parent().parent().find('img');


	    //If the uploader object has already been created, reopen the dialog
	    if (custom_uploader) {
	        custom_uploader.open();
	        return;
	    }

	    //Extend the wp.media object
	    custom_uploader = wp.media.frames.file_frame = wp.media({
	        title: 'Select Favicon Image',
	        button: {
	            text: 'Select Image'
	        },
	        multiple: false
	    });

	    //When a file is selected, grab the URL and set it as the text field's value
	    custom_uploader.on('select', function() {
	        
	        attachment = custom_uploader.state().get('selection').first().toJSON();
	        
	        textfield.val(attachment.url);

	        thumbnail.attr('src',attachment.url);

	    });

	    //Open the uploader dialog
	    custom_uploader.open();

	});

 
}); // end jquery scripts (Don't delete this)



