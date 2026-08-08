<?php
/**
 * A textarea that the control-frame script upgrades to TinyMCE.
 *
 * @package Colorlib_404_Customizer
 */

defined( 'ABSPATH' ) || exit;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'CNFP_Control_Text_Editor' ) ) {

	/**
	 * Rich-text control for the heading, content and button strings.
	 */
	class CNFP_Control_Text_Editor extends WP_Customize_Control {

		/**
		 * Control type.
		 *
		 * @var string
		 */
		public $type = 'cnfp-editor';

		/**
		 * Render the textarea.
		 *
		 * @return void
		 */
		public function render_content() {
			// `wp.editor.initialize()` takes a DOM id, and TinyMCE chokes on the
			// brackets in `cnfp_settings[...]`, so strip them for the id only.
			$id = str_replace( array( '[', ']' ), '', (string) $this->id );
			?>
			<label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $this->label ); ?></label>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
			<textarea id="<?php echo esc_attr( $id ); ?>" class="widefat text wp-editor-area js-cnfp-editor"
				<?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			<?php
		}
	}
}
