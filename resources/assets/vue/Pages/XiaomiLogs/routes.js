import List from './List';
import Breadcrumbs from "Breadcrumbs";

import {
    DASHBOARD,
    XIAOMI_LOGS,
} from 'router/actions';

Breadcrumbs.register(XIAOMI_LOGS, (crumbs) => {
    crumbs.parent(DASHBOARD);
    crumbs.push('Логи Xiaomi Mi home', {name: XIAOMI_LOGS});
});

export default [
    {
        path: '/xiaomi/logs',
        name: XIAOMI_LOGS,
        component: List
    },
];