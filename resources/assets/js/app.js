import Vue from 'vue';

require('./bootstrap');
require('../vue/components');

const app = new Vue({
    el: '#app',

    created() {

        artyom.on(['Включи свет в *', 'Включи свет на *'], true).then((i, wildcard) => {
            this.$api.commands.fromSpech('room:switch_on', wildcard);
        });

        artyom.on(['Выключи свет в *', 'Выключи свет на *'], true).then((i, wildcard) => {
            this.$api.commands.fromSpech('room:switch_off', wildcard);
        });

        artyom.on(['Какая сегодня погода']).then((i) => {
            this.$api.commands.fromSpech('weather');
        });

        Echo.channel('device')
            .listen('.registered', e => {
                artyom.say("Зарегистрировано новое устройство");
            });

        Echo.channel('spech.command')
            .listen('.say', e => {
                artyom.say(e.message);
            })
            .listen('.not.found', e => {
                artyom.say('Произошла ошибка при выполнении команды.');
            });
    }
});

