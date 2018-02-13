<template>
    <div v-if="hasRooms" class="card border border-primary">
        <div class="card-header">Привязан к помещениям</div>
        <div class="card-body">
            <router-link :to="linkRoom(room)"
                         class="badge badge-outline badge-info mr-5"
                         v-for="room in rooms"
                         :key="room.id">
                {{ room.name }}
            </router-link>
        </div>
    </div>
</template>

<script>
    import DevicePropertyRepository from 'Repositories/DeviceProperty';
    import {ROOM_SHOW} from 'router/actions';

    export default {
        name: "device-property-rooms",
        props: {
            property: {
                type: Object,
                required: true,
                default() {
                    return DevicePropertyRepository.structure
                }
            }
        },
        data() {
            return {
                rooms: [],
                loading: false
            }
        },
        mounted() {
            this.loadRooms();
        },
        methods: {
            async loadRooms() {
                this.loading = true;

                try {
                    this.rooms = await DevicePropertyRepository.rooms(this.property.id);
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            },
            linkRoom(room) {
                return {
                    name: ROOM_SHOW,
                    params: {id: room.id}
                }
            }
        },
        computed: {
            hasRooms() {
                return this.rooms.length > 0;
            }
        }
    }
</script>