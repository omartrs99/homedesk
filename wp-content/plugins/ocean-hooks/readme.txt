=== Ocean Hooks ===
Contributors: oceanwp, apprimit, freemius
Requires at least: 5.6
Tested up to: 6.6.2
Stable tag: 2.1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Manage and apply various display conditional logic to your custom templates or custom PHP codes. Display everything where you want and how you want effortlessly using the straightforward interface and options.
This plugin requires the [OceanWP](https://oceanwp.org/) theme to be installed.

== Installation ==

1. Upload `ocean-hooks` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Done!

== Frequently Asked Questions ==

= I installed the plugin but it does not work =

This plugin will only work with the [OceanWP](https://oceanwp.org/) theme.

== Changelog ==

= 2.1.2 - OCT 16 2024
- Added: Option to add PHP codes using the Block Editor.
- Updated: WordPress version number for compatibility.
- Fixed: Custom templates not displayed if multiple templates using the same hook within the same display entity.

= 2.1.1 - MAY 22 2024
- NEW: Add hooks to specific post categories.
- NEW: Add hooks to specific product categories.
- Added: Hook: ocean_before_mobile_icon
- Added: Hook: ocean_after_mobile_icon
- Added: Hook: ocean_before_mobile_icon_inner
- Added: Hook: ocean_after_mobile_icon_inner

= 2.1.0 - SEP 6 2023 =
- NEW: Metabox Settings Interface: https://docs.oceanwp.org/category/826-oceanwp-settings
- Updated: Compatibility: WordPress version number.

= 2.0.3 - MAY 23 2023 =
- Added: Compatibility: SiteOrigin: Custom templates support.
- Added: Compatibility: PHP 8.2.6: Creation of dynamic property Ocean_Hooks::$plugin_path and Ocean_Hooks::$plugin_url is deprecated.
- Fixed: PHP fatal error - undefined 'ID' on Null.

= 2.0.2 - NOV 9 2022 =
- NEW: Option to add and run PHP codes.

= 2.0.1 =
- Improved: Theme Panel.

= 2.0.0 =
- Added: Enabled support for php code editor with Gutenberg support for my library template.
- Fixed: PHP editor is not loading after enabling it.

= 1.1.4 =
- Fixed: Fatal error on saving hooks settings in theme panel > my library.

= 1.1.3 =
- Added: Version updated for WordPress 5.4.

= 1.1.2 =
- Tweak, Sanitize changed for the hook location so you will have no problem if you add custom hooks locations.
- Tweak: Now you can add a priority 0.
- Fixed: PHP code was not showing if nothing was added to the default editor.

= 1.1.1 =
- Fixed: Conditional Logic and User Roles not saved when a hook is created with Elementor.

= 1.1.0 =
- Added: PHP editor.
- Added: Logged In/out conditionals added.
- Tweak: Plugin rewrote, now to add a hook, you need to go on Theme Panel > My Library, create a new item, click the Hooks tab in OceanWP Settings and activate the item as a hook. This way, you can add more than one hook at the same place and most importantly, you can create your hook with your page builder.

= 1.0.7 =
- Added: Polish translation, thanks to Fin Fafarafiel.

= 1.0.6 =
- Added: Single product hooks.

= 1.0.5 =
- Added: Before Page Entry hook.
- Added: After Page Entry hook.

= 1.0.4 =
- Tweak: Show/Hide hooks in the admin bar removed in admin.

= 1.0.3 =
- Added: Show Hooks button in the admin bar to allow you to display all the hooks in front end.
- Added: New Conditional Logic for WooComerce: Product Category, Product Tag and Single Product.
- Added: Spanish language, thank you to Angel Julian Mena.
- Deleted: Admin notice if OceanWP is not the theme used.

= 1.0.2 =
- Fixed: Small issue with update.

= 1.0.1 =
- Added: Conditional Logic, now you can display your code on the page or taxonomy you want.
- Added: User Roles, now you can display your code on the user roles you want.
- Added: New hooks: Before/After Blog Entry Title.
- Added: New hooks: Before/After Blog Entry Meta.
- Added: New hooks: Before/After Blog Entry Content.
- Added: New hooks: Before/After Blog Entry Read More.
- Added: New hooks: Before/After Single Post Title.
- Added: New hooks: Before/After Single Post Meta.
- Added: New hooks: Before/After Single Post Content.
- Added: New hooks: Before/After Single Post Author Bio.
- Added: New hooks: Before/After Single Post Next/Prev Link.
- Added: New hooks: Before/After Single Post Related Posts.
- Added: New hooks: Before/After Archive Product Item.
- Added: New hooks: Before/After Archive Product Image.
- Added: New hooks: Before/After Archive Product Categories.
- Added: New hooks: Before/After Archive Product Title.
- Added: New hooks: Before/After Archive Product Price & Rating.
- Added: New hooks: Before/After Archive Product Description.
- Added: New hooks: Before/After Archive Product Add To Cart.
- Fixed: Issue with the cookie.js script.

= 1.0.0 =
- Initial release.