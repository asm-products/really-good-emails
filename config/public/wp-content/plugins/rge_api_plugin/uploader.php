<?php
Class uploader_api {

  public $upload_dir;
  public $attachment_id;

  public function __construct(){

    $this->upload_dir = wp_upload_dir();

    if ( is_admin() )
      add_action( 'post_edit_form_tag' , array( &$this, 'addEnctype' ) );
  }

  /**
   * Handles the saving, i.e. creates a post type of attachment.
   *
   * During form submission run the method:
   * $class->fileUpload( $field_name='form_field_name' );
   *
   * @param null $field_name
   *
   * @param null $user_id
   *
   * @param null $base64_string
   *
   * @return array|bool $final_file An array of array of f*cking cool stuff
   */
  public function saveUpload( $field_name=null, $user_id=null, $base64_string=null ) {

    if ( is_null( $field_name ) )
      die('Need field_name');

    // Move the file to the uploads directory, returns an array
    // of information from $_FILES
    if($_FILES[ $field_name ] && is_null($base64_string)) {
      $file = $_FILES[ $field_name ];
      $type = $_FILES[ $field_name ]['type'];
    } else {
      $file = $this->load_base64_to_jpeg($base64_string);
      $temp = $this->setupTempFILES($file);
      $type = $temp['type'];
    }

    $uploaded_file = $this->handleUpload( $file );

    if ( ! isset( $uploaded_file['file'] ) )
      return false;

    // If we were to have a unique user account for uploading
    if ( is_null( $user_id ) ) {
      $current_user = wp_get_current_user();
      $user_id = $current_user->ID;
    }

    // Build the Global Unique Identifier
    $guid = $this->buildGuid( $uploaded_file['file'] );

    // Build our array of data to be inserted as a post
    $attachment = array(
      'post_mime_type' => $type,
      'guid' => $guid,
      'post_title' => 'Uploaded : ' . $this->mediaTitle( $uploaded_file['file'] ),
      'post_content' => '',
      'post_author' => $user_id,
      'post_status' => 'inherit',
      'post_date' => date( 'Y-m-d H:i:s' ),
      'post_date_gmt' => date( 'Y-m-d H:i:s' )
    );

    // Add the file to the media library and generate thumbnail.
    $this->attachment_id = wp_insert_attachment( $attachment, $uploaded_file['file'] );

    if(!function_exists('wp_generate_attachment_metadata')) {
      require_once( ABSPATH . 'wp-admin/includes/image.php' );
    }

    $meta = wp_generate_attachment_metadata( $this->attachment_id, $uploaded_file['file'] );

    wp_update_attachment_metadata( $this->attachment_id, $meta );

    $file_info = pathinfo( $uploaded_file['file'] );


    $final_file = array();
    $final_file['attachment_id'] = $this->attachment_id;
    $final_file['file'] = $uploaded_file['file'];
    $final_file['file_info'] = $file_info;

    return $final_file;
  }

  public function setupTempFILES($file) {
    $temp = array();
    $temp['name'] = basename($file);
    $temp['type'] = 'image/jpeg'; // TODO: we need to set this up for PNG's tested for JPG's only
    $temp['tmp_name'] = $file;
    $temp['size'] = filesize($file);
    return $temp;
  }

  /**
   * Do some set-up before calling the wp_handle_upload function
   */
  public function handleUpload( $file = array() ){

    if( !function_exists( 'wp_handle_upload' ) ) {
      require_once( ABSPATH . "wp-admin/includes/file.php" );
      require_once( ABSPATH . 'wp-admin/includes/image.php' );
    }

    if(!is_array($file) && is_string($file)) {
      $temp = $this->setupTempFILES($file);
      return wp_handle_sideload( $temp, array( 'test_form' => false ), date('Y/m') );
    } else {
      return wp_handle_upload( $file, array( 'test_form' => false ), date('Y/m') );
    }

  }

  /**
   * Builds the GUID for a given file from the media library
   * @param full/path/to/file.jpg
   * @return string guid
   */
  public function buildGuid( $file=null ){
    // $wp_upload_dir = wp_upload_dir();
    return $this->upload_dir['baseurl'] . '/' . _wp_relative_upload_path( $file );
  }

  /**
   * Parse the title of the media based on the file name
   *
   * @param string $file
   *
   * @return string $title
   */
  public function mediaTitle( $file ){
    $title = addslashes( preg_replace('/\.[^.]+$/', '', basename( $file ) ) );
    return $title;
  }

  /**
   * Adds the enctype for file upload, used with the hook
   * post_edit_form_tag for adding uploader to post meta
   */
  public function addEnctype(){
    echo ' enctype="multipart/form-data"';
  }

  /**
   * Resize images based on the "type"
   *
   * Normally this is done in WordPress, but for some reason
   * wp_generate_attachment_metadata() does not work when
   * used in a plugin.
   *
   * @param $file = /my/file/path/image.jpg
   *
   * @internal param $type = thumb|square|main
   *
   * @todo     Since images are NOT "registered" with WordPress
   * they will NOT be deleted from the media library when the
   * original image is deleted!
   *
   * @todo     use wp_update_attachment_metadata() to update
   * the postmeta thumbnails ref. the array in
   * wp_generate_attachment_metadata()
   *
   * @todo     remove hardcoded sizes and suffix, possibly a
   * public variable.
   *
   * @return \WP_Error|\WP_Image_Editor $image same as image_resize() wp_error
   */
  public function resizeImage( $file=null ){
    $image = wp_get_image_editor( $file );

    if ( ! is_wp_error( $image ) ) {
      $image->resize( 1024, 1024, true );
      $image->save( $this->upload_dir['path'] );
    }

    return $image;
  }

  /**
   * Handle Base64 Images and turn them into files
   *
   * @param string $base64_string encoded image
   *
   * @return string the file location
   */
  function load_base64_to_jpeg( $base64_string ) {
    $file_loc = $this->upload_dir['path'] . uniqid() . '.jpg';
    $ifp = fopen( $file_loc , "xb" );
    fwrite( $ifp, base64_decode( $base64_string) );
    fclose( $ifp );
    return $file_loc;
  }

}