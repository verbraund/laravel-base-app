import React, {useEffect, useRef} from 'react';
import {useParams, useHistory} from 'react-router-dom';
import axios from "axios";

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


                    <div className="form-group">
                        <label htmlFor="FormTitleInput">Наименование</label>
                        <input ref={title} type="text" className="form-control" id="FormTitleInput" aria-describedby="FormTitleInputHelp" />
                        <small id="FormTitleInputHelp" className="form-text text-muted">meta:title</small>
                    </div>
                    <div className="form-group">
                        <label htmlFor="FormSlugInput">ЧПУ (URI)</label>
                        <input ref={slug} type="text" className="form-control" id="FormSlugInput" aria-describedby="FormSlugInputHelp" />
                        <small id="FormSlugInputHelp" className="form-text text-muted">Заполниться автоматически</small>
                    </div>
                    <div className="form-group">
                        <label htmlFor="FormDescriptionTextarea">Краткое описание</label>
                        <textarea ref={description} className="form-control" id="FormDescriptionTextarea" rows="3" />
                        <small id="FormDescriptionTextareaHelp" className="form-text text-muted">meta:description</small>
                    </div>
                    <div className="form-group">
                        <label htmlFor="FormTextTextarea">Основной текст</label>
                        <textarea ref={text} className="form-control" id="FormTextTextarea" rows="10" />
                    </div>


                    <div className="form-group form-check">
                        <input type="checkbox" className="form-check-input" id="FormPublishCheckbox" />
                        <label className="form-check-label" htmlFor="FormPublishCheckbox">Опубликовать</label>
                    </div>

                </div>
                <div className="card-body">
                    <a className="btn btn-primary" onClick={save}>Сохранить</a>
                </div>
            </div>

        </div>
    );
}
