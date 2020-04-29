<?php
declare(strict_types=1);
/**
 * La boite à bouillons maintenance.
 *
 * @package La boite à bouillons
 * @version 1.0
 */
namespace lbab\maintenance;

/**
 * Activates maintenance mode
 * 
 * Creates .maintenance with <?php $upgrading = time(); ?> inside
 */
function activate() {
	nocache_headers();
	if(!current_user_can('edit_themes') || !is_user_logged_in()){
		$string = file_get_contents( WP_CONTENT_DIR . '/maintenance.php' );
        wp_die( $string, 'Maintenance | La Boite à bouillons', array('response' => '503'));
    }
}

