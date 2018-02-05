import Vue from 'vue';

require('./bootstrap');
require('../vue/components');

const app = new Vue({
    el: '#app',

    created() {

        artyom.on(['включи свет в *', 'включи свет на *'], true).then((i, wildcard) => {
            this.$api.commands.fromSpech('room:switch_on', wildcard);
        });

        artyom.on(['выключи свет в *', 'выключи свет на *'], true).then((i, wildcard) => {
            this.$api.commands.fromSpech('room:switch_off', wildcard);
        });

        artyom.on(['какая сегодня погода']).then((i) => {
            this.$api.commands.fromSpech('weather');
        });

        Echo.channel('spech.command')
            .listen('.say', e => {
                artyom.say(e.message);
            });
    }
});

