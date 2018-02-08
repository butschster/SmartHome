import {
    DASHBOARD,
    ROOMS_LIST,
    DEVICES_LIST
} from 'router/actions';

export default [
    {
        title: 'General',
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
            }
        ]
    }
];