# Storefront Child – Northline Outfitters

Child theme for the Northline Outfitters WooCommerce store, built on
[Storefront](https://wordpress.org/themes/storefront/). All site customisation
lives here so the parent theme and WordPress core stay untouched and updatable.

## Requirements
- WordPress 7.1+, WooCommerce 11.3+, PHP 8.1+
- Storefront 4.6+ installed (parent theme)

## Install
1. Copy this folder to `wp-content/themes/storefront-child/`.
2. Appearance → Themes → activate **Storefront Child**.

## What is in here
| File | Purpose |
|---|---|
| `style.css` | Theme header, plus a small CSS fix that hides the header mini-cart from screen readers until it is opened. |
| `functions.php` | Adds the GA4 tag (`NORTHLINE_GA4_ID`) and a meta description on every page. |

## Configuration
- **GA4:** change `NORTHLINE_GA4_ID` in `functions.php`. The measurement ID is public, not a secret.
- No API keys, passwords or credentials are stored in this repository. Payment keys live in the Stripe plugin settings on each environment.

## Changing CSS
Raise `Version:` in `style.css` after a CSS change so browsers load the new file.

## Licence
GPL-3.0-or-later, the same licence as the Storefront parent theme. See `LICENSE`.
