<template>
    <main-layout :title="`Устройство ${device.name}`" v-loading="loading" :crumb="crumb">
        <page-content>
            <device-form :device="device" v-on:save="update"></device-form>

            <properties :properties="device.properties"></properties>
        </page-content>
    </main-layout>
</template>

<script>
    import DeviceRepository from 'Repositories/Device';
    import {DEVICES_LIST, DEVICE_SHOW} from 'router/actions';
    import DeviceForm from './Partials/Form';
    import Properties from './Property/List';

    export default {
        name: "page-device-show",
        components: {
            DeviceForm, Properties
        },
        data() {
            return {
                device: DeviceRepository.structure,
                loading: false
            }
        },
        created() {
            this.loadDevice()
        },
        methods: {
            async loadDevice() {
                this.loading = true;

                try {
                    this.device = await DeviceRepository.show(this.deviceId);

                } catch (e) {
                    this.$message.error(e.message);

                    this.$router.push({
                        name: DEVICES_LIST
                    });
                }

                this.loading = false;
            },

            async update(data) {
                this.loading = true;

                try {
                    this.device = await DeviceRepository.update(this.deviceId, data);

                    this.$message.info('Данные устройства обновлены.');
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
            crumb() {
                return {
                    name: DEVICE_SHOW,
                    params: this.device
                }
            }
        }
    }
</script>