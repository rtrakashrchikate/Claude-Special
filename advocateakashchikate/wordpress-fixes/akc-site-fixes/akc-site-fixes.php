<?php
/**
 * Plugin Name:  AKC Site Fixes
 * Description:  Three targeted corrections: (1) 301 redirect for wrong BHC page,
 *               (2) remove all "Pune Bench" references, (3) correct bail-after-arrest
 *               default bail section and 60/90-day deadlines.
 * Version:      1.0.0
 * Author:       Adv. Akash Chikate site admin
 */

defined( 'ABSPATH' ) || exit;

/* ═══════════════════════════════════════════════════════════════════════════
   FIX 1 — 301 REDIRECT (active whenever plugin is active)
   /bombay-high-court-pune-bench-jurisdiction/ → /bombay-high-court-lawyer-pune/
   The old page claims a "Pune Bench" of the Bombay High Court exists.
   No such bench exists. Pune matters go to the Principal Seat (Mumbai).
   ═══════════════════════════════════════════════════════════════════════════ */

add_action( 'template_redirect', 'akc_redirect_wrong_bhc_page' );

function akc_redirect_wrong_bhc_page() {
    $request = trailingslashit( strtok( $_SERVER['REQUEST_URI'], '?' ) );
    if ( $request === '/bombay-high-court-pune-bench-jurisdiction/' ) {
        wp_redirect( home_url( '/bombay-high-court-lawyer-pune/' ), 301 );
        exit;
    }
}


/* ═══════════════════════════════════════════════════════════════════════════
   FIX 2 + FIX 3 — RUN ON ACTIVATION
   ═══════════════════════════════════════════════════════════════════════════ */

register_activation_hook( __FILE__, 'akc_run_all_fixes' );

function akc_run_all_fixes() {
    $log = [];
    $log[] = akc_fix_pune_bench();
    $log[] = akc_fix_bail_after_arrest();
    flush_rewrite_rules();
    // Store log for admin notice
    update_option( 'akc_fixes_log', $log );
    update_option( 'akc_fixes_ran_at', current_time( 'mysql' ) );
}


/* ───────────────────────────────────────────────────────────────────────────
   FIX 2 — Remove all "Pune Bench" references site-wide
   ─────────────────────────────────────────────────────────────────────────── */

function akc_fix_pune_bench() {
    global $wpdb;
    $total = 0;

    // Ordered: longest / most specific strings first to avoid double-replace
    $pairs = [
        'Bombay High Court, Pune Bench' => 'Bombay High Court',
        'Bombay High Court Pune Bench'  => 'Bombay High Court',
        'at Pune Bench'                 => 'at the Bombay High Court',
        'the Pune Bench'                => 'the Bombay High Court',
        'Pune Bench'                    => 'Bombay High Court',
    ];

    foreach ( $pairs as $find => $replace ) {
        $like = '%' . $wpdb->esc_like( $find ) . '%';

        // Post content and excerpt
        $rows = $wpdb->query( $wpdb->prepare(
            "UPDATE {$wpdb->posts}
             SET    post_content = REPLACE(post_content, %s, %s),
                    post_excerpt = REPLACE(post_excerpt, %s, %s)
             WHERE  (post_content LIKE %s OR post_excerpt LIKE %s)
               AND  post_status IN ('publish','draft','private')",
            $find, $replace,
            $find, $replace,
            $like, $like
        ) );
        $total += (int) $rows;

        // Postmeta (RankMath / Yoast title + description fields)
        $rows = $wpdb->query( $wpdb->prepare(
            "UPDATE {$wpdb->postmeta}
             SET    meta_value = REPLACE(meta_value, %s, %s)
             WHERE  meta_value LIKE %s
               AND  meta_key IN (
                        'rank_math_title', 'rank_math_description',
                        '_yoast_wpseo_title', '_yoast_wpseo_metadesc',
                        '_aioseo_title', '_aioseo_description'
                    )",
            $find, $replace, $like
        ) );
        $total += (int) $rows;
    }

    // Clean cache for any posts we touched
    $affected_ids = $wpdb->get_col(
        "SELECT ID FROM {$wpdb->posts}
         WHERE post_status IN ('publish','draft','private')
           AND (post_content LIKE '%Pune Bench%' OR post_excerpt LIKE '%Pune Bench%')"
    );
    foreach ( $affected_ids as $id ) {
        clean_post_cache( $id );
    }

    return "Fix 2 — Pune Bench: {$total} database row(s) updated across posts and postmeta.";
}


/* ───────────────────────────────────────────────────────────────────────────
   FIX 3 — Correct /bail-after-arrest-pune-guide/
   The live page has two errors that may be present:
     (a) wrong section number: "Section 479 BNSS" instead of "Section 187(3) BNSS"
     (b) 60/90-day deadlines may be inverted
   Confirmed correct:
     • 90 days  → offences with death / life imprisonment / ≥10 years
     • 60 days  → all other offences
   ─────────────────────────────────────────────────────────────────────────── */

function akc_fix_bail_after_arrest() {
    global $wpdb;
    $changes = 0;

    // Find the post by slug
    $post = get_page_by_path( 'bail-after-arrest-pune-guide', OBJECT, 'post' );
    if ( ! $post ) {
        // Try as a page too
        $post = get_page_by_path( 'bail-after-arrest-pune-guide', OBJECT, 'page' );
    }
    if ( ! $post ) {
        return 'Fix 3 — Bail page: page not found by slug "bail-after-arrest-pune-guide". Check slug in WordPress and run again.';
    }

    $content   = $post->post_content;
    $original  = $content;

    // ── (a) Wrong section number ──────────────────────────────────────────
    $content = str_replace(
        [ 'Section 479 BNSS', 'section 479 BNSS', 'S. 479 BNSS', 'S.479 BNSS' ],
        'Section 187(3) BNSS',
        $content
    );

    // ── (b) Inverted deadline: "60 days ... death / life / 10 years" ──────
    // Pattern: "60 days" immediately followed (within ~100 chars) by context
    // about death, life imprisonment, or 10 years. Replace with 90.
    $content = preg_replace(
        '/\b60\s*days(\s*[^.]*?(?:death|life imprisonment|ten years|10 years))/i',
        '90 days$1',
        $content
    );

    // Pattern: "90 days ... other offences" — flip to 60
    $content = preg_replace(
        '/\b90\s*days(\s*[^.]*?(?:other offence|all other|remaining offence|less than ten|less than 10))/i',
        '60 days$1',
        $content
    );

    // ── (c) Explicit wrong bullet patterns ────────────────────────────────
    // Handle common formatted variants (Gutenberg list blocks)
    $wrong_to_right = [
        // Wrong: 60 days for serious, 90 for others
        '60 days</strong> – if the offence is punishable with death'        => '90 days</strong> – if the offence is punishable with death',
        '60 days</strong> – for offences punishable with death'             => '90 days</strong> – for offences punishable with death',
        '60 days</strong> for offences punishable with death'               => '90 days</strong> for offences punishable with death',
        '60 days – if the offence is punishable with death'                 => '90 days – if the offence is punishable with death',
        '90 days</strong> – for all other offences'                        => '60 days</strong> – for all other offences',
        '90 days</strong> for all other offences'                          => '60 days</strong> for all other offences',
        '90 days – for all other offences'                                 => '60 days – for all other offences',
        // Plain text variants
        '60 days for offences punishable with death, life imprisonment, or imprisonment for a term not less than ten years' =>
            '90 days for offences punishable with death, life imprisonment, or imprisonment for a term not less than ten years',
        '60 days for offences punishable with death, life imprisonment, or imprisonment of ten years or more' =>
            '90 days for offences punishable with death, life imprisonment, or imprisonment of ten years or more',
        '60 days for offences punishable with death, life imprisonment, or ten years or more' =>
            '90 days for offences punishable with death, life imprisonment, or ten years or more',
        '90 days for all other offences'                                    => '60 days for all other offences',
        '90 days for other offences'                                        => '60 days for other offences',
    ];
    foreach ( $wrong_to_right as $wrong => $right ) {
        if ( false !== strpos( $content, $wrong ) ) {
            $content = str_replace( $wrong, $right, $content );
            $changes++;
        }
    }

    if ( $content === $original ) {
        return 'Fix 3 — Bail page: content inspected — no matching wrong patterns found. Page may already be correct, or uses different phrasing. Review manually at /bail-after-arrest-pune-guide/ and verify the 60/90-day order.';
    }

    $result = wp_update_post( [
        'ID'           => $post->ID,
        'post_content' => $content,
    ] );

    if ( is_wp_error( $result ) ) {
        return 'Fix 3 — Bail page: found errors but wp_update_post failed — ' . $result->get_error_message();
    }

    clean_post_cache( $post->ID );
    return "Fix 3 — Bail page (post #{$post->ID}): corrected section number and/or 60/90-day deadline order. {$changes} explicit string replacement(s) applied.";
}


/* ═══════════════════════════════════════════════════════════════════════════
   ADMIN NOTICE — show results after activation
   ═══════════════════════════════════════════════════════════════════════════ */

add_action( 'admin_notices', 'akc_show_fix_results' );

function akc_show_fix_results() {
    $log = get_option( 'akc_fixes_log' );
    $ran = get_option( 'akc_fixes_ran_at' );
    if ( ! $log ) return;

    echo '<div class="notice notice-success is-dismissible">';
    echo '<p><strong>AKC Site Fixes — ran at ' . esc_html( $ran ) . '</strong></p>';
    echo '<ul style="list-style:disc;margin-left:1.5em">';
    foreach ( $log as $line ) {
        echo '<li>' . esc_html( $line ) . '</li>';
    }
    echo '</ul>';
    echo '<p>Fix 1 (redirect) is now active. To verify: open <code>/bombay-high-court-pune-bench-jurisdiction/</code> in an incognito window — it should redirect to <code>/bombay-high-court-lawyer-pune/</code>.</p>';
    echo '<p>Fix 2 (Pune Bench): run a Google search for <code>site:advocateakashchikate.com "Pune Bench"</code> in a few days to confirm no remaining occurrences in the index.</p>';
    echo '<p>Fix 3 (bail page): visit <code>/bail-after-arrest-pune-guide/</code> and check the default bail section shows 90 days for serious offences and 60 days for others.</p>';
    echo '</div>';

    // After the admin has seen the notice, clean up (one-time notice)
    // Uncomment the next line once you have confirmed the results:
    // delete_option('akc_fixes_log');
}


/* ═══════════════════════════════════════════════════════════════════════════
   RE-RUN BUTTON in Tools menu (in case you need to run fixes again)
   ═══════════════════════════════════════════════════════════════════════════ */

add_action( 'admin_menu', function () {
    add_management_page(
        'AKC Site Fixes',
        'AKC Site Fixes',
        'manage_options',
        'akc-site-fixes',
        'akc_tools_page'
    );
} );

function akc_tools_page() {
    if ( isset( $_POST['akc_run_fixes'] ) && check_admin_referer( 'akc_run_fixes_nonce' ) ) {
        akc_run_all_fixes();
        echo '<div class="notice notice-success"><p>Fixes re-applied. See results above.</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>AKC Site Fixes</h1>
        <p>This plugin applies three corrections to advocateakashchikate.com:</p>
        <ol>
            <li><strong>Fix 1 (always active):</strong> 301 redirect from <code>/bombay-high-court-pune-bench-jurisdiction/</code> to <code>/bombay-high-court-lawyer-pune/</code></li>
            <li><strong>Fix 2:</strong> Remove all "Pune Bench" references from posts, pages, and SEO meta fields (RankMath / Yoast)</li>
            <li><strong>Fix 3:</strong> Correct Section 479 → Section 187(3) BNSS and fix inverted 60/90-day bail deadlines on <code>/bail-after-arrest-pune-guide/</code></li>
        </ol>
        <form method="post">
            <?php wp_nonce_field( 'akc_run_fixes_nonce' ); ?>
            <p><input type="submit" name="akc_run_fixes" class="button button-primary" value="Re-run Fixes 2 and 3 Now"></p>
        </form>
        <hr>
        <h2>Last run</h2>
        <?php
        $log = get_option( 'akc_fixes_log' );
        $ran = get_option( 'akc_fixes_ran_at' );
        if ( $log ) {
            echo '<p>Ran at: <strong>' . esc_html( $ran ) . '</strong></p><ul>';
            foreach ( $log as $line ) {
                echo '<li>' . esc_html( $line ) . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>Not yet run (or log cleared).</p>';
        }
        ?>
    </div>
    <?php
}
