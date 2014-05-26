<?php
/*-----------------------------------------------------------------------------------*/

    /* This files contains content filters for certain post formats */
    /* WARNING: Do not change anything in here or things will quickly break */

/*-----------------------------------------------------------------------------------*/
/*
/*  Post Classes
/*
/*-----------------------------------------------------------------------------------*/

function vk_post_class($classes) {

    // get post
    global $post;

    // audio post
    if( 'audio' == get_post_format() ) {

        $embed = get_post_meta($post->ID, 'vk_audio', true);

        $type = substr($embed, 0, 4);

        if($type=='http'){

            $classes[] = 'self-hosted';

        } else {

            $classes[] = 'embedded';

        }

    }

    // video post
    if( 'video' == get_post_format() ) {

        $embed = get_post_meta($post->ID, 'vk_video_embed', true);

        if($embed==''){

            $classes[] = 'self-hosted';

        } else {

            $classes[] = 'embedded';

        }

    }

    return $classes;

}
add_filter('post_class', 'vk_post_class');


/*-----------------------------------------------------------------------------------*/
/*
/*  Audio Function
/*
/*-----------------------------------------------------------------------------------*/

function vk_audio($postid){

    // Get the posts audio code
    $embed = get_post_meta($postid, 'vk_audio', true);

    $type = substr($embed, 0, 4);

    // self hosted
    if($type=='http'){

        return do_shortcode('[audio src="'.$embed.'"]');

    // embed code
    } else {

        return stripslashes( nl2br( htmlspecialchars_decode( $embed ) ) );

    }

}

/*-----------------------------------------------------------------------------------*/
/*
/*  Video Function
/*
/*-----------------------------------------------------------------------------------*/

function vk_video($postid){

    // mp4
    $mp4 = get_post_meta($postid, 'vk_video_mp4', true);

    // ogv
    $ogv = get_post_meta($postid, 'vk_video_ogv', true);

    // poster
    $poster = get_post_meta($postid, 'vk_video_poster', true);

    // embed
    $embed = get_post_meta($postid, 'vk_video_embed', true);


    // embedded
    if($embed!=''){

        // return video
        return stripslashes( nl2br( htmlspecialchars_decode( $embed ) ) );

    // self hosted
    } else {

        // poster fallback
        if($poster=='') {

            $poster = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'standard' );
            $poster = $poster[0];

        }

        // return video
        return do_shortcode('[video mp4="'.$mp4.'" ogv="'.$ogv.'" poster="'.$poster.'" preload="true"]');

    }

}

/*-----------------------------------------------------------------------------------*/
/*
/*  Chat Function
/*
/*-----------------------------------------------------------------------------------*/

function vk_chat( $content ) {
    global $_post_format_chat_ids;

    // Set the global variable of speaker IDs to a new, empty array for this chat.
    $_post_format_chat_ids = array();

    // Allow the separator (separator for speaker/text) to be filtered
    $separator = apply_filters( 'my_post_format_chat_separator', ':' );

    // Open the chat transcript div and give it a unique ID based on the post ID
    $chat_output = "\n\t\t\t" . '<div id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat-transcript">';

    // Split the content to get individual chat rows
    $chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );

    // Loop through each row and format the output
    foreach ( $chat_rows as $chat_row ) {

        // If a speaker is found, create a new chat row with speaker and text
        if ( strpos( $chat_row, $separator ) ) {

            // Split the chat row into author/text
            $chat_row_split = explode( $separator, trim( $chat_row ), 2 );

            // Get the chat author and strip tags
            $chat_author = strip_tags( trim( $chat_row_split[0] ) );

            // Get the chat text
            $chat_text = trim( $chat_row_split[1] );

            // Get the chat row ID (based on chat author) to give a specific class to each row for styling
            $speaker_id = vk_chat_row_id( $chat_author );

            // Open the chat row
            $chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

            // Add the chat row author
            $chat_output .= "\n\t\t\t\t\t" . '<div class="chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard"><h5>' . apply_filters( 'my_post_format_chat_author', $chat_author, $speaker_id ) . '</h5></div>';

            // Add the chat row text
            $chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text"><p>' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</p></div>';

            // Close the chat row
            $chat_output .= "\n\t\t\t\t" . '</div>';

        }

        // If no author is found, assume this is a separate paragraph of text that belongs to the
        // previous speaker and label it as such, but let's still create a new row
        else {

            // Make sure we have text
            if ( !empty( $chat_row ) ) {

                // Open the chat row
                $chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

                // Don't add a chat row author.  The label for the previous row should suffice

                // Add the chat row text
                $chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</div>';

                // Close the chat row
                $chat_output .= "\n\t\t\t</div><!-- .chat-row -->";
            }
        }
    }

    // Close the chat transcript div
    $chat_output .= "\n\t\t\t</div><!-- .chat-transcript -->\n";

    // Return the chat content and apply filters for developers
    return $chat_output;

}

function vk_chat_row_id( $chat_author ) {
    global $_post_format_chat_ids;

    // Let's sanitize the chat author to avoid craziness and differences like "John" and "john"
    $chat_author = strtolower( strip_tags( $chat_author ) );

    // Add the chat author to the array
    $_post_format_chat_ids[] = $chat_author;

    // Make sure the array only holds unique values
    $_post_format_chat_ids = array_unique( $_post_format_chat_ids );

    // Return the array key for the chat author and add "1" to avoid an ID of "0"
    return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1;
}

?>