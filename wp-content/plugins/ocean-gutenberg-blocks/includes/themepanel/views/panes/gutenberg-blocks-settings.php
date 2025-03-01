<?php

$gutenberg_blocks             = scandir( OGB_INC . 'blocks/modules' );
$oe_gutenberg_blocks_settings = get_option( 'oe_gutenberg_blocks_settings', 0 );
if ( empty( $oe_gutenberg_blocks_settings ) && $oe_gutenberg_blocks_settings !== 0 ) {
	$oe_gutenberg_blocks_settings = array();
}

?>



<div id="ocean-gutenberg-blocks-control" class="column-wrap clr">
	<form class="save_panel_settings">
		<input type="hidden" name="option_name" value="oe_gutenberg_blocks_settings" />

		<div id="ocean-gutenberg-blocks-disable-bulk" class="oceanwp-tp-switcher column-wrap clr">
			<label for="oceanwp-switch-gutenberg-blocks-disable-bulk" class="column-name">
				<input type="checkbox" role="checkbox" name="gutenberg-blocks-disable-bulk" value="true" <?php checked( ( $oe_gutenberg_blocks_settings === 0 ) ); ?> id="oceanwp-switch-gutenberg-blocks-disable-bulk" class="oe-switcher-bulk" />
				<span class="slider round"></span>
			</label>
		</div>

		<div id="ocean-gutenberg-blocks-items" class="column-wrap clr">
			<?php foreach ( $gutenberg_blocks as $module_key ) : ?>
				<?php
				if ( $module_key == '.' || $module_key == '..' ) {
					continue;
				}
				?>
				<?php
				$module_label = ucwords( str_replace( '-', ' ', $module_key ) );
				if ( $oe_gutenberg_blocks_settings === 0 ) {
					$checked_val = true;
				} else {
					$checked_val = ! empty( $oe_gutenberg_blocks_settings[ $module_key ] );
				}
				?>
				<div id="ocean-gutenberg-blocks-<?php echo $module_key; ?>" class="oceanwp-tp-small-block column-wrap clr">
					<h3 class="title"><?php echo esc_attr( $module_label ); ?></h3>
					<!-- <div class="oceanwp-switcher-block"> -->
						<!-- <div class="oceanwp-switcher-item"> -->
							<label for="oceanwp-gutenberg-blocks-switch-[<?php echo esc_attr( $module_key ); ?>]" class="oceanwp-tp-switcher column-name">
								<input type="checkbox" role="checkbox" name="oe_gutenberg_blocks_settings[<?php echo esc_attr( $module_key ); ?>]" value="true" id="oceanwp-gutenberg-blocks-switch-[<?php echo esc_attr( $module_key ); ?>]" <?php checked( $checked_val ); ?>>
								<span class="slider round"></span>
							</label>
						<!-- </div> -->
					<!-- </div> -->
				</div>
			<?php endforeach; ?>
		</div>
		<?php submit_button(); ?>
	</form>
</div>
