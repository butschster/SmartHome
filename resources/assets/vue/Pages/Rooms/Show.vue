<template>
    <main-layout :title="room.name" v-loading="loading" :crumb="crumb">
        <page-content>
            <room-form :room="room" v-on:save="update"></room-form>

            <device-property-form :room="room" v-if="room.id"></device-property-form>
        </page-content>
    </main-layout>
</template>

<script>
    import RoomRepository from 'Repositories/Room';
    import {ROOMS_LIST, ROOM_SHOW} from 'router/actions';
    import RoomForm from './Partials/Form';
    import DevicePropertyForm from './Partials/DevicePropertyForm';

    export default {
        name: "page-room-show",
        components: {
            RoomForm, DevicePropertyForm
        },
        data() {
            return {
                room: RoomRepository.structure,
                loading: false
            }
        },
        created() {
            this.loadRoom()
        },
        methods: {
            async loadRoom() {
                this.loading = true;

                try {
                    this.room = await RoomRepository.show(this.roomId);

                } catch (e) {
                    this.$message.error(e.message);

                    this.$router.push({
                        name: ROOMS_LIST
                    });
                }

                this.loading = false;
            },

            async update(data) {
                this.loading = true;

                try {
                    this.room = await RoomRepository.update(this.roomId, data);

                    this.$message.info('Данные обновлены.');
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            }
        },
        computed: {
            roomId() {
                return this.$route.params.id;
            },
            crumb() {
                return {
                    name: ROOM_SHOW,
                    params: this.room
                }
            }
        }
    }
</script>