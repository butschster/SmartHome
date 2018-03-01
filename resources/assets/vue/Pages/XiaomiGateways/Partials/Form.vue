<template>
    <div class="card card-bordered">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" id="name" v-model="gateway.name">
            </div>

            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" id="description" v-model="gateway.description"></textarea>
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="text" class="form-control" id="password" v-model="gateway.password">
            </div>
        </div>

        <div class="card-footer">
            <button type="button" class="btn btn-primary" @click="save">Сохранить</button>
        </div>
    </div>
</template>

<script>
    import Repository from 'Repositories/Xiaomi';

    export default {
        name: "room-form",
        props: {
            gateway: {
                type: Object,
                default() {
                    return Repository.gatewayStructure;
                }
            }
        },
        methods: {
            save() {
                this.$emit('save', this.gateway)
            }
        }
    }
</script>