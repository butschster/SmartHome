<template>
    <div class="card card-bordered border-primary" v-loading="loading">
        <div class="card-header">Подключенные устройства</div>
        <device
                v-for="device in devices"
                :device="device"
                :key="device.id" class="mb-0"></device>
    </div>
</template>

<script>
    import XiaomiRepository from 'Repositories/Xiaomi';
    import Device from 'Pages/Devices/Partials/Device';

    export default {
        props: {
            gateway: Object
        },
        components: {
            Device
        },
        data() {
            return {
                devices: [],
                loading: false
            }
        },
        created() {
            this.loadDevices()
        },
        methods: {
            async loadDevices() {
                this.loading = true;

                try {
                    this.devices = await XiaomiRepository.gatewayDevices(this.gateway.id);

                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            },
        }
    }
</script>