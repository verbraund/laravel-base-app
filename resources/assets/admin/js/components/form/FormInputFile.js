import React, {useEffect, useState} from 'react';
import {generateInputAndHelperIds} from "../../utils/form";
import axios from "axios";

export default function FormInputFile({reference, title, description}) {

    const [inputId, helperId] = generateInputAndHelperIds('FormInputFile');

    const [selectedFile, setSelectedFiles] = useState(false);

    const [file, setFile] = useState(null);

    const changeHandler = (e) => {
        let fileObject = e.target.files[0];


        setFile(fileObject);
    };

    useEffect(() => {

        if(file instanceof File){
            const data = new FormData();
            data.append('data', file);
            data.append('resource_id', 1);

            axios.post('/api/admin/files', data)
                .then(function (response) {
                    // if(typeof response.data.data === 'object' && response.data.data !== null){
                    //     title.current.value = response.data.data.title;
                    //     slug.current.value = response.data.data.slug;
                    //     description.current.value = response.data.data.description;
                    //     text.current = response.data.data.text;
                    //
                    // }

                }).catch(_ => {
                console.error('catch error');
                //history.push('/admin/404');
            });
        }
    }, [file]);



    return (
        <div className="form-row">
            <div className="form-group col">
                <label htmlFor={inputId}>{ title }</label>
                <div className="custom-file">
                    <input onChange={changeHandler} type="file" className="custom-file-input" id={inputId} />
                    <label className="custom-file-label" htmlFor={inputId}>
                        {file ? file.name : 'Выберите файл'}
                    </label>
                </div>
                {description && <small id={helperId} className="form-text text-muted">{description}</small>}
            </div>
        </div>

    );

}
