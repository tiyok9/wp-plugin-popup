<?php
/**
 * Plugin Name:     Wp Popup Plugin
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     wp-popup-plugin
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Wp_Popup_Plugin
 */

use app\controller\ApiController;
use app\controller\ClientController;
use app\controller\ContentController;
use app\controller\HomeController;
use app\controller\ThemeController;
use app\model\Content;
use app\model\Theme;
use assets\Asset;
use database\DBCreate;

require_once __DIR__ . '/vendor/autoload.php';
$theme = new Theme();
$content = new Content();
$controller = new HomeController($theme);
$controllerApi = new ApiController();
$controllerTheme = new ThemeController($theme);
$controllerContent = new ContentController($content);
$controllerClient = new ClientController();
Asset::get_instance();
DBCreate::get_instance();
function enqueue_custom_script() {
	wp_enqueue_media();
	wp_enqueue_script(
		'custom-upload-script',
		plugins_url('assets/js/upload.js', __FILE__),
		array(),
		null,
		true
	);
}
add_action('wp_enqueue_scripts', function () {
	wp_enqueue_script(
		'react-app',
		plugin_dir_url(__FILE__) . 'dist/bundle.js',
		array(),
		'1.0.0',
		true
	);

});
add_action('admin_enqueue_scripts', 'enqueue_custom_script');

add_action('admin_menu', function () use ($controller) {
	$controller->index();
	$controller->subMenu();
});
add_action('rest_api_init', function () use ($controllerApi) {
	$controllerApi->register();
});
add_action('admin_post_save_template', function () use ($controllerTheme) {
	$controllerTheme->save_template();
});
add_action('admin_post_delete_template', function () use ($controllerTheme) {
	$controllerTheme->delete_template();
});
add_action('admin_post_save_content_popup', function () use ($controllerContent) {
	$controllerContent->save_content_popup();
});
add_action('admin_post_delete_content_popup', function () use ($controllerContent) {
	$controllerContent->delete_content_popup();
});

add_action('admin_post_save_status', function () use ($controllerContent) {
	$controllerContent->save_status();
});
add_action('wp_footer', function () use ($controllerClient) {
	$controllerClient->popup();
});


function my_plugin_set_active_submenu($submenu_file) {
	global $plugin_page;

	if ($plugin_page === 'createtemplate') {
		$submenu_file = 'wp-templates'; // Set menu utama yang aktif
	}

	return $submenu_file;
}
add_filter('submenu_file', 'my_plugin_set_active_submenu');
