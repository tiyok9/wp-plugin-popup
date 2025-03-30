import React, { useState, useEffect } from "react";
import Popup from "./Popup";
import Admin from "./component/Admin";
import Client from "./component/Client";
import ReactDOM from "react-dom/client"; // Pastikan ini adalah 'react-dom/client'

const Index = () => {
	const [isClient, setIsClient] = useState(undefined);

	useEffect(() => {
		if (typeof window !== "undefined" && window.wpConfig) {
			setIsClient(window.wpConfig.isClient);
		}else{
			setIsClient(0)
		}
	}, []);
	return isClient == 1 ?<Client/>  : isClient===0 ? <Admin/>:''
}


const root = ReactDOM.createRoot(document.getElementById("react-root"));
root.render(<Index/>);
