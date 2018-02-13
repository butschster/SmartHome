<template>
    <main-layout v-loading="loading" :crumb="crumb">
        <page-header :title="`Устройство ${device.name}`" :crumb="crumb">
            <div class="page-header-actions">
                <router-link :to="logsLink" type="button" class="btn btn-outline btn-round btn-primary" tag="button">
                    <icon name="fas fa-fw fa-archive"></icon>
                    Логи
                </router-link>
            </div>
        </page-header>

        <page-content>
            <device-form :device="device" v-on:save="update"></device-form>

            <properties :properties="device.properties"></properties>
        </page-content>
    </main-layout>
</template>

<script>
    import PageHeader from 'Components/Layouts/Partials/Header';
    import DeviceRepository from 'Repositories/Device';
    import {DEVICES_LIST, DEVICE_SHOW, DEVICE_LOGS} from 'router/actions';
    import DeviceForm from './Partials/Form';
    import Properties from './Property/List';

    export default {
        name: "page-device-show",
        components: {
            DeviceForm, Properties, PageHeader
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
            },
            logsLink() {
                return {
                    name: DEVICE_LOGS,
                    params: {id: this.deviceId}
                }
            }
        }
    }
</script>