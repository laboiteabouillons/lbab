<?php
declare(strict_types=1);
/**
 * Template part for displaying a single post excerpt.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package La boite à bouillons
 * @version 1.0
 */
?>
<article>
<?php
    the_title( '<h2>', '</h2>' );
    the_excerpt();
?>
</article>