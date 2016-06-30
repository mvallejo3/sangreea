<?php 
/**
 * Content Template
 *
 * @package sangreea
 */

?>

<article <?php post_class( 'sgr-post' ); ?>>
	
	<?php 
	/**
	 * Display thumbnail or video depending on post format
	 */
	if ( 'video' !== get_post_format() ) : 
		
		if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'medium', array( 'class' => 'premise-responsive' ) ); ?>
			</div><?php 
		endif;

	else :
		
		$video_url = premise_get_value( 'sgr_video_url', 'post' ) ? premise_get_value( 'sgr_video_url', 'post' ) : get_post_meta( $post->ID, 'pego_post_video_url', true );

		if ( $video_url ) : ?>

			<div class="post-video">
				<div id="sgr-video-<?php echo esc_attr( $post->ID ); ?>" class="the-video" data-video-id="<?php echo esc_attr( sgr_get_video_id( $video_url ) ); ?>"></div>
				<?php //echo premise_output_video( $video_url, array( 'playerVars' => array( 'rel' => 0, 'showinfo' => 0, 'autoplay' => 0, 'controls' => 2, 'theme' => 'light' ) ) ); ?>
			</div>

			<script type="text/javascript">
				(function($){
					$( document ).ready( function() {
						var videoInfo = $( '.post-<?php echo esc_attr( $post->ID ); ?> .post-info, #header' ),
						ytPlayer      = $( '#sgr-video-<?php echo esc_attr( $post->ID ); ?>').premiseLoadYouTube( {
							width: '100%',
							height: '100%', 
							playerVars: {
								showinfo: 0,
								controls: 1,
								theme: 'light'
							},
							events: {
								onStateChange: sgrYTReady
							}
						} );

						function sgrYTReady( e ) {
							// Hide / show the titile when the video is playing
							if ( 1 === e.data ) {
								videoInfo.fadeOut( 'fast' );
							}
							else {
								videoInfo.fadeIn( 'fast' );
							}
							return false;
						}
					} );
				}(jQuery));
			</script><?php 

		endif;

	endif; ?>

	<div class="post-content">
		<?php the_content(); ?>
	</div>
	
	<div class="related-content">
		<!-- add related content here -->
	</div>
</article>