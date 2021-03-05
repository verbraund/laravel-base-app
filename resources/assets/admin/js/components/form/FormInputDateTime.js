import React, {useEffect, useRef, useState} from 'react';
import {generateInputAndHelperIds} from "../../utils/form";
import DateTimePickerDefault from "./DateTimePickerDefault";

export default function FormInputDateTime({reference, title, description}){

    const [inputId, helperId] = generateInputAndHelperIds('FormInputDateTime');



    return (
        <div className="form-row">
            <div className="form-group col">
                <label htmlFor={inputId}>{ title }</label>

                <div>
                    <DateTimePickerDefault reference={reference} />
                </div>
                {description && <small id={helperId} className="form-text text-muted">{description}</small>}
            </div>
        </div>
    );

}
