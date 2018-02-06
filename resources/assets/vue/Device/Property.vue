<template>
    <div v-on:dblclick="edit = true" v-loading="loading">
        <component v-bind:is="propertyComponent(property)" :property="property">
            <h4>
                {{ property.name }}

                <template v-if="hasDescription">
                    <br>
                    <small>{{ property.description }}</small>
                </template>
            </h4>
        </component>

        <device-property-form
                v-if="edit"
                :data="property"
                v-on:update="update"
                v-on:close="edit = false">
        </device-property-form>
    </div>
</template>

<script>
    import Mixin from './Property/mixin';
    import PowerProperty from './Property/Power';
    import HumidityProperty from './Property/Humidity';
    import TemperatureProperty from './Property/Temperature';
    import DoorProperty from './Property/Door';
    import DevicePropertyForm from './Form';
    import DevicePropertyRepository from '../Repositories/DeviceProperty';

    export default {
        components: {
            DevicePropertyForm,
            PowerProperty,
            HumidityProperty,
            DoorProperty,
            TemperatureProperty
        },
        mixins: [Mixin],
        data() {
            return {
                edit: false,
                loading: false
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
            async update(data) {
                this.loading = true;

                try {
                    await DevicePropertyRepository.update(this.property.id, data);

                    this.edit = false;
                    this.$message.success('Данные успешно обновлены.');
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            }
        }
    }
</script>

<style scoped>

</style>