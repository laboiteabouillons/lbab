<?php
declare(strict_types=1);
/**
 * The template for displaying 404 pages (not found)
 * Function is_404 return TRUE.
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * @link https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/#404-php
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
<article>
<h1>Page non trouv&#233;e</h1>
<p><strong>D&#233;sol&#233; !</strong><br />
Nous ne pouvons pas trouver la page que vous recherchez.
Elle a pu &#234;tre supprim&#233;e, son nom modifi&#233;, ou &#234;tre temporairement inaccessible.<br />
Merci de v&#233;rifier que l'adresse du site Web est correctement orthographi&#233;e.
Ou rendez-vous sur notre <a rel="prev" href="https://www.laboiteabouillons.fr/" title="Retour &agrave; l'accueil"><strong>page d'accueil</strong></a>, et utilisez les menus pour naviguer vers une section sp&#233;cifique.</p>
</article>
</div>
</div>
</div>
</main>
<?php
get_footer();