<?php
/**
 * Plugin name:	Realty Plugin
 * Version: 	1.0
 * Author: 		Vladimir
 */
require_once dirname( __FILE__ ) . "/RealtyWidget.php";

add_action('init', 'add_city_post_type');

// Добавляем новый тип постов - Города
function add_city_post_type() {
	register_post_type('cities', array(
		'public' => true,
		'show_in_menu' => true,
		'hierarchical' => false,
		'has_archive' => true,
		'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
		'supports' => array('title', 'editor', 'thumbnail'),
		'rewrite' => true,
		'query_var' => true,
		'labels' => array(
			'name' => __('Cities'),
			'singular_name' => __('City'),
			'add_new' => __('Add new city'),
		),
		
	));
}


add_action('add_meta_boxes', function () {
	add_meta_box('realty_city', __('Город'), 'realty_city_metabox', 'realty', 'side');
}, 1);

function realty_city_metabox($post) {
	$cities = get_posts(array(
		'post_type' => 'cities',
		'posts_per_page' => -1,
		'order_by' => 'post_title'
	));

	if ($cities) {
		echo '<div style="max-height:200px; overflow-y:auto;"><ul>';

		foreach ($cities as $city) {
			echo '<li><label>
				<input type="radio" name="post_parent" value="'. $city->ID .'" '. checked($city->ID, $post->post_parent, 0). '> ' . esc_html($city->post_title).'</label></li>';
		}

		echo '</ul></div>';
	}
}

add_action('widgets_init', function(){
	register_widget("RealtyWidget");
});