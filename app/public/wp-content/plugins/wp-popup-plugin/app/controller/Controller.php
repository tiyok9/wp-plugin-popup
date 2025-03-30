<?php
namespace app\controller;

use Exception;

class Controller
{
	protected $pages = [
		'wp-popup-plugin'=> 'menu.php',
		'wp-create'=> 'create.php',
		'wp-templates'=> 'template.php',
		'createtemplate'=> 'createTemplate.php',
	];
	protected string $viewPath;

	public function __construct()
	{
		$this->viewPath = __DIR__ . "/../../view/";
	}
	/**
	 * Menentukan dan menampilkan view berdasarkan halaman WordPress saat ini.
	 */
	public function view($data = [])
	{
		$route = $this->getCurrentPage();

		if ($route == null) {
			throw new Exception("Halaman tidak dikenali.");
		}

		$file = $this->viewPath . "{$route}";
		if (!file_exists($file)) {
			throw new Exception("View file '{$route}' not found.");
		}
		if($data){
			extract($data);
		}

		ob_start();
		include $file;
		echo ob_get_clean();
	}

	/**
	 * Mengambil nama halaman WordPress saat ini untuk dicocokkan dengan view.
	 */
	public function getCurrentPage(): ?string
	{
		// Jika menggunakan add_menu_page() atau add_submenu_page()
		if (isset($_GET['page'])) {
			if (array_key_exists($_GET['page'], $this->pages)) {
				return $this->pages[$_GET['page']];
			}
			return null;
		}

		return null;
	}

}
