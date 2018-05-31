<?php
/**
 * Custom Post Type.
 *
 * @link       https://www.thoughtsideas.uk/
 * @author     Thoughts & Ideas <hello@thoughtsideas.uk>
 *
 * @since      0.1.0
 *
 * @package    TI/Post_Type
 */

namespace TI;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks.
 *
 * @package    TI/Post_Type
 */
class Post_Type {
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
	 * The arguments of this post type.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      array   $args    The arguments for this post type.
	 */
	public $args;

	/**
	 * The options of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      array   $labels    The labels for this plugin.
	 */
	public $labels;

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
		$this->args = $this->get_args();

	}

	/**
	 * Get post type arguments.
	 */
	public function get_args() {

		$args = [
			'labels'                => self::get_labels(),
			'description'           => __(
				'Description.',
				'ti-projects'
			),
			'public'                => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-portfolio',
			'capability_type'       => 'post',
			'hierarchical'          => false,
			'supports'              => [
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'trackbacks',
				'custom-fields',
				'comments',
				'revisions',
			],
			'has_archive'           => true,
			'rewrite'               => [
				'slug'                  => self::get_slug(),
			],
			'show_in_rest'          => false,
			'rest_base'             => $this->plugin_name,
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		];

		/**
		 * Filters labels applied to the taxonomy.
		 *
		 * @since 0.1.0
		 *
		 * @param array $labels   Deafult labels for post type.
		 */
		return wp_parse_args(
			apply_filters(
				'ti_projects_post_type_args',
				$args
			),
			$args
		);

	}

	/**
	 * Returns the name of the post type slug.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return string
	 */
	function get_slug() {

		/**
		 * Filters slug applied to the post type
		 *
		 * @since 0.1.0
		 *
		 * @param array $this->plugin_name   Deafult post type slug.
		 */
		return apply_filters(
			'ti_projects_slug',
			get_option( 'ti_project_base' )
		);

	}

	/**
	 * Default labels for Locations custom taxonomy.
	 *
	 * @since 0.1.0
	 * @access public
	 * @return array Post Type Labels
	 */
	public function get_labels() {

		$labels = [
			'name'               => _x(
				'Projects',
				'post type general name',
				'ti-projects'
			),
			'singular_name'      => _x(
				'Project',
				'post type singular name',
				'ti-projects'
			),
			'menu_name'          => _x(
				'Projects',
				'admin menu',
				'ti-projects'
			),
			'name_admin_bar'     => _x(
				'Project',
				'add new on admin bar',
				'ti-projects'
			),
			'add_new'            => _x(
				'Add New',
				'class',
				'ti-projects'
			),
			'add_new_item'       => __(
				'Add New Project',
				'ti-projects'
			),
			'new_item'           => __(
				'New Project',
				'ti-projects'
			),
			'edit_item'          => __(
				'Edit Project',
				'ti-projects'
			),
			'view_item'          => __(
				'View Project',
				'ti-projects'
			),
			'all_items'          => __(
				'All Projects',
				'ti-projects'
			),
			'search_items'       => __(
				'Search Projects',
				'ti-projects'
			),
			'parent_item_colon'  => __(
				'Parent Projects:',
				'ti-projects'
			),
			'not_found'          => __(
				'No Projects found.',
				'ti-projects'
			),
			'not_found_in_trash' => __(
				'No Projects found in Trash.',
				'ti-projects'
			),
		];

		/**
		 * Filters labels applied to the taxonomy.
		 *
		 * @since 0.1.0
		 *
		 * @param array $labels   Deafult labels for post type.
		 */
		return wp_parse_args(
			apply_filters(
				'ti_projects_post_type_labels',
				$labels
			),
			$labels
		);

	}

	/**
	 * Setup the Locations Post Type
	 *
	 * @since    0.1.0
	 */
	public function setup_post_type() {

		register_post_type(
			$this->plugin_name,
			$this->args
		);

	}

}
