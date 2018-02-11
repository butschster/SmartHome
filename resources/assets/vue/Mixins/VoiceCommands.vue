<script>
    import CommandsRepository from 'Repositories/Commands';

    export default {
        name: "voice-commands",
        mounted() {
            this.initVoiceCommands();

            Echo.channel('spech.command')
                .listen('.say', e => {
                    artyom.say(e.message);

                    this.$notify.info({title: 'Alexa', message: e.message});
                });
        },
        methods: {
            async initVoiceCommands() {
                try {
                    let commands = await CommandsRepository.triggers();
                    _.each(commands, (command, key) => {
                        let isSmart = false;

                        _.each(command, (cmd) => {
                            if (cmd.includes('*')) {
                                isSmart = true;
                            }
                        });

                        if (isSmart) {
                            artyom.on(command, true).then((i, wildcard) => {
                                this.$api.commands.fromSpech(key, wildcard);
                            });
                        } else {
                            artyom.on(command).then((i) => {
                                this.$api.commands.fromSpech(key);
                            });
                        }
                    });
                } catch (e) {
                    this.$message.error(e.message);
                }
            }
        }
    }
</script>