<?php 
/**
 * Instagram Template
 *
 * @package sangreea
 */

get_header();

?>

<section id="instagram">
	
	<div class="sgr-instagram-feed">
		
		<?php echo do_shortcode( '[instagram-feed]' ); ?>

	</div>

</section>

<?php get_footer(); ?>