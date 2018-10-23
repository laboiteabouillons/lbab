<?php
/**
 * La boite à bouillons theme compatibility.
 *
 * Prevents La boite à bouillons theme from running on WordPress versions prior to 4.9.8,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.9.8.
 *
 * @package lbab
 */

declare(strict_types=1);

namespace lbab\compatibility;

/**
 * Prevent switching to La boite à bouillons theme on old versions of WordPress.
 * Switches to the default theme.
 */
function switch_Theme() {
    switch_theme( WP_DEFAULT_THEME );
    unset( $_GET['activated'] );
    add_action( 'admin_notices', '\lbab\compatibility\upgrade_Notice' );
}
add_action( 'after_switch_theme', '\lbab\compatibility\switch_Theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * La boite à bouillons theme on WordPress versions prior to 4.9.8.
 *
 * @global string $wp_version WordPress version.
 */
function upgrade_Notice() {
    $message = sprintf( __( 'La boîte à bouillons theme requires at least WordPress version 4.9.8. You are running version %s. Please upgrade and try again.', 'lbab' ), $GLOBALS['wp_version'] );
    printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.9.8.
 *
 * @global string $wp_version WordPress version.
 */
function customize() {
    wp_die(
        sprintf( __( 'La boite à bouillons theme requires at least WordPress version 4.9.8. You are running version %s. Please upgrade and try again.', 'lbab' ), $GLOBALS['wp_version'] ),
        '',
        array(
            'back_link' => true,
        )
    );
}
add_action( 'load-customize.php', '\lbab\compatibility\customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.9.8.
 *
 * @global string $wp_version WordPress version.
 */
function preview() {
    if ( isset( $_GET['preview'] ) ) {
        wp_die( sprintf( __( 'La boite à bouillons theme requires at least WordPress version 4.9.8. You are running version %s. Please upgrade and try again.', 'lbab' ), $GLOBALS['wp_version'] ) );
    }
}
add_action( 'template_redirect', '\lbab\compatibility\preview' );
