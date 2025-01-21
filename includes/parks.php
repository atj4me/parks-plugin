<?php 
/**
 * Registers the custom post type "Parks".
 *
 * This function sets up the custom post type "Parks" with various labels and arguments.
 * It includes support for title, custom fields, and author.
 *
 * Labels:
 * - name: Parks
 * - singular_name: Park
 * - menu_name: My Parks
 * - all_items: All Parks
 * - add_new: Add new
 * - add_new_item: Add new Park
 * - edit_item: Edit Park
 * - new_item: New Park
 * - view_item: View Park
 * - view_items: View Parks
 * - search_items: Search Parks
 * - not_found: No Parks found
 * - not_found_in_trash: No Parks found in trash
 * - parent: Parent Park:
 * - featured_image: Featured image for this Park
 * - set_featured_image: Set featured image for this Park
 * - remove_featured_image: Remove featured image for this Park
 * - use_featured_image: Use as featured image for this Park
 * - archives: Park archives
 * - insert_into_item: Insert into Park
 * - uploaded_to_this_item: Upload to this Park
 * - filter_items_list: Filter Parks list
 * - items_list_navigation: Parks list navigation
 * - items_list: Parks list
 * - attributes: Parks attributes
 * - name_admin_bar: Park
 * - item_published: Park published
 * - item_published_privately: Park published privately.
 * - item_reverted_to_draft: Park reverted to draft.
 * - item_trashed: Park trashed.
 * - item_scheduled: Park scheduled
 * - item_updated: Park updated.
 * - parent_item_colon: Parent Park:
 *
 * Arguments:
 * - label: Parks
 * - labels: Array of labels
 * - description: (string) Description of the post type
 * - public: (bool) Whether the post type is publicly accessible
 * - publicly_queryable: (bool) Whether queries can be performed on the front end
 * - show_ui: (bool) Whether to generate a default UI for managing this post type
 * - show_in_rest: (bool) Whether to include the post type in the REST API
 * - rest_base: (string) The base slug for the REST API
 * - rest_controller_class: (string) The controller class for the REST API
 * - rest_namespace: (string) The namespace for the REST API
 * - has_archive: (bool) Whether the post type has an archive page
 * - show_in_menu: (bool) Whether to show the post type in the admin menu
 * - show_in_nav_menus: (bool) Whether to show the post type in navigation menus
 * - delete_with_user: (bool) Whether to delete posts of this type when deleting a user
 * - exclude_from_search: (bool) Whether to exclude posts of this type from search results
 * - capability_type: (string) The type of capability used for this post type
 * - map_meta_cap: (bool) Whether to map meta capabilities
 * - hierarchical: (bool) Whether the post type is hierarchical
 * - can_export: (bool) Whether the post type can be exported
 * - rewrite: (array) Rewrite rules for the post type
 * - query_var: (bool) Whether to allow querying the post type using a query variable
 * - supports: (array) Features supported by the post type
 * - show_in_graphql: (bool) Whether to include the post type in GraphQL
 *
 * @return void
 */
function register_parks_post_type() {

	$labels = [
		"name" => esc_html__( "Parks", "twentytwentyfive" ),
		"singular_name" => esc_html__( "Park", "twentytwentyfive" ),
		"menu_name" => esc_html__( "My Parks", "twentytwentyfive" ),
		"all_items" => esc_html__( "All Parks", "twentytwentyfive" ),
		"add_new" => esc_html__( "Add new", "twentytwentyfive" ),
		"add_new_item" => esc_html__( "Add new Park", "twentytwentyfive" ),
		"edit_item" => esc_html__( "Edit Park", "twentytwentyfive" ),
		"new_item" => esc_html__( "New Park", "twentytwentyfive" ),
		"view_item" => esc_html__( "View Park", "twentytwentyfive" ),
		"view_items" => esc_html__( "View Parks", "twentytwentyfive" ),
		"search_items" => esc_html__( "Search Parks", "twentytwentyfive" ),
		"not_found" => esc_html__( "No Parks found", "twentytwentyfive" ),
		"not_found_in_trash" => esc_html__( "No Parks found in trash", "twentytwentyfive" ),
		"parent" => esc_html__( "Parent Park:", "twentytwentyfive" ),
		"featured_image" => esc_html__( "Featured image for this Park", "twentytwentyfive" ),
		"set_featured_image" => esc_html__( "Set featured image for this Park", "twentytwentyfive" ),
		"remove_featured_image" => esc_html__( "Remove featured image for this Park", "twentytwentyfive" ),
		"use_featured_image" => esc_html__( "Use as featured image for this Park", "twentytwentyfive" ),
		"archives" => esc_html__( "Park archives", "twentytwentyfive" ),
		"insert_into_item" => esc_html__( "Insert into Park", "twentytwentyfive" ),
		"uploaded_to_this_item" => esc_html__( "Upload to this Park", "twentytwentyfive" ),
		"filter_items_list" => esc_html__( "Filter Parks list", "twentytwentyfive" ),
		"items_list_navigation" => esc_html__( "Parks list navigation", "twentytwentyfive" ),
		"items_list" => esc_html__( "Parks list", "twentytwentyfive" ),
		"attributes" => esc_html__( "Parks attributes", "twentytwentyfive" ),
		"name_admin_bar" => esc_html__( "Park", "twentytwentyfive" ),
		"item_published" => esc_html__( "Park published", "twentytwentyfive" ),
		"item_published_privately" => esc_html__( "Park published privately.", "twentytwentyfive" ),
		"item_reverted_to_draft" => esc_html__( "Park reverted to draft.", "twentytwentyfive" ),
		"item_trashed" => esc_html__( "Park trashed.", "twentytwentyfive" ),
		"item_scheduled" => esc_html__( "Park scheduled", "twentytwentyfive" ),
		"item_updated" => esc_html__( "Park updated.", "twentytwentyfive" ),
		"parent_item_colon" => esc_html__( "Parent Park:", "twentytwentyfive" ),
	];

	$args = [
		"label" => esc_html__( "Parks", "twentytwentyfive" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => true,
		"rewrite" => [ "slug" => "parks", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "custom-fields", "author" ],
		"show_in_graphql" => false,
	];

	/**
	 * Registers a custom post type named "parks".
	 *
	 * @param string $post_type The name of the post type.
	 * @param array  $args      An array of arguments for registering a post type.
	 */
	register_post_type( "parks", $args );
}

