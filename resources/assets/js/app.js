import Vue from 'vue';
import App from 'App';
import { router } from './router';

require('./bootstrap');
require('./ui');
require('../vue/components');

const app = new Vue({
    el: '#app',

    router,

    render: h => h(App)
});

