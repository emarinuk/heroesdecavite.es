<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_info extends Widget_Base {

	public function get_name() {
		return 'ova_info';
	}

	public function get_title() {
		return __( 'Info', 'ova-framework' );
	}

	public function get_icon() {
		return 'fa fa-info';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {
		return [ 'script-elementor' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_version_info',
			[
				'label' => __( 'Version Info', 'ova-framework' ),
			]
		);
			$this->add_control(
				'version_info',
				[
					'label' => __( 'Choose Type Info', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'info_staff',
					'options' => [
						'info_staff' => __( 'Info Staff', 'ova-framework' ),
						'info_contact' => __( 'Info Contact', 'ova-framework' ),
					],
				]
			);
		$this->end_controls_section();


		/****************************************************************************************************
													SECTION CONTENT INFO STAFF
		*****************************************************************************************************/

		$this->start_controls_section(
			'section_content_staff',
			[
				'label' => __( 'Info Staff', 'ova-framework' ),
				'condition' => [
					'version_info' => ['info_staff'],
				],
			]
		);
 
			$this->add_control(
				'title_staff',
				[
					'label' => __( 'Title', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'Title',
				]
			);

			$this->add_control(
				'sub_title_staff',
				[
					'label' => __( 'Sub Title', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'Sub Title',
				]
			);

			$this->add_control(
				'phone_staff',
				[
					'label' => __( 'Phone', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '(+64)686 889 6789',
				]
			);

			$this->add_control(
				'email_staff',
				[
					'label' => __( 'Email', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'E-Mail',
				]
			);

			$this->add_control(
				'link_email_staff',
				[
					'label' => __( 'Link Email', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'someone@example.com',
				]
			);

			$this->add_responsive_control(
				'align_staff',
				[
					'label' => __( 'Alignment', 'ova-framework' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left'    => [
							'title' => __( 'Left', 'ova-framework' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'ova-framework' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'ova-framework' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'default' => 'center',
					'selectors' => [
						'{{WRAPPER}} .ova_info .ova_info_staff ' => 'text-align: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
		// end tab section_content_Staff


		/****************************************************************************************************
													SECTION CONTENT INFO CONTACT
		*****************************************************************************************************/


		$this->start_controls_section(
			'section_content_contact',
			[
				'label' => __( 'Info Contact', 'ova-framework' ),
				'condition' => [
					'version_info' => ['info_contact'],
				],
			]
		);
 
			$this->add_control(
				'title_contact',
				[
					'label' => __( 'Title', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'Title',
				]
			);

			$this->add_control(
				'sub_title_contact',
				[
					'label' => __( 'Sub Title', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'Sub Title',
				]
			);

			$this->add_control(
				'phone_contact',
				[
					'label' => __( 'Phone', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '(+64)686 889 6789',
				]
			);

			$this->add_control(
				'email_contact',
				[
					'label' => __( 'Email', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'E-Mail',
				]
			);

			$this->add_control(
				'link_email_contact',
				[
					'label' => __( 'Link Email', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'someone@example.com',
				]
			);


			$this->add_responsive_control(
				'align_contact',
				[
					'label' => __( 'Alignment', 'ova-framework' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left'    => [
							'title' => __( 'Left', 'ova-framework' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'ova-framework' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'ova-framework' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'default' => 'center',
					'selectors' => [
						'{{WRAPPER}} .ova_info .ova_info_contact ' => 'text-align: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
		//END SECTION CONTENT CONTACT

		/****************************************************************************************************
													SECTION STYLE INFO STAFF
		*****************************************************************************************************/


		//SECTION TAB STYLE TITLE STAFF
		$this->start_controls_section(
			'section_style_title_staff',
			[
				'label' => __( 'Title Staff', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'version_info' => ['info_staff'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ova_info .ova_info_staff h3.title',
			]
		);

		$this->add_control(
			'color_title_staff',
			[
				'label' => __( 'Color Title', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_info .ova_info_staff h3.title' => 'color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE TITLE STAFF

		//SECTION TAB STYLE SUB TITLE STAFF
		$this->start_controls_section(
			'section_style_sub_title_staff',
			[
				'label' => __( 'Sub Title Staff', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'version_info' => ['info_staff'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_typography',
				'selector' => '{{WRAPPER}} .ova_info .ova_info_staff h4.sub-title',
			]
		);

		$this->add_control(
			'color_sub_title_staff',
			[
				'label' => __( 'Color Sub Title', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_info .ova_info_staff h4.sub-title' => 'color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE SUB TITLE STAFF

		//SECTION TAB STYLE PHONE, EMAIL STAFF
		$this->start_controls_section(
			'section_style_phone_staff',
			[
				'label' => __( 'Phone, Email Staff', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'version_info' => ['info_staff'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'phone_typography',
				'selector' => '{{WRAPPER}} .ova_info .ova_info_staff .info-contact span',
			]
		);

		$this->add_control(
			'color_phone_staff',
			[
				'label' => __( 'Color Phone, Email', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_info .ova_info_staff .info-contact span' => 'color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE PHONE, EMAIL STAFF

		/****************************************************************************************************
													SECTION STYLE INFO CONTACT
		*****************************************************************************************************/


		//SECTION TAB STYLE TITLE CONTACT
		$this->start_controls_section(
			'section_style_title_contact',
			[
				'label' => __( 'Title Contact', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'version_info' => ['info_contact'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_contact_typography',
				'selector' => '{{WRAPPER}} .ova_info .ova_info_contact h3.title',
			]
		);

		$this->add_control(
			'color_title_contact',
			[
				'label' => __( 'Color Title', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_info .ova_info_contact h3.title' => 'color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE TITLE CONTACT

		//SECTION TAB STYLE SUB TITLE CONTACT
		$this->start_controls_section(
			'section_style_sub_title_contact',
			[
				'label' => __( 'Sub Title', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'version_info' => ['info_contact'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_contact_typography',
				'selector' => '{{WRAPPER}} .ova_info .ova_info_contact h4.sub-title',
			]
		);

		$this->add_control(
			'color_sub_title_contact',
			[
				'label' => __( 'Color Sub Title', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_info .ova_info_contact h4.sub-title' => 'color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE SUB TITLE CONTACT

		//SECTION TAB STYLE PHONE, EMAIL CONTACTCONTACT
		$this->start_controls_section(
			'section_style_phone_contact',
			[
				'label' => __( 'Phone, Email Staff', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'version_info' => ['info_contact'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'phone_contact_typography',
				'selector' => '{{WRAPPER}} .ova_info .ova_info_contact .info-contact span',
			]
		);

		$this->add_control(
			'color_phone_contact',
			[
				'label' => __( 'Color Phone, Email', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_info .ova_info_contact .info-contact span' => 'color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE PHONE, EMAIL CONTACT



	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$version_info = $settings['version_info'];

		switch($version_info) {
			case "info_staff" : {
				$title = $settings['title_staff'];
				$sub_title = $settings['sub_title_staff'];
				$phone = $settings['phone_staff'];
				$email = $settings['email_staff'];
				$link_email = $settings['link_email_staff'];
				break;
			}
			case "info_contact" : {
				$title = $settings['title_contact'];
				$sub_title = $settings['sub_title_contact'];
				$phone = $settings['phone_contact'];
				$email = $settings['email_contact'];
				$link_email = $settings['link_email_contact'];
				break;
			}
		}

		
	?>
	<div class="ova_info">
		<?php if ($version_info === 'info_staff') : ?>
		<div class="ova_info_staff">
			<?php if (!empty($title)) : ?>
				<h3 class="title second_font"><?php echo esc_html($title) ?></h3>
			<?php endif ?>
			<?php if (!empty($sub_title)) : ?>
				<h4 class="sub-title" ><?php echo esc_html($sub_title) ?></h4>
			<?php endif ?>
			<div class="info-contact">
				<?php if (!empty($phone)) : ?>
					<a href="tel:<?php echo esc_attr($phone) ?>" class="phone"><?php echo esc_html($phone) ?></a>
				<?php endif ?>

				<?php if (!empty($email)) : ?>
					<?php if (!empty($phone)) : ?>
						<span class="separator"><?php echo esc_html('/') ?></span>
					<?php endif ?>
					<a class="email" href="mailto:<?php echo esc_html($link_email) ?>"><?php echo esc_html($email) ?></a>
				<?php endif ?>
			</div>
		</div>
		<!-- end .ova_info_staff -->
		<?php endif ?>
		
		<?php if ($version_info === 'info_contact') : ?>
			<div class="ova_info_contact">
				<?php if (!empty($title)) : ?>
					<h3 class="title second_font"><?php echo esc_html($title) ?></h3>
				<?php endif ?>
				<?php if (!empty($sub_title)) : ?>
					<h4 class="sub-title" ><?php echo esc_html($sub_title) ?></h4>
				<?php endif ?>
				<div class="info-contact">
					<?php if (!empty($phone)) : ?>
						<a href="tel:<?php echo esc_attr($phone) ?>" class="phone"><?php echo esc_html($phone) ?></a>
					<?php endif ?>

					<?php if (!empty($email)) : ?>
						<a class="email" href="mailto:<?php echo esc_html($link_email) ?>"><?php echo esc_html($email) ?></a>
					<?php endif ?>
				</div>
			</div>
		<?php endif ?>
	</div>
	<?php
	}
}
