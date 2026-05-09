# Step-by-Step Implementation Guide
# advocateakashchikate.com — All Changes

Read this top to bottom. Each section is ordered by ROI.
Estimated total time: 3–4 hours spread over a week.

---

## STEP 1 — Install the AKC SEO Toolkit Plugin
**Time: 5 minutes | Fixes: Schema, WhatsApp CTA, Open Graph, robots.txt**

This single plugin applies the most important technical fixes automatically.

### How to install:
1. Download `akc-seo-toolkit.zip` from this folder
2. Log in to WordPress: `yourdomain.com/wp-admin`
3. Go to **Plugins → Add New Plugin**
4. Click **Upload Plugin** (top of page)
5. Click **Choose File** → select `akc-seo-toolkit.zip` → click **Install Now**
6. Click **Activate Plugin**

### Configure it (takes 2 minutes):
1. Go to **Settings → AKC SEO**
2. Fill in:
   - **Phone Number** → your number with country code, e.g. `+919876543210`
   - **WhatsApp Number** → same number, digits only, no +, e.g. `919876543210`
   - **Office Address** → your full Shivajinagar address
   - **Default OG Image** → upload a photo of yourself in court attire to WordPress Media Library, copy its URL and paste here (1200×630px works best)
3. Make sure all 4 feature checkboxes are ticked ✅
4. Click **Save Settings**

### What happens automatically after saving:
- ✅ WhatsApp floating button appears on every page
- ✅ Sticky mobile bar (Call / WhatsApp / Book) appears on mobile
- ✅ Attorney + LegalService JSON-LD schema added to homepage
- ✅ BreadcrumbList + Article schema added to inner pages and blog posts
- ✅ FAQ schema auto-extracted from blog posts that have Q&A sections
- ✅ Open Graph tags added (better WhatsApp/LinkedIn share previews)
- ✅ Clean robots.txt applied

> **Note:** If you already have Yoast SEO or RankMath installed, the plugin automatically skips Open Graph (to avoid conflicts) but still adds schema and WhatsApp CTA.

---

## STEP 2 — Add RankMath (Free SEO Plugin)
**Time: 10 minutes | Fixes: Sitemap, meta titles, meta descriptions on every page**

RankMath is free and handles sitemap generation, meta tags, and more.

### Install:
1. **Plugins → Add New Plugin**
2. Search: `RankMath SEO`
3. Click **Install Now** → **Activate**
4. Run the setup wizard — choose **Easy** mode
5. Connect to Google Search Console when prompted (important — do this)

### After installing, submit your sitemap:
1. In RankMath → **Sitemap Settings** → note the sitemap URL (usually `yourdomain.com/sitemap_index.xml`)
2. Go to **Google Search Console** (search.google.com/search-console)
3. Select your property → **Sitemaps** (left menu)
4. Enter the sitemap URL → click **Submit**

### Set meta titles and descriptions for key pages:
For **each** of these pages, open it in WordPress editor → find the **RankMath** panel (bottom or right sidebar) → set:

| Page | SEO Title | Meta Description |
|---|---|---|
| Homepage | `Criminal Lawyer Pune \| Adv. Akash Chikate \| Bail & FIR` | `Facing arrest, FIR, or criminal case in Pune? Advocate Akash R. Chikate — Bombay High Court enrolled, 8+ years. Free confidential consultation. Call now.` |
| About | `About Adv. Akash Chikate \| Criminal Lawyer Pune \| 8+ Years` | `Advocate Akash R. Chikate — criminal defence attorney enrolled at Bombay High Court. 8+ years in bail, FIR quashing, cybercrime, and family law in Pune.` |
| Criminal Law | `Criminal Law Services Pune \| Bail & FIR Quashing \| Adv. Akash Chikate` | `Criminal defence in Pune — bail applications, anticipatory bail, FIR quashing at Bombay High Court, NDPS, POCSO, criminal appeals. Free consultation.` |
| Family Law | `Family Law & Divorce Lawyer Pune \| Family Court \| Adv. Akash Chikate` | `Divorce, child custody, maintenance, domestic violence — Adv. Akash Chikate at Pune Family Court. 8+ years, free consultation, discreet service.` |
| Cybercrime | `Cybercrime Lawyer Pune \| IT Act Defence \| Adv. Akash Chikate` | `Cybercrime FIR in Pune? IT Act defence, online fraud, bail from cyber cell — Adv. Akash Chikate, Bombay High Court enrolled. Free consultation.` |
| Blog | `Legal Insights \| Criminal Law Blog Pune \| Adv. Akash Chikate` | `Plain-language guides on bail, FIR quashing, cybercrime law, and family law in Pune — by criminal defence attorney Adv. Akash Chikate.` |

---

## STEP 3 — Update the Homepage
**Time: 30 minutes | Fixes: Hero copy, trust bar, CTAs, practice area section**

All the copy is pre-written in `copy/homepage-copy.md`. Follow these steps:

### 3a. Update the Hero section
1. Open your homepage in the WordPress editor (Pages → Home → Edit)
2. Find the hero section (the big text at the top)
3. Replace the headline with:
   > **Facing an Arrest, FIR, or Criminal Case in Pune?**
4. Replace the subheadline/body text with:
   > You deserve straight answers — not legal jargon. In 8+ years at the Bombay High Court, I've helped hundreds of individuals and families get bail, quash FIRs, and defend their rights. I'll tell you exactly where you stand.
5. Replace the CTA button text with: **Discuss Your Case — Free & Confidential**
6. Add a secondary line below the button: `📞 Call Now  |  💬 WhatsApp Us`

### 3b. Add a Trust Bar (5 stats below hero)
Add a row of 5 columns immediately below the hero with these stats:

| Number | Label |
|---|---|
| 8+ Years | Courtroom Experience |
| Bombay High Court | Enrolled Advocate |
| 500+ Cases | Successfully Handled |
| 48 hrs | Typical Bail Timeline |
| Free | First Consultation |

### 3c. Update Practice Area Cards
Replace the current service cards text. See `copy/homepage-copy.md` → **PRACTICE AREAS SECTION** for the full copy for each card.

### 3d. Add the Free Resources section
Below the How It Works section, add a section titled **Free Legal Guides** with 4 download cards — see `copy/homepage-copy.md` → **FREE RESOURCES SECTION**.

---

## STEP 4 — Create/Update Practice Area Pages
**Time: 60 minutes | Fixes: SEO content, internal linking, FAQ schema**

Pre-written content is in the `practice-areas/` folder. For each page:

1. Open the page in WordPress editor
2. Replace the content with the content from the `.md` file
3. In RankMath panel: set the SEO title and meta description (from the front matter of each file)
4. Add a featured image (can use Canva — legal/court themed)
5. For FAQ sections: format questions as `### Q: question` and answers as `A: answer` — the plugin auto-extracts these for FAQ schema

### Pages and their source files:
| WordPress Page | Source File |
|---|---|
| `/practice-areas/criminal-law/` | `practice-areas/criminal-law.md` |
| `/practice-areas/cybercrime-it-law/` | `practice-areas/cybercrime.md` |
| `/practice-areas/family-law/` | `practice-areas/family-law.md` |
| `/practice-areas/consumer-court/` | `practice-areas/consumer-court.md` |

> **For Criminal Law page:** You'll need to create a new parent page at `/practice-areas/criminal-law/` and set it as the parent of existing sub-pages.

---

## STEP 5 — Add Location Pages
**Time: 20 minutes per page | Start with 3, add more weekly**

### Create the first new location page (Hinjewadi):
1. **Pages → Add New Page**
2. Title: `Criminal Lawyer in Hinjewadi, Pune — Adv. Akash Chikate`
3. Slug (URL): `criminal-lawyer-hinjewadi-pune`
4. Parent page: Set to `/criminal-lawyer/` (create this as a parent page first if it doesn't exist)
5. Copy the content from `location-pages/hinjewadi.md`
6. In RankMath: set title and meta description from the file's front matter
7. Add the location schema — copy `schema/location-page-schema.json`, replace `AREA_NAME` with `Hinjewadi` and `SLUG` with `hinjewadi`, paste as a **Custom Schema** in RankMath's Schema tab
8. Publish

### Repeat for each location:
Priority order: Hinjewadi → Koregaon Park → Baner → Kothrud → Viman Nagar → (rest weekly)

Content for all 14 locations is in `location-pages/`.

---

## STEP 6 — Publish the Two Pillar Blog Posts
**Time: 20 minutes per post**

### Publish "Complete Guide to Getting Bail in Pune":
1. **Posts → Add New Post**
2. Title: `Complete Guide to Getting Bail in Pune (2026) — Types, Process & Timeline`
3. Copy content from `blog-posts/complete-guide-bail-pune.md`
4. Category: `Criminal Law`
5. Featured image: Court/legal themed image (create in Canva)
6. RankMath meta description: `Everything you need to know about getting bail in Pune — bailable vs non-bailable, Magistrate vs Sessions vs High Court, timeline, costs. By Adv. Akash Chikate.`
7. Add a **lead capture box at the bottom** (see Step 8 for how to set this up)
8. Publish

### Publish "False 498A Case — Your Defence Options":
Same process using `blog-posts/498a-false-case-defence.md`.

---

## STEP 7 — Claim Google Business Profile
**Time: 20 minutes setup + 5 days verification**

This is the single highest-ROI action for local search.

1. Go to: **business.google.com**
2. Search: `Advocate Akash Chikate Shivajinagar Pune`
3. If it appears → click **Claim this business**
   If it doesn't → click **Add your business**
4. Category: **Attorney** (primary)
5. Add address, phone, website, hours
6. Verify by **postcard** (Google sends a card to your office — arrives in 5–7 days, enter the code)

### After verification:
- Upload 10+ photos (office, you in court attire, certificates)
- Add all services (Criminal Law, Bail, FIR Quashing, Family Law, Cybercrime, Consumer Court)
- Write the description using text from `technical/directory-submissions-checklist.md`
- Post your first update (share one blog post)
- Ask 5 clients for a Google review (send them the direct review link from your GBP dashboard)

---

## STEP 8 — Set Up Lead Magnet Downloads
**Time: 45 minutes for all 4**

### For each lead magnet:
1. **Convert to PDF:**
   - Go to canva.com → Create new design → A4 Document
   - Copy the content from the `.md` file in `lead-magnets/`
   - Add your logo, name, and contact details at top and bottom
   - Download as PDF

2. **Upload to WordPress:**
   - Media Library → Add New → upload the PDF
   - Copy the PDF URL

3. **Create a simple landing page:**
   - Pages → Add New
   - Title: e.g. `Download: What to Do in 24 Hours After an FIR`
   - Slug: `fir-24hr-guide`
   - Add a form (using Contact Form 7 or WPForms — both free):
     - Fields: Name + WhatsApp Number
     - On submission: send an email to yourself with the filled details, and redirect to the PDF URL
   - Publish with "noindex" in RankMath (these pages don't need to rank, they just receive traffic from other pages)

4. **Link from relevant pages:**
   - At the bottom of each blog post: add `[Download the free guide: What to Do in 24 Hours After an FIR →]` linking to the landing page
   - On practice area pages: add a lead capture box in the sidebar or at the bottom

### Lead magnet to page mapping:
| File | Where to link from |
|---|---|
| `fir-24hr-checklist.md` | All criminal law pages, homepage |
| `bail-application-checklist.md` | Bail guide blog post, criminal law page |
| `cybercrime-7day-action-plan.md` | Cybercrime page, cybercrime blog posts |
| `divorce-rights-guide.md` | Family law page, divorce blog post |

---

## STEP 9 — Complete Directory Listings
**Time: 15 minutes each | Do in priority order**

Full details in `technical/directory-submissions-checklist.md`.

### This week:
1. **Google Business Profile** (Step 7 above)
2. **LawRato** — lawrato.com/advocate-akash-chikate — log in, complete profile, add photo and all practice areas
3. **Vakil Search** — vakilsearch.com/lawyer-registration

### Next week:
4. **JustDial** — claim/create listing
5. **Lawzana** — already appears in search, complete the profile
6. **xpertslegal.com** — profile exists at the URL in the checklist, claim it

---

## STEP 10 — Start Posting on LinkedIn and Instagram
**Time: 30 minutes/week**

All 30 days of content is pre-written in `social-content/30-day-calendar.md`.

### Set up:
1. Make sure LinkedIn profile is updated with current title: `Criminal Defence Attorney | Bombay High Court | Pune`
2. Switch Instagram to a **Business Account** (Settings → Account → Switch to Professional)
3. Optional: set up **Buffer** (free tier) to schedule posts in advance

### Start posting:
- Week 1, Day 1 post is ready to go — copy from the calendar
- Post at 9am Monday–Friday on LinkedIn
- Post 2x/week on Instagram (Tuesday + Thursday)
- Aim for 2 Instagram Reels/week (film a 30-second legal tip to camera — no production needed)

---

## ONGOING — Monthly Maintenance (30 min/month)

- [ ] Check Google Search Console → fix any crawl errors
- [ ] Publish 1 new blog post (outlines for posts 3–8 are in `blog-posts/remaining-6-posts-outlines.md`)
- [ ] Ask 5 recent clients for a Google review
- [ ] Reply to all Google reviews (positive and negative)
- [ ] Post 4 LinkedIn updates + 2 Instagram posts
- [ ] Check rankings for primary keywords — track in a simple spreadsheet

---

## QUICK REFERENCE — File Index

| What you need | File location |
|---|---|
| Plugin (.zip to install) | `wordpress-plugin/akc-seo-toolkit.zip` |
| Homepage copy | `copy/homepage-copy.md` |
| Practice area pages | `practice-areas/*.md` |
| Location pages | `location-pages/*.md` |
| Blog posts | `blog-posts/*.md` |
| Lead magnets (PDFs to make) | `lead-magnets/*.md` |
| WhatsApp nurture messages | `email-sequences/nurture-sequence.md` |
| Social content | `social-content/30-day-calendar.md` |
| Schema JSON-LD (manual) | `schema/*.json` |
| robots.txt (manual upload) | `technical/robots.txt` |
| Directory checklist | `technical/directory-submissions-checklist.md` |
