import React, {useEffect, useState} from 'react';
import SidebarMenu from "../components/layout/Menu";
import axios from "axios";

export default function Sidebar() {


    // [
    //     {name:'home',to:'/admin', children:[]},
    //     {name:'news',to:'/admin/news', children:[]},
    //     {name:'about',children:[
    //             {name:'test 1',to:'#', children:[]},
    //             {name:'test 2',to:'#', children:[]}
    //         ]},
    // ]

    const [menu, setMenu] = useState([]);

    const prepare = (items) => {
        return items.map(item => {
            return {
                name: item.name,
                to: item.urn,
                children: item.childes ? prepare(item.childes) : []
            };
        });
    }

    useEffect(() => {
        axios.get('/api/admin/account/menus').then(function (response) {
            if(typeof response.data.data === 'object' && response.data.data !== null){
                console.log(prepare(response.data.data));
                setMenu(prepare(response.data.data));
            }
        }).catch(e => {
            console.error(e);
        });
    },[])

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
