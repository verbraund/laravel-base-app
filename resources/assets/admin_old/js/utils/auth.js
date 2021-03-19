import axios from 'axios';

// export const AUTH_FACTOR_ONE = 'AUTH_FACTOR_ONE';
// export const AUTH_FACTOR_TWO = 'AUTH_FACTOR_TWO';


axios.interceptors.request.use((config) => {
    let token = auth.getToken();
    if(token){
        config.headers.Authorization = 'Bearer ' + token;
    }
    return config;
});

axios.interceptors.response.use(r => r, (error) => {

    if(auth.isTokenExpiredError(error.response)){

        if(!auth.isRefreshingToken()){
            auth.setRefreshingToken(true);

            auth.refreshToken()
                .then(token => {
                    auth.setRefreshingToken(false);
                    if(token){
                        auth.onTokenRefreshed(token);
                    }
                }).catch(auth.logout);
        }

        return new Promise((resolve) => {
            auth.addTokenRefreshSubscriber((token) => {
                error.config.headers.Authorization = token;
                resolve(axios(error.config));
            });
        });

    }

    return Promise.reject(error);

});


const utils = () => {

    let token = null;
    let isRefreshingToken = false;
    let tokenRefreshSubscribers = [];
    const client = navigator.userAgent;
    const config = {
        refresh : {url: null, handle: _ => _},
        login : {url: null, handle: _ => _},
        tfa : {url: null, handle: _ => _, qr: null, enabled: false},
        tfaForgot : {url: null, handle: _ => _},
        logout : {url: null, handle: _ => _},
    };


    return {
        getToken: _ => token,
        setToken: t => token = t,
        getTfaQrCode: _ => config.tfa.qr,
        isEnabledTfa: _ => config.tfa.enabled,

        setRefreshUrl: u => config.refresh.url = u,
        setLoginUrl: u => config.login.url = u,
        setTfaUrl: u => config.tfa.url = u,
        setLogoutUrl: u => config.logout.url = u,
        setTfaForgotUrl: u => config.tfaForgot.url = u,
        setRefreshHandle: h => config.refresh.handle = h,
        setLoginHandle: h => config.login.handle = h,
        setLogoutHandle: h => config.logout.handle = h,
        setTfaHandle: h => config.tfa.handle = h,
        setTfaForgotHandle: h => config.tfaForgot.handle = h,

        addTokenRefreshSubscriber: s => tokenRefreshSubscribers.push(s),
        onTokenRefreshed: t => tokenRefreshSubscribers = tokenRefreshSubscribers.filter(c => c(t)),
        isTokenExpiredError: response => response.status === 401 && token !== null,
        isRefreshingToken: _ => isRefreshingToken,
        setRefreshingToken: v => isRefreshingToken = v,

        refreshToken: _ => {
            if(!config.refresh.url) return Promise.reject(new Error("refresh url address is not defined"));
            return axios.post(
                config.refresh.url,
                new URLSearchParams({refresh: true,client: client}),
                {withCredentials: true}
            ).then(r => {
                return r.data['access-token'] ? token = r.data['access-token'] : false;
            }).then(config.refresh.handle);
        },
        login: (l, p) => {
            if(!config.login.url) return Promise.reject(new Error("login url address is not defined"));
            return axios.post(config.login.url, new URLSearchParams({
                login: l,
                password: p,
                client: client
            }), {withCredentials: true}).then(r => {
                if(r.data['access-token']){
                    token = r.data['access-token'];

                    if(!r.data['tfa'])return true;

                    config.tfa.enabled = true;
                    config.tfa.qr = r.data['tfa_code'];
                }
                return false;
            }).then(config.login.handle);
        },
        tfa: (c) => {
            if(!config.tfa.url) return Promise.reject(new Error("Tfa url address is not defined"));
            return axios.post(config.tfa.url, new URLSearchParams({code: c}), {withCredentials: true})
                .then(r => {
                    if(r.data['access-token']){
                        token = r.data['access-token'];
                        config.login.handle(true);
                        return true;
                    }
                    return false;
            }).then(config.tfa.handle);
        },
        tfaForgot: _ => {
            if(!config.tfaForgot.url) return Promise.reject(new Error("tfa forgot url address is not defined"));
            return axios.get(
                config.tfaForgot.url,
                {withCredentials: true}
            ).then(config.tfaForgot.handle);
        },
        logout: () => {
            if(!config.logout.url) return Promise.reject(new Error("logout url address is not defined"));
            return axios.post(
                config.logout.url,
                new URLSearchParams({client: client}),
                {withCredentials: true}
            ).then(r => {
                return token = null;
            }).then(config.logout.handle);
        },

    };
};

export const auth  = utils();
