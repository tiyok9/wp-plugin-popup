<?php

namespace view\component;

use WP_List_Table;

class TableTemplate extends WP_List_Table {

	public function __construct() {
		parent::__construct([
			'singular' => 'popup',
			'plural'   => 'popups',
			'ajax'     => false
		]);
	}

	/**
	 * Menentukan kolom yang akan ditampilkan
	 */
	public function get_columns() {
		return [
			'template' => 'Template Popup', // Kolom yang bisa diklik untuk sorting
		];
	}

	/**
	 * Menentukan kolom yang bisa diurutkan
	 */
	public function get_sortable_columns() {
		return [
			'template' => ['id', false], // Sorting berdasarkan id
		];
	}

	/**
	 * Mengisi data tabel
	 */
	public function prepare_items() {
		global $wpdb;
		$popup_table = $wpdb->prefix . 'popup_settings';

		$per_page     = 10;
		$current_page = $this->get_pagenum();
		$search       = isset($_REQUEST['s']) ? trim($_REQUEST['s']) : '';

		// Menyusun kondisi pencarian
		$where = '';
		if (!empty($search)) {
			$where = $wpdb->prepare("WHERE p.id LIKE %s", '%' . $wpdb->esc_like($search) . '%');
		}

		// Menghitung total item
		$total_items = $wpdb->get_var("SELECT COUNT(*) FROM $popup_table p $where");

		// Sorting berdasarkan id (default DESC)
		$orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'id';
		$order   = (isset($_GET['order']) && $_GET['order'] === 'asc') ? 'ASC' : 'DESC';

		// Pastikan hanya sorting kolom tertentu
		$allowed_orderby = ['id'];
		if (!in_array($orderby, $allowed_orderby)) {
			$orderby = 'id';
		}

		// Query untuk mengambil data (sorting berdasarkan id)
		$query = $wpdb->prepare("
            SELECT p.id
            FROM $popup_table p
            $where
            ORDER BY $orderby $order
            LIMIT %d OFFSET %d
        ", $per_page, ($current_page - 1) * $per_page);

		// Eksekusi query
		$data = $wpdb->get_results($query, ARRAY_A);

		// Iterasi +1 untuk setiap data
		$iterasi = ($current_page - 1) * $per_page + 1;
		foreach ($data as &$item) {
			$item['template'] = 'Template ' . $iterasi++; // Tambahkan "Template X"
		}

		// Set kolom tabel
		$this->_column_headers = [$this->get_columns(), [], $this->get_sortable_columns()];
		$this->items = $data;

		// Set pagination
		$this->set_pagination_args([
			'total_items' => $total_items,
			'per_page'    => $per_page,
			'total_pages' => ceil($total_items / $per_page),
		]);
	}

	/**
	 * Menampilkan data kolom "Template Popup"
	 */
	public function column_template($item) {
		$title = '<strong>' . esc_html($item['template']) . '</strong>';

		ob_start(); ?>
		<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="display: inline;">
			<input type="hidden" name="action" value="delete_template">
			<input type="hidden" name="template_id" value="<?php echo intval($item['id']); ?>">
			<?php wp_nonce_field('delete_popup_nonce', 'popup_nonce'); ?>
			<button type="submit" class="delete-popup" onclick="return confirm('Are you sure?')" style="border: none; background: none; color: red; cursor: pointer; text-decoration: underline;">
				Trash
			</button>
		</form>
		<?php
		$delete_form = ob_get_clean();

		return $title . $this->row_actions(['trash' => $delete_form]);
//		$delete_url = wp_nonce_url(
//			admin_url('admin-post.php?action=delete_popup&id=' . intval($item['id'])),
//			'delete_popup_nonce'
//		);
//
//		return sprintf(
//			'%s<br><a href="%s" class="button delete-popup" onclick="return confirm(\'Apakah Anda yakin ingin menghapus popup ini?\')">Hapus</a>',
//			esc_html($item['template']),
//			esc_url($delete_url)
//		);
	}

}
