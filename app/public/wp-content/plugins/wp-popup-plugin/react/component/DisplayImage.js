import React, { useEffect, useState } from "react";

const DisplayImage = () => {
	const [imageUrl, setImageUrl] = useState(null);
	let data = sessionStorage.getItem("image")
	// useEffect(() => {
	// 	fetch("http://popup.local/wp-json/custom/v1/get-image")
	// 		.then(response => response.json())
	// 		.then(data => {
	// 			if (data.url) {
	// 				setImageUrl(data.url);
	// 			} else {
	// 				console.error("No image found:", data.error);
	// 			}
	// 		})
	// 		.catch(error => console.error("Fetch error:", error));
	// }, []);
	useEffect(() => {
		if(data){
			setImageUrl(data)
		}
	}, [data]);

	return (
		<div>
			<h3>Uploaded Image</h3>
			{imageUrl ? (
				<img src={imageUrl} alt="Uploaded" style={{ maxWidth: "300px" }} />
			) : (
				<p>No image uploaded</p>
			)}
		</div>
	);
};

export default DisplayImage;
