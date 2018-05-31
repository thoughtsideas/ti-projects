<?php
/**
 * Admin_Columns.
 *
 * @link       https://www.thoughtsideas.uk/
 * @author     Thoughts & Ideas <hello@thoughtsideas.uk>
 *
 * @since      0.1.0
 *
 * @package    TI/Projects/includes
 */

namespace TI;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks.
 *
 * @package    TI/Admin_Columns
 */
class Admin_Columns {
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
	 * Add column title for featured image.
	 *
	 * @since   0.1.0
	 * @param array $columns Current columns.
	 *
	 * @return array Modified columns.
	 */
	public function add_featured_image_column_title( $columns ) {
		$columns['ti_featured_image'] = __( 'Image', 'ti-projects' );
		return $columns;
	}

	/**
	 * Add content to column.
	 *
	 * @since   0.1.0
	 * @param string $column_name The name of the column to display.
	 */
	public function add_featured_image_column_content( $column_name ) {
		if ( 'ti_featured_image' !== $column_name ) {
			return;
		}
			echo the_post_thumbnail( 'thumbnail' );
	}

}
