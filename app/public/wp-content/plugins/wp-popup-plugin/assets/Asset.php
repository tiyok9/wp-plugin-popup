<?php

namespace assets;

class Asset
{
	private static $intance = null;
	private function __construct() {
		add_action('admin_enqueue_scripts', [$this, 'css_asset']);
		add_action('admin_enqueue_scripts', [$this, 'js_assets']);

	}
	public static function get_instance(){
		if(self::$intance == null){
			self::$intance = new self();
		}
		return self::$intance;
	}

	public function css_asset() {
		wp_enqueue_style('style', plugins_url('css/output.css', __FILE__));
	}
	function js_assets()
	{
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('js', plugin_dir_url(__FILE__) . 'js/index.js', array('jquery', 'jquery-ui-sortable'), false, true);
	}
}
