# SEO Audit — Reference Guide

## Title Tag Guidelines
| Situation | Recommendation |
|-----------|---------------|
| Length | 50–60 chars (Google truncates ~60 chars) |
| Format | Primary Keyword – Brand Name |
| Uniqueness | Must be unique across all pages |
| Missing | Critical issue; page gets no title in SERPs |

## Meta Description Guidelines
| Situation | Recommendation |
|-----------|---------------|
| Length | 150–160 chars (mobile: ~120 chars) |
| Content | Include target keyword + CTA |
| Uniqueness | Unique per page |
| Missing | Google may auto-generate from page content |

## HTTP Status Codes
| Code | SEO Meaning |
|------|-------------|
| 200 | OK — page is indexable |
| 301 | Permanent redirect — passes ~99% link equity |
| 302 | Temporary redirect — passes less link equity |
| 404 | Not Found — remove from sitemap |
| 410 | Gone — tells Google page is permanently removed |
| 500 | Server error — temporarily drops from index |

## Robots.txt Directives
| Directive | Meaning |
|-----------|---------|
| `Disallow: /` | Blocks all crawlers from entire site |
| `Disallow: /admin/` | Blocks `/admin/` path |
| `Allow: /` | Explicitly allows path (overrides disallow) |
| `Sitemap:` | Points to sitemap location |
| `Crawl-delay:` | Asks crawlers to wait N seconds between requests |

## Robots Meta Tag Values
| Value | Meaning |
|-------|---------|
| `index` | Allow indexing (default) |
| `noindex` | Do not index this page |
| `follow` | Follow links on this page (default) |
| `nofollow` | Do not follow links |
| `noarchive` | Do not cache the page |
| `nosnippet` | No snippet in search results |

## Core Web Vitals Thresholds (2024)
| Metric | Good | Needs Improvement | Poor |
|--------|------|------------------|------|
| LCP (Largest Contentful Paint) | ≤ 2.5s | 2.5s–4s | > 4s |
| INP (Interaction to Next Paint) | ≤ 200ms | 200–500ms | > 500ms |
| CLS (Cumulative Layout Shift) | ≤ 0.1 | 0.1–0.25 | > 0.25 |

## Schema.org Types by Page Type
| Page Type | Recommended Schemas |
|-----------|-------------------|
| Homepage | Organization, WebSite, SearchAction |
| Blog post | Article, BlogPosting, BreadcrumbList |
| Product page | Product, Offer, AggregateRating |
| FAQ page | FAQPage, Question, Answer |
| Local business | LocalBusiness, PostalAddress, GeoCoordinates |
| Event | Event, Place, Offer |
| Recipe | Recipe, NutritionInformation |
| How-to | HowTo, HowToStep |
| Review | Review, Rating, ItemReviewed |

## Open Graph Required Tags
| Tag | Purpose |
|-----|---------|
| `og:title` | Title shown when shared |
| `og:description` | Description shown when shared |
| `og:image` | Image shown (min 1200×630px recommended) |
| `og:url` | Canonical URL for the shared page |
| `og:type` | Content type (website, article, product, etc.) |

## Common SEO Issues by Impact
| Issue | Impact | Effort to Fix |
|-------|--------|--------------|
| No HTTPS | High | Medium |
| noindex on key pages | Critical | Low |
| Missing title tags | High | Low |
| Duplicate title tags | High | Medium |
| Missing H1 | High | Low |
| Multiple H1s | Medium | Low |
| Missing meta descriptions | Medium | Low |
| No sitemap | Medium | Low |
| Missing canonical tags | Medium | Low |
| Images without alt text | Low–Medium | Medium |
| Slow page speed | High | High |
| No structured data | Medium | High |
| Missing Open Graph | Low | Low |

## Word Count Benchmarks
| Content Type | Recommended Length |
|-------------|-------------------|
| Homepage | 300–500 words |
| Blog post (informational) | 1,500–2,500 words |
| Product page | 300–1,000 words |
| Category page | 200–500 words |
| FAQ page | 500–1,500 words |
| Landing page | 500–1,500 words |

## Canonical Tag Rules
1. Self-referencing canonical is always recommended.
2. Canonical must be an absolute URL (not relative).
3. Only one canonical per page.
4. Canonical chain (canonical pointing to another canonical) should be avoided.
5. Canonical must match the primary version served to Googlebot.

## Hreflang Implementation Checklist
- [ ] Each page links to all language/region variants including itself.
- [ ] x-default is set for the fallback page.
- [ ] hreflang values use valid BCP 47 language codes (e.g., `en-US`, `fr-FR`).
- [ ] Each linked URL also reciprocates with hreflang back.
- [ ] Sitemap includes hreflang annotations OR hreflang is in the HTML `<head>`.
