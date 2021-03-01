import React, {useState} from 'react';

export function useForceUpdate () {
    const [sate, setSate] = useState(Math.random());
    const update = () => setSate(Math.random());
    return [update, sate];
}
