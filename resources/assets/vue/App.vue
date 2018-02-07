<template>
    <div id="app">
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        /**
         * The name of the application.
         */
        name: 'vue-boilerplate',

        watch: {
            // call again the method if the route changes
            '$route'() {
                this.fetchData();
            }
        },

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

                    this.$notify.info({title: 'Alexa', message: e.message});
                });
        },

        methods: {

        }
    }
</script>
