<?php

namespace app\controller;

class ClientController
{
	public function get_popups() {
		global $wpdb;
		$current_page_id = get_the_ID();
		$query = "
				SELECT p.*
				FROM {$wpdb->prefix}popup_content AS p
				JOIN {$wpdb->prefix}popup_settings AS r ON p.theme_id = r.id
				WHERE p.page_id = %d
				AND p.status = %d
			";
		return $wpdb->get_results($wpdb->prepare($query, $current_page_id, 1), ARRAY_A);

	}

	public function popup() {
		$data = $this->get_popups();

		if (!$data) {
			return;
		}
		wp_localize_script('react-app', 'wpConfig', [
			'isClient' => 1,
			'pageId' =>get_the_ID(),
		]);

		echo '<div id="react-root"></div>';
	}
}
