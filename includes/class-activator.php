<?php
/**
 * Fired during plugin activation
 *
 * @link       https://www.thoughtsideas.uk
 * @since      1.0.0
 *
 * @package    TI/Projects
 * @subpackage TI/Projects/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    TI/Projects
 * @subpackage TI/Projects/includes
 * @author     Thoughts & Ideas <hello@thoughtsideas.uk>
 */
class Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		if ( ! get_option( 'ti_projects_rewrite_rules_flag' ) ) {
			add_option( 'ti_projects_rewrite_rules_flag', true );
		}

		// Set plugin version in database.
		add_site_option(
			'ti_projects_version',
			TI_PROJECTS_VERSION
		);

		// Set plugin slug in database.
		add_site_option(
			'ti_project_base',
			'ti-projects',
			'',
			'yes'
		);

	}

}
