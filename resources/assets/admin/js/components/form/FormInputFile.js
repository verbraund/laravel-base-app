import React, {useEffect, useRef, useState} from 'react';
import {generateInputAndHelperIds} from "../../utils/form";
import axios from "axios";

export default function FormInputFile({reference, title, description}) {

    const [inputId, helperId] = generateInputAndHelperIds('FormInputFile');
    const [file, setFile] = useState(null);
    const input = useRef(null);

    const changeHandler = (e) => {

        if(e.target.files.length > 0){
            let inputFile = e.target.files[0];
            if(inputFile instanceof File){

                const data = new FormData();
                data.append('data', inputFile);

                axios.post('/api/admin/files', data)
                    .then(function (response) {
                        if(typeof response.data.data === 'object' && response.data.data !== null){
                            setFile(response.data.data);
                        }
                    }).catch(_ => {
                    console.error('catch error');
                    //history.push('/admin/404');
                });
            }
        }
    };

    const closeHandler = e => {
        input.current.value = '';
        setFile(null);
    };

    useEffect(() => {
        if(reference.current && file === null){
            setFile(reference.current);
        }
    }, [reference.current]);

    useEffect(() => {
        reference.current = file;
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
                        <input  onChange={changeHandler} ref={input} id={inputId}  className="custom-file-input" type="file"/>
                    </div>
                    {file && <div className="form-group">
                            <div className="custom-file-input-info">
                                <a target="_blank" href={file.url} className="reference">
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
