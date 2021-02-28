import React from 'react';
import {generateInputAndHelperIds} from "../../utils/form";

export default function FormCheckbox({title, description}){

    const [checkboxId, helperId] = generateInputAndHelperIds('FormCheckbox');

    return (
        <div className="form-group form-check">
            <input type="checkbox" className="form-check-input" id={checkboxId} />
            <label className="form-check-label" htmlFor={checkboxId}>{title}</label>
            {description && <small id={helperId} className="form-text text-muted">{description}</small>}
        </div>
    );
}
