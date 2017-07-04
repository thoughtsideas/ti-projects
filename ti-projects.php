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

/**
 * The core plugin class that is used to define internationalization,
 * and plugin hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ti-projects.php';

/**
 * Begins execution of the plugin.
 *
 * @since    0.1.0
 */
function run_ti_projects() {
	$plugin = new TI\Projects();
	$plugin->run();
}

run_ti_projects();
