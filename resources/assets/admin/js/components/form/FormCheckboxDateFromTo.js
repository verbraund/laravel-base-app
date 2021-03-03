import React, {useEffect, useRef, useState} from 'react';
import {generateInputAndHelperIds} from "../../utils/form";

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
                <div className="row justify-content-start">
                    <div className="col-md-10 input-group">
                        <div className="input-group-prepend">
                            <div className="input-group-text">С</div>
                        </div>
                        <input ref={fromRef} type="text" className="form-control" />
                    </div>
                </div>
            </div>
            <div className={"form-group col-md-4 " + (checked ? '' : 'd-none')}>
                <div className="row justify-content-end">
                    <div className="col-md-10 input-group">
                        <div className="input-group-prepend">
                            <div className="input-group-text">По</div>
                        </div>
                        <input ref={toRef} type="text" className="form-control" />
                    </div>
                </div>
            </div>
        </div>

    );
}
