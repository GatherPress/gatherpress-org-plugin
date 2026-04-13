<?php
/**
 * Manages plugin setup for GatherPress Org Plugin.
 *
 * @package GatherPress_Org_Plugin
 */

namespace GatherPress_Org_Plugin;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; // @codeCoverageIgnore

use GatherPress\Core\Traits\Singleton;

/**
 * Class Setup.
 *
 * Manages plugin setup and initialization for gatherpress.org-specific functionality.
 */
class Setup {
	/**
	 * Enforces a single instance of this class.
	 */
	use Singleton;

	/**
	 * Constructor for the Setup class.
	 *
	 * Initializes and sets up various components of the plugin.
	 */
	protected function __construct() {
		$this->setup_hooks();
		Post_Type::get_instance();
	}

	/**
	 * Set up hooks for various purposes.
	 *
	 * This method adds hooks for different purposes as needed.
	 *
	 * @return void
	 */
	protected function setup_hooks(): void {
		add_action( 'gatherpress_sub_pages', array( $this, 'setup_sub_page' ) );
	}

	/**
	 * Adds a sub-page for GatherPress Org to the existing sub-pages array.
	 *
	 * This function modifies the provided sub-pages array to include a new sub-page
	 * for GatherPress Org Plugin with specified details such as name, priority, and sections.
	 *
	 * @param array $sub_pages An associative array of existing sub-pages.
	 * @return array Modified array of sub-pages including the GatherPress Org sub-page.
	 */
	public function setup_sub_page( array $sub_pages ): array {
		$sub_pages['org'] = array(
			'name'     => __( 'Org Settings', 'gatherpress-org-plugin' ),
			'priority' => 10,
			'sections' => array(
				'org_general' => array(
					'name'        => __( 'General', 'gatherpress-org-plugin' ),
					'description' => __( 'Settings specific to gatherpress.org.', 'gatherpress-org-plugin' ),
				),
			),
		);

		return $sub_pages;
	}
}
