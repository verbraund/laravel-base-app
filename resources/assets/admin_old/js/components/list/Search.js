import React from 'react';

export default function Search({searching, setSearching}){


    const minLength = 3;

    const delay = 1300;
    let interval = null;


    const handling = (e) => {

        let s = e.currentTarget.value.trim();

        if(s.length < minLength && s !== searching)s = '';

        if(
            (String(Number(s)) === s  && s.length < minLength) ||
            s.length >= minLength ||
            (s.length === 0 && s !== searching)
        ){
            if(interval !== null)clearInterval(interval);
            interval = setTimeout(() => {
                if(s !== searching){
                    setSearching(s)
                }
            }, delay);
        }


    };

    return (
        <div className='search'>
            <input onChange={handling} type="text" />
        </div>
    );
}
