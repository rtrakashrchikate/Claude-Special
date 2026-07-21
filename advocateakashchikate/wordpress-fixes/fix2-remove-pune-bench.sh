#!/usr/bin/env bash
# FIX 2: Remove all "Pune Bench" / "pune bench" references site-wide
#
# WHY: The Bombay High Court has NO Pune Bench. Pune matters go to the
# Principal Seat in Mumbai. The bench list is: Nagpur, Aurangabad,
# Kolhapur (since Aug 2025), Porvorim (Goa). Every instance of
# "Pune Bench" on the site is factually wrong.
#
# ─── METHOD A: WP-CLI (fastest — run from your server terminal) ───────────────
#
# Run these commands from your WordPress root directory:
#
# STEP 1 — Dry run first (shows what will change, makes no changes):
#   wp search-replace 'Bombay High Court, Pune Bench' 'Bombay High Court' --dry-run
#   wp search-replace 'Bombay High Court Pune Bench' 'Bombay High Court' --dry-run
#   wp search-replace 'Pune Bench' 'Bombay High Court' --dry-run
#
# STEP 2 — Apply changes (only after verifying the dry run output):
#   wp search-replace 'Bombay High Court, Pune Bench' 'Bombay High Court' --all-tables
#   wp search-replace 'Bombay High Court Pune Bench' 'Bombay High Court' --all-tables
#   wp search-replace 'Pune Bench' 'Bombay High Court' --all-tables
#
# STEP 3 — Flush caches:
#   wp cache flush
#
# --all-tables covers posts, postmeta, options, and any custom tables.
# Run the comma-variant first because it's a subset of the non-comma variant.
#
# ─── METHOD B: phpMyAdmin SQL (if no WP-CLI access) ─────────────────────────
#
# Run these SQL queries in phpMyAdmin → SQL tab, one at a time.
# Replace `wp_` with your actual table prefix if different.

cat <<'SQL'
-- Step 1: Comma variant (e.g. "Bombay High Court, Pune Bench")
UPDATE wp_posts
SET post_content = REPLACE(post_content, 'Bombay High Court, Pune Bench', 'Bombay High Court')
WHERE post_content LIKE '%Pune Bench%';

UPDATE wp_postmeta
SET meta_value = REPLACE(meta_value, 'Bombay High Court, Pune Bench', 'Bombay High Court')
WHERE meta_value LIKE '%Pune Bench%';

-- Step 2: Space variant (e.g. "Bombay High Court Pune Bench")
UPDATE wp_posts
SET post_content = REPLACE(post_content, 'Bombay High Court Pune Bench', 'Bombay High Court')
WHERE post_content LIKE '%Pune Bench%';

UPDATE wp_postmeta
SET meta_value = REPLACE(meta_value, 'Bombay High Court Pune Bench', 'Bombay High Court')
WHERE meta_value LIKE '%Pune Bench%';

-- Step 3: Any remaining standalone "Pune Bench" in post content
-- (review the results of this SELECT before running the UPDATE)
SELECT ID, post_title, post_status
FROM wp_posts
WHERE post_content LIKE '%Pune Bench%'
  AND post_status IN ('publish', 'draft');

-- Run this UPDATE only after reviewing the SELECT output above:
-- UPDATE wp_posts
-- SET post_content = REPLACE(post_content, 'Pune Bench', 'Bombay High Court')
-- WHERE post_content LIKE '%Pune Bench%'
--   AND post_status IN ('publish', 'draft');

-- Step 4: Check RankMath / Yoast SEO meta fields (stored in postmeta)
SELECT post_id, meta_key, meta_value
FROM wp_postmeta
WHERE meta_value LIKE '%Pune Bench%'
  AND meta_key IN ('rank_math_description', 'rank_math_title', '_yoast_wpseo_title', '_yoast_wpseo_metadesc');

-- Update those SEO fields:
UPDATE wp_postmeta
SET meta_value = REPLACE(meta_value, 'Pune Bench', 'Bombay High Court')
WHERE meta_value LIKE '%Pune Bench%'
  AND meta_key IN ('rank_math_description', 'rank_math_title', '_yoast_wpseo_title', '_yoast_wpseo_metadesc');
SQL

# ─── METHOD C: WordPress Admin (no server access) ────────────────────────────
#
# Install the free plugin "Better Search Replace" by Delicious Brains:
# Plugins → Add New → search "Better Search Replace" → Install and Activate
#
# Settings → Better Search Replace:
#   Search For:    Bombay High Court, Pune Bench
#   Replace With:  Bombay High Court
#   Select Tables: wp_posts, wp_postmeta
#   Run as dry run: YES (first pass)
#
# Repeat without dry run once satisfied, then run again for:
#   Search For:    Bombay High Court Pune Bench
#   Search For:    Pune Bench  ← do last, verify no false positives in preview
#
# ─── AFTER ANY METHOD ────────────────────────────────────────────────────────
#
# 1. Flush all caches (WP Super Cache / W3TC / LiteSpeed / Cloudflare)
# 2. Verify by searching Google for: site:advocateakashchikate.com "Pune Bench"
#    (it will take a few days for Google to re-index the corrected pages)
# 3. Check these specific pages manually for any remaining occurrences:
#    - /how-to-get-anticipatory-bail-pune/
#    - /fir-quashing-bombay-high-court-pune/
#    - /practice-areas/criminal-defence/
#    - /about/
