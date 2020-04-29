<?php
declare(strict_types=1);
/**
 * La boite à bouillons theme support setup.
 *
 * Prevents La boite à bouillons theme from running on WordPress versions prior to 4.9.1,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.9.1.
 *
 * @package La boite à bouillons
 * @version 1.0
 */
namespace lbab\setup;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function setup() {

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
    // TODO
}


/**
 * Prevent switching to La boite à bouillons theme on old versions of WordPress.
 * Switches to the default theme.
 */
function getStarterContent() : array {
    return [
        'widgets' => [], // No widget
        'posts' => [
            'home' => [
                'post_type' => 'page',
                'post_title' => "Concentré d'intelligence collective" ],
            'esprit' => [
                'post_type' => 'page',
                'post_title' => "L'esprit" ],
            'fondatrice' => [
                'post_type' => 'page',
                'post_title' => "La fondatrice" ],
            'legal' => [
                'post_type' => 'page',
                'post_title' => "Mentions légales" ],
            'challenge' => [
                'post_type' => 'page',
                'post_title' => "Votre challenge" ],
            'accompagnement' => [
                'post_type' => 'page',
                'post_title' => "Accompagnement communication" ],
            'workshop' => [
                'post_type' => 'page',
                'post_title' => "Workshops créatifs" ],
            'formation' => [
                'post_type' => 'page',
                'post_title' => "Formations" ],
            'pepite' => [
                'post_type' => 'page',
                'post_title' => "Les pépites" ],
            'reseau' => [
                'post_type' => 'page',
                'post_title' => "Le réseau" ],
            'blog' => [
                'post_type' => 'page',
                'post_title' => "Blog" ]
        ],

    ];
}


/*
* Define and register starter content to showcase the theme on new sites.
*
* @link https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
*/
/*$aStarterContent = [
    // 'widgets' => [] // No widget
    // Specify the core-defined pages to create
    'posts' => [ array(
        'post_type' => 'page',
        'post_title' => _x( 'Home', 'Theme starter content' ),
        'post_content' => _x( 'Welcome to your site! This is your homepage, which is what most visitors will see when they come to your site for the first time.', 'Theme starter content' ),
    )
    'Concentré d&#39;intelligence collective',
        'L&#39;esprit',
        'La fondatrice',
        'Mentions légales',
        'Votre challenge',
        'Accompagnement communication',
        'Workshops créatifs',
        'Formations',
        'Les pépites',
        'Le réseau',
        'Blog' ],
    // Default to a static front page and assign the front and posts pages.
    'options' => array(
        'show_on_front' => 'page',       // type of homepage (latest posts or static page)
        'page_on_front' => '{{home}}',   // which page is shown on homepage
        'page_for_posts' => '{{Blog}}',
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
/*];
$aStarterContent = apply_filters( 'lbab_starter_content', $aStarterContent );
add_theme_support( 'starter-content', $aStarterContent );
}
*/