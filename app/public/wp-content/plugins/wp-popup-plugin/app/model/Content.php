<?php

namespace app\model;

use Exception;

class Content
{
	public function __construct()
	{
		global $wpdb; // Panggil global dalam metode
		$this->wpdb = $wpdb;
		$this->table = $wpdb->prefix . 'popup_content';
	}
	public function save_content($data) {
		if (isset($data)) {
			try {
				foreach ($data['page_id'] as $val){
					$status = $this->wpdb->insert(
						$this->table,
						[
							'theme_id' => $data['theme_id'],
							'page_id'    => $val,
							'popup_button'    => $data['popup_button'],
							'popup_title'    => $data['popup_title'],
							'popup_content'    => $data['popup_content'],
							'status'    => false,
						],
						['%s', '%s', '%s', '%s', '%s', '%s']
					);
					if (!$status){
						return false;
					}
				}

				return true;
			}catch (Exception $e){
				return false;
			}
		}
		return false;
	}

	public function status($id) {
			try {
				$this->wpdb->query(
					$this->wpdb->prepare(
						"UPDATE $this->table SET status = 0 WHERE id <> %d",
						$id
					)
				);
				$status = $this->wpdb->update(
					$this->table,
					['status' => 1], // Data yang diperbarui
					['id' => $id],   // WHERE id = $id
					['%d'],          // Format untuk status
					['%d']           // Format untuk id
				);
				if($status){
					return true;
				}
				return false;
			}catch (Exception $e){
				return false;
			}
	}

	public function delete_content_popup($id) {
		try {
			// Debugging query
			$query = $this->wpdb->prepare("
            DELETE FROM {$this->table}
            WHERE id = %d AND status <> %d
        ", $id, 1);


			$deleted = $this->wpdb->query($query);
			if ($deleted) {
				return true;
			}

			return false;
		} catch (Exception $e) {
			return false;
		}
	}
}
