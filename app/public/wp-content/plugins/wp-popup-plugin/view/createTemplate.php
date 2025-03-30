
<div class="wrap">
		<h1 class="dashboard-title">My Custom Dashboard</h1>
		<form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
			<input type="hidden" name="action" value="save_template">

			<?php wp_nonce_field('save_popup_settings_nonce', 'popup_settings_nonce'); ?>

			<div class="dashboard-layout">
			<!-- Kolom Besar -->
			<div class="dashboard-column large-column" id="large-column">
				<div class="dashboard-box" id="box1">
					<div class="box-header p-15">
						<h2>Theme Settings</h2>
					</div>
					<div class="box-content">
						<!-- Sidebar dengan ul & li -->
						<div class="container-sidebar">
							<div class="sidebar">
								<ul>
									<li onclick="showContent('overall')">Overall</li>
									<li onclick="showContent('title')">Title</li>
									<li onclick="showContent('container')">Container</li>
									<li onclick="showContent('content')">Content</li>
									<li onclick="showContent('button')">Button</li>
								</ul>
							</div>
							<!-- Konten Utama -->
							<div class="main-content" id="main-content">
								<?php include __DIR__ . '/component/sidebarContent.php'; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="dashboard-box p-15" id="box2">
					<div class="box-header">
						<h2>Select Theme</h2>
					</div>
					<div class="box-content">
						<div class="radio-image-container">
							<label>
								<input type="radio" id="theme1" name="imageOption" value="theme1" checked>
								<img src="<?php echo plugins_url('assets/img/Group 1.png', __DIR__); ?>" alt="Theme 1">
							</label>
							<label>
								<input type="radio" id="theme2" name="imageOption" value="theme2">
								<img src="<?php echo plugins_url('assets/img/Group 2.png', __DIR__); ?>" alt="Theme 2">
							</label>
						</div>
					</div>
				</div>

			</div>

			<!-- Kolom Kecil -->
			<div class="dashboard-column small-column" id="small-column">
				<div class="dashboard-box p-15" id="box3">
					<div class="box-header">
						<h2>Theme Preview</h2>
						<?php submit_button('Save Template'); ?>
					</div>
					<div class="box-content">
						<?php include __DIR__ . '/component/themepreview.php'; ?>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
