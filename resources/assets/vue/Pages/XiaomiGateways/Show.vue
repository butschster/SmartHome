<template>
    <main-layout :title="`Шлюз ${gateway.name}`" v-loading="loading" :crumb="crumb">
        <page-content>
            <gateway-form :gateway="gateway" v-on:save="update"></gateway-form>
            <devices v-if="gateway.id" :gateway="gateway"></devices>
        </page-content>
    </main-layout>
</template>

<script>
    import XiaomiRepository from 'Repositories/Xiaomi';
    import {XIAOMI_GATEWAY_SHOW, XIAOMI_GATEWAY_LIST} from 'router/actions';
    import GatewayForm from './Partials/Form';
    import Devices from './Partials/Devices';

    export default {
        name: "page-gateway-show",
        components: {
            Devices,
            GatewayForm
        },
        data() {
            return {
                gateway: XiaomiRepository.gatewayStructure,
                devices: [],
                loading: false,
            }
        },
        created() {
            this.loadGateway()
        },
        methods: {
            async loadGateway() {
                this.loading = true;

                try {
                    this.gateway = await XiaomiRepository.gateway(this.gatewayId);

                } catch (e) {
                    this.$message.error(e.message);

                    this.$router.push({
                        name: XIAOMI_GATEWAY_LIST
                    });
                }

                this.loading = false;
            },

            async update(data) {
                this.loading = true;

                try {
                    this.gateway = await XiaomiRepository.update(this.gatewayId, data);

                    this.$message.info('Данные обновлены.');
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            }
        },
        computed: {
            gatewayId() {
                return this.$route.params.id;
            },
            crumb() {
                return {
                    name: XIAOMI_GATEWAY_SHOW,
                    params: this.gateway
                }
            }
        }
    }
</script>