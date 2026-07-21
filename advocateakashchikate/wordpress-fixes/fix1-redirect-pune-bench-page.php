<?php
/**
 * FIX 1: Redirect /bombay-high-court-pune-bench-jurisdiction/ → /bombay-high-court-lawyer-pune/
 *
 * HOW TO USE:
 * Option A (Recommended) — Paste into your child theme's functions.php:
 *   Copy the add_action() block below and paste it at the bottom of functions.php.
 *
 * Option B — Use the "Redirection" WordPress plugin (free, by John Godley):
 *   Tools → Redirection → Add New
 *   Source URL:  /bombay-high-court-pune-bench-jurisdiction/
 *   Target URL:  /bombay-high-court-lawyer-pune/
 *   HTTP Status: 301
 *
 * Option C — .htaccess rule (if WordPress redirect isn't available):
 *   See the .htaccess snippet at the bottom of this file.
 *
 * WHY: /bombay-high-court-pune-bench-jurisdiction/ contains factually wrong content
 * claiming a "Pune Bench" of the Bombay High Court exists. No such bench exists.
 * Pune matters go to the Principal Seat in Mumbai. The new correct page is at
 * /bombay-high-court-lawyer-pune/ (content ready in the repo).
 */

// ─── PASTE THIS INTO functions.php ───────────────────────────────────────────

add_action( 'template_redirect', function () {
    // Normalise: strip query string and ensure trailing slash
    $request = trailingslashit( strtok( $_SERVER['REQUEST_URI'], '?' ) );

    if ( $request === '/bombay-high-court-pune-bench-jurisdiction/' ) {
        wp_redirect( home_url( '/bombay-high-court-lawyer-pune/' ), 301 );
        exit;
    }
} );

// ─── END functions.php SNIPPET ───────────────────────────────────────────────


/*
 * ─── OPTION C: .htaccess rule ────────────────────────────────────────────────
 *
 * Add this ABOVE the WordPress "# BEGIN WordPress" block in .htaccess:
 *
 * RedirectPermanent /bombay-high-court-pune-bench-jurisdiction/ /bombay-high-court-lawyer-pune/
 *
 * ─────────────────────────────────────────────────────────────────────────────
 *
 * After implementing either option:
 * 1. Visit /bombay-high-court-pune-bench-jurisdiction/ in an incognito window
 * 2. Confirm it loads /bombay-high-court-lawyer-pune/ with a 301 response
 * 3. Use a browser dev tools Network tab or https://httpstatus.io to verify the 301 code
 * 4. Once confirmed, delete the old page from WordPress so it's clean
 *
 * PREREQUISITE: Publish /bombay-high-court-lawyer-pune/ FIRST.
 * Content is in: advocateakashchikate/landing-pages/bombay-high-court.md
 */
