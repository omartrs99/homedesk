# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

E-commerce WordPress site for selling home products, built on OceanWP + WooCommerce.  
Local development via MAMP at `http://localhost/homedesk`.

**Database:** `db_homedesk` on `localhost` (user: `root`, pass: `root`)  
**Table prefix:** `wp_db54_home_`  
**Language:** French (UI, button labels, default messages)

---

## Stack

| Layer | Technology |
|---|---|
| CMS | WordPress |
| Theme | OceanWP (parent theme, not a child theme) |
| E-commerce | WooCommerce 9.7.0 |
| Page builder | Elementor (extension via `ocean-elementor-widgets`) |
| Forms | WPForms Lite |
| Custom order flow | `one-page-cod` (custom plugin) |
| Caching | LiteSpeed Cache + WP Super Cache |
| Images | EWWW Image Optimizer |

---

## Environment

- **Local URL:** `http://localhost/homedesk`
- **WP Admin:** `http://localhost/homedesk/wp-admin`
- **MAMP:** MySQL on port 3306, Apache — start MAMP before testing
- **PHP:** 7.4+ required (plugin constraint)

There are no build steps, test runners, or lint commands — this is a WordPress project edited directly. Verify changes by loading pages in a browser against the local MAMP server.

---

## Theme — OceanWP

**Path:** `wp-content/themes/oceanwp/`

> Only this theme is active. Do not touch other themes in `wp-content/themes/`.

### Key files

| File | Purpose |
|---|---|
| `functions.php` | Theme bootstrap — `OCEANWP_Theme_Class`, hooks, admin filters |
| `custom-functions.php` | **All custom theme code goes here** — included via `require_once` at bottom of `functions.php` |
| `assets/css/custom.css` | Custom frontend CSS (1800+ lines) |
| `assets/js/custom.js` | Custom frontend JS (carousels, sliders, CTA scroll) |
| `assets/js/hook-produit-editor.js` | React component for the block editor meta field inside WP product admin |
| `assets/css/bootstrap.css` | Bootstrap grid — modified for this project |

Never edit `functions.php` directly for project-specific logic.

### What's in custom-functions.php

- Enables Gutenberg block editor for WooCommerce products
- Registers `_hook_produit` post meta — editable rich content displayed above the stacked product gallery (React block editor component in `hook-produit-editor.js`)
- Registers `_product_template` post meta — dropdown in product admin to select "Default" or "Stacked" layout
- `[homedesk_carousel]` shortcode — Swiper carousel of images from `assets/img/carousel-clients-homedesk/`
- Disables WooCommerce product reviews tab
- Adds a dynamic percentage discount badge to sale products on single product pages
- **Sécurité**: supprime la version WP du `<head>` et des flux ; bloque l'énumération des utilisateurs via `/?author=`
- **Performance**: preload LCP `ogb-columns-bg` (transient), preload hero image sur pages produit, dequeue CSS block editor, async font-awesome/simple-line-icons, defer oceanwp-custom/swiper-js
- **Accessibilité**: inject auto `alt` sur les images des blocs `ocean-gutenberg-blocks/testimonial`

### Active OceanWP extensions (plugins)

- `ocean-extra` — theme panel & advanced options
- `ocean-elementor-widgets` — custom Elementor widgets
- `ocean-gutenberg-blocks` — Gutenberg premium blocks
- `ocean-hooks` — conditional template logic
- `ocean-popup-login` — modal login/register
- `ocean-cookie-notice` — GDPR cookie banner
- `ocean-sticky-header` / `ocean-sticky-footer` — sticky UI elements
- `ocean-side-panel` — off-canvas side panel
- `ocean-woo-popup` — add-to-cart popup
- `ocean-full-screen` — full-screen menu overlay
- `ocean-footer-callout` — footer CTA bar
- `ocean-instagram` — Instagram feed widget
- `ocean-portfolio` — portfolio CPT
- `ocean-product-sharing` / `ocean-social-sharing` — product/social share buttons
- `ocean-white-label` — white-label branding
- `ocean-pro-demos` — demo importer

---

## Product Layout System

Each WooCommerce product has a `_product_template` meta field (set via a meta box in the product admin editor). Two layouts are available:

**Default** — standard WooCommerce side-by-side gallery + summary  
→ Template: `woocommerce/content-single-product.php`

**Stacked** — full custom long-form page sections  
→ Template: `woocommerce/content-single-product-stacked.php`  
→ Sections rendered in order:
1. `_hook_produit` block editor content (editable per-product rich HTML)
2. Product gallery (`pgf` carousel)
3. Features banner (4-column teal bar)
4. Transformations cards (4-card grid)
5. Gift / "Sac" block (3-col: hero carousel + offer text + mini gallery)
6. Demo videos section (dark background, 9:16 portrait grid)
7. Gallery + OPC order form (2-col, form is sticky)

The `wc_get_template_part` filter in `custom-functions.php` swaps the template based on the `_product_template` meta value.

---

## Custom JS Patterns (assets/js/custom.js)

Custom carousels and interactive components — all vanilla JS / jQuery:

| Identifier | Component | Notes |
|---|---|---|
| `pgf` | Product gallery carousel | Auto-rotates every 3s, thumbnail nav, pauses on hover |
| `pgb` | Gift block main carousel | Auto-rotates every 3.2s, IntersectionObserver scroll animations on `.pgb--visible` |
| `pgb-hero` | Hero image carousel inside gift block | Auto-rotates every 3s, thumbnail nav |
| `bab` | Before/after comparison slider | Mouse + touch drag, updates clip-path on `.bab-panel--avant` and `.bab-apres` |
| `hd-carousel-swiper` | Client testimonials | Swiper.js, responsive (2→3→6 slides), autoplay 3.5s |
| `mySwiper` | General Swiper carousel | Responsive (1→2→3 slides), autoplay 6s |

**CTA scroll:** `.opc-submit-btn` and `.pcta-btn` both smoothly scroll to `.opc-form-container` with an 80px header offset.

---

## CSS Conventions (assets/css/custom.css)

Components follow BEM-style naming: `.pgb-*`, `.bab-*`, `.hd-carousel-*`, `.opc-*`, `.pgf-*`

**Brand colors:**
- Primary teal: `#318b82`
- Hover teal: `#22766c`
- Background cream: `#f4f4f0`
- Error red: `#e74c3c`

Custom CSS is organized by component/section, not by global utilities. New styles for a section should be grouped with existing styles for that section.

---

## Custom Plugin: `one-page-cod`

**Path:** `wp-content/plugins/one-page-cod/`  
**Purpose:** One-page Cash-on-Delivery order form on WooCommerce product pages, bypassing the cart.

Architecture (singleton pattern):

```
One_Page_COD (main class)
├── OPC_Form        — form rendering & AJAX handlers
├── OPC_Order       — WooCommerce order creation
├── OPC_Settings    — admin settings page (under WooCommerce menu)
├── OPC_Shortcode   — [one_page_cod product_id="123"] shortcode
└── opc-functions.php — helper functions & admin order list filters
```

Settings stored in `opc_settings` WP option (defaults):
- Auto-detect product: `yes` — shows form automatically on product pages
- Variable products: `yes`
- Payment: `cod`
- Order status: `processing`
- Required fields: `name, phone, address, city`
- Form position: `after_add_to_cart`
- Button: `Commander maintenant`
- Success message: `Votre commande a été enregistrée avec succès !`

Script handle: `opc-scripts` / Localized JS object: `opcData` (contains `ajax_url`, `nonce`, `messages`)  
HPOS compatible (WooCommerce Custom Order Tables).

### AJAX Endpoints

| Action | Nonce | Description |
|---|---|---|
| `opc_submit_order` | `opc_nonce` | Validates form, creates WC order, returns `order_id` + `redirect_url` |
| `opc_get_variation_data` | `opc_nonce` | Returns variation `price_html`, `is_in_stock`, `stock_quantity` for selected attributes |

Both endpoints accept logged-in and non-logged-in requests (`wp_ajax_nopriv`).

### Extension Hooks

```php
// Fires after a successful order is created
do_action('opc_order_created', $order_id, $customer_data);

// Filter the form title
apply_filters('opc_form_title', __('Commandez directement', 'one-page-cod'));
```

OPC orders are tagged with `_opc_order = 'yes'` meta. The admin orders list shows an "OPC" column and a dropdown filter.

---

## Other Active Plugins

| Plugin | Purpose |
|---|---|
| `woocommerce` | E-commerce core |
| `akismet` | Anti-spam |
| `wpforms-lite` | Contact forms |
| `duplicate-page` | Page duplication utility |
| `litespeed-cache` | Full-page cache (LiteSpeed) |
| `wp-super-cache` | Full-page cache (Apache) |
| `ewww-image-optimizer` | Image compression & WebP conversion |
| `wp-whatsapp-chat` | WhatsApp chat widget |

---

## Git Conventions

- Branch: `master`
- Commits follow `<verb> <subject>` style (see git log)
- Do not commit: `wp-content/uploads/`, `.history/`, cache files

---

## Common Tasks

### Add theme custom function
→ Edit `wp-content/themes/oceanwp/custom-functions.php`

### Add/modify WooCommerce hooks
→ `custom-functions.php` using `add_action('woocommerce_*', ...)`

### Modify the OPC order form
→ `wp-content/plugins/one-page-cod/includes/class-opc-form.php` (rendering + validation)  
→ `wp-content/plugins/one-page-cod/includes/class-opc-order.php` (order creation)  
→ `wp-content/plugins/one-page-cod/assets/js/opc-scripts.js` (client-side validation + AJAX)

### Modify product page layout or sections
→ Set `_product_template` in the product admin meta box ("Default" or "Stacked")  
→ Edit stacked template at `wp-content/themes/oceanwp/woocommerce/content-single-product-stacked.php`  
→ Edit per-product hook content via the block editor meta box in the product admin

### Custom CSS
→ `wp-content/themes/oceanwp/assets/css/custom.css`
