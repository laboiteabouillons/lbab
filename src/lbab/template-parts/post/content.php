<?php
declare(strict_types=1);
/**
 * Template part for displaying a single post.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package La boite à bouillons
 * @version 1.0
 */

// Get the ID
$iItemID = get_the_ID();

// Get the title
$sTitle = single_post_title( '', FALSE );

// Get the post thumbnail
if( has_post_thumbnail( $iItemID ) ) {
    // Retrieve the post thumbnail URL, caption and alt text for the featured image.
    $sFigureTag = sprintf( '<figure><img src="%1$s" alt="%2$s"><figcaption>%3$s</figcaption></figure>'
        , esc_attr( esc_url( get_the_post_thumbnail_url( $iItemID )))
        , esc_attr( trim( get_post_meta( get_post_thumbnail_id($iItemID),  '_wp_attachment_image_alt', true )))
        , esc_html( trim( get_the_post_thumbnail_caption($iItemID) ) ) );
}
else{
    // No featured image
    $sFigureTag = '';
}
?>
<article>
<h1><?php echo esc_html( $sTitle ); ?></h1>
<?php
    // Display the details
    echo \lbab\post\getDetailsMarkup( $iItemID ), PHP_EOL;

    // Display the post thumbnail
    echo $sFigureTag, PHP_EOL;

    // Display the content
    the_content();
?>
</article>