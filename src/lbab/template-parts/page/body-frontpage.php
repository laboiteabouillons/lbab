<?php
declare(strict_types=1);
/**
 * The template file used to render:
 *  - a static front page when “front page” is set in the front page displays
 *    section and front-page.php does not exists.
 *    Functions is_front_page, is_page return TRUE.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#front-page-display
 *
 * @package La boite à bouillons
 * @version 1.0
 */

// <head>
get_header();

// Featured image as top image
get_template_part( 'template-parts/header/featured', 'image' );

// <header>
get_template_part( 'template-parts/header/main', 'menu' );
?>
<main>
<?php
the_title( '<h1 id="top-heading">', '</h1>' );
the_content();
?>
</main>
