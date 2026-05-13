# Homedesk — WordPress Project

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

---

## Theme — OceanWP

**Path:** `wp-content/themes/oceanwp/`

> Only this theme is active. Do not touch other themes in `wp-content/themes/`.

### Key files

| File | Purpose |
|---|---|
| `functions.php` | Theme bootstrap — `OCEANWP_Theme_Class`, hooks, admin filters |
| `custom-functions.php` | **Custom theme code goes here** — imported at bottom of functions.php |
| `assets/css/custom.css` | Custom frontend CSS overrides |
| `assets/css/bootstrap.css` | Bootstrap grid — modified for this project |

### Custom functions file

All theme customizations live in `wp-content/themes/oceanwp/custom-functions.php`.  
It is included from `functions.php` via `require_once`.  
Never edit `functions.php` directly for project-specific logic.

### Active OceanWP extensions (plugins)

- `ocean-extra` — theme panel & advanced options
- `ocean-elementor-widgets` — custom Elementor widgets
- `ocean-gutenberg-blocks` — Gutenberg premium blocks
- `ocean-hooks` — conditional template logic
- `ocean-portfolio` — portfolio post type
- `ocean-popup-login` — modal login/register
- `ocean-social-sharing` / `ocean-product-sharing` — share buttons
- `ocean-cookie-notice` — GDPR cookie banner
- `ocean-sticky-header` / `ocean-sticky-footer` — sticky UI elements
- `ocean-side-panel` — off-canvas side panel
- `ocean-full-screen` — fullscreen scroll sections
- `ocean-footer-callout` — footer promo block
- `ocean-instagram` — Instagram feed widget
- `ocean-woo-popup` — add-to-cart popup
- `ocean-pro-demos` — template importer
- `ocean-white-label` — branding override

---

## Custom Plugins

### `one-page-cod` (full-featured)

**Path:** `wp-content/plugins/one-page-cod/`  
**Purpose:** One-page Cash-on-Delivery order form on WooCommerce product pages.

Architecture (singleton pattern):

```
One_Page_COD (main class)
├── OPC_Form        — form rendering & validation
├── OPC_Order       — WooCommerce order creation
├── OPC_Settings    — admin settings page
└── OPC_Shortcode   — [one_page_cod] shortcode
```

Default settings (stored in `opc_settings` option):
- Auto-detect product: `yes`
- Variable products: `yes`
- Payment: `cod`
- Order status: `processing`
- Required fields: `name, phone, address, city`
- Form position: `after_add_to_cart`
- Button: `Commander maintenant`

Script handle: `opc-scripts` / Localized object: `opcData`  
HPOS compatible (WooCommerce Custom Order Tables).

---

## Other Active Plugins

| Plugin | Purpose |
|---|---|
| `woocommerce` | E-commerce core |
| `akismet` | Anti-spam |
| `wpforms-lite` | Contact forms |
| `duplicate-page` | Page duplication utility |

---

## Git Conventions

- Branch: `master`
- Commits follow `<verb> <subject>` style (see git log)
- Do not commit: `wp-content/uploads/`, `.history/`, cache files
- Untracked to watch: `one-page-cod/`, `custom-functions.php`

---

## Common Tasks

### Add theme custom function
→ Edit `wp-content/themes/oceanwp/custom-functions.php`

### Add/modify WooCommerce hooks
→ `custom-functions.php` using `add_action('woocommerce_*', ...)`

### Modify order form behavior
→ `wp-content/plugins/one-page-cod/includes/class-opc-*.php`

### Custom CSS
→ `wp-content/themes/oceanwp/assets/css/custom.css`

---

## Environment

- **Local URL:** `http://localhost/homedesk`
- **WP Admin:** `http://localhost/homedesk/wp-admin`
- **MAMP:** MySQL on port 3306, Apache
- **PHP:** 7.4+ required (plugin constraint)
