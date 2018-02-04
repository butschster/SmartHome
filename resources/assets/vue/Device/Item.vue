<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                {{ device.name }}

                <button class="btn btn-default btn-sm pull-right" @click="edit = !edit">Edit</button>
            </div>
        </div>

        <div class="panel-body btn-info" v-if="hasDescription">
            {{ device.description }}
        </div>

        <device-form :device="device" v-if="edit" v-on:updated="updated"></device-form>

        <div class="panel-footer">
            <property :property="property"
                      v-for="property in device.properties"
                      :key="property.id"
                      v-on:changed="updateProperty"
            >
            </property>
        </div>
    </div>
</template>

<script>
    import Property from './Property';
    import DeviceForm from './Form';

    export default {
        components: {
            Property, DeviceForm
        },
        props: {
            device: {
                required: true,
                type: Object
            }
        },
        data() {
            return {
                edit: false
            }
        },
        methods: {
            updateProperty(p) {
                this.device.properties = _.map(this.device.properties, property => {
                    if (property.id == p.id) {
                        return p;
                    }
                    return property;
                })
            },
            updated(device) {
                this.$emit('updated', device);
            }
        },
        computed: {
            hasDescription() {
                return !_.isEmpty(this.device.description);
            }
        }
    }
</script>