<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <label for="name">Название устройства</label>
                <input type="text" class="form-control" id="name" v-model="device.name">
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" id="description" v-model="device.description"></textarea>
            </div>
        </div>
        <div class="panel-footer">
            <button type="button" class="btn btn-primary" @click="update">Сохранить</button>
        </div>
    </div>
</template>

<script>
    import DeviceRepository from '../Repositories/Device';

    export default {
        props: {
            device: {
                required: true,
                type: Object
            }
        },
        methods: {
            async update() {

                await DeviceRepository.update(this.device.id, {
                    name: this.device.name,
                    description: this.device.description
                }).then(device => {
                    this.$emit('updated', device);
                });

            }
        }
    }
</script>