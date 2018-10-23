<?php
declare(strict_types=1);
/**
 * Header functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package La boite à bouillons
 * @version 1.0
 */
namespace lbab\header;

/**
 * Builds the navigation for the header menu.
 *
 * @param array $aPages The page list. Each element is an array of two elements: 'post_title' and 'post_name'.
 * @param array $aFilter The filter. Use the default.
 * @param bool Shall we skip the first page. Default is TRUE.
 * @return array
 */
function buildNavigationForHeaderMenu( array $aPages, array $aFilter = [ 'post_title' => 'post_title', 'post_name' => 'post_name' ], bool $bSkipFirst = TRUE ) : array {
    // Initialize
    $sHeaderTagTemplate = '<a href="%1$s/" class="button hidden-sm">%2$s</a>' . PHP_EOL;
    $sNavTagTemplate = '<a href="%1$s/">%2$s</a>' . PHP_EOL;
    $sHeaderTags = $sNavTags = '';

    // Build the nav
    foreach( $aPages as $aPage ) {

        // We assume that the front/home page is an icon and not a text
        if( $bSkipFirst ) {
            $bSkipFirst = FALSE;
            continue;
        }

        // Test the keys.
        $aPage = array_intersect_key( $aPage, $aFilter );

        if( count($aPage) === count($aFilter) ) {
            $sUrl = esc_attr( esc_url( home_url( '/' ) . $aPage['post_name'] ));
            $sTitle = esc_html( $aPage['post_title'] );
            $sHeaderTags .= sprintf( $sHeaderTagTemplate, $sUrl, $sTitle );
            $sNavTags .= sprintf( $sNavTagTemplate, $sUrl, $sTitle );
        }
    }

    return [ 'header_tag' => $sHeaderTags, 'nav_tag' => $sNavTags ];
}