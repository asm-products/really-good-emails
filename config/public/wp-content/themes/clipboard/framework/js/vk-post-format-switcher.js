jQuery(document).ready(function($) {

/* This script is for handling metaboxes for post formats */
/* The custom page and post metaboxes are handled via the theme/functions/theme-postmeta.js script */

/*-----------------------------------------------------------------------------------*/
/* Default Media Manager View (also set for each button in create-post-meta.php)
/*-----------------------------------------------------------------------------------*/

    // Default Media View (mainly for set featured image)
    var called = 0;
    $('#wpcontent').ajaxStop(function() {
        if ( 0 === called ) {
            $('[value="uploaded"]').attr( 'selected', true ).parent().trigger('change');
            called = 1;
        }
    });


/*-----------------------------------------------------------------------------------*/
/* Post Meta Switches
/*-----------------------------------------------------------------------------------*/

    // Metabox variables
    var standardBox = $('#vk-metabox-standard');
    var imageBox = $('#vk-metabox-image');
    var galleryBox = $('#vk-metabox-gallery');
    var linkBox = $('#vk-metabox-link');
    var videoBox = $('#vk-metabox-video');
    var audioBox = $('#vk-metabox-audio');
    var chatBox = $('#vk-metabox-chat');
    var statusBox = $('#vk-metabox-status');
    var quoteBox = $('#vk-metabox-quote');
    var asideBox = $('#vk-metabox-aside');


    // Hide all the custom metaboxes
    function hideAll() {
        standardBox.hide();
        imageBox.hide();
        galleryBox.hide();
        linkBox.hide();
        videoBox.hide();
        audioBox.hide();
        chatBox.hide();
        statusBox.hide();
        quoteBox.hide();
        asideBox.hide();
    }
    hideAll();

    // Group
    var group = $('#post-formats-select input');

    // On Load
    var active = $('#post-formats-select input:checked');
    var activeVal = $(active).val();

        // If its the standard post
        if(activeVal==='0'){
            $('#vk-metabox-standard').show();
        // If its something exotic
        } else {
            $('#vk-metabox-'+activeVal).show();
        }

    // On Change
    group.change( function() {

        if($(this).val() === '0') {
            hideAll();
            standardBox.show();

        } else if ($(this).val() === 'aside') {
            hideAll();
            asideBox.show();

        } else if ($(this).val() === 'audio') {
            hideAll();
            audioBox.show();

        } else if ($(this).val() === 'chat') {
            hideAll();
            chatBox.show();

        } else if ($(this).val() === 'gallery') {
            hideAll();
            galleryBox.show();

        } else if ($(this).val() === 'image') {
            hideAll();
            imageBox.show();

        } else if ($(this).val() === 'link') {
            hideAll();
            linkBox.show();

        } else if ($(this).val() === 'status') {
            hideAll();
            statusBox.show();

        } else if ($(this).val() === 'quote') {
            hideAll();
            quoteBox.show();

        } else if ($(this).val() === 'video') {
            hideAll();
            videoBox.show();

        }

    });



/*-- End Functions --*/
});