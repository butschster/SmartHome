<template>
    <div>
        <button type="button" class="btn float-right" @click="toggle" :class="btnClasses">
            <i class="far fa-lightbulb fa-1x"></i>
        </button>

        <h5 class="list-group-item-heading">
            <i class="fas fa-power-off"></i>
            {{ property.name }}
        </h5>
        <small v-if="hasDescription" class="text-muted">{{ property.description }}</small>

        <div class="clearfix"></div>
    </div>
</template>

<script>
    import Mixin from './mixin';
    export default {
        mixins: [Mixin],
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
            listClasses() {
                return {
                    'list-group-item-success': this.isSwitchedOn,
                }
            },
            btnClasses() {
                return {
                    'btn-success': this.isSwitchedOn,
                    'btn-default': this.isSwitchedOn,
                }
            }
        }
    }
</script>