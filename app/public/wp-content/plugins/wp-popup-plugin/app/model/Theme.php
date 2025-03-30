<?php

namespace app\model;

use Exception;

class Theme
{
	public function __construct()
	{
		global $wpdb; // Panggil global dalam metode
		$this->wpdb = $wpdb;
		$this->table = $wpdb->prefix . 'popup_settings';
	}

	public function get_popup_settings() {

		// Ambil semua data popup
		$query = "
           SELECT * FROM wp_popup_settings
        ";
		$popups = $this->wpdb->get_results($query, ARRAY_A);

		return $popups;
	}


	public function save_template($data) {
		if (isset($data)) {
			$grouped = array_filter($data, fn($key) => preg_match('/^group\d+$/', $key), ARRAY_FILTER_USE_KEY);

			$ungrouped = array_diff_key($data, $grouped);


			try {
				$this->wpdb->insert(
					$this->table,
					[
						'theme_style' => json_encode($grouped, JSON_UNESCAPED_UNICODE),
						'button_style'    => $ungrouped['button']?sanitize_text_field($ungrouped['buttonstyle']):false,
						'button'    => $ungrouped['buttonstyle']?json_encode($ungrouped['button'], JSON_UNESCAPED_UNICODE):null,
						'background_img'    => $ungrouped['img']? sanitize_text_field($ungrouped['img']):null,
						'template'    => $ungrouped['imageOption']? sanitize_text_field($ungrouped['imageOption']):null,
					],
					['%s', '%s', '%s', '%s', '%s']
				);
				return true;
			}catch (Exception $e){
				return false;
			}
		}
		return false;
	}

	public function delete_template($id)
	{
		try {
			$this->wpdb->delete($this->table, ['id' => $id], ['%d']);
			return true;
		}catch (Exception $e){
			return false;
		}
	}
}
