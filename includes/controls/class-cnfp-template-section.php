<?php
if (class_exists('WP_Customize_Section')) {
    class CNFP_Templates_Section extends WP_Customize_Section {

        public $type = 'cnfp-templates-section';

        public function __construct( WP_Customize_Manager $manager, $id, array $args = array() ) {
            $manager->register_section_type( 'CNFP_Templates_Section' );
            parent::__construct( $manager, $id, $args );
        }

        public function json() {
            $array = parent::json();

            $array['button_label']    = esc_html__( 'Change', 'colorlib-404-customizer' );
            $ccsm_options = get_option('cnfp_settings');
            $array['active_template'] = str_replace( '_', ' ', $ccsm_options['colorlib_404_customizer_select_template'] );

            return $array;
        }

        public function render_template() {
            ?>
            <li id="accordion-section-{{ data.id }}" class="accordion-section control-panel-themes">
                <h3 class="accordion-section-title">
                    <span class="customize-action"><?php esc_html_e( 'Active Template','colorlib-404-customizer' ); ?></span>
                    <span class="cnfp-active_template">{{ data.active_template }}</span>
                    <button type="button" class="button change-theme" aria-label="<?php esc_html_e( 'Change Template','colorlib-404-customizer' ); ?>"><?php esc_html_e( 'Change','colorlib-404-customizer' ); ?></button>
                </h3>
                <ul class="accordion-section-content">
                    <li class="customize-section-description-container section-meta <# if ( data.description_hidden ) { #>customize-info<# } #>">
                        <div class="customize-section-title">
                            <button class="customize-section-back" tabindex="-1">
                                <span class="screen-reader-text"><?php esc_html_e( 'Back','colorlib-404-customizer' ); ?></span>
                            </button>
                            <h3>
                                <span class="customize-action">
                                    {{{ data.customizeAction }}}
                                </span>
                                {{ data.title }}
                            </h3>
                            <# if ( data.description && data.description_hidden ) { #>
                                <button type="button" class="customize-help-toggle dashicons dashicons-editor-help" aria-expanded="false"><span class="screen-reader-text"><?php esc_html_e( 'Help','colorlib-404-customizer' ); ?></span></button>
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