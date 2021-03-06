<?php 
/* Social icon Shortcode */

vc_map(
	array(
		'name'        => esc_html__( 'Social icon', 'js_composer' ),
		'base'        => 'lawyer_social',
		'params'      => array(
			array(
				'type'        => 'iconpicker',
				'heading'     => esc_html__( 'Icon', 'js_composer' ),
				'param_name'  => 'icon',
				'value'       => 'icon-adjustments',
				'settings'       => array(
					'emptyIcon'    => false,
					'type'         => 'flaticon',
					'source'       => lawyer_fontello_icons( true ),
					'iconsPerPage' => 4000,
				),
				'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
			),
			array(
				'type' 		  => 'textfield',
				'heading' 	  => esc_html__( 'Icon link', 'js_composer' ),
				'param_name'  => 'url',
			),
			array(
				'type' 		  => 'textfield',
				'heading' 	  => esc_html__( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
				'value' 	  => ''
			),
			/* CSS editor */
			array(
				'type' 		  => 'css_editor',
				'heading' 	  => esc_html__( 'CSS box', 'js_composer' ),
				'param_name'  => 'css',
				'group' 	  => esc_html__( 'Design options', 'js_composer' )
			)
		)
	)
);

class WPBakeryShortCode_lawyer_social extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'icon' 	   => '',
			'url'      => '',
			'el_class' => '',
			'css' 	   => ''
		), $atts ) );


		if ( ! empty( $icon ) ) {
			$class  = ( ! empty( $el_class ) ) ? $el_class : '';
			$class .= vc_shortcode_custom_css_class( $css, ' ' );

			$class .= ' ' . $icon;

			$icon_html = '<i class="' . $class . '"></i>';

			if ( ! empty( $url ) ) {
				$icon_html = '<a href="' . esc_url( $url ) . '">' . $icon_html . '</a>';
			}

			ob_start();

				echo $icon_html;

			return ob_get_clean();
		}
	}
}