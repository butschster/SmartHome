<template>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" id="name" v-model="device.name">
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" id="description" v-model="device.description"></textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-primary" @click="save">Сохранить</button>
        </div>
    </div>
</template>

<script>
    import DeviceRepository from 'Repositories/Device';

    export default {
        props: {
            device: {
                required: true,
                type: Object,
                default() {
                    return DeviceRepository.structure;
                }
            }
        },
        methods: {
            save() {
                this.$emit('save', this.device)
            }
        }
    }
</script>