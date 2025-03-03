=== Ocean Portfolio ===
Contributors: oceanwp, apprimit, wpfleek, freemius
Requires at least: 5.6
Tested up to: 6.6.2
Stable tag: 2.3.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

A complete solution to display your portfolio and work in a good-looking and an appealing way.
This plugin requires the [OceanWP](https://oceanwp.org/) theme to be installed.

== Installation ==

1. Upload `ocean-portfolio` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Done!

== Frequently Asked Questions ==

= I installed the plugin but it does not work =

This plugin will only work with the [OceanWP](https://oceanwp.org/) theme.

== Changelog ==

= 2.3.0 - OCT 16 2024 =
- NEW: Customizer: Library upgraded to default WordPress ReactJS.
- NEW: Customizer: Customizer Controls.
- NEW: Customizer: User Interface.
- NEW: Customizer: Reorganized settings for improved user experience.
- Removed: Customizer: Legacy PHP Controls.

= 2.2.2 - OCT 11 2024 =
- Added: Conditional checks for future updates.
- Updated: Compatibility: WordPress version number.

= 2.2.1 - MAY 22 2024
- Added: Translations: Portuguese translation.
- Updated: Compatibility: WordPress version.
- Fixed: Lightbox: When using lightbox inside filtered content, images unrelated to the filtered content display.

= 2.2.0 - SEP 6 2023 =
- NEW: Metabox Settings Interface: https://docs.oceanwp.org/category/826-oceanwp-settings
- Updated: Compatibility: WordPress version number.

= 2.1.2 - MAY 23 2023 =
- Fixed: Pagination position issue.
- Fixed: Default style pagination is not working.
- Added: Compatibility: PHP 8.2.6: Creation of dynamic property Ocean_Portfolio::$plugin_path and Ocean_Portfolio::$plugin_url is deprecated.

= 2.1.1 - JAN 10 2023 =
- Fixed: Icon options for Portfolio shortcodes don't function.

= 2.1.0 - NOV 9 2022 =
- NEW: Filter Button: Brand new filter type option: Customize > Portfolio > Filter Bar.
- Added: Placeholder image for portfolio items without a featured image.

= 2.0.7 =
- Improved: Theme Panel.

= 2.0.6 =
- Fixed: WordPress 5.9 Compatibility: WP_User_Query issue.

= 2.0.5 =
- Fixed: Scripts: load issue.

= 2.0.4 =
- Fixed: Deprecated PhotoSwipe script: removed redundant HTML from footer area.
- Fixed: Filter: links active style.
- Fixed: Minor issues.

= 2.0.3 =
- Fixed: Gallery: navigation arrows missing in Lightbox.

= 2.0.2 =
- Fixed: Open lightbox on click link icon issue.

= 2.0.1 =
- Fixed: Fatal error: Uncaught Error: Call to undefined method Ocean_Portfolio::init().

= 2.0.0 =
- Added: Vanilla JS.

= 1.3.1 =
- Added: OceanWP SVG icon support.
- Fixed: Shortcode pagination issue.

= 1.3.0 =
- Fixed: Next/Prev arrows updated to Font Awesome 5.
- Fixed: Next/Prev RTL arrows.
- Added: Accessibility improvement.
- Added: Meta separator style.

= 1.2.0 =
- Added: Version updated for WordPress 5.4.

= 1.1.10 =
- Fixed: Missing taxonomies (category and tag fields after WP5).
- Fixed: Missing 'portfolio' template from page attribute dropdown.

= 1.1.9 =
- Added: Code added to support Freemius migration.

= 1.1.8 =
- Added: Title tag for the single item title.

= 1.1.7 =
- Added: Layout setting for the archive and taxonomies pages.
- Tweak: Correct page title added for the breadcrumb.

= 1.1.6 =
- Fixed: Wrong image displayed on the lightbox.
- Fixed: Lightbox issue on portfolio taxonomy.
- Fixed: Buttons after the footer on single portfolio items.

= 1.1.5 =
- Fixed: Issue with lightbox script on single portfolio items.

= 1.1.4 =
- Fixed: Taxonomy issue for Order and Orderby settings.
- Fixed: Issue with Elementor Themer.

= 1.1.3 =
- Fixed: Search issue.

= 1.1.2 =
- Tweak: French translation updated, thanks to Julien Roussel.
- Added: Polish translation, thanks to Fin Fafarafiel.
- Tweak: Better approch for calling the metabox scripts.

= 1.1.1 =
- Added: Added translation for the lightbox texts so now you can translate the words of the PhotoSwipe lightbox.

= 1.1.0 =
- Added: Two new settings to disable the link or lightbox icon.
- Added: Settings to choose if you want to open the portfolio item or a lightbox to the image click.
- Added: PhotoSwipe instead of Magnific Popup, much better lightbox script for photographers, so the Mgnific Poup scripts are removed from the portfolio pages, no need to have two lightbox scripts.
- Added: New setting for the shortcode creation to allow you to disable the MagnificPopup lightbox script on th epage where you will add the portfolio shortcode.
- Added: SEO markups.

= 1.0.9 =
- Added: Filter "op_portfolio_all_text" for the All text in the filter to allow you to add what you want via a child theme.

= 1.0.8 =
- Added: New field in the OceanWP Settings metabox to add a portfolio item external URL.
- Added: New field to add a target to your portfolio item external URL.
- Fixed: Issue with the lightbox script.
- Deleted: Admin notice if OceanWP is not the theme used.

= 1.0.7 =
- Fixed: Capabilities issue in the metabox.

= 1.0.6 =
- Tweak: Remove Chocolat script.

= 1.0.5 =
- Added: Both Sidebars layout in the customizer for the single items.
- Fixed: Issue with the social sharing buttons.
- Fixed: Issue with color fields.

= 1.0.4 =
- Tweak: Schema markup.
- Added: French translation, thanks a lot to Jean of freepixel.net.

= 1.0.3 =
- Fixed: The Shortcode metabox on the Shortcodes post type doesn't display on some hosts.

= 1.0.2 =
- Fixed: Sanitize value issue for some fields.

= 1.0.1 =
- Fixed: Error 500 on some host.

= 1.0.0 =
- Initial release.
