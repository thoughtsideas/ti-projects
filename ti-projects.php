<?php
/**
 * [TI] Projects
 *
 * @author            Thoughts & Ideas <hello@thoughtsideas.uk>
 * @link              https://thoughtsideas.uk/
 * @copyright         Copyright (c) 2017 Thoughts & Ideas
 * @license           https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @version           0.1.0
 * @package           TI\Projects
 *
 * Plugin Name:       [TI] Projects
 * Plugin URI:        http://www.thoughtsideas.uk
 * Description:
 * Version:           0.1.0
 * Author:            Thoughts & Ideas
 * Author URI:        https://www.thoughtsideas.uk/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ti-projects
 * Domain Path:       /languages
 */

/**
 * If this file is called directly, abort.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'TI_PROJECTS_VERSION', '0.1.0' );

require plugin_dir_path( __FILE__ ) . 'includes/class-requirements-check.php';

$ti_projects_requirements_check = new TI\Requirements_Check( array(
	'title' => '[TI] Projects',
	'php'   => '5.6',
	'wp'    => '4.9',
	'file'  => __FILE__,
));

/**
 * Begins execution of the plugin.
 *
 * @since    0.1.0
 */
function run_ti_projects() {
	$plugin = new TI\Projects();
	$plugin->run();
}

if ( $ti_projects_requirements_check->passes() ) {

	require plugin_dir_path( __FILE__ ) . 'includes/class-projects.php';

	run_ti_projects();

}

unset( $ti_projects_requirements_check );
