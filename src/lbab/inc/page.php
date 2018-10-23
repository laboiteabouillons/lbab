<?php
declare(strict_types=1);
/**
 * Page functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package La boite à bouillons
 * @version 1.0
 */
namespace lbab\page;

/**
 * Returns the filtered page data used to build menu.
 *
 * @param WP_POST $thePage The page
 * @param array $aFilter The filter. Use the default.
 * @return array
 */
function filterPageDataForMenu( \WP_POST $thePage, array $aFilter = [ 'post_title' => 'post_title', 'post_name' => 'post_name' ]) : array {
    return array_intersect_key( $thePage->to_array(), $aFilter );
}

/**
 * Returns the page list used to build the menu.
 *
 * @param array $aDefaults Array of arguments to retrieve pages
 * @return array|FALSE
 */
function getPagesForMenu( array $aDefaults = [ 'sort_column' => 'menu_order', 'parent' => 0 ] ) {

    // Initialize
    $aReturn = FALSE;

    // Retrieve the list of pages. An array of WP_POST object.
    $aPages = get_pages( $aDefaults );

    // Filter the data
    if( !empty($aPages) ) {
        $aReturn = array_map( '\lbab\page\filterPageDataForMenu', $aPages );
    }

    return $aReturn;
}