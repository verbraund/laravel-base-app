import React from 'react';
import SidebarMenu from "../components/Menu";

export default function Sidebar() {

    const menu = [
        {name:'home',to:'#', children:[]},
        {name:'test',to:'#', children:[]},
        {name:'about',to:'#', children:[]},
        {name:'about 2',children:[
                {name:'test 1',to:'#', children:[]},
                {name:'test 2',to:'#', children:[]}
            ]},
        {name:'about 3',children:[
                {name:'test 4',to:'#', children:[]},
                {name:'test 5',to:'#', children:[]}
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
