import List from './List';
import Show from './Show';

import Breadcrumbs from 'Breadcrumbs';
import {
    DASHBOARD,
    XIAOMI_GATEWAY_LIST,
    XIAOMI_GATEWAY_SHOW
} from 'router/actions';

Breadcrumbs.register(XIAOMI_GATEWAY_SHOW, (crumbs, gateway) => {
    crumbs.parent(XIAOMI_GATEWAY_LIST);
    crumbs.push(gateway.name, {name: XIAOMI_GATEWAY_SHOW, params: {id: gateway.id}});
}).register(XIAOMI_GATEWAY_LIST, (crumbs) => {
    crumbs.parent(DASHBOARD);
    crumbs.push('Xiaomi Gateways', {name: XIAOMI_GATEWAY_LIST});
});

export default [
    {
        path: '/xiaomi/gateway/:id',
        name: XIAOMI_GATEWAY_SHOW,
        component: Show,
        meta: {
            title(gateway) {
                return gateway.name
            },
            icon: 'fas fa-plug'
        }
    },
    {
        path: '/xiaomi/gateways',
        name: XIAOMI_GATEWAY_LIST,
        component: List,
        meta: {
            title: 'Xiaomi Gateways',
            icon: 'fas fa-plug'
        }
    },
];