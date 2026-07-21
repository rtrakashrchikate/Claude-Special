AKC Site Fixes — Installation & Usage
======================================

WHAT THIS PLUGIN DOES
─────────────────────
Applies three corrections to advocateakashchikate.com in one click:

  Fix 1 (always active while plugin is on):
    301 redirect: /bombay-high-court-pune-bench-jurisdiction/ → /bombay-high-court-lawyer-pune/
    The old page claims a "Pune Bench" of the Bombay High Court exists — it does not.

  Fix 2 (runs once on activation):
    Removes every instance of "Pune Bench" from all posts, pages, and SEO meta
    fields (RankMath title/description, Yoast title/metadesc, AIOSEO).
    The Bombay High Court has no Pune Bench. Correct term: "Bombay High Court".

  Fix 3 (runs once on activation):
    On /bail-after-arrest-pune-guide/ — corrects any wrong BNSS section number
    (479 → 187(3)) and fixes inverted 60/90-day default bail deadlines.
    Correct: 90 days for serious offences (death/life/10+ years), 60 for others.


HOW TO INSTALL
──────────────
PREREQUISITE: Before activating, make sure /bombay-high-court-lawyer-pune/ is
published and live. Otherwise the redirect (Fix 1) will send visitors to a
404 page.

Step 1: In WordPress admin → Plugins → Add New → Upload Plugin
Step 2: Upload the akc-site-fixes.zip file (zip the akc-site-fixes folder)
Step 3: Click "Install Now" then "Activate Plugin"

That's it. On activation, Fixes 2 and 3 run automatically.
Fix 1 (the redirect) is active as long as the plugin is enabled.

After activation you will see a green admin notice listing what was changed.


VERIFY THE FIXES WORKED
────────────────────────
Fix 1: Open /bombay-high-court-pune-bench-jurisdiction/ in an incognito window.
       It should redirect to /bombay-high-court-lawyer-pune/ with a 301 status.
       (Check Network tab in browser DevTools — look for 301 then 200.)

Fix 2: In WordPress → Search (or use Ctrl+F in the block editor on any page)
       and search for "Pune Bench". Should find nothing.
       After a few days, verify with Google: site:advocateakashchikate.com "Pune Bench"

Fix 3: Visit /bail-after-arrest-pune-guide/ and find the "Default Bail" section.
       It should say Section 187(3) BNSS and:
         • 90 days → offences with death, life imprisonment, or ≥10 years
         • 60 days → all other offences


RE-RUNNING FIXES
────────────────
If you need to re-run Fixes 2 and 3 (e.g., after adding new content):
  WordPress Admin → Tools → AKC Site Fixes → click "Re-run Fixes 2 and 3 Now"


AFTER EVERYTHING IS CONFIRMED
──────────────────────────────
1. Keep the plugin active (Fix 1 redirect is only active while it's enabled).
   Once you have permanently deleted /bombay-high-court-pune-bench-jurisdiction/
   from WordPress AND Google has de-indexed it, you can deactivate the plugin.
   Until then, keep it on.

2. Flush your Cloudflare / hosting cache after activation so visitors
   get fresh content immediately.
