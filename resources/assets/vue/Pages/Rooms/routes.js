import List from './List';
import Show from './Show';
import Create from './Create';
import Breadcrumbs from 'Breadcrumbs';
import {
    DASHBOARD,
    ROOMS_LIST,
    ROOM_SHOW,
    ROOM_CREATE,
} from 'router/actions';

Breadcrumbs.register(ROOM_CREATE, (crumbs, room) => {

    crumbs.parent(ROOMS_LIST);
    crumbs.push(room.name, {name: ROOM_CREATE});

}).register(ROOM_SHOW, (crumbs, room) => {

    crumbs.parent(ROOMS_LIST);
    crumbs.push(room.name, {name: ROOM_SHOW, params: {id: room.id}});

}).register(ROOMS_LIST, (crumbs) => {

    crumbs.parent(DASHBOARD);
    crumbs.push('Помещения', {name: ROOMS_LIST});

});

export default [
    {
        path: '/room/create',
        name: ROOM_CREATE,
        component: Create,
        meta: {
            title: 'Новое помещение',
            icon: 'fas fa-cubes'
        }
    },

    {
        path: '/room/:id',
        name: ROOM_SHOW,
        component: Show,
        meta: {
            title(room) {
                return room.name
            },
            icon: 'fas fa-cubes'
        }
    },
    {
        path: '/rooms',
        name: ROOMS_LIST,
        component: List,
        meta: {
            title: 'Помещения',
            icon: 'fas fa-cubes'
        }
    },
];