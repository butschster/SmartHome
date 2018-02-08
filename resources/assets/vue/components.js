import Vue from 'vue';

Vue.component('Icon', require('Components/Icon'));
Vue.component('Actions', require('Components/Layouts/Partials/Actions'));
Vue.component('ButtonAction', require('Components/Layouts/Partials/ButtonAction'));
Vue.component('MainLayout', require('Components/Layouts/Main'));
Vue.component('PageContent', require('Components/Layouts/Partials/PageContent'));

Vue.mixin({
    methods: {
        imgError(el) {
            $(el.target).attr('src', '/svg/no-image.svg');
        },
        avatarError(el) {
            $(el.target).attr('src', '/svg/user.svg');
        }
    }
});