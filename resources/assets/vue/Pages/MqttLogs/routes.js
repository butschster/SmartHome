import List from './List';
import Breadcrumbs from "Breadcrumbs";

import {
    DASHBOARD,
    MQTT_LOGS,
} from 'router/actions';

Breadcrumbs.register(MQTT_LOGS, (crumbs) => {
    crumbs.parent(DASHBOARD);
    crumbs.push('Логи MQTT', {name: MQTT_LOGS});
});

export default [
    {
        path: '/mqtt/logs',
        name: MQTT_LOGS,
        component: List
    },
];