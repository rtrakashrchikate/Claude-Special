# WordPress Upload Checklist
# advocateakashchikate.com — All New Pages & Posts

Do these in order. Each row = one WordPress page or post.
All content files are ready to paste — open the source file, select all, copy, paste into WordPress.

---

## BEFORE YOU START — One-Time Setup

- [ ] Plugin installed: upload `wordpress-plugin/akc-seo-toolkit.zip` → Plugins → Add New → Upload
- [ ] Plugin configured: Settings → AKC SEO → fill in phone, WhatsApp, OG image URL → Save
- [ ] RankMath installed and setup wizard completed
- [ ] Google Search Console connected to RankMath
- [ ] Sitemap submitted in Search Console (`yourdomain.com/sitemap_index.xml`)
- [ ] Parent page `/criminal-lawyer/` created (blank page, slug: `criminal-lawyer`, parent: none)

---

## PART 1 — Location Pages (11 pages)

All go under: **Parent page = `/criminal-lawyer/`**
In WordPress: Pages → Add New → paste content → set Parent → set RankMath SEO Title + Meta Description → Publish

| # | WordPress Slug | RankMath SEO Title | Meta Description | Source File |
|---|---|---|---|---|
| 1 | `criminal-lawyer-baner-pune` | Criminal Lawyer in Baner Pune \| Bail & FIR \| Adv. Akash Chikate | Criminal lawyer in Baner, Pune — Adv. Akash Chikate. Bail, FIR quashing, cybercrime, family law. Bombay High Court enrolled. Free consultation. | `location-pages/baner.md` |
| 2 | `criminal-lawyer-kothrud-pune` | Criminal Lawyer in Kothrud Pune \| Family Law & Bail \| Adv. Akash Chikate | Criminal & family lawyer in Kothrud, Pune. Divorce, domestic violence, bail, cheque bounce — Adv. Akash Chikate. Bombay HC enrolled. Free consultation. | `location-pages/kothrud.md` |
| 3 | `criminal-lawyer-wakad-pune` | Criminal Lawyer in Wakad Pune \| Bail & Cybercrime \| Adv. Akash Chikate | Criminal lawyer in Wakad, Pune. Bail, cybercrime FIR, FIR quashing — Adv. Akash Chikate, Bombay High Court. Free confidential consultation. | `location-pages/wakad.md` |
| 4 | `criminal-lawyer-viman-nagar-pune` | Criminal Lawyer in Viman Nagar Pune \| NRI & Expat \| Adv. Akash Chikate | Criminal lawyer in Viman Nagar, Pune. NRI matters, bail, passport impoundment, cybercrime — Adv. Akash Chikate. Free consultation. | `location-pages/viman-nagar.md` |
| 5 | `criminal-lawyer-hadapsar-pune` | Criminal Lawyer in Hadapsar Pune \| Industrial & Bail \| Adv. Akash Chikate | Criminal lawyer in Hadapsar, Pune. Bail, cheque bounce, industrial criminal matters — Adv. Akash Chikate. Bombay HC enrolled. Free consultation. | `location-pages/hadapsar.md` |
| 6 | `criminal-lawyer-kondhwa-pune` | Criminal Lawyer in Kondhwa Pune \| Family Law & Bail \| Adv. Akash Chikate | Criminal and family lawyer in Kondhwa, Pune. Bail, divorce, domestic violence, 498A — Adv. Akash Chikate. Free consultation. | `location-pages/kondhwa.md` |
| 7 | `criminal-lawyer-pimpri-pune` | Criminal Lawyer in Pimpri Pune \| Industrial & NDPS \| Adv. Akash Chikate | Criminal lawyer in Pimpri, Pune. NDPS bail, industrial criminal matters, cheque bounce — Adv. Akash Chikate. Free consultation. | `location-pages/pimpri.md` |
| 8 | `criminal-lawyer-chinchwad-pune` | Criminal Lawyer in Chinchwad Pune \| Auto Sector & Bail \| Adv. Akash Chikate | Criminal lawyer in Chinchwad, Pune. Auto sector criminal matters, bail, cheque bounce — Adv. Akash Chikate, 8+ years. Free consultation. | `location-pages/chinchwad.md` |
| 9 | `criminal-lawyer-kalyani-nagar-pune` | Criminal Lawyer in Kalyani Nagar Pune \| White-Collar & Bail \| Adv. Akash Chikate | Criminal lawyer in Kalyani Nagar, Pune. White-collar crime, cybercrime, bail — Adv. Akash Chikate, Bombay High Court. Free consultation. | `location-pages/kalyani-nagar.md` |
| 10 | `criminal-lawyer-yerawada-pune` | Criminal Lawyer near Yerawada Pune \| Bail & Prison Matters \| Adv. Akash Chikate | Criminal lawyer near Yerawada, Pune. Bail for undertrials, parole, criminal appeals — Adv. Akash Chikate. Bombay HC enrolled. Free consultation. | `location-pages/yerawada.md` |
| 11 | `criminal-lawyer-warje-pune` | Criminal Lawyer in Warje Pune \| Family Law & Bail \| Adv. Akash Chikate | Criminal and family lawyer in Warje, Pune. Bail, divorce, domestic violence — Adv. Akash Chikate. Bombay HC enrolled. Free consultation. | `location-pages/warje.md` |

**Already live (done in a previous session):**
- ✅ `criminal-lawyer-hinjewadi-pune` → `location-pages/hinjewadi.md`
- ✅ `criminal-lawyer-koregaon-park-pune` → `location-pages/koregaon-park.md`
- ✅ `criminal-lawyer-aundh-pune` → `location-pages/aundh.md`

### How to add Location Schema via RankMath (for each location page):
1. Open the page in WordPress editor
2. RankMath panel → **Schema** tab → **Add New Schema** → **Custom**
3. Open `schema/location-page-schema.json`
4. Replace `AREA_NAME` with the suburb name (e.g., `Baner`)
5. Replace `SLUG` with the page slug (e.g., `criminal-lawyer-baner-pune`)
6. Paste the JSON → Save

---

## PART 2 — Blog Posts (6 new posts)

In WordPress: Posts → Add New → paste content → set Category → set Featured Image → RankMath SEO Title + Meta → Publish

| # | Category | RankMath SEO Title | Meta Description | Source File |
|---|---|---|---|---|
| 3 | Cybercrime | Cybercrime FIR in Pune: What You Must Do in the First 24 Hours (2026) | Received a cybercrime FIR or notice in Pune? Step-by-step guide for the first 24 hours — do's, don'ts, and when to call a lawyer. By Adv. Akash Chikate. | `blog-posts/cybercrime-fir-pune-24hrs.md` |
| 4 | Family Law | Divorce Process in Pune: Timeline, Courts & What to Expect (2026) | Complete guide to divorce in Pune — mutual consent vs contested, Family Court process, timeline, maintenance, custody. By Adv. Akash Chikate. | `blog-posts/divorce-process-pune.md` |
| 5 | Criminal Law | NDPS Act in Pune: Bail, Section 37, and Your Defence Options (2026) | Arrested under NDPS Act in Pune? Section 37 bail explained, defence options, key judgments. Adv. Akash Chikate — Bombay HC. Free consultation. | `blog-posts/ndps-act-bail-defence-pune.md` |
| 6 | Criminal Law | Cheque Bounce Case in Pune (NI Act S.138): Complete Guide for 2026 | Cheque bounce case in Pune — filed against you or need to file one? NI Act S.138 process, bail, compounding, defences. Adv. Akash Chikate. Free consultation. | `blog-posts/cheque-bounce-case-pune.md` |
| 7 | Consumer Law | How to File a Consumer Court Complaint in Pune (2026) — Step-by-Step | File a consumer complaint in Pune against builder, bank, or company. Step-by-step guide to CDRC Pune. By Adv. Akash Chikate. Free consultation. | `blog-posts/consumer-court-complaint-pune.md` |
| 8 | Criminal Law | Anticipatory Bail in Pune: When to Apply, How It Works & Timeline (2026) | Anticipatory bail in Pune — when you need it, how to apply, what conditions courts impose. Adv. Akash Chikate, Bombay HC. Free consultation. | `blog-posts/anticipatory-bail-pune.md` |

**Already live:**
- ✅ Post 1: `blog-posts/complete-guide-bail-pune.md`
- ✅ Post 2: `blog-posts/498a-false-case-defence.md`

### Blog post checklist (repeat for each):
- [ ] Paste content from source `.md` file
- [ ] Set the URL slug to match the `url:` field in the file's front matter
- [ ] Set RankMath Focus Keyword (first keyword in title)
- [ ] Add featured image (Canva — court/legal themed, 1200×628px)
- [ ] Add internal links: link to relevant practice area page and 1-2 other blog posts
- [ ] Add lead magnet CTA box at bottom (see STEP-BY-STEP-GUIDE.md Step 8)
- [ ] Publish

---

## PART 3 — RankMath Title Fixes (4 pages, titles too long)

These existing pages have titles Google truncates on mobile. Edit in RankMath per page.

| Page | Current Title (chars) | Fix To |
|---|---|---|
| Homepage | Criminal Lawyer in Pune \| Bail & FIR Quashing \| Adv. Akash Chikate (68) | `Criminal Lawyer Pune \| Bail & FIR Quashing \| Akash Chikate` (60) |
| About | About Adv. Akash Chikate \| Criminal Lawyer Pune \| 8+ Years Experience (70) | `About Adv. Akash Chikate \| Criminal Lawyer Pune` (50) |
| Criminal Defence | Criminal Defence Lawyer in Pune \| Bombay High Court \| Adv. Akash Chikate (73) | `Criminal Defence Lawyer Pune \| Bombay HC \| Akash Chikate` (58) |
| IP Law | Intellectual Property Lawyer Pune \| Trademark \| Copyright \| Adv. Akash Chikate (80) | `IP & Trademark Lawyer Pune \| Adv. Akash Chikate` (50) |

---

## PART 4 — Remaining Manual Steps

| Step | Action | Est. Time |
|---|---|---|
| Google Business Profile | Claim/create at business.google.com, verify by postcard | 20 min + 5 days |
| LawRato profile | lawrato.com → log in → complete profile + photo | 15 min |
| Vakil Search | vakilsearch.com/lawyer-registration | 15 min |
| JustDial | Claim/create listing | 15 min |
| Lead magnets | Convert 4 `.md` files to PDF in Canva, upload to WordPress, create landing pages | 45 min |
| LinkedIn posts | Copy from `social-content/30-day-calendar.md`, post weekdays | 5 min/day |

---

## QUICK REFERENCE — All Source Files

| Deliverable | Location |
|---|---|
| Plugin (.zip) | `wordpress-plugin/akc-seo-toolkit.zip` |
| Homepage copy | `copy/homepage-copy.md` |
| Practice area pages | `practice-areas/*.md` (4 files) |
| Location pages (14 total) | `location-pages/*.md` |
| Blog posts (8 total) | `blog-posts/*.md` |
| Lead magnets | `lead-magnets/*.md` (4 files) |
| WhatsApp nurture | `email-sequences/nurture-sequence.md` |
| Social content | `social-content/30-day-calendar.md` |
| Schema JSON-LD | `schema/*.json` |
| robots.txt (manual) | `technical/robots.txt` |
| Directory checklist | `technical/directory-submissions-checklist.md` |
