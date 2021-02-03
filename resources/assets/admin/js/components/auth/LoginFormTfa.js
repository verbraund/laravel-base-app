import React, {useContext, useRef} from 'react';
import {AuthContext} from "../../contexts/AuthContext";

export default function LoginFormTfa({setTfa}){

    const {auth} = useContext(AuthContext);

    const code = useRef('');
    const qr = auth.getTfaQrCode();

    const submitHandler = () => {
        console.log(code);
        if(code.current.value.length > 0){
            auth.tfa(code.current.value).then(isAuthenticated => {
                if(isAuthenticated && auth.isEnabledTfa()){
                    setTfa(false);
                }
            }).catch(_ => {
                code.current.value = '';
            });
        }
    };


    return (
        <div className="row">
            {qr && <img src={qr} className="qr" />}
            <input type="text" ref={code} className="form-control mb-3" placeholder="Code TFA" />
            <button onClick={submitHandler} type="submit" className="btn btn-primary btn-block">Submit</button>
        </div>
    );
}
