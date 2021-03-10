import React from 'react';
import {AlertContext} from "../contexts/AlertContext";
import ReactNotification from "react-notifications-component";
import { store } from 'react-notifications-component';

export default function AlertProvider({children}){

    const notification = (title, message, type) => {
        store.addNotification({
            title: title,
            message: message,
            type: type,
            insert: "top",
            container: "bottom-right",
            animationIn: ["animate__animated", "animate__fadeIn"],
            animationOut: ["animate__animated", "animate__fadeOut"],
            dismiss: {
                duration: 5000,
                onScreen: false
            }
        });
    };
    const error = (title, message) => {
        notification(title, message, 'danger');
    };
    const success = (title, message) => {
        notification(title, message, 'success');
    };



    return (
        <AlertContext.Provider value={{error,success}}>
            <ReactNotification />
            {children}
        </AlertContext.Provider>
    );

}
