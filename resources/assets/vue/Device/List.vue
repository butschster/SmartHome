<template>
    <div>
        <h3>Устройства</h3>

        <device v-for="device in devices"
                :device="device"
                :key="device.id"
                v-on:updated="updateDevice"
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
            },

            updateDevice(d) {
                this.devices = _.map(this.devices, device => {
                    if (d.id == device.id) {
                        d.properties = device.properties;
                        return d;
                    } else return device;
                });
            }
        }
    }
</script>