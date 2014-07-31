<?php
class custom_api {

  public $subject = '';
  public $body = '';
  public $tags = array();
  public $cats = array();
  public $post = array();
  public $ready = false;
  public $author = 1; // TODO: change to api user account user_id (user has not been made so I'm using user 1)


  function __construct($subject, $body, $json) {

    // upload images in json array
    // TODO: What we want to do with retina images
    $images = $this->upload_image(json_decode($json));

    // load terms
    $tags = get_terms( array('post_tag'), array( 'fields' => 'names' ) );
    $cats = get_terms( array('category'), array( 'fields' => 'names' ) );

    // look in subject for terms
    $api_terms = explode(' ', $subject);

    // load terms if they are in subject
    $this->tags = array_intersect($tags, $api_terms);
    $this->cats = array_intersect($cats, $api_terms);

    //TODO: setup cat id's here for when adding a post

    // filter html
    // TODO: validate the type of HTML coming in we need to standardize body/the_content HTML
    $allowed_html = array(
      'a' => array(
        'href' => array(),
        'title' => array()
      ),
      'img' => array(
        'src' => array(),
        'class' => array(),
        'id' => array(),
        'alt' => array(),
        'width' => array(),
        'height' => array()
      ),
      'h2' => array(),
      'h1' => array(),
      'strong' => array(),
    );

    // insert image
    // TODO: get image with link. I have not done that yet
    $image_tag = wp_get_attachment_image($images[0]['attachment_id'], 'full');
    $body = str_replace('{{image}}', $image_tag, $body);

    $this->post = array(
      'post_content'   => wp_kses($body, $allowed_html),
      'post_name'      => sanitize_title($subject),  // The name (slug) for your post
      'post_title'     => sanitize_text_field($subject), // The title of your post.
      'post_status'    => 'draft',
      'post_type'      => 'post',
      'post_author'    => intval($this->author), // The user ID number of the author. Default is the current user ID.
      'ping_status'    => 'closed', // Pingbacks or trackbacks allowed. Default is the option 'default_ping_status'.
      'comment_status' => 'closed', // Default is the option 'default_comment_status', or 'closed'.
      'post_category'  => $this->cats, // TODO: set this to cat id's not the names, this is as far as i got
      // 'tags_input'     => $this->tags // For the company name
    );


    $this->ready = true; // TODO: I do this for fun but need to be wrapped in validation
    $this->add_email_post(); // publish draft of post

  }

  function add_email_post() {

    if($this->ready) {
      wp_insert_post( $this->post );
    }

  }

  function upload_image($images) {
      $tmp = new uploader_api();
      $data = array();

    // TODO: test this for multiple images I'm not sure what we plan to do
      foreach($images as $base64) {
        $data[] = $tmp->saveUpload( uniqid(), $this->author, $base64 );
      }

    return $data;

  }

}