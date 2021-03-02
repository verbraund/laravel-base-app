import React, {useRef, useState} from 'react';
import {generateInputAndHelperIds} from "../../utils/form";

export default function FormCheckboxDateFromTo({checkboxRef, fromRef, title, description}){

    const [checkboxId, helperId] = generateInputAndHelperIds('FormCheckboxDateFromTo');

    const [checked, setChecked] = useState(false);

    const from = useRef(fromRef.current);

    return (
        <div className="form-group form-check">
            <input
                // ref={checked}
                onChange={e => {
                    checkboxRef.current = e.target.checked;
                }}
                type="checkbox"
                className="form-check-input"
                id={checkboxId}
            />
            <label className="form-check-label" htmlFor={checkboxId}>{title}</label>
            {checked &&
                <input type="text" />
            }
            {description && <small id={helperId} className="form-text text-muted">{description}</small>}
        </div>
    );
}
