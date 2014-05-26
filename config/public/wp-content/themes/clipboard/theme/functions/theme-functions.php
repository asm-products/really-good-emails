<?php
/*-----------------------------------------------------------------------------------*/

    /* This file contains all the themes specific output functions */
    /* WARNING: Do not change anything in here or things will quickly break */

/*-----------------------------------------------------------------------------------*/
/*
/*  Output Landing Page
/*
/*-----------------------------------------------------------------------------------*/

    if ( !function_exists( 'landingPage' ) ) {
        function landingPage() {

            // page content
            $title = get_option('vk_landing_page');
            $page = get_page_by_title($title);
            $page_data = get_page( $page );

            // do the landing page
            if($title!='0') { ?>

            <div class="landingWrapper">

                <div class="landingInner"><?php  echo apply_filters('the_content', $page_data->post_content); ?></div>
                <div class="landingClose"><a class="button"><span class="icon-close"></span></a></div>
                <div class="landingBackground"></div>

            </div>

            <?php }
        }
    }


/*-----------------------------------------------------------------------------------*/
/*
/*  Custom Background (adds in .rightContainer to header styling)
/*
/*-----------------------------------------------------------------------------------*/
    
    // this is all default core stuff but we have slightly altered the output styling
    // the original function _custom_background_cb() is kept in /wp-includes/theme.php

    if ( !function_exists( 'vk_custom_background' ) ) {
        function vk_custom_background() {

            // $background is the saved custom image, or the default image.
            $background = set_url_scheme( get_background_image() );

            // $color is the saved custom color.
            // A default has to be specified in style.css. It will not be printed here.
            $color = get_theme_mod( 'background_color' );

            if ( ! $background && ! $color )
                return;

            $style = $color ? "background-color: #$color;" : '';

            if ( $background ) {
                $image = " background-image: url('$background');";

                $repeat = get_theme_mod( 'background_repeat', 'repeat' );
                if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
                    $repeat = 'repeat';
                $repeat = " background-repeat: $repeat;";

                $position = get_theme_mod( 'background_position_x', 'left' );
                if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
                    $position = 'left';
                $position = " background-position: top $position;";

                $attachment = get_theme_mod( 'background_attachment', 'scroll' );
                if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
                    $attachment = 'scroll';
                $attachment = " background-attachment: $attachment;";

                $style .= $image . $repeat . $position . $attachment;

            }

        ?>

        <style type="text/css" id="custom-background-css">

            .rightContainer,
            .iphone.vk_background_stretch_1 .iosBackground { <?php echo trim( $style ); ?> }

        </style>

        <?php

        }
    }

/*-----------------------------------------------------------------------------------*/
/*
/*  Mediaelements Infinity Scroll Fix (Wordpress 3.6 only)
/*
/*-----------------------------------------------------------------------------------*/
    
    // We manually enqueue the mediaelements styles
    if( !function_exists( 'vk_enqueue_media_styles' ) ) {
        function vk_enqueue_media_styles() {

            if( get_option('vk_pagination')!='standardPag' && !is_single() ) {
                wp_enqueue_style('mediaelement');
                wp_enqueue_style('wp-mediaelement');
            }

        }
        add_action('wp_enqueue_scripts', 'vk_enqueue_media_styles');
    }

    // We manually enqueue the mediaelements scripts
    if( !function_exists( 'vk_enqueue_media_scripts' ) ) {
        function vk_enqueue_media_scripts() {

            if( get_option('vk_pagination')!='standardPag' && !is_single() ) {
                wp_enqueue_script('mediaelement');
                wp_enqueue_script('wp-mediaelement');
            }

        }
        add_action('wp_enqueue_scripts', 'vk_enqueue_media_scripts');
    }    


/*-----------------------------------------------------------------------------------*/
/* Output Slider Gallery
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'vk_slider' ) ) {
        function vk_slider($postid, $imagesize) { ?>

        <?php // get all of the attachments for the post
        $args = array(
            'orderby' => 'menu_order',
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => -1,
        );

            $attachments = get_posts($args);
            if( !empty($attachments) ) {

                $i = 0;
                echo '<ul class="postSlides slides_'.$postid.' tr">';

                foreach( $attachments as $attachment ) {
                    $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                    $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;

                    echo '<li class="tr"><img class="tr" src="'.$src[0].'" alt="'.$alt.'" /></li>';
                    $i++;
                }

                echo '</ul>';

            } else { ?>

                <ul><li><?php the_post_thumbnail( $imagesize, array( 'class' => 'imagescale') ); ?></li></ul>
            
            <?php }
        }
    }


/*-----------------------------------------------------------------------------------*/
/* Output Thumb Gallery
/*-----------------------------------------------------------------------------------*/

    if ( !function_exists( 'vk_gallery' ) ) {
        function vk_gallery($postid, $imagesize) { ?>

        <?php // get all of the attachments for the post
        $args = array(
            'orderby' => 'menu_order',
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => -1,
        );

            $attachments = get_posts($args);
            if( !empty($attachments) ) {

                $i = 0;
                echo '<ul>';

                foreach( $attachments as $attachment ) {

                    $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                    $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;

                    echo '<li><img src="'.$src[0].'" alt="'.$alt.'"/></li>';
                    $i++;
                }

                echo '</ul>';
            }
        }
    }

/*-----------------------------------------------------------------------------------*/
/* Output Lightbox Link
/*-----------------------------------------------------------------------------------*/

    if ( !function_exists( 'vk_lightbox_link' ) ) {
        function vk_lightbox_link($postid, $type) { ?>

        <?php // get all of the attachments for the post
        $args = array(
            'orderby' => 'menu_order',
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => -1,
        );

            $attachments = get_posts($args);
            if( !empty($attachments) ) {

                $i = 0;

                foreach( $attachments as $attachment ) {

                    $full = wp_get_attachment_image_src( $attachment->ID, 'fullsize' );
                    $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                    $caption = $attachment->post_excerpt; if($caption=='') { $caption=$alt; }

                    echo '<a href="'.$full[0].'" class="slideBox_'.$postid.'_'.$type.'" title="'.$caption.'"></a>';
                    
                    $i++;
                }

                ?>
                    <script type="text/javascript">
                    jQuery(document).ready(function($) {

                        // Only create a new instance of the lightbox if it doesn't already exist
                        if($('.slideBox_<?php echo $postid; ?>_<?php echo $type; ?>').length > 0) {
                            $('.slideBox_<?php echo $postid; ?>_<?php echo $type; ?>').Slidebox();
                        } else {

                            alert('already exists');

                        }

                    });
                    </script>

                <?php
            }
        }
    }

/*-----------------------------------------------------------------------------------*/
/*  Output Post Time Ago
/*-----------------------------------------------------------------------------------*/

    if ( !function_exists( 'vk_post_time' ) ) {
        function vk_post_time() {
            global $post;
            $date = get_post_time('G', true, $post);

            // Array of time period chunks
            $chunks = array(
                array( 60 * 60 * 24 * 365 , __( 'year', 'framework' ), __( 'years', 'framework' ) ),
                array( 60 * 60 * 24 * 30 , __( 'month', 'framework' ), __( 'months', 'framework' ) ),
                array( 60 * 60 * 24 * 7, __( 'week', 'framework' ), __( 'weeks', 'framework' ) ),
                array( 60 * 60 * 24 , __( 'day', 'framework' ), __( 'days', 'framework' ) ),
                array( 60 * 60 , __( 'hour', 'framework' ), __( 'hours', 'framework' ) ),
                array( 60 , __( 'minute', 'framework' ), __( 'minutes', 'framework' ) ),
                array( 1, __( 'second', 'framework' ), __( 'seconds', 'framework' ) )
            );
         
            if ( !is_numeric( $date ) ) {
                $time_chunks = explode( ':', str_replace( ' ', ':', $date ) );
                $date_chunks = explode( '-', str_replace( ' ', '-', $date ) );
                $date = gmmktime( (int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0] );
            }
         
            $current_time = current_time( 'mysql', $gmt = 0 );
            $newer_date = strtotime( $current_time );
         
            // Difference in seconds
            $since = $newer_date - $date;
         
            // Something went wrong with date calculation and we ended up with a negative date.
            if ( 0 > $since )
                return __( 'sometime', 'framework' );
         
            //Step one: the first chunk
            for ( $i = 0, $j = count($chunks); $i < $j; $i++) {
                $seconds = $chunks[$i][0];
         
                // Finding the biggest chunk (if the chunk fits, break)
                if ( ( $count = floor($since / $seconds) ) != 0 )
                    break;
            }
         
            // Set output var
            $output = ( 1 == $count ) ? '1 '. $chunks[$i][1] : $count . ' ' . $chunks[$i][2];
         
         
            if ( !(int)trim($output) ){
                $output = '0 ' . __( 'seconds', 'framework' );
            }
         
            $output .= ' '.__('ago', 'framework');
            return $output;
        }
    }


/*-----------------------------------------------------------------------------------*/
/*  Output Comment Time Ago
/*-----------------------------------------------------------------------------------*/

    if ( !function_exists( 'vk_comment_time' ) ) {
        function vk_comment_time($time) {
         
            $date = $time;
         
            // Array of time period chunks
            $chunks = array(
                array( 60 * 60 * 24 * 365 , __( 'year', 'framework' ), __( 'years', 'framework' ) ),
                array( 60 * 60 * 24 * 30 , __( 'month', 'framework' ), __( 'months', 'framework' ) ),
                array( 60 * 60 * 24 * 7, __( 'week', 'framework' ), __( 'weeks', 'framework' ) ),
                array( 60 * 60 * 24 , __( 'day', 'framework' ), __( 'days', 'framework' ) ),
                array( 60 * 60 , __( 'hour', 'framework' ), __( 'hours', 'framework' ) ),
                array( 60 , __( 'minute', 'framework' ), __( 'minutes', 'framework' ) ),
                array( 1, __( 'second', 'framework' ), __( 'seconds', 'framework' ) )
            );
         
            if ( !is_numeric( $date ) ) {
                $time_chunks = explode( ':', str_replace( ' ', ':', $date ) );
                $date_chunks = explode( '-', str_replace( ' ', '-', $date ) );
                $date = gmmktime( (int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0] );
            }
         
            $current_time = current_time( 'mysql', $gmt = 0 );
            $newer_date = strtotime( $current_time );
         
            // Difference in seconds
            $since = $newer_date - $date;
         
            // Something went wrong with date calculation and we ended up with a negative date.
            if ( 0 > $since )
                return __( 'sometime', 'framework' );

         
            //Step one: the first chunk
            for ( $i = 0, $j = count($chunks); $i < $j; $i++) {
                $seconds = $chunks[$i][0];
         
                // Finding the biggest chunk (if the chunk fits, break)
                if ( ( $count = floor($since / $seconds) ) != 0 )
                    break;
            }
         
            // Set output var
            $output = ( 1 == $count ) ? '1 '. $chunks[$i][1] : $count . ' ' . $chunks[$i][2];
         
         
            if ( !(int)trim($output) ){
                $output = '0 ' . __('seconds', 'framework' );
            }
         
            $output .= ' '.__('ago', 'framework');
            return $output;
        }
    }

/*-----------------------------------------------------------------------------------*/
/*  Output Infinite Scroll
/*-----------------------------------------------------------------------------------*/

    // Infinite Scroll for archive
    if ( !function_exists( 'wp_infinite_archive' ) ) {
        function wp_infinite_archive(){

            $paged = $_POST['page_no'];
            $query_string = $_POST['query'];
            $posts_per_page = get_option('posts_per_page');

            //if user is logged in include private posts
            if( is_user_logged_in() ) {
                $status = 'publish,private';
            } else {
                $status = 'publish';

            }

            // Query the posts
            query_posts( $query_string . '&post_status='.$status.'&paged='.$paged );
            get_template_part('loop');
            exit;

        }
        add_action('wp_ajax_infinite_archive', 'wp_infinite_archive'); // For admin
        add_action('wp_ajax_nopriv_infinite_archive', 'wp_infinite_archive'); // For user
    }

    // Infinite Scroll for post listings
    if ( !function_exists( 'wp_infinite_page' ) ) {
        function wp_infinite_page(){

            $paged = $_POST['page_no'];
            $posts_per_page = get_option('posts_per_page');

            //if user is logged in include private posts
            if( is_user_logged_in() ) {
                $status = array('publish','private');
            } else {
                $status = array('publish');

            }

            // Query the posts
            query_posts( array('paged' => $paged, 'post_status'=>$status ) );
            get_template_part('loop');
            exit;
        }
        add_action('wp_ajax_infinite_page', 'wp_infinite_page'); // For admin
        add_action('wp_ajax_nopriv_infinite_page', 'wp_infinite_page'); // For user
    }


/*-----------------------------------------------------------------------------------*/
/* Output Post Categories
/*-----------------------------------------------------------------------------------*/

    if ( !function_exists( 'vk_categories' ) ) {
        function vk_categories() {

            $categories = get_the_category();
            $separator = ', ';
            $output = '';

            if($categories) {
                foreach($categories as $category) {
                        if ($category->cat_name != 'Uncategorized') {
                            $output .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( 'View all posts in %s','framework'), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
                        }
                } $categories_output = trim($output, $separator);
            } else {
                $categories_output = '';
            }
            return $categories_output;
        }
    }

/*-----------------------------------------------------------------------------------*/
/* Filter Tag Cloud
/*-----------------------------------------------------------------------------------*/

    if ( !function_exists( 'vk_tag_cloud' ) ) {
        function vk_tag_cloud($in) {
            return 'smallest=10&largest=10';
        }
        add_filter( 'widget_tag_cloud_args', 'vk_tag_cloud' );
    }


?>