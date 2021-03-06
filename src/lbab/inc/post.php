<?php
declare(strict_types=1);
/**
 * Post functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package La boite à bouillons
 * @version 1.0
 */
namespace lbab\post;

/**
 * Builds HTML5 author meta information for the current post/page.
 *
 * @return string
 */
function getDetailsMarkupAuthor() : string {
    return sprintf( '<a href="%1$s" rel="author" title="Plus d&#39;informations sur l&#39;auteur">%2$s</a>'
        , esc_url( get_author_posts_url( get_the_author_meta( 'ID' )))
        , esc_html( get_the_author() ));
}

/**
 * Builds HTML5 permalink meta information for a post or page.
 *
 * @param integer $iTheID The post/page id
 * @return string
 */
function getDetailsMarkupPermalink( int $iTheID ) : string {
    return sprintf( '<a href="%1$s" rel="bookmark" title="Accéder à l&#39;article %2$s">&#9875;</a>'
        , esc_url( get_permalink( $iTheID ))
        , esc_attr( get_the_title( $iTheID )));
}

/**
 * Builds HTML5 title and permalink meta information for an post or page.
 *
 * @param integer $iTheID The post/page id
 * @return string
 */
function getDetailsMarkupTitleAndPermalink( int $iTheID ) : string {
    $sTitle = get_the_title( $iTheID );
    return sprintf( '<a href="%1$s" rel="bookmark" title="Accéder à l&#39;article %3$s">%2$s</a>'
        , esc_url( get_permalink( $iTheID ))
        , esc_html( $sTitle )
        , esc_attr( $sTitle ));
}

/**
 * Builds HTML5 date meta information for a post/page.
 *
 * @param integer $iTheID The post/page id
 * @param string $sDateFormat PHP date format
 * @return string
 */
function getDetailsMarkupDate( int $iTheID, string $sDateFormat = 'F Y' ) : string {
    if ( get_the_time( 'Ym', $iTheID ) !== get_the_modified_time( 'Ym', $iTheID ) ) {
        $sTime = ', publié en <time datetime="%1$s" pubdate="pubdate">%2$s</time> puis mis à jour en <time datetime="%3$s">%4$s</time>';
    }
    else {
        $sTime = ' et publié en <time datetime="%1$s" pubdate="pubdate">%2$s</time>';
    }
    return sprintf( $sTime
        , esc_attr( get_the_date( 'c', $iTheID ) )
        , esc_html( get_the_date($sDateFormat, $iTheID) )
        , esc_attr( get_the_modified_date( 'c', $iTheID ) )
        , esc_html( get_the_modified_date($sDateFormat, $iTheID)));
}

/**
 * Builds HTML5 category and tag meta informations for a post.
 *
 * @param integer $iTheID The post id
 * @return string
 */
function getDetailsMarkupCategoryAndTag( int $iTheID ) : string {
    // Initialize
    $sReturn = '';

    // Hide category and tag text for pages.
    if ( 'post' === get_post_type ($iTheID )) {

        // get the category
        $sCategories = get_the_category_list( ', ', '', $iTheID );
        if( stripos($sCategories, 'non class')!==FALSE ) {
            $sCategories = '';
        }


        // Get the tags
        $sTags = get_the_tag_list( '', ', ', '', $iTheID );
        $sTags = is_wp_error ($sTags ) ? false : $sTags;

        // Build category
        if( !empty( $sCategories )) {
            $sReturn = 'Il aborde le thème de ' . $sCategories;
            if( empty( $sTags )) {
                $sReturn .= '.';
            }
        }

        // Build tags
        if( !empty( $sTags )) {
            if( empty( $sCategories )) {
                $sReturn = 'Il porte spécifiquement sur ';
            }
            else {
                $sReturn .= ' et porte plus précisement sur ';
            }
            $sReturn .= $sTags . '.';
        }
    }
    return $sReturn;
}

/**
 * Builds HTML5 details tag with meta information for the current post date/time and author.
 *
 * @param integer $iTheId The post id
 * @return string
 */
function getDetailsMarkup( int $iTheId ) : string {
    $sDetails = sprintf( '<p>%4$s Cet article est écrit par %1$s%2$s. %3$s</p>'
    , \lbab\post\getDetailsMarkupAuthor()
    , \lbab\post\getDetailsMarkupDate( $iTheId )
    , \lbab\post\getDetailsMarkupCategoryAndTag( $iTheId )
    , \lbab\post\getDetailsMarkupPermalink( $iTheId ));
    return '<details><summary>Détails...</summary>' . $sDetails . '</details>';
}

/**
 * Builds HTML5 details tag with meta information for the current attachment date/time and author.
 *
 * @param integer $iTheId The post id
 * @param array $aSizes The differents sizes of srcset to build
 * @return string
 */
function getAttachmentDetailsMarkup( int $iTheId ) : string {
    $sDetails = sprintf( '<p>Ce media est publié dans l&#39;article %1$s.</p>'
    , \lbab\post\getDetailsMarkupTitleAndPermalink( $iTheId ));
    return '<details><summary>Détails...</summary>' . $sDetails . '</details>';
}

/**
 * Returns the most recent post excerpt. Used in the footer.
 * Do not show post format link.
 *
 * @link https://codex.wordpress.org/Function_Reference/wp_get_recent_posts
 *
 * @param array $aDefaults Array of arguments to retrieve the most recent post. Use the default.
 * @return array [ 'post_title'=>'...', 'post_name'=>'...', 'post_excerpt'=>'...' ]
 */
function getMostRecentPostExcerpt( array $aDefaults = ['post_status'=>'publish','has_password'=>false,'numberposts'=>1,'orderby'=>'post_date','order'=>'DESC','tax_query'=>[['taxonomy'=>'post_format','field'=>'slug','terms'=>'post-format-link','operator'=>'NOT IN']]]) {

    // Initialize
    $aReturn = FALSE;

    // Retrieve the most recent posts.
    $aPosts = wp_get_recent_posts( $aDefaults, ARRAY_A );

    // Filter the data
    if( !empty( $aPosts ) && is_array( $aPosts[0] )){
        $aReturn = array_intersect_key( $aPosts[0], [ 'post_title'=>'post_title', 'post_name'=>'post_name', 'post_excerpt'=>'post_excerpt' ] );
        $aReturn['post_title'] = isset( $aReturn['post_title'] ) ? apply_filters( 'the_title', $aReturn['post_title']) : '';
        $aReturn['post_excerpt'] = isset( $aReturn['post_excerpt'] ) ? apply_filters( 'the_excerpt', $aReturn['post_excerpt']) : '';
        $aReturn['post_name'] = isset( $aReturn['post_name'] ) ? $aReturn['post_name'] : '';
    } else {
        $aReturn = [ 'post_title'=>'', 'post_name'=>'', 'post_excerpt'=>'' ];
    }

    wp_reset_query();
    return $aReturn;
}

/**
 * Filters the post_navigation template.
 * Rename classes.
 *
 * @param string $sTemplate The default template.
 * @param array $aSearch The values being searched for. Use the default.
 * @param array $aReplace The replacement value that replaces found search values. Use the default.
 * @return string
 */
function filterPaginationTemplate( string $sTemplate,
                            array $aSearch = [ '\'', 'prev page-numbers', 'next page-numbers', 'page-numbers current', 'page-numbers dots', 'page-numbers' ],
                            array $aReplace = [ '"', 'page-prev', 'page-next', 'page-current', 'page-dots', 'page-number' ] ) : string {
    return str_replace( $aSearch, $aReplace, $sTemplate ) . PHP_EOL;
}

/**
 * Filters the 'Continue reading' link for a automatically generated excerpt.
 * Replaces "[...]" with ... and add the 'Continue reading' link.
 *
 * @param string $sLink Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function filterMoreLinkForAutomaticallyGeneratedExcerpt( string $sLink ) : string {
    if( is_admin() ) {
        return $sLink;
    }

    $sLink = sprintf( '<br /><a href="%1$s">%2$s</a>',
        esc_url( get_permalink( get_the_ID() ) ),
        '&#187; Lire la suite de cet article' );
    return ' &hellip; ' . $sLink;
}

/**
 * Filters the 'Continue reading' link for a manual excerpt.
 *
 * @param string $sLink Link to single post/page.
 * @return string 'Continue reading' link.
 */
function filterMoreLinkForManualExcerpt( string $sLink ) : string {
    if( has_excerpt() && !is_attachment() ) {

        // Post format
        $sPostFormat = get_post_format();
        if ( $sPostFormat && !is_wp_error($sPostFormat) ) {
            $sPostFormat = sanitize_html_class( $sPostFormat );
        } else {
            $sPostFormat = 'standard';
        }

        if( strcasecmp( $sPostFormat, 'link') == 0) {
            $sBuffer = '&#187; Découvrir cette pépite';
        } else {
            $sBuffer = '&#187; Découvrir cet article';
        }

        $sLink .= sprintf( '<br /><a href="%1$s">%2$s</a>',
        esc_url( get_permalink( get_the_ID() ) ),
        $sBuffer );
      }
      return $sLink;
}

/**
 * Create shortcode for the newsletter subscription
 * Use the shortcode: [lbab_newsletter url="https://my.sendinblue.com/users/subscribe/js_id/2w6oq/id/2"]
 *
 * @param array $aUserDefinedAttributes (Required) User defined attributes in shortcode tag.
 * @return string html code for newsletter
 */
function lbab_shortcode_newsletter( $aUserDefinedAttributes ) {

    // Declare Entire list of supported attributes and their defaults.
    $aPairs = [ 'url' => 'https://my.sendinblue.com/users/subscribe/js_id/2w6oq/id/2' ];

    // Normalize attribute keys, lowercase
    $aNormalizedUserDefinedAttributes = array_change_key_case( (array)$aUserDefinedAttributes, CASE_LOWER );

    // Combine and filter the user defined attribute list.
    $aFilteredAttributes = shortcode_atts( $aPairs, $aNormalizedUserDefinedAttributes );

    // Return the html code
    return '<div class="iframe-container"><iframe src="' . esc_url( $aFilteredAttributes['url'] ). '" allowfullscreen></iframe></div>';
}

/**
 * Returns the most recent link post content. Used for the pepites.
 *
 * @link https://codex.wordpress.org/Function_Reference/wp_get_recent_posts
 *
 * @param array $aDefaults Array of arguments to retrieve the most recent post link. Use the default.
 * @return array [ 0 => [ 'post_content'=>'...' ], ... ]
 */
function getMostRecentPostLinkContent( array $aDefaults = [ 'post_status'=>'publish', 'has_password'=>false, 'numberposts'=>21, 'orderby'=>'post_date', 'order'=>'DESC', 'tax_query' => [[ 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => 'post-format-link' ]]]) {

    // Initialize
    $aReduced = FALSE;

    // Retrieve the most recent posts.
    $aPosts = wp_get_recent_posts( $aDefaults, ARRAY_A );

    // Keep onlyt the 'post_content' values
    if( !empty($aPosts) && is_array( $aPosts[0] ) ) {
        $aReduced = array_map( function($aPost){return array_intersect_key( $aPost, [ 'post_content'=>'post_content' ] );}, $aPosts );
    }

    wp_reset_query();
    return $aReduced;
}

/**
 * Create shortcode for the pepites
 * Use the shortcode: [lbab_pepites]
 *
 * @param array $aUserDefinedAttributes (Required) User defined attributes in shortcode tag.
 * @return string html code for the pepites
 */
function lbab_shortcode_pepites( $aUserDefinedAttributes ) {
    // Initialize
    $sBuffer = '';
    $iIndex=0;
    // Get link format posts
    $aPosts = \lbab\post\getMostRecentPostLinkContent();
    // Filter the posts
    if( !empty($aPosts) && is_array( $aPosts[0] ) ) {
        $aFiltered = array_map( function($aPost){return isset( $aPost['post_content'] ) ? apply_filters( 'the_content', $aPost['post_content']) : '';}, $aPosts );
    }
    // Build lines
    foreach ( $aFiltered as $sContent ) {
        if( 0===$iIndex++ ) {
            $sBuffer .= '<div class="row">' . PHP_EOL;
        }
        $sBuffer .= '<div class="col-sm-12 col-md-4 col-lg-4">' . PHP_EOL
                 . $sContent . PHP_EOL
                 . '</div>' . PHP_EOL;
        if( $iIndex>=3 ) {
            $sBuffer .= '</div>' . PHP_EOL;
            $iIndex=0;
        }
    }
    // Return the html code
    return $sBuffer;
}

/**
 * Filters the post_navigation template.
 * Rename classes.
 *
 * @param object $query The query object
 * @return void
 */
function filterPostQueryForHome( $query ) {
    if ( !is_admin() && $query->is_home() && $query->is_main_query() ) {
        $args = [ [
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => 'post-format-link',
            'operator' => 'NOT IN'
        ]];
        $query->set( 'tax_query', $args );
    }
}
