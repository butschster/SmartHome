<template>
    <main-layout :title="room.name" v-loading="loading" :crumb="crumb">
        <page-content>
            <room-form :room="room" v-on:save="create"></room-form>
        </page-content>
    </main-layout>
</template>

<script>
    import RoomRepository from 'Repositories/Room';
    import RoomForm from './Partials/Form';
    import {ROOM_SHOW, ROOM_CREATE} from 'router/actions';

    export default {
        name: "page-room-create",
        components: {
            RoomForm
        },
        data() {
            return {
                room: _.defaults({name: 'Новое помещение'}, RoomRepository.structure),
                loading: false
            }
        },
        methods: {
            async create(data) {
                this.loading = true;

                try {
                    let room = await RoomRepository.store(data);

                    this.$message.info('Помещение создано.');
                    this.$router.push({
                        name: ROOM_SHOW,
                        params: {id: room.id}
                    });

                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            }
        },
        computed: {
            crumb() {
                return {
                    name: ROOM_CREATE,
                    params: this.room
                };
            }
        }
    }
</script>