<?php

namespace app\controller;

use app\model\Theme;
use app\request\Validation;

class ThemeController extends Validation
{
	public function __construct(Theme $theme)
	{
		$this->theme = $theme;
	}

	public function save_template()
	{
		// Pastikan request memiliki data
		if (empty($_POST)) {
			wp_redirect(admin_url('admin.php?page=popup_settings&message=error'));
			exit();
		}

		// Aturan Validasi seperti Laravel
		$rules = [
			'group1' => ['required'],
			'group2' => ['required'],
			'group3' => ['required'],
			'buttonstyle' => ['required'],
			'button' => ['required'],
			'img' => ['required'],
			'imageOption' => ['required']
		];

		// Validasi input
		$validation = $this->validate($_POST, $rules);
		$errors = $validation['errors'];
		$validatedData = $validation['validated'];
		// Jika ada error, redirect dengan pesan error

		if (!empty($errors)) {

			$errorMessage = http_build_query(['message' => json_encode($errors)]);
			wp_redirect(admin_url("admin.php?page=wp-templates&message=error"));
			exit();
		}


		$response = $this->theme->save_template($validatedData);

		if ($response === false) {
			wp_redirect(admin_url('admin.php?page=wp-templates&message=error'));
			exit();
		}

		// Redirect sukses

		wp_redirect(admin_url('admin.php?page=wp-templates&message=success'));
		exit();
	}

	public function delete_template()
	{
		if (empty($_POST)) {
			wp_redirect(admin_url('admin.php?page=popup_settings&message=error'));
			exit();
		}
		$response = $this->theme->delete_template($_POST['template_id']);

		if ($response === false) {
			wp_redirect(admin_url('admin.php?page=wp-templates&message=error'));
			exit();
		}

		// Redirect sukses

		wp_redirect(admin_url('admin.php?page=wp-templates&message=success'));
		exit();
	}
}
