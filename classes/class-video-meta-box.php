<?php 
/**
* Adds the video url metabox
*/
class SGR_Video_MB {



	/**
	 * Object instance.
	 *
	 * @see get_instance()
	 *
	 * @var object
	 */
	protected static $instance = null;



	/**
	 * Register the custom post type is PremiseCPT class exists
	 *
	 * @see 	init() does the rest once our custom post type has been registered
	 * @since 	1.0
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post',      array( $this, 'save'         ) );
	}



	/**
	 * Access this CPT's working instance
	 *
	 * @since   1.0
	 * @return  object instance of this class
	 */
	public static function get_instance() {
		null === self::$instance and self::$instance = new self;

		return self::$instance;
	}



	/**
	 * initiate CPT
	 *
	 * @since   1.0
	 */
	public function init() {
		
	}



	/**
	 * add the meta box to our custom post type
	 * 
	 * @param void $post_type adds our meta box to the custom post type
	 */
	public function add_meta_box( $post_type ) {
		if ( 'post' == $post_type ) {
			add_meta_box(
                'sgr_video_url',
                __( 'Add A Video', '' ),
                array( $this, 'meta_box_html' ),
                $post_type,
                'advanced',
                'high'
            );
		}
	}



	/**
	 * render the inner html of the CPT meta box
	 * 
	 * @return string html for meta box
	 */
	public function meta_box_html() {
		
		// Add an nonce field so we can check for it later.
        wp_nonce_field( 'sgr_video_url', 'sgr_video_url_nonce' );
        
        global $post;
        premise_field( 'video', array( 
        	'name' => 'sgr_video_url', 
        	'context' => 'post', 
        	'default' => get_post_meta( $post->ID, 'pego_post_video_url', true ), 
        ) );
	}



	/**
	 * save our post type options
	 * 
	 * @return void does not return anything
	 */
	public function save( $post_id ) {
		// Check if our nonce is set.
        if ( ! isset( $_POST['sgr_video_url_nonce'] ) ) {
            return $post_id;
        }
 
        $nonce = $_POST['sgr_video_url_nonce'];
 
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'sgr_video_url' ) ) {
            return $post_id;
        }
 
        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
 
        // Check the user's permissions.
        if ( 'post' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
 
        /* OK, it's safe for us to save the data now. */
 
        // Update the meta field.
        update_post_meta( $post_id, 'sgr_video_url', $this->sanitized() );
	}



	/**
	 * return the sanitized data to save in database
	 * 
	 * @return array returns arrat with sanitized fieldds.
	 */
	public function sanitized() {
		// Sanitize the user input.
        $mydata = $_POST['sgr_video_url'];
        return $mydata;
	}
}

?>