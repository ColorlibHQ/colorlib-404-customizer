<?php
/**
 * The template picker control.
 *
 * @package Colorlib_404_Customizer
 */

defined( 'ABSPATH' ) || exit;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'CNFP_Template_Selection' ) ) {

	/**
	 * A grid of preview thumbnails backed by radio inputs.
	 */
	class CNFP_Template_Selection extends WP_Customize_Control {

		/**
		 * Control type.
		 *
		 * @var string
		 */
		public $type = 'cnfp-templates';

		/**
		 * Render the grid.
		 *
		 * @return void
		 */
		public function render_content() {
			?>
			<div class="colorlib_template_selection_radio">
				<div class="colorlib-templates-wrapper">
					<?php foreach ( $this->choices as $key => $label ) : ?>
						<label class="colorlib-single-template-wrapper">
							<input class="colorlib-template-radio" type="radio"
								name="<?php echo esc_attr( $this->id ); ?>"
								value="<?php echo esc_attr( $key ); ?>"
								<?php $this->link(); ?>
								<?php checked( $key, $this->value() ); ?> />
							<?php
							/*
							 * Twenty thumbnails on one panel; let the browser skip the
							 * ones the user never scrolls to.
							 */
							?>
							<img src="<?php echo esc_url( CNFP_URL . 'templates/' . $key . '/' . $key . '.png' ); ?>"
								alt="<?php echo esc_attr( $label ); ?>"
								loading="lazy" decoding="async" />
						</label>
					<?php endforeach; ?>
				</div>
			</div>
			<?php
		}
	}
}
