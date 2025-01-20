<?php 
function register_parks_post_type() {

	/**
	 * Post Type: Parks.
	 */

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

	register_post_type( "parks", $args );
}

