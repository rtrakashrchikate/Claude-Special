Perform a comprehensive SEO audit for the URL provided as $ARGUMENTS (ask the user for a URL if none was given).

Follow these steps in order:

## Step 1 — Collect raw data

Run the audit script to extract structured SEO signals:
```bash
python3 .claude/skills/seo-audit/scripts/seo_check.py $ARGUMENTS
```

Also fetch the live page HTML with WebFetch so you can inspect its content directly.

## Step 2 — Audit all seven categories

### 1. Crawlability & Indexability
- robots.txt: present, disallow rules, sitemap pointer
- sitemap.xml: present, URL count, lastmod freshness
- `<meta name="robots">` tag: noindex, nofollow flags
- Canonical tag: present, absolute URL, points to correct version

### 2. Technical SEO
- HTTPS: is page served over HTTPS?
- Redirect chain: any hops before reaching the page?
- Mobile viewport meta tag: present?
- Hreflang: present and well-formed for multilingual sites?
- HTTP response code: 200, 301, 404, 500?

### 3. On-Page Optimization
- Title tag: text, length (50–60 chars ideal), keyword first
- Meta description: text, length (150–160 chars ideal), includes CTA
- H1: exactly one, matches intent, keyword present
- H2–H6: logical hierarchy, keyword coverage
- Image alt text: all images covered, no keyword stuffing
- URL: short, keyword-rich, hyphens not underscores
- Internal links: count, anchor text diversity

### 4. Content Quality
- Estimated word count
- Primary keyword present in title, H1, first 100 words?
- Content freshness signals (visible dates, schema dateModified)
- Readability: use of lists, short paragraphs, subheadings

### 5. Structured Data (Schema.org)
- All JSON-LD blocks: list types found
- Microdata / RDFa if present
- Missing recommended schema for page type (Article, Product, FAQ, BreadcrumbList, etc.)
- Required properties present?

### 6. Performance Signals
- Render-blocking `<script>` tags without async/defer
- Images missing `loading="lazy"`
- Images missing width/height attributes
- `<link rel="preload">` hints present?
- CDN usage visible in asset URLs?

### 7. Social & Open Graph
- og:title, og:description, og:image, og:url present?
- Twitter Card tags present?
- OG image URL valid?

## Step 3 — Score the page (out of 100)

Use the scoring table from the script output as the base, then apply your judgment for issues the script cannot detect (content quality, keyword relevance, heading hierarchy logic).

| Category | Max Points |
|---|---|
| Crawlability & Indexability | 15 |
| Technical SEO | 20 |
| On-Page Optimization | 25 |
| Content Quality | 15 |
| Structured Data | 10 |
| Performance Signals | 10 |
| Social & Open Graph | 5 |

## Step 4 — Output the report

```
# SEO Audit Report: <URL>
Audit Date: <today>

## Executive Summary
<2-3 sentence overview: overall health, top win, critical issue>

## Score: <X>/100
| Category | Score | Status |
|---|---|---|
| Crawlability & Indexability | X/15 | ✅ / ⚠️ / ❌ |
| Technical SEO | X/20 | ✅ / ⚠️ / ❌ |
| On-Page Optimization | X/25 | ✅ / ⚠️ / ❌ |
| Content Quality | X/15 | ✅ / ⚠️ / ❌ |
| Structured Data | X/10 | ✅ / ⚠️ / ❌ |
| Performance Signals | X/10 | ✅ / ⚠️ / ❌ |
| Social & Open Graph | X/5 | ✅ / ⚠️ / ❌ |

## Critical Issues (Fix Immediately)
- [ ] <Issue> — <Why it matters> — <How to fix>

## Warnings (Fix Soon)
- [ ] <Issue> — <Why it matters> — <How to fix>

## Passed Checks
- ✅ <What is working well>

## Detailed Findings

### 1. Crawlability & Indexability
...

### 2. Technical SEO
...

### 3. On-Page Optimization
**Title:** "<text>" (<N> chars)
**Meta Description:** "<text>" (<N> chars)
**H1:** "<text>"
**Heading structure:** H1 × 1 → H2 × N → H3 × N
...

### 4. Content Quality
**Estimated word count:** N
...

### 5. Structured Data
**Types found:** <list>
**Missing recommended schemas:** <list>
...

### 6. Performance Signals
...

### 7. Social & Open Graph
...

## Top 5 Priority Actions
1. **<Action>** — Impact: High/Medium/Low
2. **<Action>** — Impact: High/Medium/Low
3. **<Action>** — Impact: High/Medium/Low
4. **<Action>** — Impact: High/Medium/Low
5. **<Action>** — Impact: High/Medium/Low
```

Use ✅ for scores ≥ 80 %, ⚠️ for 60–79 %, ❌ for < 60 % of the category max.
Consult `.claude/skills/seo-audit/references/REFERENCE.md` for scoring thresholds, schema type tables, and best-practice benchmarks.
