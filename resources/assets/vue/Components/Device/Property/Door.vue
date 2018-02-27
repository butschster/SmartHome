<template>
    <div class="card-body">
        <el-switch
                v-model="isOpen"
                active-text="Открыто"
                inactive-text="Закрыто"
                disabled
                class="float-right"
        >
        </el-switch>

        <h4>
            <i class="fas fa-magnet"></i>
            {{ property.name }}
        </h4>
        <small v-if="hasDescription" class="text-muted">{{ property.description }}</small>
    </div>
</template>

<script>
    import PropertyMixin from '../Mixins/Property';

    export default {
        mixins: [PropertyMixin],
        computed: {
            isOpen() {
                return this.property.value == 1;
            }
        }
    }
</script>