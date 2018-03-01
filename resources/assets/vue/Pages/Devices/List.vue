<template>
    <main-layout title="Устройства" icon="fas fa-microchip" class="app-work" v-loading="loading" :crumb="crumb">
        <page-content class="page-content-table">
            <device v-for="device in devices" :device="device" :key="device.id" v-on:destroy="destroy"></device>
        </page-content>
    </main-layout>
</template>

<script>
    import DeviceRepository from 'Repositories/Device';
    import Device from './Partials/Device';
    import {DEVICES_LIST} from 'router/actions';

    export default {
        name: "page-devices-list",
        components: {
            Device
        },
        data() {
            return {
                devices: [],
                loading: false,
                crumb: {
                    name: DEVICES_LIST
                }
            }
        },
        mounted() {
            Echo.channel('device')
                .listen('.registered', e => {
                    this.loadDevices();
                });

            this.loadDevices();
        },
        methods: {
            async loadDevices() {
                this.loading = true;

                try {
                    this.devices = await DeviceRepository.list();
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            },

            async destroy(device) {
                try {
                    await this.$confirm('Вы действительно хотите удалить устройство?', device.name);
                } catch (e) {
                    return;
                }

                this.loading = true;

                try {
                    await DeviceRepository.destroy(device.id);
                    this.devices = this.devices.filter(d => d.id != device.id);
                    this.$message.info('Устройство удалено.');
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            }
        }
    }
</script>