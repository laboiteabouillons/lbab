<?php
declare(strict_types=1);
/**
 * Head functions and definitions.
 *
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/wp_head
 *
 * @package La boite à bouillons
 * @version 1.0
 */
namespace lbab\head;

/**
 * Returns the meta description for the home page.
 *
 * @param string $sKey The name of the custom field. Use the default.
 * @return string
 */
function getMetaDescriptionForHomePage( string $sKey = 'meta-description' ) : string {
    $sValue = get_post_meta( get_option( 'page_for_posts' ), $sKey, true );
    return empty( $sValue ) ? 'Cette page montre un résumé de mes derniers articles.' : esc_attr( $sValue );
}

/**
 * Returns the meta description for the 404 page.
 *
 * @return string
 */
function getMetaDescriptionFor404Page() : string {
    global $wp;
    return 'La page &#39;' . esc_attr( $wp->request ) . '&#39; n&#39;existe pas.';
}

/**
 * Returns the meta description for a page.
 *
 * @param integer $iTheId The post id.
 * @param string $sKey The name of the custom field. Use the default.
 * @return string
 */
function getMetaDescriptionForAPage( int $iTheId, string $sKey = 'meta-description' ) : string {
    $sValue = get_post_meta( $iTheId, $sKey, true );
    return empty( $sValue ) ? 'Cette page porte sur ' . esc_attr( get_the_title( $iTheId )) : esc_attr( $sValue );
}

/**
 * Returns the meta description for a post.
 *
 * @param integer $iTheId The post id.
 * @param string $sKey The name of the custom field. Use the default.
 * @return string
 */
function getMetaDescriptionForAPost( int $iTheId, string $sKey = 'meta-description' ) : string {
    $sValue = get_post_meta( $iTheId, $sKey, true );
    if( empty( $sValue )) {
        // build a default description from the tags and category.
        $sValue = sprintf( 'Cet article &#39;%4$s&#39; est écrit par %1$s et publié en %2$s. %3$s'
        , 'Anne-Sophie Evrard'
        , get_the_date( 'F Y', $iTheId )
        , strip_tags( \lbab\post\getDetailsMarkupCategoryAndTag( $iTheId ))
        , get_the_title( $iTheId ));
    }
    return esc_attr( $sValue );
}

/**
 * Retrieve the meta description from the post custom field.
 *
 * @param string $sKey The name of the custom field. Use the default.
 * @return string
 */
function getMetaDescription( string $sKey = 'meta-description' ) : string {
    if( is_home() ){
        $sValue = \lbab\head\getMetaDescriptionForHomePage( $sKey );
    } elseif( is_404() ){
        $sValue = \lbab\head\getMetaDescriptionFor404Page();
    } elseif( is_single() ){
        $sValue = \lbab\head\getMetaDescriptionForAPost( get_the_ID(), $sKey);
    } else {
        $sValue = \lbab\head\getMetaDescriptionForAPage( get_the_ID(), $sKey);
    }
    return $sValue;
}

/**
 * Returns the meta robots directive.
 *
 * @return string
 */
function getMetaRobots() : string {
    return is_404() ? 'NOINDEX,NOFOLLOW' : 'INDEX,FOLLOW';
}

/**
 * Customize the wp_head action hook.
 */
function getCustomHead() {
    // Mandatory metas
    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge" />', PHP_EOL;
    echo '<meta name="viewport" content="width=device-width, initial-scale=1" />', PHP_EOL;
    echo '<base href="' . esc_url( get_bloginfo( 'template_url', 'display' )) . '/" />', PHP_EOL;
    echo '<meta name="apple-mobile-web-app-capable" content="yes" />', PHP_EOL;
    echo '<meta name="author" content="Anne-Sophie Evrard" />', PHP_EOL;
    echo '<meta name="description" content="' . \lbab\head\getMetaDescription() . '" />', PHP_EOL;
    echo '<meta name="robots" content="' . \lbab\head\getMetaRobots() . '" />', PHP_EOL;
    // Site icon
    if( !has_site_icon() ){
        // Default site icon
        echo '<meta name="msapplication-TileColor" content="#ffffff" />', PHP_EOL;
        echo '<meta name="msapplication-TileImage" content="assets/img/logo/lbab-144x144.png" />', PHP_EOL;
        echo '<meta name="theme-color" content="#59bcab" />', PHP_EOL;
        echo '<link rel="icon" type="image/png" href="assets/img/logo/lbab-16x16.png" sizes="16x16" />', PHP_EOL;
        echo '<link rel="icon" type="image/png" href="assets/img/logo/lbab-32x32.png" sizes="32x32" />', PHP_EOL;
        echo '<link rel="icon" type="image/png" href="assets/img/logo/lbab-96x96.png" sizes="96x96" />', PHP_EOL;
        echo '<link rel="icon" type="image/png" href="assets/img/logo/lbab-192x192.png" sizes="192x192" />', PHP_EOL;
        echo '<link rel="apple-touch-icon" type="image/png" href="apple-touch-icon-120x120.png" />', PHP_EOL;
        echo '<link rel="apple-touch-icon" type="image/png" href="apple-touch-icon-152x152.png" sizes="152x152" />', PHP_EOL;
        echo '<link rel="apple-touch-icon" type="image/png" href="apple-touch-icon-167x167.png" sizes="167x167" />', PHP_EOL;
        echo '<link rel="apple-touch-icon" type="image/png" href="apple-touch-icon.png" sizes="180x180" />', PHP_EOL;
        echo '<link rel="mask-icon" type="image/svg+xml" href="assets/img/logo/safari-pinned-tab" sizes="any" color="#59bcab" />', PHP_EOL;
    }
    // More links
    echo '<link rel="manifest" href="manifest.json" />', PHP_EOL;
    echo '<link rel="author" type="text/plain" href="humans.txt" />', PHP_EOL;
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com" />', PHP_EOL;
}