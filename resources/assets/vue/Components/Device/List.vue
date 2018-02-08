<template>
    <div v-loading="loading">
        <device v-for="device in devices"
                :device="device"
                :key="device.id"
        >
        </device>
    </div>
</template>

<script>
    import DeviceRepository from 'Repositories/Device';
    import Device from './Item';

    export default {
        components: {
            Device
        },
        data() {
            return {
                devices: [],
                loading: false
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
            }
        }
    }
</script>