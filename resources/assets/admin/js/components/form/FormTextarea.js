import React from 'react';
import {generateInputAndHelperIds} from "../../utils/form";

export default function FormTextarea({reference, title, description, rows}){

    const [textareaId, helperId] = generateInputAndHelperIds('FormTextarea');

    return (
        <div className="form-group">
            <label htmlFor={ textareaId }>{ title }</label>
            <textarea ref={reference} className="form-control" id={textareaId} rows={rows ? rows : 3} />
            {description && <small id={helperId} className="form-text text-muted">{description}</small>}
        </div>
    );
}
