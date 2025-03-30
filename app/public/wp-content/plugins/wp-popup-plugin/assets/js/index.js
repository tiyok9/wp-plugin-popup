jQuery(document).ready(function ($) {
	var largeColumn = $("#large-column");
	var smallColumn = $("#small-column");

	function updateSidebar() {
		var sidebarList = $("#sidebar-list");
		sidebarList.empty();

		$(".dashboard-box").each(function () {
			var title = $(this).find(".box-header h2").text();
			sidebarList.append("<li>" + title + "</li>");
		});
	}

	function checkScreenSize() {
		if ($(window).width() <= 768) {
			$(".dashboard-column").sortable("disable");
		} else {
			$(".dashboard-column").sortable("enable");
		}
	}

	$(".dashboard-column").sortable({
		connectWith: ".dashboard-column",
		placeholder: "sortable-placeholder", // Tambah placeholder
		start: function (event, ui) {
			// Tambah efek garis saat mulai drag
			$(".dashboard-column").addClass("drag-active");
		},
		stop: function (event, ui) {
			// Hapus efek garis setelah selesai drag
			$(".dashboard-column").removeClass("drag-active");
		},
		update: function () {
			var orderLarge = largeColumn.sortable("toArray");
			var orderSmall = smallColumn.sortable("toArray");

			localStorage.setItem("dashboard_large_order", JSON.stringify(orderLarge));
			localStorage.setItem("dashboard_small_order", JSON.stringify(orderSmall));
		}
	});

	checkScreenSize();
	$(window).resize(checkScreenSize);
	updateSidebar();
});

document.querySelectorAll(".range-group").forEach(group => {
	const rangeInput = group.querySelector(".range-input");
	const numberInput = group.querySelector(".number-input");

	// Sinkronisasi nilai dari slider ke input number
	rangeInput.addEventListener("input", function () {
	numberInput.value = rangeInput.value;
});

	// Sinkronisasi nilai dari input number ke slider
	numberInput.addEventListener("input", function () {
	let value = parseInt(numberInput.value, 10) || 0;

	// Pastikan nilai tetap dalam batas
	if (value > 100) value = 100;
	if (value < 0) value = 0;

	numberInput.value = value;
	rangeInput.value = value;
});
});

function showContent(type) {
	// Sembunyikan semua konten
	var sections = document.getElementsByClassName('content-section');
	for (var i = 0; i < sections.length; i++) {
	sections[i].style.display = 'none';
}
	// Tampilkan konten yang dipilih
	var selectedSection = document.getElementById(type);
	if (selectedSection) {
	selectedSection.style.display = 'block';
	}
}

	// Tampilkan konten 'overall' saat halaman pertama kali dimuat
document.addEventListener('DOMContentLoaded', function() {
	showContent('overall');
	// const radioButtons = document.querySelectorAll('input[name="imageOption"]');
	//
	// radioButtons.forEach(radio => {
	// 	radio.addEventListener("change", function () {
	// 		sessionStorage.setItem("theme", this.value);
	// 	});
	// });
});
