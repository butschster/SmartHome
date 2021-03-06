import Vue from 'vue';

export default {

    structure: {
        id: null,
        device_id: null,
        type: null,
        key: null,
        value: null,
        name: null,
        description: null,
        meta: {
            units: null
        },
        commands: []
    },

    async all() {
        try {
            let response = await Vue.$api.device_property.all();

            return response.data.data;
        } catch (e) {
            throw new Error(`Не удалось загрузить список свойств.`);
        }
    },

    async rooms(propertyId) {
        try {
            let response = await Vue.$api.device_property.rooms(propertyId);

            return response.data.data;
        } catch (e) {
            throw new Error(`Не удалось загрузить список помещений для датчика [${id}].`);
        }
    },

    async list(deviceId) {
        try {
            let response = await Vue.$api.device_property.list(deviceId);

            return response.data.data;
        } catch (e) {
            throw new Error(`Не удалось загрузить список датчиков для устройства [${id}].`);
        }
    },

    async logs(id, params) {
        try {
            let response = await Vue.$api.device_property.logs(id, params);

            return response.data.data;
        } catch (e) {
            throw new Error(`Не удалось загрузить лог для датчика [${id}].`);
        }
    },

    async show(id) {
        try {
            let response = await Vue.$api.device_property.show(id);

            return response.data.data;
        } catch (e) {
            throw new Error(`Не удалось загрузить данные для устройства [${id}].`);
        }
    },

    async update(id, data) {
        try {
            let response = await Vue.$api.device_property.update(id, data);

            return response.data.data;
        } catch (e) {
            throw new Error(`Не удалось обновить информацию устройства [${id}].`);
        }
    },
}