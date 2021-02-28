import React from 'react';
import {generateInputAndHelperIds} from "../../utils/form";

export default function FormInputFile({reference, title, description}) {

    const [inputId, helperId] = generateInputAndHelperIds('FormInputFile');

    return (
        <div className="form-group">
            <label htmlFor={inputId}>{ title }</label>
            <input ref={reference} type="text" className="form-control" id={inputId} aria-describedby={helperId} />
            {description && <small id={helperId} className="form-text text-muted">{description}</small>}
        </div>
    );

}
