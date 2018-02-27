<template>
    <div class="card-body">
        <button type="button" class="btn float-right" @click="toggle" :class="btnClasses">
            <i class="far fa-lightbulb fa-2x"></i>
        </button>

        <h5>
            <i class="fas fa-power-off"></i>
            {{ property.name }}
        </h5>
        <small v-if="hasDescription" class="text-muted">{{ property.description }}</small>

        <div class="clearfix"></div>
    </div>
</template>

<script>
    import PropertyMixin from '../Mixins/Property';

    export default {
        mixins: [PropertyMixin],
        methods: {
            async toggle() {
                await this.$api.commands.handleDeviceCommand(this.property.id, 'toggle');

                this.property.value == 1
                    ? this.property.value = 0
                    : this.property.value = 1;
            }
        },
        computed: {
            isSwitchedOn() {
                return this.property.value == 1;
            },
            btnClasses() {
                return {
                    'btn-success text-white': this.isSwitchedOn,
                    'btn-default': !this.isSwitchedOn,
                }
            }
        }
    }
</script>