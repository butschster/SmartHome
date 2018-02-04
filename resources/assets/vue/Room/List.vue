<template>
    <div>
        <h3>Помещения</h3>

        <room v-for="room in rooms" :key="room.id" :room="room"></room>
    </div>
</template>

<script>
    import RoomRepository from '../Repositories/Room';
    import Room from './Item';

    export default {
        components: {
            Room
        },
        data() {
            return {
                rooms: []
            }
        },
        mounted() {
            this.loadRooms();
        },
        methods: {
            async loadRooms() {

                this.rooms = await RoomRepository.list();

            }
        }
    }
</script>