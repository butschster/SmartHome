<template>
    <div class="card-body">
        <div class="float-right text-right">
            <i class="fas fa-3x fa-fw" :class="motionsClass"></i>
        </div>
        <h4>
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
            motionsClass() {
                return {
                    'fa-heartbeat text-primary': this.property.value == 'motion',
                    'fa-heart text-muted': this.property.value != 'motion',
                }
            }
        }
    }
</script>