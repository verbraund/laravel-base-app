import React from 'react';
import {GlobalContext} from "../contexts/GlobalContext";

export default function GlobalProvider({children}){

    return (
        <GlobalContext.Provider value={{}}>
            {children}
        </GlobalContext.Provider>
    );

}