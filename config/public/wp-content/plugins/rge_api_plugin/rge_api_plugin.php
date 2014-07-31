<?php
/*
Plugin Name: Custom
Plugin URI: http://robojuice.com/
Description: REST API for RGE.
Version: 0.1.0
Author: Kevin Dees
Author URI: http://kevindees.cc
*/
require_once('uploader.php');
require_once('api.php');

function api_boot() {

  // Test email body
  $body = '<h2>Email Subject</h2>
New at GoSquared in July — Why accuracy matters

<h2>Mobile Email View</h2>
{{image}}';

  // TODO: need to get already encoded image from API this is just a test file
  if(file_exists(__DIR__ . '/example.jpg')) {

    $ifp = fopen( __DIR__ . '/example.jpg', "rb" );
    $imageData = fread( $ifp, filesize( __DIR__ . '/example.jpg' ) );
    fclose( $ifp );

    $json = array(
      base64_encode($imageData)
    );

    // TODO: this need to be hooked into a REST API so images and posts get added
    (new custom_api( 'Test Subject Uncategorized Tags', $body, json_encode($json) ));

  }
}

// TODO: you can test against this hook
// add_action('init', 'api_boot');