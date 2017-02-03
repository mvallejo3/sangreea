<?php
/**
 * The loop
 *
 * @package Simplicity
 */

?>

<div class="pwps-the-loop<?php echo pwps_uses_sidebar() ? ' span8' : '' ?>">

	<?php
	/**
	 * The loop. Check if we have posts and display them.
	 */
	if ( have_posts() ) :

		while ( have_posts() ) : the_post();

			if ( is_singular() ) :
				get_template_part( 'content', pwps_get_post_format() );
				get_template_part( 'loop', 'related' );
				if ( ( comments_open() || get_comments_number() ) ) :
					comments_template();
				endif;
			else :
				get_template_part( 'content', 'loop' );
			endif;

		endwhile;

	else :

		get_template_part( 'content', 'none' );

	endif;
	?>

</div>

<?php pwps_the_sidebar();

if ( ! is_singular() ) //pwps_pagination(); ?>