# Plugin Installation — advocateakashchikate.com
Two plugins. Install in this order.

---

## Step 1 — Install akc-site-fixes (three critical fixes)
**File:** `wordpress-fixes/akc-site-fixes.zip`

1. WordPress Admin → Plugins → Add New → Upload Plugin
2. Upload `akc-site-fixes.zip` → Install Now → **Activate**
3. You will see a green notice listing what was changed

**What it does on activation:**
- Sets up 301 redirect: `/bombay-high-court-pune-bench-jurisdiction/` → `/bombay-high-court-lawyer-pune/`
- Removes all "Pune Bench" text from every post, page, and SEO meta field site-wide
- Corrects Section 479 → 187(3) BNSS and fixes inverted 60/90-day deadlines on `/bail-after-arrest-pune-guide/`

**Prerequisite:** Publish `/bombay-high-court-lawyer-pune/` first (content in `landing-pages/bombay-high-court.md`).

**Keep active:** The redirect is live only while the plugin is on. Don't deactivate until Google has de-indexed the old URL (check with `site:advocateakashchikate.com bombay-high-court-pune-bench`).

---

## Step 2 — Install akc-seo-toolkit (schema, WhatsApp CTA, OG tags)
**File:** `wordpress-plugin/akc-seo-toolkit.zip`

1. WordPress Admin → Plugins → Add New → Upload Plugin
2. Upload `akc-seo-toolkit.zip` → Install Now → **Activate**
3. Go to **Settings → AKC SEO** and fill in:

| Field | Value |
|-------|-------|
| Phone Number | Your number with country code, e.g. `+919876543210` |
| WhatsApp Number | Same number (or different if you prefer) |
| OG Image URL | URL of your professional headshot or office photo |
| All toggles | Leave all ON (Schema, WhatsApp CTA, Open Graph, Robots, Title/Meta) |

4. Click **Save Changes**

**What it does:**
- Injects Attorney + LegalService + LocalBusiness schema on the homepage
- Injects Article + BreadcrumbList + FAQPage schema on blog posts
- Adds Open Graph tags (Facebook/WhatsApp preview image + description)
- Shows a WhatsApp floating button on all pages
- Handles canonical URLs and meta description fallbacks
- Outputs `robots.txt` and `sitemap.xml` virtually (no file upload needed)

**Note:** If RankMath or Yoast is active, Title/Meta and Canonical features automatically defer to those plugins. The schema and WhatsApp CTA work independently alongside any SEO plugin.

---

## After Both Are Installed

**Verify:**
- Open `/bombay-high-court-pune-bench-jurisdiction/` in incognito → should redirect to `/bombay-high-court-lawyer-pune/`
- Open any blog post → right-click → View Source → search for `application/ld+json` → should see schema
- Open homepage on mobile → should see green WhatsApp button in bottom-right corner
- Share a blog post URL in WhatsApp → preview should show the post title, description, and image

**Flush caches:**
After activating both plugins, flush your Cloudflare cache and any WordPress caching plugin (WP Super Cache, W3TC, LiteSpeed Cache) so visitors get the updated pages immediately.

**Google Search Console:**
Within 48 hours of activation, check Search Console → Enhancements → FAQ for any rich result opportunities being detected on your blog posts.

---

## Plugin Summary

| Plugin | File | Purpose | Keep Active? |
|--------|------|---------|-------------|
| AKC Site Fixes | `wordpress-fixes/akc-site-fixes.zip` | Three one-time corrections + permanent redirect | Yes, until old BHC URL is de-indexed |
| AKC SEO Toolkit v1.2.0 | `wordpress-plugin/akc-seo-toolkit.zip` | Schema, WhatsApp CTA, OG tags, SEO meta | Yes, permanently |
