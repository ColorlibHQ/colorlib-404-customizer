<?php
/**
 * On/off switch control.
 *
 * @package Colorlib_404_Customizer
 */

defined( 'ABSPATH' ) || exit;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'CNFP_Control_Toggle' ) ) {

	/**
	 * A styled checkbox, rendered from a JS template.
	 */
	class CNFP_Control_Toggle extends WP_Customize_Control {

		/**
		 * Control type.
		 *
		 * @var string
		 */
		public $type = 'cnfp-toggle';

		/**
		 * Register the control type so its JS template is printed once.
		 *
		 * @param WP_Customize_Manager $manager Customizer manager.
		 * @param string               $id      Control id.
		 * @param array                $args    Control arguments.
		 */
		public function __construct( WP_Customize_Manager $manager, $id, array $args = array() ) {
			parent::__construct( $manager, $id, $args );

			$manager->register_control_type( 'CNFP_Control_Toggle' );
		}

		/**
		 * Extra data for the JS template.
		 *
		 * @return array
		 */
		public function json() {
			$json = parent::json();

			$json['id']      = $this->id;
			$json['link']    = $this->get_link();
			$json['value']   = $this->value();
			$json['checked'] = ( '1' === (string) $this->value() );
			$json['inputId'] = 'cnfp-toggle-' . str_replace( array( '[', ']' ), array( '-', '' ), (string) $this->id );

			return $json;
		}

		/**
		 * Rendered from `content_template()` instead.
		 *
		 * @return void
		 */
		public function render_content() {}

		/**
		 * The Underscore template for this control.
		 *
		 * @return void
		 */
		public function content_template() {
			?>
			<div class="colorlib_cnfp">
				<div class="checkbox_switch">
					<div>
						<div class="cf toggle-wrapper">
							<div class="right-toggle">
								<label for="{{ data.inputId }}">{{{ data.label }}}</label>
								<div class="epsilon-toggle">
									<input class="epsilon-toggle__input" type="checkbox"
										id="{{ data.inputId }}" value="1" {{{ data.link }}}
										<# if ( data.checked ) { #> checked="checked" <# } #> >
									<div class="epsilon-toggle__items">
										<span class="epsilon-toggle__track"></span>
										<span class="epsilon-toggle__thumb"></span>
										<svg class="epsilon-toggle__off" width="6" height="6" aria-hidden="true" focusable="false" viewBox="0 0 6 6">
											<path d="M3 1.5c.8 0 1.5.7 1.5 1.5S3.8 4.5 3 4.5 1.5 3.8 1.5 3 2.2 1.5 3 1.5M3 0C1.3 0 0 1.3 0 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3z"></path>
										</svg>
										<svg class="epsilon-toggle__on" width="2" height="6" aria-hidden="true" focusable="false" viewBox="0 0 2 6">
											<path d="M0 0h2v6H0z"></path>
										</svg>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
