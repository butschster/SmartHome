import Vue from 'vue';

export default {

    structure: {
        message: null,
        topic: null,
        created_at: null
    },

    async logs(params) {
        try {
            let response = await Vue.$api.mqtt.logs(params);

            return [response.data.data, response.data.meta, response.data.links];
        } catch (e) {
            throw new Error('Не удалось загрузить логи MQTT.');
        }
    },
}