<div class="wrap">
	<h1>Pengaturan Popup</h1>

	<?php if (isset($_GET['message']) && $_GET['message'] === 'success'): ?>
		<div class="updated notice is-dismissible"><p>Popup berhasil disimpan!</p></div>
	<?php elseif (isset($_GET['message']) && $_GET['message'] === 'error'): ?>
		<div class="error notice is-dismissible"><p>Terjadi kesalahan saat menyimpan popup!</p></div>
	<?php endif; ?>

	<form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
		<input type="hidden" name="action" value="save_content_popup">
		<?php wp_nonce_field('save_popup_settings_nonce', 'popup_settings_nonce'); ?>

		<table class="form-table">
			<tbody>
			<tr>
				<th scope="row"><label for="popup_title">Judul Popup</label></th>
				<td>
					<input type="text" name="popup_title" id="popup_title" class="regular-text" required>
					<p class="description">Masukkan judul untuk popup.</p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="popup_title">Judul Popup</label></th>
				<td>
					<input type="text" name="popup_button" id="popup_title" class="regular-text" required>
					<p class="description">Masukkan judul untuk popup.</p>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="popup_content">Konten Popup</label></th>
				<td>
					<textarea name="popup_content" id="popup_content" class="large-text code" rows="5" required></textarea>
					<p class="description">Isi konten popup.</p>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="popup_display_type">Template Popup</label></th>
				<td>
					<select name="theme_id" id="popup_display_type" class="regular-text">

						<?php foreach ($templates as $key=>$template): ?>
							<option value="<?= htmlspecialchars($template['id']); ?>">Template <?= htmlspecialchars($key) + 1; ?></option>
						<?php endforeach; ?>
					</select>
					<p class="description">Pilih bagaimana popup akan ditampilkan.</p>
				</td>
			</tr>

			<tr>
				<th scope="row">Tampilkan di Halaman</th>
				<td>
					<?php foreach (get_pages() as $page) : ?>
						<label>
							<input type="checkbox" name="page_id[]" value="<?php echo esc_attr($page->ID); ?>">
							<?php echo esc_html($page->post_title); ?>
						</label>
						<br>
					<?php endforeach; ?>
					<p class="description">Pilih halaman di mana popup akan muncul.</p>
				</td>
			</tr>
			</tbody>
		</table>

		<?php submit_button('Simpan Pengaturan Popup'); ?>
	</form>
</div>
