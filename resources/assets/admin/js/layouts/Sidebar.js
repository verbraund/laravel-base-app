import React from 'react';
import SidebarMenu from "../components/Menu";

export default function Sidebar() {

    const menu = [
        {name:'home',to:'/admin', children:[]},
        {name:'news',to:'/admin/news', children:[]},
        {name:'about',children:[
                {name:'test 1',to:'#', children:[]},
                {name:'test 2',to:'#', children:[]}
            ]},
    ];

    const style = {
        classes: {
            ul:'list-unstyled menu'
        }
    };

    return (
        <nav className="sidebar">
            <div className="sidebar-header">
                <h3>Admin</h3>
            </div>
            <SidebarMenu menu={menu} style={style} />
        </nav>
    );
}
