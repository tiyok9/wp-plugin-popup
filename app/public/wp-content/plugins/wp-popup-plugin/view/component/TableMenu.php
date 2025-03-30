<?php

namespace view\component;

use WP_List_Table;


class TableMenu extends WP_List_Table {

	public function __construct() {
		parent::__construct([
			'singular' => 'popup',
			'plural'   => 'popups',
			'ajax'     => false
		]);
	}

	/**
	 * Menentukan kolom yang akan ditampilkan di tabel
	 */
	public function get_columns() {
		return [
			'cb'            => '<input type="checkbox" />',
			'popup_title'   => 'Popup Title',
			'status'        => 'Popup Status',
			'popup_content' => 'Content',
			'page_id'       => 'Pages',
		];
	}

	/**
	 * Menentukan kolom yang bisa diurutkan
	 */
	public function get_sortable_columns() {
		return [
			'popup_title' => ['popup_title', false], // Sorting berdasarkan popup_title
		];
	}

	/**
	 * Menampilkan checkbox di setiap baris
	 */
	public function column_cb($item) {
		return sprintf('<input type="checkbox" name="popup[]" value="%s" />', $item['id']);
	}

	public function column_status($item) {
		$status = intval($item['status']);
		$label = $status ? 'Aktif' : 'Not Active';
		$button_class = $status ? 'button-primary' : 'button-secondary';
		$admin_url = admin_url('admin-post.php');

		return sprintf(
			'<form method="post" action="%s">
        <input type="hidden" name="action" value="save_status">
        %s
        <input type="hidden" name="popup_id" value="%d">
        <input type="hidden" name="current_status" value="%d">

        <button type="submit" name="toggle_status" class="toggle-status %s">
            %s
        </button>
    </form>',
			esc_url($admin_url), // Pastikan URL aman
			wp_nonce_field('save_popup_settings_nonce', 'popup_settings_nonce', true, false), // Output nonce sebagai string
			intval($item['popup_id']),
			$status,
			esc_attr($button_class),
			esc_html($label)
		);
	}
	/**
	 * Menampilkan data di dalam kolom
	 */
	public function column_default($item, $column_name) {
		return isset($item[$column_name]) ? esc_html($item[$column_name]) : '-';
	}

	/**
	 * Menyiapkan data untuk ditampilkan di tabel
	 */
	public function prepare_items() {
		global $wpdb;
		$popup_table = $wpdb->prefix . 'popup_content';
		$relation_table = $wpdb->prefix . 'popup_settings';

		$per_page = 10;
		$current_page = $this->get_pagenum();
		$search = isset($_REQUEST['s']) ? trim($_REQUEST['s']) : '';

		// Pastikan $where tidak kosong
		$where = '';
		if (!empty($search)) {
			$where .= $wpdb->prepare(" AND p.popup_title LIKE %s", '%' . $wpdb->esc_like($search) . '%');
		}

		// Ambil jumlah total data
		$total_items = $wpdb->get_var("SELECT COUNT(*) FROM $popup_table p WHERE 1=1 $where");

		$orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'popup_title';
		$order   = (isset($_GET['order']) && $_GET['order'] === 'asc') ? 'ASC' : 'DESC';

		// Pastikan hanya sorting kolom tertentu
		$allowed_orderby = ['popup_title', 'status', 'popup_content', 'page_id'];
		if (!in_array($orderby, $allowed_orderby)) {
			$orderby = 'popup_title';
		}

		// Query utama
		$query = $wpdb->prepare("
			SELECT
				p.id AS popup_id, p.*,
				pr.id AS relation_id, pr.*
			FROM $popup_table p
			LEFT JOIN $relation_table pr ON p.theme_id = pr.id
			WHERE 1=1 $where
			ORDER BY $orderby $order
			LIMIT %d OFFSET %d
		", $per_page, ($current_page - 1) * $per_page);

		// Eksekusi query
		$data = $wpdb->get_results($query, ARRAY_A);

		// Debugging: Cek apakah data tersedia
		error_log("Data Retrieved: " . print_r($data, true));

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
	 * Menampilkan baris data dalam tabel
	 */
	public function display_rows() {
		foreach ($this->items as $item) {
			$this->single_row($item);
		}
	}
	public function column_popup_title($item) {
		$title = '<strong>' . esc_html($item['popup_title']) . '</strong>';

		ob_start(); ?>
		<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="display: inline;">
			<input type="hidden" name="action" value="delete_content_popup">
			<input type="hidden" name="popup_id" value="<?php echo intval($item['popup_id']); ?>">
			<?php wp_nonce_field('delete_popup_nonce', 'popup_nonce'); ?>
			<button type="submit" class="delete-popup" onclick="return confirm('Are you sure?')" style="border: none; background: none; color: red; cursor: pointer; text-decoration: underline;">
				Trash
			</button>
		</form>
		<?php
		$delete_form = ob_get_clean();

		return $title . $this->row_actions(['trash' => $delete_form]);
	}
}
