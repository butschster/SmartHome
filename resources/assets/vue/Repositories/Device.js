import Vue from 'vue';

export default {
    async list() {
        try {
            let response = await Vue.$api.device.list();

            return response.data.data;
        } catch (e) {
            throw new Error('Не удалось загрузить список устройств.');
        }
    },

    async show(id) {
        try {
            let response = await Vue.$api.device.show(id);

            return response.data.data;
        } catch (e) {
            throw new Error(`Не удалось загрузить устройство [${id}].`);
        }
    },

    async update(id, data) {
        try {
            let response = await Vue.$api.device.update(id, data);

            return response.data.data;
        } catch (e) {
            throw new Error(`Не удалось обновить информаци устройство [${id}].`);
        }
    },

    async properties(deviceId) {
        try {
            let response = await Vue.$api.device.properties(deviceId);

            return response.data.data;
        } catch (e) {
            throw new Error(`Не удалось загрузить список свойств для устройства [${id}].`);
        }
    },

    async property(id) {
        try {
            let response = await Vue.$api.device.property(id);

            return response.data.data;
        } catch (e) {
            throw new Error(`Не удалось загрузить данные для устройства [${id}].`);
        }
    }
}