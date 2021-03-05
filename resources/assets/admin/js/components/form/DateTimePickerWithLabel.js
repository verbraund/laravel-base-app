import React, {forwardRef, useRef} from 'react';
import DateTimePicker from "./DateTimePicker";

export default function DateTimePickerWithLabel({reference, label}){

    const input = useRef(null);

    const DateTimeCustomInput = forwardRef(({ onClick, value }, ref) => (
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
        <DateTimePicker reference={reference} customInput={<DateTimeCustomInput ref={input} />} />
    );
}
