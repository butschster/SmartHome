<template>
    <div>
        <h4 class="list-group-item-heading pull-left">{{ property.name }}</h4>

        <button type="button" class="btn pull-right" @click="toggle" :class="btnClasses">
            <i class="far fa-lightbulb fa-1x"></i>
        </button>
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