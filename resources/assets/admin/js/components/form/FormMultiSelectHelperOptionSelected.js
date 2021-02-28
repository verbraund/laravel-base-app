import React from 'react';

export default function FormMultiSelectHelperOption({title, value, remove}){

    const handle = (e) => {
        e.stopPropagation();
        remove(value);
    };

    return (
        <div className="helper-option selected" onClick={handle}>
            {title}
            <i className="fas fa-times" />
        </div>
    );
}
