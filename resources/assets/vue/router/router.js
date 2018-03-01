import Dashboard from 'Pages/Dashboard/Dashboard';
import PageNotFound from 'Pages/404';
import Breadcrumbs from 'Breadcrumbs';
import RoomsRoutes from 'Pages/Rooms/routes';
import DevicesRoutes from 'Pages/Devices/routes';
import MqttLogsRoutes from 'Pages/MqttLogs/routes';
import XiaomiLogsRoutes from 'Pages/XiaomiLogs/routes';
import XiaomiGatewaysRoutes from 'Pages/XiaomiGateways/routes';

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
    RoomsRoutes,
    DevicesRoutes,
    MqttLogsRoutes,
    XiaomiLogsRoutes,
    XiaomiGatewaysRoutes
]);

router.register([
    {
        path: '/',
        name: DASHBOARD,
        title: 'Dashboard',
        component: Dashboard
    },
    {
        path: "*",
        name: PAGE_NOT_FOUND,
        component: PageNotFound
    }
]);

Breadcrumbs.register(DASHBOARD, (crumbs) => {
    crumbs.push('Dashboard', {name: DASHBOARD})
});

export default router;