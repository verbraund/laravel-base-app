import React from 'react';

export default function MultiSelectOptionSelected({title, value, remove}){

    const handleRemove = (e) => {
        e.stopPropagation();
        remove(value);
    };

    return (
        <div className="option-selected" onClick={handleRemove}>
            {title}
            <i className="fas fa-times" />
        </div>
    );
}
