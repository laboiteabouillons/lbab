<?php
declare(strict_types=1);
/**
 * The template file used to render:
 *  - a static page (page post-type).
 *    Functions is_page return TRUE.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
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
<span id="top-arrows" class="bounce"><a href="<?php echo esc_attr( esc_url( get_page_link())); ?>#anchor">&#8693;&emsp;</a></span>
<main>
<div class="container responsive-padding">
<div class="row">
<div class="col-sm-12 col-lg-10 col-lg-offset-1">
<article>
<h1><?php single_post_title(); ?></h1>
<?php the_content(); ?>
</article>
</div>
</div>
</div>
</main>
