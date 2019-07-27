<?php

// Добавляем js переменную для хранения ajax url и nonce
add_action('wp_enqueue_scripts', 'add_ajaxurl');

function add_ajaxurl() {
	wp_localize_script('jquery', 'realty_var', array(
		'url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('realty_nonce'),
	));
}



// javascript для отправки формы новой недвижимости
add_action('wp_footer', 'new_realty_ajax', 99);

function new_realty_ajax() {
	?>
	<script type="text/javascript" >
		jQuery(document).ready(function ($) {

			$("#new_realty_form").submit(function(e) {
				e.preventDefault();

				var data = {
					action: 'new-realty',
					_ajax_nonce: realty_var.nonce,
					title: $('input[name=title]').val(),
					description: $('input[name=description]').val(),
					price: $('input[name=price]').val(),
					area: $('input[name=area]').val(),
					address: $('input[name=address]').val(),
					living_space: $('input[name=living_space]').val(),
					floor: $('input[name=floor]').val(),
					city: $('#city').val()
				};

				jQuery.post(realty_var.url, data, function(responce) {
					console.log('Responce: ' + responce);
					$('#new_realty_form')[0].reset();
				});
			});
		});
	</script>
	<?php
}


// Добавление новой недвижимости на сайт через ajax
add_action('wp_ajax_new-realty', 'new_realty_ajax_callback');
add_action('wp_ajax_nopriv_new-realty', 'new_realty_ajax_callback');


function new_realty_ajax_callback() {
	check_ajax_referer( 'realty_nonce', '_ajax_nonce' );

	$realty_data = array(
		'post_title' => sanitize_text_field($_POST['title']),
		'post_content' => sanitize_textarea_field($_POST['description']),
		'post_status' => 'publish',
		'post_type' => 'realty',
		'post_parent' => intval($_POST['city']),
	);

	$realty_id = wp_insert_post($realty_data);

	update_post_meta($realty_id, 'area', intval($_POST['area']));
	update_post_meta($realty_id, 'price', intval($_POST['price']));
	update_post_meta($realty_id, 'address', sanitize_text_field($_POST['address']));
	update_post_meta($realty_id, 'living_space', intval($_POST['living_space']));
	update_post_meta($realty_id, 'floor', intval($_POST['floor']));
	wp_die();
}