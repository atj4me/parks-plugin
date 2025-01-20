<?php

function register_facilities_taxonomy() {

	/**
	 * Taxonomy: Facilities.
	 */

	$labels = [
		"name" => esc_html__( "Facilities", "twentytwentyfive" ),
		"singular_name" => esc_html__( "Facility", "twentytwentyfive" ),
		"menu_name" => esc_html__( "Facilities", "twentytwentyfive" ),
		"all_items" => esc_html__( "All Facilities", "twentytwentyfive" ),
		"edit_item" => esc_html__( "Edit Facility", "twentytwentyfive" ),
		"view_item" => esc_html__( "View Facility", "twentytwentyfive" ),
		"update_item" => esc_html__( "Update Facility name", "twentytwentyfive" ),
		"add_new_item" => esc_html__( "Add new Facility", "twentytwentyfive" ),
		"new_item_name" => esc_html__( "New Facility name", "twentytwentyfive" ),
		"parent_item" => esc_html__( "Parent Facility", "twentytwentyfive" ),
		"parent_item_colon" => esc_html__( "Parent Facility:", "twentytwentyfive" ),
		"search_items" => esc_html__( "Search Facilities", "twentytwentyfive" ),
		"popular_items" => esc_html__( "Popular Facilities", "twentytwentyfive" ),
		"separate_items_with_commas" => esc_html__( "Separate Facilities with commas", "twentytwentyfive" ),
		"add_or_remove_items" => esc_html__( "Add or remove Facilities", "twentytwentyfive" ),
		"choose_from_most_used" => esc_html__( "Choose from the most used Facilities", "twentytwentyfive" ),
		"not_found" => esc_html__( "No Facilities found", "twentytwentyfive" ),
		"no_terms" => esc_html__( "No Facilities", "twentytwentyfive" ),
		"items_list_navigation" => esc_html__( "Facilities list navigation", "twentytwentyfive" ),
		"items_list" => esc_html__( "Facilities list", "twentytwentyfive" ),
		"back_to_items" => esc_html__( "Back to Facilities", "twentytwentyfive" ),
		"name_field_description" => esc_html__( "The name is how it appears on your site.", "twentytwentyfive" ),
		"parent_field_description" => esc_html__( "Assign a parent term to create a hierarchy. The term Jazz, for example, would be the parent of Bebop and Big Band.", "twentytwentyfive" ),
		"slug_field_description" => esc_html__( "The slug is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.", "twentytwentyfive" ),
		"desc_field_description" => esc_html__( "The description is not prominent by default; however, some themes may show it.", "twentytwentyfive" ),
	];

	
	$args = [
		"label" => esc_html__( "Facilities", "twentytwentyfive" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'facilities', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "facilities",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "facilities", [ "parks" ], $args );
}