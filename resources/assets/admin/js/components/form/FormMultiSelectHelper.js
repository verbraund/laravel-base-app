import React from 'react';
import FormMultiSelectOption from "./FormMultiSelectOption";

export default function FormMultiSelectHelper({options, selected}){

    return (
        <div className="multi-select-helper">
            {options.map((e,i) => {
                return <FormMultiSelectOption value={e.value} title={e.title} key={i} />
            })}
        </div>
    );
}
