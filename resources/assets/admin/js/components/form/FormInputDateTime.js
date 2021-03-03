import React, {useState} from 'react';
import {generateInputAndHelperIds} from "../../utils/form";
import DatePicker from "react-datepicker";
import ru from 'date-fns/locale/ru';

export default function FormInputDateTime({reference, title, description}){

    const [inputId, helperId] = generateInputAndHelperIds('FormInputDateTime');
    const [startDate,setStartDate] = useState(new Date)


    return (
        <div className="form-row">
            <div className="form-group col">
                <label htmlFor={inputId}>{ title }</label>

                <div>
                    <DatePicker
                        wrapperClassName="w-100"
                        selected={startDate}
                        onChange={date => setStartDate(date)}
                        showTimeSelect
                        locale={ru}
                        id={inputId}
                        timeFormat="HH:mm"
                        className="form-control"
                        aria-describedby={helperId}
                        timeIntervals={1}
                        timeCaption="time"
                        dateFormat="dd.mm.yyyy HH:mm"
                    />
                </div>
                {description && <small id={helperId} className="form-text text-muted">{description}</small>}
            </div>
        </div>
    );

}
