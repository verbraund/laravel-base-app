import React from 'react';

export default function FormCheckbox({title, description}){

    const checkboxId = 'FormCheckbox-' + Math.random().toString(36).substr(2);
    const helperId = 'FormCheckboxHelper-' + Math.random().toString(36).substr(2);

    return (
        <div className="form-group form-check">
            <input type="checkbox" className="form-check-input" id={checkboxId} />
            <label className="form-check-label" htmlFor={checkboxId}>{title}</label>
            {description && <small id={helperId} className="form-text text-muted">{description}</small>}
        </div>
    );
}