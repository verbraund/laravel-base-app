import React from 'react';
import {Route, Switch} from "react-router-dom";

import Home from "./pages/Home";
import News from "./pages/News";
import NotFound from "./pages/NotFound";
import Account from "./pages/Account";

export default function Routes(){
    return (
        <Switch>
            <Route exact path="/admin">
                <Home />
            </Route>

            <Route path="/admin/news">
                <News />
            </Route>

            <Route path="/admin/account">
                <Account />
            </Route>

            <Route path="*">
                <NotFound />
            </Route>


            {/*<Route path="/admin">*/}

            {/*    <Route exact path="/">*/}
            {/*        <Home />*/}
            {/*    </Route>*/}

            {/*    <Route path="/news">*/}
            {/*        <News />*/}
            {/*    </Route>*/}
            {/*    */}
            {/*    <Route path="*">*/}
            {/*        <NotFound />*/}
            {/*    </Route>*/}
            {/*</Route>*/}

        </Switch>
    );
}
