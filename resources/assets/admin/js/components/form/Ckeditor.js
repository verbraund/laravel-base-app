import React from 'react';
import '../../vendor/ckeditor';

export default function Ckeditor({data}){

    const className = 'ck-editor';

    ClassicEditor
        .create( document.querySelector( '.' + className ), {

            toolbar: {
                items: [
                    'heading',
                    'fontSize',
                    'fontFamily',
                    '|',
                    'bold',
                    'italic',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'indent',
                    'outdent',
                    'alignment',
                    'insertTable',
                    '|',
                    'fontColor',
                    'fontBackgroundColor',
                    '|',
                    'link',
                    'imageUpload',
                    '|',
                    'undo',
                    'redo',
                    '|',
                    'code'
                ]
            },
            language: 'ru',
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
            licenseKey: '',

        } )

        .then( editor => {
            editor.setData(data);
            //window.editor = editor;
        } )
        .catch( error => {
            //console.error( error );
        } );


    return (
        <div className={className}>
            {data}
        </div>
    );
}