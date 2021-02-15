import React from 'react';

export default function FormTextarea({reference, title, description, rows}){

    const textareaId = 'FormTextarea-' + Math.random().toString(36).substr(2);
    const helperId = 'FormTextareaHelper-' + Math.random().toString(36).substr(2);

    return (
        <div className="form-group">
            <label htmlFor={ textareaId }>{ title }</label>
            <textarea ref={reference} className="form-control" id={textareaId} rows={rows ? rows : 3} />
            {description && <small id={helperId} className="form-text text-muted">{description}</small>}
        </div>
    );
}