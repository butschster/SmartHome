<template>
    <div>
        <h5 class="text-info">
            <i class="fas fa-lg fa-fw" :class="batteryClass"></i>
            {{ property.name }} <span class="label label-info">{{ property.formatted_value }}{{ property.meta.units }}</span>
        </h5>
    </div>
</template>

<script>
    import PropertyMixin from '../Mixins/Property';
    import LogsMixin from '../Mixins/Logs';
    import LineChart from '../Partials/LineChart';

    export default {
        components: {
            LineChart
        },
        mixins: [LogsMixin, PropertyMixin],
        computed: {
            batteryClass() {
                let percentage = this.property.formatted_value;
                return {
                    'fa-battery-empty': percentage < 5,
                    'fa-battery-quarter': percentage >= 25 && percentage < 50,
                    'fa-battery-half': percentage >= 50 && percentage < 70,
                    'fa-battery-three-quarters': percentage >= 70 && percentage < 90,
                    'fa-battery-full': percentage >= 90,
                }
            }
        }
    }
</script>