import Popup from "../Popup";
import React, { useState, useEffect } from "react";
import Template1 from "../template/Template1";
import Template2 from "../template/Template2";

const WP_API_URL = "http://popup.local/wp-json/custom/v1/get-popup";

const Client = () => {
	const [isOpen, setIsOpen] = useState(true);
	const [theme, setTheme] = useState();
	const [group1, setGroup1] = useState({});
	const [group2, setGroup2] = useState({});
	const [group3, setGroup3] = useState({});
	const [group4, setGroup4] = useState({});
	const [data, setData] = useState({});
	const [button, setButton] = useState({});
	const [bgImage, setBgImage] = useState({});
	useEffect(() => {
		fetch(`${WP_API_URL}?page_id=${window.wpConfig.pageId}`)
			.then((res) => res.json())
			.then(data => {
				if (data) {
					if (data.template) {
						setTheme(data.template)
					}
					if(data.theme_style){
						const themeStyle = JSON.parse(data.theme_style);
						setGroup1(themeStyle.group1)
						setGroup2(themeStyle.group2)
						setGroup3(themeStyle.group3)
						setGroup4(themeStyle.group4)
					}
					if (data.button == 1) {
						setButton({
							button: data.button,
							style: data.button_style,
							content: data.popup_button
						});
					}
					if (data.background_img){
						setBgImage(data.background_img)
					}
					setData({
						title: data.popup_tittle,
						content: data.popup_content
					});

				} else {
					console.error("Data tidak ditemukan atau format salah.");
				}
			})
			.catch((error) => console.error("Error fetching data:", error));
	}, []);
	return (
		<div>
			{(() => {
				switch (theme) {
					case 'theme1':
						return (
							<Template1
								bgImage={bgImage}
								button={button}
								data={data}
								group1={group1}
								group2={group2}
								group3={group3}
								group4={group4}
								client={true}
								isOpen={isOpen}
								setIsOpen={setIsOpen}
							/>
						);
					case 'theme2':
						return (
							<Template2
								bgImage={bgImage}
								button={button}
								data={data}
								group1={group1}
								group2={group2}
								group3={group3}
								group4={group4}
								client={true}
								isOpen={isOpen}
								setIsOpen={setIsOpen}
							/>
						);
					default:
						return null;
				}
			})()}
		</div>

	);
};

export default Client;
