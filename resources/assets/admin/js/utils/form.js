
export function generateInputAndHelperIds(name){

    const inputId = name + '-' + Math.random().toString(36).substr(2);
    const helperId = name + 'Helper-' + Math.random().toString(36).substr(2);

    return [inputId, helperId];
}
