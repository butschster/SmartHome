<template>
    <div class="card card-shadow card-inverse bg-primary white" v-loading="loading">
        <div class="p-35 text-center">
            <h3 class="mt-0">Moscow, Russia</h3>
            <p class="mb-35">{{ date }}</p>

            <div class="font-size-50">
                <icon :name="`owf owf-${weather.weather_id}`"></icon>
                <span>
                    {{ weather.temp }}°
                    <span class="font-size-30">C</span>
                </span>
            </div>

            <div>
                {{ weather.weather_description }}
            </div>
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