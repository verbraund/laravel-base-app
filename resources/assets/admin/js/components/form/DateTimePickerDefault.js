import React, {forwardRef, useRef} from 'react';
import DateTimePicker from "./DateTimePicker";

export default function DateTimePickerDefault({reference}){

    const input = useRef(null);
    const DateTimeCustomInput = forwardRef(({ onClick, value }, ref) => (
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
        <DateTimePicker reference={reference} customInput={<DateTimeCustomInput ref={input} />} />
    );
}
