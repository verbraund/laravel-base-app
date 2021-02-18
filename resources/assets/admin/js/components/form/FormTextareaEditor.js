import React from 'react';
import Ckeditor from './Ckeditor';

export default function FormTextareaEditor({reference, title, description, rows}){

    return (
        <div className="form-group">
            <label>{ title }</label>

            <Ckeditor data={'test 123'} />

            {description && <small className="form-text text-muted">{description}</small>}
        </div>
    );
}