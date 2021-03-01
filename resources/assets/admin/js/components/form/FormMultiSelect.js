import React, {useEffect, useState, useRef} from 'react';
import FormMultiSelectOptionSelected from "./FormMultiSelectOptionSelected";
import FormMultiSelectHelper from "./FormMultiSelectHelper";
import {generateInputAndHelperIds} from "../../utils/form";


export default function FormMultiSelect({title, description, options, selected, setSelected}){

    const [multiSelectId, helperId] = generateInputAndHelperIds('FormMultiSelect');

    console.log('render FormMultiSelect');

    const [showHelper, setShowHelper] = useState(false);
    const helperPositionYTypeClass = useRef('bottom');

    const [localSelected, setLocalSelected] = useState([]);


    const removeFromSelected = (value) => {
        setLocalSelected(localSelected.filter(e => e.value !== value));
    };

    const addToSelected = (value, title) => {
        setLocalSelected(localSelected.concat([{value: value, title: title}]));
    };

    const save = () => {
        setShowHelper(false);
        setSelected(localSelected);
    };

    useEffect(() => {
        setLocalSelected(selected);
    }, [selected]);



    const getHelperPositionYType = () => {
        let element = document.getElementById(multiSelectId);
        if(element){
            let multiSelect = element.getBoundingClientRect();
            let positionMultiSelectY = multiSelect.top + pageYOffset;
            let body = document.body,
                html = document.documentElement;
            let height = Math.max( body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight );

            if(height < positionMultiSelectY + 300)return 'top';
        }
        return 'bottom';
    };

    useEffect(() => {
        helperPositionYTypeClass.current = getHelperPositionYType()
    },[]);

    const handleShowAll = () => setShowHelper(!showHelper);

    return (
        <div className="form-group" key={selected}>
            <label htmlFor={multiSelectId}>{ title }</label>

            <div
                className="multi-select"
                id={multiSelectId}
                onClick={handleShowAll}
                onBlur={save}
                tabIndex="0"
            >

                {localSelected.map((o, i) => {
                    return <FormMultiSelectOptionSelected key={i} title={o.title} value={o.value} remove={removeFromSelected}/>
                })}

                {showHelper && <FormMultiSelectHelper
                    options={options}
                    selected={localSelected}
                    remove={removeFromSelected}
                    add={addToSelected}
                    positionYTypeClass={helperPositionYTypeClass}
                />}

                <div className="choice">
                    {showHelper ? <i className="fas fa-angle-up" /> : <i className="fas fa-angle-down" />}
                </div>
            </div>

            {description && <small id={helperId} className="form-text text-muted">{description}</small>}
        </div>
    );
}
