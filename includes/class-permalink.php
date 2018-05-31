<?php
/**
 * Permalink.
 *
 * @link       https://www.thoughtsideas.uk/
 * @author     Thoughts & Ideas <hello@thoughtsideas.uk>
 *
 * @since      0.1.0
 *
 * @package    TI/Settings
 */

namespace TI;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks.
 *
 * @package    TI/Permalink
 */
class Permalink {
	/**
	 * The ID of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.1.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version           The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * [register_setting description]
	 *
	 * @since    0.1.0
	 */
	public function register_setting() {

		$args = array(
			'type' => 'string',
			'description' => __( 'Slug to use for Projects post type.', 'ti-projects' ),
			'sanitize_callback' => 'sanitize_text_field',
			'show_in_rest' => false,
			'default' => 'projects',
		);

		register_setting(
			'permalink',
			'ti_project_base',
			$args
		);

	}

	/**
	 * Add settings.
	 *
	 * @since    0.1.0
	 */
	public function add_settings() {

		add_settings_section(
			'ti_projects_permalink',
			__( 'Project Settings', 'ti-projects' ),
			array( $this, 'permalink_description' ),
			'permalink'
		);

		add_settings_field(
			'ti_project_base',
			__( 'Projects base', 'ti-projects' ),
			array( $this, 'output_settings' ),
			'permalink',
			'ti_projects_permalink',
			array(
				'label_for' => 'ti_project_base',
			)
		);

	}

	/**
	 * Help the user by explaining how they can use this option.
	 *
	 * @since    0.1.0
	 */
	public function permalink_description() {
		echo '<p>Thoughts & Ideas Projects plugin offers you the ability to use a custom slug in your projects urls.</p>';
	}

	/**
	 * Output HTML for setting field.
	 *
	 * @since    0.1.0
	 * @param  array $args Setting section information.
	 */
	public function output_settings( $args ) {
		$project_base = get_option( 'ti_project_base' );
		?>
		<input name="ti_project_base" id="<?php echo esc_attr( $args['label_for'] ); ?>" type="text" value="<?php echo esc_attr( $project_base ); ?>" class="regular-text code" />
		<?php
	}

	/**
	 * Save our custom setting.
	 *
	 * Setting API doesn't automaticall save custom fields on the permalink page
	 * so we need to manually save the field.
	 *
	 * @since    0.1.0
	 *
	 * phpcs:ignore WordPress.VIP.SuperGlobalInputUsage.AccessDetected
	 */
	public function save_settings() {

		// Check we have data to process.
		// phpcs:ignore WordPress.VIP.SuperGlobalInputUsage.AccessDetected
		if ( ! isset( $_POST['permalink_structure'] ) && ! isset( $_POST['ti_project_base'] ) ) {
			return;
		}

		// Check request is coming from the admin page.
		if ( ! check_admin_referer( 'update-permalink' ) ) {
			return;
		}

		// Check a value has been supplied.
		// phpcs:ignore WordPress.VIP.SuperGlobalInputUsage.AccessDetected
		if ( ! empty( $_POST['ti_project_base'] ) ) {
		// phpcs:ignore WordPress.VIP.SuperGlobalInputUsage.AccessDetected
			$ti_project_base = sanitize_text_field( wp_unslash( $_POST['ti_project_base'] ) );
			update_option( 'ti_project_base', $ti_project_base );
			return true;
		}

		delete_option( 'ti_project_base' );

	}

	/**
	 * Flush rewrite rules.
	 *
	 * @since    0.1.0
	 */
	public function rewrite_rules_flush() {

		if ( get_option( 'ti_projects_rewrite_rules_flag' ) ) {
			flush_rewrite_rules();
			delete_option( 'ti_projects_rewrite_rules_flag' );
		}

	}

}
