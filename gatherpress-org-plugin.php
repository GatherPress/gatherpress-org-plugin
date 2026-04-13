<?php
/**
 * Plugin Name:  GatherPress Org
 * Plugin URI:   https://gatherpress.org/
 * Description:  Site-specific functionality for gatherpress.org, including the Releases post type and taxonomy.
 * Author:       The GatherPress Community
 * Author URI:   https://gatherpress.org/
 * Version:      1.0.0
 * Requires PHP: 7.4
 * Text Domain:  gatherpress-org-plugin
 * Domain Path:  /languages
 * License:      GNU General Public License v2.0 or later
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package GatherPress_Org_Plugin
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; // @codeCoverageIgnore

// Constants.
define( 'GATHERPRESS_ORG_PLUGIN_VERSION', current( get_file_data( __FILE__, array( 'Version' ), 'plugin' ) ) );
define( 'GATHERPRESS_ORG_PLUGIN_CORE_PATH', __DIR__ );

/**
 * Adds the GatherPress_Org_Plugin namespace to the autoloader.
 *
 * This function hooks into the 'gatherpress_autoloader' filter and adds the
 * GatherPress_Org_Plugin namespace to the list of namespaces with its core path.
 *
 * @param array $namespace An associative array of namespaces and their paths.
 * @return array Modified array of namespaces and their paths.
 */
function gatherpress_org_plugin_autoloader( array $namespace ): array {
	$namespace['GatherPress_Org_Plugin'] = GATHERPRESS_ORG_PLUGIN_CORE_PATH;

	return $namespace;
}
add_filter( 'gatherpress_autoloader', 'gatherpress_org_plugin_autoloader' );

/**
 * Initializes the GatherPress Org Plugin setup.
 *
 * This function hooks into the 'plugins_loaded' action to ensure that
 * the GatherPress_Org_Plugin\Setup instance is created once all plugins are loaded,
 * only if the GatherPress plugin is active.
 *
 * @return void
 */
function gatherpress_org_plugin_setup(): void {
	if ( defined( 'GATHERPRESS_VERSION' ) ) {
		GatherPress_Org_Plugin\Setup::get_instance();
	}
}
add_action( 'plugins_loaded', 'gatherpress_org_plugin_setup' );
