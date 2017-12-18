<?php

if ( !class_exists( 'UaeLoader' ) ) {


	final class UaeLoader {

		static public function init() {

			self::define_constants();
			self::load_files();
		}
		/* Define Addon Constants */

		static private function define_constants() {
			define('UAE_FILE', trailingslashit(dirname(dirname(__FILE__))) . 'ultimate-addons-elementor.php');
			define('UAE_DIR',plugin_dir_path(UAE_FILE));
		}

		static private function load_files() {
			require_once UAE_DIR . 'classes/class-uae-helper.php';
			require_once UAE_DIR . 'classes/class-uae-module.php';
		}
	}

	UaeLoader::init();

}
