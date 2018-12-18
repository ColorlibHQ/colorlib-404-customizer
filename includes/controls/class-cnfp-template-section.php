<?php
if (class_exists('WP_Customize_Section')) {
    class CNFP_Templates_Section extends WP_Customize_Section
    {

        public $type = 'outer';

        public function __construct( WP_Customize_Manager $manager, $id, array $args = array() ) {
            $manager->register_section_type( 'CNFP_Templates_Section' );
            parent::__construct( $manager, $id, $args );
        }
        public function render_template() {
            ?>
            <li id="accordion-section-{{ data.id }}" class="accordion-section control-panel-themes">
                <h3 class="accordion-section-title">
                    <?php
                    $ccsm_options = get_option('cnfp_settings');
                    $active_template = $ccsm_options['colorlib_404_customizer_select_template'];
                    echo '<span class="customize-action">' . __( 'Active Template','ccsm' ) . '</span>'.ucfirst(str_replace('_',' ',$active_template));
                    ?>
                    <button type="button" class="button change-theme" aria-label="<?php esc_attr_e( 'Change theme' ); ?>"><?php _ex( 'Change', 'ccsm' ); ?></button>
                </h3>
                <ul class="accordion-sub-container control-panel-content"></ul>
            </li>
            <?php
        }
    }
}