import React from 'react';

export default function FormMultiSelectHelperOption({title, value, add}){

    const handle = (e) => {
        e.stopPropagation();
        add(value, title);
    };


    return (
        <div className="helper-option" onClick={handle}>
            {title}
            <i className="fas fa-plus" />
        </div>
    );
}
