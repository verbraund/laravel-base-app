import React, {useEffect, useState} from 'react';
import FormMultiSelectOptionSelected from "./FormMultiSelectOptionSelected";
import FormMultiSelectHelper from "./FormMultiSelectHelper";


export default function FormMultiSelect({title, description, items, selected}){

    const multiSelectId = 'FormMultiSelect-' + Math.random().toString(36).substr(2);
    const helperId = 'FormMultiSelectHelper-' + Math.random().toString(36).substr(2);


    const [options, setOptions] = useState(items);


    console.log(items);
    console.log(options);


    const showAll = () => {

    };

    return (
        <div className="form-group">
            <label htmlFor={multiSelectId}>{ title }</label>

            <div className="multi-select" id={multiSelectId}>

                {selected.map((o, i) => {
                    return <FormMultiSelectOptionSelected key={i} title={o.title} value={o.value}/>
                })}

                <FormMultiSelectHelper options={options} selected={selected} />

                <div className="choice" onClick={showAll}>
                    <i className="fas fa-angle-down" />
                </div>
            </div>

            {description && <small id={helperId} className="form-text text-muted">{description}</small>}
        </div>
    );
}
