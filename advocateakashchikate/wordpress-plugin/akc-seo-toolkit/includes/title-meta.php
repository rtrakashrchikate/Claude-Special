<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * Handles three audit gaps when no full SEO plugin (Yoast / RankMath) is active:
 *   1. Title tag length enforcement (≤ 60 chars on SERP-critical pages)
 *   2. Meta description fallback (excerpt → site description)
 *   3. Self-referencing canonical URL
 *
 * All three are suppressed when Yoast or RankMath is active — those plugins
 * own these outputs and handle them better than we can here.
 */

// ── 1. Title length enforcement ──────────────────────────────────────────────
add_filter( 'document_title_parts', 'akc_trim_title_parts', 20 );
function akc_trim_title_parts( $parts ) {
    if ( akc_seo_get( 'enable_title_meta' ) !== '1' ) return $parts;
    if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) return $parts;

    if ( empty( $parts['title'] ) ) return $parts;

    $sep       = ' | ';
    $site      = isset( $parts['site'] ) ? $parts['site'] : get_bloginfo( 'name' );
    $max_title = 60 - strlen( $sep ) - strlen( $site );   // chars left for the page-title part
    $max_title = max( 20, $max_title );                    // never go below 20 chars

    if ( strlen( $parts['title'] ) > $max_title ) {
        // Trim at a word boundary, then strip any trailing punctuation
        $parts['title'] = rtrim(
            mb_substr( $parts['title'], 0, $max_title ),
            ' ,;:-–—'
        );
    }

    return $parts;
}

// ── 2. Meta description fallback ─────────────────────────────────────────────
add_action( 'wp_head', 'akc_inject_meta_description', 2 );
function akc_inject_meta_description() {
    if ( akc_seo_get( 'enable_title_meta' ) !== '1' ) return;
    if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) return;

    $desc = '';

    if ( is_singular() ) {
        if ( has_excerpt() ) {
            $desc = wp_trim_words( get_the_excerpt(), 28, '' );
        } else {
            $desc = wp_trim_words(
                wp_strip_all_tags( strip_shortcodes( get_the_content() ) ),
                28,
                ''
            );
        }
    }

    // Homepage / archive: fall back to the global site description from settings
    if ( ! $desc ) {
        $desc = akc_seo_get( 'site_desc' );
    }

    $desc = trim( $desc );
    if ( ! $desc ) return;

    // Hard cap at 160 chars
    if ( mb_strlen( $desc ) > 160 ) {
        $desc = rtrim( mb_substr( $desc, 0, 157 ), ' ,;.' ) . '…';
    }

    printf(
        '<meta name="description" content="%s">' . "\n",
        esc_attr( $desc )
    );
}

// ── 3. Canonical URL ─────────────────────────────────────────────────────────
add_action( 'wp_head', 'akc_inject_canonical', 2 );
function akc_inject_canonical() {
    if ( akc_seo_get( 'enable_title_meta' ) !== '1' ) return;
    if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) return;

    $canonical = '';

    if ( is_front_page() ) {
        $canonical = home_url( '/' );
    } elseif ( is_home() ) {
        $canonical = get_permalink( get_option( 'page_for_posts' ) );
    } elseif ( is_singular() ) {
        $canonical = get_permalink();
    } elseif ( is_tax() || is_category() || is_tag() ) {
        $canonical = get_term_link( get_queried_object() );
        if ( is_wp_error( $canonical ) ) $canonical = '';
    }

    if ( $canonical ) {
        printf(
            '<link rel="canonical" href="%s">' . "\n",
            esc_url( $canonical )
        );
    }
}
