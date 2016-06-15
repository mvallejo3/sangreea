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
			<?php echo premise_output_video( $video_url, array( 'autohide' => 0, 'controls' => 0, 'modestbranding' => 1 ) ); ?>
		</div>

	<?php endif; ?>
	
</article>