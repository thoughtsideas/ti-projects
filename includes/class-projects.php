<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across the plugin.
 *
 * @link       https://www.thoughtsideas.uk
 * @since      0.1.0
 *
 * @package    TI/Projects
 * @subpackage TI/Projects/includes
 */

namespace TI;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, plugin hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      0.1.0
 * @package    TI/Projects
 * @subpackage TI/Projects/includes
 * @author     Thoughts & Ideas <hello@thoughtsideas.uk>
 */
class Projects {
	/**
	 * The loader that's responsible for maintaining and registering all hooks
	 * that power the plugin.
	 *
	 * @since    0.1.0
	 * @access   protected
	 * @var      TI_Projects_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    0.1.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    0.1.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    0.1.0
	 */
	public function __construct() {
		$this->plugin_name = 'ti-projects';
		$this->version = TI_PROJECTS_VERSION;
		$this->load_dependencies();
		$this->set_locale();
		$this->register_post_type();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - TI_Projects_Loader. Orchestrates the hooks of the plugin.
	 * - TI_Projects_i18n. Defines internationalization functionality.
	 * - TI_Projects_Login. Defines all hooks for the admin area.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-i18n.php';
		$this->loader = new \Projects\Loader();

		/**
		 * The class responsible for registering the custom post types required
		 * by this plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-post-type.php';

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the TI_Projects_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new \Projects\I18n();

		$this->loader->add_action(
			'plugins_loaded',
			$plugin_i18n,
			'load_plugin_textdomain'
		);

	}

	/**
	 * Register Post Type
	 */
	private function register_post_type() {
			$projects_post_types = new \TI\Post_Type(
				$this->get_plugin_name(),
				$this->get_version()
			);

		$this->loader->add_action(
			'init',
			$projects_post_types,
			'setup_post_type'
		);

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    0.1.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     0.1.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     0.1.0
	 * @return    TI_Projects_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     0.1.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
