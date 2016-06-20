<?php 
/**
 * Content Loop Template
 *
 * @package [level 1]\[level 2]\[etc.]
 */

?>

<article <?php post_class( 'sgr-blog-post' ); ?>>
	
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'medium', array( 'class' => 'premise-responsive' ) ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="pot-title">
		<a href="<?php the_permalink(); ?>">
			<h3><?php the_title(); ?></h3>
		</a>
	</div>
	
</article>