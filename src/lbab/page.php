<?php
declare(strict_types=1);
/**
 * The template file used to render:
 *  - a static page (page post-type).
 *    Function is_page returns TRUE.
 *  - a static front page when “front page” is set in the front page displays
 *    section and front-page.php does not exists.
 *    Functions is_front_page and is_page return TRUE.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package La boite à bouillons
 * @version 1.0
 */
while ( have_posts() ) {
    the_post();
    if( is_front_page() ) {
        get_template_part( 'template-parts/page/body', 'frontpage' );
    }
    else {
        get_template_part( 'template-parts/page/body', 'page' );
    }
    break;
}
get_footer();