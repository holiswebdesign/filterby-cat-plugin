<?php

namespace KnowTheCode\FilterByCategory;

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_script' );
/**
 * Enqueue the script.
 *
 * @since 1.0.0
 *
 * @return void
 */
function enqueue_script() {
	$script_filename = '/assets/scripts/jquery.filterby-category.js';

	wp_enqueue_script(
		'filterby-category',
		_get_plugin_url() . $script_filename,
		[ 'jquery' ],
		_is_in_development_mode() ? filemtime( _get_plugin_directory() . $script_filename ) : '1.0.0',
		true
	);

	wp_localize_script( 'filterby-category', 'filterbyCatParams', [
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'action' => 'get_posts_for_filterby_cat',
		'nonce'   => wp_create_nonce( 'filterby-cat' ),
	] );
}

add_action( 'loop_start', __NAMESPACE__ . '\render_category_filtering' );
/**
 * Render out the category filtering HTML.
 *
 * @since 1.0.0
 *
 * @return void
 */
function render_category_filtering() {
	if ( ! is_front_page() || ! is_home() ) {
		return;
	}

	$categories = get_categories( [
		'hide_empty' => false,
		'orderby'    => 'name',
		'order'      => 'ASC',
	] );

	if ( empty( $categories ) || is_wp_error( $categories ) ) {
		return;
	}

	require __DIR__ . '/views/filterby.php';
}

add_action( 'wp_ajax_get_posts_for_filterby_cat', __NAMESPACE__ . '\get_posts_for_filterby_cat' );
add_action( 'wp_ajax_nopriv_get_posts_for_filterby_cat', __NAMESPACE__ . '\get_posts_for_filterby_cat' );
/**
 * Handle the AJAX request: get the posts, convert into JSON, and then render them out to the browser for the script.
 *
 * @since 1.0.0
 *
 * @return void
 */
function get_posts_for_filterby_cat() {
	check_ajax_referer( 'filterby-cat', 'nonce' );

	if ( ! isset ( $_POST['catId'] ) ) {
		wp_die( __( 'The category ID was not passed via AJAX.', 'filterby-cat' ) );
	}

	$posts = get_posts( [
		'category' => (int) $_POST['catId'],
		'numberposts' => 10,
		'no_found_rows' => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	] );

	//echo json_encode( $posts );
	
	foreach( $posts as $post ) {
		$permalink = get_permalink( $post );
		$title = get_the_title( $post );
		$response .= '<h1><a href="'. $permalink . '">' . $title . '</a></h1>';
	}
	
	echo $response;
	
	die();
}
