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

    async current() {
        try {
            let response = await Vue.$api.weather.current();

            return response.data.data;
        } catch (e) {
            throw new Error('Не удалось загрузить данные о погоде.');
        }
    }
}