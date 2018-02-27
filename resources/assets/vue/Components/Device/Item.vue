<template>
    <div class="card border">
        <div class="card-header">
            {{ device.name }}
            <p v-if="hasDescription" class="card-text text-muted">{{ device.description }}</p>
        </div>

        <property :property="property"
                  v-for="property in device.properties"
                  :key="property.id"
                  v-on:changed="updateProperty"
                  class="mb-0"
        >
        </property>

        <device-status :device="device" class="card-footer"></device-status>
    </div>
</template>

<script>
    import Property from './Property';
    import DeviceStatus from './Partials/Status';

    export default {
        components: {
            Property, DeviceStatus
        },
        props: {
            device: {
                required: true,
                type: Object
            }
        },
        mounted() {
            Echo.channel(`device.${this.device.id}`)
                .listen('.last_activity.updated', e => {
                    this.$emit('updated', e.device);
                });
        },
        methods: {
            updateProperty(p) {
                this.device.properties = _.map(this.device.properties, property => {
                    if (property.id == p.id) {
                        return p;
                    }

                    return property;
                })
            }
        },
        computed: {
            hasDescription() {
                return !_.isEmpty(this.device.description);
            },
            hasProperties() {
                return !_.isEmpty(this.device.properties);
            }
        }
    }
</script>