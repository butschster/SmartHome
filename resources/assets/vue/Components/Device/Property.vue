<template>
    <div class="card" :style="styles" :class="classes">
        <component v-bind:is="propertyComponent(property)" :property="property" v-on:updateStyle="updateStyle" v-on:updateClasses="updateClasses">
            <h4>
                {{ property.name }}
            </h4>
            <small v-if="hasDescription" class="text-muted">{{ property.description }}</small>
        </component>
    </div>
</template>

<script>
    import PropertyMixin from './Mixins/Property';
    import PowerProperty from './Property/Power';
    import HumidityProperty from './Property/Humidity';
    import TemperatureProperty from './Property/Temperature';
    import DoorProperty from './Property/Door';
    import ActionProperty from './Property/Action';
    import BatteryProperty from './Property/Battery';
    import IlluminationProperty from './Property/Illumination';
    import MotionProperty from './Property/Motion';
    import RGBProperty from './Property/RGB';
    import NoMotionTimerProperty from './Property/NoMotionTimer';

    export default {
        components: {
            PowerProperty,
            HumidityProperty,
            DoorProperty,
            TemperatureProperty,
            ActionProperty,
            BatteryProperty,
            IlluminationProperty,
            MotionProperty,
            RGBProperty,
            NoMotionTimerProperty
        },
        mixins: [PropertyMixin],
        data() {
            return {
                styles: {},
                classes: {}
            }
        },
        mounted() {
            Echo.channel(`device.property.${this.property.id}`)
                .listen('.property.changed', e => {
                    this.$emit('changed', e.property);
                });
        },
        methods: {
            propertyComponent(property) {
                return `${property.type}Property`;
            },
            updateStyle(style) {
                this.styles = style;
            },
            updateClasses(classes) {
                this.classes = classes;
            }
        }
    }
</script>