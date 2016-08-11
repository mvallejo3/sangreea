<?php 
/**
 * Functions Library 
 *
 * Theme Prefix: 'sgr_'
 *
 * @package sangreea
 */


//  Hide the admin bar in the front end
show_admin_bar( false );


// Enqueue styles and scripts 
if ( ! function_exists( 'sgr_enqueue_scripts' ) ) {
	/**
	 * Enqueue theme scripts in the front end
	 * 
	 * @return void
	 */
	function sgr_enqueue_scripts() {
		wp_register_style( 'sgr_css', get_template_directory_uri() . '/css/style.min.css' );
		wp_register_script( 'sgr_js', get_template_directory_uri() . '/js/script.min.js', array( 'jquery' ) );

		if ( ! is_admin() ) {
			wp_enqueue_style( 'sgr_css' );
			wp_enqueue_script( 'sgr_js' );
		}
	}
}