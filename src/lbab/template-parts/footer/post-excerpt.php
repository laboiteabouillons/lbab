<?php
declare(strict_types=1);
/**
 * Template part for displaying post excerpt on footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/
 *
 * @package La boite à bouillons
 * @version 1.0
 */

// get the most recent post excerpt
$aTheMostRecentPost = \lbab\post\getMostRecentPostExcerpt();
?>
<aside>
<h5><?php echo esc_html( $aTheMostRecentPost['post_title'] ), PHP_EOL; ?></h5>
<p><?php echo esc_html( $aTheMostRecentPost['post_excerpt'] ), PHP_EOL; ?></p>
<p><?php echo sprintf( '<a class="button" href="%1$s" rel="bookmark">Lire mon article</a>', esc_attr( esc_url( home_url( '/' ) . $aTheMostRecentPost['post_name'] ))), PHP_EOL; ?></p>
</aside>
<?php
$aTheMostRecentPost = NULL;