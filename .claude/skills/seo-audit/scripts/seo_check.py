#!/usr/bin/env python3
"""
SEO audit helper: fetches a URL and extracts structured SEO signals.
Usage: python3 seo_check.py <url>
Outputs JSON to stdout.
"""

import sys
import json
import re
import urllib.request
import urllib.error
import urllib.parse
from html.parser import HTMLParser


class SEOParser(HTMLParser):
    def __init__(self):
        super().__init__()
        self.title = ""
        self.meta = {}
        self.headings = {"h1": [], "h2": [], "h3": [], "h4": [], "h5": [], "h6": []}
        self.links = {"internal": [], "external": [], "nofollow": []}
        self.images = {"total": 0, "missing_alt": 0, "missing_dimensions": 0}
        self.canonical = None
        self.robots_meta = None
        self.viewport = None
        self.json_ld = []
        self.og_tags = {}
        self.twitter_tags = {}
        self.hreflang = []
        self.preload_hints = []
        self.scripts = {"blocking": 0, "async_defer": 0}
        self._in_title = False
        self._in_heading = None
        self._in_script = False
        self._script_type = ""
        self._script_buf = []
        self._current_text = []
        self._base_domain = ""
        self._visible_text = []
        self._in_body = False

    def handle_starttag(self, tag, attrs):
        attrs = dict(attrs)

        if tag == "title":
            self._in_title = True

        elif tag in self.headings:
            self._in_heading = tag
            self._current_text = []

        elif tag == "meta":
            name = attrs.get("name", "").lower()
            prop = attrs.get("property", "").lower()
            content = attrs.get("content", "")
            if name == "description":
                self.meta["description"] = content
            elif name == "robots":
                self.robots_meta = content
            elif name == "viewport":
                self.viewport = content
            elif name == "keywords":
                self.meta["keywords"] = content
            elif prop.startswith("og:"):
                self.og_tags[prop] = content
            elif name.startswith("twitter:"):
                self.twitter_tags[name] = content

        elif tag == "link":
            rel = attrs.get("rel", "").lower()
            href = attrs.get("href", "")
            if rel == "canonical":
                self.canonical = href
            elif rel == "alternate" and attrs.get("hreflang"):
                self.hreflang.append({"hreflang": attrs.get("hreflang"), "href": href})
            elif rel == "preload":
                self.preload_hints.append({"href": href, "as": attrs.get("as", "")})

        elif tag == "a":
            href = attrs.get("href", "")
            rel = attrs.get("rel", "")
            if href and not href.startswith(("#", "mailto:", "tel:", "javascript:")):
                parsed = urllib.parse.urlparse(href)
                if parsed.netloc and parsed.netloc != self._base_domain:
                    self.links["external"].append(href)
                    if "nofollow" in rel or "sponsored" in rel:
                        self.links["nofollow"].append(href)
                elif href:
                    self.links["internal"].append(href)

        elif tag == "img":
            self.images["total"] += 1
            if not attrs.get("alt") and attrs.get("alt") != "":
                self.images["missing_alt"] += 1
            if not attrs.get("width") or not attrs.get("height"):
                self.images["missing_dimensions"] += 1

        elif tag == "script":
            self._in_script = True
            self._script_type = attrs.get("type", "")
            self._script_buf = []
            src = attrs.get("src", "")
            if src:
                has_async = "async" in attrs
                has_defer = "defer" in attrs
                if has_async or has_defer:
                    self.scripts["async_defer"] += 1
                else:
                    self.scripts["blocking"] += 1

        elif tag == "body":
            self._in_body = True

    def handle_endtag(self, tag):
        if tag == "title":
            self._in_title = False

        elif tag in self.headings and self._in_heading == tag:
            text = "".join(self._current_text).strip()
            if text:
                self.headings[tag].append(text)
            self._in_heading = None
            self._current_text = []

        elif tag == "script":
            self._in_script = False
            if self._script_type == "application/ld+json":
                raw = "".join(self._script_buf).strip()
                if raw:
                    try:
                        self.json_ld.append(json.loads(raw))
                    except json.JSONDecodeError:
                        self.json_ld.append({"_raw": raw, "_error": "parse_failed"})
            self._script_buf = []

    def handle_data(self, data):
        if self._in_title:
            self.title += data

        elif self._in_heading:
            self._current_text.append(data)

        elif self._in_script:
            self._script_buf.append(data)

        elif self._in_body and data.strip():
            self._visible_text.append(data.strip())


def fetch_url(url, timeout=10):
    req = urllib.request.Request(
        url,
        headers={"User-Agent": "Mozilla/5.0 (compatible; SEO-Audit-Skill/1.0)"},
    )
    try:
        with urllib.request.urlopen(req, timeout=timeout) as resp:
            return resp.read().decode("utf-8", errors="replace"), resp.status, dict(resp.headers)
    except urllib.error.HTTPError as e:
        return "", e.code, {}
    except Exception as e:
        return "", 0, {"_error": str(e)}


def check_robots(domain):
    url = f"{domain}/robots.txt"
    body, status, _ = fetch_url(url)
    return {"url": url, "status": status, "present": status == 200, "content_preview": body[:500] if body else ""}


def check_sitemap(domain):
    url = f"{domain}/sitemap.xml"
    body, status, _ = fetch_url(url)
    count = body.count("<url>") if body else 0
    return {"url": url, "status": status, "present": status == 200, "url_count": count}


def word_count(texts):
    combined = " ".join(texts)
    return len(re.findall(r"\w+", combined))


def audit(url):
    parsed = urllib.parse.urlparse(url)
    domain = f"{parsed.scheme}://{parsed.netloc}"

    body, status, headers = fetch_url(url)

    parser = SEOParser()
    parser._base_domain = parsed.netloc
    if body:
        parser.feed(body)

    title = parser.title.strip()
    meta_desc = parser.meta.get("description", "")
    h1s = parser.headings["h1"]

    result = {
        "url": url,
        "status_code": status,
        "https": url.startswith("https://"),
        "title": {
            "text": title,
            "length": len(title),
            "present": bool(title),
            "length_ok": 10 <= len(title) <= 70,
        },
        "meta_description": {
            "text": meta_desc,
            "length": len(meta_desc),
            "present": bool(meta_desc),
            "length_ok": 50 <= len(meta_desc) <= 165,
        },
        "h1": {
            "count": len(h1s),
            "texts": h1s,
            "present": len(h1s) > 0,
            "single": len(h1s) == 1,
        },
        "headings": {k: v for k, v in parser.headings.items()},
        "canonical": parser.canonical,
        "robots_meta": parser.robots_meta,
        "viewport": parser.viewport,
        "images": parser.images,
        "links": {
            "internal_count": len(parser.links["internal"]),
            "external_count": len(parser.links["external"]),
            "nofollow_count": len(parser.links["nofollow"]),
        },
        "structured_data": {
            "json_ld": parser.json_ld,
            "schema_types": list({
                item.get("@type", item.get("@graph", [{}])[0].get("@type", "unknown"))
                if isinstance(item, dict) else "unknown"
                for item in parser.json_ld
            }),
        },
        "open_graph": parser.og_tags,
        "twitter_card": parser.twitter_tags,
        "hreflang": parser.hreflang,
        "performance": {
            "blocking_scripts": parser.scripts["blocking"],
            "async_defer_scripts": parser.scripts["async_defer"],
            "preload_hints": len(parser.preload_hints),
            "lazy_load_images": body.count('loading="lazy"') + body.count("loading='lazy'"),
        },
        "robots_txt": check_robots(domain),
        "sitemap": check_sitemap(domain),
        "word_count": word_count(parser._visible_text),
        "content_headers": headers.get("Content-Type", ""),
    }

    # Compute score
    score = 100
    issues = []
    warnings = []
    passed = []

    if not result["https"]:
        score -= 15
        issues.append("Page not served over HTTPS")
    else:
        passed.append("HTTPS enabled")

    if not result["title"]["present"]:
        score -= 10
        issues.append("Missing <title> tag")
    elif not result["title"]["length_ok"]:
        score -= 3
        warnings.append(f"Title length {result['title']['length']} chars (ideal: 10–70)")
    else:
        passed.append(f"Title tag present ({result['title']['length']} chars)")

    if not result["meta_description"]["present"]:
        score -= 5
        warnings.append("Missing meta description")
    elif not result["meta_description"]["length_ok"]:
        score -= 2
        warnings.append(f"Meta description length {result['meta_description']['length']} chars (ideal: 50–165)")
    else:
        passed.append(f"Meta description present ({result['meta_description']['length']} chars)")

    if not result["h1"]["present"]:
        score -= 10
        issues.append("Missing H1 tag")
    elif not result["h1"]["single"]:
        score -= 5
        warnings.append(f"Multiple H1 tags found ({result['h1']['count']})")
    else:
        passed.append("Single H1 tag present")

    if result["robots_meta"] and "noindex" in result["robots_meta"].lower():
        score -= 20
        issues.append("Page has noindex robots meta — will not be indexed")

    if not result["robots_txt"]["present"]:
        score -= 5
        warnings.append("No robots.txt found")
    else:
        passed.append("robots.txt present")

    if not result["sitemap"]["present"]:
        score -= 5
        warnings.append("No sitemap.xml found")
    else:
        passed.append(f"sitemap.xml present ({result['sitemap']['url_count']} URLs)")

    if not result["canonical"]:
        score -= 3
        warnings.append("No canonical tag — duplicate content risk")
    else:
        passed.append("Canonical tag present")

    if not result["viewport"]:
        score -= 5
        warnings.append("Missing viewport meta tag — may not be mobile-friendly")
    else:
        passed.append("Viewport meta tag present")

    if not result["structured_data"]["json_ld"]:
        score -= 5
        warnings.append("No JSON-LD structured data found")
    else:
        passed.append(f"Structured data found: {result['structured_data']['schema_types']}")

    if not result["open_graph"].get("og:title"):
        score -= 3
        warnings.append("Missing og:title — poor social sharing preview")
    else:
        passed.append("Open Graph tags present")

    if result["images"]["total"] > 0 and result["images"]["missing_alt"] > 0:
        score -= min(5, result["images"]["missing_alt"])
        warnings.append(f"{result['images']['missing_alt']}/{result['images']['total']} images missing alt text")
    elif result["images"]["total"] > 0:
        passed.append("All images have alt text")

    if result["performance"]["blocking_scripts"] > 3:
        score -= 3
        warnings.append(f"{result['performance']['blocking_scripts']} render-blocking scripts (no async/defer)")
    else:
        passed.append("Scripts use async/defer or are minimal")

    result["score"] = max(0, score)
    result["issues"] = issues
    result["warnings"] = warnings
    result["passed"] = passed

    return result


if __name__ == "__main__":
    if len(sys.argv) < 2:
        print(json.dumps({"error": "Usage: seo_check.py <url>"}))
        sys.exit(1)

    url = sys.argv[1]
    if not url.startswith(("http://", "https://")):
        url = "https://" + url

    result = audit(url)
    print(json.dumps(result, indent=2, ensure_ascii=False))
