<?php
/* Colorlib 404 Customizer Options */


class CNFP_Customizer {

	public function __construct() {

		add_action( 'customize_register', array( $this, 'cnfp_customizer_controls' ) );
		add_action( 'customize_register', array( $this, 'cnfp_panels_initialize' ) );
		add_action( 'admin_menu', array( $this, 'cnfp_add_menu_item' ) );
		add_action( 'admin_init', array( $this, 'cnfp_redirect_customizer' ) );
	}

	public function cnfp_panels_initialize( $wp_customize ) {

		$wp_customize->add_panel( 'colorlib_404_customizer_panel', array(
				'priority' => 1,
				'title'    => esc_html__( 'Colorlib 404 Customizer Settings', 'colorlib-404-customizer' ),
			)
		);


		/* Section - 404 Page - Templates */
		$wp_customize->add_section( 'colorlib_404_customizer_template_selection', array(
				'title'    => esc_html__( 'Templates', 'colorlib-404-customizer' ),
				'panel'    => 'colorlib_404_customizer_panel',
				'priority' => 5,
				'type'     => 'outer'
			)
		);

		/* Section - 404 Page - General */
		$wp_customize->add_section( 'colorlib_404_customizer_general', array(
				'title'    => esc_html__( 'General', 'colorlib-404-customizer' ),
				'panel'    => 'colorlib_404_customizer_panel',
				'priority' => 10,
			)
		);

		/* Section - 404 Page - Social Links */
		$wp_customize->add_section( 'colorlib_404_customizer_social_settings', array(
				'title'    => esc_html__( 'Social Links', 'colorlib-404-customizer' ),
				'panel'    => 'colorlib_404_customizer_panel',
				'priority' => 35,
			)
		);


		/* Section - 404 Page - Custom CSS */
		$wp_customize->add_section( 'colorlib_404_customizer_custom_css', array(
				'title'     => esc_html__( 'Custom CSS', 'colorlib-404-customizer' ),
				'panel'     => 'colorlib_404_customizer_panel',
				'priority'  => 40,
				'code_type' => 'text/css',
			)
		);

	}


	public function cnfp_customizer_controls( $wp_customize ) {

		require_once( CNFP_PATH . 'includes/controls/class-cnfp-control-text-editor.php' );
		require_once( CNFP_PATH . 'includes/controls/class-cnfp-control-toggle.php' );
		require_once( CNFP_PATH . 'includes/controls/class-cnfp-template-selection.php' );

		/* Setting - Coming Soon - Activation */
		$wp_customize->add_setting( 'cnfp_settings[colorlib_404_customizer_activation]', array(
			'default'           => '1',
			'sanitize_callback' => 'cnfp_sanitize_text',
			'type'              => 'option',
		) );

		$wp_customize->add_control( new CNFP_Control_Toggle ( $wp_customize, 'cnfp_settings[colorlib_404_customizer_activation]', array(
				'label'       => esc_html__( 'Activate Colorlib 404 Customizer?', 'colorlib-404-customizer' ),
				'description' => esc_html__( '', 'colorlib-404-customizer' ),
				'section'     => 'colorlib_404_customizer_general',
				'priority'    => 10,
			) )
		);

		/* Setting - 404 Page - Custom CSS */
		$wp_customize->add_setting( 'cnfp_settings[colorlib_404_customizer_custom_css]', array(
			'sanitize_callback' => 'cnfp_sanitize_text',
			'type'              => 'option'
		) );

		$wp_customize->add_control( new WP_Customize_Code_Editor_Control ( $wp_customize, 'cnfp_settings[colorlib_404_customizer_custom_css]', array(
				'label'       => esc_html__( 'Custom CSS on 404 page', 'colorlib-404-customizer' ),
				'section'     => 'colorlib_404_customizer_custom_css',
				'code_type'   => 'text/css',
				'priority'    => 20,
				'input_attrs' => array(
					'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4',
				),
			) )
		);


		/* Setting - 404 Page - Templates Selection */
		$wp_customize->add_setting( 'cnfp_settings[colorlib_404_customizer_select_template]', array(
			'default'           => 'template_01',
			'sanitize_callback' => 'cnfp_sanitize_text',
			'type'              => 'option'
		) );

		$wp_customize->add_control( new CNFP_Template_Selection( $wp_customize, 'cnfp_settings[colorlib_404_customizer_select_template]', array(
				'label'    => esc_html__( 'Select Template', 'colorlib-404-customizers' ),
				'section'  => 'colorlib_404_customizer_template_selection',
				'priority' => 30,
				'choices'  => array(
					'template_01' => esc_html__( 'Template 1', 'colorlib-404-customizer' ),
					'template_02' => esc_html__( 'Template 2', 'colorlib-404-customizer' ),
					'template_03' => esc_html__( 'Template 3', 'colorlib-404-customizer' ),
					'template_04' => esc_html__( 'Template 4', 'colorlib-404-customizer' ),
					'template_05' => esc_html__( 'Template 5', 'colorlib-404-customizer' ),
					'template_06' => esc_html__( 'Template 6', 'colorlib-404-customizer' ),
					'template_07' => esc_html__( 'Template 7', 'colorlib-404-customizer' ),
					'template_08' => esc_html__( 'Template 8', 'colorlib-404-customizer' ),
					'template_09' => esc_html__( 'Template 9', 'colorlib-404-customizer' ),
					'template_10' => esc_html__( 'Template 10', 'colorlib-404-customizer' ),
					'template_11' => esc_html__( 'Template 11', 'colorlib-404-customizer' ),
					'template_12' => esc_html__( 'Template 12', 'colorlib-404-customizer' ),
					'template_13' => esc_html__( 'Template 13', 'colorlib-404-customizer' ),
					'template_14' => esc_html__( 'Template 14', 'colorlib-404-customizer' ),
					'template_15' => esc_html__( 'Template 15', 'colorlib-404-customizer' ),
					'template_16' => esc_html__( 'Template 15', 'colorlib-404-customizer' ),
					'template_17' => esc_html__( 'Template 15', 'colorlib-404-customizer' ),
					'template_18' => esc_html__( 'Template 15', 'colorlib-404-customizer' ),
					'template_19' => esc_html__( 'Template 15', 'colorlib-404-customizer' ),
					'template_20' => esc_html__( 'Template 15', 'colorlib-404-customizer' ),
				),
			)
		) );

		/* Setting - General - Site Logo */
		$wp_customize->add_setting( 'cnfp_settings[colorlib_cnfp_plugin_logo]', array(
			'default'           => CNFP_URL . 'assets/images/logo.jpg',
			'sanitize_callback' => 'cnfp_sanitize_text',
			'type'              => 'option'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cnfp_settings[colorlib_cnfp_plugin_logo]', array(
				'label'       => esc_html__( 'Logo Image', 'colorlib-coming-soon' ),
				'description' => esc_html__( 'Recommended size: 80px by 80px', 'colorlib-coming-soon' ),
				'section'     => 'colorlib_404_customizer_general',
				'priority'    => 10,
			) )
		);

		/* Setting - General - Site Background Image */
		$wp_customize->add_setting( 'cnfp_settings[colorlib_404_page_background_image]', array(
			'default'           => CNFP_URL . 'assets/images/logo.jpg',
			'sanitize_callback' => 'cnfp_sanitize_text',
			'type'              => 'option'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cnfp_settings[colorlib_404_page_background_image]', array(
				'label'           => esc_html__( 'Background Image', 'colorlib-coming-soon' ),
				'description'     => esc_html__( '', 'colorlib-coming-soon' ),
				'section'         => 'colorlib_404_customizer_general',
				'priority'        => 10,
				//'active_callback' => 'cnfp_template_has_background_image',
			) )
		);

		/* Setting - General - Site Background Color */
		$wp_customize->add_setting( 'cnfp_settings[colorlib_404_customizer_background_color]', array(
			'default'           => CNFP_URL . 'assets/images/logo.jpg',
			'sanitize_callback' => 'cnfp_sanitize_text',
			'type'              => 'option'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cnfp_settings[colorlib_404_customizer_background_color]', array(
				'label'           => esc_html__( 'Background Color', 'colorlib-coming-soon' ),
				'description'     => esc_html__( '', 'colorlib-coming-soon' ),
				'section'         => 'colorlib_404_customizer_general',
				'priority'        => 10,
				//'active_callback' => 'cnfp_template_has_background_color',
			) )
		);

		/* Setting - General - Site Text Color */
		$wp_customize->add_setting( 'cnfp_settings[colorlib_404_customizer_text_color]', array(
			'default'           => CNFP_URL . 'assets/images/logo.jpg',
			'sanitize_callback' => 'cnfp_sanitize_text',
			'type'              => 'option'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cnfp_settings[colorlib_404_customizer_text_color]', array(
				'label'    => esc_html__( 'Text Color', 'colorlib-404-customizer' ),
				'section'  => 'colorlib_404_customizer_general',
				'priority' => 10,
			) )
		);


		/* Setting - Coming Soon - Page Heading */
		$wp_customize->add_setting( 'cnfp_settings[colorlib_404_customizer_page_heading]', array(
			'default'           => 'Something <strong>really good</strong> is coming <strong>very soon</strong>',
			'sanitize_callback' => 'cnfp_sanitize_text',
			'transport'         => 'postMessage',
			'type'              => 'option'
		) );

		$wp_customize->add_control( new CNFP_Control_Text_Editor( $wp_customize, 'cnfp_settings[colorlib_404_customizer_page_heading]', array(
				'label'    => esc_html__( 'Heading', 'colorlib-coming-soon' ),
				'section'  => 'colorlib_404_customizer_general',
				'priority' => 20,
			) )
		);


		/* Setting - 404 Page - Page Content */
		$wp_customize->add_setting( 'cnfp_settings[colorlib_404_customizer_content]', array(
			'default'           => 'If you have something new you’re looking to launch, you’re going to want to start building a community of people interested in what you’re launching.',
			'sanitize_callback' => 'cnfp_sanitize_text',
			'transport'         => 'postMessage',
			'type'              => 'option'
		) );

		$wp_customize->add_control( new CNFP_Control_Text_Editor( $wp_customize, 'cnfp_settings[colorlib_404_customizer_content]', array(
				'label'           => esc_html__( 'Main Content', 'colorlib-coming-soon' ),
				'section'         => 'colorlib_404_customizer_general',
				'priority'        => 30,
				//'active_callback' => 'cnfp_template_has_content',
			) )
		);


		/* Setting - 404 Page - Button Text */
		$wp_customize->add_setting( 'cnfp_settings[colorlib_404_customizer_button_text]', array(
			'default'           => 'And don\'t worry, we hate spam too! You can unsubscribe at any time.',
			'sanitize_callback' => 'cnfp_sanitize_text',
			'transport'         => 'postMessage',
			'type'              => 'option'
		) );

		$wp_customize->add_control( new CNFP_Control_Text_Editor( $wp_customize, 'cnfp_settings[colorlib_404_customizer_button_text]', array(
				'label'           => esc_html__( 'Return to home text', 'colorlib-coming-soon' ),
				'section'         => 'colorlib_404_customizer_general',
				'priority'        => 40,
				//'active_callback' => 'cnfp_template_has_footer',
			) )
		);

		/* Setting - 404 Page - Social Links  Facebook*/
		$wp_customize->add_setting( 'cnfp_settings[colorlib_404_customizer_social_facebook]', array(
			'default'           => 'https://www.facebook.com/',
			'sanitize_callback' => 'cnfp_sanitize_text',
			'type'              => 'option'
		) );

		$wp_customize->add_control( 'cnfp_settings[colorlib_404_customizer_social_facebook]', array(
				'label'    => esc_html__( 'Facebook', 'colorlib-coming-soon' ),
				'section'  => 'colorlib_404_customizer_social_settings',
				'type'     => 'text',
				'priority' => 10,
			)
		);


		/* Setting - 404 Page - Social Links Twitter*/
		$wp_customize->add_setting( 'cnfp_settings[colorlib_404_customizer_social_twitter]', array(
			'default'           => 'https://www.twitter.com/',
			'sanitize_callback' => 'cnfp_sanitize_text',
			'type'              => 'option'
		) );

		$wp_customize->add_control( 'cnfp_settings[colorlib_404_customizer_social_twitter]', array(
				'label'    => esc_html__( 'Twitter', 'colorlib-coming-soon' ),
				'section'  => 'colorlib_404_customizer_social_settings',
				'type'     => 'text',
				'priority' => 20,
			)
		);

		/* Setting - 404 Page - Social Links Email*/
		$wp_customize->add_setting( 'cnfp_settings[colorlib_404_customizer_social_email]', array(
			'default'           => 'you@domain.com',
			'sanitize_callback' => 'cnfp_sanitize_text',
			'type'              => 'option'
		) );

		$wp_customize->add_control( 'cnfp_settings[colorlib_404_customizer_social_email]', array(
				'label'    => esc_html__( 'Email', 'colorlib-coming-soon' ),
				'section'  => 'colorlib_404_customizer_social_settings',
				'type'     => 'text',
				'priority' => 30,
			)
		);

		/* Setting - 404 Page - Social Links Youtube*/
		$wp_customize->add_setting( 'cnfp_settings[colorlib_404_customizer_social_youtube]', array(
			'default'           => 'https://youtube.com/',
			'sanitize_callback' => 'cnfp_sanitize_text',
			'type'              => 'option'
		) );

		$wp_customize->add_control( 'cnfp_settings[colorlib_404_customizer_social_youtube]', array(
				'label'    => esc_html__( 'Youtube', 'colorlib-coming-soon' ),
				'section'  => 'colorlib_404_customizer_social_settings',
				'type'     => 'text',
				'priority' => 40,
			)
		);

		/* Setting - 404 Page - Social Links Pinteres*/
		$wp_customize->add_setting( 'cnfp_settings[colorlib_404_customizer_social_pinterest]', array(
			'default'           => 'https://pinterest.com/',
			'sanitize_callback' => 'cnfp_sanitize_text',
			'type'              => 'option'
		) );

		$wp_customize->add_control( 'cnfp_settings[colorlib_404_customizer_social_pinterest]', array(
				'label'    => esc_html__( 'Pinterest', 'colorlib-coming-soon' ),
				'section'  => 'colorlib_404_customizer_social_settings',
				'type'     => 'text',
				'priority' => 50,
			)
		);

		/* Setting - 404 Page - Social Links Instagram*/
		$wp_customize->add_setting( 'cnfp_settings[colorlib_404_customizer_social_instagram]', array(
			'default'           => 'https://instagram.com/',
			'sanitize_callback' => 'cnfp_sanitize_text',
			'type'              => 'option'
		) );

		$wp_customize->add_control( 'cnfp_settings[colorlib_404_customizer_social_instagram]', array(
				'label'    => esc_html__( 'Instagram', 'colorlib-coming-soon' ),
				'section'  => 'colorlib_404_customizer_social_settings',
				'type'     => 'text',
				'priority' => 60,
			)
		);
	}

	public function cnfp_add_menu_item() {
		$page = add_menu_page(
			esc_html__( 'Colorlib 404 Page', 'colorlib-404-customizer' ), esc_html__( '404 Page', 'colorlib-404-customizer' ), 'manage_options', 'cnfp_settings', array(
			$this,
			'settings_page',
		), 'dashicons-share-alt'
		);
	}

	/**
	 * Add settings link to plugin list table
	 *
	 * @param  array $links Existing links
	 *
	 * @return array        Modified links
	 */
	public function cnfp_add_settings_link( $links ) {
		$settings_link = '<a href="options-general.php?page=cnfp_settings">' . __( 'Settings', 'colorlib-404-customizer' ) . '</a>';
		array_push( $links, $settings_link );

		return $links;
	}

	/**
	 * Hook to redirect the page for the Customizer.
	 *
	 * @access public
	 * @return void
	 */
	public function cnfp_redirect_customizer() {
		if ( ! empty( $_GET['page'] ) ) { // Input var okay.
			if ( 'cnfp_settings' === $_GET['page'] ) { // Input var okay.

				// Generate the redirect url.
				$url = add_query_arg(
					array(
						'autofocus[panel]' => 'colorlib_404_customizer_panel',
					),
					admin_url( 'customize.php' )
				);

				wp_safe_redirect( $url );
			}
		}
	}

}

$cl = new CNFP_Customizer();

function cnfp_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

