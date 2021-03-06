import Vue from 'vue';

export default {
    structure: {
        id: null,
        name: null,
        description: null,
        type: null,
        key: null,
        properties: [],
        last_activity: null
    },

    async list() {
        try {
            let response = await Vue.$api.device.list();

            return response.data.data;
        } catch (e) {
            throw new Error('Не удалось загрузить список устройств.');
        }
    },

    async logs(deviceId, params) {
        try {
            let response = await Vue.$api.device.logs(deviceId, params);

            return [response.data.data, response.data.meta];
        } catch (e) {
            throw new Error(`Не удалось загрузить логи устройств [${deviceId}].`);
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
            throw new Error(`Не удалось обновить информацию устройства [${id}].`);
        }
    },

    async destroy(id) {
        try {
            let response = await Vue.$api.device.destroy(id);

            return response.data.data;
        } catch (e) {
            throw new Error(`Не удалось удалить устройство [${id}].`);
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