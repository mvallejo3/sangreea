<?php 
/**
 * Functions Library 
 *
 * Theme Prefix: 'sgr_'
 *
 * @package sangreea
 */



// Require Premise WP if it does not exist.
if ( ! class_exists( 'Premise_WP' ) ) {
	require 'includes/require-premise-wp.php';
}


// setup theme 
if ( ! function_exists( 'sgr_theme_setup' ) ) {
	/**
	 * Setup the theme once it is activated.
	 *
	 * This function runs only once when you activate the theme. It performs tasks that should NOT be ran on every page load such as flushing rewrite rules.
	 * 
	 * @return void
	 */
	function sgr_theme_setup() {
		// flush rewrite rules
		flush_rewrite_rules();

		# perform other tasks here
	}
}



// Add theme supprt
if ( function_exists( 'add_theme_support' ) ) {
	// Add Menu Support.
	add_theme_support( 'menus' );

	// Add Thumbnail Theme Support.
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'video' ) );


	// custom logo in customizer
	add_theme_support( 'custom-logo', array(
		'size' => 'custom-logo-size',
	) );

	// Thumbnail sizes
	// add_image_size( 'post-featured', 1180, 474, true );
	// custom logo size
	add_image_size( 'custom-logo-size', 300, 150 );
}



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



// output the main nav 
if ( ! function_exists( 'sgr_main_nav' ) ) {
	/**
	 * Main navigation
	 *
	 * @return void
	 */
	function sgr_main_nav() {

		wp_nav_menu(
			array(
				'theme_location'  => 'header-menu', // DO NOT MODIFY.
				'menu'            => '',
				'container'       => 'div',
				'container_class' => 'header-menu-container',
				'container_id'    => '',
				'menu_class'      => 'menu',
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => '',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul>%3$s</ul>',
				'depth'           => 0,
			)
		);
	}
}



// Register menu locations 
if ( ! function_exists( 'sgr_register_menu' ) ) {
	/**
	 * Register theme menu location
	 *
	 * @return void
	 */
	function sgr_register_menu() {

		register_nav_menus(
			array( 
				'header-menu' => __( 'Header Menu', '' ), // Main Navigation.
			)
		);
	}
}



if ( ! function_exists( 'sgr_pagination' ) ) {
	/**
	 * display the pagination for the site
	 * 
	 * @return string html for pagination
	 */
	function sgr_pagination() {
		global $wp_query;

		$big = 999999999; // need an unlikely integer

		$args = array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'mid_size' => 0,
			'prev_text' => '<i class="fa fa-chevron-left"></i>',
			'next_text' => '<i class="fa fa-chevron-right"></i>',
		);

		$html  = '<div class="sgr-pagination">';
		$html .= paginate_links( $args );
		$html .= '</div>';

		echo (string) $html;
	}
}



function sgr_front_page( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'cat', '24' );
        $query->set( 'posts_per_page', '1' );
        // var_dump($query);
    }
}




function sgr_load_video_mb_class() {
	new SGR_Video_MB;
}








/*
	Includes
 */
include 'classes/class-video-meta-box.php';



/*
	Hooks
 */
if ( function_exists( 'add_action' ) ) {
	// On theme activation.
	add_action( 'after_theme_setup', 'sgr_theme_setup' );

	// Register menus
	add_action( 'init', 'sgr_register_menu' );

	// Enqueue scripts.
	add_action( 'wp_enqueue_scripts', 'sgr_enqueue_scripts' );
	
	// Filter front page posts
	add_action( 'pre_get_posts', 'sgr_front_page' );

	if ( is_admin() ) {
		add_action( 'load-post.php',     'sgr_load_video_mb_class' );
	    add_action( 'load-post-new.php', 'sgr_load_video_mb_class' );
	}
}


/*
	Filters
 */
if ( function_exists( 'add_filter' ) ) {
}


# pego_post_video_url