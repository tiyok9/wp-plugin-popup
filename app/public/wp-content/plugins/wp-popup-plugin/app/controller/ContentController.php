<?php

namespace app\controller;

use app\model\Content;
use app\request\Validation;

class ContentController extends Validation
{
	public function __construct(Content $content)
	{
		$this->content = $content;
	}

	public function save_content_popup()
	{

		if (empty($_POST)) {
			wp_redirect(admin_url('admin.php?page=wp-popup-plugin&message=missing_data'));
			exit();
		}

		$rules = [
			'popup_title' => ['required'],
			'popup_content' => ['required'],
			'theme_id' => ['required'],
			'popup_button' => ['required'],
			'page_id' => ['array']
		];

		// Validasi input
		$validation = $this->validate($_POST, $rules);
		$errors = $validation['errors'];
		$validatedData = $validation['validated'];
		// Jika ada error, redirect dengan pesan error
		if (!empty($errors)) {

			$errorMessage = http_build_query(['message' => json_encode($errors)]);
			wp_redirect(admin_url("admin.php?page=wp-popup-plugin&$errorMessage"));
			exit();
		}

		$response = $this->content->save_content($validatedData);
		if ($response === false) {
			wp_redirect(admin_url('admin.php?page=wp-popup-plugin&message=error'));
			exit();
		}

		// Redirect sukses

		wp_redirect(admin_url('admin.php?page=wp-popup-plugin&message=success'));
		exit();
	}

	public function save_status()
	{

		if (empty($_POST)) {
			wp_redirect(admin_url('admin.php?page=wp-popup-plugin&message=error'));
			exit();
		}

		$response = $this->content->status($_POST['popup_id']);
		if ($response === false) {
			wp_redirect(admin_url('admin.php?page=wp-popup-plugin&message=error'));
			exit();
		}

		// Redirect sukses
		wp_redirect(admin_url('admin.php?page=wp-popup-plugin&message=success'));
		exit();
	}

	public function delete_content_popup()
	{
		if (empty($_POST)) {
			wp_redirect(admin_url('admin.php?page=wp-popup-plugin&message=error'));
			exit();
		}

		$response = $this->content->delete_content_popup($_POST['popup_id']);


		if ($response === false) {
			wp_redirect(admin_url('admin.php?page=wp-popup-plugin&message=error'));
			exit();
		}

		// Redirect sukses
		wp_redirect(admin_url('admin.php?page=wp-popup-plugin&message=success'));
		exit();
	}
}
