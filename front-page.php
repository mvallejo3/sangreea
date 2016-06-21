<?php 
/**
 * Front Page
 *
 * @package sangreea
 */

get_header();

get_template_part( 'loop', 'episodes' );

?>

<section id="participate">
	
	<div class="container">
		
		<div class="premise-align-center">
			<h2>Would you like to be part of sangreea?</h2>
			<p>If you live in Chicago and would like to experience Sangreea
			<br>fill out the form below. We will contact you with next available dates.</p>
		</div>

		<div class="participate-form-container">
			
			<form action="#submit_form_participate" method="post" class="participate-form">
				
				<?php 

				$fields = array(
					array( 
						'name' => '_check', 
						'style' => 'display: none;',
					),
					array( 
						'name' => 'participant[name]', 
						'label' => 'Name', 
						'required' => true, 
					),
					array( 
						'type' => 'email', 
						'name' => 'participant[email]', 
						'label' => 'Email', 
						'required' => true, 
					),
					array( 
						'type' => 'textarea', 
						'name' => 'participant[message]', 
						'label' => 'Tell us something about you...', 
						'plceholder' => 'It could be what attracted you about Sangreea, or your favorite thing to eat, or dietary restrictions.', 
						'required' => false, 
					),
					array(
						'type' => 'submit', 
						'value' => 'Submit', 
						'wrapper_class' => 'premise-align-center',  
					),
				);

				premise_field_section( $fields );
				?>
			</form>

		</div>

	</div>

</section>


<section id="instagram">
	
	<div class="sgr-instagram-feed">
		
		<?php echo do_shortcode( '[instagram-feed]' ); ?>

	</div>

</section>

<?php get_footer(); ?>