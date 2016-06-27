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
			<?php the_post_thumbnail( 'medium', array( 'class' => 'premise-responsive' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="post-content">
		<?php the_content(); ?>
	</div>
	
	<div class="related-content">
		<!-- add related content here -->
	</div>
</article>