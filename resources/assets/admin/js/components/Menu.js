import React from 'react';
import MenuItem from "./MenuItem";
import MenuItemDropDown from "./MenuItemDropDown";

export default function Menu({menu,style}){


    return (
        <ul className={style.classes.ul}>
            {menu.map((item, index) => {
                return (item.children && item.children.length > 0) ?
                    <MenuItemDropDown key={index} item={item}/> :
                    <MenuItem key={index} item={item}/>
            })}
        </ul>
    );
}
