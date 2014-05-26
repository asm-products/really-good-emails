<?php

/*
Plugin Name: Visualkicks - Social Widget
Plugin URI: http://www.visualkicks.com/plugins
Description: Enables a Social Icons widget for use in our compatible Visualkicks themes 
Version: 1.2
Author: Visualkicks
Author URI: http://www.visualkicks.com

Changelog

12/01/2013 - Version 1.2
- all visualkick themes come with font awesome in their framework so we have removed it from the widget
- styelsheet is only printed if widget is actually in use

29/11/2013 - Version 1.1
- icon handle is now 'fa-'. All themes should use the same handle
- removed theme check classes "non-visualkicks" as it is no longer needed
- icon font set to 'FontAwesome' with !important rule
- added a -5px bottom margin to the widget container

/*-----------------------------------------------------------------------------------*/

	// widget init
	add_action( 'widgets_init', 'vk_social_widget' );

	// register widget
	function vk_social_widget() {

		register_widget( 'VK_Social_Widget' );

	}

/*-----------------------------------------------------------------------------------*/
/*
/*	Register Styles
/*
/*-----------------------------------------------------------------------------------*/

    function vk_social_register_scripts() {

    	// register
	    wp_register_style('widget-social', plugins_url( '/widget-social.css', __FILE__ ), 'all');

		// only print if widget is in use
		global $add_social_scripts;
		if ( ! $add_social_scripts ) {

			return;

		} else {

		    // enqueue
		    wp_print_styles('widget-social');

		}

	}
    add_action('wp_footer', 'vk_social_register_scripts'); // add plugin styles after the theme styles


/*-----------------------------------------------------------------------------------*/
/*
/*	Widget Setup
/*
/*-----------------------------------------------------------------------------------*/

	// widget class
	class vk_social_widget extends WP_Widget {

	function VK_Social_Widget() {
	
		// settings
		$widget_ops = array( 
		    'classname' => 'vk_social_widget', 
		    'description' => __('A widget that displays a set buttons that link to your social profiles.', 'framework') 
		);

		// control
		$control_ops = array( 
		    'width' => 300, 
		    'height' => 350,
		    'id_base' => 'vk_social_widget'
		);

		// create
		$this->WP_Widget( 'vk_social_widget', __('Social Icons', 'framework'), $widget_ops, $control_ops );

	}

/*-----------------------------------------------------------------------------------*/
/*
/*	Display Widget
/*
/*-----------------------------------------------------------------------------------*/

	// widget output
	function widget( $args, $instance ) {
		extract( $args );

		// variables
		$title = apply_filters('widget_title', $instance['title'] );

		$android = $instance['android'];

		$apple = $instance['apple'];

		$dribbble = $instance['dribbble'];

		$dropbox = $instance['dropbox'];

		$facebook = $instance['facebook'];

		$flickr = $instance['flickr'];

		$foursquare = $instance['foursquare'];

		$github = $instance['github'];

		$google = $instance['google'];

		$instagram = $instance['instagram'];

		$linkedin = $instance['linkedin'];

		$pinterest = $instance['pinterest'];

		$renren = $instance['renren'];

		$skype = $instance['skype'];

		$trello = $instance['trello'];

		$tumblr = $instance['tumblr'];

		$twitter = $instance['twitter'];

		$vimeo = $instance['vimeo'];

		$vk = $instance['vk'];

		$weibo = $instance['weibo'];

		$windows = $instance['windows'];

		$xing = $instance['xing'];

		$youtube = $instance['youtube'];

		$rss = $instance['rss'];

		// add script global
		global $add_social_scripts;
		$add_social_scripts = true;

		// widget before
		echo $before_widget;

		// widget title
		if ( $title ) { echo $before_title . $title . $after_title; } ?>

		<div class="social-widget">

			<?php if($android!='') { ?><a href="<?php echo $android; ?>" class="button icon android fa-android"></a><?php } ?>

			<?php if($apple!='') { ?><a href="<?php echo $apple; ?>" class="button icon apple fa-apple"></a><?php } ?>

			<?php if($dribbble!='') { ?><a href="<?php echo $dribbble; ?>" class="button icon dribbble fa-dribbble"></a><?php } ?>

			<?php if($dropbox!='') { ?><a href="<?php echo $dropbox; ?>" class="button icon dropbox fa-dropbox"></a><?php } ?>

			<?php if($facebook!='') { ?><a href="<?php echo $facebook; ?>" class="button icon facebook fa-facebook"></a><?php } ?>

			<?php if($flickr!='') { ?><a href="<?php echo $flickr; ?>" class="button icon flickr fa-flickr"></a><?php } ?>

			<?php if($foursquare!='') { ?><a href="<?php echo $foursquare; ?>" class="button icon foursquare fa-foursquare"></a><?php } ?>

			<?php if($github!='') { ?><a href="<?php echo $github; ?>" class="button icon github fa-github"></a><?php } ?>

			<?php if($google!='') { ?><a href="<?php echo $google; ?>" class="button icon google fa-google-plus"></a><?php } ?>

			<?php if($instagram!='') { ?><a href="<?php echo $instagram; ?>" class="button icon instagram fa-instagram"></a><?php } ?>

			<?php if($linkedin!='') { ?><a href="<?php echo $linkedin; ?>" class="button icon linkedin fa-linkedin"></a><?php } ?>

			<?php if($pinterest!='') { ?><a href="<?php echo $pinterest; ?>" class="button icon pinterest fa-pinterest"></a><?php } ?>

			<?php if($renren!='') { ?><a href="<?php echo $renren; ?>" class="button icon renren fa-renren"></a><?php } ?>

			<?php if($skype!='') { ?><a href="<?php echo $skype; ?>" class="button icon skype fa-skype"></a><?php } ?>

			<?php if($trello!='') { ?><a href="<?php echo $trello; ?>" class="button icon trello fa-trello"></a><?php } ?>

			<?php if($tumblr!='') { ?><a href="<?php echo $tumblr; ?>" class="button icon tumblr fa-tumblr"></a><?php } ?>

			<?php if($twitter!='') { ?><a href="<?php echo $twitter; ?>" class="button icon twitter fa-twitter"></a><?php } ?>

			<?php if($vimeo!='') { ?><a href="<?php echo $vimeo; ?>" class="button icon vimeo fa-vimeo-square"></a><?php } ?>

			<?php if($vk!='') { ?><a href="<?php echo $vk; ?>" class="button icon vk fa-vk"></a><?php } ?>

			<?php if($weibo!='') { ?><a href="<?php echo $weibo; ?>" class="button icon weibo fa-weibo"></a><?php } ?>

			<?php if($windows!='') { ?><a href="<?php echo $windows; ?>" class="button icon windows fa-windows"></a><?php } ?>

			<?php if($xing!='') { ?><a href="<?php echo $xing; ?>" class="button icon xing fa-xing"></a><?php } ?>

			<?php if($youtube!='') { ?><a href="<?php echo $youtube; ?>" class="button icon youtube fa-youtube"></a><?php } ?>

			<?php if($rss!='') { ?><a href="<?php echo $rss; ?>" class="button icon rss fa-rss"></a><?php } ?>

		</div>

		<?php // widget after
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

		$instance['android'] = strip_tags( $new_instance['android'] );

		$instance['apple'] = strip_tags( $new_instance['apple'] );

		$instance['dribbble'] = strip_tags( $new_instance['dribbble'] );

		$instance['dropbox'] = strip_tags( $new_instance['dropbox'] );

		$instance['facebook'] = strip_tags( $new_instance['facebook'] );

		$instance['flickr'] = strip_tags( $new_instance['flickr'] );

		$instance['foursquare'] = strip_tags( $new_instance['foursquare'] );

		$instance['github'] = strip_tags( $new_instance['github'] );

		$instance['google'] = strip_tags( $new_instance['google'] );

		$instance['instagram'] = strip_tags( $new_instance['instagram'] );

		$instance['linkedin'] = strip_tags( $new_instance['linkedin'] );

		$instance['pinterest'] = strip_tags( $new_instance['pinterest'] );

		$instance['renren'] = strip_tags( $new_instance['renren'] );

		$instance['skype'] = strip_tags( $new_instance['skype'] );

		$instance['trello'] = strip_tags( $new_instance['trello'] );

		$instance['tumblr'] = strip_tags( $new_instance['tumblr'] );

		$instance['twitter'] = strip_tags( $new_instance['twitter'] );

		$instance['vimeo'] = strip_tags( $new_instance['vimeo'] );

		$instance['vk'] = strip_tags( $new_instance['vk'] );

		$instance['weibo'] = strip_tags( $new_instance['weibo'] );

		$instance['windows'] = strip_tags( $new_instance['windows'] );

		$instance['xing'] = strip_tags( $new_instance['xing'] );

		$instance['youtube'] = strip_tags( $new_instance['youtube'] );

		$instance['rss'] = strip_tags( $new_instance['rss'] );

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
			'title' => 'Social Icons',
			'android' => '',
			'apple' => '',
			'dribbble' => '',
			'dropbox' => '',
			'facebook' => '',
			'flickr' => '',
			'foursquare' => '',
			'github' => '',
			'google' => '',
			'instagram' => '',
			'linkedin' => '',
			'pinterest' => '',
			'renren' => '',
			'skype' => '',
			'trello' => '',
			'tumblr' => '',
			'twitter' => '',
			'vimeo' => '',
			'vk' => '',
			'weibo' => '',
			'windows' => '',
			'xing' => '',
			'youtube' => '',
			'rss' => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'android' ); ?>"><?php _e('android', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'android' ); ?>" name="<?php echo $this->get_field_name( 'android' ); ?>" value="<?php echo $instance['android']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'apple' ); ?>"><?php _e('apple', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'apple' ); ?>" name="<?php echo $this->get_field_name( 'apple' ); ?>" value="<?php echo $instance['apple']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'dribbble' ); ?>"><?php _e('dribbble', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" value="<?php echo $instance['dribbble']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'dropbox' ); ?>"><?php _e('dropbox', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'dropbox' ); ?>" name="<?php echo $this->get_field_name( 'dropbox' ); ?>" value="<?php echo $instance['dropbox']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('facebook', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e('flickr', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo $instance['flickr']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'foursquare' ); ?>"><?php _e('foursquare', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'foursquare' ); ?>" name="<?php echo $this->get_field_name( 'foursquare' ); ?>" value="<?php echo $instance['foursquare']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'github' ); ?>"><?php _e('github', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'github' ); ?>" name="<?php echo $this->get_field_name( 'github' ); ?>" value="<?php echo $instance['github']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'google' ); ?>"><?php _e('google', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'google' ); ?>" name="<?php echo $this->get_field_name( 'google' ); ?>" value="<?php echo $instance['google']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e('instagram', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo $instance['instagram']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('linkedin', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo $instance['linkedin']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e('pinterest', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo $instance['pinterest']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'renren' ); ?>"><?php _e('renren', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'renren' ); ?>" name="<?php echo $this->get_field_name( 'renren' ); ?>" value="<?php echo $instance['renren']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'skype' ); ?>"><?php _e('skype', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'skype' ); ?>" name="<?php echo $this->get_field_name( 'skype' ); ?>" value="<?php echo $instance['skype']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'trello' ); ?>"><?php _e('trello', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'trello' ); ?>" name="<?php echo $this->get_field_name( 'trello' ); ?>" value="<?php echo $instance['trello']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tumblr' ); ?>"><?php _e('tumblr', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'tumblr' ); ?>" name="<?php echo $this->get_field_name( 'tumblr' ); ?>" value="<?php echo $instance['tumblr']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('twitter', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e('vimeo', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo $instance['vimeo']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'vk' ); ?>"><?php _e('vk', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'vk' ); ?>" name="<?php echo $this->get_field_name( 'vk' ); ?>" value="<?php echo $instance['vk']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'weibo' ); ?>"><?php _e('weibo', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'weibo' ); ?>" name="<?php echo $this->get_field_name( 'weibo' ); ?>" value="<?php echo $instance['weibo']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'windows' ); ?>"><?php _e('windows', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'windows' ); ?>" name="<?php echo $this->get_field_name( 'windows' ); ?>" value="<?php echo $instance['windows']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'xing' ); ?>"><?php _e('xing', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'xing' ); ?>" name="<?php echo $this->get_field_name( 'xing' ); ?>" value="<?php echo $instance['xing']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e('youtube', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e('rss', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo $instance['rss']; ?>" />
		</p>
	<?php
	}

}

?>