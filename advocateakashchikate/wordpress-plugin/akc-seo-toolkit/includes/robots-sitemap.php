<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Override WordPress's default robots.txt with a clean one
add_filter( 'robots_txt', 'akc_custom_robots_txt', 10, 2 );
function akc_custom_robots_txt( $output, $public ) {
    if ( akc_seo_get('enable_robots') !== '1' ) return $output;

    $site_url = home_url('/');

    return "User-agent: *
Allow: /

Disallow: /wp-admin/
Disallow: /wp-login.php
Disallow: /wp-includes/
Disallow: /xmlrpc.php
Disallow: /?s=
Disallow: /search/

User-agent: Googlebot
Allow: /

User-agent: Bingbot
Allow: /

Sitemap: {$site_url}sitemap_index.xml
Sitemap: {$site_url}sitemap.xml
";
}

// Add admin notice if no SEO plugin is active (no sitemap being generated)
add_action( 'admin_notices', 'akc_sitemap_notice' );
function akc_sitemap_notice() {
    if ( defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION') ) return;

    $screen = get_current_screen();
    if ( ! $screen || $screen->id !== 'settings_page_akc-seo-toolkit' ) return;

    echo '<div class="notice notice-warning"><p>';
    echo '<strong>AKC SEO:</strong> No sitemap plugin detected. ';
    echo 'Install <strong>RankMath</strong> (free) to auto-generate a sitemap. ';
    echo 'Or manually upload the <code>sitemap.xml</code> from the deliverables folder to your site root.';
    echo '</p></div>';
}
