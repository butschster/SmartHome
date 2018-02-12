import Vue from 'vue';

export default {

    async list() {
        try {
            let response = await Vue.$api.commands.voiceCommands();

            return response.data;
        } catch (e) {
            throw new Error('Не удалось загрузить список голосовых команд.');
        }
    },

    async handle(command, text) {
        try {
            let response = await Vue.$api.commands.voiceCommand(command, text);

            return response.data;
        } catch (e) {
            throw new Error('Не удалось выполнить голосовую команду.');
        }
    }
}