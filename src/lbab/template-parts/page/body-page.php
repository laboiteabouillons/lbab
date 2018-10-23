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
<label class="button primary large" for="modal-check">Click to display a modal dialog</label>
<input id="modal-check" type="checkbox">
<div class="modal" style="text-align:initial">
<div class="card">
<label for="modal-check" class="close"></label>
<h3 class="section double-padded">Modal</h3>
<div class="section double-padded">
<iframe width="540" height="783" src="https://my.sendinblue.com/users/subscribe/js_id/2w6oq/id/1" frameborder="0" scrolling="auto" allowfullscreen style="display: block;margin-left: auto;margin-right: auto;"></iframe>
<label class="button primary" for="modal-check">Close modal</label>
</div>
</div>
</div>
</article>
</div>
</div>
</div>
</main>