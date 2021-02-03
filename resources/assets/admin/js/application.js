import React from 'react';
import {BrowserRouter as Router} from "react-router-dom";
import GlobalProvider from "./providers/GlobalProvider";
import AlertProvider from "./providers/AlertProvider";
import AuthProvider from "./providers/AuthProvoder";
import Sidebar from "./layouts/Sidebar";
import Content from "./layouts/Content";

export default function Application() {
    return (
        <Router>
            <GlobalProvider>
                <AlertProvider>
                    <AuthProvider>

                        <div className="app">
                            <Sidebar/>
                            <Content/>
                        </div>

                    </AuthProvider>
                </AlertProvider>
            </GlobalProvider>
        </Router>
    );
}

