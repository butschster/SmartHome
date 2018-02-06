<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" id="name" v-model="data.name">
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" id="description" v-model="data.description"></textarea>
            </div>
        </div>
        <div class="panel-footer">
            <button type="button" class="btn btn-primary" @click="update">Сохранить</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            data: {
                required: true,
                type: Object
            }
        },
        methods: {
            async update() {
                this.$emit('update', {
                    name: this.data.name,
                    description: this.data.description
                });
            },
            close() {
                this.$emit('close')
            }
        }
    }
</script>