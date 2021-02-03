import React from 'react';
import ReactDOM from 'react-dom';
import './vendor/bootstrap';
import Application from './application';



//require('./vendor/bootstrap');

if (document.getElementById('app')) {
    ReactDOM.render(<Application />, document.getElementById('app'));
}
