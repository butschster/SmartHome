<template>
    <tr>
        <router-link :to="itemLink" tag="td">
            <h5 class="blue-grey-700 mt-0">{{ room.name }}</h5>
            <small class="blue-grey-400">{{ room.description }}</small>
        </router-link>
        <td class="cell-60">
            <button class="btn btn-sm btn-icon btn-danger" @click="destroy">
                <icon name="far fa-trash-alt"></icon>
            </button>
        </td>
    </tr>
</template>

<script>
    import RoomRepository from 'Repositories/Room';
    import {ROOM_SHOW} from 'router/actions';

    export default {
        props: {
            room: {
                required: true,
                type: Object,
                default() {
                    return RoomRepository.structure;
                }
            }
        },
        methods: {
            async destroy() {
                this.$emit('destroy', this.room)
            }
        },
        computed: {
            itemLink() {
                return {
                    name: ROOM_SHOW,
                    params: {id: this.room.id}
                }
            }
        }
    }
</script>