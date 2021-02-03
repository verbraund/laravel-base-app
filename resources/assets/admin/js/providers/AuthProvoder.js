import React, {useEffect, useState} from 'react';
import {AuthContext} from "../contexts/AuthContext";
import Login from "../pages/Login";
import Loading from "../components/Loading";
import {auth} from "../utils/auth";

export default function AuthProvider({children}){


    const [authenticated,setAuthenticated] = useState(false);
    const [loading, setLoading] = useState(true);


    auth.setLoginUrl('/api/auth/login');
    auth.setRefreshUrl('/api/auth/refresh-tokens');
    auth.setLogoutUrl('/api/auth/logout');
    auth.setTfaUrl('/api/auth/tfa');

    auth.setLoginHandle(isAuthenticated => {
        if(isAuthenticated) setAuthenticated(true);
    });

    auth.setLogoutHandle(() => setAuthenticated(false));


    useEffect(() => {
        auth.refreshToken()
            .then(isAuthenticated => {
                if(isAuthenticated) setAuthenticated(true);
            })
            .catch(() => {})
            .finally(() => {setLoading(false)})
    }, []);


    return (
        <AuthContext.Provider value={{auth}}>
            {authenticated ? children : (
                loading ? <Loading /> : <Login />
            )}
        </AuthContext.Provider>
    );

}
