<?php
if ( class_exists( 'WP_Customize_Control' ) ) {
	if ( ! class_exists( 'CNFP_Template_Selection' ) ) {

		class CNFP_Template_Selection extends WP_Customize_Control {
			/**
			 * The type of control being rendered
			 */
			public $type = 'template_select_radio';

			/**
			 * Render the control in the customizer
			 */
			public function render_content() {
				?>
                <div class="colorlib_template_selection_radio">
                    <div class="colorlib-templates-wrapper">
						<?php foreach ( $this->choices as $key => $value ) { ?>
                            <label class="colorlib-single-template-wrapper">
                                <img
                                        src="<?php echo CNFP_URL . 'templates/' . esc_attr( $key ) . '/' . esc_attr( $key ) . '.jpg' ?>">
                                <input class="colorlib-template-radio" type="radio"
                                       name="<?php echo esc_attr( $this->id ); ?>"
                                       value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
                            </label>
						<?php } ?>
                    </div>
                </div>
				<?php
			}
		}
	}
}