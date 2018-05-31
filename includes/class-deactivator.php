<?php
/**
 * Fired during plugin deactivation
 *
 * @link       https://www.thoughtsideas.uk
 * @since      0.1.0
 *
 * @package    TI/Projects
 * @subpackage TI/Projects/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      0.1.0
 * @package    TI/Projects
 * @subpackage TI/Projects/includes
 * @author     Thoughts & Ideas <hello@thoughtsideas.uk>
 */
class Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    0.1.0
	 */
	public static function deactivate() {

		delete_option( 'ti_project_base' );
		delete_option( 'ti_projects_rewrite_rules_flag' );
		flush_rewrite_rules();

	}

}
