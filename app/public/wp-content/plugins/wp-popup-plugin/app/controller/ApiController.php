<?php

namespace app\controller;

use WP_Error;
use WP_REST_Request;

class ApiController
{
	public function register()
	{
		register_rest_route('custom/v1', '/upload-image/', array(
			'methods' => 'POST',
			'callback' => [$this, 'handle_image_upload'],
			'permission_callback' => '__return_true',
		));

		register_rest_route('custom/v1', '/get-image', array(
			'methods' => 'GET',
			'callback' => [$this,'get_uploaded_image'],
			'permission_callback' => '__return_true',
		));
		register_rest_route('custom/v1', '/get-popup', array(
			'methods' => 'GET',
			'callback' => [$this,'get_popup_data'],
			'permission_callback' => '__return_true',
		));
	}

	public function handle_image_upload(WP_REST_Request $request) {
		if (!isset($_FILES['image'])) {
			return new WP_Error('no_file', 'No image uploaded', array('status' => 400));
		}

		session_start();
		$upload_dir = wp_upload_dir();
		$file_name = time() . "_" . basename($_FILES['image']['name']);
		$target_path = $upload_dir['path'] . '/' . $file_name;

		if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
			$_SESSION['uploaded_image'] = $file_name;
			return rest_ensure_response(['success' => true, 'image_url' => $_SESSION['uploaded_image']]);
		}

		return new WP_Error('upload_failed', 'Failed to upload', array('status' => 500));
	}

	public function get_uploaded_image() {
		session_start();
		return rest_ensure_response(['image_url' => $_SESSION['uploaded_image'] ?? null]);
	}

	public function get_popup_data(WP_REST_Request $request) {
		global $wpdb;
		$page_id = $request->get_param('page_id');

		$query = "
        SELECT p.*, r.*
        FROM {$wpdb->prefix}popup_content AS p
        JOIN {$wpdb->prefix}popup_settings AS r ON p.theme_id = r.id
        WHERE p.page_id = %d
        AND p.status = %d
        LIMIT 1
    ";

		return $wpdb->get_row($wpdb->prepare($query, $page_id, 1), ARRAY_A);
	}


}
