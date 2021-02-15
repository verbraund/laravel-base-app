import React, {useEffect, useState} from 'react';
import {useRouteMatch} from 'react-router-dom'
import axios from 'axios';

import {Link} from "react-router-dom";
import Pagination from "../../../components/list/Pagination";
import Search from "../../../components/list/Search";

export default function NewsIndex(){


    let { path, url } = useRouteMatch();
    console.log(path, url);


    const [news, setNews] = useState([]);
    const [sortable, setSortable] = useState('');
    const [ascending, setAscending] = useState(true);


    const firstPage = 1;

    const [page, setPage] = useState(firstPage);
    const [countPage, setCountPage] = useState(firstPage);

    const [searching, setSearching] = useState('');



    const getSortFieldValue = () => {
        return (ascending ? '' : '-') + sortable;
    };

    const setSortableField = fieldName => () => {
        setSortable((!ascending && fieldName  === sortable) ? '' : fieldName);
        setAscending((sortable !== fieldName) ? true : !ascending);
        setPage(firstPage);
    };

    const getSearchingFieldValue = () => {
        return searching;
    };

    const setSearchingFieldValue = v => {
        setSearching(v);
        setPage(firstPage);
    };


    useEffect(() => {

        const params = {};
        if(getSortFieldValue() !== '') params.sort = getSortFieldValue();
        if(getSearchingFieldValue() !== '') params.search = getSearchingFieldValue();
        params.page = page;

        axios.get(
            '/api/admin/news',
            {params: params}
        ).then(function (response) {
            if(Array.isArray(response.data.data)){
                setNews(response.data.data);
                setCountPage(response.data.meta.last_page)
            }

        })
    }, [sortable, ascending, page, searching]);




    return (
        <div>
            <div>
                <h3 className="h3">
                    Новости {(new Date()).getMilliseconds()}
                </h3>
            </div>
            <div>
                <Link className="btn btn-primary" to={ url + '/create' } >
                    <i className="fas fa-edit" /> Создать
                </Link>
            </div>
            <div>
                <Search searching={searching} setSearching={setSearchingFieldValue} />
            </div>
            <div>
                <table className="table grid">
                    <thead>
                    <tr>
                        <th onClick={setSortableField('id')} scope="col" className="sortable">
                            # <i className="fas fa-sort" />
                        </th>
                        <th onClick={setSortableField('title')} scope="col" className="sortable">
                            Наименование <i className="fas fa-sort" />
                        </th>
                        <th scope="col">Автор</th>
                        <th scope="col">Дата создания</th>
                        <th scope="col">Дата модификации</th>
                        <th scope="col" />
                    </tr>
                    </thead>
                    <tbody>
                    {news.map((item, index) => {
                        return <tr key={index}>
                            <th scope="row">{item.id}</th>
                            <td>{item.title}</td>
                            <td>-</td>
                            <td>{item.created_at}</td>
                            <td>{item.updated_at}</td>
                            <td>
                                <Link className="nav-link" to={ url + '/' + item.id + '/edit' } >
                                    <i className="fas fa-edit" />
                                </Link>
                            </td>
                        </tr>
                    })}
                    </tbody>
                </table>
            </div>
            <div>
                {countPage > firstPage &&
                    <Pagination count={countPage} current={page} rangeCount={2} setPage={setPage}/>
                }
            </div>
        </div>
    );
}
