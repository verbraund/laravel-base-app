import React, {useEffect, useState} from 'react';
import axios from 'axios';

import {Link} from "react-router-dom";

export default function News (){

    const [news, setNews] = useState([]);
    const [sortable, setSortable] = useState('');
    const [ascending, setAscending] = useState(true);


    const getSortFields = () => {
        return (ascending ? '' : '-') + sortable;
    };

    const setSortableField = fieldName => () => {
        setSortable((!ascending && fieldName  === sortable) ? '' : fieldName);
        setAscending((sortable !== fieldName) ? true : !ascending);
    };


    useEffect(() => {
        axios.get(
            '/api/admin/news',
            {params: {sort: getSortFields()}}
        ).then(function (response) {
            if(Array.isArray(response.data.data))
                setNews(response.data.data);
        })
    }, [sortable, ascending]);


    return (
        <div>
            <div>
                <h3 className="h3">
                    Новости {(new Date()).getMilliseconds()}
                </h3>
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
                                   <Link className="nav-link" to={'news/' + item.slug} >
                                       <i className="fas fa-edit" />
                                   </Link>
                               </td>
                           </tr>
                       })}
                   </tbody>
               </table>
           </div>
        </div>
    );
}
