import React, {forwardRef, useEffect, useRef, useState} from 'react';
import {generateInputAndHelperIds} from "../../utils/form";
import DatePicker from "react-datepicker";
import ru from 'date-fns/locale/ru';
import FormDateTimePickerDefault from "./FormDateTimePickerDefault";
import FormDateTimePickerWithLabel from "./FormDateTimePickerWithLabel";

export default function FormCheckboxDateFromTo({checkboxRef, fromRef, toRef, title, description}){

    const [checkboxId, helperId] = generateInputAndHelperIds('FormCheckboxDateFromTo');

    const [checked, setChecked] = useState(false);

    useEffect(() => {
        checkboxRef.current = checked;
    },[checked]);

    useEffect(() => {
        if(checked !==  checkboxRef.current){
            setChecked(checkboxRef.current);
        }
    },[checkboxRef.current]);




    // return (
    //     <FormDateTimePickerWithLabel reference={fromRef} label={'С'} />
    // );

    return (
        <div className="form-row">
            <div className="form-group col-md-4">
                <div className="custom-control custom-switch mt-2 mb-2">
                    <input
                        //ref={checkbox}
                        onChange={e => {
                            setChecked(e.target.checked);
                            //checkboxRef.current = e.target.checked;
                        }}
                        type="checkbox"
                        className="custom-control-input"
                        id={checkboxId}
                        checked={checked}
                    />
                    <label className="custom-control-label" htmlFor={checkboxId}>{title}</label>
                    {description && <small id={helperId} className="form-text text-muted">{description}</small>}
                </div>
                </div>
            <div className={"form-group col-md-4 " + (checked ? '' : 'd-none')}>
                <div className="row ">
                    <div className="w-75">
                        <FormDateTimePickerWithLabel reference={fromRef} label={'С'} />
                    </div>
                </div>
            </div>
            <div className={"form-group col-md-4 " + (checked ? '' : 'd-none')}>
                <div className="row ">
                    <div className="w-75">
                        <FormDateTimePickerWithLabel reference={toRef} label={'По'} />
                    </div>
                </div>
            </div>
        </div>

    );
}
