<?php 
/**
 * Header Template
 *
 * @package [level 1]\[level 2]\[etc.]
 */

?><!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">

		<!-- Make Responsive -->
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class( '' ); ?>>
		<?php echo '<!-- ' . basename( get_page_template() ) . ' -->'; ?>

		<header id="header">
			
			<div class="container">
				
				<div class="logo">
					<a href="<?php echo esc_url( site_url() ); ?>" class="logo-anchor">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/img/logo.png' ); ?>" class="premise-responsive premise-inline-block">
					</a>
				</div>

				<div class="nav">
					<div class="nav-toggle">
						<a href="javascript:void(0);" class="nav-toggle-a">
							<i class="fa fa-bars"></i>
						</a>
					</div>
					<div class="nav-search">
						<input type="text" name="nav_search" placeholder="Start typing">
					</div>
					<div class="nav-ui"></div>
				</div>

			</div>

		</header>