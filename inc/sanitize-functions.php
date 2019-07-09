<?php
/**
 * Function to sanitize number
 */
if ( ! function_exists( 'mtwriter_sanitize_number' ) ) :
	function mtwriter_sanitize_number ( $mtwriter_input, $mtwriter_setting ) {
		$mtwriter_sanitize_text = sanitize_text_field( $mtwriter_input );

		// If the input is an number, return it; otherwise, return the default
		return ( is_numeric( $mtwriter_sanitize_text ) ? $mtwriter_sanitize_text : $mtwriter_setting->default );
	}
endif;

/**
 * Sanitizing the checkbox
 */
if ( !function_exists('mtwriter_sanitize_checkbox') ) :
	function mtwriter_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
endif;

/**
 * Sanitizing the page/post
 */
if ( !function_exists('mtwriter_sanitize_page') ) :
	function mtwriter_sanitize_page( $input ) {
		// Ensure $input is an absolute integer.
		$page_id = absint( $input );
		// If $page_id is an ID of a published page, return it; otherwise, return false
		return ( 'publish' == get_post_status( $page_id ) ? $page_id : false );
	}
endif;

/**
 * Sanitizing the select/radio callback example
 */
if ( !function_exists('mtwriter_sanitize_select') ) :
	function mtwriter_sanitize_select( $input, $setting ) {

		$input = sanitize_text_field( $input );

		return $input;
	}
endif;

/**
 * Allowed HTML
 */
if ( !function_exists('mtwriter_sanitize_allowed_html') ) :
	function mtwriter_sanitize_allowed_html ( $input ) {
		$allowed_html = wp_kses_allowed_html();
		$output = wp_kses( $input, $allowed_html );
		return $output;
	}
endif;

/**
 * Textarea sanitization
 */
if ( !function_exists('mtwriter_sanitize_textarea') ) :
	function mtwriter_sanitize_textarea( $input ) {
		if ( current_user_can( 'unfiltered_html' ) ) {
			$output = $input;
		} else {
			$output = mtwriter_sanitize_allowed_html( $input );
		}
		return $output;
	}
endif;

/**
 * Separator Sanitization
 */
if ( !function_exists('mtwriter_sanitize_separator') ) :
	function mtwriter_sanitize_separator() {
		return true;
	}
endif;