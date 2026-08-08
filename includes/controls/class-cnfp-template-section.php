<?php
/**
 * The collapsed "Active Template" section that slides out the picker.
 *
 * @package Colorlib_404_Customizer
 */

defined( 'ABSPATH' ) || exit;

if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'CNFP_Templates_Section' ) ) {

	/**
	 * Mirrors core's theme browser: a summary row with a Change button.
	 */
	class CNFP_Templates_Section extends WP_Customize_Section {

		/**
		 * Section type.
		 *
		 * @var string
		 */
		public $type = 'cnfp-templates-section';

		/**
		 * Register the section type so its JS template is printed.
		 *
		 * @param WP_Customize_Manager $manager Customizer manager.
		 * @param string               $id      Section id.
		 * @param array                $args    Section arguments.
		 */
		public function __construct( WP_Customize_Manager $manager, $id, array $args = array() ) {
			$manager->register_section_type( 'CNFP_Templates_Section' );

			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Extra data for the JS template.
		 *
		 * @return array
		 */
		public function json() {
			$data = parent::json();

			$data['button_label']    = esc_html__( 'Change', 'colorlib-404-customizer' );
			$data['active_template'] = str_replace( '_', ' ', cnfp_get_template() );

			return $data;
		}

		/**
		 * The Underscore template for this section.
		 *
		 * @return void
		 */
		public function render_template() {
			?>
			<li id="accordion-section-{{ data.id }}" class="accordion-section control-panel-themes">
				<h3 class="accordion-section-title">
					<span class="customize-action"><?php esc_html_e( 'Active Template', 'colorlib-404-customizer' ); ?></span>
					<span class="cnfp-active_template">{{ data.active_template }}</span>
					<button type="button" class="button change-theme" aria-label="<?php esc_attr_e( 'Change Template', 'colorlib-404-customizer' ); ?>">
						{{ data.button_label }}
					</button>
				</h3>
				<ul class="accordion-section-content">
					<li class="customize-section-description-container section-meta <# if ( data.description_hidden ) { #>customize-info<# } #>">
						<div class="customize-section-title">
							<button class="customize-section-back" tabindex="-1">
								<span class="screen-reader-text"><?php esc_html_e( 'Back', 'colorlib-404-customizer' ); ?></span>
							</button>
							<h3>
								<span class="customize-action">
									{{{ data.customizeAction }}}
								</span>
								{{ data.title }}
							</h3>
							<# if ( data.description && data.description_hidden ) { #>
								<button type="button" class="customize-help-toggle dashicons dashicons-editor-help" aria-expanded="false">
									<span class="screen-reader-text"><?php esc_html_e( 'Help', 'colorlib-404-customizer' ); ?></span>
								</button>
								<div class="description customize-section-description">
									{{{ data.description }}}
								</div>
							<# } #>

							<div class="customize-control-notifications-container"></div>
						</div>

						<# if ( data.description && ! data.description_hidden ) { #>
							<div class="description customize-section-description">
								{{{ data.description }}}
							</div>
						<# } #>
					</li>
				</ul>
			</li>
			<?php
		}
	}
}
