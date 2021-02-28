import React from 'react';
import {generateInputAndHelperIds} from '../../utils/form';

export default function FormInputText({reference, title, description}){

    const [inputId, helperId] = generateInputAndHelperIds('FormInputText');

    return (
        <div className="form-group">
            <label htmlFor={inputId}>{ title }</label>
            <input ref={reference} type="text" className="form-control" id={inputId} aria-describedby={helperId} />
            {description && <small id={helperId} className="form-text text-muted">{description}</small>}
        </div>
    );
}
