import React from 'react';

export default function FormMultiSelect({title, description}){

    const multiSelectId = 'FormMultiSelect-' + Math.random().toString(36).substr(2);
    const helperId = 'FormMultiSelectHelper-' + Math.random().toString(36).substr(2);

    return (
        <div className="form-group">
            <label htmlFor={multiSelectId}>{ title }</label>

            <div className="multi-select" id={multiSelectId}>
                <div className="multi-select-option">Test</div>
                <div className="multi-select-option">Test 123</div>
            </div>

            {description && <small id={helperId} className="form-text text-muted">{description}</small>}
        </div>
    );
}