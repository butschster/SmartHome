<template>
    <div class="card-body">
        <h5 class="text-info">
            <i class="fas fa-tint fa-fw fa-lg"></i>
            {{ property.name }} <span class="label label-info">{{ property.value }}  {{ property.meta.units }}</span>
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
        mixins: [LogsMixin, PropertyMixin]
    }
</script>