import React from 'react';

import { CKEditor } from '@ckeditor/ckeditor5-react';

import Editor from '../../vendor/ckeditor';
import {generateInputAndHelperIds} from "../../utils/form";


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

    const [editorId] = generateInputAndHelperIds('FormTextarea');

    return (
        <div className="form-row">
            <div className="form-group col">
                <label>{ title }</label>

                <CKEditor
                    id={editorId}
                    editor={ Editor }
                    config={ editorConfiguration }
                    data={reference.current}
                    onReady={ editor => setCustomSettings(editor) }
                />

                {description && <small className="form-text text-muted">{description}</small>}
            </div>
        </div>
    );
}
