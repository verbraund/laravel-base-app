

const currentUser = () => {
    let login = '';
    let newPass = '';
    let email = '';

    return {
        getLogin: _ => name,
        setLogin: l => login = l,
        setPass: p => newPass = p,
        getEmail: _ => email,
        setEmail: e => email = e,

    };

};


export const user = currentUser();
