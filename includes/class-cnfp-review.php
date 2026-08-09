<?php
/**
 * The "please leave a review" admin notice.
 *
 * @package Colorlib_404_Customizer
 */

defined( 'ABSPATH' ) || exit;

/**
 * Shows a dismissible review prompt a few times over the first month of use.
 */
class CNFP_Review {

	/**
	 * Singleton instance.
	 *
	 * @var CNFP_Review|null
	 */
	private static $instance;

	/**
	 * Days of use on which the notice is shown.
	 *
	 * @var int[]
	 */
	private $when = array( 5, 15, 30 );

	/**
	 * Days the plugin has been installed.
	 *
	 * @var int
	 */
	private $value = 0;

	/**
	 * Notice copy.
	 *
	 * @var array<string, string>
	 */
	private $messages;

	/**
	 * Review link template.
	 *
	 * @var string
	 */
	private $link = 'https://wordpress.org/support/plugin/%s/reviews/#new-post';

	/**
	 * Plugin slug on wordpress.org.
	 *
	 * @var string
	 */
	private $slug = '';

	/**
	 * Capability required to interact with the notice.
	 *
	 * @var string
	 */
	private $capability = 'manage_options';

	/**
	 * Build the notice.
	 *
	 * @param array $args Accepts `slug` and `messages`.
	 */
	public function __construct( $args ) {
		if ( isset( $args['slug'] ) ) {
			$this->slug = sanitize_key( $args['slug'] );
		}

		$this->value = $this->value();

		$this->messages = array(
			/* translators: %s: number of days the plugin has been installed. */
			'notice'  => __( "Hey, I noticed you have installed our plugin for %s day(s) - that's awesome! Could you please do me a BIG favor and give it a 5-star rating on WordPress? Just to help us spread the word and boost our motivation.", 'colorlib-404-customizer' ),
			'rate'    => __( 'Ok, you deserve it', 'colorlib-404-customizer' ),
			'rated'   => __( 'I already did', 'colorlib-404-customizer' ),
			'no_rate' => __( 'No, not good enough', 'colorlib-404-customizer' ),
		);

		if ( isset( $args['messages'] ) && is_array( $args['messages'] ) ) {
			$this->messages = wp_parse_args( $args['messages'], $this->messages );
		}

		$this->init();
	}

	/**
	 * Get (and lazily build) the singleton.
	 *
	 * @param array $args Constructor arguments.
	 * @return CNFP_Review
	 */
	public static function get_instance( $args ) {
		if ( null === static::$instance ) {
			static::$instance = new static( $args );
		}

		return static::$instance;
	}

	/**
	 * Register the admin-side hooks.
	 *
	 * @return void
	 */
	private function init() {
		if ( ! is_admin() ) {
			return;
		}

		add_action( 'wp_ajax_cnfp_epsilon_review', array( $this, 'ajax' ) );

		if ( ! current_user_can( $this->capability ) ) {
			return;
		}

		if ( $this->check() ) {
			add_action( 'admin_notices', array( $this, 'five_star_wp_rate_notice' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
		}
	}

	/**
	 * Whether the notice is due.
	 *
	 * @return bool
	 */
	private function check() {
		$options = get_option( 'cnfp_settings' );
		$option  = ( is_array( $options ) && isset( $options['givemereview'] ) ) ? $options['givemereview'] : '';

		if ( 'already-rated' === $option ) {
			return false;
		}

		if ( '' !== $option && (string) $this->value === (string) $option ) {
			return false;
		}

		return in_array( $this->value, $this->when, true );
	}

	/**
	 * Days since the plugin was first loaded.
	 *
	 * @return int
	 */
	private function value() {
		$installed = get_transient( 'cnfp_review' );

		if ( ! $installed ) {
			// `gmdate()` keeps this independent of the site's timezone setting.
			set_transient( 'cnfp_review', gmdate( 'Y-m-d' ), 30 * DAY_IN_SECONDS );

			return 0;
		}

		$started = strtotime( $installed . ' UTC' );

		if ( ! $started ) {
			return 0;
		}

		return (int) round( ( time() - $started ) / DAY_IN_SECONDS );
	}

	/**
	 * Render the notice.
	 *
	 * @return void
	 */
	public function five_star_wp_rate_notice() {
		$url = sprintf( $this->link, $this->slug );
		?>
		<div id="<?php echo esc_attr( $this->slug ); ?>-epsilon-review-notice" class="notice notice-success is-dismissible cnfp-review-notice">
			<p><?php echo wp_kses_post( sprintf( $this->messages['notice'], (string) $this->value ) ); ?></p>
			<p class="actions">
				<a id="epsilon-rate" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"
					class="button button-primary epsilon-review-button"><?php echo esc_html( $this->messages['rate'] ); ?></a>
				<a id="epsilon-rated" href="#"
					class="button button-secondary epsilon-review-button"><?php echo esc_html( $this->messages['rated'] ); ?></a>
				<a id="epsilon-no-rate" href="#"
					class="button button-secondary epsilon-review-button"><?php echo esc_html( $this->messages['no_rate'] ); ?></a>
			</p>
		</div>
		<?php
	}

	/**
	 * Record the visitor's answer.
	 *
	 * @return void
	 */
	public function ajax() {
		check_ajax_referer( 'cnfp-review', 'security' );

		if ( ! current_user_can( $this->capability ) ) {
			wp_send_json_error( null, 403 );
		}

		$options = get_option( 'cnfp_settings' );
		$options = is_array( $options ) ? $options : array();

		// phpcs:ignore WordPress.Security.NonceVerification.Missing -- Verified by check_ajax_referer() above.
		$options['givemereview'] = isset( $_POST['epsilon-review'] ) ? 'already-rated' : (string) $this->value;

		update_option( 'cnfp_settings', $options );

		wp_send_json_success();
	}

	/**
	 * Load the notice script.
	 *
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script(
			'cnfp-review',
			CNFP_URL . 'assets/js/review-notice.js',
			array(),
			CNFP_VERSION,
			true
		);

		wp_localize_script(
			'cnfp-review',
			'CNFPReview',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'cnfp-review' ),
			)
		);
	}
}
