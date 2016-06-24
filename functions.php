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


/**
 * alter the front page query, to display only episodes
 * 
 * @param  object $query the main query
 * @return void
 */
function sgr_front_page_query( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'cat', '24' );
        $query->set( 'posts_per_page', '1' );
    }
}


/**
 * register and load the video meta box for posts
 * 
 * @return void 
 */
function sgr_load_video_mb_class() {
	new SGR_Video_MB;
}


/**
 * return the video ID if a youtube url is passed
 * 
 * @param  string $video the url string or video id
 * @return string        the video id
 */
function sgr_get_video_id( $video = '' ) {
	if ( '' == $video ) return false;

	// http://stackoverflow.com/questions/5830387/how-to-find-all-youtube-video-ids-in-a-string-using-a-regex
	$video_id = preg_replace( '~(?#!js YouTubeId Rev:20160125_1800)
		# Match non-linked youtube URL in the wild. (Rev:20130823)
		https?://          # Required scheme. Either http or https.
		(?:[0-9A-Z-]+\.)?  # Optional subdomain.
		(?:                # Group host alternatives.
		  youtu\.be/       # Either youtu.be,
		| youtube          # or youtube.com or
		  (?:-nocookie)?   # youtube-nocookie.com
		  \.com            # followed by
		  \S*?             # Allow anything up to VIDEO_ID,
		  [^\w\s-]         # but char before ID is non-ID char.
		)                  # End host alternatives.
		([\w-]{11})        # $1: VIDEO_ID is exactly 11 chars.
		(?=[^\w-]|$)       # Assert next char is non-ID or EOS.
		(?!                # Assert URL is not pre-linked.
		  [?=&+%\w.-]*     # Allow URL (query) remainder.
		  (?:              # Group pre-linked alternatives.
		    [\'"][^<>]*>   # Either inside a start tag,
		  | </a>           # or inside <a> element text contents.
		  )                # End recognized pre-linked alts.
		)                  # End negative lookahead assertion.
		[?=&+%\w.-]*       # Consume any URL (query) remainder.
		~ix', '$1',
		$video );

	return $video_id;
}


/**
 * get the post content template based on the post format
 * 
 * @return string the content template that should be used
 */
function sgr_post_format() {
	switch ( get_post_format() ) {
		case 'video':
			$format = 'episode';
			break;

		default :
			$format = '';
	}

	return $format;
}


/**
 * Process participant form
 * 
 * @return string confimation fo form submission
 */
function sgr_participant_form() {
	$_form = array();
	parse_str( $_POST['participantForm'], $_form );

	$form = $_form['sgr_participant'];

	$_check  = ( isset( $form['_check'] ) )  ? $form['_check']                         : '';
	$name    = ( isset( $form['name'] ) )    ? sanitize_text_field( $form['name'] )    : '';
	$email   = ( isset( $form['email'] ) )   ? sanitize_email( $form['email'] )        : '';
	$message = ( isset( $form['message'] ) ) ? sanitize_text_field( $form['message'] ) : '';

	// check for spam. This field must be empty 
	if ( ! empty( $_check ) ) die( 'Captha!' );

	if ( ! empty( $name ) && ! empty( $email ) ) {

		$to = 'mario@vallgroupcom';
		$subject = 'New Participant Request For Sangreea';
		$body = $name . ' ' . $email;
		
		if ( wp_mail( $to, $subject, $body ) ) {
			echo '<p class="success">Your email has been sent. Thank You!</p>';
		}
		else {
			echo '<p class="error">There was an issue sending your email, please try again later.</p>';
		}
	}
	die();
}


/**
 * Perform nav search
 * 
 * @return string html with search results loop
 */
function sgr_nav_search() {
	$action = ( isset( $_POST['action'] ) && ! empty( $_POST['action'] ) ) ? (string) sanitize_text_field( $_POST['action'] ) : '';
	$search = ( isset( $_POST['search'] ) && ! empty( $_POST['search'] ) ) ? (string) sanitize_text_field( $_POST['search'] ) : '';

	if ( '' !== $action && '' !== $search ) {
		new SGR_Nav_Search( $search );
	}
	die();
}


/**
* The nav search class searches the database for posts based on a keyword string
*/
class SGR_Nav_Search {

	/**
	 * the search string submitted by the user
	 * 
	 * @var string
	 */
	public $s = '';


	/**
	 * the query object
	 * 
	 * @var null
	 */
	public $query = NULL;


	/**
	 * Construct our object
	 */
	function __construct( $search ) {
		$this->s = $search;

		$this->query = new WP_Query( array( 's' => $this->s, 'post_status' => 'publish' ) );
		wp_reset_query(); // reset query immediately, we already saved the object reference

		$this->loop();
	}


	/**
	 * Loop through search results
	 * 
	 * @return string html for loop results
	 */
	public function loop() {
		if ( $this->query->have_posts() ) {
			$this->load();
		}
	}


	/**
	 * load each result post from results
	 * 
	 * @return string html for loop results
	 */
	public function load() {
		?>
		<div <?php post_class( 'nav-results' ); ?>>
			<div class="container">
				<div class="premise-row">
					<?php while( $this->query->have_posts() ) {
						$this->query->the_post();
						get_template_part( 'content', 'loop' );
					} ?>
				</div>
			</div>
		</div>
		<?php 
	}
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
	add_action( 'pre_get_posts', 'sgr_front_page_query' );

	if ( is_admin() ) {
		add_action( 'load-post.php',     'sgr_load_video_mb_class' );
	    add_action( 'load-post-new.php', 'sgr_load_video_mb_class' );
	}

	add_action( 'wp_ajax_sgr_nav_search', 'sgr_nav_search' );
	add_action( 'wp_ajax_nopriv_sgr_nav_search', 'sgr_nav_search' );

	add_action( 'wp_ajax_sgr_participant_form', 'sgr_participant_form' );
	add_action( 'wp_ajax_nopriv_sgr_participant_form', 'sgr_participant_form' );
}


/*
	Filters
 */
if ( function_exists( 'add_filter' ) ) {
}


