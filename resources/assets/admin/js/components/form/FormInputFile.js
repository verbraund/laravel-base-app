import React, {useEffect, useState} from 'react';
import {generateInputAndHelperIds} from "../../utils/form";
import axios from "axios";

export default function FormInputFile({reference, title, description}) {

    const [inputId, helperId] = generateInputAndHelperIds('FormInputFile');
    const [file, setFile] = useState(null);

    const changeHandler = (e) => {
        if(e.target.files.length > 0){
            setFile(e.target.files[0]);
        }
    };

    const closeHandler = (e) => {
        //TODO close
    };

    useEffect(() => {

        if(file instanceof File){
            const data = new FormData();
            data.append('data', file);

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
                <div className="form-row">
                    <label>{ title }</label>
                </div>
                <div className="form-row">
                    <div className="form-group">
                        <label htmlFor={inputId} className="btn btn-primary custom-file-input-label">
                            <i className="fas fa-upload" /> Прикрепить файл
                        </label>
                        <input id={inputId} onChange={changeHandler} className="custom-file-input" type="file"/>
                    </div>
                    {file && <div className="form-group">
                            <div className="custom-file-input-info">
                                <a target="_blank" href="" className="reference">
                                    <i className="fas fa-external-link-alt" />
                                </a>
                                {file.name}
                                <i className="fas fa-times close" onClick={closeHandler} />
                            </div>
                    </div>}
                </div>
                {description && <small id={helperId} className="form-text text-muted">{description}</small>}
            </div>
        </div>

    );

}
