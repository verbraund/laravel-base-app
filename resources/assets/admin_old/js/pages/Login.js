import React, {useRef} from "react";
import LoginForm from "../components/auth/LoginForm";
import LoginFormTfa from "../components/auth/LoginFormTfa";

export default function Login(){

    return (
        <div className="auth">
            <div className="container-fluid h-100">
                <div className="row justify-content-center h-100">
                    <div className="col-lg-3 col-md-6 col-sm-6 align-self-center ">

                        <div className="login my-auto">
                            <div className="row justify-content-md-center">
                                <h2 className="h3 mb-4">LOGIN</h2>
                            </div>
                            <div className="row">
                                <LoginForm/>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    );
}
