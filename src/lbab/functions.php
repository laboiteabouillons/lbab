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
 * La boite à bouillons theme only works in WordPress 4.9.8 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.9.8', '<' ) ) {
    require_once get_template_directory() . '/inc/compatibility.php';
    return;
}

/**
 * Load La boite à bouillons files.
 */
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/footer.php';
require_once get_template_directory() . '/inc/head.php';
require_once get_template_directory() . '/inc/header.php';
require_once get_template_directory() . '/inc/media.php';
require_once get_template_directory() . '/inc/page.php';
require_once get_template_directory() . '/inc/post.php';
require_once get_template_directory() . '/inc/maintenance.php';

/**
 * Add Actions
 */
add_action( 'after_setup_theme', '\lbab\setup\setup' ); // Sets up theme defaults and registers support for various WordPress features. Called during each page load, after the theme is initialized.
add_action( 'wp_enqueue_scripts', '\lbab\customizer\enqueueScripts' ); // Add theme stylesheet and custom scripts
add_action( 'wp_head', '\lbab\head\printCustomHead', 2); // Custom <head>
defined( 'WP_DEBUG_DISPLAY' ) && (TRUE===constant( 'WP_DEBUG_DISPLAY' )) && add_action( 'wp_footer', '\lbab\footer\debug', 90 ); // Load WP_FOOTER actions.
add_action( 'customize_register', '\lbab\customizer\customizeRegister' ); // Defines new Customizer panels, sections, settings, and controls.
add_action('login_head', '\lbab\customizer\printCustomLoginLogo'); // Customises the login form.
add_action( 'pre_get_posts', '\lbab\post\filterPostQueryForHome' );
//add_action('get_header', '\lbab\maintenance\activate');

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
add_filter( 'style_loader_src', '\lbab\customizer\filterVersionParameterFromEnqueuedScript', 90,2 ); // Remove the version parameter, ver=, from enqueued CSS script
add_filter( 'script_loader_src', '\lbab\customizer\filterVersionParameterFromEnqueuedScript', 90,2 );// Remove the version parameter, ver=, from enqueued JS script
add_filter( 'login_headerurl', '\lbab\customizer\getCustomLoginHeaderUrl' ); // Filter the url of the logo in WordPress login page.
add_filter( 'login_headertitle', '\lbab\customizer\getCustomLoginHeaderTitle' ); // Filters the title attribute of the header logo in WordPress login page.

/**
 * Remove Filters
 */
remove_filter( 'the_content', 'wpautop' ); // Stop WP adding extra <p> </p> to the pages' content
remove_filter( 'the_excerpt', 'wpautop' ); // Stop WP adding extra <p> </p> to the post excerpts' content

/**
 * Add shortcodes
 */
add_shortcode('lbab_newsletter', '\lbab\post\lbab_shortcode_newsletter' );
add_shortcode('lbab_pepites', '\lbab\post\lbab_shortcode_pepites' );
