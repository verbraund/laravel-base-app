import React, {useEffect, useState} from 'react';
import FormMultiSelectOption from "./FormMultiSelectOption";


export default function FormMultiSelect({title, description, options}){

    const multiSelectId = 'FormMultiSelect-' + Math.random().toString(36).substr(2);
    const helperId = 'FormMultiSelectHelper-' + Math.random().toString(36).substr(2);

    return (
        <div className="form-group">
            <label htmlFor={multiSelectId}>{ title }</label>

            <div className="multi-select" id={multiSelectId}>

                {options.map((o, i) => {
                    return <FormMultiSelectOption key={i} title={o.title} value={o.value}/>
                })}

                <div className="choice">
                    <i className="fas fa-angle-down" />
                </div>
            </div>

            {description && <small id={helperId} className="form-text text-muted">{description}</small>}
        </div>
    );
}
