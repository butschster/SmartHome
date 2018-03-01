import {
    DASHBOARD,
    ROOMS_LIST,
    DEVICES_LIST,
    MQTT_LOGS,
    XIAOMI_LOGS,
    XIAOMI_GATEWAY_LIST
} from 'router/actions';

export default [
    {
        title: '',
        items: [
            {
                title: 'Dashboard',
                icon: 'fas fa-tachometer-alt',
                route: {name: DASHBOARD}
            },
            {
                title: 'Устройства',
                icon: 'fas fa-microchip',
                route: {name: DEVICES_LIST}
            },
            {
                title: 'Xiaomi Gateways',
                icon: 'fas fa-plug',
                route: {name: XIAOMI_GATEWAY_LIST}
            },
            {
                title: 'Помещения',
                icon: 'fas fa-cubes',
                route: {name: ROOMS_LIST}
            },
            {
                title: 'Логи MQTT',
                icon: 'fas fa-archive',
                route: {name: MQTT_LOGS}
            },
            {
                title: 'Логи Xiaomi',
                icon: 'fas fa-archive',
                route: {name: XIAOMI_LOGS}
            }
        ]
    }
];