import React, {useRef} from 'react';
import {useHistory} from 'react-router-dom';
import axios from "axios";
import FormInputText from "../../../components/form/FormInputText";
import FormTextarea from "../../../components/form/FormTextarea";
import FormCheckbox from "../../../components/form/FormCheckbox";

export default function NewsCreate(){

    let history = useHistory();


    const title = useRef('');
    const slug = useRef('');
    const description = useRef('');
    const text = useRef('');


    const create = () => {
        axios.post(
            '/api/admin/news' ,
            {
                title: title.current.value,
                slug: slug.current.value,
                description: description.current.value,
                text: text.current.value,
            }
        ).then(response => {
            if(typeof response.data.data === 'object' && response.data.data !== null){
                history.push('/admin/news/' + response.data.data.id + '/edit');
            }

        }).catch(_ => {
            //console.log(response);
            console.error('catch error');
            //history.push('/admin/404');
        });
    };

    return (
        <div>
            <div className="card">
                <h5 className="card-header">Создание Новости</h5>
                <div className="card-body">

                    <FormInputText reference={title} title={'Наименование'} description={'meta:title'} />

                    <FormInputText reference={slug} title={'ЧПУ (URI)'} description={'Заполниться автоматически'} />

                    <FormTextarea reference={description} title={'Краткое описание'} description={'meta:description'} />

                    <FormTextarea reference={text} title={'Основной текст'} rows={10} />

                    <FormCheckbox title={'Опубликовать'} />


                </div>
                <div className="card-body">
                    <a className="btn btn-primary" onClick={create}>Создать</a>
                </div>
            </div>

        </div>
    );
}
