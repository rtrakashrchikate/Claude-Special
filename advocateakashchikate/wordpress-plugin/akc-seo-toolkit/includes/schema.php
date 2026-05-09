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

// Extract FAQ pairs from post content — looks for <h3>Q: ...</h3><p>A: ...</p> patterns
function akc_extract_faq_from_post( $post ) {
    if ( ! $post ) return [];
    $content = $post->post_content;
    if ( strlen( $content ) < 200 ) return [];
    $items   = [];

    // Match patterns: heading starting with Q: followed by paragraph starting with A:
    $prev_limit = ini_get('pcre.backtrack_limit');
    ini_set('pcre.backtrack_limit', 500000);
    $result = preg_match_all(
        '/<h[23][^>]*>\s*(?:Q:|Q\.)?(?:<strong>)?\s*([^<]{3,200}?)\s*(?:<\/strong>)?\s*<\/h[23]>\s*<p>\s*(?:A:|A\.)?(?:<strong>)?\s*([^<]{3,500}?)\s*(?:<\/strong>)?\s*<\/p>/si',
        $content,
        $matches,
        PREG_SET_ORDER
    );
    ini_set('pcre.backtrack_limit', $prev_limit);
    if ( $result === false ) return [];

    foreach ( $matches as $m ) {
        $q = wp_strip_all_tags( $m[1] );
        $a = wp_strip_all_tags( $m[2] );
        if ( $q && $a ) {
            $items[] = [
                '@type'          => 'Question',
                'name'           => $q,
                'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $a ],
            ];
        }
    }

    return $items;
}
