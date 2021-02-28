import React from 'react';
import FormMultiSelectHelperOption from "./FormMultiSelectHelperOption";
import FormMultiSelectHelperOptionSelected from "./FormMultiSelectHelperOptionSelected";

export default function FormMultiSelectHelper({options, selected, remove, add, positionYTypeClass}){


    return (
        <div className={"multi-select-helper " + positionYTypeClass.current}>
            {options.map((e,i) => {
                if(selected.filter(s => s.value === e.value).length > 0){
                    return <FormMultiSelectHelperOptionSelected value={e.value} title={e.title} remove={remove} key={i}/>
                }else{
                    return <FormMultiSelectHelperOption value={e.value} title={e.title} add={add} key={i}/>
                }
            })}
        </div>
    );
}
