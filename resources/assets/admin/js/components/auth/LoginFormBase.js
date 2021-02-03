import React, {useContext, useRef} from 'react';
import {AuthContext} from "../../contexts/AuthContext";

export default function LoginFormBase({setTfa}){

    const {auth} = useContext(AuthContext);

    const login = useRef('');
    const pass = useRef('');

    const submitHandler = () => {
        if(login.current.value.length > 0 && pass.current.value.length > 0){

            auth.login(login.current.value, pass.current.value).then(isAuthenticated => {
                if(!isAuthenticated && auth.isEnabledTfa()){
                    setTfa(true);
                }
            }).catch(_ => {
                login.current.value = '';
                pass.current.value = '';
            });
        }
    };

    return (
        <div className="row">
            <input type="text" ref={login} className="form-control mb-3" placeholder="Login" />
            <input type="password" ref={pass} className="form-control mb-3" placeholder="Password" />
            <button onClick={submitHandler} type="submit" className="btn btn-primary btn-block">Submit</button>
        </div>
    );
}
