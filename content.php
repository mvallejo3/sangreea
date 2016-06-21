<?php 
/**
 * Content Template
 *
 * @package sangreea
 */

?>

<article <?php post_class( 'sgr-post' ); ?>>
	
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'medium', array( 'class' => 'premise-responsive' ) ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="post-content">
		<?php the_content(); ?>
	</div>
	
</article>