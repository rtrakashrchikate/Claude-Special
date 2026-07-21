<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_head', 'akc_inject_opengraph', 2 );
function akc_inject_opengraph() {
    if ( akc_seo_get('enable_og') !== '1' ) return;

    // Don't output if another SEO plugin (Yoast/RankMath) is active — they handle OG
    if ( defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION') ) return;

    $title = is_front_page()
        ? get_bloginfo('name') . ' | ' . get_bloginfo('description')
        : get_the_title() . ' | ' . get_bloginfo('name');

    $desc = is_singular() && has_excerpt()
        ? wp_trim_words( get_the_excerpt(), 30, '' )
        : akc_seo_get('site_desc');

    $image = is_singular() && has_post_thumbnail()
        ? get_the_post_thumbnail_url( null, 'large' )
        : akc_seo_get('og_image');

    $url = is_front_page() ? home_url('/') : get_permalink();

    $tags = [
        'og:type'        => is_single() ? 'article' : 'website',
        'og:site_name'   => get_bloginfo('name'),
        'og:title'       => $title,
        'og:description' => $desc,
        'og:url'         => $url,
    ];

    if ( $image ) {
        $tags['og:image'] = $image;
        $tags['og:image:width']  = '1200';
        $tags['og:image:height'] = '630';
        $tags['og:image:alt']    = $title;
    }

    // Twitter Card
    $tags['twitter:card']        = 'summary_large_image';
    $tags['twitter:title']       = $title;
    $tags['twitter:description'] = $desc;
    if ( $image ) $tags['twitter:image'] = $image;

    echo "\n<!-- AKC SEO: Open Graph / Twitter Card -->\n";
    foreach ( $tags as $property => $content ) {
        $attr = strpos( $property, 'twitter:' ) === 0 ? 'name' : 'property';
        printf(
            '<meta %s="%s" content="%s">' . "\n",
            esc_attr( $attr ),
            esc_attr( $property ),
            esc_attr( $content )
        );
    }

    echo "\n";
}
