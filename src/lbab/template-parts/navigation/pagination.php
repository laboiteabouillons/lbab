<?php
declare(strict_types=1);
/**
 * Pagination.
 *
 * @package La boite à bouillons
 * @version 1.0
 */
echo \lbab\post\filterPaginationTemplate( get_the_posts_pagination( [
    'mid_size' => 1,
    'prev_text' => '<span class="tooltip" aria-label="' . __( 'Les plus récents articles', 'lbab' ) . '"><span class="text-first"></span></span>',
    'next_text' => '<span class="tooltip" aria-label="' . __( 'Les plus anciens articles', 'lbab' ) . '"><span class="text-last"></span></span>']));