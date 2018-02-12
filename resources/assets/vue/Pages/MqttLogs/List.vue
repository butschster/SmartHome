<template>
    <main-layout title="Логи MQTT" v-loading="loading" :crumb="crumb">
        <page-content>
            <div class="card">
                <table class="table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th class="w-100" scope="col">Created At</th>
                        <th class="w-250" scope="col">Topic</th>
                        <th scope="col">Message</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="log in logs" :key="log.id">
                        <td>
                            <small>{{ log.created_at }}</small>
                        </td>
                        <th>
                            <small><strong>{{ log.topic }}</strong></small>
                        </th>
                        <td>
                            <textarea class="form-control" disabled
                                      style="font-size: .7rem">{{ log.message }}</textarea>
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
    import {MQTT_LOGS} from "router/actions";
    import Mqttrepository from 'Repositories/Mqtt';
    import Pagination from 'Components/Layouts/Partials/Pagination';

    export default {
        name: "mqtt-logs",
        components: {Pagination},
        data() {
            return {
                logs: [],
                pagination: null,
                links: [],
                loading: false,
                crumb: {
                    name: MQTT_LOGS
                }
            }
        },
        mounted() {
            Echo.channel('mqtt')
                .listen('.message', e => {
                    this.loadLogs(this.currentPage);
                });

            this.loadLogs(this.currentPage);
        },
        methods: {
            gotoPage(page) {
                this.$router.replace({query: {page}});
                this.loadLogs(page);
            },

            async loadLogs(page = 1) {
                this.loading = true;

                try {
                    [this.logs, this.pagination, this.links] = await Mqttrepository.logs({page});
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            }
        },
        computed: {
            currentPage() {
                return this.$route.query.page || 1;
            }
        }
    }
</script>