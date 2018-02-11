import Vue from 'vue';

export default {
    async triggers() {
        try {
            let response = await Vue.$api.commands.triggers();

            return response.data;
        } catch (e) {
            throw new Error('Не удалось загрузить список голосовых команд.');
        }
    }
}