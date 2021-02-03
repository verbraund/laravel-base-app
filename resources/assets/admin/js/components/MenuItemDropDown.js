import React from 'react';
import MenuItem from "./MenuItem";

export default function MenuItemDropDown({item}) {

    const id = 'sub_' + Math.floor(Math.random() * 10000).toString();
    return (
        <li>
            <a
                href="#dropdown" data-toggle="collapse" aria-expanded="false"
                className="dropdown-toggle" data-target={'#' + id}
            >{item.name}</a>
            <ul className="collapse list-unstyled" id={id}>
                {item.children.map((c, i) => {
                    return <MenuItem key={i} item={c}/>
                })}
            </ul>
        </li>
    );
}
