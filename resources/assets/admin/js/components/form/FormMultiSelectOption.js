import React from 'react';

export default function FormMultiSelectOption({title, value}){

    return (
        <div className="multi-select-option">
            {title}
            <i className="fas fa-times" />
        </div>
    );
}
