<?php
/**
 * Check our requirements are met for running this plugin.
 *
 * Based on the work by Mark Jaquith (https://markjaquith.wordpress.com/2018/02/19/handling-old-wordpress-and-php-versions-in-your-plugin/).
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
class Requirements_Check {

	/**
	 * Plugin Name.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $title    Plugin Name.
	 */
	private $title = '';

	/**
	 * Default minimum version of PHP required for this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $php    Minimum PHP version required.
	 */
	private $php = '5.2.4';

	/**
	 * Default minimum version of WordPress required for this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $wp    Minimum WordPress version required..
	 */
	private $wp = '3.8';

	/**
	 * The loader that's responsible for maintaining and registering all hooks
	 * that power the plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $file    Maintains and registers all hooks for the plugin.
	 */
	private $file;

	/**
	 * Construction.
	 *
	 * @since    0.1.0
	 *
	 * @param   string $args    Load the required values.
	 */
	public function __construct( $args ) {

		foreach ( array( 'title', 'php', 'wp', 'file' ) as $setting ) {

			if ( isset( $args[ $setting ] ) ) {
				$this->$setting = $args[ $setting ];
			}
		}

	}

	/**
	 *
	 * @since    0.1.0
	 */
	public function passes() {
		$passes = $this->php_passes() && $this->wp_passes();
		if ( ! $passes ) {
			add_action( 'admin_init', array( $this, 'deactivate' ) );
		}
		return $passes;
	}

	/**
	 * Deactivate plugin.
	 *
	 * @since    0.1.0
	 */
	public function deactivate() {
		if ( isset( $this->file ) ) {
			deactivate_plugins( plugin_basename( $this->file ) );
		}
	}

	/**
	 * Test if PHP version passes.
	 *
	 * @since    0.1.0
	 */
	private function php_passes() {
		if ( $this->_php_at_least( $this->php ) ) {
			return true;
		} else {
			add_action( 'admin_notices', array( $this, 'php_version_notice' ) );
			return false;
		}
	}

	/**
	 * Compare current PHP version with minimum required version.
	 *
	 * @since    0.1.0
	 *
	 * @param string $min_version Semver number of minimum version.
	 */
	private static function _php_at_least( $min_version ) {
		return version_compare( phpversion(), $min_version, '>=' );
	}

	/**
	 * PHP Version error notice.
	 *
	 * @since    0.1.0
	 */
	public function php_version_notice() {
		echo '<div id="php-version-message" class="error notice is-dismissible">';
		echo '<p>The &#8220;' . esc_html( $this->title ) . '&#8221; plugin cannot run on PHP versions older than ' . esc_html( $this->php ) . '. Please contact your host and ask them to upgrade.</p>';
		echo '</div>';
	}

	/**
	 *
	 * @since    0.1.0
	 */
	private function wp_passes() {

		if ( $this->_wp_at_least( $this->wp ) ) {
			return true;
		} else {
			add_action( 'admin_notices', array( $this, 'wp_version_notice' ) );
			return false;
		}

	}

	/**
	 * Compare current WordPress version with minimum required version.
	 *
	 * @since    0.1.0
	 *
	 * @param string $min_version Semver number of minimum version.
	 */
	private static function _wp_at_least( $min_version ) {

		return version_compare( get_bloginfo( 'version' ), $min_version, '>=' );

	}

	/**
	 * WordPress version error notice.
	 *
	 * @since    0.1.0
	 */
	public function wp_version_notice() {
		echo '<div id="wp-version-message" class="error notice is-dismissible">';
		echo '<p>The &#8220;' . esc_html( $this->title ) . '&#8221; plugin cannot run on WordPress versions older than ' . esc_html( $this->wp ) . '. Please update WordPress.</p>';
		echo '</div>';
	}

}
