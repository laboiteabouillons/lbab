<?php
declare(strict_types=1);
/**
 * Secondary tag template.
 *
 * @link https://codex.wordpress.org/Tag_Templates
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

// The title
echo '<h1>' . esc_html( ucfirst( single_tag_title( '', false ))) . '</h1>', PHP_EOL;

// The description: only on the first page
if( !is_paged() ){
    echo '<h2>Description</h2>', PHP_EOL;
    $sDescription = tag_description();
    echo empty($sDescription) ? '<p>Il n&#39;y aucune description pour ce sujet.</p>' : $sDescription , PHP_EOL;
}

if( have_posts() ) {

    echo '<h2>Aperçu rapide</h2>', PHP_EOL;
    echo '<p>Voici la liste des articles qui abordent ce sujet particulier:</p>', PHP_EOL;

    while( have_posts() ){
        the_post();
        echo '<article>', PHP_EOL;
        the_title( '<h3>', '</h3>' );
        the_excerpt();
        echo '</article>', PHP_EOL;
    }

    // Pagination
    get_template_part( 'template-parts/navigation/pagination' );
}
?>
</div>
</div>
</div>
</main>
<?php
get_footer();