<template>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" id="name" v-model="property.name">
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" id="description" v-model="property.description"></textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-primary" @click="save">Сохранить</button>
        </div>
    </div>
</template>

<script>
    import DevicePropertyRepository from 'Repositories/DeviceProperty';

    export default {
        props: {
            property: {
                required: true,
                type: Object,
                default() {
                    return DevicePropertyRepository.structure;
                }
            }
        },
        methods: {
            save() {
                this.$emit('save', this.property)
            }
        }
    }
</script>