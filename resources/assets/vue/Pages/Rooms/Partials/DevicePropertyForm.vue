<template>
    <div>

    </div>
</template>

<script>
    import RoomRepository from 'Repositories/Room';

    export default {
        name: "device-property-form",
        props: {
            room: {
                type: Object,
                required: true,
                default() {
                    return RoomRepository.structure;
                }
            }
        },
        mounted() {

        }
    }
</script>