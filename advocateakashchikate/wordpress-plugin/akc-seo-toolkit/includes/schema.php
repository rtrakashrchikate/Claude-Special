<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_head', 'akc_inject_schema', 1 );

function akc_inject_schema() {
    if ( akc_seo_get('enable_schema') !== '1' ) return;

    $schemas = [];

    if ( is_front_page() ) {
        $schemas = akc_build_homepage_schema();
    } elseif ( is_singular() ) {
        $schemas = akc_build_page_schema();
    }

    if ( ! empty( $schemas ) ) {
        echo '<script type="application/ld+json">' . wp_json_encode( $schemas, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    }
}

// ---------- Homepage schema ----------
function akc_build_homepage_schema() {
    $name    = akc_seo_get('lawyer_name');
    $desc    = akc_seo_get('site_desc');
    $phone   = akc_seo_get('phone');
    $address = akc_seo_get('address');
    $url     = home_url('/');
    $logo    = get_site_icon_url( 512 ) ?: '';

    return [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'           => [ 'Attorney', 'LegalService', 'LocalBusiness' ],
                '@id'             => $url . '#attorney',
                'name'            => $name,
                'alternateName'   => 'Adv. Akash Chikate',
                'description'     => $desc,
                'url'             => $url,
                'logo'            => $logo ? [ '@type' => 'ImageObject', 'url' => $logo ] : null,
                'telephone'       => $phone,
                'address'         => [
                    '@type'           => 'PostalAddress',
                    'streetAddress'   => 'Shivajinagar',
                    'addressLocality' => 'Pune',
                    'addressRegion'   => 'Maharashtra',
                    'postalCode'      => '411005',
                    'addressCountry'  => 'IN',
                ],
                'geo' => [
                    '@type'     => 'GeoCoordinates',
                    'latitude'  => (float) akc_seo_get('lat'),
                    'longitude' => (float) akc_seo_get('lng'),
                ],
                'areaServed' => [
                    [ '@type' => 'City',  'name' => 'Pune' ],
                    [ '@type' => 'State', 'name' => 'Maharashtra' ],
                ],
                'openingHoursSpecification' => [
                    [
                        '@type'      => 'OpeningHoursSpecification',
                        'dayOfWeek'  => [ 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday' ],
                        'opens'      => '09:00',
                        'closes'     => '19:00',
                    ],
                ],
                'knowsAbout' => [
                    'Criminal Law', 'Bail Applications', 'Anticipatory Bail',
                    'FIR Quashing', 'Cybercrime Law', 'IT Act',
                    'Family Law', 'Divorce', 'Child Custody',
                    'Domestic Violence', 'NDPS Act', 'POCSO Act',
                    'Consumer Court', 'Cheque Bounce', 'Intellectual Property',
                ],
                'priceRange'       => '₹₹',
                'currenciesAccepted' => 'INR',
                'sameAs' => [
                    'https://in.linkedin.com/in/akashchikate',
                    'https://www.facebook.com/advakashchikate/',
                    'https://lawrato.com/advocate-akash-chikate',
                ],
            ],
            [
                '@type'     => 'WebSite',
                '@id'       => $url . '#website',
                'url'       => $url,
                'name'      => get_bloginfo('name'),
                'publisher' => [ '@id' => $url . '#attorney' ],
                'potentialAction' => [
                    '@type'       => 'SearchAction',
                    'target'      => $url . '?s={search_term_string}',
                    'query-input' => 'required name=search_term_string',
                ],
            ],
        ],
    ];
}

// ---------- Inner page schema (BreadcrumbList + FAQPage if FAQ blocks exist) ----------
function akc_build_page_schema() {
    global $post;
    $url      = get_permalink();
    $home_url = home_url('/');
    $title    = get_the_title();

    $schemas = [];

    // BreadcrumbList
    $breadcrumbs = [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $home_url ],
    ];

    // If post has a parent page, add it
    if ( $post->post_parent ) {
        $parent = get_post( $post->post_parent );
        $breadcrumbs[] = [
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => get_the_title( $parent ),
            'item'     => get_permalink( $parent ),
        ];
        $breadcrumbs[] = [
            '@type'    => 'ListItem',
            'position' => 3,
            'name'     => $title,
            'item'     => $url,
        ];
    } else {
        $breadcrumbs[] = [
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => $title,
            'item'     => $url,
        ];
    }

    $schemas[] = [
        '@context'     => 'https://schema.org',
        '@type'        => 'BreadcrumbList',
        'itemListElement' => $breadcrumbs,
    ];

    // Article schema for blog posts
    if ( is_single() && get_post_type() === 'post' ) {
        $schemas[] = [
            '@context'        => 'https://schema.org',
            '@type'           => 'Article',
            'headline'        => $title,
            'description'     => wp_trim_words( get_the_excerpt(), 30, '...' ),
            'datePublished'   => get_the_date( 'c' ),
            'dateModified'    => get_the_modified_date( 'c' ),
            'author'          => [
                '@type' => 'Person',
                '@id'   => $home_url . '#attorney',
                'name'  => akc_seo_get('lawyer_name'),
                'url'   => $home_url . 'about/',
            ],
            'publisher'       => [ '@id' => $home_url . '#attorney' ],
            'mainEntityOfPage'=> [ '@type' => 'WebPage', '@id' => $url ],
            'image'           => get_the_post_thumbnail_url( null, 'large' ) ?: akc_seo_get('og_image'),
        ];
    }

    // FAQPage — parse h3 inside .akc-faq div, OR use [akc_faq] shortcode data stored in post meta
    $faq_items = akc_extract_faq_from_post( $post );
    if ( ! empty( $faq_items ) ) {
        $schemas[] = [
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => $faq_items,
        ];
    }

    return $schemas;
}

/**
 * Extract FAQ pairs from post content.
 *
 * Handles three patterns our blog posts use:
 *   Pattern A: <h3>Q: question?</h3> <p>answer</p>
 *   Pattern B: <h3><strong>Q: question?</strong></h3> <p>answer</p>
 *   Pattern C: <p><strong>Q: question?</strong></p> <p>answer</p>
 *
 * Answers may contain inline HTML (<strong>, <em>, <a>) — stripped before output.
 * Stops each answer at the next heading or next Q: pattern.
 */
function akc_extract_faq_from_post( $post ) {
    if ( ! $post ) return [];
    $content = $post->post_content;
    if ( strlen( $content ) < 200 ) return [];

    $items = [];
    $seen  = [];

    $prev_limit = ini_get( 'pcre.backtrack_limit' );
    ini_set( 'pcre.backtrack_limit', 1000000 );

    // Pattern A + B: question in h2/h3 heading
    $result_h = preg_match_all(
        '/<h[23][^>]*>\s*(?:<strong>)?\s*(?:Q[:.]?\s*)?(.{5,250}?)\s*(?:<\/strong>)?\s*<\/h[23]>\s*<p>([\s\S]{10,800}?)<\/p>/i',
        $content,
        $matches_h,
        PREG_SET_ORDER
    );

    // Pattern C: question in bold paragraph
    $result_p = preg_match_all(
        '/<p>\s*<strong>\s*(?:Q[:.]?\s*)(.{5,250}?)<\/strong>\s*<\/p>\s*<p>([\s\S]{10,800}?)<\/p>/i',
        $content,
        $matches_p,
        PREG_SET_ORDER
    );

    ini_set( 'pcre.backtrack_limit', $prev_limit );

    $all = array_merge(
        ( $result_h ? $matches_h : [] ),
        ( $result_p ? $matches_p : [] )
    );

    foreach ( $all as $m ) {
        $q = trim( wp_strip_all_tags( $m[1] ) );
        $a = trim( wp_strip_all_tags( $m[2] ) );

        // Skip non-question headings (no question mark and doesn't start with Q:)
        if ( ! str_contains( $q, '?' ) && ! preg_match( '/^Q[:.]/i', $q ) ) continue;

        // Deduplicate
        $key = strtolower( substr( $q, 0, 60 ) );
        if ( isset( $seen[ $key ] ) ) continue;
        $seen[ $key ] = true;

        if ( strlen( $q ) < 5 || strlen( $a ) < 10 ) continue;

        // Hard cap answer at 500 chars for schema (Google truncates anyway)
        if ( mb_strlen( $a ) > 500 ) {
            $a = rtrim( mb_substr( $a, 0, 497 ), ' ,;.' ) . '…';
        }

        $items[] = [
            '@type'          => 'Question',
            'name'           => $q,
            'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $a ],
        ];
    }

    return $items;
}
