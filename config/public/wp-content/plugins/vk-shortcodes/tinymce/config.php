<?php

/*-----------------------------------------------------------------------------------*/
/*
/*	Button Config
/*
/*-----------------------------------------------------------------------------------*/

$visual_shortcodes['button'] = array(
	'no_preview' => true,
	'params' => array(
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Button URL', 'framework'),
			'desc' => __('Add the button\'s url eg http://example.com', 'framework')
		),
		'style' => array(
			'type' => 'select',
			'label' => __('Button Style', 'framework'),
			'desc' => __('Select the button\'s style, ie the button\'s colour', 'framework'),
			'options' => array(
				'default' => 'Default (set by theme)',
				'grey' => 'Grey',
				'green' => 'Green',
				'light-blue' => 'Light Blue',
				'blue' => 'Blue',
				'red' => 'Red',
				'orange' => 'Orange',
				'purple' => 'Purple',
				'black' => 'Black',
				'white' => 'White',
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => __('Button Size', 'framework'),
			'desc' => __('Select the button\'s size', 'framework'),
			'options' => array(
				'small' => 'Small',
				'medium' => 'Medium',
				'large' => 'Large'
			)
		),
		'target' => array(
			'type' => 'select',
			'label' => __('Button Target', 'framework'),
			'desc' => __('_self = open in same window. _blank = open in new window', 'framework'),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),
		'content' => array(
			'std' => 'Button Text',
			'type' => 'text',
			'label' => __('Button\'s Text', 'framework'),
			'desc' => __('Add the button\'s text', 'framework'),
		)
	),
	'shortcode' => '[visual_button url="{{url}}" style="{{style}}" size="{{size}}" target="{{target}}"] {{content}} [/visual_button]',
	'popup_title' => __('Insert Button Shortcode', 'framework')
);

/*-----------------------------------------------------------------------------------*/
/*
/*	Alert Config
/*
/*-----------------------------------------------------------------------------------*/

$visual_shortcodes['alert'] = array(
	'no_preview' => true,
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => __('Alert Style', 'framework'),
			'desc' => __('Select the alert\'s style, ie the alert colour', 'framework'),
			'options' => array(
				'white' => 'White',
				'grey' => 'Grey',
				'red' => 'Red',
				'yellow' => 'Yellow',
				'green' => 'Green'
			)
		),
		'content' => array(
			'std' => 'Your Alert!',
			'type' => 'textarea',
			'label' => __('Alert Text', 'framework'),
			'desc' => __('Add the alert\'s text', 'framework'),
		)
		
	),
	'shortcode' => '[visual_alert style="{{style}}"] {{content}} [/visual_alert]',
	'popup_title' => __('Insert Alert Shortcode', 'framework')
);

/*-----------------------------------------------------------------------------------*/
/*
/*	Toggle Config
/*
/*-----------------------------------------------------------------------------------*/

$visual_shortcodes['toggle'] = array(
	'no_preview' => true,
	'params' => array(
		'title' => array(
			'type' => 'text',
			'label' => __('Toggle Content Title', 'framework'),
			'desc' => __('Add the title that will go above the toggle content', 'framework'),
			'std' => 'Title'
		),
		'content' => array(
			'std' => 'Content',
			'type' => 'textarea',
			'label' => __('Toggle Content', 'framework'),
			'desc' => __('Add the toggle content. Will accept HTML', 'framework'),
		),
		'state' => array(
			'type' => 'select',
			'label' => __('Toggle State', 'framework'),
			'desc' => __('Select the state of the toggle on page load', 'framework'),
			'options' => array(
				'open' => 'Open',
				'closed' => 'Closed'
			)
		),
		
	),
	'shortcode' => '[visual_toggle title="{{title}}" state="{{state}}"] {{content}} [/visual_toggle]',
	'popup_title' => __('Insert Toggle Content Shortcode', 'framework')
);

/*-----------------------------------------------------------------------------------*/
/*
/*	Tabs Config
/*
/*-----------------------------------------------------------------------------------*/

$visual_shortcodes['tabs'] = array(
    'params' => array(),
    'no_preview' => true,
    'shortcode' => '[visual_tabs] {{child_shortcode}}  [/visual_tabs]',
    'popup_title' => __('Insert Tab Shortcode', 'framework'),
    
    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Title',
                'type' => 'text',
                'label' => __('Tab Title', 'framework'),
                'desc' => __('Title of the tab', 'framework'),
            ),
            'content' => array(
                'std' => 'Tab Content',
                'type' => 'textarea',
                'label' => __('Tab Content', 'framework'),
                'desc' => __('Add the tabs content', 'framework')
            )
        ),
        'shortcode' => '[visual_tab title="{{title}}"] {{content}} [/visual_tab]',
        'clone_button' => __('Add Tab', 'framework')
    )
);

/*-----------------------------------------------------------------------------------*/
/*
/*	Columns Config
/*
/*-----------------------------------------------------------------------------------*/

$visual_shortcodes['columns'] = array(
	'params' => array(),
	'shortcode' => ' {{child_shortcode}} ', // as there is no wrapper shortcode
	'popup_title' => __('Insert Columns Shortcode', 'framework'),
	'no_preview' => true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __('Column Type', 'framework'),
				'desc' => __('Select the type, ie width of the column.', 'framework'),
				'options' => array(
					'visual_one_third' => 'One Third',
					'visual_one_third_last' => 'One Third Last',
					'visual_two_third' => 'Two Thirds',
					'visual_two_third_last' => 'Two Thirds Last',
					'visual_one_half' => 'One Half',
					'visual_one_half_last' => 'One Half Last',
					'visual_one_fourth' => 'One Fourth',
					'visual_one_fourth_last' => 'One Fourth Last',
					'visual_three_fourth' => 'Three Fourth',
					'visual_three_fourth_last' => 'Three Fourth Last'
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Column Content', 'framework'),
				'desc' => __('Add the column content.', 'framework'),
			)
		),
		'shortcode' => '[{{column}}] {{content}} [/{{column}}] ',
		'clone_button' => __('Add Column', 'framework')
	)
);

?>