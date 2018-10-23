<?php
declare(strict_types=1);
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/post-template-files/#index-php
 *
 * @package La boite à bouillons
 * @version 1.0
 */
if( is_page() ) {
    get_template_part( 'page' );
} elseif( is_home() ) {
    get_template_part( 'home' );
} elseif( is_single() ) {
    get_template_part( 'single' );
} else {
    get_template_part( '404' );
}