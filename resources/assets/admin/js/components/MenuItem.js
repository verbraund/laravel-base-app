import React from 'react';
import {Link} from "react-router-dom";

export default function MenuItem({item}){
    return (
        <li className="nav-item">
            <Link className="nav-link" to={item.to} >{item.name}</Link>
        </li>
    );
}
