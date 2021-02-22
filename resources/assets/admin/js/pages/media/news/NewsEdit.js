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
    const [currentCategories, setCurrentCategories] = useState([]);


    useEffect(() => {

        axios.get('/api/admin/news/' + id + '/edit',).then(function (response) {
            if(typeof response.data.data === 'object' && response.data.data !== null){
                title.current.value = response.data.data.title;
                slug.current.value = response.data.data.slug;
                description.current.value = response.data.data.description;
<<<<<<< HEAD
                text.current.value = response.data.data.text;
                setCurrentCategories(response.data.data.categories.map(item => {
=======
                text.current = response.data.data.text;
                setCategories(response.data.data.categories.map(item => {
>>>>>>> f2a540c26dd249b99a4405ea089b1fb91f411b06
                    return {value: item.id, title: item.title};
                }));
            }

        }).catch(r => {
            console.log(r);
            //history.push('/admin/404');
        });


        axios.get('/api/admin/news/categories').then(function (response) {
            if(typeof response.data.data === 'object' && response.data.data !== null){
                setCategories(response.data.data.map(item => {
                    return {value: item.id, title: item.title};
                }));
            }
        }).catch(e => {
            console.error(e);
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



                    <FormMultiSelect title={'Категории'} items={categories} selected={currentCategories}/>

                    <FormCheckbox title={'Опубликовать'} />
                    <FormCheckbox title={'Опубликовать'} />
                    <FormCheckbox title={'Опубликовать'} />
                    <FormCheckbox title={'Опубликовать'} />
                    <FormCheckbox title={'Опубликовать'} />
                    <FormCheckbox title={'Опубликовать'} />
                    <FormCheckbox title={'Опубликовать'} />
                    <FormCheckbox title={'Опубликовать'} />
                    <FormCheckbox title={'Опубликовать'} />
                    <FormCheckbox title={'Опубликовать'} />
                </div>
                <div className="card-body">
                    <a className="btn btn-primary" onClick={save}>Сохранить</a>
                </div>
            </div>

        </div>
    );
}
