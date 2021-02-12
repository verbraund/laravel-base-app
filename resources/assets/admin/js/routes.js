import React from 'react';
import {Route, Switch} from "react-router-dom";

import Home from "./pages/Home";
import NotFound from "./pages/NotFound";
import Account from "./pages/Account";
import NewsIndex from "./pages/media/news/NewsIndex";

export default function Routes(){
    return (
        <Switch>
            <Route exact path="/admin">
                <Home />
            </Route>

            <Route exact path="/admin/news">
                <NewsIndex />
            </Route>

            <Route path="/admin/news/:slug">
                < />
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
