<?php

/*
Plugin Name: Visualkicks - Dribbble Widget
Plugin URI: http://www.visualkicks.com/plugins
Description: Enables a Dribbble widget for use in our compatible Visualkicks themes 
Version: 1.1
Author: Visualkicks
Author URI: http://www.visualkicks.com

Changelog

04/01/2014 Version 1.1
- removed the styling from the shortcode as it should be handled by the theme
- scripts are now only loaded if they are needed

/*-----------------------------------------------------------------------------------*/

	// widget init
	add_action( 'widgets_init', 'vk_dribbble_widget' );

	// register widget
	function vk_dribbble_widget() {

		register_widget( 'VK_Dribbble_Widget' );

	}

/*-----------------------------------------------------------------------------------*/
/*
/*	Register Scripts
/*
/*-----------------------------------------------------------------------------------*/

    function vk_dribble_register_scripts() {

    	// register
	    wp_register_script('widget-dribbble', plugins_url( '/jquery.jribbble.min.js', __FILE__ ), 'jquery', '1.0', true);

	}
    add_action('wp_enqueue_scripts', 'vk_dribble_register_scripts');


/*-----------------------------------------------------------------------------------*/
/*
/*	Print Scripts
/*
/*-----------------------------------------------------------------------------------*/

	function vk_dribble_print_scripts() {

		// only print if widget is in use
		global $add_dribbble_scripts;
		if ( ! $add_dribbble_scripts ) {

			return;

		} else {

			// print
			wp_print_scripts('widget-dribbble');

		}

	}
	add_action('wp_footer', 'vk_dribble_print_scripts');

/*-----------------------------------------------------------------------------------*/
/*
/*	Widget Setup
/*
/*-----------------------------------------------------------------------------------*/

	// widget class
	class vk_dribbble_widget extends WP_Widget {

	function VK_Dribbble_Widget() {
	
		// settings
		$widget_ops = array( 
		    'classname' => 'vk_dribbble_widget', 
		    'description' => __('A widget that displays your latest dribbble shots.', 'framework') 
		);

		// control
		$control_ops = array( 
		    'width' => 300, 
		    'height' => 350,
		    'id_base' => 'vk_dribbble_widget'
		);

		// create
		$this->WP_Widget( 'vk_dribbble_widget', __('Dribbble Shots', 'framework'), $widget_ops, $control_ops );

	}

/*-----------------------------------------------------------------------------------*/
/*
/*	Display Widget
/*
/*-----------------------------------------------------------------------------------*/

	function widget( $args, $instance ) {
		extract( $args );

		// title
		$title = apply_filters('widget_title', $instance['title'] );
		
		// username
		$vk_dribbble_username = $instance['username'];

		// postcount
		$vk_dribbble_postcount = $instance['postcount'];
		
		// add script global
		global $add_dribbble_scripts;
		$add_dribbble_scripts = true;

		// widget before
		echo $before_widget;

		// widget title
		if ( $title ) { echo $before_title . $title . $after_title; }

		$id = rand(0,999); ?>

			<script type="text/javascript">
			jQuery(document).ready(function($){

				$.jribbble.getShotsByPlayerId('<?php echo $vk_dribbble_username; ?>', function (playerShots) {
					
					var html = [];
					
					$.each(playerShots.shots, function (i, shot) {
						html.push('<div><a href="' + shot.url + '"><img src="' + shot.image_url + '" alt="' + shot.title + '"></a></div>');
					});

					$('#dribbble_<?php echo $id; ?>').html(html.join(''));

				}, { page: 1, per_page: '<?php echo $vk_dribbble_postcount; ?>' });

			});
			</script>
            
            <div id="dribbble_<?php echo $id; ?>" class="dribbble"></div>
           
            <div class="clear"></div><?php

		// widget after
		echo $after_widget;

	}

	
/*-----------------------------------------------------------------------------------*/
/*
/*	Update Widget
/*
/*-----------------------------------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['username'] = strip_tags( $new_instance['username'] );

		$instance['postcount'] = strip_tags( $new_instance['postcount'] );

		return $instance;
	}
	
/*-----------------------------------------------------------------------------------*/
/*
/*	Widget Settings
/*
/*-----------------------------------------------------------------------------------*/
		 
	function form( $instance ) {

		// defaults
		$defaults = array(
			'title' => 'Latest Dribbble Shots',
			'username' => 'envato',
			'postcount' => '1',
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Dribbble Username:', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of Shots:', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
		</p>		
	<?php
	}
}
?>