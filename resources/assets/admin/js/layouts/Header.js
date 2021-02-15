import React from 'react';
import HeaderMenu from "../components/layout/Menu";
import HeaderUserInfo from "../components/layout/HeaderUserInfo";

export default function Header() {

    let menu = [
        {name: 'Главная', to:'/admin'},
        {name: 'новости', to:'/admin/news'}
    ];

    const style = {
        classes: {
            ul:'navbar-nav'
        }
    };

    return (
        <div className="header">
            <nav className="navbar navbar-expand-sm navbar-light bg-light">
                <HeaderMenu menu={menu} style={style} />
                <HeaderUserInfo/>
            </nav>
        </div>
    );
}
