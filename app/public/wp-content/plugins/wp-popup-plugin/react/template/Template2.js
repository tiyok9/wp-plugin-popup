import React, {  useState } from "react";
import "../../assets/css/index.scss";

const Template2 = ({ title='', children,bgImage=" " ,group1,group2,group3,group4
					   ,client = false,isOpen = false,button= {},data={},setIsOpen = () => {}}) => {


	return !client ? <div className="popup-overlay-admin" >
		<div className="popup-content-admin" onClick={(e) => e.stopPropagation()}
			 >
			<button className="popup-close-admin" onClick={() => setIsOpen(false)}>
				&times;
			</button>
			<div className="row">
				<img src={bgImage} className="image-popup" alt='background'/>

				<div>

					<h2 className="popup-title-admin" style={group2}>{title}</h2>

				</div>
			</div>
		</div>
	</div> : isOpen ? (
		<div className="popup-overlay" onClick={() => setIsOpen(false)}>
			<div className="popup-content" style={{...group3, backgroundImage: `url(${bgImage})`}}
				 onClick={(e) => e.stopPropagation()}>
				<button className="popup-close" onClick={() => setIsOpen(false)}>
					&times;
				</button>
				<div className="row">
					<img src={bgImage} className="image-popup" alt='background'/>
					<div>
						<h2 className="popup-title-admin" style={group2}>{data.title}</h2>
						<div className="popup-body">
							<p style={group4}>{data.content}</p>
							{button.button &&
								<button className="button" style={{...button.style}}>{button.content}</button>}
						</div>
					</div>
				</div>


			</div>
		</div>
	) : null;
};

export default Template2;

