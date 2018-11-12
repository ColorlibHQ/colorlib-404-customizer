<?php
if ( class_exists( 'WP_Customize_Control' ) ) {

	if ( ! class_exists( 'CCSM_Control_Text_Editor' ) ) {

		class CCSM_Control_Text_Editor extends WP_Customize_Control {

		    public $type = 'ccsm-editor';

			public
			function render_content() {
			    //replace '[' , ']' characters for wp_editor functionality to work correctly
				$id = str_replace( '[', '', $this->id );
				$id = str_replace( ']', '', $id );
				?>
                <label><?php echo $this->label; ?></label>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
                </span>
                <textarea id="<?php echo $id ?>"
                          class="widefat text wp-editor-area js-ccsm-editor" <?php echo $this->link(); ?><?php echo $this->value(); ?></textarea>
				<?php
			}
		}
	}
}