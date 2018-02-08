import Vue from 'vue';
import App from 'App';
import {router} from 'router';
import {getInstance} from './remark/Site';
import Breadcrumbs from 'Breadcrumbs';

require('./bootstrap');
require('./ui');
require('components');
require('./remark/Plugins/menu');
require('./remark/Plugins/asscrollable');
require('./remark/Plugins/slidepanel');
require('./remark/Plugins/matchheight');
require('./remark/Plugins/nprogress');

Vue.prototype.$site = getInstance;
Vue.prototype.$loader = require('nprogress');
Vue.prototype.$breadcrumbs = Breadcrumbs;

Breakpoints();

const app = new Vue({
    el: '#app',

    router,

    render: h => {
        if (document.getElementById('app')) {
            return h(App);
        }
    }
});

