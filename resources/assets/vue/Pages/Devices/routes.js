import List from './List';
import Show from './Show';
import Logs from './Logs';
import PropertyShow from './Property/Show';
import Breadcrumbs from "Breadcrumbs";
import {
    DASHBOARD,
    DEVICES_LIST,
    DEVICE_SHOW,
    DEVICE_PROPERTY_SHOW,
    DEVICE_LOGS
} from 'router/actions';

Breadcrumbs
    .register(DEVICE_SHOW, (crumbs, device) => {
        crumbs.parent(DEVICES_LIST);
        crumbs.push(device.name, {name: DEVICE_SHOW, params: {id: device.id}});

    })
    .register(DEVICES_LIST, (crumbs) => {
        crumbs.parent(DASHBOARD);
        crumbs.push('Устройства', {name: DEVICES_LIST});
    })
    .register(DEVICE_PROPERTY_SHOW, (crumbs, props) => {
        crumbs.parent(DEVICE_SHOW, props.device);
        crumbs.push(props.property.name, {name: DEVICE_PROPERTY_SHOW, params: props.property});
    })
    .register(DEVICE_LOGS, (crumbs, device) => {
        crumbs.parent(DEVICE_SHOW, device);
        crumbs.push('Логи', {name: DEVICES_LIST});
    });

export default [
    {
        path: '/device/:id/property/:property',
        name: DEVICE_PROPERTY_SHOW,
        component: PropertyShow
    },
    {
        path: '/device/:id/logs',
        name: DEVICE_LOGS,
        component: Logs
    },
    {
        path: '/device/:id',
        name: DEVICE_SHOW,
        component: Show
    },
    {
        path: '/devices',
        name: DEVICES_LIST,
        component: List
    },
];