# Site Audit — advocateakashchikate.com
**Date:** July 2026  
**Method:** Google search snippet analysis (direct site access blocked by Cloudflare)

---

## Summary of Findings

| Severity | Count | Description |
|----------|-------|-------------|
| CRITICAL | 1 | Wrong factual content — /bombay-high-court-pune-bench-jurisdiction/ |
| HIGH | 2 | "Pune Bench" language on 3+ pages (no such bench exists) |
| MEDIUM | 3 | Missing year tag, section number to verify, off-brand pages |
| LOW | 4 | FAQ schema gaps, title pattern inconsistency, POCSO title weak |

---

## CRITICAL — Fix Immediately

### 1. /bombay-high-court-pune-bench-jurisdiction/ — Factually Wrong Content

**Problem:** This page claims a "Pune Bench" of the Bombay High Court exists. **No such bench exists.**

The Bombay High Court has four benches:
- Principal Seat: **Mumbai**
- Nagpur Bench
- Aurangabad Bench
- Kolhapur Bench (established August 18, 2025)
- Porvorim Bench (Goa)

Pune is under the **Principal Seat jurisdiction (Mumbai)**. There is no Pune Bench and there never has been. A 2015 Maharashtra government recommendation to establish Pune and Kolhapur benches resulted only in the Kolhapur bench (2025). Pune was not included.

**Why it matters:** A lawyer claiming expertise at a court that doesn't exist is a serious credibility risk. Any client or competitor who notices this loses trust immediately.

**Fix:**
1. Publish the new landing page at `/bombay-high-court-lawyer-pune/` (content ready in repo: `advocateakashchikate/landing-pages/bombay-high-court.md`)
2. In WordPress, set up a 301 redirect: `/bombay-high-court-pune-bench-jurisdiction/` → `/bombay-high-court-lawyer-pune/`
3. If redirect plugin isn't available, delete the old page after confirming the new one is live

A corrected standalone replacement is also in the repo: `advocateakashchikate/landing-pages/bombay-high-court-pune-bench-jurisdiction-CORRECTED.md` — this can temporarily replace the wrong page's content if the redirect takes time to set up.

---

## HIGH — Fix This Week

### 2. "Bombay High Court, Pune Bench" in live page content

**Affected pages:**
- `/how-to-get-anticipatory-bail-pune/` — body text says "Bombay High Court, Pune Bench"
- `/fir-quashing-bombay-high-court-pune/` — body text says "Pune Bench or Mumbai seat"
- Possibly other pages

**Correct language to use:**
- "Bombay High Court (Principal Seat, Mumbai)" — for formal legal accuracy
- "Bombay High Court" — acceptable shorthand when context is clear
- "Bombay High Court in Mumbai" — for client-facing plain language

**Never use:** "Bombay High Court, Pune Bench" — this bench does not exist.

**Fix:** Do a site-wide search in WordPress for "Pune Bench" and replace every instance.

---

### 3. Default bail section number — verify urgently

**Affected page:** `/bail-after-arrest-pune-guide/`  
**Current content:** "Default Bail under Section 187 BNSS (formerly Section 167 CrPC)"  

**Potential conflict:** Other blog posts in the content calendar reference "S.479 BNSS" for default bail. These two section numbers cannot both be correct for the same provision.

**What to check:**
- Open the BNSS text at bnss.gov.in or e-kanoon
- Find the section that says: "if police fail to file chargesheet within 60 days (non-bailable) or 90 days (serious offences), the accused is entitled to bail"
- That section number goes on all pages

The blog post we created at `/blog/default-bail-section-479-bnss-pune/` asserts S.479 BNSS. The live site asserts S.187 BNSS. One of these needs to be corrected.

---

## MEDIUM — Fix Within 30 Days

### 4. /witness-criminal-case-india-rights-obligations/ — No year in title

**Current title:** "Called as a Witness in a Criminal Case in India — Rights & Obligations Guide"  
**Recommended:** "Called as a Witness in a Criminal Case in India — Rights & Obligations (2025)"

All other blog posts include "(2025)." This one is inconsistent. Year tags improve CTR for evergreen guides by signalling freshness.

---

### 5. Off-brand pages dilute criminal defence positioning

**Pages flagged:**
- `/consumer-court-pune-how-to-file-complaint/` — Consumer law has nothing to do with criminal defence. Someone searching this keyword will not need a criminal defence lawyer.
- `/child-custody-after-divorce-pune-family-court/` — Family court content. Somewhat related (498A matters involve family), but the informational angle here ("how family court decides custody") serves the wrong audience for this practice.

**Not flagged:** `/online-fraud-cyber-scam-complaint-pune/` — Cybercrime victims sometimes also need defence counsel; this is borderline acceptable.

**Recommendation:** These pages are likely attracting search traffic but not converting to clients. If the practice genuinely offers consumer and family law services, keep them. If the positioning is "criminal defence specialist," these pages undermine the signal. Consider whether they belong under a separate website or are attracting the right clients in practice.

---

### 6. /free-pocso-defence-guide/ — Title lacks local keyword and year

**Current title:** "Understanding POCSO: A Guide for the Accused and Their Families"  
**Problem:** Generic. No "Pune." No year. Pattern mismatch with all other pages.  
**Recommended:** "POCSO Defence in Pune — A Guide for the Accused and Their Families (2025)"  
**Also:** The URL `/free-pocso-defence-guide/` signals a giveaway/lead magnet but doesn't rank well for "POCSO lawyer Pune" type searches. Consider a separate ranking page `/pocso-lawyer-pune/` and keep this as a content offer.

---

## LOW — Optimise When Time Allows

### 7. FAQ schema — no rich results visible

Searching Google shows snippets but no FAQ accordion rich results for any pages. This suggests either:
- FAQPage schema is not implemented on any blog posts
- Schema is implemented but has validation errors
- Google has chosen not to show it (less likely if schema is valid)

**Recommended action:**
- Install the WordPress plugin (code in repo: `wp-plugins/akc-seo-toolkit/`)
- Use Google's Rich Results Test to verify each page after implementing schema
- Priority pages for FAQPage schema: anticipatory bail, FIR quashing, bail after arrest

### 8. Case results section — minimal schema opportunity

**Current:** `/case-results/murder-conviction-bail-women-co-accused-bhc-db-2025/` exists  
**Gap:** No schema for case results. Add `LegalCase` or `Article` schema with proper datePublished, author, and subject fields.

---

## Full Inventory of Live Pages

### Blog / Informational Posts

| URL | Title | Indexed | Issues |
|-----|-------|---------|--------|
| /how-to-get-anticipatory-bail-pune/ | How to Get Anticipatory Bail in Pune — Step-by-Step Guide 2025 | Yes | "Pune Bench" language in body |
| /fir-quashing-bombay-high-court-pune/ | FIR Quashing at Bombay High Court: Grounds, Process & Cost (2025) | Yes | "Pune Bench" language in body |
| /bail-after-arrest-pune-guide/ | Bail After Arrest in Pune — Types, Process & Timeline (2025) | Yes | Verify S.187 vs S.479 BNSS for default bail |
| /plea-bargaining-india-criminal-case-bnss/ | Plea Bargaining in India — When to Accept vs Fight Your Criminal Case (2025) | Yes | Content appears accurate; no issues found |
| /witness-criminal-case-india-rights-obligations/ | Called as a Witness in a Criminal Case in India — Rights & Obligations Guide | Yes | Missing year in title |
| /bombay-high-court-pune-bench-jurisdiction/ | Unknown | Maybe | **CRITICAL: Wrong content; no Pune Bench exists** |
| /online-fraud-cyber-scam-complaint-pune/ | Online Fraud Victim in Pune? How to File Complaint & Recover Money (2025) | Yes | Borderline off-brand; content appears accurate |
| /consumer-court-pune-how-to-file-complaint/ | How to File a Consumer Court Complaint in Pune — Complete Guide 2025 | Yes | Off-brand for criminal defence |
| /child-custody-after-divorce-pune-family-court/ | Child Custody After Divorce in Pune — How Family Court Decides (2025) | Yes | Off-brand for criminal defence |
| /free-pocso-defence-guide/ | Understanding POCSO: A Guide for the Accused and Their Families | Yes | No year, no "Pune" in title, URL pattern inconsistent |
| /case-results/murder-conviction-bail-women-co-accused-bhc-db-2025/ | Bail Granted for Women Co-Accused in Murder Case | Bombay HC DB 2025 | Yes | Good; add LegalCase schema |

### Practice Area Pages

| URL | Title | Indexed | Issues |
|-----|-------|---------|--------|
| /practice-areas/criminal-defence/ | Criminal Defence Lawyer in Pune | Bombay High Court | Adv. Akash Chikate | Yes | Likely has "Pune Bench" reference — check |
| /practice-areas/bail-application/ | Bail Application Lawyer in Pune | Yes | Verify |
| /practice-areas/family-law-divorce/ | Family Law & Divorce Lawyer Pune | Family Court | Yes | Verify |
| /practice-areas/cheque-bounce-ni-act/ | Cheque Bounce Lawyer Pune | NI Act S.138 | Yes | Verify |
| /practice-areas/intellectual-property/ | (not confirmed) | Yes | IP + criminal defence = unusual combination |
| /criminal-lawyer/criminal-lawyer-aundh-pune/ | Criminal Lawyer in Aundh Pune — Bail, 498A & Criminal Defence | Yes | Local landing page — good strategy |

---

## Content We've Written (Ready to Publish)

These files exist in the repository but are not yet live on the site:

| File | Target URL | Status |
|------|-----------|--------|
| blog-posts/husband-arrested-pune.md | /blog/husband-arrested-pune-what-to-do/ | Ready |
| blog-posts/navara-atak-zala-pune.md | /blog/navara-atak-zala-pune-kay-karave/ | Ready |
| blog-posts/498a-fir-pune.md | /blog/498a-fir-filed-husband-pune/ | Ready |
| blog-posts/fir-quashing-bombay-high-court.md | /blog/fir-quashing-bombay-high-court-pune/ | Ready — note URL differs from live /fir-quashing-bombay-high-court-pune/ |
| blog-posts/ndps-arrest-bail-pune.md | /blog/ndps-arrest-bail-pune/ | Ready |
| blog-posts/bail-rejected-sessions-court-pune.md | /blog/bail-rejected-sessions-court-pune-what-next/ | Ready |
| blog-posts/what-happens-after-fir-pune.md | /blog/what-happens-after-fir-filed-pune/ | Ready |
| blog-posts/default-bail-section-479-bnss-pune.md | /blog/default-bail-section-479-bnss-pune/ | Ready — **verify section number first** |
| blog-posts/business-partner-criminal-complaint-pune.md | /blog/business-partner-criminal-complaint-pune/ | Ready |
| blog-posts/how-to-choose-criminal-lawyer-pune.md | /blog/how-to-choose-criminal-lawyer-pune/ | Ready |
| landing-pages/bombay-high-court.md | /bombay-high-court-lawyer-pune/ | Ready — publish FIRST, then redirect old page |
| landing-pages/nri-fir-india.md | /nri-criminal-lawyer-india-pune/ | Ready |
| landing-pages/atakpurva-jaamin-pune.md | /atakpurva-jaamin-vkil-pune/ | Ready (Marathi) |

**Note on FIR quashing URL:** The live site has `/fir-quashing-bombay-high-court-pune/` (no /blog/ prefix). Our repo file targets `/blog/fir-quashing-bombay-high-court-pune/`. Decide: update our version to replace the existing page, or keep them as separate URLs (old = landing page, new = blog format). Replacing the existing page is probably cleaner.

---

## Action Priority List

### Do Now (same day)
1. Go to WordPress → Redirects and add: `/bombay-high-court-pune-bench-jurisdiction/` → `/bombay-high-court-lawyer-pune/` (301)
2. First publish `/bombay-high-court-lawyer-pune/` with content from repo if not yet live
3. Do site-wide WordPress search for "Pune Bench" and remove every instance

### Do This Week
4. Verify the correct BNSS section number for default bail; update all pages consistently
5. Add "(2025)" to the witness rights page title
6. Run Google Rich Results Test on /how-to-get-anticipatory-bail-pune/ — confirm FAQ schema status

### Do This Month
7. Publish all 10 blog posts from the repo above
8. Publish 3 landing pages (HC, NRI, Marathi)
9. Install akc-seo-toolkit WordPress plugin (schema + OG tags)
10. Decide on consumer court and child custody pages — keep or noindex/redirect

---

## What's NOT an Issue

- All titles include "(2025)" freshness signal (except one)
- Meta descriptions are keyword-rich and under 160 characters
- Pages are being indexed — no crawl/indexing problems detected
- Content depth appears appropriate — no thin content issues visible
- FIR quashing, anticipatory bail, bail after arrest — all appear substantively correct aside from the Pune Bench error
- Plea bargaining page covers BNSS Chapter reference correctly
- Witness rights page has solid BSA/Witness Protection Scheme content
