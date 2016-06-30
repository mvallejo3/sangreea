<?php 
/**
 * Related posts template
 *
 * Displays posts that relate to a sepcific posts. If the post uses tags
 * this template will display other posts that use that same tag.
 *
 * @package sangreea
 */

// get all tags for this post 
$tags = wp_get_post_tags($post->ID);

// if ther are tags on this post, try to find other posts 
if ( $tags ) :

	// save our tag ids in an array
	$tag_ids = array();
	foreach ( $tags as $k => $tag ) {
		array_push( $tag_ids, $tag->term_id );
	}

	// prep our WP_Query arguments
	$args = array(
		'tag__in' => $tag_ids,
		'post__not_in' => array($post->ID),
	);

	// query our posts
	$lr_query = new WP_Query( $args );

	// only display this section if there are related posts
	if ( $lr_query->have_posts() ) : ?>
		<section id="loop-related-posts" class="sgr-section-border-top">
			<h2>Similar Posts..</h2>
			<div class="sgr-loop-related">
				<div class="premise-row"><?php 
					while( $lr_query->have_posts() ) : $lr_query->the_post();

						get_template_part( 'content', 'related' );

					endwhile; ?>
				</div>
			</div>
		</section><?php 
	endif;

	// reset our post query
	wp_reset_query();

endif; ?>