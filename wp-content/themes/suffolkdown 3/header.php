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
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<div class="site-logo-container">
				<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</a>
			</div>
			<div id="navbar" class="navbar">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					<!-- <button class="menu-toggle"><?php _e( 'Menu', 'suffolkdowns' ); ?></button> -->
					<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'suffolkdowns' ); ?>"><?php _e( 'Skip to content', 'suffolkdowns' ); ?></a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'menu_id' => 'primary-menu' ) ); ?>
					<!-- <?php get_search_form(); ?> -->
					<div class="site-nav-responsive-button">
						<button id="nav-menu-button" class="responsive-nav-button">
							<div id="nav-icon">
								<span></span>
								<span></span>
								<span></span>
							</div>
						</button>
						<button id="close-nav-menu-button" class="close-nav-button hide">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</nav>
			</div>
			<div class="responsive-nav-container hide">
				<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'suffolkdowns' ); ?>"><?php _e( 'Skip to content', 'suffolkdowns' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'menu_id' => 'primary-menu' ) ); ?>
			</div>
		</header>
		<div id="main" class="site-main">
