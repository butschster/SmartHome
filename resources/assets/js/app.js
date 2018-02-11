import Vue from 'vue';
import Admin from 'Admin';
import App from 'App';
import {router} from 'router';
import {getInstance} from './remark/Site';

require('./bootstrap');
require('./ui');
require('components');
require('./remark/Plugins/menu');
require('./remark/Plugins/asscrollable');
require('./remark/Plugins/slidepanel');
require('./remark/Plugins/matchheight');

Vue.prototype.$site = getInstance;

Breakpoints();

new Vue({
    el: '#app',

    render: h => {
        if (document.getElementById('app')) {
            return h(App);
        }
    }
});

new Vue({
    el: '#admin',

    router,

    render: h => {
        if (document.getElementById('admin')) {
            return h(Admin);
        }
    }
});

