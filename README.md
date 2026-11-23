# Storefront Child – reusable store base

Child theme for WooCommerce stores built on
[Storefront](https://wordpress.org/themes/storefront/). First used for
Northline Outfitters; every new client site starts from this repository so a
fix made once reaches all sites. WordPress core and the parent theme stay
untouched and updatable.

## Requirements
- WordPress 7.1+, WooCommerce 11.3+, PHP 8.1+
- Storefront 4.6+ installed (parent theme)

## Components
| File | What it does |
|---|---|
| `functions.php` | GA4 tag (production only, admins excluded), meta description on every page, and lets WooCommerce's Hold stock job cancel unpaid block-checkout orders. |
| `style.css` | Theme header, plus a fix that hides the header mini-cart from screen readers until it is opened. |

## Plugin baseline
Only these plugins are installed by default. Anything else needs a reason
agreed with the client.

| Plugin | Why |
|---|---|
| WooCommerce | The store itself. |
| WooCommerce Stripe Gateway | Card payments, with a free sandbox for testing. |

## Per-site settings (wp-config.php, never in this repo)
```php
define( 'WP_ENVIRONMENT_TYPE', 'local' );   // local | staging | production
define( 'SITE_GA4_ID', 'G-XXXXXXX' );       // the client's GA4 measurement ID
```
Payment keys live in the Stripe plugin settings on each environment.

## Start a new client site
1. Create the site in LocalWP; install Storefront and the plugin baseline.
2. Clone this repository into `wp-content/themes/storefront-child/` and activate it.
3. Add the per-site settings above to `wp-config.php`.
4. Set the native options: Hold stock (Settings → Products → Inventory),
   menu on Primary + Handheld (Appearance → Menus), text colour (Customise).

## Environments: local → staging → production
- **Code moves up** through Git: work locally, commit, push, then deploy the
  same tagged version to staging and, once checked, to production.
- **Content and the database move down** (production → staging → local), never
  up, so real orders and customers are never overwritten.
- **Staging** uses `WP_ENVIRONMENT_TYPE` `staging`, Stripe test keys, and
  "Discourage search engines" switched on.
- **Production** uses `production`, Stripe live keys and HTTPS.
- **Backups:** daily host backups on staging and production, and a manual
  backup before every deploy (LocalWP Export on local).

## Releasing a change
1. Raise `Version:` in `style.css` (also refreshes browser caches for CSS).
2. Commit, then tag the release: `git tag v1.2.0 && git push --tags`.
3. Deploy that tag to staging, check it, then deploy it to production.

## Licence
GPL-3.0-or-later, the same licence as the Storefront parent theme. See `LICENSE`.
