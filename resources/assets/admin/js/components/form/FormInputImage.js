import React from 'react';
import {generateInputAndHelperIds} from "../../utils/form";

export default function FormInputImage({reference, title, description}){

    const [inputId, helperId] = generateInputAndHelperIds('FormInputImage');

    return (
        <div className="form-row">
            <div className="form-group col">
                <label htmlFor={inputId}>{ title }</label>
                <input ref={reference} type="text" className="form-control" id={inputId} aria-describedby={helperId} />
                {description && <small id={helperId} className="form-text text-muted">{description}</small>}
            </div>
        </div>
    );
}
