import React, {forwardRef, useRef} from 'react';
import FormDateTimePicker from "./FormDateTimePicker";

export default function FormDateTimePickerDefault({reference}){

    const input = useRef(null);
    const FormDateTimeCustomInput = forwardRef(({ onClick, value }, ref) => (
        <input
            onClick={onClick}
            value={value}
            onChange={onClick}
            ref={ref}
            type="text"
            className="form-control"
        />
    ));

    return (
        <FormDateTimePicker reference={reference} customInput={<FormDateTimeCustomInput ref={input} />} />
    );
}
