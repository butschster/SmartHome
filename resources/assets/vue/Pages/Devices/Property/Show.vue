<template>
    <main-layout :title="`Датчик ${property.name}`" v-loading="loading" :crumb="crumb">
        <page-content>
            <property-form :property="property" v-on:save="update"></property-form>
        </page-content>
    </main-layout>
</template>

<script>
    import DevicePropertyRepository from 'Repositories/DeviceProperty';
    import {DEVICE_SHOW, DEVICE_PROPERTY_SHOW} from 'router/actions';
    import PropertyForm from './Partials/Form';

    export default {
        name: "page-room-show",
        components: {
            PropertyForm
        },
        data() {
            return {
                property: DevicePropertyRepository.structure,
                loading: false
            }
        },
        created() {
            this.loadRoom()
        },
        methods: {
            async loadRoom() {
                this.loading = true;

                try {
                    this.property = await DevicePropertyRepository.show(this.propertyId);

                } catch (e) {
                    this.$message.error(e.message);

                    this.$router.push({
                        name: DEVICE_SHOW,
                        params: {id: this.property.device_id}
                    });
                }

                this.loading = false;
            },

            async update(data) {
                this.loading = true;

                try {
                    this.property = await DevicePropertyRepository.update(this.propertyId, data);

                    this.$message.info('Данные обновлены.');
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            }
        },
        computed: {
            propertyId() {
                return this.$route.params.property;
            },
            crumb() {
                return {
                    name: DEVICE_PROPERTY_SHOW,
                    params: this.property
                }
            }
        }
    }
</script>