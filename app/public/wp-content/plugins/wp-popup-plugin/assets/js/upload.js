// document.addEventListener("DOMContentLoaded", function () {
// 	document.getElementById("fileInput").addEventListener("change", function () {
// 		const file = this.files[0];
// 		if (!file) return;
//
// 		const formData = new FormData();
// 		formData.append("image", file);
//
// 		fetch(WP_API.base_url + "upload-image", {
// 			method: "POST",
// 			body: formData
// 		})
// 			.then(response => response.json())
// 			.then(data => {
// 				console.log("Upload Success:", data);
// 				localStorage.setItem('uploaded_image', data.image_url); // Simpan ke localStorage
//
// 			})
// 			.catch(error => console.error("Upload Error:", error));
// 	});
// });


jQuery(document).ready(function($) {
	let mediaUploader;

	$("#selectImage").click(function(e) {
		e.preventDefault();

		// Cek apakah Media Uploader sudah dibuat
		if (mediaUploader) {
			mediaUploader.open();
			return;
		}

		// Buat Media Uploader
		mediaUploader = wp.media({
			title: "Pilih Gambar",
			button: { text: "Gunakan Gambar Ini" },
			multiple: false
		});

		// Ketika gambar dipilih
		mediaUploader.on("select", function() {
			let attachment = mediaUploader.state().get("selection").first().toJSON();
			$("#fileInput").val(attachment.url);
			$("#previewImage").attr("src", attachment.url).show(); // Tampilkan preview
			sessionStorage.setItem("image", "");
			sessionStorage.setItem("image", attachment.url);
			// window.location.reload();

		});

		mediaUploader.open();
	});
});
