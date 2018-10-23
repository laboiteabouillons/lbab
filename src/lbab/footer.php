<?php
declare(strict_types=1);
/**
 * The template for displaying the footer.
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @link https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/#footer-php
 *
 * @package La boite à bouillons
 * @version 1.0
 */
?>
<footer>
<div class="container responsive-padding">
<div class="row">
<div class="col-sm-12 col-md-7 col-lg-4">
<?php get_template_part( 'template-parts/footer/contact' ); ?>
</div>
<div class="col-sm-12 col-md-5 col-lg-8">
<hr class="hidden-md hidden-lg"/>
<?php get_template_part( 'template-parts/footer/post', 'excerpt' ); ?>
</div>
</div>
<hr />
<div class="row">
<div class="col-sm">
<?php get_template_part( 'template-parts/footer/copyright' ); ?>
</div>
</div>
</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>