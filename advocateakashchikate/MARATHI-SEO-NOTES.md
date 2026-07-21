# Marathi Content — WordPress Implementation Notes

## Pages Created

| File | URL Slug | Language |
|------|----------|----------|
| blog-posts/navara-atak-zala-pune.md | /blog/navara-atak-zala-pune-kay-karave/ | Marathi (mr) |
| landing-pages/atakpurva-jaamin-pune.md | /atakpurva-jaamin-vkil-pune/ | Marathi + bilingual title |

---

## WordPress Setup for Marathi Pages

### Option A: Single-language site with Marathi pages (Simpler — Recommended to start)

Create these as regular WordPress pages/posts. In RankMath:
- Set the language to Marathi in the "Advanced" tab if the option is available
- Add the `<html lang="mr">` attribute — RankMath or Yoast can do this per-page

In the page content:
- Use Marathi text as-is (Devanagari script renders correctly in WordPress)
- The URL slug should be transliterated Roman (already done above) — Devanagari in URLs is supported by Google but Roman transliteration is more copy-pasteable for WhatsApp sharing

### Option B: Multilingual plugin (WPML or Polylang — more complete)

If you want proper hreflang tags linking English and Marathi versions:
1. Install WPML (paid) or Polylang (free)
2. Set English as primary language, add Marathi (mr-IN)
3. Link the Marathi "navara-atak-zala-pune" post to the English "husband-arrested-pune" post as a translation pair
4. The plugin automatically adds: `<link rel="alternate" hreflang="mr" href="...marathi-url...">` and `<link rel="alternate" hreflang="en" href="...english-url...">`

**For now:** Start with Option A. It gets the pages live and indexable immediately. Upgrade to Option B when you have 5+ Marathi pages.

---

## RankMath Settings for Marathi Pages

For the Marathi blog post (`navara-atak-zala-pune`):
- **SEO Title:** नवरा अटक झाला पुणे — काय करावे? | अॅड. आकाश चिकटे
- **Meta Description:** पुण्यात नवरा अटक झाला आहे? पहिल्या २४ तासात काय करावे, कोणाला फोन करावा, जामीन कसा मिळतो — सोप्या भाषेत मार्गदर्शन.
- **Focus Keyword:** नवरा अटक झाला पुणे काय करावे
- **Schema:** BlogPosting + FAQ (the guide has a checklist that can be FAQ-tagged)

For the anticipatory bail landing page (`atakpurva-jaamin-pune`):
- **SEO Title:** अटकपूर्व जामीन वकील पुणे | अॅड. आकाश चिकटे | Anticipatory Bail Pune
- **Meta Description:** पुण्यात अटकपूर्व जामीन (Anticipatory Bail) हवा आहे? अॅड. आकाश चिकटे — मुंबई उच्च न्यायालय, शिवाजीनगर पुणे. आत्ता फोन करा.
- **Focus Keyword:** अटकपूर्व जामीन वकील पुणे
- **Schema:** LegalService + FAQPage

---

## Target Marathi Keywords (No Competitor Has These)

| Keyword (Marathi) | Transliteration | Intent |
|-------------------|----------------|--------|
| नवरा अटक झाला पुणे | navara atak zala pune | Emergency (Persona B) |
| अटकपूर्व जामीन वकील पुणे | atakpurva jaamin vakil pune | High intent bail |
| जामीन वकील पुणे | jaamin vakil pune | High volume bail |
| गुन्हेगारी वकील पुणे | gunhegari vakil pune | General criminal |
| FIR कशी रद्द होते | FIR kashi radd hote | FIR quashing |
| खोटी FIR काय करावे | khoti FIR kay karave | False FIR |
| जामीन कसा मिळतो | jaamin kasa milato | Informational |
| अटकेपासून संरक्षण | atakepasun sanrakshan | Anticipatory bail |

---

## Future Marathi Content to Add (Priority Order)

1. **FIR रद्दबातल कशी होते?** (/marathi/fir-quashing-pune/) — FIR quashing in Marathi
2. **चेक बाऊंस प्रकरण — काय करावे?** (/marathi/cheque-bounce-pune/) — Cheque bounce
3. **४९८अ खटल्यात जामीन मिळतो का?** (/marathi/498a-jaamin-pune/) — 498A bail
4. **NDPS प्रकरणात काय होते?** — NDPS Act explanation in Marathi
5. **मुंबई उच्च न्यायालयात जामीन** — HC bail in Marathi

---

## Why Marathi Content Matters

Google detects page language from content. A page written in Marathi ranks for Marathi queries. The people searching "नवरा अटक झाला पुणे" at midnight on their phone are Segment 2 clients in peak distress — the highest-conversion moment in the entire funnel. No competitor is there. These two pages fill that gap entirely.
