import React, {useContext} from 'react';
import {Link} from "react-router-dom";
import {AuthContext} from "../../contexts/AuthContext";

export default function HeaderUserInfo() {

    const {auth} = useContext(AuthContext);

    return (
        <ul className="navbar-nav ml-md-auto">
            <li className="nav-item">
                <Link className="nav-link" to="/admin/account" >
                    <i className="fas fa-user mr-2" /> Admin
                </Link>
            </li>
            <li className="nav-item">
                <a onClick={auth.logout} className="nav-link logout">Выйти</a>
            </li>
        </ul>
    );
}
