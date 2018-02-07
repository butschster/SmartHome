import Vue from 'vue';
import VueRouter from 'vue-router';
import Router from './router/router';

Vue.use(VueRouter);

export const router = new VueRouter({
    mode: 'hash',
    base: '',
    routes: Router.routes()
});

Vue.router = router;
export default {router};