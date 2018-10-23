<?php
declare(strict_types=1);
/**
 * The template file used to render:
 *  - a single post
 *    Functions is_singular and is_single return TRUE.
 *  - a single page
 *    Functions is_singular and is_page return TRUE.
 *  - an attachment page
 *    Functions is_attachment, is_singular and is_single return TRUE.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/post-template-files/#singular-php
 *
 * @package La boite à bouillons
 * @version 1.0
 */
if( is_attachment() ) {
    get_template_part( 'attachment' );
} elseif( is_page() ) {
    get_template_part( 'page' );
} elseif( is_single() ) {
    get_template_part( 'single' );
} else {
    get_template_part( '404' );
}