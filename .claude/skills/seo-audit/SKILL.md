---
name: seo-audit
description: Perform a comprehensive SEO audit of a website. Use when the user asks to audit, analyze, or check SEO for a URL or domain. Covers technical SEO, on-page factors, performance, structured data, and actionable recommendations.
allowed-tools: WebFetch WebSearch Bash
---

# SEO Audit Skill

You are an expert SEO analyst. When this skill is triggered, perform a thorough SEO audit of the given URL and produce a structured, actionable report.

## How to Run the Audit

1. **Receive the URL** from the user (ask if not provided).
2. **Run the audit script** to collect raw data:
   ```bash
   python3 .claude/skills/seo-audit/scripts/seo_check.py <URL>
   ```
3. **Fetch the live page** with WebFetch to inspect HTML content directly.
4. **Search for additional signals** (e.g., PageSpeed, schema validators) using WebSearch when relevant.
5. **Produce the final report** following the format below.

---

## Audit Categories

### 1. Crawlability & Indexability
- Fetch `<domain>/robots.txt` — check for blocked paths, disallow rules affecting key pages.
- Fetch `<domain>/sitemap.xml` (and any sub-sitemaps) — verify presence, count URLs, check lastmod dates.
- Check for `<meta name="robots">` tags on the page (noindex, nofollow, noarchive).
- Look for canonical tags (`<link rel="canonical">`) — verify they point to the correct URL.
- Note any `X-Robots-Tag` headers if visible.

### 2. Technical SEO
- **HTTPS**: Confirm the page loads over HTTPS. Note if HTTP redirects to HTTPS.
- **Redirect chains**: Note any redirect hops (301, 302) in the URL path.
- **Mobile viewport**: Check for `<meta name="viewport">` tag.
- **Page speed signals**: Look for render-blocking resources, large images (no lazy loading), missing compression hints.
- **Hreflang**: Check for `<link rel="alternate" hreflang="...">` tags if multilingual.
- **Pagination**: Check for `rel="next"` / `rel="prev"` if applicable.

### 3. On-Page Optimization
- **Title tag**: Extract content, check length (50–60 chars ideal), keyword placement, uniqueness signal.
- **Meta description**: Extract content, check length (150–160 chars ideal), CTA presence, keyword inclusion.
- **H1 tag**: Presence (exactly one), content, keyword alignment with title.
- **H2–H6 structure**: Logical heading hierarchy, keyword coverage.
- **Image alt text**: Presence on all `<img>` tags; check for keyword-stuffing or empty alts.
- **Internal links**: Count, anchor text diversity, navigation structure.
- **External links**: Count, rel="nofollow"/"sponsored" usage.
- **URL structure**: Length, keyword inclusion, hyphens vs underscores, special characters.

### 4. Content Quality
- **Word count**: Estimate from visible text.
- **Keyword density**: Identify primary topic; note if it appears in title, H1, first 100 words.
- **Content freshness**: Check for date signals in the HTML (published/modified schema, visible dates).
- **Duplicate content signals**: Canonical usage, thin content flags.
- **Readability**: Sentence/paragraph length, use of lists and formatting.

### 5. Structured Data (Schema.org)
- Extract all JSON-LD `<script type="application/ld+json">` blocks.
- Extract all Microdata and RDFa markup if present.
- Identify schema types (Article, Product, BreadcrumbList, Organization, FAQ, HowTo, etc.).
- Flag missing recommended schemas for the page type.
- Note any validation issues (missing required properties).

### 6. Core Web Vitals & Performance Signals
- Check for lazy loading (`loading="lazy"`) on images.
- Note presence of `<link rel="preload">` hints.
- Check for render-blocking `<script>` tags without `async`/`defer`.
- Identify large unoptimized images (missing `width`/`height` attributes).
- Note use of a CDN (via domain patterns in asset URLs).

### 7. Social & Open Graph
- Check for Open Graph tags (`og:title`, `og:description`, `og:image`, `og:url`).
- Check for Twitter Card tags.
- Verify OG image is present and appropriately sized.

---

## Output Format

Produce the report in this exact structure:

```
# SEO Audit Report: <URL>
Audit Date: <date>

## Executive Summary
<2-3 sentence overview of the site's SEO health, top wins, and critical issues>

## Score: <X>/100
| Category                  | Score | Status |
|---------------------------|-------|--------|
| Crawlability & Indexability | X/15 | ✅/⚠️/❌ |
| Technical SEO             | X/20  | ✅/⚠️/❌ |
| On-Page Optimization      | X/25  | ✅/⚠️/❌ |
| Content Quality           | X/15  | ✅/⚠️/❌ |
| Structured Data           | X/10  | ✅/⚠️/❌ |
| Performance Signals       | X/10  | ✅/⚠️/❌ |
| Social & Open Graph       | X/5   | ✅/⚠️/❌ |

## Critical Issues (Fix Immediately)
- [ ] <Issue> — <Impact> — <Fix>

## Warnings (Fix Soon)
- [ ] <Issue> — <Impact> — <Fix>

## Passed Checks
- ✅ <What's working well>

## Detailed Findings

### 1. Crawlability & Indexability
...

### 2. Technical SEO
...

### 3. On-Page Optimization
**Title Tag**: "<title>" (X chars)
**Meta Description**: "<description>" (X chars)
**H1**: "<h1 text>"
**Heading Structure**: H1 > H2 (X) > H3 (X)
...

### 4. Content Quality
...

### 5. Structured Data
**Schemas Found**: <list>
**Missing Recommended**: <list>
...

### 6. Performance Signals
...

### 7. Social & Open Graph
...

## Top 5 Priority Recommendations
1. **[Priority 1]** <Action> — Expected impact: <High/Medium/Low>
2. **[Priority 2]** <Action> — Expected impact: <High/Medium/Low>
3. **[Priority 3]** <Action> — Expected impact: <High/Medium/Low>
4. **[Priority 4]** <Action> — Expected impact: <High/Medium/Low>
5. **[Priority 5]** <Action> — Expected impact: <High/Medium/Low>
```

---

## Scoring Guide

| Score | Status | Icon |
|-------|--------|------|
| 80–100 | Excellent | ✅ |
| 60–79  | Needs Work | ⚠️ |
| 0–59   | Critical | ❌ |

Deduct points based on severity:
- Missing title or H1: −10 pts each
- No HTTPS: −15 pts
- noindex on important page: −20 pts
- Missing meta description: −5 pts
- No structured data on content pages: −5 pts
- No sitemap: −5 pts
- Missing OG tags: −3 pts

---

## Notes on Tool Usage

- Use **WebFetch** to retrieve the raw HTML of the target URL, robots.txt, and sitemap.xml.
- Use **WebSearch** to find PageSpeed Insights data or schema validation results if helpful.
- Use **Bash** to run `seo_check.py` for structured data extraction and metric computation.
- If BrightData scraping tools are configured, use them for pages behind bot-protection or for competitor analysis.
- Do not guess — if a tag is absent, report it as absent, not as unknown.
