<template>
    <div class="panel" :class="panelClasses">
        <div class="panel-heading">
            <div class="panel-title">
                {{ device.name }}

                <span class="label label-danger" v-if="isOutOfDate">Нет связи</span>
                <span class="label label-info" v-else>Последняя активность {{ device.last_activity }}</span>

                <div class="btn-group pull-right" role="group">
                    <button class="btn btn-danger btn-sm" v-if="isOutOfDate" @click="destroy">
                        <i class="far fa-trash-alt"></i>
                    </button>

                    <button class="btn btn-default btn-sm" @click="edit = !edit">
                        <i class="far fa-edit"></i>
                    </button>
                </div>
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
    import DeviceRepository from '../Repositories/Device';

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
        mounted() {
            Echo.channel(`device.${this.device.id}`)
                .listen('.last_activity.updated', e => {
                    this.updated(e.device);
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
            },
            updated(device) {
                this.$emit('updated', device);
            },
            async destroy() {
                DeviceRepository.destroy(this.device.id).then(r => {
                    this.$emit('destroyed', this.device);
                });
            }
        },
        computed: {
            hasDescription() {
                return !_.isEmpty(this.device.description);
            },
            isOutOfDate() {
                if (this.device.last_activity) {
                    return !moment(this.device.last_activity).isAfter(moment().subtract(1, 'hours'));
                }

                return true;
            },
            panelClasses() {
                return {
                    'panel-primary': !this.isOutOfDate,
                    'panel-warning': this.isOutOfDate
                };
            }
        }
    }
</script>