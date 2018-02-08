<template>
    <div class="card">
        <div class="card-body">
            <component v-bind:is="propertyComponent(property)" :property="property">
                <h4>
                    {{ property.name }}
                </h4>
                <small v-if="hasDescription" class="text-muted">{{ property.description }}</small>
            </component>
        </div>
    </div>
</template>

<script>
    import PropertyMixin from './Mixins/Property';
    import PowerProperty from './Property/Power';
    import HumidityProperty from './Property/Humidity';
    import TemperatureProperty from './Property/Temperature';
    import DoorProperty from './Property/Door';
    import ActionProperty from './Property/Action';

    export default {
        components: {
            PowerProperty,
            HumidityProperty,
            DoorProperty,
            TemperatureProperty,
            ActionProperty
        },
        mixins: [PropertyMixin],
        mounted() {
            Echo.channel(`device.property.${this.property.id}`)
                .listen('.property.changed', e => {
                    this.$emit('changed', e.property);
                });
        },
        methods: {
            propertyComponent(property) {
                return `${property.type}Property`;
            }
        }
    }
</script>