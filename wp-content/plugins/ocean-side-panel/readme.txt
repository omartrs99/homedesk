=== Ocean Side Panel ===
Contributors: oceanwp, apprimit, wpfleek, freemius
Requires at least: 5.6
Tested up to: 6.6.2
Stable tag: 2.2.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Add a responsive side panel with your preferred widgets inside.
This plugin requires the [OceanWP](https://oceanwp.org/) theme to be installed.

== Installation ==

1. Upload `ocean-side-panel` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Done!

== Frequently Asked Questions ==

= I installed the plugin but it does not work =

This plugin will only work with the [OceanWP](https://oceanwp.org/) theme.

== Changelog ==

= 2.2.0 - OCT 16 2024 =
- NEW: Customizer: Library upgraded to default WordPress ReactJS.
- NEW: Customizer: Customizer Controls.
- NEW: Customizer: User Interface.
- NEW: Customizer: Reorganized settings for improved user experience.
- Removed: Customizer: Legacy PHP Controls.

= 2.1.2 - OCT 11 2024 =
- Added: Conditional checks for future updates.
- Updated: Compatibility: WordPress version number.

= 2.1.1 - MAY 20 2024 =
- Added: Translations: Portuguese language.
- Updated: Compatibility: WordPress version number.

= 2.1.0 - SEP 6 2023 =
- NEW: Metabox Settings Interface: https://docs.oceanwp.org/category/826-oceanwp-settings
- Updated: Compatibility: WordPress version number.
- Fixed: JS error on the browser console when Side Panel disabled using Metabox Settings.

= 2.0.7 - MAY 23 2023 =
- Added: Compatibility: SiteOrigin: Custom templates support.
- Added: Compatibility: PHP 8.2.6: Creation of dynamic property Ocean_Side_Panel::$plugin_path and Ocean_Side_Panel::$plugin_url is deprecated.

= 2.0.6 =
- Fixed: My Library: Custom Template: dynamic blocks is not rendering in custom template.

= 2.0.5 =
- Fixed: Custom Templates: Content display issues when templates used on Elementor pages.

= 2.0.3 =
- Fixed: Scripts: load issue.

= 2.0.2 =
- Fixed: Demo Import: inherit style issue.

= 2.0.1 =
- Fixed: JS Error in Widgets admin page.

= 2.0.0 =
- Added: Vanilla JS.

= 1.1.2 =
- Fixed: Missing icon issue.

= 1.1.1 =
- Added: OceanWP SVG icon support.

= 1.1.0 =
- Added: Version updated for WordPress 5.4.

= 1.0.13 =
- Fixed: Broken icon issue.

= 1.0.12 =
- Added: Codes for Freemius switch.

= 1.0.11 =
- Added: Polish translation, thanks to Fin Fafarafiel.
- Fixed: Custom breakpoint issue.

= 1.0.10 =
- Added: Filter to enbale/disable the side panel via a child theme.
- Fixed: Issue if you use a custom link or button to open the side panel.

= 1.0.9 =
- Fixed: Custom template issue if it is not created with a page builder.

= 1.0.8 =
- Added: New field in the OceanWP Settings metabox to disable the side panel per page/post.
- Fixed: Border radius issue on the opening button on the left side.
- Added: Spanish language, thank you to Angel Julian Mena.
- Deleted: Admin notice if OceanWP is not the theme used.

= 1.0.7 =
- Added: New options to color for the opening button.
- Added: New option to allow you to add the text before/after the opening icon.
- Tweak: Elementor instance.

= 1.0.6 =
- Added: New Template field, now you can select a template created in Theme Panel > My Library to replace the panel content.
- Added: New breakpoints field, now you can hide the side panel at the media query you want.
- Added: New field to choose to place the opening button in the menu or beside the panel.
- Added: Custom opening buttons with effects.
- Added: Shortcode to display the opening button where you want, see the different parameters: http://docs.oceanwp.org/article/462-ospbtn-shortcode
- Fixed: Issue with the opening icon on mobile.

= 1.0.5 =
- Added: French translation, thanks a lot to Jean of freepixel.net.

= 1.0.4 =
- Fixed: Customizer options issue.

= 1.0.3.1 =
- Added: All sanitize_callback for the customizer options.
- Fixed: Icons select options.

= 1.0.3 =
- Tweak: Improved panel width field in the customizer.

= 1.0.2.1 =
- Fixed: Scrolling issue on mobile device.

= 1.0.2 =
- Added: New option to choose your icon for the opening button.
- Added: New option to add text for the opening button.
- Added: New option to hide the close button of the panel.
- Added: New option to displace or not the panel.
- Added: New option to add an overlay when the panel is opened.
- Added: New option to control the width of the panel.
- Added: NiceScroll, now you can scroll into the panel without scrollbar.

= 1.0.1 =
- Added: Support OceanWP 1.1.

= 1.0.0 =
- Initial release.