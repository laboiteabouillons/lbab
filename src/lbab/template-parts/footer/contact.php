<?php
declare(strict_types=1);
/**
 * The template for displaying the contact inside the footer.
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package La boite à bouillons
 * @version 1.0
 */

// The theme implements Custom Logo feature.
$aImage = FALSE;
if( has_custom_logo() ){
    $aImage = wp_get_attachment_image_src( (int) get_theme_mod( 'custom_logo' ), 'full' );
}
$aImage = is_array( $aImage ) ? array_slice( $aImage, 0, 3 ) : [];
?>
<aside class="alignedTextFooter">
<picture class="floatedImage">
<?php
if( empty( $aImage )){
    // Default logo
    echo '<source srcset="assets/img/logo/lbab.svg" type="image/svg+xml" />', PHP_EOL;
    echo '<img src="assets/img/logo/lbab-144x144.png" alt="Logo de la boite à bouillons" width="144" height="144" />', PHP_EOL;
} else {
    // Custom Logo
    echo sprintf( '<img src="%1$s" alt="Logo de la boite à bouillons" width="%2$d" height="%3$d" />', esc_url( $aImage[0] ), esc_attr( $aImage[1] ), esc_attr( $aImage[2] )), PHP_EOL;
}
?>
</picture>
<h5><strong>CONTACT</strong></h5>
<p>Anne-Sophie&nbsp;Evrard<br />
La boite à bouillons - Nantes<br />
&#9743;&nbsp;<a href="tel:0663354236">06 63 35 42 36</a><br />
&#9993;&nbsp;<a href="mailto:contact@laboiteabouillons.fr">contact@laboiteabouillons.fr</a><br />
Retrouvez-nous sur&nbsp;<a href="https://www.facebook.com/laboiteabouillons/" title="Aller sur la page facebook de La boite à bouillons" rel="external">
<picture>
<source srcset="assets/img/vendor/facebook.svg" type="image/svg+xml" />
<img class="icon" src="assets/img/vendor/facebook.png" alt="Logo de facebook" width="20" height="20" />
</picture></a></p>
</aside>
<?php
$aImage = NULL;