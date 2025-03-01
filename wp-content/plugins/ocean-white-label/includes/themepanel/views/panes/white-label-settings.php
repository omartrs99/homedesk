<?php
$settings = Ocean_White_Label::get_white_label_settings();
?>

<div id="ocean-white-label-control" class="column-wrap clr">
	<form class="integration-settings" data-settings-for="white_label">

		<table class="form-table">
			<tbody>
				<tr id="oceanwp_branding_branding_tr">
					<th scope="row">
						<label for="oceanwp-branding"><?php esc_html_e( 'Theme Branding:', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<input name="oceanwp_branding[branding]" type="text" id="oceanwp-branding" value="<?php echo esc_attr( $settings['branding'] ); ?>" class="regular-text">
						<p class="desc"><?php esc_html_e( 'This option replaces OceanWP in the OceanWP Settings for metabox feature with the name of your theme.', 'ocean-extra' ); ?></p>
					</td>
				</tr>

				<tr id="oceanwp_branding_name_tr">
					<th scope="row">
						<label for="oceanwp-name"><?php esc_html_e( 'Theme Name:', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<input name="oceanwp_branding[name]" type="text" id="oceanwp-name" value="<?php echo esc_attr( $settings['name'] ); ?>" class="regular-text">
						<p class="desc"><?php esc_html_e( 'This option replaces OceanWP theme name in Appearance > Themes.', 'ocean-extra' ); ?></p>
					</td>
				</tr>


				<tr id="oceanwp_branding_author_tr">
					<th scope="row">
						<label for="oceanwp-author"><?php esc_html_e( 'Theme Author:', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<input name="oceanwp_branding[author]" type="text" id="oceanwp-author" value="<?php echo esc_attr( $settings['author'] ); ?>" class="regular-text">
						<p class="desc"><?php esc_html_e( 'This option replaces theme author name in Appearance > Themes.', 'ocean-extra' ); ?></p>
					</td>
				</tr>

				<tr id="oceanwp_branding_author_url_tr">
					<th scope="row">
						<label for="oceanwp-author_url"><?php esc_html_e( 'Theme Author URL:', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<input name="oceanwp_branding[author_url]" type="text" id="oceanwp-author_url" value="<?php echo esc_url( $settings['author_url'] ); ?>" class="regular-text">
						<p class="desc"><?php esc_html_e( 'This option replaces theme author URL in Appearance > Themes.', 'ocean-extra' ); ?></p>
					</td>
				</tr>

				<tr id="oceanwp_branding_description_tr">
					<th scope="row">
						<label for="oceanwp-description"><?php esc_html_e( 'Theme Description:', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<textarea name="oceanwp_branding[description]" id="oceanwp-description" rows="3"><?php echo esc_attr( $settings['description'] ); ?></textarea>
						<p class="desc"><?php esc_html_e( 'This option replaces theme description text in Appearance > Themes.', 'ocean-extra' ); ?></p>
					</td>
				</tr>


				<tr id="oceanwp_branding_screenshot_tr">
					<th scope="row">
						<label for="oceanwp-screenshot"><?php esc_html_e( 'Theme Screenshot URL:', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<div class="oceanwp-media-live-preview" style="display:none;">
							<?php
							$preview = $settings['screenshot'];
							if ( $preview ) {
								?>
								<img src="<?php echo esc_url( $preview ); ?>" alt="<?php esc_html_e( 'Preview Image', 'ocean-extra' ); ?>" />
							<?php } ?>
						</div>
						<input class="oceanwp-media-input" type="text" name="oceanwp_branding[screenshot]" value="<?php echo esc_url( $settings['screenshot'] ); ?>" class="regular-text">
						<input class="oceanwp-media-upload-button button-secondary" type="button" value="<?php esc_html_e( 'Upload', 'ocean-extra' ); ?>" />
						<a href="#" class="oceanwp-media-remove" style="display:none;"><?php esc_html_e( 'Remove Image', 'ocean-extra' ); ?></a>
						<p class="desc"><?php esc_html_e( 'This option replace the theme screenshot in Appearance > Themes. Recommended size: 1200x900px', 'ocean-extra' ); ?></p>
					</td>
				</tr>

				<tr id="oceanwp_whitelabel_oceanwp_panel_tr">
					<th scope="row">
						<label for="oceanwp-whitelabel-oceanwp-panel"><?php esc_html_e( 'Whitelabel OceanWP Panel', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<input type="checkbox" id="oceanwp-whitelabel-oceanwp-panel" name="oceanwp_branding[whitelabel_oceanwp_panel]" value="1" <?php checked( '1', $settings['whitelabel_oceanwp_panel'] ); ?>>
					</td>
				</tr>
				<tr id="oceanwp_panel_logo_tr">
					<th scope="row">
						<label for="oceanwp-panel-logo"><?php esc_html_e( 'Theme panel Custom Logo:', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<div class="oceanwp-media-live-preview" style="display:none;">
							<?php
							$logo_preview = $settings['panel_logo'];
							if ( $logo_preview ) {
								?>
								<img src="<?php echo esc_url( $logo_preview ); ?>" alt="<?php esc_html_e( 'Preview Image', 'ocean-extra' ); ?>" />
							<?php } ?>
						</div>
						<input class="oceanwp-media-input" type="text" name="oceanwp_branding[panel_logo]" value="<?php echo esc_url( $settings['panel_logo'] ); ?>" class="regular-text">
						<input class="oceanwp-media-upload-button button-secondary" type="button" value="<?php esc_html_e( 'Upload', 'ocean-extra' ); ?>" />
						<a href="#" class="oceanwp-media-remove" style="display:none;"><?php esc_html_e( 'Remove Image', 'ocean-extra' ); ?></a>
						<p class="desc"><?php esc_html_e( 'This option replaces our logo in the Theme Panel header. Recommended size: 170x30px.', 'ocean-extra' ); ?></p>
					</td>
				</tr>
				<tr id="oceanwp_hide_oceanwp_news_tr">
					<th scope="row">
						<label for="oceanwp-hide-oceanwp-news"><?php esc_html_e( 'Hide the OceanWP News & Updates in the Dashboard', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<input type="checkbox" id="oceanwp-hide-oceanwp-news" name="oceanwp_branding[hide_oceanwp_news]" value="1" <?php checked( '1', $settings['hide_oceanwp_news'] ); ?>>
					</td>
				</tr>

				<?php /* ?>
				<tr id="oceanwp_hide_theme_panel_sidebar_tr">
					<th scope="row">
						<label for="oceanwp-hide-theme-panel-sidebar"><?php esc_html_e( 'Hide The Theme Panel Sidebar', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<input type="checkbox" id="oceanwp-hide-theme-panel-sidebar" name="oceanwp_branding[hide_theme_panel_sidebar]" value="1" <?php checked( '1', $settings['hide_theme_panel_sidebar'] ); ?>>
					</td>
				</tr>
				<?php */ ?>
				<tr id="oceanwp_hide_themes_customizer_tr">
					<th scope="row">
						<label for="oceanwp-hide-themes-customizer"><?php esc_html_e( 'Hide The Themes Section in the Customizer', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<input type="checkbox" id="oceanwp-hide-themes-customizer" name="oceanwp_branding[hide_themes_customizer]" value="1" <?php checked( '1', $settings['hide_themes_customizer'] ); ?>>
					</td>
				</tr>
				<tr id="oceanwp_hide_info_customizer_tr">
					<th scope="row">
						<label for="oceanwp-hide-info-customizer"><?php esc_html_e( 'Hide The Info Section in the Customizer', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<input type="checkbox" id="oceanwp-hide-info-customizer" name="oceanwp_branding[hide_info_customizer]" value="1" <?php checked( '1', $settings['hide_info_customizer'] ); ?>>
					</td>
				</tr>
				<tr id="oceanwp_hide_changelog_tr">
					<th scope="row">
						<label for="oceanwp-hide-changelog"><?php esc_html_e( 'Hide Changelog', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<input type="checkbox" id="oceanwp-hide-changelog" name="oceanwp_branding[hide_changelog]" value="1" <?php checked( '1', $settings['hide_changelog'] ); ?>>
                        <p class="desc"><?php esc_html_e( 'Check this option to hide Changelog Section from Theme Panel.', 'ocean-extra' ); ?></p>
					</td>
				</tr>
				<tr id="oceanwp_hide_help_section_tr">
					<th scope="row">
						<label for="oceanwp-hide-help-section"><?php esc_html_e( 'Hide Help Section', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<input type="checkbox" id="oceanwp-hide-help-section" name="oceanwp_branding[hide_help_section]" value="1" <?php checked( '1', $settings['hide_help_section'] ); ?>>
                        <p class="desc"><?php esc_html_e( 'Check this option to hide Help Section from Theme Panel.', 'ocean-extra' ); ?></p>
					</td>
				</tr>
				<tr id="oceanwp_hide_download_section_tr">
					<th scope="row">
						<label for="oceanwp-hide-download-section"><?php esc_html_e( 'Hide Download Section on Home', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<input type="checkbox" id="oceanwp-hide-download-section" name="oceanwp_branding[hide_download_section]" value="1" <?php checked( '1', $settings['hide_download_section'] ); ?>>
                        <p class="desc"><?php esc_html_e( 'Check this option to hide Download Section on Home from Theme Panel.', 'ocean-extra' ); ?></p>
					</td>
				</tr>
				<tr id="oceanwp_hide_love_corner_section_tr">
					<th scope="row">
						<label for="oceanwp-hide-love-corner-section"><?php esc_html_e( 'Hide Love Corner Section on Home', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<input type="checkbox" id="oceanwp-hide-love-corner-section" name="oceanwp_branding[hide_love_corner_section]" value="1" <?php checked( '1', $settings['hide_love_corner_section'] ); ?>>
                        <p class="desc"><?php esc_html_e( 'Check this option to hide Love Corner Section on Home from Theme Panel.', 'ocean-extra' ); ?></p>
					</td>
				</tr>
				<tr id="oceanwp_hide_small_nav_menu_tr">
					<th scope="row">
						<label for="oceanwp-hide-small-nav-menu"><?php esc_html_e( 'Hide Small Navigation Menu', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<input type="checkbox" id="oceanwp-hide-small-nav-menu" name="oceanwp_branding[hide_small_nav_menu]" value="1" <?php checked( '1', $settings['hide_small_nav_menu'] ); ?>>
						<p class="desc"><?php esc_html_e( 'Check this option to hide Small Navigation Menu from Theme Panel.', 'ocean-extra' ); ?></p>
					</td>
				</tr>
				<tr id="oceanwp_hide_box_tr">
					<th scope="row">
						<label for="oceanwp-hide-box"><?php esc_html_e( 'Hide This Box', 'ocean-extra' ); ?></label>
					</th>
					<td>
						<input type="checkbox" id="oceanwp-hide-box" name="oceanwp_branding[hide_box]" value="1" <?php checked( '1', $settings['hide_box'] ); ?>>
                        <p class="desc"><?php esc_html_e( 'Check this option to hide this box. Re-activate Ocean White Label to display this box again.', 'ocean-extra' ); ?></p>
					</td>
				</tr>

			</tbody>
		</table>

		<?php submit_button(); ?>
	</form>
</div>
