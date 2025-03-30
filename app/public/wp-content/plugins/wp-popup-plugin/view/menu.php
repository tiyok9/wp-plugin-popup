<?php
if (isset($_GET['message']) && $_GET['message'] === 'success'):
	echo '<div class="updated notice is-dismissible"><p>Popup berhasil disimpan!</p></div> ';
elseif (isset($_GET['message']) && $_GET['message'] === 'error'):
	echo '<div class="error notice is-dismissible"><p>Terjadi kesalahan saat menyimpan popup!</p></div>';
endif;
$popup_table = new \view\component\TableMenu();
$nav = new \view\component\DisplayNavTab();

$popup_table->prepare_items();
?>
<form method="post">
<div class="wrap">
<h1 class="wp-heading-inline">Popup List</h1>
<?php
$nav->display_nav_tabs();?>

<hr class="wp-header-end">
<?php
$popup_table->search_box('Search Popup', 'popup_search');

$popup_table->display();
?>
</div>
</form>
