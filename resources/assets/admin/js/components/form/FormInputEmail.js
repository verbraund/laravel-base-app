import React from 'react';
import {generateInputAndHelperIds} from "../../utils/form";

export default function FormInputEmail({reference, title, description}){

    const [inputId, helperId] = generateInputAndHelperIds('FormInputEmail');

    return (
        <div className="form-row">
            <div className="form-group col">
                <label htmlFor={inputId}>{ title }</label>
                <input ref={reference} type="email" className="form-control" id={inputId} aria-describedby={helperId} />
                {description && <small id={helperId} className="form-text text-muted">{description}</small>}
            </div>
        </div>

    );
}
