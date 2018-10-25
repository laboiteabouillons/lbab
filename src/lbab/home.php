<?php
declare(strict_types=1);
/**
 * The template file used to render the latest blog posts (blog posts index),
 * whether it is being used as the front page or on separate static page.
 * If front-page.php exists, it will override the home.php template.
 * Functions "is_home" (and "is_front_page" if front page case) return TRUE.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
<span id="top-arrows" class="bounce"><a href="<?php echo esc_attr( esc_url( get_page_link( get_option( 'page_for_posts' ) ))); ?>#anchor">&#8693;&emsp;</a></span>
<main>
<div class="container responsive-padding">
<div class="row">
<div class="col-sm-12 col-lg-10 col-lg-offset-1">
<h1>Le blog</h1>
<?php
if ( have_posts() ) {

    while ( have_posts() ) {
        the_post();
        // only display the not link post
        if( strcasecmp( get_post_format(),'link' )!==0 ) {
            /*
            * Include the Post-Format-specific template for the content.
            * If you want to override this in a child theme, then include a file
            * called content-___.php (where ___ is the Post Format name) and that will be used instead.
            */
            get_template_part( 'template-parts/post/content', 'posts' );
        }
    }

    // Pagination
    get_template_part( 'template-parts/navigation/pagination' );
}
else {
    get_template_part( 'template-parts/post/content', 'none' );
}
?>
</div>
</div>
</div>
</main>
<?php
get_footer();
