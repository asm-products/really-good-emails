jQuery(document).ready(function($) {

/* This script is for handling metaboxes for custom post types and pages etc */
/* The core post format metaboxes are handled via the framework/js/vkpostmeta.js script */

/*-----------------------------------------------------------------------------------*/
/* Page Meta Switches
/*-----------------------------------------------------------------------------------*/

    $(document).ready(function(){
		$('#page_template').trigger('change');
    });
    
    // Contact Page Meta
    $('#page_template').change(function() {
        if($(this).val() === "page-contact.php") { $("#vk-metabox-contact").show(); } else { $("#vk-metabox-contact").hide(); }
    });


/*-- End Functions --*/
});