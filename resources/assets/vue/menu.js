import {
    DASHBOARD,
    ROOMS_LIST,
    DEVICES_LIST,
    MQTT_LOGS
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
                title: 'Помещения',
                icon: 'fas fa-cubes',
                route: {name: ROOMS_LIST}
            },
            {
                title: 'Логи MQTT',
                icon: 'fas fa-archive',
                route: {name: MQTT_LOGS}
            }
        ]
    }
];