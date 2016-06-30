<?php 
/**
 * Front Page
 *
 * @package sangreea
 */

get_header();

?>
<section id="front-page">
	
	<?php get_template_part( 'loop', 'episodes' );

	get_template_part( 'section', 'participate' );

	get_template_part( 'section', 'episodes-ajax' );

	get_template_part( 'section', 'instagram' ); ?>
	
</section>

<?php get_footer(); ?>