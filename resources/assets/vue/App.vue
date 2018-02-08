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
            '$route'() {
                this.fetchData();
            }
        },

        mounted() {
            this.fetchData();
        },

        methods: {
            fetchData() {
                setTimeout(() => this.$site().run(), 200);
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
        }
    }
</script>
