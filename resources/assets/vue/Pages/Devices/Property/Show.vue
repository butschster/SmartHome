<template>
    <main-layout :title="`Датчик ${property.name}`" v-loading="loading" :crumb="crumb">
        <page-content>
            <property-form :property="property" v-on:save="update"></property-form>

            <rooms-list :property="property" v-if="property.id"></rooms-list>
        </page-content>
    </main-layout>
</template>

<script>
    import DeviceRepository from 'Repositories/Device';
    import DevicePropertyRepository from 'Repositories/DeviceProperty';
    import {DEVICE_SHOW, DEVICE_PROPERTY_SHOW} from 'router/actions';
    import PropertyForm from './Partials/Form';
    import RoomsList from './Partials/Rooms';

    export default {
        name: "page-room-show",
        components: {
            PropertyForm, RoomsList
        },
        data() {
            return {
                device: DeviceRepository.structure,
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
                    this.device = await DeviceRepository.show(this.deviceId);
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
            deviceId() {
                return this.$route.params.id;
            },
            propertyId() {
                return this.$route.params.property;
            },
            crumb() {
                return {
                    name: DEVICE_PROPERTY_SHOW,
                    params: {property: this.property, device: this.device}
                }
            }
        }
    }
</script>