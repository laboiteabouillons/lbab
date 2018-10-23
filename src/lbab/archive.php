<?php
declare(strict_types=1);
/**
 * Template for the archives page.
 * Function is_archive returns TRUE.
 * The file is used to render:
 *  - the author page. Function is_author returns true
 *  - the category page. Function is_category returns true
 *  - the tag page. Function is_tag returns true
 *
 * @link https://codex.wordpress.org/Creating_an_Archive_Index#The_Archives_Page
 *
 * @package La boite à bouillons
 * @version 1.0
 */

if( is_author() ){
    get_template_part( 'template-parts/archive/author' );
} elseif( is_category() ){
    get_template_part( 'template-parts/archive/category' );
} elseif( is_tag() ){
    get_template_part( 'template-parts/archive/tag' );
} else {
    get_template_part( 'template-parts/archive/other' );
}

get_footer();