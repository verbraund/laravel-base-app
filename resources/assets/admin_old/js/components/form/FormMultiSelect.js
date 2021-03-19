import React, {useEffect, useState, useRef} from 'react';
import MultiSelectOptionSelected from "./MultiSelectOptionSelected";
import MultiSelectHelper from "./MultiSelectHelper";
import {generateInputAndHelperIds} from "../../utils/form";


export default function FormMultiSelect({title, description, options, selected, selectedRef}){

    const [multiSelectId, helperId] = generateInputAndHelperIds('FormMultiSelect');

    const [showHelper, setShowHelper] = useState(false);
    const helperPositionYTypeClass = useRef('bottom');

    const [localSelected, setLocalSelected] = useState([]);
    const [localOptions, setLocalOptions] = useState([]);


    const removeFromSelected = (value) => {
        selectedRef.current = localSelected.filter(e => e.value !== value);
        setLocalSelected(localSelected.filter(e => e.value !== value));
    };

    const addToSelected = (value, title) => {
        selectedRef.current = localSelected.concat([{value: value, title: title}]);
        setLocalSelected(localSelected.concat([{value: value, title: title}]));
    };

    useEffect(() => {
        setLocalSelected(selected);
    }, [selected]);

    useEffect(() => {
        setLocalOptions(options);
    }, [options]);



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
        <div className="form-row">
            <div className="form-group col" key={selected}>
                <label htmlFor={multiSelectId}>{ title }</label>

                <div
                    className="multi-select"
                    id={multiSelectId}
                    onClick={handleShowAll}
                    onBlur={() => {setShowHelper(false);}}
                    tabIndex="0"
                >

                    {localSelected.map((o, i) => {
                        return <MultiSelectOptionSelected key={i} title={o.title} value={o.value} remove={removeFromSelected}/>
                    })}

                    {showHelper && <MultiSelectHelper
                        options={localOptions}
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
        </div>
    );
}
