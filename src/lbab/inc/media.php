<?php
declare(strict_types=1);
/**
 * Media functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package La boite à bouillons
 * @version 1.0
 */
namespace lbab\media;

/**
 * Builds srcset from an URL.
 *
 * @param string $sUrl  The URL
 * @param array $aSizes The differents sizes of srcset to build
 * @return string
 */
function buildSizedSrcset( string $sUrl, array $aSizes = [ '1366w' => '1366x768', '1024w' => '1024x768', '768w' => '768x1024', '360w' => '360x640' ] ): string {
    // Initialize
    $sBuffer = '';

    // Get the information about the file path
    $aPathInfo = (!empty($sUrl)) ? pathinfo($sUrl): [];

    // Build sizes
    if( 4==count( $aPathInfo ) ) {
        $sBuffer = esc_url( $sUrl ) . ' 1920w';
        foreach( $aSizes as $key => $value ) {
            $sBuffer .= ',' . esc_url( $aPathInfo['dirname'] . '/' . $aPathInfo['filename'] . '_' . $value . '.' . $aPathInfo['extension'] ) . ' ' . $key;
        }
    }

    // Build srcset
    $sReturn =  sprintf( 'srcset="%1$s" sizes="100vw"', esc_attr( $sBuffer ) );

    return $sReturn;
}

/**
 * Builds image tag with srcset from an url and it's alternate text.
 * The function is used to build the featured image in pages.
 *
 * @param string $sUrl  The URL
 * @param string $sAlt The alternate text
 * @return string
 */
function buildImageTagWithSizedSrcset( string $sUrl, string $sAlt ): string {
    return sprintf( '<img src="%1$s" alt="%2$s" %3$s >'
        , esc_attr( esc_url( $sUrl ) )
        , esc_attr( $sAlt )
        , \lbab\media\buildSizedSrcset( $sUrl ) );
}