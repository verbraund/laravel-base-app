import React from 'react';

export default function FormMultiSelectOptionSelected({title, value}){

    return (
        <div className="multi-select-option-selected">
            {title}
            <i className="fas fa-times" />
        </div>
    );
}
