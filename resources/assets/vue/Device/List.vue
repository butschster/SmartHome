<template>
    <div>
        <h3>Устройства</h3>

        <device v-for="device in devices"
                :device="device"
                :key="device.id"
        ></device>
    </div>
</template>

<script>
    import DeviceRepository from '../Repositories/Device';
    import Device from './Item';

    export default {
        components: {
            Device
        },
        data() {
            return {
                devices: []
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

                this.devices = await DeviceRepository.list();

            }
        }
    }
</script>