import React, {useEffect, useRef, useState} from 'react';
import {generateInputAndHelperIds} from "../../utils/form";

export default function FormCheckboxDateFromTo({checkboxRef, fromRef, toRef, title, description}){

    const [checkboxId, helperId] = generateInputAndHelperIds('FormCheckboxDateFromTo');

    //const checkbox = useRef({checked:checkboxRef.current});

    //const from = useRef(fromRef.current);

    // useEffect(() => {
    //     checkbox.current.checked = checkboxRef.current;
    //     //setChecked(checkboxRef.current);
    // },[checkboxRef.current]);


    // console.log('checkboxRef',checkboxRef.current);
    // console.log('checkbox',checkbox.current.checked);

    useEffect(() => {
        setChecked(checkboxRef.current);
    },[checkboxRef.current]);


    const [checked, setChecked] = useState(false);

    return (
        <div className="form-row">
            <div className="form-group col-md-2">
                <div className="custom-control custom-switch mt-2">
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
            {checked &&
                <div className="form-group col-md-5">
                    <div className="row justify-content-center">
                        <div className="col-md-6 input-group">
                            <div className="input-group-prepend">
                                <div className="input-group-text">С</div>
                            </div>
                            <input ref={fromRef} type="text" className="form-control" />
                        </div>
                    </div>
                </div>
            }
            {checked &&
                <div className="form-group col-md-5">
                    <div className="row justify-content-center">
                        <div className="col-md-6 input-group">
                            <div className="input-group-prepend">
                                <div className="input-group-text">По</div>
                            </div>
                            <input ref={toRef} type="text" className="form-control" />
                        </div>
                    </div>
                </div>
            }
        </div>

    );
}
