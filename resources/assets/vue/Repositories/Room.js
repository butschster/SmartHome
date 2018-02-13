import Vue from 'vue';

export default {

    structure: {
        id: null,
        name: null,
        description: null,
        position: 1,
        properties: [],
        links: {
            self: null,
            list: null
        }
    },

    async list() {
        try {
            let response = await Vue.$api.room.list();

            return response.data.data;
        } catch (e) {
            throw new Error('Не удалось загрузить список помещений.');
        }
    },

    async properties(roomId) {
        try {
            let response = await Vue.$api.room.properties(roomId);

            return response.data.data;
        } catch (e) {
            throw new Error('Не удалось загрузить список датчиков помещения.');
        }
    },

    async attachProperty(roomId, propertyId) {
        try {
            await Vue.$api.room.attachProperty(roomId, propertyId);
        } catch (e) {
            throw new Error('Не удалось привязать датчик к помещению.');
        }
    },

    async detachProperty(roomId, propertyId) {
        try {
            await Vue.$api.room.detachProperty(roomId, propertyId);
        } catch (e) {
            throw new Error('Не удалось отвязать датчик от помещения.');
        }
    },

    async show(id) {
        try {
            let response = await Vue.$api.room.show(id);

            return response.data.data;
        } catch (e) {
            throw new Error(`Не удалось загрузить данные о помещении [${id}].`);
        }
    },

    async update(id, data) {
        try {
            let response = await Vue.$api.room.update(id, data);

            return response.data.data;
        } catch (e) {
            throw new Error(`Не удалось обновить информацию о помещении [${id}].`);
        }
    },


    async store(data) {
        try {
            let response = await Vue.$api.room.store(data);

            return response.data.data;
        } catch (e) {
            throw new Error(`Не удалось добавить новое помещение.`);
        }
    },

    async destroy(id) {
        try {
            let response = await Vue.$api.room.destroy(id);
        } catch (e) {
            throw new Error(`Не удалось удалить помещение [${id}].`);
        }
    }
}