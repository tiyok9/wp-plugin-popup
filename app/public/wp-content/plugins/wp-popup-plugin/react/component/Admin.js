import React, { useState,useEffect} from "react";
import Popup from "../Popup";
import Template1 from "../template/Template1";
import Template2 from "../template/Template2";
import DisplayImage from "./DisplayImage";

const Admin = () => {
	const [group1, setGroup1] = useState({});
	const [group2, setGroup2] = useState({});
	const [group3, setGroup3] = useState({});
	const [group4, setGroup4] = useState({});


	const [imageUrl,setImageUrl] = useState('theme2');
	useEffect(() => {
		// Fungsi untuk mengambil nilai input dari grup tertentu
		const getGroupValues = (groupName) => {
			const inputs = document.querySelectorAll(`[data-group="${groupName}"] input`);
			const values = {};
			inputs.forEach((input) => {
				values[input.name] = input.type === "checkbox" ? input.checked
					: input.type === "range" ? input.value + "%"
						: input.value;
			});
			return values;
		};

		// Set state awal dengan data dari form
		setGroup1(getGroupValues("group1"));
		setGroup2(getGroupValues("group2"));
		setGroup3(getGroupValues("group3"));
		setGroup4(getGroupValues("group4"));

		// Event listener untuk menangkap perubahan input
		const handleInputChange = (event) => {
			const group = event.target.closest(".input-group")?.dataset.group;
			if (!group) return;

			const updateState = (prevState) => {
				// Bersihkan nama key (menghilangkan 'group2[' dan ']')
				const cleanKey = event.target.name.replace(/^.*\[(.*?)\]$/, "$1");

				return {
					...prevState,
					[cleanKey]: event.target.type === "checkbox"
						? event.target.checked
						: event.target.type === "range"
							? event.target.value + "%"
							: event.target.value
				};
			};

			// Perbarui state sesuai grupnya
			if (group === "group1") setGroup1((prevState) => updateState(prevState));
			if (group === "group2") setGroup2((prevState) => updateState(prevState));
			if (group === "group3") setGroup3((prevState) => updateState(prevState));
			if (group === "group4") setGroup4((prevState) => updateState(prevState));
		};

		// Ambil semua input dan tambahkan event listener
		const inputs = document.querySelectorAll(".input-group input");
		inputs.forEach((input) => input.addEventListener("input", handleInputChange));

		// Cleanup: Hapus event listener saat komponen unmount
		return () => {
			inputs.forEach((input) => input.removeEventListener("input", handleInputChange));
		};
	}, []);
	const getSelectedTheme = () => {
		const selected = document.querySelector('input[name="imageOption"]:checked');
		return selected ? selected.value : "theme1"; // Default jika tidak ada yang dipilih
	};

	const [template, setTemplate] = useState(getSelectedTheme());

	useEffect(() => {
		const handleThemeChange = () => {
			setTemplate(getSelectedTheme());
		};

		// Tambahkan event listener ke semua radio button
		document.querySelectorAll('input[name="imageOption"]').forEach((radio) => {
			radio.addEventListener("change", handleThemeChange);
		});

		return () => {
			// Hapus event listener saat komponen tidak digunakan
			document.querySelectorAll('input[name="imageOption"]').forEach((radio) => {
				radio.removeEventListener("change", handleThemeChange);
			});
		};
	}, []);


	return (
		<div>
			{(() => {
				switch (template) {
					case 'theme1':
						return (
							<Template1
								title="BIG PROMO LEBARAN"
								bgImage={imageUrl}
								group1={group1}
								group2={group2}
								group3={group3}
								group4={group4}
							/>
						);
					case 'theme2':
						return (
							<Template2
								title="BIG PROMO LEBARAN"
								bgImage={imageUrl}
								group1={group1}
								group2={group2}
								group3={group3}
								group4={group4}
							/>
						);
					default:
						return null;
				}
			})()}
		</div>

	);
};

export default Admin;
