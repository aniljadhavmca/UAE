<?php

if ( ! class_exists('UaeModule') ) {

	final class UaeModule {

		static public function init() {

			add_action('elementor/widgets/widgets_registered', __CLASS__ . '::add_modules');

		}

		/* Initialize Module */
		
		static public function add_modules() {

			include	 UAE_DIR . 'modules/uae-heading.php';

		}
	}

	UaeModule::init();

}