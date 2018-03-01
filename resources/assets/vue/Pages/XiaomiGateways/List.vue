<template>
    <main-layout title="Xiaomi Gateways" icon="fas fa-plug" class="app-work" :classes="{page: 'bg-white'}" :crumb="crumb">
        <page-content class="page-content-table">
            <div class="panel">
                <template v-if="hasGateways">
                    <table class="table" v-loading="loading">
                        <tbody>
                            <table-item :gateway="gateway" v-for="gateway in gateways" :key="gateway.id" v-on:destroy="destroy"></table-item>
                        </tbody>
                    </table>
                </template>
                <template v-else>
                    <div role="alert" v-if="!loading" class="alert dark alert-info">
                        <p>
                            Шлюзы не найдены.
                        </p>
                    </div>
                </template>
            </div>
        </page-content>
    </main-layout>
</template>

<script>
    import XiaomiRepository from 'Repositories/Xiaomi';
    import TableItem from './Partials/Gateway';
    import SearchForm from 'Components/Form/Search';
    import { XIAOMI_GATEWAY_LIST } from 'router/actions';

    export default {
        name: "page-gateways-list",
        components: {
            TableItem, SearchForm
        },
        data() {
            return {
                gateways: [],
                loading: false,
                crumb: {
                    name: XIAOMI_GATEWAY_LIST
                }
            }
        },
        mounted() {
            this.loadGateways();
        },
        methods: {
            async loadGateways() {
                this.loading = true;

                try {
                    this.gateways = await XiaomiRepository.gateways();
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            },

            async destroy(gateway) {

                try {
                    await this.$confirm('Вы действительно хотите удалить шлюз?', gateway.name);
                } catch (e) {
                    return;
                }

                this.loading = true;

                try {
                    await XiaomiRepository.destroy(gateway.id);
                    this.gateways = this.gateways.filter(g => g.id != gateway.id);
                    this.$message.info('Шлюз удален.');
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            }

        },
        computed: {
            hasGateways() {
                return this.gateways.length > 0;
            }
        }
    }
</script>