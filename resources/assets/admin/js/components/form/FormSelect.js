import React from 'react';

export default function FormSelect({title, description, options}){

    const selectId = 'FormSelect-' + Math.random().toString(36).substr(2);
    const helperId = 'FormSelectHelper-' + Math.random().toString(36).substr(2);

    return (
        <div className="form-group">
            <label htmlFor={selectId}>{ title }</label>
            <select className="custom-select" id={selectId}>
                {options.map((option, index) => {
                    return <option value={option.value} key={index}>{option.name}</option>;
                })}
            </select>
            {description && <small id={helperId} className="form-text text-muted">{description}</small>}
        </div>
    );
}