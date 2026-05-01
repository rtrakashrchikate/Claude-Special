# advocateakashchikate.com — Complete Implementation Guide

All deliverables in this folder were produced from a comprehensive multi-skill study of advocateakashchikate.com.  
Implement in priority order below. Each item has a difficulty rating and estimated time.

---

## PHASE 1 — Quick Wins (Week 1, ~4 hours total)

### 1.1 Fix Bot Blocking — CRITICAL
The site returns HTTP 403 to all crawlers (Googlebot excluded, but SEO tools are blocked).
- **Action:** In Cloudflare / hosting firewall, whitelist known SEO crawlers by user agent or reduce bot protection level from "Under Attack Mode" to "Standard"
- **Why:** Ahrefs, Semrush, and Google Search Console can't audit a blocked site
- **Time:** 15 min
- **File:** No file — direct server/Cloudflare setting

### 1.2 Add robots.txt
- **Action:** Upload `technical/robots.txt` to site root (`https://advocateakashchikate.com/robots.txt`)
- **Time:** 5 min

### 1.3 Add sitemap.xml
- **Action:** Upload `technical/sitemap.xml` to site root. Then submit to Google Search Console (Search Console → Sitemaps → Add Sitemap URL)
- **Note:** If using WordPress with Yoast/RankMath, use the plugin's built-in sitemap and just submit that URL — no need for the manual sitemap file
- **Time:** 10 min

### 1.4 Install WhatsApp + Phone CTA
- **Action:** Paste `technical/whatsapp-cta.html` into WordPress → Appearance → Theme Editor → footer.php (or use a plugin like "Insert Headers and Footers")
- **Replace:** All instances of `+91XXXXXXXXXX` with actual phone number
- **Time:** 20 min

### 1.5 Claim Google Business Profile
- **Action:** Follow checklist in `technical/directory-submissions-checklist.md` — GBP section
- **Why:** Single highest-ROI local SEO action available
- **Time:** 45 min for setup + 10 min/week ongoing

### 1.6 Update Homepage Copy
- **Action:** Use content from `copy/homepage-copy.md` to update homepage in WordPress
- Replace hero text, add trust bar, update CTAs
- **Time:** 60 min

---

## PHASE 2 — Technical SEO (Week 2, ~3 hours)

### 2.1 Add JSON-LD Schema to Homepage
- **Action:** Copy content of `schema/homepage-schema.json`
- In WordPress: Appearance → Theme Editor → header.php, paste inside `<head>` as `<script type="application/ld+json">[JSON]</script>`
- Or use RankMath/Yoast "Schema" tab in the page editor
- **Replace:** Phone number, logo URL, image URL
- **Time:** 30 min

### 2.2 Add Schema to All Practice Area Pages
- **Action:** Use `schema/practice-area-schema.json` as the template
- For each practice area page: add Service schema + BreadcrumbList + FAQPage
- Customise the FAQ questions/answers for each page
- **Time:** 2 hours (all pages)

### 2.3 Add Schema to All Blog Posts
- **Action:** Use `schema/blog-article-schema.json` template
- Add Article + BreadcrumbList + FAQPage schema to every existing and new post
- **Time:** 30 min per post (do existing posts first)

### 2.4 Add Missing Meta Tags to All Pages
In WordPress (with Yoast/RankMath), for every page:
- [ ] Set SEO title (from page's `meta` section in this folder)
- [ ] Set meta description
- [ ] Set canonical URL (usually auto-set by plugin)
- [ ] Add Open Graph image (featured image works if set)
- **Time:** 10 min per page

### 2.5 Fix Site Architecture
- **Action:** Create new parent pages as per `practice-areas/criminal-law.md` structure
- Create `/practice-areas/criminal-law/` parent page
- Create `/practice-areas/cybercrime-it-law/` page (use `practice-areas/cybercrime.md`)
- Update internal linking accordingly
- **Time:** 2 hours

---

## PHASE 3 — Content Expansion (Weeks 3–6)

### 3.1 Publish All Practice Area Pages
Pages ready to publish:
- `practice-areas/criminal-law.md` → `/practice-areas/criminal-law/`
- `practice-areas/cybercrime.md` → `/practice-areas/cybercrime-it-law/`
- `practice-areas/family-law.md` → `/practice-areas/family-law/` (update existing)
- `practice-areas/consumer-court.md` → `/practice-areas/consumer-court/`
- **Time:** 2 hours total

### 3.2 Publish All Location Pages
14 location pages ready:
- `location-pages/aundh.md` — already exists, update with new copy
- `location-pages/hinjewadi.md` → `/criminal-lawyer/criminal-lawyer-hinjewadi-pune/`
- `location-pages/koregaon-park.md` → `/criminal-lawyer/criminal-lawyer-koregaon-park-pune/`
- All 11 remaining locations in `location-pages/remaining-locations.md`
- **Time:** 30 min per page (WordPress creation + schema)

### 3.3 Publish Pillar Blog Posts
Priority order (publish highest-search-volume first):
1. `blog-posts/complete-guide-bail-pune.md` — publish immediately
2. `blog-posts/498a-false-case-defence.md` — publish week 2
3. Posts 3–8 from `blog-posts/remaining-6-posts-outlines.md` — 1 per week

**Before publishing each post:**
- [ ] Follow `blog-posts/_TEMPLATE.md` checklist
- [ ] Add featured image (use Canva — legal-themed image)
- [ ] Add Article + FAQPage JSON-LD
- [ ] Add lead capture CTA at bottom (link to relevant lead magnet)
- [ ] Add 2–3 internal links

### 3.4 Set Up Lead Magnets
4 lead magnets ready in `lead-magnets/`:
1. `fir-24hr-checklist.md` — highest conversion, publish first
2. `bail-application-checklist.md`
3. `cybercrime-7day-action-plan.md`
4. `divorce-rights-guide.md`

**For each:**
1. Convert markdown to PDF (use Canva, Adobe, or WordPress PDF plugin)
2. Add brand header (logo + colors)
3. Create a simple landing page with a form (Name + WhatsApp)
4. Connect form to WhatsApp automation (see email-sequences/)
5. Link from relevant practice area pages and blog posts

---

## PHASE 4 — Lead Generation & Nurture (Week 6+)

### 4.1 Set Up WhatsApp Automation
- **Provider options:** Interakt, AiSensy, Wati, or WhatsApp Business API directly
- **Sequence:** Use `email-sequences/nurture-sequence.md`
- Configure all 4 messages as an automated drip
- Trigger: Any form submission that includes WhatsApp number

### 4.2 Start Social Media Posting
- Use `social-content/30-day-calendar.md` as your content queue
- Schedule posts using Buffer, Hootsuite, or LinkedIn's native scheduler
- Post Mon–Fri; 5 LinkedIn posts + 2 Instagram posts per week
- Aim to publish Instagram Reels 2x/week (huge reach for legal content)

### 4.3 Directory Submissions
- Follow `technical/directory-submissions-checklist.md` in priority order
- Complete LawRato and Vakil Search in Week 1
- Complete all directories by end of Month 1

---

## PHASE 5 — Ongoing (Monthly)

### Monthly SEO Maintenance
- [ ] Check Google Search Console for crawl errors, coverage issues
- [ ] Add 1–2 new blog posts (use content calendar topics from study)
- [ ] Check for and fix broken internal links
- [ ] Update `dateModified` on blog posts as they're refreshed
- [ ] Monitor Google ranking for primary keywords (use Semrush or free tools like Ubersuggest)
- [ ] Request 5 new Google reviews from recent clients

### Monthly Content
- [ ] 4 new LinkedIn posts (use social calendar)
- [ ] 8+ Instagram posts (4 static + 4 Reels)
- [ ] 1 new blog post (minimum)
- [ ] Update sitemap with any new pages added

---

## TECHNOLOGY STACK RECOMMENDATIONS

If website is on WordPress (likely based on URL structure):

| Need | Plugin/Tool | Cost |
|---|---|---|
| SEO (meta, schema, sitemap) | RankMath (preferred) or Yoast SEO | Free |
| Contact forms | WPForms or Contact Form 7 | Free |
| WhatsApp button | WA Web Button or custom (see whatsapp-cta.html) | Free |
| Lead capture / CRM | FluentCRM | Free |
| Page caching (speed) | WP Rocket or LiteSpeed Cache | Paid / Free |
| CDN (speed) | Cloudflare Free tier | Free |
| Analytics | Google Analytics 4 + Search Console | Free |
| Booking | Calendly embedded | Free tier available |
| Email | WP Mail SMTP + Gmail | Free |

---

## KEYWORD TRACKING

Set up rank tracking for these primary keywords (use Google Search Console or Semrush):

| Keyword | Current Est. Position | 3-Month Target |
|---|---|---|
| criminal lawyer Pune | Unknown | Top 10 |
| bail lawyer Pune | Unknown | Top 10 |
| FIR quashing Pune | Unknown | Top 5 |
| cybercrime lawyer Pune | Unknown | Top 10 |
| divorce lawyer Pune | Unknown | Top 10 |
| 498A lawyer Pune | Unknown | Top 10 |
| anticipatory bail Pune | Unknown | Top 5 |
| consumer court lawyer Pune | Unknown | Top 10 |

---

## SUCCESS METRICS (6-Month Targets)

| Metric | Current | 6-Month Target |
|---|---|---|
| Google ranking: "criminal lawyer Pune" | Unknown | Page 1 |
| Monthly organic visits | Unknown | 500+ |
| Monthly WhatsApp/call leads from website | Unknown | 20+ |
| Google Business Profile reviews | 0 (not claimed) | 25+ |
| Total indexed pages | ~15 | 50+ |
| Location pages live | 1 | 15 |
| Pillar blog posts | 4 | 12 |
| Directory listings | 2–3 | 10+ |

---

## FILE INDEX

```
advocateakashchikate/
├── IMPLEMENTATION-GUIDE.md          ← This file — start here
├── technical/
│   ├── robots.txt                   ← Upload to site root
│   ├── sitemap.xml                  ← Upload + submit to Search Console
│   ├── whatsapp-cta.html            ← Add to WordPress footer
│   └── directory-submissions-checklist.md
├── schema/
│   ├── homepage-schema.json         ← Add to homepage <head>
│   ├── practice-area-schema.json    ← Template for all practice area pages
│   ├── blog-article-schema.json     ← Template for all blog posts
│   └── location-page-schema.json   ← Template for all location pages
├── copy/
│   └── homepage-copy.md            ← Rewrite homepage with this content
├── practice-areas/
│   ├── criminal-law.md             ← New/updated page content
│   ├── cybercrime.md               ← New page content
│   ├── family-law.md               ← Updated page content
│   └── consumer-court.md           ← New page content
├── location-pages/
│   ├── _TEMPLATE.md                ← Use to create any future location page
│   ├── aundh.md                    ← Update existing Aundh page
│   ├── hinjewadi.md                ← New page
│   ├── koregaon-park.md            ← New page
│   └── remaining-locations.md      ← 11 more pages (Baner, Kothrud, etc.)
├── blog-posts/
│   ├── _TEMPLATE.md                ← Blog post publishing checklist
│   ├── complete-guide-bail-pune.md ← Publish first
│   ├── 498a-false-case-defence.md  ← Publish second
│   └── remaining-6-posts-outlines.md ← Posts 3–8
├── lead-magnets/
│   ├── fir-24hr-checklist.md       ← Highest priority lead magnet
│   ├── bail-application-checklist.md
│   ├── cybercrime-7day-action-plan.md
│   └── divorce-rights-guide.md
├── email-sequences/
│   └── nurture-sequence.md         ← 4-message WhatsApp/email drip
└── social-content/
    └── 30-day-calendar.md          ← LinkedIn + Instagram content queue
```
