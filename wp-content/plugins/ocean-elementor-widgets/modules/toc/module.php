<?php
namespace owpElementor\Modules\TOC;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'TOC',
		];
	}

	public function get_name() {
		return 'oew-toc';
	}
}
