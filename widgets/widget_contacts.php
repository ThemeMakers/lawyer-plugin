<?php
/**
 *
 * Lawyer Contacts Widget
 *
 */
if( ! class_exists( 'Lawyer_Contacts' ) ) {
	class Lawyer_Contacts extends WP_Widget {

		function __construct() {

			$widget_ops     = array(
				'classname'   => 'lawyer_contacts widget-address',
				'description' => esc_html__( 'Lawyer Theme Widget.', 'lawyer-plugin' )
			);
			parent::__construct( 'Lawyer_Contacts', esc_html__( 'Lawyer - Contacts', 'lawyer-plugin' ), $widget_ops );
		}

		function widget( $args, $instance ) {

			extract( $args );

			echo $before_widget;

			$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );

			if ( ! empty( $instance['title'] ) ) {
				echo $before_title . $title . $after_title;
			}

			if ( isset( $instance['labels'] ) && $instance['labels'] ) {
				$html = '<p>';
					$html .= ! empty( $instance['сname'] ) 	 ? esc_html__( 'Company:', 'lawyer-plugin' ) . ' ' . esc_html( $instance['сname'] ) . ', ' : '';
					$html .= ! empty( $instance['address'] ) ? esc_html__( 'Address:', 'lawyer-plugin' ) . ' ' . esc_html( $instance['address'] ) . ', ' : '';
					$html .= ! empty( $instance['city'] ) 	 ? esc_html__( 'City:', 'lawyer-plugin' ) . ' ' . esc_html( $instance['city'] ) . ', ' : '';
					$html .= ! empty( $instance['region'] )  ? esc_html__( 'Region:', 'lawyer-plugin' ) . ' ' . esc_html( $instance['region'] ) . ', ' : '';
					$html .= ! empty( $instance['zip'] ) 	 ? esc_html__( 'Zip code:', 'lawyer-plugin' ) . ' ' . esc_html( $instance['zip'] ) . ', ' : '';
					$html .= ! empty( $instance['country'] ) ? esc_html__( 'Country:', 'lawyer-plugin' ) . ' ' . esc_html( $instance['country'] ) : '';
				$html .= '</p>';
				$html .= ! empty( $instance['phone'] ) ? '<p class="widget-address__info icon-phone-3">' . esc_html__( 'Phone:', 'lawyer-plugin' ) . ' ' . esc_html( $instance['phone'] ) . '</p>' : '';
				$html .= ! empty( $instance['fax'] ) ? '<p class="widget-address__info icon-fax">' . esc_html__( 'Fax:', 'lawyer-plugin' ) . ' ' . esc_html( $instance['phone'] ) . '</p>' : '';
				$html .= ! empty( $instance['email'] ) ? '<p class="widget-address__info icon-mail-3"><a href="mailto:' . esc_html( $instance['email'] ) . '">' . esc_html__( 'Email:', 'lawyer-plugin' ) . ' ' . esc_html( $instance['email'] ) . '</a></p>' : '';
			} else {
				$html = '<p>';
					$html .= ! empty( $instance['сname'] ) 	 ? esc_html( $instance['сname'] ) . ', ' : '';
					$html .= ! empty( $instance['address'] ) ? esc_html( $instance['address'] ) . ', ' : '';
					$html .= ! empty( $instance['city'] ) 	 ? esc_html( $instance['city'] ) . ', ' : '';
					$html .= ! empty( $instance['region'] )  ? esc_html( $instance['region'] ) . ', ' : '';
					$html .= ! empty( $instance['zip'] ) 	 ? esc_html( $instance['zip'] ) . ', ' : '';
					$html .= ! empty( $instance['country'] ) ? esc_html( $instance['country'] ) : '';
				$html .= '</p>';
				$html .= ! empty( $instance['phone'] ) ? '<p class="widget-address__info icon-phone-3">' . esc_html( $instance['phone'] ) . '</p>' : '';
				$html .= ! empty( $instance['fax'] ) ? '<p class="widget-address__info icon-fax">' . esc_html( $instance['fax'] ) . '</p>' : '';
				$html .= ! empty( $instance['email'] ) ? '<p class="widget-address__info icon-mail-3"><a href="mailto:' . esc_html( $instance['email'] ) . '">' . esc_html( $instance['email'] ) . '</a></p>' : '';
			}

			echo $html;

			echo $after_widget;

		}

		function update( $new_instance, $old_instance ) {

			$instance            = $old_instance;
			$instance['title']   = $new_instance['title'];
			$instance['сname']   = $new_instance['сname'];
			$instance['address'] = $new_instance['address'];
			$instance['city']    = $new_instance['city'];
			$instance['region']  = $new_instance['region'];
			$instance['zip']     = $new_instance['zip'];
			$instance['country'] = $new_instance['country'];
			$instance['phone']   = $new_instance['phone'];
			$instance['fax']     = $new_instance['fax'];
			$instance['email']   = $new_instance['email'];
			$instance['labels']  = $new_instance['labels'];

			return $instance;

		}

		function form( $instance ) {

			// set defaults
			// -------------------------------------------------
			$instance   = wp_parse_args( $instance, array(
				'title'   => esc_html__( 'Contacts', 'lawyer-plugin' ),
				'сname'    => '',
				'address' => '',
				'city'    => '',
				'region'  => '',
				'zip'     => '',
				'country' => '',
				'phone'   => '',
				'fax'     => '',
				'email'   => '',
				'labels'  => false
			));

			// text field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['title'] );
			$text_field = array(
				'id'    => $this->get_field_name('title'),
				'name'  => $this->get_field_name('title'),
				'type'  => 'text',
				'title' => esc_html__( 'Title', 'lawyer-plugin' )
			);

			echo cs_add_element( $text_field, $text_value );
			
			// name field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['сname'] );
			$text_field = array(
				'id'    => $this->get_field_name('сname'),
				'name'  => $this->get_field_name('сname'),
				'type'  => 'text',
				'title' => esc_html__( 'Organization name', 'lawyer-plugin' )
			);	
			echo cs_add_element( $text_field, $text_value );
					
			// address field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['address'] );
			$text_field = array(
				'id'    => $this->get_field_name('address'),
				'name'  => $this->get_field_name('address'),
				'type'  => 'text',
				'title' => esc_html__( 'Address', 'lawyer-plugin' )
			);

			echo cs_add_element( $text_field, $text_value );

			// city field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['city'] );
			$text_field = array(
				'id'    => $this->get_field_name('city'),
				'name'  => $this->get_field_name('city'),
				'type'  => 'text',
				'title' => esc_html__( 'Сity', 'lawyer-plugin' )
			);

			echo cs_add_element( $text_field, $text_value );

			// region field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['region'] );
			$text_field = array(
				'id'    => $this->get_field_name('region'),
				'name'  => $this->get_field_name('region'),
				'type'  => 'text',
				'title' => esc_html__( 'Region', 'lawyer-plugin' )
			);

			echo cs_add_element( $text_field, $text_value );

			// zip field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['zip'] );
			$text_field = array(
				'id'    => $this->get_field_name('zip'),
				'name'  => $this->get_field_name('zip'),
				'type'  => 'text',
				'title' => esc_html__( 'Postal Code', 'lawyer-plugin' )
			);

			echo cs_add_element( $text_field, $text_value );

			// country field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['country'] );
			$text_field = array(
				'id'    => $this->get_field_name('country'),
				'name'  => $this->get_field_name('country'),
				'type'  => 'text',
				'title' => esc_html__( 'Сountry', 'lawyer-plugin' )
			);

			echo cs_add_element( $text_field, $text_value );

			// phone field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['phone'] );
			$text_field = array(
				'id'    => $this->get_field_name('phone'),
				'name'  => $this->get_field_name('phone'),
				'type'  => 'text',
				'title' => esc_html__( 'Phone', 'lawyer-plugin' )
			);

			echo cs_add_element( $text_field, $text_value );

			// fax field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['fax'] );
			$text_field = array(
				'id'    => $this->get_field_name('fax'),
				'name'  => $this->get_field_name('fax'),
				'type'  => 'text',
				'title' => esc_html__( 'Fax', 'lawyer-plugin' )
			);

			echo cs_add_element( $text_field, $text_value );

			// email field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['email'] );
			$text_field = array(
				'id'    => $this->get_field_name('email'),
				'name'  => $this->get_field_name('email'),
				'type'  => 'text',
				'title' => esc_html__( 'Email', 'lawyer-plugin' )
			);

			echo cs_add_element( $text_field, $text_value );

			// labels field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['labels'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('labels'),
				'name'  => $this->get_field_name('labels'),
				'type'  => 'switcher',
				'title' => esc_html__( 'Show labels', 'lawyer-plugin' )
			);

			echo cs_add_element( $switcher_field, $switcher_value );


		}
	}
}

if ( ! function_exists( 'lawyer_init_contects_widget' ) ) {
	function lawyer_init_contects_widget() {
		register_widget( 'Lawyer_Contacts' );
	}
}
add_action( 'widgets_init', 'lawyer_init_contects_widget', 2 );