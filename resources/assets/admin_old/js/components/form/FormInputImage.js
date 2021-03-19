import React, {useEffect, useRef, useState} from 'react';
import {generateInputAndHelperIds} from "../../utils/form";
import axios from "axios";

export default function FormInputImage({reference, title, description}){

    const [inputId, helperId] = generateInputAndHelperIds('FormInputImage');
    const [image, setImage] = useState(null);
    const input = useRef(null);


    const changeHandler = (e) => {

        if(e.target.files.length > 0){
            let inputFile = e.target.files[0];
            if(inputFile instanceof File){

                const data = new FormData();
                data.append('data', inputFile);

                axios.post('/api/admin/images', data)
                    .then(function (response) {
                        if(typeof response.data.data === 'object' && response.data.data !== null){
                            setImage(response.data.data);
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
        setImage(null);
    };


    useEffect(() => {
        reference.current = image;
    }, [image]);

    useEffect(() => {
        if(reference.current && image === null){
            setImage(reference.current);
        }
    }, [reference.current]);

    return (
        <div className="form-row">
            <div className="form-group col">
                <div className="form-row">
                    <label>{ title }</label>
                </div>
                {image && <div className="form-row">
                    <div className="form-group">
                        <div className="custom-file-input-image">
                            <div className="form-row justify-content-center">
                                <img className="preview" src={image.url} alt=""/>
                            </div>
                            <div className="form-row justify-content-around mt-3">
                                <div className="form-group">
                                    <a target="_blank" href={image.url} className="reference">
                                        <i className="fas fa-external-link-alt" />
                                    </a>
                                </div>
                                <div className="form-group">
                                    <button type="button" onClick={closeHandler} className="remove">
                                        Удалить <i className="fas fa-times" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>}
                <div className="form-row">
                    <div className="form-group">
                        <label htmlFor={inputId} className="btn btn-primary custom-file-input-label">
                            <i className="fas fa-upload" /> Прикрепить изображение
                        </label>
                        <input  onChange={changeHandler} ref={input} id={inputId}  className="custom-file-input" type="file"/>
                    </div>
                </div>
                {description && <small id={helperId} className="form-text text-muted">{description}</small>}
            </div>
        </div>

    );
}
