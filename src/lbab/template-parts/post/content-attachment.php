<?php
declare(strict_types=1);
/**
 * Template part for displaying an attachment.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#attachment
 *
 * @package La boite à bouillons
 * @version 1.0
 */

?>
<article>
<h1><?php echo esc_html( single_post_title( '', FALSE ) ); ?></h1>
<?php
    // Get attachment info
    $pAttachment = get_queried_object();

    // Display the details
    echo \lbab\post\getAttachmentDetailsMarkup( $pAttachment->post_parent ), PHP_EOL;

    // Display the content
    the_content();

    // Clean
    $pAttachment = NULL;
?>
</article>