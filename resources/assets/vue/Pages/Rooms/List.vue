<template>
    <main-layout title="Помещения" icon="fas fa-cubes" class="app-work" :classes="{page: 'bg-white'}" :crumb="crumb">
        <page-content class="page-content-table">
            <div class="panel">
                <search-form v-model="searchQuery" placeholder="Поиск"></search-form>

                <template v-if="hasRooms">
                    <table class="table" v-loading="loading">
                        <tbody>
                            <table-item :room="room" v-for="room in rooms" :key="room.id" v-on:destroy="destroy"></table-item>
                        </tbody>
                    </table>
                </template>
                <template v-else>
                    <div role="alert" v-if="!loading" class="alert dark alert-info">
                        <p>
                            Раздел пуст.
                        </p>
                    </div>
                </template>
            </div>

            <actions>
                <button-action :link="createLink" icon="fas fa-plus"></button-action>
            </actions>
        </page-content>
    </main-layout>
</template>

<script>
    import RoomRepository from 'Repositories/Room';
    import TableItem from './Partials/Room';
    import SearchForm from 'Components/Form/Search';
    import {ROOM_CREATE, ROOMS_LIST} from 'router/actions';

    export default {
        name: "page-rooms-list",
        components: {
            TableItem, SearchForm
        },
        data() {
            return {
                rooms: [],
                searchQuery: '',
                loading: false,
                createLink: {
                    name: ROOM_CREATE
                },
                crumb: {
                    name: ROOMS_LIST
                }
            }
        },
        mounted() {
            this.loadRooms();
        },
        methods: {
            async loadRooms() {
                this.loading = true;

                try {
                    this.rooms = await RoomRepository.list();
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            },

            async destroy(room) {

                try {
                    await this.$confirm('Вы действительно хотите удалить запись?', room.name);
                } catch (e) {
                    return;
                }

                this.loading = true;

                try {
                    await RoomRepository.destroy(room.id);
                    this.rooms = this.rooms.filter(r => r.id != room.id);
                    this.$message.info('Помещение удалено.');
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            }

        },
        computed: {
            hasRooms() {
                return this.rooms.length > 0;
            }
        }
    }
</script>