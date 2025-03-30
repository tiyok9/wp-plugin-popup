<?php

class Sidebar
{
	private static $instance = null;
	private function __construct() {
		add_action('admin_menu', [$this, 'add_admin_menu']);
	}

	public static function get_instance() {
		if (self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function add_admin_menu()
	{
		add_menu_page(
			'me PopUp',
			'PopUp Mne',
			'manage_options',
			'e',
			[$this, 'popup_menu'],
			plugin_dir_url(__FILE__) . '../images/icon_wporg.png',
			20
		);
	}

	public function popup_menu() {
		echo "ini popup";
	}
}
