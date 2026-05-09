<?php
/**
 * Plugin Name: AKC SEO Toolkit
 * Plugin URI:  https://advocateakashchikate.com
 * Description: Schema markup, WhatsApp CTA, Open Graph tags, and local SEO for Advocate Akash Chikate's website. Install, configure phone number in Settings → AKC SEO, done.
 * Version:     1.0.0
 * Author:      Advocate Akash Chikate
 * License:     GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'AKC_SEO_VERSION', '1.0.0' );
define( 'AKC_SEO_FILE', __FILE__ );
define( 'AKC_SEO_DIR', plugin_dir_path( __FILE__ ) );
define( 'AKC_SEO_URL', plugin_dir_url( __FILE__ ) );

require_once AKC_SEO_DIR . 'includes/settings.php';
require_once AKC_SEO_DIR . 'includes/schema.php';
require_once AKC_SEO_DIR . 'includes/whatsapp-cta.php';
require_once AKC_SEO_DIR . 'includes/opengraph.php';
require_once AKC_SEO_DIR . 'includes/robots-sitemap.php';

register_activation_hook( __FILE__, 'akc_seo_activate' );
function akc_seo_activate() {
    // Flush rewrite rules so robots.txt virtual file works
    flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'akc_seo_deactivate' );
function akc_seo_deactivate() {
    flush_rewrite_rules();
}
