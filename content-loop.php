<?php
/**
 * Content Loop Template
 *
 * @package Simplicity
 */

$episode   = premise_get_value( 'psmb_youtube[url]', 'post' );
$instagram = premise_get_value( 'psmb_instagram[url]', 'post' );

$thumb = '';
$thumb = wp_get_attachment_url( get_post_thumbnail_id() );

?>
<div class="<?php echo ( $episode ) ? 'sangreea-grid-item sangreea-episode' : 'sangreea-grid-item'; ?>">
	<article <?php post_class( 'pwps-blog-post' );
		echo ( ! empty( $thumb ) ) ? ' style="background-image: url('.$thumb.');"' : '';
		echo ( $episode ) ? ' data-youtube="'.$episode.'"' : '';
		echo ( $instagram ) ? ' data-instagram="'.$instagram.'"' : ''; ?>>

		<div class="pwps-post-title">
			<a href="<?php the_permalink(); ?>">
				<h2><?php the_title(); ?></h2>
			</a>
		</div>

	</article>
</div>