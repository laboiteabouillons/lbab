<?php
declare(strict_types=1);
/**
 * Displays the main menu as header.
 *
 * @package La boite à bouillons
 * @version 1.0
 */

// Build the navigation menu from the pages.
$aNavs = ['header_tag' => '', 'nav_tag' => '' ];
$aPages = \lbab\page\getPagesForMenu();
if( is_array( $aPages )) {
    $aNavs = lbab\header\buildNavigationForHeaderMenu( $aPages );
    $aPages = NULL;
}

// The theme implements Custom Header feature.
$aImage = [];
$sUrl = get_header_image();
if( !empty( $sUrl )) {
    // Has header image
    $pCustomheader = get_custom_header();
    $aImage[] = $sUrl;
    $aImage[] = $pCustomheader->width;
    $aImage[] = $pCustomheader->height;
    $pCustomheader = NULL;
}
$sUrl = NULL;
?>
<header class="sticky">
<a href="<?php echo esc_attr( esc_url( home_url( '/' ))); ?>" rel="home" class="logo">
<picture>
<?php
if( empty( $aImage )){
    // Default header
    echo '<source srcset="assets/img/logo/lbab-nobkg.svg" type="image/svg+xml" />', PHP_EOL;
    echo '<img src="assets/img/logo/lbab-45x45.png" alt="Logo de la boite à bouillons" width="45" height="45" />', PHP_EOL;
} else {
    // Custom Header
    echo sprintf( '<img src="%1$s" alt="Logo de la boite à bouillons" width="%2$d" height="%3$d" />', esc_url( $aImage[0] ), esc_attr( $aImage[1] ), esc_attr( $aImage[2] )), PHP_EOL;
}
?>
</picture>
</a>
<label class="drawer-toggle button" for="navigation-toggle"></label>
<?php echo $aNavs['header_tag'],PHP_EOL; ?>
</header>
<input type="checkbox" id="navigation-toggle" />
<nav class="drawer hidden-md hidden-lg">
<label class="close" for="navigation-toggle"></label>
<?php echo $aNavs['nav_tag'],PHP_EOL; ?>
</nav>
<?php
$aImage = $aNavs = NULL;