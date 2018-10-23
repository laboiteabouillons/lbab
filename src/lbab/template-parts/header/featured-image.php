<?php
declare(strict_types=1);
/**
 * Displays the featured image.
 *
 * @package La boite à bouillons
 * @version 1.0
 */

// Retrieve the current item ID
$iItemID = is_home() ? get_option( 'page_for_posts' ) : get_the_ID();

if( has_post_thumbnail( $iItemID )) {
    // Retrieve the post thumbnail URL, caption and alt text for the featured image.
    $sImageTag = \lbab\media\buildImageTagWithSizedSrcset( trim( get_the_post_thumbnail_url( $iItemID )), trim( get_post_meta( get_post_thumbnail_id($iItemID),  '_wp_attachment_image_alt', true )));
    $sImageCaption = trim( esc_html( get_the_post_thumbnail_caption($iItemID) ) );
} else {
    // No featured image
    $sImageTag = $sImageCaption = '';
}
?>
<div id="top-image">
<?php echo $sImageTag;?>
</div>
<div class="container responsive-padding">
<p id="anchor"><q><?php echo $sImageCaption;?></q></p>
</div>
<?php
$iItemID = $sImageTag = $sImageCaption = '';