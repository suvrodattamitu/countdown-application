<?php
namespace Elementor;
namespace NinjaCountdown\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;

if (!defined('ABSPATH')) {
    exit;
}

class CountdownWidget extends Widget_Base {
	public function get_name() {//Get the slug of the element name.
		return 'countdown-widget';
	}

	public function get_title() {//Get the name of the element.
		return __('Countdown Timer', 'ninjacountdown');
	}

	public function get_icon() {//Get the icon of the element.
		return 'eicon-countdown';
	}
	
	public function get_categories() {//Include element into the category.
		return ['countdown-widget'];
	}

	public function get_script_depends() {
		return [ 'countdown_widget_manager' ]; //script handle
	}

	public function get_style_depends() {
		return [ 'countdown_widget_manager' ]; //style handle
	}
    
	protected function _register_controls() 
	{
		//contents: message
		$this->start_controls_section(
			'message_section',
			[
				'label' => __( 'Message', 'ninjacountdown' ),
			]
		);
		$this->add_control(
			'message',
			[
				'label'			=> __('MESSAGE BEFORE TIMER', 'ninjacountdown'),
				'type'			=> Controls_Manager::TEXTAREA,
				'default'		=> __('Get 50% off before it\'s too late ⏳','ninjacountdown'),
			]
		);
		$this->end_controls_section();

		//contents: timer
		$this->start_controls_section(
			'timer_section',
			[
				'label' => __( 'Timer', 'ninjacountdown' ),
			]
		);
	    $this->add_control(
			'countdown_due_date',
			[
				'label' => __( 'Due Date', 'ninjacountdown' ),
				'type' => Controls_Manager::DATE_TIME,
				'default' => date( 'Y-m-d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
				'description' => sprintf( __( 'Date set according to your timezone: %s.', 'ninjacountdown' ), Utils::get_timezone_string() ),
				
			]
		);
		$this->end_controls_section(); 

		//contents: button
		$this->start_controls_section(
			'button_section',
			[
				'label' => __( 'Button', 'ninjacountdown' ),
			]
		);
	    $this->add_control(
			'show_button',
			[
				'label' => __( 'SHOW BUTTON', 'ninjacountdown' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ninjacountdown' ),
				'label_off' => __( 'Hide', 'ninjacountdown' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'button_link',
			[
				'label'			=> __('BUTTON LINK', 'ninjacountdown'),
				'type'			=> Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ninjacountdown' ),
				'show_external' => true,
				'default' => [
					'url' => 'https://google.com',
					'is_external' => true,
					'nofollow' => true,
				],
				'condition'		=> [
					'show_button' => 'yes'
				],
			]
		);
        $this->add_control(
			'button_text',
			[
				'label'			=> __('BUTTON TEXT', 'ninjacountdown'),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __('Shop Now','ninjacountdown'),
				'condition'		=> [
					'show_button' => 'yes'
				],
			]
		);
		$this->end_controls_section();

		//styles: countdown style
		$this->start_controls_section(
			'countdown_style_section',
			[
				'label' => __( 'Countdown' , 'ninjacountdown' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'position',
			[
				'label'			=> __('POSITION', 'ninjacountdown'),
				'label_block'	=> false,
				'type'			=> Controls_Manager::SELECT,
                'description'   => __('Select where you want to show the countdown', 'ninjacountdown'),
				'options'		=> [
					'top'		=> __('Top', 'ninjacountdown'),
					'bottom'		=> __('Bottom', 'ninjacountdown'),
					'required_position'		=> __('Required Position', 'ninjacountdown'),
				],
				'default' => 'required_position'
			]
		);
		$this->add_control(
			'background_color',
			[
				'label' => __( 'BACKGROUND COLOR', 'ninjacountdown' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ninja-countdown-timer-container' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
		
		//styles: message style
		$this->start_controls_section(
			'message_style_section',
			[
				'label' => __( 'Message', 'ninjacountdown' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'message_color',
			[
				'label' => __( 'MESSAGE COLOR', 'ninjacountdown' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ninja-countdown-timer-header-title-text' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		//styles: message style
		$this->start_controls_section(
			'timer_style_section',
			[
				'label' => __( 'Timer', 'ninjacountdown' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'timer_color',
			[
				'label' => __( 'TIMER COLOR', 'ninjacountdown' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ninja-countdown-timer-item' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		//styles: button style
		$this->start_controls_section(
			'button_style_section',
			[
				'label' => __( 'Button' , 'ninjacountdown' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __( 'BUTTON COLOR', 'ninjacountdown' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ninja-countdown-timer-button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'BUTTON TEXT COLOR', 'ninjacountdown' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ninja-countdown-timer-button' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();  
	}
	
	protected function render() 
	{
		$settings = $this->get_settings();
		$date = strtotime($settings['countdown_due_date'])*1000;

		?>
		<div class="nfd-container">
			<div class="nfd-row">
				<div id="countdown-timer-wrapper ninja-wrapper-styler" class="ninja-countdown-timer-wrapper <?php echo 'timer-position-'.$settings['position']; ?> <?php echo $settings['position'] !== 'required_position' ? 'timer-floating-option-frontend' : ''; ?>">
					<div class="ninja-countdown-timer-container">
						<div class="ninja-countdown-timer">
							<div class="ninja-countdown-timer-header">
								<div class="ninja-countdown-timer-header-title-text">
									<?php echo esc_html($settings['message']); ?>
								</div>
							</div>
							<div class="ninja-countdown-timer-item-container"  id="ninja_countdown" data-position="<?php echo esc_html($settings['position']); ?>" data-enddatetime="<?php echo esc_html($date); ?>">
								<div class="ninja-countdown-timer-item">
									<div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
										<div class="ninja-countdown-timer-item-group-inner">
											<div class="ninja-countdown-timer-item" id="days">0</div>
										</div>
										<div class="ninja-countdown-timer-item-group-label" title="Days">Days</div>
									</div>
									<div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
										<div class="ninja-countdown-timer-item-group-inner">
											<div class="ninja-countdown-timer-item" id="hours">0</div>
										</div>
										<div class="ninja-countdown-timer-item-group-label" title="Days">Hours</div>
									</div>
									<div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
										<div class="ninja-countdown-timer-item-group-inner">
											<div class="ninja-countdown-timer-item" id="minutes">0</div>
										</div>
										<div class="ninja-countdown-timer-item-group-label" title="Days">Minutes</div>
									</div>
									<div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
										<div class="ninja-countdown-timer-item-group-inner">
											<div class="ninja-countdown-timer-item" id="seconds">0</div>
										</div>
										<div class="ninja-countdown-timer-item-group-label" title="Days">Seconds</div>
									</div>
								</div>
							</div>
							<?php if( $settings['show_button'] === 'yes' ) {?>
								<div class="ninja-countdown-timer-button-container">
									<a class="ninja-countdown-timer-button" href="<?php echo esc_url($settings['button_link']['url']); ?>" target="_blank">
										<?php echo esc_html($settings['button_text']); ?>
									</a>
								</div>
							<?php } ?>
						</div>
						<?php if($settings['position'] !== 'required_position'): ?>
							<div class="ninja-countdown-timer-bar-close" id="close_ninja_timer"></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	protected function _content_template() {}
}
