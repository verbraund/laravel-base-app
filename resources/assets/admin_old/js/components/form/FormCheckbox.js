import React, {useEffect, useRef} from 'react';
import {generateInputAndHelperIds} from "../../utils/form";

export default function FormCheckbox({reference, title, description}){

    const [checkboxId, helperId] = generateInputAndHelperIds('FormCheckbox');
    const checked = useRef({checked:reference.current});

    return (
        <div className="form-row">
            <div className="form-group form-check col">
                <input
                    ref={checked}
                    onChange={e => {
                        reference.current = e.target.checked;
                    }}
                    type="checkbox"
                    className="form-check-input"
                    id={checkboxId}
                />
                <label className="form-check-label" htmlFor={checkboxId}>{title}</label>
                {description && <small id={helperId} className="form-text text-muted">{description}</small>}
            </div>
        </div>
    );
}
