<!DOCTYPE HTML>
<html lang="en">
<head>
	<title><?php iishanto_get_titles();?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">


	<!-- Font -->

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">


	<!-- Stylesheets -->

	<?php 
		add_styles(get_bloginfo( 'template_url' )."/common-css/bootstrap.css","iishanto_bootstrap");
		add_styles(get_bloginfo( 'template_url' )."/common-css/ionicons.css","iishanto_common_icons");
		add_styles(get_bloginfo( 'template_url' )."/layout-1/css/styles.css","iishanto_index_style");
	?>

	<?php wp_head(); ?>
</head>
<body >



	<header>
		<div class="container-fluid position-relative no-side-padding">

			<a href="<?php echo home_url() ?>" class="logo"><img src="<?php echo get_logo_url() ?>" alt="iiShanto"></a>

			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

<?php
  $args = array(
 'theme_location' => 'header-menu',
 'depth' => 4,
 'container' => '',
 'menu_class'  => 'main-menu visible-on-click',
 'menu_id' => 'main-menu'
);
wp_nav_menu($args);
?>

			<div class="src-area">
				<?php get_search_form() ?>
			</div>

		</div><!-- conatiner -->
	</header>