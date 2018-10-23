<?php
declare(strict_types=1);
/**
 * Wordpress and theme support customization.
 * Customizer functions and definitions.
 *
 * @link https://codex.wordpress.org/Theme_Customization_API/
 *
 * @package La boite à bouillons
 * @version 1.0
 */
namespace lbab\customizer;

/**
 * Sets up a filter to require that API consumers be authenticated, which effectively prevents anonymous external access.
 * We should not disable the REST API, because doing so would break future WordPress Admin functionality that will depend on the API being active.
 *
 * @link https://developer.wordpress.org/rest-api/using-the-rest-api/frequently-asked-questions/#can-i-disable-the-rest-api
 *
 * @param WP_Error|null|bool WP_Error if authentication error, null if authentication method wasn't used, true if authentication succeeded.
 * @return WP_Error|null|bool WP_Error if the user is not logged in, the $result, otherwise true.
 */
function setAuthenticationForREST( $result ) {
    if( !empty( $result )) {
        // Error from another authentication handler.
        return $result;
    }

    if( !is_user_logged_in()) {
        return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', [ 'status' => 401 ] );
    }
    return $result;
}

/**
 * Update customizer panel.
 *
 * @link https://codex.wordpress.org/Theme_Customization_API
 *
 * @param WP_Customize_Manager $pWPCustomize The customizer class.
 */
function customizeRegister( \WP_Customize_Manager $pWPCustomize ) {
    $pWPCustomize->remove_section( 'background_image' );
    $pWPCustomize->remove_section( 'custom_css' );
}

/**
 * Add more or remove allowed mime types and file extensions..
 *
 * @param array $aMimes The list of the default allowed mime types.
 * @return array
 */
function getCustomAllowedMimeTypes( array $aMimes ): array {
    // Remove a mime type.
    unset( $aMimes['class'] );
    unset( $aMimes['txt|asc|c|cc|h|srt'] );
    // New allowed mime types.
    $aMimes['txt|asc|srt'] = 'text/plain';
    $aMimes['svg'] = 'image/svg+xml';
    $aMimes['webp'] = 'image/webp';
    return $aMimes;
}

/**
 * Add configuration to TinyMCE Advanced.
 *
 * @param array $aDefaults Array of TinyMCE config.
 * @return array
 */
function getCustomTinyMCEAdvanced( array $aInit ) : array {
    $sDefault = '"000000", "Black","993300", "Burnt orange","333300", "Dark olive","003300", "Dark green","003366", "Dark azure","000080", "Navy Blue","333399", "Indigo","333333", "Very dark gray","800000", "Maroon","FF6600", "Orange","808000", "Olive","008000", "Green","008080", "Teal","0000FF", "Blue","666699", "Grayish blue","808080", "Gray","FF0000", "Red","FF9900", "Amber","99CC00", "Yellow green","339966", "Sea green","33CCCC", "Turquoise","3366FF", "Royal blue","800080", "Purple","999999", "Medium gray","FF00FF", "Magenta","FFCC00", "Gold","FFFF00", "Yellow","00FF00", "Lime","00FFFF", "Aqua","00CCFF", "Sky blue","993366", "Red violet","FFFFFF", "White","FF99CC", "Pink","FFCC99", "Peach","FFFF99", "Light yellow","CCFFCC", "Pale green","CCFFFF", "Pale cyan","99CCFF", "Light sky blue","CC99FF", "Plum"';
    $sCustom = '"59BCAB", "Vert céladon", "0D4952", "Bleu canard", "7F5487", "Violet", "696A6C", "Gris", "C5B286", "Beige", "E9325D", "Rose", "FEC73E", "Jaune","FFFFFF", "White"';
    $aInit['textcolor_map'] = '['.$sCustom.','.$sDefault.']';
    $aInit['textcolor_rows'] = 6;
    return $aInit;
}

/**
 * Builds the body background color style using Custom Background feature.
 * This function may be used as 'wp-head-callback' callback in add_theme_support( 'custom-background' ).
 *
 * @return string
 */
function getCustomBackgroundStyle() {
    // Initialize
    $sColor = get_background_color();

    // Do not have custom background color
    if( strcmp( $sColor, 'f8f8f8' ) === 0 ) {
        return;
    }

    // Has background color
    if( !empty( $sColor )) {
        $sReturn = sprintf( '<style type="text/css">body{background-color:#%1$s !important;}</style>', $sColor );
    } else {
        $sReturn = '';
    }

    echo $sReturn;
}

/**
 * Filters the separator for the document title.
 *
 * @link https://developer.wordpress.org/reference/hooks/document_title_separator/
 */
function getCustomDocumentTitleSeparator()
{
    return '|';
}

/**
 * Enqueue scripts and styles.
 */
function enqueueScripts()
{
    // Disable Embeds
    wp_deregister_script( 'wp-embed' );
    wp_dequeue_script( 'wp-embed' );

    // Register the google fonts.
    if( wp_register_style('lbab-fonts', \lbab\customizer\getCustomFont(), [], null, 'all')){
        wp_enqueue_style('lbab-fonts'); // Enqueue it!
    }

    // Register the CSS stylesheet.
    if( wp_register_style('lbab-style', get_template_directory_uri() . '/assets/css/lbab.css', [], null, 'all')){
        wp_enqueue_style('lbab-style'); // Enqueue it!
    }

    // Register the custom scripts.
    /*
    if( wp_register_script('lbab-script', ...)){
        wp_enqueue_script('lbab-script'); // Enqueue it!
    }
    */
}

/**
 * Register custom fonts.
 *
 * @return string
 */
function getCustomFont() : string {
    $aQueryArgs = [
        'family' => urlencode( implode( '|', [ 'Athiti:500,700', 'Caveat:400,700', 'Raleway:500,500i,700,700' ])),
        'subset' => urlencode( 'latin-ext' ),
    ];
    return esc_url_raw( add_query_arg( $aQueryArgs, 'https://fonts.googleapis.com/css' ) );
}

/**
 * Filters the navigation markup template.
 * Removes the heading and the div
 *
 * @link https://developer.wordpress.org/reference/hooks/navigation_markup_template/
 *
 * @param string $sTemplate The default template.
 * @param string $sClass The class passed by the calling function.
 * @return string
 */
function getCustomPaginationTemplate( string $sTemplate, string $sClass ) : string {
    $sReturn = str_replace( [ '<h2 ', '</h2>', '<div class="nav-links">', '</div>' ], [ '<!--h2 ', '</h2-->', '', '' ], $sTemplate );
    return $sReturn;
}