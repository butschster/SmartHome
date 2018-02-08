<template>
    <div class="card card-shadow" v-loading="loading">
        <div class="p-35 text-center">
            <h4>Moscow, Russia</h4>
            <p class="blue-grey-400 mb-35">{{ date }}</p>
            <icon :name="`owf owf-4x owf-${weather.weather_id}`"></icon>
            <div class="font-size-40 red-600">
                {{ weather.temp }}°
                <span class="font-size-30">C</span>
            </div>
            <div>{{ weather.weather_description }}</div>
        </div>
    </div>
</template>

<script>
    import Repository from 'Repositories/Weather';

    export default {
        name: "weather-widget",
        mounted() {
            Echo.channel('weather')
                .listen('.updated', e => {
                    this.weather = e.weather;
                });

            this.loadCurrentWeather();
        },

        data() {
            return {
                weather: Repository.structure,
                loading: false,
                date: moment().format('dddd, MMMM Do YYYY')
            };
        },

        methods: {
            async loadCurrentWeather() {
                this.loading = true;

                try {
                    this.weather = await Repository.current();
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            }
        }
    }
</script>