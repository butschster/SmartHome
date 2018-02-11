<template>
    <div id="app">
        <router-view></router-view>
    </div>
</template>

<script>
    import VoiceCommands from 'Mixins/VoiceCommands';

    export default {
        name: 'admin-boilerplate',
        mixins: [VoiceCommands],
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
        }
    }
</script>
