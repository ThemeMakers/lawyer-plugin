<?php

// Locations post type
if ( ! function_exists( 'lawyer_register_locations_post_type' ) ) {
	function lawyer_register_locations_post_type() { 
		// New Post Type
		register_post_type( 'locations',
			array(
				'labels' => array(
					'name' => esc_html__( 'Locations', 'lawyer-plugin' ),
					'singular_name' => esc_html__( 'Location', 'lawyer-plugin' )
				),
				'menu_icon'   		 => 'dashicons-location-alt',
				'public' 	  		 => true,
				// 'publicly_queryable' => false,
				'supports'    		 => array( 'title', 'editor' ),
				'has_archive' 		 => true,
				'rewrite'     		 => array('slug' => 'locations'),
			)
		);

		// Post type taxonomy
		register_taxonomy(
			'locations-category',
			'locations',
			array(
				'label' 	   => esc_html__( 'Categories', 'lawyer-plugin' ),
				'rewrite' 	   => array( 
					'slug' => 'locations-category' 
				),
				'hierarchical' => false,
			)
		);
	}
}
add_action('init', 'lawyer_register_locations_post_type', 8 );