<?php
/**
 * Elementor_Bubbletech class.
 *
 * @category   Class
 * @package    ElementorBubbletech
 * @subpackage WordPress
 * @author     Maxime Herbiet
 * @copyright  2020 Herbiet Maxime
 * @link       link(https://www.bubbletech.be)
 * @since      1.0.0
 * php version 7.3.9
 */

namespace ElementorBubbletech\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

/**
 * Horaire widget class.
 *
 * @since 1.0.0
 */
class Horaire extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'horaire';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Horaire', 'elementor-bubbletech' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-clock';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'bubbletech' );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'elementor-pro' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => __( 'Title', 'elementor-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Horaire', 'elementor-pro' ),
			)
		);

		$this->add_control(
			'text_align',
			[
			  'label' => __( 'Alignment', 'elementor-pro' ),
			  'type' => \Elementor\Controls_Manager::CHOOSE,
			  'options' => [
				'left' => [
				  'title' => __( 'Left', 'elementor-pro' ),
				  'icon' => 'fa fa-align-left',
				],
				'center' => [
				  'title' => __( 'Center', 'elementor-pro' ),
				  'icon' => 'fa fa-align-center',
				],
				'right' => [
				  'title' => __( 'Right', 'elementor-pro' ),
				  'icon' => 'fa fa-align-right',
				],
			  ],
			  'default' => 'center',
			  'toggle' => true,
			]
		  );
		
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => __( 'Title', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Title' , 'elementor-pro' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_content', [
				'label' => __( 'Content', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Content' , 'elementor-pro' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_color',
			[
				'label' => __( 'Color', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'List', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Lundi', 'elementor-pro' ),
						'list_content' => __( '9h - 17h', 'elementor-pro' ),
					],
					[
						'list_title' => __( 'Mardi', 'elementor-pro' ),
						'list_content' => __( '9h - 17h', 'elementor-pro' ),
					],
					[
						'list_title' => __( 'Mercredi', 'elementor-pro' ),
						'list_content' => __( 'Fermé', 'elementor-pro' ),
					],
					[
						'list_title' => __( 'Jeudi', 'elementor-pro' ),
						'list_content' => __( '9h - 17h', 'elementor-pro' ),
					],
					[
						'list_title' => __( 'Vendredi', 'elementor-pro' ),
						'list_content' => __( '9h - 17h', 'elementor-pro' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
			  'label' => __( 'Style Section', 'elementor-pro' ),
			  'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		  );

		  $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
			  'name'     => 'list_style',
			  'label'    => __( 'Typography', 'elementor-pro' ),
			  'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			  'selector' => '{{WRAPPER}} .list-style',
			]
		  );

		  $this->add_control(
			'cell_padding',
			array(
				'label'   => __( 'Spacing', 'elementor-pro' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => __( '8', 'elementor-pro' ),
			)
			);

			$this->add_control(
				'background-filled',
				[
				  'label' => __( 'Background', 'elementor-pro' ),
				  'type' => \Elementor\Controls_Manager::CHOOSE,
				  'options' => [
					'' => [
					  'title' => __( 'Alternate', 'elementor-pro' ),
					  'icon' => 'fa fa-grip-lines',
					],
					'transparent !important' => [
					  'title' => __( 'Transparent', 'elementor-pro' ),
					  'icon' => 'fa fa-times',
					],
				  ],
				  'default' => 'center',
				  'toggle' => true,
				]
			  );


			$this->add_control(
				'separator',
				[
				  'label' => __( 'Separator', 'elementor-pro' ),
				  'type' => \Elementor\Controls_Manager::CHOOSE,
				  'options' => [
					'border: 1px solid #ccc' => [
					  'title' => __( 'Cell', 'elementor-pro' ),
					  'icon' => 'far fa-square',
					],
					'border: none !important; border-bottom: 1px solid #ccc !important' => [
					  'title' => __( 'Lines', 'elementor-pro' ),
					  'icon' => 'fa fa-grip-lines',
					],
					'border: none !important' => [
					  'title' => __( 'None', 'elementor-pro' ),
					  'icon' => 'fa fa-times',
					],
				  ],
				  'default' => 'center',
				  'toggle' => true,
				]
			  );

		  /* Add the options you'd like to show in this tab here */
		  
		  $this->end_controls_section();
		  
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'list', 'advanced' );
		?>
		<table style="text-align: <?php echo $settings['text_align'] ?>" class="list-style">
			<thead>
				<tr>
					<h2 style="text-align: <?php echo $settings['text_align'] ?>"><?php echo wp_kses( $settings['title'], array() ); ?></h2>
				</tr>
			</thead>
			<tbody>
			<?php
				if ( $settings['list'] ) {
					foreach (  $settings['list'] as $item ) {
						echo '<tr class="elementor-repeater-item-' . $item["_id"] . '">';
						echo '<td style="' . $settings['separator'] . '; padding: ' . $settings['cell_padding'] . 'px; background-color:' . $settings['background-filled'] . '">' . $item['list_title'] . '</td>';
						echo '<td style="' . $settings['separator'] . '; padding: ' . $settings['cell_padding'] . 'px; background-color:' . $settings['background-filled'] . '">' . $item['list_content'] . '</td>';
						echo '</tr>';
					}
				}
			?>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {
		?>
		
		<table style="text-align: {{{ settings.text_align }}}" class="list-style">
			<thead>
				<tr>
					<h2 style="text-align: {{{ settings.text_align }}}"> {{{ settings.title }}}</h2>
				</tr>
			</thead>
			<tbody>
				<# if ( settings.list.length ) { #>
					<# _.each( settings.list, function( item ) { #>
					<tr class="elementor-repeater-item-{{{ item._id }}}">
					<td style="{{ settings.separator }}; padding: {{{ settings.cell_padding }}}px; background-color: {{ settings['background-filled'] }}"> {{{ item.list_title }}} </td>
					<td style="{{ settings.separator }}; padding: {{{ settings.cell_padding }}}px; background-color: {{ settings['background-filled'] }}"> {{{ item.list_content }}} </td>
					</tr>
					<# }) #>
				<# } #>
			</tbody>
		</table>
		<?php
	}
}


