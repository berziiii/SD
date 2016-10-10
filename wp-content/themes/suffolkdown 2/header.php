<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Suffolk_Downs
 * @since Suffolk Downs 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/assets/styles/suffolkdown.css"; ?>">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/assets/bootstrap-3.3.5-dist/css/bootstrap.min.css"; ?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri() . "/assets/scripts/debounce.js"; ?>"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri() . "/assets/scripts/mkoryak-floatThead/dist/jquery.floatThead.min.js"; ?>"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri() . "/assets/scripts/suffolkdown.js"; ?>"></script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<nav id="navbar" class="navbar">
				<div class="site-image-container">
					<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					</a>
				</div>
				<div class="site-nav-container">
					<div id="site-navigation" class="navigation main-navigation" role="navigation">
						<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'suffolkdowns' ); ?>"><?php _e( 'Skip to content', 'suffolkdowns' ); ?></a>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'menu_id' => 'primary-menu' ) ); ?>
						<!-- <?php get_search_form(); ?> -->
					</div>
				</div>
				<div>
					<div class="site-nav-responsive-button">
						<button id="nav-menu-button" class="menu-toggle">
							<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
						</button>
						<button id="close-nav-menu-button" class="close-nav-button hide">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
			</nav>
			<div class="responsive-nav-container hide">
				<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'suffolkdowns' ); ?>"><?php _e( 'Skip to content', 'suffolkdowns' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'menu_id' => 'primary-menu' ) ); ?>
		  </div>
		</header>
		<div id="main" class="site-main clear-float">
