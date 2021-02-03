import React from 'react';
import {AlertContext} from "../contexts/AlertContext";

export default function AlertProvider({children}){

    return (
        <AlertContext.Provider value={{}}>
            {children}
        </AlertContext.Provider>
    );

}