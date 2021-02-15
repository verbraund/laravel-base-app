import React, {useEffect, useRef} from 'react';
import {useParams, useHistory} from 'react-router-dom';
import axios from "axios";
import FormInputText from "../../../components/form/FormInputText";
import FormTextarea from "../../../components/form/FormTextarea";
import FormCheckbox from "../../../components/form/FormCheckbox";
import FormSelect from "../../../components/form/FormSelect";
import FormMultiSelect from "../../../components/form/FormMultiSelect";

export default function NewsEdit(){

    let { id } = useParams();
    let history = useHistory();


    const title = useRef('');
    const slug = useRef('');
    const description = useRef('');
    const text = useRef('');


    useEffect(() => {

        axios.get(
            '/api/admin/news/' + id + '/edit',
            {params: {}}
        ).then(function (response) {
            if(typeof response.data.data === 'object' && response.data.data !== null){
                title.current.value = response.data.data.title;
                slug.current.value = response.data.data.slug;
                description.current.value = response.data.data.description;
                text.current.value = response.data.data.text;
                //setNews(response.data.data);
            }

        }).catch(_ => {
            history.push('/admin/404');
        });
    }, []);


    const save = () => {
        axios.post(
            '/api/admin/news/' + id ,
            {
                    title: title.current.value,
                    slug: slug.current.value,
                    description: description.current.value,
                    text: text.current.value,
                }
        ).then(function (response) {
            if(typeof response.data.data === 'object' && response.data.data !== null){
                title.current.value = response.data.data.title;
                slug.current.value = response.data.data.slug;
                description.current.value = response.data.data.description;
                text.current.value = response.data.data.text;
                //setNews(response.data.data);
            }

        }).catch(_ => {
            console.error('catch error');
            //history.push('/admin/404');
        });
    };

    return (
        <div>
            <div className="card">
                <h5 className="card-header">Редактирование Новости</h5>
                <div className="card-body">


                    <FormInputText reference={title} title={'Наименование'} description={'meta:title'} />

                    <FormInputText reference={slug} title={'ЧПУ (URI)'} description={'Заполниться автоматически'} />

                    <FormTextarea reference={description} title={'Краткое описание'} description={'meta:description'} />

                    <FormTextarea reference={text} title={'Основной текст'} rows={10} />

                    <FormCheckbox title={'Опубликовать'} />

                    <FormSelect title={'Опубликовать'} options={
                        [{name: 'ivan', value: 1}, {name: 'vasya', value: 2},{name: 'petya', value: 3}]
                    } description={'123213'}/>

                    <FormMultiSelect title={'Тест мультиселект'} />

                </div>
                <div className="card-body">
                    <a className="btn btn-primary" onClick={save}>Сохранить</a>
                </div>
            </div>

        </div>
    );
}
