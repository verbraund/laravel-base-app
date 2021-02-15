import React from 'react';

export default function FormInputText({reference, title, description}){

    const inputId = 'FormInputText-' + Math.random().toString(36).substr(2);
    const helperId = 'FormInputTextHelper-' + Math.random().toString(36).substr(2);

    return (
        <div className="form-group">
            <label htmlFor={inputId}>{ title }</label>
            <input ref={reference} type="text" className="form-control" id={inputId} aria-describedby={helperId} />
            {description && <small id={helperId} className="form-text text-muted">{description}</small>}
        </div>
    );
}