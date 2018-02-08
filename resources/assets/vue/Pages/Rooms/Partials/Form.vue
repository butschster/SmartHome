<template>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" id="name" v-model="room.name">
            </div>

            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" id="description" v-model="room.description"></textarea>
            </div>

            <div class="form-group">
                <label for="position">Позиция</label>
                <input type="number" class="form-control" id="position" v-model="room.position">
            </div>
        </div>

        <div class="card-footer">
            <button type="button" class="btn btn-primary" @click="save">Сохранить</button>
        </div>
    </div>
</template>

<script>
    import RoomRepository from 'Repositories/Room';

    export default {
        name: "room-form",
        props: {
            room: {
                type: Object,
                default() {
                    return RoomRepository.structure;
                }
            }
        },
        methods: {
            save() {
                this.$emit('save', this.room)
            }
        }
    }
</script>