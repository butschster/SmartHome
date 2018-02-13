<template>
    <main-layout title="Логи устройства" v-loading="loading" :crumb="crumb">
        <page-content>
            <div class="card">
                <table class="table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th class="w-100" scope="col">Created At</th>
                        <th scope="col">Message</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="log in logs" :key="log.id">
                        <td>
                            <small>{{ log.created_at }}</small>
                        </td>
                        <td>
                            <textarea class="form-control" disabled style="font-size: .7rem">{{ log.message }}</textarea>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="card-footer">
                    <pagination :data="pagination" v-on:page-changed="gotoPage"></pagination>
                </div>
            </div>
        </page-content>
    </main-layout>
</template>

<script>
    import {DEVICE_LOGS} from "router/actions";
    import DeviceRepository from 'Repositories/Device';
    import Pagination from 'Components/Layouts/Partials/Pagination';

    export default {
        name: "mqtt-logs",
        components: {Pagination},
        data() {
            return {
                logs: [],
                device: DeviceRepository.structure,
                pagination: null,
                loading: false
            }
        },
        mounted() {
            this.loadDevice();
        },
        methods: {
            gotoPage(page) {
                this.$router.replace({query: {page}});
                this.loadLogs(page);
            },

            async loadDevice() {
                this.loading = true;

                try {
                    this.device = await DeviceRepository.show(this.deviceId);
                    this.loadLogs(this.currentPage)
                } catch (e) {
                    this.$message.error(e.message);

                    this.$router.push({
                        name: DEVICES_LIST
                    });
                }

                this.loading = false;
            },

            async loadLogs(page = 1) {
                this.loading = true;

                try {
                    [this.logs, this.pagination] = await DeviceRepository.logs(this.deviceId, {page});
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
            currentPage() {
                return this.$route.query.page || 1;
            },
            crumb() {
                return {
                    name: DEVICE_LOGS,
                    params: this.device
                }
            }
        }
    }
</script>