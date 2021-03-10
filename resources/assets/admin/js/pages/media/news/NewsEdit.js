import React, {useEffect, useRef, useState} from 'react';
import {useParams, useHistory} from 'react-router-dom';
import axios from "axios";
import FormInputText from "../../../components/form/FormInputText";
import FormTextarea from "../../../components/form/FormTextarea";
import FormCheckbox from "../../../components/form/FormCheckbox";
import FormInputDateTime from "../../../components/form/FormInputDateTime";
import FormCheckboxDateFromTo from "../../../components/form/FormCheckboxDateFromTo";
import FormSelect from "../../../components/form/FormSelect";
import FormMultiSelect from "../../../components/form/FormMultiSelect";
import FormTextareaEditor from "../../../components/form/FormTextareaEditor";
import FormInputFile from "../../../components/form/FormInputFile";
import FormInputImage from "../../../components/form/FormInputImage";
import {useForceUpdate} from "../../../utils/other";

export default function NewsEdit(){

    let { id } = useParams();
    let history = useHistory();

    const title = useRef('');
    const slug = useRef('');
    const description = useRef('');
    const text = useRef('');

    const categories = useRef([]);
    const currentCategories = useRef([]);
    const [forceUpdateCategories, categoriesKey] = useForceUpdate();

    const published = useRef(false);
    const publishAt = useRef('');
    const publishTo = useRef('');

    const user = useRef(null);
    const attachment = useRef(null);
    const image = useRef(null);

    useEffect(() => {

        axios.get('/api/admin/news/' + id + '/edit').then(function (response) {
            if(typeof response.data.data === 'object' && response.data.data !== null){
                title.current.value = response.data.data.title;
                slug.current.value = response.data.data.slug;
                description.current.value = response.data.data.description;
                text.current = response.data.data.text;
                currentCategories.current = response.data.data.categories.map(item => {
                    return {value: item.id, title: item.title};
                });

                published.current = Boolean(response.data.data.published);
                publishAt.current = response.data.data.published_at;
                publishTo.current = response.data.data.published_to;

                user.current = response.data.data.user;
                attachment.current = response.data.data.attachment;
                image.current = response.data.data.image;

                forceUpdateCategories();

            }

        }).catch(r => {
            console.log(r);
            //history.push('/admin/404');
        });


        axios.get('/api/admin/news/categories').then(function (response) {
            if(typeof response.data.data === 'object' && response.data.data !== null){
                categories.current = response.data.data.map(item => {
                    return {value: item.id, title: item.title};
                });
                forceUpdateCategories();
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
                text: text.current,
                categories: currentCategories.current.map(c => c.value),
                published: published.current,
                published_at: publishAt.current,
                published_to: publishTo.current,
                image: image.current ? image.current.id : image.current,
                attachment: attachment.current ? attachment.current.id : attachment.current,
            }
        ).then(function (response) {
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
    };

    return (
        <div>
            <div className="card">
                <div className="card-header">
                    <div className="row">
                        <h5 className="col mb-0">Редактирование Новости</h5>
                        {user.current && <div className="col text-right text-black-50">
                            последний редактор: <span className="badge badge-success">{user.current.login}</span>
                        </div>}
                    </div>
                </div>
                <div className="card-body">

                    <FormMultiSelect
                        title={'Категории'}
                        options={categories.current}
                        selected={currentCategories.current}
                        selectedRef={currentCategories}
                        key={categoriesKey}
                    />

                    <FormCheckboxDateFromTo checkboxRef={published} fromRef={publishAt} toRef={publishTo} title={'Опубликовать'} />


                    <FormInputFile reference={attachment} title={'Прикрепляемый файл'} />

                    <FormInputImage reference={image} title={'Превью новости'} />

                    <FormInputText reference={title} title={'Наименование'} description={'meta:title'} />

                    <FormInputText reference={slug} title={'ЧПУ (URI)'} description={'Заполниться автоматически'} />

                    <FormTextarea reference={description} title={'Краткое описание'} description={'meta:description'} />

                    <FormTextareaEditor reference={text} title={'Основной текст'} rows={10} />


                </div>
                <div className="card-body">
                    <a className="btn btn-primary" onClick={save}>Сохранить</a>
                </div>
            </div>

        </div>
    );
}
