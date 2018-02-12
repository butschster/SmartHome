<script>
    import VoiceCommandsRepository from 'Repositories/VoiceCommands';

    export default {
        name: "voice-commands",
        mounted() {
            this.initVoiceCommands();

            Echo.channel('voice')
                .listen('.say', e => {
                    artyom.say(e.message);

                    this.$notify.info({title: 'Alexa', message: e.message});
                });
        },
        methods: {
            async initVoiceCommands() {
                try {
                    let commands = await VoiceCommandsRepository.list();

                    _.each(commands, (params, key) => {
                        let isSmart = params.smart,
                            triggers = params.triggers;

                        if (isSmart) {
                            artyom.on(triggers, true).then((i, text) => {
                                this.handle(key, text);
                            });
                        } else {
                            artyom.on(triggers).then((i) => {
                                this.handle(key);
                            });
                        }
                    });
                } catch (e) {
                    console.error(e);
                }
            },

            async handle(command, data) {
                try {
                    await VoiceCommandsRepository.handle(command, data);
                } catch (e) {
                    console.error(e);
                }
            }
        }
    }
</script>