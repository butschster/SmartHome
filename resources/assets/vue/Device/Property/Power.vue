<template>
    <button type="button" class="btn btn-lg" :class="classes" @click="toggle">
        <i class="far fa-lightbulb fa-1x"></i> {{ property.name }}
    </button>
</template>

<script>
    export default {
        props: {
            property: {
                required: true,
                type: Object
            }
        },
        methods: {
            async toggle() {
                await this.$api.commands.invoke(this.property.id, 'toggle');

                this.property.value == 1
                    ? this.property.value = 0
                    : this.property.value = 1;
            }
        },
        computed: {
            isSwitchedOn() {
                return this.property.value == 1;
            },
            classes() {
                return {
                    'btn-success': this.isSwitchedOn,
                    'btn-default': !this.isSwitchedOn,
                }
            }
        }
    }
</script>