<template>
    <div>
        <h4>
            <i class="fas fa-tint fa-fw fa-lg"></i>
            {{ property.name }} <span class="label label-info">{{ property.value }}  {{ property.meta.units }}</span>
        </h4>

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
    import PropertyMixin from './mixin';
    import LogsMixin from './logs';
    import LineChart from '../Partials/LineChart';

    export default {
        components: {
            LineChart
        },
        mixins: [LogsMixin, PropertyMixin]
    }
</script>