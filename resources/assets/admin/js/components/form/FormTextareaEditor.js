import React from 'react';

import { CKEditor } from '@ckeditor/ckeditor5-react';

import Editor from '../../vendor/ckeditor';


export default function FormTextareaEditor({reference, title, description, rows}){

    const editorConfiguration = {
        toolbar: {
            items: [
                'heading', 'fontSize', 'fontFamily', '|', 'bold', 'italic',
                'bulletedList', 'numberedList', '|', 'indent', 'outdent',
                'alignment', 'insertTable', '|', 'fontColor', 'fontBackgroundColor', '|',
                'link', 'imageUpload', '|', 'undo', 'redo', '|', 'code'
            ]
        },
        image: {
            toolbar: [
                'imageTextAlternative',
                'imageStyle:full',
                'imageStyle:side'
            ]
        },
        table: {
            contentToolbar: [
                'tableColumn',
                'tableRow',
                'mergeTableCells',
                'tableCellProperties',
                'tableProperties'
            ]
        },
        language: 'ru'
    };

    const setCustomSettings = (editor) => {
        editor.editing.view.change( writer => {
            writer.setStyle( 'height', '500px', editor.editing.view.document.getRoot() );
        });
    };


    return (
        <div className="form-group">
            <label>{ title }</label>

            <CKEditor
                editor={ Editor }
                config={ editorConfiguration }
                data={"<p>Hello from CKEditor 5!</p>"}
                onReady={ editor => setCustomSettings(editor) }
            />

            {description && <small className="form-text text-muted">{description}</small>}
        </div>
    );
}