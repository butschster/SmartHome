import axios from 'axios';
import Vue from 'vue';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */
axios.interceptors.request.use(config => {
    return config;
});

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


// Add a response interceptor
axios.interceptors.response.use(
    response => response,
    (error) => {

        switch (error.response.status) {
            case 200:
            case 202:
                break;

            case 422:
                Bus.$emit('validation.thrown', error.response.data);
                break;

            case 401:
                Bus.$emit('response.need_auth', error.response.data);

            case 403:
                Bus.$emit('response.access_denied', error.response.data);

            case 404:
                Bus.$emit('response.not_found', error.response.data);
        }

        console.error(
            `Request [${error.response.config.method}:${error.response.config.url}] error`,
            error.response.data
        );

        return Promise.reject(error);
    });

import Api from './api';

Vue.$api = Api;
Object.defineProperty(Vue.prototype, '$api', {
    get() {
        return Api;
    },
});