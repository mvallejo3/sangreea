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

	get_template_part( 'page', 'participate' );

	get_template_part( 'page', 'instagram' ); ?>
	
</section>

<?php get_footer(); ?>