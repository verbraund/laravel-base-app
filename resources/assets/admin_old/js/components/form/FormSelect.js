import React from 'react';
import {generateInputAndHelperIds} from "../../utils/form";

export default function FormSelect({title, description, options}){

    const [selectId, helperId] = generateInputAndHelperIds('FormSelect');

    return (
        <div className="form-row">
            <div className="form-group col">
                <label htmlFor={selectId}>{ title }</label>
                <select className="custom-select" id={selectId}>
                    {options.map((option, index) => {
                        return <option value={option.value} key={index}>{option.name}</option>;
                    })}
                </select>
                {description && <small id={helperId} className="form-text text-muted">{description}</small>}
            </div>
        </div>
    );
}
