import React, {forwardRef, useRef} from 'react';
import FormDateTimePicker from "./FormDateTimePicker";

export default function FormDateTimePickerWithLabel({reference, label}){

    const input = useRef(null);

    const FormDateTimeCustomInput = forwardRef(({ onClick, value }, ref) => (
        <div className="input-group">
            <div className="input-group-prepend">
                <div className="input-group-text">{label}</div>
            </div>
            <input
                onClick={onClick}
                value={value}
                onChange={onClick}
                ref={ref}
                type="text"
                className="form-control"
            />
        </div>
    ));

    return (
        <FormDateTimePicker reference={reference} customInput={<FormDateTimeCustomInput ref={input} />} />
    );
}
