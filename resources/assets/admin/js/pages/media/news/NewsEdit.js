import React, {useEffect, useRef, useState} from 'react';
import {useParams, useHistory} from 'react-router-dom';
import axios from "axios";
import FormInputText from "../../../components/form/FormInputText";
import FormTextarea from "../../../components/form/FormTextarea";
import FormCheckbox from "../../../components/form/FormCheckbox";
import FormSelect from "../../../components/form/FormSelect";
import FormMultiSelect from "../../../components/form/FormMultiSelect";
import FormTextareaEditor from "../../../components/form/FormTextareaEditor";

export default function NewsEdit(){

    let { id } = useParams();
    let history = useHistory();

    const title = useRef('');
    const slug = useRef('');
    const description = useRef('');
    const text = useRef('');

    const [categories, setCategories] = useState([]);


    useEffect(() => {

        axios.get(
            '/api/admin/news/' + id + '/edit',
            {params: {}}
        ).then(function (response) {
            if(typeof response.data.data === 'object' && response.data.data !== null){
                title.current.value = response.data.data.title;
                slug.current.value = response.data.data.slug;
                description.current.value = response.data.data.description;
                text.current = response.data.data.text;
                setCategories(response.data.data.categories.map(item => {
                    return {value: item.id, title: item.title};
                }));
                //console.log(categories);
            }

        }).catch(r => {
            console.log(r);
            //history.push('/admin/404');
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

                    <FormTextareaEditor reference={text} title={'Основной текст'} rows={10} />

                    <FormCheckbox title={'Опубликовать'} />

                    <FormMultiSelect title={'Категории'} options={categories} />

                </div>
                <div className="card-body">
                    <a className="btn btn-primary" onClick={save}>Сохранить</a>
                </div>
            </div>

        </div>
    );
}
