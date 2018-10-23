<?php
declare(strict_types=1);
/**
 * Footer functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package La boite à bouillons
 * @version 1.0
 */
namespace lbab\footer;

/**
 * Returns a formated return of the given function.
 *
 * @param string $sFunction The function name
 * @return string
 */
function getDebugStatusMarkup( string $sFunction ) : string {
    $sTemplate = '<li style="%3$s">%1$s: %2$s';
    if( !function_exists( $sFunction )) {
        $sReturn = 'FALSE';
        $sStyle = 'color:red;';
    } elseif( TRUE===$sFunction()) {
        $sReturn = 'TRUE';
        $sStyle = 'color:green;';
    } else {
        $sReturn = 'FALSE';
        $sStyle = 'color:grey;';
    }
    return sprintf( $sTemplate, $sFunction, $sReturn, $sStyle );
}

/**
 * WP_FOOTER actions.
 */
function debug() {
    echo '<div class="container responsive-padding">', PHP_EOL;
    echo '<div style="columns: 3;"><p>Hierarchy<ul>', PHP_EOL;

    echo \lbab\footer\getDebugStatusMarkup('is_archive') . '<ul>', PHP_EOL;
    $aReturn = array_map( '\lbab\footer\getDebugStatusMarkup', [ 'is_author', 'is_category', 'is_tax', 'is_date', 'is_tag', 'is_day', 'is_month', 'is_year' ]);  // , 'is_post_type_archive'
    foreach( $aReturn as $sValue ) {
        echo $sValue . '</li>', PHP_EOL;
    }
    echo '</ul></li>', PHP_EOL;
    echo \lbab\footer\getDebugStatusMarkup('is_singular') . '<ul>', PHP_EOL;
    echo \lbab\footer\getDebugStatusMarkup('is_single') . '<ul>', PHP_EOL;
    echo \lbab\footer\getDebugStatusMarkup('is_attachment') . '</li></ul></li>', PHP_EOL;
    echo \lbab\footer\getDebugStatusMarkup('is_page') . '<ul>', PHP_EOL;
    echo \lbab\footer\getDebugStatusMarkup('is_front_page') . '</li></ul></li></ul></li>', PHP_EOL;
    echo \lbab\footer\getDebugStatusMarkup('is_home') . '<ul>', PHP_EOL;
    echo \lbab\footer\getDebugStatusMarkup('is_front_page') . '</li></ul></li>', PHP_EOL;
    $aReturn = array_map( '\lbab\footer\getDebugStatusMarkup', [ 'is_search', 'is_404', 'is_paged', 'is_feed', 'is_trackback' ]);
    foreach ($aReturn as $sValue) {
        echo $sValue . '</li>', PHP_EOL;
    }
    echo '</ul></p>', PHP_EOL;
    echo '<p>Post<ul><li>format: ' . ( get_post_format() ? : 'standard' ) . '</li>', PHP_EOL;
    echo \lbab\footer\getDebugStatusMarkup('is_sticky') . '</li>', PHP_EOL;
    echo \lbab\footer\getDebugStatusMarkup('has_excerpt') . '</li></ul></p>', PHP_EOL;
    echo '<p>Customizer<ul>', PHP_EOL;
    $aReturn = array_map( '\lbab\footer\getDebugStatusMarkup', [ 'has_custom_logo', 'has_header_image', 'has_site_icon' ]);
    foreach ($aReturn as $sValue) {
        echo $sValue . '</li>', PHP_EOL;
    }
    echo '</ul></p></div></div>', PHP_EOL;
}