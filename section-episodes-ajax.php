<?php 
/**
 * Section template for display episodes via ajax on button click
 *
 * This section s displays a button that when clicked loads the most recent espisodes
 * via ajax. The number of episodes loaded depends on the setting set at 
 * Settings -> Reading -> Blog pages show at most. default is 10.
 *
 * @package sangreea
 */

?>

<section id="load-recent-episodes">
	<div class="container">

		<div id="sgr-load-episodes">
			<!-- Is filled out by JS when button gets clicked -->
		</div>
		
		<div class="premise-align-center">
			<a href="javascript:void(0);" id="load-recent-episodes-a" class="sgr-btn">
				See the most recent episodes
			</a>
		</div>

	</div>
</section>