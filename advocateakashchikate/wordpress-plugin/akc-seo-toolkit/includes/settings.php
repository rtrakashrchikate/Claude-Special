<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// ---------- Defaults ----------
function akc_seo_defaults() {
    return [
        'phone'        => '',
        'whatsapp'     => '',
        'address'      => 'Shivajinagar, Pune, Maharashtra 411005',
        'lat'          => '18.5308',
        'lng'          => '73.8475',
        'lawyer_name'  => 'Advocate Akash R. Chikate',
        'site_desc'    => 'Criminal defence attorney enrolled at the Bombay High Court with 8+ years of experience in bail applications, FIR quashing, cybercrime defence, and family law in Pune.',
        'og_image'     => '',
        'enable_schema'    => '1',
        'enable_whatsapp'  => '1',
        'enable_og'        => '1',
        'enable_robots'    => '1',
    ];
}

function akc_seo_get( $key ) {
    $opts = get_option( 'akc_seo_options', [] );
    $defaults = akc_seo_defaults();
    return isset( $opts[ $key ] ) && $opts[ $key ] !== '' ? $opts[ $key ] : ( $defaults[ $key ] ?? '' );
}

// ---------- Admin menu ----------
add_action( 'admin_menu', function () {
    add_options_page(
        'AKC SEO Toolkit',
        'AKC SEO',
        'manage_options',
        'akc-seo-toolkit',
        'akc_seo_settings_page'
    );
} );

add_action( 'admin_init', function () {
    register_setting( 'akc_seo_group', 'akc_seo_options', 'akc_seo_sanitize' );
} );

function akc_seo_sanitize( $input ) {
    $clean = [];
    $text_fields = [ 'phone', 'whatsapp', 'address', 'lat', 'lng', 'lawyer_name', 'site_desc', 'og_image' ];
    foreach ( $text_fields as $f ) {
        $clean[ $f ] = sanitize_text_field( $input[ $f ] ?? '' );
    }
    $toggle_fields = [ 'enable_schema', 'enable_whatsapp', 'enable_og', 'enable_robots' ];
    foreach ( $toggle_fields as $f ) {
        $clean[ $f ] = ! empty( $input[ $f ] ) ? '1' : '0';
    }
    return $clean;
}

function akc_seo_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    ?>
    <div class="wrap">
        <h1>⚖️ AKC SEO Toolkit</h1>
        <p>Configure once — schema, WhatsApp CTA, and Open Graph tags are applied automatically across the entire site.</p>

        <?php if ( isset( $_GET['settings-updated'] ) ) : ?>
            <div class="notice notice-success is-dismissible"><p><strong>Settings saved.</strong> Changes are live on the site.</p></div>
        <?php endif; ?>

        <form method="post" action="options.php">
            <?php settings_fields( 'akc_seo_group' ); ?>

            <h2>📞 Contact Details</h2>
            <table class="form-table">
                <tr>
                    <th><label for="akc_phone">Phone Number</label></th>
                    <td>
                        <input type="text" id="akc_phone" name="akc_seo_options[phone]"
                               value="<?php echo esc_attr( akc_seo_get('phone') ); ?>"
                               placeholder="+919XXXXXXXXX" class="regular-text">
                        <p class="description">Include country code, no spaces. Used for the Call button and schema.</p>
                    </td>
                </tr>
                <tr>
                    <th><label for="akc_whatsapp">WhatsApp Number</label></th>
                    <td>
                        <input type="text" id="akc_whatsapp" name="akc_seo_options[whatsapp]"
                               value="<?php echo esc_attr( akc_seo_get('whatsapp') ); ?>"
                               placeholder="919XXXXXXXXX" class="regular-text">
                        <p class="description">Digits only, no +, no spaces. Usually same as phone but without the +.</p>
                    </td>
                </tr>
            </table>

            <h2>🏢 Office Details (for Schema)</h2>
            <table class="form-table">
                <tr>
                    <th><label for="akc_address">Office Address</label></th>
                    <td>
                        <input type="text" id="akc_address" name="akc_seo_options[address]"
                               value="<?php echo esc_attr( akc_seo_get('address') ); ?>"
                               class="large-text">
                    </td>
                </tr>
                <tr>
                    <th><label for="akc_lawyer_name">Lawyer Name</label></th>
                    <td>
                        <input type="text" id="akc_lawyer_name" name="akc_seo_options[lawyer_name]"
                               value="<?php echo esc_attr( akc_seo_get('lawyer_name') ); ?>"
                               class="regular-text">
                    </td>
                </tr>
                <tr>
                    <th><label for="akc_site_desc">Short Description</label></th>
                    <td>
                        <textarea id="akc_site_desc" name="akc_seo_options[site_desc]"
                                  rows="3" class="large-text"><?php echo esc_textarea( akc_seo_get('site_desc') ); ?></textarea>
                        <p class="description">Used in schema and Open Graph tags. Keep under 160 characters.</p>
                    </td>
                </tr>
            </table>

            <h2>🖼️ Open Graph Image</h2>
            <table class="form-table">
                <tr>
                    <th><label for="akc_og_image">Default OG Image URL</label></th>
                    <td>
                        <input type="text" id="akc_og_image" name="akc_seo_options[og_image]"
                               value="<?php echo esc_attr( akc_seo_get('og_image') ); ?>"
                               class="large-text" placeholder="https://advocateakashchikate.com/wp-content/uploads/og-image.jpg">
                        <p class="description">Used when sharing pages on WhatsApp, LinkedIn, Facebook. Recommended: 1200×630px image of Akash in court attire.</p>
                    </td>
                </tr>
            </table>

            <h2>⚙️ Features</h2>
            <table class="form-table">
                <?php
                $features = [
                    'enable_schema'   => [ 'JSON-LD Schema', 'Injects Attorney + LegalService + FAQPage structured data. Enables rich results in Google.' ],
                    'enable_whatsapp' => [ 'WhatsApp CTA', 'Floating WhatsApp bubble + sticky mobile bar (Call / WhatsApp / Book buttons).' ],
                    'enable_og'       => [ 'Open Graph Tags', 'Adds og:title, og:description, og:image for better WhatsApp/LinkedIn/Facebook sharing.' ],
                    'enable_robots'   => [ 'Robots.txt', 'Adds a clean robots.txt that allows all search engine crawlers while blocking WP admin paths.' ],
                ];
                foreach ( $features as $key => [ $label, $desc ] ) : ?>
                <tr>
                    <th><?php echo esc_html( $label ); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="akc_seo_options[<?php echo esc_attr( $key ); ?>]"
                                   value="1" <?php checked( akc_seo_get( $key ), '1' ); ?>>
                            Enable
                        </label>
                        <p class="description"><?php echo esc_html( $desc ); ?></p>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>

            <?php submit_button( 'Save Settings' ); ?>
        </form>

        <hr>
        <h2>🔍 Schema Preview</h2>
        <p>This is the JSON-LD being injected on your homepage right now:</p>
        <pre style="background:#f1f1f1;padding:12px;overflow:auto;font-size:12px;max-height:400px;"><?php
            echo esc_html( json_encode( akc_build_homepage_schema(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) );
        ?></pre>
    </div>
    <?php
}
