import Vue from 'vue';

export default {

    logStructure: {
        message: null,
        ip: null,
        model: null,
        sid: null,
        created_at: null
    },

    gatewayStructure: {
        id: null,
        name: null,
        description: null,
        sid: null,
        password: null,
        ip: null,
    },

    async gateways(params) {
        try {
            let response = await Vue.$api.xiaomi.gateways(params);

            return response.data.data;
        } catch (e) {
            throw new Error('Не удалось загрузить список шлюзов.');
        }
    },

    async gateway(id) {
        try {
            let response = await Vue.$api.xiaomi.gateway(id);

            return response.data.data;
        } catch (e) {
            throw new Error('Не удалось загрузить информацию по шлюзу.');
        }
    },

    async gatewayDevices(id) {
        try {
            let response = await Vue.$api.xiaomi.gatewayDevices(id);

            return response.data.data;
        } catch (e) {
            throw new Error('Не удалось загрузить список устройств.');
        }
    },

    async update(id, data) {
        try {
            let response = await Vue.$api.xiaomi.updateGateway(id, data);

            return response.data.data;
        } catch (e) {
            throw new Error('Не удалось сохранить информацию по шлюзу.');
        }
    },

    async logs(params) {
        try {
            let response = await Vue.$api.xiaomi.logs(params);

            return [response.data.data, response.data.meta, response.data.links];
        } catch (e) {
            throw new Error('Не удалось загрузить логи Xiaomi Mi Home.');
        }
    },
}