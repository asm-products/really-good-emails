<?php
global $more;
$more = 0;

// paged
if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} else if ( get_query_var('page') ) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

// status
if( is_user_logged_in() ) {
    $status = array('publish','private');
} else {
    $status = array('publish');
}

$args = array( 'post_type' => 'post', 'paged'=> $paged, 'post_status'=>$status );
$wp_query = new WP_Query();
$wp_query->query($args);
?>
