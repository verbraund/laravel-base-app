import React, {useEffect, useState} from 'react';
import DatePicker from "react-datepicker";
import ru from 'date-fns/locale/ru';
import {formatISO9075, parse} from "date-fns";


export default function FormDateTimePicker ({reference, customInput}){

    const [date,setDate] = useState('');

    useEffect(() => {
        if(reference.current){
            let pd = parse(reference.current, 'yyyy-MM-dd HH:mm:ss', new Date());
            if(pd instanceof Date){
                if(date === ''){
                    return setDate(pd);
                }
            }
        }

    },[reference.current])

    useEffect(() => {
        reference.current = (date instanceof Date) ? formatISO9075(date) : date;
    },[date])

    return (
        <DatePicker
            selected={date}
            onChange={date => setDate(date)}
            customInput={customInput}
            showTimeSelect
            isClearable
            locale={ru}
            wrapperClassName="w-100 custom-date-picker"
            timeFormat="HH:mm"
            className="form-control"
            timeIntervals={1}
            timeCaption="time"
            dateFormat="dd.MM.yyyy HH:mm"
        />
    );

}
