import React, {useContext, useState} from 'react';

import LoginFormBase from "./LoginFormBase";
import LoginFormTfa from "./LoginFormTfa";

export default function LoginForm(){

    const [tfa, setTfa] = useState(false);

    return (
        <div className="col-md-12">
            {tfa ? <LoginFormTfa setTfa={setTfa} /> : <LoginFormBase setTfa={setTfa} />}
        </div>
    );
}
