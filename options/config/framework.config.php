<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings           = array(
	'menu_title'      => 'Theme Options',
	'menu_type'       => 'menu', // menu, submenu, options, theme, etc.
	'menu_slug'       => 'cs-framework',
	'ajax_save'       => true,
	'show_reset_all'  => false,
	'framework_title' => 'Lawyer theme <small>by ThemeMakers</small>',
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();

// ----------------------------------------
// General option section           -
// ----------------------------------------
$options[]      = array(
	'name'        => 'general',
	'title'       => 'General',
	'icon'        => 'fa fa-cog',
	'fields'      => array(
		array(
			'id'      	 => 'main_theme_color',
			'type'    	 => 'color_picker',
			'title'   	 => 'Main theme color',
			'default' 	 => '#b1001e',
		),
		array(
			'id'      => 'site_favicon',
			'type'    => 'upload',
			'title'   => 'Site favicon',
			'desc'    => 'Upload any media using the WordPress Native Uploader.'
		),
		array(
			'id'      => 'sidebar_position',
			'type'    => 'radio',
			'title'   => 'Sidebar position',
			'options' => array(
				'left'  => 'Left side',
				'right' => 'Right side',
				'none'  => 'No sidebar'
			),
			'default' => 'right',
		),
		array(
			'id'      => 'sticky_navigation',
			'type'    => 'switcher',
			'title'   => 'Enable Sticky Navigation',
			'default' => true
		),
		array(
            'id'         => 'custom_css_styles',
            'desc'       => 'Only CSS, without tag &lt;style&gt;.',
            'type'       => 'textarea',
            'title'      => 'Custom css code'
        ),
        array(
            'id'         => 'custom_js_code',
            'desc'       => 'Only JS code, without tag &lt;script&gt;.',
            'type'       => 'textarea',
            'title'      => 'Custom JavaScript code'
        )
	)
);


// ----------------------------------------
// Header and Footer					  -
// ----------------------------------------
$options[]      = array(
	'name'        => 'header',
	'title'       => 'Header and Footer',
	'icon'        => 'fa fa-star',
	'fields'      => array(
		array(
			'id'      => 'top_bar',
			'type'    => 'switcher',
			'title'   => 'Enable top bar',
			'default' => false
		),
		array(
			'id'              => 'tb_social',
			'type'            => 'group',
			'title'           => 'Social',
			'button_title'    => 'Add New',
			'accordion_title' => 'Add New Field',
			'fields'          => array(
				array(
					'id'         => 'icon',
					'type'       => 'icon',
					'title'      => 'Select Icon'
				),
				array(
					'id'         => 'link',
					'type'       => 'text',
					'title'      => 'Paste URL',
				)
			),
			'dependency' => array( 'top_bar', '==', true )
		),

		array(
			'id'      => 'header_additional_info',
			'type'    => 'switcher',
			'title'   => 'Additional info',
			'default' => false
		),
		array(
			'id'         => 'header_info_icon',
			'type'       => 'icon',
			'title'      => 'Info Icon',
			'dependency' => array( 'header_additional_info', '==', true )
		),
		array(
			'id'         => 'header_info_title',
			'type'       => 'text',
			'title'      => 'Info title',
			'dependency' => array( 'header_additional_info', '==', true )
		),
		array(
			'id'         => 'header_info_text',
			'type'       => 'textarea',
			'title'      => 'Info text',
			'dependency' => array( 'header_additional_info', '==', true ),
			'desc'   	 => esc_html__('Allowed HTML tags: div, span, a', 'lawyer'),
		),
		array(
			'id'         => 'header_style',
			'type'       => 'select',
			'title'      => 'Header style',
			'options'    => array(
				'one'   	=> 'Style 1',
				'two'   	=> 'Style 2',
				'three' 	=> 'Style 3'
			),
		),
		array(
			'id'      	 => 'header_search',
			'type'    	 => 'switcher',
			'title'   	 => 'Search form in menu',
			'default'	 => false
		),
		array(
			'id'         => 'logo_type',
			'type'       => 'select',
			'title'      => 'Logo Type',
			'options'    => array(
				'image'   => 'Image',
				'text'    => 'Text'
			),
		),
		array(
			'id'        => 'image_logo',
			'type'      => 'upload',
			'title'     => 'Logo',
			'default'	=> T_URI . '/assets/images/logo.png',
			'settings'      => array(
				'upload_type'  => 'image',
				'button_title' => 'Upload',
				'frame_title'  => 'Select an image',
				'insert_title' => 'Use this image',
			),
			'dependency' => array( 'logo_type', '==', 'image' )
		),
		array(
			'id'     	 => 'image_logo_width',
			'type'    	 => 'number',
			'title'   	 => 'Logo width',
			'dependency' => array( 'logo_type', '==', 'image' )
		),
		array(
			'id'     	 => 'text_logo',
			'type'    	 => 'text',
			'default'	 => 'Lawyer',
			'title'   	 => 'Text Logo',
			'dependency' => array( 'logo_type', '==', 'text' )
		),
		array(
			'id'        => 'logo_font_family',
			'type'      => 'typography',
			'title'     => 'Font family',
			'default'   => array(
				'family'  => 'Cabin',
				'font'    => 'google',
			),
			'variant'   => false,
			'chosen'    => false,
			'dependency' => array( 'logo_type', '==', 'text' )
		),
		array(
			'id'     	 => 'text_logo_size',
			'type'    	 => 'number',
			'default'	 => '34',
			'title'   	 => 'Text Logo Font Size',
			'dependency' => array( 'logo_type', '==', 'text' )
		),
		array(
			'id'      	 => 'text_logo_color',
			'type'    	 => 'color_picker',
			'title'   	 => 'Text Logo Color',
			'default' 	 => '#262626',
			'dependency' => array( 'logo_type', '==', 'text' )
		),	
		array(
			'id'      	 => 'text_logo_hover_color',
			'type'    	 => 'color_picker',
			'title'   	 => 'Text Logo Hover Color',
			'default' 	 => '#b1001e',
			'dependency' => array( 'logo_type', '==', 'text' )
		),	

		array(
			'type'    => 'notice',
			'class'   => 'info',
			'content' => 'Footer options',
		),
		array(
			'id'        => 'footer_logo',
			'type'      => 'upload',
			'title'     => 'Footer logo',
			'default'	=> T_URI . '/assets/images/logo-footer.png',
			'settings'      => array(
				'upload_type'  => 'image',
				'button_title' => 'Upload',
				'frame_title'  => 'Select an image',
				'insert_title' => 'Use this image',
			),
		),
		array(
			'id'              => 'footer_socials',
			'type'            => 'group',
			'title'           => 'Social icons',
			'button_title'    => 'Add New',
			'accordion_title' => 'Add New Field',
			'fields'          => array(
				array(
					'id'          => 'icon',
					'type'        => 'icon',
					'title'       => 'Select Icon'
				),
				array(
					'id'          => 'link',
					'type'        => 'text',
					'title'       => 'URL'
				),
			)
		),
		array(
			'id'        => 'footer_copy',
			'type'      => 'text',
			'title'     => 'Copyright text',
			'default'   => 'Copyright &copy; 2017. ThemeMakers. All rights reserved'
		),
		array(
			'id'        => 'footer_author',
			'type'      => 'wysiwyg',
			'title'     => 'Author text',
			'default'   => 'Developed by <a href="https://webtemplatemasters.com/">ThemeMakers</a>'
		),
		array(
			'id'      => 'footer_sidebar',
			'type'    => 'switcher',
			'title'   => 'Show sidebar in footer',
			'default' => false
		),
		array(
			'id'      	=> 'footer_background_color',
			'type'    	=> 'color_picker',
			'title'   	=> 'Footer Background Color',
			'desc'   	=> 'Work as overlay if background image is set.',
			'default' 	=> '#2e2e30'
		),
		array(
			'id'      	 => 'footer_cta',
			'type'    	 => 'switcher',
			'title'   	 => 'Footer Call to Action',
			'default'	 => false
		),
		array(
			'id'         => 'footer_cta_text',
			'type'       => 'text',
			'title'      => 'Main text',
			'dependency' => array( 'footer_cta', '==', true )
		),
		array(
			'id'         => 'footer_cta_btn_title',
			'type'       => 'text',
			'title'      => 'Button title',
			'dependency' => array( 'footer_cta', '==', true )
		),
		array(
			'id'         => 'footer_cta_btn_url',
			'type'       => 'text',
			'title'      => 'Button url',
			'dependency' => array( 'footer_cta', '==', true )
		),
	)
);


// ----------------------------------------
// API Settings				  			  -
// ----------------------------------------
$google_map = 'developers.google.com/maps/documentation/javascript/get-api-key';
$tw_apps = 'apps.twitter.com';
$options[]      = array(
	'name'        => 'api',
	'title'       => 'API Settings',
	'icon'        => 'fa fa-star',
	'fields'      => array(
		array(
			'type'    => 'notice',
			'class'   => 'info',
			'content' => 'Info: You can get Google Map API key <a target="_blank" href="' . esc_url( $google_map ) . '">here</a>.',
		),
		array(
			'id'      => 'google_map_key',
			'type'    => 'text',
			'title'   => 'Google Map API key',
			'default' => ''
		)
	)
);

// ----------------------------------------
// Styling	 							  -
// ----------------------------------------
$options[]      = array(
	'name'        => 'styling',
	'title'       => 'Styling',
	'icon'        => 'fa fa-paint-brush',
	'sections' => array(
		array(
			'name'      => 'main',
			'title'     => 'Main',
			'icon'      => 'fa fa-check',
			'fields'    => array(
				array(
					'type'    => 'notice',
					'class'   => 'info',
					'content' => 'Site Text',
				),
				array(
					'id'        => 'text_font_family',
					'type'      => 'typography',
					'title'     => 'Font family',
					'default'   => array(
						'family'  => 'Gudea',
						'font'    => 'google',
					),
					'variant'   => false,
					'chosen'    => true,
				),
				array(
					'id'      => 'text_font_size',
					'type'    => 'number',
					'title'   => 'Font size',
					'default' => '16'
				),
				array(
					'id'      	 => 'text_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text color',
					'default' 	 => '#777'
				),
				array(
					'id'      	 => 'text_links_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text links color',
					'default' 	 => '#b1001e'
				),
				array(
					'id'      	 => 'text_links_hovering_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text links hovering color',
					'default' 	 => '#000000'
				),
				/*
					Font family
					Font size
					Text color
					Text links color
					Text links hovering color
				*/
				// -------------------------------------------------
				array(
					'type'    => 'notice',
					'class'   => 'info',
					'content' => 'Site Backgrounds',
				),
				array(
					'id'      	 => 'top_bar_background_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Top bar background color',
					'default' 	 => '#2e2e30'
				),
				array(
					'id'      	 => 'header_background_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Header background color'
				),
				array(
					'id'         => 'body_background',
					'type'       => 'select',
					'title'      => 'Body background',
					'options'    => array(
						'color'   => 'Color',
						'image'   => 'Image',
					),
				),
				array(
					'id'      	 => 'body_background_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Body background color',
					'default' 	 => '#fff',
					'dependency' => array( 'body_background', '==', 'color' )
				),

				array(
					'id'        => 'body_background_image',
					'type'      => 'upload',
					'title'     => 'Body background image',
					'settings'      => array(
						'upload_type'  => 'image',
						'button_title' => 'Upload',
						'frame_title'  => 'Select an image',
						'insert_title' => 'Use this image',
					),
					'dependency' => array( 'body_background', '==', 'image' )
				),
				/*
					Top bar background color
					Header background color
					Site body background
					Background color
					Background image
				*/
			)
		),
		array(
			'name'      => 'headings',
			'title'     => 'Headings',
			'icon'      => 'fa fa-check',
			'fields'    => array(
				array(
					'type'    => 'notice',
					'class'   => 'info',
					'content' => 'H1 headings',
				),
				array(
					'id'        => 'h1_font_family',
					'type'      => 'typography',
					'title'     => 'Font family',
					'default'   => array(
						'family'  => 'Slabo 27px',
						'font'    => 'google',
					),
					'variant'   => false,
					'chosen'    => false,
				),
				array(
					'id'      => 'h1_font_size',
					'type'    => 'number',
					'title'   => 'Font size',
					'default' => '40'
				),
				array(
					'id'      	 => 'h1_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text color',
					'default' => '#000'
				),
				array(
					'id'      	 => 'h1_links_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text links color',
					'default' => '#000'
				),
				array(
					'id'      	 => 'h1_links_hover_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text links hovering color',
					'default' => '#b1001e'
				),
				array(
					'type'    => 'notice',
					'class'   => 'info',
					'content' => 'H2 headings',
				),
				array(
					'id'        => 'h2_font_family',
					'type'      => 'typography',
					'title'     => 'Font family',
					'default'   => array(
						'family'  => 'Slabo 27px',
						'font'    => 'google',
					),
					'variant'   => false,
					'chosen'    => false,
				),
				array(
					'id'      => 'h2_font_size',
					'type'    => 'number',
					'title'   => 'Font size',
					'default' => '32'
				),
				array(
					'id'      	 => 'h2_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text color',
					'default' 	 => '#000'
				),
				array(
					'id'      	 => 'h2_links_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text links color',
					'default' 	 => '#000'
				),
				array(
					'id'      	 => 'h2_links_hover_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text links hovering color',
					'default' 	 => '#b1001e'
				),
				array(
					'type'    => 'notice',
					'class'   => 'info',
					'content' => 'H3 headings',
				),
				array(
					'id'        => 'h3_font_family',
					'type'      => 'typography',
					'title'     => 'Font family',
					'default'   => array(
						'family'  => 'Slabo 27px',
						'font'    => 'google',
					),
					'variant'   => false,
					'chosen'    => false,
				),
				array(
					'id'      => 'h3_font_size',
					'type'    => 'number',
					'title'   => 'Font size',
					'default' => '24'
				),
				array(
					'id'      	 => 'h3_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text color',
					'default' 	=> '#000'
				),
				array(
					'id'      	 => 'h3_links_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text links color',
					'default' => '#000'
				),
				array(
					'id'      	 => 'h3_links_hover_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text links hovering color',
					'default' => '#b1001e'
				),
				array(
					'type'    => 'notice',
					'class'   => 'info',
					'content' => 'H4 headings',
				),
				array(
					'id'        => 'h4_font_family',
					'type'      => 'typography',
					'title'     => 'Font family',
					'default'   => array(
						'family'  => 'Slabo 27px',
						'font'    => 'google',
					),
					'variant'   => false,
					'chosen'    => false,
				),
				array(
					'id'      => 'h4_font_size',
					'type'    => 'number',
					'title'   => 'Font size',
					'default' => '21'
				),
				array(
					'id'      	 => 'h4_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text color',
					'default' 	 => '#000'
				),
				array(
					'id'      	 => 'h4_links_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text links color',
					'default' 	 => '#000'
				),
				array(
					'id'      	 => 'h4_links_hover_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text links hovering color',
					'default' 	 => '#b1001e'
				),


				array(
					'type'    => 'notice',
					'class'   => 'info',
					'content' => 'H5 headings',
				),
				array(
					'id'        => 'h5_font_family',
					'type'      => 'typography',
					'title'     => 'Font family',
					'default'   => array(
						'family'  => 'Slabo 27px',
						'font'    => 'google',
					),
					'variant'   => false,
					'chosen'    => false,
				),
				array(
					'id'      => 'h5_font_size',
					'type'    => 'number',
					'title'   => 'Font size',
					'default' => '15'

				),
				array(
					'id'      	 => 'h5_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text color',
					'default' 	 => '#777'
				),
				array(
					'id'      	 => 'h5_links_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text links color',
					'default' 	 => '#777'
				),
				array(
					'id'      	 => 'h5_links_hover_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text links hovering color',
					'default' 	 => '#b1001e'
				),
				array(
					'type'    => 'notice',
					'class'   => 'info',
					'content' => 'H6 headings',
				),
				array(
					'id'        => 'h6_font_family',
					'type'      => 'typography',
					'title'     => 'Font family',
					'default'   => array(
						'family'  => 'Slabo 27px',
						'font'    => 'google',
					),
					'variant'   => false,
					'chosen'    => false,
				),
				array(
					'id'      => 'h6_font_size',
					'type'    => 'number',
					'title'   => 'Font size',
					'default' => '16'
				),
				array(
					'id'      	 => 'h6_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text color',
					'default' 	 => '#000'
				),
				array(
					'id'      	 => 'h6_links_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text links color',
					'default' 	 => '#000'
				),
				array(
					'id'      	 => 'h6_links_hover_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text links hovering color',
					'default' 	 => '#b1001e'
				),
			)
		),
		array(
			'name'      => 'navigation',
			'title'     => 'Main Navigation',
			'icon'      => 'fa fa-check',
			'fields'    => array(
				array(
					'type'    => 'notice',
					'class'   => 'info',
					'content' => 'Main level',
				),
				array(
					'id'        => 'menu_font_family',
					'type'      => 'typography',
					'title'     => 'Font family',
					'default'   => array(
						'family'  => 'Slabo 27px',
						'font'    => 'google',
					),
					'variant'    => false,
					'chosen'     => false,
				),
				array(
					'id'      	 => 'menu_font_size',
					'type'    	 => 'number',
					'title'      => 'Font size',
					'default'    => '17'
				),

				array(
					'id'      	 => 'menu_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text color',
					'default'    => '#000'
				),
				array(
					'id'      	 => 'menu_hover_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text hovering color',
					'default'    => '#fff'
				),
				array(
					'type'    => 'notice',
					'class'   => 'info',
					'content' => 'Sublevels mega menu',
				),
				array(
					'id'      	 => 'submenu_bg_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Sublevel background color',
					'default'    => '#3a3a3c'
				),
				array(
					'id'        => 'submenu_title_font_family',
					'type'      => 'typography',
					'title'     => 'Mega menu title font family',
					'default'   => array(
						'family'  => 'Slabo 27px',
						'font'    => 'google',
					),
					'variant'    => false,
					'chosen'     => false,
				),
				array(
					'id'      	 => 'submenu_title_font_size',
					'type'    	 => 'number',
					'title'      => 'Mega menu title font size',
					'default'    => '17'
				),
				array(
					'id'      	 => 'submenu_title_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Mega menu title font color',
					'default'    => '#fff'
				),

				array(
					'type'    => 'notice',
					'class'   => 'info',
					'content' => 'Sublevels',
				),

				array(
					'id'        => 'submenu_font_family',
					'type'      => 'typography',
					'title'     => 'Font family',
					'default'   => array(
						'family'  => 'Gudea',
						'font'    => 'google',
					),
					'variant'    => false,
					'chosen'     => false,
				),
				array(
					'id'      	 => 'submenu_font_size',
					'type'    	 => 'number',
					'title'      => 'Font size',
					'default'    => '14'					
				),
				array(
					'id'      	 => 'submenu_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text color',
					'default'    => '#b4b4b4'
				),
				array(
					'id'      	 => 'submenu_hover_color',
					'type'    	 => 'color_picker',
					'title'   	 => 'Text hovering color',
					'default'    => '#fff'
				),
			)
		)
	)
);
// ----------------------------------------
// Blog	 								  -
// ----------------------------------------
$options[]      = array(
	'name'        => 'blog',
	'title'       => 'Blog',
	'icon'        => 'fa fa-book',
	'sections' => array(
		array(
			'name'      => 'blog',
			'title'     => 'Blog',
			'icon'      => 'fa fa-check',
			'fields'    => array(
				array(
					'id'      	 => 'blog_heading',
					'type'    	 => 'switcher',
					'title'   	 => 'Blog heading',
					'default'	 => false
				),
				array(
					'id'         => 'blog_heading_text',
					'type'       => 'text',
					'title'      => 'Heading text',
					'default'	 => 'News',
					'dependency' => array( 'blog_heading', '==', true )
				),
				array(
					'id'         => 'blog_heading_bg',
					'type'       => 'switcher',
					'title'      => 'Enable heading background image',
					'default'    => false
				),
				array(
					'id'        => 'blog_heading_background_image',
					'type'      => 'upload',
					'title'     => 'Heading default background image',
					'default'	=> T_URI . '/assets/images/banner-img--news.jpg',
					'settings'      => array(
						'upload_type'  => 'image',
						'button_title' => 'Upload',
						'frame_title'  => 'Select an image',
						'insert_title' => 'Use this image',
					),
					'dependency' => array( 'blog_heading_bg', '==', true )
				),
				array(
					'id'      	 => 'blog_breadcrumbs',
					'type'    	 => 'switcher',
					'title'   	 => 'Blog breadcrumbs',
					'default'	 => false
				),
				array(
					'id'         => 'excerpt_symbol_count',
					'type'       => 'number',
					'title'      => 'Excerpt length'
				),
				array(
					'id'      	 => 'blog_date',
					'type'    	 => 'switcher',
					'title'   	 => 'Show date',
					'default'	 => true
				),
				array(
					'id'      	 => 'blog_apollo_images',
					'type'    	 => 'switcher',
					'title'   	 => 'Apollo style for images',
					'default'	 => true
				),
				array(
					'id'      	 => 'blog_author',
					'type'    	 => 'switcher',
					'title'   	 => 'Show author',
					'default'	 => true
				),
				array(
					'id'      	 => 'blog_category',
					'type'    	 => 'switcher',
					'title'   	 => 'Show category',
					'default'	 => true
				),
				array(
					'id'      	 => 'blog_tags',
					'type'    	 => 'switcher',
					'title'   	 => 'Show tags',
					'default'	 => true
				),
				array(
					'id'      	 => 'blog_comments',
					'type'    	 => 'switcher',
					'title'   	 => 'Show comments',
					'default'	 => true
				),
			)
		),
		array(
			'name'      => 'post',
			'title'     => 'Post',
			'icon'      => 'fa fa-check',
			'fields'    => array(
				array(
					'id'      	 => 'post_heading',
					'type'    	 => 'switcher',
					'title'   	 => 'Post heading',
					'default'	 => false
				),
				array(
					'id'         => 'post_heading_text',
					'type'       => 'text',
					'title'      => 'Heading text',
					'default'	 => 'Single post',
					'dependency' => array( 'post_heading', '==', true )
				),
				array(
					'id'      	 => 'post_breadcrumbs',
					'type'    	 => 'switcher',
					'title'   	 => 'Post breadcrumbs',
					'default'	 => false
				),
				array(
					'id'      	 => 'post_apollo_images',
					'type'    	 => 'switcher',
					'title'   	 => 'Apollo style for images',
					'default'	 => true
				),
				array(
					'id'      	 => 'post_date',
					'type'    	 => 'switcher',
					'title'   	 => 'Show date',
					'default'	 => true
				),
				array(
					'id'      	 => 'post_author',
					'type'    	 => 'switcher',
					'title'   	 => 'Show author',
					'default'	 => true
				),
				array(
					'id'      	 => 'post_category',
					'type'    	 => 'switcher',
					'title'   	 => 'Show category',
					'default'	 => true
				),
				array(
					'id'      	 => 'post_tags',
					'type'    	 => 'switcher',
					'title'   	 => 'Show tags',
					'default'	 => true
				),
				array(
					'id'      	 => 'post_social_share',
					'type'    	 => 'switcher',
					'title'   	 => 'Show social share',
					'default'	 => true
				),
				array(
					'id'      	 => 'post_author_bio',
					'type'    	 => 'switcher',
					'title'   	 => 'Show author bio',
					'default'	 => true
				),
				array(
					'id'      	 => 'post_like_btn',
					'type'    	 => 'switcher',
					'title'   	 => 'Show like button',
					'default'	 => true
				),
			)
		),
		array(
			'name'      => 'people',
			'title'     => 'People',
			'icon'      => 'fa fa-check',
			'fields'    => array(
				array(
					'id'      	 => 'people_pagination',
					'type'    	 => 'number',
					'title'   	 => 'Count items per page'
				),
			),
		),
	)
);

// ----------------------------------------
// 404 Page                               -
// ----------------------------------------
$options[]      = array(
	'name'        => 'error_page',
	'title'       => '404 Page',
	'icon'        => 'fa fa-bolt',

	// begin: fields
	'fields'      => array(
		array(
			'id'      => '404_title',
			'type'    => 'text',
			'title'   => 'Title',
			'default' => '404 page not found',
		),
		array(
			'id'      => '404_subtitle',
			'type'    => 'text',
			'title'   => 'Subtitle',
			'default' => 'Oops. looks like we got lost...',
		),
		array(
			'id'      => '404_btn_text',
			'type'    => 'text',
			'title'   => 'Button Text',
			'default' => 'Go home',
		),
	) // end: fields
);

// ----------------------------------------
// Backup
// ----------------------------------------
$options[]   = array(
	'name'     => 'backup_section',
	'title'    => 'Backup',
	'icon'     => 'fa fa-shield',
	// begin: fields
	'fields'   => array(
		array(
			'type'    => 'notice',
			'class'   => 'warning',
			'content' => 'You can save your current options. Download a Backup and Import.',
		),
		array(
			'type'    => 'backup',
		),
	) // end: fields
);


CSFramework::instance( $settings, $options );
