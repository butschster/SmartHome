<template>
    <div class="card mb-5" v-loading="loading">
        <div class="card-header" v-if="!edit">
            <div class="btn-group float-right" role="group">
                <button class="btn btn-danger btn-sm" @click="destroy">
                    <i class="far fa-trash-alt"></i>
                </button>

                <button class="btn btn-primary btn-sm" @click="edit = !edit">
                    <i class="far fa-edit"></i>
                </button>
            </div>

            {{ device.name }}
            <p v-if="hasDescription" class="card-text text-muted">{{ device.description }}</p>
        </div>

        <device-form :data="device"
                     v-if="edit"
                     v-on:update="update"
                     v-on:close="edit = false"
                     class="border-top-0 border-right-0 border-left-0 border-bottom border-light"
        >
        </device-form>

        <div class="card-group">
            <property :property="property"
                      v-for="property in device.properties"
                      :key="property.id"
                      v-on:changed="updateProperty"
                      class="w-50"
            >
            </property>
        </div>

        <device-status :device="device" class="card-footer"></device-status>
    </div>
</template>

<script>
    import Property from './Property';
    import DeviceForm from './Form';
    import DeviceStatus from './Partials/Status';
    import DeviceRepository from '../../Repositories/Device';

    export default {
        components: {
            Property, DeviceForm, DeviceStatus
        },
        props: {
            device: {
                required: true,
                type: Object
            }
        },
        data() {
            return {
                edit: false,
                loading: false
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
            },
            async update(data) {
                this.loading = true;

                try {
                    await DeviceRepository.update(this.device.id, data).then(device => {
                        this.$emit('updated', device);
                        this.edit = false;
                    });

                    this.$message.success('Данные успешно обновлены.');
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            },
            async destroy() {
                this.loading = true;

                try {
                    DeviceRepository.destroy(this.device.id).then(r => {
                        this.$emit('destroyed', this.device);
                    });

                    this.$message.success('Устройство удалено.');
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
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