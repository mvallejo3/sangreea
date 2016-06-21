<?php 
/**
 * Loop Episodes Template
 *
 * @package sangreea
 */

?>

<section id="episodes">
	
	<div class="container">
		
		<?php 
		/**
		 * The loop. Check if we have posts and display them.
		 */
		if ( have_posts() ) :

			while ( have_posts() ) : the_post();
				
				if ( premise_get_value( 'sgr_video_url', 'post' ) 
					|| get_post_meta( $post->ID, 'pego_post_video_url', true ) ) 
						get_template_part( 'content', 'episode' );

			endwhile;

			sgr_pagination();
			
		else :

			get_template_part( 'content', 'none' );

		endif;
		?>

	</div>
</section>