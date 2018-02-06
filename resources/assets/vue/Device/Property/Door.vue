<template>
    <div>
        <slot></slot>

        <el-switch
                v-model="isOpen"
                active-text="Открыта"
                inactive-text="Закрыта"
                disabled
        >
        </el-switch>
    </div>
</template>

<script>
    import Mixin from './mixin';

    export default {
        mixins: [Mixin],
        computed: {
            isOpen() {
                return this.property.value == 1;
            }
        }
    }
</script>