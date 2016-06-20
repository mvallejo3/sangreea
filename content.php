<?php 
/**
 * Content Template
 *
 * @package [level 1]\[level 2]\[etc.]
 */

?>

<article <?php post_class( '' ); ?>>
	
	<?php 
	$video_url = premise_get_value( 'sgr_video_url', 'post' ) ? premise_get_value( 'sgr_video_url', 'post' ) : get_post_meta( $post->ID, 'pego_post_video_url', true );

	if ( $video_url ) : ?>

		<div class="post-video">
			<div id="sgr-video-<?php echo esc_attr( $post->ID ); ?>" class="the-video" data-video-id="<?php echo esc_attr( sgr_get_video_id( $video_url ) ); ?>"></div>
			<?php //echo premise_output_video( $video_url, array( 'playerVars' => array( 'rel' => 0, 'showinfo' => 0, 'autoplay' => 0, 'controls' => 2, 'theme' => 'light' ) ) ); ?>
		</div>

		<div class="post-info">
			<h2><?php the_title(); ?></h2>
		</div>

		<script type="text/javascript">
			(function($){
				$( document ).ready( function() {
					var videoInfo = $( '.post-<?php echo esc_attr( $post->ID ); ?> .post-info' ),
					ytPlayer      = $( '#sgr-video-<?php echo esc_attr( $post->ID ); ?>').premiseLoadYouTube( {
						width: '100%',
						height: '100%', 
						playerVars: {
							showinfo: 0,
							controls: 2,
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
		</script>

	<?php endif; ?>
	
</article>