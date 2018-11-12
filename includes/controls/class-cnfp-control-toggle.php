<?php
if ( class_exists( 'WP_Customize_Control' ) ) {

	if ( ! class_exists( 'CCSM_Control_Toggle' ) ) {

		class CCSM_Control_Toggle extends WP_Customize_Control {

			/**
			 * The type of customize control being rendered.
			 *
			 * @since  1.0.0
			 * @access public
			 * @var    string
			 */
			public $type = 'ccsm-toggle';

			/**
			 * CCSM_Control_Toggle constructor.
			 *
			 * @param WP_Customize_Manager $manager
			 * @param string $id
			 * @param array $args
			 */
			public function __construct( WP_Customize_Manager $manager, $id, array $args = array() ) {
				parent::__construct( $manager, $id, $args );
				$manager->register_control_type( 'CCSM_Control_Toggle' );
			}

			/**
			 * Add custom parameters to pass to the JS via JSON.
			 *
			 * @since  1.0.0
			 * @access public
			 */
			public function json() {
				$json          = parent::json();
				$json['id']    = $this->id;
				$json['link']  = $this->get_link();
				$json['value'] = $this->value();

				return $json;
			}

			/**
			 * Empty, as it should.
			 *
			 * @since  1.0.0
			 * @access public
			 * @return void
			 */
			public function render_content() {

			}

			/**
			 * @since  1.0.0
			 * @access public
			 */


			public function content_template() {
				//@formatter:off
				?>
                <div class="colorlib_csmm">
                    <div class="checkbox_switch">
                        <div>
                            <div class="cf toggle-wrapper">
                                <div class="left-toggle">
                                    {{{ data.label }}}
                                </div>
                                <div class="right-toggle">
                                    <input type="checkbox" id="{{{ data.id }}}" name="{{{ data.id }}}"
                                           class="onoffswitch-checkbox" value="{{{ data.value }}}" {{{ data.link }}} <#
                                    if(
                                    data.value ) { #> checked="checked" <# } #> >
                                    <label class="onoffswitch-label" for="{{{ data.id }}}"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<?php
				//@formatter:on
			}
		}
	}
}