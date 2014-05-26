<?php

wp_enqueue_script( 'child-custom', get_stylesheet_directory_uri() . '/js/child-custom.js', null, null, true );

add_image_size( 'mailchimp', 207, 207, true );