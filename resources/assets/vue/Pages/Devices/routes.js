import List from './List';
import Show from './Show';
import PropertyShow from './Property/Show';
import Breadcrumbs from "Breadcrumbs";
import {
    DASHBOARD,
    DEVICES_LIST,
    DEVICE_SHOW,
    DEVICE_PROPERTY_SHOW,
} from 'router/actions';

Breadcrumbs.register(DEVICE_SHOW, (crumbs, device) => {
    crumbs.parent(DEVICES_LIST);
    crumbs.push(device.name, {name: DEVICE_SHOW, params: {id: device.id}});

}).register(DEVICES_LIST, (crumbs) => {
    crumbs.parent(DASHBOARD);
    crumbs.push('Устройства', {name: DEVICES_LIST});
}).register(DEVICE_PROPERTY_SHOW, (crumbs, property) => {
    crumbs.parent(DEVICE_SHOW, {name: 'Устройство', id: property.device_id});
    crumbs.push(property.name, {name: DEVICE_PROPERTY_SHOW, params: {id: property.device_id, property: property.id}});
});

export default [
    {
        path: '/device/:id/property/:property',
        name: DEVICE_PROPERTY_SHOW,
        component: PropertyShow
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