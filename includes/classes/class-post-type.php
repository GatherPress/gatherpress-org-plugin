<?php
/**
 * Registers the Releases custom post type and taxonomy for gatherpress.org.
 *
 * @package GatherPress_Org_Plugin
 */

namespace GatherPress_Org_Plugin;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; // @codeCoverageIgnore

use GatherPress\Core\Traits\Singleton;

/**
 * Class Post_Type.
 *
 * Manages the Releases custom post type and Release Category taxonomy
 * used on gatherpress.org to publish plugin release notes.
 */
class Post_Type {
	/**
	 * Enforces a single instance of this class.
	 */
	use Singleton;

	/**
	 * Post type slug for Releases.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	const POST_TYPE = 'releases';

	/**
	 * Taxonomy slug for Release Categories.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	const TAXONOMY = 'release_category';

	/**
	 * Constructor for the Post_Type class.
	 *
	 * Registers hooks for the custom post type and taxonomy.
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * Set up hooks for post type and taxonomy registration.
	 *
	 * @return void
	 */
	protected function setup_hooks(): void {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ) );
	}

	/**
	 * Registers the Releases custom post type.
	 *
	 * @return void
	 */
	public function register_post_type(): void {
		$labels = array(
			'name'               => _x( 'Releases', 'Post type general name', 'gatherpress-org-plugin' ),
			'singular_name'      => _x( 'Release', 'Post type singular name', 'gatherpress-org-plugin' ),
			'menu_name'          => _x( 'Releases', 'Admin menu text', 'gatherpress-org-plugin' ),
			'add_new'            => __( 'Add New Release', 'gatherpress-org-plugin' ),
			'add_new_item'       => __( 'Add New Release', 'gatherpress-org-plugin' ),
			'new_item'           => __( 'New Release', 'gatherpress-org-plugin' ),
			'edit_item'          => __( 'Edit Release', 'gatherpress-org-plugin' ),
			'view_item'          => __( 'View Release', 'gatherpress-org-plugin' ),
			'all_items'          => __( 'All Releases', 'gatherpress-org-plugin' ),
			'search_items'       => __( 'Search Releases', 'gatherpress-org-plugin' ),
			'not_found'          => __( 'No releases found.', 'gatherpress-org-plugin' ),
			'not_found_in_trash' => __( 'No releases found in Trash.', 'gatherpress-org-plugin' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'has_archive'       => true,
			'show_in_rest'      => true,
			'menu_icon'         => 'dashicons-megaphone',
			'menu_position'     => 20,
			'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'rewrite'           => array( 'slug' => 'releases' ),
			'show_in_nav_menus' => true,
		);

		register_post_type( self::POST_TYPE, $args );
	}

	/**
	 * Registers the Release Category taxonomy.
	 *
	 * @return void
	 */
	public function register_taxonomy(): void {
		$labels = array(
			'name'              => _x( 'Release Categories', 'Taxonomy general name', 'gatherpress-org-plugin' ),
			'singular_name'     => _x( 'Release Category', 'Taxonomy singular name', 'gatherpress-org-plugin' ),
			'search_items'      => __( 'Search Release Categories', 'gatherpress-org-plugin' ),
			'all_items'         => __( 'All Release Categories', 'gatherpress-org-plugin' ),
			'parent_item'       => __( 'Parent Release Category', 'gatherpress-org-plugin' ),
			'parent_item_colon' => __( 'Parent Release Category:', 'gatherpress-org-plugin' ),
			'edit_item'         => __( 'Edit Release Category', 'gatherpress-org-plugin' ),
			'update_item'       => __( 'Update Release Category', 'gatherpress-org-plugin' ),
			'add_new_item'      => __( 'Add New Release Category', 'gatherpress-org-plugin' ),
			'new_item_name'     => __( 'New Release Category Name', 'gatherpress-org-plugin' ),
			'menu_name'         => __( 'Categories', 'gatherpress-org-plugin' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'release-category' ),
		);

		register_taxonomy( self::TAXONOMY, self::POST_TYPE, $args );
	}
}
