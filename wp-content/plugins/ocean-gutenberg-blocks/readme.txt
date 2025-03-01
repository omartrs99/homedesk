=== Ocean Gutenberg Blocks ===
Contributors: oceanwp, apprimit, freemius
Requires at least: 5.6
Tested up to: 6.6.1
Stable tag: 1.1.8
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

== Copyright ==

Copyright (C) 2016-2021 OceanWP LLC
Licensed under GNU GPL, Version 3.0+ (the "License);
You may not use this file except in compliance with the License.
You may obtain a copy of the License at:
https://www.gnu.org/licenses/gpl-3.0.en.html

ADDITIONAL TERMS per GNU GPL Section 7 The origin of the Program must not be misrepresented;
you must not claim that you wrote the original Program. Altered source versions must be plainly marked as such,
and must not be misrepresented as being the original Program.

Unless required by applicable law or agreed to in writing, software distributed under the
License is distributed on an “AS IS” BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and limitations under the License.

Ocean Gutenberg Blocks bundles the following third-party resources:

Font Awesome Fonts, Copyright Dave Gandy
License: SIL OFL 1.1 License - https://scripts.sil.org/OFL
Source: https://fontawesome.com/

Font Awesome Icons, Copyright Dave Gandy
License: CC BY 4.0 License - https://creativecommons.org/licenses/by/4.0/
Source: https://fontawesome.com/

== Description ==

A premium plugin to add magnificent and various blocks to the WordPress default Gutenberg editor. Enrich your blog posts or build stunning pages.
This plugin requires the [OceanWP](https://oceanwp.org/) theme to be installed.

== Installation ==

1. Upload `ocean-gutenberg-blocks` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Done!

== Frequently Asked Questions ==

= I installed the plugin but it does not work =

This plugin will only work with the [OceanWP](https://oceanwp.org/) theme.

== Changelog ==

= 1.1.8 - AUG 5 2024 =
- Fixed: Error when adding blocks to reusable patterns / blocks.
- Fixed: Blocks' device preview controls appearance inside Gutenberg sidebar.

= 1.1.7 - MAY 20 2024 =
- Added: Translations: Portuguese language.
- Updated: Compatibility: WordPress version number.

= 1.1.6 - MAR 13 2024 =
- Fixed: Missing dependencies while using the Query Monitor plugin on admin pages.
- Fixed: Timeline block: Block functionality inside the editor.
- Fixed: PHP Warning: Cannot modify header information - headers already sent by (output started at .../plugins/ocean-gutenberg-blocks/includes/blocks/modules/blog-grid/blog-grid.php:116).

= 1.1.5 - DEC 13 2023 =
- NEW: Clipoboard block.
- NEW: ACF block.
- Updated: Font Awesome library to the latest 6.5.1 version.
- Improved: JS files loading.
- Fixed: PHP Warning: Undefined index: icon.
- Fixed: PHP Warning: Undefined index: label.
- Fixed: Newsletter block subscribing issue.

= 1.1.4 - MAY 23 2023 =
- Added: Compatibility: PHP 8.2.6: Creation of dynamic property Ocean_Gutenberg_Blocks::$plugin_path and Ocean_Gutenberg_Blocks::$plugin_url is deprecated.
- Updated: MailChimp: CURL method replaced with wp_remote_get.
- Fixed: Heading block: Can't add new heading block.
- Fixed: Blog Grid block: PHP warning after adding blog grid block.
- Fixed: Info box block: Incorrect CSS output.
- Fixed: Undefined 'className' attribute.

= 1.1.3 - NOV 9 2022 =
- Fixed: Class name change for Gutenberg components.
- Fixed: Blog Grid: Hide original video thumbnail with enable/disable thumbnail setting.
- Fixed: Blog Grid: Backend and frontend column display differences.
- Fixed: Blog Grid: Adding multiple Blog Grid blocks to the same post / page displays the same content.
- Fixed: Blog Grid: Responsive CSS issue with device type preview.
- Fixed: Blog List: Responsive CSS issue with device type preview.
- Fixed: Timeline: Responsive CSS issue with device type preview.

= 1.1.2 =
- Fixed: Compatibility with OceanWP child theme.

= 1.1.1 =
- New Block: Pricing Menu.
- Improved: Theme Panel styling.
- Added: Blog Grid block: H tag choice.
- Added: Blog List block: H tag choice.
- Added: Call to Action block: H tag choice.
- Fixed: Blog Carousel: Video post format thumbnail issue.
- Removed: redundant plugin file.

= 1.1.0 =
- New Block: Star Rating.
- New Block: Recipe.
- New Block: Modal Window.
- New Block: Icon list.
- New Block: Section.
- New Block: Team.
- New Block: Buttons.
- New Block: Circle Progress.
- Fixed : Wrong font family name of Testimonial block.
- Fixed : Blog grid read more button styling.
- Fixed : Call to action block - Animation issue fixed on frontend.
- Fixed : Fatal error on plugin activation.
- Added : alignwide and alignfull support for columns block.
- Added : Background color for blog grid post content area.
- Fixed: __experimentalUseInnerBlocksProps is not available in Wordpress 5.9

= 1.0.1 =
- Plugin slug updated.

= 1.0.0 =
- Initial release.
