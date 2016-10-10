<?php

/**
 * Suffolk Downs functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see https://codex.wordpress.org/Theme_Development
 * and https://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link https://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Suffolk_Downs
 * @since Suffolk Downs 1.0
 */

/*
 * Set up the content width value based on the theme's design.
 *
 * @see suffolkdowns_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;

/**
 * Add support for a custom header image.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Suffolk Downs only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/inc/back-compat.php';

/**
 * Suffolk Downs setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Suffolk Downs supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Suffolk Downs 1.0
 */
function suffolkdowns_setup() {
	/*
	 * Makes Suffolk Downs available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Suffolk Downs, use a find and
	 * replace to change 'suffolkdowns' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'suffolkdowns', get_template_directory() . '/languages' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', suffolkdowns_fonts_url() ) );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * This theme supports all available post formats by default.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'suffolkdowns' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'suffolkdowns_setup' );

/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Suffolk Downs 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function suffolkdowns_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'suffolkdowns' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'suffolkdowns' );

	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';

		if ( 'off' !== $bitter )
			$font_families[] = 'Bitter:400,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Suffolk Downs 1.0
 */
function suffolkdowns_scripts_styles() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );

	// Loads JavaScript file with functionality specific to Suffolk Downs.
	// wp_enqueue_script( 'suffolkdowns-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );

	// Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	// wp_enqueue_style( 'suffolkdowns-fonts', suffolkdowns_fonts_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	// wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.03' );

	// Loads our main stylesheet.
	// wp_enqueue_style( 'suffolkdowns-style', get_stylesheet_uri(), array(), '2013-07-18' );

	// Loads the Internet Explorer specific stylesheet.
	// wp_enqueue_style( 'suffolkdowns-ie', get_template_directory_uri() . '/css/ie.css', array( 'suffolkdowns-style' ), '2013-07-18' );
	// wp_style_add_data( 'suffolkdowns-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'suffolkdowns_scripts_styles' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Suffolk Downs 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function suffolkdowns_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'suffolkdowns' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'suffolkdowns_wp_title', 10, 2 );

/**
 * Register two widget areas.
 *
 * @since Suffolk Downs 1.0
 */
function suffolkdowns_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'suffolkdowns' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'suffolkdowns' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Secondary Widget Area', 'suffolkdowns' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'suffolkdowns' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'suffolkdowns_widgets_init' );

if ( ! function_exists( 'suffolkdowns_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Suffolk Downs 1.0
 */
function suffolkdowns_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'suffolkdowns' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'suffolkdowns' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'suffolkdowns' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'suffolkdowns_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since Suffolk Downs 1.0
 */
function suffolkdowns_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>

	<?php
}
endif;

if ( ! function_exists( 'suffolkdowns_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own suffolkdowns_entry_meta() to override in a child theme.
 *
 * @since Suffolk Downs 1.0
 */
function suffolkdowns_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . esc_html__( 'Sticky', 'suffolkdowns' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		suffolkdowns_entry_date();

	// Translators: used between list items, there is a space after the comma.
	// $categories_list = get_the_category_list( __( ', ', 'suffolkdowns' ) );
	// if ( $categories_list ) {
	// 	echo '<span class="categories-links">' . $categories_list . '</span>';
	// }

	// // Translators: used between list items, there is a space after the comma.
	// $tag_list = get_the_tag_list( '', __( ', ', 'suffolkdowns' ) );
	// if ( $tag_list ) {
	// 	echo '<span class="tags-links">' . $tag_list . '</span>';
	// }

	// Post author
	// if ( 'post' == get_post_type() ) {
	// 	printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
	// 		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
	// 		esc_attr( sprintf( __( 'View all posts by %s', 'suffolkdowns' ), get_the_author() ) ),
	// 		get_the_author()
	// 	);
	// }
}
endif;

if ( ! function_exists( 'suffolkdowns_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own suffolkdowns_entry_date() to override in a child theme.
 *
 * @since Suffolk Downs 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function suffolkdowns_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'suffolkdowns' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><time class="entry-date" datetime="%3$s">%4$s</time></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'suffolkdowns' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'suffolkdowns_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Suffolk Downs 1.0
 */
function suffolkdowns_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since Suffolk Downs 1.0
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'suffolkdowns_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( reset( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Suffolk Downs 1.0
 *
 * @return string The Link format URL.
 */
function suffolkdowns_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

if ( ! function_exists( 'suffolkdowns_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ...
 * and a Continue reading link.
 *
 * @since Suffolk Downs 1.4
 *
 * @param string $more Default Read More excerpt link.
 * @return string Filtered Read More excerpt link.
 */
function suffolkdowns_excerpt_more( $more ) {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'suffolkdowns' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'suffolkdowns_excerpt_more' );
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since Suffolk Downs 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function suffolkdowns_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	return $classes;
}
add_filter( 'body_class', 'suffolkdowns_body_class' );

/**
 * Adjust content_width value for video post formats and attachment templates.
 *
 * @since Suffolk Downs 1.0
 */
function suffolkdowns_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'suffolkdowns_content_width' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Suffolk Downs 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function suffolkdowns_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title',
			'container_inclusive' => false,
			'render_callback' => 'suffolkdowns_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'suffolkdowns_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'suffolkdowns_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Suffolk Downs 1.9
 * @see suffolkdowns_customize_register()
 *
 * @return void
 */
function suffolkdowns_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Suffolk Downs 1.9
 * @see suffolkdowns_customize_register()
 *
 * @return void
 */
function suffolkdowns_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JavaScript handlers to make the Customizer preview
 * reload changes asynchronously.
 *
 * @since Suffolk Downs 1.0
 */
function suffolkdowns_customize_preview_js() {
	wp_enqueue_script( 'suffolkdowns-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20141120', true );
}
add_action( 'customize_preview_init', 'suffolkdowns_customize_preview_js' );



add_action( 'wp_enqueue_scripts', 'add_my_script' );
function add_my_script() {
    wp_enqueue_script(
        'jquery', // name your script so that you can attach other scripts and de-register, etc.
        get_template_directory_uri() . '/assets/scripts/jquery.min.js', // this is the location of your script file
        array('jquery') // this array lists the scripts upon which your script depends
    );
}


// Remove embeds.
function disable_embeds_init() {
	// Remove the REST API endpoint.
	remove_action('rest_api_init', 'wp_oembed_register_route');

	// Turn off oEmbed auto discovery.
	// Don't filter oEmbed results.
	remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

	// Remove oEmbed discovery links.
	remove_action('wp_head', 'wp_oembed_add_discovery_links');

	// Remove oEmbed-specific JavaScript from the front-end and back-end.
	remove_action('wp_head', 'wp_oembed_add_host_js');
}

add_action('init', 'disable_embeds_init', 9999);

// Remove shortlink.
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Remove canoncial
remove_action('wp_head', 'rel_canonical');

// Remove generator (wp).
remove_action('wp_head', 'wp_generator');

// Remove wlwmanifest_link.
remove_action( 'wp_head', 'wlwmanifest_link' );

// Remove EditURI.
remove_action( 'wp_head', 'rsd_link' );

// Remove emoji.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Remove feeds.
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

//	Remove file versioning.
function remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );


// // Remove jquery.
// add_action('wp_enqueue_scripts', 'no_more_jquery');
// function no_more_jquery(){
//     wp_deregister_script('jquery');
// }


// remove login logo
function custom_login_logo() {
	echo '<style>h1 a{background:none !important}</style>';
}
add_action('login_head', 'custom_login_logo');


// Remove current page selction (Blog) in 404.
function dtbaker_wp_nav_menu_objects($sorted_menu_items, $args){
    // check if the current page is really a blog post.
    global $wp_query;
    if(!empty($wp_query->queried_object_id)){
        $current_page = get_post($wp_query->queried_object_id);
        if($current_page && $current_page->post_type=='post'){
            //yes!
        }else{
            $current_page = false;
        }
    }else{
        $current_page = false;
    }

    $home_page_id = (int) get_option( 'page_for_posts' );
    foreach($sorted_menu_items as $id => $menu_item){
        if ( ! empty( $home_page_id ) && 'post_type' == $menu_item->type && empty( $wp_query->is_page ) && $home_page_id == $menu_item->object_id ){
            if(!$current_page){
                foreach($sorted_menu_items[$id]->classes as $classid=>$classname){
                    if($classname=='current_page_parent'){
                        unset($sorted_menu_items[$id]->classes[$classid]);
                    }
                }
            }
        }
    }
    return $sorted_menu_items;
}
add_filter('wp_nav_menu_objects','dtbaker_wp_nav_menu_objects',10,2);

// Remove jquery.

add_action('wp_enqueue_scripts', 'no_more_jquery');
function no_more_jquery(){
    wp_deregister_script('jquery');
}


remove_action( 'wp_head', 'wp_resource_hints', 2 );

remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
