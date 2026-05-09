<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', 'akc_enqueue_whatsapp_styles' );
function akc_enqueue_whatsapp_styles() {
    if ( akc_seo_get('enable_whatsapp') !== '1' ) return;
    wp_enqueue_style(
        'akc-whatsapp-cta',
        AKC_SEO_URL . 'assets/whatsapp-cta.css',
        [],
        AKC_SEO_VERSION
    );
}

add_action( 'wp_footer', 'akc_render_whatsapp_cta', 100 );
function akc_render_whatsapp_cta() {
    if ( akc_seo_get('enable_whatsapp') !== '1' ) return;

    $phone     = akc_seo_get('phone');
    $wa_number = akc_seo_get('whatsapp');
    $wa_msg    = rawurlencode( 'Hi Advocate Akash, I need legal help with...' );

    if ( ! $phone && ! $wa_number ) {
        // Show admin notice instead of broken buttons
        if ( current_user_can('manage_options') ) {
            echo '<div class="akc-admin-notice">⚠️ AKC SEO: Add your phone number in <a href="' . esc_url( admin_url('options-general.php?page=akc-seo-toolkit') ) . '">Settings → AKC SEO</a></div>';
        }
        return;
    }

    $wa_url    = 'https://wa.me/' . esc_attr( $wa_number ) . '?text=' . $wa_msg;
    $call_url  = 'tel:' . esc_attr( $phone );
    $book_url  = home_url('/contact/');
    ?>

    <!-- AKC WhatsApp Float (desktop + mobile) -->
    <a href="<?php echo esc_url( $wa_url ); ?>"
       class="akc-wa-float"
       target="_blank"
       rel="noopener noreferrer"
       aria-label="Chat on WhatsApp">
        <?php echo akc_whatsapp_svg(); ?>
        <span>WhatsApp Us</span>
    </a>

    <!-- AKC Sticky Bar (mobile only) -->
    <div class="akc-sticky-bar" role="navigation" aria-label="Contact options">
        <a href="<?php echo esc_url( $call_url ); ?>" class="akc-bar-call" aria-label="Call now">
            <?php echo akc_phone_svg(); ?>
            <span>Call Now</span>
        </a>
        <a href="<?php echo esc_url( $wa_url ); ?>"
           class="akc-bar-wa"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="WhatsApp">
            <?php echo akc_whatsapp_svg(); ?>
            <span>WhatsApp</span>
        </a>
        <a href="<?php echo esc_url( $book_url ); ?>" class="akc-bar-book" aria-label="Book free consultation">
            <?php echo akc_calendar_svg(); ?>
            <span>Free Consult</span>
        </a>
    </div>
    <?php
}

// ---------- Inline SVGs ----------
function akc_whatsapp_svg() {
    return '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>';
}

function akc_phone_svg() {
    return '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>';
}

function akc_calendar_svg() {
    return '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/></svg>';
}
