<?php
if ( ! isset( $content_width ) ) {
	$content_width = 750; /* pixels */
}

if ( ! function_exists( 'base_setup' ) ) :
function base_setup() {
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'base' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // base_setup
add_action( 'after_setup_theme', 'base_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function base_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'base' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'base_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function base_scripts() {
	wp_enqueue_style( 'base-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'base-modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2.min.js', array(), '20120206');

	wp_enqueue_script( 'base-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'base-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'base_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * People custom post type.
 */
add_action( 'init', 'create_projects' );
function create_projects() {
	register_post_type( 'projects',
		array(
			'labels' => array(
				'name' => __('Projects'),
				'singular_name' => __('Project'),
				'add_new' => __( 'Add New' ),
				'add_new_item' => __( 'Add New Project' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Project' ),
				'new_item' => __( 'New Project' ),
				'view' => __( 'View Project' ),
				'view_item' => __( 'View Project' ),
				'search_items' => __( 'Search Projects' ),
				'not_found' => __( 'No Projects found' ),
				'not_found_in_trash' => __( 'No Projects found in Trash' ),
				'parent' => __( 'Parent Project' )
			),
			'public' => true,
			'menu_icon' => 'dashicons-awards',
			'menu_position' => 5,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			'rewrite' => array( 'slug' => 'projects', 'with_front' => false)
		)
	);
}
