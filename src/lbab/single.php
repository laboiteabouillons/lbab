<?php
declare(strict_types=1);
/**
 * The template file used to render a single post.
 * Functions is_single and is_singular return TRUE.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @link https://developer.wordpress.org/themes/template-files-section/post-template-files/
 *
 * @package La boite à bouillons
 * @version 1.0
 */
// <head>
get_header();

// <header>
get_template_part( 'template-parts/header/main', 'menu' );
?>
<main>
<div class="container responsive-padding">
<div class="row">
<div class="col-sm-12 col-lg-10 col-lg-offset-1">
<?php
    while( have_posts() ) {
        the_post();
        if( is_attachment() ) {
            get_template_part( 'template-parts/post/content', 'attachment' );
        } else {
            get_template_part( 'template-parts/post/content', get_post_format() );
            the_post_navigation();
        }
    }
?>
</div>
</div>
</div>
</main>
<?php
get_footer();
