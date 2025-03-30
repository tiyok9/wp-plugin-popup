import React, {  useState } from "react";
import "../assets/css/index.scss";

const Popup = ({ title, children,bgImage=" "  }) => {
    const [isOpen, setIsOpen] = useState(true);

    return isOpen ? (
        <div className="popup-overlay" onClick={() => setIsOpen(false)}>
            <div className="popup-content" onClick={(e) => e.stopPropagation()} style={{ backgroundImage: `url(${bgImage})` }}>
                <button className="popup-close" onClick={() => setIsOpen(false)}>
                    &times;
                </button>
                <h2 className="popup-title">{title}</h2>
                <div className="popup-body">{children}</div>
            </div>
        </div>
    ) : null;

};

export default Popup;
