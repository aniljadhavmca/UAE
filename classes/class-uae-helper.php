<?php 

if ( ! class_exists( 'UaeHelper' ) ) {

	final class UaeHelper {

		function __construct() {

			add_action( 'elementor/init', array( $this, 'add_elementor_category' ) );
		}

		function add_elementor_category() {
		    Elementor\Plugin::instance()->elements_manager->add_category(
		        'ultimate-elements',
		        [
		            'title'  => 'Ultimate Elements',
		            'icon' => 'font'
		        ],
		        1
		    );
		}
	}
	new UaeHelper();
}