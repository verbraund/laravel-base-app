import React from 'react';
import MultiSelectHelperOption from "./MultiSelectHelperOption";
import MultiSelectHelperOptionSelected from "./MultiSelectHelperOptionSelected";

export default function MultiSelectHelper({options, selected, remove, add, positionYTypeClass}){


    return (
        <div className={"multi-select-helper " + positionYTypeClass.current}>
            {options.map((e,i) => {
                if(selected.filter(s => s.value === e.value).length > 0){
                    return <MultiSelectHelperOptionSelected value={e.value} title={e.title} remove={remove} key={i}/>
                }else{
                    return <MultiSelectHelperOption value={e.value} title={e.title} add={add} key={i}/>
                }
            })}
        </div>
    );
}
