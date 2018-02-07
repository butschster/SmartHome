// Pages
import Dashboard from 'Pages/Dashboard/Dashboard';
import PageNotFound from 'Pages/404';

import {
    DASHBOARD,
    PAGE_NOT_FOUND
} from "./actions";

class Router {
    constructor(components = []) {
        this._routes = [];

        components.forEach(component => this.register(component))
    }

    register(routes) {
        if (_.isFunction(routes)) {
            return routes(this);
        }

        if (!_.isArray(routes)) {
            throw Error('routes argument must be an array');
        }

        for(let i in routes)
            this._routes.push(routes[i]);
    }

    routes() {
        return this._routes;
    }
}

let router = new Router([

]);


router.register([
    {
        path: '/',
        name: DASHBOARD,
        title: 'Dashboard',
        component: Dashboard,
        meta: {
            auth: true,
            menu: true,
        }
    },
    {
        path: "*",
        name: PAGE_NOT_FOUND,
        component: PageNotFound,
        meta: {
            guest: true,
            menu: false,
        }
    }
]);

export default router;