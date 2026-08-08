<?php
/**
 * Customizer panel, sections, settings and controls.
 *
 * @package Colorlib_404_Customizer
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers everything the plugin exposes in the Live Customizer.
 */
class CNFP_Customizer {

	/**
	 * Hook everything up.
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'cnfp_panels_initialize' ) );
		add_action( 'customize_register', array( $this, 'cnfp_customizer_controls' ) );
		add_action( 'admin_menu', array( $this, 'cnfp_add_menu_item' ) );
		add_action( 'admin_init', array( $this, 'cnfp_redirect_customizer' ) );
		add_action( 'wp_print_styles', array( $this, 'cnfp_remove_all_styles_preview' ), 100 );
	}

	/**
	 * Register the panel and its sections.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager.
	 * @return void
	 */
	public function cnfp_panels_initialize( $wp_customize ) {
		require_once CNFP_PATH . 'includes/controls/class-cnfp-template-section.php';

		$wp_customize->add_panel(
			'colorlib_404_customizer_panel',
			array(
				'priority' => 1,
				'title'    => esc_html__( 'Colorlib 404 Customizer Settings', 'colorlib-404-customizer' ),
			)
		);

		$wp_customize->add_section(
			new CNFP_Templates_Section(
				$wp_customize,
				'colorlib_404_customizer_template_selection',
				array(
					'title'    => esc_html__( 'Templates', 'colorlib-404-customizer' ),
					'panel'    => 'colorlib_404_customizer_panel',
					'priority' => 5,
				)
			)
		);

		$wp_customize->add_section(
			'colorlib_404_customizer_general',
			array(
				'title'    => esc_html__( 'General', 'colorlib-404-customizer' ),
				'panel'    => 'colorlib_404_customizer_panel',
				'priority' => 10,
			)
		);

		$wp_customize->add_section(
			'colorlib_404_customizer_social_settings',
			array(
				'title'           => esc_html__( 'Social Links', 'colorlib-404-customizer' ),
				'panel'           => 'colorlib_404_customizer_panel',
				'priority'        => 35,
				'active_callback' => 'cnfp_template_has_social_links',
			)
		);

		$wp_customize->add_section(
			'colorlib_404_customizer_custom_css',
			array(
				'title'    => esc_html__( 'Custom CSS', 'colorlib-404-customizer' ),
				'panel'    => 'colorlib_404_customizer_panel',
				'priority' => 40,
			)
		);
	}

	/**
	 * Register every setting and control.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager.
	 * @return void
	 */
	public function cnfp_customizer_controls( $wp_customize ) {
		require_once CNFP_PATH . 'includes/controls/class-cnfp-control-text-editor.php';
		require_once CNFP_PATH . 'includes/controls/class-cnfp-control-toggle.php';
		require_once CNFP_PATH . 'includes/controls/class-cnfp-template-selection.php';

		/* General - activation toggle. */
		$this->add_setting( $wp_customize, 'colorlib_404_customizer_activation', 'cnfp_sanitize_checkbox' );
		$wp_customize->add_control(
			new CNFP_Control_Toggle(
				$wp_customize,
				$this->id( 'colorlib_404_customizer_activation' ),
				array(
					'label'    => esc_html__( 'Activate Colorlib 404 Customizer ?', 'colorlib-404-customizer' ),
					'section'  => 'colorlib_404_customizer_general',
					'priority' => 10,
				)
			)
		);

		/* General - render inside the theme's header and footer. */
		$this->add_setting( $wp_customize, 'colorlib_404_customizer_enable_header_footer', 'cnfp_sanitize_checkbox' );
		$wp_customize->add_control(
			new CNFP_Control_Toggle(
				$wp_customize,
				$this->id( 'colorlib_404_customizer_enable_header_footer' ),
				array(
					'label'    => esc_html__( 'Enable header and footer on 404 pages', 'colorlib-404-customizer' ),
					'section'  => 'colorlib_404_customizer_general',
					'priority' => 10,
				)
			)
		);

		/* General - contact link. */
		$this->add_setting( $wp_customize, 'colorlib_404_customizer_contact_link', 'cnfp_sanitize_url' );
		$wp_customize->add_control(
			$this->id( 'colorlib_404_customizer_contact_link' ),
			array(
				'label'           => esc_html__( 'Enter Contact Link', 'colorlib-404-customizer' ),
				'section'         => 'colorlib_404_customizer_general',
				'priority'        => 10,
				'type'            => 'url',
				'active_callback' => 'cnfp_template_has_contact_link',
			)
		);

		/* Custom CSS. */
		$this->add_setting( $wp_customize, 'colorlib_404_customizer_custom_css_control', 'cnfp_sanitize_css' );
		$wp_customize->add_control(
			new WP_Customize_Code_Editor_Control(
				$wp_customize,
				$this->id( 'colorlib_404_customizer_custom_css_control' ),
				array(
					'label'       => esc_html__( 'Custom CSS on 404 page', 'colorlib-404-customizer' ),
					'section'     => 'colorlib_404_customizer_custom_css',
					'code_type'   => 'text/css',
					'priority'    => 20,
					'input_attrs' => array(
						'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4',
					),
				)
			)
		);

		/* Template picker. */
		$template_choices = array();
		$index            = 0;

		foreach ( array_keys( cnfp_get_templates() ) as $slug ) {
			++$index;
			/* translators: %d: template number. */
			$template_choices[ $slug ] = sprintf( esc_html__( 'Template %d', 'colorlib-404-customizer' ), $index );
		}

		$this->add_setting( $wp_customize, 'colorlib_404_customizer_select_template', 'cnfp_sanitize_template' );
		$wp_customize->add_control(
			new CNFP_Template_Selection(
				$wp_customize,
				$this->id( 'colorlib_404_customizer_select_template' ),
				array(
					'label'    => esc_html__( 'Select Template', 'colorlib-404-customizer' ),
					'section'  => 'colorlib_404_customizer_template_selection',
					'priority' => 30,
					'choices'  => $template_choices,
				)
			)
		);

		/* General - background image. */
		$this->add_setting( $wp_customize, 'colorlib_404_customizer_background_image', 'cnfp_sanitize_url' );
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				$this->id( 'colorlib_404_customizer_background_image' ),
				array(
					'label'    => esc_html__( 'Background Image', 'colorlib-404-customizer' ),
					'section'  => 'colorlib_404_customizer_general',
					'priority' => 10,
				)
			)
		);

		/* General - background repeat. */
		$this->add_setting( $wp_customize, 'colorlib_404_customizer_background_repeat', 'cnfp_sanitize_background_repeat' );
		$wp_customize->add_control(
			$this->id( 'colorlib_404_customizer_background_repeat' ),
			array(
				'label'    => esc_html__( 'Background Repeat', 'colorlib-404-customizer' ),
				'section'  => 'colorlib_404_customizer_general',
				'priority' => 10,
				'type'     => 'select',
				'choices'  => array(
					'repeat'    => esc_html__( 'Repeat', 'colorlib-404-customizer' ),
					'no-repeat' => esc_html__( 'No Repeat', 'colorlib-404-customizer' ),
					'repeat-X'  => esc_html__( 'Repeat X', 'colorlib-404-customizer' ),
					'repeat-Y'  => esc_html__( 'Repeat-Y', 'colorlib-404-customizer' ),
					'round'     => esc_html__( 'Round', 'colorlib-404-customizer' ),
					'space'     => esc_html__( 'Space', 'colorlib-404-customizer' ),
				),
			)
		);

		/* General - background size. */
		$this->add_setting( $wp_customize, 'colorlib_404_customizer_background_size', 'cnfp_sanitize_background_size' );
		$wp_customize->add_control(
			$this->id( 'colorlib_404_customizer_background_size' ),
			array(
				'label'    => esc_html__( 'Background Size', 'colorlib-404-customizer' ),
				'section'  => 'colorlib_404_customizer_general',
				'priority' => 10,
				'type'     => 'select',
				'choices'  => array(
					'cover'   => esc_html__( 'Cover', 'colorlib-404-customizer' ),
					'contain' => esc_html__( 'Contain', 'colorlib-404-customizer' ),
					'auto'    => esc_html__( 'Auto', 'colorlib-404-customizer' ),
				),
			)
		);

		/* General - background colour. */
		$this->add_setting( $wp_customize, 'colorlib_404_customizer_background_color', 'cnfp_sanitize_color' );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$this->id( 'colorlib_404_customizer_background_color' ),
				array(
					'label'           => esc_html__( 'Background Color', 'colorlib-404-customizer' ),
					'section'         => 'colorlib_404_customizer_general',
					'priority'        => 10,
					'active_callback' => 'cnfp_template_has_background_color',
				)
			)
		);

		/* General - text colour. */
		$this->add_setting( $wp_customize, 'colorlib_404_customizer_text_color', 'cnfp_sanitize_color' );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$this->id( 'colorlib_404_customizer_text_color' ),
				array(
					'label'    => esc_html__( 'Text Color', 'colorlib-404-customizer' ),
					'section'  => 'colorlib_404_customizer_general',
					'priority' => 10,
				)
			)
		);

		/* General - heading, content and button text. */
		$editors = array(
			'colorlib_404_customizer_page_heading' => array(
				'label'    => esc_html__( 'Heading', 'colorlib-404-customizer' ),
				'priority' => 20,
				'active'   => 'cnfp_template_has_heading',
			),
			'colorlib_404_customizer_content'      => array(
				'label'    => esc_html__( 'Main Content', 'colorlib-404-customizer' ),
				'priority' => 30,
				'active'   => 'cnfp_template_has_content',
			),
			'colorlib_404_customizer_button_text'  => array(
				'label'    => esc_html__( 'Return to home text', 'colorlib-404-customizer' ),
				'priority' => 40,
				'active'   => 'cnfp_template_has_back_button',
			),
		);

		foreach ( $editors as $key => $editor ) {
			$this->add_setting( $wp_customize, $key, 'cnfp_sanitize_html', 'postMessage' );

			$args = array(
				'label'    => $editor['label'],
				'section'  => 'colorlib_404_customizer_general',
				'priority' => $editor['priority'],
			);

			if ( $editor['active'] ) {
				$args['active_callback'] = $editor['active'];
			}

			$wp_customize->add_control( new CNFP_Control_Text_Editor( $wp_customize, $this->id( $key ), $args ) );

			$wp_customize->selective_refresh->add_partial(
				$this->id( $key ),
				array( 'selector' => '#' . $key )
			);
		}

		/* Social links. */
		$networks = array(
			'facebook'  => esc_html__( 'Facebook', 'colorlib-404-customizer' ),
			'twitter'   => esc_html__( 'X (Twitter)', 'colorlib-404-customizer' ),
			'email'     => esc_html__( 'Email', 'colorlib-404-customizer' ),
			'youtube'   => esc_html__( 'YouTube', 'colorlib-404-customizer' ),
			'pinterest' => esc_html__( 'Pinterest', 'colorlib-404-customizer' ),
			'instagram' => esc_html__( 'Instagram', 'colorlib-404-customizer' ),
		);

		$priority = 10;

		foreach ( $networks as $network => $label ) {
			$key       = 'colorlib_404_customizer_social_' . $network;
			$sanitizer = ( 'email' === $network ) ? 'cnfp_sanitize_email' : 'cnfp_sanitize_url';

			$this->add_setting( $wp_customize, $key, $sanitizer );

			$wp_customize->add_control(
				$this->id( $key ),
				array(
					'label'    => $label,
					'section'  => 'colorlib_404_customizer_social_settings',
					'type'     => ( 'email' === $network ) ? 'email' : 'url',
					'priority' => $priority,
				)
			);

			$wp_customize->selective_refresh->add_partial(
				$this->id( $key ),
				array( 'selector' => '#' . $key )
			);

			$priority += 10;
		}
	}

	/**
	 * Full setting id for a settings key.
	 *
	 * @param string $key Bare option key.
	 * @return string
	 */
	private function id( $key ) {
		return 'cnfp_settings[' . $key . ']';
	}

	/**
	 * Register one setting against the shared option row.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager.
	 * @param string               $key          Bare option key.
	 * @param string               $sanitizer    Sanitize callback name.
	 * @param string               $transport    Setting transport.
	 * @return void
	 */
	private function add_setting( $wp_customize, $key, $sanitizer, $transport = 'refresh' ) {
		$defaults = cnfp_default_options();

		$wp_customize->add_setting(
			$this->id( $key ),
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'default'           => isset( $defaults[ $key ] ) ? $defaults[ $key ] : '',
				'sanitize_callback' => $sanitizer,
				'transport'         => $transport,
			)
		);
	}

	/**
	 * Add the top-level admin menu entry.
	 *
	 * @return void
	 */
	public function cnfp_add_menu_item() {
		add_menu_page(
			esc_html__( 'Colorlib 404 Customizer', 'colorlib-404-customizer' ),
			esc_html__( '404 Customizer', 'colorlib-404-customizer' ),
			'manage_options',
			'cnfp_settings',
			array( $this, 'settings_page' ),
			'dashicons-warning'
		);
	}

	/**
	 * Fallback screen, shown only if the customizer redirect does not apply.
	 *
	 * @return void
	 */
	public function settings_page() {
		?>
		<div class="wrap" id="colorlib-404-customizer-settings">
			<h1><?php esc_html_e( 'Colorlib 404 Customizer', 'colorlib-404-customizer' ); ?></h1>
			<p>
				<?php
				esc_html_e(
					'The 404 Customizer is a free WordPress plugin that allows you to create a custom and stylish 404 page quickly via the Live Customizer. You can preview your changes before you save them! Awesome, right?',
					'colorlib-404-customizer'
				);
				?>
			</p>
			<p>
				<a href="<?php echo esc_url( $this->customizer_url() ); ?>" class="button button-primary">
					<?php esc_html_e( 'Start Customizing!', 'colorlib-404-customizer' ); ?>
				</a>
			</p>
		</div>
		<?php
	}

	/**
	 * Deep link into the plugin's customizer panel.
	 *
	 * @return string
	 */
	private function customizer_url() {
		return add_query_arg(
			array( 'autofocus[panel]' => 'colorlib_404_customizer_panel' ),
			admin_url( 'customize.php' )
		);
	}

	/**
	 * Send the admin menu entry straight to the customizer panel.
	 *
	 * The missing `exit` here is what surfaced as the fatal error in issue #28:
	 * without it the request carried on into the page callback after the redirect
	 * header had already been sent.
	 *
	 * @return void
	 */
	public function cnfp_redirect_customizer() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reading the current screen, not acting on input.
		$page = isset( $_GET['page'] ) ? sanitize_key( wp_unslash( $_GET['page'] ) ) : '';

		if ( 'cnfp_settings' !== $page ) {
			return;
		}

		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		wp_safe_redirect( $this->customizer_url() );
		exit;
	}

	/**
	 * Drop theme styles from the standalone preview.
	 *
	 * The plugin's own document does not load the theme, so the customizer preview
	 * must not either — otherwise the preview and the real 404 look different.
	 *
	 * @return void
	 */
	public function cnfp_remove_all_styles_preview() {
		if ( cnfp_use_theme_header_footer() || ! is_customize_preview() ) {
			return;
		}

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only marker; the customizer enforces its own auth.
		if ( ! isset( $_REQUEST['colorlib-404-customization'] ) ) {
			return;
		}

		global $wp_styles;

		if ( ! $wp_styles instanceof WP_Styles ) {
			return;
		}

		$wp_styles->queue = array();

		// Core registers this handle itself; re-adding it with a filesystem path,
		// as this used to, produced a <link> pointing at an absolute server path.
		wp_enqueue_style( 'customize-preview' );
	}
}

new CNFP_Customizer();

/**
 * Sanitize a checkbox/toggle value.
 *
 * @param mixed $input Raw value.
 * @return string '1' when on, an empty string otherwise.
 */
function cnfp_sanitize_checkbox( $input ) {
	return ( '1' === $input || 1 === $input || true === $input ) ? '1' : '';
}

/**
 * Sanitize rich text coming from the TinyMCE-backed controls.
 *
 * @param mixed $input Raw value.
 * @return string
 */
function cnfp_sanitize_html( $input ) {
	return wp_kses_post( force_balance_tags( (string) $input ) );
}

/**
 * Sanitize a URL for storage.
 *
 * @param mixed $input Raw value.
 * @return string
 */
function cnfp_sanitize_url( $input ) {
	$input = trim( (string) $input );

	// The contact link defaults to a bare fragment, which `esc_url_raw()` keeps.
	return esc_url_raw( $input );
}

/**
 * Sanitize an email address.
 *
 * @param mixed $input Raw value.
 * @return string
 */
function cnfp_sanitize_email( $input ) {
	return sanitize_email( (string) $input );
}

/**
 * Restrict the template setting to slugs that actually exist.
 *
 * The value is interpolated into an `include` path, so anything unknown must
 * fall back rather than reach the filesystem.
 *
 * @param mixed $input Raw value.
 * @return string
 */
function cnfp_sanitize_template( $input ) {
	return cnfp_get_template( is_string( $input ) ? $input : '' );
}

/**
 * Restrict the background-repeat setting to the offered choices.
 *
 * @param mixed $input Raw value.
 * @return string
 */
function cnfp_sanitize_background_repeat( $input ) {
	$choices = cnfp_background_choices();

	return in_array( $input, $choices['repeat'], true ) ? (string) $input : 'no-repeat';
}

/**
 * Restrict the background-size setting to the offered choices.
 *
 * @param mixed $input Raw value.
 * @return string
 */
function cnfp_sanitize_background_size( $input ) {
	$choices = cnfp_background_choices();

	return in_array( $input, $choices['size'], true ) ? (string) $input : 'auto';
}

/**
 * Kept for backwards compatibility with stored callback references.
 *
 * @param mixed $input Raw value.
 * @return string
 */
function cnfp_sanitize_text( $input ) {
	return cnfp_sanitize_html( $input );
}
