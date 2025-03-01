<?php
namespace owpElementor\Modules\StoryPortfolio;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Story_Portfolio',
		];
	}

	public function get_name() {
		return 'oew-story-portfolio';
	}
}
