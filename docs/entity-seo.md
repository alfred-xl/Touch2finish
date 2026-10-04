# Touch2Finish entity SEO

## Identity and verification

`config/touch2finish.php` is the source for the public brand, legal name, company number, canonical domain, contact details, country and official social profiles. Touch2Finish is the public brand; Touch2finish Services Ltd is the legal company supplied by the owner. The name and number 17277580 were checked against https://find-and-update.company-information.service.gov.uk/company/17277580 during the pre-implementation review.

London is the primary service area. Content says the business serves London; it does not infer an operating address from a registered office. Outside-London work is subject to the requirement and availability.

No registered address, opening hours, coordinates, founding date, prices, VAT number, ratings, reviews or social accounts have been added. Official social URLs remain empty until supplied and verified by the owner. Add profiles as `Platform name => https://official-profile-url`; empty or invalid/non-HTTPS values do not render. A syntactically valid URL is not proof of ownership: verify ownership before adding it.

## Files and behavior

| Files | Change |
| --- | --- |
| `config/touch2finish.php` | Central business identity, consistent marketing brand spelling, empty social profiles and future locations. Existing contact/service/quote fields retained. |
| `app/Support/Seo.php` | Shared canonical URLs, organization IDs, geographic context, verified-profile filtering and homepage/service graphs. |
| `app/Providers/AppServiceProvider.php` | Production URL forcing uses the business domain, independent of a misconfigured APP_URL. |
| `resources/views/partials/seo.blade.php` | Business-based site name, canonical/OG alignment, real image dimensions, safe JSON encoding, removal of the UTF-8 BOM. |
| `resources/views/welcome.blade.php` | UK title/description, visible business/legal identity and connected homepage graph. |
| `resources/views/about.blade.php`, `routes/web.php` | New GET/HEAD `/about`, named `about`, using the existing layout and styles. Explains identity, services, working approach and coverage; links to Companies House and enquiries. |
| `resources/views/components/layout.blade.php` | Desktop/mobile About navigation, footer company identity, Areas link and conditional accessible profile links. |
| `resources/views/service.blade.php` | Service/provider and breadcrumb graphs, coverage link, consistent brand copy. |
| `resources/views/services/index.blade.php` | London metadata and coverage link. Optional ItemList omitted because the existing service list and Service graphs already describe the offering. |
| `resources/views/areas-we-cover.blade.php` | UK operating-company context and contextual links to Home, About and Services; existing five-service links retained. |
| `resources/views/legal/*.blade.php`, `resources/views/errors/404.blade.php` | SEO-facing brand capitalization. Legal body wording and the 404 noindex directive retained. |
| `app/Http/Controllers/SitemapController.php` | Adds About and emits only canonical business-domain URLs. Existing escaped XML template retained. |
| `public/robots.txt` | Brand spelling only; public asset/page crawling and the production sitemap reference retained. |
| `public/build/manifest.json`, `public/build/assets/app-*.css` | Rebuilt frontend assets for the new About page and shared layout. |
| `tests/Feature/EntitySeoTest.php` | Rendered metadata/schema, canonical host and query handling, company links, image dimensions, sitemap allowlist, robots and unpublished-location checks. |
| `tests/Feature/PublicServicesTest.php` | Canonical expectations now explicitly use the business domain instead of localhost; existing behavioral tests retained. |
| `README.md`, `docs/entity-seo.md` | Deployment settings and verification/ownership notes. |

## Schema and metadata

The homepage has one graph containing Organization/LocalBusiness at `https://touch2finish.co.uk/#organization` and WebSite at `https://touch2finish.co.uk/#website`, connected through publisher. The organization has the legal name and Companies House identifier, contact details, existing imagery, and London areaServed within the United Kingdom. Empty sameAs is omitted.

Each canonical service page has Service and BreadcrumbList nodes. Provider references the shared organization ID without repeating its full definition. Breadcrumbs follow Home → Services → current service, using canonical URLs.

The homepage title is `Touch2Finish UK | Valeting, Cleaning, Removals & Property Services`. About uses `About Touch2Finish | Touch2finish Services Ltd UK`. The service index uses `Services | Touch2Finish London`. Descriptions explain London coverage and the actual service range. Other public SEO titles use the consistent Touch2Finish spelling.

Canonical homepage output is `https://touch2finish.co.uk` without a trailing slash. IDs intentionally use `/#organization` and `/#website`. Canonicals and the sitemap use production identity URLs even during local development. Navigation/quote form URLs stay local outside production. Query parameters still preselect the quote service but are excluded from canonical and OG URLs.

Social metadata retains the existing imagery and reports each local asset's actual dimensions; the hero is 1600×1200 and the fallback is 1080×1080. A future approved 1200×630 social image can use the existing image override. No new image or visual identity was generated.

The sitemap contains 12 indexable pages: Home, About, Services, five service pages, Areas and three legal pages. It excludes redirects, forms, auth, errors, query variants and future locations. `locations` is a documented empty structure; adding an entry alone does not publish a URL.

## Verification

Run `php artisan test` and `npm run build`. Targeted checks can also be run with:

```sh
php artisan test tests/Feature/EntitySeoTest.php tests/Feature/PublicServicesTest.php tests/Feature/QuoteRequestTest.php
```

Before these changes, the full suite had 42 passes and 22 failures: the failures were legacy Breeze authentication/profile tests for unregistered routes and absent controllers. Those tests and authentication functionality are outside this SEO change. Report the existing failures rather than deleting tests or restoring authentication just to make the suite pass.

Implementation verification on 4 October 2026: `npm run build` passed; `php artisan test` reported 72 passed and the same 22 pre-existing authentication/profile failures. All 30 new entity SEO cases and all 39 existing public-service/quote cases passed. Rendered HTML checks covered all 12 sitemap pages and their internal page/fragment links. JSON-LD and sitemap XML parsed successfully, and static robots directives were inspected. The Vite build emitted a non-blocking warning that its Browserslist data is six months old. No deployment has been performed.

## Deployment and external actions

1. Deploy the code and rebuilt assets together. Refresh config, route and view caches using the README deployment commands.
2. On controlled infrastructure, configure permanent HTTP → HTTPS and www → apex redirects, preserving paths and query strings. Test for redirect loops through the proxy. No `.net`/`.com` redirects are included.
3. Verify the deployed `/`, `/about`, `/services`, all service pages, `/areas-we-cover`, `/sitemap.xml` and `/robots.txt`. Confirm rendered canonicals, schema IDs, asset URLs and status codes after caches are refreshed.
4. Use the owner's Google Search Console property to submit the sitemap and inspect the homepage/About/service pages. Validate structured data with Google's Rich Results Test and Schema.org Validator; schema alone does not guarantee a rich result or a brand ranking.
5. Review the owner's Google Business Profile, if available, for accurate name, website, contact information and service coverage. Confirm the operating model before adding address/hours information or changing profile details.
6. Supply verified official social URLs for configuration. Maintain matching identity information in owner-controlled profiles/citations. No directory or external account was edited by this change.

Optional business inputs still needed: verified social profiles/Google Business Profile URL, confirmed operating-base details if “London-based” wording is desired, and useful unique local information before considering location pages. These omissions do not block the current release.
