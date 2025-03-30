<?php

namespace view\component;

class DisplayNavTab
{
	public function display_nav_tabs()
	{
		$current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'themes';
		$tabs = [
			'popups' => 'wp-popup-plugin',
			'themes' => 'wp-templates'
		];
		echo '<div class="nav-tab-wrapper container-nav-tab">';
		echo '<div >';
		foreach ($tabs as $tab_key => $tab_name) {
			$active_class = ($current_tab === $tab_key) ? 'nav-tab-active' : '';
			echo '<a href="?page='. esc_attr($tab_name) .'&tab=' . esc_attr($tab_key) . '" class="nav-tab ' . esc_attr($active_class) . '">' . esc_html($tab_key) . '</a>';
		}
		echo '</div>';
		echo '<div>';
		echo '<a href="' . admin_url('admin.php?page=wp-create') . '" class="page-title-action">Add New Popup</a>';
		echo '<a href="' . admin_url('admin.php?page=createtemplate') . '" class="page-title-action">Add New Template Popup</a>';
		echo '</div>';
		echo '</div>';
	}
}
