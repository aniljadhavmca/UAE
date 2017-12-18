<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Uae_Module_Heading extends Widget_Base {

	public function get_name() {
		return 'uae-heading';
	}

	public function get_title() {
		return __( 'Ultimate - Heading', 'uae' );
	}
	
	public function get_icon() {
		return 'eicon-type-tool';
	}

	public function get_categories() {
		return [ 'ultimate-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Heading', 'uae' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'uae' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter your title', 'uae' ),
			]
		); 
		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'uae' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
				'default' => [
					'url' => '',
				],
				'separator' => 'before',
			]
		); 

		$this->add_control(
			'header_size',
			[
				'label' => __( 'HTML Tag', 'uae' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => __( 'H1', 'uae' ),
					'h2' => __( 'H2', 'uae' ),
					'h3' => __( 'H3', 'uae' ),
					'h4' => __( 'H4', 'uae' ),
					'h5' => __( 'H5', 'uae' ),
					'h6' => __( 'H6', 'uae' ),
					'div' => __( 'div', 'uae' ),
					'span' => __( 'span', 'uae' ),
					'p' => __( 'p', 'uae' ),
				],
				'default' => 'h2',
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'uae' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Heading', 'uae' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'uae' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .uae-heading-title a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .uae-heading-title' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['title'] ) ) {
			return;
		}
		$this->add_render_attribute( 'title', 'class', 'uae-heading-title' );

		$title = $settings['title'];

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'url', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'url', 'target', '_blank' );
			}

			if ( ! empty( $settings['link']['nofollow'] ) ) {
				$this->add_render_attribute( 'url', 'rel', 'nofollow' );
			}

			$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
		}

		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'title' ), $title );
		?>
		<div class = "uae-heading-title">
		<?php
		echo $title_html;
		?>
		</div>
		<?php
		// echo $settings['title'];
	}

	protected function _content_template() {
		?>
		<div class="title">
			<#
			var title = settings.title;
			

			if ( '' !== settings.link.url ) {
				title = '<a href="' + settings.link.url + '">' + title + '</a>';
			}
			var title_html = '<' + settings.header_size + ' class="uae-heading-title" >' + title + '</' + settings.header_size + '>';

			print( title_html );

			 #>
		</div>
		<?php
	}

}
Plugin::instance()->widgets_manager->register_widget_type( new Uae_Module_Heading() );