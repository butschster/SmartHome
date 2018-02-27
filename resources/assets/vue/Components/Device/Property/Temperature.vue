<template>
    <div class="card-body">
        <h5 class="text-primary">
            <i class="fas fa-lg fa-fw" :class="thermometerClass"></i>
            {{ property.name }} <span class="label label-info">{{ property.value }} {{ property.meta.units }}</span>
        </h5>

        <line-chart :data="convertedLogs"
                    :units="property.meta.units"
                    :id="property.id"
                    :name="property.name"
                    v-if="hasLogs"
        >
        </line-chart>
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
        mixins: [PropertyMixin, LogsMixin],
        computed: {
            thermometerClass() {
                return {
                    'fa-thermometer-empty': this.property.value < 5,
                    'fa-thermometer-half': this.property.value >= 5 && this.property.value < 30,
                    'fa-thermometer-full': this.property.value >= 30,
                }
            }
        }
    }
</script>