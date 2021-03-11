import React, {useContext, useEffect, useRef, useState} from 'react';
import {AuthContext} from "../../contexts/AuthContext";
import {AlertContext} from "../../contexts/AlertContext";

export default function LoginFormTfa({setTfa}){

    const {auth} = useContext(AuthContext);
    const {error} = useContext(AlertContext);

    const code = useRef('');
    const qr = auth.getTfaQrCode();

    const [sendEmailBtnDisabled, setSendEmailBtnDisabled] = useState(false);
    const sendEmailBtn = useRef(false);
    const sendEmailBtnTextDef = 'Отправить на email';
    const waitTimeOutEmailSend = 30;
    let interval = null;

    const sendTfaCodeHandler = () => {
        if(code.current.value.length > 0){
            auth.tfa(code.current.value.trim()).then(isAuthenticated => {
                if(isAuthenticated && auth.isEnabledTfa()){
                    setTfa(false);
                }
            }).catch(_ => {
                code.current.value = '';
                error('Ошибка!','Некорректный код');
            });
        }
    };

    const sendToEmailBtnHandler = () => {

        auth.tfaForgot().then(response => {
            console.log(response.data);
        }).catch(e => {
            console.error(e)
            error('Ошибка!','Слишком много запросов');
        });

        let seconds = 0;
        interval = setInterval(() => {
            if(seconds >= waitTimeOutEmailSend){
                clearInterval(interval);
                sendEmailBtn.current.innerText = sendEmailBtnTextDef;
                setSendEmailBtnDisabled(false);
            }else{
                sendEmailBtn.current.innerText = sendEmailBtnTextDef + ' ' + (waitTimeOutEmailSend - seconds);
                seconds++;
            }
        }, 1000)

        setSendEmailBtnDisabled(true);
    };

    useEffect(() => {
        return () => {if(interval)clearInterval(interval);}
    }, []);


    return (
        <div className="row">
            <div className="col-md-12">
                {qr && <div><img src={qr} className="qr" /></div>}
                <div className="row">
                    <input type="text" ref={code} className="form-control mb-3" placeholder="Code TFA" />
                </div>
                <div className="row justify-content-between">
                    <button onClick={sendTfaCodeHandler} type="submit" className="btn btn-primary">Submit</button>
                    <button disabled={sendEmailBtnDisabled} ref={sendEmailBtn} onClick={sendToEmailBtnHandler} type="submit" className="btn btn-primary email-send">{sendEmailBtnTextDef}</button>
                </div>
            </div>
        </div>
    );
}
