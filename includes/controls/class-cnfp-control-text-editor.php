<?php
if ( class_exists( 'WP_Customize_Control' ) ) {

	if ( ! class_exists( 'CNFP_Control_Text_Editor' ) ) {

		class CNFP_Control_Text_Editor extends WP_Customize_Control {

		    public $type = 'cnfp-editor';

			public
			function render_content() {
			    //replace '[' and ']' characters for wp_editor functionality to work correctly
				$id = str_replace( '[', '', $this->id );
				$id = str_replace( ']', '', $id );
				?>
                <label><?php echo esc_html( $this->label ); ?></label>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                </span>
                <textarea id="<?php echo esc_attr( $id ); ?>"
                          class="widefat text wp-editor-area js-cnfp-editor" <?php echo $this->link(); ?><?php echo esc_textarea( $this->value() ); ?></textarea>
				<?php
			}
		}
	}
}