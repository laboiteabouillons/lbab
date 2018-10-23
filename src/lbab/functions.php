<?php
declare(strict_types=1);
/**
 * Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package La boite à bouillons
 * @version 1.0
 */

/**
 * La boite à bouillons theme only works in WordPress 4.9.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.9.1', '<' ) ) {
	require_once get_template_directory() . '/inc/compatibility.php';
	return;
}

/**
 * Load La boite à bouillons files.
 */
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/footer.php';
require_once get_template_directory() . '/inc/head.php';
require_once get_template_directory() . '/inc/header.php';
require_once get_template_directory() . '/inc/media.php';
require_once get_template_directory() . '/inc/page.php';
require_once get_template_directory() . '/inc/post.php';

/**
 * Theme Support.
 */
if( !function_exists( 'lbab_setup' )) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
	function lbab_setup() {

        // Set the default content width.
        $GLOBALS['content_width'] = 1366;

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on lbab, use a find and replace
		 * to change 'lbab' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'lbab', get_template_directory() . '/assets/languages' );

        /*
        * Enable support for Post Formats.
        *
        * See: https://codex.wordpress.org/Post_Formats
        */
        add_theme_support( 'post-formats', [ 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ]);
        // Or Disabling support for Post Formats.
        // remove_theme_support('post-formats');

		/*
		 * Enable support for Featured Images on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'lbab-featuredimage', 1920, 1080, true );
        add_image_size( 'lbab-featuredimage-360x640', 360, 640, true );
        add_image_size( 'lbab-featuredimage-768x1024', 768, 1024, true );
        add_image_size( 'lbab-featuredimage-1024x768', 1024, 768, true );
        add_image_size( 'lbab-featuredimage-1366x768', 1366,768, true );
        add_image_size( 'lbab-thumbnail-avatar', 100, 100, true );

		/*
		 * Enable support for Custom Background.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support( 'custom-background', [
            'default-color'          => 'f8f8f8',
            'default-image'          => '',
            'default-repeat'         => '',
            'default-position-x'     => '',
            'wp-head-callback'       => '\lbab\customizer\getCustomBackgroundStyle',
            'admin-head-callback'    => '',
            'admin-preview-callback' => '' ]);

		/*
		 * Enable support for Custom Headers.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
		 */
        add_theme_support( 'custom-header', [
            'default-image'          => get_template_directory_uri() . '/assets/img/logo/lbab-45x45.png',
            'width'                  => 45,
            'height'                 => 45,
            'flex-width'             => false,
            'flex-height'            => false,
            'uploads'                => false,
            'random-default'         => false,
            'header-text'            => false,
            'default-text-color'     => '212121',
            'wp-head-callback'       => '',
            'admin-head-callback'    => '',
            'admin-preview-callback' => '',
            'video'                  => false,
            'video-active-callback'  => '' ]);

        // Registers a selection of default headers to be displayed by the Customizer.
        register_default_headers( [
            'default-image' =>[
                'url'           => '%s/assets/img/logo/lbab-45x45.png',
                'thumbnail_url' => '%s/assets/img/logo/lbab-45x45.png',
                'description'   => esc_html__( 'Logo de la boite à bouillons', 'lbab' )],
            'default-image-small' => [
                'url'           => '%s/assets/img/logo/lbab-48x48.png',
                'thumbnail_url' => '%s/assets/img/logo/lbab-48x48.png',
                'description'   => esc_html__( 'Logo de la boite à bouillons', 'lbab' )]]);

		/*
		 * Enable support for Custom Logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo/
		 */
        add_theme_support( 'custom-logo',[
            'height'      => 144,
            'width'       => 144,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => [ 'site-title', 'site-description' ]]);

		/*
		 * Enable Automatic Feed Links for post and comment in the head.
		 *
		 * @link https://codex.wordpress.org/Automatic_Feed_Links
		 */
        add_theme_support( 'automatic-feed-links' );

		/*
		 * Allows the use of HTML5 markup.
		 *
		 * @link https://codex.wordpress.org/Theme_Markup/
		 */
        add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ]);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 *
		 * @link https://codex.wordpress.org/Title_Tag/
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Add theme support for selective refresh for widgets.
		 *
		 * @link https://make.wordpress.org/core/2016/03/22/implementing-selective-refresh-support-for-widgets/
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Add theme support for custom CSS in the TinyMCE visual editor
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_editor_style/
		 */
        add_editor_style( [ 'assets/css/editor.css', \lbab\customizer\getCustomFont() ]);

		/*
		 * Add theme support for navigation menu location. This theme uses wp_nav_menu().
		 *
		 * @link https://developer.wordpress.org/themes/functionality/navigation-menus/
		 */
//        register_nav_menus([ 'header-menu' => esc_html__( 'Header Menu', 'lbab' )]);

        /*
        * Define and register starter content to showcase the theme on new sites.
        *
        * @link https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
        */
        $aStarterContent = [
            // Specify the core-defined pages to create and add custom thumbnails to some of them.
            'posts' => [ 'home', 'blog' ],
            // Default to a static front page and assign the front and posts pages.
            'options' => array(
                'show_on_front' => 'page',       // type of homepage (latest posts or static page)
                'page_on_front' => '{{home}}',   // which page is shown on homepage
                'page_for_posts' => '{{blog}}',
            ),
            // Set up nav menus for each of the two areas registered in the theme.
 /*           'nav_menus' => array(
                // Assign a menu to the "top" location.
                'top' => array(
                    'name' => __( 'Top Menu', 'lbab' ),
                    'items' => array(
                        'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
                        'page_about',
                        'page_blog',
                        'page_contact',
                    ),
                ),
            ),*/
        ];
        $aStarterContent = apply_filters( 'lbab_starter_content', $aStarterContent );
        add_theme_support( 'starter-content', $aStarterContent );
	}
}

/**
 * Add Actions
 */
add_action( 'after_setup_theme', 'lbab_setup' ); // Sets up theme defaults and registers support for various WordPress features. Called during each page load, after the theme is initialized.
add_action( 'wp_enqueue_scripts', '\lbab\customizer\enqueueScripts' ); // Add theme stylesheet and custom scripts
add_action( 'wp_head', '\lbab\head\getCustomHead', 2); // Custom <head>
defined( 'WP_DEBUG_DISPLAY' ) && (TRUE===constant( 'WP_DEBUG_DISPLAY' )) && add_action( 'wp_footer', '\lbab\footer\debug', 90 ); // Load WP_FOOTER actions.
add_action( 'customize_register', '\lbab\customizer\customizeRegister' ); // Defines new Customizer panels, sections, settings, and controls.

/**
 * Remove Actions
 */
foreach( [ 'rss2_head', 'commentsrss2_head', 'rss_head', 'rdf_header', 'atom_head', 'comments_atom_head', 'opml_head', 'app_head' ] as $sTag ){
    remove_action( $sTag, 'the_generator' ); // Feed generator tags
}
remove_action( 'wp_head', 'wp_generator'); // wp_head generator tags
remove_action( 'wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'wp_resource_hints', 2);
//remove_action( 'wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'print_emoji_detection_script', 7);
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action( 'wp_head', 'rest_output_link_wp_head', 10); // Display link in <head>
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 ); // Remove oEmbed discovery links.
//remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'rel_canonical');

/**
 * Add Filters
 */
add_filter( 'xmlrpc_enabled', '__return_false' ); // Disable XML RPC
add_filter( 'rest_authentication_errors', '\lbab\customizer\setAuthenticationForREST' ); // Disable REST API
add_filter('upload_mimes', '\lbab\customizer\getCustomAllowedMimeTypes'); // Update allowed mime types and file extensions.
add_filter('tiny_mce_before_init', '\lbab\customizer\getCustomTinyMCEAdvanced'); // Load Tinymce_Advanced options
add_filter('document_title_separator', '\lbab\customizer\getCustomDocumentTitleSeparator');
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter( 'excerpt_more', '\lbab\post\filterMoreLinkForAutomaticallyGeneratedExcerpt' ); // Enhance the more tag in automatically generated excerpt
add_filter( 'get_the_excerpt', '\lbab\post\filterMoreLinkForManualExcerpt' ); // Enhance the more tag in manual excerpt
add_filter( 'navigation_markup_template', '\lbab\customizer\getCustomPaginationTemplate', 10, 2 ); // Filter the navigation html markup

/**
 * Remove Filters
 */
remove_filter( 'the_content', 'wpautop' ); // Stop WP adding extra <p> </p> to the pages' content
remove_filter( 'the_excerpt', 'wpautop' ); // Stop WP adding extra <p> </p> to the post excerpts' content