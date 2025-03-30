<?php

namespace app\controller;

use app\model\Theme;

class HomeController extends Controller
{
	public function __construct(Theme $theme)
	{
		parent::__construct();

		$this->theme = $theme;
	}

	public function index()
	{
		add_menu_page(
			'Setting ge',
			'geg',
			'manage_options',
			'wp-popup-plugin',
			[$this, 'view'],
			plugin_dir_url(__FILE__) . '../images/icon_wporg.png',
			20
		);
	}
	public function subMenu()
	{
		add_submenu_page(
			'wp-popup-plugin',
			'Pengaturan Popup Tambahan',
			'Create Popup',
			'manage_options',
			'wp-create',
			function () {
				$results = $this->theme->get_popup_settings();
				$this->view(['templates' => $results]);
			}
		);
		add_submenu_page(
			'wp-popup-plugin',
			'Templates',
			'Templates',
			'manage_options',
			'wp-templates',
			[$this, 'view']
		);
		add_submenu_page(
			null,
			'My Hidden Page', // Judul halaman
			'My Hidden Page', // Nama submenu (tidak penting karena tidak muncul)
			'manage_options', // Hak akses
			'createtemplate', // Slug halaman
			[$this, 'view']);
	}
}
