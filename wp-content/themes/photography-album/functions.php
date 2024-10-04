<?php
if ( ! function_exists( 'photography_album_setup' ) ) :
function photography_album_setup() {

	add_theme_support( "woocommerce" );	

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( "responsive-embeds" );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );
	
	
	add_theme_support( 'custom-header' );
	
	//Add selective refresh for sidebar widget
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary_menu' => esc_html__( 'Primary Menu', 'photography-album' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	/*
	 * Enable support for custom logo.
	 */
	add_theme_support('custom-logo');
	
	remove_theme_support( 'widgets-block-editor' );

	// -- Disable Custom Colors
	add_theme_support( 'disable-custom-colors' );
		
	// Gutenberg wide images.
	add_theme_support( 'align-wide' );
		
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css' ) );
	
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'photography_album_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	load_theme_textdomain( 'photography-album', get_stylesheet_directory() . '/languages' );
}
endif;
add_action( 'after_setup_theme', 'photography_album_setup' );

/*
 * Enable support for Post Formats.
 *
 * See: https://codex.wordpress.org/Post_Formats
*/
add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function photography_album_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'photography_album_content_width', 1170 );
}
add_action( 'after_setup_theme', 'photography_album_content_width', 0 );

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'photography_album_loop_columns', 999);
if (!function_exists('photography_album_loop_columns')) {
	function photography_album_loop_columns() {
		return 3; // 3 products per row
	}
}

function photography_album_customize_remove_register() {
    global $wp_customize;

    $wp_customize->remove_setting( 'display_header_text' );
    $wp_customize->remove_control( 'display_header_text' );
    
}
add_action( 'customize_register', 'photography_album_customize_remove_register', 11 );

/**
 * All Styles & Scripts.
 */
require_once get_template_directory() . '/inc/enqueue.php';

/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Sidebar.
 */
require_once get_template_directory() . '/inc/sidebar/sidebar.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require_once get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
 require_once get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require_once get_template_directory() . '/inc/jetpack.php';

/**
 * Load Web Font
 */
require_once get_template_directory() . '/inc/wptt-webfont-loader.php';

/**
 * Load Recommended Plugin
 */
require_once get_template_directory() . '/inc/tgm-plugin/tgm.php';

/**
 * Called all the Customize file.
 */
require( get_template_directory() . '/inc/customize/premium.php');

/**
 * Get Started.
 */
require( get_template_directory() . '/inc/started/main.php');

/**
 * Admin notice function.
 */
require_once get_template_directory() . '/inc/admin-notice/admin.php';

/* 
* Logo Resizer
*/
function photography_album_logo_resizer_setting() {

    $photography_album_theme_logo_size_css = '';
    $photography_album_logo_resizer_setting = get_theme_mod('photography_album_logo_resizer_setting');

	$photography_album_theme_logo_size_css = '
		.custom-logo{
			height: '.esc_attr($photography_album_logo_resizer_setting).'px !important;
			width: '.esc_attr($photography_album_logo_resizer_setting).'px !important;
		}
	';
    wp_add_inline_style( 'photography-album-style',$photography_album_theme_logo_size_css );

}
add_action( 'wp_enqueue_scripts', 'photography_album_logo_resizer_setting' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue Global color style */
/*-----------------------------------------------------------------------------------*/
function photography_album_global_color() {

    $photography_album_theme_color_css = '';
    $photography_album_theme_color_1 = get_theme_mod('photography_album_theme_color_1');
    $photography_album_theme_color_2 = get_theme_mod('photography_album_theme_color_2');

    $photography_album_theme_color_css = '
        a.slider-btn, a.about-btn,span.call-box,.page-template-template-homepage #header.navbar-area.header-fixed,.navbar-area.header-fixed,.line-1,.line-2,span.post-page-numbers.current span,span.onsale,.pro-button a,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt ,.woocommerce a.added_to_cart.wc-forward,.pro-button a:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce ul.products li.product .onsale,.woocommerce span.onsale,.woocommerce .woocommerce-ordering select,.woocommerce-account .woocommerce-MyAccount-navigation ul li,.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,.wc-block-cart__submit-container,#home_project .box-image span,.photography-album-btn .posts-navigation .nav-links a,.widget_search form.search-form .search-submit,.paginations a:hover, .paginations a:focus, .paginations a.active, span.page-numbers.current,.pagination a,.animate-border,a.login_button:hover,a.register_button:hover,.blog-post .post-thumb,button, input[type="button"], input[type="reset"], input[type="submit"],#footer-copyright,.widget_tag_cloud a:hover, .widget_tag_cloud a:focus, .wp-block-tag-cloud a:hover, .wp-block-tag-cloud a:focus,.nav-previous, .nav-next {
            background: ' . esc_attr($photography_album_theme_color_1) . ';
        }
        @media screen and (min-width: 320px) and (max-width: 768px) {
		        .toggle-menu button {
		        background: '.esc_attr($photography_album_theme_color_1).';
		    }
		}
        a.boxed-btn.btn-white i,.btn,.widget_categories ul li, .widget_archive ul li,#sidebar .widget_categories ul li, #sidebar .widget_archive ul li,.scrollup,.gb_nav_menu .sub-menu {
            background-color: ' . esc_attr($photography_album_theme_color_1) . ';
        }
        hr.hr-a,.photography-album-btn .boxed-btn, .photography-album-btn .boxed-btn:hover, .photography-album-btn .boxed-btn:focus, .photography-album-btn .posts-navigation .nav-links a:hover, .photography-album-btn .posts-navigation .nav-links a:focus, .sidebar .widget_search button, .wp-block-search .wp-block-search__button, .sidebar .widget table th {
            background-color: ' . esc_attr($photography_album_theme_color_1) . '!important;
        }
        .slider_content_box hr,.woocommerce-message,.woocommerce-info,.wp-block-button.is-style-outline a.wp-block-button__link,#sidebar .widget_categories ul li,#sidebar .widget_archive ul li,.scrollup,.scrollup:hover, .scrollup:focus {
            border-color: ' . esc_attr($photography_album_theme_color_1) . ';
        }
       	a.boxed-btn i, .boxed-btn i,.loader-text,p.price,.woocommerce ul.products li.product .price,.woocommerce div.product p.price,.woocommerce div.product span.price,.woocommerce-message::before,.woocommerce-info::before,.post-comment-area .media,.footer-sidebar .widget ul li a:before,.wp-block-post-terms a:before,.woocommerce ul.products li.product .woocommerce-loop-product__title, #blog-content .post-content h4 a:hover,#blog-content ul.meta-info li a,.post-category i,i.fa.fa-user,#blog-content ul.meta-info li,.sidebar .widget-title, #sidebar .widget.widget_search label, #sidebar .sidebar .widget h2.wp-block-heading, .sidebar h2.wp-block-heading,.sidebar .widget_recent_entries ul li a:focus, .sidebar .widget_recent_comments ul li a:focus, .sidebar .widget_archive ul li a:focus, .sidebar .widget_categories ul li a:focus, .sidebar .widget_meta ul li a:focus,.widget_pages ul li a:hover, .widget_pages ul li a:focus,.footer-sidebar .widget_recent_entries ul li a:hover, .footer-sidebar .widget_recent_comments ul li a:hover, .footer-sidebar .widget_archive ul li a:hover, .footer-sidebar .widget_categories ul li a:hover, .footer-sidebar .widget_meta ul li a:hover, .footer-sidebar .widget_recent_entries ul li a:focus, .footer-sidebar .widget_recent_comments ul li a:focus, .footer-sidebar .widget_archive ul li a:focus, .footer-sidebar .widget_categories ul li a:focus, .footer-sidebar .widget_meta ul li a:focus,#blog-content .post-content:hover .post-title a, #recent-blog .post-content .post-title a, .footer-sidebar .widget.widget_products ul li a:hover, .footer-sidebar .widget.widget_products ul li a:focus, .sidebar .widget_info i,.scrollup:hover, .scrollup:focus,p a,#blog-content ul.meta-info li i,#blog-content ul.meta-info li:focus-within i, #blog-content ul.meta-info li a:focus, #blog-content ul.meta-info li a:hover,.gb_nav_menu ul li a:active, .gb_nav_menu ul li a:hover,.wc-block-cart-item__wrap a,#recent-blog .blog-post:hover .read-more-link, .blog-post:hover .post-content .post-title a, #recent-blog .blog-post:focus-within .read-more-link, .blog-post:focus-within .post-content .post-title a, .site-content a{
            color: ' . esc_attr($photography_album_theme_color_1) . ';
        }
        span.highlight-text{
            color: ' . esc_attr($photography_album_theme_color_1) . '!important;
        }
    ';
    
    wp_add_inline_style('photography-album-style', $photography_album_theme_color_css);
    wp_add_inline_style('photography-album-woocommerce-css', $photography_album_theme_color_css);

}
add_action('wp_enqueue_scripts', 'photography_album_global_color');