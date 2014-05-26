<?php
/*-----------------------------------------------------------------------------------*/

    /* This file contains all the custom metaboxes for our posts and pages */
    /* WARNING: Do not change anything in here or things will quickly break */

/*-----------------------------------------------------------------------------------*/
/*	Set up the nonce and prefix
/*-----------------------------------------------------------------------------------*/

    $pfx = 'vk_';
    $nonce = basename(__FILE__);

/*-----------------------------------------------------------------------------------*/
/*	Define Metaboxes
/*-----------------------------------------------------------------------------------*/

// General Page Settings
$metabox_page = array(
	'id' => 'vk-metabox-page',
	'title' => 'General Page Settings',
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'low',
	'fields' => array(
    	array( 'name' => 'Display Post Title',
			   'desc' => 'Check this if want the post title to be visible.',
			   'id' => $pfx . 'post_title',
			   'type' => 'checkbox',
			   'std' => 'on',
		),
    )
);


// Contact Page Settings
$metabox_contact = array(
	'id' => 'vk-metabox-contact',
	'title' =>  'Contact Page Settings',
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'low',
	'fields' => array(
    	array( 'name' => 'Contact Form Header',
			   'desc' => 'The text placed above the contact form (eg: Send us an email).',
			   'id' => $pfx . 'contact_header',
			   'type' => "text",
			   'std' => 'Send us an email',
		),
    	array( 'name' => 'Contact Form Header Icon',
			   'desc' => 'The icon placed at the front of the header.',
			   'id' => $pfx . 'contact_icon',
			   'type' => 'select',
			   'std' => 'envelope',
			   'options' => array(
					'envelope',
					'heart',
					'chat',
			   	)
		),
    	array( 'name' => 'Contact Form Email Address',
			   'desc' => 'Where will the contact form be sent? Leaving this blank will default to the admin email address.',
			   'id' => $pfx . 'contact_email',
			   'type' => "text",
			   'std' => '',
		),
    	array( 'name' => 'Contact Form Subject Line',
			   'desc' => 'An optional subject line that will be used for the email.',
			   'id' => $pfx . 'contact_subject',
			   'type' => "text",
			   'std' => '',
		),
    	array( 'name' => 'Google Maps Address',
			   'desc' => 'The address used to retrive your google map. Leaving this blank result in no map.',
			   'id' => $pfx . 'contact_address',
			   'type' => "text",
			   'std' => '',
		),

    )
);


// permalink
$default_permalink = get_option('vk_default_permalink');
if($default_permalink == 1) { $default_permalink = 'on'; } else { $default_permalink = 'off'; }

// lightbox
$default_lightbox = get_option('vk_default_lightbox');
if($default_lightbox == 1) { $default_lightbox = 'on'; } else { $default_lightbox = 'off'; }

// content
$default_content = get_option('vk_default_content');

// meta
$default_meta = get_option('vk_default_meta');

// title
$default_title = get_option('vk_default_title');
if($default_title == 1) { $default_title = 'on'; } else { $default_title = 'off'; }

// social
$default_social = get_option('vk_default_social');
if($default_social == 1) { $default_social = 'on'; } else { $default_social = 'off'; }

// pagination
$default_pagination = get_option('vk_default_pagination');
if($default_pagination == 1) { $default_pagination = 'on'; } else { $default_pagination = 'off'; }

// author
$default_author = get_option('vk_default_author');
if($default_author == 1) { $default_author = 'on'; } else { $default_author = 'off'; }

// comments
$default_comments = get_option('vk_default_comments');
if($default_comments == 1) { $default_comments = 'on'; } else { $default_comments = 'off'; }

// similar posts
$default_similar = get_option('vk_default_similar');
if($default_similar == 1) { $default_similar = 'on'; } else { $default_similar = 'off'; }

// quote link text color
$default_ql_text = get_option('vk_default_ql_text');

// quote link background color
$default_ql_background = get_option('vk_default_ql_background');


// Post Settings
$metabox_post_settings = array(
	'id' => 'vk-metabox-post-settings',
	'title' => 'Post Settings',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'low',
	'fields' => array(
    	array( 'name' => 'Include Permalink Hover Icon',
			   'desc' => 'Choose to add a clickable permalink icon to this post.',
			   'id' => $pfx . 'post_permalink',
			   'type' => 'checkbox',
			   'std' => $default_permalink,
		),
    	array( 'name' => 'Include Lightbox Hover Icon',
			   'desc' => 'Choose to add a clickable lightbox icon to this post. This will only work if post has image attachments.',
			   'id' => $pfx . 'post_lightbox',
			   'type' => 'checkbox',
			   'std' => $default_lightbox,
		),
    	array( 'name' => 'Content Visability',
			   'desc' => 'Select when the post content, title and meta is displayed.</br><strong>This will default to "Never Show" if there is no content.</strong>',
			   'id' => $pfx . 'post_content',
			   'type' => 'select',
			   'std' => $default_content,
			   'options' => array(
					'Always show',
					'Only show on post page',
					'Never show',
			   	)
		),
    	array( 'name' => 'Post Meta Visability',
			   'desc' => 'Select when the post meta is displayed. This is at the mercy of the above content setting.',
			   'id' => $pfx . 'post_meta',
			   'type' => 'select',
			   'std' => $default_meta,
			   'options' => array(
					'Always show',
					'Only show on post page',
					'Never show',
			   	)
		),
    	array( 'name' => 'Display Post Title',
			   'desc' => 'Check this if want the post title to be visible. Only visible if content is turned on.',
			   'id' => $pfx . 'post_title',
			   'type' => 'checkbox',
			   'std' => $default_title,
		),
    	array( 'name' => 'Display Post Sharing Buttons',
			   'desc' => 'Check this if you want the social sharing buttons to be visible.',
			   'id' => $pfx . 'post_social',
			   'type' => 'checkbox',
			   'std' => $default_social,
		),
    	array( 'name' => 'Display Post Pagination',
			   'desc' => 'Check this if you want the post pagination links to be visible',
			   'id' => $pfx . 'post_pagination',
			   'type' => 'checkbox',
			   'std' => $default_pagination,
		),
    	array( 'name' => 'Display Author Badge',
			   'desc' => 'Choose to display this posts author badge at the bottom of the post.',
			   'id' => $pfx . 'post_author',
			   'type' => 'checkbox',
			   'std' => $default_author,
		),
    	array( 'name' => 'Display Comments',
			   'desc' => 'Choose to display the comment form and comments. This does not close comments, it just hides them.',
			   'id' => $pfx . 'post_commments',
			   'type' => 'checkbox',
			   'std' => $default_comments,
		),
    	array( 'name' => 'Display Similar Posts',
			   'desc' => 'Choose to display similar posts to this one. Similar posts are based on tags.',
			   'id' => $pfx . 'post_similar',
			   'type' => 'checkbox',
			   'std' => $default_similar,
		),
    	array( 'name' => 'Post Label',
			   'desc' => 'Post labels can only be 4 letters or smaller.',
			   'id' => $pfx . 'accent_text',
			   'type' => "text",
			   'std' => '',
		),
    )
);

// Audio Post
$metabox_audio = array(
	'id' => 'vk-metabox-audio',
	'title' => 'Audio Post Settings',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
    	array( 'name' => 'Audio File URL or Embed Code',
			   'desc' => 'Insert a URL to an audio file (.mp3 for best compatibility) OR paste your 3rd party (eg: soundcloud, spotify) embed code here. ',
			   'id' => $pfx . 'audio',
			   'type' => 'textarea',
			   'std' => '',
    	),
    	array( 'name' =>  '',
			   'desc' => '',
			   'id' => $pfx . 'audio_button',
			   'type' => 'button',
			   'std' => 'Browse',
			   'media' => 'select',
			   'for' => $pfx . 'audio',
    	),
    )
);

// Chat Post
$metabox_chat = array(
	'id' => 'vk-metabox-chat',
	'title' => 'Chat Post Settings',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
    	array( 'name' => 'Chat Dialog',
			   'desc' => 'The chat dialog can suppot up to 5 speakers and needs to be formated like this:</br></br>John: Hello</br>Gary: Hi John</br>Jenna: See ya later.',
			   'id' => $pfx . 'chat',
			   'type' => 'textarea',
			   'std' => '',
    	),
    )
);


// Gallery Post
$metabox_gallery = array(
	'id' => 'vk-metabox-gallery',
	'title' => 'Gallery Post Settings',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
    	array( 'name' => 'Gallery Style',
			   'desc' => 'Select what type of gallery post this will be.',
			   'id' => $pfx . 'gallery',
			   'type' => 'select',
			   'std' => 'Always',
			   'options' => array(
					'slider'=>'Slider',
					'thumbnails'=>'Thumbnails',
			   	),
		),
    	array( 'name' => 'Gallery Images',
			   'desc' => 'All images uploaded to this post will be used in the gallery.',
			   'id' => $pfx . 'gallery_button',
			   'type' => 'button',
			   'std' => 'Upload Images',
			   'media' => 'upload',
    	),
    )
);


// Link Post
$metabox_link = array(
	'id' => 'vk-metabox-link',
	'title' => 'Link Post Settings',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
    	array( 'name' => 'Link URL',
			   'desc' => 'The hyperlink displayed in the post',
			   'id' => $pfx . 'link_url',
			   'type' => 'text',
			   'std' => '',
		),
    	array( 'name' => 'Optional Link Description',
			   'desc' => 'An optional short description about the link.',
			   'id' => $pfx . 'link_desc',
			   'type' => 'text',
			   'std' => '',
		),
    	array( 'name' => 'Text Color',
			   'desc' => 'The color of the text.',
			   'id' => $pfx . 'link_color',
			   'type' => 'color',
			   'std' => $default_ql_text,
		),
    	array( 'name' => 'Background Color',
			   'desc' => 'The background color. Featured images are used as background images by default.',
			   'id' => $pfx . 'link_bgcolor',
			   'type' => 'color',
			   'std' => $default_ql_background,
		),
    	array( 'name' => 'Background Overlay Color',
			   'desc' => 'This color will be at 50% opacity.',
			   'id' => $pfx . 'link_overlay',
			   'type' => 'color',
			   'std' => '',
		),

    )
);

// Quote Post
$metabox_quote = array(
	'id' => 'vk-metabox-quote',
	'title' => 'Quote Post Settings',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
    	array( 'name' => 'The Quote',
			   'desc' => 'The actual quote for this post.',
			   'id' => $pfx . 'quote_text',
			   'type' => 'text',
			   'std' => '',
		),
    	array( 'name' => 'Optional Quote Reference',
			   'desc' => 'A persons name or the quotes source (url, book etc).',
			   'id' => $pfx . 'quote_source',
			   'type' => 'text',
			   'std' => '',
		),
    	array( 'name' => 'Text Color',
			   'desc' => 'The color of the text.',
			   'id' => $pfx . 'quote_color',
			   'type' => 'color',
			   'std' => $default_ql_text,
		),
    	array( 'name' => 'Background Color',
			   'desc' => 'The background color. Featured images are used as background images by default.',
			   'id' => $pfx . 'quote_bgcolor',
			   'type' => 'color',
			   'std' => $default_ql_background,
		),
    	array( 'name' => 'Background Overlay Color',
			   'desc' => 'This color will be at 50% opacity.',
			   'id' => $pfx . 'quote_overlay',
			   'type' => 'color',
			   'std' => '',
		),

    )
);

// Satus Post
$metabox_status = array(
	'id' => 'vk-metabox-status',
	'title' => 'Status Post Settings',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
    	array( 'name' => 'Embedded Twitter Code',
			   'desc' => 'If you would rather embed a tweet you can do so here. Code here will overide any content above and all post settings. <strong>Posts will still require a title</strong>.',
			   'id' => $pfx . 'status_embed',
			   'type' => 'textarea',
			   'std' => '',
		),
    )
);

// Video Post
$metabox_video = array(
	'id' => 'vk-metabox-video',
	'title' => 'Video Post Settings',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
    	array( 'name' => 'Embed Code',
			   'desc' => 'If you want to use a 3rd party embedded video (eg: youtube, vimeo), paste your embed code here. Otherwise leave this field blank.',
			   'id' => $pfx . 'video_embed',
			   'type' => 'textarea',
			   'std' => '',
    	),

    	/*-------------------------------------------------------------------------------------------------------*/
    		/* Divider */ array( 'name' =>  '', 'desc' => '', 'id' => $pfx . 'divider', 'type' => 'divider', ),
    	/*-------------------------------------------------------------------------------------------------------*/

    	array( 'name' => 'Self Hosted .mp4 File',
			   'desc' => '.mp4 files support Chrome, Safari  & IE9+.',
			   'id' => $pfx . 'video_mp4',
			   'type' => 'text',
			   'std' => '',
    	),
    	array( 'name' =>  '',
			   'desc' => '',
			   'id' => $pfx . 'video_mp4_button',
			   'type' => 'button',
			   'std' => 'Browse',
			   'media' => 'select',
			   'for' => $pfx . 'video_mp4',
    	),
    	array( 'name' => 'Self Hosted .ogv File',
			   'desc' => '.ogv files support Firefox & Opera.',
			   'id' => $pfx . 'video_ogv',
			   'type' => 'text',
			   'std' => '',
    	),
    	array( 'name' =>  '',
			   'desc' => '',
			   'id' => $pfx . 'video_ogv_button',
			   'type' => 'button',
			   'std' => 'Browse',
			   'media' => 'select',
			   'for' => $pfx . 'video_ogv',
    	),
    	array( 'name' => 'Self Hosted Video Poster',
			   'desc' => 'Select or upload a video poster for self hosted video. This will default to the featured image if not set.',
			   'id' => $pfx . 'video_poster',
			   'type' => 'text',
			   'std' => '',
		),
    	array( 'name' =>  '',
			   'desc' => '',
			   'id' => $pfx . 'video_poster_button',
			   'type' => 'button',
			   'std' => 'Browse',
			   'media' => 'select',
			   'for' => $pfx . 'video_poster',
    	),
    )
);

add_action('admin_menu', 'vk_add_box');


/*-----------------------------------------------------------------------------------*/
/*	Make a list of all the custom metaboxes to be used in later functions
/*-----------------------------------------------------------------------------------*/

	$metaboxes['boxes']['metabox_page'] = $metabox_page;
	$metaboxes['boxes']['metabox_contact'] = $metabox_contact;
	$metaboxes['boxes']['metabox_post_settings'] = $metabox_post_settings;
	$metaboxes['boxes']['metabox_post_audio'] = $metabox_audio;
	$metaboxes['boxes']['metabox_chat'] = $metabox_chat;
	$metaboxes['boxes']['metabox_gallery'] = $metabox_gallery;
	$metaboxes['boxes']['metabox_quote'] = $metabox_quote;
	$metaboxes['boxes']['metabox_link'] = $metabox_link;
	$metaboxes['boxes']['metabox_status'] = $metabox_status;
	$metaboxes['boxes']['metabox_post_video'] = $metabox_video;


/*-----------------------------------------------------------------------------------*/

    /* ! You should not have to touch anything below here. */
    /* ! All metaboxes in the above list are generated automatically */

/*-----------------------------------------------------------------------------------*/
/*	Add And Show Metaboxes
/*-----------------------------------------------------------------------------------*/

	if ( !function_exists( 'vk_add_box' ) ) {
		function vk_add_box() {

			// Get the nonce and list
			global $nonce, $metaboxes;

			// Add each metabox
			foreach ($metaboxes['boxes'] as $metabox) { vk_add_meta_box($metabox, $nonce); }

		}
	}

/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/

	if ( !function_exists( 'vk_save_data' ) ) {
		function vk_save_data($post_id) {

				// verify nonce
				if (!isset($_POST['jn_meta_box_nonce']) || !wp_verify_nonce($_POST['jn_meta_box_nonce'], basename(__FILE__)) ) {
					return $post_id;
				}

				// check autosave
				if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
					return $post_id;
				}

				// check permissions
				if ('page' == $_POST['post_type']) {
					if (!current_user_can('edit_page', $post_id)) {
						return $post_id;
					}

				// else
				} elseif (!current_user_can('edit_post', $post_id)) {
					return $post_id;

				}

			// Get the metabox list
			global $metaboxes;

			// Save each metabox
			foreach ($metaboxes['boxes'] as $metabox) { vk_save_meta_box($post_id, $metabox); }

		}
		add_action('save_post', 'vk_save_data');
	}

/*-----------------------------------------------------------------------------------*/
/*	Enqueue Metabox Scripts
/*-----------------------------------------------------------------------------------*/
	
	// Scripts
	function vk_theme_postmeta_scripts() {

		wp_enqueue_script('vk-color-picker', VK_DIRECTORY .'/framework/js/vk-colorpicker.js', array('jquery'));

	}
	add_action('admin_print_scripts', 'vk_theme_postmeta_scripts');


	// Styles
	function vk_theme_postmeta_styles() {

		wp_enqueue_style('vk-color-picker', VK_DIRECTORY .'/framework/css/vk-colorpicker.css');

	}
	add_action('admin_print_styles', 'vk_theme_postmeta_styles');


?>