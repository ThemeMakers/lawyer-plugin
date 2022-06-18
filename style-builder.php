<?php

require_once EF_ROOT . '/scssphp/scss.inc.php';
use ScssPhp\ScssPhp\Compiler;

function lawyer_get_font_family( $option, $default ) {
	if( lawyer_get_options( $option ) ) {
		$font = lawyer_get_options( $option );
		$family = $font['family'];
	} else {
		$family = $default;
	}
	return $family;
}

function lawyer_get_pixels_size( $option, $default ) {
	if ( ! empty( lawyer_get_options( $option ) ) ) {
		if ( is_numeric( lawyer_get_options( $option ) ) ) {
			$size = lawyer_get_options( $option ) . 'px';
		} else {
			$size = lawyer_get_options( $option );
		}
	} else {
		$size = $default;
	}
	return $size;
}

function lawyer_update_settings() {

	$body_background_color = '#fff';
	if ( lawyer_get_options('body_background') == 'color' && lawyer_get_options( 'body_background_color' ) ) {
		$body_background_color = lawyer_get_options( 'body_background_color' );
	}

	$body_background_image = 'none';
	if ( lawyer_get_options('body_background') == 'image' && lawyer_get_options( 'body_background_image' ) ) {
		$body_background_image = lawyer_get_options( 'body_background_image', 'none' );
		if ( $body_background_image ) {
            $body_background_image = 'url(' . $body_background_image . ')';
        }
	}

	$settings = '
	$theme-color-red:					#b1001e;
	$theme-color-blue:					#1973dc;
	$theme-color-dirty-orange:			#9a8474;

	$main-theme-color:					' . lawyer_get_options( 'main_theme_color', '#b1001e' ) . ';

	$body-bg-color:						' . $body_background_color . ';
	$body-bg-image:           			' . $body_background_image . ';
	$content-color-minor:				#303133;

	$primary-font-family:				Gudea, sans-serif;				// Content
	$titles-font-family:				"Slabo 27px", serif;			// Titles
	$alternative-font-family:			PT Serif, serif;				// Testimonials


	$content-font-family:				"' . lawyer_get_font_family( 'text_font_family', 'Gudea' ) . '", sans-serif;
	$content-txt-size:					' . lawyer_get_pixels_size( 'text_font_size', '16px' ) . ';
	$content-txt-color-normal:			' . lawyer_get_options( 'text_color', '#777' ) . ';
	$content-txt-color-link:			' . lawyer_get_options( 'text_links_color', '#b1001e' ) . ';
	$content-txt-color-link-hover:		' . lawyer_get_options( 'text_links_hovering_color', '#000' ) . ';
	$border-color: rgba(0,0,0,.1);


	$h1-font-family:					"' . lawyer_get_font_family( 'h1_font_family', 'Slabo 27px' ) . '", serif;
	$h1-txt-size:						' . lawyer_get_pixels_size( 'h1_font_size', '40px' ) . ';
	$h1-txt-color-normal:				' . lawyer_get_options( 'h1_color', '#000000' ) . ';
	$h1-txt-color-link:					' . lawyer_get_options( 'h1_links_color', '#000' ) . ';
	$h1-txt-color-link-hover:			' . lawyer_get_options( 'h1_links_hover_color', '#b1001e' ) . ';

	$h2-font-family:					"' . lawyer_get_font_family( 'h2_font_family', 'Slabo 27px' ) . '", serif;
	$h2-txt-size:						' . lawyer_get_pixels_size( 'h2_font_size', '32px' ) . ';
	$h2-txt-color-normal:				' . lawyer_get_options( 'h2_color', '#000000' ) . ';
	$h2-txt-color-link:					' . lawyer_get_options( 'h2_links_color', '#000' ) . ';
	$h2-txt-color-link-hover:			' . lawyer_get_options( 'h2_links_hover_color', '#b1001e' ) . ';

	$h3-font-family:					"' . lawyer_get_font_family( 'h3_font_family', 'Slabo 27px' ) . '", serif;
	$h3-txt-size:						' . lawyer_get_pixels_size( 'h3_font_size', '24px' ) . ';
	$h3-txt-size-serif:					17px;
	$h3-txt-color-normal:				' . lawyer_get_options( 'h3_color', '#000000' ) . ';
	$h3-txt-color-serif:				#303133;
	$h3-txt-color-link:					' . lawyer_get_options( 'h3_links_color', '#000' ) . ';
	$h3-txt-color-link-hover:			' . lawyer_get_options( 'h3_links_hover_color', '#b1001e' ) . ';

	$h4-font-family:					"' . lawyer_get_font_family( 'h4_font_family', 'Slabo 27px' ) . '", serif;
	$h4-txt-size:						' . lawyer_get_pixels_size( 'h4_font_size', '21px' ) . ';
	$h4-txt-size-serif:					16px;
	$h4-txt-color-normal:				' . lawyer_get_options( 'h4_color', '#000000' ) . ';
	$h4-txt-color-serif:				#303133;
	$h4-txt-color-link:					' . lawyer_get_options( 'h4_links_color', '#000' ) . ';
	$h4-txt-color-link-hover:			' . lawyer_get_options( 'h4_links_hover_color', '#b1001e' ) . ';

	$h5-font-family:					"' . lawyer_get_font_family( 'h5_font_family', 'Slabo 27px' ) . '", serif;
	$h5-txt-size:						' . lawyer_get_pixels_size( 'h5_font_size', '15px' ) . ';
	$h5-txt-size-blog:				    ' . lawyer_get_pixels_size( 'h5_font_size', '18px' ) . ';
	$h5-txt-color-blog:                 ' . lawyer_get_options( 'h5_color', '#000' ) . ';
	$h5-txt-color-normal:				' . lawyer_get_options( 'h5_color', '#777' ) . ';
	$h5-txt-color-link:					' . lawyer_get_options( 'h5_links_color', '#777' ) . ';
	$h5-txt-color-link-hover:			' . lawyer_get_options( 'h5_links_hover_color', '#b1001e' ) . ';

	$h6-font-family:					"' . lawyer_get_font_family( 'h6_font_family', 'Slabo 27px' ) . '", serif;
	$h6-txt-size:						' . lawyer_get_pixels_size( 'h6_font_size', '16px' ) . ';
	$h6-txt-color-normal:				' . lawyer_get_options( 'h6_color', '#000000' ) . ';
	$h6-txt-color-link:					' . lawyer_get_options( 'h6_links_color', '#000' ) . ';
	$h6-txt-color-link-hover:			' . lawyer_get_options( 'h6_links_hover_color', '#b1001e' ) . ';

	$header-bg-color:          			' . lawyer_get_options( 'header_background_color', 'transparent' ) . ';
	$vav-l1-font-family:				"' . lawyer_get_font_family( 'menu_font_family', 'Slabo 27px' ) . '", serif;	// First level font family
	$vav-l1-txt-size:					' . lawyer_get_pixels_size( 'menu_font_size', '17px' ) . ';				// First level text size
	$vav-l1-txt-color:					' . lawyer_get_options( 'menu_color', '#000' ) . ';					// First level text color
	$vav-l1-txt-color-hover:			' . lawyer_get_options( 'menu_hover_color', '#fff' ) . ';			// First level text color hover


	$vav-sl-bg-color:					' . lawyer_get_options( 'submenu_bg_color', '#3a3a3c' ) . ';					// Sublevel bg color
	$vav-mm-title-font-family:			"' . lawyer_get_font_family( 'submenu_title_font_family', 'Slabo 27px' ) . '", serif;		// Megamenu title font family
	$vav-mm-title-txt-size:				' . lawyer_get_pixels_size( 'submenu_title_font_size', '17px' ) . ';			// Megamenu title text size
	$vav-mm-title-txt-color:			' . lawyer_get_options( 'submenu_title_color', '#fff' ) . ';					// Megamenu title text color
	
	$vav-sl-font-family:				"' . lawyer_get_font_family( 'submenu_font_family', 'Gudea' ) . '", sans-serif;	// Sublevel font family
	$vav-sl-txt-size:					' . lawyer_get_pixels_size( 'submenu_font_size', '14px' ) . ';					// Sublevel text size
	$vav-sl-txt-color:					' . lawyer_get_options( 'submenu_color', '#b4b4b4' ) . ';						// Sublevel text color
	$vav-sl-txt-color-hover:			' . lawyer_get_options( 'submenu_hover_color', '#ffffff' ) . ';					// Sublevel text hover

	$tb-bg-color:						' . lawyer_get_options( 'top_bar_background_color', '#2e2e30' ) . ';			// Top bar bg color
	$tb-txt-size:						12px;
	$tb-txt-color-normal:				#fff;
	$tb-txt-color-link:					#fff;
	$tb-txt-color-link-hover:			#fff;

	$bb-txt-size:						14px;
	$bb-txt-color-normal:				#b4b4b4;
	$bb-txt-color-link:					$main-theme-color;
	$bb-txt-color-link-hover:			#ffffff;

	$footer-bg-color:					' . lawyer_get_options( 'footer_background_color', '#2e2e30' ) . ';					// Footer bg color
	$footer-title-color:				#ffffff;
	$footer-txt-size:					16px;
	$footer-txt-color-normal:			#b4b4b4;
	$footer-txt-color-link:				$main-theme-color;
	$footer-txt-color-link-hover:		#ffffff;
	$footer-border-color: rgba(255,255,255,.1);

	$services-links-row-bg: #e7e7e7;
	$services-links-item-bg: #e1e1e1;
	$services-links-item-bg-hover: #262729;
	$services-links-txt-size: 14px;
	$services-links-txt-color-hover: #fff;
	$services-links-txt-color-normal: #303133;

	$cat-links-txt-color-normal: #303133;
	$cat-links-txt-color-hover: $main-theme-color;
	$cat-links-txt-size: 16px;

	$logo-font-family: ' . lawyer_get_font_family( 'logo_font_family', 'Cabin' ) . ', Arial, sans-serif;
	$logo-txt-size: ' . lawyer_get_pixels_size( 'text_logo_size', '34px' ) . ';
	$logo-txt-color-link: ' . lawyer_get_options( 'text_logo_color', '#262626' ) . ';
	$logo-txt-color-link-hover: ' . lawyer_get_options( 'text_logo_hover_color', '#b1001e' ) . ';';

	return $settings;
}

function lawyer_rebuild_styles() {

	if ( function_exists( 'lawyer_get_options' ) ) {

		// require_once 'scssphp/scss.inc.php';

		// Update settings file
		$settings_file = LAWYER_T_PATH . '/assets/scss/_settings.scss';

		if ( file_exists( $settings_file ) ) {
			$new_settings_content = lawyer_update_settings();
			file_put_contents( $settings_file, $new_settings_content );
		}

		$scss = new Compiler();
		$scss->setImportPaths( LAWYER_T_PATH . '/assets/scss/' );
		$scss->setOutputStyle('compressed');

		$content  = file_get_contents( LAWYER_T_PATH . '/assets/scss/main.scss' );
		
		$compiled = $scss->compileString( $content )->getCss();

		$file = fopen( LAWYER_T_PATH . '/assets/css/main.css', 'w' );
		if ( $file ) {
			fwrite( $file, $compiled );
			fclose( $file );
		}
	}
}
add_action('update_option__cs_options', 'lawyer_rebuild_styles');